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
                        <h6 class="h2 text-white d-inline-block mb-0">Detail Kelas</h6>
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
                        <img class="m-2 shadow profile_img" src="{{ url('uploads/foto_kelas/' . $Kelas->foto_kelas) }}"
                            id="previewpicture"><br>
                        <div class="form-group">
                            <label for="">Nama Kelas <span class="text-red">*</span></label>
                            <input type="text" name="judul" placeholder="Ex. ( SMA )" class="form-control"
                                value="{{ $Kelas->nama_kelas }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nominal <span class="text-red">*</span></label>
                            <input type="text" name="judul" placeholder="Ex. ( SMA )" class="form-control"
                                value="{{ $Kelas->nominal }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi <span class="text-primary">*</span></label>
                            <textarea type="text" name="deskripsi" readonly id="task-textarea" class="form-control">{{ $Kelas->desktripsi }}</textarea>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/admin/kelas/' . $Kelas->id) }}" method="POST">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{ url('/admin/kelas/') }}" class="btn btn-warning" type="submit"><i
                                            class="fas fa-backward"></i>&nbsp Kembali</a>
                                    <a href="{{ url('/admin/kelas/' . $Kelas->id) }}/edit" class="btn btn-primary"
                                        type="submit"><i class="fas fa-edit"></i>&nbsp Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="hapusFunction()" class="btn btn-danger fas fa-trash-alt"
                                        type="submit"> &nbsp Hapus</button>
                                </div>
                            </form>
                        </div>
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
        .create( document.querySelector( '#task-textarea' ) )
        .then( editor => {
            editor.enableReadOnlyMode( 'my-feature-id' );
            editor.isReadOnly;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script type="text/javascript">
        function hapusFunction() {
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form
            swal({
                    title: "Are you sure?",
                    text: "Apakah Anda yakin akan menghapus data?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#a90808",
                    cancelButtonColor: "#87a182",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Tidak, Jangan Hapus!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        form.submit(); // submitting the form when user press yes
                    } else {
                        swal("Cancelled", "Data Batal Terhapus!", "error");
                    }
                });
        }
    </script>
@endpush
