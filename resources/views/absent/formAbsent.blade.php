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
                                <h3 class="card-title">Persensi Kuliah / {{$data['schedule']->class->nama}} ({{$data['schedule']->class->tahun_ajaran}} - {{$data['schedule']->class->smester}}) / {{$data['schedule']->mata_kuliah->nama}} / Form Absen</h3>
                                {{-- <p class="ms-auto"><a href="{{ route('kelas.matkulPerKelas.detail',["id"=>$data["class"]->id]) }}"
                                        class="btn btn-primary btn-sm">Tambah Absen</a></p> --}}
                            </div>

                            <form action="{{route('absent.store', ["schedule_id"=> $data['schedule']->id])}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="control-group form-group">
                                            {{-- <label class="form-label">Tanggal Pelajaran</label> --}}
                                            <input type="date" class="form-control required" name="tanggal_pelajaran"
                                                id="tanggal_lahir">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-success">Submit Absen</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table  text-nowrap" id="datatables">
                                        <tbody>

                                            @foreach ($data['siswa'] as $key => $siswa)
                                            <tr class="border-bottom">

                                                <td>{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</td>
                                                <td>
                                                    <label class="custom-control custom-radio presence_{{ $siswa->id }}">
                                                        <input type="radio" class="custom-control-input" name="siswa[{{ $siswa->id }}]" value="HADIR">
                                                        <span class="custom-control-label">Hadir</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="custom-control custom-radio presence_{{ $siswa->id }}">
                                                        <input type="radio" class="custom-control-input" name="siswa[{{ $siswa->id }}]" value="SAKIT">
                                                        <span class="custom-control-label">Sakit</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="custom-control custom-radio presence_{{ $siswa->id }}">
                                                        <input type="radio" class="custom-control-input" name="siswa[{{ $siswa->id }}]" value="IZIN">
                                                        <span class="custom-control-label">Izin</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="custom-control custom-radio presence_{{ $siswa->id }}">
                                                        <input type="radio" class="custom-control-input" name="siswa[{{ $siswa->id }}]" value="GHOIB">
                                                        <span class="custom-control-label">Ghoib</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="custom-control custom-radio presence_{{ $siswa->id }}">
                                                        <input type="radio" class="custom-control-input" name="siswa[{{ $siswa->id }}]" value="TERLAMBAT">
                                                        <span class="custom-control-label">Terlambat</span>
                                                    </label>
                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
