<?php

// Connexion à la base de données
include("../connexion/connex_l9.inc.php");

$idcom=connex("SIA","myparam");
		
//Requete SQL
$requete="select tcy.id_cycle,tc.idexploitation,tc.raison_social as exploitation,ta.adresse as rue, ta.codepostal, ta.commune ,tc.log,tc.passe from tformation tf ";
$requete.="JOIN tcycle tcy USING (id_cycle) JOIN tcartonet tc ON tc.idexploitation=tf.idexploitation JOIN tadresseabonne ta ON ta.idexploitation=tf.idexploitation ";
$requete.="where tcy.id_cycle='".$_GET['idcycle']."'";
$result=pg_query($idcom,$requete);
 
// Entêtes des colones dans le fichier Excel
$excel .="Exploitation;rue;codepostal;commune\n";
 
//Les resultats de la requette
while($row = pg_fetch_array($result)) {
        $excel .= "$row[exploitation];$row[rue];$row[codepostal];$row[commune];$row[log];$row[passe]\n";
}
 
header("Content-type: application/vnd.ms-excel;");
header("Content-disposition: attachment; filename=Formation_".$_GET['idcycle'].".csv");

print $excel;

exit;
pg_close($idcom);


?>
