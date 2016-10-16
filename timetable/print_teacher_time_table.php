<?php
//SESSION CONFIGURATION
$check_array_in="time_table";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script src="javascript/time_table_javascript.js"></script>   
             
    </head>
    <body onload="print_page()">
      <div id='second_work_div'> 
                     
                       
                  <?php
                      if(!empty($_REQUEST['xml_employee']))
                             {      
                          $employee_unique_id=$_REQUEST['xml_employee'];
                           $employee_db=mysql_query("SELECT *,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                      . "LEFT JOIN hr_family_db as T3 ON T1.family_id=T3.family_unique_id "
                      . "LEFT JOIN hr_department_db as T4 ON T1.department_id=T4.department_id "
                      . "LEFT JOIN hr_designation_db as T5 ON T1.designation_id=T5.designation_id "
                      . " WHERE T1.employee_id='$employee_unique_id' and T1.is_delete='none'");
                        $employee_data=mysql_fetch_array($employee_db);
                        $employee_num_rows=mysql_num_rows($employee_db);
              if((!empty($employee_data))&&($employee_data!=null)&&($employee_num_rows!=0))
              {
                  
                 $employee_unique_id=$employee_data['t1_employee_id'];
                $employee_encrypt_id=$employee_data['t1_encrypt_id'];
                $employee_no=$employee_data['employee_no'];
                $employee_name=$employee_data['full_name'];
                $employee_gender=ucwords($employee_data['gender']);
                $employee_mobile_no=$employee_data['mobile'];
                $employee_father_name=ucwords($employee_data['father_name']);
                $department=ucwords($employee_data['department_name']);
                $desgintion=ucwords($employee_data['designation_name']);       
                
                
               $week_days=array("sunday","monday","tuesday","wednesday","thursday","friday","saturday");
                         
                $employee_week_days=array();           
                $employee_assign_subject_db=mysql_query("SELECT * FROM time_table_assign_subject_db as T1"
                        . " LEFT JOIN time_table_week_days_db as T2 ON T1.week_day_id=T2.id WHERE $db_t1_main_details"
                        . " T1.teacher_id='$employee_unique_id' and T1.is_delete='none'");
                while ($employee_assign_subject_data=mysql_fetch_array($employee_assign_subject_db))
                {
                $week_days_id=$employee_assign_subject_data['week_day_id'];
                $week_days_name=$employee_assign_subject_data['week_day_name'];
               
                if(in_array($week_days_name,$employee_week_days)==false)
                {
                   
                    array_push($employee_week_days, $week_days_name);
                }
                    
                }
                
            
      
                      
                       ?>
                       
                         <center><h2 style=" padding:0; margin:0;  "><?php echo $fetch_school_name;?></h2>
              <h5 style=" padding:0; margin:0;  "><?php echo $branch_adress;?></h5></center>
          <br/>   
                       
                        <div id="table_print_div" style=" width:100%;  float:left;  margin-top:0; ">
                       <div  style=" width:99%; height:auto; border:2px solid black;  float:left; margin-top:0px; ">
                           <div style=" width:20%; float:left;  "><h3 style=" margin:0; padding:0; margin-left:5%; margin-top:3px;   ">Teacher Timetable</h3></div>   
                           <div class="class_section_details" style=" width:75%;  background-color:white; border:0;
                                 float:right; height:auto;padding-top:0; margin-top:3px;   ">
                              | <table id="time_table_one" style=" font-size:13px; font-weight:bold;  
                                      padding-bottom:0; margin-bottom:3px; width:auto; float:right;     margin-top:0px;  ">
                                   <tr>
                                       <td><b>Department</b></td>
                                       <td><b>:</b></td>
                                       <td><?php echo $department;?></td>
                                       <td style=" width:10%; "></td>
                                       
                                       <td><b>Designation</b></td>
                                       <td><b>:</b></td>
                                       <td><?php echo $desgintion;?></td>
                                       <td style=" width:10%; "></td>
                                       
                                       <td><b>Teacher</b></td>
                                       <td><b>:</b></td>
                                       <td><?php echo $employee_name;?></td>
                                       <td style=" width:10%; "></td>
                                   </tr>   
                               </table>    
                               
                           </div></div></div>
          <style>
       #table_time_table_manage tr td{ font-size:9px; }       
          </style>
                       <table  id="table_time_table_manage" style=" margin-top:10px; ">
                           <tr class="time_table_heading">
                               <td style=" width:60px; height:40px;  background-color:white; background-repeat:no-repeat; 
                                   background-image:url('../images/time_table_arrow.png'); background-size:contain;  "></td>
                           <?php
                       
                 echo "<td valign='top' colspan='20' style='background-color:whitesmoke; color:black; height:30px;'><center style='font-size:13px; PADDING-TOP:10PX;'>TEACHER LECTURES</center></td>";                   
                              
                          
                           ?>
                           </tr>
                           
                           
                          <?php
                         
                            $week_days=array("sunday","monday","tuesday","wednesday","thursday","friday","saturday");
                           foreach($week_days as $week_namee)
                           {
                        if(in_array($week_namee, $employee_week_days)==true)
                        {
                            $week_db_id=0;  
                            $temp_week_name=$week_namee;
                            $week_name=ucwords($week_namee);  
                            echo "<tr class='time_table_data_td'>    
                           <td style='padding-left:5px; background-color:whitesmoke;'><b>$week_name</b></td>";
                            
                            $employee_assign_subject_db=mysql_query("SELECT * FROM time_table_assign_subject_db as T1"
                        . " LEFT JOIN time_table_week_days_db as T2 ON T1.week_day_id=T2.id"
                       . " LEFT JOIN time_table_set_lecture_db as T3 ON T1.lecture_id=T3.id "
                         . " LEFT JOIN time_table_db as T4 ON T1.time_table_id=T4.time_table_id "
                         . " LEFT JOIN subject_db as T5 ON T1.subject_id=T5.subject_id WHERE $db_t1_main_details"
                        . " T1.teacher_id='$employee_unique_id' and T2.week_day_name='$temp_week_name' and T4.is_delete='none' ORDER BY T3.temp_start_time ASC");
                while ($employee_assign_subject_data=mysql_fetch_array($employee_assign_subject_db))
                {
                $week_days_id=$employee_assign_subject_data['week_day_id'];
                $week_days_name=$employee_assign_subject_data['week_day_name'];
               
               $start_time=$employee_assign_subject_data['start_time'];
               $end_time=$employee_assign_subject_data['end_time'];
               $subject=$employee_assign_subject_data['subject_name'];
               $room_no=$employee_assign_subject_data['room'];
               
               $time_table_id=$employee_assign_subject_data['time_table_id'];
               $time_table_db=mysql_query("SELECT * FROM time_table_db as T1 "
                       . "LEFT JOIN course_db as T2 ON T1.class_id=T2.course_id "
                       . "LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id WHERE T1.time_table_id='$time_table_id'"
                       . " and T1.is_delete='none'");
               $time_table_data=mysql_fetch_array($time_table_db);
               $time_table_num_rows=mysql_num_rows($time_table_db);
               if((!empty($time_table_data))&&($time_table_data!=null)&&($time_table_num_rows!=0))
               {
                $class_name=$time_table_data['course_name'];
                $section_name=$time_table_data['section_name'];
               }else
               {
                $class_name="";
                $section_name="";    
               }


               $lecture_name=  ucwords($employee_assign_subject_data['lecture_name']);
              
            
                                 echo "<td><center><b style='color:red; font-size:11px;'>$lecture_name</b> <br/><br/>"
                                         . "<b>$subject</b> <br/> ( $start_time - $end_time )<br/>"
                                         . "<BR/><span style='width:100%; float:left;height:5px;'></span><b style='color:gr"
                                         . "een;'> $class_name , $section_name </b> <span style='color:blue;'>"; if(!empty($room_no)) { echo"<br/><b>Room No.:</b> $room_no"; } echo"</span></center></td>";    
                            
                              ?>   
                           <td style=" background-color:lightgoldenrodyellow; display:none; "><center></center></td>
                             <?php
                      
                            
                           } 
                            
                            
                           echo"</tr>"; 
                            
                            
                           }
                           }
                          ?>     
                          
 </table> 
                       
                       <?php
                     
                   
                   }
                      }
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