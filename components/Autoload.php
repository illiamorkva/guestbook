<?php

function __autoload($class_name)
{
    //  An array of folders where you can find the necessary classes
    $array_paths = array('/models/', '/components/', '/controllers/',);

    // We go through the array folders
    foreach ($array_paths as $path) {

        // Generated name and path to the file with the class
        $path = ROOT . $path . $class_name . '.php';

        if (is_file($path)) {
            include_once $path;
        }
    }
}

