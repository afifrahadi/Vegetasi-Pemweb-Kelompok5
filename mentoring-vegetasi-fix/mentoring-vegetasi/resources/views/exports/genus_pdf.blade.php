<!DOCTYPE html>
<html>
<head>
    <title>Genus Data PDF</title>
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
    <h2>Tabel Data Genus</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Genus</th>
                <th>Nama Genus</th>
                <th>Deskripsi</th>
                <th>Famili</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($genus as $index => $gen)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $gen->code }}</td>
                    <td>{{ $gen->nama_genus }}</td>
                    <td>{{ $gen->deskripsi }}</td>
                    <td>{{ $gen->familis->nama_famili }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
