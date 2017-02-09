<form action="{{ route('articleDestroy') }}" method="post">

    <!--<input type="hidden" name="_method" value="DELETE">-->



    {{ csrf_field() }}

    <p>
        <b>Вы действительно хотите удалить статью?</b>
    </p>
    <p><input name="del" type="radio" value="true">Да</p>
    <p><input name="del" type="radio" value="false">Нет</p>
    <input type="hidden" name="art" value="{{ $article }}">
    <p><input type="submit" value="Выбрать"></p>


</form>