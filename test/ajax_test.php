<?php
include("../connexion/connex.inc.php");
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_facture_abonne")
	{
		$idcom=connex("SIA","myparam");
		$requete="select tf.campagne,ts.libelle as statut,abo.libelle as abo,mois.mois,tf.date_creation,tf.date_modif,tf.idexploitation,tf.idtfacturation,abo.tarif FROM tfacturation tf JOIN ttypeabonnement abo USINg (idtypeabonnement) JOIN treglementfacture tr USING (idtfacturation) JOIN tstatutfacture ts USING (idstatutfacture) JOIN tmois mois USING (idmois) WHERE  idexploitation='". $_POST['producteur']. "' ORDER BY campagne desc;";
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
	


// Liste des valeurs pour les statuts de factures
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_formation_dispo")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT idstatutfacture,libelle FROM tstatutfacture";
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
	// Liste des valeurs pour les statuts des abonnements
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_abonnement")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT idtypeabonnement,libelle FROM ttypeabonnement";
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
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_abonnement2")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT idtypeabonnement,libelle FROM ttypeabonnement where idregroupement='1' ORDER BY libelle";
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
	// Modification du changement de abonnement de la facture (Attention dans cartonet et facture)
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="modifier_abonnement")
{
	$idcom=connex("SIA","myparam");
	// MAJ table tcartonet pour le changement d'abonnement
	$requete="UPDATE tcartonet SET idtypeabonnement=";
	if(isset($_POST['idtfacturation']) && !empty ($_POST['idtfacturation'])) {
		$requete.="'".$_POST['idtypeabonnement']."' WHERE idexploitation='".$_POST['idexploitation']."'";
		echo "reussi";
	}
	$result=pg_query($idcom,$requete);	
	// MAJ table tfacturation pour le changment de abonnement
	$requete="UPDATE treglementfacture SET idtypeabonnement=";
	if(isset($_POST['idtfacturation']) && !empty ($_POST['idtfacturation'])) {
		$requete.="'".$_POST['idtypeabonnement']."' WHERE idtfacturation='".$_POST['idtfacturation']."'";
	}
	$requete="UPDATE tfacturation SET date_modif=now() WHERE idtfacturation='".$_POST['idtfacturation']."'";
	$result=pg_query($idcom,$requete);	
	$requete="UPDATE tfacturation SET idtypeabonnement='".$_POST['idtypeabonnement']."' WHERE idtfacturation='".$_POST['idtfacturation']."'";
	$result=pg_query($idcom,$requete);	
	// Inscription dans l'historique de l'abonné
	$requete="INSERT INTO thistoriqueabonne(idexploitation,commentaire,datemodification) VALUES (";
	$requete.="'".$_POST['idexploitation']."','Changement de formule en : ' || (SELECT libelle FROM ttypeabonnement WHERE idtypeabonnement='".$_POST['idtypeabonnement']."'),now())";
	$result=pg_query($idcom,$requete);
	pg_close($idcom);
}
// Modification du changement de statut de la facture
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="modifier_statut")
{
	$idcom=connex("SIA","myparam");
	$requete="UPDATE treglementfacture SET idstatutfacture=";
	if(isset($_POST['idtfacturation']) && !empty ($_POST['idtfacturation'])) {
		$requete.="'".$_POST['idstatut']."' WHERE idtfacturation='".$_POST['idtfacturation']."'";
	}
	$result=pg_query($idcom,$requete);	
	$requete="UPDATE tfacturation SET date_modif=now() WHERE idtfacturation='".$_POST['idtfacturation']."'";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
}
// Modification du mois de la facture
// Modification du changement de statut de la facture
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="modifier_mois")
{
	$idcom=connex("SIA","myparam");
	$requete="UPDATE tfacturation SET date_modif=now(),idmois=".$_POST['idmois']." WHERE idtfacturation='".$_POST['idtfacturation']."' RETURNING idexploitation";
		// On récupère le numéro
	$result=pg_query($idcom,$requete);	
		if($result!==false){
		$lire=pg_fetch_row($result);		
	}	
	pg_close($idcom);
	$idcom=connex("SIA","myparam");
	$requete="UPDATE tcartonet SET idmois=";
	$requete.="'".$_POST['idmois']."' WHERE idexploitation='".$lire[0]."'";
	$result=pg_query($idcom,$requete);
	pg_close($idcom);
}
// Liste des valeurs pour les statuts de factures
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_campagne")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT campagne FROM tfacturation GROUP BY campagne ORDER BY campagne desc";
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
// Export Excel
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="export_facture")
{	
$idcom=connex("SIA","myparam");
	//Requete SQL
$requete="select tf.idexploitation,abo.libelle FROM tfacturation tf JOIN ttypeabonnement abo USINg (idtypeabonnement) JOIN treglementfacture tr USING (idtfacturation) JOIN tstatutfacture ts USING (idstatutfacture) JOIN tmois mois USING (idmois) WHERE campagne='".$_POST['campagne']."'";
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
// Liste des valeurs pour les statuts de factures
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_statut")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT idstatutfacture,libelle FROM tstatutfacture where disponible=1";
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
// Liste des valeurs pour des mois
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_mois")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT idmois,mois FROM tmois JOIN tcartonet USING (idmois) where idtypeabonnement='".$_POST['idm']."' GROUP BY idmois,mois";
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
	
	// Liste des abonnement selon le traitements des factures
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="info_facture_statut")
	{
		$idcom=connex("SIA","myparam");
		$requete="select tf.idtfacturation,tc.raison_social,tt.libellecourt,m.mois FROM tmillesime tmi,tfacturation tf JOIN treglementfacture trf USING (idtfacturation) ";
		$requete.="JOIN tcartonet tc USING (idexploitation) JOIN tmois m ON m.idmois=tc.idmois JOIN ttypeabonnement tt ON tt.idtypeabonnement=tc.idtypeabonnement WHERE ";
		$requete.="tmi.courant='1' and tf.campagne=tmi.millesime AND tt.idregroupement='1' ";
	if(isset($_POST['idstatut']) && !empty ($_POST['idstatut'])) {
		$requete.="AND trf.idstatutfacture='".$_POST['idstatut']. "' ORDER BY tc.raison_social";
	}
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
		
			// Liste des abonnement selon le traitements des factures
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="info_facture_statut2")
	{
		$idcom=connex("SIA","myparam");
		$requete="select tf.idtfacturation,tc.raison_social,tt.libellecourt,m.mois FROM tmillesime tmi,tfacturation tf JOIN treglementfacture trf USING (idtfacturation) ";
		$requete.="JOIN tcartonet tc USING (idexploitation) JOIN tmois m ON m.idmois=tc.idmois JOIN ttypeabonnement tt ON tt.idtypeabonnement=tc.idtypeabonnement WHERE ";
		$requete.="tmi.courant='1' and tf.campagne=tmi.millesime AND tt.idregroupement='1' ";
	if(isset($_POST['idstatut']) && !empty ($_POST['idstatut'])) {
		$requete.="AND trf.idstatutfacture='".$_POST['idstatut']."' and tc.idtypeabonnement='".$_POST['idabo']."' aND tc.idmois='".$_POST['idmois']."' ORDER BY tc.raison_social";
	}
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
// Modification du changement de statut de la facture
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="test")
{
	$idcom=connex("SIA","myparam");
	$requete="UPDATE treglementfacture SET idstatutfacture=";
	if(isset($_POST['idep']) && !empty ($_POST['idep'])) {
		$requete.="".$_POST['idstatut']." WHERE idtfacturation='".$_POST['idep']."'";
	}
	echo $requete;
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
	
}

