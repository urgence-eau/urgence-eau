<?php
require_once '../config.php';

$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");
$nom = filter_input(INPUT_POST, "nom");
$prenom = filter_input(INPUT_POST, "prenom");
$sexe = filter_input(INPUT_POST, "sexe");
$pays = filter_input(INPUT_POST, "pays");

$r= Config::getDb()->prepare("insert into utilisateurs (email,motDePasse,nom,prenom, sexe, pays)". " value (:email ,:password,:nom, :prenom, :sexe, :pays)");
$r->bindParam(":nom", $nom);
$r->bindParam(":prenom", $prenom);
$r->bindParam(":password", $password);
$r->bindParam(":email", $email);
$r->bindParam(":sexe", $sexe);
$r->bindParam(":pays", $pays);

$r->execute();

header("Location: ../");
