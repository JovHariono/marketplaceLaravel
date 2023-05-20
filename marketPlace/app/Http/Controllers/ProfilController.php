<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\detail_profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function indexProfile()
    {
        $check = detail_profile::where('user_id', Auth::id())->first();
        if ($check == null) {
            $check = collect(['alamat' => null,'no_hp' => null]);
            $profile = $check->merge(['alamat' => 'kosong', 'no_hp' => 'kosong']);
            $profile->first();
            // dd($profile);
        }else{
            $profile = detail_profile::where('user_id', Auth::id())->first();
        }
        return view('backend.profil.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {


        try {
            $user = User::find(Auth::id());
            $user->name = $request->name;
            $user->email = $request->email;
            // $user->password = bcrypt($request->password);
            if (!empty($request->password)) {
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
            // $user->save();
            $check = detail_profile::where('user_id', Auth::id())->first();
            if ($check == null) {
                $profile = new detail_profile;
                $profile->alamat = $request->alamat;
                $profile->no_hp = $request->no_hp;
                $profile->user_id = Auth::id();
            } else {
                $profile = detail_profile::where('user_id', Auth::id())->first();
                $profile->alamat = $request->alamat;
                $profile->no_hp = $request->no_hp;
                $profile->user_id = Auth::id();
            }


            // dd($profile);

            
            $user->profile()->save($profile);
            $user->detail_profile_id = $profile->id;
            $user->save();


            // $profile = detail_profile::find(Auth::id());
            // $profile->alamat = $request->alamat;
            // $profile->no_hp = $request->no_hp;
            // $profile->user_id = Auth::id();

            // $profile->save();

            toast('Berhasil Mengubah Data Profil', 'success');
            return back();
        } catch (\Throwable $th) {
            toast('Terjadi kesalahan pada inputan, mohon diperiksa ulang!', 'error');
            return back();
        }
    }

    public function index_detail()
    {
        return view('backend.profil.create_detail');
    }

    public function detail_post(Request $request)
    {
        try {
            $profile = new detail_profile;
            $profile->alamat = $request->alamat;
            $profile->no_hp = $request->no_hp;
            $profile->user_id = Auth::id();

            $profile->save();

            toast('Berhasil Mengubah Data Profil', 'success');
            return back();
        } catch (\Throwable $th) {
            //throw $th;
            toast('Terjadi kesalahan pada inputan, mohon diperiksa ulang!', 'error');
            return back();
        }
    }
}
