<!-- header & grobal navi -->
<header style="position: fixed; heigth:30px; width:100%; z-index: 1;">
<nav class="navbar navbar-default" style="background-color: #FFFFFF;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('top') }}">
                POS
            </a>
        </div>
            
        <div class="collapse navbar-collapse" id="navbarEexample2">
            <ul class="nav navbar-nav">
                <li><a href="#">> @yield('subtitle')</a></li>
            </ul>
        </div>
    </div>
</nav>
</header>