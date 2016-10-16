<?php
//SESSION CONFIGURATION
$check_array_in="sms_module";
require '../connection.php';
require_once '../config/configuration.php';
if($connection_permission==1)
{
if(!empty($_REQUEST['class_unique_id']))
{
  echo "<option value='0'>---Select---</option>";   
 $course_id=$_REQUEST['class_unique_id'];
 $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details course_id='$course_id' and is_delete='none'");
 while($section_date=mysql_fetch_array($section_db))
 {
     $section_id=$section_date['section_id'];
     $section_name=$section_date['section_name'];
     echo "<option value='$section_id'>$section_name</option>";
 }
 $section_num_rows=mysql_num_rows($section_db);
 if(empty($section_num_rows))
 {
  echo 'zero';  
 }
 
 
 
}  
}
?>