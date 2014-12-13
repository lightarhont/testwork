<div class="mf">
    <div><h3>Редактировать отзыв:</h3></div>
    <form onsubmit="presubmit();" action="<?PHP echo $lang; ?>/manager/savepost" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>#<?PHP echo $review->id; ?></legend>
<label>Имя</label>
<input type="text" name="name" value="<?PHP echo $review->name; ?>" placeholder="Введите имя…">
<span class="help-block">Имя того кто оставил отзыв.</span>
<label>E-mail</label>
<input type="text" name="email" value="<?PHP echo $review->email; ?>" placeholder="Введите email…">
<span class="help-block">E-mail того кто оставил отзыв.</span>
<label>Содержимое</label>
<textarea id="editor" name="content"><?PHP echo $review->content; ?></textarea>
<span class="help-block">Отзыв</span>
<input type="hidden" name="id" value="<?PHP echo $review->id; ?>" />
<input type="submit" value="Сохранить" class="btn btn-primary">
<a href="<?PHP echo $lang; ?>/manager/index/created/desc" class="btn btn-inverse">Отмена</a>
        </fieldset>
    </form>
</div>