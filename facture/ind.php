<?php
include("../connexion/connex.inc.php");
include("../connexion/xls.class.php");
$xl = new xls();

//adding new cells to the spreadsheet
//syntax: object_of_xls_class->add_cell("column_number:row_number","cell_content");
$xl->add_cell("1:1","Name");
$xl->add_cell("1:2","Rahul");
$xl->add_cell("1:3","Tina");
$xl->add_cell("2:1","Amount");
$xl->add_cell("2:2","36");
$xl->add_cell("2:3","24");
$xl->add_cell("1:4","Total");

//you can apply formula to a cell
$xl->add_cell("2:4","=sum(B2:B3)");

//force download the file with specified name
$xl->execute("myfile.xls");
?>