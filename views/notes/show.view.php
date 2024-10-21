<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>


<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>
            <a href="/notes" class="text-blue-500 hover:underline">Go back...</a>
        </p>

        <p><?= htmlspecialchars($note['body']) ?></p>

        <form method="post">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            <button class="text-red-500">Delete</button>
        </form>
    </div>
</main>


<?php require base_path('views/partials/footer.php') ?>
