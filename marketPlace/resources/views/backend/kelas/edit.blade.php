@extends('layouts.argon')

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-6">
                    <div class="col-lg-6 col-7">
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <h6 class="h2 text-white d-inline-block mb-0">Ubah Kelas</h6>
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
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Form</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/admin/kelas/' . $Kelas->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <img class="m-2 shadow profile_img" src="{{ url('uploads/foto_kelas/' . $Kelas->foto_kelas) }}"
                            id="previewpicture"><br>
                        <div class="form-group">
                            <label for="">Nama Kelas <span class="text-red">*</span></label>
                            <input type="text" name="nama_kelas" placeholder="nama kelas" class="form-control"
                                value="{{ $Kelas->nama_kelas }}">
                        </div>
                        <div class="form-group">
                            <label>Gambar Kelas <span class="text-danger"><i>*</i></span> Abaikan jika tidak ingin mengubah gambar</label>
                            <input type="file" class="form-control" name="foto_kelas">
                        </div>
                        <div class="form-group">
                            <label for="">Nominal <span class="text-red">*</span></label>
                            <input type="text" name="nominal" placeholder="nominal" class="form-control"
                                value="{{ $Kelas->nominal }}">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi <span class="text-primary">*</span></label>
                            <textarea type="text" name="deskripsi" id="task-textarea" class="form-control">{{ $Kelas->desktripsi }}</textarea>
                        </div>
                            <div class="form-group">
                                <a href="{{ url('/admin/kelas') }}" class="btn btn-danger"><i class="fas fa-backward"></i>&nbsp Kembali</a>
                                {{-- <button type="submit" class="btn btn-info" name="again">Simpan & Tambah Lagi</button> --}}
                                <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-save"></i> Simpan</button>
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

@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#task-textarea'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection