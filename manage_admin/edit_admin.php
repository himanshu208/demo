<?php
//SESSION CONFIGURATION
$check_array_in="manage_admin";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>
<?php
require_once '../connection.php';
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
$message_show="";
if(isset($_POST['submit_data_process']))
{
 
$final_school_id=$_POST['update_unique_id']; 
$module_update_db_id=$_POST['module_update_db_id'];

    $branch_id=$_POST['branch_id'];
    $account_type=$_POST['account_type'];
    $joining_date=$_POST['joining_date'];
    $full_name=$_POST['full_name'];
    $father_name=$_POST['father_name'];
    $gender=$_POST['admin_gender'];
    $date_of_birth=$_POST['date_of_birth'];
    $mobile_number=$_POST['mobile_number'];
    $email_id=$_POST['email_id'];
    $qualification_details=$_POST['qualification_details'];
    $address=$_POST['address'];
    $private_note=$_POST['private_note'];
    
    if(count($_POST['module_list'])>0)
      {
      $module_list=$_POST['module_list'];
      }else
      {
        $module_list=""; 
      }
    
    $user_name=$_POST['user_name'];
    $new_password=$_POST['new_password'];
    $retype_password=$_POST['retype_password'];
    $temp_password=$new_password;
    if((!empty($full_name))&&(!empty($module_list))&&(!empty($father_name))&&(!empty($gender))&&(!empty($mobile_number))
            &&(!empty($email_id))&&(!empty($address))&&(!empty($user_name))&&(!empty($new_password))&&(!empty($retype_password)))
    {
    if($new_password==$retype_password)
    {   
     $match_user_db=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id!='$final_school_id'
            and user_name='$user_name' and is_delete='none' OR user_admin_id!='$final_school_id'
            and mobile_number='$mobile_number' and is_delete='none' OR user_admin_id!='$final_school_id'
            and email_id='$email_id' and is_delete='none'");
     $fetch_user_data=mysql_fetch_array($match_user_db);
     $fetch_user_num_rows=mysql_num_rows($match_user_db);
     if((empty($fetch_user_data))&&($fetch_user_data==null)&&($fetch_user_num_rows==0)) 
     {
      
      if((!empty($_FILES['report_logo']))) 
       {                    
        
        $filename= $_FILES['report_logo']['name'];
        $tmpfilename = $_FILES['report_logo']['tmp_name'];
        $filesize = $_FILES['report_logo']['size'];
       
        if((!empty($filename)))
        { 
        if(($filesize<153600))
         {
        $imagesize=getimagesize($tmpfilename);
        if ((!empty($imagesize))) {
            
            date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(1000, 5000);
            $location="images/user_image/". $random . $time . $filename;
            $templocation= "images/user_image/". $random . $time;
            $upload= move_uploaded_file($tmpfilename,"../".$location);
             
          
      if(($upload))
      {  
      $insert_image=$location;
      
      }else  $message_show="Request failed,please try again";
      }else  $message_show="Invalid picture format";
      }else  $message_show="Picture size should be below 150kb";
      }else  
      {
          $insert_image=$_POST['temp_profile_picture'];
      }
      }else {
          $insert_image=$_POST['temp_profile_picture'];
      }
      $password_static="AMITBHATI_1"; 
      $both_password=$new_password.$password_static;
      $password_encrypt=md5(md5(md5($both_password)));
      
    
     $update_db=mysql_query("UPDATE login_user_db SET user_name='$user_name',password='$password_encrypt',"
             . "temp_password='$temp_password',account_type='$account_type',joining_date='$joining_date',full_name='$full_name',"
             . "father_name='$father_name',gender='$gender',date_of_birth='$date_of_birth',mobile_number='$mobile_number',email_id='$email_id',"
             . "qualification='$qualification_details',address='$address',private_note='$private_note',profile_picture='$insert_image' WHERE user_admin_id='$final_school_id' and is_delete='none'");  
      
      
       if($update_db)
       {

       $implode_module_list=implode(",",$module_list);  
       if(!empty($module_update_db_id))
       {
      $update_new_db=mysql_query("UPDATE module_db SET admin_type='$account_type',module='$implode_module_list',module_operation='' WHERE module_id='$module_update_db_id'");
        if($update_new_db)
        {
         $message_show="Record update successfully complete."; 
           
        }else
        {
         $message_show="Request failed,Please try again.";       
        }
       }else
       {
        $message_show="Record update successfully complete."; 
             
       }
         
       }else
       {
        $message_show="Request failed,Please try again.";       
       }
         
         
         
     }else
     {
       $message_show="Sorry,Record already exist in database.";    
     }
        
        
    }else
    {
       $message_show="New password & re-type password did`t match."; 
    }   
    }else
    {
       $message_show="Please fill all fields."; 
    }
    require_once '../pop_up.php';  
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
          <style>
        .text_box_org{ width:180px; font-size:11px;  }  
        .select_style{ width:192px; font-size:11px;  }
        .text_area_style{ width:180px;  font-size:11px; }
        .text_box_orges{ width:180px;  font-size:11px; }
        #report_logo{ width:180px;  font-size:11px; }
        </style>   
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Admin Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];
             
            $select_data=mysql_query("SELECT * FROM login_user_db WHERE user_admin_encrypt_id='$token_id' and is_delete='none'"); 
            $fetch_data=mysql_fetch_array($select_data);
            $fetch_num_data=mysql_num_rows($select_data);
            if((!empty($fetch_data))&&($fetch_data!=null)&&($fetch_num_data!=0))
            {
               $admin_id=$fetch_data['user_admin_id'];
            $school_id=$fetch_data['organization_id'];
                   $branch_id=$fetch_data['branch_id'];
                    $user_name=$fetch_data['user_name'];
                    $password=$fetch_data['temp_password'];
                    $account_type=$fetch_data['account_type'];
                    $joining_date=$fetch_data['joining_date'];
                    $full_name=$fetch_data['full_name'];
                    $father_name=$fetch_data['father_name'];
                    $gender=$fetch_data['gender'];
                    $dob=$fetch_data['date_of_birth'];
                    $mobile_no=$fetch_data['mobile_number'];
                    $email=$fetch_data['email_id'];
                    $qualification=$fetch_data['qualification'];
                    $address=$fetch_data['address'];
                    $private_note=$fetch_data['private_note'];
                    $profile_picture=$fetch_data['profile_picture'];
                    
             if($account_type=="branch_head_admin")
             {
              $b_check="selected";
              $a_check="";
             }else
             {
             $b_check="";
              $a_check="selected";   
             }
             
             
             if($gender=="Male")
             {
              $m_check="selected";
               $f_check="";
                      $o_check="";
             }else
                 if($gender=="Female")
                 {
                 $m_check="";
               $f_check="selected";
                      $o_check="";     
                 }else
                 {
                  $m_check="";
               $f_check="";
                      $o_check="selected";    
                 }
             
             
             {
             ?>  
              <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $admin_id;?>">
              <input type="hidden"  name="temp_profile_picture" value="<?php echo $profile_picture;?>">
             <div id="div_search_top">
                       <div class="left_admin_div">
                           <table cellspacing="2" cellpadding="2" id="org_table_style" style=" margin-top:15px; ">
                    <?php
                    $message_show="";
                     echo  $message_show;
                    ?>
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr>
                                    <td><b>School Name</b><sup>*</sup></td>
                                    <td><b>:</b></td>
                                    <td><input type="text" autocomplete="off" id="school_name"
                                   placeholder="Enter school name" class="text_box_org"
                                   name="school_name" style=" background-color:whitesmoke; "
                                   readonly="readonly" value="<?php  echo $fetch_school_name;?>"></td>
                              
                                    <td><b>Branch</b> <sup>*</sup></td>
                                    <td><b>:</b></td>
                                    <td><select name="branch_id" id="branch_name_id" style=" background-color:whitesmoke; " class="select_style">
                                           
                                      <?php 
                                        $fetch_branch_db=  mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' and branch_id='$branch_id'");
                                        while ($fetch_branch_data_fetch=  mysql_fetch_array($fetch_branch_db))
                                        {  $fetch_branch_id_print=$fetch_branch_data_fetch['branch_id'];
                                          $fetch_branch_name=$fetch_branch_data_fetch['branch_name'];
                                          echo "<option value='$fetch_branch_id_print'>$fetch_branch_name</option>";
                                       
                                            
                                        }
                                        if(empty($fetch_branch_id_print))
                                        {
                                            echo "<option value=0''>Record no found !!</option>";  
                                        }
                                        ?>
                                        </select></td>
                                </tr>
                               
                                <tr>
                                    <td>
                                        <b>Admin Role</b> <sup>*</sup>  
                                    </td>
                                    <td>
                                        <b>:</b>
                                    </td>
                                    <td>
                                        <select name="account_type" class="select_style">
                                            <option value="0">---Select---</option>
                                            <option value="branch_head_admin" <?php echo $b_check;?>>Branch Head Admin</option>
                                            <option value="admin" <?php echo $a_check;?>>Admin</option>
                                        </select>
                                    </td>
                        <td><b>Joining Date</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="joining_date"
                                   placeholder="Enter joining date" class="text_box_org"
                                   name="joining_date" value="<?php echo $joining_date;?>"></td>
                    
                                </tr>
                                <tr><td><b>Full Name</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sap_name"
                                   placeholder="Enter full name" class="text_box_org"
                                   name="full_name" value="<?php echo $full_name;?>"></td>
                   <td><b>Father Name</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sap_father_name"
                                   placeholder="Enter father name" class="text_box_org"
                                   name="father_name" value="<?php echo $father_name;?>"></td>
                    </tr>
                    <tr><td><b>Gender</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><select class="select_style" id="admin_gender" name="admin_gender">
                                <option <?php echo $m_check;?>>Male</option>   
                                <option <?php echo $f_check;?>>Female</option> 
                                <option <?php echo $o_check;?>>Other</option>   
                            </select></td>
                            <td><b>Date Of Birth</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off"  id="user_dob"
                                   placeholder="Enter date of birth" class="text_box_org"
                                   name="date_of_birth" value="<?php echo $dob;?>"></td>
                    </tr>
                    <tr><td><b>Mobile Number</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sap_mobile_no"
                                   placeholder="Enter mobile number" class="text_box_org"
                                   name="mobile_number" value="<?php echo $mobile_no;?>"></td>
                    <td><b>Email</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sap_email_id"
                                   placeholder="Enter email address" class="text_box_org"
                                   name="email_id" value="<?php echo $email;?>"></td>
                    </tr>
                    <tr>
                        <td><b>Qualification</b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea 
                               autocomplete="off" class="text_area_style" 
                               placeholder="Enter qualification details" name="qualification_details" id="address_text_area"><?php echo $qualification;?></textarea>
                        </td>
                    
                        <td><b>Address </b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="sap_address" 
                                      autocomplete="off" class="text_area_style" placeholder="Enter address"
                                      name="address" id="address_text_area"><?php echo $address;?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Private Note</b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="school_address" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter private note" name="private_note" id="address_text_area"><?php echo $private_note;?></textarea>
                        </td>
                        <td><b>Profile Picture</b></td>
                        <td><b>:</b></td>
                        <td>
                            <input id="report_logo" name="report_logo" type="file"> 
                            <?php
                            if((!empty($profile_picture))&&(is_file("../".$profile_picture)))
                            {
                            {
                           ?>
                            <input type="button" value="View"> 
                            <?php
                            }    
                            }
                            ?>
                            
                        </td>
                    </tr>
                    <tr>
                        <td style=" height:10px; "></td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Account Login Details</b></td>
                    </tr>
                    <tr>
                        <td colspan="6"><div class="verticle_line"></div></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <table cellspacing="5" style=" margin-top:10px; margin-bottom:10px;  ">
                               <tr><td><b>Username</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sap_user_name"
                                   placeholder="Enter username"  class="text_box_orges"
                                   name="user_name" value="<?php echo $user_name;?>"></td>
                    <td><b>New Password</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sap_new_password"
                                   placeholder="Enter new password" class="text_box_orges"
                                   name="new_password" value="<?php echo $password;?>"></td>
                               </tr>
                               <tr>
                   <td><b>Re-type Password</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sap_retype_password"
                                   placeholder="Enter re-type password" class="text_box_orges"
                                   name="retype_password" value="<?php echo $password;?>"></td>
                    </tr>  
                            </table>
                            
                        </td>
                    </tr>
                    
                   
                    <tr>
                        <td colspan="6">
                            <input type="submit" name="submit_data_process" class="save_button" id="save_button" style=" width:110px; margin-top:10px;  " value="Update">   
                        </td>
                    </tr>
                </table>    
                       </div>  
                       <script type="text/javascript">
        $(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.module_check_box').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.module_check_box').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});
        </script>
        <div class="right_admin_div" style=" text-align:left; ">
                           <div class="module_liststed" style=" margin-bottom:10px; ">Module Access</div> 
                       <?php
                      $module_dbs=mysql_query("SELECT * FROM module_db WHERE $db_main_details_whout_session admin_id='$admin_id'");
                      $fetch_module_datas=mysql_fetch_array($module_dbs);
                     $fetch_module_num_rowss=mysql_num_rows($module_dbs);
                     if((!empty($fetch_module_datas))&&($fetch_module_datas!=null)&&($fetch_module_num_rowss!=0))
                     {
                      $module_list=$fetch_module_datas['module'];   
                      $module_unique_id=$fetch_module_datas['module_id']; 
                     }else
                     {
                    $module_list="";    
                    $module_unique_id="";
                     }
                     
                      $module_explode=explode(",",$module_list); 
                       
                       ?>
                           <input type="hidden" name="module_update_db_id" value="<?php echo $module_unique_id;?>">
                           <?php
                       $print_admin_role="Branch Head Admin";   
                       $module_db=mysql_query("SELECT * FROM module_db WHERE $db_main_details_whout_session admin_type='branch_head_admin'");
                      $fetch_module_data=mysql_fetch_array($module_db);
                     $fetch_module_num_rows=mysql_num_rows($module_db);
                     
                     if(!empty($fetch_module_num_rows))
                     {
                     {
                      ?>
                        <div class='module_icon_set'>
                                 <table>
                                           <tr><td><input id="selecctall" class='module_check_box' type='checkbox'></td>
                                               <td><b>Select All</b></td></tr></table></div>
                           <div style=" width:100%; float:left; height:1px;   "></div>
                           <?php
                     }   
                     }
                     
                      if((!empty($fetch_module_data))&&($fetch_module_data!=null)&&($fetch_module_num_rows!=0))
                      {
                       $module_list=$fetch_module_data['module'];  
                      }else
                      {
                       $module_list="";   
                      }
                      
                       $explode_module=  explode(",",$module_list);
                               foreach($explode_module as $module_name)
                               {
                                  $explode_module_list=explode("_", $module_name); 
                                   
                                  if(!empty($explode_module_list[1]))
                                  {
                                  $a_print=ucwords($explode_module_list[1]);    
                                  }else
                                  {
                                  $a_print="";    
                                  }
                                  $ab_print=ucwords($explode_module_list[0]);
                                  if(in_array($module_name,$module_explode)==true)
                                  {
                                   echo "<div class='module_icon_set'>"
                                  . "<table>"
                                           . "<tr><td><input class='module_check_box'  name='module_list[]' value='$module_name' type='checkbox' checked></td>"
                                           . "<td>$ab_print $a_print</td></tr></table></div>"; 
                                  }  else {
                                       echo "<div class='module_icon_set'>"
                                  . "<table>"
                                           . "<tr><td><input class='module_check_box'  name='module_list[]' value='$module_name' type='checkbox'></td>"
                                           . "<td>$ab_print $a_print</td></tr></table></div>";   
                                  }
                               }
                       ?>    
                           
                           
                       </div>  
                       
                       
                       
                   </div>  
                
                
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