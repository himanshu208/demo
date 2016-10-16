<?php 
require_once '../connection.php';
if((!empty($_REQUEST['school_id']))&&(!empty($_REQUEST['branch_id']))
        &&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['class_id']))&&(!empty($_REQUEST['section_name']))
        &&(!empty($_REQUEST['strength'])))
{
  
        $school_id=$_REQUEST['school_id'];
        $fetch_branch_id=$_REQUEST['branch_id'];
        $session_id=$_REQUEST['session_id'];
        $class_id=$_REQUEST['class_id'];
        $section_name=$_REQUEST['section_name'];
        $strength=$_REQUEST['strength'];
        
        
$class_course_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$school_id' and branch_id='$fetch_branch_id'"
        . " and session_id='$session_id' and course_id='$class_id' and is_delete='none'");
$fetch_course_data= mysql_fetch_array($class_course_db);
if((!empty($fetch_course_data))&&($class_course_db!=null))
{
 $class_strength=$fetch_course_data['strength'];   
}else
{
 $class_strength=0;   
}
        
if($class_strength<$strength)
{
  echo "sorry higer value";     
}else
{
    echo "sorry higer value";   
}



    
    
}else
{
    echo "<span style='color:red;'>Please fill all fields.</span>"; 
}

?>