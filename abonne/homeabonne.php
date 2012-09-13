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
</div><!-- /header -->
	<div data-role="content">
		<div class="content-primary">	
		<ul data-role="listview">
			<li><a href="ficheabonne.php?idexploitation=<?php echo "".$_GET['idexploitation']."";?>">
				<img src="../img/mobile/facture_avec_logo.jpg" />
				<h3>Infos</h3>
			</a></li>
			
			<li><a href="index.html">
				<img src="../img/mobile/logo_facture.jpg" />
				<h3>Facturation</h3>
			</a></li>
			<li><a href="index.html">
				<img src="../img/mobile/logo_formation.jpg" />
				<h3>Formation</h3>
			</a></li>
			<li><a href="http://sd-22074.dedibox.fr/casig/portail_base/spac2.php">
				<img src="../img/mobile/logo_telepac_2012.jpg" />
				<h3>PAC</h3>
				<p>Lien vers la fiche de suivi PAC 2012</p>
			</a></li>
			<li><a href="index.html">
				<img src="../img/mobile/logo_printer.png" />
				<h3>Edition</h3>
			</a></li>
			
		</ul>
		</div><!--/content-primary -->		
	</div><!-- /page -->

		</body>
		</html>