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
				localStorage.idexploitation=getUrlParameter('idexploitation')
				var obj =jQuery.parseJSON(data);
				var row = obj[0];	
				
					buffer='<h3>Modifier ' + row[1] + '</h3>';
					buffer=buffer + '<table class="table"><tr>';
					buffer=buffer + '<th>Nom exploitation :</th><td><input type="text" name="username" id="username" value="' + row[1] + '" /></td><td><a href="" data-role="button" data-icon="refresh" data-theme="f" data-iconpos="notext" onclick="modif_rs()"></a></td></tr>';
					buffer=buffer + '<tr><th>Nom contact :</th><td><input type="text" name="nom" id="nom" value="' + row[2] + '" /></td><td><a href="" data-role="button" data-icon="refresh" data-theme="f" data-iconpos="notext" onclick="modif_nom()"></a></td></tr>';
					buffer=buffer + '<tr><th>Adresse :</th><td><input type="text" name="adresse" id="adresse" value="' + row[5] + '" /></td></tr>';
					buffer=buffer + '<tr><th>Tél :</th><td><input type="tel" name="tel" id="tel" value="' + row[3] + '" /></td><td><a href="" data-role="button" data-icon="refresh" data-theme="f" data-iconpos="notext" onclick="modif_tel()"></a></td></tr>';
					buffer=buffer + '<tr><th>Mail:</th><td><input type="email" name="email" id="email" value="' + row[4] + '" /></td><td><a href="" data-role="button" data-icon="refresh" data-theme="f" data-iconpos="notext" onclick="modif_mail()"></a></td></tr>';
					buffer=buffer + '<tr><th>Identifiant :</th><td><input type="text" name="identifiant" id="identifiant" value="" /></td><td><a href="" data-role="button" data-icon="refresh" data-theme="f" data-iconpos="notext" onclick="modif_login()"></a></td></tr>';
					buffer=buffer + '<tr><th>PassWord :</th><td><input type="text" name="passe" id="passe" value="" /></td><td><a href="" data-role="button" data-icon="refresh" data-theme="f" data-iconpos="notext" onclick="modif_passe()"></a></td></tr>';
					buffer=buffer + '</table>';
					//buffer=buffer + '<a href="" id="d" data-role="button"  data-inline="true" data-theme="e">Mettre à jour</a>';
				
				$('#div_producteur').html(buffer);
				$('#div_producteur').trigger('create');
			$('#d').click(function(){
					modification_abonne(getUrlParameter('idexploitation'));
										});
			}
		});
	}
	// Changer le tel
	function modif_tel(idexploitation){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'modif_telephone',
				tel : $('#tel').val(),
				idexploitation : localStorage.idexploitation
			},
			success : function(data,text){	
				alert('Numéro de téléphone à jour !');
			}
		})
	}
	// Changer le mail
	function modif_mail(idexploitation){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'modif_mail',
				mailto : $('#email').val(),
				idexploitation : localStorage.idexploitation
			},
			success : function(data,text){	
				alert('Email mis à jour !');
			}
		})
	}
	// Changer la raison social
	function modif_rs(idexploitation){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'modif_rs',
				raisonsocial : $('#username').val(),
				idexploitation : localStorage.idexploitation
			},
			success : function(data,text){	
				alert('Raison social mis à jour !');
			}
		})
	}
	// Changer le nom
	function modif_nom(idexploitation){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'modif_nom',
				nom : $('#nom').val(),
				idexploitation : localStorage.idexploitation
			},
			success : function(data,text){	
				alert('Nom mis à jour !');
			}
		})
	}
		// Changer le login
	function modif_login(idexploitation){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'modif_identifiant',
				login : $('#identifiant').val(),
				idexploitation : localStorage.idexploitation
			},
			success : function(data,text){	
				alert('Identifiant mis à jour !');
			}
		})
	}
	function modif_passe(idexploitation){
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			data: {
				action: 'modif_passe',
				passe : $('#passe').val(),
				idexploitation : localStorage.idexploitation
			},
			success : function(data,text){	
				alert('Mot de passe mis à jour !');
			}
		})
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