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
                                <h3 class="card-title">Master Pembayaran</h3>
                                <p class="ms-auto"><a href="{{ route('paymentType.create') }}"
                                        class="btn btn-primary">Tambah</a></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Tahun Ajaran</th>
                                                <th class="wd-15p border-bottom-0">Nama</th>
                                                <th class="wd-15p border-bottom-0">Tipe</th>
                                                <th class="wd-15p border-bottom-0">Nominal</th>
                                                <th class="wd-15p border-bottom-0">Jatuh Tempo</th>
                                                <th class="wd-15p border-bottom-0">Publish</th>
                                                <th class="wd-10p border-bottom-0">Action</th>
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
            function deleteRow(url, text) {
                let token = $("meta[name='csrf-token']").attr("content");

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: `Anda akan menghapus data ${String(text)}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    buttonsStyling: false,
                    customClass: {
                        cancelButton: 'btn btn-light waves-effect',
                        confirmButton: 'btn btn-primary waves-effect waves-light'
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
                                    window.location = redirect;
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
            $(document).ready(function() {
                $('#datatables').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('paymentType.dataGet') }}", // Sesuaikan dengan route yang Anda buat
                    "columns": [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'full_year',
                            name: 'academic_years.full_year'
                        },
                        {
                            data: 'name',
                            name: 'name',
                            searchable: true
                        },
                        {
                            data: 'tipe',
                            name: 'type'
                        },
                        {
                            data: 'nomial_format',
                            name: 'nominal'
                        },
                        {
                            data: 'due_date',
                            name: 'due_date'
                        },
                        {
                            data: 'published',
                            name: 'published'
                        },
                        {
                            data: 'action',
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
                            "width": "10%",
                            "targets": 2
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
