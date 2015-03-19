/**
 * Created by eken on 30/01/2015.
 */

$(function(){

    /**
     * Appliquer le style bootstrap au formulaire
     */
    $('#block_inscription1 div').each(function(){
        $(this).addClass("row");
    });
    $('#block_inscription1 label').each(function () {
        $(this).addClass("col-lg-5");
    });
    $('#block_inscription1 span').each(function(){
        $(this).addClass("col-lg-7");
    });
    $('#block_inscription1 input').each(function(){
       $(this).addClass("form-control");
        /**
         * Quand l'input perd le focus il redevient bleu pour le cas des erreurs
         */
        $(this).blur(function(){
            $(this).parent("div").removeClass("has-error");
        });
    });
    $('.part').each(function(){
       $(this).addClass("col-lg-12");
    });
    $('#table_inscription').addClass("col-lg-12");


    /*
    Quand il coche ou decoche une option
     */
    $('.option').change(function(){
        verifierOption();
    });

    /**
     * Fonction qui désélectionne les autres options lorsque le maximum est atteint
     */
    function verifierOption()
    {
        var cpt = 0;
        //je compte le nombre d'option choisie
       $('.option').each(function(e){
          if(this.checked)
          {
              cpt++
          }
       });
        //je récupère le nombre d'élément cocher pour vérifier qu'il envoi 4 options
        $('input[name="nbrOptionChoisi"]').attr("value",cpt);
        //$('input[name="nbrOptionChoisi"]').show();
       if(cpt == 4)
       {
           //je désactive les autres options
           $('.option').each(function(e){
              if(!this.checked)
              {
                  $(this).attr('disabled','disabled');
              }
           });
       }
        else if(cpt < 4)
       {
           $('.option').each(function(e){
               if($(this).attr('disabled') == 'disabled')
               {
                   $(this).removeAttr('disabled');
               }
           });
       }
    //alert(cpt);
    }

    /**
     * Vérification lors de l'envoie du formulaire
     */
    $('#formulaire').submit(function(e){
        e.preventDefault(); //// Le navigateur ne peut pas envoyer le formulaire

         var donnees = $(this).serialize(); //contient les données du formulaire
        $.ajax({
            url : "controleur/enregistrer.php",
            type : "POST",
            data: donnees,
            dataType: "json",
            success : function(reponse)
            {
                if(reponse != "1")
                {
                    var err = "<div class=\"alert alert-block alert-danger\" style=\"display:none\"><h4>Erreur !</h4>" + reponse.msg + "</div>";
                    if(reponse.err == "option")
                    {
                        $("#table_options").after(err);
                        $("div.alert").show("slow").delay(4000).hide("slow",function(){
                            $(this).remove();
                        });
                    }
                    else
                    {
                        $('input[name='+reponse.err+']').parent("div").addClass("has-error");

                        /*
                         Je crée la div qui afichera le message d'erreur
                         */

                        $('input[name='+reponse.err+']').after(err);
                        $("div.alert").show("slow").delay(4000).hide("slow",function(){
                            $(this).remove();
                        });

                        $('html, body').animate({
                            scrollTop: $('input[name='+reponse.err+']').offset().top
                        }, 500, function(){
                            $('input[name='+reponse.err+']').focus();
                        });
                    }
                }
                else
                {
                    //window.location.href = "effectuer.php"; /// redirection
                    $("#container").html("<div class='effectuer col-lg-12'><h1>Inscription effectu&eacute;e !!!!!</h1></div>")
                        .addClass("col-lg-8")
                        .css("left","50px");
                }
            }
        });
    });

    /**
     * Verification pour le formulaire d'administration
     */

    $('#form_admin').submit(function(e){
        e.preventDefault(); //// Le navigateur ne peut pas envoyer le formulaire
        $("#err_admin").hide();
        var donnee = $(this).serialize();
        $.ajax({
            url : "controleur/admin.php",
            type: "POST",
            data: donnee,
            dataType: "text",
            success: function(reponse){
                if(reponse == 1)
                {
                    window.location.href = "exporterDonnees.php";
                }
                else
                {
                    $("#err_admin").html(reponse).fadeIn("slow").delay(4000).fadeOut("slow");
                }
            }


        });

    });

});
