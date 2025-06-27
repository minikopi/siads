@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <div class="row mt-5">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-2">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="text-center">Buat Akun?</h6>
                                                <h3 class="mb-2"><a href="{{ route('dosen.create') }}"
                                                        class="btn btn-sm btn-primary w-100">Daftar</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-5">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Dosen</h6>
                                                <h3 class="mb-2 number-font">{{ $dosenCount }}</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-primary">Akun Terdaftar</span>
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto">
                                                    <i class="fa fa-users text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-5">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Musyrif</h6>
                                                <h3 class="mb-2 number-font">{{ $musyrifCount }}</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-secondary">Akun Terdaftar</span>
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-danger-gradient box-shadow-danger brround  ms-auto">
                                                    <i class="fa fa-users text-white mb-5 "></i>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Dosen Ma'had Darus-Sunnah</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Nama Dosen</th>
                                                <th class="wd-20p border-bottom-0">Nomor Induk</th>
                                                <th class="wd-15p border-bottom-0">Jabatan</th>
                                                <th class="wd-10p border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Musyrif Darus-Sunnah</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables2">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Nama Dosen</th>
                                                <th class="wd-20p border-bottom-0">Nomor Induk</th>
                                                <th class="wd-15p border-bottom-0">Jabatan</th>
                                                <th class="wd-10p border-bottom-0">Action</th>
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
                    "ajax": "{{ route('dosen.dataGet') }}", // Sesuaikan dengan route yang Anda buat
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
                                var route = '{{ route("dosen.edit", ["id" =>":id" ])}}'
                                var routeDelete = '{{ route("dosen.delete", ["id" =>":id" ])}}'
                                route = route.replace(':id', data.id);
                                routeDelete = routeDelete.replace(':id', data.id);
                                return '<a href="'+route+'" class="btn btn-sm btn-warning">Edit</a> ' +
                                    '<button class="btn btn-sm btn-danger" onclick="deleteRow(`' +
                                    routeDelete +
                                    '`)">Delete</button>';
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
                                var route = '{{ route("dosen.edit", ["id" =>":id" ])}}'
                                var routeDelete = '{{ route("dosen.delete", ["id" =>":id" ])}}'
                                route = route.replace(':id', data.id);
                                routeDelete = routeDelete.replace(':id', data.id);
                                return '<a href="'+route+'" class="btn btn-sm btn-warning">Edit</a> ' +
                                    '<button class="btn btn-sm btn-danger" onclick="deleteRow(`' +
                                    routeDelete +
                                    '`)">Delete</button>';
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
