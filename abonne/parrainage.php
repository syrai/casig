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
  			afficher_modif_valorisation(localStorage.idexplopt);
   // On ajout la liste des factures disponibles
	function afficher_modif_valorisation(abonnen){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'liste_campagne_avec_facture',
				abonne : abonnen
			},

			success : function(data){	
				buffer='<input type="text" name="camp" id="camp" placeholder="Exploitation parrainée" value=""  />';
				buffer=buffer + '<a href="" id="supp_facture" name="supp_facture" data-role="button"  data-theme="f" onclick="ajouter_le_parrainage()">Nouveau parrainage</a>';
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
				
				$('#div_choix').html(buffer);
				$('#div_choix').trigger('create');	
				},
				
			error : function(data){
				$('#div_choix').html(buffer);
				$('#div_choix').trigger('create');
								}
				});
	}
	
	

	function ajouter_le_parrainage()
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			async: false,
			data: {
				action : 'ajouter_par_abonne',
				abonne_ajout : localStorage.idexplopt,
				campa : $('#camp').val(),
				idfacture : $('input[type=radio][name=radio-view]:checked').attr('value')
			},
			success : function(data){
			
			}
		});
	}
	</script>

</body>
</html>