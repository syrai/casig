<?php
function connex($base,$param)
{
		include("myparam_l9.inc.php");
		$hote   = PGHOST;
        $user   = PGUSER;
        $passe  = PGPASS;
        $port   = PGPORT;
     
      $idcom    = pg_connect("host=".$hote." port=".$port." dbname=".$base." user=".$user." password= ".$passe) ;
      if (!$idcom)
       {
       	echo "<script type=text/javascript>";
       	echo "alert('Connexion Impossible à la base $base ($hote)')</script>";
       }
      return $idcom;
}
?>