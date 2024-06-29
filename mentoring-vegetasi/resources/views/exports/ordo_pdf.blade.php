<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Ordo</title>
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
