<?php
//SESSION CONFIGURATION
$check_array_in="transport";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
$message_show="";
if(isset($_POST['submit_button_save']))
{
         $student_id=$_POST['student_id'];
         $route=$_POST['transport_route_id'];
         $sub_route=$_POST['sub_route'];
         $vehicle_type=$_POST['transport_vehicle_type_id'];
         $vehicle=$_POST['transport_vehicle_reg_no'];
         $joining_date=$_POST['transport_joining_date'];
         $description=$_POST['transport_description'];
         $insert_session_id=$_POST['use_inset_session_id'];
                
$st_transport_result=mysql_query("SHOW TABLE STATUS LIKE 'student_allot_transport'");
$st_transport_row=mysql_fetch_array($st_transport_result);
$st_transport_nextId=$st_transport_row['Auto_increment']; 
$st_transport_final_db_id="TRSPORT_ID_$st_transport_nextId"; 
$st_transport_encrypt_id=md5(md5($st_transport_final_db_id));
         
         if((!empty($student_id))&&(!empty($route))&&(!empty($sub_route))&&(!empty($vehicle_type))
                 &&(!empty($vehicle))&&(!empty($joining_date))&&(!empty($st_transport_final_db_id)))
         {
       
         $select_check_db=mysql_query("SELECT * FROM student_db as T1 "
                 . "INNER JOIN student_allot_transport as T2 ON T1.transport_id=T2.transport_unique_id"
                 . " WHERE $db_t1_main_details  T1.student_id='$student_id' and T2.is_delete='none'");    
         $select_data=mysql_fetch_array($select_check_db);
         $select_num_data=mysql_num_rows($select_check_db);
         if((empty($select_data))&&($select_data==null)&&($select_num_data==0))
         {
         $insert_db=mysql_query("INSERT into student_allot_transport values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
                 . ",'$st_transport_final_db_id','$st_transport_encrypt_id','$joining_date','','$route'"
                 . ",'$sub_route','$vehicle_type','$vehicle','$description','none','$date','$date_time')"); 
         if((!empty($insert_db))&&($insert_db))
         {
          
        $update_student_db=mysql_query("UPDATE student_db SET transport_id='$st_transport_final_db_id' "
                . "WHERE $db_main_details student_id='$student_id' and is_delete='none'");    
        if((!empty($update_student_db))&&($update_student_db))
        {
          $message_show="Transport service allotment successfully complete";     
        }else
        {
         $delete_db=  mysql_query("DELETE FROM student_allot_transport WHERE transport_unique_id='$st_transport_final_db_id' and is_delete='none'");   
        $message_show="Sorry, Request failed , Please try again.";  
         }
             
         }else
         {
          $message_show="Sorry, Request failed , Please try again.";     
         }
             
         }else
         {
         $message_show="Transport service already allotment";    
         }
             
             
         }else
         {
         $message_show="Please fill all fields";
         return false;
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
        <script type="text/javascript" src="javascript/transport_js.js"></script>
         <script type="text/javascript">
         function search_button()
         {
         var class_id=document.getElementById("class_course_id").value;
         var section_id=document.getElementById("section_name").value;
         var student_id=document.getElementById("student_id").value;
         
         if(student_id==0)
         {
         alert("Please select student");
         return false;
         }else
         {
         document.getElementById("ajax_loader_show").style.display="block";    
         window.location.assign("student_allocate_transport.php?Xmlhtppclass="+class_id+"&Xmlhttpsection="+section_id+"&Xmlhtppstudentid="+student_id+"");
         }
         
         
         }
         
         function validate_form()
         {
          if(document.getElementById("student_id"))
          {
         var student_id=document.getElementById("student_id").value; 
         var route=document.getElementById("route_id").value;
         var sub_route=document.getElementById("sub_route").value;
         var vehicle_type=document.getElementById("vehicle_type_id").value;
         var vehicle=document.getElementById("vehicle_reg_no").value;
         var joining_date=document.getElementById("transport_joining_date").value;
         if(student_id==0)
         {
            alert("Please select student");
            return false;
         }else
             if(route==0)
         {
            alert("Please select route");
            return false;
         }else
             if(sub_route==0)
         {
            alert("Please select sub route");
            document.getElementById("sub_route").focus();
            return false;
         }else
             if(vehicle_type==0)
         {
            alert("Please select vehicle type");
            document.getElementById("vehicle_type_id").focus();
            return false;
         }else
             if(vehicle==0)
         {
            alert("Please select vehicle");
            document.getElementById("vehicle_reg_no").focus();
            return false;
         }else
             if(joining_date==0)
         {
            alert("Please enter joining date");
            document.getElementById("transport_joining_date").focus();
            return false;
         }else
         {
var r=confirm("Are you sure you want to Allot Transport Service");
if (r==true)
  { 
         document.getElementById("ajax_loader_show").style.display="block";    
       
  }else
  {
     return false; 
  }
        
         }
             
          }else
          {
             alert("Please first select student");
             return false;
          }
         }
         function cancel_button_this()
         {
          window.location.assign("student_allocate_transport.php");  
         }
         
         </script>
    </head>
    <body>
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>"> 
        
        <form action="student_allocate_transport.php" name="myForm" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
        
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="transport_dashboard.php">Transport</a></td>
                           <td>/</td>
                           <td>Student Allot Transport Service</td>
                       </tr>
                   </table>   
               </div>
                <div id='fetch_record' style=" display:none; "></div>
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
        <input type="hidden" id="organization_id" value="<?php  echo $fetch_school_id;?>">
               <input type="hidden" id="brnach_id" value="<?php  echo $fetch_branch_id;?>">              
               
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Student Allot Transport Service</b></div>
                    <a href="student_allocate_list.php">
                        <div class="view_button">List of Transport Allotment </div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   <div style=" width:100%; height:auto; border-bottom:1px solid blue;
                        float:left;margin-top:20px; padding-bottom:10px;    ">
                       <table style=" width:100%; margin:auto;  ">
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
                                  if(empty($_REQUEST['Xmlhtppclass']))
                                  {
                                      echo "<option value='0'>---Select---</option>";   
                                  }else
                                  {
                                echo "<option value='0'>---Select---</option>";             
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
    echo "<option value='0'>---Select---</option>";      
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
                              
                              $search_result="T1.course_id='$class_id' and T1.section_id='$section_id' and";
                              
                                 }else {
                                $search_result="";     
                                 }
                              
                              
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
                 . " LEFT JOIN parent_db as T6 ON T1.parent_id=T6.parent_unique_id"
                 . " LEFT JOIN student_personal_db as T7 ON T1.student_personal_id=T7.student_unqiue_id"
                 . " LEFT JOIN student_allot_transport as T10 ON T1.transport_id=T10.transport_unique_id WHERE "
                 . " $db_t1_main_details $search_result T1.is_delete='none' and T10.is_delete is null"
                           . " OR $db_t1_main_details $search_result T1.is_delete='none' and T10.is_delete='yes'");
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
      echo "<option value='$student_unqiue_id' selected>  $student_full_name $relation $student_father_name / Mo. $student_father_mobile_no / $course_name - $section_name  </option>";
  }else
  {
    echo "<option value='$student_unqiue_id'> $student_full_name $relation $student_father_name / Mo. $student_father_mobile_no / $course_name - $section_name  </option>";
     
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
                               <input type='button' class='add_button_reset_button' onclick="search_button()" value='Continue'>
                               <input type='button' onclick="reset_button()" class='add_button_reset_button' style="background-color:deeppink;" value='Reset'></td>
                       </tr>
                       
                   </table>  
                   </div>
                  
                   
                   <div class="get_student_data">
                      
                        <?php
               if(!empty($_REQUEST['Xmlhtppstudentid']))
                {
               $student_unique_id=$_REQUEST['Xmlhtppstudentid'];    
                   
     $student_db=mysql_query("SELECT *,T1.id as db_id,T1.encrypt_id as encrpt_id,T1.user_name as student_user_name"
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
                 . " $db_t1_main_details T1.student_id='$student_unique_id' and T1.is_delete='none' and T10.is_delete is null "
             . " OR $db_t1_main_details T1.student_id='$student_unique_id' and T1.is_delete='none' and T10.is_delete='yes'");
         
   
     $fetch_student_data=mysql_fetch_array($student_db);
     $fetch_student_num_row=mysql_num_rows($student_db);
if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_row!=0))
 {

   $fetch_student_sr_no=$fetch_student_data['sr_no'];
    $fetch_student_admission_no=$fetch_student_data['admission_no'];
    $student_unique_id=$fetch_student_data['student_id'];
     $fetch_student_roll_no=$fetch_student_data['roll_no'];
    $student_encrypt_id=$fetch_student_data['encrpt_id'];
     $course_name=$fetch_student_data['course_name'];
  $section_name=$fetch_student_data['section_name'];
  $session_name=$fetch_student_data['session_name'];   
 $category_name=$fetch_student_data['category_name'];
     
     
     $fetch_student_full_name=ucwords($fetch_student_data['student_full_name']);
     $fetch_student_gender=ucfirst($fetch_student_data['student_gender']);
     $fetch_student_dob=$fetch_student_data['student_dob'];
     $fetch_student_father_name=$fetch_student_data['father_name'];
     $fetch_student_father_mobile_no=$fetch_student_data['father_mobile_no'];
     $fetch_student_mother_name=$fetch_student_data['mother_name'];
     $fetch_student_mother_no=$fetch_student_data['mother_mobile_no'];
     $student_photo=$fetch_student_data['student_photo'];
     if(!empty($student_photo))
     {
       if(!is_file("../$student_photo"))
       {
        $student_photo="../images/no_avilable_image.gif";   
       }else
       {
        $student_photo="../$student_photo";   
       }
     }else
     {
      $student_photo="../images/no_avilable_image.gif";      
     }
     {
    ?>
     
    <input type="hidden" id="student_id" name="student_id" value="<?php echo $student_unique_id;?>"> 
                   <div class="left_div">
                       <div class="details_title">Student Details</div>
                       <table cellspacing="0" cellpadding="0" class="student_details">
                           <tr>
                               <td><b>Sr. No.</b></td><td><b>:</b></td><td><?php echo $fetch_student_sr_no;?></td>
                               <td><b>Roll No.</b></td><td><b>:</b></td><td><?php echo $fetch_student_roll_no;?></td>
                               <td rowspan="5" colspan="3"><img class="student_image_show" 
                                                                src="<?php echo $student_photo;?>"></td>
                           </tr> 
                           <tr>
                               <td><b>Admission No.</b></td><td><b>:</b></td><td colspan="4"><?php echo $fetch_student_admission_no;?></td>
                               </tr> 
                           <tr>
                               <td><b>Student Name</b></td><td><b>:</b></td>
                               <td colspan="3"><?php echo $fetch_student_full_name;?></td>
                           </tr>
                            <tr>
                               <td><b>Gender</b></td><td><b>:</b></td>
                               <td colspan="4"><?php echo $fetch_student_gender;?></td>
                           </tr>
                            <tr>
                               <td><b>Date Of Birth</b></td><td><b>:</b></td>
                               <td><?php echo $fetch_student_dob;?></td>
                               <td><b>Category</b></td><td><b>:</b></td>
                               <td colspan="4"><?php echo $category_name;?></td>
                           </tr>
                           
                             <tr>
                               <td><b>Father Name</b></td><td><b>:</b></td>
                               <td><?php echo $fetch_student_father_name;?></td>
                               <td><b>Mobile No.</b></td><td><b>:</b></td>
                               <td colspan="3"><?php echo $fetch_student_father_mobile_no;?></td>
                           </tr>
                            <tr>
                               <td><b>Mother Name</b></td><td><b>:</b></td>
                               <td><?php echo $fetch_student_mother_name;?></td>
                               <td><b>Mobile No.</b></td><td><b>:</b></td>
                               <td colspan="4">9899176775</td>
                           </tr>
                       <tr>
                           <td><b>Class/Course</b></td><td><b>:</b></td><td><?php echo $course_name;?></td>
                           <td ><b>Section</b></td><td><b>:</b></td><td colspan="3"><?php echo $section_name;?></td>
                          
                       </tr>
                       <tr>
                           <td><b>Session</b></td><td><b>:</b></td><td><?php echo $session_name;?></td>
                       </tr>
                       <tr>
                           <td style=" background-color: white;" colspan="8">
                               <a href="#" onclick="window.open('../search/student_full_details.php?token_id=<?php echo $student_encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                    <input type="button" class="view_button" style=" border:0; " value="View Full Details"></a>
                                 
                           </td>
                       </tr>
                       </table>  
                   </div>
                   
                   <div class="vertical_line"></div>
                   
                   <div class="right_div" style=" width:60%; float:right;  ">
                   <div class="details_title">Allot Transport Service</div>   
                   
                    <table cellspacing="0" cellpadding="0" class="student_details_table">
                   <tr>
                       <td colspan="6"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                   </tr>
                 
                   <tr>
                       <td><b>Route </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td colspan="5">
                           <style>
                             #route_id_chosen{ width:450px; } 
                             .active-result { font-size:12px; }
                                            </style>
                           <div id="room_div">
                           <select id="route_id" onchange="change_route_id(this.value)" name="transport_route_id"
                                   tabindex="-1" data-placeholder="Select Route" class="chosen-select"  
                                   style=" width:100%; ">
                               <option value="0"></option>   
                             <?php 
                               $route_db=mysql_query("SELECT * FROM transport_route_db WHERE $db_main_details is_delete='none'");
                               while ($fetch_route_data=mysql_fetch_array($route_db))
                               {
                                $fetch_route_id=$fetch_route_data['route_id'];
                                $fetch_route_name=$fetch_route_data['route_name'];
                                $fetch_route_code=$fetch_route_data['route_code'];
                                $sub_route=$fetch_route_data['sub_route_name'];
                                if(!empty($fetch_route_code))
                                {
                                $fetch_route_code=" { Route Code : $fetch_route_code }  { Sub Route : $sub_route }";    
                                }
                                echo "<option value='$fetch_route_id'>$fetch_route_name $fetch_route_code</option>";
                                
                               }
                               
                               ?>
                               
                           </select>
                           </div>
                       </td>
                       
                     
                   </tr>
                   <tr>
                      <td><b>Sub Route </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td colspan="5">
                           <select name="sub_route"
                                   id="sub_route" class="select_box_style"  style=" width:450px; ">
                               <option value="0">-- Select Sub Route --</option>   
                              
                               
                           </select>
                       </td>
                          
                   </tr>
   
                    <tr>
                          <td><b>Vehicle Type </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select name="transport_vehicle_type_id" onchange="change_vehicle_type_id(this.value)"
                                   id="vehicle_type_id" class="select_box_style"  style=" width:190px; ">
                               <option value="0">-- Select vehicle type --</option>   
                              
                               
                           </select>
                       </td>
                        
                       <td><b>Vehicle</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select name="transport_vehicle_reg_no" id="vehicle_reg_no" class="select_box_style"
                                    style=" width:190px; ">
                               <option value="0">---Select vehicle---</option>   
                               
                           </select>
                       </td>
                   </tr>
                     <tr>
                         <td><b>Joining Date</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" readonly="readonly" name="transport_joining_date" id="transport_joining_date"
                                  class="text_box_styling" value="<?php echo $date;?>" style=" background-color:whitesmoke;  width:180px; " placeholder="Enter Joining date"></td>
                       
                     </tr>
                     <tr>
                         <td><b>Description</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td colspan="5">
                           <textarea id="transport_description" name="transport_description" class="text_area_class"
                                     style=" width:94%; height:40px; "></textarea>
                       </td>    
                     </tr>
                   
                   <tr>
                       <td colspan="7" style=" height:0px; ">
                           <div class="verticle_line"></div>   
                       </td>
                   </tr>
                   
                   <tr>
                       <td colspan="6">
                           <input type="submit" name="submit_button_save" class="continue_button_styling" style=" text-align: center;" value="Allotment">
                           <input type="button"  onclick="cancel_button_this()" class="continue_button_styling" 
                                    style=" margin-right:10px; background-color: red; border:0; margin-right:20px;   " value="Cancel">
                         
                       
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
            <script type="text/javascript" src="../javascript/admission_javascript.js"></script>
      
             <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
         
         <script type="text/javascript">
      
$(function() {
   
      $("#transport_joining_date").datepicker({ 
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