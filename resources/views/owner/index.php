<?php $title = 'Laporan Owner'; ?>

<link href="<?= urlpath('assets/favicon/favicon.png') ?>" rel="icon">

<?php ob_start() ?>
<?php
if (isset($url)) {
    include_once $url . '.php';
}
?>

<?php include 'resources/views/master/master_layout.php'; ?>