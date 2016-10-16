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
        <script type="text/javascript">
        function show_full_time_table()
        {
        var class_id=document.getElementById("class_course_id").value;
        var section_id=document.getElementById("section_name").value;  
        if(class_id==0)
        {
          alert("Please select class/course");
          document.getElementById("class_course_id").focus();
          return false;
        }else
            if(section_id==0)
        {
           alert("Please select section");
           document.getElementById("section_name").focus();
           return false;
       }
        else
        {
          document.getElementById("ajax_loader_show").style.display="block";    
                      
        window.location.assign("view_full_time_table.php?Xmlhtppclass="+class_id+"&Xmlhttpsection="+section_id+"");
        }
    }
    
    function reset_button()
    {
         document.getElementById("ajax_loader_show").style.display="block";    
     window.location.assign("view_full_time_table.php");   
    }
    
        </script>    
    </head>
    <body>
       <?php 
      include_once '../ajax_loader_page_second.php';
      ?> 
        
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="time_table_dashboard.php">Time Table</a></td>
                           <td>/</td>
                           <td>Time Table Report</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button"><div id="transport_function" class="Short_menu_show"><b>Time Table Report</b></div></div>
                
                    
               <div class="main_work_data" style=" padding-top:20px;">
               
                   <div id='time_table_style'>
                     
                       <table style="width:auto; font-size:12px;  margin:0 auto; ">
                            <tr>
                           <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                       </tr>
                       <tr>
                           <td style=" height:10px; ">
                               <input type="hidden" value="<?php  echo $fetch_school_id;?>" id="organization_id">  
                               <input type="hidden" value="<?php  echo $fetch_branch_unique_db_id;?>" id="branch_id">
                               <input type="hidden" value="<?php  echo $fecth_session_id_set;?>" id="session_id">
                           </td>
                       </tr>
                           <tr>
                               <td><b>Class/Course <sup style=" color:red; ">*</sup></b></td>
                               <td><b>:</b></td>
                               <td>
                                   <select id="class_course_id" onchange="class_id(this.value)" class="select_box_time_table">
                                       <option value="0">---Select---</option>
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
                                   <td style=" width:30px; "></td>
                               <td><b>Section <sup style=" color:red; ">*</sup></b></td>
                               <td><b>:</b></td>
                               <td>
                                   <select id="section_name" class="select_box_time_table">
                                      
                                       <?php 
                                  if(empty($_REQUEST['Xmlhttpsection']))
                                  {
                                      echo "<option>---Select---</option>";   
                                  }else
                                  {
                                     
                                echo "<option>---Select---</option>";          
                 $get_course_name=$_REQUEST['Xmlhtppclass']; 
                 $get_section_id=$_REQUEST['Xmlhttpsection'];
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
                                        <td style=" width:30px; "></td>
                               <td>
                                   <input class="button_style_ing" onclick="reset_button()" style=" background-color: deeppink; margin-left:10px; " type="button" value="Reset">
                                   <input class="button_style_ing" onclick="show_full_time_table()" type="button" value="Show Time Table">
                                   
                               </td>
                           </tr>
                       </table>     
                   </div>
                   
                   
                   
                   <div id='second_work_div'> 
                    
            <div class="top_button_div">
         <div class="header_top_button" onclick="PrintDiv('List Of Student')" style=" background-color:green; ">Print</div>
               
                   
               </div>  
                       
                   <?php
                       if((!empty($_REQUEST['Xmlhtppclass']))&&(!empty($_REQUEST['Xmlhttpsection'])))
                       {
                      $get_class_id=$_REQUEST['Xmlhtppclass'];
                      $search_class="course_id='$get_class_id' and ";
                      
                      $get_section_id=$_REQUEST['Xmlhttpsection'];
                      $search_section=" and section_id='$get_section_id' ";
                      
                      
                      
                       }else
                       {
                        $search_class=""; 
                        $search_section="";
                       }
                           
                   $course_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details $search_class is_delete='none'");        
                   while ($course_data=mysql_fetch_array($course_db))
                   {
                   $class_id=$course_data['course_id']; 
                   $class_name=$course_data['course_name']; 
                   $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details course_id='$class_id' $search_section and is_delete='none'");  
                   while ($section_data=mysql_fetch_array($section_db))
                   {
                    
                  $section_id=$section_data['section_id'];
                  $section_name=$section_data['section_name'];
                     
                  
                  
                  
                  
                     
                   $time_table_db=mysql_query("SELECT * FROM time_table_db as T1 "
                           . " LEFT JOIN course_db as T2 ON T1.class_id=T2.course_id "
                           . " LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id WHERE $db_t1_main_details "
                           . " T1.class_id='$class_id' "
                           . " and T1.section_id='$section_id' and T1.is_delete='none'");        
                     $time_table_num_rows=mysql_num_rows($time_table_db);
                      while ($time_table_data=mysql_fetch_array($time_table_db))     
                         {   
                     $time_table_unique_id=$time_table_data['time_table_id'];
                     $class_id=$time_table_data['class_id'];
                     $fetch_section_id=$time_table_data['section_id'];
                     $time_table_name=$time_table_data['time_table_name'];      
                     
                     $course_name=$time_table_data['course_name'];
                     $section_name=$time_table_data['section_name'];
                      
                      
                       ?>
                       
                       
                       
                       <div style=" width:100%; height:auto; float:left; margin-top:10px;    ">
                           <div class="class_section_details">
                               <table id="time_table_one">
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
                       
                       <input type="hidden" name="time_table_unique_id" value="<?php echo $time_table_unique_id;?>">
                       <input type="hidden" name="insert_class_id" id='insert_class_id' value="<?php echo $class_id;?>">
                       <table  id="table_time_table_manage" style=" margin-top:10px; ">
                           <tr class="time_table_heading">
                               <td style=" width:80px; background-color:aliceblue; background-repeat:no-repeat; 
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
                       <div class="horizental_line" style=" background-color:blue; "></div>
                       <?php
                       }
                       }
                            
                   }
                   
                       ?>
                       
                   </div>
                   
                   
               </div>
              
            </div> 
        </div>
        
        <div style=" width:100px; height:30px; float: left;  "></div>
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