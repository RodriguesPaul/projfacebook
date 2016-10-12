<?php
session_start();
session_destroy();
header("Location:../affichage/login.php");
?>
