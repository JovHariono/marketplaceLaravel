@extends('layouts.argon')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row align-items-center py-1">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Daftar Kelas</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row mt-3">
            @foreach ($Kelas as $Kelas)
                <div class="col-12 col-md-6 col-xl-4 md-0 mt-0 mb-3">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-8">
                                    <h6 class="mb-0">{{ $Kelas->nama_kelas }}</h6>
                                </div>
                                <div class="col-md-4 mt-1">
                                    <h6>@currency($Kelas->nominal)</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div style="display: flex; justify-content: center; align-items: center">
                                <img src="{{ asset('uploads/foto_kelas/' . $Kelas->foto_kelas) }}"
                                    class="img-fluid border-radius-lg shadow-lg max-height-500">
                            </div>
                            <hr class="horizontal gray-light my-4">
                            <p class="text-sm">{!! $Kelas->desktripsi !!}
                            </p>
                            <hr class="horizontal gray-light my-4">
                            <a class="btn btn-facebook btn-simple" href="{{ url('/siswa/detail-kelas/' . $Kelas->id)}}" style="width: 350px">
                                <i class="fas fa-info"></i>  Detail Kelas
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
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
