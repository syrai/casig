<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Rechercher</title>
	<link rel="shortcut icon" href="../img/mobile/favicon.png" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
	 
</head>
<body>	
	<?php
	include_once("./inc_abonne/header_abonne.inc.php");
	?>	
<div data-role="page=" id="consabo">

	<script type="text/javascript">
	initDatabase();
	
	function initDatabase() {  
    try {  
        if (!window.openDatabase) {  
            alert('Databases are not supported in this browser.');  
        } else {  
            var shortName = 'DEMODB';  
            var version = '1.0';  
            var displayName = 'DEMO SIA';  
            var maxSize = 100000; //  bytes  
            DEMODB = openDatabase(shortName, version, displayName, maxSize);  
            createTables();  
            
        }  
    } catch(e) {  
  
        if (e == 2) {  
            // Version number mismatch.  
            console.log("Invalid database version.");  
        } else {  
            console.log("Unknown error "+e+".");  
        }  
        return;  
    }  
}  

function createTables(){  
    DEMODB.transaction(  
        function (transaction) {  
            transaction.executeSql('CREATE TABLE IF NOT EXISTS tcartonet2 (idexploitation INTEGER PRIMARY KEY,raisonsocial TEXT,idtypeabonnement INTEGER,idmois INTEGER);', []);  
        }  
    );  
    prePopulate();  
}  


function prePopulate(){  
    DEMODB.transaction(  
        function (transaction) {  
        //Optional Starter Data when page is initialized  
        var data = ['4646','ALPA','1','1'];  
        transaction.executeSql("INSERT INTO  tcartonet2 (idexploitation, raisonsocial, idtypeabonnement, idmois) VALUES (?, ?, ?, ?)", [data[0], data[1], data[2], data[3]]);  
        }  
    );  
} 



	
	</script>
	
</div>
</body>
</html>