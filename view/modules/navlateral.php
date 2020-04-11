<section class="full-box cover dashboard-sideBar">
    <div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
    <div class="full-box dashboard-sideBar-ct" style="background-color:rgba(173, 172, 178, 0.50)">
        <!--SideBar Title -->
        <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
            <img src="<?php echo SERVERURL; ?>view/assets/img/navlateral.png" width="200px"> <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
        </div>
        <!-- SideBar User info -->
        <div class="full-box dashboard-sideBar-UserInfo">
            <figure class="full-box">
                <img src="<?php echo SERVERURL; ?>view/assets/avatars/<?php echo $_SESSION['Foto_AuxR']; ?>" alt="UserIcon">
                <figcaption class="text-center text-titles"><?php echo $_SESSION['Username_AuxR']; ?></figcaption>
            </figure>
            <?php if ($_SESSION['Rol_AuxR'] == "Administrador") {
                $tipo = "Admin";
            } else {
                $tipo = "Acu";
            }
            ?>
            <ul class="full-box list-unstyled text-center">
                <li>
                    <a href="<?php echo SERVERURL; ?>dataper/<?php echo $tipo . "/" . $lc->encryption($_SESSION['Code_AuxR']); ?>" title="Mis datos">
                        <i class="zmdi zmdi-account-circle"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>udper/<?php echo $tipo . "/" . $lc->encryption($_SESSION['Code_AuxR']); ?>" title="Mi cuenta">
                        <i class="zmdi zmdi-settings"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $lc->encryption($_SESSION['Token_AuxR']); ?>" title="Salir del sistema" class="btn-exit-system">
                        <i class="zmdi zmdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- SideBar Menu -->
        <ul class="list-unstyled full-box dashboard-sideBar-Menu">
            <?php if ($_SESSION['Rol_AuxR'] == "Administrador") : ?>
                <li>
                    <a href="<?php echo SERVERURL; ?>home/">
                        <i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Inicio
                    </a>
                </li>
                <li>
                    <a href="" class="btn-sideBar-SubMenu">
                        <i class="zmdi zmdi-case zmdi-hc-fw"></i> Evento enfermeria <i class="zmdi zmdi-caret-down pull-right"></i>
                    </a>
                    <ul class="list-unstyled full-box">
                        <li>
                            <a href="<?php echo SERVERURL; ?>evegestion/"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Gestión</a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL; ?>cuida/"><i class="zmdi zmdi-collection-image zmdi-hc-fw"></i> Cuidado Médico</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#!" class="btn-sideBar-SubMenu">
                        <i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Persona <i class="zmdi zmdi-caret-down pull-right"></i>
                    </a>
                    <ul class="list-unstyled full-box">
                        <li>
                            <a href="<?php echo SERVERURL; ?>pergestion/"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Gestión</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>cligestion/">
                        <i class="zmdi zmdi-city zmdi-hc-fw"></i> Historial Clinico
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['Rol_AuxR'] == "Acudiente") : ?>
                <li>
                    <a href="#!" class="btn-sideBar-SubMenu">
                        <i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Persona <i class="zmdi zmdi-caret-down pull-right"></i>
                    </a>
                    <ul class="list-unstyled full-box">
                        <li>
                            <a href="<?php echo SERVERURL; ?>persearch/"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Gestión</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="" class="btn-sideBar-SubMenu">
                        <i class="zmdi zmdi-case zmdi-hc-fw"></i> Evento enfermeria <i class="zmdi zmdi-caret-down pull-right"></i>
                    </a>
                    <ul class="list-unstyled full-box">
                        <li>
                            <a href="<?php echo SERVERURL; ?>evelist/"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Gestión</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</section>