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
                                <h3 class="card-title">Jadwal Kuliah / Daftar Mata Kuliah {{ $data['class']->nama }}
                                    ({{ $data['class']->tahun_ajaran }})</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <div class="col-3">
                                            <!-- Empty column to keep space on the left side -->
                                        </div>
                                        <div class="col-6 text-center">
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
                                        <div class="col-3 text-end">
                                            <div class="control-group form-group">
                                                @if (Auth::user()->role == 'Mahasantri')
                                                    <a class="btn btn-success" id="cetakKRS"
                                                        href="javascript:void(0);">
                                                        Cetak KRS
                                                    </a>
                                                @endif
                                            </div>
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
                route = '{{ route('mahasantri.jadwal.data', ['id' => $data['class']->id]) }}?smester=' + smester
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
                            data: 'peserta',
                            name: 'Peserta'
                        },
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
                            "width": "10%",
                            "targets": 2
                        }
                    ]
                });

                $('.smester').change(function() {
                    smester = $(this).val();
                    route =
                        '{{ route('mahasantri.jadwal.data', ['id' => $data['class']->id]) }}?smester=' +
                        smester
                    table.ajax.url(route).load();
                })

                $('#cetakKRS').on('click', function() {
                    semester = $('.smester').val();
                    window.location.href = '{{ route('mahasantri.jadwal.print', ['id' => Auth::user()->mahasantri->kelas_id]) }}/' + semester;
                });
            });
        </script>
    @endpush
@endsection
