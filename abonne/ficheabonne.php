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
	<script src="jquery.mobile.fixedToolbar.polyfill.js"></script>

</head> 
<body> 


		
	<div data-role="page" >
		<div data-role="header" data-position="fixed" data-theme="e">
			<h3><?php
include_once("../connexion/connex.inc.php");
if ($_GET['idexploitation'])
	{
		$_SESSION['idpdec']=$_GET['idexploitation'];
	}
		ELSE
		{
		$idpdeclarant=$_SESSION['idpdec'];	
		}
	$idcom=connex("SIA","myparam");
	$requete="select raison_social as n FROM tcartonet where idexploitation='".$_GET['idexploitation']."';";
	$result=pg_query($idcom,$requete);
	$ligne=pg_fetch_array($result);
	echo "".$ligne['n']."";
	pg_free_result($result);
;?></h3>
<div data-role="navbar">
		<ul>
			<li><a href="coordabonne.php?idexploitation=<?php echo "".$_GET['idexploitation']."";?>" data-role="button" data-icon="plus" data-rel="dialog" data-iconpos="notext">Infos</a></li>
			<li><a href="voircommentaire.php" data-role="button" data-icon="grid" data-iconpos="notext">Voir les commentaires</a></li>
			<li><a href="rechercheabonne.php" data-role="button" data-icon="search" data-iconpos="notext">Retour</a></li>
		</ul>
</div><!-- /navbar -->	</div><!-- /header -->
		<form action="accesajax.php" method="post">
		<div data-role="fieldcontain">
		<input type="hidden" name="ide" value="<?php echo "".$_GET['idexploitation']."";?>"/>		
		<fieldset data-role="controlgroup">
		
			<legend>Choisir les élements abordés : </legend>
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
	
	
	$requete="select libelle,idtypeabonnement FROM ttypeabonnement where idregroupement='1' ";
	$result=pg_query($idcom,$requete);			
	while($ligne=pg_fetch_array($result))
		{
			$requete2="select p1.idtypeabonnement from tcartonet p1   WHERE p1.idexploitation='".$idpdeclarant."' and p1.idtypeabonnement=".$ligne['idtypeabonnement']."";
			$res=pg_query($idcom,$requete2);
			$ligne2=pg_fetch_array($res);
			if ($ligne2['idtypeabonnement'] <> null)
			
				{
					?>
					<input type="radio"  name="idpac[]" id="<?php echo $ligne['idtypeabonnement'];?>" value="<?php echo $ligne['idtypeabonnement'];?>" checked="true" data-mini="true" class="custom" />
					<label for="<?php echo $ligne['idtypeabonnement'];?>"><?php echo $ligne['libelle'];?> </label>
					<?php
				}
			else
					{
					?>
					<input type="radio" name="idpac[]" id="<?php echo $ligne['idtypeabonnement'];?>" value="<?php echo $ligne['idtypeabonnement'];?>" data-mini="true" class="custom" />
					<label for="<?php echo $ligne['idtypeabonnement'];?>"><?php echo $ligne['libelle'];?> </label>
					<?php
					}
				pg_free_result($res)
						?>
		
		<?php
		}
	pg_free_result($result);
?>
		</fieldset>	
		<fieldset data-role="controlgroup">
		
			<legend>Mois</legend>
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
	
	
	$requete="select mois as libelle,idmois as idtypeabonnement FROM tmois  ";
	$result=pg_query($idcom,$requete);			
	while($ligne=pg_fetch_array($result))
		{
			$requete2="select p1.idtypeabonnement from tcartonet p1   WHERE p1.idexploitation='".$idpdeclarant."' and p1.idmois=".$ligne['idtypeabonnement']."";
			$res=pg_query($idcom,$requete2);
			$ligne2=pg_fetch_array($res);
			if ($ligne2['idtypeabonnement'] <> null)
			
				{
					?>
					<input type="radio"  name="idpa[]" id="<?php echo $ligne['idtypeabonnement'];?>" value="<?php echo $ligne['idtypeabonnement'];?>" checked="true" data-mini="true" class="custom" />
					<label for="<?php echo $ligne['idtypeabonnement'];?>"><?php echo $ligne['libelle'];?> </label>
					<?php
				}
			else
					{
					?>
					<input type="radio" name="idpa[]" id="<?php echo $ligne['idtypeabonnement'];?>" value="<?php echo $ligne['idtypeabonnement'];?>" data-mini="true" class="custom" />
					<label for="<?php echo $ligne['idtypeabonnement'];?>"><?php echo $ligne['libelle'];?> </label>
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
		</div>
		</form>
<div data-role="footer" data-theme="e">

		<?php	if ($_GET['idexploitation'])
	{
		$idpdeclarant=$_GET['idexploitation'];
	}
		ELSE
		{
		$idpdeclarant=$_SESSION['idpdec'];	
		}?>
		
			<h1><?php
include_once("connex.inc.php");
	$idcom=connex("SIA","myparam");
	$requete="select pd.raison_sociale || ' avec ' || tc.nom as n FROM pplanning JOIN pdeclarant pd USING (idpdeclarant) JOIN tconseiller tc USING (id) WHERE pplanning.millesime='2012' and pplanning.idpdeclarant='".$idpdeclarant."';";
	$result=pg_query($idcom,$requete);
	$ligne=pg_fetch_array($result);
	echo "".$ligne['n']."";
	pg_free_result($result);
;?></h1></div><!-- /header -->
	</div><!-- /page -->

		</body>
		</html>