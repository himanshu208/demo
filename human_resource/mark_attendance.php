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
$today_date=date("Y-m-d");
$print_today_date=date("l d/F/Y");
$date_time=$today_date." ".$time_current;
$check_current_month=date("Y-m");



if(isset($_POST['save_hr_attendance_button']))
{
  

$insert_session_id=$_POST['use_inset_session_id'];
$insert_hr_attendance_date=$_POST['insert_hr_attendance_date'];
$sms_command=$_POST['sms_command'];
$note=$_POST['note'];
if(count($_POST['insert_employee_id'])>0)  
{
$insert_employee_id=$_POST['insert_employee_id'];
}else
{
 $insert_employee_id=0;   
}

if((!empty($insert_employee_id))&&(!empty($insert_session_id))&&(!empty($insert_hr_attendance_date)))
{

 $implode_employee_id=implode(",",$insert_employee_id);
 $explode_employee_id=explode(",",$implode_employee_id);
 
 $select_match=mysql_query("SELECT * FROM hr_attendance_mark_db WHERE $db_main_details attendance_date='$insert_hr_attendance_date' and is_delete='none'");
 $select_data=mysql_fetch_array($select_match);
 $select_num_rows=mysql_num_rows($select_match);
 if((empty($select_data))&&($select_data==null)&&($select_num_rows==0))
 {

$results=mysql_query("SHOW TABLE STATUS LIKE 'hr_attendance_mark_db'");
$rows=mysql_fetch_array($results);
$nextIds=$rows['Auto_increment']; 
$hr_attendance_day_id="H_T_DY_$nextIds";
$encrypt_ids=md5($hr_attendance_day_id);
    
  $insert_hr_attendance_day=mysql_query("INSERT into hr_attendance_total_day_db values('','$fetch_school_id','$fetch_branch_unique_db_id'"
        . ",'$insert_session_id','$hr_attendance_day_id','$encrypt_ids'"
          . ",'$insert_hr_attendance_date','$note','none','$today_date','$date_time')");   
  if((!empty($insert_hr_attendance_day))&&($insert_hr_attendance_day))  
  {
 foreach($explode_employee_id as $insert_employee_id)
 {    
   
$hr_attendance=$_POST["mark_hr_attendance_$insert_employee_id"];   
$remark=$_POST["remark_$insert_employee_id"];   

$result=mysql_query("SHOW TABLE STATUS LIKE 'hr_attendance_mark_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_employee_fee_pay_fee_id="H_M_ATTE_$nextId";
$encrypt_id=md5($final_employee_fee_pay_fee_id);

$insert_hr_attendance=mysql_query("INSERT into hr_attendance_mark_db values('','$fetch_school_id','$fetch_branch_unique_db_id'"
        . ",'$insert_session_id','$final_employee_fee_pay_fee_id','$encrypt_id','$insert_hr_attendance_date'"
        . ",'$insert_employee_id','$hr_attendance_day_id','','$hr_attendance','$remark','none','$fecth_user_unique','$today_date','$date_time','','action')");
 }
 
if($insert_hr_attendance)
{
    if($sms_command=="yes")
    {
     header("Location:send_hr_attendance_sms.php?xmlattendanceid=$hr_attendance_day_id&&xmlhttp_dt=$insert_hr_attendance_date");    
    }else
    {
    $message_show="<span style='color:green;'>Record save successfully complete.</span>";       
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
        <script type="text/javascript" src="javascript/attendance_javascript.js"></script>
       
        <script type="text/javascript">
        function on_submit_button()
        {
 var number=1;


  var test_arr = $("input[name*='insert_employee_id[]']"); 
$.each(test_arr, function(i, item) {  //i=index, item=element in array
   var employee_id=$(item).val();
   var check_hr_attendance=$("input[name=mark_hr_attendance_"+employee_id+"]:checked").val();
  
   if(check_hr_attendance=="a" || check_hr_attendance=="l")
   {
    if(check_hr_attendance=="a")
    {
    var hr_attendance_status="<span class='absent_employee'>Absent</span>";
    }else
    {
    var hr_attendance_status="<span class='absent_employee' style='background-color:orange;'>Leave</span>";    
    }
   
   document.getElementById("alert_empty").style.display="none";
  
  var employee_record=document.getElementById("get_employee_data_"+employee_id+"").value;
  var remark=document.getElementById("remark_"+employee_id+"").value;

  var my_arr=employee_record.split('@@');
   
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
    cell5.innerHTML=hr_attendance_status;
     cell6.innerHTML=remark;
  
    number++;
  }
  
  if(number==1)
  {
  document.getElementById("alert_empty").style.display="block";
  }
  
  
});
  
         
           
        var employee_list=document.getElementById("employee_absent_list").value;
        if(employee_list==0)
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
               document.getElementById("employee_absent_list").value="0";
            }
            
             function close_button()
            {
               document.getElementById("win_pop_up").style.display="none"; 
               document.getElementById("employee_absent_list").value="0";
            }
            
              function ab_close_button()
            {
               document.getElementById("win_pop_up_1").style.display="none"; 
                document.getElementById("win_pop_up").style.display="none"; 
               document.getElementById("employee_absent_list").value="0";
            }
            
   document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) 
    {
       document.getElementById("win_pop_up").style.display="none";
       document.getElementById("employee_absent_list").value="0";
    }else
    if (evt.keyCode == 13) 
    {
    document.getElementById("win_pop_up").style.display="none";
    document.getElementById("employee_absent_list").value="0";
    }
}

function continue_buttoned()
{
 

    
 document.getElementById("win_pop_up").style.display="none";     
 document.getElementById("win_pop_up_1").style.display="block";   
 document.getElementById("employee_absent_list").value="1";
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
            
            <script type="text/javascript">
            function employee_continue_button()
            {
           var all_employee=document.getElementById("all_employee").checked;
           var department=document.getElementById("department_id").value;
           var designation=document.getElementById("designation").value;
           var date=document.getElementById("hr_attendance_date").value;
           
           if(all_employee==true)
           {
            all_employee="yes";   
           }else
           {
           all_employee="no";      
            if(department==0&&designation==0)
            {
              alert("Please select atleast one option");
              return false;
            }  
           }
          
         if(date!=0)
         {
         document.getElementById("ajax_loader_show").style.display="block";    
         window.location.assign("mark_attendance.php?xmlallemployee="+all_employee+"&xmldepartment="+department+"\
&xmldesignation="+designation+"&xmldate="+date+"");   
         }
          
                
            }  
            </script>
            
            
            <style>
                .hr_attendance_select{ width:150px; }
            </style>
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
                           <td>Sl.No.</td>
                           <td>Employee No.</td>
                            <td>Employee Name</td>
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
            
            
            
            <input type="hidden" id="employee_absent_list" value="0">
            <input type="hidden" name="sms_command" id="sms_command">
            <div id="win_pop_up_1" style=" display:none; ">
            <div id="first_pop_up_div"></div> 
            <div id="second_pop_up" class="second_show_pop_up">
                <div id="student_list_show">
                  <div class="close_div" onclick="ab_close_button()"></div>  
                  <div class="middle_center_work_div"  id="win_pop_up_text">
                    Are You Sure Want To Send SMS to all Absent Employees
                       </div>
                  <div class="last_bottom_close_div">
                   
                    <input type="submit" onclick="confirm_button('yes')" name="save_hr_attendance_button" class="ok_button_style" style=" border:0; height:40px;   background-color:dodgerblue; " value="Yes">
                    <input type="submit" onclick="confirm_button('no')" name="save_hr_attendance_button" 
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
                           <td><a href="hr_dashboard.php">Human Resource</a></td>
                           <td>/</td>
                          <td>Mark Attendance</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Add Mark Attendance</b></div>
              <a href="attendance_report.php"> <div class="view_button"><b>View Mark Attendance Report</b></div> </a> 
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
             document.getElementById("designation").disabled=true;
              }else
              {
              document.getElementById("department_id").disabled=false;
             document.getElementById("designation").disabled=false;    
              }
              
               }
               </script>
               
               <div class='work_main_div'>
                   <table class='main_search_table' style=" float:none; margin:0 auto; margin-top:10px;   ">
                       <tr>
                           <td>
                               <table>
                                   <tr>
                                       <td><input onclick="all_employee_select()" id="all_employee" value="yes" type="checkbox"></td><td><b>All Employee</b></td>
                                   </tr>
                               </table>   
                               
                           </td>
                           <td style=" width:60px; "></td>
                           <td><b>Department</b></td>
                           <td><b>:</b></td>
                           <td><select id="department_id" class='attendance_select' style=" width:160px; ">
                                  <option id="zero_1" value="0">--- Select ---</option> 
                                   
                               <?php
                               if(!empty($_REQUEST['xmlallemployee']))
                             {
                             $get_employee=$_REQUEST['xmlallemployee'];   
                             }else
                             {
                              $get_employee="";   
                             }
                               
                               
                               
                             if(!empty($_REQUEST['xmldepartment']))
                             {
                             $get_department=$_REQUEST['xmldepartment'];   
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
                           <td style=" width:20px; "></td>
                           <td><b>Designation</b></td>
                           <td><b>:</b></td>
                           <td><select id="designation" class='attendance_select' style=" width:160px; ">
                                   <option id="zero_2" value="0">--- Select ---</option>      
                                 <?php
                              if(!empty($_REQUEST['xmldesignation']))
                             {
                             $get_designation=$_REQUEST['xmldesignation'];   
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
                                   
                               </select>
                           </td>
                           <?php
                           if(!empty($_REQUEST['xmldate']))
                           {
                          $get_date=$_REQUEST['xmldate'];     
                           }else
                           {
                          $get_date="";      
                           }
                           ?>
                           
                            <td style=" width:20px; "></td>
                           <td><b>Date</b></td><td><b>:</b></td>
                           <td><input readonly="readonly" type="text" id="hr_attendance_date" class="text_box_styling" 
                                      style=" background-color:whitesmoke; width:150px;  " 
                                      value="<?php if(!empty($get_date)){ echo $get_date; }else { echo $today_date; }?>"></td>
                             <td style=" width:20px; "></td>
<td><input type='button' class='add_button_reset_button' onclick="employee_continue_button()" value='Continue'></td>
<td><input type='button' class='add_button_reset_button' style="background-color:deeppink;" value='Reset'></td>
                       </tr>
                       
                   </table>    
               </div>
                
                    
               <div id="main_hr_attendance_work_div">
               
                   
                   
                   <div class="employee_record_div" style=" margin-top:10px; ">
                       
                   <?php
                   
                   
                  if((!empty($_REQUEST['xmlallemployee']))&&(!empty($_REQUEST['xmldate'])))

                  {
          
                      
                      
                 $all_employee=$_REQUEST['xmlallemployee'];
                 $attedance_date=$_REQUEST['xmldate'];
                 if($all_employee=="yes")
                 {
                     $search="";   
               
                    }else
                 {
                    $search=" T1.department_id='$get_department' and T1.designation_id='$get_designation' and";   
                  
                 }
                  
                  
$total_work_day=mysql_query("SELECT * FROM hr_attendance_total_day_db WHERE $db_main_details is_delete='none'");
$total_working_days=mysql_num_rows($total_work_day)+1;  
                   
                   
                     $employee_db=mysql_query("SELECT *,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                      . "LEFT JOIN hr_family_db as T3 ON T1.family_id=T3.family_unique_id "
                      . "LEFT JOIN hr_department_db as T4 ON T1.department_id=T4.department_id "
                      . "LEFT JOIN hr_designation_db as T5 ON T1.designation_id=T5.designation_id WHERE $search T1.is_delete='none'");
                   $fetch_employee_num_rows=mysql_num_rows($employee_db);
                   if($fetch_employee_num_rows!=0)
                   {
         

   
     
  if(!empty($_REQUEST['xmldate']))  
  {
  $get_today_date=$_REQUEST['xmldate'];
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
 
$insert_hr_attendance_date=date("Y-m-d",strtotime($date));
             

$mark_hr_attendance_dbs=mysql_query("SELECT * FROM hr_attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_hr_attendance_date' and is_delete='none'");
$fetch_already_hr_attendance=mysql_num_rows($mark_hr_attendance_dbs);

$prsent_hr_attendance=mysql_query("SELECT * FROM hr_attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_hr_attendance_date' "
        . "and attendance='p' and is_delete='none'");
$total_prsent_employee=mysql_num_rows($prsent_hr_attendance);

$absent_hr_attendance=mysql_query("SELECT * FROM hr_attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_hr_attendance_date' "
        . "and attendance='a' and is_delete='none'");
$total_absent_employee=mysql_num_rows($absent_hr_attendance);

$leave_hr_attendance=mysql_query("SELECT * FROM hr_attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_hr_attendance_date' "
        . "and attendance='l' and is_delete='none'");
$total_leave_employee=mysql_num_rows($leave_hr_attendance);

$late_hr_attendance=mysql_query("SELECT * FROM hr_attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_hr_attendance_date' "
        . "and attendance='lt' and is_delete='none'");
$total_late_employee=mysql_num_rows($late_hr_attendance);


$hr_attendance_total_db=mysql_query("SELECT * FROM hr_attendance_total_day_db WHERE $db_main_details attendance_date='$insert_hr_attendance_date' and is_delete='none'");
$hr_attendance_total_num_rows=mysql_num_rows($hr_attendance_total_db);
$hr_attendance_total_data= mysql_fetch_array($hr_attendance_total_db);



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
                       
                       
                       
                       <input type='hidden' name='insert_hr_attendance_date' value='<?php  echo $insert_hr_attendance_date;?>'>
                       
                       <div class="hr_attendance_month_register" style="width:100%;  margin-top:10px; float:left;  ">
                          
                           
                           <div class="button_viem_month"><b>View Attendance Register</b></div>   
                         <?php 
                           if($fetch_already_hr_attendance!=0)
                           {
                           {
                           ?>
                           
                           <a href="">
                           <div class='button_viem_month'
                                style=" background-color:orange; color:black;  margin-right:10px;  "><b>Modify Attendance</b></div>
                           </a>
                           
                           <div class='button_viem_month' onclick="hr_attendance_delete('')"
                                style=" background-color:red; margin-right:10px;  "><b>Delete</b></div>
                           
                   <?php 
                           }
                           }
                     ?>
                       </div>
                       
                       
                       
                      <div class="month_calander_style">
                      <div class="left_side_title">MONTH - YEAR</div>  
                     
                       <center>
                          <div class="center_month_div">
                               <table cellspacing="2" cellpadding="0" style=" margin-top:2px; ">
                                   <tr>
                                       <td>
                                           <a href="mark_attendance.php?xmlallemployee=<?php echo $get_employee;?>&xmldepartment=<?php echo $get_department;?>&xmldesignation=<?php echo $get_designation;?>&xmldate=<?php  echo $previous_month_date;?>"><div class="button_next_style" id="dodblue_previous_button"></div></a></td>
                                       <td style=" padding-left:25px; "></td>
                                       <td><?php  echo ucfirst($current_month);?> -<?php  echo $current_year;?></td>
                                       <td style=" padding-left:25px; "></td>
                                       <td>
                                         <?php 
                                           if($strtotime_current_month>$strtotime_get_current_month)
                                           {
                                           ?>
                                           
                                           <a href="mark_attendance.php?xmlallemployee=<?php echo $get_employee;?>&xmldepartment=<?php echo $get_department;?>&xmldesignation=<?php echo $get_designation;?>&xmldate=<?php  echo $next_month_date;?>"><div class="button_next_style" id="dodblue_next_button"></div></a>
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
                                           <a href="mark_attendance.php?xmlallemployee=<?php echo $get_employee;?>&xmldepartment=<?php echo $get_department;?>&xmldesignation=<?php echo $get_designation;?>&xmldate=<?php  echo $previous_day_date;?>"><div class="button_next_style" id="deeppink_previous_button"></div></a>
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
                                           <a href="mark_attendance.php?xmlallemployee=<?php echo $get_employee;?>&xmldepartment=<?php echo $get_department;?>&xmldesignation=<?php echo $get_designation;?>&xmldate=<?php  echo $next_day_date;?>"><div class="button_next_style" id="deeppink_next_button"></div></a>
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
                       
                     
                       
                       
                       
                       
                       
                       <div class='main_hr_attendance_div'>
                           <div class='modify_hr_attendance'></div>
                       <table cellspacing="0" cellpadding="0" id="hr_attendance_tabel" style=" width:100%; ">
                           <tr>
                                 <td class="tr_heading_style">Sl.No.</td>
                                 <td class="tr_heading_style">Employee No.</td>
                                 <td class="tr_heading_style" style=" text-align:left; "><div>Employee Name</div></td>
                                  <td class="tr_heading_style" style=" text-align:left; ">Mobile No.</td>
                                 <td class="tr_heading_style" style=" text-align:left; ">Father Name</td>
                                 <td class="tr_heading_style">
                                     <center>
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td><input name="employee_hr_attendance" id="prsent_select_all" class='hr_attendance_check_box' type='radio' checked></td>
                                             <td>Present</td>
                                         </tr>
                                     </table>
                                     </center>
                                      </td>
                                      <td class="tr_heading_style">
                                       <center>
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td><input name="employee_hr_attendance" id="absent_select_all" class='hr_attendance_check_box' type='radio'></td>
                                             <td>Absent</td>
                                         </tr>
                                     </table></center>   
                                      </td>
                                      <td class="tr_heading_style">
                                       <center>
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td><input name="employee_hr_attendance" id="leave_select_all" class='hr_attendance_check_box' type='radio'></td>
                                             
                                             <td>Leave</td>
                                         </tr>
                                     </table></center>    
                                      </td>
                                      <td class="tr_heading_style">
                                        <center>
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td><input name="employee_hr_attendance" id="late_select_all" class='hr_attendance_check_box' type='radio'></td>
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
                   
                   while ($employee_data=mysql_fetch_array($employee_db))
                   {
                    $row++;
                    
               $fetch_employee_id=$employee_data['t1_employee_id'];
                $employee_encrypt_id=$employee_data['t1_encrypt_id'];
                $employee_no=$employee_data['employee_no'];
                $fetch_employee_name=$employee_data['full_name'];
                $employee_gender=ucwords($employee_data['gender']);
                $employee_mobile_no=$employee_data['mobile'];
                $fetch_employee_father_name=ucwords($employee_data['father_name']);
                $get_employee_value="$row@@$employee_no@@$fetch_employee_name@@$fetch_employee_father_name";
                   
                   
         $mark_hr_attendance_data_db=mysql_query("SELECT * FROM hr_attendance_mark_db WHERE $db_main_details"
        . " attendance_date='$insert_hr_attendance_date' and employee_id='$fetch_employee_id' and is_delete='none'");

        $attandence_num_rows=mysql_num_rows($mark_hr_attendance_data_db);           
        $hr_attendance_data=mysql_fetch_array($mark_hr_attendance_data_db); 
                 if((!empty($hr_attendance_data))&&($hr_attendance_data!=null)&&($attandence_num_rows!=0))
                 {
                  $hr_attendance=$hr_attendance_data['attendance'];   
                  if($hr_attendance=="p")
                  {
                    $prsent="<span class='attendance_style' style='background-color:green;'>Present</span>";  
                  
                    $absent="";
                    $leave="";
                    $late="";
                  }else
                  if($hr_attendance=="a")
                  {
                    $absent="<span class='attendance_style' style='background-color:red;'>Absent</span>"; 
                    $prsent="";
                   
                    $leave="";
                    $late="";
                  }else
                  if($hr_attendance=="l")
                  {
                   $leave="<span class='attendance_style' style='background-color:yellow; color:black;'>Leave</span>";
                   $prsent="";
                    $absent="";
                    
                    $late="";
                  }else
                  if($hr_attendance=="lt")
                  {
                    $late="<span class='attendance_style' style='background-color:silver;'>Late</span>";  
                    $prsent="";
                    $absent="";
                    $leave="";
                    
                  } 
                  
                 $remark=$hr_attendance_data['remark'];   
                 }else
                 {
                  $remark="";   
                 }
        
                 
                 
$employee_prsent_att=0;
$employee_absent_att=0;
$employee_leave_att=0;
$employee_late_att=0;
$mark_attenandance_type=mysql_query("SELECT * FROM hr_attendance_mark_db WHERE $db_main_details employee_id='$fetch_employee_id' "
        . "and is_delete='none' and is_delete='none'");
while ($fetch_hr_attendance_data=mysql_fetch_array($mark_attenandance_type))
{
$hr_attendance=$fetch_hr_attendance_data['attendance'];
if($hr_attendance=="p")
{
 $employee_prsent_att++;   
}else
 if($hr_attendance=="a")
{
 $employee_absent_att++;   
}else
 if($hr_attendance=="l")
{
 $employee_leave_att++;   
}else
    if($hr_attendance=="lt")
{
 $employee_late_att++;   
}
}
     
$leave_hr_attendance_count=$employee_leave_att;
$leave_hr_attendance_calculate=($employee_leave_att/2);
 if((empty($hr_attendance_data))&&($hr_attendance_data==null)&&($attandence_num_rows==0))
 {
 $add=1;    
 }  else {
    $add=0; 
 }
 
 
$total_prsent_hr_attendance=($employee_prsent_att+$leave_hr_attendance_calculate+$employee_late_att+$add);

if($total_working_days!=0)
{
$hr_attendance_aggrigate=(($total_prsent_hr_attendance*100)/$total_working_days);
}else
{
 $hr_attendance_aggrigate=0;   
}
if($hr_attendance_aggrigate!=0)
{
 $hr_attendance_aggrigate=number_format($hr_attendance_aggrigate,2);   
}
        
                   {   
                       ?>
                                      
                                      
                       <?php
                                      if((empty($hr_attendance_data))&&($hr_attendance_data==null)&&($attandence_num_rows==0))
                                      {
                                     ?>                 
                       <tr class="green_color_all" id="hr_attendance_color_<?php  echo $fetch_employee_id;?>">
                           <?php
                                      }else
                                      {
                           ?>
                             <tr  id="hr_attendance_color_<?php  echo $fetch_employee_id;?>">
                             <style>
                                #prsent_select_all { display:none; } 
                                #absent_select_all { display:none; } 
                                #leave_select_all { display:none; } 
                                #late_select_all { display:none; } 
                             </style>
                           
                           <?php
                                      }
                           ?>
                           
                       <td class="hr_attendance_td_style"><center><b><?php  echo $row;?></b></center>
                       <input type="hidden" id="total_working_day_<?php  echo $fetch_employee_id;?>" value="<?php  echo $total_working_days;?>">
                       <input type="hidden" id="prsent_allendance_<?php  echo $fetch_employee_id;?>" value="<?php  echo $employee_prsent_att;?>">
                       <input type="hidden" id="leave_allendance_<?php  echo $fetch_employee_id;?>" value="<?php  echo $employee_leave_att;?>">
                       <input type="hidden" id="leave_count_hr_attendance_<?php  echo $fetch_employee_id;?>" value="2">
                       </td>
                       
                       <td class="hr_attendance_td_style">
                           <input type="hidden" id="get_employee_data_<?php  echo $fetch_employee_id;?>" value="<?php echo $get_employee_value;?>">
                           <input type="hidden" class="employee_id_list" name="insert_employee_id[]" value="<?php  echo $fetch_employee_id;?>">
                       <center><?php  echo $employee_no;?></center>
                       </td>
                       
                     
                       <td class="hr_attendance_td_style"><?php  echo $fetch_employee_name;?></td>
                        <td class="hr_attendance_td_style"><?php  echo $employee_mobile_no;?></td>
                      
                       <td class="hr_attendance_td_style"><?php  echo $fetch_employee_father_name;?></td>
                                 
                       
                                   <td class="hr_attendance_td_style">
                                   <center>
                                     <?php
                                      if((empty($hr_attendance_data))&&($hr_attendance_data==null)&&($attandence_num_rows==0))
                                      {
                                     ?>  
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td> <input name="mark_hr_attendance_<?php  echo $fetch_employee_id;?>" onclick="prsent_status('<?php  echo $fetch_employee_id;?>')" class='td_hr_attendance_check_box_p' type='radio' value='p' checked></td>
                                     <td>Present</td> </tr>  </table>
                                       <?php
                                      }else
                                      {
                                          echo $prsent;   
                                      }
                                       ?>
                                   </center>  
                                 </td>
                                 <td class="hr_attendance_td_style">
                                   <center>
                                        <?php
                                      if((empty($hr_attendance_data))&&($hr_attendance_data==null)&&($attandence_num_rows==0))
                                      {
                                     ?> 
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
     <td>
     <input name="mark_hr_attendance_<?php  echo $fetch_employee_id;?>" onclick="absent_status('<?php  echo $fetch_employee_id;?>')" class='td_hr_attendance_check_box_a' type='radio' value='a'></td>
     </td>
                                             <td>Absent</td>
                                         </tr>
                                     </table>
                                   <?php
                                      }else
                                      {
                                          echo $absent; 
                                      }
                                   ?>
                                   </center>  
                                 </td>
                                 <td class="hr_attendance_td_style">
                                   <center>
                                        <?php
                                      if((empty($hr_attendance_data))&&($hr_attendance_data==null)&&($attandence_num_rows==0))
                                      {
                                     ?> 
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td>
        <input name="mark_hr_attendance_<?php  echo $fetch_employee_id;?>" onclick="leave_status('<?php  echo $fetch_employee_id;?>')" class='td_hr_attendance_check_box_l' type='radio' value='l'></td>
     
                                             </td>
                                             <td>Leave</td>
                                         </tr>
                                     </table>
                                   <?php
                                      }else
                                      {
                                          echo $leave; 
                                      }
                                   ?>
                                   </center>  
                                 </td>
                                 
                                 <td class="hr_attendance_td_style">
                                   <center>
                                        <?php
                                      if((empty($hr_attendance_data))&&($hr_attendance_data==null)&&($attandence_num_rows==0))
                                      {
                                     ?> 
                                     <table cellspacing='0' cellpadding='0'>
                                         <tr>
                                             <td>
  <input name="mark_hr_attendance_<?php  echo $fetch_employee_id;?>" onclick="school_leave_status('<?php  echo $fetch_employee_id;?>')" class='td_hr_attendance_check_box_lt' type='radio' value='lt'></td>
      
                                             </td>
                                             <td>Late</td>
                                         </tr>
                                     </table>
                                   <?php
                                      }else
                                      {
                                         echo $late; 
                                      }
                                   ?>
                                   </center>  
                                 </td>
                                 <td class="hr_attendance_td_style" style=" padding-left:3px; padding-right:3px;  ">
                                         <?php
                                      if((empty($hr_attendance_data))&&($hr_attendance_data==null)&&($attandence_num_rows==0))
                                      {
                                     ?> 
                                     
                                     <textarea id="remark_<?php  echo $fetch_employee_id;?>" style=" width:96%; " name="remark_<?php  echo $fetch_employee_id;?>"></textarea>
                                     <?php
                                      }else
                                      {
                                      echo $remark;    
                                      }
                                     ?>
                                     
                                     
                                 </td>
                                 <td class="hr_attendance_td_style" style=" text-align:center;  border-right:1px solid gray; ">
                                     <div id="employee_hr_attendance_aggrigate_<?php  echo $fetch_employee_id;?>"><?php echo $hr_attendance_aggrigate;?>%</div>   
                                 </td>
                             </tr>
                             
                         <?php 
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
                                      <div class="total_employee_record_div">
                                          
                                          
                                          <table style=" width:65%;  float:left; margin:10px;  ">
                                           
                                              <tr>
                                                  <td style=" width:40px; "><b>Note</b></td><td><b>:</b></td>
                                                   <?php
                                            if((empty($hr_attendance_total_data))&&($hr_attendance_total_data==null)&&($hr_attendance_total_num_rows==0))
{
   
                                            ?>
                                                  <td><textarea class="text_area_style" name="note" style=" height:70px; "></textarea></td>
                                             <?php
}else
{
  $note=$hr_attendance_total_data['note'];
  echo "<td>"; 
  echo ucwords($note);
  echo "</td>";
}
                                              ?>
                                              </tr>
                                             
                                          </table> 
                                          
                                          
                                          <table cellspacing="0" cellpadding="5" id="track_student_table" style=" float:left; margin-top:5px;  ">
                                              <tr >
                                                  <td><b>Total Student</b></td><td><b>:</b></td><td><?php echo $fetch_employee_num_rows;?></td>  
                                              </tr>
                                              <tr>
                                                  <td><b>Total Present</b></td><td><b>:</b></td><td><div id="total_present">
      
                                                     <?php 
                                                       if((empty($hr_attendance_total_data))&&($hr_attendance_total_data==null)&&($hr_attendance_total_num_rows==0))
{
                                                           echo $fetch_employee_num_rows;          
                                                       }else
                                                       {
                                                           echo $total_prsent_employee;    
                                                       }
                                                     
                                                     ?> 
                                                      
                                                      </div></td>  
                                              </tr>
                                              <tr>
                                                  <td><b>Total Absent</b></td><td><b>:</b></td><td><div id="total_absent"><?php echo $total_absent_employee;?></div></td>  
                                              </tr>
                                              <tr>
                                                  <td><b>Total Leave</b></td><td><b>:</b></td><td><div id="total_leave"><?php echo $total_leave_employee;?></div></td>  
                                              </tr>
                                              <tr>
                                                  <td><b>Total Late</b></td><td><b>:</b></td><td style=" width:20px; "><div id="total_late"><?php echo $total_late_employee;?></div></td>  
                                              </tr>
                                          </table>
                                     </div>  
                                 </td>
                                
                                 
                                 <td colspan="4">
                                    <?php 
                           if($fetch_already_hr_attendance==0)
                           {
                           {
                           ?>
                                     
                                     <input type="button" class="button_styling" onclick="on_submit_button()" id="submit_button_1" name='save_hr_attendance_button' value="Save"> 
                                     <input type="button" class="button_styling" style=" background-color:deeppink; " value="Reset">
                               <?php 
                           }
                           } ?>
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
                       echo "employee no found !";
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
        
        
        <?php
        if(!empty($_REQUEST['xmlallemployee']))
        {
        $all_employee=$_REQUEST['xmlallemployee'];    
         if($all_employee=="yes")
         {
        ?>
        <script type="text/javascript">
        function window_load()
        {
            document.getElementById("all_employee").checked=true;
        document.getElementById("zero_1").selected=true;
              document.getElementById("zero_2").selected=true;
             document.getElementById("department_id").disabled=true;
             document.getElementById("designation").disabled=true;    
        }
        </script>
        <?php
         }
        }
        ?>
        
         <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
         
                       
              
<script type="text/javascript">    
$(function() {
$("#hr_attendance_date").datepicker({ 
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
            $('.td_hr_attendance_check_box_p').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"   
              $(".green_color_all").css("background-color","#E0FFD1");  
              
    $('input:radio').change(function(){
        var prsent = $('.td_hr_attendance_check_box_p:checked').length;
        var absent = $('.td_hr_attendance_check_box_a:checked').length;
        var leave=$('.td_hr_attendance_check_box_l:checked').length;
        var late=$('.td_hr_attendance_check_box_lt:checked').length;        
        $('#total_present').text(prsent);
        $('#total_absent').text(absent);     
         $('#total_leave').text(leave);     
          $('#total_late').text(late);     
    });
              
              
            });
        }else{
            $('.td_hr_attendance_check_box_p').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
    $('#absent_select_all').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.td_hr_attendance_check_box_a').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"   
                 $(".green_color_all").css("background-color","#FFE6E6");  
              
       $('input:radio').change(function(){
        var prsent = $('.td_hr_attendance_check_box_p:checked').length;
        var absent = $('.td_hr_attendance_check_box_a:checked').length;
        var leave=$('.td_hr_attendance_check_box_l:checked').length;
        var late=$('.td_hr_attendance_check_box_lt:checked').length;        
        $('#total_present').text(prsent);
        $('#total_absent').text(absent);     
         $('#total_leave').text(leave);     
          $('#total_late').text(late);     
    });
            });
        }else{
            $('.td_hr_attendance_check_box_a').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
    $('#leave_select_all').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.td_hr_attendance_check_box_l').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"       
                 $(".green_color_all").css("background-color","#FFFFCC"); 
                 
                 $('input:radio').change(function(){
        var prsent = $('.td_hr_attendance_check_box_p:checked').length;
        var absent = $('.td_hr_attendance_check_box_a:checked').length;
        var leave=$('.td_hr_attendance_check_box_l:checked').length;
        var late=$('.td_hr_attendance_check_box_lt:checked').length;        
        $('#total_present').text(prsent);
        $('#total_absent').text(absent);     
         $('#total_leave').text(leave);     
          $('#total_late').text(late);     
    });
                 
            });
        }else{
            $('.td_hr_attendance_check_box_l').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
    $('#late_select_all').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.td_hr_attendance_check_box_lt').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"   
                 $(".green_color_all").css("background-color","#CCD6E0");  
                 
                 
                 $('input:radio').change(function(){
        var prsent = $('.td_hr_attendance_check_box_p:checked').length;
        var absent = $('.td_hr_attendance_check_box_a:checked').length;
        var leave=$('.td_hr_attendance_check_box_l:checked').length;
        var late=$('.td_hr_attendance_check_box_lt:checked').length;        
        $('#total_present').text(prsent);
        $('#total_absent').text(absent);     
         $('#total_leave').text(leave);     
          $('#total_late').text(late);     
    });
                 
            });
        }else{
            $('.td_hr_attendance_check_box_lt').each(function() { //loop through each checkbox
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