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
                    <h4 class="pull-left page-title">Authentification</h4>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="m-b-30">
                                <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#ajout-modal">Ajouter</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped" id="datatable-editable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Methode</th>
                                <th>Lien</th>
                                <th>Body</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($auth as $donnee) { ?>
                                <tr class="gradeX">
                                    <td><?= $i++ ?></td>
                                    <td><?= $donnee['methode'] ?></td>
                                    <td><?= $donnee['liens'] ?></td>
                                    <td><?= $donnee['body'] ?></td>
                                    <td class="actions">
                                        <a href="#" class="on-default edit-row"
                                            data-toggle="modal"
                                            data-target="#edit-modal"
                                            data-id="<?= $donnee['id'] ?>"
                                            data-methode="<?= $donnee['methode_auth'] ?>"
                                            data-lien="<?= $donnee['lien_auth'] ?>"
                                            data-body="<?= $donnee['body'] ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#"
                                            class="on-default remove-row btn-delete"
                                            data-id="<?= $donnee['id']; ?>">
                                            <i class="fa fa-trash-o"></i>
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
        <div id="ajout-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                        <h4 class="modal-title">Nouvelle authentification</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('AjoutAuthentification') ?>" method="POST">
                            <div class="row">
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
                                        <label for="field-2" class="control-label">Base URL</label>
                                        <select class="form-control" name="lien">
                                            <option>choisir le lien...</option>
                                            <?php
                                            foreach ($lien as $donnee) { ?>
                                                <option value="<?= $donnee['id'] ?>"><?= $donnee['base_url'] ?></option>;
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Body</label>
                                        <input type="text" class="form-control" id="field-2" name="body">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-info waves-effect waves-light">Ajouter</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div><!-- /.modal -->

        <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                        <h4 class="modal-title">Modification d'une authentification</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('EditAuthentification') ?>" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="id" name="id">
                                        <label class="control-label">Methode</label>
                                        <select class="form-control" name="meth">
                                            <option></option>
                                            <?php foreach ($methode as $datamet) { ?>
                                                <option value="<?= $datamet['id'] ?>"><?= $datamet['methode_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Base URL</label>
                                        <select class="form-control" name="lien">
                                            <option></option>
                                            <?php foreach ($lien as $datalien) { ?>
                                                <option value="<?= $datalien['id'] ?>"><?= $datalien['base_url'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Body</label>
                                        <input type="text" class="form-control" name="body" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-info waves-effect waves-light">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- content -->


<div id="dialog" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
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
    var resizefunc = [];
    //edit
    $('#edit-modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        let id = button.data('id');
        let methode = button.data('methode');
        let lien = button.data('lien');
        let body = button.data('body');

        var modal = $(this);
        modal.find('input[name="id"]').val(id);
        modal.find('select[name="meth"]').val(methode);
        modal.find('select[name="lien"]').val(lien);
        modal.find('input[name="body"]').val(body);
    });

    //supression
    $('.btn-delete').click(function(e) {
        e.preventDefault();
        deleteId = $(this).data('id');
        $('#dialog').modal('show');
    });

    $('#dialogConfirm').click(function() {
        if (deleteId) {
            window.location.href = "<?= base_url('DeleteAuthentification/'); ?>" + deleteId;
        }
    });
</script>