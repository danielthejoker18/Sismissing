<?php
//configurando o PHP para mostrar os erros na tela
ini_set('display_errors', 1);

//configurando o PHP para reportar todos os erro
error_reporting(True);

require_once 'lib/Application.php';

$o_Application = new Application();
$o_Application->dispatch();
