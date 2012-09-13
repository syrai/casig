<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">	
	<link rel="stylesheet" href="http://sd-22074.dedibox.fr/casig/gamp/css/section_mobile.css" type="text/css" media="screen">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>

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
                    url: "changementmillesime.php",
                    cache: false,
                    data: formData,
                    success: onSuccess,
                    error: onError
                });
 
                return false;
            });
        });
    </script>
<div data-role="page" id="callAjaxPage">
	
	<div class="home_tagline">Fixer le millésime courant</div>
	<div data-role="content">
						<form class="login_form" id="callAjaxForm" >			
							<input class="wrapped_input login_email" type="text" name="millesime" id="millesime" value="" placeholder="millesime" />							
							<div class="cta_button_wrapper">
								<h3 id="notification"></h3>
								<input class="button login_submit" type="submit" value="Fixer le millésime" name="login_submit" />
							</div>
							<input type="hidden" name="__login" value="Login" />
						</form>
				</div>
			</div>
	</div><!-- content -->
</div><!-- Page -->
</body>
</html>