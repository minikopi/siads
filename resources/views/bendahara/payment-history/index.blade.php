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
                                <h3 class="card-title">Data Transaksi</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">NIM</th>
                                                <th class="wd-15p border-bottom-0">NAMA</th>
                                                <th class="wd-15p border-bottom-0">ANGKATAN</th>
                                                <th class="wd-15p border-bottom-0">METODE PEMBAYARAN</th>
                                                <th class="wd-15p border-bottom-0">TANGGAL</th>
                                                <th class="wd-15p border-bottom-0">NOMINAL</th>
                                                <th class="wd-15p border-bottom-0">KETERANGAN</th>
                                                <th class="wd-10p border-bottom-0"></th>
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
                    "ajax": "{{ route('bendahara.payment-history.data') }}", // Sesuaikan dengan route yang Anda buat
                    "columns": [
                        // {
                        //     data: 'DT_RowIndex',
                        //     name: 'DT_RowIndex',
                        //     orderable: false,
                        //     searchable: false
                        // },
                        {
                            data: 'mahasantri.nim',
                            name: 'mahasantri.nim',
                            orderable: false,
                        },
                        {
                            data: 'mahasantri.nama_lengkap',
                            name: 'mahasantri.nama_lengkap',
                            orderable: false,
                        },
                        {
                            data: 'nama_angkatan',
                            name: 'nama_angkatan',
                            orderable: false,
                        },
                        {
                            data: 'via',
                            name: 'payment_type',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            orderable: false,
                        },
                        {
                            data: 'total',
                            name: 'total',
                            orderable: false,
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                        }
                    ],
                });
            });
        </script>
    @endpush
@endsection
