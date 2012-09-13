<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
</head>
<body>
<div id="div_lsite2">
<p id="demo"></p>

</div>
<div id="div_lsite">
<audio controls="controls">
  <source src="sleep.mp3" type="audio/mpeg" />
Your browser does not support the audio element.
</audio>
</div>
<script type="text/javascript">
var x=document.getElementById("demo");
getLocation();
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition);
    }
  else{x.innerHTML="Geolocation is not supported by this browser.";}
  }
function showPosition(position)
  {
  getCommunes(position.coords.longitude,position.coords.latitude);
  }
 function getCommunes(lo,la)
 {
		$.ajax({
			type: 'POST',
			url: 'ajax_test.php',
			datatype: 'json',
			data: {
				action: 'geocommuneloc',
				x : lo,
				y : la
					},
			success : function(data){
				var obj =jQuery.parseJSON(data);
				var row = obj[0];
				x.innerHTML="<br />Commune de "+ row[0];
			}
		});
	
 }
</script>
</body>
</html>