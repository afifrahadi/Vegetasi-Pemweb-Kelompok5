<?php

namespace App\Exports;

use App\Models\Classis;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;

class ClassisPdfExport implements FromView
{
    public function view(): View
    {
        $classis = Classis::all();

        return view('exports.classis_pdf', [
            'classis' => $classis,
        ]);
    }

    public function exportPdf()
    {
        $pdf = new Mpdf();
        $pdf->WriteHTML($this->view()->render());
        $pdf->Output('classis.pdf', 'D');
    }
}
