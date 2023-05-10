@extends('layouts.argon')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row align-items-center py-1">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Daftar Pembayaran</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Daftar Pembayaran</h3>
                            </div>
                        </div>
                    </div>
                    <!-- <div class=""> -->
                    <div class="">
                        <!-- Projects table -->
                        <table class="table-kontrak table table-responsive align-items-center table-flush datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width:1%">No.</th>
                                    <th style="width:1%">Nama Kelas</th>
                                    <th scope="col">Harga</th>
                                    <th style="width:10%">Status</th>
                                    <th style="width:10%">Bayar</th>
                                    <th style="width:10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Order as $Order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $Order->kelas->nama_kelas }}</td>
                                        <td>@currency($Order->nominal) </td>
                                        <td>
                                            @if ($Order->status == 3)
                                                <div class="badge badge-light-danger">Belum di bayar</div>
                                            @elseif ($Order->status == 1)
                                                <div class="badge badge-light-success">Lunas</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="badge badge-light-secondary btn-bayar"
                                                data-snaptoken="{{ $Order->snaptoken }}">
                                                <i class="fas fa-hand-holding-usd"></i>
                                                Bayar
                                            </a>
                                        </td>
                                        <td>
                                            @if ($Order->status == 1)
                                                <div class="badge badge-light-success">Pembayaran Telah Lunas</div>
                                            @else
                                                <form action="/siswa/pembayaran/{{ $Order->id }}" method="POST">
                                                    @csrf
                                                    <button onclick="hapusFunction()" class="btn btn-outline-danger btn-sm"
                                                        type="submit"><i class="fas fa-trash-alt"></i>&nbsp Cancel
                                                        Pembelian</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.footers.nav')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/js/datatables.min.js "></script>
    <script>
        $(document).ready(function() {
            $('.table-kontrak').DataTable({
                "lengthMenu": [
                    [100, 200, -1],
                    [100, 200, "All"]
                ]
            });
        });
    </script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        $('.btn-bayar').click(function(e) {
            e.preventDefault();
            var snaptoken = $(this).attr("data-snaptoken");
            // alert(snaptoken);

            snap.pay(snaptoken, {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                    window.location.reload();
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script type="text/javascript">
        function hapusFunction() {
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form
            swal({
                    title: "Are you sure?",
                    text: "Apakah Anda yakin akan menghapus data Pembayaran?",
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
