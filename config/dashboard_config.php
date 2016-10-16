<?php
session_start(); 
ob_start();
?>
<?php
//header url link

require 'page_url_link_1.php';
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
require_once 'connection.php';
if(isset($_SESSION['verify_account_permission']))
{
 header("Location:account_verify.php");       
}else
if(isset($_SESSION['admin_session_on']))
{
$user_unique_id=$_SESSION['admin_session_on'];
$user_db=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id='$user_unique_id'");
$fetch_user_data=mysql_fetch_array($user_db);
$fetch_user_num_rows=mysql_num_rows($user_db);
if((!empty($fetch_user_data))&&($fetch_user_data!=null)&&($fetch_user_num_rows!=0))
{
  $fetch_school_id=$fetch_user_data['organization_id'];
  $fetch_branch_id=$fetch_user_data['branch_id'];
  $fetch_accout_type=$fetch_user_data['account_type'];
$organisation_db=mysql_query("SELECT * FROM organization_db  WHERE organization_id='$fetch_school_id'"); 
 $fetch_org_data=mysql_fetch_array($organisation_db);
 $fetch_org_num_rows=mysql_num_rows($organisation_db);
if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_rows!=0))
{
$fetch_school_logo=$fetch_org_data['school_logo'];

$branch_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");  
$fetch_branch_data=mysql_fetch_array($branch_db);
$fetch_branch_num_rows=mysql_num_rows($branch_db);
 if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
 {

  $fetch_school_name=$fetch_branch_data['branch_name'];
  $fetch_school_logo=$fetch_branch_data['branch_logo'];
 $school_session_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");
 $fetch_school_session_data=mysql_fetch_array($school_session_db);
 $fetch_school_num_rows=mysql_num_rows($school_session_db);
  if((!empty($fetch_school_session_data))&&($fetch_school_session_data!=null)&&($fetch_school_num_rows!=0))  
  {
 
 $course_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'"); 
 $fetch_course_data=  mysql_fetch_array($course_db);
 $fetch_course_num_rows=  mysql_num_rows($course_db);
  if((!empty($fetch_course_data))&&($fetch_course_data!=null)&&($fetch_course_num_rows!=0))   
  {  
 
 $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");
$fetch_section_data=mysql_fetch_array($section_db);
$fetch_section_num_rows=mysql_num_rows($section_db);
if((!empty($fetch_section_data))&&($fetch_section_data!=null)&&($fetch_section_num_rows!=0))
{    
  
  $category_db=mysql_query("SELECT * FROM category_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");  
  $fecth_category_data=  mysql_fetch_array($category_db);
  $fecth_category_num_rows=  mysql_num_rows($category_db);
   if((!empty($fecth_category_data))&&($fecth_category_data!=null)&&($fecth_category_num_rows!=0)) 
    
   {
       
 
if($fetch_accout_type=="branch_head_admin")
{
 $manage_module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and admin_type='branch_head_admin'");   

}else
{
$manage_module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and admin_id='$user_unique_id'");   
}
$fetch_module_data=mysql_fetch_array($manage_module_db);
$fetch_module_num_rows=mysql_num_rows($manage_module_db);
 if((!empty($fetch_module_data))&&($fetch_module_data!=null)&&($fetch_module_num_rows!=0))
 {
  $fetch_module_list=$fetch_module_data['module'];
  $explode_module_array=explode(",",$fetch_module_list);
     
      
    
 }else
 {
 header("Location:loginPage.php?return_url=$absolute_url");   
 }
    



}else
 {
 header("Location:add_category.php");   
 }

}else
 {
 header("Location:add_section.php");   
 }


}else
 {
 header("Location:add_course.php");   
 }

}else
 {
 header("Location:add_session.php");   
 }

 }else
 {
 header("Location:loginPage.php?return_url=$absolute_url");   
 }
 
 
 }else
{
     header("Location:loginPage.php?return_url=$absolute_url");
}


}else
{
    header("Location:loginPage.php?return_url=$absolute_url");
}

}else
{
     header("Location:loginPage.php?return_url=$absolute_url");
}

?>