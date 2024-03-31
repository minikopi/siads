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
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Data Prestasi Akademik</h3>
                                @if (Auth::user()->role == 'Mahasantri')
                                    <a class="btn btn-primary" href="{{ route('prestasi.create') }}">Tambah</a>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">NPS</th>
                                                <th class="wd-20p border-bottom-0">Nama Mahasiswa</th>
                                                <th class="wd-15p border-bottom-0">Pretasi Mahasiswa</th>
                                                <th class="wd-10p border-bottom-0">File</th>
                                                <th class="wd-10p border-bottom-0">Status</th>
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
                    "ajax": "{{ route('prestasi.dataGet') }}", // Sesuaikan dengan route yang Anda buat
                    "columns": [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + 1; // Adding 1 to start the iteration from 1
                            },
                            name: 'iteration'
                        },
                        {
                            data: 'nim',
                            name: 'nim'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'prestasi',
                            name: 'prestasi'
                        },
                        {
                            data: 'file',
                            name: 'file'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: null,
                            visible: @json(Auth::user()->role == 'Admin'),
                            render: function(data, type, row) {
                                var acceptButton =
                                    '<button class="btn btn-success accept-button" data-id="' + row.id +
                                    '">Terima</button>';
                                var rejectButton =
                                    '<button class="btn btn-danger reject-button" data-id="' + row.id +
                                    '">Tolak</button>';

                                if (row.status === 'Diterima' || row.status === 'Ditolak') {
                                    return '';
                                } else {
                                    return acceptButton + ' ' + rejectButton;
                                }
                            },
                            name: 'action'
                        }

                    ],
                    "colum00nDefs": [{
                            "width": "3%",
                            "targets": 0
                        }, // No
                        {
                            "width": "12%",
                            "targets": 1
                        }, // NPS
                        {
                            "width": "20%",
                            "targets": 2
                        }, // Nama
                        {
                            "width": "25%",
                            "targets": 3
                        }, // Prestasi
                        {
                            "width": "10%",
                            "targets": 4
                        }, // File
                        {
                            "width": "10%",
                            "targets": 5
                        }, // Status
                        {
                            "width": "10%",
                            "targets": 6
                        } // Action
                    ]
                });
            });
            $('#datatables').on('click', '.accept-button', function() {
                var rowId = $(this).data('id');
                acceptRow(rowId);
            });
            $('#datatables').on('click', '.reject-button', function() {
                var rowId = $(this).data('id');
                rejectRow(rowId);
            });

            function acceptRow(rowId) {
                // Make an AJAX request to update the row with the new status "Diterima"
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menerima prestasi ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Terima',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User clicked "Ya, Terima," proceed with the AJAX request
                        $.ajax({
                            url: '{{ route('prestasi.accept', ['id' => '_ID_']) }}'.replace('_ID_', rowId),
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                status: 'Diterima'
                            },
                            success: function(response) {
                                // Handle the success response if needed
                                console.log(response);
                                $('#datatables').DataTable().draw();
                            },
                            error: function(error) {
                                // Handle the error response if needed
                                console.error(error);
                            }
                        });
                    }
                });
            }

            function rejectRow(rowId) {
                // Show SweetAlert2 prompt for providing a reason
                Swal.fire({
                    title: 'Berikan alasan penolakan',
                    html: '<textarea id="reason" class="swal2-input" "></textarea>',
                    showCancelButton: true,
                    confirmButtonText: 'Tolak',
                    cancelButtonText: 'Batal',
                    preConfirm: function() {
                        var reason = document.getElementById('reason').value;

                        // Make an AJAX request to update the row with the new status "Ditolak"
                        $.ajax({
                            url: '{{ route('prestasi.reject', ['id' => '_ID_']) }}'.replace('_ID_', rowId),
                            method: 'POST', // or 'PUT', 'PATCH', depending on your server route
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                status: 'Ditolak',
                                reason: reason
                            },
                            success: function(response) {
                                // Handle the success response if needed
                                console.log(response);
                                $('#datatables').DataTable().draw();
                            },
                            error: function(error) {
                                // Handle the error response if needed
                                console.error(error);
                            }
                        });
                    }
                });
            }
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
