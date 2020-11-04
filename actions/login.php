<?php
require_once '../config.php';
//Récupérer les saisies
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");

//On regarde dans la base s'il existe les identifiants récupéré dans les saisies
$r =Config::getDb()->prepare("select * from user where email = :email and motDePasse = :motdepasse");
$r->bindParam(":email", $email);
$r->bindParam(":motdepasse", $password);
$r->execute();

//Si la requete nous renvoi au moins une ligne alors l'utilisateur existe
//on assigne l'id de personne connecté avec la variable de session
//puis on regarde si son idMetier est égal a 5 (pour savoir si c'est le chef ou pas),
// on enregistre dans une nouvelle variable de session un boléen qui nous servira a determiné si l'utilisateur est le chef ou non.
if($r->rowCount() > 0){
    $user = $r->fetch();
    session_start();
    $_SESSION["id"] = $user["id"];
}
header("Location: ../");