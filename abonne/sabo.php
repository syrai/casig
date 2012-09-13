<?php
session_start();	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PAC</title>
	<meta name="viewport" content="width=device-width, initial-scale=2">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0-rc.2/jquery.mobile-1.1.0-rc.2.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0-rc.2/jquery.mobile-1.1.0-rc.2.min.js""></script>
	 <script type="text/javascript" src="jquery.mobile.listview.accordion.js"></script>
	 <link rel="stylesheet" href="jquery.mobile.listview.accordion.css"/>

</head>
<body>
	<div data-role="page">
	<div data-role="header">
			<div data-role="navbar">
       <ul>
       <li><a href="consultpac2.php"  data-icon="grid"></a></li>
		<li><a href="dispordv.php" data-icon="info"></a></li>
		<li><a href="pacrdv.php" data-icon="star"></a></li>
		<li><a href="searchpac.php" data-icon="search"></a></li>
		<li><a href="accueilpac.html" data-icon="home"></a></li>
       </ul>
		</div>
		</div><!-- /header -->
		<div data-role="content" data-theme="b" data-content-theme="c" data-inset="true">
     <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="application/x-www-form-urlencoded">
       	<div data-role="fieldcontain">
    <label for="search">Recherche :</label>
    <input type="search" name="search" id="search"/ >
</div>
<div class="content-secondary">
	<ul data-role="listview" id="listView">
	<?php
	if (isset($_POST['search']))
	{
		include_once("../connexion/connex.inc.php");
		$rs=$_POST['search'];
		$idcom=connex("SIA","myparam");
		$requete="SElect raison_social  as rdv,idexploitation FROM tcartonet where raison_social like UPPER('%".$rs."%') ORDER by raison_social";
		$result=pg_query($idcom,$requete);
		while($ligne=pg_fetch_array($result))
			{
	?>
			<li  data-role="list-divider" class="ui-li-accordion-head" data-mini="true">
			<?php 
			$_SESSION['idexploitation']=$ligne['idexploitation'];
			$ide=$ligne['rdv']; 
				$idec=$ligne['idexploitation'];
 				echo "$ide";?> 
 				<span><a href="coordabonne.php?idexploitation=<?php echo "".$ligne['idexploitation']."" ;?>" data-icon="star" data-rel="dialog">Suivi</a></span>
				</li>
			<li data-theme="e">
			<div class="ui-li-accordion" data-mini="true">
					echo "ok";
						
			</div>	
			<?php
				}
				pg_free_result($result);
	}
			?>			
			</li>
			</div>
	</ul>
	</body>
	</html>