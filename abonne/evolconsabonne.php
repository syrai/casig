<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Rechercher</title>
	<link rel="shortcut icon" href="../img/mobile/favicon.png" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
	 
</head>
<body>	
<script type="text/javascript">

</script>
	<?php
	include_once("./inc_abonne/header_abonne.inc.php");
	?>	
<div data-role="page=" id="consabo">
<div id="div_producteur" data-role="content">
	
</div>
<div id="div_liste" data-role="content">

</div>
	<script type="text/javascript">
	//Affichage de la liste déroulante des types d'abonnement
	
	affichage_liste_abonnement();
	function affichage_liste_abonnement(){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'liste_abonnement'
					},
			success : function(data){	
				buffer='<select name="a" id ="a" data-native-menu="false" data-mini="true">';
				buffer=buffer + '<option>Abonnement...</option>';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					buffer=buffer + '<option value="' + tmp[0] + '">' + tmp[1] + '</option>';
										}
				buffer=buffer + '</select>';
				$('#div_producteur').html(buffer);
				$('#div_producteur').trigger('create');				
				$('select#a').change(function(){
					afficher_abonne($('select#a').val());
										});
				}
				});
	}
	function afficher_abonne(idtypeabonnement){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'liste_abonne',
				idtypeabonnement : idtypeabonnement
					},
			success : function(data){	
				buffer1='<ul data-role="listview" id="listView" data-filter="true" data-inset="true" data-filter-placeholder="Chercher un abonne..." data-filter-theme="d" data-theme="d" data-divider-theme="e">';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					buffer1=buffer1 + '<li>';
					buffer1=buffer1 + '<a href="ficheabonnes.php?idexploitation='+ tmp[0] + '" id="vers" rel="external" data-icon="star">' + tmp[1] + '</a>';
					buffer1=buffer1 + '</li>';							
					}
				buffer1=buffer1 + '</ul>';
				$('#div_liste').html(buffer1);
				$('#div_liste').trigger('create');				
				}
				});
	}
	</script>
	
</div>
</body>
</html>