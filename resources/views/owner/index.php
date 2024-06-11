<?php $title = 'Laporan Owner'; ?>

<?php ob_start() ?>
<?php
if (isset($url)) {
    include_once $url . '.php';
}
?>

<?php include 'resources/views/master/master_layout.php'; ?>