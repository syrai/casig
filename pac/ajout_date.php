<!DOCTYPE html> 
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>PAC</title> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<link type="text/css" href="http://dev.jtsage.com/cdn/datebox/latest/jquery.mobile.datebox.min.css" rel="stylesheet" /> 
	<link type="text/css" href="http://dev.jtsage.com/cdn/simpledialog/latest/jquery.mobile.simpledialog.min.css" rel="stylesheet" /> 
	<link type="text/css" href="http://dev.jtsage.com/jQM-DateBox/css/demos.css" rel="stylesheet" /> 
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js""></script>
	<script type="text/javascript" src="http://dev.jtsage.com/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jquery.mobile.datebox.js"></script>
	<script type="text/javascript" src="http://dev.jtsage.com/cdn/simpledialog/latest/jquery.mobile.simpledialog.min.js"></script>
	
	<script type="text/javascript" src="http://dev.jtsage.com/gpretty/prettify.js"></script>
	<link type="text/css" href="http://dev.jtsage.com/gpretty/prettify.css" rel="stylesheet" />
</head> 
<body> 
<script>
        function onSuccess(data, status)
        {
            data = $.trim(data);
            $("#notification").text(data);
        }
 
        function onError(data, status)
        {
            // handle an error
        }        
 
        $(document).ready(function() {
            $("#submit").click(function(){
 
                var formData = $("#callAjaxForm").serialize();
 
                $.ajax({
                    type: "POST",
                    url: "ajout_date_ajax.php",
                    cache: false,
                    data: formData,
                    success: onSuccess,
                    error: onError
                });
 
                return false;
            });
        });
    </script>
	<div data-role="page">
		<div data-role="header" data-theme="e">
			<h1>Ajouter</h1>
		</div><!-- /header -->				
		<div data-role="content" data-theme="b">
			<form id="callAjaxForm">
				<div data-role="fieldcontain" >	
					<fieldset>
						<label for="mydate">Choix de la date</label>
						<input name="mydate" id="mydate" type="date" data-role="datebox"	data-options='{"mode": "calbox"}'>		
						<input type="hidden" name="iddspor" id="iddspor" value="<?php echo "".$_GET['iddispor']."" ; ?>"></input>
						<h3 id="notification"></h3>
						<button data-theme="b" id="submit" type="submit">Créer</button>
					</fieldset>
				</div>
			</form>	
		</div>
</div><!-- /page -->
		</body>
		</html>

