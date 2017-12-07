<?php

require_once ("../config/dbconnection.php");

class Login{

    public function getLogin($pdo){
        $stmt = $pdo->prepare("SELECT * FROM users, rangs WHERE (email = :login or login = :login)");
        $stmt->bindParam("login",$_POST['pseudo']);
        $stmt->execute();
        return $stmt->fetch();
    }
}