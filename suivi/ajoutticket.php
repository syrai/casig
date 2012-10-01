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
	<div class="content-primary">
<div id="liste">
<ul data-role="listview" data-theme="d" data-inset="true">
<li data-role="fieldcontain">
<label for="exploitation">Qui : </label>
<input type="text" name="exploitation" id="exploitation" value="" placeholder="Nom de exploitation..." data-mini="true" />
</li>
<li data-role="fieldcontain">
<label for="resume">Sujet : </label>
<input type="text" name="resume" id="resume" value="" placeholder="Nom de exploitation..." data-mini="true" />
</li>
<li data-role="fieldcontain">
<label for="description">Description : </label>
<textarea name="description" id="description" value="" placeholder="Description" data-mini="true"></textarea>
</li>
<li id="test" data-role="fieldcontain">

</li>
</ul>
</div>
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
    buffer2=buffer2 + '<h4>Type de suivi</h4>';
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

</script>
<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>
</body>
</html>