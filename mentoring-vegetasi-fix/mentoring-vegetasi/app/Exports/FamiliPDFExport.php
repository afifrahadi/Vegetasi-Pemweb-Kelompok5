<?php

namespace App\Exports;

use App\Models\Famili;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\View as FacadeView;
use Mpdf\Mpdf;

class FamiliPdfExport implements FromView
{
    public function view(): View
    {
        $Familis = Famili::all();

        return FacadeView::make('exports.famili_pdf', [
            'Familis' => $Familis,
        ]);
    }

    public function exportPdf()
    {
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($this->view()->render());
        $mpdf->Output('famili.pdf', 'D'); // 'D' downloads the file
    }
}
