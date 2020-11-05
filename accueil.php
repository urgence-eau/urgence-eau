<?php
require_once 'Config.php';
include_once "header.php";

$nbIncidentConvert = (count(Config::getAllIncident()) + 1) * 100;
$nbIncidentTrait = Config::getAllIncidentTraite();
?>

<div class="header-element">
    <div class="header-container">
        <h1 class="title">
            Et si on sauvait de l'eau ?
        </h1>
        <p class="description">
            Nous utilisons vos alertes générées pour améliorer le réseau de canalisation et éviter le gaspillage d’eau.
        </p>
        <a href="app.php" id="btn-map" >
                Signaler une fuite
        </a>
    </div>
</div>
<div class="feature-content">
    <div class="title-container">
        <h2>Comment ça fonctionne ?</h2>
        <div class="marqueur"><div class="trait"></div></div>
    </div>
    <div class="card-content">
        <div class="card-feature">
            <img src="./assets/image/pipe.png" alt="">
            <div class="info">Détection de la fuite</div>
        </div>
        <div class="card-feature">
            <img src="./assets/image/emergency-call_1.svg" alt="">
            <div class="info">Signalez sur notre plateforme</div>
        </div>
        <div class="card-feature">
            <img src="./assets/image/alarm.png" alt="">
            <div class="info">On vous confirme que l'alerte a été prise en compte</div>
        </div>
        <div class="card-feature">
            <img src="./assets/image/plumber.png" alt="">
            <div class="info">Une équipe se déplace dans les 24h</div>
        </div>
    </div>
</div>
<div class="objectif-container">
    <div class="title-description">
        <h2 id="obj">Notre objectif ?</h2>
        <p class="description-obj">Les difficultés liées à la distribution de l’eau potable sur le territoire, perdurent principalement en raison de la vétusté des réseaux. C’est surtout à l’échelle locale que la préservation de l’eau se joue. Les fuites représentent encore un <span>litre d’eau sur cinq distribués</span> soit un total impressionnant de <span>1 300 milliards de litres d'eau</span> ou <span>430 000 piscines olympiques par an.</span></p>
        <p class="description-obj">Notre plateforme a pour objectif de <span>remonter les incidents signalés.</span> La détection et de réparation de fuites, visibles et invisibles,  permet de <span>réduire les pertes sur les réseaux</span> afin que l’eau potable produite, dont la quantité est suffisante,<span>ne soit pas gaspillée.</span> </p>
        <a href="app.php" id="btn-map">Consulter la map</a>
    </div>
    <div class="stats-container">
        <div class="card-stat">
            <img src="assets/image/water-drops%20(1)%203.svg" alt="">
            <p>Eau sauvegardée grâce à vos signalement</p>
            <div class="number"><?php echo $nbIncidentConvert ?> m³</div>
        </div>
        <div class="card-stat">
            <img src="assets/image/wrench%202.svg" alt="">
            <p>Nombres d'interventions déjà effectuées</p>
            <div class="number"><?php echo $nbIncidentTrait ?></div>
        </div>
        <div class="card-stat">
            <img src="assets/image/pipe%204.png" alt="">
            <p>Litres d'eau gaspillés à cause des fuites par an</p>
            <div class="number">1 300 milliards</div>
        </div>
    </div>
</div>
<div class="reseau-sociaux">
    <div class="content-sociaux">
        <i class="fab fa-instagram-square"></i>
        <i class="fab fa-linkedin"></i>
        <i class="fab fa-twitter-square"></i>
        <i class="fab fa-facebook-square"></i>
    </div>
</div>

<?php include_once "footer.php" ?>
