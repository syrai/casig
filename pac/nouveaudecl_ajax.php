<?php

			include_once("../connexion/connex.inc.php");
						$idcom=connex("SIA","myparam");
						$ideca=$_POST['submit'];
						$requete="INSERT INTO pdeclarant(raison_sociale,idexploitation,adresse,idporiginedeclarant,millesime,idpstatutdeclarant) VALUES ((SELECT raison_social as raison_sociale from tcartonet where idexploitation='".$ideca."'),'".$ideca."',(SELECT (case WHEN adresse is null THEN ' ' ELSE UPPER(adresse) || ', ' end)   || codepostal || ' à ' || commune as adresse from tadresseabonne wHERE idexploitation='".$ideca."'),'1','2012','1')"; 
						$result=pg_query($idcom,$requete);
						pg_free_result($result);
						// Mise à jour de l'historique A rajouter en version 1.2
			header('Location: nouveaudecl.php');
?>