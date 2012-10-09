<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Options</title>
  <?php
  include_once("../connexion/version_jq.php");
	?>
</head>
<body>
<div data-role="header" data-theme="f" data-position="fixed">
<h1>Millésime</h1>
<a href="../facture/consfacture.php" rel="external" data-icon="back" data-iconpos="notext" data-transition="flip" >Home</a>
</div>
<div id="test">

</div>
<script type="text/javascript">

afficher_millesime();
function afficher_millesime(){
	$.ajax({
  type: 'POST',
  url: 'ajax_options.php',
  data: {
    action: 'afficher_liste_millesime'
  },
  success : function(data){	
	buffer2='<div data-role="fieldcontain" >';
    buffer2=buffer2 + '<fieldset data-role="controlgroup"  >';
    buffer2=buffer2 + '<h4>Millésime</h4>';
		var obj = jQuery.parseJSON(data);
		for(i=0;i<obj.length;i++){
			var tmp=obj[i];
			buffer2=buffer2 + '<input type="radio" name="ch" id="ch' + tmp[0] + '" value="' + tmp[0] + '" class="custom" onclick="changer_tpac()" />';
			buffer2=buffer2 + '<label for="ch' + tmp[0] + '">'+ tmp[1] + ' </label>';
			}
		buffer2=buffer2 + '</fieldset>';
		buffer2=buffer2 + '</div>';
		$('#test').html(buffer2);
		$('#test').trigger('create');
		cocher_case_pac();
   }
  });
}
function cocher_case_pac(){
	$.ajax({
  type: 'POST',
  url: 'ajax_options.php',
  data: {
    action: 'cocher_millesime',
  },
  success : function(data){	
	var obj = jQuery.parseJSON(data);
    var row = obj[0];
    $('input[type=radio][name=ch][id=ch' + row[0] + ']').attr("checked",true).checkboxradio("refresh");
 
   }
  });
}
 function changer_tpac(){
	$.ajax({
  type: 'POST',
  url: 'ajax_options.php',
  data: {
    action: 'changer_millesime',
    idmillesime: $('input[type=radio][name=ch]:checked').attr('value'),
    
  },
  success : function(data){
  	jAlert('Millésime courant changé !', 'GAMP');
  }
  });
} 
</script>
	<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>
</body>
</html>