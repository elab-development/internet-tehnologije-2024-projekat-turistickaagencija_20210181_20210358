<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrangements PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Arrangements List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Destination</th>
                <th>Price</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
                @foreach($arrangements as $arrangement)
            <tr>
                <td>{{ $arrangement->id }}</td>
                <td>{{ $arrangement->name }}</td>
                <td>{{ $arrangement->destination->name ?? 'N/A' }}</td> <!-- Ako destination nije null, prikazuje se name -->
                <td>{{ $arrangement->price }}</td>
                <td>{{ $arrangement->date }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>