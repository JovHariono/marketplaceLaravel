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
                                    <th style="width:1%">Pembeli</th>
                                    <th style="width:1%">Nama Kelas</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">SnapToken</th>
                                    <th scope="col">Tanggal dibuat</th>
                                    <th style="width:10%">Status</th>
                                </tr>
                            </thead>
                            <tbody>

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
        $(function(){
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url("/admin/report") }}',
                    type: 'GET',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'kelas_id', name: 'kelas_id'},
                    {data: 'nominal', name: 'nominal'},
                    {data: 'snaptoken', name: 'snaptoken'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'status', name: 'status'}
                ],
                lengthMenu: [[10,25,50, 100, -1],[10,25,50, 100, "All"]]
            })
            // console.log()
            // styling wrapper
            //$('.dataTables_wrapper').addClass('py-2')
    
            //$('<div id="header-datatable" class="d-flex justify-content-between" ></div>').prependTo('.dataTables_wrapper')
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
            // $('.dataTable').removeClass('no-footer')
        })
    </script>
    {{-- <script src="{{ asset('argon') }}/js/datatables.min.js "></script>
    <script>
        $(document).ready(function() {
            $('.table-kontrak').DataTable({
                "lengthMenu": [
                    [100, 200, -1],
                    [100, 200, "All"]
                ]
            });
        });
    </script> --}}
@endpush
