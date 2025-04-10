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
