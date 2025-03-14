<!-- views/layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My Blog' ?></title>
    <!-- <script src="https://unpkg.com/@tailwindcss/browser@4"></script> -->
    <link href="./css/output.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">

<div class="flex flex-row justify-between items-center p-4 bg-blue-500 text-white">
    <h1 class="text-2xl font-bold">My Blog</h1>

    <?php if(isset($_SESSION['user_id'])) : ?>
        <div class="logout__wrapper">
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
            </form>
            <button form="logout-form" type="submit" class="btn size-fit self-center my-4 px-4 py-1 border-1 border-blue-400 bg-blue-400 hover:bg-blue-200 rounded-md hover:cursor-pointer">Logout</button>
        </div>
    <?php endif; ?>    
</div>

<main class="container mx-auto mt-6 flex-grow">
    <?= $content ?? '' ?>
</main>

<footer class="p-4 mt-6 bg-gray-800 text-white text-center">
    &copy; <?= date('Y'); ?> My Blog
</footer>

</body>
</html>