
      <?php 
        require_once '../connection.php';
        if((!empty($_REQUEST['course_id']))&&(!empty($_REQUEST['section_id']))
                &&(!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id'])))
        {
           $course_id=$_REQUEST['course_id'];
           $section_id=$_REQUEST['section_id'];
           $org_id=$_REQUEST['org_id'];
           $branch_id=$_REQUEST['branch_id'];
           $session_id=$_REQUEST['session_id'];
           
            
            
            
                   $time_table_db=mysql_query("SELECT * FROM time_table_db WHERE organization_id='$org_id'"
                           . "and branch_id='$branch_id' and session_id='$session_id'"
                           . "and class_id='$course_id' and section_id='$section_id' and is_delete='none' and action='active'");
                  $fetch_time_table_data=  mysql_fetch_array($time_table_db);
                  $fetch_time_table_num_rows=  mysql_num_rows($time_table_db);
                  if((!empty($fetch_time_table_data))&&($fetch_time_table_data!=null)&&($fetch_time_table_num_rows!=0))
                  {
                  {?>

<div id='top_class_section'>
                           <div class='class_section_name'>
                               <table style=" width:auto; margin:0 auto; padding-top:10px; color:black;      ">
                                   <tr>
                                       <td><b>Class/Course</b></td>
                                       <td><b>:</b></td>
                                       <td>NUS</td>
                                       <td style=" width:40px; "></td>
                                       <td><b>Section</b></td>
                                       <td><b>:</b></td>
                                       <td>A</td>
                                   </tr>
                               </table>  
                           </div>  
                       </div>
                       
                       <div class='top_button_show'>
                           <div class='time_table_button'>Edit</div> 
                           <div class='time_table_button' style="background-color:red; ">Delete</div> 
                           
                           <div class='time_table_buttons'>Print</div>
                           <div class='time_table_buttons' style=" background-color:maroon; ">Pdf</div>
                           <div class='time_table_buttons' style=" background-color:darkseagreen; ">Excel</div>
                           <div class='time_table_buttons' style=" background-color:orange; ">CVC</div>
                           
                       </div>    
                       
                    
                   <table class='view_time_table'>
                <?php 
                  }
                      
                  $fetch_no_of_week_days=$fetch_time_table_data['working_days'];
                  $explode_week_days=explode(",",$fetch_no_of_week_days);
                  
                  $fetch_no_of_lecture=$fetch_time_table_data['no_of_lecture'];
                   
                  $fetch_subject_list=unserialize($fetch_time_table_data['subject_id']);
                  $fetch_teachers_list=unserialize($fetch_time_table_data['teacher_id']);
                  $fetch_lecture_start_time=unserialize($fetch_time_table_data['start_time']);
                  $fetch_lecture_end_time=unserialize($fetch_time_table_data['end_time']);
                  $fetch_room_list=unserialize($fetch_time_table_data['room']);
                  
                  
                  $fecth_lunch_option=$fetch_time_table_data['lunch_option'];
                  $fetch_after_lecture_lunch=$fetch_time_table_data['after_period'];
                  $fecth_lunch_start_time=$fetch_time_table_data['lunch_start_time'];
                  $fecth_lunch_end_time=$fetch_time_table_data['lunch_end_time'];
                  
                   
                  echo "<tr><td class='view_th_style' style='width:40px;'>LECT.</td>";
                  
                  for($x=1;$x<=7;$x++)
                  {
                    $days_name=$explode_week_days[$x];  
                      echo "<td class='view_th_style'>$days_name</td>"; 
                      
                  }
                  echo "</tr>";
                  
                  
                  for($period_no=1;$period_no<=$fetch_no_of_lecture;$period_no++)
                  {
                      if(($fecth_lunch_option=="yes"))
                      {
                      
                      if((!empty($fetch_after_lecture_lunch))&&(!empty($fecth_lunch_start_time))&&(!empty($fecth_lunch_end_time)))    
                      {
                          
                          $after_period_no=$fetch_after_lecture_lunch+1;
                          if($after_period_no==$period_no)
                          {
                          echo "<tr><td colspan='8' class='view_lunch_td' >LUNCH ( Start Time - ".strtoupper($fecth_lunch_start_time)."   End Time -  ".strtoupper($fecth_lunch_end_time)." )</td></tr>";
                          }
                      }  
                          
                      }
                      
                      
                      echo "<tr><td class='subject_td_style'><b>$period_no</b></td>";   
                      for($x=1;$x<=7;$x++)
                  {
                    
                    $days_name=$explode_week_days[$x];  
                    
                    $subject_details=$fetch_subject_list[$period_no];
                    $subject_name=$subject_details[$days_name];
                    
                    $teacher_details=$fetch_teachers_list[$period_no];
                    $teachers_name=$teacher_details[$days_name];
                    
                    
                    $start_time_details=$fetch_lecture_start_time[$period_no];
                    $start_time=$start_time_details[$days_name];
                    
                            
                    $end_time_details=$fetch_lecture_end_time[$period_no];
                    $end_time=$end_time_details[$days_name];
                            
                            
                    $room_details=$fetch_room_list[$period_no];
                    $room=$room_details[$days_name];
                    
                    echo "<td class='subject_td_style'>
<center><table cellspacing=6 cellpadding=0 style='font-size:11px;'> 
<tr><td><b>Subject</b></td><td><b>:</b></td><td>$subject_name</td></tr>
<tr><td><b>Teacher</b></td><td><b>:</b></td><td>$teachers_name</td></tr>
<tr><td  colspan='3'>
<table cellspacing=0 cellpadding=0 style='font-size:11px;'>
<tr><td><b>Start</b></td><td><b>:</b></td><td>$start_time</td><td style='width:5px;'></td>
<td><b>End</b></td><td><b>:</b></td><td>$end_time</td>    
</tr>
</table>
</td></tr>
<tr><td><b>Room</b></td><td><b>:</b></td><td>$room</td></tr>
</table> </center>                       

                    </td>"; 
                      
                  }
                      
                      
                      
                      echo "</tr>";
                  }
                  
                  
                  
                  }
                  
                   ?>
                       </table>

<?php 
        }
?>