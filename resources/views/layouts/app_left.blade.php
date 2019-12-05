<!DOCTYPE html>
    <html lang='ja'>
    <head>
        <meta charset='UTF-8'>
        <title>@yield('title') | POS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel='stylesheet' href='/css/app.css' media="screen">
        @yield('stylesheet')
    </head>
    <body>
        <!-- ヘッダー -->
        @include('layouts.header')

        <div class="container">
 
            <div class="row" id="content">
                <div class="col-md-3">
                    <!-- サイドバー -->
                    @include('layouts.sidebar')
                </div>
                <div class="col-md-9" style="margin-top:70px;">
                    <!-- コンテンツ -->
                    @yield('content')
                </div>
            </div>

        </div>

        <!-- フッター -->
        @include('layouts.footer')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </body>
</html>
