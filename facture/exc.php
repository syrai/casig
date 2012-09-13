
<?php

// Connexion à la base de données
include("../connexion/connex_l9.inc.php");

$idcom=connex("SIA","myparam");
		
//Requete SQL
$requete="select tc.raison_social as exploitation,tc.nom as nom,ta.commune,m.mois,CASE WHEN tpa.avoir is null THEN abo.libelle ELSE abo.libelle || ' (P)' end as libelle,CASE WHEN tpa.avoir is null THEN abo.tarif ELSE sum(tpa.avoir)+abo.tarif end as tarif,abo.codecompta,ts.libelle as etat ";
$requete.=" FROM tfacturation tf JOIN ttypeabonnement abo USINg (idtypeabonnement";
$requete.=") JOIN treglementfacture tr USING (idtfacturation) JOIN tstatutfacture ts USING (idstatutfacture) JOIN tmois mois USING (idmois) JOIN tcartonet tc USING (idexploitation)";
$requete.=" LEFT JOIN tparrainage tpa ON tpa.idtfacturation=tf.idtfacturation ";
$requete.=" JOIN tmois m on m.idmois=tc.idmois JOIN tadresseabonne ta ON ta.idexploitation=tc.idexploitation  WHERE  campagne='".$_GET['campagne']."' AND idregroupement='1' ";
$requete.=" GROUP BY tc.raison_social,tc.nom,ta.commune,m.mois,tpa.avoir,abo.libelle,abo.tarif,abo.codecompta,ts.libelle ";
$requete.=" ORDER BY abo.libelle,m.mois,tc.raison_social";
$result=pg_query($idcom,$requete);
 
// Entêtes des colones dans le fichier Excel
$excel ="Exploitation;Nom;Commune;Mois;Abonnement;Tarif;codecompta;etat\n";
 
//Les resultats de la requette
while($row = pg_fetch_array($result)) {
        $excel .= "$row[exploitation];$row[nom];$row[commune];$row[mois];$row[libelle];$row[tarif];$row[codecompta];$row[etat]\n";
}
 
header("Content-type: application/vnd.ms-excel;");
header("Content-disposition: attachment; filename=Facturation_".$_GET['campagne'].".csv");

print $excel;

exit;
pg_close($idcom);


?>
