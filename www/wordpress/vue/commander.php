<div class="modal-header" style="background-color: #ff8012; color: white;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h1>Formulaire de commande</h1>
</div>
<div class="modal-body" style="height:auto; margin-right: 10px;">
    <div class="row">
        <form action="" class="form-horizontal col-lg-12 ">
            <div class="row ">
                <div class="form-group">
                    <label for="qte" class="col-lg-3 control-label">Quantitée : </label>
                    <div class="col-lg-9">
                        <input type="number" name="qte" id="qte" class= "form-control" min="1"/>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="form-group">
                    <label for="nom" class="col-lg-3 control-label">Nom : </label>
                    <div class="col-lg-9">
                        <input type="text" name="nom" id="nom" class= "form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="rue" class="col-lg-3 control-label">Rue : </label>
                    <div class="col-lg-9">
                        <input type="text" name="rue" id="rue" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="rcpue" class="col-lg-3 control-label">Code postal : </label>
                    <div class="col-lg-9">
                        <input type="text" name="cp" id="cp" class="form-control" maxlength="5"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="ville" class="col-lg-3 control-label">Ville : </label>
                    <div class="col-lg-9">
                        <input type="text" name="ville" id="ville" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="email" class="col-lg-3 control-label">E-mail : </label>
                    <div class="col-lg-9">
                        <input type="email" name="email" id="rue" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="tel" class="col-lg-3 control-label">Téléphone : </label>
                    <div class="col-lg-9">
                        <input type="tel" name="tel" id="tel" class="form-control"/>
                    </div>
                </div>
            </div>
            <input type="text" name="numP" value="<?php echo $_GET['numP']; ?>" hidden="hidden"/> <!--je récuprère le numéro du plateau-->
            <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-ok-sign" style="color:blue;"></span> Bocaliser votre commande !!</button>
        </form>
    </div>

</div>
