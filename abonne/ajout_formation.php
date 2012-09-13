<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Nouvelle formation</title>
	<link rel="stylesheet" href="popup-examples.css" />
	 <?php
	include_once("../connexion/version_jq.php");
	?>
</head>
<body>	
	<?php
		include_once("./inc_abonne/header_abonne.inc.php");
	?>	
<div id="div_producteur" data-role="content">
	
</div>
<div id="div_liste" data-role="content">

</div>
<script type="text/javascript">
		afficher_liste_formation();		
function ajouter_participant(idexploitation,producteur)
	{
		$.ajax({
			type: 'POST',
			url: 'trait_formation_abonne.php',
			datatype: 'json',
			data: {
				action : 'ajouter_participant',
				idcycle : producteur,
				idexploitation : idexploitation
			},
			success : function(data){
			
			}
		});
	}
function afficher_participant(producteur)
	{
		$.ajax({
			type: 'POST',
			url: 'trait_formation_abonne.php',
			datatype: 'json',
			data: {
				action : 'liste_participant',
				idcycle : producteur
				
			},
			success : function(data){
				buffer3='<ul data-role="listview" data-theme="d" data-divider-theme="e">';
				buffer3=buffer3 + '<li data-role="list-divider">Participants</li>'
				var obj =jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
				var tmp = obj[i];							
				buffer3=buffer3 + '<li><a href="presenceformation.php?idexploitation=' + tmp[2] + '&idcycle=' + $('select#a').val()+ '" </a>' + tmp[1] + '</li>';
				}
				buffer3=buffer3 + '</ul>';	
			
				
				$('#div_liste').html(buffer3);
				$('#div_liste').trigger('create');
			
			}
		});
	}
function afficher_liste_formation(){
		$.ajax({
			type: 'POST',
			url: 'trait_formation_abonne.php',
			data: {
				action: 'liste_formation_dispo'
			},
			success : function(data,text){	
				buffer='<h1>Consultation des formations</h1>'
				buffer=buffer + '<select name="a" id ="a" data-native-menu="false" data-mini="true">';
				buffer=buffer + '<option>Formation...</option>';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					buffer=buffer + '<option value="' + tmp[0] + '">' + tmp[1] + '</option>';
										}
				buffer=buffer + '</select><input type="submit" id="c" name="c" data-iconpos="notext" data-icon="search">';
				buffer=buffer + '</select><input type="submit" id="d" name="d" data-iconpos="notext" data-icon="plus">';
				$('#div_producteur').html(buffer);
				$('#div_producteur').trigger('create');
				// Définit l'evenement
			$('#c').click(function(){
			afficher_participant($('select#a').val());
				});
				$('#d').click(function(){
			ajouter_participant(getUrlParameter('idexploitation'),$('select#a').val());
				});
				}
				})
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

<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>	
</body>
</html>