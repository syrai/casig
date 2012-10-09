<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Consultation</title>
	<?php
	include_once("../connexion/version_jq.php");
	?>
</head>
<body>	
	<?php
	include_once("./inc_contact/header_contact.inc.php");
	?>	
<div data-role="page=" id="conscon">
	<div data-role="content">
				<ul data-role="listview" id="listView" data-autodividers="true" data-filter="true" data-inset="true" data-filter-placeholder="Chercher un exploitant..." data-filter-theme="d" data-theme="d" data-divider-theme="e">
	<?php
	
		include("../connexion/connex.inc.php");
		$idcom=connex("SIA","myparam");
		$requete="select  idcontact,raisonsociale || ' : ' || tct.libelle as rdv  from tcontact JOIN tcommunes tc USING (codeinsee) JOIN ttypecontact tct USING (idtypecontact) ORDER BY raisonsociale";
		$result=pg_query($idcom,$requete);
		while($ligne=pg_fetch_array($result))
			{
	?>
			<li>
			<?php 
			$ide=$ligne['rdv']; 
			$idec=$ligne['idcontact']; 				
			;?> 				
			<a href="fichecontact.php?idcontact=<?php echo "".$ligne['idcontact']."" ;?>" id="vers" rel="external" data-icon="star"><?php echo "".$ligne['rdv']."" ;?></a>
										
			<?php
				}
				pg_free_result($result);
	
			?>			
			</li>
			</ul>
	</div>
</div>
</body>
</html>