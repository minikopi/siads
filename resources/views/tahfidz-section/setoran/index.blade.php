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
                                <h3 class="card-title">Setoran</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('tahfidz.setoran.store') }}" method="post" class="form-horizontal">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="mahasantri_id" class="col-md-2 col-form-label">Nama Mahasantri</label>
                                        <div class="col-md-10">
                                            <select class="form-control select2 @error('mahasantri_id') is-invalid @enderror" name="mahasantri_id" id="mahasantri_id">
                                                <option value="">Pilih mahasantri</option>
                                                @foreach ($students as $mahasantri)
                                                    <option value="{{ $mahasantri->getKey() }}" @selected(old('mahasantri_id') == $mahasantri->getKey())>
                                                        {{ $mahasantri->nama_lengkap }} | {{ $mahasantri->nim }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('mahasantri_id')
                                                <div class="invalid-feedback" style="color: red;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="juz_number" class="col-md-2 col-form-label">Juz</label>
                                        <div class="col-md-10">
                                            <select class="form-control select2 @error('juz_number') is-invalid @enderror" name="juz_number" id="juz_number">
                                                @for ($i = 1; $i <= 35; $i++)
                                                    <option @selected(old('juz_number') == $i)>{{ $i }}</option>
                                                @endfor
                                            </select>
                                            @error('juz_number')
                                                <div class="invalid-feedback" style="color: red;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-primary offset-md-2">
                                        Mulai
                                    </button>


                                </form>
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
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
