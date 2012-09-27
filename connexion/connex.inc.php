<?php
function connex($base,$param)
{
		include("myparam.inc.php");
		$hote   = PGHOST;
        $user   = PGUSER;
        $passe  = PGPASS;
        $port   = PGPORT;
     
      $idcom    = pg_connect("host=".$hote." port=".$port." dbname=".$base." user=".$user." password= ".$passe) ;
      if (!$idcom)
       {
       	
       	alert('Connexion Impossible à la base $base ($hote)');
       }
      return $idcom;
}
?>