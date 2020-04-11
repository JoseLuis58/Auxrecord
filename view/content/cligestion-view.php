<div class="container-fluid">
    <div class="page-header">
        <h2 class="text-titles"><i class="zmdi zmdi-balance zmdi-hc-fw" style="color: #03a9f4"></i> Historial Clínico</h2>
    </div>
</div>

<div class="container-fluid">
    <ul class="breadcrumb breadcrumb-tabs">
        <li>
            <a href="<?php echo SERVERURL; ?>cligestion/" class="btn btn-info">
                <i class="zmdi zmdi-plus"></i> &nbsp; NUEVO HISTORIAL
            </a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>clilist/" class="btn btn-success">
                <i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE HISTORIALES
            </a>
        </li>
    </ul>
</div>
<?php  
    require_once "./controller/medicalController.php";
    $classO = new medicalController();

    $filesO = $classO->dataEve();

    if ($filesO->rowCount() == 1) {
        $campo = $filesO->fetch();

?>
<!-- panel datos de la empresa -->
<div class="container-fluid">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; DATOS HISTORIAL</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo SERVERURL; ?>ajax/medicalAjax.php" method="POST" data-form="save" class="AjaxForm" autocomplete="off" enctype="multipart/form.data">
                <fieldset>
                    <legend><i class="zmdi zmdi-assignment" style="color: #03a9f4"></i> &nbsp; Datos básicos</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">DNI/DOCUMENTO DE IDENTIDAD *</label>
                                    <input pattern="[0-9-]{1,10}" class="form-control" type="text" name="dni-his" required="" maxlength="30" value="<?php echo $campo['Id_Person']; ?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre y Apellidos *</label>
                                    <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="nombre-his" required="" maxlength="40" value="<?php echo $campo['Name_Person']; ?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Teléfono</label>
                                    <input pattern="[0-9+]{1,10}" class="form-control" type="text" name="telefono-his" required="" maxlength="15" value="<?php echo $campo['Tel']; ?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Lugar de Nacimiento</label>
                                    <input class="form-control" type="text" name="lugar-his" required="" maxlength="170">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Dirección</label>
                                    <input class="form-control" type="text" name="direccion-his" required="" maxlength="170" value="<?php echo $campo['Adress']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <br>
                <fieldset>
                    <div class="col-xs-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Patologias *</label>
                            <textarea class="form-control" name="pato-his" id="pato-his" required="" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Antecedentes Familiares *</label>
                            <textarea class="form-control" name="ante-his" id="ante-his" required="" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Condiciones alimentarias *</label>
                            <textarea class="form-control" name="cond-his" id="cond-his" required="" rows="1"></textarea>
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