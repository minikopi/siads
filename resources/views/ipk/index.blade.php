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
                        <h1 class="page-title">Riwayat Indeks Prestasi</h1>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row mt-5">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        {{-- <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xl-2">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">IPK</h6>
                                                <h3 class="mb-2 number-font">3.07</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-primary"><i
                                                            class="fa fa-chevron-circle-up text-primary me-1"></i>
                                                        3%</span> dari Semester sebelumnya.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Riwayat Indeks Prestasi</h3>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div id="chartArea" class="chart-donut"></div>
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
                                <h3 class="card-title">Tabel Riwayat Indeks Prestasi</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Tahun Akademik</th>
                                                <th class="wd-20p border-bottom-0">Semester</th>
                                                <th class="wd-15p border-bottom-0">Jumlah SKS</th>
                                                <th class="wd-10p border-bottom-0">IP</th>
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
