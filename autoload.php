<?php
/*------ Autoloader ------*/
spl_autoload_register(
    function ($class) {
        $ruta = '../'.str_replace('\\', '/', $class).'.php';
        if(file_exists($ruta)) {
            include_once $ruta;
        }else {
            die("No se encuentra la clase $class");
        }
    }
);
