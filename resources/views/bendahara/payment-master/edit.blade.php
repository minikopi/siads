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
                                <h4 class="card-title">
                                    Form Pengubahan Poin Pembayaran Mahasantri -
                                    {{ $mahasantri->nama_lengkap }}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST"
                                            action="{{ route('bendahara.master-payment.payment.update', [$mahasantri, $payment]) }}"
                                            class="form-horizontal">
                                            @csrf @method('PUT')

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="payment_type_id">Nama
                                                    Pembayaran</label>
                                                <div class="col-md-9">
                                                    <select
                                                        class="form-control @error('payment_type_id') is-invalid @enderror"
                                                        name="payment_type_id" id="payment_type_id">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach ($payment_types as $type)
                                                            <option value="{{ $type->getKey() }}"
                                                                @selected(old('payment_type_id', $payment->payment_type_id) == $type->getKey())>{{ $type->name }} -
                                                                {{ number_format($type->nominal, 0, ',', '.') }}</option>
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
                                                        value="{{ old('semester', $payment->semester) }}">
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
                                                        name="total" value="{{ old('total', $payment->total) }}"
                                                        id="total">
                                                    <div class="text-small text-secondary">
                                                        Telah terbayar sebesar {{ number_format($payment->paid, 0, ',', '.') }}
                                                    </div>
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
                                                        name="discount"
                                                        value="{{ old('discount', $payment->discount, 0) }}"
                                                        id="discount">
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
                                                        value="{{ old('due_date', $payment->due_date->translatedFormat('Y-m-d')) }}">
                                                    @error('due_date')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="note">Catatan</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control richText" name="note" id="note" rows="3">{{ old('note', $payment->note) }}</textarea>
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
            });
        </script>
    @endpush
@endsection
