<?php
include("../connexion/connex.inc.php");
// Création d'une nouvelle formation
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_formation_dispo")
{
		
	$idcom=connex("SIA","myparam");
	$requete="SELECT id_cycle,nom FROM tcycle WHERE date > now() ORDER BY date desc";	
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
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_participant")
{
		
	$idcom=connex("SIA","myparam");
	$requete="select tcy.nom,tc.raison_social,tf.idexploitation FROM tformation tf JOIN tcartonet tc USING (idexploitation) JOIN tcycle tcy USING (id_cycle) WHERE tf.id_cycle='".$_POST['idcycle']."';";	
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
// Ajout d'un participant à une formation
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="ajouter_participant")
{
	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO tformation(idexploitation,id_cycle) VALUES (";
	if(isset($_POST['idexploitation']) && !empty ($_POST['idexploitation'])) {
		$requete.="'".$_POST['idexploitation']."','".$_POST['idcycle']."')";
	}
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
}
// Présence jour
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="affichage_presence_formation")
{
	$idcom=connex("SIA","myparam");
	$requete="SELECT presence1,repas1,presence2,repas2 FROM tformation WHERE idexploitation='".$_POST['idexploitation']."' AND id_cycle='".$_POST['idcycle']."'";
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
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="affichage_presence_formation")
{
	// On efface de la table des formations
	$idcom=connex("SIA","myparam");
	$requete="DELETE FROM tformation where idexploitation='". $_POST['idexploitation']."' and id_cycle='". $_POST['idcycle']."'";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
}
?>