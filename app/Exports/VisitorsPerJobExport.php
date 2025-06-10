<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VisitorsPerJobExport implements FromCollection, WithMapping, WithHeadings
{
    public $datas;

    public function __construct($datas) {
        $this->datas = $datas;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->datas;
    }

    public function map($data): array {
        return [
            $data['careerTitle'],
            $data['screenPageViews'],
            $data['clickApplyButton'],
            $data['percent_by_views_vs_click'],
            gmdate('i:s', (int) $data['sessionDuration'])
        ];
    }

    public function headings(): array {
        return [
            'Job',
            'screenPageViews',
            'clickApplyButton',
            'Percent',
            'averagesessionDuration'
        ];
    }
}
