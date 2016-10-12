<?php
// La page de gestion des amis.
// Amis, attente, invitation (les bannis on les aime pas, on les affiche pas)
// Formulaire d'acceptation/refus amitié
// formulaire de demande d'amitié

session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:../affichage/login.php");
}


include("entete.php");

// Il faut faire des requêtes pour afficher ses amis, les attentes, les gens qu'on a invités qui ont pas répondu etc..
// Elles sont listées ci-dessous
	echo "<form method='GET' action='#' >";
	echo "<input type='text' placeholder='rechercher un ami' name='rechercher'>";
	echo "<input type='submit' value='rechercher'>";
	echo "</form>";
	
if(isset($_GET['rechercher'])) {
	$sql ="SELECT * FROM utilisateur WHERE login like CONCAT('%',?,'%') and id<>? and id NOT IN(select idUtilisateur1 FROM lien WHERE idUtilisateur2=?) and id NOT IN(select idUtilisateur2 FROM lien WHERE idUtilisateur1=?) ";
	$query = $pdo -> prepare($sql);
	$query->execute(array($_GET["rechercher"],$_SESSION['id'],$_SESSION['id'],$_SESSION['id']));
	echo "<ul>";
	while($line = $query->fetch()) {
		echo "<li>".$line['login'];
	 echo lien("../traitement/demanderamitie.php?etat=attente&id=".$line['id']," tu veut devenir mon ami ? ");
	 "</li>";
	}
	echo "</ul> </div>";
 }


// Connaitre les gens que l'on a invité et qui n'ont pas répondu : 
$sql = "SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON utilisateur.id=idUtilisateur2 AND etat='attente' AND idUtilisateur1=?";
$query = $pdo -> prepare($sql);
$query->execute(array($_SESSION['id']));
//Paramètre 1 : le $_SESSION['id']

echo "<div id='ami'> <h3>En attente d'une réponse: </h3> </br>";
echo "<ul>";
while($line = $query->fetch()) {
	 echo "<li>".$line['login']."</li>";
 }
 echo "</ul> </div>";

// Connaitre les gens qui nous ont invité et pour lequel on a pas répondu 
$sql = "SELECT utilisateur.* FROM utilisateur WHERE id IN(SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente')";
$q = $pdo -> prepare($sql);
$q->execute(array($_SESSION['id']));

echo "<div id='ami'><h3> Attendant votre réponse : </h3> </br>";
echo "<ul>";
while($line = $q->fetch()) {
	 echo "<li>".$line['login'];
	 echo lien("../traitement/valideramitie.php?etat=ami&id=".$line['id'],"viens me faire un calin mon gars ");
	 echo lien("../traitement/valideramitie.php?etat=banni&id=".$line['id'],"casse toi tu pus ");
	 "</li>";
 }
 echo "</ul> </div>";
//Paramètre 1 : le $_SESSION['id']



// Connaitre ses amis : SELECT * FROM utilisateur WHERE id IN (SELECT )
$sql = "SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur1=utilisateur.id AND etat='ami' AND idUTilisateur2=? UNION SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur2=utilisateur.id AND etat='ami' AND idUTilisateur1=? ORDER BY login";
$qami = $pdo -> prepare($sql);
$qami->execute(array($_SESSION['id'],$_SESSION['id']));

echo "<div id='ami'> <h3>Vos amis: </h3> </br>";
echo "<ul>";
while($line = $qami->fetch()) {
	 echo "<li>";
	 echo lien("../affichage/mur.php?id=".$line['id'],$line['login']);
	 echo lien("../traitement/valideramitie.php?etat=banni&id=".$line['id']," casse toi tu pus ");
	 echo "</li>";
 }
 echo "</ul> </div>";
//Les deux paramètres sont le $_SESSION['id']




?>



<?php

include("pied.php");
?>
