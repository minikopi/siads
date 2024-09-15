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
                                <h3 class="card-title">Tahun Ajaran</h3>
                                <a href="{{ route('academic-year.create') }}" class="btn btn-primary">Tambah</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Tahun Ajaran</th>
                                                <th class="wd-20p border-bottom-0">Status</th>
                                                <th class="wd-15p border-bottom-0">Periode Berjalan</th>
                                                <th class="wd-15p border-bottom-0">Periode Baru</th>
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
                    "ajax": "{{ route('academic-year.dataGet') }}", // Sesuaikan dengan route yang Anda buat
                    "columns": [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        {
                            data: 'full_year',
                            name: 'full_year',
                            orderable: false
                        },
                        {
                            data: 'visible',
                            name: 'visible',
                            orderable: false
                        },
                        {
                            data: 'active',
                            name: 'active',
                            orderable: false
                        },
                        {
                            data: 'registration',
                            name: 'registration',
                            orderable: false
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                var route =
                                    '{{ route('academic-year.edit', ['academic_year' => ':id']) }}'
                                var routeDelete =
                                    '{{ route('academic-year.destroy', ['academic_year' => ':id']) }}'
                                route = route.replace(':id', data.id);
                                routeDelete = routeDelete.replace(':id', data.id);
                                let tahun = String(data.full_year);
                                let params = `'${routeDelete}','${tahun}'`;
                                console.log(params)
                                return `<a href="${route}" class="btn btn-warning">Edit</a> <button class="btn btn-danger" onclick="deleteRow(${params})">Delete</button>`;
                            },
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
    @endpush
@endsection
