<?php
session_start();
include("BDD.php");
include("balise.php");


if(isset($_POST['login'])) { // Le formulaire a été soumis
 // Vérifier la concordance entre les données saisies et les données de la table user
	$sql = "SELECT * FROM user WHERE login =? AND passwd=MD5(?)";
	$q = $pdo->prepare($sql);
	$q->execute (array($_POST['login'], $_POST['password']));
	$line = $q->fetch();


if($line==false){
	header("location:cosess.php");
}
$_SESSION['id'] = $line['id'];
$_SESSION['login'] = $line['login'];
header("location:cosess.php");
}

if(isset($_GET['action']) && $_GET['action']=="deconnexion") { // Il taut détruire la session
session_destroy();
header("location:cosess.php");
}

if(isset($_SESSION['id'])) { // On est loggé
echo "bonjour". $_SESSION['login'];
echo lien("cosess.php?action=deconnexion","ciao"); 

} 
else {
echo "<form method='post'>";
echo "pseudo".input("text","login");
echo "<br/>";
echo "password".input("password","password") ;
echo  input("submit","valide");
echo "</form>";
}


?>

