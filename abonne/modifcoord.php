
<?php
session_start();	

?>
<?php
   include_once("../connexion/connex.inc.php");
					$idcom=connex("SIA","myparam");	
					$raison=$_POST['rl'];
					$personne=$_POST['personne'];
					$adresse=$_POST['adresse'];
					$cpo=$_POST['cp'];
					$commune=$_POST['com'];
					$idd=$_POST['submit'];
					$_SESSION['idexploitation']=$idd;
					$requete4="UPDATE tadresseabonne SET adresse=UPPER('".$adresse."'), codepostal='".$cpo."',commune='".$commune."' WHERE idexploitation='".$idd."';";
				$query=pg_query($idcom,$requete4);
				pg_free_result($query);
				$requete4="UPDATE tcartonet SET raison_social='".$raison."', nom='".$personne."' WHERE idexploitation='".$idd."';";
				$query=pg_query($idcom,$requete4);
				pg_free_result($query);
// Pour rendre disponible
$chemin = "http://sd-22074.dedibox.fr/casig/gamp/abonne/ficheabonne.php?idexploitation=".$idd; 

header("Location: $chemin"); 
?>