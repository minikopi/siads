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
                                <h3 class="card-title">Kelas</h3>
                                <p class="ms-auto">
                                    <a href="{{ route('kelas.create') }}"
                                        class="btn btn-primary btn-sm d-inline-block mx-1">Tambah</a>
                                <form action="{{ route('kelas.updateSmester') }}" onsubmit="return confirm('Are you sure?')"
                                    method="POST">
                                    @csrf
                                    {{-- <button type="submit" class="btn btn-sm btn-info">Update Semester</button> --}}
                                </form>
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Nama Kelas</th>
                                                <th class="wd-15p border-bottom-0">Tahun Ajaran</th>
                                                {{-- <th class="wd-15p border-bottom-0">Smester</th> --}}
                                                <th class="wd-15p border-bottom-0">Jenis Kelamin</th>
                                                <th class="wd-10p border-bottom-0">Musyrif</th>
                                                <th class="wd-10p border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Sahih al-Bukhary</td>

                                                <td>
                                                    <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                    <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
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
            function deleteRow(url) {
                let token = $("meta[name='csrf-token']").attr("content");

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: `Anda akan menghapus data ini`,
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
                                    window.location.reload();
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
                    "ajax": "{{ route('kelas.dataGet') }}", // Sesuaikan dengan route yang Anda buat
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
                            data: 'tahun_ajaran',
                            name: 'tahun_ajaran'
                        },
                        // {
                        //     data: 'smester',
                        //     name: 'smester'
                        // },
                        {
                            data: 'gender',
                            name: 'gender'
                        },
                        {
                            data: 'dosen.user.name',
                            name: 'dosen.user.name'
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                var route = '{{ route('kelas.detail', ['id' => ':id']) }}'
                                var routeDelete = '{{ route('kelas.delete', ['id' => ':id']) }}'
                                route = route.replace(':id', data.id);
                                routeDelete = routeDelete.replace(':id', data.id);
                                return `<a href="${route}" class="btn btn-warning">Detail</a> <button class="btn btn-danger" onclick="deleteRow('${routeDelete}')">Delete</button>`;
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
