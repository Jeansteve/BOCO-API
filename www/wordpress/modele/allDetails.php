<?php


function getAllDetails($numP)
{
    try
    {
        //connxion
        $bdd = new PDO("mysql:host=localhost;dbname=BOCCO-GROUPE1","root","root");
        $donnee = array();
        /**
         * Récupèration du nom du chef pour le plat
         */
        $req = $bdd->prepare("
        SELECT C.nom_chef
        FROM  CHEF C, PLAT P, PLATEAU PL
        WHERE PL.num_plateau = :nump
        AND PL.code_plat = P.Code_plat
        AND C.Code = P.code_chef");
        $req->bindValue(":nump", $numP);
        $req->execute();
        //ajout du nom dans mon tablea donnee
        $val= $req->fetch(PDO::FETCH_ASSOC);
        $donnee['chef_plat'] = $val['nom_chef'];
        $req->closeCursor();
        /**
         * Récupération du nom du chef pour le dessert
         */
        $req = $bdd->prepare("
        SELECT C.nom_chef
        FROM  CHEF C, DESSERT D, PLATEAU PL
        WHERE PL.num_plateau = :nump
        AND PL.code_dessert = D.Code_Dessert
        AND C.Code = D.code_chef");
        $req->bindValue(":nump", $numP);
        $req->execute();

        $val= $req->fetch(PDO::FETCH_ASSOC);
        $donnee['chef_dessert'] = $val['nom_chef'];
//    $donnee = json_encode($donnee);
        $req->closeCursor();

        /**
         * récupération du nom du chef pour l'entree
         */
        $req = $bdd->prepare("
        SELECT C.nom_chef
        FROM  CHEF C, ENTREE E, PLATEAU PL
        WHERE PL.num_plateau = :nump
        AND PL.code_entree = E.Code_entree
        AND C.Code = E.code_chef");
        $req->bindValue(":nump", $numP);
        $req->execute();

        $val= $req->fetch(PDO::FETCH_ASSOC);
        $donnee['chef_entree'] = $val['nom_chef'];
        $req->closeCursor();

        //print_r($donnee);
        //$donnee = json_encode($donnee);

        return $donnee;
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}

