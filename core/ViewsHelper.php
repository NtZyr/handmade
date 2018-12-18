<?php

if (!function_exists('view')) {
    function view(string $file)
    {
        require dirname(__DIR__) . "/views/$file.view.php";
    }
}