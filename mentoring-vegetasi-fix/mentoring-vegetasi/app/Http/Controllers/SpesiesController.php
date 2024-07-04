<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Genus;
use App\Models\Spesies;
use App\Models\Wilayah;
use App\Models\Vegetasi;
use Illuminate\Http\Request;
use App\Exports\SpesiesPdfExport;
use App\Exports\SpesiesExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class SpesiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "Data Spesies";

        $Genus = Genus::all();
        $Wilayahs = Wilayah::all();
        $Vegetasis = Vegetasi::all();
        $Spesies = Spesies::all();

        return view('dashboard.spesies.index', compact('page_title', 'Spesies', 'Genus', 'Wilayahs', 'Vegetasis'));
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
            'code' => 'required|string|unique:spesies,code|max:10',
            'nama_spesies' => 'required|string|max:100',
            'tinggi' => 'required|integer',
            'diameter' => 'required|integer',
            'warna_daun' => 'required|string|max:50',
            'latitude' => 'required|numeric|between:-90.0,90.0',
            'longitude' => 'required|numeric|between:-180.0,180.0',
            'deskripsi' => 'nullable|string',
            'fk_id_genus' => 'required|exists:genus,id',
            'fk_id_wilayah' => 'required|exists:wilayahs,id',
            'fk_id_vegetasi' => 'required|exists:vegetasis,id',
            'foto' => 'nullable|image|max:5000',
        ]);

        try {
            if ($request->hasFile('foto')) {
                $validated_data['foto'] = $this->storePhoto($request->file('foto'), $validated_data['code']);
            }

            Spesies::create($validated_data);
            $message = "Berhasil menambahkan data spesies.";
        } catch (\Throwable $err) {
            $message = "Error: " . $err->getMessage();
            throw $err;
        }

        return redirect()->route('dashboard.spesies.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Spesies $spesies)
    {
        $page_title = "Detail Data Spesies";
        return view('dashboard.spesies.detail', compact('page_title', 'spesies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spesies $spesies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spesies $spesies)
    {
        $validated_data = $request->validate([
            'code' => "required|string|unique:genus,code,$spesies->id|max:10",
            'nama_spesies' => 'required|string|max:100',
            'tinggi' => 'required|integer',
            'diameter' => 'required|integer',
            'warna_daun' => 'required|string|max:50',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'deskripsi' => 'nullable|string',
            'fk_id_genus' => 'required|exists:genus,id',
            'fk_id_wilayah' => 'required|exists:wilayahs,id',
            'fk_id_vegetasi' => 'required|exists:vegetasis,id',
            'foto' => 'nullable|image|max:5000',
        ]);

        if ($request->hasFile('foto')) {
            if ($spesies->foto) {
                Storage::disk('public')->delete($spesies->foto);
            }
            $validated_data['foto'] = $this->storePhoto($request->file('foto'), $validated_data['code']);
        }

        $spesies->update($validated_data);
        $message = "Berhasil mengubah data spesies.";
        return redirect()->route('dashboard.spesies.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spesies $spesies)
    {
        if ($spesies->foto) {
            Storage::disk('public')->delete($spesies->foto);
        }
        $spesies->delete();
        $message = "Berhasil menghapus data spesies.";
        return redirect()->route('dashboard.spesies.index')->with('message', $message);
    }

    private function storePhoto($file, $name)
    {
        $filename = $name . "-" . date('Ymd') . ".webp";
        return $file->storeAs('spesies_photos', $filename, 'public');
    }

    public function exportExcel()
    {
        return Excel::download(new SpesiesExcelExport(), 'spesies.xlsx');
    }
    
    public function exportPdf()
    {
        $pdfExport = new SpesiesPdfExport();
        $pdfExport->export();
    }
}
