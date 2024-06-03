<?php $title = 'Ristretto Cafe'; ?>

<?php ob_start(); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<?php $apiscriptlink = ob_get_clean(); ?>

<?php ob_start() ?>
<?php
if (isset($url)) {
    include_once $url . '.php';
}
?>
<?php $body = ob_get_clean() ?>

<?php ob_start() ?>
    <?= urlpath('resources/css/landing.css') ?>
<?php $style = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="<?= urlpath('resources/js/map.js') ?>"></script>
<?php $mapscript = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="<?= urlpath('resources/js/landing.js') ?>"></script>
<script>
    function sendDataToBackend() {
        var form = document.getElementById('registerForm');
        var formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: '<?= urlpath('register') ?>',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                alert('Anda sudah berhasil mendaftar');
                window.location.href = '<?= urlpath('login') ?>';
            },
            error: function(xhr, status, error) {
                var response = JSON.parse(xhr.responseText);
                alert(response.message);
                console.error('Terjadi kesalahan, mohon coba lagi');
            }
        });
    }
</script>
<?php $customscript = ob_get_clean() ?>

<?php ob_start() ?>
<script>
    $(document).ready(function() {
        $('#registerForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: "Bagian ini harus diisi",
                    email: "Silahkan masukkan Email yang valid"
                },
                username: {
                    required: "Bagian ini harus diisi"
                },
                password: {
                    required: "Bagian ini harus diisi"
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass('text-red-500 text-xs');
                error.insertAfter(element.parent());
            },
            highlight: function(element, errorClass, validClass) {
                $(element)
                    .addClass('border-red-500 focus:ring-red-500 focus:border-red-500')
                    .removeClass('border-gray-300 dark:border-gray-600 focus:border-red-600 dark:focus:border-red-500');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element)
                    .removeClass('border-red-500 focus:ring-red-500 focus:border-red-500')
                    .addClass('border-gray-300 dark:border-gray-600 focus:border-red-600 dark:focus:border-red-500');
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
<?php $validatorscript = ob_get_clean() ?>

<?php include 'resources/views/master/master_layout.php'; ?>