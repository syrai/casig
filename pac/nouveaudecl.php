<!DOCTYPE html> 
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

	<div data-role="page" class="type-interior" >
	<div data-role="header" data-position="fixed">
		
		</div><!-- /header -->
	<div data-role="content">
		<div class="content-primary">	
		<ul data-role="listview" data-split-icon="plus" data-split-theme="d">
		<?php
include_once("../connexion/connex.inc.php");
$idcom=connex("SIA","myparam");
$requete="SELECT tc.idexploitation as idpplanning,tc.raison_social || ' ' || tc.nom || ', ' || tt.libelle as raison_sociale from tcartonet tc JOIN ttypeabonnement tt USING (idtypeabonnement)  where (tt.idregroupement='1') AND  tc.idexploitation not in (select pdec.idexploitation from  pdeclarant pdec,tmillesime tmi where tmi.courant=1 and pdec.millesime=tmi.millesime) order by tc.raison_social;";
$result=pg_query($idcom,$requete);

while($ligne=pg_fetch_array($result))
{
	$id=$ligne['idpplanning']
	?>
			<li><a href="lists-split-purchase.html" 
			<h3><?php echo "".$ligne['raison_sociale']."";?></h3>
			</a>
			<?php $param="?idexploitation=".$ligne['idpplanning']."&rs=".$ligne['raison_sociale'] ;?>
			<a href="dialog_nouveaudecl.php<?php echo "".$param ;?>"  data-rel="dialog" data-transition="turn">Créer</a>
			</li>
			<?php
}
?>
		</ul>
		</div><!--/content-primary -->		
	</div><!-- /content -->
</div><!-- /page -->

	</body>
	</html>