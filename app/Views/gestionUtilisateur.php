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
                    <h4 class="pull-left page-title">Gestion Utilisateur</h4>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <?php if (session()->getFlashdata('successMessage')): ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?= session()->getFlashdata('successMessage') ?>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="m-b-30">
                                <button class="btn btn-primary waves-effect waves-light btn-add" data-toggle="modal"
                                    data-target="#ajout-modal">Ajouter</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped" id="datatable-editable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Profile</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($user as $donnee) { ?>
                                <tr class="gradeX">
                                    <td><?= $i++ ?></td>
                                    <td><?= $donnee['nom'] ?></td>
                                    <td><?= $donnee['prenom'] ?></td>
                                    <td><?= $donnee['email'] ?></td>
                                    <td><?= $donnee['username'] ?></td>
                                    <td><?= $donnee['profils'] ?></td>
                                    <td style="text-align: center">
                                        <?php if ($donnee['statut'] == 1) { ?>
                                            <i class="fa fa-check-circle" style="color: green; font-size:22px;"></i>

                                        <?php } else { ?>
                                            <i class="fa fa-times-circle" style="color: red; font-size:22px;"></i>
                                        <?php } ?>
                                    </td>

                                    <td class="actions">

                                        <a href="#" data-toggle="modal" data-target="#edit-modal"
                                            data-id="<?= $donnee['id'] ?>" data-nom="<?= $donnee['nom'] ?>"
                                            data-prenom="<?= $donnee['prenom'] ?>" data-email="<?= $donnee['email'] ?>"
                                            data-username="<?= $donnee['username'] ?>"
                                            data-mdp="<?= $donnee['motdepasse'] ?>"
                                            data-profile="<?= $donnee['profile_id'] ?>">
                                            <button type="button" class="btn btn-warning">Modifier</button>
                                        </a>
                                        <?php if ($donnee['statut'] == 1) { ?>
                                            <a href="#" class="on-default btn-bloq" data-id="<?= $donnee['id']; ?>">
                                                <button type="button" class="btn btn-danger">Bloquer</button>
                                            </a>

                                        <?php } else { ?>
                                            <a href="#" class="btn-debloq" data-id="<?= $donnee['id']; ?>">
                                                <button type="button" class="btn btn-danger">Debloq</button>
                                            </a>
                                        <?php } ?>

                                        <!-- <a href="#"
                                            class="on-default remove-row btn-delete"
                                            data-id="<?= $donnee['id']; ?>">
                                            <i class="fa fa-archive" style="color: red;"></i>
                                        </a> -->

                                        <a href="<?= base_url('SendEmail/') . $donnee['id'] ?>"
                                            class="on-default send-row btn-send" data-id="<?= $donnee['id']; ?>">
                                            <button type="button" class="btn btn-success">
                                                <i class="fa fa-send" style="color: green;"></i>
                                            </button>
                                        </a>
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

    <div id="ajout-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Nouveau utilisateur</h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('AjoutUser') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Prenom</label>
                                    <input type="text" class="form-control" id="field-2" name="prenom">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Nom</label>
                                    <input type="text" class="form-control" id="field-2" name="nom">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Email</label>
                                    <input type="email" class="form-control" id="field-2" name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Username</label>
                                    <input type="text" class="form-control" id="field-2" name="username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Mot de passe</label>
                                    <input type="" class="form-control" id="field-2" name="mdp">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Profile</label>
                                    <select class="form-control" name="profile">
                                        <option>choisir le profil...</option>
                                        <?php foreach ($profil as $donnee) { ?>
                                            <option value="<?= $donnee['id'] ?>"><?= $donnee['profile_name'] ?></option>;
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-info waves-effect waves-light">Ajouter</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div><!-- /.modal -->

    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Modification d'un utilisateur</h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('EditUser') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" id='id' name="id">
                                    <label for="field-2" class="control-label">Prenom</label>
                                    <input type="text" class="form-control" id="field-2" name="prenom">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Nom</label>
                                    <input type="text" class="form-control" id="field-2" name="nom">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Email</label>
                                    <input type="email" class="form-control" id="field-2" name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Username</label>
                                    <input type="text" class="form-control" id="field-2" name="username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Mot de passe</label>
                                    <input type="" class="form-control" id="field-2" name="mdp">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Profile</label>
                                    <select class="form-control" name="profile">
                                        <option>choisir le profil...</option>
                                        <?php foreach ($profil as $donnee) { ?>
                                            <option value="<?= $donnee['id'] ?>"><?= $donnee['profile_name'] ?></option>;
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-info waves-effect waves-light">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div id="dialog" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width: 30%;" role="document">
        <div class="modal-content">
            <header class="panel-heading bg-danger">
                <h2 class="panel-title">Êtes-vous sûr ?</h2>
            </header>
            <div class="modal-body">
                <p>Voulez-vous vraiment supprimer cet utilisateur ?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Non</button>
                <button id="dialogConfirm" class="btn btn-danger">Oui</button>
            </div>
        </div>
    </div>
</div> -->

<div id="bloq" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width: 30%;" role="document">
        <div class="modal-content">
            <header class="panel-heading bg-danger">
                <h2 class="panel-title">Êtes-vous sûr ?</h2>
            </header>
            <div class="modal-body">
                <p>Voulez-vous vraiment bloquer cet utilisateur ?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Non</button>
                <button id="bloqConfirm" class="btn btn-danger">Oui</button>
            </div>
        </div>
    </div>
</div>

<div id="debloq" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width: 30%;" role="document">
        <div class="modal-content">
            <header class="panel-heading bg-success">
                <h2 class="panel-title">Êtes-vous sûr ?</h2>
            </header>
            <div class="modal-body">
                <p>Voulez-vous vraiment debloquer cet utilisateur ?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Non</button>
                <button id="debloqConfirm" class="btn btn-success">Oui</button>
            </div>
        </div>
    </div>
</div>

<?= $this->include('template/footer') ?>

<script>
    var resizefunc = [];

    //modification
    $('#edit-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        let id = button.data('id');
        let nom = button.data('nom');
        let prenom = button.data('prenom');
        let email = button.data('email');
        let username = button.data('username');
        let profil = button.data('profile');
        let mdp = button.data('mdp');

        var modal = $(this);
        modal.find('input[name="id"]').val(id);
        modal.find('input[name="nom"]').val(nom);
        modal.find('input[name="prenom"]').val(prenom);
        modal.find('input[name="email"]').val(email);
        modal.find('input[name="username"]').val(username);
        modal.find('select[name="profile"]').val(profil);
        modal.find('input[name="mdp"]').val(mdp);
    });

    //suppression
    $('.btn-delete').click(function (e) {
        e.preventDefault();
        deleteId = $(this).data('id');
        $('#dialog').modal('show');
    });
    $('#dialogConfirm').click(function () {
        if (deleteId) {
            window.location.href = "<?= base_url('DeleteUser/'); ?>" + deleteId;
        }
    });

    //bloquer
    $('.btn-bloq').click(function (e) {
        e.preventDefault();
        bloqId = $(this).data('id');
        $('#bloq').modal('show');
    });
    $('#bloqConfirm').click(function () {
        if (bloqId) {
            window.location.href = "<?= base_url('ChangeStatut'); ?>/" + bloqId;
        }
    });

    //debloquer
    $('.btn-debloq').click(function (e) {
        e.preventDefault();
        debloqId = $(this).data('id');
        $('#debloq').modal('show');
    });
    $('#debloqConfirm').click(function () {
        if (debloqId) {
            window.location.href = "<?= base_url('ChangeStatut/'); ?>" + debloqId;
        }
    });

</script>