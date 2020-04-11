<div class="container-fluid">
    <div class="page-header">
        <h2 class="text-titles"><i class="zmdi zmdi-account-circle zmdi-hc-fw" style="color: #03a9f4"></i> MIS DATOS</h2>
    </div>
</div>

<!-- Panel mis datos -->
<div class="container-fluid">
    <?php
    $data = explode("/", $_GET['views']);

    if ($data[1] == "Admin" || $data[1] == "Acu") :
        if ($_SESSION['Rol_AuxR'] == "") {
            echo $lc->close_session_controller();
        }

        require_once "./controller/userController.php";
        $classAdmin = new userController();

        $filesA = $classAdmin->data_user_controller("Unico", $data[2]);

        if ($filesA->rowCount() == 1) {
            $campo = $filesA->fetch();

            if ($campo['Code_Person'] != $_SESSION['Code_AuxR']) {
                if ($_SESSION['Rol_AuxR'] == "") {
                    echo $lc->close_session_controller();
                }
            }
    ?>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="zmdi zmdi-refresh"></i> &nbsp; MIS DATOS</h3>
                </div>
                <div class="panel-body">
                    <form action="<?php echo SERVERURL; ?>ajax/userAjax.php" method="POST" data-form="update" class="AjaxForm" autocomplete="off" enctype="multipart/form.data">
                        <input type="hidden" name="cuenta-up" value="<?php echo $data[2]; ?>">
                        <fieldset>
                            <legend><i class="zmdi zmdi-account-box" style="color: #03a9f4"></i> &nbsp; Información personal</legend>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">DNI/CÉDULA *</label>
                                            <input pattern="[0-9-]{1,10}" class="form-control" type="text" name="dni-up" value="<?php echo $campo['DNI_Person']; ?>" required="" maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nombres *</label>
                                            <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-up" value="<?php echo $campo['Name_Person']; ?>" required="" maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Apellidos *</label>
                                            <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" value="<?php echo $campo['Last_Person']; ?>" name="apellido-up" required="" maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Teléfono</label>
                                            <input pattern="[0-9+]{1,15}" class="form-control" type="text" value="<?php echo $campo['Tel_Person']; ?>" name="telefono-up" maxlength="15">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Dirección</label>
                                            <input class="form-control" type="text" value="<?php echo $campo['Adress']; ?>" name="dire-reg" maxlength="50" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <p class="text-left" style="margin-left: 900px;">
                            <button type="submit" class="btn btn-info btn-raised btn-xm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                        </p>
                        <div class="RespuestaAjax"></div>
                    </form>
                </div>
            </div>
        <?php
        } else { ?>
            <div class="container-fluid">
                <div class="alert alert-dismissible alert-warning text-center">
                    <button class="close" type="button" data-dismiss="alert">x</button>
                    <i class="zmdi zmdi-alert-triangle zmdi-hc-5x"></i>
                    <h4>!Lo sentimos¡</h4>
                    <p>Ocurrio un error inesperado</p>
                </div>
            </div>
        <?php
        } else :
        ?>
        <div class="container-fluid">
            <div class="alert alert-dismissible alert-warning text-center">
                <button class="close" type="button" data-dismiss="alert">x</button>
                <i class="zmdi zmdi-alert-triangle zmdi-hc-5x"></i>
                <h4>!Lo sentimos¡</h4>
                <p>Ocurrio un error inesperado</p>
            </div>
        </div>

    <?php endif; ?>

</div>