<?php

namespace App\Exports;

use App\Models\Spesies;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SpesiesExcelExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Spesies::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Code',
            'Nama Spesies',
            'Tinggi (m)',
            'Diameter (cm)',
            'Warna Daun',
            'Latitude',
            'Longitude',
            'Deskripsi',
            'Genus ID',
            'Wilayah ID',
            'Foto',
        ];
    }
}
