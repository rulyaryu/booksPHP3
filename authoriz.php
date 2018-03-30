<?php 


    $msgAuth = '';
    $msgAuthClass = '';

    $userAuthFile = new SplFileObject('./data/users.csv', 'r');
    $userAuthFile -> setFlags(SplFileObject::READ_CSV);

    if(filter_has_var(INPUT_POST, 'login')) {

        foreach ($userAuthFile as $key => $value) {
            if (array_search($_POST['loginAuth'], $value) !== false) {
                $_SESSION['user'] = $_POST['loginAuth'];
                if(password_verify($_POST['passwAuth'], $value[2])) {
                    isset($value[3]) && $value[3] == 'idAdmin' 
                            ?   $_SESSION['adminSuccess'] = 'success' 
                            :   $_SESSION['loginSuccess'] = 'success';
                    // echo $_SESSION['user'] . '<br>';
                    // echo $_SESSION['loginSuccess'] . '<br>';
                } else {
                    $msgAuth = 'wrong password';
                    $msgAuthClass = 'alert-danger';
                }
            }
        }

        if ($_SESSION['user'] === false) 
            $msgAuth = 'this login is not registred yet';
            $msgAuthClass = 'alert-danger';
    }
?>