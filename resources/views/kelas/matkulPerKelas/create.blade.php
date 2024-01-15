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
                                <h4 class="card-title">Form Pembuatan Jadwal Mata Kuliah</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST" action="{{ route('kelas.matkulPerKelas.store', ["id"=> $data["class"]->id]) }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf

                                           <div class="row mb-4">
                                            <label class="col-md-3 form-label">Semester</label>
                                                <div class="col-md-9">
                                                <select class="form-control smester" name="smester" id="smester">
                                                    @foreach ($data['smester'] as $item)
                                                        <option value="{{$item}}">Semester {{$item}}</option>
                                                    @endforeach

                                                </select>
                                                </div>
                                            </div>
                                           <div class="row mb-4">
                                                <label class="col-md-3 form-label">Mata Kuliah</label>
                                                <div class="col-md-9">
                                                <select class="form-control select2-show-search required matkul" name="mata_kuliah_id" id="mata_kuliah_id">
                                                    <option value="">Pilih Salah Satu</option>
                                                    {{-- @foreach ($data["matkul"] as $item)
                                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                                    @endforeach --}}
                                                </select>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Dosen</label>
                                                <div class="col-md-9">
                                                <select class="form-control select2-show-search required" name="dosen_id" id="dosen_id">
                                                    <option value="">Pilih Salah Satu</option>
                                                    @foreach ($data["dosen"] as $item)
                                                        <option value="{{$item->id}}">{{$item->user->name}}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Hari</label>
                                                <div class="col-md-9">
                                                <select class="form-control required" name="day" id="day">
                                                    <option value="">Pilih Salah Satu</option>
                                                    @foreach ($data["days"] as $item)
                                                        <option value="{{$item}}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Jam Mata Kuliah</label>
                                                <div class="col-md-9">
                                                    <div class="input-daterange input-group" id="dateRange">
                                                        <input type="text" class="form-control" name="start_date" id="startDate" />
                                                        <span class="input-group-text">Sampai</span>
                                                        <input type="text" class="form-control" name="end_date" id="endDate" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="place">Tempat</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('place') is-invalid @enderror"
                                                        type="text" name="place" id="place"
                                                        value="{{ old('place') }}">
                                                    @error('place')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ route('kelas.index') }}"
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
        <script>
        //     $(function() {
        //         $('#dateRange').datetimepicker({
        //             datepicker:false,
        //             format:'H:i'
        //         });

        // // You can customize the format and options for timepicker as needed
        //     $('#startDate, #endDate').datetimepicker({
        //             dateFormat: '',
        //             datepicker:false,
        //             pickDate: false,
        //             format: "H:i",
        //             timeOnly:true
        //     });

        //         $('#tahun_ajaran').on('input', function() {
        //             var inputValue = $(this).val();
        //             var numericRegex = /^[0-9]+$/;

        //             if (!numericRegex.test(inputValue)) {
        //                 // Jika karakter yang dimasukkan bukan angka, hapus karakter terakhir
        //                 $(this).val(inputValue.slice(0, -1));
        //             }
        //         });
        //     });

        flatpickr("#startDate, #endDate", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
        });
        $("#smester").change(function(){
            var smester = $(this).val();
            $('.matkul').empty();
            $.ajax({
                url: '{{route("mata-kuliah.json")}}?smester='+smester,  // Ganti dengan URL endpoint Anda
                type: 'GET',  // Atur sesuai dengan metode yang dibutuhkan (GET, POST, dll.)
                success: function(response, xhr) {
                    $(".matkul").append('<option value="">Pilih Salah Satu</option>');
                    $.each(response, function(index, element) {
                        $(".matkul").append('<option value="' + element.id + '">' + element.nama + '</option>');
                    });
                }
            });
        })


        </script>
    @endpush
@endsection
