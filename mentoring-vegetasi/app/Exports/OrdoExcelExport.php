<?php

namespace App\Exports;

use App\Models\Ordo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdoExcelExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Ordo::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kode Ordo',
            'Nama Ordo',
            'Deskripsi',
            'Kelas ID' // Adjust this based on your actual relationship
        ];
    }
}
