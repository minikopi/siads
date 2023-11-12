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
                                                        class="btn btn-primary w-100">Daftar</a></h3>
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
                                                <h3 class="mb-2 number-font">34,516</h3>
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
                                                <h6 class="">Total Ustadz</h6>
                                                <h3 class="mb-2 number-font">56,992</h3>
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
                                <h3 class="card-title">Data Dosen</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="data-table">
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
                                <h3 class="card-title">Data Ustadz</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="data-table2">
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
        <script>
            $(document).ready(function() {
                $('#data-table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('dosen.dataGet') }}", // Sesuaikan dengan route yang Anda buat
                    "columns": [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'nomor_induk',
                            name: 'nomor_induk'
                        } {
                            data: 'jabatan',
                            name: 'jabatan'
                        }
                    ]
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#data-table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('dosen.dataGet2') }}", // Sesuaikan dengan route yang Anda buat
                    "columns": [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'nomor_induk',
                            name: 'nomor_induk'
                        } {
                            data: 'jabatan',
                            name: 'jabatan'
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
