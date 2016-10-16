<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>
<?php
if(isset($_POST['save_button']))
{
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

        $update_db_id=$_POST['update_unique_id'];
        $group_id=$_POST['group_name'];
        $name=$_POST['person_name'];
        $organization=$_POST['organization'];
        $phone_no=$_POST['phone_number'];
        $mobile_no=$_POST['mobile_number'];
        $email=$_POST['email'];
        $note=$_POST['note'];
         

         $insert_session=$_POST['use_inset_session_id'];
        if((!empty($group_id))&&(!empty($update_db_id))&&(!empty($name))&&(!empty($organization))&&(!empty($mobile_no)))
        {
     $select_db=mysql_query("SELECT * FROM contact_no_db WHERE $db_main_details_whout_session contact_id!='$update_db_id' and group_id='$group_id' and name='$name' and is_delete='none' "
             . " OR $db_main_details_whout_session contact_id!='$update_db_id' and mobile_number='$mobile_no' and is_delete='none'"); 
      $select_num_rows=mysql_num_rows($select_db);
      if((empty($select_num_rows))&&($select_num_rows==0))
      {
       
    $update_db=mysql_query("UPDATE contact_no_db SET group_id='$group_id',name='$name',organization='$organization',"
            . "phone_number='$phone_no',mobile_number='$mobile_no',email='$email',note='$note' WHERE contact_id='$update_db_id' and is_delete='none'");  
        if($update_db) 
        {
         $message_show="Record update successfully complate";     
        }else
        {
          $message_show="Request failed,Please try again";    
        }
      }else
      {
        $message_show="Record already exist in database.";    
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
        <title>Edit Contact</title>
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
                <div class="title_name">Edit Contact Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];
             
            $select_data=mysql_query("SELECT * FROM contact_no_db WHERE encrypt_id='$token_id' and is_delete='none'"); 
            $contact_data=mysql_fetch_array($select_data);
            $fetch_num_data=mysql_num_rows($select_data);
            if((!empty($contact_data))&&($contact_data!=null)&&($fetch_num_data!=0))
            {
            
              $session_id=$contact_data['session_id'];    
               $fetch_contact_id=$contact_data['contact_id'];
                    $encrypt_id=$contact_data['encrypt_id'];
                    $group=$contact_data['group_id'];
                            $name=$contact_data['name'];
                            $organization=$contact_data['organization'];
                            $phone_no=$contact_data['phone_number'];
                            $mobile_no=$contact_data['mobile_number'];
                            $email_id=$contact_data['email'];
                            $note=$contact_data['note'];
             {
             ?>  
              <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $fetch_contact_id;?>">
             <input type="hidden" name="use_inset_session_id" id="insert_session_id"  value="<?php  echo $session_id;?>">   
      
                <table cellspacing="3" cellpadding="3" class="middle_table_show" style=" font-size:12px; width:auto; margin:auto;   ">
                           <tr>
                               <td><b>Group</b> <sup style=" color:red; ">*</sup></td>
                               <td><b>:</b></td>
                               <td><select id="group_id" name="group_name" class="select_style_box">
                                       <option value="0">---Select Group---</option>
                                       <?php
                                        $contact_group_db=mysql_query("SELECT * FROM contact_group_db WHERE $db_main_details_whout_session is_delete='none'");   
                     while ($fetch_contact_group_data=mysql_fetch_array($contact_group_db))
                     {
                  
                                $fetch_contact_group_db_id=$fetch_contact_group_data['id'];
                                $fetch_contact_group_name=ucwords($fetch_contact_group_data['group_name']) ;
                                $fetch_contact_group_description=$fetch_contact_group_data['description'];
                                if($group==$fetch_contact_group_db_id)
                                {
                                echo "<option value='$fetch_contact_group_db_id' selected>$fetch_contact_group_name</option>";       
                                }else
                                {
                                  echo "<option value='$fetch_contact_group_db_id'>$fetch_contact_group_name</option>";       
                                   
                                }
                                }
                                       ?>
                                   </select></td>
                                   </tr>
                           
                           
                           <tr>
                               <td><b>Name</b> <sup style=" color:red; ">*</sup></td>
                           <td><b>:</b></td>
                           <td><input placeholder="Enter Name" value="<?php echo $name;?>" id="name" name="person_name" class="text_box_class" type="text"></td>
                           </tr>
                           
                           <tr>
                               <td><b>Organization</b> <sup style=" color:red; ">*</sup></td>
                           <td><b>:</b></td>
                           <td><input placeholder="Enter Organization" value="<?php echo $organization;?>" name="organization" id="organization" class="text_box_class" type="text"></td>
                           </tr>
                           
                           <tr>
                               <td><b>Phone Number</b></td>
                           <td><b>:</b></td>
                           <td><input placeholder="Enter Phone Number" value="<?php echo $phone_no;?>" id="phone_number" name="phone_number" class="text_box_class" type="text"></td>
                           </tr>
                           
                           <tr>
                               <td><b>Mobile Number</b> <sup style=" color:red; ">*</sup></td>
                           <td><b>:</b></td>
                           <td><input placeholder="Enter Mobile Number" value="<?php echo $mobile_no;?>" id="mobile_number" name="mobile_number" class="text_box_class" type="text"></td>
                           </tr>
                           
                           <tr>
                               <td><b>Email</b></td>
                           <td><b>:</b></td>
                           <td><input placeholder="Enter Email" id="email" value="<?php echo $email_id;?>" name="email" class="text_box_class" type="text"></td>
                           </tr>
                           
                           
                           <tr>
                               <td><b>Note</b></td>
                           <td><b>:</b></td>
                           <td><textarea placeholder="Enter Note" id="note" name="note" class="text_area_class"><?php echo $note;?></textarea></td>
                           </tr>
                           
                           
                           <tr>
                               <td colspan="3">
                                   
                                   <input  class="button_style_ing" type="submit" name="save_button" value="Update">
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