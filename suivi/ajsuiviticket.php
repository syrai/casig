<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Suivi Ticket</title>
  <?php
  include_once("../connexion/version_jq.php");
 ?>
</head>
<body>
<div data-role="dialog">
	<div data-role="header" data-theme="e" data-position="fixed">
		<h1>Ajout ticket</h1>
	</div>
	<div id="liste">
		<ul data-role="listview" data-theme="d" >
			<li data-role="fieldcontain">
				<textarea name="description" id="description" value="" placeholder="Description" data-mini="true"></textarea>
			</li>
			<li data-role="fieldcontain">
				<a href="" id="d" data-role="button" data-rel="back"  data-theme="d" onclick="enregistrer_suiviticket()">Valider</a>
			</li>
		</ul>
	</div>
	<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
	?>
</div>
<script type="text/javascript">


function enregistrer_suiviticket(){
		$.ajax({
			type: 'POST',
			url: 'ajax_suivi.php',
			data: {
				action: 'nouveau_suiviticket',
				idticket : localStorage.idticket,
				description: $('#description').val(),
				idutilisateur : localStorage.iduti
					},
			success : function(data){		
				}
				});
	}
</script>

</body>
</html>