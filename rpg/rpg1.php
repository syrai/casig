<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>RPG</title>
	
	<?php
	include_once("../connexion/version_jq.php");
	?>	
</head>
<body>	
	<div data-role="header" data-theme="e" data-position="fixed">
<h1>RPG 2010</h1>
<a href="#" rel="external" data-icon="home" data-iconpos="notext" data-transition="fade" >Home</a>

</div>
<div data-role="page=" id="consabo">
<div id="div_ilot" data_role="content">
<input type="search" id="recherche_ilot" name="recherche_ilot" placeholder="Numéro ilot..." value="" onchange="afficher_info_ilot()"/>
	
</div>
<div id="div_liste" data-role="content">

</div>
<script type="text/javascript">
	
	function afficher_info_ilot(){
		$.ajax({
			type: 'POST',
			url: 'ajax_rpg.php',
			data: {
				action: 'info_ilot',
				num_ilot : $('#recherche_ilot').val()
					},
			success : function(data){	
				buffer1='<ul data-role="listview" id="listView"  data-autodividers="true" data-inset="true" data-mini="true"  data-filter-theme="d" data-theme="d" data-divider-theme="e">';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					buffer1=buffer1 + '<li>';
					buffer1=buffer1 + '<a href="./rpg2.php?num_ilot='+ tmp[0] + '" id="vers" rel="external" data-inset="true" data-mini="true" data-icon="star">' + tmp[1] + ', Numéro Ilot : ' + tmp[0] + ',  Surface : ' + tmp[3] + ' ha , Exploitation : ' + tmp[5] +'</a>';
					buffer1=buffer1 + '</li>';							
					}
				buffer1=buffer1 + '</ul>';
				$('#div_liste').html(buffer1);
				$('#div_liste').trigger('create');	
					
				}
				});
				
	}
	</script>
<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
 ?>
</div>
</body>
</html>