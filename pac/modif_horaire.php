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
			<h1>Gestion des horaires</h1>						
		</div><!-- /header -->
		<div data-role="content">
			<form action="modif_horaire_ajax.php"  method="post" >
				<div data-role="fieldcontain">
					<input type="hidden" name="ide" value="<?php echo "".$_GET['iddispo']."";?>"/>	
					<fieldset data-role="controlgroup">
					<legend>Modifier les horaires </legend>
						<?php
							include_once("../connexion/connex.inc.php");
							$idcom=connex("SIA","myparam");	
							$requete="select iddisphor,case when disponible='0' THEN 'checked' ELSE '' END as disponible,p.libelle from pdispohoraire pdis join phoraire p using (idhoraire) where iddispo='".$_GET['iddispo']."' order by p.idhoraire;";
							$result=pg_query($idcom,$requete);			
	while ($ligne=pg_fetch_array($result))
		{
			?>
					<input type="checkbox"  name="favorite[]" id="<?php echo $ligne['iddisphor'];?>" value="<?php echo $ligne['iddisphor'];?>" <?php echo "".$ligne['disponible']."" ;?> data-mini="true" class="custom"  />
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