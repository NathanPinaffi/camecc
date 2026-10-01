<?php
declare(strict_types=1);

require __DIR__ . '/inc/helpers.php';
$data = require __DIR__ . '/inc/data.php';

$site = $data['site'];
$title = $site['name'] . ' — ' . $site['full_name'];
$description = $site['tagline'] . ' Conheça o centro acadêmico, os membros e acompanhe o Trucamecc, o Snooker Open e o Snooker Doubles.';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?= e($title) ?></title>
    <meta name="description" content="<?= e($description) ?>">
    <meta name="theme-color" content="#e11d1d">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e($title) ?>">
    <meta property="og:description" content="<?= e($description) ?>">
    <meta property="og:image" content="<?= asset('assets/img/cameccao.webp') ?>">
    <link rel="icon" type="image/svg+xml" href="<?= asset('assets/img/favicon.svg') ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,400&family=Titan+One&family=Permanent+Marker&display=swap">
    <link rel="preload" as="image" href="<?= asset('assets/img/cameccao.webp') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
    <script>document.documentElement.classList.add('js');</script>
</head>
<body>
    <a class="skip-link" href="#conteudo">Pular para o conteúdo</a>

    <?php include __DIR__ . '/partials/preloader.php'; ?>
    <div class="progress" aria-hidden="true"><span></span></div>

    <?php include __DIR__ . '/partials/header.php'; ?>

    <main id="conteudo">
        <?php
        include __DIR__ . '/partials/hero.php';
        include __DIR__ . '/partials/about.php';
        include __DIR__ . '/partials/members.php';
        include __DIR__ . '/partials/tournaments.php';
        include __DIR__ . '/partials/contact.php';
        ?>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>

    <script src="<?= asset('assets/js/main.js') ?>" defer></script>
</body>
</html>
