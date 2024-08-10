<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-size: 12px;
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
        طباعة ( {{ count($students) }} )
    </div>
    <h2>
        طلاب لديهم مهام غير مكتملة
    </h2>
    <table border="1">
        <tr>
            <td>رقم الطالب</td>
            <td> الاسم </td>
        </tr>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>
                <a href="{{ route('admin.student.dashboard',$student->id) }}">
                {{ $student->full_name }}
                </a>
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>