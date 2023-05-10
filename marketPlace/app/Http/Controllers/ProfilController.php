<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function indexProfile(){
        return view('backend.profil.profile');
    }

    public function updateProfile(Request $request){

        try {
            $user = User::find(Auth::id());
            $user->name = $request->name;
            $user->email = $request->email;
            // $user->password = bcrypt($request->password);
            if(!empty($request->password)){
                $user->password = bcrypt($request->password);
            }
            //upload foto_profil
            if ($request->hasFile('foto_profil')) {
                $file = $request->file('foto_profil');
                $originalName1 = time() . '.' . $file->getClientOriginalName();
                $foto_profil = $originalName1;
                $file->move('uploads/foto_profil', $foto_profil);
                if ($user->foto_profil != '') {
                    File::delete('uploads/foto_profil/' . $user->foto_profil);
                }
            } else {
                $foto_profil = $user->foto_profil;
            }
            $user->foto_profil = $foto_profil;

            $user->save();

            toast('Berhasil Mengubah Data Profil', 'success');
            return back();
        } catch (\Throwable $th) {
            toast('Terjadi kesalahan pada inputan, mohon diperiksa ulang!','error');
            return back();
        }
            
    }
}
