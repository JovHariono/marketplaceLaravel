<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use Illuminate\Http\Request;
use App\Models\kelas;

class FrontendController extends Controller
{
    public function index(){
        $Kelas = kelas::all();
        $Artikel = artikel::all();

        return view('frontend.index', compact('Kelas', 'Artikel'));
    }

    public function detailArtikel($slug){
        $Artikel = artikel::where('slug', $slug)->first();

        $ArtikelList = artikel::all();

        return view('frontend.artikel-details', compact('Artikel', 'ArtikelList'));
    }
}
