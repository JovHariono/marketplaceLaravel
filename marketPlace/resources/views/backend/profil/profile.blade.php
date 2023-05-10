@extends('layouts.argon')
@section('content')
<style>
    .card-body .profile_img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin: 2px auto;
    border: 2px solid #ccc;
    border-radius: 50%;
}
</style>
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Profile</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th>Name</th>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ auth()->user()->email }}</td>
                            </tr>
                            <tr>
                                <th>Foto Profil</th>
                                <th><img class="m-2 shadow profile_img" src="{{ url('uploads/foto_profil/'. auth()->user()->foto_profil) }}" id="previewpicture"><br></th>
                            </tr>
                        </table>
                        <hr>
                        <strong>Ubah Data User</strong>
                        <hr>
                        <form action="{{ url('/admin/profile') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <label for="">Nama </label>
                            <input type="text" class="form-control" name="name" value="{{ auth()->user()->name}}">
                            <label for="">Email <span class="text-danger"><i>*</i></span></label>
                            <input type="email" class="form-control" required name="email" value="{{ auth()->user()->email }}">
                            <label>Foto Profile <span class="text-primary"><i>*</i></span></label>
                            <input type="file" class="form-control" name="foto_profil">
                            <span class="text-danger">*Abaikan input apabila tidak ingin mengubah Foto Profile</span>
                            <br><br>
                            <label for="">Masukkan Password Baru </label>
                            <input type="password" class="form-control" name="password">
                            <span class="text-danger"><i>*</i> Abaikan jika tidak ingin mengubah password</span>
                            <br><br>
                            <div class="card-body">
                                <div class="form-group">
                                    <a href="{{ url('/home') }}" class="btn btn-warning" type="submit"><i class="fas fa-backward"></i>&nbsp Kembali</a>
                                    {{-- <button type="submit" class="btn btn-info" name="again">Simpan & Tambah Lagi</button> --}}
                                    <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.footers.nav')
    </div>
@endsection
@push('scripts')
@endpush