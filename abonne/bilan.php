<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Bilan</title>
  <?php
  include_once("../connexion/version_jq.php");
	?>
</head>
<body>
<div data-role="header" data-theme="e" data-position="fixed">
<h1>Bilan</h1>
<a href="../h.php" rel="external" data-icon="home" data-iconpos="notext" data-transition="fade" >Home</a>
</div>
<div id="liste">
function afficher_bilan()
</div>
<script typep="text/javascript">
afficher_bilan();
function afficher_bilan()
{
  $.ajax({
  type: 'POST',
  url: 'ajax_abonne.php',
  data: {
    action: 'afficher_le_bilan'
  },
  success : function(data){
    buffer='<ul data-role="listview" id="ul_bilan" data-theme="f">';
    var obj = jQuery.parseJSON(data);
    for(i=0;i<obj.length;i++){
    var tmp=obj[i];
      buffer=buffer + '<li>' + tmp[0] + '<span class="ui-li-count">' + tmp[1] + '</span></li>';
          }
      buffer=buffer + '</ul>';
      $('#liste').html(buffer1);
  		$('#liste').trigger('create');	
  }
  })
  
}
</script>
</body>
</html>