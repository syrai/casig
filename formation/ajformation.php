<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Nouvelle formation</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<link rel="stylesheet" href="../css/jqm-docs.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
</head>
<body>	
	<?php
	include_once("./inc_formation/header_formation.inc.php");
	?>	

<div id="div_formation" data-role="content">
<table>
<tr><td >Type de Formation : </td><td><select name="typeformation" id="typeformation" data-native-menu="false" data-mini="true" >
<option>Formation...</option>
<?php
include_once("../connexion/connex.inc.php");

$idcom=connex("SIA","myparam");
$requete="SELECT idtypedeformation,libelle FROM ttypeformation";
$result=pg_query($idcom,$requete);
while($ligne=pg_fetch_array($result))
{

echo "<option value=\"".$ligne['idtypedeformation']."\">".$ligne['libelle']."</option>";	
	
}
pg_free_result($result);
?>
</select></td></tr>
<tr><td>Lieu : </td><td><select name="lieuformation" id="lieuformation" data-native-menu="false" data-mini="true">
<option>Lieu...</option>
<?php
include_once("../connexion/connex.inc.php");

$idcom=connex("SIA","myparam");
$requete="SELECT idlieuformation,libelle FROM tlieuformation";
$result=pg_query($idcom,$requete);
while($ligne=pg_fetch_array($result))
{

echo "<option value=\"".$ligne['libelle']."\">".$ligne['libelle']."</option>";	
	
}
pg_free_result($result);
?>
</select></td></tr>
<tr><td><label for="date1">Début :</label></td><td><input type="date" name="date1" id="date1"/></td></tr>
<tr><td><label for="date2">Fin :</label></td><td><input type="date" name="date2" id="date2"/></td></tr>
</table>
<input type="submit" id="valide_ajout_formation" name="valide_ajout_formation" value="Ajouter">

</div>
<script type="text/javascript">

// Définit l'evenement
		$('#valide_ajout_formation').click(function(){
			afficher_resultat_recherche();
		});
function afficher_resultat_recherche(){
		$.ajax({
			type: 'POST',
			url: 'ajax_formation.php',
			data: {
				action: 'ajouter_formation',
				date1 : $('#date1').val(),
				date2 : $('#date2').val(),
				typeformation : $('select#typeformation').val(),
				lieuformation : $('select#lieuformation').val()
			},
			success : function(data,text){	
			}
		})
	}
</script>

<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>	
</body>
</html>