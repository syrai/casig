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
	include_once("./inc_abonne/header_abonne.inc.php");
	?>	
	<div id="div_producteur" data-role="content">
	</div>
	<div id="div_lsite" data-role="content">
	
	</div>
	<div id="div_choix" data-role="content">
	
	</div>

<script type="text/javascript">
	
		
		// Définit l'evenement			
  			afficher_resultat_recherche(localStorage.idexplopt);
    function afficher_resultat_recherche(idexploitationn){
	
		$.ajax({
			type: 'POST',
			url: 'producteur.php',
			datatype: 'json',
			data: {
				action: 'lancer_recherche2',
				producteur : idexploitationn
			},
			success : function(data){
				buffer2='<div data-role="fieldcontain" id="a">';
				buffer2=buffer2 + '<ul data-role="listview" data-theme="c" data-divider-theme="e" data-inset="true" ><span><a href="" id="supp_abonne" name="supp_abonne" data-role="button"  data-theme="f" data-icon="delete" data-inline="true" onclick="supprimer_abonne()">Supprimer abonné</a></span>';
				var obj =jQuery.parseJSON(data);
				var row = obj[0];					
				buffer2=buffer2 + '<li data-role="list-divider">' + row[2] + '</li>';
				buffer2=buffer2 + '<li><h3>' + row[1] + '</h3>';
				buffer2=buffer2 + '<p>' + row[3] + '</p></li>';				
				buffer2=buffer2 + '</ul>';
				buffer2=buffer2 + '</div>';
				$('#div_lsite').html(buffer2);
				$('#div_lsite').trigger('create');
				// Ajout des choix de valorisation uniquement pour PE plan epandge
				afficher_modif_valorisation(localStorage.idexplopt);
			}
		})
	}
	function afficher_modif_valorisation(abonnen){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'liste_campagne_avec_facture',
				abonne : abonnen
			},

			success : function(data){	
				buffer='<input type="text" name="camp" id="camp" placeholder="Millésime..." value=""  />';
				buffer=buffer + '<a href="" id="supp_facture" name="supp_facture" data-role="button"  data-theme="f" onclick="ajouter_la_facture()">Ajouter la facture</a>';
				buffer=buffer +'<div data-role="fieldcontain" id="a">';
				buffer=buffer + '<fieldset data-role="controlgroup"  data-inset="true" data-mini="false" id="f1">';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
				var tmp=obj[i];
				buffer=buffer + '<input type="radio" name="radio-view" id="radio-view-' + tmp[0] + '" value="' + tmp[0] + '">';
				buffer=buffer + '<label for="radio-view-' + tmp[0] + '">' + tmp[1] + '</label>';
									}						
				buffer=buffer + '</fieldset>';
				buffer=buffer + '</div>';
				buffer=buffer + '<a href="" id="supp_facture" name="supp_facture" data-role="button"  data-theme="f" onclick="supprimer_la_facture()">Supprimer la facture</a>';
			
				$('#div_choix').html(buffer);
				$('#div_choix').trigger('create');	
				},
				
			error : function(data){
				$('#div_choix').html(buffer);
				$('#div_choix').trigger('create');
								}
				});
	}
	
	
	function enregister_identifiant(producteur)
	{
		localStorage.idexploitationvalo=producteur;
	}
	function supprimer_abonne()
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			async: false,
			data: {
				action : 'suppression_abonne',
				abonne_supp : localStorage.idexplopt,
			},
			success : function(data){
			
			}
		});
	}
	function ajouter_la_facture()
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			async: false,
			data: {
				action : 'ajouter_fact_abonne',
				abonne_ajout : localStorage.idexplopt,
				campa : $('#camp').val()
			},
			success : function(data){
			
			}
		});
	}
	function supprimer_la_facture()
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			async: false,
			data: {
				action : 'supprimer_fact_abonne',
				campa : $('input[type=radio][name=radio-view]:checked').attr('value')
			},
			success : function(data){
			
			}
		});
	}
	</script>

</body>
</html>