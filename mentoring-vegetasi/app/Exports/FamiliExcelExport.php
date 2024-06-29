<?php

namespace App\Exports;

use App\Models\Famili;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FamiliExcelExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Famili::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kode Famili',
            'Nama Famili',
            'Deskripsi',
            'Jenis Ordo',
            'Created At',
            'Updated At',
        ];
    }
}
