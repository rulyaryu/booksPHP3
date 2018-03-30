<?php 
	session_start();
    require './layout/head.php';
    $editFile = new SplFileObject('./data/srcopy.csv', 'r+');
    
	$editFile -> setFlags(SplFileObject::READ_CSV | 
						SplFileObject::READ_AHEAD | 
						SplFileObject::SKIP_EMPTY |
						SplFileObject::DROP_NEW_LINE);  //важно было добавить эту строчку - 
                                                        // она позволяет удалять перенос строки 
                                                        // при использовании fputcsv()
    $deleteBook = [];

    foreach ($editFile as $key => $value) {
        if($value[0] === $_GET['id']) {
            // echo "id = $value[0], author = $value[4], bookTitle = $value[3] and category = $value[6] <br>";
            // echo $_GET['id'] . '<br>';
            $deleteBook = [$value[0], $value[1], 'imgUrl' => $value[2], 'title' => $value[3], 'author' => $value[4], $value[5], 'category' => $value[6]];
            $currentIdx = $key; //дает индекс редактируемого элемента..
                                // разный при удалении и редактировании, 
                                // так как при удалении из $list массива индексом будет номер строки, 
                                // который начинается с 1 
            break;
        }
         
	}
	
	if(filter_has_var(INPUT_POST, 'deleteSubmit')) {

		$editFile = null;		

		$list = [];
        $list = file('./data/srcopy.csv') or die('Не открывается');
        
		unset($list[$currentIdx]);

		$fileUpdated = fopen('./data/srcopy.csv', 'r+');
		flock($fileUpdated, LOCK_EX);
		ftruncate($fileUpdated, 0);
		foreach ($list as $key => $value) {
			fwrite($fileUpdated, $value);
		}
		fclose($fileUpdated);
	}
?>



<div class="container">
	<div class="row">
		<div class="col">
			<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
            
            
                <div class="alert alert-warning">
                    <h3>Вы уверены что хотите удалить эту книгу?</h3>
                    <div class="card">
						<img src="<?= $deleteBook['imgUrl'] ?>" alt="<?= $deleteBook['title']?>" class="card-img-top">
						<div class="card-body">
							<h5 class="card-title"><?= $deleteBook['title']?></h5>
							<p class="card-subtitle"><?= $deleteBook['author']?></p>
						</div>
						<div class="card-footer text-muted">
                            <p><?= $deleteBook['category']?></p>
                        </div>
					</div>
                </div>



			<input type="submit" name='deleteSubmit' class="btn btn-success" value="Delete">
		</form>
		</div>
	</div>

	<a href="index.php" class="btn btn-success mt-4">Вернуться на главную</a>
</div>


<?php 
    require './layout/foot.php';
?>