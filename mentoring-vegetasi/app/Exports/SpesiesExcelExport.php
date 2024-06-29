<?php

namespace App\Exports;

use App\Models\Spesies;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SpesiesExcelExport implements FromCollection, WithHeadings, WithStyles, WithCustomStartCell, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Spesies::all();
    }

    /**
     * @param mixed $spesies
     * @return array
     */
    public function map($spesies): array
    {
        static $number = 0;
        $number++;
        return [
            $number,
            $spesies->code,
            $spesies->nama_spesies,
            $spesies->tinggi,
            $spesies->diameter,
            $spesies->warna_daun,
            $spesies->latitude,
            $spesies->longitude,
            $spesies->deskripsi,
            $spesies->fk_id_genus,
            $spesies->fk_id_wilayah,
            $spesies->foto,
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
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

    /**
     * @return string
     */
    public function startCell(): string
    {
        return 'B5';
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Times New Roman');

        $sheet->mergeCells('B2:M3');
        $sheet->setCellValue('B2', 'Data Spesies');
        $sheet->getStyle('B2:M3')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '8DB4E2'],
            ],
        ]);

        $sheet->getStyle('B5:M5')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'B8CCE4'],
            ],
        ]);

        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('B6:M' . $lastRow)->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'DCE6F1'],
            ],
        ]);

        $sheet->getStyle('B6:B' . $lastRow)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('B2:M' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        foreach (range('B', 'M') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
}
