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
<div data-role="header" data-theme="e" data-position="fixed">
<h1>Options</h1>
<a href="./gest_param.php" rel="external" data-icon="back" data-iconpos="notext" data-transition="fade" >Home</a>
</div>
<div data-role="content">
		<div class="content-primary">
<div id="liste">
<ul data-role="listview" data-theme="d" data-inset="true">
<li data-role="fieldcontain">

<table>
<tr>
<td width="100px">
<label for="name" data-mini="true">Nom abonnement </label>
</td>
<td>
<input type="text" name="name" id="name" value=""  />
</td>
<td>
<a href="#" data-role="button" data-icon="refresh" data-iconpos="notext" onclick="modif_nom_abonnement()"></a>
</td>
</tr>
</table>
</li>
<li data-role="fieldcontain">
<table>
<tr>
<td width="100px">
<label for="tarif" data-mini="true">Tarif </label>
</td>
<td>
<input type="text" name="tarif" id="tarif" value=""  />
</td>
<td>
<a href="#" data-role="button" data-icon="refresh" data-iconpos="notext" onclick="modif_tarif()"></a>
</td>
</tr>
</table>
</li>
<li data-role="fieldcontain">
<table>
<tr>
<td width="100px">
<label for="libellecourt" data-mini="true">Libelle court </label>
</td>
<td>
<input type="text" name="libellecourt" id="libellecourt" value=""  />
</td>
<td>
<a href="#" data-role="button" data-icon="refresh" data-iconpos="notext" onclick="modif_libellecourt()"></a>
</td>
</tr>
</table>
</li>
<li data-role="fieldcontain">
<label for="flipdisponible">Abonnement disponible</label>
<select name="flipdisponible" id="flipdisponible" data-role="slider" ">
	<option value="off">Non</option>
	<option value="on">Oui</option>
</select> 
</li>
<li data-role="fieldcontain">
<label for="flipabosec">Abonnement secondaire</label>
<select name="flipabosec" id="flipabosec" data-role="slider">
	<option value="off">Non</option>
	<option value="on">Oui</option>
</select> 
</li>
<li data-role="fieldcontain">
<label for="flipmillesime">Passage de millésime</label>
<select name="flipmillesime" id="flipmillesime" data-role="slider">
	<option value="off">Non</option>
	<option value="on">Oui</option>
</select> 
</li>
<li id="test" data-role="fieldcontain">

</li>
</ul>
</div>
</div>
</div>
<script type="text/javascript">
// Stockage en base de l'identifiant abonnement
localStorage.idtypeabonnement=getUrlParameter('idtypeabonnement')
afficher_slider(localStorage.idtypeabonnement);
afficher_autre_champ();
function afficher_autre_champ(){
	$.ajax({
  type: 'POST',
  url: 'ajax_options.php',
  data: {
    action: 'afficher_liste_pac'
  },
  success : function(data){	
	buffer2='<div data-role="fieldcontain" >';
    buffer2=buffer2 + '<fieldset data-role="controlgroup"  >';
    buffer2=buffer2 + '<h4>Prestation PAC</h4>';
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
    action: 'cocher_pac',
    idtypeabonnement: localStorage.idtypeabonnement
  },
  success : function(data){	
	var obj = jQuery.parseJSON(data);
    var row = obj[0];
    $('input[type=radio][name=ch][id=ch' + row[0] + ']').attr("checked",true).checkboxradio("refresh");
 
   }
  });
}

function afficher_slider(idtypeabonnement){
  $.ajax({
  type: 'POST',
  url: 'ajax_options.php',
  data: {
    action: 'afficher_slider',
    idtypeabonnement: idtypeabonnement
  },
  success : function(data){
   		var myswitch = $("#flipdisponible");
   		var sw_abo_sec = $("#flipabosec");
   		var sw_millesime = $("#flipmillesime");
   		
    	var obj = jQuery.parseJSON(data);
    	var row = obj[0];
    	if (row[0]!='1') {    		
			myswitch[0].selectedIndex = 0;
			
    
    	} else {
    		myswitch[0].selectedIndex = 1;
			
    	}
    	myswitch.slider("refresh");
    	if (row[1]!='1') {    		
			sw_abo_sec[0].selectedIndex = 0;
			
    
    	} else {
    		sw_abo_sec[0].selectedIndex = 1;
			
    	}
    	sw_abo_sec.slider("refresh");
    	if (row[2]!='1') {    		
			sw_millesime[0].selectedIndex = 0;
			
    
    	} else {
    		sw_millesime[0].selectedIndex = 1;
			
    	}
    	sw_millesime.slider("refresh");
    	
        $("#name").val(row[4]);
        $("#tarif").val(row[5]);
    	$("#libellecourt").val(row[6]);
    	
  }
  });
  
}
$('#flipdisponible').change(function(event){
event.stopPropagation();
var mys=$(this);
var show = mys[0].selectedIndex;
 changer_dispo(show);
});

function changer_dispo(dispo){
	$.ajax({
  type: 'POST',
  url: 'ajax_options.php',
  data: {
    action: 'changer_dispo',
    dispo: dispo,
    idtypeabonnement:localStorage.idtypeabonnement
  },
  success : function(data){
  	
  }
  });
}
// Changement abonnement secondaire
$('#flipabosec').change(function(event){
event.stopPropagation();
var mys=$(this);
var show = mys[0].selectedIndex;
 changer_dispo2(show);
});

function changer_dispo2(dispo){
	$.ajax({
  type: 'POST',
  url: 'ajax_options.php',
  data: {
    action: 'changer_abo_sec',
    dispo: dispo,
    idtypeabonnement:localStorage.idtypeabonnement
  },
  success : function(data){
  	
  }
  });
}
// Changement passage de millésime
$('#flipmillesime').change(function(event){
event.stopPropagation();
var mys=$(this);
var show = mys[0].selectedIndex;
 changer_millesime(show);
});

function changer_millesime(dispo){
	$.ajax({
  type: 'POST',
  url: 'ajax_options.php',
  data: {
    action: 'changer_milles',
    dispo: dispo,
    idtypeabonnement:localStorage.idtypeabonnement
  },
  success : function(data){
  	
  }
  });
}


function changer_tpac(){
	$.ajax({
  type: 'POST',
  url: 'ajax_options.php',
  data: {
    action: 'changer_type_pac',
    dispo: $('input[type=radio][name=ch]:checked').attr('value'),
    idtypeabonnement:localStorage.idtypeabonnement
  },
  success : function(data){
  	
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
</script>
	<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>
</body>
</html>