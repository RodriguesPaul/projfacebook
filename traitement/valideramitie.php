<?php
session_start();

include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}

$sql="UPDATE lien set etat=? WHERE (idUtilisateur1=? and idUtilisateur2=?) OR (idUtilisateur1=? and idUtilisateur2=?)";
$query = $pdo -> prepare($sql);
$query -> execute(array($_GET['etat'],$_GET['id'],$_SESSION['id'],$_SESSION['id'],$_GET['id']));

header("Location:../affichage/mur.php?id=".$_GET['id']);
// La requete de demande de creation amitie : UPDATE lien set etat=? INTO lien WHERE idUtilisateur1=? and idUtilisateur2=?
// Le premier paramètre de la requête la valeur banni si on veut pas ou la valeur ami si on est d'accord
// Le second paramètre de la requête est le $_POST['id'] : celui a qui on repond
// Le troisieme paramètre de la requête est le SESSION['id'] : celui qui répond à la demande d'amitié


?>
