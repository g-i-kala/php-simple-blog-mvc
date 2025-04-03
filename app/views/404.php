<?php

$title = "404 Not Found";
ob_start();

?>
<div>
    <div class="header__wrapper mx-auto py-8">
        <h1 class="font-bold text-4xl">
            I think you're lost<?php (isset($_SESSION['username'])) ? htmlspecialchars($_SESSION['username']) : '' ?>.
        </h1>
        <p>
            <a href="/" class="link size-fit self-center my-4  py-1 text-blue-400 hover:text-blue-700 ">Go back home. </a>
        </p>
    </div>
    
</div>

<?php
$content = ob_get_clean();
include 'layout.view.php';
?>