@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <div class="row mt-5">
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form Pembuatan Tipe Pembayaran</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST" action="{{ isset($data['model']) ? route('paymentType.update', ["id" => $data['model']->id]) : route('paymentType.store') }}" class="form-horizontal"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="name">Nama</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('name') is-invalid @enderror"
                                                        type="input" name="name" id="name" autocomplete="off"
                                                        value="{{ isset($data['model']) ? $data['model']->name : ''}}">
                                                    @error('name')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>



                                            {{-- <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="smester">Smester</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('smester') is-invalid @enderror"
                                                        type="number" name="smester" id="smester"
                                                        value="{{ old('smester') }}">
                                                    @error('smester')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div> --}}

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Tipe Pembayaran</label>
                                                <div class="col-md-9">
                                                    <select class="form-control required" name="type" id="gender">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach ($data['payment_type'] as $key => $item)
                                                            <option value="{{$key}}" {{isset($data['model']) ? $data['model']->type == $key ? 'selected' :'' :''}}>{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Nominal</label>
                                                <div class="col-md-9">
                                                    <input type="input" class="form-control required numericInput" name="nominal" value="{{ isset($data['model']) ? $data['model']->nominal : ''}}"
                                                        id="nominal">
                                                </div>
                                            </div>

                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ route('paymentType.index') }}"
                                                        class="btn btn-secondary">Cancel</a>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTAINER CLOSED -->
    </div>

    @push('custom')
        <script>
            $(function() {
                $("#tahun_ajaran").datepicker({
                    format: "yyyy",
                    startView: "years",
                    minViewMode: "years",
                    autoclose: true
                });

                $('#tahun_ajaran').on('input', function() {
                    var inputValue = $(this).val();
                    var numericRegex = /^[0-9]+$/;

                    if (!numericRegex.test(inputValue)) {
                        // Jika karakter yang dimasukkan bukan angka, hapus karakter terakhir
                        $(this).val(inputValue.slice(0, -1));
                    }
                });
            });
        </script>
    @endpush
@endsection
