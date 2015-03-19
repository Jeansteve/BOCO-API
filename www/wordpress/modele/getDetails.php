<?php
$numP = $_GET['numP'];

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
$details = $req->fetch();
//json_encode($details);

$arr = array("numP" =>utf8_encode($details['num_plateau']), "Titre" => utf8_encode($details['libelle_plateau']), "Prix" => utf8_encode($details['prix_plateau']), "Plat" => utf8_encode($details['libelle_plat']), "Entree" => utf8_encode($details['libelle_entree']), "Dessert" => utf8_encode($details['Libelle_Dessert']));

/**
 * Fonction qui convertit les données du tableau sous format xml
 * @param array $arr tableau contient les données
 * @param SimpleXMLElement $xml la balise global xml
 * @return SimpleXMLElement
 */
function array_to_xml(array $arr, SimpleXMLElement $xml)
{
    foreach ($arr as $k => $v) {
        is_array($v)
            ? array_to_xml($v, $xml->addChild($k))
            : $xml->addChild($k, $v);
    }
    return $xml;
}
$detail = new SimpleXMLElement('<detail></detail>');
echo array_to_xml($arr, $detail)->asXML();




