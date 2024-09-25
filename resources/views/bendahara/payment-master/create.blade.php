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
                                <h4 class="card-title">Form Pembuatan Poin Pembayaran Mahasantri -
                                    {{ $mahasantri->nama_lengkap }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST"
                                            action="{{ route('bendahara.master-payment.payment.store', $mahasantri) }}"
                                            class="form-horizontal">
                                            @csrf

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="payment_type_id">Nama
                                                    Pembayaran</label>
                                                <div class="col-md-9">
                                                    <select
                                                        class="form-control @error('payment_type_id') is-invalid @enderror"
                                                        name="payment_type_id" id="payment_type_id">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach ($payment_types as $payment)
                                                            <option value="{{ $payment->getKey() }}"
                                                                @selected(old('payment_type_id') == $payment->getKey())>{{ $payment->name }} - {{ number_format($payment->nominal, 0, ',', '.') }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('payment_type_id')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="semester">Semester</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('semester') is-invalid @enderror"
                                                        type="text" name="semester" id="semester" autocomplete="off"
                                                        value="{{ old('semester') }}">
                                                    @error('semester')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Cicilan</label>
                                                <div class="col-md-9">
                                                    <select class="form-control @error('installment') is-invalid @enderror"
                                                        name="installment" id="installment">
                                                        <option value="0">Tidak dicicil</option>
                                                        <option value="1">Dicicil</option>
                                                    </select>
                                                    @error('installment')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Nominal</label>
                                                <div class="col-md-9">
                                                    <input type="number"
                                                        class="form-control @error('total') is-invalid @enderror numericInput"
                                                        name="total" value="{{ old('total') }}" id="total">
                                                    @error('total')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Potongan</label>
                                                <div class="col-md-9">
                                                    <input type="number"
                                                        class="form-control @error('discount') is-invalid @enderror"
                                                        name="discount" value="{{ old('discount', 0) }}" id="discount">
                                                    @error('discount')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="due_date">Jatuh Tempo</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('due_date') is-invalid @enderror"
                                                        type="date" name="due_date" id="due_date" autocomplete="off"
                                                        value="{{ old('due_date') }}">
                                                    @error('due_date')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="note">Catatan</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control richText" name="note" id="note" rows="3">{{ old('note') }}</textarea>
                                                    @error('note')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ route('bendahara.master-payment.payment.index', $mahasantri) }}"
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
        <script src="{{ asset('plugins/wysiwyag/jquery.richtext.min.js') }}"></script>
        <script>
            $(function() {
                $('.richText').richText();
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


