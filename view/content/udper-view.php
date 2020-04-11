<div class="container-fluid">
    <div class="page-header">
        <h2 class="text-titles"><i class="zmdi zmdi-settings zmdi-hc-fw" style="color: #03a9f4"></i> MI CUENTA</h2>
    </div>
</div>
<?php
$data = explode("/", $_GET['views']);

if (isset($data[1]) && ($data[1] == "Admin" || $data[1] == "Acu")) :

    require_once "./controller/accountController.php";
    $classA = new accountController();
    
    $fileA = $classA->data_user_controller($data[2]);

    if ($fileA->rowCount() == 1) {
        $campos = $fileA->fetch();
?>
        <div class="container-fluid">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="zmdi zmdi-refresh"></i> &nbsp; MI CUENTA</h3>
                </div>
                <div class="panel-body">
                    <form action="<?php echo SERVERURL; ?>ajax/accountAjax.php" method="POST" data-form="update" class="AjaxForm" autocomplete="off" enctype="multipart/form.data">
                        <?php
                        if ($_SESSION['Code_AuxR'] != $campos['Code_Account']) {
                            if ($_SESSION['Rol_AuxR'] != "Administrador" || $_SESSION['Rol_AuxR'] == "") {
                                echo $lc->close_session_controller();
                            } else {
                                echo '<input type="hidden" name="rol_up" value="verdadero">';
                            }
                        } else {
                            # code...
                        }

                        ?>
                        <input type="hidden" name="account_up" value="<?php echo $data[2] ?>">
                        <input type="hidden" name="rol-up" value="<?php echo $lc->encryption($data[1]) ?>">
                        <fieldset>
                            <legend><i class="zmdi zmdi-key" style="color: #03a9f4"></i> &nbsp; Datos de la cuenta</legend>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nombre de usuario *</label>
                                            <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,15}" class="form-control" type="text" value="<?php echo $campos['Username']; ?>" name="usuario-up" maxlength="15">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nuevo Nombre de usuario *</label>
                                            <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,15}" class="form-control" type="text" name="new-user" maxlength="15">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">E-mail</label>
                                            <input class="form-control" type="email" value="<?php echo $campos['Email']; ?>" name="email-up" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Género</label>
                                            <div class="radio radio-primary">
                                                <label>
                                                    <input type="radio" name="optionsGenero" <?php if ($campos['Gender'] == "Masculino") {
                                                                                                    echo 'checked=""';
                                                                                                } ?> id="optionsRadios1" value="Masculino">
                                                    <i class="zmdi zmdi-male-alt"></i> &nbsp; Masculino
                                                </label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <label>
                                                    <input type="radio" name="optionsGenero" <?php if ($campos['Gender'] == "Femenino") {
                                                                                                    echo 'checked=""';
                                                                                                } ?>id="optionsRadios2" value="Femenino">
                                                    <i class="zmdi zmdi-female"></i> &nbsp; Femenino
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset>
                            <legend><i class="zmdi zmdi-lock" style="color: #03a9f4"></i> &nbsp; Contraseña</legend>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Contraseña actual *</label>
                                            <input class="form-control" type="password" value="<?php echo $campos['Password']; ?>" name="password-up" maxlength="70">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nueva contraseña *</label>
                                            <input class="form-control" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{8,12}" type="password" name="newPassword1-up" maxlength="70">
                                            <p class="help-block">Contraseña de 8 a 12 caracteres</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Repita la nueva contraseña *</label>
                                            <input class="form-control" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{8,12}" type="password" name="newPassword2-up" maxlength="70">
                                            <p class="help-block">Contraseña de 8 a 12 caracteres</p>
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
<?php
endif;
?>
<!-- Panel mi cuenta -->