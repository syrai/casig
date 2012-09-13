<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Nouveau contact</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
</head>
<body>	
	<?php
	include_once("./inc_contact/header_contact.inc.php");
	?>	

	<div id="div_contact" data-role="content">
<div data-role="fieldcontain">
<table>
<tr><td><label for="raison_social">Raison sociale :</label></td><td><input type="text" name="raison_social" id="raison_social"/></td></tr>
<tr><td><label for="personne">Personne :</label></td><td><input type="text" name="personne" id="personne"/></td></tr>
<tr><td><label for="adr">Voie :</label></td><td><input type="text" name="adr" id="adr"/></td></tr>
<tr><td><label for="tel">Tél :</label></td><td><input type="tel" name="tel" id="tel"/></td></tr>
<tr><td><label for="email">Email :</label></td><td><input type="email" name="mailto" id="mailto"/></td></tr>
</table>
	<label for="commune" class="select">Commune :</label>
		<select name="commune" id="commune" data-native-menu="false">
<option>Commune de ?</option>
<?php

include_once("../connexion/connex.inc.php");

$idcom=connex("SIA","myparam");
$requete="SELECT codeinsee,nom as libelle FROM tcommunes WHERE dpt='54' ORDER by nom";
$result=pg_query($idcom,$requete);
while($ligne=pg_fetch_array($result))
{

echo "<option value=\"".$ligne['codeinsee']."\">".$ligne['libelle']."</option>";	
	
}
pg_free_result($result);
?>
</select>

<label for="contact" class="contact">Type de contact :</label>
<select name="contact" id="contact" data-native-menu="false">
<option>Choisissez en un...</option>
<?php
include_once("../connexion/connex.inc.php");
$idcom=connex("SIA","myparam");
$requete="SELECT idtypecontact,libelle FROM ttypecontact ORDER by libelle";
$result=pg_query($idcom,$requete);
while($ligne=pg_fetch_array($result))
{

echo "<OPTION VALUE=\"".$ligne['idtypecontact']."\">".$ligne['libelle']."</OPTION>";	
	
}
pg_free_result($result);
?>
</select>
<input type="submit" id="valide_ajout_contact" name="valide_ajout_contact" value="Ajouter">
<figure>
  <iframe data-src="neon_globe.html" width="958" height="400"></iframe>
  <figcaption>Neon outline globe.</figcaption>
</figure>
</div>
<script type="text/javascript">
$(document).bind('mobileinit',function(){
   $.mobile.selectmenu.prototype.options.nativeMenu = true;
});
// Définit l'evenement
		$('#valide_ajout_contact').click(function(){
			afficher_resultat_recherche();
		});
function afficher_resultat_recherche(){
		$.ajax({
			type: 'POST',
			url: 'ajax_ajcontact.php',
			data: {
				action: 'ajouter_contact',
				raisonsocial : $('#raison_social').val(),
				nom : $('#personne').val(),
				tel : $('#tel').val(),
				mailto : $('#mailto').val(),
				adresse : $('#adr').val(),
				codeinsee : $('select#commune').val(),
				idtypecontact : $('select#contact').val()
			},
			success : function(data){
				$.mobile.changePage( "conscontact.php", { transition: "slideup"} );
			}
		})
	}
</script>
</div>
</body>
</html>