<?php 
	require './data/category.php';
 ?>

<form method="post" action="action.php">
	<div class="form-group">
		<label for="bookName">
			Введите название книги:
		</label>
		<input type="text" name="book" id='bookName' class="form-control">
	</div>
	<div class="form-group">
		<label for="author">
			Введите имя автора книги:
		</label>
		<input type="text" name="writer" id='author' class="form-control">
	</div>
	<div class="form-group">
		<label for="imgUrl">
			Введите ссылку на изображение:
		</label>
		<input type="text" id='imgUrl' name="src" class="form-control">
	</div>
	<div class="form-group">
		<label for="category">
			Выберите категорию
		</label>
		<select class="form-control" name="category" id="category">

		<?php foreach ($category as $key => $value): ?>
			<option value="<?=$value?>"><?=$value?></option>
		<?php endforeach ?>	

		</select>
	</div>
	 <input type="submit" class="btn btn-success">
</form>


