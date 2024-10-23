<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Hasil Studi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            font-size: 12px;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('images/logo-khs.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.3;
            z-index: -1;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 150px;
        }

        .details {
            width: 100%;
            margin: 0 auto;
            padding-bottom: 10px;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .details td {
            padding: 3px;
            vertical-align: top;
        }

        .details .left-column {
            width: 50%;
            text-align: left;
        }

        .details .right-column {
            width: 50%;
            text-align: left;
        }

        .details .strong-text {
            font-weight: bold;
        }

        .details .colon {
            width: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            padding: 8px;
            border: 1px solid #000;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer {
            position: absolute;
            bottom: 0;
            right: 0;
            margin-right: 20px;
            margin-bottom: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('images/logo-khs.png') }}" alt="Logo Darsun">
            <h3>KARTU HASIL STUDI</h3>
        </div>
        <div class="details">
            <table>
                <tr>
                    <td class="left-column">
                        <table>
                            <tr>
                                <td class="strong-text">NAMA</td>
                                <td class="colon">:</td>
                                <td>{{ $nama }}</td>
                            </tr>
                            <tr>
                                <td class="strong-text">NIM</td>
                                <td class="colon">:</td>
                                <td>{{ $nim }}</td>
                            </tr>
                            <tr>
                                <td class="strong-text">ANGKATAN</td>
                                <td class="colon">:</td>
                                <td>{{ $angkatan }}</td>
                            </tr>
                        </table>
                    </td>
                    <td class="right-column">
                        <table>
                            <tr>
                                <td class="strong-text">SEMESTER</td>
                                <td class="colon">:</td>
                                <td>{{ $semester }}</td>
                            </tr>
                            <tr>
                                <td class="strong-text">TAHUN AKADEMIK</td>
                                <td class="colon">:</td>
                                <td>{{ $tahun_akademik }}</td>
                            </tr>
                            <tr>
                                <td class="strong-text">MUSYRIF PA</td>
                                <td class="colon">:</td>
                                <td>{{ $musyrif_pa?->user->name ?? '-' }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <table class="table" style="width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Nilai</th>
                    <th>Huruf</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($score as $index => $item)
                    @php
                        $total_sks += $item->mata_kuliah->sks;
                        $nilai = count($item->score) > 0 ? ($item->score[0]->akademik * 60) / 100 + ($item->score[0]->non_akademik * 40) / 100 : 0;
                        if ($nilai > 80) {
                            $grade = 'A';
                        } elseif ($nilai > 70) {
                            $grade = 'B';
                        } elseif ($nilai > 60) {
                            $grade = 'C';
                        } elseif ($nilai > 50) {
                            $grade = 'D';
                        } else {
                            $grade = 'E';
                        }
                    @endphp
                    <tr style="text-align: center">
                        <td><strong>{{ $index + 1 }}</strong></td>
                        <td>{{ $item->mata_kuliah->kode }}</td>
                        <td>{{ $item->mata_kuliah->nama }}</td>
                        <td>{{ $item->mata_kuliah->sks }}</td>
                        <td>{{ $item->score[0]->akademik ?? '-' }}</td>
                        <td>{{ $grade }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Jumlah SKS</strong></td>
                    <td colspan="4"><strong>{{ $total_sks }}</strong></td>
                </tr>
            </tbody>
        </table>
        <div class="footer">
            <p>Jakarta, {{ Carbon\Carbon::parse(now())->locale('id_ID')->translatedFormat('d F Y') }}<br>Waka Akademik</p>
            <br><br>
            <br><br>
            <p style="text-decoration: underline;">Amien Nurhakim, Lc., MA.</p>
        </div>
    </div>
</body>

</html>
