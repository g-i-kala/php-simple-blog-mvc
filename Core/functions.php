<?php

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function renderView($viewName, $data = [])
{
    extract($data);
    require base_path("app/views/" . $viewName . ".view.php");
}

function displayError($errors, $key)
{
    if (isset($errors[$key])) {
        echo "<p class='text-red-500 font-bold text-sm mt-2'>" . htmlspecialchars($errors[$key]) . "</p>";
    }
    return '';
}
