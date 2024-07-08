<?php

namespace App\Http\Controllers;

use App\Exports\WilayahExcelExport;
use App\Models\Wilayah;
use App\Models\Vegetasi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WilayahPdfExport;

class WilayahController extends Controller
{
    public function index()
    {
        $page_title = "Data Wilayah";

        $wilayahs = Wilayah::all();
        return view('dashboard.wilayah.index', compact('page_title', 'wilayahs'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'code' => 'required|string|unique:wilayahs,code|max:10',
            'name' => 'required|string|max:100',
            'area' => 'required|integer'
        ]);

        Wilayah::create($validated_data);

        $message = "Berhasil menambahkan data Wilayah.";

        return redirect()->route('dashboard.wilayah.index')->with('message', $message);
    }

    public function show(Wilayah $wilayah)
    {
        $page_title = "Detail Wilayah";
        $vegetasiData = Vegetasi::withCount(['spesies' => function ($query) use ($wilayah) {
            $query->where('fk_id_wilayah', $wilayah->id);
        }])->get();

        $labels = $vegetasiData->pluck('nama_vegetasi');
        $data = $vegetasiData->pluck('spesies_count');

        return view('dashboard.wilayah.detail', compact('page_title', 'wilayah', 'labels', 'data'));
    }

        /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wilayah $wilayah)
    {
        //
    }

    public function update(Request $request, Wilayah $wilayah)
    {
        $validated_data = $request->validate([
            'code' => "required|string|unique:wilayahs,code,$wilayah->id|max:10",
            'name' => 'required|string|max:100',
            'area' => 'nullable|integer'
        ]);

        $wilayah->update($validated_data);

        $message = "Berhasil mengubah data Wilayah.";
        return redirect()->route('dashboard.wilayah.index')->with('message', $message);
    }

    public function destroy(Wilayah $wilayah)
    {
        $wilayah->delete();
        $message = "Berhasil menghapus data wilayah.";
        return redirect()->route('dashboard.wilayah.index')->with('message', $message);
    }
    public function exportExcel()
    {
        return Excel::download(new WilayahExcelExport, 'wilayahs.xlsx');
    }
    public function exportPdf()
    {
        $export = new WilayahPdfExport();
        $export->exportPDF();
    }
}
