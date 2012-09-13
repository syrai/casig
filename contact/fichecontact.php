<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Fiche</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>

</head>
<body>	
	<?php
	include_once("./inc_contact/header_contact.inc.php");
	?>	
	<div id="div_producteur" data-role="content">
	
	</div>
	<script type="text/javascript">
    	afficher_fiche_contact(getUrlParameter('idcontact'));
	function afficher_fiche_contact(producteur)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_ajcontact.php',
			datatype: 'json',
			data: {
				action : 'info_contact',
				producteur : producteur
			},
			success : function(data){
				var obj =jQuery.parseJSON(data);
				var row = obj[0];		
				buffer='<div data-role="collapsible" data_collapsed="true" data-theme="e" data-content-theme="c">';
				buffer=buffer + '<h1>' + row[1] + '</h1>';
				buffer=buffer + '<table><tr>';
				buffer=buffer + '<td>Nom contact :</td><td>' + row[6] + '</td></tr>';
				buffer=buffer + '<td>Adresse :</td><td>' + row[7] + '</td></tr>';
				buffer=buffer + '<td>Tél :</td><td>' + row[2] + '</td></tr>';
				buffer=buffer + '<td>Mail:</td><td>' + row[3] + '</td></tr>';
				buffer=buffer + '<td>Type contact:</td><td>' + row[5] + '</td></tr>';
				buffer=buffer + '</table>';
				buffer=buffer + '</div>';
				buffer=buffer + '<div data-role="collapsible" data_collapsed="true" data-theme="e" data-content-theme="c">';
				buffer=buffer + '<h1>Options</h1>';
				buffer=buffer + '<a href="modifiercontact.php?idcontact=' + row[0] + '&rs=' + row[1] + '"  rel="external" data-icon="refresh" data-role="button" >Modifier le contact</a>'
				buffer=buffer + '<a href="basculcontact.php?idcontact=' + row[0] + '" rel="external" data-icon="star" data-role="button">Créer un client</a>';
				buffer=buffer + '<a href="suivicontact.php?idcontact=' + row[0] + '&rs=' + row[1] + '" rel="external" data-icon="plus" data-role="button">Ajouter un suivi</a>';
				buffer=buffer + '<a href="supprimercontact.php?idcontact=' + row[0] + '&rs=' + row[1] + '"  rel="external" data-icon="delete" data-role="button" >Supprimer le contact</a>';
				buffer=buffer + '</div>';
				buffer=buffer + '<div data-role="collapsible" id="div_suivi" data_collapsed="true" data-theme="e" data-content-theme="c">';
				buffer=buffer + '<h1>Suivi</h1>';	
				buffer=buffer + '<div class="content-primary" id="ab">';
				
				afficher_suivi_contact(getUrlParameter('idcontact'));
				buffer=buffer + '</div>';
				buffer=buffer + '</div>';
				
				$('#div_producteur').html(buffer);
				$('#div_producteur').trigger('create');
			
			}
		});
	}
	function afficher_suivi_contact(producteur)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_ajcontact.php',
			datatype: 'json',
			data: {
				action : 'cons_suivi',
				producteur : producteur
			},
			success : function(data){
				buffer='<ul data-role="listview" data-theme="g" data-divider-theme="d">';
				var obj =jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
				var tmp = obj[i];				
				buffer=buffer + '<li data-role="list-divider">' + tmp[0] + '</li>';			
				buffer=buffer + '<li><p>' + tmp[1] + '</p></li>';
				}
				buffer=buffer + '</ul>';			
			
				
				$('#ab').html(buffer);
				$('#ab').trigger('create');
			
			}
		});
	}
	function getUrlParameter(name) {
 
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