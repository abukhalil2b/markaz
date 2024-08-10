<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .body{
            padding-top: 3%;
            text-align: center;
            display: flex;
            justify-content: center;
        }
        .ayats{
            padding: 3px;
            border: 5px dotted black;
            width: 450px;
            word-wrap: break-word;
        }
        .aya{
            padding: 1px;
           
        }
        .number{
            background-color: #c4c4c4;
            border-radius: 50%;
        }
    </style>
</head>

<body class="body">
    <div class="ayats">
        @foreach($ayats as $key =>  $ayat)
        <span class="aya">
        {{ $ayat->content }} <span class="number">
        ({{$key+1}})
        </span>
        </span>
        @endforeach
    </div>

</body>

</html>