<div class="container-fluid">
    <div class="page-header">
        <h2 class="text-titles"><i class="zmdi zmdi-balance zmdi-hc-fw" style="color: #03a9f4"></i> Historial Clínico </h2>
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
    $insM = new medicalController();
?>
<!-- panel lista de empresas -->
<div class="container-fluid">
    <div class="panel panel-success">
    <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; DATOS EVENTO</h3>
        </div>
        <div class="panel-body">
            <?php 
                $page=explode("/",$_GET['views']);
                echo $insM->page_medical_controller($page[1],5);
            ?>
        </div>
    </div>
</div>