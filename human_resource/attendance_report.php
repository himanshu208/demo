<?php
//SESSION CONFIGURATION
$check_array_in="hr";
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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Employee Attendance Report </title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
         <script type="text/javascript" src="../javascript/attendance_javascript.js"></script>
       
    </head>
    <body>
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
         <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>"> 
        
        
        
    
      <script type="text/javascript">
             
  //normal search
  function normal_search()
  {
 
   document.getElementById("normal_search_id").style.display="block";
   document.getElementById("advance_div").style.display="none";
  
  }
  
  //advance search
  function advance_search()
  {

   document.getElementById("advance_div").style.display="block";
   document.getElementById("normal_search_id").style.display="none";
  
   
  }
  
            </script>
            
            <script type="text/javascript">
              function employee_normal_search_record()
              {
              var all_employee=document.getElementById("all_employee").checked;    
              var department=document.getElementById("department_id").value;
              var designation=document.getElementById("designation_id").value;
              var from_date=document.getElementById("from_date").value;
              var to_date=document.getElementById("to_date").value;        
              var employee_id=document.getElementById("employee_id").value;
              var result_option=document.getElementById("result_this_by").value; 
              var result_value=document.getElementById("result_value").value; 
   
              
              if(all_employee!=true)
              {
                  
              if(department==0 && designation==0 && employee_id==0 || from_date==0 && to_date==0)
              {
                 alert("Please select atleast one option");
                 return false;
              }else
              {
                   document.getElementById("ajax_loader_show").style.display="block";    
                
              window.location.assign("attendance_report.php?all_employee=no&xml_department="+department+"&xml_designation="+designation+"&xml_employee="+employee_id+"&xmlfromdate="+from_date+"&xmltodate="+to_date+"&Xmlhtppresultoption="+result_option+"&Xmlhtppresultvalue="+result_value+""); 
              }    
              }else
              {
                   document.getElementById("ajax_loader_show").style.display="block";    
                
                window.location.assign("attendance_report.php?all_employee=yes&xml_department=&xml_designation=&xml_employee=&xmlfromdate="+from_date+"&xmltodate="+to_date+"&Xmlhtppresultoption="+result_option+"&Xmlhtppresultvalue="+result_value+""); 
                 
              }
             
              }
              function reset_button()
              {
                   document.getElementById("ajax_loader_show").style.display="block";    
                
                window.location.assign("attendance_report.php"); 
                  
              }
              
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
                           <td><a href="hr_dashboard.php">Human Resource</a></td>
                           <td>/</td>
                          <td>Employee Attendance Report</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Employee Attendance Report</b></div>
              <a href="mark_attendance.php"> <div class="view_button">Add Mark Attendance</div> </a> 
                   </div>
                
               
              
               <?php 
               if((!empty($_REQUEST['xml_serch_type'])))
               {
                $search_type=$_REQUEST['xml_serch_type'];
                if($search_type=="normal")
                {
                 $normal_check="checked";
                 $advance_check="";
                 
                 echo "<style>
                     #normal_search_id { display:block; }
                     #advance_div {display:none; }
                    </style>"; 
                }else
                 if($search_type=="advance")
                {
                 $normal_check="";
                 $advance_check="checked";    
                    echo "<style>
                     #normal_search_id { display:none; }
                     #advance_div {display:block; }
                    </style>"; 
                }
               }else
               {
                $normal_check="checked";
                $advance_check="";   
               }
               ?>
                <style>
            .search{
                width:320px; height:25px; border:1px solid silver; padding-left:4px; padding-right:4px; 
            }   
            #advance_div { display:none; }
        </style>
        <div id="search_first_div" style=" margin-top:15px; ">
               
          
            
            <table class="date_table">
                <tr>
                    <td><div class="by_date"><b>By Date</b></div></td>
                    <td style=" width:30px; "></td>
                    <td><b>From</b></td><td><b>:</b></td>
                    <td><input class="date_text_box" id="from_date" value="<?php echo $date;?>" readonly="readonly" type="text"></td>
                    <td style=" width:40px; "></td>
                    <td><b>To</b></td><td><b>:</b></td>
                    <td><input class="date_text_box" id="to_date" value="<?php echo $date;?>" readonly="readonly" type="text"></td>
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
            
                   <input type="hidden" id="admission_no" value="">
                   <script>
               function all_employee_select()
               {
              var all_employee_check=document.getElementById("all_employee").checked;    
              if(all_employee_check==true)
              {
             document.getElementById("zero_1").selected=true;
             document.getElementById("zero_2").selected=true;
             document.getElementById("zero_3").selected=true;
             document.getElementById("department_id").disabled=true;
             document.getElementById("designation_id").disabled=true;
             document.getElementById("employee_id").disabled=true;
              }else
              {
             document.getElementById("department_id").disabled=false;
             document.getElementById("designation_id").disabled=false; 
             document.getElementById("employee_id").disabled=false;
              }
              }
               </script>
                   <div id="normal_search_id" > 
                   <table class="search_table">
                       <tr>
                           <td>
                               <?php
                               if(!empty($_REQUEST['all_employee']))
                               {
                               $all_employee=$_REQUEST['all_employee'];
                               if($all_employee=="yes")
                                   {
                               $all_check="checked";
                               $disabled="disabled";
                                   }else
                                   {
                                   $all_check="";   
                                   $disabled="";
                                   }
                               }else
                               {
                              $all_check=""; 
                              $disabled="";
                               }
                               ?>
                               
                               <table>
                                   <tr>
                                       <td><input onclick="all_employee_select()" id="all_employee" value="yes" type="checkbox" <?php echo $all_check;?>></td><td><b>All Employee</b></td>
                                   </tr>
                               </table>   
                               
                           </td>
                           <td><b>Department </b></td>
                           <td><b>:</b></td>
                           <td>
                               <select onchange="department(this.value)" id="department_id" class="select_search_style" style=" width:170px; " <?php echo $disabled;?>>
     <option id="zero_1" value="0">-- Select --</option>
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
 </select>
                           
                           </td>
                       
                           <td><b>Designation</b></td>
                           <td><b>:</b></td>
                           <td><select onchange="designation(this.value)" id="designation_id" class="select_search_style" style=" width:170px; " <?php echo $disabled;?>>
                                   <option id="zero_2" value="0">-- Select --</option>
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
                          
                           <td><b>Employee</b></td>
                           <td><b>:</b></td>
                           <td>
                               <style>
                                #employee_id_chosen { width:320px; }  
                                .active-result{ font-size:12px; }
                               </style>
                               <?php
                                if(!empty($_REQUEST['xml_employee']))
                             {
                             $get_employee=$_REQUEST['xml_employee'];   
                             }else
                             {
                              $get_employee="";   
                             }  
                               ?>
                               <div id="employee_select">
                                   <select id="employee_id" onchange="" data-placeholder="---Select---" class="chosen-select" tabindex="-1">
                                       <option id="zero_3" value="0"></option>
                                   <?php 
                                     $employee_db=mysql_query("SELECT *,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                      . "LEFT JOIN hr_family_db as T3 ON T1.family_id=T3.family_unique_id "
                      . "LEFT JOIN hr_department_db as T4 ON T1.department_id=T4.department_id "
                      . "LEFT JOIN hr_designation_db as T5 ON T1.designation_id=T5.designation_id WHERE T1.is_delete='none'");
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
                if($get_employee==$employee_unique_id)
                {
                echo "<option value='$employee_unique_id' selected>$employee_no / $employee_name <B>$gender</B> $employee_father_name</option>";  
                }else
                {
                  echo "<option value='$employee_unique_id'>$employee_no / $employee_name <B>$gender</B> $employee_father_name</option>";  
                  
                }
                }
                                   ?>
                                   </select>   
                               </div>
                           </td>
                       
                       
                       </tr>
                       <tr>
                           <td colspan="10">
                                 <input type="button" onclick="employee_normal_search_record()" id="search_button" value="Search">
                        
                                 <input type="button" onclick="reset_button()" id="search_button" style=" background-color:darkorange; margin-right:10px;  " value="Reset">
                           </td>
                       </tr>
                   </table>
                   </div>
               </div>
                    
               
                  <div id="main_attendance_work_div">
                  <div class="student_record_div">
                  
              <?php 
                if((!empty($_REQUEST['all_employee']))&&(!empty($_REQUEST['xmlfromdate']))&&(!empty($_REQUEST['xmltodate'])))
                {
                
                   $all_employee=$_REQUEST['all_employee'];
                   $get_department_id=$_REQUEST['xml_department'];
                   $get_employee_id=$_REQUEST['xml_employee'];
                   $get_designation_id=$_REQUEST['xml_designation'];
                   $get_from_date=$_REQUEST['xmlfromdate'];
                   $get_to_date=$_REQUEST['xmltodate'];
                   $get_reault_by=$_REQUEST['Xmlhtppresultoption'];
                   $get_result_value=$_REQUEST['Xmlhtppresultvalue'];
                    
                   if($all_employee!="yes")
                   {
                   if((!empty($get_department_id))&&(!empty($get_designation_id))&&(!empty($get_employee_id)))
                   {
                   $search_result="T1.employee_id='$get_employee_id' and T1.department_id='$get_department_id' and T1.designation_id='$get_designation_id' and ";   
                       
                   }else
                     if((!empty($get_department_id))&&(!empty($get_designation_id)))
                   {
                    $search_result=" T1.department_id='$get_department_id' and T1.designation_id='$get_designation_id' and ";   
                      
                   }else
                     if((!empty($get_department_id))&&(!empty($get_employee_id)))
                   {
                    $search_result="T1.employee_id='$get_employee_id' and T1.department_id='$get_department_id' and ";   
                      
                   }else   
                      if((!empty($get_designation_id))&&(!empty($get_employee_id)))
                   {
                    $search_result="T1.employee_id='$get_employee_id' and T1.designation_id='$get_designation_id' and ";   
                      
                   }else
                   if((!empty($get_department_id)))
                   {
                     $search_result=" T1.department_id='$get_department_id' and ";   
                     
                   }else
                        if((!empty($get_designation_id)))
                   {
                   $search_result=" T1.designation_id='$get_designation_id' and ";   
                       
                   }else
                    if((!empty($get_employee_id)))
                   {
                    $search_result="T1.employee_id='$get_employee_id' and ";   
                      
                   }else
                   {
                    $search_result="";   
                      
                   }
                    }else
                   {
                    $search_result="";    
                   }
                   
                   
                    
               $employee_db=mysql_query("SELECT *,T1.id as db_id,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                      . "LEFT JOIN hr_family_db as T3 ON T1.family_id=T3.family_unique_id "
                      . "LEFT JOIN hr_department_db as T4 ON T1.department_id=T4.department_id "
                      . "LEFT JOIN hr_designation_db as T5 ON T1.designation_id=T5.designation_id "
                      . "LEFT JOIN hr_bank_db as T6 ON T1.bank_id=T6.bank_unique_id "
                      . "LEFT JOIN category_db as T8 ON T1.category_id=T8.category_id WHERE $search_result T1.is_delete='none'");
              $empoyee_num_rows=mysql_num_rows($employee_db);
             
                if($empoyee_num_rows!=0)
                { 
                    
$total_work_day=mysql_query("SELECT * FROM hr_attendance_total_day_db WHERE $db_main_details attendance_date BETWEEN '$get_from_date' and '$get_to_date' and is_delete='none'");
$total_working_days=mysql_num_rows($total_work_day);    
                    
                    
                {
                ?>  
                      
                       <div class="first_table_button_div" style=" margin-top:10px; ">
                         <a href=""><div class="attendance_button_style" onclick="PrintDiv('Student Attendance Report')" style=" margin-right:0px; "><b>Print</b></div></a>
                          <a href=""><div class="attendance_button_style" style=" background-color:maroon;display:none;  ">Pdf</div></a>
                          <a href=""><div class="attendance_button_style" style=" background-color:green;display:none; ">Excel</div></a>
                          <a href="modify_attedance.php"><div class="attendance_button_style" style=" background-color:red; "><b>Modify Attendance</b></div></a>
                      </div> 
                      
                      
                      <div class="first_table_button_div" style=" margin-top:10px; ">
                          <table style=" width:auto; background-color: whitesmoke;
                                padding-left:2%; padding-right:2%; border-radius:4px;   margin:0 auto; margin-bottom:10px;  height:50px;   ">
                              <tr>
                                  
                                  <td><b>Date Form</b></td>
                                  <td><b>:</b></td>
                                  <td>2015-07-09</td>
                                   <td style=" width:50px; "></td>
                                  
                                  <td><b>Date To</b></td>
                                  <td><b>:</b></td>
                                  <td>2015-07-09</td>
                                  <td style=" width:50px; "></td>
                                  
                                  
                                  <td><b>Total Working Days</b></td>
                                  <td><b>:</b></td>
                                  <td><?php echo $total_working_days;?></td>
                                </tr>
                          </table>   
                      </div>   
                 <table cellspacing="0" cellpadding="0" id="attendance_tabel" style=" width:100%; ">
                           <tr>
                                 <td class="tr_heading_style">Sl. No.</td>
                                 <td class="tr_heading_style">Employee No.</td>
                                  <td class="tr_heading_style">Department</td>
                                   <td class="tr_heading_style">Designation</td>
                                 <td class="tr_heading_style">Employee Name</td>
                                 <td class="tr_heading_style"><div>Mobile No</div></td>
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
                                      <td class="tr_heading_style">Aggregate (%)</td>
                                      <td class="tr_heading_style" style=" border-right:1px solid gray; ">Action</td>
                             </tr>
                             
                <?php 
 $row=0;                 
 while ($employee_data=mysql_fetch_array($employee_db))
              {
                $row++;
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
                

$student_prsent_att=0;
$student_absent_att=0;
$student_leave_att=0;
$student_late_att=0;
$mark_attenandance_type=mysql_query("SELECT * FROM hr_attendance_mark_db WHERE $db_main_details attendance_date BETWEEN '$get_from_date' and '$get_to_date'"
        . " and employee_id='$employee_unique_id' "
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
        . "<td class='td_data_style'><center>$row</center></td>"
        . "<td class='td_data_style'><center>$employee_no</center></td>"
        . "<td class='td_data_style'><center>$deapartment</center></td>"
        . "<td class='td_data_style'>$designation</td>"
        . "<td class='td_data_style'>$employee_name</td>"
        . "<td class='td_data_style'>$employee_mobile_no</td>"
        . "<td class='td_data_style'>$employee_father_name</td>"
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
                      
                   <?php 
                }
                }else
                {
                    echo "<center><span style='padding:3em; margin-top:2em; color:red;'><b>Record no found !</b></span></center>";   
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
          
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
        <script type="text/javascript">
      
$(function() {

$(".date_text_box").datepicker({ 
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