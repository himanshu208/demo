<?php
//SESSION CONFIGURATION
$check_array_in="time_table";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php
$message_show="";
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

if(isset($_POST['step_one_submit_button']))
{
 if(count($_POST['week_days'])>0)
 {
$week_name=$_POST['week_days']; 
$count_week_name=count($_POST['week_days']);  
 }else
 {
  $week_name=array();   
  $count_week_name=0;   
 }
   
 if(count($_POST['lecture_name'])>0)
 {
  $lecture_name=$_POST['lecture_name']; 
  $count_lecture_name=count($_POST['lecture_name']);
 }else
 {
  $lecture_name=array();
  $count_lecture_name=0;
 }
 
 $break=$_POST['text_break'];
 
 $start_time=$_POST['lecture_start_time'];
 $end_time=$_POST['lecture_end_time'];       
 
 
$insert_session_id=$_POST['use_inset_session_id'];
$time_table_name=$_POST['time_table_name'];
$class_id=$_POST['course_id'];
$section_id=$_POST['section_id'];

 if((!empty($count_week_name))&&(!empty($count_lecture_name))&&(!empty($insert_session_id))
         &&(!empty($time_table_name))&&(!empty($class_id))&&(!empty($section_id)))
 {
  
   
$result=mysql_query("SHOW TABLE STATUS LIKE 'time_table_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_db_id="TM_TB_$nextId"; 
$encrypt_id=md5(md5($final_db_id));   
     
     
     
  $select_match_db=mysql_query("SELECT * FROM time_table_db WHERE $db_main_details class_id='$class_id' and section_id='$section_id' "
          . "and time_table_name='$time_table_name' and is_delete='none'");
  $select_data=mysql_fetch_array($select_match_db);
  $select_num_rows=mysql_num_rows($select_match_db);
     
  if((empty($select_data))&&($select_data==null)&&($select_num_rows==0))
  {
  //insert week days    
   $delete_db=mysql_query("DELETE FROM table_week_days_db WHERE $db_main_details time_table_id='$final_db_id' and is_delete='none'");   
        
 $week_days_save=0;   
 foreach ($week_name as $insert_week_name)
 {
 if(!empty($insert_week_name))
 {
  
$insert_weeks_db=mysql_query("INSERT into time_table_week_days_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
               . ",'$final_db_id','$insert_week_name','none','$date','$date_time')");  
if($insert_weeks_db)
{
 $week_days_save++;   
}
else
{
    
}
 }
 }

 //insert lecture value
 
 $delete_db=mysql_query("DELETE FROM time_table_set_lecture_db WHERE $db_main_details time_table_id='$final_db_id' and is_delete='none'");
 $lecture_save=0;
for($number=0;$number<$count_lecture_name;$number++)
{
$insert_lecture_name=$lecture_name[$number];
$insert_start_time=$start_time[$number];
$insert_end_time=$end_time[$number];  
$insert_break=$break[$number];
if((!empty($insert_lecture_name))&&(!empty($insert_start_time))&&(!empty($insert_end_time)))
{
$temp_start_time=strtotime($insert_start_time);
$temp_end_time=strtotime($insert_end_time);        
    
$insert_lacture_db=mysql_query("INSERT into time_table_set_lecture_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
               . ",'$final_db_id','$insert_lecture_name','$insert_start_time','$insert_end_time','$temp_start_time'"
        . ",'$temp_end_time','$insert_break','none','$date','$date_time')"); 
if($insert_lacture_db)
{
 $lecture_save++;   
}else
{
    
}
     
}    
}

//insert time table

if((!empty($week_days_save))&&(!empty($lecture_save)))
{
 
$insert_db=mysql_query("INSERT into time_table_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
               . ",'$final_db_id','$encrypt_id','$class_id','$section_id','$time_table_name','pending','yes','$date','$date_time'"
        . ",'','')");    
 if((!empty($insert_db))&&($insert_db))
 {
     header("Location:create_time_table.php?token_id=$encrypt_id&xmlclass=$class_id&xmlsection=$section_id&xmltimetable=$time_table_name");    
 }else
 {
  $message_show="Sorry,Request failed,Please try again.";     
 }
    
}else
{
  $message_show="Sorry,Request failed,Please try again.";        
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


<?php
//assign subject

if(isset($_POST['time_table_subject_save']))
{
 
    
 $update_db_id=$_POST['update_assign_subject'];   
$insert_session_id=$_POST['use_inset_session_id'];    
$time_table_id=$_POST['time_table_unique_id'];
$week_day_id=$_POST['insert_week_id'];
$lecture_id=$_POST['insert_lecture_id'];
        $subject_id=$_POST['subject_id'];
        $employee_id=$_POST['teacher_id'];
        $room=$_POST['room_no'];
        $note=$_POST['note'];
    
        $result=mysql_query("SHOW TABLE STATUS LIKE 'time_table_assign_subject_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_db_id="TM_TB_AS_SB_$nextId"; 
$encrypt_id=md5(md5($final_db_id));
        if((!empty($time_table_id))&&(!empty($insert_session_id))&&(!empty($week_day_id))&&(!empty($lecture_id))&&(!empty($subject_id))
                &&(!empty($employee_id))&&(!empty($final_db_id)))
        {
            
       if(empty($update_db_id))
       {
      $select_db=mysql_query("SELECT * FROM time_table_assign_subject_db WHERE time_table_id='$time_table_id'"
              . " and week_day_id='$week_day_id' and lecture_id='$lecture_id' and is_delete='none'");
      $select_num_rows=mysql_num_rows($select_db);
        if($select_num_rows==0)
        {
        $insert_db=mysql_query("INSERT into time_table_assign_subject_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
               . ",'$final_db_id','$encrypt_id','$time_table_id','$week_day_id','$lecture_id','$subject_id',"
                . "'$employee_id','$room','$note','none','$date','$date_time')");   
        if($insert_db)
        {
        $message_show="Subject assign successfully complete";      
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
       $update_db=mysql_query("UPDATE time_table_assign_subject_db SET subject_id='$subject_id',teacher_id='$employee_id',room='$room',note='$note' "
               . "WHERE id='$update_db_id'");    
        if($update_db)
        {
        $message_show="Record update successfully complete";      
        }else
        {
         $message_show="Request failed,Please try again.";     
        }
       }
 
 
        }else
 {
  $message_show="Please fill all fields.";  
 }
 
 require_once '../pop_up.php';
        
    
}


//finally save 

if(isset($_POST['final_time_table_save']))
{
 $time_table_update_id=$_POST['time_table_unique_id']; 
 $time_table_name=$_POST['time_table_name'];
 $section_id=$_POST['section_id'];
 if(!empty($time_table_update_id))
 {
$upate_time_db=mysql_query("UPDATE time_table_db SET section_id='$section_id',time_table_name='$time_table_name' WHERE time_table_id='$time_table_update_id'");   
 if((!empty($upate_time_db))&&($upate_time_db))
 {
 $message_show="Record update successfully complete"; 
 }else
 {
 $message_show="Request failed,Please try again";        
 }
     
 }else
 {
   $message_show="Please fill all fields.";      
 }
 require_once '../pop_up.php';
}

//cancel time table

if(isset($_POST['cancel_time_table']))
{
 $time_table_update_id=$_POST['time_table_unique_id']; 
 if(!empty($time_table_update_id))
 {
  $delete_db=mysql_query("DELETE FROM time_table_db WHERE time_table_id='$time_table_update_id'");   
  if((!empty($delete_db))&&($delete_db))
 {
  header("Location:create_time_table.php?status=delete");     
 
 }else
 {
 $message_show="Request failed,Please try again";        
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
        <title>Edit Time Table</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       <script src="javascript/time_table_javascript.js"></script>   
       <script type="text/javascript">
       function final_button_time()
       {
var r=confirm("Are you sure you want to finally save time table");
if (r==true)
  {
       document.getElementById("ajax_loader_show").style.display="block";      
  }else
  {
     return false; 
  }
       }
       
        function cancel_button_time()
       {
var r=confirm("Are you sure you want to delete/cancel time table");
if (r==true)
  {
       document.getElementById("ajax_loader_show").style.display="block";      
  }else
  {
     return false; 
  }
       }
       </script>     
    </head>
    <body  onload='window_load()'>
        
        
        
      <?php 
      include_once '../ajax_loader_page_second.php';
      ?> 
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" method="post" enctype="multipart/form-data">
       
            <?php
            if(!empty($_REQUEST['status']))
            {
             $time_table_status=$_REQUEST['status'];   
              if($time_table_status=="delete") 
              {
               $message_show="Timetable delete successfully complete"; 
              }else
              {
                $message_show="Time Table Create Successfully Complete.";     
              }
              require_once '../pop_up.php';
            }
            ?>
            
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="time_table_dashboard.php">Time Table</a></td>
                           <td>/</td>
                           <td><a href="active_time_table.php">Active Time Table</a></td>
                           <td>/</td>
                           <td>Edit Time Table</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Edit Timetable</b></div>
              <a href="add_mark_attendance_type.php"> <div class="view_button">View Time Table</div> </a> 
                   </div>
                
               <div class="main_work_data" style=" padding-top:20px;">
                   <div id="time_table_style">
                       
                       <div id="time_table_pop_up_1" style=" display:none; ">
                           <div id="time_table_full_opacity" style=" display:block; "></div>
                       <div id="main_work_div_time_table" style=" display:block; ">
                           <div id="middle_work_div_time_table">
                               <div id="first_div_top"><div onclick="close_pop_up()" class="close_button_style"></div></div>
                               <div id="second_div_top">
                                   <div class="time_table_title">Set Working Days</div>
                                   <table style=" margin:auto; ">
                                      <?php
               $week_days_db=mysql_query("SELECT * FROM time_table_weekdays_db WHERE $db_main_details_whout_session is_delete='none'");
               $week_data=mysql_fetch_array($week_days_db);
               $week_days_num_rows=mysql_num_rows($week_days_db);
               if((!empty($week_data))&&($week_data!=null)&&($week_days_num_rows!=0))
               {
               $week_days=$week_data['week_days']; 
               $week_days_id=$week_data['week_days_id'];
               }else
               {
                $week_days=0;   
                $week_days_id=0;
               
               }
                 
               $week_array=explode(",",$week_days);
               
               ?>  
                                      <?php
                           $week_days=array("sunday","monday","tuesday","wednesday","thursday","friday","saturday");
                           foreach($week_days as $week_namee)
                           {
                            $week_name_large=ucwords($week_namee);  
                            if(in_array($week_namee,$week_array)==true)
                            {
                            echo " <tr>
                               <td><input name='week_days[]' class='week_days_time_table' value='$week_namee' type='checkbox' checked></td><td><b>$week_name_large</b></td>
                           </tr>";        
                            }else
                            {
                            
                           echo " <tr>
                               <td><input name='week_days[]' class='week_days_time_table' value='$week_namee' type='checkbox'></td><td><b>$week_name_large</b></td>
                           </tr>";    
                            }
                           
                           }
                           ?>
                           <tr>
                               <td style=" height:20px; "></td>
                           </tr>   
                                   </table>
                                   <div class="next_button" onclick="next_button()">Next</div>    
                                   
                               </div>
                           </div>
                       </div>
                       </div>
                       
                       <div></div>                       
                       
                       <script type="text/javascript">
                        var number_this=2;
                       function add_new_line()
                       {
                    var temp_no=new Number(document.getElementById("temp_number").value);       
    var add_one=new Number('1');
    var both_add=temp_no+add_one;
    for(var i=1;i<=both_add;i++)
    {
     if(document.getElementById("lecture_name_"+i+""))
     {
      var subject_name=document.getElementById("lecture_name_"+i+"").value;
      if(subject_name==0)
      {
         alert("Please enter lecture name");
         document.getElementById("lecture_name_"+i+"").focus();
         return false;
      }
     }
     
     if(document.getElementById("start_time_"+i+""))
     {
      var subject_name=document.getElementById("start_time_"+i+"").value;
      if(subject_name==0)
      {
         alert("Please enter lecture start timing");
         document.getElementById("start_time_"+i+"").focus();
         return false;
      }
     }
     
     if(document.getElementById("end_time_"+i+""))
     {
      var subject_name=document.getElementById("end_time_"+i+"").value;
      if(subject_name==0)
      {
         alert("Please enter lecture end timing");
         document.getElementById("end_time_"+i+"").focus();
         return false;
      }
     }
     
     
      
    }
    
    
    var table=document.getElementById("lecture_time_table");
    var row = table.insertRow(number_this);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    
    cell1.innerHTML='<input name="lecture_name[]" id="lecture_name_'+both_add+'" placeholder="Enter lecture name" class="text_box_code" type="text">';
    cell2.innerHTML='<input name="lecture_start_time[]" id="start_time_'+both_add+'" class="text_box_timeing" type="text">';
    cell3.innerHTML='<input name="lecture_end_time[]" id="end_time_'+both_add+'" class="text_box_timeing" type="text">';
    cell4.innerHTML='<input type="hidden" id="temp_break_'+both_add+'" name="text_break[]"><input name="break[]" onclick="break_check('+both_add+')"  id="break_'+both_add+'" value="yes" type="radio"><b>Is Break</b>';
    cell5.innerHTML='<input type="button" onclick="removeen(this)" class="remmove_button" value="Remove">';
    
    document.getElementById("temp_number").value=both_add;
               $(function() {
                    $('.text_box_timeing').timepicker();
                    $('.start_lunch_time').timepicker();
                    
                });
                number_this++;
                       }


function removeen(row)
{   

var r=confirm("Are you sure you want to remove");
if (r==true)
  {
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('lecture_time_table').deleteRow(i);  
    number_this--;
  }
}

function break_check(temp_no)
{
 for(var i=1;i<=number_this;i++)
 {
 if(document.getElementById("temp_break_"+i+""))
 {
   document.getElementById("temp_break_"+i+"").value="";  
 }  
 }  
 document.getElementById("temp_break_"+temp_no+"").value="yes";  
}


                       
                       </script>
                       <input type="hidden" id="temp_number" value="1">
                        <div id="time_table_pop_up_2" style=" display:none; ">
                           <div id="time_table_full_opacity" style=" display:block; "></div>
                       <div id="main_work_div_time_table" style="  display:block; ">
                           <div id="middle_work_div_time_table" style=" width:700px; margin-top:20px;  height:auto; ">
                               <div style=" background-color:white; float:left; width:100%; height:auto; padding-bottom:20px;     ">
                               <div id="first_div_top"><div onclick="close_pop_up_1()" class="close_button_style"></div></div>
                               <div id="second_div_top">
                                   <div class="time_table_title">Set Period/Lecture Timing</div>
                                   <table id="lecture_time_table" class="lecture_table">
                                       <thead>
                                           <tr class="time_th">
                                               <th>Lecture Name</th>
                                                <th>Start Timing</th>
                                                 <th>End Timing</th>
                                                  <th>Break</th>
                                                  <th>Action</th>
                                           </tr>
                                           
                                           <tr>
                                               <td><input name="lecture_name[]" id="lecture_name_1" placeholder="Enter lecture name" class="text_box_code" type="text"></td>
                                               <td><input name="lecture_start_time[]" id="start_time_1" class="text_box_timeing" type="text"><span class="text_img"></span></td>
                                               <td><input name="lecture_end_time[]" id="end_time_1" class="text_box_timeing" type="text"></td>
                                               <td><input type="hidden" id="temp_break_1" name="text_break[]"><input name="break[]" onclick="break_check('1')" id="break_1" value="yes" type="radio"><b>Is Break</b></td>
                                               <td></td>
                                           </tr>
                                         
                                       </thead>
                                       <tr>
                                           <td style=" border-bottom:0; text-align:left; ">
                                               <input type="button" onclick="add_new_line()" class="add_new_line" style=" float:left; margin-left:10px;  " value="Add New">   
                                           </td>
                                       </tr>
                                   </table>
                          
                                   <input type="submit" class="submit_button" onclick="return save_continue_button()" name="step_one_submit_button" value="Save & Continue">          
                               </div>
                           </div>
                           </div>
                       </div>
                       </div>
                       
                       
                       
                       
                          <div id="time_table_pop_up_3" style=" display:none; ">
                           <div id="time_table_full_opacity" style=" display:block; "></div>
                       <div id="main_work_div_time_table" style="  display:block; ">
                           <div id="middle_work_div_time_table" style=" width:450px; height:420px; ">
                               <div id="first_div_top"><div onclick="close_pop_up_2()" class="close_button_style"></div></div>
                               <div id="second_div_top">
                                   <div id="top_heading_contant" class="time_table_title">Assign Subject For Lecture/Period</div>
                                   <input type="hidden" name="insert_week_id" id="insert_week_id">
                                   <input type="hidden" name="insert_lecture_id" id='insert_lecture_id'>
                                   <input type="hidden" id="start_time_count">
                                   <input type="hidden" id="end_time_count">
                                   <table cellpadding="4" class="assign_table">
                                        <tr>
                           <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                       </tr>
                       <tr>
                           <td colspan="3">
                               <div class="top_one_value">
                                   <div id="day_value"></div>  <div class="verticle">|</div> 
                                   <div id="lecture_value"></div>
                               </div>    
                           </td>
                       </tr>
                                       <tr>
                                           <td><b>Subject <sup>*</sup></b></td><td><b>:</b></td>
                                           <td>
                                               <select id="subject_id" onchange="subject_ajax_request(this.value)" name="subject_id" class="select_box">
                                                   <option id="zero_1" value="0">---Select---</option>
                                                    <?php
                            if((!empty($_REQUEST['xmlclass']))&&(!empty($_REQUEST['xmlsection'])))
                            {
                            $class_id=$_REQUEST['xmlclass'];
                            $section_id=$_REQUEST['xmlsection'];       
                            ?>
                            
                         
<?php 
$subject_db=mysql_query("SELECT * FROM subject_assign_db as T1 "
        . " LEFT JOIN subject_db as T2 ON T1.subject_id=T2.subject_id WHERE $db_t1_main_details T1.class_id='$class_id' "
        . "and T1.section_id='$section_id' and T2.subject_type='theory' and T1.is_delete='none'");
$subject_num_rows=mysql_num_rows($subject_db);
if(!empty($subject_num_rows))
{
    echo "<optgroup label='Theory'>";
while ($fetch_subject_data=mysql_fetch_array($subject_db))
{
  $fecth_subject_id=$fetch_subject_data['subject_id'];
  $fetch_subject_name=$fetch_subject_data['subject_name'];
  echo "<option id='$fecth_subject_id' value='$fecth_subject_id'>$fetch_subject_name</option>"; 
}
echo '</optgroup>';
}
?>  
                            
                            
<?php 
$subject_dbs=mysql_query("SELECT * FROM subject_assign_db as T1 "
        . " LEFT JOIN subject_db as T2 ON T1.subject_id=T2.subject_id WHERE $db_t1_main_details T1.class_id='$class_id' "
        . "and T1.section_id='$section_id' and T2.subject_type='practical' and T1.is_delete='none'");
$subject_num_rowss=mysql_num_rows($subject_dbs);
if(!empty($subject_num_rowss))
{
    echo "<optgroup label='Practical/Lab'>";
while ($fetch_subject_datas=mysql_fetch_array($subject_dbs))
{
  $fecth_subject_id=$fetch_subject_datas['subject_id'];
  $fetch_subject_name=$fetch_subject_datas['subject_name'];
  echo "<option id='$fecth_subject_id' value='$fecth_subject_id'>$fetch_subject_name</option>"; 
}
echo '</optgroup>';
}
?>  
                            <?php
                            }
                            ?>
                                               </select>
                                           </td>
                                       </tr>
                                        <tr>
                                            <td><b>Teacher <sup>*</sup></b></td><td><b>:</b></td>
                                           <td>
                                               <select id="teacher_id" name="teacher_id" class="select_box">
                                                   <option id="zero_2" value="0">---Select---</option>
                                               </select>
                                           </td>
                                       </tr>
                                        <tr>
                                           <td><b>Room</b></td><td><b>:</b></td>
                                           <td>
                                               <input id="room_no" name="room_no" class="text_box" type="text">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td><b>Note</b></td><td><b>:</b></td>
                                           <td><textarea id="note" name="note" class="text_area"></textarea></td>
                                       </tr>
                                       <tr>
                                           <td colspan="3">
                                               <input type="hidden" id="temp_teachers_id">
                                               <input type="hidden" name="update_assign_subject" id="assign_subject_update_id">
                                               <input id="submit_button_value" class="submit_button" name="time_table_subject_save" onclick="return validate_form()" style=" margin-right:0; background-color:darkorange;  " type="submit" value="Save">   
                                           </td>
                                       </tr>
                                   </table>
                                   
                                   
                                   
                          </div>
                           </div>
                       </div>
                       </div>
                       <div></div>    
                       
                       
                       
                       
                       <table style="width:100%; font-size:12px;  margin:0 auto; ">
                            <tr>
                           <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                       </tr>
                       <tr>
                           <td style=" height:10px; "></td>
                       </tr>
                           <tr>
                               <td><b>Class/Course <sup style=" color:red; ">*</sup></b></td>
                               <td><b>:</b></td>
                               <td>
                                   <select id="class_course_id" name="course_id" onchange="class_id(this.value)" class="select_box_time_table" disabled>
                                       <option value="0">---Select---</option>
                                   <?php  
                                    $course_db=  mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
                          while ($fetch_course_data=mysql_fetch_array($course_db))
                          {
                              
                           if(!empty($_REQUEST['xmlclass']))
                           {
                            $get_course_name=$_REQUEST['xmlclass'];   
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
                               
                               <td><b>Section <sup style=" color:red; ">*</sup></b></td>
                               <td><b>:</b></td>
                               <td>
                                   <select id="section_name" name="section_id"  class="select_box_time_table">
                                       <option value="0">---Select---</option>
                                       <?php 
                                  if(empty($_REQUEST['xmlsection']))
                                  {
                                     
                                  }else
                                  {
                 $get_course_name=$_REQUEST['xmlclass']; 
                 $get_section_id=$_REQUEST['xmlsection'];
    $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details course_id='$get_course_name' and is_delete='none'");
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
                                   <td>
                                       <b>Time Table Name <sup>*</sup></b>
                                   </td>
                                   <td><b>:</b></td>
                                   <td>
                                  <?php
                                  if(!empty($_REQUEST['xmltimetable']))
                                  {
                                  {
                                   ?>
                                    <input type="text" id="time_table_name" name="time_table_name" class="text_box_time_table"
                                           placeholder="Please enter time table" value="<?php echo $_REQUEST['xmltimetable'];?>">    
                                       <?php
                                  }   
                                  }else
                                  {
                                  ?>     
  <input type="text" id="time_table_name" name="time_table_name" class="text_box_time_table"
         placeholder="Please enter time table">
                                   <?php
                                  }
                                   ?>
                                   </td>
                           </tr>
                       </table>   
                   </div>
                   
                   
                   
                   <div id="time_table_lacture_div">
                       <?php
                       if((!empty($_REQUEST['token_id'])))
                       {
                       $token_id=$_REQUEST['token_id'];   
                   $time_table_db=mysql_query("SELECT * FROM time_table_db WHERE $db_main_details encrypt_id='$token_id' and is_delete='none'");        
                     $time_table_data=mysql_fetch_array($time_table_db);
                     $time_table_num_rows=mysql_num_rows($time_table_db);
                     if((!empty($time_table_data))&&($time_table_data!=null)&&($time_table_num_rows!=0))
                     {
                     $time_table_unique_id=$time_table_data['time_table_id'];
                     $class_id=$time_table_data['class_id'];
                       ?>
                       <input type="hidden" name="time_table_unique_id" value="<?php echo $time_table_unique_id;?>">
                       <input type="hidden" name="insert_class_id" id='insert_class_id' value="<?php echo $class_id;?>">
                       <table  id="table_time_table_manage" style=" margin-top:10px; ">
                           <tr class="time_table_heading">
                               <td style=" width:80px; background-color:yellow; background-repeat:no-repeat; background-size:cover;   background-image:url('../images/time_table_arrow.png');  "></td>
                           <?php
                            $time_table_week_days=mysql_query("SELECT * FROM time_table_week_days_db WHERE $db_main_details"
                                   . " time_table_id='$time_table_unique_id' and is_delete='none'");
                           $total_week_days_num=mysql_num_rows($time_table_week_days)+1;
                           
                           $time_table_lecture_db=mysql_query("SELECT * FROM time_table_set_lecture_db WHERE $db_main_details"
                                   . " time_table_id='$time_table_unique_id' and is_delete='none'");
                           while ($fetch_lecture_data=mysql_fetch_array($time_table_lecture_db))
                           {
                               $lecture_name=ucwords($fetch_lecture_data['lecture_name']);
                               $start_time=$fetch_lecture_data['start_time'];
                               $end_time=$fetch_lecture_data['end_time'];        
                               $is_break=$fetch_lecture_data['is_break']; 
                               
                               
                               if($is_break=="yes")
                               {
                               echo "<td class='break_color'  style='background-color:#FFCCBA; color:black;' valign='top' rowspan='$total_week_days_num'><center>$lecture_name<br/> $start_time - $end_time</center></td>";  
                               }else
                               {
                                echo "<td valign='top'><center>$lecture_name<br/> $start_time - $end_time</center></td>";  
                                  
                               }
                           }
                           ?>
                           </tr>
                           
                           
                          <?php
                         
                           while ($week_day_data=mysql_fetch_array($time_table_week_days))
                           {
                            $week_db_id=$week_day_data['id'];  
                            $week_name=ucwords($week_day_data['week_day_name']);  
                            echo "<tr class='time_table_data_td'>    
                           <td style='padding-left:5px; background-color:whitesmoke;'><b>$week_name</b></td>";
                            $time_table_lecture_db=mysql_query("SELECT * FROM time_table_set_lecture_db WHERE $db_main_details"
                                   . " time_table_id='$time_table_unique_id' and is_delete='none'");
                           while ($fetch_lecture_data=mysql_fetch_array($time_table_lecture_db))
                           {
                              $lecture_unqiue_id=$fetch_lecture_data['id'];
                              $lecture_name=ucwords($fetch_lecture_data['lecture_name']);
                              $start_time=$fetch_lecture_data['start_time'];
                               $end_time=$fetch_lecture_data['end_time'];        
                               
                             $is_break=$fetch_lecture_data['is_break'];
                             if($is_break!="yes")
                             {
                             $assign_subject_time_tb_db=mysql_query("SELECT *,T1.id as t1_id FROM time_table_assign_subject_db as T1"
                                     . " LEFT JOIN subject_db as T2 ON T1.subject_id=T2.subject_id WHERE $db_t1_main_details "
                                     . "T1.time_table_id='$time_table_unique_id' and T1.week_day_id='$week_db_id' and T1.lecture_id='$lecture_unqiue_id' and T1.is_delete='none'");    
                             $assign_subject_data=mysql_fetch_array($assign_subject_time_tb_db);
                             $assign_subject_num_rows=mysql_num_rows($assign_subject_time_tb_db);
                             if((!empty($assign_subject_data))&&($assign_subject_data!=null)&&($assign_subject_num_rows!=0))
                             {
                              $time_table_update_db_id=$assign_subject_data['t1_id'];  
                              $time_table_assign_unique_id=$assign_subject_data['time_table_assign_subject_id'];   
                              $employee_id=$assign_subject_data['teacher_id'];  
                              $subject_id=$assign_subject_data['subject_id']; 
                              $subject_name=ucwords($assign_subject_data['subject_name']);
                              $employee_db=mysql_query("SELECT *,T1.id as db_id,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
          . " WHERE T1.employee_id='$employee_id' and T1.is_delete='none'");
              $empoyee_num_rows=mysql_num_rows($employee_db);
              $employee_data=mysql_fetch_array($employee_db);
              if((!empty($employee_data))&&($employee_data!=null)&&($empoyee_num_rows!=0))
              {
              $employee_unqiue_id=$employee_data['employee_id'];
              $emplyee_name=ucwords($employee_data['full_name']);
              $employee_no=$employee_data['employee_no'];
              
              }else
              {
             $emplyee_name="";
              }     
                    
             $room_no=$assign_subject_data['room'];  
             $note=$assign_subject_data['note'];  
                                 echo "<td><div id='delete_row_$time_table_assign_unique_id'><center><b>$subject_name</b> <br/> ( $start_time - $end_time )<br/><span style='width:100%; float:left;height:5px;'></span><b style='color:gr"
                                         . "een;'> $emplyee_name  </b> <br/>"; if(!empty($room_no)) { echo"Room No.: $room_no"; } echo"</center>"
                                         . "<div class='table_action_div'>";
                                         {
                                         ?>
                                         <div class='edit_button' 
 onclick="edit_subject('<?php echo $week_name;?>','<?php echo $lecture_name;?>','<?php echo $week_db_id;?>','<?php echo $lecture_unqiue_id;?>','<?php echo $start_time;?>','<?php echo $end_time;?>','<?php echo $time_table_update_db_id;?>','<?php echo $subject_id;?>','<?php echo $employee_id;?>','<?php echo $room_no;?>','<?php echo $note;?>')">Edit</div>
                                         <?php
                                         }
                              {
                            ?>
                           <div class='edit_button' onclick="delete_subject('<?php echo $time_table_assign_unique_id;?>')" style='float:right; color:red;'>Delete</div> 
                             <?php
                             }
                                                 echo"</div></div>";
                                                 {
                                                     ?>
                           <center><div id="show_assign_<?php echo $time_table_assign_unique_id;?>" style=" display:none; " onclick="assign_subject('<?php echo $week_name;?>','<?php echo $lecture_name;?>','<?php echo $week_db_id;?>','<?php echo $lecture_unqiue_id;?>','<?php echo $start_time;?>','<?php echo $end_time;?>')" class='assign_button'>Assign</div></center>
                           <?php
                                                 }
                                                 echo"</td>";    
                             }  else {
                                 
                           
                              ?>   
                           <td><center><div onclick="assign_subject('<?php echo $week_name;?>','<?php echo $lecture_name;?>','<?php echo $week_db_id;?>','<?php echo $lecture_unqiue_id;?>','<?php echo $start_time;?>','<?php echo $end_time;?>')" class='assign_button'>Assign</div></center></td>
                             <?php
                             }
                             }
                           } 
                            
                            
                           echo"</tr>"; 
                            
                            
                           }
                          ?>     
                          
 </table> 
                       <div class="horizental_line" style=" background-color:blue; "></div>                     
                       <input type="submit" class="submit_button"  onclick="return final_button_time()" name="final_time_table_save" style=" background-color:dodgerblue; " value="Update">
                       <input type="submit" class="submit_button" name="cancel_time_table" onclick="return cancel_button_time()" style=" background-color:red; "  value="Delete">
                       
                       
                       <?php
                       }
                       }
                       ?>
                   </div>
                 </div>      
               </div> 
        </div>
        </form>
        
          <script src="../javascript/jquery-1.7.2.min.js"></script>  
  <script type="text/javascript" src="../javascript/time_picker/jquery.timepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="../javascript/time_picker/jquery.timepicker.css" />

  <script type="text/javascript" src="../javascript/time_picker/lib/bootstrap-datepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="../javascript/time_picker/lib/bootstrap-datepicker.css" />

  <script type="text/javascript" src="../javascript/time_picker/lib/site.js"></script>
  <link rel="stylesheet" type="text/css" href="../javascript/time_picker/lib/site.css" /> 
  
  <script>
                $(function() {
                    $('.text_box_timeing').timepicker();
                    $('.start_lunch_time').timepicker();
                    
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