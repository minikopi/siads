<div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown"
        aria-expanded="false">
        Opsi
    </button>
    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        <li><a class="dropdown-item" href="{{ route('absent.AbsentAdmin', $data) }}">Presensi Siswa</a></li>
        <li><a class="dropdown-item" href="{{ route('score.AbsentAdmin', $data) }}">Penilaian Siswa</a></li>
    </ul>
</div>
