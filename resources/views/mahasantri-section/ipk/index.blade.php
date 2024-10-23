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
                                <h3 class="card-title">Riwayat Indeks Prestasi</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-20p border-bottom-0">Tahun Ajaran</th>
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
                    <div class="col-lg-12">
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
                var route;
                route = '{{ route('mahasantri.ipk.data') }}'
                var table = $('#datatables').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": route,
                    "columns": [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'tahun',
                            name: 'tahun'
                        },
                        {
                            data: 'semester',
                            name: 'semester'
                        },
                        {
                            data: 'sks',
                            name: 'sks'
                        },
                        {
                            data: 'ips',
                            name: 'ips',

                        }
                    ],
                });
            });
        </script>
    @endpush
@endsection
