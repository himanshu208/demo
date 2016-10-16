<?php 
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
{
?>
<?php 
    
        if(isset($_SESSION['verify_account_permission']))
        {
     if(!empty($_REQUEST['return_url']))
     { 
      $return_url=$_REQUEST['return_url'];  
      header("Location:account_verify.php?return_url=$return_url");  
    }else
    {   
    header("Location:account_verify.php");   
    }
        }else
if(isset($_SESSION['super_admin_session_on']))
{
    
    if(!empty($_REQUEST['return_url']))
     { 
      $return_url=$_REQUEST['return_url'];  
       header("Location:$return_url");  
    }else
    {
  header("Location:superadmin/dashboard.php");  
    }
}else
    if(isset($_SESSION['admin_session_on']))
    {
     if(!empty($_REQUEST['return_url']))
     { 
       $return_url=$_REQUEST['return_url'];  
       header("Location:$return_url");  
     }else
     {
    header("Location:dashboard.php");
     }
    }
       
?>


<?php 
$message_show_alert="";
require_once 'connection.php';
if(!empty($_POST['user_login_button']))
{
     
$login_user_name=mysql_real_escape_string($_POST['login_user_name']);
$password_user=mysql_real_escape_string($_POST['login_user_password']);
$security_code=trim($_POST['captcha_code']);
$to_check=md5($security_code);


if((!empty($security_code))&&(!empty($login_user_name))&&($login_user_name!=null)&&(!empty($password_user))&&($password_user!=null))
{
  if($to_check==$_SESSION['security_code'])
{  
    
      $password_static="AMITBHATI_1"; 
      $both_password=$password_user.$password_static;
      $password_encrypt=md5(md5(md5($both_password)));
      
 $select_login_user=mysql_query("SELECT * FROM login_user_db WHERE user_name='$login_user_name' and password='$password_encrypt' and action='active'");   
 $login_user_record_match=mysql_fetch_array($select_login_user);
 $login_user_num_rows_match=mysql_num_rows($select_login_user);
  if((!empty($login_user_record_match))&&($login_user_num_rows_match!=null)&&($login_user_num_rows_match!=0))
  {
   $fetch_account_type=$login_user_record_match['account_type'];
   $fetch_login_user_id=$login_user_record_match['user_admin_id'];
   $fetch_school_id=$login_user_record_match['organization_id'];
   $fetch_branch_id=$login_user_record_match['branch_id'];
   
   
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s");
$today_date=date("Y-m-d");
$date_time=$today_date." ".$time_current;
    
   
   
   
   $select_last_login_db=  mysql_query("SELECT * FROM admin_last_login_date_db WHERE organization_id='$fetch_school_id'"
           . " and branch_id='$fetch_branch_id' and user_admin_id='$fetch_login_user_id' ORDER BY id DESC");
   $fecth_user_last_login_data=mysql_fetch_array($select_last_login_db);
   $fecth_user_last_login_num_rows=mysql_num_rows($select_last_login_db);
   if((!empty($fecth_user_last_login_data))&&($fecth_user_last_login_data!=null)&&($fecth_user_last_login_num_rows!=0))
   {
    $fecth_last_login_date_time=$fecth_user_last_login_data['last_login_data_time'];   
   }else
   {
   $fecth_last_login_date_time=$date_time;
   }
   
$result=mysql_query("SHOW TABLE STATUS LIKE 'admin_last_login_date_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_last_login_id="LAST_LOGIN_ID_$nextId";
$encrypt_id=md5($final_last_login_id);

   
$insert_last_login_db=mysql_query("INSERT into admin_last_login_date_db values('','$fetch_school_id','$fetch_branch_id'"
        . ",'$final_last_login_id','$encrypt_id','$fetch_login_user_id','$date_time','','','','123456','none','active')");
   if((!empty($insert_last_login_db))&&($insert_last_login_db))    
   {
       
       
       
   if($fetch_account_type=="super_admin")
   {
    
    $_SESSION['verify_account_permission']=$fetch_login_user_id;    
    $_SESSION['super_admin_session_on']=$fetch_login_user_id; 
    $_SESSION['last_login_date']=$fecth_last_login_date_time;
    $_SESSION['otp_encrypt_id']=$final_last_login_id;
  if(isset($_SESSION['verify_account_permission']))
   {
     header("Location:account_verify.php");  
   }else
    if(isset($_SESSION['super_admin_session_on']))
    {
    if(!empty($_REQUEST['return_url']))
   {
   $return_url=$_REQUEST['return_url'];
   header("Location:$return_url");
   }else
   {    
    header("Location:superadmin/dashboard.php");
   }
   }
    
    
   }else
   {  
   $_SESSION['verify_account_permission']=$fetch_login_user_id;    
   $_SESSION['admin_session_on']=$fetch_login_user_id;  
   $_SESSION["finance_module"]=$fetch_login_user_id;
   $_SESSION['last_login_date']=$fecth_last_login_date_time;
   $_SESSION['otp_encrypt_id']=$final_last_login_id;
   if(isset($_SESSION['verify_account_permission']))
   {
       
   header("Location:account_verify.php");    
   }else
   if(isset($_SESSION['admin_session_on']))
   {
   if(!empty($_REQUEST['return_url']))
   {
   $return_url=$_REQUEST['return_url'];
   header("Location:$return_url");
   }else
   {
   header("Location:dashboard.php");
   }
   }
   }  
   
   
   
   
   
   
  }else 
  {
      $message_show_alert="Request failed,please try again later"; 
  }
  }else
  {
      $message_show_alert="Please correct fill username and password"; 
  }
 }else
{
$message_show_alert="Please enter valid captcha security code.";    
}
}else
{
$message_show_alert="Please fill all fields.";    
}
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <link href="stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       <title>Pixabyte</title>
       
       
       <script type="text/javascript">
           function login_page_validate()
           {
              
               var user_name=document.getElementById("user_name").value;
               var password=document.getElementById("password_from_user").value;
               var captcha_code=document.getElementById("captcha_code").value;
               if(user_name==0)
                   {
                    alert("Please enter username");  
                    document.getElementById("user_name").focus();
                    return false;
                   }else
                       if(password==0)
                           {
                            alert("Please enter password");
                            document.getElementById("password_from_user").focus();
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
       
       
       
    </head>
    <body  style=" background-image:url('images/login_bg.jpg'); ">
        <div class="first_shadow">  
       <?php 
include_once 'ajax_loader_page.php';
      ?>
        <form action="" onsubmit="return login_page_validate();" method="post" enctype="multipart/form-data">
        <div  class="login_first_div">
            <table cellspacing="5" cellpadding="5" id="user_first_table">
                <tr>
                   
                    <td colspan="3">
                <center>
                    <div class="company_image" style=" margin:0 auto; "><img class="school_image" src="<?php  echo $company_logo;?>"></div>
                </center>
                </td>    
                </tr>
                
                <tr>
                    
                    <td>
                     <?php 
                       if(!empty($message_show_alert))
                       {
                           echo "<div class='notification_show_alert'>$message_show_alert</div>";
                       }
                       ?> 
                        
                    </td>
                </tr>
                <tr>
                    
                <td>
				<input type="text" autocomplete="off" id="user_name" name="login_user_name" class="text_box_style" placeholder="Username"></td>
                </tr>
                <tr>
                    
                <td>
			
				<input type="password" autocomplete="off" id="password_from_user" name="login_user_password" class="text_box_style" placeholder="Password"></td>
                </tr>
                
                 <tr>
                     
                    <td  colspan="2" style=" ">
                        <p style=" float:left; font-weight:100;  margin-left:0.8em; "><input type="checkbox"> Remember me</p>
                        <p style=" float:right;font-weight:100;  "><input type="checkbox"> Forget Password</p>
                    
                    </td>
                </tr>
                
                <tr>
                    
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
                    <input type="submit" name="user_login_button" id="login_button" value="Log In">    
                    </td>
                </tr>
                
            </table>   
            
        </div></form>
    </body>
</html>
<?php 
}
}else
{
    header("Location:organisation_details.php");   
}
?>