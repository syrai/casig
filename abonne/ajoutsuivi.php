<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Factures</title>
	<link rel="shortcut icon" href="../img/mobile/favicon.png" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<link rel="stylesheet" href="../css/jqm-docs.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>

</head>
<body>	
<div data-role="dialog">
	<div data-role="header" data-theme="f">
			<h1>Nouvelle note</h1>
</div>
	<div id="div_producteur" data-role="content">
	
	</div>
</div>
<script type="text/javascript">
	
    afficher_modif_statut();
    function afficher_modif_statut(){
	
				buffer='<table>';
				buffer=buffer +'<tr><td width="550px"><input type="text" id="txtsuivi" name="txtsuivi" width="150px" ></td></tr>';
				buffer=buffer + '<tr><td><a href="" id="d" data-role="button"  data-rel="back"  data-theme="f">Ajouter</a></td></tr>';
				buffer=buffer + '</table>';
				$('#div_producteur').html(buffer);
				$('#div_producteur').trigger('create');				
				$('#d').click(function(){
					ajouter_participant(getUrlParameter('idexploitation'),$('#txtsuivi').val());
										});
										
				}
function ajouter_participant(idexploitation,commentaire)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_abonne.php',
			datatype: 'json',
			data: {
				action : 'ajouter_une_note',
				commentaire : commentaire,
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

</body>
</html>