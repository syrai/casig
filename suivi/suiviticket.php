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
<h1>Suivi MesParcelles</h1>
<a href="./ticket.php" rel="external" data-icon="back" data-iconpos="notext" data-transition="fade" >Home</a>
<a href="./ajsuiviticket.php" rel="external" data-role="button"  data-rel="dialog" data-icon="plus" data-iconpos="notext" data-transition="flip" >Ajouter</a>
</div>

<div id="liste">

</div>
<div data-role="controlgroup" data-type="horizontal" data-mini="true">
<a href="" id="d" data-role="button" rel="external" data-rel="back"   data-theme="d" onclick="supprimer_ticket()">Supprimer</a>
<a href="" id="d2" data-role="button" rel="external" data-rel="back"  data-theme="e" onclick="fermer_ticket()">Fermer</a>
<a href="" id="d32" data-role="button" rel="external" data-rel="back"  data-theme="f" onclick="reouvrir_ticket()">Réouvrir</a>
</div>

<script type="text/javascript">
// Stockage en base de l'identifiant abonnement
localStorage.idticket=getUrlParameter('idticket')
afficher_suiviticket();
function afficher_suiviticket(){
  $.ajax({
  type: 'POST',
  url: 'ajax_suivi.php',
  data: {
    action: 'liste_suivi_n_ti',
    idticket: localStorage.idticket
  },
  success : function(data){
   
  buffer='<ul data-role="listview" data-split-icon="delete" data-split-theme="c" data-mini="true">';
    var obj = jQuery.parseJSON(data);
    for(i=0;i<obj.length;i++){
    var tmp=obj[i];
      buffer=buffer + '<li>';
      buffer=buffer + '<a href="">';
      buffer=buffer + '<h3>' + tmp[0] + '</h3>';
      buffer=buffer + '</a>';
      buffer=buffer + '<a href="./suiviticket.php?idticket=localStorage.idticket"  rel="external" onclick="supprimer_suiviticket('+ tmp[2] + ')"></a>';
      buffer=buffer + '</li>'; 
          }
          
     buffer=buffer + '</ul>';
     $('#liste').html(buffer);
 	 $('#liste').trigger('create');	
  }
  });
  
}
function supprimer_ticket(){
		$.ajax({
			type: 'POST',
			url: 'ajax_suivi.php',
			data: {
				action: 'supp_suiviticket',
				idticket : localStorage.idticket
					},
			success : function(data){		
				}
				});
	}
function fermer_ticket(){
		$.ajax({
			type: 'POST',
			url: 'ajax_suivi.php',
			data: {
				action: 'statut_ticket',
				idticket : localStorage.idticket,
				idstatutticket : 2
					},
			success : function(data){		
				}
				});
	}
function reouvrir_ticket(){
		$.ajax({
			type: 'POST',
			url: 'ajax_suivi.php',
			data: {
				action: 'statut_ticket',
				idticket : localStorage.idticket,
				idstatutticket : 1
					},
			success : function(data){		
				}
				});
	}	
function supprimer_suiviticket(idticketsuivi){
		$.ajax({
			type: 'POST',
			url: 'ajax_suivi.php',
			data: {
				action: 'supp_suiviticket2',
				idticketsuivi : idticketsuivi
					},
			success : function(data){		
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
</script>
	<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>
</body>
</html>