<?php 
$message_show="";
session_start(); 
ob_start();
?>
<?php 
require_once 'connection.php';
$school_db=mysql_query("SELECT * FROM organization_db WHERE id ORDER BY id DESC");
$fetch_school_data=mysql_fetch_array($school_db);
$fetch_num_rows=mysql_num_rows($school_db);
if((!empty($fetch_school_data))&&($fetch_school_data!=null)&&($fetch_num_rows!=0))
{
  $company_logo=$fetch_school_data['school_logo']; 


if(isset($_SESSION['verify_account_permission']))
{
 $school_unique_id=$_SESSION['verify_account_permission'];
 
 if(isset($_SESSION['otp_encrypt_id']))
 {
 $otp_unqiue_id=$_SESSION['otp_encrypt_id'];
 }else
 {
 $login_otp_db=mysql_query("SELECT * FROM admin_last_login_date_db WHERE user_admin_id='$school_unique_id'"
         . " and is_delete='none' ORDER BY id DESC");
 $fetch_login_data=mysql_fetch_array($login_otp_db);
 $fetch_login_num_rows=mysql_num_rows($login_otp_db);
 
 if((!empty($fetch_login_data))&&($fetch_login_data!=null)&&($fetch_login_num_rows!=0))
 {
  $otp_unqiue_id=$fetch_login_data['last_login_id'];   
 }else
 {
  $otp_unqiue_id=0;   
 }
 }
 
 

?>
<?php 
require_once 'connection.php';
if(isset($_POST['user_login_button']))
{
  $otp_pincode=$_POST['otp_code'];  
  $security_code=trim($_POST['captcha_code']);
  $to_check=md5($security_code);
 if($to_check==$_SESSION['security_code'])
{  
     
$select_login_user=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id='$school_unique_id'"
         . " and action='active'");   
 $login_user_record_match=mysql_fetch_array($select_login_user);
 $login_user_num_rows_match=mysql_num_rows($select_login_user);
  if((!empty($login_user_record_match))&&($login_user_num_rows_match!=null)&&($login_user_num_rows_match!=0))
  {
   $fetch_account_type=$login_user_record_match['account_type'];
       
  $select_match_otp=mysql_query("SELECT * FROM admin_last_login_date_db WHERE"
          . " last_login_id='$otp_unqiue_id' and otp_password='$otp_pincode' and is_delete='none'");
  $fetch_organization_data=mysql_fetch_array($select_match_otp);
  $fetch_organization_num_rows=mysql_num_rows($select_match_otp);
  if((!empty($fetch_organization_data))&&($fetch_organization_data!=null)&&($fetch_organization_num_rows!=0))
  {
   
  $update_org_details=mysql_query("UPDATE admin_last_login_date_db SET is_delete='yes' WHERE"
          . " last_login_id='$otp_unqiue_id' and is_delete='none'");    
  if((!empty($update_org_details))&&($update_org_details))
  {
  
  if(isset($_SESSION['verify_account_permission']))
  {
     unset($_SESSION['verify_account_permission']); 
   if(!empty($_REQUEST['return_url']))
   {
   $return_url=$_REQUEST['return_url'];
   header("Location:$return_url");
   }else
   {  
    if($fetch_account_type=="super_admin")
    {
      header("Location:superadmin/dashboard.php");   
    }else
    {
    header("Location:dashboard.php");
    }
   }
    
      
  }else
  {
   unset($_SESSION['verify_account_permission']);   
   if(!empty($_REQUEST['return_url']))
   {
   $return_url=$_REQUEST['return_url'];
   header("Location:$return_url");
   }else
   {    
    if($fetch_account_type=="super_admin")
    {
    header("Location:superadmin/dashboard.php");   
    }else
    {
    header("Location:dashboard.php");
    }
   }
  }
  
  }else
  {
      $message_show="Request failed,please try again.";
      require_once 'pop_up.php';
  }
      
      
  }else
  {
      $message_show="Please enter vaild one time password (OTP).";
      require_once 'pop_up.php';
      
  }
   }else
  {
      $message_show="Technical Problem,Please try again.";
      require_once 'pop_up.php';
      
  }
  }else
  {
      $message_show="Please enter valid captcha security code.";
      require_once 'pop_up.php';
      
  }
}


{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>One Time Password (OTP)</title>
         <link href="stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       <script type="text/javascript">
          
      function verify_validate()
      {
     var one_time_password=document.getElementById("otp_code").value;
     var captcha_code=document.getElementById("captcha_code").value;
     if(one_time_password==0)
         {
            alert("Please enter One Time Password (OTP)");
            document.getElementById("otp_code").focus();
            return false;
         }else
         if(captcha_code==0)
         {
            alert("Please enter captcha security key");
                       document.getElementById("captcha_code").focus();
                       return false;
                       }else
                               {
                             document.getElementById("ajax_loader_show").style.display="block";    
                   
                               }
             
      
      }
      

      </script>
      <script type="text/javascript">
             function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
            </script> 
      <script type="text/javascript" src="javascript/resend_otp.js"></script> 
    </head>
   <body  style=" background-image:url('images/login_bg.jpg'); ">
        <div class="first_shadow">  
       <?php 
include_once 'ajax_loader_page.php';
      ?>
            <input type="hidden" id="otp_unqiue_id" name="otp_unqiue_id" value="<?php echo $otp_unqiue_id;?>">
            <form action="" method="post" onsubmit="return verify_validate();" enctype="multipart/form-data">
            <div class="login_first_div" style="  width:410px;">
                <table cellspacing="5" cellpadding="5" id="user_first_table">
                <tr>
                   
                    <td colspan="3">
                <center>
                    <div class="company_image" style=" margin:0 auto; "><img class="school_image" style=" height:90px; " src="<?php  echo $company_logo;?>"></div>
                </center>
                </td>    
                </tr>
                </tr>
                
                <tr>
                    <td colspan="3">
                    
                  <?php
                 if(isset($_SESSION['admin_session_on']))
                  {
                  $admin_unique_id=$_SESSION['admin_session_on'];
                  
                  $admin_db=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id='$admin_unique_id'");
                  $admin_data=mysql_fetch_array($admin_db);
                  $admin_num_rows=mysql_num_rows($admin_db);
                  if((!empty($admin_data))&&($admin_data!=null)&&($admin_num_rows!=0))
                  {
                  
                   $reg_mobile_no=$admin_data['mobile_number'];
                   $reg_email=$admin_data['email_id'];
                      
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
                        
                        
                <center>
                    <p style=" font-size:0.95em; ">6-digit One Time Password (OTP)
                        has been <span id="resned_notify">sent</span> to<br/> your <?php echo $print_mobile;?>
                        <?php echo $print_email;?>.
                           </p>   
                </center>
                       
                    </td> 
                </tr>
                <tr>
                <td colspan="3">
                    <table style=" width:100%;  margin:0 auto; margin-left: 10px; ">
                       <tr>
                    <td><b>OTP Code <sup>*</sup></b></td>
                    <td><b>:</b></td>
                <td><input type="password" maxlength="6" onkeypress="javascript:return isNumber (event)" autocomplete="off" id="otp_code" name="otp_code"
                          value="123456" class="text_box_style" style=" width:220px; text-align:center;  "
                           placeholder="Enter One Time Password (OTP)"></td>
                </tr>
                <tr>
                    <td style=" height:8px; "> </td>
                </tr>
                 <tr>
                    <td  colspan="3" style=" color:#999;">
                 <center>
                        <p style="font-size:0.80em;  ">
                            If you do not receive the OTP in 1 minute,Click to
                            <input type="button" onclick="resend_otp_password()" class='resend_button' value='Resend OTP'>
                        </p>
                 </center>
                    </td>
                </tr>  
                    </table>        
                </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        
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
                    <td colspan="3">
                       
                    <input type="submit" name="user_login_button" id="login_button" value="Verify">    
                    </td>
                </tr>
               
            </table>
                     
                     
                     
                     
                 </form>
            </div>   
        </div>
    </body>
</html>
<?php 
}
}else
{
    header("Location:loginPage.php");   
}
}else
{
    header("Location:organisation_details.php");   
}
?>