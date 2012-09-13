<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<link rel="shortcut icon" href="../img/mobile/favicon.png" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>




<script type="text/javascript">
$(document).ready(function() {
    
    $('#success').hide();

   
$('button').click(function () {

	$.post('topdf.php', $('form').serialize(), function () {
		$('div#wrapper').fadeOut( function () {

        $('#success').show();

		});
	});
	return false;
});
});





</script>



<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>test pdf</title>

</head>
<body>
<div id="main" align="center">
<div id="success"><p> Please <a href="result.pdf">download </a> your results in PDF Version . </p></div>
<div id="wrapper">

<form action="testopdf.php"  method="post">
<fieldset>
<div class="submit">
        <input type="hidden" value="submitted" />
	<button type="submit">Submit</button>
    </div>
	
</fieldset>
</form>

</div>
</div>



</body>
</html>
