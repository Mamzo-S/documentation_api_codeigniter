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
                    <h4 class="pull-left page-title">Liste des menus</h4>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="m-b-30">
                                <button class="btn btn-primary waves-effect waves-light btn-add" data-toggle="modal" data-target="#ajout-modal">Ajouter</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped" id="datatable-editable">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Libelle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menu as $donnee) { ?>
                                <tr class="gradeX">
                                    <td><?= $donnee['code'] ?></td>
                                    <td><?= $donnee['libelle'] ?></td>
                                    <td class="actions">
                                        <a href="#" class="on-default edit-row"
                                            data-toggle="modal"
                                            data-target="#edit-modal"
                                            data-id="<?= $donnee['id'] ?>"
                                            data-code="<?= $donnee['code'] ?>"
                                            data-lib="<?= $donnee['libelle'] ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#"
                                            class="on-default remove-row btn-delete"
                                            data-id="<?= $donnee['id']; ?>">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- end: page -->

            </div> <!-- end Panel -->

        </div> <!-- container -->

    </div> <!-- content -->

    <div id="ajout-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Nouveau menu</h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('AjoutMenu') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Code</label>
                                    <input type="text" class="form-control" id="field-2" name="code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Libelle</label>
                                    <input type="text" class="form-control" id="field-2" name="libelle">
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
    </div>

    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Modifier un menu</h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('EditMenu') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" id='id' name="id">
                                    <label for="field-2" class="control-label">Code</label>
                                    <input type="text" class="form-control" id="field-2" name="code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Libelle</label>
                                    <input type="text" class="form-control" id="field-2" name="libelle">
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
    var resizefunc = [];

    //modification
    $('#edit-modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        let id = button.data('id');
        let code = button.data('code');
        let lib = button.data('lib');

        var modal = $(this);
        modal.find('input[name="id"]').val(id);
        modal.find('input[name="code"]').val(code);
        modal.find('input[name="libelle"]').val(lib);
    });

    //suppression
    $('.btn-delete').click(function(e) {
        e.preventDefault();
        deleteId = $(this).data('id');
        $('#dialog').modal('show');
    });
    $('#dialogConfirm').click(function() {
        if (deleteId) {
            window.location.href = "<?= base_url('DeleteMenu/'); ?>" + deleteId;
        }
    });

    //gestion de roles et permissions
    let smenuId = 4;
    let perm = role[(smenuId)];
    if (perm.add == 1) {
        $(".btn-add").show();
    } else {
        $(".btn-add").hide();
    }

    if (perm.upd == 1) {
        $('#edit-modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            let id = button.data('id');
            let code = button.data('code');
            let lib = button.data('lib');

            var modal = $(this);
            modal.find('input[name="id"]').val(id);
            modal.find('input[name="code"]').val(code);
            modal.find('input[name="libelle"]').val(lib);
        });
    } else {
        $(".edit-row").hide();
    }

    if (perm.del == 1) {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            deleteId = $(this).data('id');
            $('#dialog').modal('show');
        });
        $('#dialogConfirm').click(function() {
            if (deleteId) {
                window.location.href = "<?= base_url('DeleteMenu/'); ?>" + deleteId;
            }
        });
    } else {
        $(".btn-delete").hide();
    }

    if (perm.upd != 1 && perm.del != 1) {
        $("#datatable-editable th:last-child, #datatable-editable td:last-child").hide();
    }
</script>