<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vegetasi Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4682B4;
            color: white;
            text-align: center
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Tabel Data Vegetasi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Vegetasi</th>
                <th>Nama Vegetasi</th>
                <th>Kode Warna</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vegetasis as $vegetasi)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td>{{ $vegetasi->code }}</td>
                <td>{{ $vegetasi->nama_vegetasi }}</td>
                <td>{{ $vegetasi->hex_code }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
