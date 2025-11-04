<?= $this->include('template/header') ?>
<?= $this->include('template/top_bar') ?>
<?= $this->include('template/left_sidebar') ?>


<link rel="stylesheet" href="<?= base_url() ?>assets/swagger-ui/css/swagger-ui.css">

<script src="<?= base_url() ?>assets/swagger-ui/js/swagger-ui-bundle.js"></script>
<script src="<?= base_url() ?>assets/swagger-ui/js/swagger-ui-standalone-preset.js"></script>
<script src="<?= base_url() ?>assets/swagger-ui/js/swagger-initializer.js"></script>

<div id="swagger-ui" style="width: 80%; height: 100%;padding-top: 89px; padding-bottom: 50px; margin-left: 19.5%; border: 1px solid #ccc;"></div>

<?= $this->include('template/footer') ?>