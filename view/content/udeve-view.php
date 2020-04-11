<div class="container-fluid">
    <div class="page-header">
        <h2 class="text-titles"><i class="zmdi zmdi-balance zmdi-hc-fw" style="color: #03a9f4"></i> Evento Enfermeria </h2>
    </div>
</div>

<div class="container-fluid">
    <ul class="breadcrumb breadcrumb-tabs">
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
    </ul>
</div>

<?php 
        $data=explode("/",$_GET['views']);

        if ($data[1]=="Admin" || $data[1]=="Acu"):
            if ($_SESSION['Rol_AuxR']=="") {
                echo $lc->close_session_controller();
            }

            require_once "./controller/nurseController.php";
            $classNurse= new nurseController();

            $filesA=$classNurse->data_eve_controller("Unico",$data[2]);

            if ($filesA->rowCount()==1) {
                $campo=$filesA->fetch();

                // if ($campo['Id_Person']!=$_SESSION['Id_Person']) {
                //     if ($_SESSION['Rol_AuxR']=="") {
                //         echo $lc->close_session_controller();
                //     }
                // }
                ?>


<!-- panel datos de la empresa -->
<div class="container-fluid">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; EVENTO ENFERMERÍA</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo SERVERURL; ?>ajax/nurseAjax.php" method="POST" data-form="update" class="AjaxForm" autocomplete="off" enctype="multipart/form.data">
            <input type="hidden" name="Eve-up" value="<?php echo $data[2];?>">
                <fieldset>
                    <legend><i class="zmdi zmdi-assignment" style="color: #03a9f4"></i> &nbsp; Datos básicos</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Documento de Identidad</label>
                                    <input pattern="[0-9-]{1,30}" class="form-control" type="text" value="<?php echo $campo['Id_Person']; ?>" name="id_person-up" required="" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre del paciente *</label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text"   value="<?php echo $campo['Name_Person']; ?>" name="nombre-up" required="" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Teléfono</label>
                                    <input pattern="[0-9+]{1,15}" class="form-control" type="text" value="<?php echo $campo['Tel']; ?>" name="telefono-up" maxlength="15">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Dirección</label>
                                    <input class="form-control" type="text" value="<?php echo $campo['Adress']; ?>"  name="dire-up" maxlength="50" required="">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre del acudiente *</label>
                                    <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,50}" class="form-control" type="text" value="<?php echo $campo['Name_Acu']; ?>" name="nomAcu-up" required="" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Hora de Ingreso *</label>
                                    <input class="form-control" type="datetime-local" value="<?php echo $campo['Hour']; ?>"  name="horaIng-up" maxlength="1">
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
                            <label class="control-label">Signos vitales *</label>
                            <textarea class="form-control" name="sign-up" id="sign-reg" required="" rows="1"><?php echo $campo['Vital_Signs']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Movito *</label>
                            <textarea class="form-control" name="motivo-up" id="motivo-reg" required=""  rows="1"><?php echo $campo['Reason_Consult']; ?></textarea>
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
            }else {
                ?>
                <h4>Lo sentimos</h4>
                <p>No podemos mostrar la informacion solicitada</p>
                <?php
            }
        else:
     ?>
     <h4>Lo sentimos</h4>
     <p>No podemos mostrar la informacion solicitada</p>
    <?php endif;?>
</div>