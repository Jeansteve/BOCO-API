<?php

/**
 * requete qui récupère le libelle du fromage s'il y en a
 **/

$numP = $_GET['numP'];

$bdd = new PDO("mysql:host=localhost;dbname=BOCCO-GROUPE1","root","root");

$req = $bdd->prepare("SELECT DISTINCT F.libelle_fromage
                          FROM FROMAGE F, PLATEAU PL
                          WHERE PL.num_plateau = :num
                          AND PL.code_fromage = F.Code_fromage");

$req->bindValue(":num", $numP);
$req->execute();

$count = $req->rowCount();
if($count == 1)
{
    $fromage = $req->fetch();
   //echo json_encode($fromage);
    echo $fromage['libelle_fromage'];
}
else
{
    echo 0;
}
