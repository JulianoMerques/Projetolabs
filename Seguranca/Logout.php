<?php
session_start();
session_destroy();
//Redireciono para realizar login novamente.
header('location:../index.php');
?>
 