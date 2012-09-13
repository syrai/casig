<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Rechercher</title>
	<link rel="shortcut icon" href="../img/mobile/favicon.png" />
	
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
	 
</head>
<body>	
	<?php
	include_once("./inc_abonne/header_abonne.inc.php");
	?>	
<div data-role="page=" id="consabo">

<div id="div_producteur" data-role="content">
	<input type="search" id="valide_recherche" name="valide_recherche" placeholder="Nom exploitation..." value="" onchange="afficher_abonne()"/>
	
</div>
<div id="div_liste" data-role="content">

</div>
	<script type="text/javascript">
	function afficher_abonne(){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'liste_abonne2',
				raisonsociale : $('#valide_recherche').val()
					},
			success : function(data){	
				buffer1='<ul data-role="listview" id="listView" data-filter="true" data-inset="true" data-mini="true" data-filter-placeholder="Chercher un abonne..." data-filter-theme="d" data-theme="d" data-divider-theme="e">';
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