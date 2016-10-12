<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:../affichage/login.php");
}
if(isset($_GET['id'])){
	$sql = "DELETE FROM ecrit where id=?";
	$query = $pdo -> prepare($sql);
	$query->execute(array($_GET['id']));
}


// La requete de suppression d'un écrit (il faut le donner en get : DELETE FROM ecrit where id=?
// Le paramètre est le $_GET['id']

// A la fin on retourne d'où on vient
header("Location:".$_SERVER['HTTP_REFERER']);

?>
