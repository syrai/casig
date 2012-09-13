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
		<h1>Gestion des conseillers</h1>
		<a href="ajout_date.php?iddispor=<?php echo "".$_POST['abonnement']."";?>" data-role="button" data-icon="plus" data-iconpos="notext" data-mini="true" data-inline="true"></a>
		</div>		
		
		<form action="gestion_horaire.php" id="f1" method="post" >
		<div data-role="fieldcontain">
		<fieldset data-role="controlgroup">
		<legend>Choix du conseiller</legend>
		<select name="abonnement" data-mini="true">
				<?php
					include_once("../connexion/connex.inc.php");
					$idcom=connex("SIA","myparam");
					$requete="select id as iddisphor, nom as libelle FROM tconseiller JOIN tdroit USING (id) where idprofil='6' ORDER by nom";
					$result=pg_query($idcom,$requete);
					while($ligne=pg_fetch_array($result))
						{
							echo "<OPTION VALUE=\"".$ligne['iddisphor']."\">".$ligne['libelle']." </OPTION>";	
						}
						pg_free_result($result);
				?>
			</select><!-- Select abonnement -->			
			</fieldset>
			
			<button type="submit" data-mini="true">Choisir</submit>
			</div>
			</form>
			<form action="gestion_horaire.php" id="f2" method="post">
		<div>
		
		
		</div>
			</form>
		<input type="hidden" name="ide" value="<?php echo "".$_POST['abonnement']."";?>"/>
		
	<div data-role="content">
		<div class="content-primary">
		<ul data-role="listview" data-split-icon="delete" data-split-theme="e">
		<?php
		include_once("../connexion/connex.inc.php");
$idcom=connex("SIA","myparam");
$requete="select date_dispo || ', ' || lieu as date_dispo,iddispo from pdispoconseiller WHERE id='".$_POST['abonnement']."' ORDER BY date_dispo";
$result=pg_query($idcom,$requete);
while($ligne=pg_fetch_array($result))
{
	?>
			<li>
			<?php $param="?iddispo=".$ligne['iddispo'] ;?>
			<a href="modif_horaire.php<?php echo "".$param ;?> " data-rel="dialog" data-transition="turn"
			<h3><?php echo "".$ligne['date_dispo']."";?></h3>
				</a>
				<?php $param="?iddispo=".$ligne['iddispo'] ;?>
				<a href="modif_horaire.php<?php echo "".$param ;?>"  >Ajouter</a>
				</li>
			<?php
}
?>
		</ul>	
	
		</div>
		</div>
		
</div><!-- /page -->

</body>
</html>