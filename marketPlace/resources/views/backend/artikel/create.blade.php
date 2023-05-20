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
                        <h6 class="h2 text-white d-inline-block mb-0">Tambah Artikel</h6>
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
                        <form action="{{ url('/admin/artikel') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group">
                                <select class="form-control js-example-basic-single" name="category_id" required>
                                    <option value="">-- PILIH KATEGORI ARTIKEL --</option>
                                    @foreach($Category as $category)
                                        <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Judul <span class="text-red">*</span></label>
                                <input type="text" name="judul" placeholder="masukkan_judul"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Gambar artikel</label>
                                <input type="file" class="form-control" name="foto">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi <span class="text-primary">*</span></label>
                                <textarea type="text" name="deskripsi" id="task-textarea" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <a href="{{ url('/admin/pendidikan') }}" class="btn btn-danger"><i
                                        class="fas fa-backward"></i>&nbsp Kembali</a>
                                {{-- <button type="submit" class="btn btn-info" name="again">Simpan & Tambah Lagi</button> --}}
                                <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-save"></i>
                                    Simpan</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    </script>
@endsection
