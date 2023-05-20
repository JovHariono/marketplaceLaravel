@extends('layouts.argon')
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-5">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Role Akses User</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <!-- <a href="{{ url('admin/siswa/create') }}" class="btn btn-neutral fas fa-plus">&nbsp Tambah Data</a> -->
                        <!-- <a href="{{ url('users/export') }}" class="btn btn-neutral">Export Excel</a> -->
                        <!-- <a href="{{ url('admin/export/PDF') }}" class="btn btn-neutral">Export PDF</a>
                                        <a href="{{ url('export-admin') }}" class="btn btn-neutral">Export Excel</a> -->
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
                                <h3 class="mb-0">Hak Akses User</h3>
                                <br />
                                <h5 class="mb-0">Untuk memberi Hak Akses maka klik centang, hilangkan centang jika tidak
                                    ingin memberi Hak Akses.</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3>{{ $user->name }} <small>({{ $user->level->nama_level }})</small> </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/admin/role-akses/' . $user->id) }}" method="post">
                                @csrf
                                <table class="table">

                                    <tr>
                                        <td class="bg-light" colspan="6"><strong> Modul Category</strong> </td>
                                    </tr>
                                    <tr>
                                        <td>Modul Category</td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'CategoryController' && $akses->can_index == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="cat_i"> Index</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'CategoryController' && $akses->can_create == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="cat_c"> Create</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'CategoryController' && $akses->can_read == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="cat_r"> Read</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'CategoryController' && $akses->can_edit == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="cat_e"> Update</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'CategoryController' && $akses->can_delete == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="cat_d"> Delete</label></td>
                                    </tr>

                                    <tr>
                                        <td class="bg-light" colspan="6"><strong> Modul Artikel</strong> </td>
                                    </tr>
                                    <tr>
                                        <td>Modul Artikel</td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'ArtikelController' && $akses->can_index == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="art_i"> Index</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'ArtikelController' && $akses->can_create == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="art_c"> Create</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'ArtikelController' && $akses->can_read == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="art_r"> Read</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'ArtikelController' && $akses->can_edit == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="art_e"> Update</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'ArtikelController' && $akses->can_delete == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="art_d"> Delete</label></td>
                                    </tr>

                                    <tr>
                                        <td class="bg-light" colspan="6"><strong> Modul Kelas</strong> </td>
                                    </tr>
                                    <tr>
                                        <td>Modul Kelas</td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'KelasController' && $akses->can_index == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="kel_i"> Index</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'KelasController' && $akses->can_create == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="kel_c"> Create</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'KelasController' && $akses->can_read == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="kel_r"> Read</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'KelasController' && $akses->can_edit == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="kel_e"> Update</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'KelasController' && $akses->can_delete == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox" value="1"
                                                    name="kel_d"> Delete</label></td>
                                    </tr>

                                    <tr>
                                        <td class="bg-light" colspan="6"><strong> Modul Report Pembayaran</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Modul Report Pembayaran</td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'ReportPembayaranController' && $akses->can_index == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox"
                                                    value="1" name="reppem_i"> Index</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'ReportPembayaranController' && $akses->can_create == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox"
                                                    value="1" name="reppem_c" disabled> Create</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'ReportPembayaranController' && $akses->can_read == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox"
                                                    value="1" name="reppem_r" disabled> Read</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'ReportPembayaranController' && $akses->can_edit == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox"
                                                    value="1" name="reppem_e" disabled> Update</label></td>
                                        <td><label class="label"> <input <?php foreach ($role as $akses) {
                                            if ($akses->nama_controller == 'ReportPembayaranController' && $akses->can_delete == 1) {
                                                echo 'checked';
                                            }
                                        } ?> type="checkbox"
                                                    value="1" name="reppem_d" disabled> Delete</label></td>
                                    </tr>

                                </table>

                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ url('/admin/role-akses/') }}" class="btn btn-warning me-md-2">
                                    <i class="fas fa-backward"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
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

@push('scripts')
@endpush
