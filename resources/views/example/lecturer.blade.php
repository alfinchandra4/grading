<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Dosen</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>NIDN</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @php
                $lecturer = App\Models\Lecturer::all();
            @endphp
            @foreach ($lecturer as $lec)
                <tr>
                    <td>{{ $lec->name }}</td>
                    <td>{{ $lec->nidn }}</td>
                    <td>{{ $lec->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
