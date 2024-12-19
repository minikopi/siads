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
                                <h5>{{ $mahasantri->nama_lengkap }}</h5>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Juz</th>
                                                    <th>Halaman</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                    <th>Waktu</th>
                                                    <th>Verifikator</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($items as $item)
                                                    <tr class="text-center">
                                                        <td scope="row">
                                                            {{ $item->juz_number }}
                                                        </td>
                                                        <td>
                                                            {{ $item->page_number }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $status = 'danger';
                                                                if ($item->status === 'sah') {
                                                                    $status = 'success';
                                                                }
                                                            @endphp

                                                            <span class="text-{{ $status }}">
                                                                {{ str()->upper($item->status) }}
                                                            </span>

                                                        </td>
                                                        <td>
                                                            @if ($item->status === 'tidak sah')
                                                                <form
                                                                    action="{{ route('tahfidz.setoran.update', $mahasantri) }}"
                                                                    method="post">
                                                                    @csrf @method('PUT')
                                                                    <input type="hidden" name="juz_number"
                                                                        value="{{ $item->juz_number }}">
                                                                    <input type="hidden" name="page_number"
                                                                        value="{{ $item->page_number }}">
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-sm rounded-pill btn-wave"
                                                                        role="button"
                                                                        onclick="return confirm('Apakah yakin bahwa juz {{ $item->juz_number }} halaman {{ $item->page_number }} sudah tuntas?')">
                                                                        SAH
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item->status === 'sah')
                                                                {{ $item->updated_at->format('d F Y, H:i') }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item->status === 'sah')
                                                                {{ $item->dosen->user->name }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
@endsection
