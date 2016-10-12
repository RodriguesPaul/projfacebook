<?php
session_start();

include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:../traitement/login.php");
}

$sql = " INSERT INTO ecrit VALUES(NULL,?,?,NOW(),NULL,?,?)";
$query = $pdo -> prepare($sql);
$query->execute(array($_POST['titre'],$_POST['contenu'],$_SESSION['id'],$_POST['ami']));

header("Location:../affichage/mur.php?id=".$_POST['ami']);

// Ecrire un message


?>
