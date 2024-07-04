<?php

namespace App\Http\Controllers;

use App\Models\Vegetasi;
use Illuminate\Http\Request;
use App\Exports\VegetasiExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VegetasiPdfExport;
use Mpdf\Mpdf;

class VegetasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "Data Vegetasi";

        $vegetasis = Vegetasi::all();
        return view('dashboard.vegetasi.index', compact('page_title', 'vegetasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'code' => 'required|string|unique:genus,code|max:10',
            'nama_vegetasi' => 'required|string|max:100',
            'hex_code' => 'required|string|max:100'
        ]);

        Vegetasi::create($validated_data);

        $message = "Berhasil menambahkan data Vegetasi.";

        return redirect()->route('dashboard.vegetasi.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vegetasi $vegetasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vegetasi $vegetasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vegetasi $vegetasi)
    {
        $validated_data = $request->validate([
            'code' => "required|string|unique:vegetasis,code,$vegetasi->id|max:10",
            'nama_vegetasi' => 'required|string|max:100',
            'hex_code' => 'required|string|max:100'
        ]);

        // $validated_data['code'] = $vegetasi->code;

        $vegetasi->update($validated_data);

        $message = "Berhasil mengubah data Vegetasi.";
        return redirect()->route('dashboard.vegetasi.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vegetasi $vegetasi)
    {
        $vegetasi->delete();
        $message = "Berhasil menghapus data vegetasi.";
        return redirect()->route('dashboard.vegetasi.index')->with('message', $message);
    }

    public function exportExcel()
    {
        return Excel::download(new VegetasiExcelExport, 'vegetasi.xlsx');
    }

    public function exportPdf()
    {
        $pdfExport = new VegetasiPdfExport();
        $pdfExport->exportPdf();
    }
}
