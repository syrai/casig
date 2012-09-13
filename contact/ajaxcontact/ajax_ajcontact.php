<?php
include("../connexion/connex.inc.php");

if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="ajouter_contact")
{
	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO tcontact(raisonsociale,tel,mail,codeinsee,idtypecontact) VALUES (";
	if(isset($_POST['raisonsocial']) && !empty ($_POST['raisonsocial'])) {
		$requete.="'".$_POST['producteur']."','".$_POST['producteur']."','".$_POST['producteur']."','".$_POST['producteur']."','".$_POST['producteur'].")";
	}
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
}
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="lancer_recherche_contact")
{
	$idcom=connex("SIA","myparam");
	$requete="SELECT raisonsociale,tel,mail,tc.nom as commune,tct.libelle from tcontact JOIN tcommunes tc USING (codeinsee) JOIN ttypecontact tct USING (idtypecontact) where ";
	if(isset($_POST['producteur']) && !empty ($_POST['producteur'])) {
		$requete.=" raisonsociale like '%".$_POST['producteur']. "%'";
	}
	$result=pg_query($idcom,$requete);
	if(pg_num_rows($result)>0){
		$myarray = array();
		while ($row = pg_fetch_row($result)) {
  				$myarray[] = $row;
			}
			echo json_encode($myarray);
	}
	pg_close($idcom);
}
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="info_producteur")
	{
		$idcom=connex("SIA","myparam");
	
		$requete="select idexploitation, nom, raison_social, adresse || ' ' || codepostal || ' à ' || commune as adresse,ttypeabonnement.libelle from tcartonet JOIN tadresseabonne USING (idexploitation)   JOIN ttypeabonnement USING (idtypeabonnement) where idexploitation='". $_POST['producteur']. "'";

		$result=pg_query($idcom,$requete);
		if(pg_num_rows($result)>0) {
			$myarray = array();
			while ($row = pg_fetch_row($result)) {
  				$myarray[] = $row;
			}
			echo json_encode($myarray);
		}
	
		pg_close($cnx);
	}
?>