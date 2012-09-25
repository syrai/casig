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
					buffer=buffer + '<ul data-role="listview"  data-split-icon="refresh" data-split-theme="d">';
					buffer=buffer + '<li data-role="fieldcontain">';
					buffer=buffer + '<a href="">';
					buffer=buffer + '<p><label for="username">Exploitation : </label>';
					buffer=buffer + '<input type="text" name="username" id="username" value="' + row[1] + '" /></p></a>';
					buffer=buffer + '<a href="#"  onclick="modif_rs()"></a>';
					buffer=buffer + '</li>';
					buffer=buffer + '<li data-role="fieldcontain">';
					buffer=buffer + '<a href="">';
					buffer=buffer + '<p><label for="nom">Nom : </label>';
					buffer=buffer + '<input type="text" name="nom" id="nom" value="' + row[2] + '" /></p></a>';
					buffer=buffer + '<a href="#"  onclick="modif_nom()"></a>';
					buffer=buffer + '</li>';
					buffer=buffer + '<li data-role="fieldcontain">';
					buffer=buffer + '<a href="">';
					buffer=buffer + '<p><label for="adresse">adresse : </label>';
					buffer=buffer + '<input type="text" name="adresse" id="adresse" value="' + row[5] + '" /></p></a>';
					buffer=buffer + '<a href="#"  onclick="modif_adresse()"></a>';
					buffer=buffer + '</li>';
					buffer=buffer + '<li data-role="fieldcontain">';
					buffer=buffer + '<a href="">';
					buffer=buffer + '<p><label for="tel2">Téléphone : </label>';
					buffer=buffer + '<input type="tel" name="tel2" id="tel2" value="' + row[3] + '" /></p></a>';
					buffer=buffer + '<a href="#"  onclick="modif_tel()"></a>';
					buffer=buffer + '</li>';
					buffer=buffer + '<li data-role="fieldcontain">';
					buffer=buffer + '<a href="">';
					buffer=buffer + '<p><label for="emaily">Email : </label>';
					buffer=buffer + '<input type="text" name="emaily" id="emaily" value="' + row[4] + '" /></p></a>';
					buffer=buffer + '<a href="#"  onclick="modif_mail()"></a>';
					buffer=buffer + '</li>';
					buffer=buffer + '<li data-role="fieldcontain">';
					buffer=buffer + '<a href="">';
					buffer=buffer + '<p><label for="identifiant">Identifiant : </label>';
					buffer=buffer + '<input type="text" name="identifiant" id="identifiant" placeholder="Identifiant..." /></p></a>';
					buffer=buffer + '<a href="#"  onclick="modif_login()"></a>';
					buffer=buffer + '</li>';
					buffer=buffer + '<li data-role="fieldcontain">';
					buffer=buffer + '<a href="">';
					buffer=buffer + '<p><label for="passe">Mot de passe : </label>';
					buffer=buffer + '<input type="text" name="passe" id="passe" placeholder="password..." /></p></a>';
					buffer=buffer + '<a href="#"  onclick="modif_passe()"></a>';
					buffer=buffer + '</li>';
					buffer=buffer + '</ul>';		
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
				tel : $('#tel2').val(),
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
				mailto : $('#emaily').val(),
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