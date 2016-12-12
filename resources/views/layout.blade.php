<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <link href="{{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{URL::to('/')}}">
                    Laravel blog
                </a>
            </div>
            <div class="navbar-left">
                <ul class="nav navbar-nav ">
                    <li><a href="{{URL::to('/posledni-pokus-uz')}}">Page</a></li>
                    <li><a href="{{URL::to('/posts')}}">All posts</a></li>
                    <li><a href="{{URL::to('/category/undefined')}}">Undefined</a></li>
                    <li><a href="{{URL::to('/category/new_category')}}">New category</a></li>
                    <li><a href="{{URL::to('/archive/2016/09')}}">Archive</a></li>
                </ul>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav ">
                    @if(Auth::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{URL::to('/admin')}}" target="_blank">Admin</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{URL::to('/login')}}">Login</a></li>
                        <li><a href="{{URL::to('/register')}}">Register</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
        @yield('content')
    </body>
    <script src="{{ URL::asset('assets/js/app.min.js') }}"></script>
</html>
