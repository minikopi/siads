@php
    use Carbon\Carbon;
@endphp

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
                                <h3 class="card-title">Persensi Kuliah / {{ $data['schedule']->class->nama }}
                                    ({{ $data['schedule']->class->tahun_ajaran }}) /
                                    {{ $data['schedule']->mata_kuliah->nama }}</h3>
                                <p class="ms-auto"><a href="{{ route('absent.AbsentForm', ['id' => $data['schedule']->id]) }}"
                                        class="btn btn-primary btn-sm">Tambah Absen</a></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Tanggal</th>
                                                <th class="wd-15p border-bottom-0">Hadir</th>
                                                <th class="wd-15p border-bottom-0">Sakit</th>
                                                <th class="wd-15p border-bottom-0">Izin</th>
                                                <th class="wd-15p border-bottom-0">Ghoib</th>
                                                <th class="wd-15p border-bottom-0">Terlambat</th>
                                                <th class="wd-15p border-bottom-0">% Hadir</th>
                                                <th class="wd-10p border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['absen'] as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d - F - Y') }}
                                                    </td>
                                                    <td>{{ $item->jumlah_hadir }}</td>
                                                    <td>{{ $item->jumlah_sakit }}</td>
                                                    <td>{{ $item->jumlah_izin }}</td>
                                                    <td>{{ $item->jumlah_ghoib }}</td>
                                                    <td>{{ $item->jumlah_terlambat }}</td>
                                                    <td>{{ $item->persen }}</td>
                                                    <td>
                                                        <a href="{{route('absent.AbsentFormEdit',['id'=>$data['schedule']->id, 'date'=>$item->tanggal])}}" class="btn btn-sm btn-primary">Edit Persensi</a>
                                                        <form action="{{route('absent.delete', ['id'=>$data['schedule']->id, 'date'=>$item->tanggal])}}"
                                                                onsubmit="return confirm('Are you sure?')" class="d-inline"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE">

                                                            <button type="submit" class="btn btn-sm btn-danger" >Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{-- <tr>
                                                <td>1</td>
                                                <td>Sahih al-Bukhary</td>

                                                <td>
                                                    <a href="" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                    <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
