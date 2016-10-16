<?php
require_once '../connection.php';
if((!empty($_REQUEST['class_id']))&&(!empty($_REQUEST['org_id']))
        &&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))) 
{
 $class_id=$_REQUEST['class_id'];
 $org_id=$_REQUEST['org_id'];
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 
 $section_array=array();
 $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$org_id' and branch_id='$branch_id'"
         . " and session_id='$session_id' and course_id='$class_id' and is_delete='none'");
 $section_num_rows=mysql_num_rows($section_db);
 while ($section_data=mysql_fetch_array($section_db))
 {
  $section_id=$section_data['section_id'];
  $section_name=$section_data['section_name'];
  
  $option="<option value='$section_id'>$section_name</option>";
  array_push($section_array,$option);
 }
 
 
  $student_array=array();
 $student_db=mysql_query("SELECT * FROM student_db WHERE organization_id='$org_id' and branch_id='$branch_id'"
         . " and session_id='$session_id' and course_id='$class_id' and action='active'");
 $student_num_rows=mysql_num_rows($student_db);
 while ($student_data=mysql_fetch_array($student_db))
 {
  $student_id=$student_data['id'];
  $student_name=$student_data['student_full_name'];
  
  $options="<option value='$student_id'>$student_name</option>";
  array_push($student_array,$options);
 }
 
 
 if((!empty($section_num_rows)))
 {
 $implode_option_array=implode("@@",$section_array);
 $implode_student_array=implode("@@",$student_array);
 $result=$implode_option_array."@,,@".$implode_student_array;
 echo $result;
 }else
 {
 echo '1'; 
 }
 
 
}

?>