<?php
try
{
    $bdd = new PDO("mysql:host=localhost;dbname=BOCCO-GROUPE1","root","root");
    $req = $bdd->query("SELECT num_plateau, libelle_plateau, prix_plateau from PLATEAU");
    $donnees = $req->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($donnees);
}
catch(PDOException $e)
{
    echo "error : "+ $e->getMessage();
}
