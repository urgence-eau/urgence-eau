<?php
include_once "../Config.php";
session_start();

$idUser = $_SESSION["id"];
$latitude = filter_input(INPUT_POST, "latitude");
$longitude = filter_input(INPUT_POST, "longitude");
$departement = filter_input(INPUT_POST, "departement");
$importance = filter_input(INPUT_POST, "importance");
$marquage = filter_input(INPUT_POST, "marquage");
$commentaire = filter_input(INPUT_POST, "commentaire");
$etat = "0";

$r = Config::getDb()->prepare("insert into incident (user_id, departement_id, lat, lng, etat, importance, commentaire, marquage)". " value (:idUser, :departement, :latitude, :longitude,  :etat,:importance, :commentaire, :marquage)");
$r->bindParam(":idUser", $idUser);
$r->bindParam(":departement", $departement);
$r->bindParam(":latitude", $latitude);
$r->bindParam(":longitude", $longitude);
$r->bindParam(":etat", $etat);
$r->bindParam(":importance", $importance);
$r->bindParam(":commentaire", $commentaire);
$r->bindParam(":marquage", $marquage);

$r->execute();

header("Location: ../app.php");



