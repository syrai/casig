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
<a href="../h.php" rel="external" data-icon="back" data-iconpos="notext" data-transition="fade" >Home</a>
<a href="./ajoutticket.php" rel="external" data-icon="plus" data-iconpos="notext" data-transition="flip" >Ajouter</a>
</div>
<div data-role="content">
<style type="text/css" media="screen">
			.containing-element .ui-slider-switch { width: 18em;}
</style>
<div id="liste2" class="containing-element"  >
<select name="flipmillesime" id="flipmillesime" data-role="slider">
<option value="1">Tickets fermés</option>
<option value="2">Tickets ouverts</option>
</select>

</div>
<div id="liste">
</div>
</div>
<script type="text/javascript">
afficher_ticket();
function afficher_ticket(){
  $.ajax({
  type: 'POST',
  url: 'ajax_suivi.php',
  data: {
    action: 'liste_suivi_n'
  },
  success : function(data){
  
  buffer='<ul data-role="listview" data-theme="d" data-divider-theme="d" data-inset="true">';
    var obj = jQuery.parseJSON(data);
    for(i=0;i<obj.length;i++){
    	var tmp=obj[i];
    	buffer=buffer + '<li data-role="list-divider">'+ tmp[5] + '<span class="ui-li-count">' + tmp[3] + '</span></li>';
      buffer=buffer + '<li><a href="./suiviticket.php?idticket=' + tmp[1] + '" rel="external">';
      buffer=buffer + '<h3>' + tmp[7] + '</h3>';
      buffer=buffer + '<h4>' + tmp[0] + '</h4>';
      buffer=buffer + '<p>' + tmp[2] + '</p>';
      buffer=buffer + '<p class="ui-li-aside"><strong>' + tmp[4] + ' ' + tmp[8] + '</strong></p>';
      buffer=buffer + '</a></li>';      
          }
          
     buffer=buffer + '</ul>';
      $('#liste').html(buffer);
 	 $('#liste').trigger('create');	
  }
  });
  
}

$('#flipmillesime').change(function(event){
event.stopPropagation();
var mys=$(this);
var show = mys[0].selectedIndex;
 changer_millesime(show);
});

function changer_millesime(dispo){
	$.ajax({
  type: 'POST',
  url: 'ajax_suivi.php',
  data: {
    action: 'liste_suivi_n_slider',
    dispo: dispo
  },
  success : function(data){
  	 buffer='<ul data-role="listview" data-theme="d" data-divider-theme="d" data-inset="true">';
 
    var obj = jQuery.parseJSON(data);
    for(i=0;i<obj.length;i++){
    	var tmp=obj[i];
    	buffer=buffer + '<li data-role="list-divider">'+ tmp[5] + '<span class="ui-li-count">' + tmp[3] + '</span></li>';
      buffer=buffer + '<li><a href="./suiviticket.php?idticket=' + tmp[1] + '" rel="external">';
      buffer=buffer + '<h3>' + tmp[7] + '</h3>';
      buffer=buffer + '<h4>' + tmp[0] + '</h4>';
      buffer=buffer + '<p>' + tmp[2] + '</p>';
      buffer=buffer + '<p class="ui-li-aside"><strong>' + tmp[4] + ' ' + tmp[8] + '</strong></p>';
      buffer=buffer + '</a></li>';      
          }
          
     buffer=buffer + '</ul>';
      $('#liste').html(buffer);
 	 $('#liste').trigger('create');
  }
  });
}


</script>
	<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>
</body>
</html>