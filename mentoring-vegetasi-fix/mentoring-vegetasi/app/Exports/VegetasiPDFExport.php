<?php

namespace App\Exports;

use App\Models\Vegetasi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Mpdf\Mpdf;

class VegetasiPdfExport implements FromView
{
    public function view(): View
    {
        $vegetasis = Vegetasi::all();

        return view('exports.vegetasi_pdf', compact('vegetasis'));
    }

    public function exportPDF()
    {
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($this->view()->render());
        $mpdf->Output('vegetasis.pdf', 'D'); // 'D' sends the PDF file directly to the browser
        exit;
    }
}
