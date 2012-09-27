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
<h1>Bilan détail</h1>
<a href="./bilan.php" rel="external" data-icon="back" data-iconpos="notext" data-transition="fade" >Précédent</a>
</div>	
<div id="detail">	
</div>
<script type="text/javascript">
localStorage.idtypeabonnement=getUrlParameter('idtypeabonnement')
afficher_detail(localStorage.idtypeabonnement);
function afficher_detail(idtypeabonnement){
  $.ajax({
  type: 'POST',
  url: 'ajax_a.php',
  data: {
    action: 'afficher_detail',
    idtypeabonnement: idtypeabonnement
  },
  success : function(data){
   
  buffer='<ul data-role="listview" data-theme="d" data-inset="false" data-mini="true">';
    var obj = jQuery.parseJSON(data);
    for(i=0;i<obj.length;i++){
    	var tmp=obj[i];
      buffer=buffer + '<li>' + tmp[0] + '/li>';      
          }
          
     buffer=buffer + '</ul>';
      $('#detail').html(buffer);
  $('#detail').trigger('create');	
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
<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>
</body>
</html>