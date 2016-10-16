<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>



<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Detail</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       
        
        <script type="text/javascript">
    window.onload = refreshParent;
    function refreshParent() {
     window.opener.location.reload();
    }
   
   function close_pop_up_this()
   {
   window.close();    
   }
   
</script>


        <script type="text/javascript">
            function ok_close()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
             function close_button()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
   document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) 
    {
       document.getElementById("win_pop_up").style.display="none";
    }else
    if (evt.keyCode == 13) 
    {
    document.getElementById("win_pop_up").style.display="none";
    }
};
            
            </script>
            
             <script type="text/javascript">
             function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
            </script> 
            
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validate_form();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Admin Detail</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                  
            <?php
           if(!empty($_REQUEST['token_id']))
           {
               $token_id=$_REQUEST['token_id'];
              $admin_db=mysql_query("SELECT * FROM login_user_db WHERE $db_main_details_whout_session"
                      . " user_admin_encrypt_id='$token_id' and is_delete='none'");
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
                        $admin_role="Admin"; 
                     }
                     
                     
    if((empty($profile_photo))||(!is_file("../".$profile_photo)))
    {
    $profile_photo="images/no_avilable_image.gif";    
    }
                     
             
            {
             ?>
            
                <div class="main_work_data" style=" padding-top:20px;">
                <div class="middle_left_div_tag">
                   
                   <table class="branch_details_table">
                       <tr>
                        <td colspan="6" style=" font-size:16px; "><b>Admin Personal Details</b><br/>
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
                     <a style="color:blue;" href="#" onclick="window.open('../system/log_history.php?token_id=<?php  echo $admin_encrypt_id;?>','size',config='height=650,width=1110,position=absolute,left=10,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                         <div class="view_button" style=" background-color:green; font-weight:bold; margin-top:20px;   ">Log History</div></a>  
                           </td>
                       </tr>
                       
                   </table>
                    
                    
                    
            <?php
            }  
            }   
            }
             ?>
            
            
            </div>
            </div>
            <div class="edit_fotter_div_tag">Design & Develop By : DIGI SHIKSHA</div>
            
            
        </div>
       </form>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>