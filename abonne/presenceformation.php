<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Nouvelle formation</title>
	<link rel="stylesheet" href="popup-examples.css" />
	 <?php
	include_once("../connexion/version_jq.php");
	?>
</head>
<body>	
	<?php
		include_once("./inc_abonne/header_abonne.inc.php");
	?>	

<div id="div_enlever" data-role="content" data-theme="c">
	<input type="submit" id="enleve" name="enleve" value="Enlever de la formation" data-icon="delete" onclick="enlever_participant(getUrlParameter('idexploitation'),getUrlParameter('idcycle'))">
</div>
<div id="div_presence" data-role="content" data-theme="c" >

</div>
<script type="text/javascript">
// Affichage des checkboxes
affichage_jour_1(getUrlParameter('idexploitation'),getUrlParameter('idcycle'));
// Définit l'evenement
			
function enlever_participant(idexploitation,idcyle){
	$.ajax({
			type: 'POST',
			url: 'trait_formation_abonne.php',
			datatype: 'json',
			data: {
				action : 'enlever_participant_formation',
				idcycle : idcycle,
				idexploitation : idexploitation				
			},
			success : function(data){
			}
			});
	}
function affichage_jour_1(idexploitation,idcycle)
	{
		$.ajax({
			type: 'POST',
			url: 'trait_formation_abonne.php',
			datatype: 'json',
			data: {
				action : 'affichage_presence_formation',
				idcycle : idcycle,
				idexploitation : idexploitation
				
			},
			success : function(data){				
				var obj =jQuery.parseJSON(data);
				var row = obj[0];	
				buffer= '<ul data-role="listview"   data-theme="a" data-divider-theme="e">';
				buffer=buffer + '<li data-role="list-divider" >Jour 1</li>'
				buffer=buffer + '<table>'
				if(row[0]!='f') {
				buffer=buffer + '<tr><td><input type="checkbox" data-theme="e" name="pr1" id="pr1"  checked="checked"/>';
				} else
				{
				buffer=buffer + '<tr><td><input type="checkbox" data-theme="e" name="pr1" id="pr1" "/>';
				}
				buffer=buffer + '<label for="pr1">Présent</label></td></tr>';
				if(row[1]!='f') {
				buffer=buffer + '<tr><td><input type="checkbox"  name="repas1" id="repas1"  checked="checked"/>';
				} else
				{
				buffer=buffer + '<tr><td><input type="checkbox"  name="repas1" id="repas1" />';
				}
				buffer=buffer + '<label for="repas1">Repas pris</label></td></tr>';
				buffer=buffer + '</table>';
				buffer=buffer + '<li data-role="list-divider">Jour 2</li>'
				buffer=buffer + '<table>'
				if(row[2]!='f') {
				buffer=buffer + '<tr><td><input type="checkbox" data-theme="e" name="pr2" id="pr2"  checked="checked"/>';
				} else
				{
				buffer=buffer + '<tr><td><input type="checkbox" data-theme="e" name="pr2" id="pr2" "/>';
				}
				buffer=buffer + '<label for="pr2">Présent</label></td></tr>';
				if(row[3]!='f') {
				buffer=buffer + '<tr><td><input type="checkbox"  name="repas2" id="repas2"  checked="checked"/>';
				} else
				{
				buffer=buffer + '<tr><td><input type="checkbox"  name="repas2" id="repas2" />';
				}
				buffer=buffer + '<label for="repas2">Repas pris</label></td></tr>';
				buffer=buffer + '</table>';			
				buffer=buffer + '</ul>';
			
				
				$('#div_presence').html(buffer);
				$('#div_presence').trigger('create');
			$('#enleve').click(function(){
			enlever_participant(getUrlParameter('idexploitation'),getUrlParameter('idcycle'));
			});
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