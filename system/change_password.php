<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
  <?php    
  $message_show="";
  if(isset($_POST['password_change_button']))
  {
   $admin_unique_insert_id=$_POST['change_admin_id'];
   $old_password=$_POST['old_password'];
           $new_password=$_POST['new_password'];
           $confirm_password=$_POST['confirm_password'];
   if((!empty($admin_unique_insert_id))&&(!empty($old_password))&&(!empty($new_password))&&(!empty($confirm_password)))
   {
   if($new_password==$confirm_password)
   {
    
       $password_static="AMITBHATI_1"; 
       $both_password=$old_password.$password_static;
       $password_encrypt=md5(md5(md5($both_password)));     
       
    $check_match_password=mysql_query("SELECT * FROM login_user_db WHERE organization_id='$fetch_school_id' and"
            . " branch_id='$fetch_branch_id' and user_admin_id='$admin_unique_insert_id' and password='$password_encrypt' and action='active'");   
    $fetch_old_password_data=mysql_fetch_array($check_match_password);
    $fetch_old_password_num_rows=mysql_num_rows($check_match_password);
    if((!empty($fetch_old_password_data))&&($fetch_old_password_data!=null)&&($fetch_old_password_num_rows!=0))
    {
     
        $password_static="AMITBHATI_1"; 
       $both_passwordS=$new_password.$password_static;
       $new_password_encrypt=md5(md5(md5($both_passwordS)));     
       
        
    $update_password_db=mysql_query("UPDATE login_user_db SET password='$new_password_encrypt' WHERE organization_id='$fetch_school_id' and"
            . " branch_id='$fetch_branch_id' and user_admin_id='$admin_unique_insert_id' and password='$password_encrypt' and action='active'");    
        
      if((!empty($update_password_db))&&($update_password_db)) 
      {
      $message_show="<span style='color:green;'>Password change successfully complete.</span>"; 
      }else
      {
       $message_show="<span style='color:red;'>Sorry request failed, Please try again.</span>"; 
        
      }
          
        
    }else
    {
     $message_show="<span style='color:red;'>Old password did`t match.</span>"; 
    }
   }else
   {
    $message_show="<span style='color:red;'>New password and old password did`t match.<br/>Please enter confirm password again.</span>"; 
      
   }
   }else
   {
     $message_show="<span style='color:red;'>Please fill all fields.</span>"; 
   }
   
   require_once '../pop_up.php';
  }
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Change Password</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="../javascript/password_strength.js"></script>
        <script type="text/javascript">
        function confirmChanged(confirm_password)
        {
       var new_password=document.getElementById("new_password").value;  
       if(new_password==confirm_password)
       {
         document.getElementById("match_password").style.display="block";  
       }else
       {
         document.getElementById("match_password").style.display="none";  
       
       }
        }
        
        </script>
        
        <script type="text/javascript">
            function validateForm()
            {
                   var old_password=document.getElementById("old_password").value;
                    var new_password=document.getElementById("new_password").value;
                    var confirm_password=document.getElementById("confirm_password").value;
                    
                   if(old_password==0)
                   {
                      alert("Please enter old password");
                      document.getElementById("old_password").focus();
                      return false;
                   }else
                       if(new_password==0)
                   {
                      alert("Please enter new password");
                      document.getElementById("new_password").focus();
                      return false;
                   }else
                       if(confirm_password==0)
                   {
                      alert("Please enter confirm password");
                      document.getElementById("confirm_password").focus();
                      return false;
                   }else
                       if(new_password!=confirm_password)
                   {
                      alert("New Password and Confirm Password did`t match.\n\
          Please enter confirm password again");
            document.getElementById("confirm_password").focus();
            return false;
                   }
                    
            }
        </script>
        
        
    </head>
    <body>
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" method="post" onsubmit="return validateForm();" enctype="multipart/form-data">
       
            <input type="hidden" name="change_admin_id" value="<?php  echo $fecth_user_unique;?>">
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="system_dashboard.php">System Setting</a></td>
                           <td>/</td>
                           <td>Change Password</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Change Password</b></div></div>
                
               <div class="main_work_data" style=" padding-top:20px;">
                 
                 <table cellspacing="4" cellpadding="4" id="org_table_style" style=" font-size:12px; 
                        margin:0 auto; margin-top:10%; width:auto;   ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr>
                        <td><b>Old Password</b></td><td><b>:</b></td>
                        <td><input type="password" autocomplete="off" class="text_box_org" name="old_password" placeholder="Enter old password" id="old_password"></td>
                        <td></td></tr>
                     <tr>
                        <td><b>New Password</b></td><td><b>:</b></td>
                        <td><input type="password" autocomplete="off" class="text_box_org" name="new_password"
                                   placeholder="Enter new password" id="new_password" size="15" maxlength="20"  onkeyup="return passwordChanged();" /></td>
                        <td><span id="result"><div class="result_show"></div></span></td>
                    </tr>
                     <tr>
                        <td><b>Confirm Password</b></td><td><b>:</b></td>
                        <td><input type="password" autocomplete="off" class="text_box_org" size="15" maxlength="20"
                                   name="confirm_password" placeholder="Enter confirm password" onkeyup="return confirmChanged(this.value);" id="confirm_password"></td>
                        <td><div class="result_show" style="background-color: green;  display:none; " id="match_password">Match Password</div></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="submit" class="change_password" name="password_change_button" value="Change Password">
                        </td>
                    </tr>
                 </table>
                  
               </div>      
              
               
               
            </div> 
        </div>
        </form>
        
        <div id="include_fotter_page">
       <?php 
         require_once '../fotter/fotter_page.php';
         
         ?>   
        </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>