
<?php 
$message_show="";
require_once 'session_connect.php'; 

if(isset($_SESSION['user_admin_session']))
{
 header("Location:user_account_details.php");
        
}else
if(isset($_SESSION['verify_account_session']))
{
 $school_unique_id=$_SESSION['verify_account_session'];   

 
{
?>
<?php 
require_once 'connection.php';
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

if(isset($_POST['resend_verify_code']))
{
  function gen_random_string($length=6)
{
   $chars ="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";//length:36
    $final_rand='';
    for($i=0;$i<$length; $i++)
    {
        $final_rand .= $chars[ rand(0,strlen($chars)-1)];
 
    }
    return $final_rand;
} 
 $verify_account_otp=gen_random_string(); 
$update_otp_password=mysql_query("UPDATE organization_db SET verify_otp='$verify_account_otp' WHERE organization_id='$school_unique_id'");    
if($update_otp_password)
{
    $message_show="One Time Password Resend Again.";   
}else
{
      $message_show="Request failed,please try again"; 
}
}


if(isset($_POST['submit_data_process']))
{
  $otp_pincode=$_POST['one_time_password'];  
  $security_code=trim($_POST['captcha_code']);
  $to_check=md5($security_code);
 if($to_check==$_SESSION['security_code'])
{   
  
  $select_match_otp=mysql_query("SELECT * FROM organization_db WHERE organization_id='$school_unique_id' and verify_otp='$otp_pincode'");
  $fetch_organization_data=mysql_fetch_array($select_match_otp);
  $fetch_organization_num_rows=mysql_num_rows($select_match_otp);
  if((!empty($fetch_organization_data))&&($fetch_organization_data!=null)&&($fetch_organization_num_rows!=0))
  {
   
  $update_org_details=mysql_query("UPDATE organization_db SET account_verify='account verify',verify_otp='' WHERE organization_id='$school_unique_id'");    
  if($update_org_details)
  {
  $_SESSION['user_admin_session']=$school_unique_id; 
  if(isset($_SESSION['user_admin_session']))
  {
     header("Location:user_account_details.php");
      
  }
      
      
      
  }else
  {
    $message_show="Request failed,Please try again";   
  }
      
      
  }else
  {
  $message_show="Please Enter valid One Time Password (OTP).";   
  }
  
  }else
  {
      $message_show="Please enter valid captcha security code.";  
  }
  
   require_once 'pop_up.php';
}



?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Pixabyte Technologies Pvt. Ltd.</title>
          <link href="stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
          <script type="text/javascript">
          function verification_code()
          {
              
          }
      function verify_validate()
      {
      var one_time_password=document.getElementById("one_time_password").value;
      var captcha_code=document.getElementById("captcha_code").value;
     if(one_time_password==0)
         {
            alert("Please fill One Time Password (OTP)");
            document.getElementById("one_time_password").focus();
            return false;
         }else
             if(captcha_code==0)
         {
            alert("Please enter captcha code");
            document.getElementById("captcha_code").focus();
            return false;
         }
      
      }
      </script>
    </head>
    <body> 
    <?php 
include_once 'ajax_loader_page.php';
      ?>
       
<?php
include_once 'step_header.php';;
?>   
        <?php
                 if(isset($_SESSION['verify_account_session']))
                  {
                  $admin_unique_id=$_SESSION['verify_account_session'];
                  
                  $select_match_otp=mysql_query("SELECT * FROM organization_db WHERE organization_id='$school_unique_id'");
  $fetch_organization_data=mysql_fetch_array($select_match_otp);
  $fetch_organization_num_rows=mysql_num_rows($select_match_otp);
  if((!empty($fetch_organization_data))&&($fetch_organization_data!=null)&&($fetch_organization_num_rows!=0))
  {
                  
                   $reg_mobile_no=$fetch_organization_data['contact_no'];
                   $reg_email=$fetch_organization_data['email_id'];
                      
                  }else
                  {
                   $reg_mobile_no=0;
                   $reg_email=0;
                  }
                   
                  }else
                  {
                   $reg_mobile_no=0;
                   $reg_email=0;
                  }
                  
                  if((!empty($reg_mobile_no)))
                  {
                    
                  $return_mobile=substr("$reg_mobile_no",-4);   
                   
                  $print_mobile="mobile *****$return_mobile";
                  }else
                  {
                   $print_mobile="";   
                  }
                  
                  if(!empty($reg_email))
                  {
                  $return_email=substr($reg_email,-14); 
                  $print_email="OR email *****$return_email";    
                  }else
                  {
                   $print_email="";   
                  }
                  ?>      
                      
        
        <div id="second_work_div">
            <div id="middle_work_div_org">
                 <form action=""  method="post" enctype="multipart/form-data">
       
                     <table cellspacing="2" cellpadding="2" id="org_table_style" style=" width:auto; font-size:13px;  margin-top:10px; ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr>
                    <tr>
                        <td style=" height:20px; "></td>
                    </tr>
                    <tr>
                        <td colspan="3" style=" text-align:center; ">
                         <center>
                             <b>
                    <div style=" font-size:0.95em; margin:0 auto; ">6-digit One Time Password (OTP)
                        has been <span id="resned_notify">sent</span> to<br/> your <?php echo $print_mobile;?>
                        <?php echo $print_email;?>.
                           <br/> please enter the same here to verify account.</div>   
                             </b>
                </center>   
                              
                        </td>
                    </tr>
                    <tr>
                        <td style=" height:20px;"></td>
                    </tr>
                    <tr><td><b>One Time Password (OTP)</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="one_time_password"
                                   placeholder="Enter One Time Password (OTP)" class="text_box_org" 
                                   name="one_time_password"></td>
                  
                    </tr>
                    <tr>
                        <td style=" height:20px;"></td>
                    </tr>
                     <tr>
                    <td  colspan="3" style=" color:#999;">
                 <center>
                        <p style="font-size:0.80em;  ">
                            <b>If you do not receive the OTP in 1 minute,Click to</b>
                            <input type="submit" onclick="verification_code()" class='resend_button' name="resend_verify_code" value="Resend OTP">
                        </p>
                 </center>
                    </td>
                </tr>  
                <tr>
                        <td style=" height:20px;"></td>
                    </tr>
                    <tr>
                       
                        <td colspan="3">
<script type="text/javascript">
function new_captcha()
{
var c_currentTime = new Date();
var c_miliseconds = c_currentTime.getTime();

document.getElementById('captcha').src = 'captcha/image.php?x='+ c_miliseconds;

}

</script>    
                            
                         <div id="verify_ur_not_robot">
                            <table style=" width:100%; ">
                                <tr>
                                    <td><img border="0" id="captcha" style=" float:left; " src="captcha/image.php" alt=""></td>
                                    <td><a href="JavaScript: new_captcha();"><input type="button" class="refresh_button"></a></td>
                                    <td><div class="verticle_captcha_line"></div></td>
                                    <td><input type="text" autocomplete="off" id="captcha_code" name="captcha_code" class="capctha_code"></td>
                                </tr>
                            </table>    
                            
                        </div>     
                            
                        </td>
                    </tr>
                    <tr>
                        <td style=" height:10px; "></td>
                        <td style=" height:10px; "></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process" class="save_button" onclick="return verify_validate();" id="save_button" value="Account Verify">   
                        </td>
                    </tr>
                </table>
                 </form>
            </div>   
        </div>
        
        <div id="develop_com_details">
            <div id="design_company_details">Design & Develop By - <a target="_blank" href="http://www.pixabyte.in">Pixabyte Technologies Pvt. Ltd</a></div>   
        </div>
    </body>
</html>
<?php 
}
}else
{
    header("Location:organisation_details.php");
}
?>