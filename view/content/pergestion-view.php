<div class="container-fluid">
    <div class="page-header">
        <h2 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw" style="color: #03a9f4"></i>Persona</h2>
    </div>
</div>

<div class="container-fluid">
    <ul class="breadcrumb breadcrumb-tabs">
        <?php if ($_SESSION['Rol_AuxR'] == "Administrador") : ?>
            <li>
                <a href="<?php echo SERVERURL; ?>pergestion/" class="btn btn-info">
                    <i class="zmdi zmdi-plus"></i> &nbsp; NUEVA PERSONA
                </a>
            </li>
            <li>
                <a href="<?php echo SERVERURL; ?>perlist/" class="btn btn-success">
                    <i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE PERSONAS
                </a>
            </li>
            <li>
                <a href="<?php echo SERVERURL; ?>persearch/" class="btn btn-primary">
                    <i class="zmdi zmdi-search"></i> &nbsp; BUSCAR PERSONA
                </a>
            </li>
        <?php endif; ?>
        <?php if ($_SESSION['Rol_AuxR'] == "Acudiente") : ?>
            <li>
                <a href="<?php echo SERVERURL; ?>persearch/" class="btn btn-primary">
                    <i class="zmdi zmdi-search"></i> &nbsp; BUSCAR PERSONA
                </a>
            </li>
    </ul>
<?php endif; ?>
</div>

<!-- Panel nuevo administrador -->
<div class="container-fluid">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVA PERSONA</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo SERVERURL; ?>ajax/userAjax.php" method="POST" data-form="save" class="AjaxForm" autocomplete="off" enctype="multipart/form.data">
                <fieldset>
                    <legend><i class="zmdi zmdi-account-box" style="color: #03a9f4"></i> &nbsp; Información personal</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">DNI/CÉDULA *</label>
                                    <input pattern="[0-9-]{1,10}" class="form-control" type="text" name="dni-reg" required="" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombres *</label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-reg" required="" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Apellidos *</label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="apellido-reg" required="" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Teléfono</label>
                                    <input pattern="[0-9+]{1,10}" class="form-control" type="text" name="telefono-reg" maxlength="15" required="">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Dirección</label>
                                    <input class="form-control" type="text" name="dire-reg" maxlength="50" required="">
                                </div>
                            </div>
                            <div id="mostrarOcultar2" style="display: none" ;>
                                <div class="col-xs-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Grado</label>
                                        <input class="form-control" type="text" name="grado-reg" maxlength="50">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Director de Grupo</label>
                                        <input class="form-control" type="text" name="direcG-reg" maxlength="50">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <br>
                <fieldset id="mostrarOcultar" style.display="none">
                    <legend><i class="zmdi zmdi-key" style="color: #03a9f4"></i> &nbsp; Datos de la cuenta</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre de usuario *</label>
                                    <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,15}" class="form-control" type="text" name="usuario-reg" maxlength="15">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">E-mail</label>
                                    <input class="form-control" type="email" name="email-reg" maxlength="50">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Género</label>
                                    <div class="radio radio-primary">
                                        <label>
                                            <input type="radio" name="optionsGenero" id="optionsRadios1" value="Masculino" checked="">
                                            <i class="zmdi zmdi-male-alt"></i> &nbsp; Masculino
                                        </label>
                                        &nbsp;
                                        <label>
                                            <input type="radio" name="optionsGenero" id="optionsRadios2" value="Femenino">
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
                    <legend><i class="zmdi zmdi-star" style="color: #03a9f4"></i> &nbsp; Roles</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <p class="text-left">
                                    <div class="label label-success">Administrador</div> Control total del sistema
                                </p>
                                <p class="text-left">
                                    <div class="label label-primary">Acudiente</div> Administrar datos de estudiente
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="radio radio-primary">
                                    <label>
                                        <input type="radio" onclick="mostrar(); ocultar2();" name="optionsPrivilegio" id="optionsRadios1" value="Administrador" checked="">
                                        <i class="zmdi zmdi-star"></i> &nbsp; Administrador
                                    </label>
                                </div>
                                <div class="radio radio-primary">
                                    <label>
                                        <input type="radio" onclick="ocultar(); mostrar2();" name="optionsPrivilegio" id="optionsRadios2" value="Estudiante">
                                        <i class="zmdi zmdi-star"></i> &nbsp; Estudiante
                                    </label>
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