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
        <title>Attendance Register </title>
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
        
    
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="attendance_dashboard.php">Attendance</a></td>
                           <td>/</td>
                          <td>View Attendance Register</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Attendance Register</b></div>
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
                               <td><input class="date_text_box" readonly="readonly" id="from_date" value="<?php  if(!empty($_REQUEST['Xmlfromd'])){ echo $_REQUEST['Xmlfromd'];}else { }?>" placeholder="Enter date from" type="text"></td>
                                <td style=" width:40px; "></td>
                                <td>
                                   <b>To <sup>*</sup></b>    
                               </td>
                               <td><b>:</b></td>
                               <td><input class="date_text_box" readonly="readonly" id="to_date" value="<?php  if(!empty($_REQUEST['Xmltod'])){ echo $_REQUEST['Xmltod'];}else { }?>" placeholder="Enter date to" type="text"></td>
                               <td style=" width:70px; "></td>
                               <td style=" display:none; ">
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
                               <td style=" display:none; "><b>:</b></td>
                               
                               <?php
                               if(!empty($_REQUEST['Xmlhtppresultvalue']))
                               {
                                $result_value=$_REQUEST['Xmlhtppresultvalue'];   
                               }else
                               {
                                  $result_value=0; 
                               }
                               ?>
                               <td style=" display:none; "><input type="text" id="result_value" class="text_box_border_style" value="<?php echo $result_value;?>"></td>
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
                               <input type='button' class='add_button_reset_button' onclick="register_search_button()" value='Filter'>
                               <input type='button' onclick="reset_button()" class='add_button_reset_button' style="background-color:deeppink;" value='Reset'></td>
                       </tr>
                       
                   </table> 
               </div>
                    
               
                  <div id="main_attendance_work_div">
                  <div class="student_record_div">
                  
              <?php 
                if((!empty($_REQUEST['Xmlhtppclass']))&&(!empty($_REQUEST['Xmlhttpsection']))
                        &&(!empty($_REQUEST['Xmlfromd']))&&(!empty($_REQUEST['Xmltod']))&&(!empty($_REQUEST['Xmlhtppstudentid'])))
                {
                
                   $get_course_id=$_REQUEST['Xmlhtppclass'];
                   $get_section_id=$_REQUEST['Xmlhttpsection'];
                   $get_from_date=$_REQUEST['Xmlfromd'];
                   $get_to_date=$_REQUEST['Xmltod'];
                   $student_id=$_REQUEST['Xmlhtppstudentid'];
                    
                  $student_db=mysql_query("SELECT *,T1.id as db_id,T1.encrypt_id as t1_encrpt_id,T1.user_name as student_user_name"
                 . ",T1.temp_password as student_password,T6.user_name as parent_user_name"
                 . ",T6.temp_password as parent_password FROM student_db as T1"
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
                          . " and T1.student_id='$student_id' and T1.is_delete='none' ORDER BY T1.roll_no ASC");
         
                $fetch_student_record_num_rows=mysql_num_rows($student_db);
                $fetch_student_data=mysql_fetch_array($student_db);
                if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_record_num_rows!=0))
                {
                $student_id=$fetch_student_data['student_id'];
                $class_id=$fetch_student_data['course_id'];
                $section_id=$fetch_student_data['section_id'];        
                    
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
                       <a href=""><div class="attendance_button_style" onclick="PrintDiv('Student Attendance Register')" style=" margin-right:0px; "><b>Print</b></div></a>
                          <a href=""><div class="attendance_button_style" style=" background-color:maroon;display:none;  ">Pdf</div></a>
                          <a href=""><div class="attendance_button_style" style=" background-color:green;display:none; ">Excel</div></a>
                         <a href=""><div class="attendance_button_style" style=" background-color:red; display:none; "><b>Modify Attendance</b></div></a>
                     </div>  
                      
                      
                      <div id="table_print_div">
                 <table cellspacing="0" cellpadding="0" class="table_list" id="attendance_tabel" 
                        style=" float:left;  width:100%; margin-top:10px;  ">
                     
                     <tr>
                         <td colspan="14">
                           <div class="first_table_button_div" id="td_hidden">
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
                      </div><br/>
                      
                      <?php
                            $student_db_id=$fetch_student_data['db_id'];
         $student_encrypt_id=$fetch_student_data['t1_encrpt_id'];       
$db_id=$fetch_student_data['db_id'];    
$student_unqiue_id=$fetch_student_data['student_id'];

$form_sr_no=$fetch_student_data['sr_no'];
$admission_no=$fetch_student_data['admission_no'];
$student_roll_no=$fetch_student_data['roll_no'];       
$student_admission_date=$fetch_student_data['admission_date'];  
$enrollment_no=$fetch_student_data['enrollment_no'];  
$course_name=$fetch_student_data['course_name'];             
$section_name=$fetch_student_data['section_name'];
$session_name=$fetch_student_data['session_name'];
$category_name=$fetch_student_data['category_name'];
$house_name=ucwords($fetch_student_data['house_name']);
 
    $student_full_name=$fetch_student_data['student_full_name'];
    $student_gender=ucfirst($fetch_student_data['student_gender']);
    $student_dob=$fetch_student_data['student_dob'];
    $student_blood_group=$fetch_student_data['student_blood_group'];
    $student_birth_place=$fetch_student_data['student_birth_place'];
    $student_nationality=$fetch_student_data['student_nationality'];
    $student_religion=$fetch_student_data['student_religion'];
    $student_mother_tongue=$fetch_student_data['mother_tongue'];
    $student_category=$fetch_student_data['category_id'];
    $student_sub_category=$fetch_student_data['sub_category'];
    $student_mobile=$fetch_student_data['student_mobile_no'];
    $student_email=$fetch_student_data['student_email_id'];
    $sub_status=ucwords($fetch_student_data['sub_status']);
    $student_photo=$fetch_student_data['student_photo'];
    if(empty($student_photo))
    {
    $student_photo="images/no_avilable_image.gif";    
    }  else {
      $student_photo=$student_photo;    
       
    }
    
    $student_current_address=$fetch_student_data['current_address'];
    $student_father_name=$fetch_student_data['father_name'];
    $student_father_mobile_no=$fetch_student_data['father_mobile_no'];
    $student_mother_name=$fetch_student_data['mother_name'];
    $student_mother_mobile_no=$fetch_student_data['mother_mobile_no'];
    
    
                      ?>
                             
                             <div class="show_studnet_list">
                                 <table cellpadding="2" class="show_student_table">
                                     <tr>
                                         <td><b>Admission No.</b></td><td><b>:</b></td><td><?php echo $admission_no;?></td>
                                         <td><b>Enrollment No.</b></td><td><b>:</b></td><td><?php echo $enrollment_no;?></td>
                                         <td style=" width:130px; " rowspan="8">
                                             <img class="student_image_this" src="../<?php echo $student_photo;?>"><br/>
                                             <a href="#" onclick="window.open('../search/student_full_details.php?token_id=<?php echo $student_encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                    <div class="view_delete_buttons" style="background-color:dodgerblue; float:right; margin-top:10px;   width:55px;">View</div></a>
                                              </td>
                                     </tr>
                                      <tr>
                                          <td><b>Roll No.</b></td><td><b>:</b></td><td><?php echo $student_roll_no;?></td>
                                          <td><b>Sr. No.</b></td><td><b>:</b></td><td><?php echo $db_id;?></td>
                                     </tr>
                                     <tr>
                                         <td><b>Class</b></td><td><b>:</b></td><td><?php echo $course_name;?></td>
                                         <td><b>Section</b></td><td><b>:</b></td><td><?php echo $section_name;?></td>
                                     </tr>
                                     <tr>
                                         <td><b>House</b></td><td><b>:</b></td><td><?php echo $house_name;?></td>
                                         <td><b>Session</b></td><td><b>:</b></td><td><?php echo $session_name;?></td>
                                       
                                     </tr>
                                     <tr>
                                         <td><b>Student</b></td><td><b>:</b></td><td><?php echo $student_full_name;?></td>
                                         <td><b>Gender</b></td><td><b>:</b></td><td><?php echo $student_gender;?></td>
                                     </tr>
                                     <tr>
                                         <td><b>Date Of Birth</b></td><td><b>:</b></td><td><?php echo $student_dob;?></td>
                                         <td><b>Category</b></td><td><b>:</b></td><td><?php echo $category_name;?></td>
                                     </tr>
                                      <tr>
                                          <td><b>Father</b></td><td><b>:</b></td><td><?php echo $student_father_name;?></td>
                                          <td><b>Mobile</b></td><td><b>:</b></td><td><?php echo $student_father_mobile_no;?></td>
                                     </tr>
                                     <tr>
                                         <td><b>Mother</b></td><td><b>:</b></td><td><?php echo $student_mother_name;?></td>
                                         <td><b>Mobile</b></td><td><b>:</b></td><td><?php echo $student_mother_mobile_no;?></td>
                                     </tr>
                                 </table>  
                                 
                             </div>       
                             
                             
                             
                         </td>
                     </tr>
                     <tr>
                         <td colspan="10">
                             <?php
                             function attendance_report($db_main_details,$insert_attendance_date,$class_id,$section_id,$fetch_student_id)
                             {
                                 
         $mark_attendance_data_db=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_attendance_date' and class_id='$class_id' "
                 . "and section_id='$section_id' and student_id='$fetch_student_id' and is_delete='none'");
        $attandence_num_rows=mysql_num_rows($mark_attendance_data_db);           
        $attendance_data=mysql_fetch_array($mark_attendance_data_db); 
                 if((!empty($attendance_data))&&($attendance_data!=null)&&($attandence_num_rows!=0))
                 {
                 $fetch_attendance_status=$attendance_data['attendance'];
                   if($fetch_attendance_status=="p")
                   {
                   echo "<div class='attendance_status'>P</div>";   
                   }else
                      if($fetch_attendance_status=="a")
                   {
                   echo "<div class='attendance_status' style='background-color:red;'>A</div>";     
                   }else
                       if($fetch_attendance_status=="l")
                   {
                    echo "<div class='attendance_status' style='background-color:yellow;'>L</div>";    
                   }else
                       if($fetch_attendance_status=="lt")
                   {
                   echo "<div class='attendance_status' style='background-color:gray;'>LT</div>";    
                   }  else {
                       echo "";
                   }
                     
                 }else
                 {
                     return 0; 
                 }
                             }
                             ?>
                             
                             
                             
