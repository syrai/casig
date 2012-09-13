<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Options</title>
	 <?php
	include_once("../connexion/version_jq.php");
	?>
	<link rel="stylesheet" href="../css/jqm-docs.css" />

</head>
<body>	
	<?php
	include_once("./inc_formation/header_formation.inc.php");
	?>	
	<div id="div_producteur" data-role="content">
	</div>
	<div id="div_lsite" data-role="content">
	
	</div>
	<div id="div_choix" data-role="content">
	
	</div>

<script type="text/javascript">
	
		localStorage.idexploitationformation=getUrlParameter('idexploitation')
		// Définit l'evenement			
  	afficher_modif_valorisation();
    
	function afficher_modif_valorisation(){
		$.ajax({
			type: 'POST',
			url: 'ajax_formation.php',
			data: {
				action: 'liste_des_cycles'
			},

			success : function(data){	
				buffer='<div data-role="fieldcontain" id="a">';
				buffer=buffer + '<fieldset data-role="controlgroup"  data-inset="true" data-mini="false" id="f1">';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
				var tmp=obj[i];
				buffer=buffer + '<input type="radio" name="radio-view" id="radio-view-' + tmp[0] + '" value="' + tmp[0] + '">';
				buffer=buffer + '<label for="radio-view-' + tmp[0] + '">' + tmp[1] + '</label>';
									}						
				buffer=buffer + '</fieldset>';
				buffer=buffer + '</div>';
				buffer=buffer + '<a href="" id="supp_facture" name="supp_facture" data-role="button" data-icon="plus"  data-theme="f" onclick="ajouter_le_participant()">Ajouter le participant</a>';
			
				$('#div_choix').html(buffer);
				$('#div_choix').trigger('create');	
				}
				});
	}
	
	function ajouter_le_participant()
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_formation.php',
			datatype: 'json',
			async: false,
			data: {
				action : 'ajouter_formation_abonne',
				abonne_ajout : localStorage.idexploitationformation,
				campa : $('input[type=radio][name=radio-view]:checked').attr('value')
			},
			success : function(data){
			confirm('Inscription réussie!');
			}
		});
	}
	
	function getUrlParameter(name) 
{
     var searchString = location.search.substring(1).split('&');
 
    for (var i = 0; i < searchString.length; i++) {
 
        var parameter = searchString[i].split('=');
        if(name == parameter[0])    return parameter[1];
 
    }
 
    return false;
}

	</script>

</body>
</html>