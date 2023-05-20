@extends('layouts.argon')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <br>
            <br>
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    @if (Auth::user()->level_id == 1)
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ url('/admin/artikel') }}">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Artikel</h5>
                                            </a>
                                            <span class="h2 font-weight-bold mb-0">{{ \App\Models\artikel::count() }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                                <i class="fas fa-handshake"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (Auth::user()->level_id == 1)
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ url('/admin/artikel') }}">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Kelas</h5>
                                            </a>
                                            <span class="h2 font-weight-bold mb-0">{{ $Kelas }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                                <i class="fas fa-handshake"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (Auth::user()->level_id == 1)
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ url('/admin/artikel') }}">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Kelas Lunas</h5>
                                            </a>
                                            <span class="h2 font-weight-bold mb-0">{{ $OrderLunas }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                                <i class="fas fa-handshake"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (Auth::user()->level_id == 2)
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ url('/admin/artikel') }}">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Order</h5>
                                            </a>
                                            <span class="h2 font-weight-bold mb-0">{{ $CountMyOrder }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                                <i class="fas fa-handshake"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->level_id == 2)
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ url('/admin/artikel') }}">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Kelas belum bayar</h5>
                                            </a>
                                            <span class="h2 font-weight-bold mb-0">{{ $CountOrderPending }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                                <i class="fas fa-handshake"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->level_id == 2)
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ url('/admin/artikel') }}">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Kelas sudah bayar</h5>
                                            </a>
                                            <span class="h2 font-weight-bold mb-0">{{ $CountOrderSuccess }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                                <i class="fas fa-handshake"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- <br>
                                            <div>
                                                <div id="grafiks"></div>
                                            </div> -->
            </div>
        </div>
    </div>



    <div class="container-fluid mt--7">
        <div class="row">
            @if (Auth::user()->level_id == 1)
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Daftar Pembayaran Pending</h3>
                                </div>
                            </div>
                        </div>
                        <!-- <div class=""> -->
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table-demo table align-items-center table-flush datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width:1%">No.</th>
                                        <th style="width:1%">Pembeli</th>
                                        <th style="width:1%">Nama Kelas</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">SnapToken</th>
                                        <th scope="col">Tanggal dibuat</th>
                                        <th style="width:10%">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Order as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->kelas->nama_kelas }}</td>
                                            <td>@currency ($order->nominal) </td>
                                            <td>{{ $order->snaptoken }}</td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if ($order->status == 3)
                                                    <div class="badge badge-danger">Belum di bayar</div>
                                                @elseif ($order->status == 1)
                                                    <div class="badge badge-success">Lunas</div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
    <br><br><br><br>
    <!-- grafik kontrak -->
    {{-- <div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div>
                        <div id="grafiks"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <br><br><br>

    <!-- grafik warga -->
    {{-- <div class="container-fluid mt--12">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div>
                        <div id="grafik2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <br><br><br>
    @include('layouts.footers.nav')
@endsection

@push('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/js/datatables.min.js "></script>
    <script>
        $(document).ready(function() {
            $('.table-demo').DataTable({
                "lengthMenu": [
                    [15, 20, -1],
                    [15, 20, "All"]
                ]
            });
        });
    </script>

    <!-- grafik kontrak -->
@endpush
