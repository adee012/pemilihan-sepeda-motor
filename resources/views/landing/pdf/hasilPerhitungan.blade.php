<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid gray;
            padding: 5px;
            text-align: center;
        }

        h1,
        h2 {
            text-align: center;
        }

        .rekomendasi {
            background-color: #d1fae5;
            border: 1px solid #34d399;
            padding: 10px;
            margin-top: 20px;
        }

        .rekomendasi p {
            margin: 5px 0;
        }

        .rekomendasi .title {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2>Hasil Perhitungan </h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Sepeda Motor</th>
                <th>Nilai S</th>
                <th>Nilai R</th>
                <th>Nilai Q</th>
                <th>Peringkat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilaiQ as $index => $hasil)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $hasil['alternatif'] }}</td>
                    <td>{{ number_format($nilaiS[$index]['total_s'], 4) }}</td>
                    <td>{{ number_format($nilaiR[$index]['nilai_r'], 4) }}</td>
                    <td>{{ number_format($hasil['nilai_q'], 4) }}</td>
                    <td><strong>{{ $hasil['rank'] }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="rekomendasi">
        <p class="title">Rekomendasi Terbaik:</p>
        <p>Berdasarkan analisis menggunakan metode VIKOR, <strong>{{ $nilaiQ[0]['alternatif'] }}</strong> menjadi
            pilihan terbaik dengan nilai indeks {{ number_format($nilaiQ[0]['nilai_q'], 4) }}. Sepeda motor ini
            merupakan rekomendasi utama untuk pembelian, mempertimbangkan berbagai kriteria yang telah ditetapkan.</p>
    </div>
</body>

</html>
