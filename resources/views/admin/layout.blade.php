<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <link href="{{ URL::asset('/') }}assets/css/app.min.css" rel="stylesheet" type="text/css">
    <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{URL::to('/admin')}}">
                    Laravel admin
                </a>
            </div>
        </div>
    </nav>
    <style>
        .sidebar {
            position: fixed;
            top: 51px;
            bottom: 0;
            left: 0;
            z-index: 1000;
            display: block;
            padding: 20px;
            overflow-x: hidden;
            overflow-y: auto;
            background-color: #f5f5f5;
            border-right: 1px solid #eee;
        }
        .nav-sidebar {
            margin-right: -21px;
            margin-bottom: 20px;
            margin-left: -20px;
        }
        .nav-sidebar > .active > a, .nav-sidebar > .active > a:hover, .nav-sidebar > .active > a:focus {
            color: #fff;
            background-color: #428bca;
        }
    </style>
    <div class="container-fluid">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="{{URL::to('/admin/posts')}}">Posts</a></li>
                <li><a href="{{URL::to('/admin/pages')}}">Pages</a></li>
                <li><a href="{{URL::to('/admin/categories')}}">Categories</a></li>
                <li><a href="{{URL::to('/admin/comments')}}">Comments</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        @yield('content')
        </div>
    </div>
    </body>
    <script src="{{ URL::asset('/') }}assets/js/app.min.js"></script>
</html>
