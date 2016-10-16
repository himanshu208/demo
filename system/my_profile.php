<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>My Profile</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        
    </head>
    <body>
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" method="post" onsubmit="return validateForm();" enctype="multipart/form-data">
       
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="system_dashboard.php">System Setting</a></td>
                           <td>/</td>
                           <td>My Profile</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                
              
            <?php
              $admin_db=mysql_query("SELECT * FROM login_user_db WHERE $db_main_details_whout_session user_admin_id='$user_unique_id'");
            $admin_fetch_data=mysql_fetch_array($admin_db);
            $admin_fetch_num_rows=mysql_num_rows($admin_db);
            if((!empty($admin_fetch_data))&&($admin_fetch_data!=null)&&($admin_fetch_num_rows!=0))
            {
             $admin_encrypt_id=$admin_fetch_data['user_admin_encrypt_id'];
             
                     $admin_name=ucwords($admin_fetch_data['full_name']);
                     $gender=ucwords($admin_fetch_data['gender']);
                     $dob=$admin_fetch_data['date_of_birth'];
                     $mobile=$admin_fetch_data['mobile_number'];
                     $email=$admin_fetch_data['email_id'];
                     $father=$admin_fetch_data['father_name'];
                     $address=$admin_fetch_data['address'];
                     $qualification=$admin_fetch_data['qualification'];
                     $private_note=$admin_fetch_data['private_note'];
                     $profile_photo=$admin_fetch_data['profile_picture'];
                     
                     $admin_role=$admin_fetch_data['account_type'];
                     $user_name=$admin_fetch_data['user_name'];
                     
                     if($admin_role=="branch_head_admin")
                     {
                      $admin_role="Branch Head Admin";   
                     }else
                     {
                        $admin_role=""; 
                     }
                     
                     
    if((empty($profile_photo))||(!is_file("../".$profile_photo)))
    {
    $profile_photo="images/no_avilable_image.gif";    
    }
                     
             
            {
             ?>
              <div id="top_show_button">
                    <div id="transport_function" class="Short_menu_show"><b>My Profile</b></div>
                     
                </div>
                <div class="main_work_data" style=" padding-top:20px;">
                <div class="middle_left_div_tag">
                   
                   <table class="branch_details_table">
                       <tr>
                        <td colspan="6" style=" font-size:16px; "><b>My Personal Details</b><br/>
                        <div class="horizental_line_ed"></div>
                        </td>
                       </tr>
                       <tr>
                           <td><b>Name</b></td><td><b>:</b></td><td><?php echo $admin_name;?></td>
                           <td rowspan="8"  colspan="4" valign="top">
                               <table style=" margin:0; padding:0;  ">
                                   <tr>
                                       <td><div class="branch_logo_show">
                                               <img class="show_logo" src='../<?php echo $profile_photo;?>'> 
                                           </div></td>
                                   </tr>
                                   <tr>
                                       <td style=" font-size:15px; "><centeR><b>Profile Picture</b></centeR></td>
                                   </tr>
                               </table>
                           </td>
                       </tr>
                       <tr>
                           <td><b>Gender</b></td><td><b>:</b></td><td><?php echo $gender;?></td>
                       </tr>
                       <tr>
                           <td><b>Date Of Birth</b></td><td><b>:</b></td><td><?php echo $dob;?></td>
                       </tr>
                        <tr>
                            <td><b>Mobile Number</b></td><td><b>:</b></td><td><?php echo $mobile;?></td>
                       </tr>
                        <tr>
                            <td><b>Email ID</b></td><td><b>:</b></td><td><?php echo $email;?></td>
                       </tr>
                       <tr>
                           <td><b>Father Name</b></td><td><b>:</b></td><td><?php echo $father;?></td>
                       </tr>
                       <tr>
                           <td><b>Qualification</b></td><td><b>:</b></td><td><?php echo $qualification;?></td>
                       </tr>
                       <tr>
                           <td><b>Address</b></td><td><b>:</b></td><td><?php echo $address;?></td>
                       </tr>
                        <tr>
                            <td><b>Private Note</b></td><td><b>:</b></td><td><?php echo $private_note;?></td>
                       </tr>
                       
                       <tr>
                        <td colspan="6" style=" font-size:16px; "><b>Account Detail</b><br/>
                        <div class="horizental_line_ed"></div>
                        </td>
                       </tr>
                       <tr>
                           <td colspan="6">
                               <table style=" width:100%; ">
                        <tr>
                            <td><b>Administration Role</b></td><td><b>:</b></td><td><?php echo $admin_role;?></td>
                            <td><b>User Name</b></td><td><b>:</b></td><td><?php echo $user_name;?></td>
                           <td><b>Password</b></td><td><b>:</b></td><td>*************</td>
                        </tr>  
                               </table>    
                           </td>
                       </tr>
                       <tr>
                           <td colspan="12">
                     <a style="color:blue;" href="#" onclick="window.open('log_history.php?token_id=<?php  echo $admin_encrypt_id;?>','size',config='height=650,width=1110,position=absolute,left=10,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                         <div class="view_button" style=" background-color:green; font-weight:bold; margin-top:20px;   ">Log History</div></a>  
                           </td>
                       </tr>
                       
                   </table>
                    
                    
                    
            <?php
            }  
                
            }
             ?>
              
              
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