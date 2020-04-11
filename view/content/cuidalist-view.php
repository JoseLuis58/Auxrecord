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
                <i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE CUIDADO MÉDICOS
            </a>
        </li>
    </ul>
</div>
<?php
    require_once "./controller/medicalCareController.php";
    $insCare = new medicalCareController();
?>
<!-- panel lista de empresas -->
<div class="container-fluid">
    <div class="panel panel-success">
    <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; DATOS EVENTO</h3>
        </div>
        <div class="panel-body">
            <?php
                $page = explode("/",$_GET['views']);
                echo $insCare->page_medicalCare_controller($page[1],6,$_SESSION['Rol_AuxR'],$_SESSION['Code_AuxR']);
            ?>
        </div>
    </div>
</div>