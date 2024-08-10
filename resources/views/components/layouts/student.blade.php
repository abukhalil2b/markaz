<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.2.0-dist/css/bootstrap.rtl.min.css') }}" />
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>


    <title>student</title>
</head>

<body class="h-screen">

    <div x-data="{ show:false }">
        <div x-cloak x-show="show" class="bg-white w-full h-screen fixed shadow z-10">
            @include('layouts._student_sidebar')
        </div>
        <div @click="show = ! show " class="float-button">
            <div x-text=" show ? 'غلق' : 'انتقال' "></div>
        </div>
    </div>

    {{ $slot }}

</body>

</html>