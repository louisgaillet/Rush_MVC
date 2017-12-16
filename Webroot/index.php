<?php 
require_once('../Src/Dispatcher.php');

define('ROOT', str_replace('Webroot/index.php', '', $_SERVER['SCRIPT_FILENAME']));


$dispatcher = new Dispatcher();

?>
