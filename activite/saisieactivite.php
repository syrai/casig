<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Activité</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<link rel="stylesheet" href="../css/jqm-docs.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>

</head>
<body>	

<div data-role="header" data-theme="f">
			<h1>Saisie des activités</h1>
<a href="./rendu.php" rel="external" data-icon="back" data-iconpos="notext" data-transition="flip" ></a>

</div>
<div id="a"  data-role="content">
<div data-role="fieldcontain">
<input type="date" name="date" id="date" value="" />
<input type="range" name="slider-fill" id="slider-fill" value="0" min="0" max="8" data-highlight="true" />
</div>
</div>
<div id="div_activite" data-role="content">

</div>


<script type="text/javascript">
	
    afficher_liste_activite();
    function afficher_liste_activite(){
		$.ajax({
			type: 'POST',
			url: 'ajax_activite.php',
			data: {
				action: 'liste_activite'
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
				buffer=buffer + '<a href="" id="d" data-role="button"  data-theme="f">Ajouter</a>';
				$('#div_activite').html(buffer);
				$('#div_activite').trigger('create');				
				$('#d').click(function(){
					ajouter_une_activite();
										});
				}
				})
	}
function ajouter_une_activite()
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_activite.php',
			datatype: 'json',
			data: {
				action : 'ajouter_activite',
				idtypeactivite : $('input[type=radio][name=radio-view]:checked').attr('value'),
				datejour : $('#date').val(),
				temps : $('#slider-fill').val()
			},
			success : function(data){
			}
		});
	}

	</script>

</body>
</html>