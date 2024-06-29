<?php

namespace App\Exports;

use App\Models\Genus;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Mpdf\Mpdf;

class GenusPdfExport implements FromView
{
    public function view(): View
    {
        $genus = Genus::with('familis')->get(); // Ambil semua data Genus dari model dan sertakan relasi familis

        return view('exports.genus_pdf', [
            'genus' => $genus,
        ]);
    }

    public function exportPdf()
    {
        $pdf = new Mpdf();
        $pdf->WriteHTML($this->view()->render());
        $pdf->Output('genus.pdf', 'D');
    }
}
