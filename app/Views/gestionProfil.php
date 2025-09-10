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
                    <h4 class="pull-left page-title">Gestion profil</h4>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
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
                                <th>Profil</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($profil as $donnee) { ?>
                                <tr class="gradeX">
                                    <td><?= $donnee['profile_name'] ?></td>
                                    <td style="text-align: center;">
                                        <a href="#" class="btn-role" data-toggle="modal" data-target="#roles-modal"
                                            data-id="<?= $donnee['id']; ?>">
                                            <i class="fa fa-cogs"></i>
                                        </a>
                                    </td>
                                    <td class="actions">
                                        <a href="#" class="on-default edit-row" data-toggle="modal"
                                            data-target="#edit-modal" data-id="<?= $donnee['id'] ?>"
                                            data-profil="<?= $donnee['profile_name'] ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="on-default remove-row btn-delete"
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

    <div id="ajout-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Nouveau profil</h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('AjoutProfil') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Profil</label>
                                    <input type="text" class="form-control" id="field-2" name="profil">
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
    </div>

    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Modifier un profil</h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('EditProfil') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" id='id' name="id">
                                    <label for="field-2" class="control-label">Profil</label>
                                    <input type="text" class="form-control" id="field-2" name="profil">
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

    <div id="roles-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="rolesModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Gestion de rôle pour les utilisateurs </h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('SaveRole') ?>" method="POST">
                        <input type="hidden" name="profil" id="profil">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Liste des menus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($menu as $donnee): ?>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="menu-item" data-toggle="modal"
                                                            data-target="#smenu-modal" data-id="<?= $donnee['id'] ?>">
                                                            <?= $donnee['libelle'] ?>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div id="submenu-container">
                                    <p class="text-muted">Veuillez sélectionner un menu pour voir ses sous-menus.</p>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer" style="margin-top: 20px;">
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-info waves-effect waves-light">Enregistrer</button>
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
    let menus = <?= json_encode($menu) ?>;
    let checkboxSelect = {};

    function EnreCheckSelect() {
        document.querySelectorAll("#submenu-container input[type=checkbox]").forEach(cb => {
            if (!checkboxSelect[cb.name]) {
                checkboxSelect[cb.name] = {};
            }
            checkboxSelect[cb.name].value = cb.checked;
        });
    }

    function RestCheckSelect() {
        document.querySelectorAll("#submenu-container input[type=checkbox]").forEach(cb => {
            if (checkboxSelect[cb.name] && checkboxSelect[cb.name].value) {
                cb.checked = true;
            }
        });
    }

    document.querySelectorAll(".menu-item").forEach(item => {
        item.addEventListener("click", function (e) {
            e.preventDefault();

            EnreCheckSelect();

            let menuId = this.getAttribute("data-id");
            let menu = menus.find(m => m.id == menuId);

            let html = `
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sous-menus</th>
                        <th>Lecture</th>
                        <th>Ajout</th>
                        <th>Modif</th>
                        <th>Suppr</th>
                    </tr>
                </thead>
                <tbody>
            `;

            if (menu && menu.sous_menus.length > 0) {
                menu.sous_menus.forEach(sm => {
                    html += `
                        <tr>
                            <td>${sm.libelle}</td>
                            <td><input type="checkbox" name="read[${sm.id}]" value="1"></td>
                            <td><input type="checkbox" name="add[${sm.id}]" value="1"></td>
                            <td><input type="checkbox" name="upd[${sm.id}]" value="1"></td>
                            <td><input type="checkbox" name="del[${sm.id}]" value="1"></td>
                        </tr>
                    `;
                });
            } else {
                html += `
                    <tr>
                        <td colspan="5" class="text-center text-muted">Aucun sous-menu pour ce menu</td>
                    </tr>
                `;
            }

            html += `</tbody></table>`;
            document.getElementById("submenu-container").innerHTML = html;

            RestCheckSelect();
        });
    });
</script>

<script>
    var resizefunc = [];

    //modification
    $('#edit-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        let id = button.data('id');
        let profil = button.data('profil');

        var modal = $(this);
        modal.find('input[name="id"]').val(id);
        modal.find('input[name="profil"]').val(profil);
    });

    //suppression
    $('.btn-delete').click(function (e) {
        e.preventDefault();
        deleteId = $(this).data('id');
        $('#dialog').modal('show');
    });
    $('#dialogConfirm').click(function () {
        if (deleteId) {
            window.location.href = "<?= base_url('DeleteProfil/'); ?>" + deleteId;
        }
    });

    //gestion role pour les profils
    $(document).on("click", ".btn-role", function (e) {
        e.preventDefault();
        let profilId = $(this).data("id");
        $("#roles-modal input[name='profil']").val(profilId);

        $("#roles-modal").modal("show");
    });

    //pour pouvoir faire des choix dans plusieurs menus sans perdre les precedents...
    document.querySelector("#roles-modal form").addEventListener("submit", function (e) {
        for (let checkb in checkboxSelect) {
            if (!this.querySelector('[name="' + checkb + '"]')) {
                let input = document.createElement("input");
                input.type = "hidden";
                input.name = checkb;

                if (checkboxSelect[checkb].value) {
                    input.value = "1";
                    this.appendChild(input);
                }
            }
        }
    });
</script>