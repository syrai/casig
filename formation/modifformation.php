<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Modif formation</title>
	<link rel="stylesheet" href="popup-examples.css" />
	 <?php
	include_once("../connexion/version_jq.php");
	?>
</head>
<body>	
	<?php
	include_once("./inc_formation/header_formation.inc.php");
	?>	

<div id="div_formation" data-role="content">
<table>
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
</select></td><td><a href="#" data-role="button" data-icon="refresh" data-iconpos="notext" onclick="modif_lieu()">Delete</a></td></tr>
<tr><td><label for="date1">Début :</label></td><td><input type="date" name="date1" id="date1"/></td><td><a href="" data-role="button" data-icon="refresh" data-iconpos="notext" onclick="modif_date1()">Delete</a></td></tr>
<tr><td><label for="date2">Fin :</label></td><td><input type="date" name="date2" id="date2"/></td><td><a href="#" data-role="button" data-icon="refresh" data-iconpos="notext" onclick="modif_date2()">Delete</a></td></tr>
</table>


</div>
<script type="text/javascript">

// Changer le lieu d'une formation
function modif_lieu(){
		$.ajax({
			type: 'POST',
			url: 'ajax_formation.php',
			data: {
				action: 'changerlieu',
				idcycle: localStorage.idcycle,
				lieuformation : $('select#lieuformation').val()
			},
			success : function(data,text){	
			}
		})
	}
// Changer la date de début d'une formation
	function modif_date1(){
		$.ajax({
			type: 'POST',
			url: 'ajax_formation.php',
			data: {
				action: 'changerdate1',
				idcycle: localStorage.idcycle,
				date1 : $('#date1').val()
			},
			success : function(data,text){	
			}
		})
	}
	function modif_date2(){
		$.ajax({
			type: 'POST',
			url: 'ajax_formation.php',
			data: {
				action: 'changerdate2',
				idcycle: localStorage.idcycle,
				date2 : $('#date2').val()
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