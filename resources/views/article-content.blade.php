@extends('layouts.site')


@section('content')
    <!-- Main jumbotron for a primary marketing message or call to action -->


    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            @if($article)
                <h2>{{ $article->name }}</h2>
                <h3>{!! $article->brief !!}</h3>
                <img src="{!! $article->img  !!} " align="middle"></img>
                <hr align="center" color="blue" width="480px">

                <div class="jumbotron">
                    <div class="container">
                        <p> {!! $article->content !!}</p>
                    </div>
                </div>
                <p><a class="btn btn-default" href="{{ route('articles') }}" role="button"> Назад &raquo;</a></p>
            @endif
        </div>
        <hr>

        <footer>
            <p>&copy; 2017 Company, Inc.</p>
        </footer>
    </div> <!-- /container -->

@endsection