<div style=" width:100%; height:auto; float:left;   "> 
   <?php
   $start_date=strtotime($get_from_date);
   $end_date=strtotime($get_to_date);
   ?>
    
<?php
$start= new DateTime($get_from_date);
$start->modify('first day of this month');
$end= new DateTime($get_to_date);
$end->modify('first day of next month');
$interval=DateInterval::createFromDateString('1 month');
$period=new DatePeriod($start, $interval, $end);
$row=0;
foreach ($period as $dt) {
   $dt= $dt->format("Y-m");
    $calander_date=$dt."-01";


/* Set the default timezone */
date_default_timezone_set("Asia/Calcutta");

/* Set the date */
$date=strtotime(date($calander_date));

$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);
$firstDay = mktime(0,0,0,$month, 1, $year);
$title = strftime('%B', $firstDay);
$dayOfWeek = date('D', $firstDay);
$daysInMonth = cal_days_in_month(0, $month, $year);
/* Get the name of the week days */
$timestamp = strtotime('next Sunday');
$weekDays = array();
for ($i = 0; $i < 7; $i++) {
	$weekDays[] = strftime('%a', $timestamp);
	$timestamp = strtotime('+1 day', $timestamp);
}
$blank = date('w', strtotime("{$year}-{$month}-01"));
?>

                                 <table cellspacing="0" class='calander_table' style=" float:left; margin:17px;  ">
	<tr>
		<th colspan="7" class="text-center"> <?php echo $title ?> <?php echo $year ?> </th>
	</tr>
	<tr>
		<?php foreach($weekDays as $key => $weekDay) : ?>
            <td class="text-center"><b><?php echo $weekDay ?></b></td>
		<?php endforeach ?>
	</tr>
	<tr>
		<?php for($i = 0; $i < $blank; $i++): ?>
			<td></td>
		<?php endfor; ?>
		<?php for($i = 1; $i <= $daysInMonth; $i++): ?>
			<?php if($day == $i): ?>
                          <?php
                         $date_this=$year."-".$month."-".$i;
                           $temp_date=  strtotime($date_this);
                           $insert_attendance_date=$date_this;
                          if($start_date<=$temp_date && $end_date>=$temp_date)
                            {
                           ?>
                        <td valign="top" class="squire_td"><div class="date_print_name"><strong><?php echo $i ?></strong></div>
                          
                            <?php
        attendance_report($db_main_details, $insert_attendance_date, $class_id, $section_id,$student_id);
                           ?> 
                        </td>
                        <?php
                           }else
                           {
                        ?>
                        <td valign="top" class="squire_td" style=" opacity:0.2; filter: alpha(opacity=20); "><div class="date_print_name"><strong><?php echo $i ?></strong></div>
                        </td>
                        <?php
                           }
                        ?>
			<?php else: ?>
                        <?php
                         $date_this=$year."-".$month."-".$i;
                           $temp_date=strtotime($date_this);
                           $insert_attendance_date=$date_this;
                           if($start_date<=$temp_date && $end_date>=$temp_date)
                           {
                           ?>
                        <td valign="top" class="squire_td"><div class="date_print_name"><strong><?php echo $i ?></strong></div>
                          
                            <?php
        attendance_report($db_main_details, $insert_attendance_date, $class_id, $section_id,$student_id);
                           ?> 
                        </td>
                        <?php
                           }else
                           {
                        ?>
                        <td valign="top" class="squire_td" style=" opacity:0.2;filter: alpha(opacity=20); "><div class="date_print_name"><strong><?php echo $i ?></strong></div>
                        </td>
                        <?php
                           }
                        ?>
                        </td>
			<?php endif; ?>
			<?php if(($i + $blank) % 7 == 0): ?>
				</tr><tr>
			<?php endif; ?>
		<?php endfor; ?>
		<?php for($i = 0; ($i + $blank + $daysInMonth) % 7 != 0; $i++): ?>
			<td></td>
		<?php endfor; ?>
	</tr>
</table>
    <?php
    if($row==2)
    {
     $row=0;   
    ?>
    <div style=" width:100%; height:2px; float:left;   "></div>
    <?php
    }else
    {
     $row++;   
    }
    ?>
                          <?php
}
                          ?>
                             </div>
                         </td>    
                     </tr>
                             
                             
                 </table>
                        
                          
                      </div>
                   <?php 
                }
                }
                }
                     ?> 
                      
                      
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