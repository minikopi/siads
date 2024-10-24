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
                                <h3 class="card-title">Transkrip Nilai</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Mata Kuliah</th>
                                                <th class="wd-15p border-bottom-0">Kode</th>
                                                <th class="wd-15p border-bottom-0">Nilai</th>
                                                <th class="wd-15p border-bottom-0">Huruf</th>
                                                <th class="wd-15p border-bottom-0">SKS</th>
                                                <th class="wd-15p border-bottom-0">Semester</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->kode }}</td>
                                                <td>{{ $item->akademik ?? '-' }}</td>
                                                <td>
                                                    @if ($item->akademik > 80)
                                                        A
                                                    @elseif ($item->akademik > 70)
                                                        B
                                                    @elseif ($item->akademik > 60)
                                                        C
                                                    @elseif ($item->akademik > 50)
                                                        D
                                                    @else
                                                        E
                                                    @endif
                                                </td>
                                                <td>{{ $item->sks }}</td>
                                                <td>{{ $item->smester }}</td>
                                            </tr>
                                            @endforeach
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
        <!-- SweetAlert2 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    @endpush
@endsection
