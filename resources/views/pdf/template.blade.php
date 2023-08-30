<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Generated PDF</title>
{{--    <style type="text/css" charset="utf-8">--}}
{{--        --}}{{--@font-face {--}}
{{--        --}}{{--    font-family: 'SF-Pro-Display';--}}
{{--        --}}{{--    src: url('{{ public_path('fonts/SF-Pro-Display-Regular.otf') }}');--}}
{{--        --}}{{--}--}}

{{--        body {--}}
{{--            font-family: 'glober', sans-serif;--}}
{{--        }--}}
{{--        th{--}}
{{--            font-family: 'glober', sans-serif;--}}
{{--        }--}}
{{--    </style>--}}
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Сумма</th>
                <th>Эмейл</th>
                <th>Телефон</th>
                <th>Фин</th>
                <th>Подробности</th>
            </tr>
        </thead>
        <tbody>
@foreach($data as $row)
    <tr>
        @foreach($row as $cell)
            <td>{{ $cell }}</td>
        @endforeach
    </tr>
    @endforeach
    </tbody>
    </table>
    </body>
    </html>
