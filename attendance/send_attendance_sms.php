<?php
//SESSION CONFIGURATION
$check_array_in="attendance";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>

<?php  
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$today_date=date("Y-m-d");
$print_today_date=date("l d/F/Y");
$date_time=$today_date." ".$time_current;
$check_current_month=date("Y-m");



if(isset($_POST['send_sms_button']))
{
 require_once'../sms_email_integration/phone_sms_api.php';
 
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
   $sms_report=sms_api($user_mobile_no,$user_message,$user_id,""); 
   
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
        <title>Attedance Send SMS</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/attendance_javascript.js"></script>
        <script type="text/javascript">
        function validateForm()
        {
             var checkboxes = document.querySelectorAll('input[name="post_data[]"]:checked'), values = [];
    Array.prototype.forEach.call(checkboxes, function(el) {
        values.push(el.value);
    });
    var message=document.getElementById("message").value;
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
    document.getElementById("ajax_loader_show").style.display="block";    
    }
    
    
        }
        </script>
    </head>
    <body onload='window_load()'>
        
            
   <?php 
      include_once '../ajax_loader_page_second.php';
      ?>  
        
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        
        
        <form name="myForm" action="send_attendance_sms.php" onsubmit="return validateForm(this);" method="post" enctype="multipart/form-data">
       
         <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">  
        
         <div id="main_work_first_div" style=" float:left; ">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="attendance_dashboard.php">Attendance</a></td>
                           <td>/</td>
                          <td>Attedance Send SMS</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Attedance Send SMS</b></div>
              <a href="mark_attendance.php"> <div class="view_button"><b>Add Mark Attendance</b></div> </a> 
                   </div>
               
               
               
               <div class='work_main_div'>
                   <table class='main_search_table' style=" float:none; margin:auto; margin-top:10px;   ">
                       <tr>
                           <td><b>Class/Course <sup style=" color:red; ">*</sup></b></td>
                           <td><b>:</b></td>
                           <td><select id="class_course_id" onchange="class_id(this.value)" class='attendance_select'>
                                  <option value="0">--- Select ---</option> 
                                   
                                 <?php  
                         $course_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
                          while ($fetch_course_data=mysql_fetch_array($course_db))
                          {
                              
                           if(!empty($_REQUEST['Xmlhtppclass']))
                           {
                            $get_course_name=$_REQUEST['Xmlhtppclass'];   
                           }else
                           {
                           $get_course_name="";    
                           }
                              
                           $fetch_course_name=$fetch_course_data['course_name']; 
                           $fetch_course_id=$fetch_course_data['course_id']; 
                           
                           if($get_course_name==$fetch_course_id)
                           {
                             echo "<option value='$fetch_course_id' selected>$fetch_course_name</option>";
                              
                           }else
                           {
                             echo "<option value='$fetch_course_id'>$fetch_course_name</option>";
                              
                           }
                           
                          
                          }
                                   ?>
                                   
                               
                               </select></td>
                           <td style=" width:20px; "></td>
                           <td><b>Section <sup style=" color:red; ">*</sup></b></td>
                           <td><b>:</b></td>
                           <td><select id="section_name" class='attendance_select'>
                                   
                                <?php 
                                  if(empty($_REQUEST['Xmlhttpsection']))
                                  {
                                      echo "<option>--- Select ---</option>";   
                                  }else
                                  {
                 $get_course_name=$_REQUEST['Xmlhtppclass']; 
                 $get_section_id=$_REQUEST['Xmlhttpsection'];
    $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details course_id='$get_course_name' and action='active'");
    while ($fetch_class_data=mysql_fetch_array($section_db))
    {
        $fetch_section_id=$fetch_class_data['section_id'];
        $fetch_section_name=$fetch_class_data['section_name'];
        if($get_section_id==$fetch_section_id)
        {
        echo "<option value='$fetch_section_id' selected>$fetch_section_name</option>";
        }else
        {
         echo "<option value='$fetch_section_id'>$fetch_section_name</option>";   
        }
    } 
   if(empty($fetch_section_id))
   {
    echo "<option>--- Select ---</option>";      
   }
                                      
                                      
                                      
                                  }
                                  
                                  ?>
                                   
                               </select>
                           </td>
                           <?php
                           if(!empty($_REQUEST['xmlhttp_dt']))
                           {
                          $get_date=$_REQUEST['xmlhttp_dt'];     
                           }else
                           {
                          $get_date="";      
                           }
                           ?>
                           
                            <td style=" width:20px; "></td>
                           <td><b>Date</b></td><td><b>:</b></td>
                           <td><input readonly="readonly" type="text" id="attendance_date" class="text_box_styling" 
                                      style=" background-color:whitesmoke; width:150px;  " 
                                      value="<?php if(!empty($get_date)){ echo $get_date; $insert_attendance_date=$get_date; }else {
                                          echo $today_date; $insert_attendance_date=$today_date; }?>"></td>
                             <td style=" width:20px; "></td>
