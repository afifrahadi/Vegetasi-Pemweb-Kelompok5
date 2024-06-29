<?php

namespace App\Exports;

use App\Models\Wilayah;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Mpdf\Mpdf;

class WilayahPdfExport implements FromView
{
    public function view(): View
    {
        $wilayahs = Wilayah::all();

        return view('exports.wilayah_pdf', compact('wilayahs'));
    }

    public function exportPDF()
    {
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($this->view()->render());
        $mpdf->Output('wilayahs.pdf', 'D'); // 'D' sends the PDF file directly to the browser
        exit;
    }
}
