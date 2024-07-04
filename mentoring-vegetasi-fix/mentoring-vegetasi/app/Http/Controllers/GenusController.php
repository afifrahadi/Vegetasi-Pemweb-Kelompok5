<?php

namespace App\Http\Controllers;

use App\Models\Genus;
use App\Models\Famili;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\GenusExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GenusPdfExport;
use Mpdf\Mpdf;

class GenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "Data Genus";

        $Familis = Famili::all();
        $Genus = Genus::all();
        return view('dashboard.genus.index', compact('page_title', 'Genus', 'Familis'));
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
            'nama_genus' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'fk_id_famili' => 'required|exists:familis,id',
            'photo' => 'nullable|image|max:5000|exclude'
        ]);

        try {
            if ($request->hasFile('photo')) {
                $validated_data['photo_path'] = $this->storePhoto($request->file('photo'), $validated_data['code']);
            }

            Genus::create($validated_data);

            $message = "Berhasil menambahkan data genus.";
        } catch (\Throwable $err) {
            $message = "Error: " . $err->getMessage();
            throw $err;
        }
        // Genus::create($validated_data);
        // $message = "Berhasil menambahkan data genus.";
        return redirect()->route('dashboard.genus.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Genus $genus)
    {
        $page_title = "Detail Data Genus";
        return view('dashboard.genus.detail', compact('page_title', 'genus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genus $genus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genus $genus)
    {
        $validated_data = $request->validate([
            'code' => "required|string|unique:genus,code,$genus->id|max:10",
            'nama_genus' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'fk_id_famili' => 'required|exists:familis,id',
            'photo' => 'nullable|image|max:5000|exclude',
        ]);

        try {
            if ($request->hasFile('photo')) {
                $this->deletePhoto($genus->getAttributes()['photo_path']);
                $validated_data['photo_path'] = $this->storePhoto($request->file('photo'), $validated_data['code']);
            }

            $genus->update($validated_data);

            $message = "Berhasil mengubah data genus.";
        } catch (\Throwable $err) {
            $message = "Error: " . $err->getMessage();
            throw $err;
        }

        // $genus->update($validated_data);
        // $message = "Berhasil mengubah data genus.";
        return redirect()->route('dashboard.genus.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genus $genus)
    {
        $photo_path = $genus->getAttributes()['photo_path'];
        try {
            $genus->delete();

            $this->deletePhoto($photo_path);

            $message = "Berhasil menghapus data genus.";
        } catch (\Throwable $err) {
            $message = "Error: " . $err->getMessage();
            throw $err;
        }

        // $genus->delete();
        // $message = "Berhasil menghapus data genus.";
        return redirect()->route('dashboard.genus.index')->with('message', $message);
    }

    private function storePhoto($file, $name)
    {
        $filename = $name . "-" . date('Ymd') . ".webp";
        return $file->storeAs('genus/', $filename, 'public');
    }

    private function deletePhoto($path)
    {
        if ($path != null) {
            Storage::disk('public')->delete($path);
        }
    }
    public function exportExcel()
    {
        return Excel::download(new GenusExcelExport(), 'genus.xlsx');
    }
    public function exportPdf()
    {
        $pdfExport = new GenusPdfExport();
        $pdfExport->exportPdf();
    }
}
