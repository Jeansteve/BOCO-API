<?php

function getListPlateau($bdd)
{
    $req = $bdd->query("SELECT num_plateau, libelle_plateau, prix_plateau from PLATEAU");
    $donnees = $req->fetchAll(PDO::FETCH_ASSOC);

    json_encode($donnees);

    return $donnees;
}
