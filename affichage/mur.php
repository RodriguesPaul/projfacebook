<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	header("Location:../affichage/login.php");
}


include("entete.php");

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	echo "Bizarre !!!!";die(1);
}

// On veut affchier notre mur ou celui d'un de nos amis et pas faire n'importe quoi 

$ok = false;
if($_GET['id']==$_SESSION['id']) {
	$ok = true; // C notre mur, pas de soucis
} else {
	// Verifions si on est amis avec cette personne
	$sql = "SELECT * FROM lien WHERE etat='ami'	AND ((idUtilisateur1=? AND idUtilisateur2=?) OR ((idUtilisateur1=? AND idUtilisateur2=?)))";
	$query = $pdo -> prepare($sql);
	$query->execute(array($_GET['id'],$_SESSION['id'],$_SESSION['id'],$_GET['id']));
	$ok = $query->fetch();
if($ok==false) {
	echo "Vous n'êtes pas encore ami, vous ne pouvez voir son mur !!";
	echo lien("../traitement/demanderamitie.php?etat=attente&id=".$_GET['id'],"voulez vous devenir son ami ?");
	die(1);
	}
}
$sql = "SELECT * FROM utilisateur WHERE id=?";
$query = $pdo -> prepare($sql);
	$query->execute(array($_GET['id']));
	$nom = $query->fetch();
echo "<h3> Bienvenue sur le mur de ".$nom['login']."</h3>";

// Requête de sélection des éléments d'un mur
$sql = "SELECT utilisateur.*,ecrit.* FROM ecrit JOIN utilisateur ON idAuteur=utilisateur.id WHERE idAmi=? ORDER BY dateEcrit DESC";
	$q = $pdo->prepare($sql);
	$q->execute(array($_GET['id'],));
	while($line = $q->fetch()) {
		echo "<div> <p>".$line['titre']."</p>";
		echo "<p>";
		echo $line['contenu'] ;
		echo "</p>";
		echo "<h5>ecrit par: <a href='../affichage/mur.php?id=".$line['idAuteur']."'>".$line['login']."</a></h5>";
	    if($_SESSION['id'] == $line['idAuteur'] || $_SESSION['id'] == $_GET['id'])
	    echo lien("../traitement/effacer.php?id=".$line['id'],"effacer le post");
	}

?>
<h4> Ecrire sur ce mur</h4>
<form action="../traitement/ecrire.php" method="post">
<input type="text" name="titre" required="required">
<br/>
<textarea name="contenu" required="required"></textarea>
<br/>
<input type="submit" name="valider" value="valider">
<input type='hidden' name='ami' value="<?php echo $_GET['id'];?>" />
</form>

<?php

include("pied.php");


?>
