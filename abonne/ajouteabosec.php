<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Secondaire</title>
	 <?php
	include_once("../connexion/version_jq.php");
	?>
</head>
<body>	
<div data-role="dialog">
	<div data-role="header" data-theme="d">
			<h1>Nouvel abonnement</h1>
</div>

<div id="div_formation" data-role="content">

</div>
</div>
<script type="text/javascript">
affichage();

		
function affichage(){
	$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'affichage_abo_sec'
				},
			success : function(data,text){	
				buffer='<h3>Ajouter un nouveau prestataire</h3>'
				buffer=buffer + '<input type="text" id="raisonsocial" name="raisonsocial">'
				buffer=buffer + '<select name="abo" id ="abo" data-native-menu="false" data-mini="true">';
				buffer=buffer + '<option>Abonnement...</option>';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					buffer=buffer + '<option value="' + tmp[0] + '">' + tmp[1] + '</option>';
										}
				buffer=buffer + '</select>';
				buffer=buffer + '<input type="submit" id="c" name="c"  data-icon="plus" data-inline="true" value="Ajouter">';
				$('#div_formation').html(buffer);
				$('#div_formation').trigger('create');
				
			$('#c').click(function(){
			afficher_resultat_recherche($('select#abo').val(),'9',getUrlParameter('idexploitation'));
				});
			}
		});
}
function afficher_resultat_recherche(abos,mois,idexp){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			data: {
				action: 'ajouter_abo_sec',
				nomexploit : $('#raisonsocial').val(),
				idexploitation : idexp,
				typeabo : abos,
				idmois : mois
			},
			success : function(data){	
			alert('Abonnement crée !');
			},
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

<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>	
</body>
</html>