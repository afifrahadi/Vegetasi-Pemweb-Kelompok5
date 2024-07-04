<?php

namespace App\Exports;

use App\Models\Ordo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Mpdf\Mpdf;

class OrdoPdfExport implements FromView
{
    public function view(): View
    {
        $ordos = Ordo::all();
        return view('exports.ordo_pdf', [
            'ordos' => $ordos,
        ]);
    }

    public function export()
    {
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($this->view());
        $mpdf->Output('ordos.pdf', 'D');
    }
}
