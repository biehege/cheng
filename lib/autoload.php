<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

// auto require when using class (model)
spl_autoload_register(function ($classname) {
    $root = APP_ROOT . 'lib' . DIRECTORY_SEPARATOR . 'vender' . DIRECTORY_SEPARATOR;
    $file = $root . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    if (file_exists($file)) 
        require_once $file;
});
