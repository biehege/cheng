<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

// auto require when using class (model)
spl_autoload_register(function ($classname) {
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    $model_file = APP_ROOT . 'model' . DIRECTORY_SEPARATOR . $filename;
    $lib_file = APP_ROOT . 'lib' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . $filename;
    if (file_exists($model_file)) 
        require_once $model_file;
    elseif (file_exists($lib_file))
        require_once $lib_file;
    // $root = APP_ROOT . 'lib' . DIRECTORY_SEPARATOR . 'vender' . DIRECTORY_SEPARATOR;
    // $file = $root . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    // if (file_exists($file)) 
    //     require_once $file;
});
