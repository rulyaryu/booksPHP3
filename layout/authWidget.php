<?php 
  require_once 'authoriz.php';

?> 

<?php if(isset($_SESSION['loginSuccess']) && $_SESSION['loginSuccess'] === 'success') :?>
    <div class="alert alert-success">Hello, <?=$_SESSION['user']?></div>
<?php endif ;?>

<div class="container <?= $_SESSION['loginSuccess'] === 'success' || $_SESSION['adminSuccess'] === 'success' ? 'd-none' : ''?>">

  <div class="row">
    
    <?php if($msgAuth !== '') : ?>
            <div class="alert text-center mb-0 <?=$msgAuthClass?>"><?=$msgAuth?></div>
    <?php endif; ?>

    <div class="col">
    
    <form action="index.php?auth=login" method="post" class='m-auto'>

        <div class="form-group">
            <label for="loginAuth">Login</label>
            <input type="text" name="loginAuth" class="form-control" id="loginAuth" aria-describedby="emailHelp" placeholder="Johny D">
            <small id="emailHelp" class="form-text text-muted">Type your name</small>
        </div>    
        <div class="form-group">
            <label for="passwordAuth">Password</label>
            <input type="password" name="passwAuth" class="form-control" id="passwordAuth" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary" name='login'>Enter</button>

    </form>

    </div>

  </div>

</div>


<?php 
// $_SESSION['loginSuccess'] === 'success' ? header( 'Location: /', true, 307 ) : null; 

// Warning: Cannot modify header information -
//  headers already sent by (output started at E:\wamp64\www\layout\header.php:24) 
// in E:\wamp64\www\layout\authWidget.php on line 41

?>