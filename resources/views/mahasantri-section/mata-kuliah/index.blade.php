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
                                <h3 class="card-title">Mata Kuliah Darus-Sunnah</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">MATA KULIAH</th>
                                                <th class="wd-15p border-bottom-0">KODE</th>
                                                <th class="wd-15p border-bottom-0">SKS</th>
                                                <th class="wd-15p border-bottom-0">SEMESTER</th>
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
                    "ajax": "{{ route('mahasantri.mata-kuliah.data') }}", // Sesuaikan dengan route yang Anda buat
                    "columns": [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama',
                            name: 'nama',
                            orderable: false,
                        },
                        {
                            data: 'kode',
                            name: 'kode',
                            orderable: false,
                        },
                        {
                            data: 'sks',
                            name: 'sks',
                            orderable: false,
                        },
                        {
                            data: 'smester',
                            name: 'smester',
                            orderable: false,
                        }
                    ],
                    "columnDefs": [{
                            "width": "5%",
                            "targets": 0
                        },
                        {
                            "width": "15%",
                            "targets": 2
                        },
                        {
                            "width": "15%",
                            "targets": 3
                        },
                        {
                            "width": "15%",
                            "targets": 4
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
