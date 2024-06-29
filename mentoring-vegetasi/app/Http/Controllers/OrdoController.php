<?php

namespace App\Http\Controllers;

use App\Models\Ordo;
use App\Models\Classis;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdoExcelExport;
use App\Exports\OrdoPdfExport;
use Mpdf\Mpdf;

class OrdoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "Data Ordo";

        $Ordos = Ordo::all();
        $classes = Classis::all(); // Mengambil daftar kelas dari database
        return view('dashboard.ordo.index', compact('page_title', 'Ordos', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'code' => 'required|string|unique:ordos,code|max:10',
            'nama_ordo' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'fk_id_kelas' => 'required|exists:classes,id',
        ]);

        Ordo::create($validated_data);
        $message = "Berhasil menambahkan data ordo.";
        return redirect()->route('dashboard.ordo.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ordo $ordo)
    {
        $page_title = "Detail Data Ordo";
        return view('dashboard.ordo.detail', compact('page_title', 'ordo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ordo $ordo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ordo $ordo)
    {
        $validated_data = $request->validate([
            'code' => "required|string|unique:ordos,code,$ordo->id|max:10",
            'nama_ordo' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'fk_id_kelas' => 'required|exists:classes,id',
        ]);

        $ordo->update($validated_data);
        $message = "Berhasil mengubah data ordo.";
        return redirect()->route('dashboard.ordo.index')->with('message', $message);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ordo $ordo)
    {
        $ordo->delete();
        $message = "Berhasil menghapus data ordo.";
        return redirect()->route('dashboard.ordo.index')->with('message', $message);
    }
    public function exportExcel()
    {
        return Excel::download(new OrdoExcelExport, 'ordos.xlsx');
    }
    public function exportPdf()
    {
        $pdfExporter = new OrdoPdfExport();
        return $pdfExporter->export();
    }
}
