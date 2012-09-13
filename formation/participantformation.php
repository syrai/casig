<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Participant</title>
	<link rel="stylesheet" href="./css/jqm-docs.css" />
	<link rel="shortcut icon" href="./img/mobile/favicon.png" />
	<script src="./js/jqm-docs.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0-beta.1/jquery.mobile-1.2.0-beta.1.min.css" />
<script src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.2.0-beta.1/jquery.mobile-1.2.0-beta.1.min.js"></script>

	 
</head>
<body>	
<div data-role="page=" id="consabo">

	<?php
	include_once("./inc_formation/header_formation.inc.php");
	?>	

<div id="div_r" data-role="content-secondary">
	

</div>
<div id="div_producteur" data-role="content-primary">
	

</div>
<div class="content-primary" id="pri">

			<div data-role="popup" id="popupLogin" data-theme="e"  data-rel="back" class="ui-btn-right">
			
				<div style="padding:10px 20px;" >
				  
		          <input type="search" id="valide_recherche" name="valide_recherche" placeholder="Nom exploitation..." value="" onchange="afficher_abonne()"/>
	

		    	  <button type="submit" id="sub2" data-theme="f"  onclick="login()">Ajouter</button>
				</div>
			
</div>
<div id="div_liste" data-role="content">

</div>

</div>
	<script type="text/javascript">
	localStorage.idcycle=getUrlParameter('idcycle');
	affichage_liste_des_participants(localStorage.idcycle);
	
	//Affichage de la liste des participants à la formation
	
	
	function affichage_liste_des_participants(idcycle){
		$.ajax({
			type: 'POST',
			url: 'ajax_formation.php',
			data: {
				action: 'liste_participants_formation',
				idcycle : idcycle
					},
			success : function(data){	
				buffer='<ul data-role="listview" id="v1" data-theme="c" data-divider-theme="e">';
				
				afficher_nom_formation(buffer,idcycle);
				
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					buffer=buffer + '<li><a href="../abonne/presenceformation?idexploitation=' + tmp[1] + '&idcycle=' + tmp[0] + '" rel="external" data-mini="true">';
					buffer=buffer + '<h3>' + tmp [2] + '</h3>';
					buffer=buffer + '<p>' + tmp[3] + '</p>';
					buffer=buffer + '</a></li>';
										}
				buffer=buffer + '</ul>';
				$('#div_producteur').html(buffer);
				$('#div_producteur').trigger('create');	
				buffer1='<a href="excel.php?idcycle=' + idcycle + '" rel="external" data-rel="dialog" data-role="button">Télécharger</a>';
				buffer1=buffer1 + '<a href="modifformation.php" rel="external" data-role="button">Modifier la formation</a>';
				
				$('#div_r').html(buffer1);
				$('#div_r').trigger('create');	
				}
				});
	}

	
	function afficher_abonne(){
		$.ajax({
			type: 'POST',
			url: 'ajax_formation.php',
			data: {
				action: 'liste_abonne2',
				raisonsociale : $('#valide_recherche').val()
					},
			success : function(data){	
				buffer1='<ul data-role="listview" id="listView" data-filter="true" data-autodividers="true" data-inset="true" data-mini="true" data-filter-placeholder="Chercher un abonne..." data-filter-theme="d" data-theme="d" data-divider-theme="e">';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					buffer1=buffer1 + '<li>';
					buffer1=buffer1 + '<a href="./participantformation.php?idexploitation='+ tmp[0] + '" id="vers" rel="dialog" data-inset="true" data-mini="true" data-icon="star">' + tmp[1] + '</a>';
					buffer1=buffer1 + '</li>';							
					}
				buffer1=buffer1 + '</ul>';
				$('#popupLogin').html(buffer1);
				$('#popupLogin').trigger('create');	
					
				}
				});
	}
	
	function afficher_nom_formation(buf,idcycle){
		$.ajax({
			type: 'POST',
			url: 'ajax_formation.php',
			async: false,
			data: {
				action: 'titre_formation',
				idcycle : idcycle
					},
			success : function(data){	
				var obj =jQuery.parseJSON(data);
				var row = obj[0];
				buffer=buf + '<li data-role="list-divider">' + row[1] + ' <span class="ui-li-count">' + row[2] + '</span></li>';
				
				return buffer;	
				
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
</div>
</body>
</html>