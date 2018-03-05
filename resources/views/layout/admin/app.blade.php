<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('main.site_title') }}</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    @include('inc.admin.navbar.navbar')
    <div class="container">
        @include('inc.messages')
        @yield('content')
    </div>
<footer id="footer" class="text-center">
    <p>&copy; <?=date('Y')?></p>
</footer>
</body>
</html>