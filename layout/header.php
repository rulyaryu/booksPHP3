<?php require './data/category.php';	
		$user = $_SESSION['user'] ?? 'noname';
?>


<div class="container-fluid bg-dark">
	<div class="container">
		<nav class="nav d-flex justify-content-around pt-4 pb-4">
			<li class="nav-item">
				<form class="d-flex" method='get'>
				    <input type="search" id="mySearch" list='authorslist' name="q" class="mr-4">
						<datalist id='authorslist'>
						</datalist>
				    <button class="btn btn-success authorsearch" type='submit'>	Search
				    </button>
				</form>
			</li>
			<li class="nav-item">
				<div class="dropdown show">
					  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <?php echo isset($_GET['cat']) ? $_GET['cat'] : 'выберите категорию' ?>
					  </a>

					  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					  	<a class="dropdown-item" href="index.php?cat=All">All</a>
					    <?php foreach ($category as $value): ?>
					    	<a class="dropdown-item" href="index.php?cat=<?=urlencode($value)?>"><?=$value?></a>
					    <?php endforeach ?>
					  </div>
					</div>
			</li>

			<!-- <li class="nav-item">
					<?php
						// require 'authWidget.php';
						// require 'registrWidget.php';
					?> 
			</li> -->
			<li class="nav-item">
					<a class='btn btn-primary' href="index.php?auth=login">login</a>
					<a class='btn btn-primary' href="index.php?auth=signup">signup</a>
			</li>
			<li class="nav-item">
			</li>
			<li class="nav-item">
				<p class="text-white"><?= 'Hi, ' . $user;?></p>
			</li>
		</nav>
	</div>
</div>