<?php
include("../connexion/connex.inc.php");
// Création d'une nouvelle formation
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="ajouter_formation")
{
		
	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO tcycle(nom,date1,date2,date,lieu,typeformation) VALUES (";
	$requete.="(SELECT libellecourt FROM ttypeformation WHERE idtypedeformation='".$_POST['typeformation']."')  || '_' || '".$_POST['lieuformation']."' || '_' ||'".$_POST['date1']."' ||'_'||'".$_POST['date2']."'  ,'".$_POST['date1']."','".$_POST['date2']."','".$_POST['date1']."','".$_POST['lieuformation']."',(SELECT libellecourt FROM ttypeformation WHERE idtypedeformation='".$_POST['typeformation']."'))";

	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
}
// Liste des type de formation
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_type_formation")
	{
		$idcom=connex("SIA","myparam");
		$requete="select tcy.id_cycle,tcy.nom as formation,count(tf.idexploitation) as n  from tcycle tcy  ";
		$requete.="LEFT JOIN tformation tf USING (id_cycle) LEFT JOIN tcartonet tc ON tc.idexploitation=tf.idexploitation LEFT JOIN tadresseabonne ta ON ta.idexploitation=tf.idexploitation ";
		$requete.="where tcy.date ";
		
		if ($_POST['quand']!='apres'){
			
			$requete.="< ";
		} ELSE {
			$requete.=">= ";
		}
		
		$requete.="Now() GROUP BY tcy.id_cycle,tcy.nom,tcy.date ORDER BY tcy.nom,tcy.date desc";
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
	
// Information sur une formation
// Liste des type de formation
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="titre_formation")
	{
		$idcom=connex("SIA","myparam");
		$requete="select tcy.id_cycle,tcy.nom as formation,count(tf.idexploitation) as n from tformation tf ";
		$requete.="JOIN tcycle tcy USING (id_cycle) JOIN tcartonet tc ON tc.idexploitation=tf.idexploitation JOIN tadresseabonne ta ON ta.idexploitation=tf.idexploitation ";
		$requete.="where tcy.id_cycle='".$_POST['idcycle']."' GROUP BY tcy.id_cycle,tcy.nom,tcy.date";
		
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
	// Participants
	// Liste des type de formation
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_participants_formation")
	{
		$idcom=connex("SIA","myparam");
		$requete="select tcy.id_cycle,tc.idexploitation,tc.raison_social,ta.adresse || ' ' || ta.codepostal || ' à ' || ta.commune as adresse from tformation tf ";
		$requete.="JOIN tcycle tcy USING (id_cycle) JOIN tcartonet tc ON tc.idexploitation=tf.idexploitation JOIN tadresseabonne ta ON ta.idexploitation=tf.idexploitation ";
		$requete.="where tcy.id_cycle='".$_POST['idcycle']."'";
		
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
	// Modification des infos de formation
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="changerlieu")
{
		
	$idcom=connex("SIA","myparam");
	$requete="UPDATE tcycle SET lieu='".$_POST['lieuformation']."',nom=(typeformation || '_' || lieu || '_' || date1 || '_' || date2) WHERE id_cycle='".$_POST['idcycle']."'";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
}
// Modification de la date 1
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="changerdate1")
{
		
	$idcom=connex("SIA","myparam");
	$requete="UPDATE tcycle SET date1='".$_POST['date1']."',date='".$_POST['date1']."',nom=(typeformation || '_' || lieu || '_' || date1 || '_' || date2)  WHERE id_cycle='".$_POST['idcycle']."'";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
}
// Modification de la date 2
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="changerdate2")
{
		
	$idcom=connex("SIA","myparam");
	$requete="UPDATE tcycle SET date2='".$_POST['date2']."',nom=(typeformation || '_' || lieu || '_' || date1 || '_' || date2) WHERE id_cycle='".$_POST['idcycle']."'";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
}
// Ajout
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
	// liste des formation
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_des_cycles")
	{
		$idcom=connex("SIA","myparam");
		$requete="select tcy.id_cycle,tcy.nom as formation  from tcycle tcy  ";
		$requete.="where tcy.date >= ";		
		$requete.="Now() GROUP BY tcy.id_cycle,tcy.nom,tcy.date ORDER BY tcy.nom,tcy.date desc";
		$result=pg_query($idcom,$requete);
		if(pg_num_rows($result)>0) {
			$myarray = array();
			while ($row = pg_fetch_row($result)) {
  				$myarray[] = $row;
			}
			echo json_encode($myarray);
		}
		else {
			echo json_encode(0);
		}
	
		pg_close($idcom);
	}
		// Création du nouvel inscrit
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="ajouter_formation_abonne")
{
	
	// Insertion dans l'historique de l'abonné
	// Table thistoabonnement avec comme statut ancien = Contact(25)
	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO tformation(idexploitation,id_cycle) VALUES (";
	if(isset($_POST['abonne_ajout']) && !empty ($_POST['abonne_ajout'])) {
		$requete.="'".$_POST['abonne_ajout']."','".$_POST['campa']."')";
	}
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
	
}
?>