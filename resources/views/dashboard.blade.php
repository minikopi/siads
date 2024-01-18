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
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Satu</h6>
                                                <h3 class="mb-2 number-font">34.516</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-primary"><i
                                                            class="fa fa-chevron-circle-up text-primary me-1"></i>
                                                        3%</span> dari nilai sebelumnya.
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto">
                                                    <i class="fe fe-trending-up text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Kedua</h6>
                                                <h3 class="mb-2 number-font">56.992</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-secondary"><i
                                                            class="fa fa-chevron-circle-up text-secondary me-1"></i>
                                                        3%</span> dari nilai sebelumnya
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-danger-gradient box-shadow-danger brround  ms-auto">
                                                    <i class="icon icon-rocket text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Ketiga</h6>
                                                <h3 class="mb-2 number-font">42.567</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-success"><i
                                                            class="fa fa-chevron-circle-down text-success me-1"></i>
                                                        5%</span> dari nilai sebelumnya
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-secondary-gradient box-shadow-secondary brround ms-auto">
                                                    <i class="fe fe-dollar-sign text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Keempat</h6>
                                                <h3 class="mb-2 number-font">34.789</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-danger"><i
                                                            class="fa fa-chevron-circle-down text-danger me-1"></i>
                                                        2%</span> dari nilai sebelumnya
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-success-gradient box-shadow-success brround  ms-auto">
                                                    <i class="fe fe-briefcase text-white mb-5 "></i>
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
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Riwayat Indeks Prestasi</h3>
                            </div>
                            <div class="card-body pb-0">
                                <div id="chartArea" class="chart-donut"></div>
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
