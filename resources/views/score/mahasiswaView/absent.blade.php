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
                                <h3 class="card-title">Nilai Kuliah / {{ Auth::user()->name }}</h3>
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
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('score.mahasantri.cetak', ['id' => Auth::user()->mahasantri->kelas_id]) }}">Cetak
                                                    KHS</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Kode</th>
                                                <th class="wd-15p border-bottom-0">Mata Kuliah</th>
                                                <th class="wd-15p border-bottom-0">SKS</th>
                                                <th class="wd-15p border-bottom-0">Nilai</th>
                                                <th class="wd-15p border-bottom-0">Huruf</th>
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
                route = '{{ route('score.mahasantri.getData') }}?smester=' + smester
                var table = $('#datatables').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": route, // Sesuaikan dengan route yang Anda buat
                    "columns": [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'mata_kuliah.kode',
                            name: 'mata_kuliah.kode'
                        },
                        {
                            data: 'mata_kuliah.nama',
                            name: 'mata_kuliah.nama'
                        },
                        {
                            data: 'mata_kuliah.sks',
                            name: 'mata_kuliah.sks'
                        },
                        {
                            data: 'score',
                            name: 'score'
                        },
                        {
                            data: 'huruf',
                            name: 'huruf'
                        },
                    ],
                });

                $('.smester').change(function() {
                    smester = $(this).val();
                    console.log(smester);
                    route = '{{ route('score.mahasantri.getData') }}?smester=' + smester
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
