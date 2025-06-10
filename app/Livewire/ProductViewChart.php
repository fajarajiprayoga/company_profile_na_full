<?php

namespace App\Livewire;

use App\Models\Product;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Spatie\Analytics\OrderBy;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class ProductViewChart extends ChartWidget
{
    protected static ?string $heading = 'Chart Daily';

    public $start_date;
    public $end_date;

    public $chartDatas;

    public ?string $filter = 'skylander-r22';

    public function getDescription(): ?string
    {
        return 'Jumlah pengunjung per product.';
    }

    public function generate(){
        // $datas = Analytics::get(
        //     Period::create($this->start_date, $this->end_date),
        //     ['screenPageViews', 'averageSessionDuration'],
        //     ['pageTitle', 'hostName', 'pagePath', 'date'],
        //     10000,
        // );

        // $datas = $datas->filter(function ($data) {
        //     return str_contains($data['pagePath'], '/product/');
        // });

        // $datas = $datas->filter(function ($data){
        //     return str_replace('/product/', '', $data['pagePath']) == $this->filter;;
        // });
        
        // $datas = $datas->map(function($data){
        //     return [
        //         'pagePath' => $data['pagePath'],
        //         'screenPageViews' => $data['screenPageViews'],
        //         'averageSessionDuration' => $data['averageSessionDuration'],
        //         'date' => $data['date']->toDateString(),
        //     ];
        // });
        
        // $datas = collect($datas)->groupBy('date')->map(function($data){
        //     return [
        //         'productTitle' => ucwords(str_replace('-', ' ', str_replace('/product/', '', $data->first()['pagePath']))),
        //         'pagePath' => $data->first()['pagePath'],
        //         'date' => $data->first()['date'],
        //         'screenPageViews' => $data->sum('screenPageViews'),
        //         'averageSessionDuration' => (int) $data->average('averageSessionDuration'),
        //     ];
        // })->values()->sortBy('date')->values();

        $client = new BetaAnalyticsDataClient([
            'credentials' => storage_path('app/public/google_service_key/new-armada-company-profile-9982881fafc6.json')
        ]);

        $response = $client->runReport([
            'property' => 'properties/' . env('ANALYTICS_PROPERTY_ID'),
            'dateRanges' => [
                new DateRange([
                    'start_date' => Carbon::parse($this->start_date)->toDateString(),
                    'end_date' => Carbon::parse($this->end_date)->toDateString(),
                ]),
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
            'limit' => 10000,  
        ]);

        $rows = collect($response->getRows())->map(function ($row) {
            $dimensions = $row->getDimensionValues();
            $metrics = $row->getMetricValues();

            return [
                'pageTitle' => $dimensions[0]->getValue(),
                'hostName' => $dimensions[1]->getValue(),
                'pagePath' => $dimensions[2]->getValue(),
                'date' => \Carbon\Carbon::createFromFormat('Ymd', $dimensions[3]->getValue())->toDateString(),
                'screenPageViews' => (int) $metrics[0]->getValue(),
                'averageSessionDuration' => (float) $metrics[1]->getValue(),
            ];
        });

        // Filter: hanya /product/ dan slug-nya sesuai dengan filter
        $filtered = $rows
            ->filter(fn($row) => str_contains($row['pagePath'], '/product/'))
            ->filter(fn($row) => str_replace('/product/', '', $row['pagePath']) === $this->filter);

        // Group by date dan format akhir
        $datas = $filtered->groupBy('date')->map(function ($group) {
            return [
                'productTitle' => ucwords(str_replace('-', ' ', str_replace('/product/', '', $group->first()['pagePath']))),
                'pagePath' => $group->first()['pagePath'],
                'date' => $group->first()['date'],
                'screenPageViews' => $group->sum('screenPageViews'),
                'averageSessionDuration' => (int) $group->avg('averageSessionDuration'),
            ];
        })->sortBy('date')->values();

        return $datas;
    }

    protected function getData(): array
    {
        $this->chartDatas = $this->generate();

        return [
            'datasets' => [
                [
                    'label' => 'Viewer',
                    'data' => $this->chartDatas->pluck('screenPageViews'),
                    'yAxisID' => 'y',
                ],
                [
                    'label' => 'AVG Duration',
                    'data' => $this->chartDatas->pluck('averageSessionDuration'),
                    'yAxisID' => 'y1',
                    'borderColor' => '#16A34F',
                    'backgroundColor' => '#F0FDF4',
                ],
            ],
            'labels' => $this->chartDatas->pluck('date'),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'position' => 'left',
                    'title' => ['display' => true, 'text' => 'Viewer'],
                ],
                'y1' => [
                    'type' => 'linear',
                    'position' => 'right',
                    'grid' => ['drawOnChartArea' => false],
                    'title' => ['display' => true, 'text' => 'AVG Duration (min)'],
                ],
            ],
        ];
    }

    protected function getFilters(): ?array
    {
        $filter = Product::get()->pluck('name', 'slug')->toArray();
        $filter += [
            'skylander-r22-combi' => "Skylander R22 Combi",
            'skylander-r22-vision' => "Skylander R22 Vision",
            'skylander-r22-sleeper' => "Skylander R22 Sleeper"
        ];
        
        return $filter;
    }

    protected function getType(): string
    {
        return 'line';
    }
}
