<?php

$numP = $_GET['numP'];
include "../modele/allDetails.php";
$donnee = getAllDetails($numP);

?>
<div class="modal-header" style="background-color: #ff8012; color: white;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h1>Détails chef !!!!!!!</h1>
</div>
<div class="modal-body">
    <table class="table table-responsive">
        <th class="">Plat</th>
        <th>Entrée</th>
        <th>Dessert</th>
        <tr>
            <td><?php echo utf8_encode($donnee['chef_plat']); ?></td>
            <td><?php echo utf8_encode($donnee['chef_entree']); ?></td>
            <td><?php echo utf8_encode($donnee['chef_dessert']); ?></td>
        </tr>
    </table>
</div>