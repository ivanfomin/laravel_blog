@extends('layouts.site')

@section('content')

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">


        @foreach($articles as $article)
                <div class="col-md-12">
                    <h2>{{ $article->name }}</h2>

                    <p> {!! $article->brief !!}</p>
                    <p><a class="btn btn-primary btn-lg" href="{{ route('articleShow', ['id'=>$article->id]) }}" role="button">Подробнее &raquo;</a></p>
                    <p>
                    @if( $user->id == $article->user_id)
                    <form action="{{ route('articleDelete', ['article' => $article->id]) }}" method="post">

                        <!--<input type="hidden" name="_method" value="DELETE">-->


                        {{ method_field('DELETE') }}

                        {{ csrf_field() }}

                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>

                    </form>
                    @endif
                    </p>
                <hr>

                </div>
            @endforeach

        </div>


        <hr>

        <div>
            <p><a class="btn btn-info" href="{{ route('addArticle') }}" role="button"> Добавить статью&raquo;</a></p>
        </div>

        <footer>
            <p>&copy; 2017 Company, Inc.</p>
        </footer>
    </div> <!-- /container -->

@endsection