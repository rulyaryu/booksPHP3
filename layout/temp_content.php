<?php require './model5.php'; ?> 

<button class="btn btn-outline-danger btn-lg fixed-bottom mb-3 ml-3 text-uppercase font-weight-bold" data-toggle="modal" data-target="#BookAddForm">add new book</button>

<div class="modal fade" id="BookAddForm" tabindex="-1" role="dialog" aria-labelledby="addBookLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addBookLabel">Add new book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
        	require 'form.php';
         ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




<div class="container">
	
	<?php foreach ($booksChunkedArr as $key => $value): ?>
		
			<div class="row">
				<?php foreach ($value as $b): ?>
					<div class="col">
					<div class="card">
						<img src="<?= $b['imgUrl'] ?>" alt="<?= $b['bookName']?>" class="card-img-top">
						<div class="card-body">
							<h5 class="card-title"><?= $b['bookName']?></h5>
							<p class="card-subtitle"><?= $b['author']?></p>
						</div>
						<div class="card-footer text-muted">
              <p><?= $b['category']?></p>

              <?php if(isset($_SESSION['adminSuccess']) &&  $_SESSION['adminSuccess'] === 'success') :?>
                <a class='btn btn-warning' href='editing.php?id=<?=$b['id']?>'>Edit</a>
                <a class='btn btn-danger' href='delete.php?id=<?=$b['id']?>'>Delete</a>
              <?php endif ;?>

            </div>
					</div>
				</div>
				<?php endforeach ?>
			</div>

	<?php endforeach ?>

</div>
