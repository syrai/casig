<?php
include("../connexion/connex.inc.php");

if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="afficher")
  {
	$idcom=connex("SIA","myparam");
	$requete="select libelle,count(idexploitation) as n ,tfacturation.idtypeabonnement FROM tfacturation JOIN ttypeabonnement tt USING (idtypeabonnement) WHERE campagne=2013 GROUP BY libelle,tfacturation.idtypeabonnement ORDER BY n desc";
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
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="afficher_total")
  {
	$idcom=connex("SIA","myparam");
	$requete="select count(idexploitation) as n FROM tfacturation JOIN ttypeabonnement tt USING (idtypeabonnement) WHERE tt.compte='1' AND campagne=2013 ";
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
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="afficher_detail")
  {
	$idcom=connex("SIA","myparam");
	$requete="select tc.raison_social  FROM tfacturation JOIN tcartonet tc USING (idexploitation) WHERE tfacturation.idtypeabonnement='".$_POST['idtypeabonnement']."' and campagne=2013 ";
	$requete.=" ORDER BY raison_social";
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