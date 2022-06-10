<?php
session_start();

require "models/InfosModel.php";

$o_info = new InfosModel();
$o_info->setInIdUser($_SESSION['in_id']);
$o_info->setInIdDesaparecido($_POST['id']);
$o_info->setStInfo($_POST['st_info']);
if($o_info->save()){$array_retorno = "ok";}else{$array_retorno = "erro";}
echo json_encode($array_retorno);
?>
