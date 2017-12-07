<?php

require_once ("../config/dbconnection.php");

class Register{
    public function ValidRegistration($pdo){
        $req=$pdo->prepare('INSERT INTO users SET login = :login, password = :password, birthYear = :birthYear, firstName = :firstName, lastName = :lastName, email =:email');
        $req->bindParam('login', $_POST['pseudo']);
        $req->bindParam('password', $_POST['password']);
        $req->execute();
    }

    public function editProfil($pdo){
        $req=$pdo->prepare('UPDATE users SET login = :login, password = :password, birthYear = :birthYear, firstName = :firstName, lastName = :lastName, email =:email WHERE id = :id');
        $req->bindParam('login', $_POST['pseudo']);
        $req->bindParam('password', $_POST['password']);
        $req->bindParam('id', $_SESSION['user_id']);
        $req->execute();
    }
}