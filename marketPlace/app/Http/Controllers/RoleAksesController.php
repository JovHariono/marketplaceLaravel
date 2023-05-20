<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    role_akses,
    User
};
use Illuminate\Support\Facades\Gate;

class RoleAksesController extends Controller
{
    public function index(){

        if(!Gate::allows('index-roleakses')) abort(403, 'access denied');

        $user = User::where('level_id', '!=', 1)->get();
        
        return view('backend.roleakses.index', compact('user'));
    }

    public function show($id){
        if(!Gate::allows('index-roleakses')) abort(403, 'access denied');

        $user = User::find($id);
        $role = role_akses::where('user_id', $id)->get();
        
        return view('backend.roleakses.show', compact('role','user'));
    }

    public function store_update($id){
        $request = Request();

        // Kategori
        $cat_role = role_akses::where(['user_id' => $id, 'nama_controller' => 'CategoryController'])->first();
        if($request->cat_i == 1 || $request->cat_c == 1 || $request->cat_r == 1 || $request->cat_e == 1 || $request->cat_d == 1){
            if(empty($cat_role)){
                $role = new role_akses;
                $role->nama_controller = 'CategoryController';
                $role->user_id = $id;
                $role->can_index = (empty(Request('cat_i'))) ? 0 : 1;
                $role->can_create = (empty(Request('cat_c'))) ? 0 : 1;
                $role->can_read = (empty(Request('cat_r'))) ? 0 : 1;
                $role->can_edit = (empty(Request('cat_e'))) ? 0 : 1;
                $role->can_delete = (empty(Request('cat_d'))) ? 0 : 1;
                $role->save();
            }else{
                $role = role_akses::find($cat_role->id);
                $role->nama_controller = 'CategoryController';
                $role->user_id = $id;
                $role->can_index = (Request('cat_i') == 1) ? 1 : 0;
                $role->can_create = (Request('cat_c') == 1) ? 1 : 0;
                $role->can_read = (Request('cat_r') == 1) ? 1 : 0;
                $role->can_edit = (Request('cat_e') == 1) ? 1 : 0;
                $role->can_delete = (Request('cat_d') == 1) ? 1 : 0;
                $role->save();
            }
        }else{
            if(!empty($cat_role)){
                $role = role_akses::find($cat_role->id);
                $role->delete();
            }
        }

        // artikel
        $art_role = role_akses::where(['user_id' => $id, 'nama_controller' => 'ArtikelController'])->first();
        if($request->art_i == 1 || $request->art_c == 1 || $request->art_r == 1 || $request->art_e == 1 || $request->art_d == 1){
            if(empty($art_role)){
                $role = new role_akses;
                $role->nama_controller = 'ArtikelController';
                $role->user_id = $id;
                $role->can_index = (empty(Request('art_i'))) ? 0 : 1;
                $role->can_create = (empty(Request('art_c'))) ? 0 : 1;
                $role->can_read = (empty(Request('art_r'))) ? 0 : 1;
                $role->can_edit = (empty(Request('art_e'))) ? 0 : 1;
                $role->can_delete = (empty(Request('art_d'))) ? 0 : 1;
                $role->save();
            }else{
                $role = role_akses::find($art_role->id);
                $role->nama_controller = 'ArtikelController';
                $role->user_id = $id;
                $role->can_index = (Request('art_i') == 1) ? 1 : 0;
                $role->can_create = (Request('art_c') == 1) ? 1 : 0;
                $role->can_read = (Request('art_r') == 1) ? 1 : 0;
                $role->can_edit = (Request('art_e') == 1) ? 1 : 0;
                $role->can_delete = (Request('art_d') == 1) ? 1 : 0;
                $role->save();
            }
        }else{
            if(!empty($art_role)){
                $role = role_akses::find($art_role->id);
                $role->delete();
            }
        }

        // kelas
        $kel_role = role_akses::where(['user_id' => $id, 'nama_controller' => 'KelasController'])->first();
        if($request->kel_i == 1 || $request->kel_c == 1 || $request->kel_r == 1 || $request->kel_e == 1 || $request->kel_d == 1){
            if(empty($kel_role)){
                $role = new role_akses;
                $role->nama_controller = 'KelasController';
                $role->user_id = $id;
                $role->can_index = (empty(Request('kel_i'))) ? 0 : 1;
                $role->can_create = (empty(Request('kel_c'))) ? 0 : 1;
                $role->can_read = (empty(Request('kel_r'))) ? 0 : 1;
                $role->can_edit = (empty(Request('kel_e'))) ? 0 : 1;
                $role->can_delete = (empty(Request('kel_d'))) ? 0 : 1;
                $role->save();
            }else{
                $role = role_akses::find($kel_role->id);
                $role->nama_controller = 'KelasController';
                $role->user_id = $id;
                $role->can_index = (Request('kel_i') == 1) ? 1 : 0;
                $role->can_create = (Request('kel_c') == 1) ? 1 : 0;
                $role->can_read = (Request('kel_r') == 1) ? 1 : 0;
                $role->can_edit = (Request('kel_e') == 1) ? 1 : 0;
                $role->can_delete = (Request('kel_d') == 1) ? 1 : 0;
                $role->save();
            }
        }else{
            if(!empty($kel_role)){
                $role = role_akses::find($kel_role->id);
                $role->delete();
            }
        }

        // ReportPembayaran
        $reppem_role = role_akses::where(['user_id' => $id, 'nama_controller' => 'ReportPembayaranController'])->first();
        if($request->reppem_i == 1 || $request->reppem_c == 1 || $request->reppem_r == 1 || $request->reppem_e == 1 || $request->reppem_d == 1){
            if(empty($reppem_role)){
                $role = new role_akses;
                $role->nama_controller = 'ReportPembayaranController';
                $role->user_id = $id;
                $role->can_index = (empty(Request('reppem_i'))) ? 0 : 1;
                $role->can_create = (empty(Request('reppem_c'))) ? 0 : 1;
                $role->can_read = (empty(Request('reppem_r'))) ? 0 : 1;
                $role->can_edit = (empty(Request('reppem_e'))) ? 0 : 1;
                $role->can_delete = (empty(Request('reppem_d'))) ? 0 : 1;
                $role->save();
            }else{
                $role = role_akses::find($reppem_role->id);
                $role->nama_controller = 'ReportPembayaranController';
                $role->user_id = $id;
                $role->can_index = (Request('reppem_i') == 1) ? 1 : 0;
                $role->can_create = (Request('reppem_c') == 1) ? 1 : 0;
                $role->can_read = (Request('reppem_r') == 1) ? 1 : 0;
                $role->can_edit = (Request('reppem_e') == 1) ? 1 : 0;
                $role->can_delete = (Request('reppem_d') == 1) ? 1 : 0;
                $role->save();
            }
        }else{
            if(!empty($reppem_role)){
                $role = role_akses::find($reppem_role->id);
                $role->delete();
            }
        }

        return redirect('/admin/role-akses');

    }
}