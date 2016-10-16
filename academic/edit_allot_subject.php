<?php
//SESSION CONFIGURATION
$check_array_in="transport";
require_once '../config/edit_page_configuration.php';
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
  
$update_db_id=$_POST['subject_unique_id'];
    $class_id=$_POST['class_course_id'];
    $subject_id=$_POST['subject_id'];
    $employee_id=$_POST['employee_name'];
    $description=$_POST['description'];
      
      if((!empty($class_id))&&(!empty($update_db_id))&&(!empty($employee_id))&&(!empty($subject_id)))
      {
         
                  
       $check_subject_record=mysql_query("SELECT * FROM subject_allocaton_db WHERE $db_main_details"
               . " subject_allot_id!='$update_db_id' and class_id='$class_id' and subject_id='$subject_id' "
               . "and employee_id='$employee_id' and is_delete='none'");
       $fetch_subject_data= mysql_fetch_array($check_subject_record);
       $fetch_subject_num_rows= mysql_num_rows($check_subject_record);
      if((empty($fetch_subject_data))&&($fetch_subject_data==null)&&($fetch_subject_num_rows==0))
      {
     
        $update_db=mysql_query("UPDATE subject_allocaton_db SET class_id='$class_id',subject_id='$subject_id',employee_id='$employee_id',description='$description' "
                . "WHERE subject_allot_id='$update_db_id' and is_delete='none'");  
       if(!empty($update_db))
         {
          $message_show="<span style='color:green;'>Record update successfully complete</span>";   
         }else
      {
          $message_show="<span style='color:red;'>Request failed,please try again</span>";  
      }     
      
          
      }else
      {
          $message_show="<span style='color:red;'>Record already exist in database.</span>";  
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
        <title>Edit Allotment Subject Detail</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       
        
   <script type="text/javascript">
    window.onload = refreshParent;
    function refreshParent() {
     window.opener.location.reload();
    }
   
   function close_pop_up_this()
   {
   window.close();    
   }
   
</script>


<script type="text/javascript">
            function ok_close()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
             function close_button()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
   document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) 
    {
       document.getElementById("win_pop_up").style.display="none";
    }else
    if (evt.keyCode == 13) 
    {
    document.getElementById("win_pop_up").style.display="none";
    }
};
            
</script>
            
<script type="text/javascript">
 function org_validate()
 {
     var subject_name=document.getElementById("subject_name").value;
     var subject_code=document.getElementById("section_code").value;
     if(subject_name==0)
         {
             alert("Please enter subject name");
             document.getElementById("subject_name").focus();
             return false;
         } else
         if(subject_code==0)
         {
             alert("Please enter subject code");
             document.getElementById("section_code").focus();
             return false;
         } else
          {
              document.getElementById("ajax_loader_show").style.display="block";    
                  
             }
             
 }
</script>
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validateForm();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Allotment Subject Detail</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div> 
          <?php 
            if(!empty($_REQUEST['token_id']))
            {
            $token_id=$_REQUEST['token_id'];
   
$subject_db=mysql_query("SELECT * FROM subject_allocaton_db WHERE $db_main_details encrypt_id='$token_id' and is_delete='none'");
$fetch_subject_data= mysql_fetch_array($subject_db);
$fetch_subject_num_rows=mysql_num_rows($subject_db);
if((!empty($fetch_subject_data))&&($fetch_subject_data!=null)&&($fetch_subject_num_rows!=0))
{

                                $fetch_subject_db_id=$fetch_subject_data['id'];
                                 $fetch_subject_unique_id=$fetch_subject_data['subject_allot_id'];
                                 $encrypt_id=$fetch_subject_data['encrypt_id'];
                                 $class_name=$fetch_subject_data['class_id'];
                                 $subject_name=$fetch_subject_data['subject_id'];
                                 $employee_ids=$fetch_subject_data['employee_id'];
                                 $description=$fetch_subject_data['description'];
?>
            
            <input type="hidden" name="subject_unique_id" value="<?php  echo $fetch_subject_unique_id;?>">
            <div class="edit_main_work_div">
                <div class="edit_center_div_tag">
                  <table cellspacing="2" cellpadding="2" id="org_table_style" style=" font-size:12px; width:auto; margin:auto;  ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr><td><b>Class/Course</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><select id="class_course_id" name="class_course_id" data-placeholder="---Select class---" class="chosen-select" tabindex="-1">
                                  <option value="0"></option> 
                                   
                                 <?php  
                         $course_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
                          while ($fetch_course_data=mysql_fetch_array($course_db))
                          {
                             
                           $fetch_course_name=$fetch_course_data['course_name']; 
                           $fetch_course_id=$fetch_course_data['course_id']; 
                           
                           if($class_name==$fetch_course_id)
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
  if($subject_name==$fecth_subject_id)
  {
  echo "<option value='$fecth_subject_id' selected>$fetch_subject_name</option>"; 
  }  else {
     echo "<option value='$fecth_subject_id'>$fetch_subject_name</option>"; 
   
  }
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
  if($subject_name==$fecth_subject_id)
  {
  echo "<option value='$fecth_subject_id' selected>$fetch_subject_name</option>"; 
  }else
  {
  echo "<option value='$fecth_subject_id'>$fetch_subject_name</option>"; 
      
  }
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
                        <td><select id="employee_id" name='employee_name' data-placeholder="---Select employee---" class="chosen-select" tabindex="-1">
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
                          if($employee_id==$employee_ids)
                          {
                          echo "<option value='$employee_id' selected>$employee_name / $employee_code / $department</option>";         
                          }else
                          {
                          echo "<option value='$employee_id'>$employee_name / $employee_code / $department</option>";         
                              
                          }
                          
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
                                      id="address_text_area"><?php echo $description;?></textarea>
                        </td>
                    </tr>
                    <tr>
                    <td style=" height:7px; "></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button" onclick="return org_validate();"
                                   id="save_button" style=" margin-right:0px; "  value="Update">   
                        </td>
                    </tr>
               </table> 
            
            
            </div>
            </div>
          <?php 
            }
            }
            ?>
            <div class="edit_fotter_div_tag">Design & Develop By : DIGI SHIKSHA</div>
            <link rel="stylesheet" href="../javascript/combosearch/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
    #parent_id_chosen{ width:400px; }
    #hostel_id_chosen{ width:330px; }
    #hostel_room_id_chosen{ width:330px; }
    #subject_id_chosen{ width:250px; }
     #subject_id_chosen,#class_course_id_chosen,#section_name_chosen,#employee_id_chosen,#subject_name_chosen{ width:250px; }

  </style>       
   <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
       
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
            
        </div>
       </form>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>