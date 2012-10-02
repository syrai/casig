<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Tickets</title>
  <?php
  include_once("../connexion/version_jq.php");
 ?>
</head>
<body>
<div data-role="header" data-theme="e" data-position="fixed">
<h1>Ajout ticket</h1>
<a href="./ticket.php" rel="external" data-icon="back" data-iconpos="notext" data-transition="fade" >Home</a>
</div>
<div data-role="content">

<div id="liste">
<ul data-role="listview" data-theme="d" data-inset="true">
<li data-role="fieldcontain">
<input type="search" name="exploitation" id="exploitation" value="" placeholder="Nom de exploitation..." data-mini="true" onchange="afficher_abonne()" />
</li>
<li id="div_liste" data-role="fieldcontain">

</li>
<li id="test" data-role="fieldcontain">

</li>
<li data-role="fieldcontain">
<input type="text" name="resume" id="resume" value="" placeholder="Résumé" data-mini="true" />
</li>
<li data-role="fieldcontain">
<textarea name="description" id="description" value="" placeholder="Description" data-mini="true"></textarea>
</li>

<li data-role="fieldcontain">
<button type="submit" data-theme="d" onclick="enregistrer_ticket()">Ajouter</button></div>
</li>
</ul>
</div>
</div>
<script type="text/javascript">
afficher_suiviticket();
function afficher_suiviticket(){
  $.ajax({
  type: 'POST',
  url: 'ajax_suivi.php',
  data: {
    action: 'affiche_type_ticket'
  },
  success : function(data){  
  	buffer2='<div data-role="fieldcontain" >';
    buffer2=buffer2 + '<fieldset data-role="controlgroup"  >';
		var obj = jQuery.parseJSON(data);
		for(i=0;i<obj.length;i++){
			var tmp=obj[i];
			buffer2=buffer2 + '<input type="radio" name="ch" id="ch' + tmp[0] + '" value="' + tmp[0] + '" class="custom" />';
			buffer2=buffer2 + '<label for="ch' + tmp[0] + '">' + tmp[1] + ' </label>';
			}
	buffer2=buffer2 + '</fieldset>';
	buffer2=buffer2 + '</div>';
	
		$('#test').html(buffer2);
		$('#test').trigger('create');

  }
  });
}
function afficher_abonne(){
		$.ajax({
			type: 'POST',
			url: 'ajax_suivi.php',
			data: {
				action: 'liste_abonne2',
				raisonsociale : $('#exploitation').val()
					},
			success : function(data){	
				buffer1='<ul data-role="listview" id="listView" data-autodividers="true" data-inset="true" data-mini="true" data-filter-placeholder="Chercher un abonne..." data-filter-theme="d" data-theme="d" data-divider-theme="e">';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					buffer1=buffer1 + '<li>';
					buffer1=buffer1 + '<a href="" id="vers"  data-inset="true" data-mini="true" data-icon="star" onclick="choix_e(' + tmp[0] + ')">' + tmp[1] + '</a>';
					buffer1=buffer1 + '</li>';							
					}
				buffer1=buffer1 + '</ul>';
				$('#div_liste').html(buffer1);
				$('#div_liste').trigger('create');	
					
				}
				});
	}
	
	function choix_e(vlau){
	localStorage.idexploitation_ticket=vlau
	}
	function enregistrer_ticket(){
		$.ajax({
			type: 'POST',
			url: 'ajax_suivi.php',
			data: {
				action: 'nouveau_ticket',
				idexploitation : localStorage.idexploitation_ticket,
				idtypeticket: $('input[type=radio][name=ch]:checked').attr('value'),
				resume: $('#resume').val(),
				description: $('#description').val(),
				idutilisateur : localStorage.iduti
					},
			success : function(data){		
					alert("Ticket crée !");
				}
				});
	}
</script>
<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>
</body>
</html>