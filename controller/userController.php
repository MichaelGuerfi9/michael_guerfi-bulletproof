<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
require_once ('../config/dbconf.php');
require_once ('../model/registerSql.php');

$errors = array();
$isFormGood = true;

if(!empty($_POST))
{
    $new = new Register();

    if(!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 4)
    {
        $errors['pseudo'] = 'Saisissez un pseudo superieur à 3 caractères<br>';
        $isFormGood = false;
    }

    if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $errors['email'] = 'Saisissez un email valide';
        $isFormGood = false;
    }

    if(!isset($_POST['password']) || strlen($_POST['password']) < 6)
    {
        $errors['password'] = 'Saisissez un mdp superieur à 5 caractères<br>';
        $isFormGood = false;
    }

    if(!isset($_POST['passwordVerif']) || $_POST['passwordVerif'] !== $_POST['password'])
    {
        $errors['passwordVerif'] = 'Saisissez le même mot de passe que le précèdent<br>';
        $isFormGood = false;
    }

    if(!isset($_POST['firstname']) || strlen($_POST['firstname']) <= 2)
    {
        $errors['firstname'] = 'Saisissez un prénom valide<br>';
        $isFormGood = false;
    }

    if(!isset($_POST['lastname']) || strlen($_POST['lastname']) <= 2)
    {
        $errors['lastname'] = 'Saisissez un nom valide<br>';
        $isFormGood = false;
    }

    if(!$isFormGood)
    {
        http_response_code(400);
        echo(json_encode(array('success'=>false, "errors"=>$errors)));
    }
    else
    {
        $_POST['password'] = sha1($_POST['password']);
        unset($_POST['passwordVerif']);

        if(isset($_POST['edit'])){
        }else{
            $new -> ValidRegistration($pdo);
        }
        echo(json_encode(array('success'=>true, "user"=>$_POST)));
    }
}
else
{
    http_response_code(400);
    echo(json_encode(array('success'=>false, "errors"=>array('Missing form data'))));
}