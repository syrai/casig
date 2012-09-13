<?php
include("../connexion/connex.inc.php");
// Ajouter un nouveau contact
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="ajouter_contact")
{
	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO tcontact(raisonsociale,tel,mail,codeinsee,idtypecontact,personne,rue1) VALUES (";
	if(isset($_POST['raisonsocial']) && !empty ($_POST['raisonsocial'])) {
		$requete.="'".$_POST['raisonsocial']."','".$_POST['tel']."','".$_POST['mailto']."','".$_POST['codeinsee']."','".$_POST['idtypecontact']."','".$_POST['nom']."','".$_POST['adresse']."')";
	}
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
}
// Suppression d'un contact
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="supprimer_contact")
{
	// On efface de la table des contact
	$idcom=connex("SIA","myparam");
	$requete="DELETE FROM tcontact where idcontact='". $_POST['producteur']. "'";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
	// On efface de l historique des suivi
	$idcom=connex("SIA","myparam");
	$requete="DELETE FROM tcontactsuivi where idcontact='". $_POST['producteur']. "'";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
}
// Pour remplir la fiche d'un contact avec l'idcontact
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="info_contact")
	{
		$idcom=connex("SIA","myparam");
	
		$requete="select idcontact,  raisonsociale,tel,mail,tc.nom as commune,tt.libelle as typecontact,personne,rue1 || ' ' || tc.codepostal || ' à ' || tc.nom as adresse FROM tcontact JOIN tcommunes tc USING (codeinsee) JOIN ttypecontact tt USING (idtypecontact)  where idcontact='". $_POST['producteur']. "'";

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
// Ajouter un suivi pour un contact
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="ajout_suivi")
	{
		$idcom=connex("SIA","myparam");
	
		$requete="INSERT INTO tcontactsuivi(idcontact,datesuivi,suivi) VALUES (";
	if(isset($_POST['suivi']) && !empty ($_POST['suivi'])) {
		$requete.="'".$_POST['producteur']."',CURRENT_TIMESTAMP,'".$_POST['suivi']."')";
	}
	$result=pg_query($idcom,$requete);
		pg_close($idcom);
	}
// Pour consulter l'ensemble des contacts
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="cons_suivi")
	{
		$idcom=connex("SIA","myparam");
	
		$requete="select date_trunc('second',datesuivi) as datesuivi,suivi FROM tcontactsuivi where idcontact='". $_POST['producteur']. "' ORDER BY datesuivi desc";

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
	// Création du nouvel abonné
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="ajouter_abonne")
{
	$idcom=connex("SIA","myparam");
	// Etape 1 : Insertion dans la table tcartonet pour création de l'abonne
	$requete="INSERT INTO tcartonet(idexploitation,nom,raison_social,idtypeabonnement,idmois) VALUES (";
	if(isset($_POST['abo']) && !empty ($_POST['abo'])) {
		$requete.="(SELECT (idcontact + 200000) as idexploitation FROM tcontact where idcontact='".$_POST['abo']."'),(SELECT personne FROM tcontact WHERE idcontact='".$_POST['abo']."'),(SELECT raisonsociale FROM tcontact WHERE idcontact='".$_POST['abo']."'),'".$_POST['idtypeabonnement']."','".$_POST['idmois']."') RETURNING idexploitation";
	}
	// On récupère le numéro
	$result=pg_query($idcom,$requete);	
		if($result!==false){
		$lire=pg_fetch_row($result);
		
	}
	$ide=$lire[0];	
	pg_close($idcom);
	// On rentre l'adresse
	$idcom=connex("SIA","myparam");
	// Insertion de l'adresse
	$requete="INSERT INTO tadresseabonne (idexploitation,adresse,codepostal,commune,codeinsee,geom ) VALUES (";
	if(isset($_POST['abo']) && !empty ($_POST['abo'])) {
		$requete.="'".$ide."',(SELECT rue1 as adresse FROM tcontact WHERE idcontact='".$_POST['abo']."')";
		$requete.=",(SELECT codepostal FROM tcommunes WHERE codeinsee=(SELECT codeinsee FROM tcontact where idcontact='".$_POST['abo']."'))";
		$requete.=",(SELECT nom FROM tcommunes WHERE codeinsee=(SELECT codeinsee FROM tcontact where idcontact='".$_POST['abo']."'))";
		$requete.=",(SELECT codeinsee FROM tcontact WHERE idcontact='".$_POST['abo']."')";
		$requete.=",(SELECT geom FROM tcommunes WHERE codeinsee=(SELECT codeinsee FROM tcontact where idcontact='".$_POST['abo']."')))";
	}
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
	// Insertion dans l'historique de l'abonné
	// Table thistoabonnement avec comme statut ancien = Contact(25)
	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO thistoabonnement(idexploitation,ancienstatut,nouveaustatut,datemodification,commentaire) VALUES (";
	if(isset($_POST['abo']) && !empty ($_POST['abo'])) {
		$requete.="'".$ide."','25','".$_POST['idtypeabonnement']."',now(),'Création depuis la fiche contact')";
	}
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
	// Création de la facture pour le millésime choisit
	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO tfacturation(idexploitation,campagne,date_modif,date_creation,idmois,idtypeabonnement) VALUES (";
	$requete.="'".$ide."','".$_POST['camp']."',now(),now(),'".$_POST['idmois']."','".$_POST['idtypeabonnement']."') RETURNING idtfacturation";
	// On récupère le numéro
	$result=pg_query($idcom,$requete);	
		if($result!==false){
		$lire2=pg_fetch_row($result);		
	}
	$ide2=$lire2[0];
	// Création de l'historique
	$idcom=connex("SIA","myparam");
	$requete="INSERT INTO treglementfacture(idtfacturation,idstatutfacture) VALUES (";
	$requete.="'".$ide2."',1)";
	$result=pg_query($idcom,$requete);	
	pg_close($idcom);
}
?>