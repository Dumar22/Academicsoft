<?php 

spl_autoload_register(function($class){
//busca la ruta del archivo
$file = __DIR__."/".$class.".php";
//configura para servidores linux para evitar problemas
$file = str_replace("\\", "/", $file);

//si no existe el archivo no ejecuta eldigo de arriba

if (is_file($file)) {
   require_once $file;
}
});

?>