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
			<h1>Ajouter</h1>
		</div><!-- /header -->				
		<div data-role="content" data-theme="b">
			<form action="nouveaudecl_ajax.php" method="post">
				<div data-role="fieldcontain" >	
					<fieldset>
						<h4>Vous allez créer pour le déclarant suivant </h4>
						<p><strong><?php echo "".$_GET[rs]."";?></strong></p>						
						<button type=submit data-theme="b" name="submit" value="<?php echo $_GET[idexploitation]?>">Créer</button>		
					</fieldset>
				</div>
			</form>			
		<a href="index.html" data-role="button" data-rel="back">Annuler</a>
		</div>
</div><!-- /page -->
		</body>
		</html>