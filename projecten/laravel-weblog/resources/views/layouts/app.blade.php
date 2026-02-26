<!DOCTYPE html>
<html>

<head>
    <title>App Name - @yield('title')</title>
    <link rel="stylesheet" href="<?= asset('style.css') ?>" type="text/css">
</head>

<body class="center">
    <div>
        @include('partials.nav')
        @yield('content')
    </div>
</body>

</html>