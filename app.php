<?php
require_once 'Config.php';
include_once "header.php";
$departements = Config::getAllDepartement(1);
$regions = Config::getAllRegion(); ?>

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
                    <h3>Signaler une fuite</h3>
                    <form action="" method="post">
                        <div class="formGroup">
                            <label for="latitude">Latitude</label>
                            <input id="latitude" type="text" name="latitude" readonly>
                        </div>
                        <div class="formGroup">
                            <label for="longitude">Longitude</label>
                            <input id="longitude" type="text" name="latitude" readonly>
                        </div>
                            <button type="button" id="btn-geo">Je me géolocalise</button>
                        <div class="formGroup">
                            <label for="departement">departement</label>
                            <select name="departement">
                                <?php foreach ($departements as $departement){ ?>
                                        <option value="<?php echo $departement["id"]?>">
                                            <?php echo $departement["nom"]?>
                                        </option>
                                <?php } ?>
                            </select>
                        </div>
                            <button type="submit">Signaler</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="info-table">
        <table class="table">
            <thead>
            <tr class="table-active">
                <th scope="col">Lieu</th>
                <th scope="col">Nombre total d’incident</th>
                <th scope="col">Nombre d’incident traîtés</th>
                <th scope="col">Proportions d'incident traîtés</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($regions as $region){ ?>
                <tr>
                    <th scope="row"><?php echo $region["nom"]?></th>
                    <td><?php echo Config::getAllIncidentFromRegion($region["id"])?></td>
                    <td><?php echo Config::getAllRepairedIncidentFromRegion($region["id"])?></td>
                    <td><?php echo Config::getAllIncidentFromRegion($region["id"]) === 0 ? "Aucun incident" : (number_format (Config::getAllRepairedIncidentFromRegion($region["id"])/Config::getAllIncidentFromRegion($region["id"]), 2)*100)."%"?></td>
                </tr>
                <?php foreach (Config::getAllDepartement($region["id"]) as $departement){ ?>
                    <tr>
                        <td scope="row"><?php echo $departement["nom"]?></td>
                        <td><?php echo Config::getAllIncidentFromDepartement($departement["id"])?></td>
                        <td><?php echo Config::getAllRepairedIncidentFromDepartement($departement["id"])?></td>
                        <td><?php echo Config::getAllIncidentFromDepartement($departement["id"]) === 0 ? "Aucun incident" : (number_format (Config::getAllRepairedIncidentFromDepartement($departement["id"])/Config::getAllIncidentFromDepartement($departement["id"]), 2)*100)."%"?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once "footer.php" ?>
