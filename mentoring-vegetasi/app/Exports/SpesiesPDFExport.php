<?php

namespace App\Exports;

use App\Models\Spesies;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;

class SpesiesPdfExport
{
    public function export()
    {
        // Retrieve all species data
        $spesies = Spesies::all();

        // Load the view and pass the data to it
        $html = View::make('exports.spesies_pdf', compact('spesies'))->render();

        // Create an instance of Mpdf
        $mpdf = new Mpdf();

        // Write HTML to PDF
        $mpdf->WriteHTML($html);

        // Output the PDF as a download
        return $mpdf->Output('spesies.pdf', 'D');
    }
}
