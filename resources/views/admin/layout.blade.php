<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.inc.style')
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('admin.inc.navbar')
           
           
                @include('admin.inc.sidebar')
                @yield('content')
          
        </div>
    </div>
    @include('admin.inc.script')
</body>

</html>