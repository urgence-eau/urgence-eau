<?php
session_start();
if(isset($_SESSION["id"])){ //Si la variable session id existe
    include "app.php";
} else {
    include "accueil.php"; //Si la variable n'existe pas redirection sur la page de login
}
