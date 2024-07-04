<?php

namespace App\Http\Controllers;

use App\Models\Ordo;
use App\Models\Famili;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FamiliExcelExport;
use App\Exports\FamiliPdfExport;
use Mpdf\Mpdf;

class FamiliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "Data Famili";

        $Familis = Famili::all();
        $Ordos = Ordo::all(); 
        return view('dashboard.famili.index', compact('page_title', 'Familis', 'Ordos'));
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
            'code' => 'required|string|unique:familis,code|max:10',
            'nama_famili' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'fk_id_ordo' => 'required|exists:ordos,id',
        ]);

        Famili::create($validated_data);
        $message = "Berhasil menambahkan data famili.";
        return redirect()->route('dashboard.famili.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Famili $famili)
    {
        $page_title = "Detail Data Famili";
        return view('dashboard.famili.detail', compact('page_title', 'famili'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Famili $famili)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Famili $famili)
    {
        $validated_data = $request->validate([
            'code' => "required|string|unique:familis,code,$famili->id|max:10",
            'nama_famili' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'fk_id_ordo' => 'required|exists:ordos,id',
        ]);

        $famili->update($validated_data);
        $message = "Berhasil mengubah data famili.";
        return redirect()->route('dashboard.famili.index')->with('message', $message);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Famili $famili)
    {
        $famili->delete();
        $message = "Berhasil menghapus data famili.";
        return redirect()->route('dashboard.famili.index')->with('message', $message);
    }
    public function exportExcel()
    {
        return Excel::download(new FamiliExcelExport, 'famili.xlsx');
    }
    public function exportPdf()
    {
        $export = new FamiliPdfExport();
        $export->exportPdf();
    }
}
