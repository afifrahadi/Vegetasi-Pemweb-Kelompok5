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
            background-color: #2E8B57;
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
    <h2>Tabel Data Kelas</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Kelas</th>
                <th>Nama Kelas</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classis as $kelas)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kelas->code }}</td>
                <td>{{ $kelas->name }}</td>
                <td>{{ $kelas->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
