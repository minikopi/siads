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
                                <h3 class="card-title">Mata Kuliah</h3>
                                <p class="ms-auto"><a href="{{ route('mata-kuliah.create') }}"
                                        class="btn btn-primary btn-sm">Tambah</a></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="data-table">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">Mata Kuliah</th>
                                                <th class="wd-20p border-bottom-0">Kode</th>
                                                <th class="wd-15p border-bottom-0">SKS</th>
                                                <th class="wd-10p border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Sahih al-Bukhary</td>
                                                <td>HDS-SB</td>
                                                <td>2</td>
                                                <td>
                                                    <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                    <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
        <script>
            $(document).ready(function() {
                $('#data-table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('mata-kuliah.dataGet') }}", // Sesuaikan dengan route yang Anda buat
                    "columns": [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'nomor_induk',
                            name: 'nomor_induk'
                        } {
                            data: 'jabatan',
                            name: 'jabatan'
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
