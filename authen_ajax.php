<?php
include("./connexion/connex.inc.php");
// Menu 
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="droit")
	{
		$idcom=connex("SIA","myparam");
		$requete="select ta.libelle,ta.url FROM tutilisateurs t  ";
		$requete.="JOIN tprofilgamp tp USING (idprofilgamp) JOIN taccesgamp tg ON tg.idprofil=tp.idprofilgamp JOIN tapplicationgamp ta USING (idapplicationgamp) ";
		$requete.="where t.idutilisateur='".$_POST['idutilisateur']."'";
		
		$result=pg_query($idcom,$requete);
		if(pg_num_rows($result)>0) {
			$myarray = array();
			while ($row = pg_fetch_row($result)) {
  				$myarray[] = $row;
			}
			echo json_encode($myarray);
		}
	else {
		echo null;
	}
		pg_close($idcom);
	}
	
	// Menu 
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="verif_login")
	{
		$idcom=connex("SIA","myparam");
		$requete="select t.idutilisateur FROM tutilisateurs t  WHERE nom='".$_POST['login']."'";
		$requete.=" AND password='".$_POST['pass']."'";
		
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