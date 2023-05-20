<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\artikel;
use App\Models\category_artikel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('index-artikel')) abort(403, 'access denied');
        
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
        if(!Gate::allows('create-artikel')) abort(403, 'access denied');

        $Category = category_artikel::all();
        return view('backend.artikel.create', compact('Category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('create-artikel')) abort(403, 'access denied');

        try {
            $Artikel = new artikel;
            $Artikel->judul = $request->judul;
            $Artikel->category_id = $request->category_id;
            $Artikel->slug = Str::slug($request->judul, '-');
            
            $foto = '';
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $originalName1 = time() . '.' . $file->getClientOriginalName();
                $foto = $originalName1;
                $file->move('uploads/artikel', $foto);
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
        if(!Gate::allows('read-artikel')) abort(403, 'access denied');
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
        if(!Gate::allows('edit-artikel')) abort(403, 'access denied');
        $Artikel = artikel::find($id);
        $Category = category_artikel::all();

        return view('backend.artikel.edit', compact('Artikel', 'Category'));
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
        if(!Gate::allows('edit-artikel')) abort(403, 'access denied');
        try {
            $Artikel = artikel::find($id);
            $Artikel->judul = $request->judul;
            
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $originalName1 = time() . '.' . $file->getClientOriginalName();
                $foto = $originalName1;
                $file->move('uploads/artikel', $foto);
                if ($Artikel->foto != '') {
                    File::delete('uploads/artikel/' . $Artikel->foto);
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
        if(!Gate::allows('delete-artikel')) abort(403, 'access denied');
        try {
            $Artikel = artikel::find($id);

            if(!empty($Artikel->foto)){
                File::delete('uploads/artikel/' . $Artikel->foto);
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
