<?php
include_once "Config.php";

$cordonniate = filter_input(INPUT_POST, "cordonniate");

$r = Config::getDb()->prepare("insert into signalement (idUser, cordonniate)". " value (:idUser, :cordonniate)");
$r->bindParam(":idUser", $_SESSION["id"]);
$r->bindParam(":cordonniate", $cordonniate);

$r->execute();

