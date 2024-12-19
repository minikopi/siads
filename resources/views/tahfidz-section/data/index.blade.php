@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <div class="row row-sm mt-5">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Tahfidz</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">NAMA MAHASANTRI</th>
                                                <th class="wd-15p border-bottom-0">NOMOR INDUK</th>
                                                <th class="wd-15p border-bottom-0">JUZ</th>
                                                <th class="wd-15p border-bottom-0">HALAMAN</th>
                                                <th class="wd-15p border-bottom-0">VERIFIKATOR</th>
                                                <th class="wd-15p border-bottom-0">WAKTU</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
        </div>
    </div>
    <!-- CONTAINER CLOSED -->
    </div>
    @push('custom')
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
        <!-- SweetAlert2 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#datatables').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('tahfidz.data.data') }}", // Sesuaikan dengan route yang Anda buat
                    "columns": [
                        {
                            data: 'mahasantri',
                            name: 'mahasantri',
                            orderable: false,
                        },
                        {
                            data: 'nim',
                            name: 'nim',
                            orderable: false,
                        },
                        {
                            data: 'juz_number',
                            name: 'juz_number',
                            orderable: false,
                        },
                        {
                            data: 'page_number',
                            name: 'page_number',
                            orderable: false,
                        },
                        {
                            data: 'updated_by',
                            name: 'updated_by',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at',
                            orderable: false,
                            searchable: true
                        }
                    ],
                });
            });
        </script>
    @endpush
@endsection
