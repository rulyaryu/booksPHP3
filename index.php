<?php 

	session_start();

	// $_SESSION['loginSuccess'] = false;
	// $_SESSION['user'] = 'noname';
	require 'layout/head.php';

	// require 'layout/registration.php';


	require 'layout/header.php';

	if(isset($_GET['auth']) && $_GET['auth'] == 'login') {
		require 'layout/authWidget.php';
	}
	if(isset($_GET['auth']) && $_GET['auth'] == 'signup') {
		require 'layout/registrWidget.php';
	} 

	// require 'layout/content.php';
	// require 'layout/content_ver2.php';
	
	if(isset($_SESSION['loginSuccess']) && $_SESSION['loginSuccess'] === 'success') {
		require 'layout/temp_content.php';
		require 'layout/pagination.php'; 
	}

	if(isset($_SESSION['adminSuccess']) && $_SESSION['adminSuccess'] === 'success') {
		// require 'layout/adminContent.php';
		require 'layout/temp_content.php';
		require 'layout/pagination.php'; 
	}


	require 'layout/foot.php';


	// require 'filter.php';

	// require 'model3.php';

	// require 'model4.php';

	// require 'model5.php';     

	// require 'getauthors.php';
 ?>

 