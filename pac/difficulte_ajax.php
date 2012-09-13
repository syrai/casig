<?php
					include_once("../connexion/connex.inc.php");
					$idcom=connex("SIA","myparam");					
					$ideca=$_POST['ide'];
					// On efface la table
					$requete4 = "DELETE FROM pdifficulterdv WHERE idpdeclarant='".$ideca."'";
					$query=pg_query($idcom,$requete4);
					$idpac_array = $_POST['idniv'];
					
						$requete5="INSERT INTO pdifficulterdv (idpdeclarant,idexploitation,idniveau) VALUES ('".$ideca."',(SELECT idexploitation FROM pdeclarant WHERE idpdeclarant='".$ideca."'),'".$idpac_array."');";
						$query2=pg_query($idcom,$requete5);
						pg_free_result($query2);
				
					pg_free_result($query);
					
			// Redirection du visiteur vers la page du minichat
                   			header('Location: nouveaudecl.php');
?>