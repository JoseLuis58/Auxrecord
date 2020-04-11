<div class="full-box login-container cover">
    <form action="" method="POST" autocomplete="off" class="logInForm">
        <p class="text-center text-muted"><img src="<?php echo SERVERURL; ?>view/assets/img/logo.png" style="width: 350px"></p>
        <p class="text-center text-muted text-uppercase" style="color: rgb(156, 156, 156)">Iniciar Sesión</p>
        <div class="form-group label-floating">
            <label class="control-label" for="UserName" style="color: rgb(156, 156, 156)">Nombre de Usuario</label>
            <input class="form-control" required="" id="UserName" name="Usuario" type="text">
            <p class="help-block">Escriba su usuario</p>
        </div>
        <div class="form-group label-floating">
            <label class="control-label" for="UserPass" style="color: rgb(156, 156, 156)">Contraseña</label>
            <input class="form-control" required="" id="UserPass" name="Contraseña" type="password">
            <p class="help-block">Escriba su contraseña</p>
        </div>
        <div class="form-group text-center">
            <input type="submit" value="Ingresar" class="btn btn-info" style="color: #FFF; background-color: #03a9f4">
        </div>
    </form>
</div>

<?php
if (isset($_POST['Usuario']) && isset($_POST['Contraseña'])) {
    require_once "./controller/loginController.php";
    $login = new loginController();
    echo $login->login_controller();
}
?>