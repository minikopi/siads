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
                                <h3 class="card-title">Kalander Akademik</h3>
                                <a href="{{ route('administrator.akademik.create') }}" class="btn btn-sm btn-primary">Tambah</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Agenda</th>
                                                <th class="wd-20p border-bottom-0">Tanggal Mulai</th>
                                                <th class="wd-15p border-bottom-0">Tanggal Akhir</th>
                                                <th class="wd-15p border-bottom-0">Keterangan</th>
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
                                <h3 class="card-title">Surat Edaran</h3>
                                <p class="ms-auto"><a href="{{ route('administrator.edaran.create') }}"
                                        class="btn btn-sm btn-primary">Tambah</a></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered border-bottom" id="datatables2">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Perihal</th>
                                                <th class="wd-20p border-bottom-0">No Edaran</th>
                                                <th class="wd-15p border-bottom-0">Tanggal Edaran</th>
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
                    "ajax": "{{ route('administrator.akademik.data') }}",
                    "columns": [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'tanggal_mulai',
                            name: 'tanggal_mulai'
                        },
                        {
                            data: 'tanggal_akhir',
                            name: 'tanggal_akhir'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ],
                    "columnDefs": [{
                            "width": "3%",
                            "targets": 0
                        },
                        {
                            "width": "25%",
                            "targets": 1
                        },
                        {
                            "width": "20%",
                            "targets": 2
                        },
                        {
                            "width": "15%",
                            "targets": 3
                        },
                        {
                            "width": "10%",
                            "targets": 4
                        },
                        {
                            "width": "15%",
                            "targets": 5
                        }
                    ]
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                var table = $('#datatables2').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('administrator.edaran.data') }}",
                    "columns": [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'no',
                            name: 'no'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ],
                    "columnDefs": [{
                            "width": "3%",
                            "targets": 0
                        },
                        {
                            "width": "25%",
                            "targets": 1
                        },
                        {
                            "width": "20%",
                            "targets": 2
                        },
                        {
                            "width": "20%",
                            "targets": 3
                        }
                    ]
                });

                // Toggle PDF viewer visibility
                $('#datatables2').on('click', '.toggle-pdf', function() {
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);
                    var pdfSrc = $(this).data('pdf');

                    if (row.child.isShown()) {
                        // If the PDF viewer is already open, close it
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        // Open the PDF viewer for the row
                        row.child('<iframe src="' + pdfSrc +
                            '" style="width:100%; height:500px;" frameborder="0"></iframe>').show();
                        tr.addClass('shown');
                    }
                });
            });
        </script>

        <script>
            function deleteKalenderRow(url, text) {
                let token = $("meta[name='csrf-token']").attr("content");

                Swal.fire({
                    title: `Hapus data agenda ${String(text)}?`,
                    text: `Tindakan ini tidak dapat dibatalkan`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    buttonsStyling: false,
                    customClass: {
                        cancelButton: 'btn btn-sm btn-light waves-effect',
                        confirmButton: 'btn btn-sm btn-primary waves-effect waves-light'
                    },
                    preConfirm: (e) => {
                        return new Promise((resolve) => {
                            setTimeout(() => {
                                resolve();
                            }, 50);
                        });
                    }
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'POST',
                            data: {
                                "_method": "DELETE",
                                "_token": token
                            },
                            url: url,
                            success: function(response) {
                                Swal.fire({
                                    title: "Sukses",
                                    text: response.msg,
                                    icon: "success"
                                });
                                setTimeout(function() {
                                    window.location = response.redirect;
                                }, 1000)
                            },
                            error: function(response) {
                                var err = JSON.parse(response.responseText);
                                Swal.fire({
                                    title: "Error",
                                    text: err.msg,
                                    icon: "error"
                                });
                            }
                        })
                    }
                })
            }
            function deleteEdaranRow(url, text) {
                let token = $("meta[name='csrf-token']").attr("content");

                Swal.fire({
                    title: `Hapus data edaran ${String(text)}?`,
                    text: `Tindakan ini tidak dapat dibatalkan`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    buttonsStyling: false,
                    customClass: {
                        cancelButton: 'btn btn-sm btn-light waves-effect',
                        confirmButton: 'btn btn-sm btn-primary waves-effect waves-light'
                    },
                    preConfirm: (e) => {
                        return new Promise((resolve) => {
                            setTimeout(() => {
                                resolve();
                            }, 50);
                        });
                    }
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'POST',
                            data: {
                                "_method": "DELETE",
                                "_token": token
                            },
                            url: url,
                            success: function(response) {
                                Swal.fire({
                                    title: "Sukses",
                                    text: response.msg,
                                    icon: "success"
                                });
                                setTimeout(function() {
                                    window.location = response.redirect;
                                }, 1000)
                            },
                            error: function(response) {
                                var err = JSON.parse(response.responseText);
                                Swal.fire({
                                    title: "Error",
                                    text: err.msg,
                                    icon: "error"
                                });
                            }
                        })
                    }
                })
            }
        </script>
    @endpush
@endsection
