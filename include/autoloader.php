<?php
spl_autoload_register('AutoLoader');

function AutoLoader($className) {
    $path = "../classes/";
    $ext = ".class.php";
    $f_path = $path . $className . $ext;

    if(!file_exists($f_path)) {
        return false;
    }
    
    include_once $f_path;
}
?>