<?php
spl_autoload_register(function($class){
    $path2class = 'classes/' . strtolower($class) .'.php';
    if(file_exists($path2class)){
        require_once($path2class);
    }
});