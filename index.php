<?php

require_once 'Autoloader.php';

Autoloader::register();

session_start();

/*Gestion des actions*/

if(isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'accueil';
}

/*
 * Action : acceuil
 */
if($action == 'accueil'){
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>
    </head>
    <body>
        <? if(isset($_SESSION['user_login'])){
            ?><div>Bienvenue <?=$_SESSION['user_login'] ?></div><?
        } ?>

    </body>
    </html>
    <?
}
/*
 * Action : Login
 */

elseif($action == 'login'){
    ?>
    <body>
    <div class="container">
        <h1 class="registerTitle">
            Rentrez vos identifiant et<br>
            <span class="orange">connectez-vous !</span>
        </h1>

        <div id="blocSuccess"></div>
        <div id="blocErreur"></div>

        <form action="" name="login" class="registerForm" method="post">
            <input type="text" id="email" name="email" placeholder="Adresse électronique">
            <input type="password" id="password" name="password" placeholder="Mot de passe">
            <br>
            <input class="button" value="Se connecter" type="submit"><br><br>
            <h2 class="registerTitle">Pas encore inscrit ?</h2>

            <div class="description">
                <p class="registerDescription">
                    Remplissez vos coordonnées et
                    devenez le nouveau membre
                    de <span class="orange">SimplePaper !</span>
                </p>
            </div>
            <br>
            <a  class="button" href="?action=register">S'inscrire</a>
        </form>
    </div>
    </body>
    <?
}

//Action dé vérification de register.php
elseif($action == 'loginController') {
    require_once '../Controller/loginController.php';
}

/*
 * Action : Inscription
 */
elseif($action == 'register') {
    ?>
    div class="container">

    <h1 class="registerTitle">Pas encore inscrit ?</h1>

    <div class="description">
        <p class="registerDescription">
    Remplissez vos coordonnées et
            devenez le nouveau membre
            de <span class="orange">SimplePaper !</span>
        </p>
    </div>

    <form method="POST" class="registerForm">
        <input type="text" id="firstName" name="firstname" class="registerFormInput" placeholder="Prénom">
        <input type="text" id="lastName" name="lastname" class="registerFormInput" placeholder="Nom">
        <input type="email" id="email" name="email" placeholder="Adresse électronique">
        <input type="password" id="password" name="password" placeholder="Mot de passe">
        <input type="password" id="passwordVerif" name="passwordVerif" placeholder="verification du mot de passe">
        <input type="text" id="passwordVerif" name="description" placeholder="Description><br>
        <input class="button" value="S'incrire" type="submit">

        <h2 class="registerTitle">Déjà inscrit ?</h2>
        <div class="arrow">
            <img src="./assets/images/mobile/arrow.png" class="arrowFirst" alt="Problem img"><br>
            <img src="./assets/images/mobile/arrow.png" alt="Problem img"><br>
            <img src="./assets/images/mobile/arrow.png" alt="Problem img">
        </div>
        <div class="description">
            <p class="registerDescription">
                Connecte toi à ton compte
                <span class="orange">SimplePaper !</span>
            </p>
        </div>
        <br>
        <a  class="button" href="?action=login">Se connecter</a>
    </form>


    <div id="blocSuccess"></div>
    <div id="blocErreur"></div>
</div>
    <?
    //Action dé vérification de register.php
}elseif($action == 'registerController') {
    require_once '../Controller/userController.php';
}

/*
 * Action : Erreur 404
 */

elseif($action == 'deco'){
    //unset($_SESSION);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_login']);
    unset($_SESSION['rang']);
    require_once '../View/accueil.php';
}

else{
    require_once '../View/error.php';
}