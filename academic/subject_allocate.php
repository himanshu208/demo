<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
     
<?php
  $message_show="";
  if(isset($_POST['submit_data_process']))
  {

date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
  

  
  if(count($_POST['class_course_id'])>0)
  {
     $class_id=$_POST['class_course_id']; 
  }else
  {
   $class_id=0;   
  }
      
    $subject_id=$_POST['subject_id'];
    if(count($_POST['employee_name'])>0)
    {
    $employee_id=$_POST['employee_name'];
    }else
    {
     $employee_id=0;   
    }
   
      $description=$_POST['description'];
      $insert_session=$_POST['use_inset_session_id'];
      
      if((!empty($class_id))&&(!empty($insert_session))&&(!empty($employee_id))&&(!empty($subject_id)))
      {
          foreach ($class_id as $insert_class_id)
          {
              
              foreach ($employee_id as $insert_employee_id)
              {
              
$result=mysql_query("SHOW TABLE STATUS LIKE 'subject_allocaton_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_subject_id="SBJCT_ALLOT_$nextId"; 
$encrypt_id=md5(md5($final_subject_id));     
                  
       $check_subject_record=mysql_query("SELECT * FROM subject_allocaton_db WHERE $db_main_details subject_allot_id='$final_subject_id' and is_delete='none'
           OR $db_main_details class_id='$insert_class_id' and subject_id='$subject_id' and employee_id='$insert_employee_id' and is_delete='none'");
       $fetch_subject_data= mysql_fetch_array($check_subject_record);
       $fetch_subject_num_rows= mysql_num_rows($check_subject_record);
      if((empty($fetch_subject_data))&&($fetch_subject_data==null)&&($fetch_subject_num_rows==0))
      {
        
          $insert_subject_db=  mysql_query("INSERT into subject_allocaton_db values('','$fetch_school_id','$fetch_branch_id'
                  ,'$insert_session','$final_subject_id','$encrypt_id','$insert_class_id','$subject_id'"
                  . ",'$insert_employee_id','$description'
                  ,'none','$date','$date_time')"); 
          
      
          
      }else
      {
          $record_exist=1;
          $message_show="<span style='color:red;'>Record already exist in database.</span>";  
      }
          }
          } 
         if(!empty($record_exist))
         {
         $message_show="<span style='color:red;'>Record already exist in database.</span>";    
         }else
         if(!empty($insert_subject_db))
         {
          $message_show="<span style='color:green;'>Record save successfully complete</span>";   
         }else
      {
          $message_show="<span style='color:red;'>Request failed,please try again</span>";  
      }
      }else
      {
          $message_show="<span style='color:red;'>Please fill all fields.</span>";  
      }
      
      
      require_once '../pop_up.php';  
      
  }   
   ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Subject Allocation</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        
<script type="text/javascript">
 function validateForm()
 {
    
 }
</script>
 <script type="text/javascript" src="../javascript/attendance_javascript.js"></script>
       
    </head>
    <body>
       <?php  include_once '../ajax_loader_page_second.php';?>
        
        
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" method="post" onsubmit="return validateForm();" enctype="multipart/form-data">
            <style>
             .attendance_select{ width:250px; }
            </style>
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                          <td><a href="academic.php">Academic</a></td>
                           <td>/</td>
                           <td><a href="subject.php">Subject</a></td>
                           <td>/</td>
                           <td>Subject Allocation</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Subject Allocation</b></div></div>
                
               <div class="main_work_data" style="">
                   <div class="left_add_work_div">
                    <div class="heading_title_td">New Subject Allotment</div>    
                      
                   
                  <table cellspacing="2" cellpadding="2" id="org_table_style" style=" font-size:12px;  float:left; ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr><td><b>Class/Course</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><select id="class_course_id" multiple name="class_course_id[]" data-placeholder="---Select multiple class---" class="chosen-select" tabindex="-1">
                                  <option value="0"></option> 
                                   
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
                    </tr>
                    <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                    <tr><td><b>Subject<sup>*</sup></b></td>
                        <td><b>:</b></td>
                        <td><select id="subject_name" name="subject_id" data-placeholder="---Select subject---" class="chosen-select" tabindex="-1">
                            <option value="0"></option>
                            <optgroup label="Theory">
<?php 
$subject_db=mysql_query("SELECT * FROM subject_db WHERE $db_main_details subject_type='theory' and is_delete='none'");
$subject_num_rows=mysql_num_rows($subject_db);
if(!empty($subject_num_rows))
{
    echo "<optgroup label='Theory'>";
while ($fetch_subject_data=mysql_fetch_array($subject_db))
{
  $fecth_subject_id=$fetch_subject_data['subject_id'];
  $fetch_subject_name=$fetch_subject_data['subject_name'];
  echo "<option value='$fecth_subject_id'>$fetch_subject_name</option>"; 
}
echo '</optgroup>';
}
?>  
                            
                            
<?php 
$subject_dbs=mysql_query("SELECT * FROM subject_db WHERE $db_main_details subject_type='practical' and is_delete='none'");
$subject_num_rowss=mysql_num_rows($subject_dbs);
if(!empty($subject_num_rowss))
{
    echo '<optgroup label="Practical/Lab">';
while ($fetch_subject_datas=mysql_fetch_array($subject_dbs))
{
  $fecth_subject_id=$fetch_subject_datas['subject_id'];
  $fetch_subject_name=$fetch_subject_datas['subject_name'];
  echo "<option value='$fecth_subject_id'>$fetch_subject_name</option>"; 
}
echo '</optgroup>';
}
?>  
                            
                               </select></td>
                    </tr>
                     <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                     <tr><td><b>Employees<sup>*</sup></b></td>
                        <td><b>:</b></td>
                        <td><select id="employee_id"  multiple  name='employee_name[]' data-placeholder="---Select multiple employees---" class="chosen-select" tabindex="-1">
                            <option value="0"></option>
                         <?php
                         $employee_db=mysql_query("SELECT * FROM hr_employee_db as T1 "
                                 . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                                 . "LEFT JOIN hr_department_db as T4 ON T1.department_id=T4.department_id WHERE $db_t1_main_without_session T1.profession_teaching='yes' and T1.is_delete='none'");
                         while ($employee_data=mysql_fetch_array($employee_db))
                         {
                          $employee_id=$employee_data['employee_id'];
                          $employee_code=$employee_data['employee_no'];
                          $employee_name=$employee_data['full_name'];
                          $department=$employee_data['department_name'];
                          
                          echo "<option value='$employee_id'>$employee_name / $employee_code / $department</option>";         
                         }
                         ?> 
                               </select>
                        </td>
                    </tr>
                    <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                    <tr>
                        <td><b>Description</b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter description" name="description" 
                                      id="address_text_area"></textarea>
                        </td>
                    </tr>
                    <tr>
                    <td style=" height:7px; "></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button" onclick="return org_validate();"
                                   id="save_button" style=" margin-right:20px; "  value="Save">   
                        </td>
                    </tr>
               </table>  
                   </div>  
                   
                   <div class="verticle_length"></div>
                   
                   
                   
                   <div class="right_fetch_work_div">
                   <div class="heading_title_td">List Of Subject Allotment</div>    
                   <table cellspacing="0" cellpadding="0" class="session_fetch_details">
                        <tr class="table_heading">
                            <td>Sl. No.</td>
                            <td>Class</td>
                             <td>Subject</td>
                              <td>Employee</td>
                              <td>Description</td>
                              <td style="border-right:1px solid gray; ">Action</td>
                        </tr>
                        
                      <?php 
                        $row=0;
                     $subject_db=mysql_query("SELECT *,T1.encrypt_id as t1_encrypt_id,T1.description as t1_description FROM subject_allocaton_db as T1 "
                             . "LEFT JOIN course_db as T2 ON T1.class_id=T2.course_id "
                             . "LEFT JOIN subject_db as T4 ON T1.subject_id=T4.subject_id WHERE $db_t1_main_details T1.is_delete='none'");   
                     while ($fetch_subject_data=mysql_fetch_array($subject_db))
                     {
                         $row++;
                                 $fetch_subject_db_id=$fetch_subject_data['id'];
                                 $fetch_subject_unique_id=$fetch_subject_data['subject_allot_id'];
                                 $encrypt_id=$fetch_subject_data['t1_encrypt_id'];
                                 $class_name=$fetch_subject_data['course_name'];
                                 $subject_name=$fetch_subject_data['subject_name'];
                                 $employee_id=$fetch_subject_data['employee_id'];
                                 $description=$fetch_subject_data['t1_description'];
                                
                                 $employee_db=mysql_query("SELECT * FROM hr_employee_db as T1"
                                          . " LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                                         . " WHERE $db_t1_main_without_session T1.employee_id='$employee_id'");
                               $employee_data=mysql_fetch_array($employee_db);
                               $employee_num_rows=mysql_num_rows($employee_db);
                               if((!empty($employee_data))&&($employee_data!=null)&&($employee_num_rows!=0))
                               {
                              $employee_name=$employee_data['full_name'];  
                              $employee_code=$employee_data['employee_no'];
                               }  else {
                                $employee_name=""; 
                                $employee_code="";
                               }
                               
                     echo "<tr id='delete_row_$fetch_subject_unique_id' class='td_data_style'>
                                   <td><b>$row</b></td> 
                                        <td>$class_name</td>
                                        <td>$subject_name</td>
                                        <td>$employee_code / $employee_name</td>
                                        <td>$description</td>
                                <td style='border-right:1px solid gray; width:130px;'>";
                                {
                            ?>
                        
                        <a style="color:blue;" href="#" onclick="window.open('edit_allot_subject.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=550,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        
                        <div onclick="delete_data('<?php  echo $fetch_subject_unique_id;?>','allocate_subject_delete_command')" class="edit_delete_button">Delete</div>
                     
                       <?php 
                        }       
                                echo"</td>
                                 </tr>";     
                                             
                                 
                                 
                                 
                                 
                     }
                       
                     if(empty($fetch_subject_db_id))
                     {
                         echo "<tr><td colspan='7' style=' border:1px solid black; height:30px; text-align:center;"
                         . "font-weight:bold; color:Red; border-top:0;'>Record no found !!</td></tr>";   
                     }
                        ?>
                        
                        
                        
                        
                   </table>
                   
                       
                   </div>
                   
                   
                   
               </div>      
              
               
               
            </div> 
        </div>
        </form>
  <link rel="stylesheet" href="../javascript/combosearch/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
    #parent_id_chosen{ width:400px; }
    #hostel_id_chosen{ width:330px; }
    #hostel_room_id_chosen{ width:330px; }
    #subject_id_chosen,#class_course_id_chosen,#section_name_chosen,#employee_id_chosen,#subject_name_chosen{ width:250px; }
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