<?php
include("../connexion/connex.inc.php");
// Recherche des types d'abonnement pour l'affichage dans la liste dans la page gest_param
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="afficher_liste_abo")
  {
	$idcom=connex("SIA","myparam");
	$requete="select libelle || ', ' || tarif  as n ,idtypeabonnement FROM  ttypeabonnement tt  ORDER BY libelle desc";
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
// Info sur la disponiblilte
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="afficher_liste_abo")
  {
	$idcom=connex("SIA","myparam");
	$requete="SELECT disponible FROM  ttypeabonnement tt  WHERE idtypeabonnement='".$_POST['idtypeabonnement']."'";
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
?>