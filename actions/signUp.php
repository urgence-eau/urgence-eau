<?php
require_once '../Config.php';

$nom = filter_input(INPUT_POST, "nom");
$tel = filter_input(INPUT_POST, "tel");
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");
$prenom = filter_input(INPUT_POST, "prenom");

var_dump($nom, $email, $prenom, $password, $tel);


$r= Config::getDb()->prepare("insert into user (nom,tel,email,password,prenom)". " value (:nom,:tel,:email,:password,:prenom)");
$r->bindParam(":nom", $nom);
$r->bindParam(":tel", $tel);
$r->bindParam(":email", $email);
$r->bindParam(":password", $password);
$r->bindParam(":prenom", $prenom);
$r->execute();



