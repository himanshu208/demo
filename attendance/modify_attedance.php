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



if(isset($_POST['save_attendance_button']))
{
  
$insert_course_id=$_POST['insert_class_id'];
$insert_section_id=$_POST['insert_section_id'];
$insert_session_id=$_POST['use_inset_session_id'];
$insert_attendance_date=$_POST['insert_attendance_date'];
$sms_command=$_POST['sms_command'];
$note=$_POST['note'];


if(count($_POST['insert_student_id'])>0)  
{
$insert_student_id=$_POST['insert_student_id'];
}else
{
 $insert_student_id=0;   
}

if((!empty($insert_student_id))&&(!empty($insert_course_id))&&(!empty($insert_section_id))&&(!empty($insert_session_id))&&(!empty($insert_attendance_date)))
{

 $implode_student_id=implode(",",$insert_student_id);
 $explode_student_id=explode(",",$implode_student_id);
 
 
 $select_match=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details attendance_date='$insert_attendance_date' and "
         . "class_id='$insert_course_id' and section_id='$insert_section_id' and is_delete='none'");
 $select_data=mysql_fetch_array($select_match);
 $select_num_rows=mysql_num_rows($select_match);
 if((!empty($select_data))&&($select_data!=null)&&($select_num_rows!=0))
 {

$update_attendance_day_db= mysql_query("UPDATE attendance_total_day_db SET note='$note' WHERE "
         . "class_id='$insert_course_id' and section_id='$insert_section_id' and attendance_date='$insert_attendance_date' and is_delete='none'");
if((!empty($update_attendance_day_db))&&($update_attendance_day_db))
{
foreach($explode_student_id as $insert_student_id)
 {    
   
$attendance=$_POST["mark_attendance_$insert_student_id"];   
$remark=$_POST["remark_$insert_student_id"];   
$attendance_update_db_id=$_POST["attendance_update_id_$insert_student_id"];

$update_db=mysql_query("UPDATE attendance_mark_db SET attendance='$attendance',remark='$remark',updated_by='$date_time' WHERE mark_attendance_id='$attendance_update_db_id' and "
        . "student_id='$insert_student_id' and is_delete='none'"); 

 }
 
if($update_db)
{
    if($sms_command=="yes")
    {
     header("Location:send_attendance_sms.php?Xmlhtppclass=$insert_course_id&&Xmlhttpsection=$insert_section_id&&xmlhttp_dt=$insert_attendance_date");    
    }else
    {
    $message_show="<span style='color:green;'>Record update successfully complete.</span>";       
    }
}else
{
   $message_show="Request Failed Please try again";   
}
}else
{
   $message_show="Request Failed Please try again";   
} 
 }else
 {
   $message_show="Record does not exist in database";   
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
        <title>Edit Attendance</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/attendance_javascript.js"></script>
       
        <script type="text/javascript">
        function on_submit_button()
        {
 var number=1;


  var test_arr = $("input[name*='insert_student_id[]']"); 
$.each(test_arr, function(i, item) {  //i=index, item=element in array
   var student_id=$(item).val();
   var check_attendance=$("input[name=mark_attendance_"+student_id+"]:checked").val();
  
   if(check_attendance=="a" || check_attendance=="l")
   {
    if(check_attendance=="a")
    {
    var attendance_status="<span class='absent_student'>Absent</span>";
    }else
    {
    var attendance_status="<span class='absent_student' style='background-color:orange;'>Leave</span>";    
    }
   
   document.getElementById("alert_empty").style.display="none";
  
  var student_record=document.getElementById("get_student_data_"+student_id+"").value;
  var remark=document.getElementById("remark_"+student_id+"").value;

  var my_arr=student_record.split('@@');
   
    var table=document.getElementById("pop_table");
    var row = table.insertRow(number);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
     var cell4 = row.insertCell(3);
      var cell5 = row.insertCell(4);
       var cell6 = row.insertCell(5);
   
   cell1.innerHTML=my_arr[0];
   cell2.innerHTML=my_arr[1];
   cell3.innerHTML=my_arr[2];
   cell4.innerHTML=my_arr[3];
    cell5.innerHTML=attendance_status;
     cell6.innerHTML=remark;
  
    number++;
  }
  
  if(number==1)
  {
  document.getElementById("alert_empty").style.display="block";
  }
  
  
});
  
         
           
        var student_list=document.getElementById("student_absent_list").value;
        if(student_list==0)
        {
         document.getElementById("win_pop_up").style.display="block"; 
         return false;
        }else
        {
        document.getElementById("ajax_loader_show").style.display="block";    
        }
        }
        </script>
        
        <script type="text/javascript">
            function ok_close()
            {
               document.getElementById("win_pop_up").style.display="none"; 
               document.getElementById("student_absent_list").value="0";
            }
            
             function close_button()
            {
               document.getElementById("win_pop_up").style.display="none"; 
               document.getElementById("student_absent_list").value="0";
            }
            
              function ab_close_button()
            {
               document.getElementById("win_pop_up_1").style.display="none"; 
                document.getElementById("win_pop_up").style.display="none"; 
               document.getElementById("student_absent_list").value="0";
            }
            
   document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) 
    {
       document.getElementById("win_pop_up").style.display="none";
       document.getElementById("student_absent_list").value="0";
    }else
    if (evt.keyCode == 13) 
    {
    document.getElementById("win_pop_up").style.display="none";
    document.getElementById("student_absent_list").value="0";
    }
}

