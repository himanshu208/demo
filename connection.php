<?php 
$conn=mysql_connect("localhost","root","") or die("Unable to connect");
if($conn)
{
    $select_db=mysql_select_db("nationa1_nmi") or die("Unable to select database");
}   if($select_db)
?>
