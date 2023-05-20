<?php

namespace App\Http\Controllers;

use App\Models\category_artikel;
use App\Models\category_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('index-kategori')) abort(403, 'access denied');

        $Category = category_artikel::all();
        return view('backend.category.index', compact('Category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('create-kategori')) abort(403, 'access denied');
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('create-kategori')) abort(403, 'access denied');

        try {
            $Category = new category_artikel;
            $Category->nama_kategori = $request->nama_kategori;

            $Category->save();

            toast('Berhasil menambahkan data', 'success');
            return redirect('/admin/category');
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
        if(!Gate::allows('read-kategori')) abort(403, 'access denied');

        $Category = category_artikel::find($id);
        return view('backend.category.show', compact('Category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Gate::allows('edit-kategori')) abort(403, 'access denied');

        $Category = category_artikel::find($id);
        return view('backend.category.edit', compact('Category'));
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
        if(!Gate::allows('edit-kategori')) abort(403, 'access denied');

        try {
            $Category = category_artikel::find($id);
            $Category->nama_kategori = $request->nama_kategori;
            
            $Category->save();

            toast('Berhasil mengubah data', 'success');
            return redirect('/admin/category');
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
        if(!Gate::allows('delete-kategori')) abort(403, 'access denied');
        
        try {
            $Category = category_artikel::find($id);

            $Category->delete();

            toast('Berhasil Menghapus Data', 'success');
            return redirect('/admin/category');

        } catch (\Throwable $th) {
            toast('Gagal hapus data', 'error');
            return back();
        }
    }
}
