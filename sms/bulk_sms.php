<?php
//SESSION CONFIGURATION
$check_array_in="sms_module";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php
if(isset($_POST['send_sms_button']))
{
 require_once '../sms_email_integration/phone_sms_api.php';
 
 
 if(count($_POST['post_data'])>0)
 {
  $user_post=$_POST['post_data'];  
}else
{
 $user_post=0;   
}

$send_to=$_POST['bulk_send_to'];
$message=$_POST['message_post']; 


if((!empty($user_post))&&(!empty($message)))
{  

$mobile_number_chuck=array_chunk($user_post,190,true);  
$sms_sent_no=0;   
$log_report=array();

if(!empty($_POST['sms_language']))
{
if(!empty($_POST['sms_language']))
{
  $unicode=$_POST['sms_language'];  
}else
{
  $unicode="";  
}
}else
{
$unicode="";    
}

$result=mysql_query("SHOW TABLE STATUS LIKE 'sms_report_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$insert_session_id=$_POST['use_inset_session_id'];
$user_mobile_no=implode(",",$user_post);
$sms_use_credit=strlen($message);
$round_credit=ceil($sms_use_credit/160);

$insert_db=mysql_query("INSERT into sms_report_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
        . ",'$send_to','$user_mobile_no','$message','$round_credit','bulk_sms','','none')");
if($insert_db)
{

foreach ($mobile_number_chuck as $multi_user)
{
 $implode_user_mobile=implode(",",$multi_user);
 $user_mobile_no=$implode_user_mobile;
 
 if((!empty($user_mobile_no)))
 {
  $user_id="multiple";
   $sms_report=sms_api($user_mobile_no,$message,$user_id,$unicode); 
    array_push($log_report,$sms_report);
  if($sms_report=="0")
  {
 $sms_sent_no++;
  }else
      if($sms_report=="2")
      {
       $sms_sent_no++;
      }else
  {
  $sms_sent_no++;
  }
     
     
 }
}
}
$implode_log_report=implode(",",$log_report);
$update_db=mysql_query("UPDATE sms_report_db SET log_report='$implode_log_report' WHERE id='$nextId' and is_delete='none'");
if($update_db)
{
if($sms_sent_no<0)
{
  $message_show="Less credits to send sms";   
}else
    if($sms_sent_no==0)
    {
      $message_show="Invalid Request";
    }else
        if($sms_sent_no>0)
        {
          $message_show="Message sent successfully complate";   
        }
         $message_show="Message sent successfully complate";   
}else  
{
  $message_show="Message sent successfully complate";      
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
        <title>Bulk SMS</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
           <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
     
        <script type="text/javascript" src="javascript/sms_javascript.js"></script>
        <script type="text/javascript">
        function user_select(user_id)
        {
         var message=document.getElementById("message").value;   
         var sms_type=document.getElementById("sms_type").value;  
        if(user_id==0)
        {
           alert("Please select atleast one");
           return false;
        }else
        {
          document.getElementById("ajax_loader_show").style.display="block";
       window.location.assign("bulk_sms.php?send_to="+user_id+"&message="+message+"&sms_type="+sms_type+"");
        
        
        }
        }
        
        function send_to(user_id)
        {
          var message=document.getElementById("message").value;   
         var sms_type=document.getElementById("sms_type").value;  
        if(user_id==0)
        {
           alert("Please select atleast one");
           return false;
        }else
        {
          document.getElementById("ajax_loader_show").style.display="block";
       window.location.assign("bulk_sms.php?send_to="+user_id+"&message="+message+"&sms_type="+sms_type+"");
        
        
        }   
        }
        
        function bulk_get_details()
        {
        if(document.getElementById("all_user").checked)
        {
       var user_id="all_user";     
        }else
         if(document.getElementById("student_check").checked)
        {
       var user_id="student";     
        }else
             if(document.getElementById("parent_check").checked)
        {
       var user_id="parent";     
        }else
             if(document.getElementById("employee_check").checked)
        {
       var user_id="teacher";     
        }else
             if(document.getElementById("contact_check").checked)
        {
       var user_id="contact";     
        }else
        {
         var user_id="all_user";      
        }
            
        
        
        var message=document.getElementById("message").value;   
        var sms_type=document.getElementById("sms_type").value;  
        if(user_id==0)
        {
           alert("Please select atleast one");
           return false;
        }else
        {
          document.getElementById("ajax_loader_show").style.display="block";
       window.location.assign("bulk_sms.php?send_to="+user_id+"&message="+message+"&sms_type="+sms_type+"");
        
        
        }  
        }
        
        
        function preview_message()
        {
          
         var message=document.getElementById("message").value; 
         
         var total_user_value=document.getElementById("total_user_data").value;   
  
    
    var checkboxes = document.querySelectorAll('input[name="post_data[]"]:checked'), values = [];
    Array.prototype.forEach.call(checkboxes, function(el) {
        values.push(el.value);
    });
   
    if(values==0)
    {
     alert("Please select receiver"); 
     return false;
    }else
    if(message==0)
{
 alert("Please enter message");
 document.getElementById("message").focus();
 return false;
}else
    {
    var mySplitResult=values.length;     
  
    document.getElementById("total_user").innerHTML=total_user_value;
     document.getElementById("selected_user").innerHTML=mySplitResult;
      document.getElementById("get_message").innerHTML=message;
    document.getElementById("win_pop_up_only_1").style.display="block";
    }  
        }
          function close_button_n()
            {
               document.getElementById("win_pop_up_only_1").style.display="none"; 
               
            }
              function ok_close_n()
            {
               document.getElementById("win_pop_up_only_1").style.display="none"; 
               
            }
        
        </script>
        <script type="text/javascript">
       
        function clear_button()
        {
      var r=confirm("Are you sure you want to clear message");
if (r==true)
  { 
       document.getElementById("message").value=" ";
       document.getElementById("left_character").value=0;
    }    
        }
        
        
        function validate_form()
        {
    
        var checkboxese=document.querySelectorAll('input[name="post_data[]"]'),valuese=[];
     Array.prototype.forEach.call(checkboxese, function(el) {
        valuese.push(el.value);
    });
    
    var message=document.getElementById("message").value;
    if(valuese==0)
    {
     alert("Please select receiver"); 
     return false;
    }else
    if(message==0)
{
 alert("Please enter message");
 document.getElementById("message").focus();
 return false;
}else
    {
    document.getElementById("ajax_loader_show").style.display="block";    
    }
        }
        
        </script>
        <script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length >160) {
		
                alert('Sorry you can fill maximum 160 character only');
              limitCount.value=limitField.value.length;
	} else {
		limitCount.value=limitField.value.length;
	}
}



</script>
    </head>
    <body onload="page_load()">
        <div id="include_header_page">
          <?php 
include_once '../ajax_loader_page_second.php';
          ?>
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="bulk_sms.php" name="myForm" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
        
            
        <div id="win_pop_up_only_1" style=" display:none; ">
            <div id="first_pop_up_div"></div> 
            <div id="second_pop_up" class="second_show_pop_up">
                <div id="student_list_show">
                  <div class="close_div" onclick="close_button_n()"></div>  
                  <div class="middle_center_work_dived" id="win_pop_up_text">
                      <div class="pop_up_title">Preview Bulk SMS</div>
                      <div style=" width:100%; float:left;max-height:400px; overflow-y:auto;    ">
                     
                          <table cellspacing="4" cellpadding="4" style=" margin:auto; margin-top:10px;  ">
                              <tr>
                                  <td><b>Total User</b></td><td><b>:</b></td><td><div id="total_user">0</div></td>
                              </tr>
                               <tr>
                                   <td><b>Selected Receiver</b></td><td><b>:</b></td><td><div style=" width:100px; " id="selected_user">0</div></td>
                              </tr>
                               <tr>
                                   <td><b>Message</b></td><td><b>:</b></td><td><div style=" width:400px; " id="get_message"></div></td>
                              </tr>
                          </table>
                          
                          
                          
                      </div>
                       </div>
                  <div class="last_bottom_close_div">
                      
                      <input type="submit"  name="send_sms_button" class="ok_button_style" style=" border:0; height:40px;   background-color:dodgerblue; " value="Send SMS">
                    <div onclick="ok_close_n()" class="ok_button_style" style=" background-color:red; margin-right:10px;  ">Cancel</div>  
                  </div>
                </div>
                </div>
              </div>     
            
            
            
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="sms_dashboard.php">SMS (Phone/Email)</a></td>
                           <td>/</td>
                           <td>Bulk SMS</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Bulk SMS</b></div>
                </div>
                 
              
               <div class="middle_left_div_tag">
                 
              
                   <style>
                       .select_box{width:100%;  height:24px; border:1px solid silver;  padding:0;  }
                   </style>
                    <div style=" width:auto; height:auto; margin:auto;   ">
                        <div class="right_div_quik_msg" style=" margin-right:100px; ">
                       <div class="title_ui_style">Bulk SMS</div>
                      
                       <div class="left_iframe" style=" width:50%; float:none; margin:auto; 
                            margin-top:10px; margin-bottom:10px;     ">
                           <table cellspacing="1" cellpadding="1" class="sms_table" style=" margin:auto; margin:10px;   font-size:12px; ">
                                <tr>
                                   <td><b>Send To<sup>*</sup></b></td><td><b>:</b></td>
                                   <td>
                                       <select class="select_box" name="bulk_send_to" onchange="send_to(this.value)" style=" width:50%; ">
                                           <option id="all_user" value="all_user">All Users</option>
                                           <option id="student" value="student">Students</option>
                                           <option id="parent" value="parent">Parents</option>
                                           <option id="teacher" value="teacher">Employee/Teachers</option> 
                                            <option id="contact" value="contact">Contacts</option>
                                           
                                       </select>   
                                   </td>
                               </tr>
                               <tr>
                                   <td><b>SMS Type<sup>*</sup></b></td><td><b>:</b></td>
                                   <td>
                                       <select id="sms_type" name="sms_type" class="select_box" style=" width:50%; "s>
                                           <option value="0">--Select--</option>
                                              <?php 
                                              if(!empty($_REQUEST['sms_type']))
                                              {
                                              $sms_type_id=$_REQUEST['sms_type'];   
                                              }  else {
                                             $sms_type_id="";     
                                              }
                                              
 $sms_message_type_db=mysql_query("SELECT * FROM sms_message_type_db WHERE $db_main_details_whout_session is_delete='none'");   
                     while ($fetch_sms_message_type_data=mysql_fetch_array($sms_message_type_db))
                     {
                       
                                 $fetch_sms_message_type_db_id=$fetch_sms_message_type_data['id'];
                                 $fetch_sms_message_type_unique_id=$fetch_sms_message_type_data['message_type_id'];
                                 $encrypt_id=$fetch_sms_message_type_data['encrypt_id'];
                                 $fetch_sms_message_type_name=$fetch_sms_message_type_data['message_type'];
                                $fetch_sms_message_type_description=$fetch_sms_message_type_data['description'];
                                if($sms_type_id==$fetch_sms_message_type_unique_id)
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
                                   <td><b>Language <sup>*</sup></b></td><td><b>:</b></td>
                                   <td>
                                       <table>
                                           <tr>
                                               <td><input type="radio" name="sms_language" value="0" checked></td><td>English</td>
                                               <td><input type="radio" name="sms_language" value="&type=3"></td><td>Hindi</td>
                                                <td><input type="radio" name="sms_language" value="&type=3"></td><td>Other</td>
                                           </tr>
                                       </table>  
                                   </td>
                               </tr> 
                               <tr>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td><b>Message <sup>*</sup></b></td><td colspan="4" style="text-align:right; ">
                                       <font size="1.7"><b style=" color:red; ">(Maximum characters: 160)</b>
                                        You have
<input readonly="readonly" type="text" name="countdown" size="3" id="left_character" value="0"
       style=" color: red; border:1px solid silver;   font-weight: bold;"> characters left.</font></td>
                               </tr>
                               <tr>
                                   <td colspan="5"><textarea id='message' onKeyDown="limitText(this.form.message_post,this.form.countdown,0);" 
                                                             onKeyUp="limitText(this.form.message_post,this.form.countdown,0);" name="message_post" placeholder="Please enter message" class="sms_message">
<?php if(!empty($_REQUEST['message'])) { echo $_REQUEST['message']; }?></textarea></td>
                               </tr>
                               <tr>
                                   <td colspan="5">
                                       <input type="button" onclick="clear_button()" class="clear_buttoned" value="Clear">
                                       <input type="button" onclick="preview_message()" class="button_css" style=" float:right; " value="PREVIEW & SEND SMS">   
                                      
                                   </td>
                               </tr>
                           </table>     
                       </div> 
                       
                     
                       
                       
                       
                       
                       
                    <div class="right_iframe">
                        <div class="title_ui_style">
                           <span>SELECT RECEIVER</span>
                           <span style=" padding-left:10%; "><b>TOTAL SELECTED</b> : <span id="total_reciver">0</span></span>
                        </div>
                        <div class="top_search_div" style=" border-bottom: 1px solid silver; margin-bottom: 10px;">
                               
                            <?php
                            if(!empty($_REQUEST['send_to']))
                            {
                             $send_to=$_REQUEST['send_to'];
                             if($send_to=="all_user")
                             {
                             $a_all=1;
                             $a_student=1;
                             $a_parent=0;
                             $a_teacher=1;
                             $a_contact=0;
                                 
                                 
                                 
                             $aa="checked";
                             $as="";
                             $ap="";
                             $at="";
                             $ac="";
                             }else
                                 if($send_to=="student")
                                 {
                               $a_all=0;
                             $a_student=1;
                             $a_parent=0;
                             $a_teacher=0;
                             $a_contact=0;      
                                     
                             $aa="";
                             $as="checked";
                             $ap="";
                             $at="";
                             $ac="";   
                                 }else
                                     if($send_to=="parent")
                                     {
                             $a_all=0;
                             $a_student=0;
                             $a_parent=1;
                             $a_teacher=0;
                             $a_contact=0;  
                             
                             $aa="";
                             $as="";
                             $ap="checked";
                             $at="";
                             $ac="";     
                                     }else
                                         if($send_to=="teacher")
                                         {
                             $a_all=0;
                             $a_student=0;
                             $a_parent=0;
                             $a_teacher=1;
                             $a_contact=0;           
                                             
                                             
                             $aa="";
                             $as="";
                             $ap="";
                             $at="checked";
                             $ac="";     
                                         }else
                                             if($send_to=="contact")
                                             {
                                 
                             $a_all=0;
                             $a_student=0;
                             $a_parent=0;
                             $a_teacher=0;
                             $a_contact=1;                     
                                                 
                             $aa="";
                             $as="";
                             $ap="";
                             $at="";
                             $ac="checked";     
                                             }else
                                             {
                             $a_all=1;
                             $a_student=1;
                             $a_parent=0;
                             $a_teacher=1;
                             $a_contact=0;       
                             $aa="checked";
                             $as="";
                             $ap="";
                             $at="";
                             $ac="";    
                                             }
                              
                            }else
                           {
                                
                             $a_all=1;
                             $a_student=1;
                             $a_parent=0;
                             $a_teacher=1;
                             $a_contact=0;    
                                
                              $aa="checked";
                             $as="";
                             $ap="";
                             $at="";
                             $ac="";      
                            }
                            
                            ?>
                            <table style=" width:auto;height:auto; margin:0 auto; ">
                                   <tr > 
                                       <td><b>Send To : </b></td>
                                       <td colspan="9">
                                           <table>
                                               <tr>
                                                   <td><input type="radio" class="user_selection_css" onclick="user_select('all_user')" id='all_user' name="user_selection" value="all_users" <?php echo $aa;?>></td><td>All Users</td>
                                       <td><input type="radio" class="user_selection_css" onclick="user_select('student')" id='student_check' name="user_selection" value="student" <?php echo $as;?>></td><td>All Students</td>
                                       <td><input type="radio" class="user_selection_css" onclick="user_select('parent')" id="parent_check" name="user_selection" <?php echo $ap;?>></td><td>All Parents</td>
                                      <td><input type="radio" class="user_selection_css" onclick="user_select('teacher')" id="employee_check" name="user_selection" <?php echo $at;?>></td><td>All Employee/Teachers</td>
                                       <td><input type="radio" class="user_selection_css" onclick="user_select('contact')" id="contact_check" name="user_selection" <?php echo $ac;?>></td><td>All Contacts</td>
                                               </tr>
                                           </table>  
                                       </td>
                                   </tr>
                                   <tr>
                                       <td colspan="9" style=" border-bottom:1px solid black; "></td>
                                   </tr>
                                   <tr>
                                       <td colspan="10"><input type="button" onclick="bulk_get_details()" class="get_details_button" value="Get Details"></td>
                                   </tr>
                               </table>   
                           </div>
                        
                        
                        <div class="data_list" id='data_list'>
                        <?php
                        
               if(!empty($a_parent))
               {
               $ab=0;    
               }else
                   if(!empty($a_contact))
                   {
                     $ab=0;  
                   }else
                   {
                    $ab=1;   
                   }
                   echo "<table cellspacing='0' cellpadding='0' style=' width: 100%;'>";  
                        if((!empty($ab)))
                        {
                        
                          echo " <span style='padding:5px;'><b>Total User : </b> 0 <br/> </span>
                                   <tr class='tr_heading_css'>
                                       <td><input id='selecctall' type='checkbox' checked></td>
                                       <td>Sl.No.</td>
                                        <td>User</td>
                                        <td>Name</td>
                                         <td>Mobile No.</td>
                                       <td>Claas - Section</td>
                                       <td>Department</td>
                                       <td>Father Name</td>
                                       <td>Mobile No.</td>
                                       
                                       <td>Action</td>
                                   </tr>
                                 "; 
                        }
          $row=0;
                 if(!empty($a_student))
                 {
                  $student_db=mysql_query("SELECT *,T1.encrypt_id as t1_encrypt_id,T1.id as t1_db_id FROM student_db as T1"
                 . " LEFT JOIN course_db as T2 ON T1.course_id=T2.course_id"
                 . " LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id "
                 . " LEFT JOIN session_db as T4 ON T1.session_id=T4.session_id "
                 . " LEFT JOIN category_db as T5 ON T1.category_id=T5.category_id "
                 . " LEFT JOIN parent_db as T6 ON T1.parent_id=T6.parent_unique_id"
                 . " LEFT JOIN student_personal_db as T7 ON T1.student_personal_id=T7.student_unqiue_id"
                 . " LEFT JOIN student_previous_class_db as T8 ON T1.previous_class_id=T8.previous_class_unique_id"
                 . " LEFT JOIN student_allot_hostel as T9 ON T1.hostel_id=T9.hostel_unique_id"
                 . " LEFT JOIN student_allot_transport as T10 ON T1.transport_id=T10.transport_unique_id "
                 . "LEFT JOIN house_db as T11 ON T1.house_id=T11.house_id WHERE "
                 . " $db_t1_main_details T1.is_delete='none'");
        
         $fetch_student_num_rows=mysql_num_rows($student_db);
         
         
                                          
                             
         while ($fetch_student_data=mysql_fetch_array($student_db))
         {
          $row++;
          $user_id=$fetch_student_data['t1_db_id'];
          $admission_no=$fetch_student_data['admission_no'];
          $encrypt_id=$fetch_student_data['t1_encrypt_id'];
          $course_name=$fetch_student_data['course_name']; 
          $section_name=$fetch_student_data['section_name'];
          $student_roll_no=$fetch_student_data['roll_no']; 
          $section_name=$fetch_student_data['section_name'];
           $student_full_name=$fetch_student_data['student_full_name'];
            $student_mobile=$fetch_student_data['student_mobile_no'];
           $student_father_name=$fetch_student_data['father_name'];
    $student_father_mobile_no=$fetch_student_data['father_mobile_no'];
   
    $post_data=$student_father_mobile_no;
      echo "<tr class='td_data_listsed'>"
             . "<td><input class='checkbox1' name='post_data[]' type='checkbox' value='$post_data' checked></td>"
                     . "<td>$row</td>"
                     . "<td><b>Student</b></td>"
                     . "<td>$student_full_name</td>"
                     . "<td>$student_mobile</td>"
                     . "<td>$course_name - $section_name</td>"
                     . "<td></td>"
                     . "<td>$student_father_name</td>"
                     . "<td>$student_father_mobile_no</td>"
                     . "<td style='width:70px;'>";
             { ?>
<a href="#" onclick="window.open('../search/student_full_details.php?token_id=<?php echo $encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                    <div class="view_delete_buttons" style="background-color:dodgerblue; width:55px;">View</div></a>

              <?php 
             }
                     echo"</td></tr>";     
             
         }
           
          }
          
          if(!empty($a_teacher))
          {
              $employee_db=mysql_query("SELECT *,T1.id as db_id,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id,T1.id as t1_db_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                      . "LEFT JOIN hr_family_db as T3 ON T1.family_id=T3.family_unique_id "
                      . "LEFT JOIN hr_department_db as T4 ON T1.department_id=T4.department_id "
                      . "LEFT JOIN hr_designation_db as T5 ON T1.designation_id=T5.designation_id "
                      . "LEFT JOIN hr_bank_db as T6 ON T1.bank_id=T6.bank_unique_id "
                      . "LEFT JOIN category_db as T8 ON T1.category_id=T8.category_id WHERE T1.is_delete='none'");
              $empoyee_num_rows=mysql_num_rows($employee_db);
              while ($employee_data=mysql_fetch_array($employee_db))
              {
                $row++;
                 $user_id=$employee_data['t1_db_id'];
                $employee_unique_id=$employee_data['t1_employee_id'];
                $employee_db_id=$employee_data['db_id'];
                $employee_encrypt_id=$employee_data['t1_encrypt_id'];
                $employee_no=$employee_data['employee_no'];
                $employee_joining_date=$employee_data['joining_date'];
                $employee_name=$employee_data['full_name'];
                $employee_gender=ucwords($employee_data['gender']);
                $employee_mobile_no=$employee_data['mobile'];
                $employee_father_name=ucwords($employee_data['father_name']);
                $employee_teaching_profession=ucfirst($employee_data['profession_teaching']);
                $deapartment=$employee_data['department_name'];
                $designation=$employee_data['designation_name'];
                
                 $post_data=$employee_mobile_no;
                 
                
                   echo "<tr class='td_data_listsed'>"
             . "<td><input class='checkbox1' name='post_data[]' type='checkbox' value='$post_data' checked></td>"
                     . "<td>$row</td>"
                    . "<td><b>Employee</b></td>"
                     . "<td>$employee_name</td>"
                     . "<td>$employee_mobile_no</td>"
                     . "<td></td>"
                            . "<td>$deapartment</td>"
                      . "<td>$employee_father_name</td>"
                        . "<td></td>"   
                     . "<td style='width:70px;'>";
             { ?>
<a href="#" onclick="window.open('../search/student_full_details.php?token_id=<?php echo $employee_encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                    <div class="view_delete_buttons" style="background-color:dodgerblue; width:55px;">View</div></a>

              <?php 
             }
                     echo"</td></tr>";     
                     
              }
          }
                          
          
          if(!empty($a_parent))
          {
                 
      $row=0;
               $parants_match=array();
               $parents_db=mysql_query("SELECT *,T6.encrypt_id as parent_encrypt_id,T1.id as t1_db_id FROM parent_db as T6 "
                       . "LEFT JOIN student_db as T1 ON T6.parent_unique_id=T1.parent_id "
                       . "LEFT JOIN student_personal_db as T7 ON T1.student_id=T7.student_unqiue_id "
                       . "WHERE $db_t1_main_details T1.is_delete='none'");
             $fetch_parent_num_rows=mysql_num_rows($parents_db);
         echo " <span style='padding:5px;'><b>Total User : </b> $fetch_parent_num_rows <br/> </span><br/><table cellspacing='0' cellpadding='0' style=' width: 100%;'>
                                   <tr class='tr_heading_css'>
                                       <td><input id='selecctall' type='checkbox' checked></td>
                                       <td>Sl.No.</td>
                                        <td>User</td>
                                        <td>Father Name</td>
                                        <td>Mobile No.</td>
                                       <td>Mother Name</td>
                                        <td>Mobile No.</td>
                                       <td>Local Guardian</td>
                                       <td>Mobile No</td>
                                       <td>Action</td>
                                   </tr>
                                 "; 
         
         
            while ($parent_data=mysql_fetch_array($parents_db))
               {
               $parent_unique_id=$parent_data['parent_unique_id'];
                     
                if(in_array($parent_unique_id,$parants_match)==false)   
                {  
                 $row++;
                  $user_id=$parent_data['t1_db_id'];
                 $parent_encrypt_id=$parent_data['parent_encrypt_id'];
                 $father_name=$parent_data['father_name'];
                 $father_mobile_no=$parent_data['father_mobile_no'];
                 $mother_name=$parent_data['mother_name'];
                 $mother_mobile_no=$parent_data['mother_mobile_no'];
                 
                 $local_guradain=$parent_data['local_parent_name'];
                         $guradian_mobile_no=$parent_data['local_parent_mobile_no'];
                 array_push($parants_match, $parent_unique_id);
                 
                 
                 $post_data=$father_mobile_no;
                 
                  echo "<tr class='td_data_listsed'>"
             . "<td><input class='checkbox1' name='post_data[]' type='checkbox' value='$post_data' checked></td>"
                     . "<td>$row</td>"
                     . "<td>Parent</td>"
                     . "<td><b>$father_name</b></td>"
                     . "<td><b>$father_mobile_no</b></td>"
                     . "<td>$mother_name</td>"
                     . "<td>$mother_mobile_no</td>"
                     . "<td>$local_guradain</td>"
                     . "<td>$guradian_mobile_no</td>"
                     . "<td style='width:70px;'>";
             { ?>
<a href="#" onclick="window.open('../search/student_full_details.php?token_id=<?php echo $parent_encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                    <div class="view_delete_buttons" style="background-color:dodgerblue; width:55px;">View</div></a>

              <?php 
             }
                     echo"</td></tr>";     
                 
                 
                }
               }
          }
          
          
          if(!empty($a_contact))
          {
               $contact_db=mysql_query("SELECT * FROM contact_no_db as T1 "
                            . "LEFT JOIN contact_group_db as T2 ON T1.group_id=T2.id "
                            . "WHERE $db_t1_main_without_session T1.is_delete='none'");
            $contact_num_rows=mysql_num_rows($contact_db);
               echo " <span style='padding:5px;'><b>Total User : </b> $contact_num_rows <br/> </span><br/><table cellspacing='0' cellpadding='0' style=' width: 100%;'>
                                   <tr class='tr_heading_css'>
                                       <td><input id='selecctall' type='checkbox' checked></td>
                                       <td>Sl.No</td>
                                       <td>User</td>
                                       <td>Group</td>
                                       <td>Name</td>
                                       <td>Organization</td>
                                       <td>Phone Number</td>
                                       <td>Mobile No.</td>
                                       <td>Action</td>
                                   </tr>
                                 ";  
               
                $row=0;
                    while ($contact_data=mysql_fetch_array($contact_db))
                     {     
                    $row++;    
                    $fetch_contact_id=$contact_data['contact_id'];
                    $encrypt_id=$contact_data['encrypt_id'];
                    $group=$contact_data['group_name'];
                            $name=$contact_data['name'];
                            $organization=$contact_data['organization'];
                            $phone_no=$contact_data['phone_number'];
                            $mobile_no=$contact_data['mobile_number'];
                           
                            $post_data=$mobile_no;
                      echo "<tr>"
                              . "<td class='td_style'><input class='checkbox1' name='post_data[]' type='checkbox' value='$post_data' checked></td>"
                              ."<td class='td_style'> $row</td>"
                               ."<td class='td_style'>Contact</td>" 
                              . "<td class='td_style'><center>$group</center></td>"
                                . "<td class='td_style'>$name</td>"
                                . "<td class='td_style'>$organization</td>"
                                . "<td class='td_style'>$phone_no</td>"
                                . "<td class='td_style'>$mobile_no</td>"
                                . "<td class='td_style' style=' width:130px; border-right:1px solid black;'>"; 
                        {
                            ?>
                       <a href="#" onclick="window.open('../search/student_full_details.php?token_id=<?php echo $encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                    <div class="view_delete_buttons" style="background-color:dodgerblue; width:55px;">View</div></a>

                       <?php
                    }
                        echo"</td>";
                            
                        
                     }
          }
          
          
          
          
          
                        ?>
                            
                            
                            
                            
                        </table>
                        </div>
                       </div>   
                       
                       
                       
                       
                   </div>
               </div>
                   </div>
                
             
                
                
               
            </div> 
        </div>
        <?php
        if(!empty($_REQUEST['send_to']))
        {
         $send_to=$_REQUEST['send_to']; 
        ?>
            <script type="text/javascript">
            function page_load()
            {
             if(document.getElementById("<?php echo $send_to;?>"))
             {
             document.getElementById("<?php echo $send_to;?>").selected=true;    
             }
            }
            </script>
            
         <?php
        }
         ?>
            
        <link rel="stylesheet" href="../javascript/combosearch/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
    #parent_id_chosen{ width:400px; }
    #hostel_id_chosen{ width:330px; }
    #teacher_id_chosen{ width:70%; }
    .chosen-results{ font-size:11px; }
    
  </style>          
  <script src="../javascript/combosearch/chosen.jquery.js" type="text/javascript"></script>
  <script src="../javascript/combosearch/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
  
        
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }

  </script>
        
 
  
  <input type="hidden" id="total_user_data" value="<?php echo $row;?>">
  
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