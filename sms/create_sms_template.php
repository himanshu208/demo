<?php
//SESSION CONFIGURATION
$check_array_in="sms_module";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php
$message_show="";
require_once '../connection.php';
if(isset($_POST['submit_process']))
{
    
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
    
$result=mysql_query("SHOW TABLE STATUS LIKE 'sms_template_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_sms_message_id="MSG_TMP_$nextId"; 
$encrypt_id=md5(md5($final_sms_message_id)); 


 $message_type=$_POST['message_type'];
 $template_name=$_POST['message_name'];
 $template=$_POST['description'];
 $insert_session=$_POST['use_inset_session_id'];
 
 if((!empty($message_type))&&(!empty($template_name))&&(!empty($template))&&(!empty($final_sms_message_id)))
 {
    
  $select_db=mysql_query("SELECT * FROM sms_template_db WHERE $db_main_details_whout_session message_type_id='$message_type' "
          . "and template_name='$template_name' and sms_template='$template'");  
  $select_num_rows=mysql_num_rows($select_db);
  if($select_num_rows==0)
  {
  $insert_db=  mysql_query("INSERT into sms_template_db values('','$fetch_school_id','$fetch_branch_id','$insert_session'"
          . ",'$final_sms_message_id','$encrypt_id','$message_type','$template_name','$template','none','$date','$date','$date_time')");  
      
   if((!empty($insert_db))&&($insert_db))
   {
    $message_show="Record save successfully complete";    
   }else
   {
   $message_show="Request failed,Please try again.";      
   }
      
  }else
  {
   $message_show="Record already exist in database";      
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
        function validate_form()
        {
         var message_type=document.getElementById("message_type").value;
         var template_name=document.getElementById("message_name").value;
         var template=document.getElementById("description").value;
         if(message_type==0)
         {
            alert("Please select message type");
            document.getElementById("message_type").focus();
            return false;
         }else
             if(template_name==0)
         {
            alert("Please enter template name");
            document.getElementById("message_name").focus();
            return false;
         }else
             if(template==0)
         {
         alert("Please enter template");
         document.getElementById("description").focus();
         return false;
         }
         
         
        }
        </script>
    </head>
    <body>
        <div id="include_header_page">
          <?php 
include_once '../ajax_loader_page_second.php';
          ?>
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" name="myForm" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
        
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="sms_dashboard.php">SMS (Phone/Email)</a></td>
                           <td>/</td>
                           <td><a href="manage_template.php">Manage Template</a></td>
                           <td>/</td>
                           <td><a href="sms_template.php">SMS Template</a></td>
                           <td>/</td>
                           <td>Create SMS Template</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Create SMS Template</b></div>
                </div>
                 
                
              <div class="middle_left_div_tag">
              <div style=" width:100%; height:10px; "></div>
              <a href="sms_template.php">
                  <div class="add_button" style=" background-color:darkgreen; height:30px;
                       float:right;  padding-top:12px;   ">View All Template</div></a> 
              
              <div style=" width:100%; height:auto; margin-top:20px;float:left; ">
              
                  
                  <table cellsapcing="4" cellpadding="4" class="table_middle">
                       <tr>
                           <td><br/></td>
                       </tr>
                       <tr>
                           <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                       </tr>
                      
                       <tr>
                       <td>Message Type <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                           <select class="select_class" id="message_type" name="message_type">
                               <option value="0">--Select--</option> 
                             <?php 
 $sms_message_type_db=mysql_query("SELECT * FROM sms_message_type_db WHERE $db_main_details_whout_session is_delete='none'");   
                     while ($fetch_sms_message_type_data=mysql_fetch_array($sms_message_type_db))
                     {
                       
                                 $fetch_sms_message_type_db_id=$fetch_sms_message_type_data['id'];
                                 $fetch_sms_message_type_unique_id=$fetch_sms_message_type_data['message_type_id'];
                                 $encrypt_id=$fetch_sms_message_type_data['encrypt_id'];
                                 $fetch_sms_message_type_name=$fetch_sms_message_type_data['message_type'];
                                $fetch_sms_message_type_description=$fetch_sms_message_type_data['description'];
                                echo "<option value='$fetch_sms_message_type_unique_id'>$fetch_sms_message_type_name</option>";
                                
                     }
?>
                           </select>    
                       </td>
                       <td><abbr title="Add New Message Type"><a href="manage_message_type.php"><div class="add_button_styles">Add</div></a></abbr></td>
                       </tr>
                      
                       
                       <tr>
                       <td>Template Name<sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="message_name" name="message_name" 
                                  placeholder="Enter Template Name" class="text_box_class">
                          </td>
                       </tr>
                       
                     
                   
                       <tr>
                           <td colspan="2"></td>
                           <td><div class="message_instruction" style=" padding:10px; width:560px; ">
If you want to incoorporate student information from the database in the message,
then you have to include certain codes in the place of student information.<br/><br/> 
The codes are:<br/> 
Code for student ( Studnet Name :#name# , Course : #course# , Batch : #batch# ).
                                   
                               </div></td>
                       </tr>
                       <tr>
                       <td>Template</td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter template"
                                     class="text_area_class" style=" width:560px; "></textarea></td>
                       </tr>
                       
                       <tr>
                           <td colspan="3">
                                <input type="submit" class="submit_process" name="submit_process" value="Save"> 
                               
                               
                           </td>
                       </tr>
                   </table>    
                   
                     
                </div>  
              </div>
              </div> 
              </div>
        
        
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