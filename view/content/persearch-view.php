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

    if (isset($_POST['search_inicial_admin'])) {
        $_SESSION['search_admin']=$_POST['search_inicial_admin'];
    }

    if (isset($_POST['delete_search'])) {
        unset($_SESSION['search_admin']);
    }

    if (!isset($_SESSION['search_admin']) && empty($_SESSION['search_admin'])):
?>
<div class="container-fluid">
    <form class="well" method="POST" action="" autocomplete="off">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="form-group label-floating">
                    <span class="control-label">¿A quién estás buscando?</span>
                    <input class="form-control" type="text" name="search_inicial_admin" required="">
                </div>
            </div>
            <div class="col-xs-12">
                <p class="text-center">
                    <button type="submit" class="btn btn-primary btn-raised btn-xm"><i class="zmdi zmdi-search"></i> &nbsp; Buscar</button>
                </p>
            </div>
        </div>
    </form>
</div>
<?php else:?>
<div class="container-fluid">
    <form class="well" method="POST" action="" autocomplete="off">
        <p class="lead text-center">Su última búsqueda  fue <strong>“<?php echo $_SESSION['search_admin'];?>”</strong></p>
        <div class="row">
            <input class="form-control" type="hidden" name="delete_search" required="" value="1">
            <div class="col-xs-12">
                <p class="text-center">
                    <button type="submit" class="btn btn-danger btn-raised btn-sm"><i class="zmdi zmdi-delete"></i> &nbsp; Eliminar búsqueda</button>
                </p>
            </div>
        </div>
    </form>
</div>
<!-- Panel listado de busqueda de administradores -->
<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-search"></i> &nbsp; BUSCAR PERSONA</h3>
        </div>
        <div class="panel-body">
            <?php
                $page = explode("/",$_GET['views']);
                echo $insUser->page_user_controller($page[1],5,$_SESSION['Rol_AuxR'],$_SESSION['Code_AuxR'],
                $_SESSION['search_admin'])
            ?>
        </div>
    </div>
</div>
<?php endif;?>