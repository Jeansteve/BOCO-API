<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
    'templates.path' => './API' //j'indique le dossier racine
));

// Je définit le dossier racine dans la vue de slim
$view = $app->view();
$view->setTemplatesDirectory('./API');


$app->get('/details/:numP', 'getDetails');
$app->get('/listPlateau','getListPlateau');

$app->run();

function getDetails($numP)
{
    try
    {
        /**
         * Je récupère les details sans le fromage
         */
        $bdd = new PDO("mysql:host=localhost;dbname=BOCCO-GROUPE1","root","root");
        $req = $bdd->prepare("
              SELECT PL.num_plateau, PL.libelle_plateau, PL.prix_plateau, P.libelle_plat, E.libelle_entree, D.Libelle_Dessert
                FROM PLATEAU PL, PLAT P, ENTREE E, DESSERT D
                WHERE PL.num_plateau = :num
                AND PL.code_plat = P.Code_plat
                AND PL.code_entree = E.Code_entree
                AND PL.code_dessert = D.Code_Dessert
    ") or die(print_r($bdd->errorInfo()));
        $req->bindParam(":num", $numP);
        $req->execute();

//echo print_r($bdd->errorInfo());
        $details = $req->fetchAll(PDO::FETCH_ASSOC);

        // echo json_encode($details);

        //$arr = array("numP" =>utf8_encode($details['num_plateau']), "Titre" => utf8_encode($details['libelle_plateau']), "Prix" => utf8_encode($details['prix_plateau']), "Plat" => utf8_encode($details['libelle_plat']), "Entree" => utf8_encode($details['libelle_entree']), "Dessert" => utf8_encode($details['Libelle_Dessert']));

        $req->closeCursor();

        /**
         * Je récupère le  s'il y en a
         */
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
            // echo json_encode($fromage);
            //echo $fromage['libelle_fromage'];

            $details[0]['libelle_fromage'] = $fromage['libelle_fromage'];
        }
        /**
         * Renvoi des données
         */
        echo json_encode($details[0]);
        //echo print_r($details[0]);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}

function getListPlateau()
{
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
}









//ob_start();
//if(!empty($_GET['page']))
//{
//    $cheminPage = "./controleur/".$_GET['page'].".php";
//    include $cheminPage;
//}
//else
//{
//    include "vue/index.html";
//}
//$contenue = ob_get_clean();
//
//include "global/haut.php";
//
//echo $contenue;
//
//include "global/bas.php";