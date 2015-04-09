<div class="modal-header" style="background-color: #ff8012; color: white;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h1>Formulaire de commande</h1>
</div>
<div class="modal-body" style="height:auto; margin-right: 10px;">
    <div class="row">
        <form action="./index.php?page=commander" method="post" class="form-horizontal col-lg-12 ">
            <div class="row ">
                <div class="form-group">
                    <label for="qte" class="col-lg-3 control-label "><span class="glyphicon glyphicon-glass"></span>    Quantitée</label>
                    <div class="col-lg-9">
                        <input type="number" name="qte" id="qte" class= "form-control" min="1" required/>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="form-group">
                    <label for="nom" class="col-lg-3 control-label"><span class="glyphicon glyphicon-user"></span>  Nom</label>
                    <div class="col-lg-9">
                        <input type="text" name="nom" id="nom" class= "form-control" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="rue" class="col-lg-3 control-label"><span class="glyphicon glyphicon-road"></span>  Rue</label>
                    <div class="col-lg-9">
                        <input type="text" name="rue" id="rue" class="form-control" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="err_cp" class="form-group ">
                    <label for="cp" class="col-lg-3 control-label"><span class="glyphicon glyphicon-send"></span>    Code postal</label>
                    <div class="col-lg-9">
                        <input type="text" name="cp" id="cp" class="form-control" maxlength="5" required/>
                        <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none;"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="ville" class="col-lg-3 control-label"><span class="glyphicon glyphicon-home"></span>    Ville</label>
                    <div class="col-lg-9">
                        <input type="text" name="ville" id="ville" class="form-control" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="email" class="col-lg-3 control-label"><span class="glyphicon glyphicon-envelope"></span>    E-mail</label>
                    <div class="col-lg-9">
                        <input type="email" name="email" id="rue" class="form-control" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="tel" class="col-lg-3 control-label"><span class="glyphicon glyphicon-earphone"></span>  Téléphone</label>
                    <div class="col-lg-9">
                        <input type="tel" name="tel" id="tel" class="form-control" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="periode" class="col-lg-3 control-label" ><span class="glyphicon glyphicon-cloud"></span>    Période de livraison</label>
                    <div class="col-lg-9">
                        <select name="periode" id="periode" required>
                            <option value="matin">Matinée</option>
                            <option value="apres midi">Après midi</option>
                            <option value="soiree">Soirée</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="text" name="numP" value="<?php echo $_GET['numP']; ?>" hidden="hidden"/> <!--je récuprère le numéro du plateau-->
            <div class="progress">
                <div id="progress_bar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:00%">
                    0%
                </div>
            </div>
            <button class="btn btn-success" id="bt_submit" type="submit"><span class="glyphicon glyphicon-ok-sign" style="color:blue;"></span> Bocaliser votre commande !!</button>
        </form>
    </div>

</div>
<script>
    $(function(){
        var progression = 0;
        var valPrec;
        var valAct;
        var erreur = 0;

        $('#bt_submit').click(function(e){
            if(isNaN($('#cp').val()))
            {
                e.preventDefault();
            }
            //e.preventDefault();
        });
        //alert("Erreur cp");
        $('#cp').change(function(){
            valAct = $(this).val();

            if( valAct == "")
            {
                if(valPrec != "" )
                {
                    progression = calculProgression(progression, "-");
                }
            }
            else if(valAct != "" && valPrec == "" )//si la valeur actuelle est vide et précédente non vide
            {
                if(isNaN(valAct) || valAct <= 9999)
                {
                    $('#err_cp').addClass("has-error has-feedback");//ajout de la class pour l'erreur
                    $(this).next("span").css("display","block");//j'affiche la croix
                }
                else //si c'est un nombre
                {
                    $("#err_cp").removeClass("has-error has-feedback");
                    $(this).next("span").css("display","none");
                    progression = calculProgression(progression, "+");
                }
            }
            else if(valAct != "" && valPrec != "") //Je gère le cas ou il fait une modification
            {
                //alert("Act:"+valAct+" Prec:"+valPrec);
                if(isNaN(valAct))
                {
                    $('#err_cp').addClass("has-error has-feedback");//ajout de la class pour l'erreur
                    $(this).next("span").css("display","block");//j'affiche la croix
                }
                else //si c'est un nombre
                {
                    $("#err_cp").removeClass("has-error has-feedback");
                    $(this).next("span").css("display","none");
                    progression = calculProgression(progression, "+");
                }
            }
            $('#progress_bar').css("width", progression+"%");
            $('#progress_bar').attr("aria-valuenow",progression);
            $('#progress_bar').text(progression+"%");
            //alert($(this).val());
        });

        /**
         * Vérifivation de la progréssion
         */
        $('#qte, #nom, #rue, #ville, #email, #tel, #periode').blur(function () {
            //alert(valPrec);
            valAct = $(this).val();
            if( valAct == "")
            {
                if(valPrec != "" )
                {
                    //progression -= 15;
                    progression = calculProgression(progression, "-");
                }
           }
           else if(valAct != "" && valPrec == "" )
           {
               //progression += 15;
               progression = calculProgression(progression, "+");
           }
            $('#progress_bar').css("width", progression+"%");
            $('#progress_bar').attr("aria-valuenow",progression);
            $('#progress_bar').text(progression+"%");
        //alert($(this).val().empty());
        });

        $('#qte, #nom, #rue, #cp, #ville, #email, #tel, #periode').focus(function () {
            valPrec = $(this).val();
        });
        /**
         * Fonction qui calcule la progression
         * @param prog : je passe la progresison actuelle a la fonction
         * @param sign : je passe le signe pour augmenter ou diminuer la progression
         * @returns {*} : je retourne la progression
         */
        function calculProgression(prog, sign)
        {
            var progress = prog;
            if(sign == "-")
            {
                progress -= 15;
            }
            else
            {
                progress += 15;
            }
            if(progress > 100)
            {
                progress = 100;
            }
            else if(progress < 0)
            {
                progress = 0;
            }

            return progress;
        }

    });
</script>