<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Suivi</title>
	<link rel="shortcut icon" href="../img/mobile/favicon.png" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css">
	<link rel="stylesheet" href="../css/jqm-docs.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
	 
</head>
<body>	
<div data-role="header" data-theme="f">
			<h1>Activité abonné</h1>
	</div>
<div data-role="page=" id="newsuivi">
<div id="div_r2" data-role="content">
	

</div>	
<div id="div_r" data-role="content">
	

</div>
<script type="text/javascript">
	afficher_resultat_recherche(localStorage.idexplopt);
	affichage_bt_radio();
	
	function affichage_bt_radio(){
		buffer='<div data-role="fieldcontain" id="r">';
		buffer=buffer + '<fieldset data-role="controlgroup" data-type="horizontal" id="f1" data-inline="true">';
		buffer=buffer + '<input type="radio" name="radio-view" id="radio-view-a" value="Bugs"  />';
		buffer=buffer + '<label for="radio-view-a">Bugs</label>';
		buffer=buffer + '<input type="radio" name="radio-view" id="radio-view-b" value="Info"  />';
		buffer=buffer + '<label for="radio-view-b">Info</label>';
		buffer=buffer + '<input type="radio" name="radio-view" id="radio-view-d" value="Autres"  />';
		buffer=buffer + '<label for="radio-view-d">Autres</label>';
		buffer=buffer + '</fieldset>';
		buffer=buffer + '</div>';
		buffer=buffer + '<fieldset data-role="controlgroup" data-type="horizontal" id="f2">';
		buffer=buffer + '<input type="radio" name="radio-view2" id="radio-view-a2" value="Email"  />';
		buffer=buffer + '<label for="radio-view-a2">Email</label>';
		buffer=buffer + '<input type="radio" name="radio-view2" id="radio-view-b2" value="Téléphone"  />';
		buffer=buffer + '<label for="radio-view-b2">Tél</label>';
		buffer=buffer + '<input type="radio" name="radio-view2" id="radio-view-c2" value="Autres"  />';
		buffer=buffer + '<label for="radio-view-c2">Autres</label>';
		buffer=buffer + '</fieldset>';
		buffer=buffer + '</div>';
		buffer=buffer + '<input type="text" name="name" id="resume" value=""  />';
		buffer=buffer + '<div data-role="fieldcontain">';
		buffer=buffer + '<textarea name="textarea" id="textarea"></textarea>';
		buffer=buffer + '</div>';
		buffer=buffer + '<fieldset data-role="controlgroup" data-type="horizontal" id="f3">';
		buffer=buffer + '<input type="radio" name="radio-view3" id="radio-view-a3" value="oui"  />';
		buffer=buffer + '<label for="radio-view-a3">Oui</label>';
		buffer=buffer + '<input type="radio" name="radio-view3" id="radio-view-b3" value="non"  />';
		buffer=buffer + '<label for="radio-view-b3">Non</label>';
		buffer=buffer + '</fieldset>';
		buffer=buffer + '<a href="" id="d" data-role="button"  data-rel="back" data-theme="f">Ajouter</a>';
		
		$('#div_r2').html(buffer);
		$('#div_r2').trigger('create');
		$('#d').click(function(){
					ajouter_une_activite(localStorage.idexplopt);
										});
				}
	
	//Affichage de la liste déroulante des types d'abonnement
	
	 function afficher_resultat_recherche(ide){
	
		$.ajax({
			type: 'POST',
			url: 'ajax_suivi.php',
			datatype: 'json',
			data: {
				action: 'compte_rendu',
				idexploitation : ide
			},
			success : function(data){
				buffer2='<div data-role="fieldcontain" id="a1">';
				buffer2=buffer2 +'<h3>Activités :</h3>';
				buffer2=buffer2 + '<ul data-role="listview" data-theme="c" data-divider-theme="e" data-inset="true" >';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];					
					buffer2=buffer2 + '<li data-role="list-divider">' + tmp[2] + '<span class="ui-li-count">' + tmp[5] + '</span></li>';
					buffer2=buffer2 + '<li><a href="fichedetailsuivi.php?idsuivi='+ tmp[6] + '"  rel="external" data-rel="dialog" data-transition="pop" >';
					buffer2=buffer2 + '<h3>Date : ' + tmp [4] + '</h3>';
					buffer2=buffer2 + '<p>Description : ' + tmp[3] + '</p>';
					buffer2=buffer2 + '<p>Type  : ' + tmp[0] + ' Origine : ' + tmp[1] + '</p>';
					buffer2=buffer2 + '</a></li>';
				} 
				buffer2=buffer2 + '</ul>';
				buffer2=buffer2 + '</div>';
				$('#div_r').html(buffer2);
				$('#div_r').trigger('create');
			}
		});
	}
	function ajouter_une_activite(idexploitation)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_suivi.php',
			datatype: 'json',
			data: {
				action : 'ajouter_activite',
				type : $('input[type=radio][name=radio-view]:checked').attr('value'),
				origine : $('input[type=radio][name=radio-view2]:checked').attr('value'),
				resume : $('#resume').val(),
				description : $('#textarea').val(),
				rappel :$('input[type=radio][name=radio-view3]:checked').attr('value'),
				idexploitation : idexploitation
			},
			success : function(data){
			}
		});
	}
	</script>
	<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>
</div>
</body>
</html>