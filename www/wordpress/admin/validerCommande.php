<?php

$num = $_POST['num'];

try
{
    $bdd = new PDO("mysql:host=localhost;dbname=BOCCO-GROUPE1","root","root");

    $query = "UPDATE COMMANDE SET etat = :etat WHERE num_commande = :num";
    $req = $bdd->prepare($query);
    $req->bindValue(":etat", "livre");
    $req->bindValue(":num", $num);
    $req->execute();
    $req->closeCursor();

    echo "reussi";
}
catch (PDOException $e)
{
    $e->getMessage();
}