<?php
// session_start();
// if(!isset($_SESSION['user'])){
//     header("Location: /views/login.php");
// }

// require_once('actions/sessionAction.php');

// $prenom = $_SESSION['user']['prenom'];
// $nom = $_SESSION['user']['nom'];
?>

<?= $this->include('template/header'); ?>
<?= $this->include('template/top_bar'); ?>
<?= $this->include('template/left_sidebar'); ?>

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
                    <h4 class="pull-left page-title">Welcome !</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="<?= base_url() ?>/#">Moltran</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>


        </div> <!-- container -->

    </div> <!-- content -->

</div>

<?= $this->include('template/footer') ?>