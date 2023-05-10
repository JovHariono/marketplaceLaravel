<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\artikel;
use Illuminate\Support\Facades\File;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Artikel = artikel::all();
        return view('backend.artikel.index', compact('Artikel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $Artikel = new artikel;
            $Artikel->judul = $request->judul;
            
            $foto = '';
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $originalName1 = time() . '.' . $file->getClientOriginalName();
                $foto = $originalName1;
                $file->move('uploads/foto', $foto);
            }
            $Artikel->foto = $foto;
            $Artikel->deskripsi = $request->deskripsi;
            $Artikel->save();

            toast('Berhasil mebnambahkan data', 'success');
            return redirect('/admin/artikel');
        } catch (\Throwable $th) {
            toast('Terjadi kesalahan pada inputtan, mohon diperiksa ulang!', 'error');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Artikel = artikel::find($id);

        return view('backend.artikel.show', compact('Artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Artikel = artikel::find($id);

        return view('backend.artikel.edit', compact('Artikel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $Artikel = artikel::find($id);
            $Artikel->judul = $request->judul;
            
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $originalName1 = time() . '.' . $file->getClientOriginalName();
                $foto = $originalName1;
                $file->move('uploads/foto', $foto);
                if ($Artikel->foto != '') {
                    File::delete('uploads/foto/' . $Artikel->foto);
                }
            } else {
                $foto = $Artikel->foto;
            }
            $Artikel->foto = $foto;
            $Artikel->deskripsi = $request->deskripsi;
            $Artikel->save();

            toast('Berhasil mengubah data', 'success');
            return redirect('/admin/artikel');
        } catch (\Throwable $th) {
            toast('Gagal mengubah data!', 'error');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $Artikel = artikel::find($id);

            if(!empty($Artikel->foto)){
                File::delete('uploads/foto/' . $Artikel->foto);
            }

            $Artikel->delete();

            toast('Berhasil Menghapus Data', 'success');
            return redirect('/admin/artikel');

        } catch (\Throwable $th) {
            toast('Gagal hapus data', 'error');
            return back();
        }
    }
}
