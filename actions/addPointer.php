<?php
include_once "../Config.php";
session_start();

$idUser = $_SESSION["id"];
$latitude = filter_input(INPUT_POST, "latitude");
$longitude = filter_input(INPUT_POST, "longitude");
$departement = filter_input(INPUT_POST, "departement");
$etat = "En cours";

var_dump($idUser);

$r = Config::getDb()->prepare("insert into incident (user_id, departement_id, etat, latitude, longitude)". " value (:idUser, :departement, :etat, :latitude, :longitude)");
$r->bindParam(":idUser", $idUser);
$r->bindParam(":departement", $departement);
$r->bindParam(":etat", $etat);
$r->bindParam(":latitude", $latitude);
$r->bindParam(":longitude", $longitude);

$r->execute();



