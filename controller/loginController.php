<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
require_once ('../config/dbconnection.php');
require_once ('../model/loginSql.php');

$errors = array();
$isFormGood = true;


if(!empty($_POST))
{
    $info = new Login();
    $info = $info -> getLogin($pdo);

    /*
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = :login");
    //$stmt->bindParam("email",$_POST['email']);
    $stmt->bindParam("login",$_POST['pseudo']);
    $stmt->execute();
    $info = $stmt->fetch();
    */

    $_POST['password'] = sha1($_POST['password']);
    if($_POST['password'] != $info['password'])
    {
        $isFormGood = false;
    }

    if(!$isFormGood)
    {
        http_response_code(400);
        echo(json_encode(array('success'=>false)));
    }
    else
    {
        $_SESSION['user_login'] = $info['login'];

        echo(json_encode(array('success'=>true)));
    }
}
else
{
    http_response_code(400);
    echo(json_encode(array('success'=>false, "errors"=>array('Missing form data'))));
}