
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
		<div data-role="content" data-theme="b">
				<div data-role="fieldcontain" id="div_producteur" >	
					
				</div>	
		</div>
		<script type="text/javascript">
    	afficher_fiche_contact(getUrlParameter('idcontact'));
    	
	function afficher_fiche_contact()
	{
		buffer='<fieldset>';
		buffer=buffer + '<h4>Ajouter un suivi</h4>';
		buffer=buffer + '<table><tr><td>' + getUrlParameter('rs') + '</td></tr>';
		buffer=buffer + '<input type="text" id="newsuivi" name="newsuivi">';
		buffer=buffer + '<input type="submit" id="enregistrer_suivi" name="enregistrer_suivi" value="Enregistrer" data-rel="back">';
		buffer=buffer + '</fieldset>'
		$('#div_producteur').html(buffer);
		$('#div_producteur').trigger('create');
		// Définit l'evenement
		$('#enregistrer_suivi').click(function(){
			ajouter_suivi(getUrlParameter('idcontact'));
		});
	}
	function ajouter_suivi(producteur)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_ajcontact.php',
			data: {
				action : 'ajout_suivi',
				producteur : producteur,
				suivi : $('#newsuivi').val()
			},
			success : function(data){
			}
		});
	}
	function getUrlParameter(name) {
 
    var searchString = location.search.substring(1).split('&');
 
    for (var i = 0; i < searchString.length; i++) {
 
        var parameter = searchString[i].split('=');
        
        if(name == parameter[0])    return parameter[1].replace('%20',' ');
 
    }
 
    return false;
}
	</script>
	</div><!-- /page -->
		</body>
		</html>