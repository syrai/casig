<?php
include("../connexion/connex.inc.php");
// Recherche d'information d'un ilot
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="info_ilot")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT num_ilot,tc.nom";
		$requete.=",CASE WHEN forme_juridique_expl is null THEN 'Individuel' ELSE forme_juridique_expl END as forme_juri,surface_reference_ilot,id_expl,";
		$requete.=" CASE WHEN te.typesoc is not null and te.societe is not null THEN te.typesoc || ' ' || societe ELSE 'Non renseignée' END as exploitation ";
		$requete.="FROM info_ilot_ano i LEFT JOIN tentreprise te USING (idexploitation) ";
		$requete.="LEFT JOIN tcommunes tc ON tc.codeinsee=i.commune_ilot";
		$requete.=" where i.num_ilot like '%".$_POST['num_ilot']. "%' ORDER BY i.num_ilot";
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
	// Recherche d'exploitation
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="info_exploitation")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT idexploitation,typesoc || ' ' || societe || ', à ' || rue1 || ' ' || codepostal || ville as info";
		$requete.=" FROM tentreprise ";
		$requete.=" where societe like UPPER('%".$_POST['societe']. "%') ORDER BY societe";
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
// Mise à jour du rpg
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="renseigner_ilot")
{
	
	$idcom=connex("SIA","myparam");
	$requete="UPDATE  info_ilot_ano SET idexploitation='".$_POST['idexpl']."' WHERE id_expl=(SELECT id_expl FROM info_ilot_ano where num_ilot='".$_POST['numilot']. "')";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
}	
?>