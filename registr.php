<?php 


$msg = '';
$msgClass = '';
$registrArr = [];

$usrf = new SplFileObject('./data/users.csv', 'a+');
$usrf -> setFlags(SplFileObject::READ_CSV);

function isLoginTaken($loginArr, $login) {
    $bool = false;
    if(empty($loginArr)) return false;
    foreach ($loginArr as $key => $value) {
        if ($value[0] === $login) {
            $bool = true;
        }
    }
    return $bool;
}

function isFilled(array $arr) {
    $filled = true;
    foreach ($arr as $key => $value) {
     if(empty($value))
        $filled = false;
    }
    return $filled;
}

if(filter_has_var(INPUT_POST, 'submitReg')) {
    
    $registrArr = [
        'login' => htmlentities($_POST['loginReg']),
        'email' => htmlentities($_POST['emailReg']),
        'password' => password_hash(htmlentities($_POST['passwReg']), PASSWORD_DEFAULT)
    ];

    
    if(isFilled($registrArr)) {

        if(isLoginTaken($usrf, $registrArr['login'])) {
            $msg = 'This login already exist.. try something else';
            $msgClass = 'alert-danger';
        }
        else if(filter_var($registrArr['email'], FILTER_VALIDATE_EMAIL) === false) {
            $msg = 'Please enter correct email';
            $msgClass = 'alert-danger';
        } else if(password_verify($_POST['passwRepReg'], $registrArr['password']) === false) {
            $msg = 'Passwords don\'t match';
            $msgClass = 'alert-danger';
        } else {

            $_SESSION['loginReg'] = $registrArr['login'];
            $_SESSION['email'] = $registrArr['email'];
            $_SESSION['passwordReg'] = $registrArr['password'];

            $usrf -> fputcsv($registrArr); 

            // $usrf = null; ???? 

            $msg = 'Passed';
            $msgClass = 'alert-success';
    

            echo session_save_path() . '<br>';
        }
    } else {
        $msg = 'Failed';
        $msgClass = 'alert-danger';
    }

}

?> 