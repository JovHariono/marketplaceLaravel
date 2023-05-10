@extends('layouts.argon')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row align-items-center py-1">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Detail Kelas</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <form action="{{ url('/siswa/detail-kelas/beli/' . '$Kelas->id') }}" method="POST">
                        <div class="card-body">
                            <h5 class="mb-4">Detail Produk</h5>
                            @csrf
                            <input type="hidden" name="kelas_id" value="{{ $Kelas->id }}">
                            <input type="hidden" name="kelas_nominal" value="{{ $Kelas->nominal }}">

                            <div class="row">
                                <div class="col-xl-5 col-lg-6 text-center">
                                    <img class="w-100 border-radius-lg shadow-lg mx-auto"
                                        src="{{ asset('uploads/foto_kelas/' . $Kelas->foto_kelas) }}" alt="chair">
                                </div>
                                <div class="col-lg-5 mx-auto">
                                    <h3 class="mt-lg-0 mt-4">{{ $Kelas->nama_kelas }}</h3>
                                    <br>
                                    <h6 class="mb-0 mt-3">Price</h6>
                                    <h5>@currency($Kelas->nominal)</h5>
                                    <span class="badge badge-success">In Stock</span>
                                    <br>
                                    <label class="mt-4">Description</label>
                                    <p>{!! $Kelas->desktripsi !!}</p>
                                    <div class="row mt-4">
                                        <div class="col-lg-5">
                                            <button class="btn btn-primary mb-0 mt-lg-auto w-100" type="submit"
                                                name="button">Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
    <!-- <script>
        $(function() {
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url('/admin/kontrak') }}',
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'judul_kontrak',
                        name: 'judul_kontrak'
                    },
                    {
                        data: 'provinsi',
                        name: 'provinsi'
                    },
                    {
                        data: 'kabupaten',
                        name: 'kabupaten'
                    },
                    {
                        data: 'kecamatan',
                        name: 'kecamatan'
                    },
                    {
                        data: 'id_desa',
                        name: 'id_desa'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                lengthMenu: [
                    [100, 200, -1],
                    [100, 200, "All"]
                ]
            })
            // console.log()
            // styling wrapper
            $('.dataTables_wrapper').addClass('py-2')

            $('<div id="header-datatable" class="d-flex justify-content-between" ></div>').prependTo(
                '.dataTables_wrapper')
            $('.dataTables_length').appendTo('#header-datatable')
            $('.dataTables_filter').appendTo('#header-datatable')

            // styling orderable
            $('.dataTables_length label')[0].childNodes[0].nodeValue = ''
            $('.dataTables_length label')[0].childNodes[2].nodeValue = ''
            $('.dataTables_length').addClass('p-0')
            $('.dataTables_length').css('float', 'none')
            $('.dataTables_length select').addClass('form-control form-control-sm form-control-alternative')

            // styling filter
            $('.dataTables_filter label')[0].childNodes[0].nodeValue = ''
            $('.dataTables_filter input').addClass('form-control form-control-sm form-control-alternative')
            $('.dataTables_filter input').attr('placeholder', 'search...')
            $('.dataTables_filter').css('float', 'none')
            $('.dataTables_filter').css('padding-right', '10px')

            // styling table
            $('.dataTable').removeClass('no-footer')
        })
    </script> -->
@endpush
