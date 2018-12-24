<?php

if (!function_exists('view')) {
    function view(string $file, $data = null)
    {
        if ($data != null && is_array($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }
        require dirname(__DIR__) . "/views/$file.view.php";
    }
}

if (!function_exists('redirect')) {
    function redirect($path)
    {
        header("Location: $path");
        die();
    }
}