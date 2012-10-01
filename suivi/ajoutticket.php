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

</div>

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
    action: 'affiche_type_ticket',
  },
  success : function(data){
  buffer='<ul data-role="listview" data-theme="d" data-inset="true">';
  buffer=buffer + '<li>';
  buffer=buffer + '<label for="exploitation">Qui ? </label>';
  buffer=buffer + '<input type="text" name="exploitation" id="exploitation" value="" placeholder="Nom de exploitation..." data-mini="true" />';
   buffer=buffer + '</li>'; 
  buffer=buffer + '<li>';
  buffer=buffer + '<label for="resume">Sujet : </label>';
  buffer=buffer + '<input type="text" name="resume" id="resume" value="" placeholder="Résumé du ticket..." data-mini="true" />';
   buffer=buffer + '</li>'; 
  buffer=buffer + '<li>';
  buffer=buffer + '<label for="description">Description : </label>';
  buffer=buffer + '<textarea" name="description" id="description" value="" placeholder="Description du ticket..." data-mini="true"></textarea>';
  var obj = jQuery.parseJSON(data);
  for(i=0;i<obj.length;i++){
    var tmp=obj[i];
      buffer=buffer + '<li>';
      buffer=buffer + '<input type="radio" name="ch" id="ch' + tmp[0] + '" value="' + tmp[0] + '" class="custom" onclick="changer_tpac()" />';
	  buffer=buffer + '<label for="ch' + tmp[0] + '">'+ tmp[1] + ' </label>';
      buffer=buffer + '</li>';      
          }
          
     buffer=buffer + '</ul>';
      $('#liste').html(buffer);
 	 $('#liste').trigger('create');	
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