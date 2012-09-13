<?php
include("../connexion/connex.inc.php");
// Compte rendu
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="compte_rendu")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT typr,origine,resume,description,datecreation,(SELECT count(idsuivi)";
		$requete.= " FROM thistoriqueabonne WHERE thistoriqueabonne.idsuivi=tsuivi.idsuivi)";
		$requete.=" as n,idsuivi FROM tsuivi WHERE idexploitation='".$_POST['idexploitation']."' ORDER by datecreation desc";
		$result=pg_query($idcom,$requete);
		if(pg_num_rows($result)>0) {
			$myarray = array();
			while ($row = pg_fetch_row($result)) {
  				$myarray[] = $row;
			}
			echo json_encode($myarray);
		}
		pg_close($idcom);
	}
	
	// Ajout d'une suivi
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="ajouter_activite")
	{
		$idcom=connex("SIA","myparam");
		$requete="INSERT INTO tsuivi (typr,origine,resume,description,datecreation,idexploitation,rappel) VALUES (";
		$requete.="'".$_POST['type']."','".$_POST['origine']."','".$_POST['resume']."','".$_POST['description']."',now(),'".$_POST['idexploitation']."','".$_POST['rappel']."')";
		$result=pg_query($idcom,$requete);
		if(pg_num_rows($result)>0) {
			$myarray = array();
			while ($row = pg_fetch_row($result)) {
  				$myarray[] = $row;
			}
			echo json_encode($myarray);
		}
		echo $requete;
		pg_close($idcom);
	}
?>