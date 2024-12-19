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
                                <h3 class="card-title">Jadwal Kuliah Yang Diampu</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">MATA KULIAH</th>
                                                <th class="wd-15p border-bottom-0">SKS</th>
                                                <th class="wd-15p border-bottom-0">LOKASI</th>
                                                <th class="wd-15p border-bottom-0">HARI</th>
                                                <th class="wd-15p border-bottom-0">MULAI</th>
                                                <th class="wd-15p border-bottom-0">SELESAI</th>
                                                <th class="wd-15p border-bottom-0">KELAS</th>
                                                <th class="wd-15p border-bottom-0">KELOMPOK</th>
                                                <th>#</th>
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
                    "ajax": "{{ route('dosen.jadwal-kuliah.data') }}",
                    "columns": [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'mata_kuliah.nama',
                            name: 'mata_kuliah.nama',
                            orderable: false,
                        },
                        {
                            data: 'mata_kuliah.sks',
                            name: 'mata_kuliah.sks',
                            orderable: false,
                        },
                        {
                            data: 'place',
                            name: 'place',
                            orderable: false,
                        },
                        {
                            data: 'day',
                            name: 'day',
                            orderable: false,
                        },
                        {
                            data: 'start_date',
                            name: 'start_date',
                            orderable: false,
                        },
                        {
                            data: 'end_date',
                            name: 'end_date',
                            orderable: false,
                        },
                        {
                            data: 'class.nama',
                            name: 'class.nama',
                            orderable: false,
                        },
                        {
                            data: 'type',
                            name: 'type',
                            orderable: false,
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                        }
                    ],
                    "columnDefs": [{
                            "width": "5%",
                            "targets": 0
                        },
                        {
                            "width": "5%",
                            "targets": 2
                        },
                        {
                            "width": "10%",
                            "targets": 4
                        },
                        {
                            "width": "10%",
                            "targets": 5
                        },
                        {
                            "width": "10%",
                            "targets": 6
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
