<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>مؤسسة دار الإتقان</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <div class="w-full min-h-screen flex flex-col sm:justify-center items-center  bg-gradient-to-t from-primary to-white">
        {{ $slot }}
    </div>
    <script src="/assets/js/alpine-persist.min.js"></script>
</body>

</html>