<?php
// La page du formulaire de création d'un compte.
// Le formulaire sera envoyé vers ../traitement/creercompte.php

session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:../affichage/mur.php");
}



include("entete.php");

// Il faut faire des requêtes pour afficher ses amis, les attentes, les gens qu'on a invités qui ont pas répondu etc..
// Elles sont listées ci-dessous
// Connaitre ses amis : 

echo "<h2>Créer un compte</h2>";
echo "<form action='../traitement/creercompte.php' method='post'>";
echo	"Pseudo ".input('text','pseudo',array("placeHolder"=>'Pseudo','required'=>'required'))."<br/>";
echo	"Mot de passe ".input('password','psswd',array("placeHolder"=>'Mot de passe','required'=>'required'))."<br/>";
echo	"Mot de passe ".input('password','psswdv',array("placeHolder"=>'Confirmation','required'=>'required'))."<br/>";
echo	input('submit','valide',array("value"=>'Créer'));

echo "</form>";

?>


<?php

include("pied.php");
?>
