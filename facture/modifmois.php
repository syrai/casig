<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Factures</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css">
	<link rel="stylesheet" href="../css/jqm-docs.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>

</head>
<body>	
<div data-role="dialog">
	<div data-role="header" data-theme="f">
			<h1>Choix du Mois...</h1>
	</div>
	<div id="div_producteur" data-role="content">
	<fieldset data-role="controlgroup">
	<input type="radio" name="radio-choice" id="radio-choice-1" value="1" />
     <label for="radio-choice-1">Janvier</label>
     <input type="radio" name="radio-choice" id="radio-choice-2" value="2" />
     <label for="radio-choice-2">Février</label>
     <input type="radio" name="radio-choice" id="radio-choice-3" value="3" />
     <label for="radio-choice-3">Mars</label>
     <input type="radio" name="radio-choice" id="radio-choice-4" value="4" />
     <label for="radio-choice-4">Avril</label>
     <input type="radio" name="radio-choice" id="radio-choice-5" value="5" />
     <label for="radio-choice-5">Mai</label>
     <input type="radio" name="radio-choice" id="radio-choice-6" value="6" />
     <label for="radio-choice-6">Juin</label>
     <input type="radio" name="radio-choice" id="radio-choice-9" value="9" checked="checked" />
     <label for="radio-choice-9">Septembre</label>
     <input type="radio" name="radio-choice" id="radio-choice-10" value="10" />
     <label for="radio-choice-10">Octobre</label>
     <input type="radio" name="radio-choice" id="radio-choice-11" value="11" />
     <label for="radio-choice-11">Novembre</label>
     <input type="radio" name="radio-choice" id="radio-choice-12" value="12" />
     <label for="radio-choice-12">Décembre</label>

	</fieldset>
	<a href="" id="d" data-role="button" data-rel="back" data-theme="f" onclick="changer_mois(getUrlParameter('idtfacturation'))">Valider</a>
	
</div>
<script type="text/javascript">

function changer_mois(idtfacturation)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_facture.php',
			datatype: 'json',
			data: {
				action : 'modifier_mois',
				idtfacturation : idtfacturation,
				idmois : $('input[type=radio][name=radio-choice]:checked').attr('value')
				
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