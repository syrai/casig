<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Rechercher</title>
	<link rel="stylesheet" href="popup-examples.css" />
	 <?php
	include_once("../connexion/version_jq.php");
	?>	
</head>
<body>	
	<div data-role="header" data-theme="e" data-position="fixed">
<h1>Abonnés</h1>
<a href="../h.php" rel="external" data-icon="home" data-iconpos="notext" data-transition="fade" >Home</a>
<a href="#popupPanel" data-rel="popup" data-transition="slide" data-position-to="window" data-icon="gear" data-iconpos="notext" data-role="button" >Menu</a>

</div>
<div data-role="page=" id="consabo">

<div id="div_producteur" data-role="content">
	<input type="search" id="valide_recherche" name="valide_recherche" placeholder="Nom exploitation..." value="" onchange="afficher_abonne()"/>				
<div data-role="popup" id="popupPanel" data-corners="false" data-theme="e" data-shadow="false" data-tolerance="0,0">

    <ul>
       <li><a href="consabonne.php" rel="external" data-icon="search" data-role="button">Recherche</a></li>
       <li><a href="ajcontact.php" rel="external" data-icon="plus" data-role="button">Nouveau</a></li>
       <li><a href="ajoutvalor.php" rel="external" data-icon="plus" data-role="button">Valorisation</a></li>
		<li><a href="../facture/consfacture.php" rel="external" data-icon="grid" data-role="button">Facturation</a></li>
		<li><a href="../formation/consformation.php" rel="external" data-icon="info" data-role="button">Formation</a></li>
      </ul>
   
</div>
</div>
<div id="div_liste" data-role="content">

</div>
	<script type="text/javascript">
	$( "#popupPanel" ).on({
    popupbeforeposition: function() {
        var h = $( window ).height();

        $( "#popupPanel" ).css( "height", h );
    }
});
	function afficher_abonne(){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'liste_abonne2',
				raisonsociale : $('#valide_recherche').val()
					},
			success : function(data){	
				buffer1='<ul data-role="listview" id="listView" data-filter="true" data-autodividers="true" data-inset="true" data-mini="true" data-filter-placeholder="Chercher un abonne..." data-filter-theme="d" data-theme="d" data-divider-theme="e">';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					buffer1=buffer1 + '<li>';
					buffer1=buffer1 + '<a href="./ficheabonnes.php?idexploitation='+ tmp[0] + '" id="vers" rel="external" data-inset="true" data-mini="true" data-icon="star">' + tmp[1] + '</a>';
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