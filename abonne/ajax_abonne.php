<?php
//Include de connexion
include("../connexion/connex.inc.php");

if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="info_abonne")
	{
		$idcom=connex("SIA","myparam");
		$requete="select tc.idexploitation,tc.raison_social,tc.nom,ta.tel,ta.mailto,ta.adresse || ' ' || ta.codepostal || ' ' || ta.commune as adresse  FROM tcartonet tc JOIN tadresseabonne ta USING (idexploitation)  where idexploitation='". $_POST['producteur']. "'";
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
	// Infor sur l'abonnement
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="info_abonnement_1")
	{
		$idcom=connex("SIA","myparam");
		$requete="select tt.libelle,mois,tsf.libelle as statut,tt.tarif FROM tmillesime tmi,tcartonet tc JOIN ttypeabonnement tt USING (idtypeabonnement) JOIN tmois USING (idmois) JOIN tfacturation tf ON (tf.idexploitation=tc.idexploitation ) JOIN treglementfacture tr USING (idtfacturation) JOIN tstatutfacture tsf USINg (idstatutfacture) WHERE tc.idexploitation='". $_POST['producteur']. "' and tmi.courant=1 AND tf.campagne=tmi.millesime;";
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
	//
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="abonne_historique")
	{
		$idcom=connex("SIA","myparam");
	
		$requete="select th.idhistoabonnement,th.datemodification || a.libelle   as  historique FROM thistoabonnement th JOIN ttypeabonnement a ON CAST(th.ancienstatut as integer)=a.idtypeabonnement JOIN ttypeabonnement b ON CAST(th.nouveaustatut as integer)=b.idtypeabonnement WHERE  th.idexploitation='". $_POST['producteur']. "' ORDER BY th.datemodification desc";

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
	
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="suivi_historique")
	{
		$idcom=connex("SIA","myparam");
	
		$requete="select th.datemodification,th.commentaire FROM thistoriqueabonne th  WHERE  th.idexploitation='". $_POST['producteur']. "' ORDER BY th.datemodification desc";

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
	
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="affichage_abo_sec")
	{
		$idcom=connex("SIA","myparam");
	
		$requete="SELECT idtypeabonnement,libelle FROM ttypeabonnement where abosecondaire='1'";

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
	
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="ajouter_abo_sec")
{
		
	$idcom=connex("SIA","myparam");
	
	$requete="INSERT INTO tfacturationsecondaire(exploitation,idexploitation,idtypeabonnement,idmois,campagne,datecreation,datemodification) VALUES ('".$_POST['nomexploit']."','".$_POST['idexploitation']."','".$_POST['typeabo']."',(SELECT idmois from tcartonet WHERE idexploitation='".$_POST['idexploitation']."'),(SELECT millesime as campagne FROM tmillesime where courant='1'),now(),now()) RETURNING idtfacturation";
	$result=pg_query($idcom,$requete);
	if($result!==false){
		$lire=pg_fetch_row($result);
		echo "id=",$lire[0];
	}
	$requete="INSERT INTO treglementfacturesec(idtfacturation,idstatutfacture)  VALUES ('".$lire[0]."','1')";
	$result=pg_query($idcom,$requete);
	
	pg_close($idcom);
}
// Info abonnement secondaire
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="info_abonnement_sec")
	{
		$idcom=connex("SIA","myparam");
	
		$requete="SELECT tf.exploitation,tt.libelle as abo,tmois.mois,ts.libelle as statut,tt.tarif,tf.datecreation,tf.datemodification ";
		$requete.="FROM tmillesime tmi ,tcartonet tc JOIN tfacturationsecondaire tf USING (idexploitation) JOIN treglementfacturesec tr USING (idtfacturation)";
		$requete.="JOIN tstatutfacture ts USING (idstatutfacture) JOIN ttypeabonnement tt ON tt.idtypeabonnement=tf.idtypeabonnement JOIN tmois ON tmois.idmois=tf.idmois";
		if(isset($_POST['idexploitation']) && !empty ($_POST['idexploitation'])) {
		$requete.=" WHERE tc.idexploitation='".$_POST['idexploitation']."' AND tmi.courant=1 and tf.campagne=tmi.millesime";
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
	// Ajout d'une note
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="ajouter_une_note")
{
	$idcom=connex("SIA","myparam");
		// Inscription dans l'historique de l'abonné
		
	$requete="INSERT INTO thistoriqueabonne(idexploitation,commentaire,datemodification) VALUES (";
	if(isset($_POST['idexploitation']) && !empty ($_POST['idexploitation'])) {
	$requete.="'".$_POST['idexploitation']."','".$_POST['commentaire']."',now())";
	}
	$result=pg_query($idcom,$requete);
	pg_close($idcom);
}
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_abonnement")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT idtypeabonnement,libelle FROM ttypeabonnement ";
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
	
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_abonne")
	{
		$idcom=connex("SIA","myparam");
		$requete="select  idexploitation,raison_social || ' ' || tt.libelle as rdv  from tcartonet JOIN ttypeabonnement tt USING (idtypeabonnement) ";
		if($_POST['idtypeabonnement']!=0){
			$requete.=" WHERE tcartonet.idtypeabonnement='".$_POST['idtypeabonnement']."' ORDER BY raison_social ";
		} ELSE {
			$requete.="  ORDER BY raison_social ";
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
		// Modification des informations d'un abonne
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="modifier_abonne")
{
	$idcom=connex("SIA","myparam");
		// Modification de la raison sociale et du nom dans tcartonet
		
	if(isset($_POST['idexploitation']) && !empty ($_POST['idexploitation'])) {
	$requete="UPDATE tcartonet SET raison_social='".$_POST['raisonsocial']."',nom='".$_POST['nom']."'";
	$requete.=" WHERE idexploitation='".$_POST['idexploitation']."'";
	}
	$result=pg_query($idcom,$requete);
	pg_close($idcom);
		// Modification des information adresse dans tadressabonne
		
	if(isset($_POST['idexploitation']) && !empty ($_POST['idexploitation'])) {
	$requete="UPDATE tadresseabonne SET tel='".$_POST['tel']."',mailto='".$_POST['mailto']."'";
	$requete.=" WHERE idexploitation='".$_POST['idexploitation']."'";
	}
	
	$result=pg_query($idcom,$requete);
	pg_close($idcom);
	echo $requete;
}

// Ajouter une valorisation 
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="enregistrer_valorisation")
{
	$idcom=connex("SIA","myparam");
	// ajout de la valorisation
	$requete="INSERT INTO tvalorisation(idexploitation,millesime,date,idtypevalorisation) VALUES (";
	if(isset($_POST['idexploitation']) && !empty ($_POST['idexploitation'])) {
	$requete.="'".$_POST['idexploitation']."',EXTRACT (YEAR FROM now()),now(),'".$_POST['idtypevalorisation']."')";
	}
	
	$result=pg_query($idcom,$requete);
	
		// Inscription dans l'historique de l'abonné		
	$requete="INSERT INTO thistoriqueabonne(idexploitation,commentaire,datemodification) VALUES (";
	if(isset($_POST['idexploitation']) && !empty ($_POST['idexploitation'])) {
	$requete.="'".$_POST['idexploitation']."','Valorisation ajouter : ' || (SELECT type FROM ttypevalorisation WHERE idtypevalorisation='".$_POST['idexploitation']."'),now())";
	}
	$result=pg_query($idcom,$requete);
	pg_close($idcom);
}
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_valor")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT idtypevalorisation,valorisation FROM ttypevalorisation";
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
	
	// Info valorisation
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="info_valorisation")
	{
		$idcom=connex("SIA","myparam");
	
		$requete="SELECT ttv.type,ttv.valorisation as nom,tv.millesime,tv.date ";
		$requete.="FROM tvalorisation tv JOIN ttypevalorisation ttv USING (idtypevalorisation)";
		if(isset($_POST['idexploitation']) && !empty ($_POST['idexploitation'])) {
		$requete.=" WHERE tv.idexploitation='".$_POST['idexploitation']."' ORDER BY tv.date desc";
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
	
	// Ajout des campagnes avec factures
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="liste_campagne_avec_facture")
	{
		$idcom=connex("SIA","myparam");
		$requete="SELECT idtfacturation,campagne FROM tfacturation WHERE idexploitation='".$_POST['abonne']."' ORDER BY campagne desc";
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
	// Suppresion totale  d'un eabonne
	if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="suppression_abonne")
	{
		$idcom=connex("SIA","myparam");
		$requete="delete FROM tcartonet WHERE idexploitation='".$_POST['abonne_supp']."'";
		$result=pg_query($idcom,$requete);
		pg_close($idcom);
		// reglement  Facture
		$idcom=connex("SIA","myparam");
		$requete="delete FROM treglementfacture WHERE idtfacturation IN (SELECT idtfacturation FROM tfacturation WHERE idexploitation='".$_POST['abonne_supp']."')";
		$result=pg_query($idcom,$requete);
		pg_close($idcom);
			// reglement  Facture secondaire
		$idcom=connex("SIA","myparam");
		$requete="delete FROM treglementfacturesec WHERE idtfacturation IN (SELECT idtfacturation FROM tfacturationsecondaire WHERE idexploitation='".$_POST['abonne_supp']."')";
		$result=pg_query($idcom,$requete);
		pg_close($idcom);
		// Facture
		$idcom=connex("SIA","myparam");
		$requete="delete FROM tfacturation WHERE idexploitation='".$_POST['abonne_supp']."'";
		$result=pg_query($idcom,$requete);
		pg_close($idcom);
		// Facture secondaire
		$idcom=connex("SIA","myparam");
		$requete="delete FROM tfacturationsecondaire WHERE idexploitation='".$_POST['abonne_supp']."'";
		$result=pg_query($idcom,$requete);
		pg_close($idcom);
		// Valorisation
		$idcom=connex("SIA","myparam");
		$requete="delete FROM tvalorisation WHERE idexploitation='".$_POST['abonne_supp']."'";
		$result=pg_query($idcom,$requete);
		pg_close($idcom);
			// adresse
		$idcom=connex("SIA","myparam");
		$requete="delete FROM tadresseabonne WHERE idexploitation='".$_POST['abonne_supp']."'";
		$result=pg_query($idcom,$requete);
		pg_close($idcom);
		// tformatpn
		$idcom=connex("SIA","myparam");
		$requete="delete FROM tformation WHERE idexploitation='".$_POST['abonne_supp']."'";
		$result=pg_query($idcom,$requete);
		pg_close($idcom);
			// tformatpn
		$idcom=connex("SIA","myparam");
		$requete="delete FROM thistofacture WHERE thistoriqueabonne='".$_POST['abonne_supp']."'";
		$result=pg_query($idcom,$requete);
		pg_close($idcom);
			// tformatpn
		$idcom=connex("SIA","myparam");
		$requete="delete FROM thistoabonnement WHERE thistoriqueabonne='".$_POST['abonne_supp']."'";
		$result=pg_query($idcom,$requete);
		pg_close($idcom);
	}
		// Création du nouvel abonné
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="ajouter_fact_abonne")
{
	
	// Insertion dans l'historique de l'abonné
	// Table thistoabonnement avec comme statut ancien = Contact(25)
	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO thistoabonnement(idexploitation,ancienstatut,nouveaustatut,datemodification,commentaire) VALUES (";
	if(isset($_POST['abonne_ajout']) && !empty ($_POST['abonne_ajout'])) {
		$requete.="('".$_POST['abonne_ajout']."','3','3',now(),'Création depuis la fiche ajout facture')";
	}
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
	// Création de la facture pour le millésime choisit
	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO tfacturation(idexploitation,campagne,date_modif,date_creation,idmois,idtypeabonnement) VALUES (";
	$requete.="'".$_POST['abonne_ajout']."','".$_POST['campa']."',now(),now(),'9','3') RETURNING idtfacturation";
	// On récupère le numéro
	$result=pg_query($idcom,$requete);	
		if($result!==false){
		$lire2=pg_fetch_row($result);		
	}
	pg_close($idcom);
	// Création de l'historique
	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO treglementfacture(idtfacturation,idstatutfacture) VALUES (";
	$requete.="'".$lire2[0]."',1)";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
}
// Ajout d'un parrainage
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="ajouter_par_abonne")
{
	
	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO tparrainage(idexploitation,idtfacturation,exploitation_par) VALUES ";
	if(isset($_POST['abonne_ajout']) && !empty ($_POST['abonne_ajout'])) {
		if(isset($_POST['campa']) && !empty ($_POST['campa'])) {
	$requete.="('".$_POST['abonne_ajout']."','".$_POST['idfacture']."','".$_POST['campa']."')";	
	}
	}
	
	
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
	
}
?>