<?php 
	session_start();
    require './layout/head.php';
    $editFile = new SplFileObject('./data/srcopy.csv', 'r+');
    
	$editFile -> setFlags(SplFileObject::READ_CSV | 
						SplFileObject::READ_AHEAD | 
						SplFileObject::SKIP_EMPTY |
						SplFileObject::DROP_NEW_LINE);  //важно было добавить эту строчку - 
														// она позволяет удалять перенос строки при использовании fputcsv()
    $editBook = [];

    foreach ($editFile as $key => $value) {
        if($value[0] === $_GET['id']) {
            // echo "id = $value[0], author = $value[4], bookTitle = $value[3] and category = $value[6] <br>";
            // echo $_GET['id'] . '<br>';
            $editBook = [$value[0], $value[1], 'imgUrl' => $value[2], 'title' => $value[3], 'author' => $value[4], $value[5], 'category' => $value[6]];
            $currentIdx = $key-1; //дает индекс редактируемого элемента
            break;
        }
         
	}
    
	echo $currentIdx;
	
	if(filter_has_var(INPUT_POST, 'editSubmit')) {
		$editedFields = [
			'title' => $_POST['edit-book'],
			'author' => $_POST['edit-writer'],
			'imgUrl' => $_POST['edit-src'],
			'category' => $_POST['edit-category']
		];

		// var_dump(array_replace($editBook, $editedFields));
		$editFile->seek($currentIdx); //ставим указатель на необходимую строку
		// $editFile->current();
		//fputcsv() Форматирует строку в виде CSV и записывает её в файловый указатель
		$editFile->fputcsv(array_replace($editBook, $editedFields));


		$editFile = null;


		// $editedArr = array_replace($editBook, $editedFields);		

		// $list = [];
		// $list = file('./data/srcopy.csv') or die('Не открывается');
		// echo "currenIdx = $currentIdx  " . "$list[$currentIdx]" . '<br>';
		// unset($list[$currentIdx]);
		// $list[$currentIdx] = implode(',', $editedArr);

		// $fileUpdated = fopen('./data/srcopy.csv', 'r+');
		// flock($fileUpdated, LOCK_EX);
		// ftruncate($fileUpdated, 0);
		// foreach ($list as $key => $value) {
		// 	# code...
		// 	fwrite($fileUpdated, $value);
		// }
		// fclose($fileUpdated);

		//  var_dump($editFile -> current());

		// foreach ($editFile as $key => $value) {
		// 	// if($key === $currentIdx) {
		// 	// 	unset($value);
		// 	// }
		// }
	}
?>


<h1>EDITIng PAGE</h1>


<div class="container">
	<div class="row">
		<div class="col">
			<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
			<div class="form-group">
				<label for="bookName">
					Введите название книги:
				</label>
				<input type="text" name="edit-book" id='bookName' class="form-control" value='<?=$editedFields['title'] ?? $editBook['title']?>' placeholder='<?= $editBook['title']?>'>
			</div>
			<div class="form-group">
				<label for="author">
					Введите имя автора книги:
				</label>
				<input type="text" name="edit-writer" id='author' class="form-control" value='<?=$editedFields['author'] ?? $editBook['author']?>' placeholder='<?= $editBook['author']?>'>
			</div>
			<div class="form-group">
				<label for="imgUrl">
					Введите ссылку на изображение:
				</label>
				<input type="text" id='imgUrl' name="edit-src" class="form-control" value='<?=$editedFields['imgUrl'] ?? $editBook['imgUrl']?>' placeholder='<?= $editBook['imgUrl']?>'>
			</div>
			<div class="form-group">
				<label for="category">
					Введите категорию
				</label>
				<input type='text' class="form-control" name="edit-category" id="category" value='<?=$editedFields['category'] ?? $editBook['category']?>' placeholder='<?= $editBook['category']?>'>
			</div>
			<input type="submit" name='editSubmit' class="btn btn-success">
		</form>
		</div>
	</div>

	<a href="index.php" class="btn btn-success mt-4">Вернуться на главную</a>
</div>


<?php 
    require './layout/foot.php';
?>