
<div id="accordeonList" class="panel-group col-lg-9 col-lg-offset-3">
    <h3>Vos BOCO en Bocal à emporter</h3>
    <?php
    $i = 0; // permet de numéroter les plateaux
        foreach($plateaux As $plateau)
        {
            $i += 1;
            $div = "<div class='panel panel-info'>";
            $div .= "<div class='col-lg-12 entete '>";
            $div .= "<h3 class='panel-title'>";
            $div .= "<span class='col-lg-10'>".$plateau['libelle_plateau']."</span>";
            $div .= "<a href='#".$plateau['num_plateau']."' data-parent='#accordeonList' data-toggle='collapse'  class='btDetail col-lg-2' num='".$plateau['num_plateau']."' >Détails</a>";
            $div .= "</h3></div></div>";

            $content = "<div class='panel-collapse collapse' id='".$plateau['num_plateau']."' >";
            $content .= "<div class='panel-body'>";

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
<script type="text/javascript">
    $(function(){
        var numP;
        //function getDetails(numP)
        $('.btDetail').click(function(){
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
                    var prix = "<h2 class='col-lg-3'>"+$(xml).find('Prix').text()+" €</h2></div>";
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
                        "<button data-toggle='modal' href=\"vue/commander.php?numP="+ numP + "\" data-target='#infos' class='btn btn-primary col-lg-3' style='margin-right:15px;'>commander </button>"+
                        "<div class='modal fade' id='infos'>"+
                        "<div class='modal-dialog'>"+
                        "<div class='modal-content'></div>"+
                        "</div></div> </div>"
                        );
                        /**
                         * Ajout du bouton pour les infos sur un plateau
                         */
                        $(details).append("" +
                            "<button data-toggle='modal' href=\"vue/allDetails.php?numP="+ numP + "\" data-target='#infos' class='btn btn-primary col-lg-8'>Qui a confectionner mon BoCo ?? </button>"+
                            "<div class='modal fade' id='infosChef'>"+
                            "<div class='modal-dialog'>"+
                            "<div class='modal-content'></div>"+
                            "</div></div> </div>"
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

            $('div').each(function(){
               if($(this).hasClass("in"))
               {
                   $(this).removeClass('in');
               }
            });
        });
        /**
         * J'éfface l'encien modal et je met l'adresse du nouveau bouton
         */
        $("body").on("hidden.bs.modal", ".modal", function () {
            $(this).removeData("bs.modal");
        });



//        $("#infoChef").click(function() {
//            $("#infos").modal({ remote: "vue/allDetails.php?numP= "+numP+"" } ,"show");
//        });

    });
</script>