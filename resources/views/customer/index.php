<?php $title = 'Review'; ?>
<link href="<?= urlpath('assets/favicon/favicon.png') ?>" rel="icon">
<?php ob_start() ?>
<?php
if (isset($url)) {
    include_once $url . '.php';
}
?>
<?php $body = ob_get_clean() ?>

<?php include 'resources/views/master/master_layout.php'; ?>