function continue_buttoned()
{
 

    
 document.getElementById("win_pop_up").style.display="none";     
 document.getElementById("win_pop_up_1").style.display="block";   
 document.getElementById("student_absent_list").value="1";
 return false;   
}

function confirm_button(sms_comand)
{
 document.getElementById("win_pop_up").style.display="none";     
 document.getElementById("win_pop_up_1").style.display="none";
 document.getElementById("sms_command").value=sms_comand;
 document.getElementById("ajax_loader_show").style.display="block";
 
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
        
        
        <form name="myForm" action="" onsubmit="return validateForm(this);" method="post" enctype="multipart/form-data">
           
            <div id="win_pop_up" style=" display:none; ">
            <div id="first_pop_up_div"></div> 
            <div id="second_pop_up" class="second_show_pop_up">
                <div id="student_list_show">
                  <div class="close_div" onclick="close_button()"></div>  
                  <div class="middle_center_work_dived" id="win_pop_up_text">
                      <div class="pop_up_title">Absent/Leave Student List</div>
                      <div style=" width:100%; float:left;max-height:400px; overflow-y:auto;    ">
                      <table cellspacing="0" cellpadding="0" class="pop_table" id="pop_table" >
                          <tr class="pop_tr_heading">
                           <td>Roll No.</td>
                           <td>Admission</td>
                            <td>Student</td>
                             <td>Father</td>
                              <td>Attendance Status</td>
                               <td>Remark</td>
                          </tr>
                          <tr id="alert_empty" style=" display:none; ">
                              <td colspan="9" style=" color:red; text-align:center; "><center><b>Record No Available</center></b></td>
                          </tr>
                      </table>
                      </div>
                       </div>
                  <div class="last_bottom_close_div">
                      <div onclick="continue_buttoned()" class="ok_button_style" style=" background-color:dodgerblue; ">Continue</div>  
                 
                    <div onclick="ok_close()" class="ok_button_style" style=" background-color:red; margin-right:10px;  ">Cancel</div>  
                  </div>
                </div>
                </div>
              </div>
            
            
            
            <input type="hidden" id="student_absent_list" value="0">
            <input type="hidden" name="sms_command" id="sms_command">
            <div id="win_pop_up_1" style=" display:none; ">
            <div id="first_pop_up_div"></div> 
            <div id="second_pop_up" class="second_show_pop_up">
                <div id="student_list_show">
                  <div class="close_div" onclick="ab_close_button()"></div>  
                  <div class="middle_center_work_div"  id="win_pop_up_text">
                    Are You Sure Want To Send SMS To All Absent Students
                       </div>
                  <div class="last_bottom_close_div">
                   
                    <input type="submit" onclick="confirm_button('yes')" name="save_attendance_button" class="ok_button_style" style=" border:0; height:40px;   background-color:dodgerblue; " value="Yes">
                    <input type="submit" onclick="confirm_button('no')" name="save_attendance_button" 
                           class="ok_button_style" style=" border:0; height:40px; margin-right:30px;
                           background-color:orange; " value="No">
                   
                  </div>
                </div>
                </div>
              </div>
            
            
            
            
            
            
            
            
            
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
                          <td>Edit Attendance</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Edit Attendance</b></div>
              <a href="attendance_report.php"> <div class="view_button"><b>View Mark Attendance Report</b></div> </a> 
                   </div>
               
               
               
               <div class='work_main_div'>
                   <table class='main_search_table' style=" float:none; margin:0 auto; margin-top:10px;   ">
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
<td><input type='button' class='add_button_reset_button' onclick="edit_continue_button()" value='Continue'></td>
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
                       
                       <div class="attendance_month_register">
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
                           
                           <div class="button_viem_month"><b>View Attendance Register</b></div>   
                        
                       </div>
                       
                       
                       
                      <div class="month_calander_style">
                      <div class="left_side_title">MONTH - YEAR</div>  
                     
                       <center>
                          <div class="center_month_div">
                               <table cellspacing="2" cellpadding="0" style=" margin-top:2px; ">
                                   <tr>
                                       <td>
                                           <a href="mark_attendance.php?Xmlhtppclass=<?php  echo $class_id;?>&&Xmlhttpsection=<?php  echo $section_id;?>&&xmlhttp_dt=<?php  echo $previous_month_date;?>"><div class="button_next_style" id="dodblue_previous_button"></div></a></td>
                                       <td style=" padding-left:25px; "></td>
                                       <td><?php  echo ucfirst($current_month);?> -<?php  echo $current_year;?></td>
                                       <td style=" padding-left:25px; "></td>
                                       <td>
                                         <?php 
                                           if($strtotime_current_month>$strtotime_get_current_month)
                                           {
                                           ?>
                                           
                                           <a href="mark_attendance.php?Xmlhtppclass=<?php  echo $class_id;?>&&Xmlhttpsection=<?php  echo $section_id;?>&&xmlhttp_dt=<?php  echo $next_month_date;?>"><div class="button_next_style" id="dodblue_next_button"></div></a>
                                     <?php 
                                           }
                                       ?>
                                       </td>
                                     </tr>
                               </table>  
                           </div>
                       </center>
                       </div> 
                       
                       
                       <div class="date_calander_style">
                           <div class="left_side_title" style=" background-color:deeppink; ">DAY - DATE</div>  
                       
                       <center>
                           <div class="center_month_div">
                            <table cellspacing="2" cellpadding="0" style=" margin-top:2px; ">
                                   <tr>
                                       <td>
                                           <a href="mark_attendance.php?Xmlhtppclass=<?php  echo $class_id;?>&&Xmlhttpsection=<?php  echo $section_id;?>&&xmlhttp_dt=<?php  echo $previous_day_date;?>"><div class="button_next_style" id="deeppink_previous_button"></div></a>
                                       </td>
                                       <td style=" padding-left:25px; "></td>
                                       <td><?php  echo ucfirst($current_day);?> -<?php  echo ucfirst($current_date);?></td>
                                       <td style=" padding-left:25px; "></td>
                                       <td>
                                     <?php 
                                       if($strotime_today>$strtotime_get_date)
                                       {
                                       {
                                           ?>    
                      <a href="mark_attendance.php?Xmlhtppclass=<?php  echo $class_id;?>&&Xmlhttpsection=<?php  echo $section_id;?>&&xmlhttp_dt=<?php  echo $next_day_date;?>"><div class="button_next_style" id="deeppink_next_button"></div></a>
                                     <?php 
                                       }
                                       }
                                       ?>
                                       </td>
                                   </tr>
                               </table>     
                           </div>
                       </center>   
                          
                            
                           
                       </div>
                       
                     
                       
                       
                       
                       
                       
                       <div class='main_attendance_div'>
                           <div class='modify_attendance'></div>
                       <table cellspacing="0" cellpadding="0" id="attendance_tabel" style=" width:100%; ">
                           <tr>
                                 <td class="tr_heading_style">Roll No</td>
                                 <td class="tr_heading_style">Admission No.</td>
                                 <td class="tr_heading_style" style=" text-align:left; "><div>Student Name</div></td>
                                 <td class="tr_heading_style" style=" text-align:left; ">Father Name</td>
                                 <td class="tr_heading_style">
                                     <center>
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td><input name="student_attendance" id="prsent_select_all" class='attendance_check_box' type='radio' checked></td>
                                             <td>Present</td>
                                         </tr>
                                     </table>
                                     </center>
                                      </td>
                                      <td class="tr_heading_style">
                                       <center>
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td><input name="student_attendance" id="absent_select_all" class='attendance_check_box' type='radio'></td>
                                             <td>Absent</td>
                                         </tr>
                                     </table></center>   
                                      </td>
                                      <td class="tr_heading_style">
                                       <center>
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td><input name="student_attendance" id="leave_select_all" class='attendance_check_box' type='radio'></td>
                                             
                                             <td>Leave</td>
                                         </tr>
                                     </table></center>    
                                      </td>
                                      <td class="tr_heading_style">
                                        <center>
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td><input name="student_attendance" id="late_select_all" class='attendance_check_box' type='radio'></td>
                                             <td>Late</td>
                                         </tr>
                                     </table></center>    
                                      </td>
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
               
                   $get_student_value="$fetch_student_roll_no@@$admission_no@@$fetch_student_name@@$fetch_student_father_name";
                   
                   
         $mark_attendance_data_db=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_attendance_date' and class_id='$class_id' "
                 . "and section_id='$section_id' and student_id='$fetch_student_id' and is_delete='none'");

        $attandence_num_rows=mysql_num_rows($mark_attendance_data_db);           
        $attendance_data=mysql_fetch_array($mark_attendance_data_db); 
                 if((!empty($attendance_data))&&($attendance_data!=null)&&($attandence_num_rows!=0))
                 {
                  $attendance=$attendance_data['attendance']; 
                  $attendance_update_id=$attendance_data['mark_attendance_id'];
                  if($attendance=="p")
                  {
                    $prsent="checked";  
                  
                    $absent="";
                    $leave="";
                    $late="";
                    
                    echo "<style>#attendance_color_$fetch_student_id { background-color:#E0FFD1;}</style>";
                    
                  }else
                  if($attendance=="a")
                  {
                    $absent="checked"; 
                    $prsent="";
                   
                    $leave="";
                    $late="";
                     echo "<style>#attendance_color_$fetch_student_id { background-color:#FFE6E6;}</style>";
                  }else
                  if($attendance=="l")
                  {
                   $leave="checked";
                   $prsent="";
                    $absent="";
                    
                    $late="";
                     echo "<style>#attendance_color_$fetch_student_id { background-color:#FFFFCC;}</style>";
                  }else
                  if($attendance=="lt")
                  {
                    $late="checked";  
                    $prsent="";
                    $absent="";
                    $leave="";
                     echo "<style>#attendance_color_$fetch_student_id { background-color:#CCD6E0;}</style>";
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
                                      
                                      
                       <?php
                                      if((empty($attendance_data))&&($attendance_data==null)&&($attandence_num_rows==0))
                                      {
                                     ?>                 
                       <tr class="green_color_all" id="attendance_color_<?php  echo $fetch_student_id;?>">
                           <?php
                                      }else
                                      {
                           ?>
                             <tr  id="attendance_color_<?php  echo $fetch_student_id;?>">
                             <style>
                                #prsent_select_all { display:none; } 
                                #absent_select_all { display:none; } 
                                #leave_select_all { display:none; } 
                                #late_select_all { display:none; } 
                             </style>
                           
                           <?php
                                      }
                           ?>
                           
                       <td class="attendance_td_style"><center><b><?php  echo $fetch_student_roll_no;?></b></center>
                       <input type="hidden" id="total_working_day_<?php  echo $fetch_student_id;?>" value="<?php  echo $total_working_days;?>">
                       <input type="hidden" id="prsent_allendance_<?php  echo $fetch_student_id;?>" value="<?php  echo $student_prsent_att;?>">
                       <input type="hidden" id="leave_allendance_<?php  echo $fetch_student_id;?>" value="<?php  echo $student_leave_att;?>">
                       <input type="hidden" id="leave_count_attendance_<?php  echo $fetch_student_id;?>" value="2">
                       </td>
                       
                       <td class="attendance_td_style">
                           <input type="hidden" name="attendance_update_id_<?php  echo $fetch_student_id;?>" value="<?php echo $attendance_update_id;?>">
                           <input type="hidden" id="get_student_data_<?php  echo $fetch_student_id;?>" value="<?php echo $get_student_value;?>">
                           <input type="hidden" class="student_id_list" name="insert_student_id[]" value="<?php  echo $fetch_student_id;?>">
                       <center><?php  echo $admission_no;?></center>
                       </td>
                       
                     
                       <td class="attendance_td_style"><?php  echo $fetch_student_name;?></td>
                       <td class="attendance_td_style"><?php  echo $fetch_student_father_name;?></td>
                                 
                       
                                   <td class="attendance_td_style">
                                   <center>
                                    
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td> <input name="mark_attendance_<?php  echo $fetch_student_id;?>" onclick="prsent_status('<?php  echo $fetch_student_id;?>')" class='td_attendance_check_box_p' type='radio' value='p' <?php echo $prsent;?>></td>
                                     <td>Present</td> </tr>  </table>
                                     
                                   </center>  
                                 </td>
                                 <td class="attendance_td_style">
                                   <center>
                                      
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
     <td>
         <input name="mark_attendance_<?php  echo $fetch_student_id;?>" onclick="absent_status('<?php  echo $fetch_student_id;?>')" class='td_attendance_check_box_a' type='radio' value='a' <?php echo $absent;?>></td>
     </td>
                                             <td>Absent</td>
                                         </tr>
                                     </table>
                                  
                                   </center>  
                                 </td>
                                 <td class="attendance_td_style">
                                   <center>
                                      
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td>
                                                 <input name="mark_attendance_<?php  echo $fetch_student_id;?>" onclick="leave_status('<?php  echo $fetch_student_id;?>')" class='td_attendance_check_box_l' type='radio' value='l' <?php echo $leave;?>></td>
     
                                             </td>
                                             <td>Leave</td>
                                         </tr>
                                     </table>
                                  
                                   </center>  
                                 </td>
                                 
                                 <td class="attendance_td_style">
                                   <center>
                                       
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td>
                                              <input name="mark_attendance_<?php  echo $fetch_student_id;?>" onclick="school_leave_status('<?php  echo $fetch_student_id;?>')" class='td_attendance_check_box_lt' type='radio' value='lt' <?php echo $late;?>></td>
      
                                             </td>
                                             <td>Late</td>
                                         </tr>
                                     </table>
                                  
                                   </center>  
                                 </td>
                                 <td class="attendance_td_style" style=" padding-left:3px; padding-right:3px;  ">
                                   
<textarea id="remark_<?php  echo $fetch_student_id;?>" style=" width:96%; "
          name="remark_<?php  echo $fetch_student_id;?>"><?php echo $remark; ;?></textarea>
                                  
                                 </td>
                                 <td class="attendance_td_style" style=" text-align:center;  border-right:1px solid gray; ">
                                     <div id="student_attendance_aggrigate_<?php  echo $fetch_student_id;?>"><?php echo $attendance_aggrigate;?>%</div>   
                                 </td>
                             </tr>
                             
                         <?php 
                           }
                   }
                   }
                           ?>
                        
                             
                             <tr>
                                 <td colspan="8">
                                     <div style=" float:left; ">
                                         <table cellspacing="0" cellpadding="2" class="reprsent_table">
                                             <tr>
                                                 <td><div class="reprsent_color" style=" background-color:#CCF5CC; "></div></td><td><b>Present</b></td>
                                             </tr>
                                              <tr>
                                                  <td><div class="reprsent_color" style=" background-color:#FF8080; "></div></td><td><b>Absent</b></td>
                                             </tr>
                                                 <tr>
                                                     <td><div class="reprsent_color" style=" background-color:#FFFF80; "></div></td><td><b>Leave</b></td>
                                             </tr>                                          
                                             <tr>
                                                 <td><div class="reprsent_color" style=" background-color:whitesmoke; "></div></td><td><b>Late</b></td>
                                             </tr>                                          

                                         </table>   
                                     </div>   
                                      <div class="total_student_record_div">
                                          
                                          
                                          <table style=" width:65%;  float:left; margin:10px;  ">
                                           
                                              <tr>
                                                  <td style=" width:40px; "><b>Note</b></td><td><b>:</b></td>
                                                   <?php
                                            if((empty($attendance_total_data))&&($attendance_total_data==null)&&($attendance_total_num_rows==0))
{
 $note=""; 
}else
{
 
  $note=$attendance_total_data['note']; 
}  
   
                                            ?>
                                                  <td><textarea class="text_area_style" name="note" style=" height:70px; "><?php echo $note;?></textarea></td>
                                          
                                              </tr>
                                             
                                          </table> 
                                          
                                          
                                          <table cellspacing="0" cellpadding="5" id="track_student_table" style=" float:left;  ">
                                              <tr >
                                                  <td><b>Total Student</b></td><td><b>:</b></td><td><?php echo $fetch_student_num_rows;?></td>  
                                              </tr>
                                              <tr>
                                                  <td><b>Total Present</b></td><td><b>:</b></td><td><div id="total_present">
      
                                                     <?php 
                                                       if((empty($attendance_total_data))&&($attendance_total_data==null)&&($attendance_total_num_rows==0))
{
                                                           echo $fetch_student_num_rows;          
                                                       }else
                                                       {
                                                           echo $total_prsent_student;    
                                                       }
                                                     
                                                     ?> 
                                                      
                                                      </div></td>  
                                              </tr>
                                              <tr>
                                                  <td><b>Total Absent</b></td><td><b>:</b></td><td><div id="total_absent"><?php echo $total_absent_student;?></div></td>  
                                              </tr>
                                              <tr>
                                                  <td><b>Total Leave</b></td><td><b>:</b></td><td><div id="total_leave"><?php echo $total_leave_student;?></div></td>  
                                              </tr>
                                              <tr>
                                                  <td><b>Total Late</b></td><td><b>:</b></td><td style=" width:20px; "><div id="total_late"><?php echo $total_late_student;?></div></td>  
                                              </tr>
                                          </table>
                                     </div>  
                                 </td>
                                
                                 
                                 <td colspan="4">
                                  
                                     
                                     <input type="button" class="button_styling" onclick="on_submit_button()" id="submit_button_1" name='save_attendance_button' value="Update"> 
                                     <input type="button" class="button_styling" style=" background-color:deeppink; " value="Reset">
                            
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
    $('#prsent_select_all').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.td_attendance_check_box_p').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"   
              $(".green_color_all").css("background-color","#E0FFD1");  
              
    $('input:radio').change(function(){
        var prsent = $('.td_attendance_check_box_p:checked').length;
        var absent = $('.td_attendance_check_box_a:checked').length;
        var leave=$('.td_attendance_check_box_l:checked').length;
        var late=$('.td_attendance_check_box_lt:checked').length;        
        $('#total_present').text(prsent);
        $('#total_absent').text(absent);     
         $('#total_leave').text(leave);     
          $('#total_late').text(late);     
    });
              
              
            });
        }else{
            $('.td_attendance_check_box_p').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
    $('#absent_select_all').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.td_attendance_check_box_a').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"   
                 $(".green_color_all").css("background-color","#FFE6E6");  
              
       $('input:radio').change(function(){
        var prsent = $('.td_attendance_check_box_p:checked').length;
        var absent = $('.td_attendance_check_box_a:checked').length;
        var leave=$('.td_attendance_check_box_l:checked').length;
        var late=$('.td_attendance_check_box_lt:checked').length;        
        $('#total_present').text(prsent);
        $('#total_absent').text(absent);     
         $('#total_leave').text(leave);     
          $('#total_late').text(late);     
    });
            });
        }else{
            $('.td_attendance_check_box_a').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
    $('#leave_select_all').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.td_attendance_check_box_l').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"       
                 $(".green_color_all").css("background-color","#FFFFCC"); 
                 
                 $('input:radio').change(function(){
        var prsent = $('.td_attendance_check_box_p:checked').length;
        var absent = $('.td_attendance_check_box_a:checked').length;
        var leave=$('.td_attendance_check_box_l:checked').length;
        var late=$('.td_attendance_check_box_lt:checked').length;        
        $('#total_present').text(prsent);
        $('#total_absent').text(absent);     
         $('#total_leave').text(leave);     
          $('#total_late').text(late);     
    });
                 
            });
        }else{
            $('.td_attendance_check_box_l').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
    $('#late_select_all').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.td_attendance_check_box_lt').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"   
                 $(".green_color_all").css("background-color","#CCD6E0");  
                 
                 
                 $('input:radio').change(function(){
        var prsent = $('.td_attendance_check_box_p:checked').length;
        var absent = $('.td_attendance_check_box_a:checked').length;
        var leave=$('.td_attendance_check_box_l:checked').length;
        var late=$('.td_attendance_check_box_lt:checked').length;        
        $('#total_present').text(prsent);
        $('#total_absent').text(absent);     
         $('#total_leave').text(leave);     
          $('#total_late').text(late);     
    });
                 
            });
        }else{
            $('.td_attendance_check_box_lt').each(function() { //loop through each checkbox
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