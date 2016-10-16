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
 
 if(!empty($_POST['admin_number']))
 {
 $admin_mobile_no=$_POST['admin_number'];
 }else
 {
  $admin_mobile_no=0;   
 }
 
 if(!empty($_POST['principal_number']))
 {
 $principal_mobile_no=$_POST['principal_number'];
 }else
 {
  $principal_mobile_no=0;   
 }
 
 
 if(!empty($_POST['employee_mobile_check']))
 {
 $employee_mobile_no=$_POST['employee_post'];
 $employee_implode=implode(",",$employee_mobile_no);
 }else
 {
  $employee_mobile_no=0;   
 }
 if(!empty($_POST['other_mobile_check']))
 {
 $other_contact_no=$_POST['other_no_post']."@$$@".""."@$$@"."none";
 
 }else
 {
 $other_contact_no="";    
 }
 
 
 if(count($_POST['post_data'])>0)
 {
  $user_post=$_POST['post_data'];  
}else
{
 $user_post=0;   
}

$send_to=$_POST['send_to'];
$message=$_POST['message_post']; 

if((!empty($user_post))&&(!empty($message)))
{  

$sms_sent_no=0;   
$log_report=array();    
$implode_post=implode("@##@",$user_post);  
$explode_post=explode("@##@",$implode_post);

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
        . ",'$send_to','$user_mobile_no','$message','$round_credit','compose_sms','','none')");
