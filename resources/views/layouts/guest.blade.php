<!DOCTYPE html>
<html>
    @include("includes.layouts.app.head")
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="/">
                    <b>Laravel</b>RBAC
                </a>
            </div>
            @yield('content')
        </div>
        
    </body>
</html>