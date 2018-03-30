<?php 
	   $fp = fopen('out/newSrc.csv', 'a') or die('something goes wrong!');

	   $csvstr[] =  $_POST['book'];
	   $csvstr[] =  $_POST['writer'];
	   $csvstr[] =  $_POST['src'];
	   $csvstr[] =  $_POST['category'];

	   fputcsv($fp, $csvstr);
	   fclose($fp);


	   //вывод информации через echo не дает выполнить redirect  
	   // echo 'this line added to csv file : <br>'; 
	   // echo $_POST['book'] . ', ' . $_POST['writer'] . ', ' . $_POST['src'] . ', ' . $_POST['category'] . '<br>';

	   header( 'Location: /', true, 307 );
 ?>

