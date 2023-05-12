<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kelas;

class FrontendController extends Controller
{
    public function index(){
        $Kelas = kelas::all();

        return view('frontend.index', compact('Kelas'));
    }
}
