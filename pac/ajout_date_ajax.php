<?php

			include_once("../connexion/connex.inc.php");
						$idcom=connex("SIA","myparam");
						$ideca=$_POST[iddspor];
						$date=$_POST[mydate];
						$requete="INSERT INTO pdispoconseiller(id,date_dispo,lieu) VALUES ('".$ideca."','".$date."','LAXOU');";
						$result=pg_query($idcom,$requete);
						pg_free_result($result);
						// Recherche de l'iddispo
						$requete="SELECT iddispo FROM pdispoconseiller WHERE id='".$ideca."' and date_dispo='".$date."';";
						$result=pg_query($idcom,$requete);
						$idd = pg_fetch_array($result);
						pg_free_result($result);
						
						
						$requete="INSERT INTO pdispohoraire(iddispo,idhoraire) VALUES ('".$idd['iddispo']."','1')";
						$result=pg_query($idcom,$requete);
						pg_free_result($result);
						$requete="INSERT INTO pdispohoraire(iddispo,idhoraire) VALUES ('".$idd['iddispo']."','2')";
						$result=pg_query($idcom,$requete);
						pg_free_result($result);
						$requete="INSERT INTO pdispohoraire(iddispo,idhoraire) VALUES ('".$idd['iddispo']."','3')";
						$result=pg_query($idcom,$requete);
						pg_free_result($result);
						$requete="INSERT INTO pdispohoraire(iddispo,idhoraire) VALUES ('".$idd['iddispo']."','4')";
						$result=pg_query($idcom,$requete);
						pg_free_result($result);
?>