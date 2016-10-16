<?php
//SESSION CONFIGURATION
$check_array_in="telephone_diary";
require_once '../config/configuration.php';
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

        $group_id=$_POST['group_name'];
        $name=$_POST['person_name'];
        $organization=$_POST['organization'];
        $phone_no=$_POST['phone_number'];
        $mobile_no=$_POST['mobile_number'];
        $email=$_POST['email'];
        $note=$_POST['note'];
         
$result=mysql_query("SHOW TABLE STATUS LIKE 'contact_no_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_db_id="CNTCT_$nextId"; 
$encrypt_id=md5(md5($final_db_id));

         $insert_session=$_POST['use_inset_session_id'];
        if((!empty($group_id))&&(!empty($name))&&(!empty($organization))&&(!empty($mobile_no))&&(!empty($final_db_id)))
        {
     $select_db=mysql_query("SELECT * FROM contact_no_db WHERE $db_main_details_whout_session group_id='$group_id' and name='$name' and is_delete='none' "
             . " OR $db_main_details_whout_session mobile_number='$mobile_no' and is_delete='none'"); 
      $select_num_rows=mysql_num_rows($select_db);
      if((empty($select_num_rows))&&($select_num_rows==0))
      {
         
      $insert_db=mysql_query("INSERT into contact_no_db values('','$fetch_school_id','$fetch_branch_id','$insert_session'"
              . ",'$final_db_id','$encrypt_id','$group_id','$name','$organization','$phone_no','$mobile_no','$email','$note','none','$date'"
              . ",'$date_time','$user_unique_id')");    
        if($insert_db) 
        {
         $message_show="Record save successfully complate";     
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

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
        function validateForm()
        {
       var group=document.getElementById("group_id").value;
       var name=document.getElementById("name").value;
       var organization=document.getElementById("organization").value;
       var mobile_no=document.getElementById("mobile_number").value;
       
       if(group==0)
       {
          alert("Please select group");
          document.getElementById("group_id").focus();
          return false;
       }else
           if(name==0)
       {
           alert("Please enter name");
           document.getElementById("name").focus();
           return false;
           
       }else
           if(organization==0)
       {
          alert("Please enter organization");
          document.getElementById("organization").focus();
          return false;
       }else
           if(mobile_no==0)
       {
          alert("Please enter mobile number");
          document.getElementById("mobile_number").focus();
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
       
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="telephonediary_report.php">Telephone Diary</a></td>
                           <td>/</td>
                           <td>Add New Contact</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button"><div id="transport_function" class="Short_menu_show"><b>Add New Contact</b></div>
                    <a href="list_of_contact.php">
                        <div class="view_button">List Of Contact</div></a>
                </div>
                
                
               <div id="main_work_div">
                   <div id="div_search_top">
                  
                       <table cellspacing="3" cellpadding="3" class="middle_table_show" style=" font-size:12px; ">
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
                                
                                echo "<option value='$fetch_contact_group_db_id'>$fetch_contact_group_name</option>";       
                     }
                                       ?>
                                   </select></td>
                                   <td><a href="manage_contact_group.php"><input type="button" class="add_button_style" value="Add Group"></a></td>
                           </tr>
                           
                           
                           <tr>
                               <td><b>Name</b> <sup style=" color:red; ">*</sup></td>
                           <td><b>:</b></td>
                           <td><input placeholder="Enter Name" id="name" name="person_name" class="text_box_class" type="text"></td>
                           </tr>
                           
                           <tr>
                               <td><b>Organization</b> <sup style=" color:red; ">*</sup></td>
                           <td><b>:</b></td>
                           <td><input placeholder="Enter Organization" name="organization" id="organization" class="text_box_class" type="text"></td>
                           </tr>
                           
                           <tr>
                               <td><b>Phone Number</b></td>
                           <td><b>:</b></td>
                           <td><input placeholder="Enter Phone Number" id="phone_number" name="phone_number" class="text_box_class" type="text"></td>
                           </tr>
                           
                           <tr>
                               <td><b>Mobile Number</b> <sup style=" color:red; ">*</sup></td>
                           <td><b>:</b></td>
                           <td><input placeholder="Enter Mobile Number" id="mobile_number" name="mobile_number" class="text_box_class" type="text"></td>
                           </tr>
                           
                           <tr>
                               <td><b>Email</b></td>
                           <td><b>:</b></td>
                           <td><input placeholder="Enter Email" id="email" name="email" class="text_box_class" type="text"></td>
                           </tr>
                           
                           
                           <tr>
                               <td><b>Note</b></td>
                           <td><b>:</b></td>
                           <td><textarea placeholder="Enter Note" id="note" name="note" class="text_area_class"></textarea></td>
                           </tr>
                           
                           
                           <tr>
                               <td colspan="3">
                                   
                                   <input  class="button_style_ing" type="submit" name="save_button" value="Save">
                                   <input class="button_style_ing" style=" margin-right:10px; background-color:deeppink;  " type="button" value="Reset">  
                               </td>
                           </tr>
                       </table>   
                       
                       
                       
                   </div>
                   
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