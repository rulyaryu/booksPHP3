<?php 

    require_once 'helperfunc.php';


	$booksOnPage = 30;

	if(isset($_GET['q'])) {
		echo 'what we found by query "' . $_GET['q'] . '" <br>'; 
	}

	if(isset($_GET['cat']) && $_GET['cat'] !== 'All') {

        $cat = $_GET['cat'];
        
			$count = 0;
			$catlen = strlen($cat) * (-1) - 2;
			$src = new SplFileObject('data/srcopy.csv');
			while($src->valid()) {
			$tmp = str_getcsv($src-> current());
			if(isset($tmp[6]) && (strrpos($tmp[6], $cat) !== false)) { 
				$count++;
			}
			$src->next();
		}

		echo $count . '   ';
    }
    
	$src = new SplFileObject('data/srcopy.csv');

	$src->seek(PHP_INT_MAX);

	$max = $src->key()-1;
	
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}

	// isset($_GET['page']) ? $page = $_GET['page'] : $page = 6919;

	$lastIdx = $page * $booksOnPage;
	$startIdx = ($lastIdx - $booksOnPage); // fixed bug - need 0 index to start from 1st line of csv file
	$booksIdx = array_fill($startIdx, $booksOnPage, '');

	$booksDataArr = [];
	
	$arrayKeys = ['id', 'imgId', 'imgUrl', 'bookName', 'author', 'catId', 'category'];

	$categoryArr = [];
	$authorsArr = [];

	if(isset($_GET['q'])) {
		$src->rewind();
		while($src->valid()) {
			$tmp = str_getcsv($src-> current());
			if(isset($tmp[4]) && (strripos($tmp[4], urldecode($_GET['q'])) !== false)) {
				// echo $tmp . '<br>';
				$authorsArr[] = array_combine($arrayKeys, $tmp);
			}
			$src->next();
			$booksDataArr = array_slice($authorsArr, $startIdx - 1, $booksOnPage); 
		}

		$max = count($authorsArr);
		if($max == 0) echo 'No books founded' . '<br>';
        $limitPage = getLimitPage($max, $booksOnPage);

	} elseif(isset($cat)) {
		$src->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);
	
		foreach ($src as $key => $value) {
			if(count($categoryArr) == $startIdx + $booksOnPage) {
				break; // end here
			}
			if  (end($value) == $cat) {
				$categoryArr[] = array_combine($arrayKeys, $value);
			}
		}

        $booksDataArr = array_slice($categoryArr, $startIdx, $booksOnPage);
        
		$max = $count - 1; 

        $limitPage = getLimitPage($max, $booksOnPage);

		echo $max % $booksOnPage . '  ';
		echo $limitPage;


	} else {

		foreach ($booksIdx as $idx => $val) {
				$src->seek($idx);
				if (count(str_getcsv($src->current())) == 7) {
					$booksDataArr[] = array_combine($arrayKeys,str_getcsv($src->current()) );
				}
				$src->next();
		}

			$limitPage = getLimitPage($max, $booksOnPage);
	}	

	$src = null;

	$booksChunkedArr = array_chunk($booksDataArr, 3);

 ?>


 <!-- 1-30 31-60 -->