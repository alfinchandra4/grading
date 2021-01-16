<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Alumni</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Nim</th>
                <th>Jurusan</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @php
                $students = App\Models\Alumni::all();
            @endphp
            @foreach ($students as $std)
                <tr>
                    <td>{{ $std->name }}</td>
                    <td>{{ $std->nim }}</td>
                    <td>
                        @switch($std->major)
                            @case(1) Sistem informasi @break
                            @case(2) Informatika @break
                            @case(3) D3 Sistem Informasi @break
                        @endswitch
                    </td>
                    <td>{{ $std->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
