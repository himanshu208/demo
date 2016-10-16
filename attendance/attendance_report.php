<?php
//SESSION CONFIGURATION
$check_array_in="attendance";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Attendance Report </title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
         <script type="text/javascript" src="../javascript/attendance_javascript.js"></script>
       
    </head>
    <body>
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
         <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>"> 
        
        
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
        <script type="text/javascript">
      
$(function() {

$("#from_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });  
    
    $("#to_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });  
});
    </script>
    
    
    
    
    <?php 
      include_once '../ajax_loader_page_second.php';
      ?>  
        
    <?php
     date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
    ?>
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="attendance_dashboard.php">Attendance</a></td>
                           <td>/</td>
                          <td>View Attendance Report</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>View Attendance Report</b></div>
              <a href="mark_attendance.php"> <div class="view_button">Add Mark Attendance</div> </a> 
                   </div>
                
               
               <div class='work_main_div' style=" height:auto; padding-bottom:2px;  ">
                    <table class="date_table">
                <tr>
                    <td><div class="by_date"><b>By Date</b></div></td>
                    <td style=" width:20px; "></td>
                    
                              <td>
                              <b>From <sup>*</sup></b>    
                               </td>
                               <td><b>:</b></td>
                               <td><input class="date_text_box" readonly="readonly" id="from_date" value="<?php  if(!empty($_REQUEST['Xmlfromd'])){ echo $_REQUEST['Xmlfromd'];}else { echo $date;}?>" placeholder="Enter date from" type="text"></td>
                                <td style=" width:40px; "></td>
                                <td>
                                   <b>To <sup>*</sup></b>    
                               </td>
                               <td><b>:</b></td>
                               <td><input class="date_text_box" readonly="readonly" id="to_date" value="<?php  if(!empty($_REQUEST['Xmltod'])){ echo $_REQUEST['Xmltod'];}else { echo $date;}?>" placeholder="Enter date to" type="text"></td>
                               <td style=" width:70px; "></td>
                               <td>
                                   <?php
                                   if(!empty($_REQUEST['Xmlhtppresultoption']))
                                   {
                                  if($_REQUEST['Xmlhtppresultoption']=="greater_than")
                                  {
                                   $greater_than="selected";
                                    $less_than="";    
                                  }else
                                  {
                                   $greater_than="";
                                    $less_than="selected";    
                                  }
                                       
                                   }else
                                   {
                                    $greater_than="";
                                    $less_than="";
                                   }
                                   ?>
                                   
                                   <select id="result_this_by" class="select_border_none">
                                       <option value="greater_than" <?php echo $greater_than;?>>Result Greater Than</option>
                                       <option value="less_then" <?php echo  $less_than;?>>Result Less Than</option>
                                   </select>
                               </td>
                               <td><b>:</b></td>
                               
                               <?php
                               if(!empty($_REQUEST['Xmlhtppresultvalue']))
                               {
                                $result_value=$_REQUEST['Xmlhtppresultvalue'];   
                               }else
                               {
                                  $result_value=0; 
                               }
                               ?>
                               <td><input type="text" id="result_value" class="text_box_border_style" value="<?php echo $result_value;?>"></td>
                </tr>
            </table>
                   <table class='main_search_table' style=" margin-left:0px; ">
                       
                       <tr>
                           <td><b>Class/Course <sup style=" color:red; ">*</sup></b></td>
                           <td><b>:</b></td>
                           <td><select id="class_course_id" onchange="class_id(this.value)" class='attendance_select' style=" width:220px; ">
                                  <option value="0">--- Select ---</option> 
                                   
                                 <?php  
                                    $course_db=  mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
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
                           <td style=" width:10px; "></td>
                           <td><b>Section <sup style=" color:red; ">*</sup></b></td>
                           <td><b>:</b></td>
                           <td><select id="section_name" onchange="section_change(this.value)" class='attendance_select' style=" width:220px; ">
                                   
                                <?php 
                                  if(empty($_REQUEST['Xmlhttpsection']))
                                  {
                                      echo "<option>--- Select ---</option>";   
                                  }else
                                  {
                 $get_course_name=$_REQUEST['Xmlhtppclass']; 
                 $get_section_id=$_REQUEST['Xmlhttpsection'];
    $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details course_id='$get_course_name' and is_delete='none' ORDER BY section_name ASC");
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
                                   
                               </select></td>
                                <td style=" width:10px; "></td>
                                <td><b>Student</b></td>
                                <td><b>:</b></td>
                                <td>
                                    <div id="temp_student_list">
                                 <select id="student_id" data-placeholder="---Select---" class="chosen-select" tabindex="-1">
                                     <option value="0"></option>
                                     <?php
                                 if((!empty($_REQUEST['Xmlhtppclass']))&&(!empty($_REQUEST['Xmlhttpsection'])))
                                 {
                              $class_id=$_REQUEST['Xmlhtppclass'];    
                              $section_id=$_REQUEST['Xmlhttpsection'];
                              
                              if(!empty($_REQUEST['Xmlhtppstudentid']))
                              {
                               $get_student_id=$_REQUEST['Xmlhtppstudentid'];      
                              }else
                              {
                               $get_student_id="";   
                              }
                              
                   $student_dbs=mysql_query("SELECT *,T1.id as db_id,T1.encrypt_id as t1_encrypt_id FROM student_db as T1"
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
                 . " $db_t1_main_details T1.course_id='$class_id' and T1.section_id='$section_id' and T1.is_delete='none'");
         $row=0;
         $fetch_student_num_rows=mysql_num_rows($student_dbs);
         while ($fetch_student_datas=mysql_fetch_array($student_dbs))
         {
$row++;  
$db_id=$fetch_student_datas['db_id'];    
$student_unqiue_id=$fetch_student_datas['student_id']; 
    $student_gender=ucfirst($fetch_student_datas['student_gender']);
$course_name=$fetch_student_datas['course_name'];             
$section_name=$fetch_student_datas['section_name'];
$student_full_name=$fetch_student_datas['student_full_name'];
$student_father_name=$fetch_student_datas['father_name'];
$student_father_mobile_no=$fetch_student_datas['father_mobile_no'];
   
    if($student_gender=="Male")
    {
       $relation="S/O";
    }else
    {
   $relation="D/O";     
    }
  if($get_student_id==$student_unqiue_id)
  {
      echo "<option value='$student_unqiue_id' selected> $course_name - $section_name / $student_full_name $relation $student_father_name / Mo. $student_father_mobile_no  </option>";
  }else
  {
    echo "<option value='$student_unqiue_id'> $course_name - $section_name / $student_full_name $relation $student_father_name / Mo. $student_father_mobile_no  </option>";
     
  }
    }
                                 }
                                     ?>
                                    </select>
                                    </div>
                                </td>
                                  </tr>
                       <tr>
                           <td style=" height:8px; "></td>
                       </tr>
                       <tr>
                           <td colspan="16">
                               <input type='button' class='add_button_reset_button' onclick="search_button()" value='Filter'>
                               <input type='button' onclick="reset_button()" class='add_button_reset_button' style="background-color:deeppink;" value='Reset'></td>
                       </tr>
                       
                   </table>    
               </div>
                    
               
                  <div id="main_attendance_work_div">
                  <div class="student_record_div">
                  
              <?php 
                if((!empty($_REQUEST['Xmlhtppclass']))&&(!empty($_REQUEST['Xmlhttpsection']))
                        &&(!empty($_REQUEST['Xmlfromd']))&&(!empty($_REQUEST['Xmltod'])))
                {
                
                   $get_course_id=$_REQUEST['Xmlhtppclass'];
                   $get_section_id=$_REQUEST['Xmlhttpsection'];
                   $get_from_date=$_REQUEST['Xmlfromd'];
                   $get_to_date=$_REQUEST['Xmltod'];
                   $get_student_id=$_REQUEST['Xmlhtppstudentid']; 
                   $get_reault_by=$_REQUEST['Xmlhtppresultoption'];
                   $get_result_value=$_REQUEST['Xmlhtppresultvalue'];
                   
                   
                   
                   
                   if(!empty($get_student_id))
                   {
                      $student_search="and T1.student_id='$get_student_id' ";  
                   }else
                   {
                    $student_search="";   
                   }
                   
                  $student_db=mysql_query("SELECT *,T1.encrypt_id as ad_id FROM student_db as T1"
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
                 . " $db_t1_main_details T1.course_id='$get_course_id' and T1.section_id='$get_section_id'"
                 . " $student_search and T1.is_delete='none' ORDER BY T1.roll_no ASC");
         
                $fetch_student_record_num_rows=mysql_num_rows($student_db);
                
                if($fetch_student_record_num_rows!=0)
                { 
                {
                ?>     
                      
                       <?php
                         $class_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details course_id='$get_course_id' and is_delete='none'");
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
                               
                                $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details section_id='$get_section_id' and is_delete='none'");
                         
                                $fetch_section_data=mysql_fetch_array($section_db);
                                $fetch_section_num_rows=mysql_num_rows($section_db);
                                if((!empty($fetch_section_data))&&($fetch_section_data!=null)&&($fetch_section_num_rows!=0))
                               {
                                $fetch_section_name=$fetch_section_data['section_name'];
                               
                               }else
                               {
                               $fetch_section_name="";    
                               }
                               
$total_work_day=mysql_query("SELECT * FROM attendance_total_day_db WHERE $db_main_details "
        . " class_id='$get_course_id' and section_id='$get_section_id' and attendance_date BETWEEN '$get_from_date' and '$get_to_date' and is_delete='none'");
$total_working_days=mysql_num_rows($total_work_day);         
                               
                       ?>
                     
                  
                      <div class="first_table_button_div" style=" margin-top:10px; ">
                          
                          
                          <a href=""><div class="attendance_button_style" onclick="PrintDiv('Student Attendance Report')" style=" margin-right:0px; "><b>Print</b></div></a>
                          <a href=""><div class="attendance_button_style" style=" background-color:maroon;display:none;  ">Pdf</div></a>
                          <a href=""><div class="attendance_button_style" style=" background-color:green;display:none; ">Excel</div></a>
                          <a href="attendance_register.php"><div class="attendance_button_style" style=" background-color:orange; "><b>Attendance Register</b></div></a>
                          <a href="modify_attedance.php"><div class="attendance_button_style" style=" background-color:red; "><b>Modify Attendance</b></div></a>
                     
                      
                      
                      
                      </div>  
                      <div id="table_print_div">
                 <table cellspacing="0" cellpadding="0" class="table_list" id="attendance_tabel" 
                        style=" float:left;  width:100%; margin-top:10px;  ">
                     
                     <tr class="zero_tr_td">
                         <td colspan="14">
                           <div class="first_table_button_div">
                          <table cellspacing="0" cellpadding="0" style=" width:auto; background-color: whitesmoke;
                                padding-left:2%; padding-right:2%; border-radius:4px;   margin:0 auto; margin-bottom:10px;  height:50px;   ">
                              <tr>
                                  <td><b>Class/Course</b></td>
                                  <td><b>:</b></td>
                                  <td><?php echo $fetch_class_name;?></td>
                                  <td style=" width:50px; "></td>
                                  <td><b>Section</b></td>
                                  <td><b>:</b></td>
                                  <td><?php echo $fetch_section_name;?></td>
                                   <td style=" width:50px; "></td>
                                  <td><b>Date Form</b></td>
                                  <td><b>:</b></td>
                                  <td><?php echo $get_from_date;?></td>
                                   <td style=" width:50px; "></td>
                                  
                                  <td><b>Date To</b></td>
                                  <td><b>:</b></td>
                                  <td><?php echo $get_to_date;?></td>
                                   <td style=" width:50px; "></td>
                                  
                                  <td><b>Total Attendance</b></td>
                                  <td><b>:</b></td>
                                  <td><?php echo $total_working_days;?></td>
                                  
                                  
                              </tr>
                          </table>   
                      </div>   
                             
                         </td>
                     </tr>
                           <tr>
                                 <td class="tr_heading_style">Roll No</td>
                                 <td class="tr_heading_style">Admission No.</td>
                                 <td class="tr_heading_style">Class - Section</td>
                                 <td class="tr_heading_style"><div>Student Name</div></td>
                                 <td class="tr_heading_style">Father Name</td>
                                  
                                 <td class="tr_heading_style">
                                     <center>
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td>Present</td>
                                         </tr>
                                     </table></center>
                                      </td>
                                      <td class="tr_heading_style">
                                       <center>
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td>Absent</td>
                                         </tr>
                                     </table></center>   
                                      </td>
                                      <td class="tr_heading_style">
                                       <center>
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td>Leave</td>
                                         </tr>
                                     </table></center>    
                                      </td>
                                      <td class="tr_heading_style">
                                       <center>
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td>Late</td>
                                         </tr>
                                     </table></center>    
                                      </td>
                                      <td class="tr_heading_style" id="td_border">Aggregate (%)</td>
                                      <td class="tr_heading_style" id="td_hidden" style=" border-right:1px solid gray; ">Action</td>
                             </tr>
                             
                <?php                 
while ($fetch_student_data=mysql_fetch_array($student_db))
{   
$fetch_student_id=$fetch_student_data['student_id'];  
$roll_no=$fetch_student_data['roll_no'];
$admission_no=$fetch_student_data['admission_no'];       
$fetch_student_name=ucfirst($fetch_student_data['student_full_name']); 
$fetch_student_father_name=$fetch_student_data['father_name'];
$course_name=$fetch_student_data['course_name'];
$section_name=$fetch_student_data['section_name'];        



$student_prsent_att=0;
$student_absent_att=0;
$student_leave_att=0;
$student_late_att=0;
$mark_attenandance_type=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details attendance_date BETWEEN '$get_from_date' and '$get_to_date'"
        . " and class_id='$get_course_id' and section_id='$get_section_id' and student_id='$fetch_student_id' "
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


$total_prsent_attendance=($student_prsent_att+$leave_attendance_calculate);
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

                   if($get_reault_by=="greater_than")
                   {
                   $ad=($attendance_aggrigate>=$get_result_value)&&($get_reault_by=="greater_than"); 
                   }else
                   if($get_reault_by=="less_than")
                   {
                   $ad=($attendance_aggrigate>=$get_result_value)&&($get_reault_by=="less_than");      
                   }else
                   {
                   $ad=($attendance_aggrigate>=0); 
                   }
              
if($ad)
{
echo "<tr>"
        . "<td class='td_data_style'><center>$roll_no</center></td>"
        . "<td class='td_data_style'><center>$admission_no</center></td>"
        . "<td class='td_data_style'><center>$course_name - $section_name</center></td>"
        . "<td class='td_data_style'>$fetch_student_name</td>"
        . "<td class='td_data_style'>$fetch_student_father_name</td>"
        . "<td class='td_data_style'><center>$student_prsent_att</center></td>"
        . "<td class='td_data_style'><center>$student_absent_att</center></td>"
        . "<td class='td_data_style'><center>$student_leave_att</center></td>"
        . "<td class='td_data_style'><center>$student_late_att</center></td>"
        . "<td class='td_data_style' id='td_border'><center>$attendance_aggrigate%</center></td>"
        . "<td class='td_data_style' id='td_hidden' style='border-right:1px solid black; width:195px;'>"
        . "<div class='att_view_button' class='hidden_td'>Month Report</div></td>"
        . "</tr>";   
    
}  
}
                  
                  ?>           
                             
                             
                             
                             
                             
                 </table>
                      </div>
                   <?php 
                }
                }
                }
                     ?> 
                      
                      
                  </div>
                  </div>
                    
                    
                    
               
              
               
                
               
                 <link rel="stylesheet" href="../javascript/combosearch/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
    #parent_id_chosen{ width:400px; }
    #hostel_id_chosen{ width:330px; }
    #hostel_room_id_chosen{ width:330px; }
    #student_id_chosen { width:430px; }
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