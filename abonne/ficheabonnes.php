<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Fiche</title>
	
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
	<script type="text/javascript">
	
	
	localStorage.idexplopt=getUrlParameter('idexploitation')
    afficher_fiche_abonne(getUrlParameter('idexploitation'));
	function afficher_fiche_abonne(producteur)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			data: {
				action : 'info_abonne',
				producteur : producteur,

			},
			success : function(data){
				var obj =jQuery.parseJSON(data);
				var row = obj[0];		
				buffer='<div data-role="collapsible" data_collapsed="true" data-theme="e" data-content-theme="c">';
					buffer=buffer + '<h1>' + row[1] + '</h1>';
					buffer=buffer + '<div class="content-primary" id="cont">';
					buffer=buffer + '<table class="table"><tr>';
					buffer=buffer + '<th>Nom contact :</th><td>' + row[2] + '</td></tr>';
					buffer=buffer + '<th>Adresse :</th><td>' + row[5] + '</td></tr>';
					buffer=buffer + '<th>Tél :</th><td>' + row[3] + '</td></tr>';
					buffer=buffer + '<th>Mail:</th><td>' + row[4] + '</td></tr>';
					buffer=buffer + '</table>';
					buffer=buffer + '</div>';
					buffer=buffer + '<div class="content-secondary" id="abonnemfent">';
					buffer=buffer + '<a href="modifieabonne.php?idexploitation=' + row[0] + '" rel="external" data-inline="true" data-icon="refresh" data-role="button">Modifier contact</a>';
				buffer=buffer + '</div>';
				buffer=buffer + '</div>';
				buffer=buffer + '<div data-role="collapsible" id="div_suivi" data_collapsed="true" data-theme="e" data-content-theme="c">';
					buffer=buffer + '<h1>Abonnement</h1>';	
					buffer=buffer + '<div class="content-primary" id="abonnement">';
					afficher_info_abonnement(getUrlParameter('idexploitation'));
					buffer=buffer + '</div>';
					buffer=buffer + '<div class="content-secondary" id="abonnemfent">';
					buffer=buffer + '<a href="../facture/histo_facture_abo?idexploitation=' + row[0] + '" rel="external" data-inline="true" data-icon="grid" data-role="button">Voir les factures</a>';
					buffer=buffer + '</div>';
				buffer=buffer + '</div>';
				buffer=buffer + '<div data-role="collapsible" data_collapsed="true" data-theme="e" data-content-theme="c">';
					buffer=buffer + '<h1>Abonnement secondaire</h1>';					
					buffer=buffer + '<div class="content-primary" id="abosec">';
					afficher_info_abo_sec(getUrlParameter('idexploitation'));
					buffer=buffer + '</div>';
					buffer=buffer + '<div class="content-secondary" id="abosec2">';
					buffer=buffer + '<a href="ajouteabosec.php?idexploitation=' + row[0] + '"  rel="external" data-icon="plus"  data-role="button" date-inline="true" data-rel="dialog" data-transition="pop">Ajout abonnement</a>'
					buffer=buffer + '</div>';
				buffer=buffer + '</div>';
				buffer=buffer + '<div data-role="collapsible" data_collapsed="true" data-theme="e" data-content-theme="c">';
					buffer=buffer + '<h1>Valorisation</h1>';	
					buffer=buffer + '<div class="content-primary" id="valorisation">';
					afficher_info_valorisation(getUrlParameter('idexploitation'));
					buffer=buffer + '</div>';
				buffer=buffer + '</div>';
				buffer=buffer + '<div data-role="collapsible" data_collapsed="true" data-theme="e" data-content-theme="c">';
					buffer=buffer + '<h1>Options</h1>';
					buffer=buffer + '<a href="ajoutsuivi.php?idexploitation=' + row[0] + '"  rel="external" data-icon="plus" data-role="button" >Ajout suivi</a>'
					
					buffer=buffer + '<a href="ajout_formation.php?idexploitation=' + row[0] +  '" rel="external" data-icon="info" data-role="button">Inscription formation</a>';
					buffer=buffer + '<a href="ajoutvalor.php?idexploitation=' + row[0] + '"  rel="external" data-icon="plus" data-role="button" >Ajout valorisation</a>';
					buffer=buffer + '<a href="parrainage.php"  rel="external" data-icon="alert" data-role="button" >Parrainage</a>';
				
					buffer=buffer + '<a href="opt_abonne.php"  rel="external" data-icon="grid" data-role="button" >Options</a>';
					buffer=buffer + '<a href="../suivi/abticket.php?idexploitation=' + row[0] + '" rel="external" data-icon="arrow-r" data-role="button" >Tickets</a>';
				buffer=buffer + '</div>';
				
				buffer=buffer + '<div data-role="collapsible" data_collapsed="true" data-theme="e" data-content-theme="c">';
					buffer=buffer + '<h1>Suivi</h1>';	
					buffer=buffer + '<div class="content-primary" id="historique">';
					afficher_historique_abonne(getUrlParameter('idexploitation'));
					buffer=buffer + '</div>';
				buffer=buffer + '</div>';
				
				
				$('#div_producteur').html(buffer);
				$('#div_producteur').trigger('create');
			
			}
		});
	}
	function afficher_info_valorisation(idexploitation)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			data: {
				action : 'info_valorisation',
				idexploitation : idexploitation
			},
			success : function(data){
				buffer4='<div data-role="collapsible-set" data-theme="c" data-content-theme="d">';
				
				var obj =jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
				var tmp = obj[i];
					buffer4=buffer4 + '<div data-role="collapsible">';
					buffer4=buffer4 +  '<h3>' + tmp[0] + '</h3>';
					buffer4=buffer4 + '<p><table class="table">';
					buffer4=buffer4 + '<tr><th>Nature : </th><td>' + tmp[1] + '</td></tr>';
					buffer4=buffer4 + '<tr><th>Millésime : </th><td>' + tmp[2] + '</td></tr>';
					buffer4=buffer4 + '<tr><th>Date : </th><td>' + tmp[3] + '</td></tr>';
					buffer4=buffer4 + '</table></p>';
					buffer4=buffer4 + '</div>';
					
				}
				
				buffer4=buffer4 + '</div>';
			
				
				$('#valorisation').html(buffer4);
				$('#valorisation').trigger('create');
			
			}
		});
	}
	function afficher_info_abo_sec(idexploitation)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			data: {
				action : 'info_abonnement_sec',
				idexploitation : idexploitation
			},
			success : function(data){
				buffer3='<div data-role="collapsible-set" data-theme="c" data-content-theme="d">';
				
				var obj =jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
				var tmp = obj[i];
					buffer3=buffer3 + '<div data-role="collapsible">';
					buffer3=buffer3 +  '<h4>' + tmp[0] + '</h4>';
					buffer3=buffer3 + '<p><table class="table">';
					buffer3=buffer3 + '<tr><th>Exploitation : </th><td>' + tmp[0] + '</td></tr>';
					buffer3=buffer3 + '<tr><th>Abonnement : </th><td>' + tmp[1] + '</td></tr>';
					buffer3=buffer3 + '<tr><th>Mois : </th><td>' + tmp[2] + '</td></tr>';
					buffer3=buffer3 + '<tr><th>Statut facture : </th><td>' + tmp[3] + '</td></tr>';
					buffer3=buffer3 + '<tr><th>Tarif : </th><td>' + tmp[4] + '</td></tr>';
					buffer3=buffer3 + '<tr><th>Date de création : </th><td>' + tmp[5] + '</td></tr>';
					buffer3=buffer3 + '<tr><th>Date de modification : </th><td>' + tmp[6] + '</td></tr>';
					buffer3=buffer3 + '</table></p>';
					buffer3=buffer3 + '</div>';
					
				}
				
				buffer3=buffer3 + '</div>';
			
				
				$('#abosec').html(buffer3);
				$('#abosec').trigger('create');
			
			}
		});
	}
	function afficher_info_abonnement(producteur)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			data: {
				action : 'info_abonnement_1',
				producteur : producteur
			},
			success : function(data){
				var obj =jQuery.parseJSON(data);
				var row = obj[0];
					buffer2= '<table class="table"><tr>';
					buffer2=buffer2 + '<th>Abonnement : </th><td>' + row[0] + '</td></tr>';
					buffer2=buffer2 + '<th>Mois : </th><td>' + row[1] + '</td></tr>';
					buffer2=buffer2 + '<th>Statut facture : </th><td>' + row[2] + '</td></tr>';
					buffer2=buffer2 + '<th>Tarif : </th><td>' + row[3] + '</td></tr>';
					buffer2=buffer2 + '</table>';	
			
				
				$('#abonnement').html(buffer2);
				$('#abonnement').trigger('create');
			
			}
		});
	}
	function afficher_historique_abonne(producteur)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			data: {
				action : 'abonne_historique',
				producteur : producteur
			},
			success : function(data){
				buffer3='<ul data-role="listview" data-theme="b" data-divider-theme="d">';
				var obj =jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
				var tmp = obj[i];				
				buffer3=buffer3 + '<li data-role="list-divider">' + tmp[0] + '</li>';			
				buffer3=buffer3 + '<li><p>' + tmp[1] + '</p></li>';
				}
				buffer3=buffer3 + '</ul>';	
			
				
				$('#suivi').html(buffer3);
				$('#suivi').trigger('create');
			
			}
		});
	}
	function afficher_historique_suivi(producteur)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			data: {
				action : 'suivi_historique',
				producteur : producteur
			},
			success : function(data){
				buffer4='<ul data-role="listview" data-theme="g" data-divider-theme="d">';
				var obj =jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
				var tmp = obj[i];				
				buffer4=buffer4 + '<li data-role="list-divider">' + tmp[0] + '</li>';			
				buffer4=buffer4 + '<li><p>' + tmp[1] + '</p></li>';
				}
				buffer4=buffer4 + '</ul>';	
			
				
				$('#historique').html(buffer4);
				$('#historique').trigger('create');
			
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