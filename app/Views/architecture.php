<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?= base_url() ?>/images/favicon_1.ico">

    <title>Moltran - Responsive Admin Dashboard Template</title>

    <!-- Base Css Files -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Icons -->
    <link href="<?= base_url() ?>/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/css/material-design-iconic-font.min.css" rel="stylesheet">

    <!-- animate css -->
    <link href="<?= base_url() ?>/css/animate.css" rel="stylesheet" />

    <!-- Waves-effect -->
    <link href="<?= base_url() ?>/css/waves-effect.css" rel="stylesheet">

    <!-- Plugin Css-->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/jquery-datatables-editable/datatables.css" />

    <!-- Custom Files -->
    <link href="<?= base_url() ?>/css/helper.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/css/style.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?= base_url() ?>/https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="<?= base_url() ?>/https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    <script src="<?= base_url() ?>/js/modernizr.min.js"></script>

</head>



<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="<?= base_url() ?>/index.html" class="logo"><i class="md md-terrain"></i> <span>Moltran </span></a>
                </div>
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="">
                        <div class="pull-left">
                            <button class="button-menu-mobile open-left">
                                <i class="fa fa-bars"></i>
                            </button>
                            <span class="clearfix"></span>
                        </div>
                        <form class="navbar-form pull-left" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control search-bar" placeholder="Type here for search...">
                            </div>
                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                        </form>

                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="dropdown hidden-xs">
                                <a href="<?= base_url() ?>/#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                    <i class="md md-notifications"></i> <span class="badge badge-xs badge-danger">3</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg">
                                    <li class="text-center notifi-title">Notification</li>
                                    <li class="list-group">
                                        <!-- list item-->
                                        <a href="<?= base_url() ?>/javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <em class="fa fa-user-plus fa-2x text-info"></em>
                                                </div>
                                                <div class="media-body clearfix">
                                                    <div class="media-heading">New user registered</div>
                                                    <p class="m-0">
                                                        <small>You have 10 unread messages</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- list item-->
                                        <a href="<?= base_url() ?>/javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <em class="fa fa-diamond fa-2x text-primary"></em>
                                                </div>
                                                <div class="media-body clearfix">
                                                    <div class="media-heading">New settings</div>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- list item-->
                                        <a href="<?= base_url() ?>/javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <em class="fa fa-bell-o fa-2x text-danger"></em>
                                                </div>
                                                <div class="media-body clearfix">
                                                    <div class="media-heading">Updates</div>
                                                    <p class="m-0">
                                                        <small>There are
                                                            <span class="text-primary">2</span> new updates available</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- last list item -->
                                        <a href="<?= base_url() ?>/javascript:void(0);" class="list-group-item">
                                            <small>See all notifications</small>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->

        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <div class="user-details">
                    <div class="pull-left">
                        <img src="<?= base_url() ?>/images/users/avatar-1.jpg" alt="" class="thumb-md img-circle">
                    </div>
                    <div class="user-info">
                        <div class="dropdown">
                            <a href="<?= base_url() ?>/#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><? //php echo $prenom .' '. $nom
                                                                                                                                ?> Mamzo <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url() ?>/javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                                <li><a href="<?= base_url() ?>/javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                                <li><a href="<?= base_url() ?>/javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
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



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pull-left page-title">Architecture</h4>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="m-b-30">
                                        <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Ajouter</button>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped" id="datatable-editable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Architecture</th>
                                        <th>Format_donnee</th>
                                        <th>Header</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($archi as $donnee) { ?>
                                        <tr class="gradeX">
                                            <td><?= $i++ ?></td>
                                            <td><?= $donnee['architecture_name'] ?></td>
                                            <td><?= $donnee['format_donnees'] ?></td>
                                            <td><?= $donnee['header'] ?></td>
                                            <td class="actions">
                                                <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    <?php }
                                    $i++;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end: page -->

                    </div> <!-- end Panel -->

                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer text-right">
                2015 © Moltran.
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

        <!-- MODAL -->
        <!-- MODAL -->
        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Nouvelle architecture</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Nom architecture</label>
                                    <input type="text" class="form-control" id="field-2" name="archi">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Format de donnee</label>
                                    <select class="form-control" name="format">
                                        <option>choisir le format...</option>
                                        <?php
                                        foreach ($format as $donnee) { ?>
                                            <option value="<?= $donnee['id'] ?>"><?= $donnee['format'] ?></option>;
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Reponse</label>
                                    <input type="text" class="form-control" id="field-2" name="rep">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-info waves-effect waves-light">Ajouter</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->

        <div id="dialog" class="modal-block mfp-hide">
            <section class="panel panel-info panel-color">
                <header class="panel-heading">
                    <h2 class="panel-title">Are you sure?</h2>
                </header>
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="modal-text">
                            <p>Are you sure that you want to delete this row?</p>
                        </div>
                    </div>

                    <div class="row m-t-20">
                        <div class="col-md-12 text-right">
                            <button id="dialogConfirm" class="btn btn-primary">Confirm</button>
                            <button id="dialogCancel" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </div>

            </section>
        </div>



    </div>
    <!-- END wrapper -->

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="<?= base_url() ?>/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/js/waves.js"></script>
    <script src="<?= base_url() ?>/js/wow.min.js"></script>
    <script src="<?= base_url() ?>/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/js/jquery.scrollTo.min.js"></script>
    <script src="<?= base_url() ?>/assets/jquery-detectmobile/detect.js"></script>
    <script src="<?= base_url() ?>/assets/fastclick/fastclick.js"></script>
    <script src="<?= base_url() ?>/assets/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?= base_url() ?>/assets/jquery-blockui/jquery.blockUI.js"></script>


    <!-- CUSTOM JS -->
    <script src="<?= base_url() ?>/js/jquery.app.js"></script>

    <!-- Examples -->
    <script src="<?= base_url() ?>/assets/magnific-popup/magnific-popup.js"></script>
    <script src="<?= base_url() ?>/assets/jquery-datatables-editable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>/assets/datatables/dataTables.bootstrap.js"></script>
    <script src="<?= base_url() ?>/assets/jquery-datatables-editable/datatables.editable.init.js"></script>

</body>

</html>