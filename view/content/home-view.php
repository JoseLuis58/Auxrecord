<?php
if ($_SESSION['Rol_AuxR'] != "Administrador") {
    echo $lc->close_session_controller();
}
?>
<div class="container-fluid">
    <div class="page-header">
        <h2 class="text-titles">Bienvenido/a Sr/Sra <?php echo $_SESSION['Username_AuxR']; ?></h2>
    </div>
</div>
<div class="full-box text-center" style="padding: 30px 10px;">
    <?php
    require "./controller/userController.php";
    $InsAdm = new userController();
    $CAdm = $InsAdm->data_user_controller("Conteo", 0)
    ?>
    <article class="full-box tile">
        <div class="full-box tile-title text-center text-titles text-uppercase">
            Adimistradores
        </div>
        <div class="full-box tile-icon text-center">
            <i class="zmdi zmdi-account"></i>
        </div>
        <div class="full-box tile-number text-titles">
            <p class="full-box"><?php echo $CAdm->rowCount(); ?></p>
            <small>Registrados</small>
        </div>
    </article>
</div>
