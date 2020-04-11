<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Acudiente </h1>
    </div>
</div>
<div class="container-fluid">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVA PERSONA</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo SERVERURL; ?>ajax/userAjax.php" method="POST" data-form="save" class="AjaxForm" autocomplete="off" enctype="multipart/form.data">
                <fieldset>
                    <legend><i class="zmdi zmdi-account-box"></i> &nbsp; Información personal</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">DNI/CEDULA *</label>
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
                    <legend><i class="zmdi zmdi-key"></i> &nbsp; Datos de la cuenta</legend>
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

                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Genero</label>
                            <div class="radio radio-primary">
                                <label>
                                    <input type="radio" name="optionsGenero" id="optionsRadios1" value="Masculino" checked="">
                                    <i class="zmdi zmdi-male-alt"></i> &nbsp; Masculino
                                </label>
                            </div>
                            <div class="radio radio-primary">
                                <label>
                                    <input type="radio" name="optionsGenero" id="optionsRadios2" value="Femenino">
                                    <i class="zmdi zmdi-female"></i> &nbsp; Femenino
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>

                    <legend><i class="zmdi zmdi-star"></i> &nbsp; Roles</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <p class="text-left">
                                    <div class="label label-success">Acudiente</div> Consultar información estudiante
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="radio radio-primary">
                                    <label>
                                        <input type="radio" name="optionsPrivilegio" id="optionsRadios2" value="Acudiente" checked="">
                                        <i class="zmdi zmdi-star"></i> &nbsp; Acudiente
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <p class="text-center" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                </p>
                <div class="RespuestaAjax"></div>
            </form>
        </div>
    </div>
</div>