// Traitements pour les bilans
//
// Compte rendu
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="bilan_global")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT campagne,sum(s) as s,sum(n) as n";
		$requete.=" FROM ( SELECT tf.campagne,tt.libelle,count(idtfacturation) as s,count(idtfacturation)*tt.tarif as n FROM tcartonet tc JOIN ttypeabonnement tt ON tt.idtypeabonnement=tc.idtypeabonnement  ";
		$requete.=" JOIN tfacturation tf USING (idexploitation)  where tt.tarif<>0 and tc.idtypeabonnement<>'7'";
		$requete.=" GROUP BY tf.campagne,tt.libelle,tt.tarif) as bil GROUP BY campagne order by campagne desc";
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
	
	// Géolocalisation des communes
	
	// Liste des valeurs pour les statuts de factures
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="geocommuneloc")
	{
		$idcom=connex("SIA","myparam");
		$requete="select tc.nom_comm FROM  tcomzn tc ";
		$requete.="WHERE (st_transform(st_geomfromtext('POINT(".$_POST[x]." ".$_POST[y].")',4326),2154))&&tc.geometrie and ";
		$requete.="st_intersects((st_transform(st_geomfromtext('POINT(".$_POST[x]." ".$_POST[y].")',4326),2154)),(tc.geometrie))='t';";
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