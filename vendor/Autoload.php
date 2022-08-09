<?php
class Autoload {
    static function myautoload($classname){
        $filename=str_replace('\\','/',$classname);
        $filename=__DIR__. '/../'.$filename.'.php';
        if (file_exists($filename)) {
          include $filename;
        }
    }
}
spl_autoload_register(array('Autoload','myautoload'));


?>