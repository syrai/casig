<?php
session_start();	
?>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>PAC</title> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js""></script>

</head> 
<body> 


		
	<div data-role="page">
		<div data-role="header" data-theme="e">
			<h1><?php
include_once("../connexion/connex.inc.php");
if ($_GET['idexploitation'])
	{
		$idpdeclarant=$_GET['idexploitation'];
	}
		ELSE
		{
		$idpdeclarant=$_SESSION['idpdec'];	
		}
	include_once("../connexion/connex.inc.php");
	$requete="select pd.raison_sociale || ' avec ' || tc.nom as n FROM pplanning JOIN pdeclarant pd USING (idpdeclarant) JOIN tconseiller tc USING (id) WHERE pplanning.millesime='2012' and pplanning.idpdeclarant='".$idpdeclarant."';";
	$result=pg_query($idcom,$requete);
	$ligne=pg_fetch_array($result);
	echo "".$ligne['n']."";
	pg_free_result($result);
;?></h1>
						
			<a href="/casig/portail_base/demo_ajax.php" data-role="button" data-icon="back" data-iconpos="notext">Retoure</a>
			</div><!-- /header -->
		<form action="difficulte_ajax.php" method="post">
		<div data-role="fieldcontain">
		<input type="hidden" name="ide" value="<?php echo "".$_SESSION['idpdec']."";?>"/>
	
		<fieldset data-role="controlgroup">
		
			<legend>Définir le niveau de difficulté du dossier </legend>
			<?php

	include_once("../connexion/connex.inc.php");
	$idcom=connex("SIA","myparam");
	if ($_GET['idexploitation'])
	{
		$idpdeclarant=$_GET['idexploitation'];
	}
		ELSE
		{
		$idpdeclarant=$_SESSION['idpdec'];	
		}
	
	
	$requete="SELECT libelle,idniveau FROM pniveau";
	$result=pg_query($idcom,$requete);			
	while($ligne=pg_fetch_array($result))
		{
			$requete2="SELECT p1.idniveau FROM pdifficulterdv p1 WHERE p1idpdeclarant='".$idpdeclarant."' and p1.idniveau=".$ligne['idniveau']."";
			$res=pg_query($idcom,$requete2);
			$ligne2=pg_fetch_array($res);
			echo $ligne2;
			if ($ligne2['idniveau'] <> null)
			
				{
					?>
					<input type="radio"  name="idniv" id="<?php echo $ligne['idniveau'];?>" value="<?php echo $ligne['idniveau'];?>" checked="checked" data-mini="true" class="custom" />
					<label for="<?php echo $ligne['idniveau'];?>"><?php echo $ligne['libelle'];?> </label>
					<?php
				}
			else
					{
					?>
					<input type="radio"  name="idniv" id="<?php echo $ligne['idniveau'];?>" value="<?php echo $ligne['idniveau'];?>"  data-mini="true" class="custom" />
					<label for="<?php echo $ligne['idniveau'];?>"><?php echo $ligne['libelle'];?> </label>
					<?php
					}
				pg_free_result($res)
						?>
		
		<?php
		}
	pg_free_result($result);
?>
		</fieldset>	
		<button type="submit" data-theme="b" name="submit" value="submit-value">Valider</button>
		</form>
</div><!-- /page -->

</body>
</html>