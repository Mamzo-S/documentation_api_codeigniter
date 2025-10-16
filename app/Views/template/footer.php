<footer class="footer text-right">
    2025 © SIMEN.
</footer>


<!-- jQuery  -->
<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/waves.js"></script>
<script src="<?= base_url() ?>assets/js/wow.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?= base_url() ?>assets/jquery-detectmobile/detect.js"></script>
<script src="<?= base_url() ?>assets/fastclick/fastclick.js"></script>
<script src="<?= base_url() ?>assets/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?= base_url() ?>assets/jquery-blockui/jquery.blockUI.js"></script>


<!-- CUSTOM JS -->
<script src="<?= base_url() ?>assets/js/jquery.app.js"></script>

<!-- Examples -->
<script src="<?= base_url() ?>assets/magnific-popup/magnific-popup.js"></script>
<script src="<?= base_url() ?>assets/jquery-datatables-editable/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/datatables/dataTables.bootstrap.js"></script>
<script src="<?= base_url() ?>assets/jquery-datatables-editable/datatables.editable.init.js"></script>

<script src="<?= base_url() ?>assets/js/jquery.slimscroll.js"></script>


<!-- TinyMCE officiel avec ton API key -->
<script src="https://cdn.tiny.cloud/1/92kgy4844hy1hphp6izgr2moiswjf4126d4autht0fub7k2o/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: 'textarea.wysiwyg',
        height: 350,
        plugins: 'lists link image table code',
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright | bullist numlist | table | code',
        menubar: false,
        branding: false,
        content_style: 'body { font-family: Courier New, monospace; font-size: 14px }'
    });
</script>