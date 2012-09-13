<?php
session_start();	

?>
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

	<div data-role="page">
		<div data-role="header" data-theme="e">
			<h1>Information de contact</h1>
		</div><!-- /header -->				
			<?php
		include_once("../connexion/connex.inc.php");
		$idcom=connex("SIA","myparam");
		$requete="SELECT raison_social,nom,ta.adresse,ta.codepostal,ta.commune FROM tcartonet JOIN tadresseabonne ta USING (idexploitation) WHERE idexploitation='".$_GET['idexploitation']."';";
		$result=pg_query($idcom,$requete);
		$ligne=pg_fetch_array($result);
		;?>
		<div data-role="content" data-theme="b">
			<form action="modifcoord.php" id="f2" method="post">
				<div data-role="fieldcontain" >	
			
					<fieldset>
						<label for="rl">Raison sociale:</label>
						<input type="text" name="rl" id="rl" value="<?php echo $ligne['raison_social'] ;?>" data-mini="true" />
						<label for="personne">Personne :</label>
						<input type="text" name="personne" id="personne" value="<?php echo "".$ligne['nom']."";?>" data-mini="true" />
						<label for="adresse">Adresse :</label>
						<input type="text" name="adresse" id="adresse" value="<?php echo "".$ligne['adresse']."";?>" data-mini="true" />
						<label for="cp">CodePostal :</label>
						<input type="text" name="cp" id="cp" value="<?php echo "".$ligne['codepostal']."";?>" data-mini="true" />
						<label for="com">Commune :</label>
						<input type="text" name="com" id="com" value="<?php echo "".$ligne['commune']."";?>" data-mini="true" />						
						<button type="submit" data-theme="b" data-direction="reverse" name="submit" value="<?php echo $_GET['idexploitation'] ?>" data-mini="true" date-inline="true" data-rel="back">Créer</button>		
					</fieldset>
				</div>
			</form>	
		</div>
</div><!-- /page -->
		</body>
		</html>