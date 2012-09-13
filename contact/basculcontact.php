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

	<tr><td><select name="abonnement" id="abonnement" data_inline="true" data-native-menu="false">
			<option>Abonnement...</option>
				<?php
include_once("../connexion/connex.inc.php");

$idcom=connex("SIA","myparam");
$requete="SELECT idtypeabonnement,libelle || '(' || tarif || ')' as libelle FROM ttypeabonnement WHERE idregroupement='1' ORDER by libelle desc";
$result=pg_query($idcom,$requete);
while($ligne=pg_fetch_array($result))
{

echo "<option value=\"".$ligne['idtypeabonnement']."\">".$ligne['libelle']."</option>";	
	
}
pg_free_result($result);
?>
</select></td></tr>
<tr><td>
<select name="mois" id="mois" data-native-menu="false">
<option>Mois de ...</option>
<?php
include_once("../connexion/connex.inc.php");
$idcom=connex("SIA","myparam");
$requete="SELECT idmois ,mois as libelle FROM tmois ORDER by idmois";
$result=pg_query($idcom,$requete);
while($ligne=pg_fetch_array($result))
{

echo "<OPTION VALUE=\"".$ligne['idmois']."\">".$ligne['libelle']."</OPTION>";	
	
}
pg_free_result($result);
?>
</select></td></tr>
<tr><td>
<select name="campagne" id="campagne" data-native-menu="false">
<option>Mois de ...</option>
<?php
include_once("../connexion/connex.inc.php");
$idcom=connex("SIA","myparam");
$requete="SELECT millesime ,millesime as libelle FROM tmillesime WHERE millesime >= (SELECT millesime FROM tmillesime WHERE courant=1) ORDER by id_millesime";
$result=pg_query($idcom,$requete);
while($ligne=pg_fetch_array($result))
{

echo "<OPTION VALUE=\"".$ligne['millesime']."\">".$ligne['millesime']."</OPTION>";	
	
}
pg_free_result($result);
?>
</select></td></tr>

<tr><td><input type="submit" id="valide_ajout_abonne" name="valide_ajout_abonne" value="Créer"></td></tr>
</table>
</div>
<script type="text/javascript">
$(document).bind('mobileinit',function(){
   $.mobile.selectmenu.prototype.options.nativeMenu = true;
});
// Définit l'evenement
		$('#valide_ajout_abonne').click(function(){
			afficher_resultat_recherche();
		});
function afficher_resultat_recherche(){
		$.ajax({
			type: 'POST',
			url: 'ajax_ajcontact.php',
			data: {
				action: 'ajouter_abonne',
				idmois : $('select#mois').val(),
				idtypeabonnement : $('select#abonnement').val(),
				abo : getUrlParameter('idcontact'),
				camp : $('select#campagne').val()
				
			},
			success : function(data){
				$.mobile.changePage( "conscontact.php", { transition: "slideup"} );
			}
		})
	}
function getUrlParameter(name) {
 
    var searchString = location.search.substring(1).split('&');
 
    for (var i = 0; i < searchString.length; i++) {
 
        var parameter = searchString[i].split('=');
        
        if(name == parameter[0])    return parameter[1].replace('%20',' ');
 
    }
 
    return false;
}
</script>
</div>
</body>
</html>