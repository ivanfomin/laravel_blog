<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>{{ $header }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jumbotron.css') }}" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">



    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>


</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">{{ $header }}</a>
        </div>
        <ul id="navbar" class="menu">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('articles')}}">Articles</a></li>
            <li><a href="{{route('articleShow',array('id'=>1))}}">Article</a></li>
            <li><a href="https://github.com/ivanfomin/laravel_blog">GitHub</a></li>
            @if (Auth::guest())
                <li><a href="{{ url('/login') }} " style="color: #0d3625">Login</a></li>
                <li><a href="{{ url('/register') }}" style="color: #0d3625">Register</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: black"
                    >
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="color: black"
                            >
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif

        </ul><!--/.navbar-collapse -->
    </div>
</nav>

@if(count($errors) > 0)

    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<br>

@yield('content')

<script src="/js/app.js"></script>


</body>
</html>
