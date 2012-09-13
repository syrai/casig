<?php
	include_once("connex.inc.php");
						$idcom=connex("SIA","myparam");
						$ideca=$_POST['login'];
						$tt=$_POST['password'];
						$requete="SELECT pass FROM tconseiller WHERE nom='".$ideca."'";
						$result=pg_fetch_array($idcom,$requete);
						if ($tt=$result['pass'])
						{
							header('Location: index.html');
						}
						ELSE
						{
							Echo "erreur";
						}
						pg_free_result($result);		

?>