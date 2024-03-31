@extends ('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Dashboard</h1>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-4">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Mahasantri</h6>
                                                <h3 class="mb-2 number-font">{{ $data['mahasantri'] }}</h3>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto">
                                                    <i class="fe fe-users text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-4">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Dosen/Musyrif</h6>
                                                <h3 class="mb-2 number-font">{{ $data['dosen'] }}</h3>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-danger-gradient box-shadow-danger brround  ms-auto">
                                                    <i class="fe fe-user text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Laporan Kehadiran</h3>
                            </div>
                            <div class="card-body pb-0">
                                <div id="chartArea" class="chart-donut"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Kehadiran Mahasiswa</div>
                            </div>
                            <div class="card-body">
                                <div id="chartDonut" class="chart-donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW-1 END -->



            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content end-->
    </div>
@endsection
