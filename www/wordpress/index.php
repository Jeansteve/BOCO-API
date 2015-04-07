<?php
require 'vendor/autoload.php';

ob_start();



if(isset($_GET['page']))
{
    $page = $_GET['page'];
    /**
     * Si on passe des parametre a la page, je les stocke dans $com
     */
    if(strstr($page, '?'))
    {
        $page = explode("?", $page);
        //echo $page[0];
        $com = explode("=",$page[1]);
        //echo $com[1];
        $cheminPage = "./controleur/".$page[0].".php";

    }
    else
    {
        $cheminPage = "./controleur/".$page.".php";

    }
    include $cheminPage;
}
else
{
    include "vue/index.html";
}
$contenue = ob_get_clean();

include "global/haut.php";

echo $contenue;

include "global/bas.php";