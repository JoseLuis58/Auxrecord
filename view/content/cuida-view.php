<div class="container-fluid">
    <div class="page-header">
        <h2 class="text-titles"><i class="zmdi zmdi-balance zmdi-hc-fw" style="color: #03a9f4"></i> Cuidado Médico </h2>
    </div>
</div>

<div class="container-fluid">
    <ul class="breadcrumb breadcrumb-tabs">
        <li>
            <a href="<?php echo SERVERURL; ?>cuida/" class="btn btn-info">
                <i class="zmdi zmdi-plus"></i> &nbsp; NUEVO CUIDADO MÉDICO
            </a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>cuidalist/" class="btn btn-success">
                <i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE CUIDADOS MÉDICOS
            </a>
        </li>
    </ul>
</div>
<?php  
    require_once "./controller/nurseController.php";
    $classC = new nurseController();

    $filesO = $classC->dataEve();

    if ($filesO->rowCount() == 1) {
        $campo = $filesO->fetch();

?>
<div class="container-fluid">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; DATOS CUIDADO</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo SERVERURL; ?>ajax/medicalCareAjax.php" method="POST" data-form="save" class="AjaxForm" autocomplete="off" enctype="multipart/form.data">
                <fieldset>
                    <legend><i class="zmdi zmdi-assignment" style="color: #03a9f4"></i> &nbsp; Datos básicos</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">DNI/DOCUMENTO DE IDENTIDAD *</label>
                                    <input pattern="[0-9-]{1,30}" class="form-control" type="text" name="dni-reg" required="" maxlength="30" value="<?php echo $campo['Id_Person'];?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Egreso Hospital</label>
                                    <div class="radio radio-primary">
                                        <label>
                                            <input type="radio" name="optionsEgre" id="optionsRadios1" value="Si">
                                            <i class="zmdi zmdi-sign-in"></i> &nbsp; Si
                                        </label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <label>
                                            <input type="radio" name="optionsEgre" id="optionsRadios2" value="No" checked="">
                                            <i class="zmdi zmdi-close"></i> &nbsp; No
                                        </label>
                                    </div>
                                </div>
                            </div>
                </fieldset>
                <br>
                <fieldset>
                    <div class="col-xs-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Observaciones *</label>
                            <textarea class="form-control" name="observaciones-reg" id="signos-reg" required="" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Recomendaciones *</label>
                            <textarea class="form-control" name="rec-reg" id="rec-reg" required="" rows="3"></textarea>
                        </div>
                    </div>
                </fieldset>
                <br>
                <p class="text-left" style="margin-left: 900px;">
                    <button type="submit" class="btn btn-info btn-raised btn-xm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                </p>
                <div class="RespuestaAjax"></div>
            </form>
        </div>
    </div>
</div>
<?php
    } else {
    ?>
        <div class="container-fluid">
            <div class="alert alert-dismissible alert-warning text-center">
                <button class="close" type="button" data-dismiss="alert">x</button>
                <i class="zmdi zmdi-alert-triangle zmdi-hc-5x"></i>
                <h4>!Lo sentimos¡</h4>
                <p>Error de Cuenta</p>
            </div>
        </div>
    <?php
    } 
    ?>