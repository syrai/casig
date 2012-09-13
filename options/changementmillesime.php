<?php
$id=$_POST['millesime'];
echo "UPDATE tmillesime SET courant='1' WHERE millesime='".$id."';";
include_once("../connexion/connex.inc.php");
$idcom=connex("SIA","myparam");
$requete="UPDATE tmillesime SET courant='1' WHERE millesime='".$id."';";
$result=pg_query($idcom,$requete);
pg_free_result($result);				
?>