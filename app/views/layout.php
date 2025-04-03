<?php require __DIR__ . "/partials/head.view.php"; ?>
<?php require __DIR__ . "/partials/header.view.php"; ?>


<main class="container mx-auto mt-6 flex-grow">
    <?= $content ?? '' ?>
</main>

<?php require __DIR__ . "/partials/footer.view.php"; ?>