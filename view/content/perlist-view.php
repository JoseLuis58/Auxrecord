<div class="container-fluid">
    <div class="page-header">
        <h2 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw" style="color: #03a9f4"></i>Persona </h2>
    </div>
</div>

<div class="container-fluid">
    <ul class="breadcrumb breadcrumb-tabs">
    <?php if($_SESSION['Rol_AuxR']=="Administrador"):?>
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
    <?php endif;?>
    <?php if($_SESSION['Rol_AuxR']=="Acudiente"):?>
        <li>
            <a href="<?php echo SERVERURL; ?>persearch/" class="btn btn-primary">
                <i class="zmdi zmdi-search"></i> &nbsp; BUSCAR PERSONA
            </a>
        </li>
    </ul>
    <?php endif;?>
</div>
<?php
    require_once "./controller/userController.php";
    $insUser = new userController();
?>
<!-- Panel listado de administradores -->
<div class="container-fluid">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE PERSONAS</h3>
        </div>
        <div class="panel-body">      
            <?php
                $page = explode("/",$_GET['views']);
                echo $insUser->page_user_controller($page[1],5,$_SESSION['Rol_AuxR'],$_SESSION['Code_AuxR'],"")
            ?>
        </div>
    </div>
</div>