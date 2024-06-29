<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Ordo</title>
    <style>
        /* Define your styles here */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Tabel Data Ordo</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Ordo</th>
                <th>Nama Ordo</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordos as $key => $ordo)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $ordo->code }}</td>
                    <td>{{ $ordo->nama_ordo }}</td>
                    <td>{{ $ordo->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
