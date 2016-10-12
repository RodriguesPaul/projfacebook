<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_POST['pseudo']) || !isset($_POST['psswd']))  // Le formulaire a été soumis
	header("Location:../affichage/login.php");
else {
	$sql = "SELECT * FROM utilisateur WHERE login=? AND passwd=MD5(?) ";
	$q = $pdo->prepare($sql);
	$q->execute(array($_POST['pseudo'],$_POST['psswd']));

	$line = $q->fetch();
	if($line==false) 
		header("Location:../affichage/login.php");
	else {
		$_SESSION['id'] = $line['id'];
		$_SESSION['login'] = $line['login'];

		header("Location:../affichage/mur.php?id=".$_SESSION['id']);
	}
}

	
	



?>





