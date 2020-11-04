<?php
require_once '../Config.php';

$nom = filter_input(INPUT_POST, "nom");
$tel = filter_input(INPUT_POST, "tel");
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");


$r= Config::getDb()->prepare("insert into user (nom,tel,email,password)". " value (:nom,:tel,:email,:password)");
$r->bindParam(":nom", $nom);
$r->bindParam(":tel", $tel);
$r->bindParam(":email", $email);
$r->bindParam(":password", $password);


$r->execute();

header("Location: ../");

