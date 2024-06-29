<!DOCTYPE html>
<html>
<head>
    <style>
        /* Tambahkan styling CSS di sini sesuai kebutuhan */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Tabel Data Spesies</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Spesies</th>
                <th>Nama Spesies</th>
                <th>Tinggi (m)</th>
                <th>Diameter (cm)</th>
                <th>Warna Daun</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($spesies as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->nama_spesies }}</td>
                <td>{{ $item->tinggi }}</td>
                <td>{{ $item->diameter }}</td>
                <td>{{ $item->warna_daun }}</td>
                <td>{{ $item->latitude }}</td>
                <td>{{ $item->longitude }}</td>
                <td>{{ $item->deskripsi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
