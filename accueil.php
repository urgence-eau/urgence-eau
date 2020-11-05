<?php
require_once 'Config.php';
include_once "header.php" ?>

<div class="header-element">
    <h1 class="title">
        Et si on sauvait de l'eau ?
    </h1>
    <p class="description">
        Nous utilisons vos alertes générées pour améliorer le réseau de canalisation et éviter le gaspillage d’eau.
    </p>
    <button id="btn-title" data-toggle="modal" data-target=".bd-example-modal-lg">
        Signaler une fuite
    </button>

</div>
<div class="feature-content">
    <h2>Comment ça fonctionne ?</h2>
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
<div class="stats-content">
    <h2>Plus de 10 millions de litre d'eau sauvegardés</h2>
    <div class="card-content">
        <div class="card-stat">
            <h3 class="title-under">Plus de</h3>
            <div class="number">4 785</div>
            <div class="separate"></div>
            <div class="info">INTERVENTION</div>
        </div>
        <div class="card-stat">
            <h3 class="title-under">Nous avons déjà sauvegardé</h3>
            <div class="number">11 500 587</div>
            <div class="separate"></div>
            <div class="info">LITRE</div>
        </div>
        <div class="card-stat">
            <h3 class="title-under">Plus de</h3>
            <div class="number">3 558</div>
            <div class="separate"></div>
            <div class="info">SIGNALEMENT</div>
        </div>
    </div>
</div>
<div class="objectif-container">
    <div class="title-description">
        <h2 id="obj">Notre objectif ?</h2>
        <p class="description-obj">Les difficultés liées à la distribution de l’eau potable sur le territoire, perdurent principalement en raison de la vétusté des réseaux. C’est surtout à l’échelle locale que la préservation de l’eau se joue. Les fuites représentent encore un litre d’eau sur cinq distribués soit un total impressionnant de 1 300 milliards de litres d'eau ou 430 000 piscines olympiques par an.</p>
        <p class="description-obj">Notre plateforme a pour objectif de remonter les incidents signalés. La détection et de réparation de fuites, visibles et invisibles,  permet de réduire les pertes sur les réseaux afin que l’eau potable produite, dont la quantité est suffisante, ne soit pas gaspillée. </p>
        <a id="btn-map">Consulter la map</a>
    </div>
    <img id="illustration-obj" src="./assets/image/undraw_unexpected_friends_tg6k.svg" alt="">
</div>
<div class="reseau-sociaux">
    <h2>Rejoignez nous sur les réseaux sociaux</h2>
    <div class="content-sociaux">
        <i class="fab fa-instagram-square"></i>
        <i class="fab fa-linkedin"></i>
        <i class="fab fa-twitter-square"></i>
        <i class="fab fa-facebook-square"></i>
    </div>
</div>

<?php include_once "footer.php" ?>
