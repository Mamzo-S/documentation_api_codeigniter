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
                        <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div
                                    class="ripple-wrapper"></div></a></li>
                        <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                        <li><a href="<?= base_url('logout') ?>"><i class="md md-lock"></i> Logout</a></li>
                    </ul>
                </div>

                <p class="text-muted m-0"><?= session()->get('profil') ?></p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="<?= base_url() ?>index"
                        class="waves-effect <?= (current_url() == base_url('index')) ? 'active' : '' ?>"><i
                            class="md md-home"></i><span> Accueil </span></a>
                </li>

                <li><a href="<?= base_url() ?>architecture"
                        class="<?= (current_url() == base_url('architecture')) ? 'active' : '' ?>">Architecture</a></li>
                <li><a href="<?= base_url() ?>endpoints"
                        class="<?= (current_url() == base_url('endpoints')) ? 'active' : '' ?>">Endpoints</a></li>
                <!-- <li><a href="<?= base_url() ?>authentification"
                        class="<?= (current_url() == base_url('authentification')) ? 'active' : '' ?>">Authentification</a>
                </li> -->
                <li>
                    <a href="<?= base_url() ?>swagger"
                        class="<?= (current_url() == base_url('swagger')) ? 'active' : '' ?>">Tester avec Swagger
                    </a>
                </li>
                <?php if (session()->get('profile_id') != 2): ?>
                    <li class="has_sub">
                        <a href="#" class="waves-effect"><i class="md md-settings"></i><span> Configuration </span><span
                                class="pull-right"><i class="md md-add"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?= base_url('methode') ?>"
                                    class="<?= (current_url() == base_url('methode')) ? 'active' : '' ?>">Methode</a></li>
                            <li><a href="<?= base_url() ?>format_donnee"
                                    class="<?= (current_url() == base_url('format_donnee')) ? 'active' : '' ?>">Format-donnee</a>
                            </li>
                            <li><a href="<?= base_url() ?>base_url"
                                    class="<?= (current_url() == base_url('base_url')) ? 'active' : '' ?>">Base URL</a></li>
                            <li><a href="<?= base_url() ?>menu"
                                    class="<?= (current_url() == base_url('menu')) ? 'active' : '' ?>">Menu</a></li>
                            <li><a href="<?= base_url() ?>sous_menu"
                                    class="<?= (current_url() == base_url('sous_menu')) ? 'active' : '' ?>">Sous Menu</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (session()->get('profile_id') == 1): ?>
                    <li class="has_sub">
                        <a href="#" class="waves-effect"><i class="md md-security"></i><span> Sécurité </span><span
                                class="pull-right"><i class="md md-add"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?= base_url() ?>gestionUtilisateur"
                                    class="<?= (current_url() == base_url('gestionUtilisateur')) ? 'active' : '' ?>">Gestion
                                    utilisateur</a></li>
                            <li><a href="<?= base_url() ?>gestionProfil"
                                    class="<?= (current_url() == base_url('gestionProfil')) ? 'active' : '' ?>">Gestion
                                    profil</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->