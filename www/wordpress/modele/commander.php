<?php
/**
 * Recupération des données
 */
$numP = htmlspecialchars($_POST['numP']);
$nom = htmlspecialchars(($_POST['nom']));
$rue = htmlspecialchars($_POST['rue']);
$cp = htmlspecialchars($_POST['cp']);
$ville = htmlspecialchars($_POST['ville']);
$tel = htmlspecialchars($_POST['tel']);
$email = htmlspecialchars($_POST['email']);
$qte = htmlspecialchars($_POST['qte']);


try
{
    $bdd = new PDO("mysql:host=localhost;dbname=BOCCO-GROUPE1","root","root");

    $req = $bdd->prepare("INSERT INTO CLIENT(nom_client,ad_rue_client,cp_client,ville_client,mail_client,tel_client)
      VALUES (:nom,:rue,:cp,:ville,:email,:tel)
    ");
    $req->bindValue(":nom",$nom);
    $req->bindValue(":rue",$rue);
    $req->bindValue(":cp",$cp);
    $req->bindValue(":ville",$ville);
    $req->bindValue(":email",$email);
    $req->bindValue(":tel",$tel);

    $req->execute();

    $numClient = $bdd->lastInsertId(); //je récupère le numéro du client
    $req->closeCursor();
    /**
     * Remplissage de la table commande
     */
    $req = $bdd->prepare("INSERT INTO COMMANDE(code_client,date_heure)
      VALUES(:code, NOW())
    ");

    $req->bindValue(":code",$numClient);

    $req->execute();

    $numCommande = $bdd->lastInsertId(); // je récupère l'identifiant de la commande

    $req->closeCursor();
    /**
     * Remplissage de la table contenir pour ajouter la quantitée
     */
    $req = $bdd->prepare("INSERT INTO CONTENIR(num_commande,num_plateau,qte_commandee)
      VALUES(:numC,:numP, :qte)
    ");

    $req->bindValue(":numC",$numCommande);
    $req->bindValue(":numP",$numP);
    $req->bindValue(":qte",$qte);

    $req->execute();
    $req->closeCursor();

    echo "enregistrer";
}
catch(PDOException $e)
{
    echo $e->getMessage();
}