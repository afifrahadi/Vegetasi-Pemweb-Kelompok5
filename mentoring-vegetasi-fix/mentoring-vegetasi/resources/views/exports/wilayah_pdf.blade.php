<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wilayahs Report</title>
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
    <h2>Tabel Data Wilayah</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Wilayah</th>
                <th>Nama Wilayah</th>
                <th>Luas Wilayah (km²)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($wilayahs as $wilayah)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td>{{ $wilayah->code }}</td>
                <td>{{ $wilayah->name }}</td>
                <td>{{ $wilayah->area }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
