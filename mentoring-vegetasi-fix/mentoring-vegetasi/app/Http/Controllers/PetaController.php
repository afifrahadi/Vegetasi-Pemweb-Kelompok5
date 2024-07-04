<?php

namespace App\Http\Controllers;

use App\Models\Spesies;
use App\Models\Vegetasi;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index()
    {
        $page_title = "Data Peta";
        $spesies = Spesies::all();
        $vegetasi = Vegetasi::all();

        return view('dashboard.peta', compact('page_title', 'spesies', 'vegetasi'));
    }
}
