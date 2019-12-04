<!DOCTYPE html>
    <html lang='ja'>
    <head>
        <meta charset='UTF-8'>
        <title>@yield('title') | POS</title>
        <link rel='stylesheet' href='/css/app.css'>
        @yield('stylesheet')
    </head>
    <body>
        <div id="header"><a href="{{ route('top') }}">TOP</a></div>
        <div id="main">
            @yield('content')
        </div>
    </body>
</html>
