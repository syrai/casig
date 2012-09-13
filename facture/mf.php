<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Factures</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<link rel="stylesheet" href="../css/jqm-docs.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>

</head>
<body>	
<div data-role="dialog">
	<div data-role="header" data-theme="f">
			<h1>Choix du statut...</h1>
</div>
	<div id="div_producteur" data-role="content">
	
	</div>
</div>
<script type="text/javascript">
	
    afficher_modif_statut();
    function afficher_modif_statut(){
		$.ajax({
			type: 'POST',
			url: 'ajax_facture.php',
			data: {
				action: 'liste_formation_dispo'
			},
			
			
		
			success : function(data){	
				buffer='<div data-role="fieldcontain" id="a">';
				buffer=buffer + '<fieldset data-role="controlgroup"  data-inset="true" id="f1">';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					buffer=buffer + '<input type="radio" name="radio-view" id="radio-view-' + tmp[0] + '" value="' + tmp[0] + '">';
				buffer=buffer + '<label for="radio-view-' + tmp[0] + '">' + tmp[1] + '</label>';
										}
				buffer=buffer + '</fieldset>';
				buffer=buffer + '</div>';
				buffer=buffer + '<a href="" id="d" data-role="button" data-rel="back" data-theme="f">Valider</a>';
				$('#div_producteur').html(buffer);
				$('#div_producteur').trigger('create');				
				$('#d').click(function(){
					ajouter_participant(getUrlParameter('idtfacturation'));
										});
				}
				})
	}
function ajouter_participant(idtfacturation)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_facture.php',
			datatype: 'json',
			data: {
				action : 'modifier_statut',
				idstatut : $('input[type=radio][name=radio-view]:checked').attr('value'),
				idtfacturation : idtfacturation
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

</body>
</html>