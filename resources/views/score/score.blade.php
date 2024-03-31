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
                                <h3 class="card-title">Penilaian Mata Kuliah / {{ $data['schedule']->class->nama }}
                                    ({{ $data['schedule']->class->tahun_ajaran }}) /
                                    {{ $data['schedule']->mata_kuliah->nama }}</h3>
                                <p class="ms-auto"><a href="{{ route('score.scoreForm', ['id' => $data['schedule']->id]) }}"
                                        class="btn btn-primary btn-sm">Beri Penilaiaan</a></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Nama</th>
                                                <th class="wd-15p border-bottom-0">Total Kelas</th>
                                                <th class="wd-15p border-bottom-0">Total Kehadiran</th>
                                                <th class="wd-15p border-bottom-0">Persentasi Kehadiran</th>
                                                <th class="wd-15p border-bottom-0">Penilaian Akademik</th>
                                                <th class="wd-15p border-bottom-0">Penilaian Non Akademik</th>
                                                {{-- <th class="wd-10p border-bottom-0">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['siswa'] as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->nama_depan }} {{ $item->nama_belakang }}</td>
                                                    <td>{{ $item->total }}</td>
                                                    <td>{{ $item->hadir }}</td>
                                                    <td>{{ round($item->persent) }}%</td>
                                                    <td>{{ isset($item->nilai) ? $item->nilai->akademik : 'Belum Terisi' }}
                                                    </td>
                                                    <td>{{ isset($item->nilai) ? $item->nilai->non_akademik : 'Belum Terisi' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{-- <tr>
                                                <td>1</td>
                                                <td>Sahih al-Bukhary</td>

                                                <td>
                                                    <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                    <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr> --}}
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
