<?php
require_once 'Config.php';
include_once "header.php";


$departements = Config::getAllDepartement(1);

?>

<div class="all-container">
    <div class="map" id="map-div">

    </div>
    <div class="controller-container">
        <div class="info-container">
            <h4>Témoin d'une fuite ?</h4>
            <span>Signalez la et sauvegardez des milliers de litres d'eau</span>
        </div>
        <button id="btn-incident" data-toggle="modal" data-target=".bd-example-modal-lg">
            Signaler une fuite
        </button>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <h3>Signaler une fuite</h3>
                        <div class="formGroup">
                            <label for="cordonne">Vos cordonnées</label>
                            <input id="cordonnee" type="text" name="cordonnee" readonly>
                            <button id="btn-geo">Je me géolocalise</button>
                            <label for="departement">departement</label>
                            <select name="departement">
                                <?php foreach ($departements as $departement){ ?>
                                        <option value="<?php echo $departement["id"]?>">
                                            <?php echo $departement["nom"]?>
                                        </option>
                                <?php } ?>
                            </select>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "footer.php" ?>
