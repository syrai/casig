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
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="afficher_slider")
  {
	$idcom=connex("SIA","myparam");
	$requete="SELECT disponible,abosecondaire,passagemillesime,idtypepac,libelle,tarif,libellecourt FROM  ttypeabonnement tt  WHERE idtypeabonnement='".$_POST['idtypeabonnement']."'";
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
// Afficher les choix pac
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="afficher_liste_pac")
  {
	$idcom=connex("SIA","myparam");
	$requete="SELECT idtypepac,libelle FROM  ttypepac tt";
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
// Afficher les choix pac
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="cocher_pac")
  {
	$idcom=connex("SIA","myparam");
	$requete="SELECT idtypepac,idtypeabonnement FROM ttypeabonnement WHERE idtypeabonnement='".$_POST['idtypeabonnement']."'";
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
// Changer la dispo
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="changer_dispo")
  {
	$idcom=connex("SIA","myparam");
	$requete="UPDATE ttypeabonnement SET disponible='".$_POST['dispo']."' WHERE idtypeabonnement='".$_POST['idtypeabonnement']."'";
	$result=pg_query($idcom,$requete);
	
	pg_close($idcom);
	
}
//changer abonnement secondaire
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="changer_abo_sec")
  {
	$idcom=connex("SIA","myparam");
	$requete="UPDATE ttypeabonnement SET abosecondaire='".$_POST['dispo']."' WHERE idtypeabonnement='".$_POST['idtypeabonnement']."'";
	$result=pg_query($idcom,$requete);
	
	pg_close($idcom);
	
}
// Changer passage du millésime
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="changer_milles")
  {
	$idcom=connex("SIA","myparam");
	$requete="UPDATE ttypeabonnement SET passagemillesime='".$_POST['dispo']."' WHERE idtypeabonnement='".$_POST['idtypeabonnement']."'";
	$result=pg_query($idcom,$requete);
	
	pg_close($idcom);
	
}
// Changer type pac
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="changer_type_pac")
  {
	$idcom=connex("SIA","myparam");
	$requete="UPDATE ttypeabonnement SET idtypepac='".$_POST['dispo']."' WHERE idtypeabonnement='".$_POST['idtypeabonnement']."'";
	$result=pg_query($idcom,$requete);
	
	pg_close($idcom);
	
}
// Afficher les choix de millésime
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="afficher_liste_millesime")
  {
	$idcom=connex("SIA","myparam");
	$requete="SELECT id_millesime,millesime FROM  tmillesime where millesime is not null ORDER BY millesime desc limit 4";
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
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="cocher_millesime")
  {
	$idcom=connex("SIA","myparam");
	$requete="SELECT id_millesime,millesime FROM tmillesime WHERE courant='1'";
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
// Changer millésime courant
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="changer_millesime")
  {
	$idcom=connex("SIA","myparam");
	$requete="UPDATE tmillesime SET courant='1' WHERE id_millesime='".$_POST['idmillesime']."'";
	$result=pg_query($idcom,$requete);
		
	$requete="UPDATE tmillesime SET courant='0' WHERE id_millesime<>'".$_POST['idmillesime']."'";
	$result=pg_query($idcom,$requete);

	pg_close($idcom);
	
}
?>