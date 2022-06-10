<?php
session_start();
session_destroy();

header('Location: http://'.$_SERVER['SERVER_NAME'] .'/Sismissing/Index.php');
?>
