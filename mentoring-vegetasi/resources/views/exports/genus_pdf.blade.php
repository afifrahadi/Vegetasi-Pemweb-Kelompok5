<!DOCTYPE html>
<html>
<head>
    <title>Genus Data PDF</title>
    <style>
        /* Tambahkan styling CSS sesuai kebutuhan */
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
    <h2>Data Genus</h2>
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
