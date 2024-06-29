<?php

namespace App\Exports;

use App\Models\Classis;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClassisExcelExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Classis::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kode Kelas',
            'Nama Kelas',
            'Deskripsi'
        ];
    }
}
