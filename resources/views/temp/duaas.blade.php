<!DOCTYPE html>
<html lang="ar" dir="rtl">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-size: 12px;
            text-align: right;
        }

        .btn-print {
            border-radius: 5px;
            width: 100px;
            border: 3px solid #ccc;
            padding: 5px;
            margin: 5px;
            font-size: 16px;
        }

        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="btn-print" onclick="window.print()">
        طباعة ( {{ count($duaas) }} )
    </div>
    <h2>
        الادعية والمتون
    </h2>
    <table border="1">

        @foreach($duaas as $duaa)
        <tr>
            <td>{{ $duaa->title }}</td>
            <td>{{ $duaa->content }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>