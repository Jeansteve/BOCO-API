<?php

include "getListCommande.php";

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>

    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="js/bootstrap-table.min.css"/>

    <script type="text/javascript" src="../js/jquery-2.1.0.js"></script>
    <script type="text/javascript" src="js/bootstrap-table.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.0-beta.6/angular.min.js"></script>
<!--    <script src="angular.js"></script>-->
    <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!--    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">-->

    <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<!--    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>-->
</head>
<body>
<div id="container" >
    <header class="row">
        <img id="img-logo" src="../images/logo2.png" alt="" class="img-header col-lg-2"/>
        <span class="col-lg-6"><h1 >Administrateur</h1></span>
    </header>
    <section>
        <div class="row">
            <div class="row text-center titre">
                <h3 class="">Liste des commandes non livrés</h3>
            </div>
            <div class="row" style="overflow:auto;height: 350px;margin-left: 5px;margin-right: 5px;">
            <!--   tabCmdRecu = tableau qui contient les commande qui n'ont pas encore été acceptés             -->
            <table  id="tabCmdRecu" data-toggle="table" data-show-refresh="true" data-url="listCommandeNonLivre.json" data-height="299" data-click-to-select="true">
                <thead>
                <tr>
                    <th data-field="state" data-checkbox="true"></th>
                    <th data-field="num_commande">Identifiant</th>
                    <th data-field="nom_client">Nom du client</th>
                    <th data-field="ad_rue_client">Rue</th>
                    <th data-field="cp_client">Code postal</th>
                    <th data-field="ville_client">Ville</th>
                    <th data-field="mail_client">E-Mail</th>
                    <th data-field="tel_client">Tel client</th>
                    <th data-field="libelle_plateau">Libellé plateau</th>
                    <th data-field="qte_commandee">Qte</th>
                    <th data-field="date_heure">Date/heure commande</th>
                    <th data-field="periode">Période</th>
                    <th data-field="etat">Etat</th>
                </tr>
                </thead>
            </table>

<!--                <table  class="table table-responsive tab-pane" data-click-to-select="true" id="tab_commande">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th data-field="state" data-checkbox="true"></th>-->
<!--                        <th data-field="nom_client">Nom du client</th>-->
<!--                        <th>Rue</th>-->
<!--                        <th>Code postal</th>-->
<!--                        <th>Ville</th>-->
<!--                        <th>E-Mail</th>-->
<!--                        <th>Tel client</th>-->
<!--                        <th>Libellé plateau</th>-->
<!--                        <th>Qte</th>-->
<!--                        <th>Date/heure commande</th>-->
<!--                        <th>Etat</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!---->
<!--                    --><?php
//
//                    include "getListCommande.php";
//
//                    $listCommande = json_decode(getListCommande());
//
//                    echo "";
//                    foreach($listCommande as $commande)
//                    {
//                        echo "<tr>";
//                        echo "<td></td>";
//                        foreach($commande as $val)
//                        {
//                            echo "<td>".$val."</td>";
//                            //echo $cle." = ".$val;
//                        }
//
//                        echo "</tr>";
//                    }
//                    echo "";
//                    ?>
<!--                </table>-->
                <button class="col-lg-offset-1" id="showSelected">Valider les commandes</button>
            </div>

        </div>
        <div class="row">
            <div class="row text-center titre">
                <h3 class="">Liste des commandes livrés</h3>
            </div>
            <div class="row" style="overflow:auto;height: 300px;margin: 5px;">
                <!--   tabCmdRecu = tableau qui contient les commande qui n'ont pas encore été acceptés             -->
                <table id="tabCmdRecuLivre" data-toggle="table" data-show-refresh="true" data-url="listCommandeLivre.json" data-height="299" data-click-to-select="true">
                    <thead>
                    <tr>
                        <th data-field="state" data-checkbox="true"></th>
                        <th data-field="num_commande">Identifiant</th>
                        <th data-field="nom_client">Nom du client</th>
                        <th data-field="ad_rue_client">Rue</th>
                        <th data-field="cp_client">Code postal</th>
                        <th data-field="ville_client">Ville</th>
                        <th data-field="mail_client">E-Mail</th>
                        <th data-field="tel_client">Tel client</th>
                        <th data-field="libelle_plateau">Libellé plateau</th>
                        <th data-field="qte_commandee">Qte</th>
                        <th data-field="date_heure">Date/heure commande</th>
                        <th data-field="periode">Période</th>
                        <th data-field="etat">Etat</th>
                    </tr>
                    </thead>
                </table>
        </div>
    </section>
</div>
</body>
</html>