<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
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
    <h2>Tabel Data Famili</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Famili</th>
                <th>Nama Famili</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Familis as $famili)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $famili->code }}</td>
                    <td>{{ $famili->nama_famili }}</td>
                    <td>{{ $famili->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
