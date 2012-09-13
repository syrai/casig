<?php
include("../connexion/connex.inc.php");

if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="lancer_recherche")
{
	$idcom=connex("SIA","myparam");
	$requete="select idexploitation, nom, raison_social, adresse || ' ' || codepostal || ' à ' || commune as adresse,ttypeabonnement.libelle from tcartonet JOIN tadresseabonne USING (idexploitation)   JOIN ttypeabonnement USING (idtypeabonnement) where  ";
	if(isset($_POST['producteur']) && !empty ($_POST['producteur'])) {
		$requete.=" raison_social like '%".$_POST['producteur']. "%'";
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
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="lancer_recherche2")
{
	$idcom=connex("SIA","myparam");
	$requete="select idexploitation, nom, raison_social, adresse || ' ' || codepostal || ' à ' || commune as adresse,ttypeabonnement.libelle from tcartonet JOIN tadresseabonne USING (idexploitation)   JOIN ttypeabonnement USING (idtypeabonnement) where  ";
	if(isset($_POST['producteur']) && !empty ($_POST['producteur'])) {
		$requete.=" idexploitation='".$_POST['producteur']. "'";
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