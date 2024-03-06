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
                                <h3 class="card-title">Penilaian / {{ $data['schedule']->class->nama }}
                                    ({{ $data['schedule']->class->tahun_ajaran }} - {{ $data['schedule']->class->smester }})
                                    / {{ $data['schedule']->mata_kuliah->nama }} / Form Penilaian</h3>
                                {{-- <p class="ms-auto"><a href="{{ route('kelas.matkulPerKelas.detail',["id"=>$data["class"]->id]) }}"
                                        class="btn btn-primary btn-sm">Tambah Absen</a></p> --}}
                            </div>

                            <form action="{{ route('score.store', ['schedule_id' => $data['schedule']->id]) }}">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table  text-nowrap" id="datatables">
                                            <tbody>

                                                @foreach ($data['siswa'] as $key => $siswa)
                                                    <tr class="border-bottom">

                                                        <td>{{ $siswa->nama_depan }} {{ $siswa->nama_belakang }}</td>
                                                        <td>
                                                            {{ $siswa->total }} Kelas
                                                        </td>
                                                        <td>
                                                            {{ $siswa->hadir }} Kehadiran
                                                        </td>
                                                        <td>
                                                            {{ round($siswa->persent) }} % Kehadiran
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control required"
                                                                name="akademik[{{ $siswa->id }}]" id="asal_sekolah" value="{{$siswa->akademin}}"
                                                                style="height: 30px" placeholder="Penilaian Akademik">

                                                        </td>
                                                        <td>

                                                            <input type="text" class="form-control required"
                                                                name="non_akademik[{{ $siswa->id }}]" id="asal_sekolah" value="{{$siswa->non_akademin}}"
                                                                style="height: 30px" placeholder="Penilaian Non Akademik">

                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row">
                                        <div class="col-3">
                                            <button class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
