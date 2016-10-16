<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/edit_page_configuration.php';
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
    

$final_sms_message_id=$_POST['update_unique_id'];

 $message_type=$_POST['message_type'];
 $template_name=$_POST['message_name'];
 $template=$_POST['description'];
 $insert_session=$_POST['use_inset_session_id'];
 $subject=$_POST['subject'];
 if((!empty($message_type))&&(!empty($subject))&&(!empty($template_name))&&(!empty($template))&&(!empty($final_sms_message_id)))
 {
    
  $select_db=mysql_query("SELECT * FROM sms_email_template_db WHERE $db_main_details_whout_session sms_template_id!='$final_sms_message_id' and message_type_id='$message_type' "
          . "and template_name='$template_name' and subject='$subject' and sms_template='$template'");  
  $select_num_rows=mysql_num_rows($select_db);
  if($select_num_rows==0)
  {
  
  $update_db=mysql_query("UPDATE sms_email_template_db SET message_type_id='$message_type',template_name='$template_name',subject='$subject'"
          . ",sms_template='$template',last_update_date='$date_time' WHERE sms_template_id='$final_sms_message_id' and is_delete='none'");
  
   if((!empty($update_db))&&($update_db))
   {
    $message_show="Record update successfully complete";    
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


<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Email Template</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
           <script type="text/javascript">
        function validate_form()
        {
         var message_type=document.getElementById("message_type").value;
         var template_name=document.getElementById("message_name").value;
         var subject=document.getElementById("subject").value;
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
             if(subject==0)
         {
           alert("Please enter subject");
            document.getElementById("subject").focus();
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
                <div class="title_name">Edit SMS Template</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];
             
            $select_data=mysql_query("SELECT * FROM sms_email_template_db WHERE $db_main_details encrypt_id='$token_id' and is_delete='none'"); 
            $sms_template_data=mysql_fetch_array($select_data);
            $fetch_num_data=mysql_num_rows($select_data);
            if((!empty($sms_template_data))&&($sms_template_data!=null)&&($fetch_num_data!=0))
            {
            
              $session_id=$sms_template_data['session_id'];    
              $message_id=$sms_template_data['message_type_id'];
                $template_unqiue_id=$sms_template_data['sms_template_id'];
                  $template_encrypt_id=$sms_template_data['encrypt_id'];
                 $template_name=$sms_template_data['template_name'];
                 $template=$sms_template_data['sms_template'];
                 $subject=$sms_template_data['subject'];
              
             {
             ?>  
              <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $template_unqiue_id;?>">
             <input type="hidden" name="use_inset_session_id" id="insert_session_id"  value="<?php  echo $session_id;?>">   
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
                                
                                if($message_id==$fetch_sms_message_type_unique_id)
                                {
                                echo "<option value='$fetch_sms_message_type_unique_id' selected>$fetch_sms_message_type_name</option>";
                                }  else {
                                echo "<option value='$fetch_sms_message_type_unique_id'>$fetch_sms_message_type_name</option>";
                                    
                                }
                     }
?>
                           </select>    
                       </td>
                       </tr>
                      
                       
                       <tr>
                       <td>Template Name<sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="message_name" name="message_name" 
                                  placeholder="Enter Template Name" value="<?php echo $template_name;?>" class="text_box_class">
                          </td>
                       </tr>
                       
                     
                   
                       <tr>
                           <td colspan="2"></td>
                           <td><div class="message_instruction" style=" width:450px; padding:10px;  ">
                               If you want to incoorporate student information from the database in the message, then you have to include certain codes in the place of student information.
<br/>
<br/>
The codes are:<br/>
Code for student ( Studnet Name :#name# , Course : #course# , Batch : #batch# ).
                               </div></td>
                       </tr>
                       <tr>
                       <td>Subject<sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="subject" name="subject" 
                                  placeholder="Enter Subject" value="<?php echo $subject;?>" class="text_box_class">
                          </td>
                       </tr>
                       <tr>
                           <td>Template <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter Template" 
                                     class="text_area_class"><?php echo $template;?></textarea></td>
                       </tr>
                       
                       <tr>
                           <td colspan="3">
                                <input type="submit" class="submit_process" name="submit_process" value="Update"> 
                               
                               
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