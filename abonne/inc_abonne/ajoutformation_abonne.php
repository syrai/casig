
<!DOCTYPE html> 
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>PAC</title> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0-rc.2/jquery.mobile-1.1.0-rc.2.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0-rc.2/jquery.mobile-1.1.0-rc.2.min.js""></script>

</head> 
<body> 


	<div data-role="page">
		<div data-role="header" data-theme="e">
			<h1>Suivi</h1>
			<a href="./fichecontact?idcontact=<?php echo "".$_GET['idcontact']."";?>" rel="external"data-icon="back" data-iconpos="notext" data-direction="reverse"></a>
		</div><!-- /header -->				
		<div data-role="content" data-theme="b" id="div_producteur">
		
		</div>
		<script type="text/javascript">
    	afficher_formation();    	
	function afficher_formation()
	{
		buffer='<fieldset>';
		buffer=buffer + '<h4>Inscrire à une formation</h4>';
		buffer='<select name="select_formation" id="select_formation" data-mini="true">';
		buffer=buffer + '<option>Formation...</option>';
		ajout_liste_formation();
		buffer=buffer + '</select>';
		buffer=buffer + '<input type="submit" id="enregistrer_suivi" name="enregistrer_suivi" value="Enregistrer" data-rel="back">';
		buffer=buffer + '</fieldset>';
		$('#div_producteur').html(buffer);
		$('#div_producteur').trigger('create');
		// Définit l'evenement
		$('#enregistrer_suivi').click(function(){
			
		});
	}
	function ajout_liste_formation()
	{
		$.ajax({
				type: 'POST',
				url: 'trait_formation_abonne.php',
				datatype: 'json',
				data: {
					action : 'liste_formation_dispo'
					
					},
			success : function(data){
				
				var obj =jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp = obj[i];				
					buffer2=buffer2 + '<option value="' + tmp[0] + '">' + tmp[1] + '</option>';
				}
				
				$('#select_formation').html(buffer2);
				$('#select_formation').trigger('create');
			}
			})
	}
	</script>
	</div><!-- /page -->
		</body>
		</html>