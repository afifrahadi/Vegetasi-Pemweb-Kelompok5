<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        /* Define your styles here */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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
