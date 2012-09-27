<?php
include("../connexion/connex.inc.php");
echo "include("../connexion/connex.inc.php");";
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="afficher")
  {
	$idcom=connex("SIA","myparam");
	echo $idcom;
	$requete="select libelle,count(idexploitation) as n FROM tfacturation JOIN ttypeabonnement tt USING (idtypeabonnement) WHERE campagne=2013 GROUP BY libelle ORDER BY n desc";
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