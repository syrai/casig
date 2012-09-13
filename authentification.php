
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GAMP</title>
	<link rel="apple-touch-icon"  href="http://sd-22074.dedibox.fr/casig/gamp/img/mobile/generic_background.png">
	<link rel="stylesheet" href="./css/jqm-docs.css" />
	<link rel="shortcut icon" href="./img/mobile/favicon.png" />
	<script src="./js/jqm-docs.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0-beta.1/jquery.mobile-1.2.0-beta.1.min.css" />
<script src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.2.0-beta.1/jquery.mobile-1.2.0-beta.1.min.js"></script>

	
</head>
<body>
<div data-role="page" class="type-home">
	<div data-role="content">
	<div class="content-secondary">
<div id="jqm-homeheader">
				<h1 id="jqm-logo"><img src="./img/mobile/generic_background.png" /></h1>
				<p>Gestion des Abonnés MesParcelles</p>
			</div>
		
</div>
<div class="content-primary" id ="sec">
		</div>

		<div class="content-primary" id="pri">

				<a href="#popupLogin" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-theme="f">Connexion</a>
			<div data-role="popup" id="popupLogin" data-theme="e"  data-rel="back" class="ui-btn-right">
			
				<div style="padding:10px 20px;" >
				  
		          <label for="un" class="ui-hidden-accessible">Username:</label>
		          <input type="text" name="user" id="un" value="" placeholder="Identifiant" data-theme="c" />

		          <label for="pw" class="ui-hidden-accessible">Password:</label>
		          <input type="password" name="pass" id="pw" value="" placeholder="Mot de passe" data-theme="c" />

		    	  <button type="submit" id="sub2" data-theme="f"  onclick="login()">Connexion</button>
				</div>
			
		
		</div>
		

		

		</div><!--/content-primary-->
		</div>
		<script type="text/javascript">
	
		
	function login(){
		$.ajax({
			type: 'POST',
			url: 'authen_ajax.php',
			datatype: 'json',
			async: false,
			data: {
				action: 'verif_login',
				login : $('#un').val(),
				pass : $('#pw').val()
					},
			success : function(data){	
				var obj =jQuery.parseJSON(data);
				var row = obj[0];
				localStorage.iduti=row[0];
				buffer='<a href="./h.php" data-role="button" data-theme="f" rel="external" >Se connecter</a>';
				$('#sec').html(buffer);
				$('#sec').trigger('create');
			$('#popupLogin').popup("close")
				},
				error : function(data){
					alert('Identification erronée!')
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
