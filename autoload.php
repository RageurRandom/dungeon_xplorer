<?php 
// autoload.php
spl_autoload_register(function ($class) {
    $directories = array(
        'models/',
        'controllers/',
        'models/hero/',
        'models/item/', 
        'models/item/spell/', 
    );

    foreach ($directories as $directory) {
        $filePath = $directory . $class . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
});

?>