@extends('layouts.site')

@section('content')

    <div class="col-md-9">

        <div class="">
            <h2>Редактирование материала</h2>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form method="post" action="{{ route('articleUpdate') }}">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $article->id }}">


            <div class="form-group">
                <label for="name">Заголовок</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $article->name }}" placeholder="Заголовок">
            </div>

            <div class="form-group">
                <label for="brief">Описание</label>
                <textarea class="form-control" id="brief"
                          name="brief">{{ $article->brief }}</textarea>
            </div>

            <div class="form-group">
                <label for="img">Ссылка на изображение(не обязательно)</label>
                <input type="text" class="form-control" id="img" name="img" value="{{ $article->img }}"
                       placeholder="Ссылка">
            </div>

            <div class="form-group">
                <label for="content">Содержимое</label>
                <textarea class="form-control" id="content" name="content"
                >{{ $article->content }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>

            {{ csrf_field() }}

        </form>
    </div>
@endsection
