<?php
spl_autoload_register(function ($class) {
    $class = strtolower(str_replace('\\',DIRECTORY_SEPARATOR,$class));
    if(file_exists(ROOT_DIR.'app/' . $class . '.class.php'))
        include_once ROOT_DIR . 'app/' . $class . '.class.php';
    if(file_exists(ROOT_DIR . 'app/' . $class . '.class.php'))
        include_once ROOT_DIR . 'app/' . $class . '.class.php';
    if(file_exists(ROOT_DIR . 'app/' . $class . '.interface.php'))
        include_once ROOT_DIR . 'app/' . $class . '.interface.php';
});