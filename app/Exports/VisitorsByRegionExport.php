<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VisitorsByRegionExport implements FromCollection, WithMapping, WithHeadings
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
            $data['region'],
            $data['country'],
            $data['screenPageViews'],
            gmdate('i:s', (int) $data['averageSessionDuration'])
        ];
    }

    public function headings(): array
    {
        return [
            'Region',
            'Country',
            'screenPageViews',
            'averageSessionDuration'
        ];
    }
}
