<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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

</div>
<script type="text/javascript">
afficher_bilan();
function afficher_bilan(){
  $.ajax({
  type: 'POST',
  url: 'ajax_a.php',
  data: {
    action: 'afficher',
    millesime: '2013'
  },
  success : function(data){
   
  buffer='<ul data-role="listview" data-theme="d" data-inset="false">';
    var obj = jQuery.parseJSON(data);
    for(i=0;i<obj.length;i++){
    	var tmp=obj[i];
      buffer=buffer + '<li><a href="#">' + tmp[0] + '<span class="ui-li-count">' + tmp[1] + '</span></a></li>';      
          }
          
     buffer=buffer + '</ul>';
      $('#liste').html(buffer);
  $('#liste').trigger('create');	
  }
  });
  
}
</script>
	<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>
</body>
</html>