<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Fiche</title>
	<?php
	include_once("../connexion/version_jq.php");
	?>
<link rel="stylesheet" href="../css/cda_1_a.css">

</head>
<body>	
	<?php
	include_once("./inc_abonne/header_abonne.inc.php");
	?>	
	<div id="div_producteur" data-role="content">
	
	</div>
	<script type="text/javascript">	
    afficher_fiche_abonne(getUrlParameter('idexploitation'));
	function afficher_fiche_abonne(producteur)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			data: {
				action : 'info_abonne',
				producteur : producteur,

			},
			success : function(data){
				var obj =jQuery.parseJSON(data);
				var row = obj[0];	
				
					buffer='<h3>Modifier ' + row[1] + '</h3>';
					buffer=buffer + '<table class="table"><tr>';
					buffer=buffer + '<th>Nom exploitation :</th><td><input type="text" name="username" id="username" value="' + row[1] + '" /></td></tr>';
					buffer=buffer + '<th>Nom contact :</th><td><input type="text" name="nom" id="nom" value="' + row[2] + '" /></td></tr>';
					buffer=buffer + '<th>Adresse :</th><td><input type="text" name="adresse" id="adresse" value="' + row[5] + '" /></td></tr>';
					buffer=buffer + '<th>Tél :</th><td><input type="tel" name="tel" id="tel" value="' + row[3] + '" /></td></tr>';
					buffer=buffer + '<th>Mail:</th><td><input type="email" name="email" id="email" value="' + row[4] + '" /></td></tr>';
					buffer=buffer + '</table>';
					buffer=buffer + '<a href="" id="d" data-role="button"  data-inline="true" data-theme="e">Mettre à jour</a>';
				
				$('#div_producteur').html(buffer);
				$('#div_producteur').trigger('create');
			$('#d').click(function(){
					modification_abonne(getUrlParameter('idexploitation'));
										});
			}
		});
	}
	function modification_abonne(idexploitation)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			data: {
				action : 'modifier_abonne',
				raisonsocial : $('#username').val(),
				nom : $('#nom').val(),
				tel : $('#tel').val(),
				mailto : $('#email').val(),
				idexploitation : idexploitation
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
<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>	
</body>
</html>