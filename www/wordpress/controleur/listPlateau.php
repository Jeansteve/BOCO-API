<?php

include "./global/connexionBDD.php";
include "./modele/listPlateau.php";

$plateaux = getListPlateau($bdd);

include "./vue/listPlateau.php";