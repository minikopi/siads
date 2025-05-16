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
                                <h4 class="card-title">Form Pembuatan Data Tipe Pembayaran</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST" action="{{ route('paymentType.store') }}" class="form-horizontal">
                                            @csrf

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="academic_year_id">Tahun Ajaran</label>
                                                <div class="col-md-9">
                                                    <select class="form-control @error('academic_year_id') is-invalid @enderror" name="academic_year_id" id="academic_year_id">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach ($data['academic_years'] as $item)
                                                            <option value="{{ $item->getKey() }}" @selected(old('academic_year_id') == $item->getKey())>{{ $item->full_year }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('academic_year_id')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="name">Nama</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('name') is-invalid @enderror"
                                                        type="text" name="name" id="name" autocomplete="off"
                                                        value="{{ old('name') }}">
                                                    @error('name')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Tipe Pembayaran</label>
                                                <div class="col-md-9">
                                                    <select class="form-control @error('type') is-invalid @enderror" name="type" id="type">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach ($data['payment_type'] as $key => $item)
                                                            <option value="{{$key}}" @selected(old('type') == $key)>{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('type')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Nominal</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control @error('nominal') is-invalid @enderror numericInput" name="nominal" value="{{ old('nominal') }}"
                                                        id="nominal">
                                                    @error('nominal')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Jatuh Tempo</label>
                                                <div class="col-md-9">
                                                    <input type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date') }}"
                                                        id="due_date">
                                                    @error('due_date')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                    <a href="{{ route('paymentType.index') }}"
                                                        class="btn btn-sm btn-secondary">Cancel</a>
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
