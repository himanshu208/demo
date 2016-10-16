<?php
session_start(); 
ob_start();
?>
<?php
//header url link

require '../page_url_link.php';
?>
<?php
//return url

function url_origin($s, $use_forwarded_host=false)
{
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}
function full_url($s, $use_forwarded_host=false)
{
    return url_origin($s, $use_forwarded_host) . $s['REQUEST_URI'];
}
$absolute_url= full_url($_SERVER);
?>
<?php
require_once '../connection.php';

if(isset($_SESSION['student_id']))
{
$user_unique_id=$_SESSION['student_id'];
$user_db=mysql_query("SELECT * FROM student_db WHERE student_id='$user_unique_id' and is_delete='none'");
$fetch_user_data=mysql_fetch_array($user_db);
$fetch_user_num_rows=mysql_num_rows($user_db);
if((!empty($fetch_user_data))&&($fetch_user_data!=null)&&($fetch_user_num_rows!=0))
{
  $student_photo=$fetch_user_data['student_photo'];
  $class_id=$fetch_user_data['course_id'];
  $section_id=$fetch_user_data['section_id'];  
  $student_id=$fetch_user_data['student_id'];
  if((empty($student_photo))&&(!is_file($student_photo)))
    {
    $student_photo="images/no_avilable_image.gif";    
    }  else {
      $student_photo=$student_photo;    
       
    }
  
  $fetch_school_id=$fetch_user_data['organization_id'];
  $fetch_branch_id=$fetch_user_data['branch_id'];
 
$organisation_db=mysql_query("SELECT * FROM organization_db WHERE organization_id='$fetch_school_id'"); 
 $fetch_org_data=mysql_fetch_array($organisation_db);
 $fetch_org_num_rows=mysql_num_rows($organisation_db);
if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_rows!=0))
{
$fetch_school_logo="../".$fetch_org_data['school_logo'];

$branch_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");  
$fetch_branch_data=mysql_fetch_array($branch_db);
$fetch_branch_num_rows=mysql_num_rows($branch_db);
 if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
 {
$fetch_branch_unique_db_id=$fetch_branch_data['branch_id'];
$fetch_school_name=$fetch_branch_data['branch_name'];
 $fetch_currency=$fetch_branch_data['currency'];
 $fetch_school_logo="../".$fetch_branch_data['branch_logo'];

 $fetch_branch_report_logo=$fetch_branch_data['report_logo'];
$student_admission_prefix_no=$fetch_branch_data['student_prefix_no'];
$employee_no_prefix_no=$fetch_branch_data['employee_prefix_no'];
 
   $connection_permission=1;
   
   $school_session_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id'"
         . " and branch_id='$fetch_branch_id'");
 $fetch_school_session_data=mysql_fetch_array($school_session_db);
 $fetch_school_num_rows=mysql_num_rows($school_session_db);
  if((!empty($fetch_school_session_data))&&($fetch_school_session_data!=null)&&($fetch_school_num_rows!=0))  
  {
 $connection_permission=1;  
 
 if(isset($_POST['change_session_id']))
{
 if(!empty($_POST['change_session_id']))
 {
 $session_current_id=$_POST['change_session_id'];  
 $_SESSION['working_session_year']=$session_current_id;
 }
}

      $session__new_activate_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id'"
              . " and branch_id='$fetch_branch_id' and by_defult='active'"); 
      $fecth_session_active_data=mysql_fetch_array($session__new_activate_db);
      $fecth_session_num_rows=mysql_num_rows($session__new_activate_db);
      if((!empty($fecth_session_active_data))&&($fecth_session_active_data!=null)&&($fecth_session_num_rows!=0))
      {
       $fecth_session_id_set_tmep=$fecth_session_active_data['session_id']; 
       
      }else
      {
       echo "<style>#session_not_active{ display:block; }</style>"; 
      }

if(isset($_SESSION['working_session_year']))
{
 $fecth_session_id_set=$_SESSION['working_session_year'];  
}else
{
  $fecth_session_id_set=$fecth_session_id_set_tmep; 
}
}
   
$db_main_details="organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and";
$db_main_details_whout_session="organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and";
$db_t1_main_details="T1.organization_id='$fetch_school_id' and T1.branch_id='$fetch_branch_id' and T1.session_id='$fecth_session_id_set' and";
$db_t1_main_without_session="T1.organization_id='$fetch_school_id' and T1.branch_id='$fetch_branch_id' and";
  
 
  
  
 }else
 {
 header("Location:login.php?return_url=$absolute_url");   
 }
 
 
 }else
{
     header("Location:login.php?return_url=$absolute_url");
}


}else
{
    header("Location:login.php?return_url=$absolute_url");
}

}else
{
     header("Location:login.php?return_url=$absolute_url");
}
?>

