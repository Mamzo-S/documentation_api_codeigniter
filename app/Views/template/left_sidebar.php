<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left">
                <img src="<?= base_url() ?>assets/images/users/avatar-1.jpg" alt="" class="thumb-md img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <?= ucfirst(session()->get('prenom')) ?></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url() ?>/javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                        <li><a href="<?= base_url() ?>/javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                        <li><a href="<?= base_url('logout') ?>"><i class="md md-lock"></i> Logout</a></li>
                        <!-- <li><a href="<?= base_url() ?>/actions/logoutAction.php"><i class="md md-settings-power"></i> Logout</a></li> -->
                    </ul>
                </div>

                <p class="text-muted m-0">Administrator</p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="<?= base_url() ?>index" class="waves-effect active"><i class="md md-home"></i><span> Accueil </span></a>
                </li>

                <li><a href="<?= base_url() ?>endpoints">Endpoints</a></li>
                <li class="active"><a href="<?= base_url() ?>architecture">Architecture</a></li>
                <li><a href="<?= base_url() ?>authentification">Authentification</a></li>

                <li class="has_sub">
                    <a href="<?= base_url() ?>/#" class="waves-effect"><i class="md md-view-list"></i><span> Configuration </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url() ?>methode">Methode</a></li>
                        <li><a href="<?= base_url() ?>format_donnee">Format-donnee</a></li>
                        <li><a href="<?= base_url() ?>base_url">Base URL</a></li>
                    </ul>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->