<?php 


// Fatal error: Cannot redeclare getLimitPage() (previously declared in E:\wamp64\www\helperfunc.php:3) in E:\wamp64\www\helperfunc.php on line 7

function getLimitPage($max, $booksOnPage) {
    return $max % $booksOnPage == 0 
                            ? intval($max / $booksOnPage)
		                    : 1 + intval($max / $booksOnPage);
}


?>