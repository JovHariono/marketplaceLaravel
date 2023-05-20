<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kelas;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('index-kelas')) abort(403, 'access denied');
        $Kelas = kelas::all();
        return view('backend.kelas.index', compact('Kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('create-kelas')) abort(403, 'access denied');
        return view('backend.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('create-kelas')) abort(403, 'access denied');
        try {
            $Kelas = new kelas;
            $Kelas->nama_kelas = $request->nama_kelas;
    
            $foto_kelas = '';
            if ($request->hasFile('foto_kelas')) {
                $file = $request->file('foto_kelas');
                $originalName1 = time() . '.' . $file->getClientOriginalName();
                $foto_kelas = $originalName1;
                $file->move('uploads/foto_kelas', $foto_kelas);
            }
            $Kelas->foto_kelas = $foto_kelas;
            $Kelas->nominal = $request->nominal;
            $Kelas->desktripsi = $request->deskripsi;
            $Kelas->save();

            toast('Berhasil menambahkan data', 'success');
            return redirect('/admin/kelas');
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
        if(!Gate::allows('read-kelas')) abort(403, 'access denied');
        $Kelas = kelas::find($id);

        return view('backend.kelas.show', compact('Kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Gate::allows('edit-kelas')) abort(403, 'access denied');
        $Kelas = kelas::find($id);

        return view('backend.kelas.edit', compact('Kelas'));
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
        if(!Gate::allows('edit-kelas')) abort(403, 'access denied');
        try {
            $Kelas = kelas::find($id);
            $Kelas->nama_kelas = $request->nama_kelas;
            
            // if ($request->hasFile('foto_kelas')) {
            //     $file = $request->file('foto_kelas');
            //     $originalName1 = time() . '.' . $file->getClientOriginalName();
            //     $foto_kelas = $originalName1;
            //     $file->move('uploads/foto_kelas', $foto_kelas);
            //     if ($Kelas->foto_kelas != '') {
            //         File::delete('uploads/foto_kelas/' . $Kelas->foto_kelas);
            //     }
            // } else {
            //     $foto_kelas = $Kelas->foto_kelas;
            // }
            // $Kelas->foto_kelas = $foto_kelas;

            if ($request->hasFile('foto_kelas')) {
                $file = $request->file('foto_kelas');
                $originalName1 = time() . '.' . $file->getClientOriginalName();
                $foto_kelas = $originalName1;
                $file->move('uploads/foto_kelas', $foto_kelas);
                if ($Kelas->foto_kelas != '') {
                    File::delete('uploads/foto_kelas/' . $Kelas->foto_kelas);
                }
            } else {
                $foto_kelas = $Kelas->foto_kelas;
            }
            $Kelas->foto_kelas = $foto_kelas;

            $Kelas->desktripsi = $request->deskripsi;
            $Kelas->save();

            toast('Berhasil mengubah data', 'success');
            return redirect('/admin/kelas');
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
        if(!Gate::allows('delete-kelas')) abort(403, 'access denied');
        try {
            $Kelas = kelas::find($id);

            if(!empty($Kelas->foto_kelas)){
                File::delete('uploads/foto_kelas/' . $Kelas->foto_kelas);
            }

            $Kelas->delete();

            toast('Berhasil Menghapus Data', 'success');
            return redirect('/admin/kelas');

        } catch (\Throwable $th) {
            toast('Gagal hapus data', 'error');
            return back();
        }
    }
}
