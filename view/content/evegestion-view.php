<div class="container-fluid">
    <div class="page-header">
        <h2 class="text-titles"><i class="zmdi zmdi-balance zmdi-hc-fw" style="color: #03a9f4"></i> Evento Enfermería </h2>
    </div>
</div>

<div class="container-fluid">
    <ul class="breadcrumb breadcrumb-tabs">
    <?php if($_SESSION['Rol_AuxR']=="Administrador"):?>
        <li>
            <a href="<?php echo SERVERURL; ?>evegestion/" class="btn btn-info">
                <i class="zmdi zmdi-plus"></i> &nbsp; NUEVO EVENTO
            </a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>evelist/" class="btn btn-success">
                <i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE EVENTOS
            </a>
        </li>
        <?php endif;?>
        <?php if($_SESSION['Rol_AuxR']=="Acudiente"):?>
            <li>
            <a href="<?php echo SERVERURL; ?>evelist/" class="btn btn-success">
                <i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE EVENTOS
            </a>
        </li>
        <?php endif; ?>
    </ul>
</div>

<!-- panel datos de la empresa -->
<div class="container-fluid">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; DATOS EVENTO</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo SERVERURL; ?>ajax/nurseAjax.php" method="POST" data-form="save" class="AjaxForm" autocomplete="off" enctype="multipart/form.data">
                <fieldset>
                    <legend><i class="zmdi zmdi-assignment" style="color: #03a9f4"></i> &nbsp; Datos básicos</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">DNI/DOCUMENTO DE IDENTIDAD *</label>
                                    <input pattern="[0-9-]{1,30}" class="form-control" type="text" name="id_person-reg" required="" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre del paciente *</label>
                                    <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="nombre-reg" required="" maxlength="40">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Teléfono</label>
                                    <input pattern="[0-9+]{1,10}" class="form-control" type="text" name="telefono-reg" maxlength="15">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Dirección</label>
                                    <input class="form-control" type="text" name="dire-reg" maxlength="170">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre del acudiente *</label>
                                    <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,50}" class="form-control" type="text" name="nomAcu-reg" required="" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Hora de Ingreso *</label>
                                    <input class="form-control" type="time" name="horaIng-reg" maxlength="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <br>
                <fieldset>
                <legend><i class="zmdi zmdi-key" style="color: #03a9f4"></i> &nbsp; Estado del Paciente</legend>                    
                    <div class="container-fluid">
                        <div class="row">

                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Signos Vitales *</label>
                            <textarea class="form-control" name="sign-reg" id="sign-reg" required="" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Movito *</label>
                            <textarea class="form-control" name="motivo-reg" id="motivo-reg" required="" rows="3"></textarea>
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