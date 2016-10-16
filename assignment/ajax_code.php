<?php
//SESSION CONFIGURATION
$check_array_in="admission";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php 
require_once '../connection.php';

//fetch section

if(!empty($_REQUEST['class_id']))
{
   
    echo "<option value='0'>---Select---</option>";
    $class_id=$_REQUEST['class_id'];
    $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details course_id='$class_id' and is_delete='none'");
    while ($fetch_class_data=mysql_fetch_array($section_db))
    {
        $fetch_section_id=$fetch_class_data['section_id'];
        $fetch_section_name=$fetch_class_data['section_name'];
        
        echo "<option value='$fetch_section_id'>$fetch_section_name</option>";
    }
    
    if(empty($fetch_section_id))
    {
        echo "<option value='0'>Record no found !!</option>";
    }
    
}

//subject id

if((!empty($_REQUEST['temp_class_id']))&&(!empty($_REQUEST['temp_section_id'])))
{
 $class_id=$_REQUEST['temp_class_id'];
 $section_id=$_REQUEST['temp_section_id'];
 echo "<option value='0'>---Select---</option>";
 $subject_assign_db=mysql_query("SELECT * FROM subject_assign_db as T1 "
         . "LEFT JOIN subject_db as T2 ON T1.subject_id=T2.subject_id WHERE T1.class_id='$class_id'"
         . " and T1.section_id='$section_id' and T1.is_delete='none'");
 while ($subject_assign_data=mysql_fetch_array($subject_assign_db))
 {
  $subject_id=$subject_assign_data['subject_id'];
  $subject_name=$subject_assign_data['subject_name'];
  
  echo "<option value='$subject_id'>$subject_name</option>";
     
     
 }
 
 
}

?>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>