<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wilayahs Report</title>
    <style>
        /* Define your styles here */
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
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Wilayah</h1>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Area</th>
            </tr>
        </thead>
        <tbody>
            @foreach($wilayahs as $wilayah)
            <tr>
                <td>{{ $wilayah->code }}</td>
                <td>{{ $wilayah->name }}</td>
                <td>{{ $wilayah->area }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
