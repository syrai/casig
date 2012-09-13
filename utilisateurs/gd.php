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

	<div data-role="page" id="callAjaxPage" >
		<div data-role="header" data-theme="e">
			<h1>Gestion des droits</h1>						
		</div><!-- /header -->
		<div data-role="content">
		 <form action="gd.php" id="f1" method="post" >
		<div data-role="fieldcontain">
		<fieldset data-role="controlgroup">
		<legend>Choix du conseiller</legend>
		<select name="abonnement" data-mini="true">
				<?php
					include_once("../connexion/connex.inc.php");
					$idcom=connex("SIA","myparam");
					$requete="select id as iddisphor, nom as libelle FROM tconseiller ORDER by nom";
					$result=pg_query($idcom,$requete);
					while($ligne=pg_fetch_array($result))
						{
							echo "<OPTION VALUE=\"".$ligne['iddisphor']."\">".$ligne['libelle']." </OPTION>";	
						}
						pg_free_result($result);
				?>
			</select><!-- Select abonnement -->			
			</fieldset>
			
			<button type="submit" data-mini="true" data-inline="true">Choisir</submit>
			</div>
		</form>
		<input type="hidden" name="ide" value="<?php echo "".$_POST['abonnement']."";?>"/>
			<form action="modif_horaire_ajax.php"  method="post" >
				<div data-role="fieldcontain">
					<input type="hidden" name="ide" value="<?php echo "".$_GET['iddispo']."";?>"/>	
					<fieldset data-role="controlgroup">
					<legend>Modifier les horaires </legend>
						<?php
							include_once("../connexion/connex.inc.php");
							$idcom=connex("SIA","myparam");	
							$requete="select t.idprofil as iddisphor, case WHEN tdroit.idprofil is null THEN '' ELSE 'checked' END as disponible,t.nom as libelle from tdroit JOIN tprofil t ON t.id=idprofil WHERE tdroit.id='".$_POST['abonnement']."'";
							$result=pg_query($idcom,$requete);			
	while ($ligne=pg_fetch_array($result))
		{
			?>
					<input type="checkbox"  name="droit[]" id="<?php echo $ligne['iddisphor'];?>" value="<?php echo $ligne['iddisphor'];?>" <?php echo "".$ligne['disponible']."" ;?> data-mini="true" class="custom"  />
					<label for="<?php echo $ligne['iddisphor'];?>"><?php echo $ligne['libelle'];?> </label>
			<?php
		}
	pg_free_result($result);
?>
		</fieldset>
		</form>
		<button type=submit data-theme="b" name="submit" value="submit" >Valider</button>
	</div>
</div><!-- /page -->
</body>
</html>