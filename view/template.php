<!DOCTYPE html>
<html lang="es">

<head>
    <title><?php echo COMPANY; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/main.css">
    <link rel="shortcut icon" href="<?php echo SERVERURL; ?>view/assets/img/fav.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/sweetalert2.css">
    <script src="<?php echo SERVERURL; ?>view/js/sweetalert2.min.js"></script>
</head>

<body>
    <?php
    $reqAjax = false;

    require_once "./controller/prinController.php";

    $cl = new prinController();
    $Rcl = $cl->get_view_controller();

    if ($Rcl == "login") :
        require_once "./view/content/login-view.php";
    elseif ($Rcl=="landingPage"):
        require_once "./view/content/landingPage-view.php";
    elseif ($Rcl=="register"):
        require_once "./view/content/register-view.php";
    else :
        session_start(['name' => 'AuxR']);

        require_once "./controller/loginController.php";

        $lc = new loginController();
        if (!isset($_SESSION['Token_AuxR']) || !isset($_SESSION['Username_AuxR'])) {
            $lc->close_session_controller();
        }
    ?>
        <!-- SideBar -->
        <?php include "./view/modules/navlateral.php"; ?>
        <!-- Content page-->
        <?php include "./view/modules/search.php"; ?>
        <!-- Content page -->
        <?php require_once $Rcl; ?>
        </section>
    <?php endif; ?>
    <?php include "./view/modules/js.php"; ?>
    <?php include "./view/modules/logout.php"; ?>
    <script>
        $.material.init();
    </script>

</body>

</html>