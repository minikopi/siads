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
                                <h3 class="card-title">Dosen Darus-Sunnah</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">NAMA DOSEN</th>
                                                <th class="wd-15p border-bottom-0">NOMOR INDUK</th>
                                                <th class="wd-15p border-bottom-0">JABATAN</th>
                                                <th class="wd-15p border-bottom-0">EMAIL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Musyrif Darus-Sunnah</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables2">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">NAMA DOSEN</th>
                                                <th class="wd-15p border-bottom-0">NOMOR INDUK</th>
                                                <th class="wd-15p border-bottom-0">JABATAN</th>
                                                <th class="wd-15p border-bottom-0">EMAIL</th>
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
                    "ajax": "{{ route('mahasantri.dosen.data') }}", // Sesuaikan dengan route yang Anda buat
                    "columns": [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'user.name',
                            name: 'user.name',
                            orderable: false,
                        },
                        {
                            data: 'nomor_induk',
                            name: 'nomor_induk',
                            orderable: false,
                        },
                        {
                            data: 'jabatan',
                            name: 'jabatan',
                            orderable: false,
                        },
                        {
                            data: 'user.email',
                            name: 'user.email',
                            orderable: false,
                            searchable: true
                        }
                    ],
                });

                $('#datatables2').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('mahasantri.musyrif.data') }}", // Sesuaikan dengan route yang Anda buat
                    "columns": [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'user.name',
                            name: 'user.name',
                            orderable: false,
                        },
                        {
                            data: 'nomor_induk',
                            name: 'nomor_induk',
                            orderable: false,
                        },
                        {
                            data: 'jabatan',
                            name: 'jabatan',
                            orderable: false,
                        },
                        {
                            data: 'user.email',
                            name: 'user.email',
                            orderable: false,
                            searchable: true
                        }
                    ],
                });
            });
        </script>
    @endpush
@endsection
