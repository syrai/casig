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
		
		$requete="select tt.resume,tt.idticket,tt.description,count(ts.idticket) as n,tt.datecreation,tty.libelle,tst.libelle,tc.raison_social,tst.libelle ";
		$requete.="FROM tticket tt LEFT JOIN tticketsuivi ts USING (idticket) JOIN ttypeticket tty USING (idtypeticket) ";
		$requete.="JOIN tstatutticket tst USING (idstatutticket) JOIN tcartonet tc USING (idexploitation) ";
		$requete.=" GROUP BY  tt.resume,tt.idticket,tt.description,tt.datecreation,tty.libelle,tst.libelle,tc.raison_social,tst.libelle";
		
		
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
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_suivi_n_slider")
	{
		$idcom=connex("SIA","myparam");
		
		$requete="select tt.resume,tt.idticket,tt.description,count(ts.idticket) as n,tt.datecreation,tty.libelle,tst.libelle,tc.raison_social,tst.libelle ";
		$requete.="FROM tticket tt LEFT JOIN tticketsuivi ts USING (idticket) JOIN ttypeticket tty USING (idtypeticket) ";
		$requete.="JOIN tstatutticket tst USING (idstatutticket) JOIN tcartonet tc USING (idexploitation) ";
		$requete.="WHERE idstatutticket='".$_POST['dispo']."' ";
		$requete.=" GROUP BY  tt.resume,tt.idticket,tt.description,tt.datecreation,tty.libelle,tst.libelle,tc.raison_social,tst.libelle";
		
		
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
		if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_suivi_n_slider2")
	{
		$idcom=connex("SIA","myparam");
		
		$requete="select tt.resume,tt.idticket,tt.description,count(ts.idticket) as n,tt.datecreation,tty.libelle,tst.libelle,tc.raison_social,tst.libelle ";
		$requete.="FROM tticket tt LEFT JOIN tticketsuivi ts USING (idticket) JOIN ttypeticket tty USING (idtypeticket) ";
		$requete.="JOIN tstatutticket tst USING (idstatutticket) JOIN tcartonet tc USING (idexploitation) ";
		$requete.=" WHERE tt.idexploitation='".$_POST['idexploitation']."' AND idstatutticket='".$_POST['dispo']."'";
		$requete.=" GROUP BY  tt.resume,tt.idticket,tt.description,tt.datecreation,tty.libelle,tst.libelle,tc.raison_social,tst.libelle ";
		
		
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
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_suivi_n2")
	{
		$idcom=connex("SIA","myparam");
		
		$requete="select tt.resume,tt.idticket,tt.description,count(ts.idticket) as n,tt.datecreation,tty.libelle,tst.libelle,tc.raison_social,tst.libelle ";
		$requete.="FROM tticket tt LEFT JOIN tticketsuivi ts USING (idticket) JOIN ttypeticket tty USING (idtypeticket) ";
		$requete.="JOIN tstatutticket tst USING (idstatutticket) JOIN tcartonet tc USING (idexploitation) ";
		$requete.=" WHERE tt.idexploitation='".$_POST['idexploitation']."' ";
		$requete.=" GROUP BY  tt.resume,tt.idticket,tt.description,tt.datecreation,tty.libelle,tst.libelle,tc.raison_social,tst.libelle ";
		
		
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
		$requete="SELECT ts.description,ts.datecreation,idticketsuivi FROM tticketsuivi ts ";
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
	
		if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_abonne2")
	{
		$idcom=connex("SIA","myparam");
		$requete="select  idexploitation,raison_social || ' ' || tt.libelle as rdv  from tcartonet JOIN ttypeabonnement tt USING (idtypeabonnement) ";
		$requete.=" WHERE tcartonet.raison_social like upper('%".$_POST['raisonsociale']."%') ORDER BY raison_social ";

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
	// Ajout d'un nouveau ticket
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="nouveau_ticket")
{

	// Insertion dans l'historique de l'abonné
	// Table thistoabonnement avec comme statut ancien = Contact(25)
	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO tticket(idexploitation,idutilisateur,idtypeticket,idstatutticket,datecreation,resume,description) VALUES ";
	if(isset($_POST['idexploitation']) && !empty ($_POST['idexploitation'])) {
		$requete.="('".$_POST['idexploitation']."','".$_POST['idutilisateur']."','".$_POST['idtypeticket']."','1',now(),'".$_POST['resume']."','".$_POST['description']."')";
	}
	
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
	
}
	// Ajout d'un nouveau suivi ticket
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="nouveau_suiviticket")
{

	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO tticketsuivi(idticket,idutilisateur,datecreation,description) VALUES ";
	if(isset($_POST['idticket']) && !empty ($_POST['idticket'])) {
		$requete.="('".$_POST['idticket']."','".$_POST['idutilisateur']."',now(),'".$_POST['description']."')";
	}

	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
	
}
	// suppirmeru suivi ticket
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="supp_suiviticket")
{

	$idcom=connex("SIA","myparam");
	$requete="DELETE FROM tticket WHERE idticket='".$_POST['idticket']."'";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
		$idcom=connex("SIA","myparam");
	$requete="DELETE FROM tticketsuivi WHERE idticket='".$_POST['idticket']."'";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
	
}
	// suppirmeru suivi ticket
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="supp_suiviticket2")
{

		$idcom=connex("SIA","myparam");
	$requete="DELETE FROM tticketsuivi WHERE idticketsuivi='".$_POST['idticketsuivi']."'";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
	
}
// changement statut ticket
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="statut_ticket")
{

	$idcom=connex("SIA","myparam");
	$requete="UPDATE tticket set idstatutticket='".$_POST['idstatutticket']."'  WHERE idticket='".$_POST['idticket']."'";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
	
}
?>