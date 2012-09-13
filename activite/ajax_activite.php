<?php
include("../connexion/connex.inc.php");
// Liste des valeurs pour les statuts de factures
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_activite")
	{
		$idcom=connex("ACTI","myparam");
		$requete="SELECT idtypeactivite,libelle FROM ttypeactivite";
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
		
	$idcom=connex("ACTI","myparam");
	$requete="INSERT INTO tactivite(date,temps,idtypeactivite) VALUES ('".$_POST['datejour']."','".$_POST['temps']."','".$_POST['idtypeactivite']."')";
	$result=pg_query($idcom,$requete);
	pg_close($idcom);
}

// Compte rendu
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="compte_rendu")
	{
		$idcom=connex("ACTI","myparam");
		$requete="SELECT libelle,annnee,mois,sum,nbre_jour,jour_effectif FROM compte_rendu";
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
	// Compte rendu
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="compte_rendu_horaire")
	{
		$idcom=connex("ACTI","myparam");
		$requete="SELECT to_char(ta.date,'DD/MM/YY') as date,sum(ta.temps),tt.libelle       FROM tactivite ta    JOIN ttypeactivite tt USING (idtypeactivite)  ";
		$requete.="JOIN tmois ON tmois.mois::double precision = date_part('month'::text, ta.date)";
		$requete.="WHERE date_part('year'::text, ta.date)='".$_POST['millesime']."' and tmois.libellemois='".$_POST['mois']."' ";
		$requete.="GROUP BY ta.date,tt.libelle     ORDER BY date,sum(ta.temps) DESC ";
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