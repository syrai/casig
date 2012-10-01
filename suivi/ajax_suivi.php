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
		
		pg_close($idcom);
	}
	// Page accueil avec affichage de l'ensemble des suivi
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_suivi_n")
	{
		$idcom=connex("SIA","myparam");
		$requete="select tt.resume,tt.idticket,tt.description,count(ts.idticket) as n,tt.datecreation,tty.libelle,tst.libelle ";
		$requete.="FROM tticket tt JOIN tticketsuivi ts USING (idticket) JOIN ttypeticket tty USING (idtypeticket) ";
		$requete.="JOIN tstatutticket tst USING (idstatutticket) GROUP BY  tt.resume,tt.idticket,tt.description,tt.datecreation,tty.libelle,tst.libelle";
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
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_suivi_n_ti")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT ts.description,ts.datecreation FROM tticketsuivi ts ";
		$requete.="WHERE ts.idticket='".$_POST['idticket']."'";
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
	// Ajout Liste des types de ticket
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="affiche_type_ticket")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT idtypeticket,libelle FROM ttypeticket order by libelle ";
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
?>
?>