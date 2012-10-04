<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Valorisation</title>
	 <link rel="stylesheet" href="popup-examples.css" />
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
	<input type="search" id="valide_recherche" name="valide_recherche" placeholder="Exploitations" value="" onchange="afficher_resultat_recherche()"/>
	</div>
	<div id="div_lsite" data-role="content">
	
	</div>
	<div id="div_choix" data-role="content">
	
	</div>

<script type="text/javascript">
	
		
		// Définit l'evenement
	
		$("#valide_recherche").change(function() {  			
  			afficher_resultat_recherche()
												});

    function afficher_resultat_recherche(){
	
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			data: {
				action: 'liste_abonne2',
				raisonsociale : $('#valide_recherche').val()
			},
			success : function(data){
				buffer2='<div data-role="fieldcontain" id="a">';
				buffer2=buffer2 +'<h3>Résultat :</h3>';
				buffer2=buffer2 + '<ul data-role="listview" data-theme="c" data-divider-theme="e" data-inset="true" >';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					
					buffer2=buffer2 + '<li data-role="list-divider">' + tmp[0] + '</li>';
					buffer2=buffer2 + '<li><h3>' + tmp[1] + '</h3>';
					buffer2=buffer2 + '<p>' + tmp[2] + '</p></li>';
					buffer2=buffer2 + '<li><a href="#" data-role="button" date-inline="true"  onclick="enregister_identifiant(' + tmp[0] + ')">Choisir</a></li>';
				} 
				buffer2=buffer2 + '</ul>';
				buffer2=buffer2 + '</div>';
				$('#div_lsite').html(buffer2);
				$('#div_lsite').trigger('create');
				// Ajout des choix de valorisation uniquement pour PE plan epandge
				afficher_modif_valorisation();
			}
		})
	}
	function afficher_modif_valorisation(){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'liste_valor'
			},
			
			
		
			success : function(data){	
				buffer='<div data-role="fieldcontain" id="a">';
				buffer=buffer + '<fieldset data-role="controlgroup"  data-inset="true" data-mini="true" id="f1">';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					buffer=buffer + '<input type="radio" name="radio-view" id="radio-view-' + tmp[0] + '" value="' + tmp[0] + '">';
				buffer=buffer + '<label for="radio-view-' + tmp[0] + '">' + tmp[1] + '</label>';
										}
				buffer=buffer + '</fieldset>';
				buffer=buffer + '</div>';
				buffer=buffer + '<a href="" id="d" data-role="button"  data-theme="f">Valider</a>';
				$('#div_choix').html(buffer);
				$('#div_choix').trigger('create');				
				$('#d').click(function(){
					ajouter_valorisation();
										});
				}
				})
	}
	function enregister_identifiant(producteur)
	{
		localStorage.idexploitationvalo=producteur;
	}
	function ajouter_valorisation()
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			async: false,
			data: {
				action : 'enregistrer_valorisation',
				idexploitation : localStorage.idexploitationvalo,
				idtypevalorisation : $('input[type=radio][name=radio-view]:checked').attr('value')
			},
			success : function(data){
			
			}
		});
	}
	</script>

</body>
</html>