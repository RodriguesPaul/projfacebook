<!doctype html>
<html lang="fr">
<head>
<!-- <link rel='stylesheet' type='text/css' href='style.css' /> -->
  <meta charset="utf-8">
  <title>Titre de la page</title>
<!--  <link rel="stylesheet" href="../css/style.css"> -->
</head>
<body>

<?php
echo "<div id='entete'>";
echo "<h1> Titre </h1>";
if(isset($_SESSION["login"])){
	echo "Connected as ".$_SESSION["login"]."</br>";
	echo "<a href='../traitement/deconnexion.php'> Deconnexion </a> </br>";
	echo "<a href='../affichage/ami.php'>Plus d'ami ?</a> </br>";
echo "</div>";
}
// Ici il faut mettre l'entete de la page pour pas la réécrire à chaque fois !
// Style l'image du site


?>
 
<div id="contenu">
