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
                    <h4 class="pull-left page-title">Endpoints</h4>
                </div>
            </div>
            <div class="panel col-md-12">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="m-b-30">
                                <button class="btn btn-primary waves-effect waves-light btn-add" data-toggle="modal"
                                    data-target="#ajout-modal">Ajouter</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 60%">Titre de l’Endpoint</th>
                                <th style="width: 40%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($endpoint as $donnee): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($donnee['titre']) ?></strong></td>
                                    <td>
                                        <!-- Bouton Voir -->
                                        <button type="button" class="btn btn-sm btn-info btn-view-endpoint"
                                            data-id="<?= $donnee['id'] ?>" data-titre="<?= $donnee['titre'] ?>"
                                            data-lien="<?= htmlspecialchars($donnee['liens']) ?>"
                                            data-end="<?= htmlspecialchars($donnee['endName']) ?>"
                                            data-type="<?= htmlspecialchars($donnee['type']) ?>"
                                            data-methode="<?= htmlspecialchars($donnee['methode']) ?>"
                                            data-param="<?= htmlspecialchars($donnee['parametre']) ?>"
                                            data-rep_success="<?= htmlspecialchars($donnee['reponse_success']) ?>"
                                            data-rep_error="<?= htmlspecialchars($donnee['reponse_error']) ?>">
                                            <i class="fa fa-eye"></i>
                                        </button>

                                        <!-- Bouton Editer -->
                                        <button type="button" class="btn btn-sm btn-warning btn-edit-endpoint"
                                            data-toggle="modal" data-target="#edit-modal" data-id="<?= $donnee['id'] ?>"
                                            data-titre="<?= htmlspecialchars($donnee['titre']) ?>"
                                            data-lien="<?= htmlspecialchars($donnee['lien_end']) ?>"
                                            data-end="<?= htmlspecialchars($donnee['endName']) ?>"
                                            data-type="<?= htmlspecialchars($donnee['type']) ?>"
                                            data-methode="<?= htmlspecialchars($donnee['methode_end']) ?>"
                                            data-param="<?= htmlspecialchars($donnee['parametre']) ?>"
                                            data-rep_s="<?= htmlspecialchars($donnee['reponse_success']) ?>"
                                            data-rep_e="<?= htmlspecialchars($donnee['reponse_error']) ?>">
                                            <i class="fa fa-pencil"></i>
                                        </button>

                                        <!-- Bouton Supprimer -->
                                        <button type="button" class="btn btn-sm btn-danger btn-delete"
                                            data-id="<?= $donnee['id'] ?>">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
                <!-- end: page -->

            </div> <!-- end Panel -->

        </div> <!-- container -->

    </div> <!-- content -->
    <div id="view-endpoint-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="endpoint-title"></h4>
                </div>
                <div class="modal-body">
                    <p><strong>Lien :</strong> <span id="endpoint-lien"></span></p>
                    <p><strong>Methode :</strong> <span id="endpoint-methode"></span></p>
                    <p><strong>Type :</strong> <span id="endpoint-type"></span></p>
                    <p><strong>Paramètre :</strong> <span id="endpoint-param"></span></p>

                    <div class="row">
                        <div class="col-md-7">
                            <p><strong>Réponse succès :</strong></p>
                            <code id="rep-success"></code>
                        </div>
                        <div class="col-md-5">
                            <p><strong>Réponse erreur :</strong></p>
                            <code id="rep-error"></code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div id="ajout-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Nouveau endpoint</h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('AjoutEndpoint') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Titre endpoint</label>
                                    <input type="text" class="form-control" id="field-2" name="titre">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Base URL</label>
                                    <select class="form-control" name="lien">
                                        <option>choisir le lien...</option>
                                        <?php
                                        foreach ($lien as $donnee) { ?>
                                            <option value="<?= $donnee['id'] ?>"><?= $donnee['nom_url'] ?></option>;
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Methode</label>
                                    <select class="form-control" name="meth">
                                        <option>choisir la methode...</option>
                                        <?php
                                        foreach ($methode as $donnee) { ?>
                                            <option value="<?= $donnee['id'] ?>"><?= $donnee['methode_name'] ?></option>;
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Type d'endpoint</label>
                                    <select class="form-control" name="type">
                                        <option>choisir le type...</option>
                                        <option value="endpoint_simple"> endpoint_simple </option>
                                        <option value="authentification"> authentification </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Endpoint</label>
                                    <input type="text" class="form-control" id="field-2" name="end">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Parametre</label>
                                    <input type="text" class="form-control" id="field-2" name="param">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label for="field-2" class="control-label">Reponse succes</label>
                                            <textarea name="rep-success" class="form-control" rows="10"></textarea>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="field-2" class="control-label">Reponse erreur</label>
                                            <textarea name="rep-error" class="form-control" rows="10"></textarea>
                                        </div>
                                    </div>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Modification d'un endpoint</h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('EditEndpoint') ?>" method="POST">
                        <div class="row">
                            <input type="hidden" name="id" id="id">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Titre endpoint</label>
                                    <input type="text" class="form-control" id="field-2" name="titre">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Base URL</label>
                                    <select class="form-control" name="lien">
                                        <option>choisir le lien...</option>
                                        <?php
                                        foreach ($lien as $donnee) { ?>
                                            <option value="<?= $donnee['id'] ?>"><?= $donnee['nom_url'] ?></option>;
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Methode</label>
                                    <select class="form-control" name="meth">
                                        <option>choisir la methode...</option>
                                        <?php
                                        foreach ($methode as $donnee) { ?>
                                            <option value="<?= $donnee['id'] ?>"><?= $donnee['methode_name'] ?></option>;
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Type d'endpoint</label>
                                    <select class="form-control" name="type">
                                        <option value="endpoint_simple"> endpoint_simple </option>
                                        <option value="authentification"> authentification </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Endpoint</label>
                                    <input type="text" class="form-control" id="field-2" name="end">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Parametre</label>
                                    <input type="text" class="form-control" id="field-2" name="param">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label for="field-2" class="control-label">Reponse succes</label>
                                            <textarea name="rep-success" class="form-control" rows="10"></textarea>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="field-2" class="control-label">Reponse erreur</label>
                                            <textarea name="rep-error" class="form-control" rows="10"></textarea>
                                        </div>
                                    </div>
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
    </div><!-- /.modal -->
</div>

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->


<div id="dialog" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width: 30%;" role="document">
        <div class="modal-content">
            <header class="panel-heading bg-danger">
                <h2 class="panel-title">Êtes-vous sûr ?</h2>
            </header>
            <div class="modal-body">
                <p>Voulez-vous vraiment supprimer cette ligne ?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Non</button>
                <button id="dialogConfirm" class="btn btn-danger">Oui</button>
            </div>
        </div>
    </div>
</div>

<?= $this->include('template/footer') ?>

<script>
    let role = <?= json_encode(session()->get('tab_smenu')) ?>;
</script>

<script>
    $('.btn-view-endpoint').click(function () {
        let button = $(this);

        $('#endpoint-title').text(button.data('titre'));
        $('#endpoint-methode').text(button.data('methode'));
        $('#endpoint-type').text(button.data('type'));
        $('#endpoint-param').text(button.data('param'));

        let base = button.data('lien');
        let end = button.data('end');
        let lien = base + '/' + end;
        $('#endpoint-lien').text(lien);

        let rep_S = button.data('rep_success');
        let rep_E = button.data('rep_error');

        if (rep_S) {
            $('#rep-success').html(
                rep_S.replace(/\n/g, '<br>').replace(/ /g, '&nbsp;')
            );
        } else {
            $('#rep-success').html('');
        }

        if (rep_E) {
            $('#rep-error').html(
                rep_E.replace(/\n/g, '<br>').replace(/ /g, '&nbsp;')
            );
        } else {
            $('#rep-error').html('');
        }

        // if (rep_S) {
        //     try {
        //         const json = JSON.parse(rep_S);
        //         $('#rep-success').html(
        //             JSON.stringify(json, null, 4)
        //                 .replace(/\n/g, '<br>')
        //                 .replace(/ /g, '&nbsp;')
        //         );
        //     } catch (e) {
        //         $('#rep-success').html(
        //             rep_S.replace(/\n/g, '<br>').replace(/ /g, '&nbsp;')
        //         );
        //     }
        // } else {
        //     $('#rep-success').html('');
        // }

        // if (rep_E) {
        //     try {
        //         const json = JSON.parse(rep_E);
        //         $('#rep-error').html(
        //             JSON.stringify(json, null, 4)
        //                 .replace(/\n/g, '<br>')
        //                 .replace(/ /g, '&nbsp;')
        //         );
        //     } catch (e) {
        //         $('#rep-error').html(
        //             rep_E.replace(/\n/g, '<br>').replace(/ /g, '&nbsp;')
        //         );
        //     }
        // } else {
        //     $('#rep-error').html('');
        // }

        $('#view-endpoint-modal').modal('show');
    });



</script>

<script>
    var resizefunc = [];

    $('#edit-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        let id = button.data('id');
        let titre = button.data('titre');
        let methode = button.data('methode');
        let lien = button.data('lien');
        let rep_S = button.data('rep_s');
        let rep_E = button.data('rep_e');
        let param = button.data('param');
        let type = button.data('type');
        let end = button.data('end');

        var modal = $(this);
        modal.find('input[name="id"]').val(id);
        modal.find('input[name="titre"]').val(titre);
        modal.find('select[name="meth"]').val(methode);
        modal.find('select[name="lien"]').val(lien);
        modal.find('input[name="param"]').val(param);
        modal.find('input[name="end"]').val(end);
        modal.find('select[name="type"]').val(type);
        modal.find('textarea[name="rep-success"]').val(rep_S);
        modal.find('textarea[name="rep-error"]').val(rep_E);

    });

    $('.btn-delete').click(function (e) {
        e.preventDefault();
        deleteId = $(this).data('id');
        $('#dialog').modal('show');
    });

    $('#dialogConfirm').click(function () {
        if (deleteId) {
            window.location.href = "<?= base_url('DeleteEndpoint/'); ?>" + deleteId;
        }
    });

    //gestion de roles et permissions
    let smenuId = 9;
    let perm = role[(smenuId)];

    if (perm.add == 1) {
        $(".btn-add").show();
    } else {
        $(".btn-add").hide();
    }

    if (perm.upd == 1) {
        $('#edit-modal').on('show.bs.modal', function (event) {
            $('#edit-modal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                let id = button.data('id');
                let methode = button.data('methode');
                let lien = button.data('lien');
                let rep = button.data('rep');
                let param = button.data('param');
                let type = button.data('type');
                let end = button.data('end');

                var modal = $(this);
                modal.find('input[name="id"]').val(id);
                modal.find('select[name="meth"]').val(methode);
                modal.find('select[name="lien"]').val(lien);
                modal.find('input[name="rep"]').val(rep);
                modal.find('input[name="param"]').val(param);
                modal.find('input[name="end"]').val(end);
                modal.find('select[name="type"]').val(type);
            });
        });
    } else {
        $(".edit-row").hide();
    }

    if (perm.del == 1) {
        $('.btn-delete').click(function (e) {
            e.preventDefault();
            deleteId = $(this).data('id');
            $('#dialog').modal('show');
        });

        $('#dialogConfirm').click(function () {
            if (deleteId) {
                window.location.href = "<?= base_url('DeleteEndpoint/'); ?>" + deleteId;
            }
        });
    } else {
        $(".btn-delete").hide();
    }

    if (perm.upd != 1 && perm.del != 1) {
        $("#datatable-editable th:last-child, #datatable-editable td:last-child").hide();
    }
</script>