<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Factures</title>
	<?php
  include_once("../connexion/version_jq.php");
	?>

</head>
<body>	
<?php
	include_once("./inc_facture/header_facture.inc.php");
?>
<div data-role="content">
<div id="mil" data-role="content-secondary">

</div>
<div id="div_choix_option" data-role="content-secondary">
	
</div>
<div id="div_resultat" data-role="content-primary">
	
</div>
</div>
<script type="text/javascript">
chercher_millesime();
afficher_options();

chercher_millesime();
function chercher_millesime(){
	$.ajax({
  type: 'POST',
  url: 'ajax_facture.php',
  data: {
    action: 'cocher_millesime'
  },
  success : function(data){
  	var obj = jQuery.parseJSON(data);
    var row = obj[0];
  	buffer='<h4>Millésime courant : '+ row[1] + '</h4>';
  	$('#mil').html(buffer);
	$('#mil').trigger('create');
  }
  });
}
function afficher_options(){
	$.ajax({
		type: 'POST',
		url: 'ajax_facture.php',
			data: {
			action: 'liste_statut'
		},
		success : function(data){
		
			buffer= '<ul data-role="listview" data-theme="c" data-inset="true" data-dividertheme="f" >';
			buffer=buffer + '<li data-role="list-divider">Choix du statut</li>';
			var obj = jQuery.parseJSON(data);
			for(i=0;i<obj.length;i++){
				var tmp=obj[i];
				buffer=buffer + '<li><a href="#" data-inline="true" onclick="afficher_liste_facture(' + tmp[0] + ')" >' + tmp[1] + '</a></li>';
				
										}
			buffer=buffer + '</ul>';
		
			$('#div_choix_option').html(buffer);
			$('#div_choix_option').trigger('create');	
			
			}
		});
}
function afficher_liste_facture(idstatut)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_facture.php',
			datatype: 'json',
			data: {
				action : 'info_facture_statut',
				idstatut : idstatut
			},
			success : function(data){
				
				
				buffer2= '<h4>Listes des factures : </h4>';
				buffer2=buffer2 + '<ul data-role="listview" data-filter="true" data-inset="true" data-autodividers="true" data-mini="true"data-filter-placeholder="Chercher un abonne..." data-filter-theme="d" data-theme="d" data-dividertheme="f"  data-mini="true" >';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
				var tmp=obj[i];
				buffer2=buffer2 + '<li><a href="mf.php?idtfacturation=' + tmp[0] + '"  rel="external" data-mini="true" </a>' + tmp[1] + ' ('+ tmp[2] + ', ' + tmp[3] + ')</li>';
				}
				buffer2=buffer2 + '</ul>';
				
				$('#div_resultat').html(buffer2);
				$('#div_resultat').trigger('create');
			
			},
			error : function(data){
				alert ('Pas de données!');
			}
		});
	}


</script>
<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>	
</body>
</html>