<td><input type='button' class='add_button_reset_button' onclick="send_continue_button()" value='Continue'></td>
<td><input type='button' class='add_button_reset_button' style="background-color:deeppink;" value='Reset'></td>
                       </tr>
                       
                   </table>    
               </div>
                
                    
               <div id="main_attendance_work_div">
               
                   <?php
                 if((!empty($_REQUEST['Xmlhtppclass']))&&(!empty($_REQUEST['Xmlhttpsection']))&&(!empty($_REQUEST['xmlhttp_dt'])))  
                 { 
                   
           $attendance_data_db=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_attendance_date' and is_delete='none'");
$attendance_data=mysql_fetch_array($attendance_data_db);
$attendance_num_data=mysql_num_rows($attendance_data_db);
if((!empty($attendance_data))&&($attendance_data!=null)&&($attendance_num_data!=0))
{
                   ?>
                   
                   
                   <div class="sms_div">
                       <table cellspacing="1" cellpadding="1" class="sms_table" style=" width:60%; ">
                                <tr>
                                   <td><b>Send By<sup>*</sup></b></td><td><b>:</b></td>
                                   <td>
                                       <select class="select_box" name="send_to">
                                           <option value="student">Students</option>
                                       </select>   
                                   </td>
                               </tr>
                               <tr>
                                   <td><b>SMS Type<sup>*</sup></b></td><td><b>:</b></td>
                                   <td>
                                       <select class="select_box" disabled>
                                           <option value="0">Attendance</option> 
                                       </select>   
                                   </td>
                                  
                               </tr>
                               
                                <tr>
                                   <td><b>Language <sup>*</sup></b></td><td><b>:</b></td>
                                   <td>
                                       <table>
                                           <tr>
                                               <td><input type="radio" checked=""></td><td>English</td>
                                               <td><input type="radio"></td><td>Hindi</td>
                                                <td><input type="radio"></td><td>Other</td>
                                           </tr>
                                       </table>  
                                   </td>
                               </tr>  
                               <tr>
                                   <td><b>Message <sup>*</sup></b></td><td colspan="2" style="text-align:right; "></td>
                               </tr>
                               <tr>
                                   <td colspan="5"><textarea readonly='readonly' style='background-color:whitesmoke;' name="message_post" id="message" placeholder="Please enter message" class="sms_message">
Dear Parent,
This is to inform you that your ward #name# is absent from School Today.
Regards,
J.D CONVENT SCHOOL.
For any query call on 9719353585
</textarea></td>
                               </tr>
                               <tr>
                                   <td colspan="5">
                                       
                                       <input type="submit" class="button_css"
                                              style=" padding-left:20px; padding-right:20px;    height:45px; border:0;   float:right; " name="send_sms_button" value="SEND SMS">
                                   </td>
                               </tr>
                           </table>
                   </div>
                   
                   
                   
                   
                   <div class="student_record_div">
                       
                   <?php 
                  if((!empty($_REQUEST['Xmlhtppclass']))&&(!empty($_REQUEST['Xmlhttpsection']))&&(!empty($_REQUEST['xmlhttp_dt'])))

                  {
          
                   $class_id=$_REQUEST['Xmlhtppclass'];
                   $section_id=$_REQUEST['Xmlhttpsection'];
                 
        $total_work_day=mysql_query("SELECT * FROM attendance_total_day_db WHERE $db_main_details "
        . " class_id='$class_id' and section_id='$section_id' and is_delete='none'");
$total_working_days=mysql_num_rows($total_work_day);  
                   
                   
                   $attendance_of_student_record=mysql_query("SELECT *,T1.encrypt_id as ad_id FROM student_db as T1"
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
                 . " $db_t1_main_details T1.course_id='$class_id' and T1.section_id='$section_id' and T1.is_delete='none' ORDER BY T1.roll_no ASC");
         
                   $fetch_student_num_rows=mysql_num_rows($attendance_of_student_record);
                   if($fetch_student_num_rows!=0)
                   {
         
$attendance_mark_type=mysql_query("SELECT * FROM attendance_type WHERE $db_main_details class_id='$class_id' and section_id='$section_id' and is_delete='none'");                  
 $fecth_attendance_mark_type_data=mysql_fetch_array($attendance_mark_type);
 $fecth_attendance_mark_type_num_rows=  mysql_num_rows($attendance_mark_type);
 if((!empty($fecth_attendance_mark_type_data))&&($fecth_attendance_mark_type_data!=null)&&($fecth_attendance_mark_type_num_rows!=0))
 {
   
     
  if(!empty($_REQUEST['xmlhttp_dt']))  
  {
  $get_today_date=$_REQUEST['xmlhttp_dt'];
  $date=date($get_today_date);
  }else
  {
   $date=date($today_date);   
  }

function isValidDate($date)
{
	if(preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $date, $matches))
	{
		if(checkdate($matches[2], $matches[3], $matches[1]))
		{
			return true;
		}
	}
}

if(isValidDate($date))
{
	
  
  
  
  
$current_day =date("l",strtotime($date));
$current_month=date("F",strtotime($date));
$current_year =date("Y",strtotime($date));
$current_date=date("d/F/Y",strtotime($date));
 
$next_month_date=date("Y-m-d",strtotime($date .' +1 month'));
$previous_month_date=date("Y-m-d",strtotime($date .' -1 month'));
 
$next_day_date=date("Y-m-d",strtotime($date .' +1 day'));
$previous_day_date=date("Y-m-d",strtotime($date .' -1 day'));
 
$insert_attendance_date=date("Y-m-d",strtotime($date));
             

$mark_attendance_dbs=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_attendance_date' and class_id='$class_id' and section_id='$section_id' and is_delete='none'");
$fetch_already_attendance=mysql_num_rows($mark_attendance_dbs);

$prsent_attendance=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_attendance_date' and class_id='$class_id' and section_id='$section_id'"
        . "and attendance='p' and is_delete='none'");
$total_prsent_student=mysql_num_rows($prsent_attendance);

$absent_attendance=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_attendance_date' and class_id='$class_id' and section_id='$section_id'"
        . "and attendance='a' and is_delete='none'");
$total_absent_student=mysql_num_rows($absent_attendance);

$leave_attendance=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_attendance_date' and class_id='$class_id' and section_id='$section_id'"
        . "and attendance='l' and is_delete='none'");
$total_leave_student=mysql_num_rows($leave_attendance);

$late_attendance=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_attendance_date' and class_id='$class_id' and section_id='$section_id'"
        . "and attendance='lt' and is_delete='none'");
$total_late_student=mysql_num_rows($late_attendance);


$attendance_total_db=mysql_query("SELECT * FROM attendance_total_day_db WHERE $db_main_details class_id='$class_id' "
        . "and section_id='$section_id' and attendance_date='$insert_attendance_date' and is_delete='none'");
$attendance_total_num_rows=mysql_num_rows($attendance_total_db);
$attendance_total_data= mysql_fetch_array($attendance_total_db);



//check next date forward
$strotime_today=strtotime($today_date);
$strtotime_get_date=strtotime($date);

$check_current_month_or_year=date("Y-M",strtotime($date));

//check next month forward
$strtotime_current_month=strtotime($check_current_month);
$strtotime_get_current_month=strtotime($check_current_month_or_year);


if(($strotime_today>=$strtotime_get_date)&&($strtotime_current_month>=$strtotime_get_current_month))

{
              {
                   ?>      
                       
                       
                       <input type='hidden' name='insert_class_id' value='<?php  echo $class_id;?>'>
                       <input type='hidden' name='insert_section_id' value='<?php  echo $section_id;?>'>
                       <input type='hidden' name='insert_attendance_date' value='<?php  echo $insert_attendance_date;?>'>
                      
                       <?php
                         $class_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details course_id='$class_id' and is_delete='none'");
                                $fetch_class_data=mysql_fetch_array($class_db);
                                $fetch_class_num_rows=mysql_num_rows($class_db);
                                if((!empty($fetch_class_data))&&($fetch_class_data!=null)&&($fetch_class_num_rows!=0))
                               {
                                $fetch_class_name=$fetch_class_data['course_name'];
                                $fetch_class_id=$fetch_class_data['course_id'];
                               }else
                               {
                               $fetch_class_name="";    
                               }
                               
                                $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details section_id='$section_id' and is_delete='none'");
                         
                                $fetch_section_data=mysql_fetch_array($section_db);
                                $fetch_section_num_rows=mysql_num_rows($section_db);
                                if((!empty($fetch_section_data))&&($fetch_section_data!=null)&&($fetch_section_num_rows!=0))
                               {
                                $fetch_section_name=$fetch_section_data['section_name'];
                               
                               }else
                               {
                               $fetch_section_name="";    
                               }
                               
                               
                               
                       ?>
                       
                       <div class="attendance_month_register" style=" margin-top:10px; margin-bottom:10px;">
                           <div class='class_or_section'>
                               <table style=" color:black; ">
                                   <tr>
                                       <td><b>Class/Course</b></td>
                                       <td><b>:</b></td>
                                       <td><?php echo $fetch_class_name;?></td>
                                       <td style=" width:40px; "></td>
                                       <td><b>Section</b></td>
                                       <td><b>:</b></td>
                                       <td><?php echo $fetch_section_name;?></td>
                                       <td style=" width:60px; "></td>
                                       <td><b>Today Date</b></td>
                                       <td><b>:</b></td>
                                       <td><?php  echo $print_today_date;?></td>
                                       
                                         <td style=" width:60px; "></td>
                                       <td><b>Attendance Date</b></td>
                                       <td><b>:</b></td>
                                       <td><?php  echo $get_date;?></td>
                                   </tr>
                               </table>   
                           </div>
                       </div>
                     
                       <input type="hidden" name="attendance_date" value="<?php echo $get_date;?>">
                       <div class='main_attendance_div'>
                           <div class='modify_attendance'></div>
                       <table cellspacing="0" cellpadding="0" id="attendance_tabel" style=" width:100%; ">
                        <tr>
                               <td class="tr_heading_style"><input type="checkbox" id="select_all" checked></td>
                                 <td class="tr_heading_style">Roll No</td>
                                 <td class="tr_heading_style">Admission No.</td>
                                 <td class="tr_heading_style" style=" text-align:left; "><div>Student Name</div></td>
                                 <td class="tr_heading_style" style=" text-align:left; ">Father Name</td>
                                 <td class="tr_heading_style" style=" text-align:center; ">Father Mobile No.</td>
                                 <td class="tr_heading_style">Attendance Status</td>
                                 <td class="tr_heading_style">Remark For A/L/LT</td>
                                 <td class="tr_heading_style" style=" border-right:1px solid gray; ">Aggregate (%)</td>
                        </tr> 
                             
                        <?php 
                  }
                  
                   $row=0;
                   
                   while ($fetch_student_data=mysql_fetch_array($attendance_of_student_record))
                   {
                    $row++;
                    
                   $fetch_student_id=$fetch_student_data['student_id'];
                   $admission_no=$fetch_student_data['admission_no'];
                   $fetch_student_roll_no=$fetch_student_data['roll_no'];
                   $fetch_student_name=ucfirst($fetch_student_data['student_full_name']);
                   $fetch_student_father_name=ucfirst($fetch_student_data['father_name']);
                   $father_mobile_number=$fetch_student_data['father_mobile_no'];
                   $get_student_value="$fetch_student_roll_no@@$admission_no@@$fetch_student_name@@$fetch_student_father_name";
                   
                   $post_data=$father_mobile_number."@$$@".$fetch_student_name."@$$@".$fetch_student_id;
                   
         $mark_attendance_data_db=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_attendance_date' and class_id='$class_id' "
                 . "and section_id='$section_id' and student_id='$fetch_student_id' and is_delete='none'");

        $attandence_num_rows=mysql_num_rows($mark_attendance_data_db);           
        $attendance_data=mysql_fetch_array($mark_attendance_data_db); 
                 if((!empty($attendance_data))&&($attendance_data!=null)&&($attandence_num_rows!=0))
                 {
                  $attendance=$attendance_data['attendance'];   
                  if(($attendance=="a") || ($attendance=="l"))
                  {
                  if($attendance=="a")
                  {
                  $absent="<span class='attendance_style' style='background-color:red;'>Absent</span>"; 
                  }else
                  if($attendance=="l")
                  {
                   $absent="<span class='attendance_style' style='background-color:yellow; color:black;'>Leave</span>";
                  }
                  
                 $remark=$attendance_data['remark'];   
                 
        
                 
                 
$student_prsent_att=0;
$student_absent_att=0;
$student_leave_att=0;
$student_late_att=0;
$mark_attenandance_type=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details class_id='$class_id' "
        . "and section_id='$section_id' and student_id='$fetch_student_id' "
        . "and is_delete='none' and action='action'");
while ($fetch_attendance_data=mysql_fetch_array($mark_attenandance_type))
{
$attendance=$fetch_attendance_data['attendance'];
if($attendance=="p")
{
 $student_prsent_att++;   
}else
 if($attendance=="a")
{
 $student_absent_att++;   
}else
 if($attendance=="l")
{
 $student_leave_att++;   
}else
    if($attendance=="lt")
{
 $student_late_att++;   
}
}
     
$leave_attendance_count=$student_leave_att;
$leave_attendance_calculate=($student_leave_att/2);
 if((empty($attendance_data))&&($attendance_data==null)&&($attandence_num_rows==0))
 {
 $add=1;    
 }  else {
    $add=0; 
 }

$total_prsent_attendance=($student_prsent_att+$leave_attendance_calculate+$student_late_att+$add);
if($total_working_days!=0)
{
$attendance_aggrigate=(($total_prsent_attendance*100)/$total_working_days);
}else
{
 $attendance_aggrigate=0;   
}
if($attendance_aggrigate!=0)
{
 $attendance_aggrigate=number_format($attendance_aggrigate,2);   
}
        
                   {   
                       ?>
                                      
                    
                             <tr  id="attendance_color_<?php  echo $fetch_student_id;?>">
                                 <td class="attendance_td_style"><center><input class="checkbox_1" type="checkbox" name="post_data[]"
                             value="<?php echo $post_data;?>" checked></center></td>   
                       <td class="attendance_td_style"><center><b><?php  echo $fetch_student_roll_no;?></b></center></td>
                       <td class="attendance_td_style"><center><?php  echo $admission_no;?></center></td>
                       <td class="attendance_td_style"><?php  echo $fetch_student_name;?></td>
                       <td class="attendance_td_style"><?php  echo $fetch_student_father_name;?></td>
                       <td class="attendance_td_style"><center><?php  echo $father_mobile_number;?></center></td>
                       <td class="attendance_td_style"><center><?php  echo $absent;?></center></td>
                       <td class="attendance_td_style" style=" padding-left:3px; padding-right:3px;  "><?php  echo $remark;?></td>
                       <td class="attendance_td_style" style=" text-align:center;  border-right:1px solid gray; ">
                       <div id="student_attendance_aggrigate_<?php  echo $fetch_student_id;?>"><?php echo $attendance_aggrigate;?>%</div>   
                        </td>
                             </tr>
                             
                 <?php 
                 }
                 }
                 }
                 }
                 ?>
                        
                             
                             <tr>
                                 <td colspan="8">
                                  
                                      <div class="total_student_record_div">
                                          
                                          
                                          <table style=" width:65%;  float:left; margin:10px;  ">
                                           
                                              <tr>
                                                  <td style=" width:40px; "><b>Note</b></td><td><b>:</b></td>
                                                   <?php

  $note=$attendance_total_data['note'];
  echo "<td>"; 
  echo ucwords($note);
  echo "</td>";
                                              ?>
                                              </tr>
                                             
                                          </table> 
                                          
                                          
                                          
                                     </div>  
                                 </td>
                                
                               
                                 
                             </tr>   
                            <?php 
                   
                              }  else {
     echo "<center><br/><br/><br/><span style='color:red; padding:10%; font-size:22px;'>enter below date</span></center>"; 
 }
}  else {
    echo "<center><br/><br/><br/><span style='color:red; padding:10%; font-size:22px;'><b>invalid date</b></span></center>";
}
 

 }  else {
     echo "<center><br/><br/><br/><span style='color:red; padding:10%; font-size:22px;'><b>Please first create mark attendance type"
     . ". <a href='manage_mark_attendance_type.php'>Create</a></b></span></center>"; 
 }
 

                   }  else {
                       echo "student no found !";
                   }
                  }
                  }else {
    echo "<center><br/><br/><br/><span style='color:red; padding:10%; font-size:22px;'><b>No Attedance Available.</b>"
                      . "  <a href='mark_attendance.php?Xmlhtppclass=$get_course_name&&Xmlhttpsection=$get_section_id&&xmlhttp_dt=$get_date'><b>Create</b></a></span></center>";
} 
                 
                 
                 }
                             ?> 
                       </table>  
                       </div>
                   </div>   
                   </div></div> 
        </div>
        </div>
        </form>
        
         <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
         
                       
              
<script type="text/javascript">    
$(function() {
$("#attendance_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      maxDate: 0,
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
});
    </script>
    
    <script type="text/javascript">
        $(document).ready(function() {
    $('#select_all').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox_1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"
            });
        }else{
            $('.checkbox_1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });

    
});
        </script>
        <div style=" width:200px; height:70px; float:left;   "></div>
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