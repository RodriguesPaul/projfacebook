<?php
function att($att){
	$o = "";
	foreach( $att as $at => $noma){
		 $o = $o . "$at='$noma' ";
	 }
	  return $o;
}

function lien($link,$texte,$attributes=array()){
	$o = att($attributes);
	return "<a href='$link' $o>$texte</a>";
}

function item($contenu,$attributes=array()){
	$o = att($attributes);
	echo"
	<li $o> $contenu</li>";
}

function table($table){
	$tmp = "";
	foreach($table as $tabl){
		$tmp = $tmp . "<tr>";
		foreach($tabl as $tab){
			$tmp = $tmp . "<td>$tab</td>";
		}
		$tmp = $tmp . "</tr>";
}
return $tmp;
}

function input($type,$name,$attributes = array()) {
	$opt = att($attributes);
	return "<input type='$type' name='$name' $opt />";
}

function select($name,$tabValeurs) {
	$tmp ="";
	foreach($tabValeurs as $ret=>$val) {
		$tmp = $tmp. "<option value='$ret'>$val</option>\n";
	}

	return "<select name='$name'>$tmp</select>";
}
?>
