<?php

    try
    {
        $bdd = new PDO("mysql:host=localhost;dbname=BOCCO-GROUPE1","root","root");

        $req = $bdd->prepare("
        SELECT COM.num_commande, CL.nom_client, CL.ad_rue_client, CL.cp_client, CL.ville_client, CL.mail_client, CL.tel_client, PL.libelle_plateau, CON.qte_commandee, COM.date_heure, COM.periode, COM.etat
        FROM CLIENT CL, PLATEAU PL, CONTENIR CON, COMMANDE COM
        WHERE CL.Code_client = COM.code_client
        AND  CON.num_commande = COM.num_commande
        AND CON.num_plateau = PL.num_plateau
        AND COM.etat = :etat
        ORDER BY COM.num_commande ASC
        ");
        $req->execute(array(
            ":etat" => "non livre"
        ));
        $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
        //echo print_r($donnees);

        $donnees = json_encode($donnees);
        //echo $donnees;
        $error = json_last_error_msg();


        //echo print_r($error);
        $req->closeCursor();
        /**
         * Ouverture tu fichier json : listCommandeNonLivre.json
         */
        /**
         * La fonction fputs ajout le texte au début du fichier, elle ne le remplace pas.
         */
        //je vide le fichier
        $fichierJson = fopen('listCommandeNonLivre.json', 'r+');
        file_put_contents('listCommandeNonLivre.json', ' '); //vide le contenu du fichier
        fputs($fichierJson, $donnees);
        fclose($fichierJson);

        //echo json_encode($donnees);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }


    try
    {
        $bdd = new PDO("mysql:host=localhost;dbname=BOCCO-GROUPE1","root","root");

        $req = $bdd->prepare("
        SELECT COM.num_commande, CL.nom_client, CL.ad_rue_client, CL.cp_client, CL.ville_client, CL.mail_client, CL.tel_client, PL.libelle_plateau, CON.qte_commandee, COM.date_heure, COM.periode, COM.etat
        FROM CLIENT CL, PLATEAU PL, CONTENIR CON, COMMANDE COM
        WHERE CL.Code_client = COM.code_client
        AND  CON.num_commande = COM.num_commande
        AND CON.num_plateau = PL.num_plateau
        AND COM.etat = :etat
        ORDER BY COM.num_commande ASC
        ");
        $req->execute(array(
            ":etat" => "livre"
        ));
        $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
        //echo print_r($donnees);

        $donnees = json_encode($donnees);
        //echo $donnees;
        $error = json_last_error_msg();

        //echo print_r($error);
        $req->closeCursor();
        /**
         * Ouverture tu fichier json : listCommandeNonLivre.json
         */
        /**
         * La fonction fputs ajout le texte au début du fichier, elle ne le remplace pas.
         */
        //je vide le fichier
        $fichierJson = fopen('listCommandeLivre.json', 'r+');
        file_put_contents('listCommandeLivre.json', ' ');        //vide le contenu du fichier
        fputs($fichierJson, $donnees);
        fclose($fichierJson);

        //echo json_encode($donnees);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
//}
?>
