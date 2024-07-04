<?php

namespace App\Http\Controllers;

use App\Models\Classis;
use Illuminate\Http\Request;
use App\Exports\ClassisExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClassisPdfExport;
use Mpdf\Mpdf;

class ClassisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "Data Kelas";

        $classis = Classis::all();
        return view('dashboard.kelas.index', compact('page_title', 'classis'));
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
            'code' => 'required|string|unique:classes,code|max:10',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        Classis::create($validated_data);
        $message = "Berhasil menambahkan data kelas.";
        return redirect()->route('dashboard.kelas.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classis $classis)
    {
        $page_title = "Detail Data Kelas";
        return view('dashboard.kelas.detail', compact('page_title', 'classis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classis $classis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classis $classis)
    {
        $validated_data = $request->validate([
            'code' => "required|string|unique:classes,code,$classis->id|max:10",
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $classis->update($validated_data);
        $message = "Berhasil mengubah data kelas.";
        return redirect()->route('dashboard.kelas.index')->with('message', $message);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classis $classis)
    {
        $classis->delete();
        $message = "Berhasil menghapus data kelas.";
        return redirect()->route('dashboard.kelas.index')->with('message', $message);
    }

    public function exportExcel()
    {
        return Excel::download(new ClassisExcelExport, 'classis.xlsx');
    }
    
    public function exportPdf()
    {
        $pdfExport = new ClassisPdfExport();
        $pdfExport->exportPdf();
    }
}
