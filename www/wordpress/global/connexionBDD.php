<?php
/*
* Connextion à la base de donnée
*/
try
{
    $bdd = new PDO("mysql:host=localhost;dbname=BOCCO-GROUPE1;charset=utf8","root","root");
}
catch(PDOException $e)
{
    echo "erreur_connexion : ".$e->getMessage();
}
?>