if($insert_db)
{
foreach ($explode_post as $multi_user)
{
 $explode_final_user=explode("@$$@",$multi_user);
    
 $user_mobile_no=$explode_final_user[0];
 $user_name=$explode_final_user[1];
 $user_id=$explode_final_user[2];
 
 if((!empty($user_mobile_no))&&(!empty($user_name))&&(!empty($user_id)))
 {
  
  $user_message=str_replace("#name#","$user_name","$message");
  $sms_report=sms_api($user_mobile_no,$user_message,$user_id,$unicode); 
   
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
        <title>Compose SMS</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="javascript/sms_javascript.js"></script>
        <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="../search_integration/javascript/class_javascript.js"></script>
        <script type="text/javascript">
        function user_select(user_id)
        {
        
         document.getElementById("parent_option").style.display="none"; 
         document.getElementById("student_option").style.display="none";  
         document.getElementById("teacher_option").style.display="none";   
         document.getElementById("contact_option").style.display="none";   
         document.getElementById(""+user_id+"_option").style.display="block";   
         document.getElementById(user_id).selected=true;
         
        }
        </script>
        <script type="text/javascript">
        function template_add(number)
        {
var r=confirm("Are you sure you want to add template");
if (r==true)
  { 
        var template_value=document.getElementById("template_value_"+number+"").innerHTML;
        document.getElementById("message").value=template_value;
        document.getElementById("left_character").value=template_value.length;
    }
        }
        
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
     var checkboxes = document.querySelectorAll('input[name="post_data[]"]:checked'), values = [];
    Array.prototype.forEach.call(checkboxes, function(el) {
        values.push(el.value);
    });
    
    
    var message=document.getElementById("message").value;
    var sms_type=document.getElementById("sms_type").value;
    if(values==0)
    {
     alert("Please select receiver"); 
     return false;
    }else
    if(sms_type==0)
    {
    alert("Please select SMS type");
 document.getElementById("sms_type").focus();
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
        
        
        function preview_message()
        {
          
         var checkboxesed = document.querySelectorAll('input[name="post_data[]"]'), valuesed = [];
    Array.prototype.forEach.call(checkboxesed, function(els) {
        valuesed.push(els.value);
    });
         
         var message=document.getElementById("message").value; 
         
         var total_user_value=valuesed.length;
  
    
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
        <script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length >2000) {
		
                alert('Sorry you can fill maximum 2000 character only');
              limitCount.value=limitField.value.length;
	} else {
		limitCount.value=limitField.value.length;
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
        
            <div id="win_pop_up_only_1" style=" display:none; ">
            <div id="first_pop_up_div"></div> 
            <div id="second_pop_up" class="second_show_pop_up">
                <div id="student_list_show">
                  <div class="close_div" onclick="close_button_n()"></div>  
                  <div class="middle_center_work_dived" id="win_pop_up_text">
                      <div class="pop_up_title">Preview Compose SMS</div>
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
                           <td>Compose SMS</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Compose SMS</b></div>
                </div>
                 
                
               <div class="middle_left_div_tag">
                 
                 <?php
include 'left_frame.php';
                 ?>  
                   <style>
                       .select_box{width:100%;  height:24px; border:1px solid silver;  padding:0;  }
                   </style>
                   <div class="right_div_quik_msg">
                       <div class="title_ui_style">COMPOSE SMS
                           
                           <span style=" width:37%; float:right;  ">
                            Message Template  
                            <span>
                            <table style=" float:right; margin-top:-8px;  margin-right:5px; ">
                                <tr>
                                    <td>Message</td><td><b>:</b></td>
                                    <td><select onchange="message_type(this.value)" class="select_box" style=" width:100px; ">
                                            <option value="0">---Select---</option>
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
                                        </select></td>
                                </tr>
                            </table>
                            </span>
                           </span>
                         </div>
                      
                       <div class="left_iframe">
                           <table cellspacing="1" cellpadding="1" class="sms_table" style=" font-size:12px; ">
                                <tr>
                                   <td><b>Send To<sup>*</sup></b></td><td><b>:</b></td>
                                   <td>
                                       <select name="send_to" class="select_box">
                                           <option id="student" value="students">Students</option>
                                           <option id="parent" value="parents">Parents</option>
                                           <option id="teacher" value="teachers">Employee/Teachers</option> 
                                            <option id="contact" value="contacts">Contacts</option>
                                           
                                       </select>   
                                   </td>
                                    <td valign="top" rowspan="4">
                                        <table id="other_option_table" style=" display:none; ">
                                           <tr class="heading_otion">
                                               <td colspan="2">Other Option</td>
                                           </tr>
                                         <?php
                                         $principle_mobile_no=$principal_mobile_no."@$$@".$principal_name."@$$@PRINC_1";
                                         $admin_mobile_no=$admin_mobile_no."@$$@".$admin_name."@$$@".$fecth_user_unique;
                                         ?>
                                           <tr>
                                               <td><input type="checkbox" name="admin_number" value="<?php echo $admin_mobile_no;?>"></td>
                                               <td><b>Send a SMS copy to admin</b></td>
                                           </tr>
                                            <tr>
                                                <td><input type="checkbox" name="principal_number" value="<?php echo $principle_mobile_no;?>"></td>
                                               <td><b>Send a SMS copy to Principal</b></td>
                                           </tr>
                                            <tr>
                                                <td><input type="checkbox" name="employee_mobile_check" onclick="teacher_check()" id="teacher_checked"></td>
                                               <td><b>Send a SMS copy to selected teacher</b></td>
                                           </tr>
                                           <tr>
                                           <script type="text/javascript">
                                            function teacher_check()
                                            {
                                             
                                             var teacher_check=document.getElementById("teacher_checked").checked;
                                             if(teacher_check==true)
                                             {
                                             document.getElementById("sms_copy_to_teachers").style.display="block";    
                                             }else
                                             {
                                              document.getElementById("sms_copy_to_teachers").style.display="none";    
                                                
                                             }
                                            }
                                            
                                            function other_mobile_no()
                                            {
                                           var other_no=document.getElementById("check_other_mobile_no").checked  
                                           if(other_no==true)
                                           {
                                            document.getElementById("other_mobile_no").style.display="block";   
                                           }else
                                           {
                                            document.getElementById("other_mobile_no").style.display="none";   
                                            
                                           }
                                            }
                                            
                                               </script>
                                               <td colspan="3">
                                                   <div id="sms_copy_to_teachers" style=" display:none; ">
                                                   <b>Teachers</b> : 
                                                   <select id="teacher_id" name="employee_post" multiple data-placeholder="---Select---" class="chosen-select" tabindex="-1">
                                                    <option value="0"></option>
                                                    <?php 
                                     $employee_db=mysql_query("SELECT *,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                      . "LEFT JOIN hr_family_db as T3 ON T1.family_id=T3.family_unique_id "
                      . "LEFT JOIN hr_department_db as T4 ON T1.department_id=T4.department_id "
                      . "LEFT JOIN hr_designation_db as T5 ON T1.designation_id=T5.designation_id ");
              while ($employee_data=mysql_fetch_array($employee_db))
              {
                
                $employee_unique_id=$employee_data['t1_employee_id'];
                $employee_encrypt_id=$employee_data['t1_encrypt_id'];
                $employee_no=$employee_data['employee_no'];
                $employee_name=$employee_data['full_name'];
                $employee_gender=ucwords($employee_data['gender']);
                $employee_mobile_no=$employee_data['mobile'];
                $employee_father_name=ucwords($employee_data['father_name']);
                
                if($employee_gender=="Male")
                {
                  $gender="S/O";  
                }  else {
                 $gender="D/O";     
                }
               $employee_post_mobile_no=$employee_mobile_no."@$$@".$employee_name."@$$@".$employee_unique_id;
                echo "<option value='$employee_post_mobile_no'>$employee_no / $employee_name <B>$gender</B> $employee_father_name</option>";  
               
                }
                                   ?>
                                                   </select> 
                                                   </div>
                                               </td>
                                           </tr>
                                           <tr>
                                               <td><input type="checkbox" name="other_mobile_check" id="check_other_mobile_no" onclick="other_mobile_no()"></td>
                                               <td><b>Send a SMS copy to other mobile no.</b></td>
                                           </tr>
                                           <tr>
                                               <td colspan="2">
                                                   <div id="other_mobile_no" style=" display:none; ">
                                                       <b>Mobile No. :</b> <input onkeypress="javascript:return isNumber (event)" name="other_no_post" class="sms_other_mobile_no" type="text"> 
                                                   </div>
                                               </td>
                                           </tr>
                                       </table>    
                                   </td>
                               </tr>
                               <tr>
                                   <td><b>SMS Type<sup>*</sup></b></td><td><b>:</b></td>
                                   <td>
                                       <select id="sms_type" name="sms_type" class="select_box">
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
                                  
                               </tr>
                                <tr>
                                   <td><b>Language <sup>*</sup></b></td><td><b>:</b></td>
                                   <td>
                                       <table>
                                           <tr>
                                               <td><input type="radio" name="sms_language" checked value=""></td><td>English</td>
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
                           
<td colspan="4"><div class="message_instruction" style=" padding:10px; width:100%;  ">
If you want to incoorporate student information from the database in the message,
then you have to include certain codes in the place of student information.<br/>
<b>The codes are:<br/> </b>
Code for student/employee/parent/contact ( Name :#name# )
                                   
                               </div></td>
                       </tr>
                               <tr>
                                   <td><b>Message <sup>*</sup></b></td><td colspan="4" style="text-align:right; ">
                                       <font size="1.7"><b style=" color:red; ">(Maximum characters : unlimited)</b>
                                        You have enter
<input readonly="readonly" type="text" name="countdown" size="3" id="left_character" value="0"
       style=" color: red; border:1px solid silver;   font-weight: bold;"> characters</font></td>
                               </tr>
                               <tr>
                                   <td colspan="5"><textarea id='message' onKeyDown="limitText(this.form.message_post,this.form.countdown,0);" 
onKeyUp="limitText(this.form.message_post,this.form.countdown,0);" name="message_post" placeholder="Please enter message" class="sms_message"></textarea></td>
                               </tr>
                               <tr>
                                   <td colspan="5">
                                       <input type="button" onclick="clear_button()" class="clear_buttoned" value="Clear">
                                       <input type="button" class="button_css" onclick="preview_message()" name="send_sms_button" style=" float:right; " value="PREVIEW & SEND SMS">   
                                      
                                   </td>
                               </tr>
                           </table>     
                       </div> 
                       
                       <div id='right_div_frame'>
                           <div id="message_data_load" class="message_div_right">
                               <ul>
                                   
                                <?php
                                            
                     $sms_template=mysql_query("SELECT * FROM sms_template_db WHERE $db_main_details_whout_session"
                             . " is_delete='none'");           
                  $sms_template_num_rows=mysql_num_rows($sms_template); 
                  while ($sms_template_data=mysql_fetch_array($sms_template))
                  {
                  $template_unqiue_id=$sms_template_data['sms_template_id'];
                  $template_encrypt_id=$sms_template_data['encrypt_id'];
                 $template_name=ucwords($sms_template_data['template_name']);
                 $template=$sms_template_data['sms_template'];       
                 {
                 ?>
                                   <li onclick="template_add('<?php echo $template_unqiue_id;?>')">                  
                 <?php                  
                 }
                 echo "<div style=' font-weight:bold; padding-bottom:3px; width:100%; border-bottom:1px solid black; font-size:14px;'>$template_name </div><br/>"
                         . "<div id='template_value_$template_unqiue_id'>$template</div></li>";
                 
                  }
                                ?>   
                                   
                                  
                               </ul>    
                           </div>  
                       </div>
                       
                       
                       
                       
                       
                    <div class="right_iframe">
                        <div class="title_ui_style">
                           <span>SELECT RECEIVER</span>
                           <span style=" padding-left:10%; "><b>TOTAL SELECTED</b> : <span id="total_reciver">0</span></span>
                        </div>
                        <div class="top_search_div" style=" border-bottom: 1px solid silver; margin-bottom: 10px;">
                               <table style=" width:auto;height:auto; margin:0 auto; font-size:12px;  ">
                                   <tr > 
                                       <td><b>Send To : </b></td>
                                       <td colspan="9">
                                           <table>
                                               <tr>
                                       <td><input type="radio" class="user_selection_css" onclick="user_select('student')" id='student_check' name="user_selection" value="student" checked></td><td>Students</td>
                                       <td><input type="radio" class="user_selection_css" onclick="user_select('parent')" id="parent_check" name="user_selection"></td><td>Parents</td>
                                       <td><input type="radio" class="user_selection_css" onclick="user_select('teacher')" id="employee_check" name="user_selection"></td><td>Teachers</td>
                                       <td><input type="radio" class="user_selection_css" onclick="user_select('contact')" id="contact_check" name="user_selection"></td><td>Contacts</td>
                                               </tr>
                                           </table>  
                                       </td>
                                   </tr>
                                   <tr>
                                       <td colspan="9" style=" border-bottom:1px solid black; "></td>
                                   </tr>
                                   <tr>
                                       <td colspan="10">
                                           <div id="student_option">
                                               <table>
                                                   <tr><td><b>Class/Course</b></td>
                                                       <td><b>:</b></td>
                                                       <td>
                                                           <select onchange="class_change_id(this.value)" id='class_id' class="select_box" style=" width:120px ">
                                                               <option value="0">---Select---</option>   
                                                               <?php
                               $class_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none'");
                               while ($fetch_class_data=mysql_fetch_array($class_db))
                               {
                                $fetch_class_name=$fetch_class_data['course_name'];
                                $fetch_class_id=$fetch_class_data['course_id'];
                                
                               echo "<option value='$fetch_class_id'>$fetch_class_name</option>";
                               }
                                                               ?>
                                                           </select>  
                                                       </td>
                                                       <td><b>Section</b></td>
                                                       <td><b>:</b></td>
                                                       <td>
                                                           <select id='section_id' class="select_box" style=" width:120px ">
                                                               <option value="0">---Select---</option>   
                                                           </select>  
                                                       </td>
                                                       <td><b>House</b></td>
                                                       <td><b>:</b></td>
                                                       <td>
                                                           <select id='house_id' class="select_box" style=" width:120px ">
                                                               <option value="0">---Select---</option>  
                                                                <?php
                               $house_db=mysql_query("SELECT * FROM house_db WHERE $db_main_details_whout_session is_delete='none'");
                               while ($fetch_house_data=mysql_fetch_array($house_db))
                               {
                                $fetch_house_id=$fetch_house_data['house_id'];
                                $fetch_house_name=$fetch_house_data['house_name'];
                                echo "<option value='$fetch_house_id'>$fetch_house_name</option>";
                               }
                               ?>
                                                               
                                                           </select>  
                                                       </td>
                                                   </tr>
                                               </table>   
                                           </div>   
                                           
                                           
                                           <div id="parent_option" style=" display:none; ">
                                               <table>
                                                   <tr>
                                                       <td><input type="radio" id="all_parent" value="all_parents" checked></td>
                                                       <td>All Parent</td>
                                                   </tr>
                                               </table>    
                                           </div>
                                           <script>
               function all_employee_select()
               {
              var all_employee_check=document.getElementById("all_employee").checked;    
              if(all_employee_check==true)
              {
             document.getElementById("zero_1").selected=true;
             document.getElementById("zero_2").selected=true;
            
             document.getElementById("department_id").disabled=true;
             document.getElementById("designation_id").disabled=true;
             
              }else
              {
             document.getElementById("department_id").disabled=false;
             document.getElementById("designation_id").disabled=false; 
             
              }
              }
               </script>
                                           <div id="teacher_option" style=" display:none; ">
                                               <table>
                                                   <tr>
                                                       <td><input onclick="all_employee_select()" id="all_employee" type="checkbox" value="yes"></td>
                                                       <td><b>All Employee</b></td>
                                                       <td style=" width:20px; "></td>
                                                       <td><b>Department</b></td><td><b>:</b></td>
                                                       <td> <select id="department_id" class="select_box" style=" width:120px ">
                                                            <option id="zero_1" value="0">--Select--</option>
                                                              <?php
                             if(!empty($_REQUEST['xml_department']))
                             {
                             $get_department=$_REQUEST['xml_department'];   
                             }else
                             {
                              $get_department="";   
                             }
                             $department_db=mysql_query("SELECT * FROM hr_department_db WHERE $db_main_details_whout_session is_delete='none'");
                             while ($department_data=mysql_fetch_array($department_db))
                             {
                                 $department_id=$department_data['department_id'];
                                 $department_name=$department_data['department_name'];
                                 
                                 if($get_department==$department_id)
                                 {
                                 echo "<option value='$department_id' selected>$department_name</option>";
                                 }else
                                 {
                                  echo "<option value='$department_id'>$department_name</option>";
                                    
                                 }
                                 
                             }
                             ?>
                                                           </select></td>
                                                        <td><b>Designation</b></td><td><b>:</b></td>
                                                       <td><select id="designation_id" class="select_box" style=" width:120px ">
                                                            <option id="zero_2" value="0">--Select--</option>
                                                            <?php
                              if(!empty($_REQUEST['xml_designation']))
                             {
                             $get_designation=$_REQUEST['xml_designation'];   
                             }else
                             {
                              $get_designation="";   
                             }  
                             $designation_db=mysql_query("SELECT * FROM hr_designation_db WHERE $db_main_details_whout_session is_delete='none'");
                             while ($designation_data=mysql_fetch_array($designation_db))
                             {
                                 $designation_id=$designation_data['designation_id'];
                                 $designation_name=$designation_data['designation_name'];
                                 if($get_designation==$designation_id)
                                 {
                                 echo "<option value='$designation_id' selected>$designation_name</option>";
                                 }else
                                 {
                                     echo "<option value='$designation_id'>$designation_name</option>";
                                 
                                 }
                                 
                             }
                             ?>
                                                           </select></td>
                                                        <td><b>Teaching Profession</b></td><td><b>:</b></td>
                                                        <td>
                                                            <table>
                                                                <tr>
                                                                    <td><input id="teching_yes" name="profession_teching" type="radio" value="yes"></td>
                                                                    <td>Yes</td>
                                                                    <td><input id="teaching_no" name="profession_teching" type="radio" value="no"></td>
                                                                    <td>No</td>
                                                                </tr>
                                                            </table>   
                                                        </td>
                                                   </tr>
                                               </table>   
                                           </div>
                                           
                                           <div id="contact_option" style=" display:none; ">
                                               <table>
                                                   <tr>
                                                       <td><input type="checkbox" id="all_contact" checked></td>
                                                       <td><b>All Contact</b></td>
                                                       <td style=" width:30px; "></td>
                                                       <td><b>Group</b></td>
                                                       <td><b>:</b></td>
                                                       <td>
                                                           <select id="group_id" class="select_box"  style=" width:120px ">
                                                           <option value="0">--Select--</option> 
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
                                                           </select>   
                                                       </td>
                                                   </tr>
                                               </table>   
                                           </div>
                                           
                                       </td>
                                   </tr>
                                   <tr>
                                       <td colspan="10"><input type="button" onclick="get_details()" class="get_details_button" value="Get Details"></td>
                                   </tr>
                               </table>   
                           </div>
                        
                        
                        <div class="data_list" id='data_list'>
                            
                        </div>
                       </div>   
                       
                       
                       
                       
                   </div>
                   </div>
                
             
                
                
               
            </div> 
        </div>
        
         
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