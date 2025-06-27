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
                                <h3 class="card-title">Poin Pembayaran Mahasantri - {{ $mahasantri->nama_lengkap }}</h3>
                                <p class="ms-auto">
                                    <a href="{{ route('bendahara.master-payment.payment.create', $mahasantri->id) }}" class="btn btn-sm btn-primary">
                                        Tambah
                                    </a>
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="datatables">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">Nama Tagihan</th>
                                                <th class="wd-15p border-bottom-0">Semester</th>
                                                <th class="wd-15p border-bottom-0">Dicicil</th>
                                                <th class="wd-15p border-bottom-0">Nominal</th>
                                                <th class="wd-15p border-bottom-0">Potongan</th>
                                                <th class="wd-15p border-bottom-0">Jatuh Tempo</th>
                                                <th class="wd-10p border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
        <script>
            function deleteRow(url, text) {
                let token = $("meta[name='csrf-token']").attr("content");

                Swal.fire({
                    title: `Hapus data pembayaran ${String(text)}?`,
                    text: `Tindakan ini tidak dapat dibatalkan`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    buttonsStyling: false,
                    customClass: {
                        cancelButton: 'btn btn-sm btn-light waves-effect',
                        confirmButton: 'btn btn-sm btn-primary waves-effect waves-light'
                    },
                    preConfirm: (e) => {
                        return new Promise((resolve) => {
                            setTimeout(() => {
                                resolve();
                            }, 50);
                        });
                    }
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'POST',
                            data: {
                                "_method": "DELETE",
                                "_token": token
                            },
                            url: url,
                            success: function(response) {
                                Swal.fire({
                                    title: "Sukses",
                                    text: response.msg,
                                    icon: "success"
                                });
                                setTimeout(function() {
                                    window.location = response.redirect;
                                }, 1000)
                            },
                            error: function(response) {
                                var err = JSON.parse(response.responseText);
                                Swal.fire({
                                    title: "Error",
                                    text: err.msg,
                                    icon: "error"
                                });
                            }
                        })
                    }
                })
            }
            $(document).ready(function() {
                $('#datatables').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('bendahara.master-payment.data', $mahasantri->id) }}", // Sesuaikan dengan route yang Anda buat
                    "columns": [
                        // {
                        //     data: 'DT_RowIndex',
                        //     name: 'DT_RowIndex',
                        //     orderable: false,
                        //     searchable: false
                        // },
                        {
                            data: 'name',
                            name: 'payment_types.name',
                            orderable: false,
                        },
                        {
                            data: 'semester',
                            name: 'semester',
                            orderable: false,
                        },
                        {
                            data: 'installment',
                            name: 'installment',
                            orderable: false,
                        },
                        {
                            data: 'total',
                            name: 'total',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'discount',
                            name: 'discount',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'due_date',
                            name: 'due_date',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                        }
                    ],
                });
            });
        </script>
    @endpush
@endsection
