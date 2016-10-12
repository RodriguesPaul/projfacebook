<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_POST['pseudo']) || !isset($_POST['psswd']) || !isset($_POST['psswdv']))
	header("Location:../affichage/creer.php");


if ($_POST['psswd'] == $_POST['psswdv']){
	
	$sql = "INSERT INTO utilisateur VALUES(NULL,?,MD5(?))";
	$query = $pdo -> prepare($sql);
	$query->execute(array($_POST['pseudo'],$_POST['psswd']));
	
	$_SESSION['id'] = $pdo->lastInsertId();
	$_SESSION['login'] = $_POST['pseudo'];
	header("Location:../affichage/ami.php");

} else 
	header("Location:../affichage/creer.php");


// Ca serait bien d'être loggé !
// A la fin on retourne à la page d'amitié :  il faut bien se faire des amis !
?>
