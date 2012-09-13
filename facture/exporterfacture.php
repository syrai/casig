<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Export</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>

</head>
<body>	
<?php
	include_once("./inc_facture/header_facture.inc.php");
?>
<div id="div_producteur" data-role="content">
	
</div>

<script type="text/javascript">
afficher_campagne();
function afficher_campagne(){
	$.ajax({
		type: 'POST',
		url: 'ajax_facture.php',
		datatype: 'json',
		data: {
			action: 'liste_campagne'
		},
		success : function(data){
			
			buffer='<li data-role="fieldcontain">';
			buffer=buffer + '<select name="a" id ="a" data-native-menu="false" data-mini="true">';
			buffer=buffer + '<option>Campagne...</option>';
			var obj = jQuery.parseJSON(data);
			for(i=0;i<obj.length;i++)
										{
										var tmp=obj[i];
										buffer=buffer + '<option value="' + tmp[0] + '">' + tmp[0] + '</option>';
										}
			buffer=buffer + '</select>';
			buffer=buffer + '</li>';
			buffer=buffer + '<input type="submit" id="valide_recherche" name="valide_recherche" value="Rechercher">';	
									
			$('#div_producteur').html(buffer);
			$('#div_producteur').trigger('create');	
			$('#valide_recherche').click(function(){
				edition_export($('select#a').val());
				});
			}
		});
			
		}

function edition_export(campagne){
	$.ajax({
		type: 'POST',
		url: 'ajax_facture.php',
		datatype: 'json',
		data: {
			action: 'liste_campagne2',
			campagne : campagne
		},
		success : function(data){
	
	buffer=buffer + '<a href="exc.php?campagne=' + campagne + '" rel="external" data-rel="dialog" data-role="button">Télécharger</a>';	
	$('#div_producteur').html(buffer);
	$('#div_producteur').trigger('create');	
				}
		
	});		
}

</script>
<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>	
</body>
</html>