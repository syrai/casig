
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GAMP</title>
	<link rel="apple-touch-icon"  href="http://sd-22074.dedibox.fr/casig/gamp/img/mobile/generic_background.png">
	<link rel="stylesheet"  href="//code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
	<link rel="stylesheet" href="./css/jqm-docs.css" />
	<link rel="shortcut icon" href="./img/mobile/favicon.png" />
	<script src="//code.jquery.com/jquery-1.7.2.min.js"></script>
	<script src="./js/jqm-docs.js"></script>
	<script src="//code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
	
</head>
<body>
<div data-role="page" class="type-home">
	<div data-role="content">
	<p id="jqm-version">1.1.0 Final Release</p>
	<div class="content-secondary">
<div id="jqm-homeheader">
				<h1 id="jqm-logo"><img src="./img/mobile/generic_background.png" /></h1>
				<p>Gestion des Abonnés MesParcelles.</p>
			</div>
</div>

		<div class="content-primary" id="pri">

			


		

		</div><!--/content-primary-->
		</div>
		<script type="text/javascript">
		afficher_menu(localStorage.iduti);
function afficher_menu(idutilisateur){
		$.ajax({
			type: 'POST',
			url: 'authen_ajax.php',
			data: {
				action: 'droit',
				idutilisateur : idutilisateur
					},
			success : function(data){	
				buffer1='<p class="intro"><strong>Bienvenue.</strong> Version 1.0.0 en développement pour un outil de gestion des abonnés à MesParcelles </p>';
				buffer1=buffer1 + '<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="f">';
				buffer1=buffer1 + '<li data-role="list-divider">Menu</li>';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					
					buffer1=buffer1 + '<li><a href="'+ tmp[1] + '"  rel="external" >' + tmp[0] + '</a></li>';												
					}
				buffer1=buffer1 + '</ul>';
				$('#pri').html(buffer1);
				$('#pri').trigger('create');
				}
				});
	}
</script>

		<div data-role="footer" class="footer-docs" data-theme="f">
		<p>&copy; 2011-12 Chambre Agriculture 54</p>
		</div>
</div>

</body>
</html>
