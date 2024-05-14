<!DOCTYPE html>
<html>

<head>
    <title>Jadwal Perkuliahan</title>
    <style>
        /* Table styles for clean presentation in PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Jadwal Perkuliahan - Semester {{ $data }}</h1>

    <table>
        <thead>
            <tr>
                <th>Hari</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Jam</th>
                <th>Ruang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwal as $j)
                <tr>
                    <td>{{ $j['hari'] }}</td>
                    <td>{{ $j['mata_kuliah'] }}</td>
                    <td>{{ $j['dosen'] }}</td>
                    <td>{{ $j['jam'] }}</td>
                    <td>{{ $j['ruang'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada jadwal perkuliahan tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
