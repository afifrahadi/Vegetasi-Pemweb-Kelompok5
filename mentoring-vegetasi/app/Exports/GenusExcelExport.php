<?php

namespace App\Exports;

use App\Models\Genus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GenusExcelExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Genus::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kode Genus',
            'Nama Genus',
            'Deskripsi',
            'Famili',
            'Tanggal Dibuat',
            'Tanggal Diubah'
            // Add more headings as needed
        ];
    }
}
