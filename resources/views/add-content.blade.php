@extends('layouts.site')

@section('content')

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="form">
                <!-- Comment-->

                <form method="POST" action="{{route('articleStore')}}">
                    <div class="form-group">
                        <label for="name">Заголовок</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Заголовок">
                    </div>

                    <div class="form-group">
                        <label for="brief">Описание</label>
                        <textarea class="form-control" id="brief" name="brief"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="img">Ссылка на изображение(не обязательно)</label>
                        <input type="text" class="form-control" id="img" name="img" placeholder="Ссылка">
                    </div>

                    <div class="form-group">
                        <label for="content">Содержимое</label>
                        <textarea class="form-control" id="content" name="content"></textarea>
                    </div>


                    <button type="submit" class="btn btn-default">Submit</button>

                    {{ csrf_field() }}

                </form>


            </div>
        </div>

        <hr>

        <footer>
            <p>&copy; 2017 Company, Inc.</p>
        </footer>
    </div> <!-- /container -->

@endsection