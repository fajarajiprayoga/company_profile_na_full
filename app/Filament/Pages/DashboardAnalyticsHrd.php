<?php

namespace App\Filament\Pages;

use App\Exports\VisitorsByRegionExport;
use App\Exports\VisitorsPerJobExport;
use Carbon\Carbon;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Filter;
use Google\Analytics\Data\V1beta\Filter\StringFilter;
use Google\Analytics\Data\V1beta\Filter\StringFilter\MatchType;
use Google\Analytics\Data\V1beta\FilterExpression;
use Google\Analytics\Data\V1beta\FilterExpressionList;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\OrderBy as V1betaOrderBy;
use Google\Analytics\Data\V1beta\OrderBy\MetricOrderBy;
use Illuminate\Support\Facades\Auth;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\OrderBy;
use Spatie\Analytics\Period;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class DashboardAnalyticsHrd extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';

    protected static string $view = 'filament.pages.dashboard-analytics-hrd';

    protected static ?string $navigationGroup = 'Dashboard';

    protected static ?string $navigationLabel = 'Analytics HRD';

    public $careerDatas = [];
    public $btnApplyClickedDatas = [];
    public $viewerByRegion = [];

    public $start_date;
    public $end_date;

    public $search_career;

    public $report_type;

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->hasRole(['super-admin', 'hr']);
    }

    protected function getForms(): array
    {
        return [
            'form',
            'searchCareer',
            'formReport'
        ];
    }

    public function mount(){
        abort_if(!Auth::user()->hasRole(['super-admin', 'hr']), '403', 'Not Authorized');

        $this->start_date = Carbon::now()->startOfMonth();
        $this->end_date = Carbon::now();

        $this->careerDatas = $this->getDataCareerView($this->start_date,$this->end_date);

        $this->viewerByRegion = $this->getDataByCity($this->start_date,$this->end_date);
    }

    public function getDataCareerView($start_date, $end_date){
        $clickApplyButtonDatas = $this->getDataBtnApplyClicked($start_date, $end_date);

        $client = new BetaAnalyticsDataClient([
            'credentials' => storage_path('app/public/google_service_key/new-armada-company-profile-9982881fafc6.json')
        ]);

        $response = $client->runReport([
            'property' => 'properties/' . env('ANALYTICS_PROPERTY_ID'),
            'dateRanges' => [
                new DateRange([
                    'start_date' => Carbon::parse($start_date)->toDateString(),
                    'end_date' => Carbon::parse($end_date)->toDateString(),
                ])
            ],
            'dimensions' => [
                new Dimension(['name' => 'pageTitle']),
                new Dimension(['name' => 'hostName']),
                new Dimension(['name' => 'pagePath']),
            ],
            'metrics' => [
                new Metric(['name' => 'screenPageViews']),
                new Metric(['name' => 'averageSessionDuration']),
            ],
            'dimensionFilter' => new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'pagePath',
                    'string_filter' => new StringFilter([
                        'match_type' => StringFilter\MatchType::CONTAINS,
                        'value' => '/career/',
                    ]),
                ]),
            ]),
            'orderBys' => [
                    (new V1betaOrderBy())
                    ->setMetric((new MetricOrderBy())->setMetricName('screenPageViews'))
                    ->setDesc(true)
            ],
            'limit' => 10000,
        ]);

        $data = collect($response->getRows())->map(function ($row) {
            $dimensions = $row->getDimensionValues();
            $metrics = $row->getMetricValues();
            
            return [
                'pagePath' => $dimensions[2]->getValue(),
                'screenPageViews' => (int) $metrics[0]->getValue(),
                'averageSessionDuration' => (float) $metrics[1]->getValue(),
            ];
        });

        $datas = $data->groupBy('pagePath')->map(function ($dataGroup, $path) use ($clickApplyButtonDatas) {
            $dataClick = $clickApplyButtonDatas
                ->where('pagePath', $path)
                ->sum('eventCount');
            
            return [
                'careerTitle' => ucwords(str_replace('-', ' ', str_replace('/career/', '', $path))),
                'sessionDuration' => (int) $dataGroup->avg('averageSessionDuration'),
                'pagePath' => $path,
                'screenPageViews' => $dataGroup->sum('screenPageViews'),
                'clickApplyButton' => $dataClick ?? 0,
                'percent_by_views_vs_click' => $dataClick != 0 ? round(($dataClick / $dataGroup->sum('screenPageViews')) * 100, 2) : 0
            ];
        })->values();

        return $datas;

    }

    public function getDataBtnApplyClicked($start_date, $end_date){    
        $client = new BetaAnalyticsDataClient([
            'credentials' => storage_path('app/public/google_service_key/new-armada-company-profile-9982881fafc6.json')
        ]);

        // Jalankan report
        $response = $client->runReport([
            'property' => 'properties/' . env('ANALYTICS_PROPERTY_ID'),
            'dateRanges' => [
                new DateRange([
                    'start_date' => Carbon::parse($start_date)->toDateString(),
                    'end_date' => Carbon::parse($end_date)->toDateString(),
                ])
            ],
            'dimensions' => [
                new Dimension(['name' => 'eventName']),
                new Dimension(['name' => 'pagePath']),
            ],
            'metrics' => [
                new Metric(['name' => 'eventCount']),
            ],
            'dimensionFilter' => new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'eventName',
                    'string_filter' => new StringFilter([
                        'match_type' => StringFilter\MatchType::EXACT,
                        'value' => 'click_apply_button',
                    ]),
                ]),
            ]),
            'orderBys' => [
                (new V1betaOrderBy())
                    ->setMetric((new MetricOrderBy())->setMetricName('eventCount'))
                    ->setDesc(true)
            ],
            'limit' => 10000,
        ]);

        // Konversi ke Laravel Collection
        $datas = collect($response->getRows())->map(function ($row) {
            $dimensions = $row->getDimensionValues();
            $metrics = $row->getMetricValues();

            return [
                'eventName' => $dimensions[0]->getValue(),
                'pagePath' => $dimensions[1]->getValue(),
                'eventCount' => (int) $metrics[0]->getValue(),
            ];
        });

        return $datas;
    }

    public function getDataByCity($start_date, $end_date){
        $client = new BetaAnalyticsDataClient([
            'credentials' => storage_path('app/public/google_service_key/new-armada-company-profile-9982881fafc6.json')
        ]);

        $response = $client->runReport([
            'property' => 'properties/' . env('ANALYTICS_PROPERTY_ID'),
            'dateRanges' => [
                new DateRange([
                    'start_date' => Carbon::parse($start_date)->toDateString(),
                    'end_date' => Carbon::parse($end_date)->toDateString(),
                ])
            ],
            'dimensions' => [
                // new Dimension(['name' => 'city']),
                new Dimension(['name' => 'region']),
                new Dimension(['name' => 'country']),
            ],
            'metrics' => [
                new Metric(['name' => 'screenPageViews']),
                new Metric(['name' => 'averageSessionDuration']),
            ],
            'dimensionFilter' => new FilterExpression([
                'and_group' => new FilterExpressionList([
                    'expressions' => [
                        new FilterExpression([
                            'filter' => new Filter([
                                'field_name' => 'pagePath',
                                'string_filter' => new StringFilter([
                                    'match_type' => StringFilter\MatchType::CONTAINS,
                                    'value' => '/career/',
                                ]),
                            ]),
                        ]),
                        // new FilterExpression([
                        //     'filter' => new Filter([
                        //         'field_name' => 'country',
                        //         'string_filter' => new StringFilter([
                        //             'match_type' => StringFilter\MatchType::CONTAINS,
                        //             'value' => 'Indonesia',
                        //         ]),
                        //     ]),
                        // ]),
                    ],
                ]),
            ]),
            'limit' => 10000,
        ]);

        $data = collect($response->getRows())->map(function ($row) {
            $dimensions = $row->getDimensionValues();
            $metrics = $row->getMetricValues();

            return [
                'region' => $dimensions[0]->getValue(),
                'country' => $dimensions[1]->getValue(),
                'screenPageViews' => $metrics[0]->getValue(),
                'averageSessionDuration' => (int) $metrics[1]->getValue(),
            ];
        });

        return $data;
    }

    /**
     * Form filter data
     */
    public function form(Form $form): Form {
        return $form->schema([
                DatePicker::make('start_date')
                    ->native(false)
                    ->maxDate(now())
                    ->default(now()),
                DatePicker::make('end_date')
                    ->native(false)
                    ->maxDate(now())
                    ->default(now()),
        ])->columns(2);
    }

    /**
     * Form search by career title
     */
    public function searchCareer(Form $form): Form {
        return $form->schema([
            TextInput::make('search_career')
            ->hiddenLabel()
            ->placeholder("Search by job name")
            ->reactive()
            ->live(debounce: 800)
            ->afterStateUpdated(function (?string $state, ?string $old) {
                if(!empty($state)){
                    $this->careerDatas = collect($this->careerDatas)->filter(function($data) use ($state){
                        return Str::of($data['careerTitle'])->lower()->contains(Str::lower($state));
                    });
                }else {
                    $this->generate();
                }
            })
        ]);
    }

    /**
     * Form Report
     */
    public function formReport(Form $form): Form {
        return $form->schema([
            Select::make('report_type')
                ->label('Type')
                ->options([
                    'report_visitors_per_job_excel' => 'Report Visitors per Job (Excel)',
                    'report_visitors_by_region_excel' => 'Report Visitors by Region (Excel)'
                ])->required()
        ]); 
    }

    /**
     * Function generate Data
     */
    public function generate(){
        $this->careerDatas = $this->getDataCareerView($this->start_date,$this->end_date);
        $this->viewerByRegion = $this->getDataByCity($this->start_date,$this->end_date);
    }

    /**
     * Function generate report
     */
    public function generateReport(){
        $start_date = $this->start_date->format('d-m-Y');
        $end_date = $this->end_date->format('d-m-Y');
        switch($this->report_type){
            case "report_visitors_per_job_excel":
                return Excel::download(new VisitorsPerJobExport($this->careerDatas), "Report Visitors Per Job $start_date to $end_date.xlsx");
                break;
            case "report_visitors_by_region_excel":
                return Excel::download(new VisitorsByRegionExport($this->viewerByRegion), "Report Visitors By Region $start_date to $end_date.xlsx");
                break;
            default:
                break;
        }
    }
}
