<?php
			
    include_once("../connexion/connex.inc.php");
					$idcom=connex("SIA","myparam");					
					$idpac_array=$_POST['favorite'];
					$idd=$_POST['ide'];
					// Pour rendre indisponible
						foreach ($idpac_array as $one_element)
					{
						if ($trame==null){
							$trame="".$one_element."" ;
						}
						else
						{
						$trame="".$trame. ",".$one_element."" ;	
						}
					}
					$requete4="UPDATE pdispohoraire SET disponible=0 where iddisphor IN (select iddisphor from pdispohoraire pdis  where iddispo='".$_POST['ide']."' and iddisphor  IN (".$trame."))";
					$query=pg_query($idcom,$requete4);
					pg_free_result($query);
// Pour rendre disponible
					$requete4="UPDATE pdispohoraire SET disponible=1 where iddisphor IN (select iddisphor from pdispohoraire pdis  where iddispo='".$_POST['ide']."' and iddisphor  NOT IN (".$trame."))";
					$query=pg_query($idcom,$requete4);
					pg_free_result($query);
					header('Location: gestion_horaire.php');
?>