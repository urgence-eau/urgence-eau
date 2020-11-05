<?php
require_once '../config.php';
//Récupérer les saisies
$incident_id = filter_input(INPUT_POST, "incident_id");

$r =Config::getDb()->prepare("select etat from incident where id=:incident_id");
$r->bindParam(":incident_id", $incident_id);
$r->execute();
$etat = $r->fetch();

if ($etat["etat"] == "0"){
    $etat = "1";
}else{
    $etat = "2";
}

$r =Config::getDb()->prepare("update incident set etat=:etat where id=:incident_id");
$r->bindParam(":incident_id", $incident_id);
$r->bindParam(":etat", $etat);
$r->execute();

header("Location: /backoffice.php");
