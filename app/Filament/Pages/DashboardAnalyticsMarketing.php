<?php

namespace App\Filament\Pages;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Filter;
use Google\Analytics\Data\V1beta\Filter\StringFilter;
use Google\Analytics\Data\V1beta\FilterExpression;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\OrderBy as V1betaOrderBy;
use Google\Analytics\Data\V1beta\OrderBy\MetricOrderBy;
use Illuminate\Support\Facades\Auth;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\OrderBy;
use Spatie\Analytics\Period;
use Illuminate\Support\Str;

class DashboardAnalyticsMarketing extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';

    protected static string $view = 'filament.pages.dashboard-analytics-marketing';

    protected static ?string $navigationGroup = 'Dashboard';

    protected static ?string $navigationLabel = 'Analytics Marketing';

    public $productDatas = [];
    public $newsDatas = [];

    public $start_date;
    public $end_date;

    public $search_product;
    public $search_news;

    public $isShowChartProduct = 'daily';

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->hasRole(['super-admin', 'marketing']);
    }

    protected function getForms(): array
    {
        return [
            'form',
            'searchProduct',
            'searchNews',
        ];
    }

    public function mount(){
        abort_if(!Auth::user()->hasRole(['super-admin', 'marketing']), '403', 'Not Authorized');

        $this->start_date = Carbon::now()->startOfMonth();
        $this->end_date = Carbon::now();

        $this->productDatas = $this->getDataProductView($this->start_date, $this->end_date);
        $this->newsDatas = $this->getDataNewsView($this->start_date, $this->end_date);
    }

    public function getDataProductView($start_date, $end_date){
        // $datas = Analytics::get(
        //     Period::create($start_date, $end_date),
        //     ['screenPageViews', 'averageSessionDuration'],
        //     ['pageTitle', 'hostName', 'pagePath', 'date'],
        //     10000,
        //     [OrderBy::metric('screenPageViews', true)],
        // );

        // $datas = $datas->filter(function ($data) {
        //     return str_contains($data['pagePath'], '/product/');
        // });
        
        // $datas = $datas->map(function($data){
        //     return $data;
        // });

        // $datas = collect($datas)->groupBy('pagePath')->map(function($data){
        //         return [
        //             'productTitle' => ucwords(str_replace('-', ' ', str_replace('/product/', '', $data->first()['pagePath']))),
        //             'sessionDuration' => gmdate('i:s', (int) $data->average('averageSessionDuration')),
        //             'pagePath' => $data->first()['pagePath'],
        //             'date' => $data->first()['date'],
        //             'screenPageViews' => $data->sum('screenPageViews'),
        //         ];
        // })->values();

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
                new Dimension(['name' => 'date']),
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
                        'value' => '/product/',
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
                'date' => $dimensions[3]->getValue(),
            ];
        });

        $datas = $data->groupBy('pagePath')->map(function ($dataGroup, $path){
            return [
                'productTitle' => ucwords(str_replace('-', ' ', str_replace('/product/', '', $path))),
                'sessionDuration' => (int) $dataGroup->avg('averageSessionDuration'),
                'pagePath' => $path,
                'screenPageViews' => $dataGroup->sum('screenPageViews'),
            ];
        })->values();
        
        return $datas;
    }

    public function getDataNewsView($start_date, $end_date){
        // $datas = Analytics::get(
        //     Period::create($start_date, $end_date),
        //     ['screenPageViews', 'averageSessionDuration'],
        //     ['pageTitle', 'hostName', 'pagePath', 'date'],
        //     10000,
        //     [OrderBy::metric('screenPageViews', true)],
        // );

        // $datas = $datas->filter(function ($data) {
        //     return str_contains($data['pagePath'], '/news/');
        // });
        
        // $datas = $datas->map(function($data){
        //     return $data;
        // });

        // $datas = collect($datas)->groupBy('pagePath')->map(function($data){
        //         return [
        //             'newsTitle' => ucwords(str_replace('-', ' ', str_replace('/news/', '', $data->first()['pagePath']))),
        //             'sessionDuration' => gmdate('i:s', (int) $data->average('averageSessionDuration')),
        //             'pagePath' => $data->first()['pagePath'],
        //             'date' => $data->first()['date'],
        //             'screenPageViews' => $data->sum('screenPageViews'),
        //         ];
        // })->values();

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
                        'value' => '/news/',
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

        $datas = $data->groupBy('pagePath')->map(function ($dataGroup, $path){
            return [
                'newsTitle' => ucwords(str_replace('-', ' ', str_replace('/news/', '', $path))),
                'sessionDuration' => (int) $dataGroup->avg('averageSessionDuration'),
                'pagePath' => $path,
                'screenPageViews' => $dataGroup->sum('screenPageViews'),
            ];
        })->values();

        return $datas;
    }

    public function form(Form $form): Form {
        return $form->schema([
            Section::make()->schema([
                DatePicker::make('start_date')
                    ->native(false),
                DatePicker::make('end_date')
                    ->native(false),
            ])->columns(2)
        ])->columns(2);
    }

    public function searchProduct(Form $form): Form {
        return $form->schema([
            TextInput::make('search_product')
            ->hiddenLabel()
            ->placeholder("Search by product name")
            ->reactive()
            ->live(debounce: 800)
            ->afterStateUpdated(function (?string $state, ?string $old) {
                if(!empty($state)){
                    $this->productDatas = collect($this->productDatas)->filter(function($data) use ($state){
                        return Str::of($data['productTitle'])->lower()->contains(Str::lower($state));
                    });
                }else {
                    $this->productDatas = $this->getDataProductView($this->start_date, $this->end_date);
                }
            })
        ]);
    }

    public function searchNews(Form $form): Form {
        return $form->schema([
            TextInput::make('search_news')
            ->hiddenLabel()
            ->placeholder("Search by news title")
            ->reactive()
            ->live(debounce: 800)
            ->afterStateUpdated(function (?string $state, ?string $old) {
                if(!empty($state)){
                    $this->newsDatas = collect($this->newsDatas)->filter(function($data) use ($state){
                        return Str::of($data['newsTitle'])->lower()->contains(Str::lower($state));
                    });
                }else {
                    $this->newsDatas = $this->getDataNewsView($this->start_date, $this->end_date);
                }
            })
        ]);
    }

    public function generate(){
        $this->productDatas = $this->getDataProductView($this->start_date, $this->end_date);
        $this->newsDatas = $this->getDataNewsView($this->start_date, $this->end_date);
    }

    public function showChartProduct($value){
        $this->isShowChartProduct = $value;
    }
}
