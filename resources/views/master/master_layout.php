<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?= $apiscriptlink ?? ''; ?>
    <link rel="icon" type="image/x-icon" href="<?= urlpath('assets/img/favicon.ico') ?>">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
    <link href="<?= urlpath('assets/favicon/favicon.png') ?>" rel="icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <title><?= $title ?? ''; ?></title>
    <style>*{font-family: 'Poppins', sans-serif;}</style>
    <link rel="stylesheet" href="<?= $style ?>">
</head>

<body class="overflow-x-hidden">
    <?= $body ?? ''; ?>
    <?= $searchscript ?? ''; ?>
    <?= $customscript ?? ''; ?>
    <?= $ajaxgetscript ?? ''; ?>
    <?= $ajaxpostscript ?? ''; ?>
    <?= $mapscript ?? ''; ?>
    <?= $validatorscript ?? ''; ?>
    <!-- <div id="overlay">
        <div id="loading-spinner" class="animate-pulse">
            <img src="<?= urlpath('../assets/icons/coffee.svg') ?>" alt="Loading...">
        </div>
    </div>
    <script>
        function showOverlay() {
            $('#overlay').fadeIn();
        }

        function hideOverlay() {
            $('#overlay').fadeOut();
        }
    </script> -->
</body>

</html>