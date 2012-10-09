
<?php

// Connexion à la base de données
include("../connexion/connex_l9.inc.php");

$idcom=connex("SIA","myparam");
		
//Requete SQL

$requete="(select 'Abonnement' as typeabonnement,tc.raison_social as exploitation,tc.nom as nom,ta.commune,m.mois,CASE WHEN tpa.avoir is null THEN abo.libelle ELSE abo.libelle || ' (Parrainage ,' || tpa.exploitation_par || ')' end as libelle, ";
$requete.="CASE WHEN tpa.avoir is null THEN abo.tarif ELSE sum(tpa.avoir)+abo.tarif end as tarif,abo.codecompta,ts.libelle as etat  ";
$requete.="FROM tfacturation tf  JOIN ttypeabonnement abo USINg (idtypeabonnement)";
$requete.=" JOIN treglementfacture tr USING (idtfacturation) JOIN tstatutfacture ts USING (idstatutfacture) JOIN tmois mois USING (idmois) JOIN tcartonet tc USING (idexploitation) ";
$requete.="LEFT JOIN tparrainage tpa ON tpa.idtfacturation=tf.idtfacturation JOIN tmois m on m.idmois=tc.idmois ";
$requete.="JOIN tadresseabonne ta ON ta.idexploitation=tc.idexploitation  WHERE  campagne='2013' AND idregroupement='1' ";
$requete.=" GROUP BY tc.raison_social,tc.nom,ta.commune,m.mois,tpa.avoir,abo.libelle,abo.tarif,abo.codecompta,ts.libelle ,tpa.exploitation_par )";
$requete.=" UNION (";
$requete.="select 'Abonnement secondaire' as typeabonnement,tc.raison_social as exploitation,tc.nom as nom,ta.commune,m.mois, abo.libelle || ' (' || tf.exploitation || ')'  as libelle, ";
$requete.="abo.tarif as tarif,abo.codecompta,'-' as etat  FROM tfacturationsecondaire tf ";
$requete.="JOIN ttypeabonnement abo USINg (idtypeabonnement) JOIN tcartonet tc USING (idexploitation) JOIN tmois m on m.idmois=tc.idmois ";
$requete.="JOIN tadresseabonne ta ON ta.idexploitation=tc.idexploitation  WHERE  campagne='2013' and abo.tarif>0 ";
$requete.="GROUP BY tc.raison_social,tc.nom,ta.commune,m.mois,abo.libelle,abo.tarif,abo.codecompta,tf.exploitation) ";
$requete.=" UNION  (";
$requete.="select 'Options ou offres' as typeabonnement,tc.raison_social as exploitation,tc.nom as nom,ta.commune,tf.millesime::text as campagne";
$requete.=", abo.valorisation as libelle,abo.tarif as tarif,'-' as codecompta,'-' as etat ";
$requete.=" FROM tvalorisation tf  JOIN ttypevalorisation abo USINg (idtypevalorisation) JOIN tcartonet tc USING (idexploitation) JOIN tadresseabonne ta ON ta.idexploitation=tc.idexploitation ";
$requete.="WHERE  millesime='2013' and abo.type IN ('OFFRE','OPTIONS')  GROUP BY tc.raison_social,tc.nom,ta.commune,tf.millesime,abo.valorisation,abo.tarif  ) ORDER BY exploitation";

$result=pg_query($idcom,$requete);
 
// Entêtes des colones dans le fichier Excel
$excel ="Type;Exploitation;Nom;Commune;Mois;Abonnement;Tarif;codecompta;etat\n";
 
//Les resultats de la requette
while($row = pg_fetch_array($result)) {
        $excel .= "$row[typeabonnement];$row[exploitation];$row[nom];$row[commune];$row[mois];$row[libelle];$row[tarif];$row[codecompta];$row[etat]\n";
}
 
header("Content-type: application/vnd.ms-excel;");
header("Content-disposition: attachment; filename=Facturation_".$_GET['campagne'].".csv");

print $excel;

exit;
pg_close($idcom);


?>
