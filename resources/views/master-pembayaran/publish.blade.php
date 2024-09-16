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
                                <h4 class="card-title">Form Publish Tipe Pembayaran</h4>
                            </div>
                            <div class="card-body">
                                <p>Anda akan menerbitkan pembayaran dengan detail sebagai berikut:</p>

                                <ol class="list-group list-group-numbered">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">{{ str($data->name)->upper() }}</div>
                                            Nama tipe pembayaran
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">{{ number_format($data->nominal, 0, ',', '.') }}</div>
                                            Nominal
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">
                                                @php
                                                    $types = App\Helpers\JsonData::TypePayment();
                                                @endphp
                                                {{ str($types[$data->type])->upper() }}
                                            </div>
                                            Tipe pembayaran
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">
                                                {{ str($data->academic_year->full_year)->upper() }}
                                            </div>
                                            Tahun ajaran
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">{{ str($count . ' Mahasantri')->upper() }}</div>
                                            Jumlah Mahasantri terdampak
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">
                                                {{ str($data->published ? 'Penerbitan Ulang' : 'Penerbitan Perdana')->upper() }}
                                            </div>
                                            Status terbit
                                        </div>
                                    </li>
                                </ol>

                                    <p class="mt-4">Apakah Anda yakin ingin melakukan ini?</p>
                                        <input type="hidden" name="replace" value="0" form="publishing">

                                    <div class="form-check">
                                        <input class="form-check-input @error('agree') is-invalid @enderror" type="checkbox"
                                            value="1" id="agree" name="agree" form="publishing" />
                                        <label class="form-check-label" for="agree">
                                            Ya, saya yakin ingin melakukan ini. @error('agree') <span class="fw-bolder">(Harus dicentang)</span> @enderror
                                        </label>
                                    </div>

                                    @if ($data->published)
                                        <div class="form-check">
                                            <input class="form-check-input @error('replace') is-invalid @enderror"
                                                type="checkbox" value="1" id="replace" name="replace" form="publishing" />
                                            <label class="form-check-label" for="replace">
                                                Ya, saya sadar akan mengubah nilai bayaran pada seluruh mahasantri
                                                terdampak. <span class="fw-bolder text-primary">(Opsional)</span>
                                            </label>
                                        </div>
                                    @endif
                                    <div class="d-inline-flex gap-2 mt-3">
                                        <a href="{{ route('paymentType.index') }}" class="btn btn-primary">Batal</a>

                                        <form action="{{ route('paymentType.publishing', $data->id) }}"
                                            onsubmit="return confirm('Apakah Anda yakin?')" class="d-inline" method="POST" id="publishing">
                                            @csrf @method('PUT')
                                            <button type="submit" class="btn btn-default">Yakin</button>
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
        <script></script>
    @endpush
@endsection
