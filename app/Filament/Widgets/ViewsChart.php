<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use App\Models\Visit;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ViewsChart extends ChartWidget
{
    protected static ?string $heading = 'Chart Visits';

    public ?string $filter = 'home';

    protected function getFilters(): ?array
    {
        return [
            'home' => 'Home',
            'product' => 'Product',
            'product_detail' => 'Product Detail',
            'contact' => 'Contact',
        ];
    }

    protected function getData(): array
    {
        $data = Trend::query(
            Visit::where('url', $this->filter)
            )
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();
 
        return [
            'datasets' => [
                [
                    'label' => 'Website Views',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(function (TrendValue $value){
                $date = Carbon::createFromFormat('Y-m', $value->date)->format('M');
                return $date;
            }),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function getDescription(): ?string
    {
        return 'Jumlah pengunjung website';
    }
}
