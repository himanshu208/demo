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
if(isset($_SESSION['verify_account_permission']))
{
 header("Location:../account_verify.php");       
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
  $fecth_user_unique=$fetch_user_data['user_admin_id'];
  $admin_name=$fetch_user_data['full_name'];
  $admin_mobile_no=$fetch_user_data['mobile_number'];
  $admin_email_id=$fetch_user_data['email_id'];
  
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
$branch_adress=$fetch_branch_data['address'];
 $fetch_currency=$fetch_branch_data['currency'];
 $fetch_school_logo="../".$fetch_branch_data['branch_logo'];

 $principal_name=$fetch_branch_data['principal_name'];
 $principal_email=$fetch_branch_data['principal_email'];
 $principal_mobile_no=$fetch_branch_data['principal_mobile'];        
 
 $fetch_branch_report_logo=$fetch_branch_data['report_logo'];
$student_admission_prefix_no=$fetch_branch_data['student_prefix_no'];
$employee_no_prefix_no=$fetch_branch_data['employee_prefix_no'];
 
 
 
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
  
  $search_match_module= in_array($check_array_in,$explode_module_array);
  if($search_match_module==true)
  {   
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
  
//account setting


                            $account_setting_db=mysql_query("SELECT * FROM finance_setting WHERE "
                                    . "$db_main_details_whout_session is_delete='none'");
                            $account_data=mysql_fetch_array($account_setting_db);
                            $account_num_rows=mysql_num_rows($account_setting_db);
                            if((!empty($account_data))&&($account_data!=null)&&($account_num_rows!=0))
                            {
                             $account_setting_id=$account_data['id'];   
                             $recipt_prefix=$account_data['receipt_prefix'];
                             $pay_slip_prefix=$account_data['pay_slip_prefix'];
                                     $recipt_format=$account_data['receipt_format'];
                                     $pay_slip_format=$account_data['pay_slip_format'];
                                     $print_copy=$account_data['no_copy'];
                                     $sms_alert=$account_data['sms_alert'];
                                     $school_logo=$account_data['school_logo'];
                                     $school_name=$account_data['school_name'];
                                     $school_address=$account_data['address_contact_us'];
                                     if($sms_alert=="yes")
                                     {
                                        $sms_check="checked"; 
                                     }else
                                     {
                                      $sms_check="";   
                                     }
                                     
                                     
                            }else
                            {
                                $account_setting_id="";
                                     $recipt_prefix="";
                                     $pay_slip_prefix="";
                                     $recipt_format="a4";
                                     $pay_slip_format="a4";
                                     $print_copy="1";
                                     $sms_alert="1";
                                     $school_logo="";
                                     $school_name="";
                                     $school_address=""; 
                                      $sms_check=""; 
                                     
                            }
               
                            
                            function message_template($module_message)
                            {
                           $module_select=$module_message;
                           $select_template=mysql_query("SELECT * FROM sms_system_template_db WHERE use_module='$module_select' and is_delete='none'");
                           $sms_fetch_data=mysql_fetch_array($select_template);
                           $sms_fetch_num_rows=mysql_num_rows($select_template);
                           if((!empty($sms_fetch_data))&&($sms_fetch_data!=null)&&($sms_fetch_num_rows!=0))
                           {
                          $message_template=$sms_fetch_data['template'];
                          if(!empty($message_template))
                          {
                              return $message_template;   
                          }else
                          {
                            return 0;    
                          }
                          }else
                          {
                              return 0;  
                          }
                           }
                            
                            



  }else
  {
   header("Location:../404_error.php");   
  }
 }else
 {
 header("Location:../loginPage.php?return_url=$absolute_url");   
 }
  
  
 }else
 {
 header("Location:../loginPage.php?return_url=$absolute_url");   
 }
 
 
 }else
{
     header("Location:../loginPage.php?return_url=$absolute_url");
}


}else
{
    header("Location:../loginPage.php?return_url=$absolute_url");
}

}else
{
     header("Location:../loginPage.php?return_url=$absolute_url");
}
?>

