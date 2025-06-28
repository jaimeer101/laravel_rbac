<!DOCTYPE html>
<html>
    @include("includes.layouts.app.head")
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper ">
            @include("includes.layouts.app.top-menu")
            @include("includes.layouts.app.side-menu")
            @yield('content')
            @include("includes.layouts.app.footer")
        </div>
        
    </body>
</html>