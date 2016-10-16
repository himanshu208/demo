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
                       if((!empty($_REQUEST['token_id'])))
                       {
                       $token_id=$_REQUEST['token_id'];
            
                   $time_table_db=mysql_query("SELECT *,T1.encrypt_id as t1_encrypt_id FROM time_table_db as T1 "
                           . " LEFT JOIN course_db as T2 ON T1.class_id=T2.course_id "
                           . " LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id WHERE $db_t1_main_details "
                           . " T1.encrypt_id='$token_id' and T1.is_delete='none'");        
                     $time_table_data=mysql_fetch_array($time_table_db);
                     $time_table_num_rows=mysql_num_rows($time_table_db);
                     if((!empty($time_table_data))&&($time_table_data!=null)&&($time_table_num_rows!=0))
                     {
                     $time_table_unique_id=$time_table_data['time_table_id'];
                     $class_id=$time_table_data['class_id'];
                      $encrypt_id=$time_table_data['t1_encrypt_id'];
                     $fetch_section_id=$time_table_data['section_id'];
                     $time_table_name=$time_table_data['time_table_name'];      
                     
                     $course_name=$time_table_data['course_name'];
                     $section_name=$time_table_data['section_name'];
                      
                      
                       ?>
          <center><h2 style=" padding:0; margin:0;  "><?php echo $fetch_school_name;?></h2>
              <h5 style=" padding:0; margin:0;  "><?php echo $branch_adress;?></h5></center>
          <br/>         
          <div id="table_print_div" style=" float:left;  margin-top:0; ">
                       <div  style=" width:99%; height:auto; border:2px solid black;  float:left; margin-top:0px; ">
                           <div style=" width:20%; float:left;  "><h3 style=" margin:0; padding:0; margin-left:5%; margin-top:3px;   ">Class Timetable</h3></div>   
                           <div class="class_section_details" style=" width:75%;  background-color:white; border:0;
                                 float:right; height:auto;padding-top:0; margin-top:3px;   ">
                              | <table id="time_table_one" style=" font-size:13px; font-weight:bold;  
                                      padding-bottom:0; margin-bottom:3px; width:auto; float:right;     margin-top:0px;  ">
                                   <tr>
                                       <td><b>Class/Course</b></td>
                                       <td><b>:</b></td>
                                       <td><?php echo $course_name;?></td>
                                       <td style=" width:10%; "></td>
                                       
                                       <td><b>Section</b></td>
                                       <td><b>:</b></td>
                                       <td><?php echo $section_name;?></td>
                                       <td style=" width:10%; "></td>
                                       
                                       <td><b>Time Table</b></td>
                                       <td><b>:</b></td>
                                       <td><?php echo $time_table_name;?></td>
                                       <td style=" width:10%; "></td>
                                   </tr>   
                               </table>    
                               
                           </div></div>
                           <style>
                            #table_time_table_manage .time_table_data_td td{ font-size:8px; }   
                            #table_time_table_manage  .time_table_heading td{ font-size:10px; }
                           </style>
                       <input type="hidden" name="time_table_unique_id" value="<?php echo $time_table_unique_id;?>">
                       <input type="hidden" name="insert_class_id" id='insert_class_id' value="<?php echo $class_id;?>">
                       <table  id="table_time_table_manage" style=" margin-top:10px;">
                           <tr class="time_table_heading">
                               <td style=" height:50px;  background-color:whitesmoke; background-repeat:no-repeat; 
                                   background-image:url('../images/time_table_arrow.png'); background-size:contain;  "></td>
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
                               echo "<td class='break_color'  style='background-color:whitesmoke; height:auto; color:black;' valign='top' rowspan='$total_week_days_num'><center>$lecture_name<br/> $start_time - $end_time</center></td>";  
                               }else
                               {
                                echo "<td valign='top'  style='background-color:whitesmoke; color:black;'><center>$lecture_name<br/> $start_time - $end_time</center></td>";  
                                  
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
                             $assign_subject_time_tb_db=mysql_query("SELECT * FROM time_table_assign_subject_db as T1"
                                     . " LEFT JOIN subject_db as T2 ON T1.subject_id=T2.subject_id WHERE $db_t1_main_details "
                                     . "T1.time_table_id='$time_table_unique_id' and T1.week_day_id='$week_db_id' and T1.lecture_id='$lecture_unqiue_id' and T1.is_delete='none'");    
                             $assign_subject_data=mysql_fetch_array($assign_subject_time_tb_db);
                             $assign_subject_num_rows=mysql_num_rows($assign_subject_time_tb_db);
                             if((!empty($assign_subject_data))&&($assign_subject_data!=null)&&($assign_subject_num_rows!=0))
                             {
                              $employee_id=$assign_subject_data['teacher_id'];   
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
                                 echo "<td><center><b>$subject_name</b> <br/> ( $start_time - $end_time )<br/><span style='width:100%; float:left;height:5px;'></span><b style='color:gr"
                                         . "een;'> $emplyee_name  </b> <br/>"; if(!empty($room_no)) { echo"Room No.: $room_no"; } echo"</center></td>";    
                             }  else {
                                 
                           
                              ?>   
                           <td style=" background-color:lightgoldenrodyellow; "><center></center></td>
                             <?php
                             }
                             }
                           } 
                            
                            
                           echo"</tr>"; 
                            
                            
                           }
                          ?>     
                          
 </table> 
                       </div>
                      
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