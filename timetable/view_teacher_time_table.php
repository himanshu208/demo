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
        <title>View Teachers Time Table</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       <script src="javascript/time_table_javascript.js"></script>   
          <script type="text/javascript">
              function employee_normal_search_record()
              {
              var department=document.getElementById("department_id").value;
              var designation=document.getElementById("designation_id").value;
              var employee_id=document.getElementById("employee_id").value;
              
              if(department==0 && designation==0 && employee_id==0)
              {
                 alert("Please select atleast one option");
                 return false;
              }else
              {
              window.location.assign("view_teacher_time_table.php?xml_serch_type=normal&xml_department="+department+"&xml_designation="+designation+"&xml_employee="+employee_id+""); 
              }
               }
            </script>
    </head>
    <body>
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
                           <td>View Teachers Time Table</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>View Teachers Time Table</b></div>
                </div>
                 
                
               <div class="middle_left_div_tag">
                    <div id="normal_search_id" > 
                        <table class="search_table" style=" margin-top:20px; margin-bottom: 20px; ">
                       <tr>
                           <td><b>Department </b></td>
                           <td><b>:</b></td>
                           <td>
 <select onchange="department(this.value)" id="department_id" class="select_search_style">
     <option id="zero_class" value="0">-- Select --</option>
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
                           <td><select onchange="designation(this.value)" id="designation_id" class="select_search_style">
                                   <option id="zero_seztion" value="0">-- Select --</option>
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
                                   <select id="employee_id" data-placeholder="---Select---" class="chosen-select" tabindex="-1">
                                   <option></option>
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
                           </td>
                       </tr>
                   </table>
                   </div>    
                   
                   <div class="horizental_lines"></div>
                     <div id='second_work_div'> 
                    
            <div class="top_button_div">
                
               
                   
               </div> 
                
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
                 
              {
                 ?>
                     <a href="#" onclick="window.open('print_teacher_time_table.php?xml_employee=<?php echo $employee_unique_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                                 
                         <div class="header_top_button" style=" background-color:green; ">Print</div></a>
               
                         <?php
              }
                  
                  
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
                       
                       
                       
                       <div style=" width:100%; height:auto; float:left; margin-top:10px;    ">
                           <div class="class_section_details">
                               <table id="time_table_one">
                                   <tr>
                                       <td><b>Department</b></td>
                                       <td><b>:</b></td>
                                       <td><?php echo $department;?></td>
                                       <td style=" width:10%; "></td>
                                       
                                       <td><b>Designation</b></td>
                                       <td><b>:</b></td>
                                       <td><?php echo $desgintion;?></td>
                                       <td style=" width:10%; "></td>
                                       
                                       <td><b>Employee</b></td>
                                       <td><b>:</b></td>
                                       <td><?php echo $employee_name;?></td>
                                       <td style=" width:10%; "></td>
                                   </tr>   
                               </table>    
                               
                           </div></div>
                       
                       <table  id="table_time_table_manage" style=" margin-top:10px; ">
                           <tr class="time_table_heading">
                               <td style=" width:80px; background-color:aliceblue; background-repeat:no-repeat; 
                                   background-image:url('../images/time_table_arrow.png'); background-size:contain;  "></td>
                           <?php
                       
                 echo "<td valign='top' colspan='20'><center style='font-size:16px; PADDING-TOP:10PX;'>TEACHER LECTURES</center></td>";                   
                              
                          
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
              
            
                                 echo "<td><center><b style='color:red; font-size:15px;'>$lecture_name</b> <br/><br/>"
                                         . "<b>$subject</b> <br/> ($start_time - $end_time)<br/>"
                                         . "<BR/><span style='width:100%; float:left;height:5px;'></span><b style='color:gr"
                                         . "een;'>$class_name , $section_name</b> <br/><BR/><span style='color:blue;'>"; if(!empty($room_no)) { echo"<b>Room No.:</b> $room_no"; } echo"</span></center><BR/></td>";    
                            
                              ?>   
                           <td style=" background-color:lightgoldenrodyellow; display:none; "><center></center></td>
                             <?php
                      
                            
                           } 
                            
                            
                           echo"</tr>"; 
                            
                            
                           }
                           }
                          ?>     
                          
 </table> 
                       <div class="horizental_line" style=" background-color:blue; "></div>
                       <?php
                     
                   
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