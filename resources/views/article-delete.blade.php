<form action="{{ route('articleDestroy') }}" method="post">

    <!--<input type="hidden" name="_method" value="DELETE">-->


    {{ csrf_field() }}

    <p>
        <b>Вы действительно хотите удалить статью?</b>
    </p>
    <p>
        <input name="del" type="radio" id="true" value="true">
        <label for="true">Да</label>

    </p>
    <p>
        <input name="del" type="radio" id="false" value="false">
        <label for="false">Нет</label>

    </p>
    <input type="hidden" name="art" value="{{ $article }}">
    <p><input type="submit" value="Выбрать"></p>


</form>