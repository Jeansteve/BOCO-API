<?php
require 'vendor/autoload.php';


$app = new \Slim\Slim();
/**
 * Fonction qui récupère la liste des plateaux
 */

$app->config(array(
    'debug' => true
));

//$app->get('/',function(){
//   echo "bonjour";
//});

$app->get('/query/plateau', function () {
    try
    {
        $bdd = new PDO("mysql:host=localhost;dbname=BOCCO-GROUPE1","root","root");
        $req = $bdd->query("SELECT num_plateau, libelle_plateau, prix_plateau from PLATEAU");
        $donnees = $req->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($donnees);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    $req->closeCursor();
});
/***
 * Récupère les détails d'un plateau
 */
$app->get('/query/details/:numP', function($numP){
    try
    {
        $bdd = new PDO("mysql:host=localhost;dbname=BOCCO-GROUPE1","root","root");
        $req = $bdd->prepare("
              SELECT PL.libelle_plateau, PL.prix_plateau, P.libelle_plat, E.libelle_entree, D.Libelle_Dessert
                FROM PLATEAU PL, PLAT P, ENTREE E, DESSERT D
                WHERE PL.num_plateau = :num
                AND PL.code_plat = P.Code_plat
                AND PL.code_entree = E.Code_entree
                AND PL.code_dessert = D.Code_Dessert
        ") or die(print_r($bdd->errorInfo()));
        //$req->bindValue(":num", $numP);
        $req->execute(array(
            ":num"=> $numP
        ));

//        echo print_r($req2->errorInfo());

        $details = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        //print_r($details[0]);
        //echo json_encode($details);

        /**
         * Récupère le fromage s'il y en a
         */
        $req = $bdd->prepare("
            SELECT DISTINCT F.libelle_fromage
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
            //echo $fromage['libelle_fromage'];

            $details[0]["libelle_fromage"] = $fromage['libelle_fromage']; //j'ajoute le fromage
        }
        //je renvoi les details
        print_r($details[0]);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

});
$app->run();