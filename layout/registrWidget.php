
<?php 
    require_once 'registr.php';

?>

<div class="container">

    <div class="row">

        <div class="col">

        <h5 class="modal-title <?= $msgClass === 'alert-success' ? 'd-none' : '' ?>" id="signupLabel">Hello, Anon!</h5>
        <?php if($msg !== '') : ?>
            <div class="alert text-center mb-0 <?=$msgClass?>"><?=$msg?></div>
        <?php endif; ?>
        
        <!--  -->

        <form action="index.php?auth=signup" method="post" class='m-auto <?= $msgClass === 'alert-success' ? 'd-none' : '' ?>'>

            <div class="form-group">
                <label for="loginRegistr">Login</label>
                <input type="text" name="loginReg" class="form-control" id="loginRegistr" aria-describedby="emailHelp" placeholder="Johny D">
                <small id="emailHelp" class="form-text text-muted">Type your name</small>
            </div>    

            <div class="form-group">
                <label for="emailRegistr">Email address</label>
                <input type="email" name="emailReg" class="form-control" id="emailRegistr" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="passwordRegistr">Password</label>
                <input type="password" name="passwReg" class="form-control" id="passwordRegistr" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="passwordRepeat">Repeat Password</label>
                <input type="password" name="passwRepReg" class="form-control" id="passwordRepeat" placeholder="Password">
            </div>

            <button type="submit" name="submitReg" class="btn btn-primary">Submit</button>

        </form>
        
        <?php if( $msgClass === 'alert-success') :?>

            <a href="index.php?auth=login" class="btn btn-success btn-lg mt-4">Login</a>
        
        <?php endif;?>

        </div>
    
    </div>

</div>