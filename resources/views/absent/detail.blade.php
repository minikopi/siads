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
                                <h3 class="card-title">Persensi Kuliah / {{ $data['class']->nama }}
                                    ({{ $data['class']->tahun_ajaran }})</h3>
                                {{-- <p class="ms-auto"><a href="{{ route('kelas.matkulPerKelas.detail',["id"=>$data["class"]->id]) }}"
                                        class="btn btn-primary btn-sm">Tambah Mata Kuliah</a></p> --}}
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-md-center">
                                    <div class="col-6">
                                        <div class="control-group form-group">
                                            <label class="form-label">Semester</label>
                                            <select class="form-control smester" name="smester" id="smester">
                                                @foreach ($data['smester'] as $item)
                                                    <option value="{{ $item }}">Semester {{ $item }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Mata Kuliah</th>
                                                <th class="wd-15p border-bottom-0">Kelas</th>
                                                <th class="wd-15p border-bottom-0">SKS</th>
                                                <th class="wd-15p border-bottom-0">Jadwal Kuliah</th>
                                                <th class="wd-15p border-bottom-0">Dosen Pengampu</th>
                                                <th class="wd-15p border-bottom-0">Peserta</th>
                                                {{-- <th class="wd-10p border-bottom-0">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Sahih al-Bukhary</td>

                                                <td>
                                                    <a href="" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                    <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
            $(document).ready(function() {
                var smester = $('.smester').val();
                var route;
                route = '{{ route('kelas.matkulPerKelas.dataGet', ['id' => $data['class']->id]) }}?smester=' + smester

                // route = route.replace(':id', $data["class"]->id);
                var table = $('#datatables').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": route, // Sesuaikan dengan route yang Anda buat
                    "columns": [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + 1; // Adding 1 to start the iteration from 1
                            },
                            name: 'iteration'
                        },

                        {
                            data: 'mata_kuliah.nama',
                            name: 'mata_kuliah.nama'
                        },
                        {
                            data: 'class.nama',
                            name: 'class.nama'
                        },
                        {
                            data: 'mata_kuliah.sks',
                            name: 'mata_kuliah.sks'
                        },
                        {
                            data: 'jadwal',
                            name: 'Jadwal Kuliah',
                        },
                        {
                            data: 'dosen.user.name',
                            name: 'dosen.user.name'
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                var route = '{{ route('absent.AbsentAdmin', ['id' => ':id']) }}'
                                route = route.replace(':id', data.id);
                                return '<a href="' + route + '" class="btn btn-sm btn-warning">Absent</a> ' +
                                    '<button class="btn btn-sm btn-danger" onclick="deleteRow(' +
                                    row.id +
                                    ')">Delete</button>';
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

                $('.smester').change(function() {
                    smester = $(this).val();
                    console.log(smester);
                    route =
                        '{{ route('kelas.matkulPerKelas.dataGet', ['id' => $data['class']->id]) }}?smester=' +
                        smester
                    table.ajax.url(route).load();
                })
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
