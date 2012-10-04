<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Rechercher</title>
	<?php
	include_once("../connexion/version_jq.php");
	?>
</head>
<body>	
<div data-role="page=" id="consabo">

	<?php
	include_once("./inc_formation/header_formation.inc.php");
	?>	
<div id="div_r" data-role="content-secondary">
	

</div>
<div id="div_producteur" data-role="content-primary">
	

</div>
<div id="div_liste" data-role="content">

</div>
<!-- Core files -->
		<script src="../jqueryalert/jquery.alerts.js" type="text/javascript"></script>
		<link href="../jqueryalert/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript">
	affichage_bt_radio();
	function affichage_bt_radio(){
		buffer='<div data-role="fieldcontain" id="r" >';
		buffer=buffer + '<fieldset data-role="controlgroup" data-type="horizontal" id="f1">';
	
		buffer=buffer + '<input type="radio" name="radio-view" id="radio-view-a"  value="avant"  />';
		buffer=buffer + '<label for="radio-view-a">Avant</label>';
		buffer=buffer + '<input type="radio" name="radio-view" id="radio-view-b" value="apres"  />';
		buffer=buffer + '<label for="radio-view-b">Après</label>';
		buffer=buffer + '</fieldset>';
		buffer=buffer + '</div>';
		buffer=buffer + '<div data-role="fieldcontain" id="rr">';
		buffer=buffer + '<fieldset data-role="controlgroup" data-type="horizontal" id="f2">';
		buffer=buffer + '<input type="radio" name="radio-viewr" id="radio-viewr-a" value="JI"  />';
		buffer=buffer + '<label for="radio-viewr-a">Initiales</label>';
		buffer=buffer + '<input type="radio" name="radio-viewr" id="radio-viewr-b" value="Autres"  />';
		buffer=buffer + '<label for="radio-viewr-b">Perfectionnement</label>';
		buffer=buffer + '</fieldset>';
		buffer=buffer + '</div>';
		$('#div_r').html(buffer);
		$('#div_r').trigger('create');
		// Evenemet
		$('#rr').change(function(){
					affichage_liste_abonnement($('input[type=radio][name=radio-view]:checked').attr('value'),$('input[type=radio][name=radio-viewr]:checked').attr('value'));
										});
	}
	//Affichage de la liste déroulante des types d'abonnement
	
	
	function affichage_liste_abonnement(quand,type){
		$.ajax({
			type: 'POST',
			url: 'ajax_formation.php',
			data: {
				action: 'liste_type_formation',
				quand : quand,
				type: type
					},
			success : function(data){	
				buffer='<ul data-role="listview" data-autodividers="true" data-divider-theme="f" >';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					buffer=buffer + '<li><a href="participantformation.php?idcycle='+ tmp[0] + '" rel="external">' + tmp[1] + '<span class="ui-li-count">'+ tmp[2] + '</span></a></li>';
										}
				buffer=buffer + '</ul>';
				$('#div_producteur').html(buffer);
				$('#div_producteur').trigger('create');				
				
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
					buffer1=buffer1 + '<a href="participantformation.php?idcycle='+ tmp[0] + '" id="vers" rel="external" data-icon="star">' + tmp[1] + '</a>';
					buffer1=buffer1 + '</li>';							
					}
				buffer1=buffer1 + '</ul>';
				$('#div_liste').html(buffer1);
				$('#div_liste').trigger('create');				
				}
				});
	}
	</script>
	<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>
</div>
</body>
</html>