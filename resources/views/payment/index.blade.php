@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Data Pembayaran</h1>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row mt-5">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                            <div class="row">
                                <div class="col-lg-4     col-md-6 col-sm-12 col-xl-4">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="">Total Siswa Lunas</h6>
                                                    <h3 class="mb-2 number-font">1.252</h3>
                                                    <p class="text-muted mb-0">
                                                        <span class="text-primary"><i
                                                                class="fa fa-chevron-circle-up text-primary me-1"></i>
                                                            90%</span> siswa telah melunasi.
                                                    </p>
                                                </div>
                                                <div class="col col-auto">
                                                    <div
                                                        class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto">
                                                        <i class="fe fe-trending-up text-white mb-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xl-4">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="">Total Siswa Belum Lunas</h6>
                                                    <h3 class="mb-2 number-font">113</h3>
                                                    <p class="text-muted mb-0">
                                                        <span class="text-secondary"><i
                                                                class="fa fa-chevron-circle-up text-secondary me-1"></i>
                                                            10%</span> siswa belum melakukan pembayaran.
                                                    </p>
                                                </div>
                                                <div class="col col-auto">
                                                    <div
                                                        class="counter-icon bg-danger-gradient box-shadow-danger brround  ms-auto">
                                                        <i class="icon icon-rocket text-white mb-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xl-4">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="">Total Pembayaran</h6>
                                                    <h3 class="mb-2 number-font">Rp 863.521.220</h3>
                                                    <p class="text-muted mb-0">
                                                        <span class="text-success"><i
                                                                class="fa fa-chevron-circle-down text-success me-1"></i>
                                                            5%</span> dari nilai sebelumnya
                                                    </p>
                                                </div>
                                                <div class="col col-auto">
                                                    <div
                                                        class="counter-icon bg-secondary-gradient box-shadow-secondary brround ms-auto">
                                                        <i class="fe fe-dollar-sign text-white mb-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Tagihan Semester Berjalan</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables2">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Jenis Tagihan</th>
                                                <th class="wd-20p border-bottom-0">Nominal</th>
                                                <th class="wd-15p border-bottom-0">Jatuh Tempo</th>
                                                <th class="wd-10p border-bottom-0">Status</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Tagihan Semester Selesai</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Jenis Tagihan</th>
                                                <th class="wd-20p border-bottom-0">Nominal</th>
                                                <th class="wd-15p border-bottom-0">Jatuh Tempo</th>
                                                <th class="wd-10p border-bottom-0">Status</th>
                                            </tr>
                                        </thead>
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
                    // "ajax": "{{ route('dosen.dataGet') }}", 
                    "columns": [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + 1; // Adding 1 to start the iteration from 1
                            },
                            name: 'iteration'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'nomor_induk',
                            name: 'nomor_induk'
                        }, {
                            data: 'jabatan',
                            name: 'jabatan'
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                return '<button class="btn btn-warning" onclick="deleteRow(' + row.id +
                                    ')">Edit</button> <button class="btn btn-danger" onclick="deleteRow(' +
                                    row.id +
                                    ')">Delete</button>';
                            },
                            name: 'action'
                        }
                    ],
                    "columnDefs": [{
                            "width": "3%",
                            "targets": 0
                        }, // No
                        {
                            "width": "25%",
                            "targets": 1
                        }, // Nama Dosen
                        {
                            "width": "20%",
                            "targets": 2
                        }, // Nomor Induk
                        {
                            "width": "15%",
                            "targets": 3
                        }, // Jabatan
                        {
                            "width": "10%",
                            "targets": 4
                        } // Action
                    ]
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#datatables2').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('dosen.dataGet2') }}", // Sesuaikan dengan route yang Anda buat
                    "columns": [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + 1; // Adding 1 to start the iteration from 1
                            },
                            name: 'iteration'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'nomor_induk',
                            name: 'nomor_induk'
                        }, {
                            data: 'jabatan',
                            name: 'jabatan'
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                return '<button class="btn btn-warning" onclick="deleteRow(' + row.id +
                                    ')">Edit</button> <button class="btn btn-danger" onclick="deleteRow(' +
                                    row.id +
                                    ')">Delete</button>';
                            },
                            name: 'action'
                        }
                    ],
                    "columnDefs": [{
                            "width": "3%",
                            "targets": 0
                        }, // No
                        {
                            "width": "25%",
                            "targets": 1
                        }, // Nama Dosen
                        {
                            "width": "20%",
                            "targets": 2
                        }, // Nomor Induk
                        {
                            "width": "15%",
                            "targets": 3
                        }, // Jabatan
                        {
                            "width": "10%",
                            "targets": 4
                        } // Action
                    ]
                });
            });
        </script>
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                });
            </script>
        @endif
    @endpush
@endsection
