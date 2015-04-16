
<div id="accordeonList" class="panel-group col-lg-9 col-lg-offset-3">
    <h3>Vos BOCO en Bocal à emporter</h3>
    <?php
    //echo date('Y-m-d H:i:s');
    $i = 0; // permet de numéroter les plateaux
        foreach($plateaux As $plateau)
        {
            $i += 1;
            $div = "<div class='panel panel-info'>";
            $div .= "<div class='col-lg-12 entete '>";
            $div .= "<h3 class='panel-title'>";
            $div .= "<span class='col-lg-10'>".$plateau['libelle_plateau']."</span>";
            $div .= "<a href='#".$plateau['num_plateau']."'  data-parent='#accordeonList' data-toggle='collapse'  class=' btDetail col-lg-2' num='".$plateau['num_plateau']."' >Détails <span  class='glyphicon glyphicon-plus'></span></a>";
            $div .= "</h3></div></div>";

            $content = "<div class='panel-collapse collapse' id='".$plateau['num_plateau']."' >";
            $content .= "<div class='panel-body'><img src='../images/ajax-loader.gif' alt='Chargement en cours ...'/>Chargement en cours ... ";

            /**
             * Bouton pour le formulaire de la commande et la quantitée
             */
            //je passe le numéro de la commande en get
//            $form = "<form action='commander.php' method='get' id='form-commande'>";
//            $form .= "<label for='qt'>Saisir la quantité : </label>";
//            $form .= "<input type='text' name='quantitee' id='qt' required/>";
//            $form .= "<input type='text' name='numP' value='".$plateau['num_plateau']."' hidden/>";
//            $form .= "<input type='submit' value='Commmander'/>";
//            $form .= "</form>";

            $content .= "</div></div>"; // fermeture du contenu

            /**
             * Affichage
             */

            echo $div; //entête de l'accordeon
            echo $content; //contenu de l'accordeon
        }

    ?>
</div>

<?php
/**
 * Gestion des parametres
 */
if(!empty($com))
{
    //j'affiche le modal
    echo "<script>$(function(){ $('#infos').modal('show'); });</script>";
}
?>
<!-- Balise qui va accueillir le contenu du modal-->
<div class="modal fade" id="infos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header " style="background-color: #ff8012; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-ok"></span>    Confirmation !!!!</h4>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <p class="col-lg-9">Votre commande a été pris en compte <br/>Seul c'est bien,à deux c'est mieu ! <br/>commander un autre bocal ! </p>
                    <span class="col-lg-3" ><img style="width:80px;height: 80px;" src="../images/logo-pouce.jpg" alt="Bien"/></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        var numP;
        //function getDetails(numP)
        $('.btDetail').click(function(e){
            //alert($(this).attr("id"));
            var num = $(this).attr("num");
            /*
            ** Je récupère les noeuds parents un a un
             */
            var h3 = this.parentNode;
            var div1 = h3.parentNode;
            var div2 = div1.parentNode;
            var details = div2.nextSibling.childNodes;

            //alert(div2.nextSibling.textContent = "ok");

            $.ajax({
                type: "GET",
                url: "../modele/getDetails.php?numP="+ num,
                dataType: "xml",
                success: function(xml)
                {
                    numP = $(xml).find('numP').text();
                    var titre = "<div class='row col-lg-12'><h2 class='col-lg-9'>"+$(xml).find('Titre').text()+"</h2>";
                    var prix = "<h2 class='col-lg-3' >"+$(xml).find('Prix').text()+" <span class='glyphicon glyphicon-euro'></span></h2></div>";
                    var entree = "<div class='row'><img class='col-lg-4' src='./images/plateau"+num+".jpg' alt=''/><ul class='col-lg-8'><span class='det"+num+" enonce col-lg-12'>Entrée</span><li>"+$(xml).find('Entree').text()+"</li>";
                    var plat = "<span class='enonce col-lg-12' >Plat</span><li>"+$(xml).find('Plat').text()+"</li>";
                    var dessert = "<span class='enonce col-lg-12'>Dessert</span><li>"+$(xml).find('Dessert').text()+"</li>";

                    var row = "<div class='row col-lg-12'>"; // block global des détails

                    row += titre;
                    row += prix;
                    row += entree;
                    row +=plat;
                    row += dessert;
                    /**
                     * Je récupère le fromage s'il y en a
                     */
                    $.get("../modele/getFromage.php?numP="+num, function( data ){
                        if(data != 0)
                        {
                            $.fromage = "<span class='enonce col-lg-12'>Fromage</span><li>"+data+"</li></ul></div>";
                            row += $.fromage;
                        }
                        else
                        {
                            $.fromage = "</ul></div>";
                            row += $.fromage;
                        }

                        $(details).html(row);//si je met cette ligne hors du get la variable $.fromage ne sera plus disponible

//                        $(details).append("<form action='./index.php?page=commander' method='post' id='form-commande'>" +
//                        "<input type='text' name='numP' value='"+numP+"' hidden/>" +
//                        "<input type='submit' value='Commmander'/>" +
//                        "</form>");


                        /**
                         * Ajout du bouton commander et de la page de commande en modal
                         */
                        $(details).append("" +
                        "<button data-toggle='modal' data-backdrop='static' href=\"vue/commander.php?numP="+ numP + "\" data-target='#infos' class='btn btn-primary btn-lg  col-lg-3' style='margin-right:15px;'><span class='glyphicon glyphicon-shopping-cart'></span>  commander </button>"
                        );
                        /**
                         * Ajout du bouton pour les infos sur un plateau
                         */
                        $(details).append("" +
                            "<button data-toggle='modal' data-backdrop='static' href=\"vue/allDetails.php?numP="+ numP + "\" data-target='#infos' class='btn btn-primary btn-lg col-lg-8'><span class='glyphicon glyphicon-info-sign'></span> Qui a confectionner mon BoCo ?? </button>"
                        );

                    });
                }
//                $('.det1').attr("data-toggle","tooltip");
//                $('ul span').attr("data-placement","left");
//                $('ul span').attr("title","Tooltip on left");
            });

            /**
             * L'ors du click sur un boutton details je dois fermer les autres accordeon
             * */

            $('.panel-collapse').each(function(){
               if($(this).hasClass("in"))
               {
                   $(this).prev('div').find(".glyphicon").attr("class","glyphicon glyphicon-plus"); //je change l'icon du boutton détails
                   $(this).removeClass('in');
               }
            });

            $(this).children('span').attr('class','glyphicon glyphicon-minus');
            //alert ($.span);
        });
        /**
         * J'éfface l'encien modal et je met l'adresse du nouveau bouton
         */
        $("body").on("hidden.bs.modal", ".modal", function () {
            $(this).removeData("bs.modal");
        });



    });
</script>