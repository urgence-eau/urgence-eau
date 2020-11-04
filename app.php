<?php
session_start();
require_once './Config.php';
include_once "header.php";

$departements = Config::getAllDepartement(1);
$rows = Config::getAllIncident();

$currentUser = Config::getUser($_SESSION["id"]);
?>
<div class="all-container">
    <div class="container-map">
        <div class="container-legende">
            <div class="card-legend">
                <div class="square" style="background-color: #45DE42">
                </div>
                <span>0% - 20%</span>
            </div>
            <div class="card-legend">
                <div class="square" style="background-color: #F9E63F">
                </div>
                <span>20% - 60%</span>
            </div>
            <div class="card-legend">
                <div class="square" style="background-color: #E8232F">
                </div>
                <span>60% - 100%</span>
            </div>
            <div class="card-legend">
                <div class="square" style="background-color: #373435">
                </div>
                <span >Non implémenté</span>
            </div>
        </div>
        <div class="map" id="map-div"></div>
    </div>
    <div class="controller-container">
        <div class="info-container">
            <h4 id="title-ita">Témoin d'une fuite ?</h4>
            <span>Signalez la et sauvegardez des milliers de litres d'eau</span>
        </div>
        <button id="btn-incident" data-toggle="modal" data-target=".bd-example-modal-lg">
            Signaler une fuite
        </button>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <h3>Formulaire de signalement de fuite</h3>
                    <div class="marqueur"><div class="trait"></div></div>
                    <form action="./actions/addPointer.php" method="post">
                        <div class="formGroup">
                            <div class="title-form">Avez-vous vu un marquage au sol à proximité de la fuite ? *</div>
                            <div class="groupRad">
                                <input type="radio" name="marquage" value="1">
                                <label for="marqueYes">Oui</label>
                            </div>
                            <div class="groupRad">
                                <input type="radio" name="marquage" value="0">
                                <label for="marqueNon">Non</label>
                            </div>
                            <span id="indic">SI OUI merci de cocher cette case et de noter dans le commentaire l'annotation sur le sol</span>
                        </div>
                        <div class="formGroup">
                            <label for="importance" class="title-form">Importance de la fuite : *</label>
                            <select name="importance">
                                <option value="1">Faible</option>
                                <option value="2">Moyen</option>
                                <option value="3">Fort</option>
                            </select>
                        </div>
                        <div class="formGroup">
                            <label for="commentaire" class="title-form">Commentaire</label>
                            <textarea name="commentaire" cols="30" rows="4"></textarea>
                        </div>
                        <h3>Lieu de la fuite</h3>
                        <div class="marqueur"><div class="trait"></div></div>
                        <div class="formGroup centered">
                            <span id="geoInfo">Si vous êtes près de la fuite, géolocalisez-vous en cliquant sur ce button *</span>
                            <input id="latitude" type="hidden" name="latitude" readonly>
                            <input id="longitude" type="hidden" name="longitude" readonly>
                            <button type="button" id="btn-geo">Je me géolocalise</button>
                        </div>
                        <div class="formGroup">
                            <label for="departement" class="title-form">Département</label>
                            <select name="departement">
                                <?php foreach ($departements as $departement){ ?>
                                        <option value="<?php echo $departement["id"]?>">
                                            <?php echo $departement["nom"]?>
                                        </option>
                                <?php } ?>
                            </select>
                        </div>
                        <h3>Comment vous joindre ?</h3>
                        <div class="marqueur"><div class="trait"></div></div>
                        <div class="formGroup">
                            <div class="squareRow">
                                <div class="groupInput">
                                    <label class="title-form" for="prenom">Prénom *</label>
                                    <input type="text" name="prenom" value="<?php echo $currentUser["prenom"] ?>">
                                </div>
                                <div class="groupInput">
                                    <label class="title-form" for="nom">Nom *</label>
                                    <input type="text" name="nom"  value="<?php echo $currentUser["nom"] ?>">
                                </div>
                            </div>
                            <div class="squareRow">
                                <div class="groupInput">
                                    <label class="title-form" for="email">Email *</label>
                                    <input type="text" name="email"  value="<?php echo $currentUser["email"] ?>">
                                </div>
                                <div class="groupInput">
                                    <label class="title-form"for="telephone">Téléphone *</label>
                                    <input type="text" name="telephone"  value="<?php echo $currentUser["tel"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="controlButton">
                            <button type="submit">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module">
    import {map, choose_display} from './assets/js/main.js';

    const table = [];
    function f() {
        <?php
        foreach ($rows as $row){
        ?>
        table.push([<?php echo $row["lat"]?>, <?php echo $row["lng"]?>]);
        <?php
            }
        ?>
    }
    f();

    table.map((x)=> L.marker(x).addTo(map));
    choose_display();
</script>

<?php include_once "footer.php" ?>
