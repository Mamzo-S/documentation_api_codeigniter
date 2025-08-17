<?php
// session_start();
// require('../actions/loginAction.php');

?>
<?= $this->include('template/header') ?>

<body>


    <div class="wrapper-page">
        <div class="panel panel-color panel-primary panel-pages">
            <div class="panel-heading bg-img">
                <div class="bg-overlay"></div>
                <h3 class="text-center m-t-10 text-white"> <strong>Connectez-vous</strong> </h3>
            </div>

            <div class="panel-body">
                <?php if (session()->getFlashdata('errorMessage')) : ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?= session()->getFlashdata('errorMessage') ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('login') ?>" method="POST">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control input-lg " type="text" required="" placeholder="Username" name="username">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control input-lg" type="password" required="" placeholder="Password" name="mdp">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup">
                                    Remember me
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg w-lg waves-effect waves-light" type="submit" name="login">Se connecter</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
