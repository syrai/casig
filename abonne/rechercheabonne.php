
<!DOCTYPE html> 
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>GAMP</title> 
	<link rel="stylesheet"  href="//code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />  
	<link rel="stylesheet" href="../_assets/css/jqm-docs.css"/>

	<script src="//code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="../../docs/_assets/js/jqm-docs.js"></script>
	<script src="//code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>

</head> 
<body> 

	<div data-role="page" class="type-interior">

		<div data-role="header" data-theme="e">
		<h1>Liste des abonnés</h1>
	</div><!-- /header -->

	<div data-role="content">
		<div class="content-primary">	
			<ul data-role="listview" data-filter="true" data-inset="true">
				<?php
		include_once("../connexion/connex.inc.php");
		$idcom=connex("SIA","myparam");
		$requete="SElect raison_social  as rdv,idexploitation FROM tcartonet  ORDER by raison_social";
		$result=pg_query($idcom,$requete);
		while($ligne=pg_fetch_array($result))
			{
	?>
			<li>
			<?php 
			$ide=$ligne['rdv']; 
			$idec=$ligne['idexploitation'];
 			;?> 
 				<a href="homeabonne.php?idexploitation=<?php echo "".$ligne['idexploitation']."" ;?>" data-icon="star" ><?php echo "".$ligne['rdv']."" ;?></a></span>
						
			<?php
				}
				pg_free_result($result);
	
			?>
			</li>
			</ul>
			</div><!--/content-primary -->	
			</div>
			
	</body>
	</html>