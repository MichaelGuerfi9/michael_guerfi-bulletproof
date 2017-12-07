<?php

require_once ("../config/dbconf.php");
global $config;
$pdo = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'], $config['user'], $config['password']);

$pdo->query("SET NAMES UTF8");//Encodage UTF8

return $pdo;
