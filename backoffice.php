<?php
session_start();
require_once './Config.php';
include_once "header.php";
?>
<div>
    <h1 id="titleCenter">
        Gestion des fuites
    </h1>
</div>
<div class="incident-list">
    <table class="table">
        <thead>
        <tr class="table-active">
            <th scope="col">ID</th>
            <th scope="col">Latitude</th>
            <th scope="col">Longitude</th>
            <th scope="col">Importance</th>
            <th scope="col">Etat</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach (Config::getAllUnrepairedIncident() as $incident){ ?>
                <tr>
                    <th scope="row"><?php echo $incident["id"]?></th>
                    <td><?php echo $incident["lat"]?></td>
                    <td><?php echo $incident["lng"]?></td>
                    <td><?php echo ($incident["importance"]) == 0 ? "Mineure" : "Majeure" ?></td>
                    <td><?php echo ($incident["etat"]) == 0 ? "Non prit en charge" : "Prit en charge" ?></td>
                    <?php if ($incident["etat"]=="0"): ?>
                        <td>
                            <form action="actions/updateIncidentEtat.php" method="post">
                                <input type="hidden" name="incident_id" value=<?php echo $incident["id"]?>>
                                <button id="btn-pending" class="fas fa-tools btn btn-warning" type="submit"></button>
                            </form>
                        </td>
                    <?php else: ?>
                        <td>
                            <form action="actions/updateIncidentEtat.php" method="post">
                                <input type="hidden" name="incident_id" value=<?php echo $incident["id"]?>>
                                <button id="btn-done" class="fas fa-check btn btn-success" type="submit"></button>
                            </form>
                        </td>
                    <?php endif ?>
                  </tr>
            <?php } ?>
        </tbody>
    </table>
</div>




<?php include_once "footer.php" ?>
