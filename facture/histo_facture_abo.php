<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Factures</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>

</head>
<body>	
<div data-role="header" data-theme="e" data-position="fixed">
<h1>Consultation factures abonné</h1>
<a href="../abonne/ficheabonnes.php?idexploitation=<?php echo "".$_GET['idexploitation']."";?>" rel="external" data-icon="back" data-iconpos="notext" >Retour</a>

</div>
	<div id="div_producteur" data-role="content">
	
	</div>
<script type="text/javascript">
	
    afficher_fiche_abonne(getUrlParameter('idexploitation'));
	function afficher_fiche_abonne(producteur)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_facture.php',
			datatype: 'json',
			data: {
				action : 'liste_facture_abonne',
				producteur : producteur
			},
			success : function(data){
				buffer='<h2>Campagne(s) : </h2>';
				var obj =jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){	
				var tmp = obj[i];	
					buffer=buffer + '<div data-role="collapsible" data_collapsed="true" data-theme="e" data-content-theme="c">';
					buffer=buffer + '<h1>' + tmp[0] + '</h1>';
					buffer=buffer + '<table><tr>';
					buffer=buffer + '<td>Abonnement : </td><td>' + tmp[2] + '</td></tr>';
					buffer=buffer + '<td>Mois :</td><td>' + tmp[3] + '</td></tr>';
					buffer=buffer + '<td>Tarif :</td><td>' + tmp[8] + ' Euros</td></tr>';
					buffer=buffer + '<td>Facture:</td><td>' + tmp[1] + '</td></tr>';					
					buffer=buffer + '<td>Date modification :</td><td>' + tmp[5] + '</td></tr>';
					buffer=buffer + '</table>';
					buffer=buffer + '<div data-role="controlgroup" data-type="horizontal">';
					buffer=buffer + '<a href="modifstatut.php?idtfacturation='+ tmp[7] + '" rel="external" data-role="button" data-rel="dialog" data-transition="pop">Statut</a>';
					buffer=buffer + '<a href="modifabonnement.php?idtfacturation='+ tmp[7] + '&idexploitation=' + getUrlParameter('idexploitation') + '" rel="external" data-role="button"  data-rel="dialog" data-transition="pop">Abonnement</a>';
					buffer=buffer + '<a href="modifmois.php?idtfacturation='+ tmp[7] + '" rel="external" data-role="button"  data-rel="dialog" data-transition="pop">Mois</a>';
					buffer=buffer + '</div>';
				buffer=buffer + '</div>';
				}
				
				$('#div_producteur').html(buffer);
				$('#div_producteur').trigger('create');
			
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
<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>	
</body>
</html>