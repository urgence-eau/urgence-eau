<?php
session_start();
require_once './Config.php';
include_once "header.php";

$regions = Config::getAllRegion();
$departements = Config::getAllDepartement(1);
$rows = Config::getAllIncident();
if(isset($_SESSION["id"])){
    $currentUser = Config::getUser($_SESSION["id"]);
}

?>
<div class="all-container">
    <div class="container-map">
        <div class="container-legende">
            <div class="card-legend">
                <div class="square" style="background-color: #E8232F">
                </div>
                <span>0% - 20%</span>
            </div>
            <div class="card-legend">
                <div class="square" style="background-color: #F9E63F">
                </div>
                <span>20% - 60%</span>
            </div>
            <div class="card-legend">
                <div class="square" style="background-color: #45DE42">
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
        <?php if (isset($_SESSION["id"])): ?>
        <form action="actions/logout.php" method="post">
            <button id="btn-incident" data-toggle="modal" type="submit">
                Deconnexion
            </button>
        </form>
        <?php if ($_SESSION["role"]==1): ?>
            <a id="btn-map" href="backoffice.php"> Accès backoffice</a>
        <?php endif; ?>
        <button id="btn-incident" data-toggle="modal" data-target=".bd-example-modal-lg">
            Signaler une fuite
        </button>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <h3>Formulaire de signalement de fuite</h3>
                            <div class="marqueur"><div class="trait"></div></div>
                            <form action="./actions/addPointer.php" method="post" class="formAdd">
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
                                                <?php echo utf8_decode($departement["nom"])?>
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
        <?php else: ?>
            <button id="btn-incident" data-toggle="modal" data-target=".bd-connexion-modal-lg">
                Se connecter
            </button>
            <div id="modal" class="modal fade bd-connexion-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h3 class="biggerTitle">Connexion</h3>
                        <div class="marqueur"><div class="trait"></div></div>
                        <form action="actions/login.php" method="post">
                            <div class="formGroup">
                                <label for="email" class="title-form">Email</label>
                                <input type="text" name="email">
                            </div>
                            <div class="formGroup">
                                <label for="password" class="title-form">Password</label>
                                <input type="password" name="password">
                            </div>
                            <div class="controlButton">
                                <button type="submit">Connexion</button>
                            </div>
                        </form>
                        <div class="inscription">
                            Pas encore inscript ? <a class="signupText" id="signup" data-toggle="modal" data-target=".bd-example-modal-signup">Cliquez ici</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-signup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h3 class="biggerTitle">Inscription</h3>
                        <div class="marqueur"><div class="trait"></div></div>
                        <form action="actions/signUp.php" method="post">
                            <div class="formGroup">
                                <label for="nom" class="title-form">Nom</label>
                                <input type="text" name="nom">
                            </div>
                            <div class="formGroup">
                                <label for="prenom" class="title-form">Prénom</label>
                                <input type="text" name="prenom">
                            </div>
                            <div class="formGroup">
                                <label for="tel" class="title-form">Téléphone</label>
                                <input type="tel" name="tel">
                            </div>
                            <div class="formGroup">
                                <label for="email" class="title-form">Email</label>
                                <input type="email" name="email">
                            </div>
                            <div class="formGroup">
                                <label for="password" class="title-form">Password</label>
                                <input type="password" name="password">
                            </div>
                            <div class="controlButton">
                                <button type="submit">Je m'inscris</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endif ?>
    <div class="container-table">
        <h5>Nombre d'incidents</h5>
        <div class="info-table">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr class="table-active">
                    <th scope="col">Région</th>
                    <th scope="col">Département</th>
                    <th scope="col">Nombre total d’incident</th>
                    <th scope="col">Nombre d’incident traîtés</th>
                    <th scope="col">Proportions d'incident traîtés</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($regions as $region){ ?>
                    <tr>
                        <th scope="row" rowspan="<?php echo (count(Config::getAllDepartement($region["id"]))+1)?>"><?php echo $region["nom"]?></th>
                        <?php foreach (Config::getAllDepartement($region["id"]) as $departement){ ?>
                            <tr>
                                <td scope="row"><?php echo utf8_encode($departement["nom"])?></td>
                                <td><?php echo Config::getAllIncidentFromDepartement($departement["id"])?></td>
                                <td><?php echo Config::getAllRepairedIncidentFromDepartement($departement["id"])?></td>
                                <td><?php echo Config::getAllIncidentFromDepartement($departement["id"]) === 0 ? "Aucun incident" : (number_format (Config::getAllRepairedIncidentFromDepartement($departement["id"])/Config::getAllIncidentFromDepartement($departement["id"]), 2)*100)."%"?></td>
                            </tr>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="module">
    import {map, choose_display} from './assets/js/main.js';
    const table = [];

    const chooseColor = (nbIncident) => {
        if(nbIncident <= 20){
            return "#E8232F";
        }else if(nbIncident <= 60){
            return "#F9E63F";
        }else{
            return "#45DE42";
        }
    }

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

    const cordonne = [];
    const nbIncidentRadius = [];
    const pourcentageIncident = [];
    function f1() {
        <?php
        foreach ($departements as $departement){
            $cord = explode(",", $departement["coordonnees"]);
            $nbIncidentRadius = Config::getAllIncidentFromDepartement($departement["id"]);
            $percentIncident = Config::getAllIncidentFromDepartement($departement["id"]) === 0 ?
                0 :
                (number_format (Config::getAllRepairedIncidentFromDepartement($departement["id"])/Config::getAllIncidentFromDepartement($departement["id"]), 2)*100);
        ?>
        nbIncidentRadius.push(<?php echo $nbIncidentRadius?>);
        pourcentageIncident.push(<?php echo $percentIncident ?>);
        cordonne.push([<?php echo $cord[0]?>, <?php echo $cord[1]?>]);
        <?php
        }
        ?>
    }
    f1();
    cordonne
        .map(
            (x, i) => L.circle(x,
                    {className: "circle",
                    fillColor: chooseColor(parseInt(pourcentageIncident[i])),
                    fillOpacity: 0.5,
                    radius: parseInt(nbIncidentRadius[i])*5000})
        .bindPopup(`
                    <p style="font-family: 'Cabin', sans-serif;">Nombre d'incident : ${nbIncidentRadius[i]}</p>
                    <p style="font-family: 'Cabin', sans-serif;">Proportions d'incident traîtés: ${pourcentageIncident[i]}%</p> `)
        .addTo(map)
    );
    choose_display();
</script>

<?php include_once "footer.php" ?>
