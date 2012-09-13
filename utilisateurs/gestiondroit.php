<html> 
  <head> 
  <title>DROIT</title> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"/></script>
  <script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
 
</head> 
<body> 
<script>
        function onSuccess(data, status)
        {
            data = $.trim(data);
        }
 
        function onError(data, status)
        {
            // handle an error
        }        
 
 $('#pac').change(function() {
    var myswitch = $(this);
    var show     = myswitch[0].selectedIndex == 1 ? true:false;
    $.ajax({
                    type: "POST",
                    url: "pacajax.php",
                    cache: false,
                    data: show,
                    success: onSuccess,
                    error: onError
                });
};
      
    </script>
  <div data-role="page" id="home">

    <div data-role="header" data-position="fixed">
      <h1>Gestion des droits</h1>
    </div>

    <div data-role="content"> 
    <form action="gestiondroit.php" id="f1" method="post" >
		<div data-role="fieldcontain">
		<fieldset data-role="controlgroup">
		<legend>Choix du conseiller</legend>
		<select name="abonnement" data-mini="true">
				<?php
					include_once("../connexion/connex.inc.php");
					$idcom=connex("SIA","myparam");
					$requete="select id as iddisphor, nom as libelle FROM tconseiller ORDER by nom";
					$result=pg_query($idcom,$requete);
					while($ligne=pg_fetch_array($result))
						{
							echo "<OPTION VALUE=\"".$ligne['iddisphor']."\">".$ligne['libelle']." </OPTION>";	
						}
						pg_free_result($result);
				?>
			</select><!-- Select abonnement -->			
			</fieldset>
			
			<button type="submit" data-mini="true" data-inline="true">Choisir</submit>
			</div>
		</form>
		<input type="hidden" name="ide" value="<?php echo "".$_POST['abonnement']."";?>"/>
      <h1>Affecter les profils</h1>
<?php
		include_once("../connexion/connex.inc.php");
$idcom=connex("SIA","myparam");
$requete="select * from tdroit WHERE id='".$_POST['abonnement']."' and idprofil='7' ";
$result=pg_query($idcom,$requete);
if (pg_fetch_array($result)<> null){
	$tram="selected='selected'";
	
}

?>
<form id="f2" >
      <div data-role="fieldcontain">
        <label for="abonne" style="margin-top: .6em;">Gestion des abonnés:</label>
        <select name="abonne" id="abonne" data-role="slider">
          <option value="off">Off</option>
          <option value="on" <?php echo $tram ; ?>>On</option>
        </select>
      </div>
      <?php
		include_once("../connexion/connex.inc.php");
$idcom=connex("SIA","myparam");
if ($_POST['abonne']="on"){
	echo $_POST['abonne'];
$requete="INSERT INTO tdroit(idprofil,id) VALUES ('7','".$_POST['abonnement']."')";
echo "INSERT INTO tdroit(idprofil,id) VALUES ('7','".$_POST['abonnement']."')";
$result=pg_query($idcom,$requete);
}
ELSE
{
	$requete="DELETE FROM tdroit WHERE idprofil='7' AND id='".$_POST['abonnement']."')";
	echo "DELETE FROM tdroit WHERE idprofil='7' AND id='".$_POST['abonnement']."')";
$result=pg_query($idcom,$requete);
}
?>
      </form>
<?php
		include_once("../connexion/connex.inc.php");
$idcom=connex("SIA","myparam");
$requete="select * from tdroit WHERE id='".$_POST['abonnement']."' and idprofil='6' ";
$result=pg_query($idcom,$requete);
if (pg_fetch_array($result)<> null){
	$tram2="selected='selected'";
	
}

?>
<form id="pacaj">
      <div data-role="fieldcontain">
        <label for="pac" style="margin-top: .6em;">Déclaration PAC :</label>
        <select name="pac" id="pac" data-role="slider">
          <option value="off">Off</option>
          <option value="on" <?php echo $tram2 ; ?>>On</option>
        </select>
      </div>
 </form>
<?php
		include_once("../connexion/connex.inc.php");
$idcom=connex("SIA","myparam");
$requete="select * from tdroit WHERE id='".$_POST['abonnement']."' and idprofil='1' ";
$result=pg_query($idcom,$requete);
if (pg_fetch_array($result)<> null){
	$tram3="selected='selected'";
	
}

?>
      <div data-role="fieldcontain">
        <label for="admin" style="margin-top: .6em;">Administation:</label>
        <select name="admin" id="admin" data-role="slider">
          <option value="off">Off</option>
          <option value="on" <?php echo $tram3 ; ?>>On</option>
        </select>
      </div>
<?php
		include_once("../connexion/connex.inc.php");
$idcom=connex("SIA","myparam");
$requete="select * from tdroit WHERE id='".$_POST['abonnement']."' and idprofil='5' ";
$result=pg_query($idcom,$requete);
if (pg_fetch_array($result)<> null){
	$tram4="selected='selected'";
	
}

?>
      <div data-role="fieldcontain">
        <label for="maepac" style="margin-top: .6em;">Suivi MAE:</label>
        <select name="maepac" id="maepac" data-role="slider">
          <option value="off">Off</option>
          <option value="on" <?php echo $tram4 ; ?>>On</option>
        </select>
      </div>

      <p><a data-ajax="false" data-role="button" href="http://www.elated.com/articles/jquery-mobile-1-1-smoother-faster-nicer/">Return to Article</a></p>
      </div>
    </div>


  </div>
</body>