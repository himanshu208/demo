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
  

  
     $class_id=$_POST['class_course_id'];    
     $section_id=$_POST['section_id']; 
     if(count($_POST['subject_name'])>0)
     {
      $subject_id=$_POST['subject_name'];    
     }  else {
        $subject_id=0;  
     }
    
      $description=$_POST['description'];
      $max_mark=$_POST['max_mark'];
      $pass_mark=$_POST['pass_mark'];   
      $description=$_POST['description'];
      $insert_session=$_POST['use_inset_session_id'];
      if((!empty($class_id))&&(!empty($section_id))&&(!empty($max_mark))&&(!empty($insert_session))&&(!empty($subject_id)))
      {
          foreach ($subject_id as $insert_subject_id)
          {
$result=mysql_query("SHOW TABLE STATUS LIKE 'subject_assign_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_subject_id="SBJCT_ASSGN_$nextId"; 
$encrypt_id=md5(md5($final_subject_id));
  
              
       $check_subject_record=mysql_query("SELECT * FROM subject_assign_db WHERE $db_main_details subject_assign_id='$final_subject_id' and is_delete='none'
           OR $db_main_details class_id='$class_id' and section_id='$section_id' and subject_id='$insert_subject_id' and is_delete='none'");
       $fetch_subject_data= mysql_fetch_array($check_subject_record);
       $fetch_subject_num_rows= mysql_num_rows($check_subject_record);
      if((empty($fetch_subject_data))&&($fetch_subject_data==null)&&($fetch_subject_num_rows==0))
      {
        
          $insert_subject_db=  mysql_query("INSERT into subject_assign_db values('','$fetch_school_id','$fetch_branch_id'
                  ,'$insert_session','$final_subject_id','$encrypt_id','$class_id','$section_id','$insert_subject_id'"
                  . ",'$max_mark','$pass_mark','$description'
                  ,'none','$date','$date_time')"); 
          
      
          
      }else
      {
          $record_exist=1;
          $message_show="<span style='color:red;'>Record already exist in database.</span>";  
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
        <title>Assign Subjects</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        
<script type="text/javascript">
 function org_validate()
 {
     var class_name=document.getElementById("class_course_id").value;
     var section_name=document.getElementById("section_name").value;
     var subject_id=document.getElementById("subject_id").value;
     var max_mark=document.getElementById("max_mark").value;
     var pass_mark=document.getElementById("pass_mark").value;     
     if(class_name==0)
         {
             alert("Please select class");
             document.getElementById("class_course_id").focus();
             return false;
         } else
         if(section_name==0)
         {
             alert("Please select section");
             document.getElementById("section_name").focus();
             return false;
         } else
         if(subject_id==0)
          {
             alert("Please select subject");
             document.getElementById("subject_id").focus();
             return false;
          }else
          {
              document.getElementById("ajax_loader_show").style.display="block";    
                  
             }
             
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
                           <td>Assign Subjects</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Assign Subjects</b></div></div>
                
               <div class="main_work_data" style="">
                   <div class="left_add_work_div">
                    <div class="heading_title_td">Assign New Subjects</div>    
                      
                   
                  <table cellspacing="2" cellpadding="2" id="org_table_style" style=" font-size:12px;  float:left; ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr><td><b>Class/Course</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><select id="class_course_id" name="class_course_id" onchange="class_id(this.value)" class='attendance_select'>
                                  <option value="0">--- Select ---</option> 
                                   
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
                    <tr><td><b>Section<sup>*</sup></b></td>
                        <td><b>:</b></td>
                        <td><select id="section_name" name="section_id" class='attendance_select' >
                                        <option value="0">--- Select ---</option>
                            </select></td>
                    </tr>
                     <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                     <tr><td><b>Subjects<sup>*</sup></b></td>
                        <td><b>:</b></td>
                        <td><select id="subject_id"  multiple  name='subject_name[]' data-placeholder="---Select multiple subjects---" class="chosen-select" tabindex="-1">
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
                            
                               </select>
                        </td>
                    </tr>
                    
                     <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                     <tr><td><b>Max. Marks<sup>*</sup></b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="max_mark" 
                                  class="text_box_org"
                                  name="max_mark" value="0" style=" width:34%; text-align:center;  "></td>
                    </tr>
                    
                     <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                     <tr><td><b>Pass Marks.<sup>*</sup></b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="pass_mark" 
                                 class="text_box_org"
                                 name="pass_mark"value="0" style=" width:34%; text-align:center;  "></td>
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
                   <div class="heading_title_td">List Of Assign Subjects</div>    
                   <table cellspacing="0" cellpadding="0" class="session_fetch_details">
                        <tr class="table_heading">
                            <td>Sl. No.</td>
                            <td>Class</td>
                            <td>Section</td>
                             <td>Subject</td>
                              <td>Max. Mark</td>
                               <td>Pass Mark</td>
                              <td>Description</td>
                              <td style="border-right:1px solid gray; ">Action</td>
                        </tr>
                        
                      <?php 
                        $row=0;
                     $subject_db=mysql_query("SELECT *,T1.encrypt_id as t1_encrypt_id,T1.description as t1_description FROM subject_assign_db as T1 "
                             . "LEFT JOIN course_db as T2 ON T1.class_id=T2.course_id "
                             . "LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id "
                             . "LEFT JOIN subject_db as T4 ON T1.subject_id=T4.subject_id WHERE $db_t1_main_details T1.is_delete='none'");   
                     while ($fetch_subject_data=mysql_fetch_array($subject_db))
                     {
                         $row++;
                                 $fetch_subject_db_id=$fetch_subject_data['id'];
                                 $fetch_subject_unique_id=$fetch_subject_data['subject_assign_id'];
                                 $encrypt_id=$fetch_subject_data['t1_encrypt_id'];
                                 $class_name=$fetch_subject_data['course_name'];
                                 $section_name=$fetch_subject_data['section_name'];
                                 $subject_name=$fetch_subject_data['subject_name'];
                                 $max_marks=$fetch_subject_data['max_mark'];
                                 $pass_marks=$fetch_subject_data['pass_mark'];
                                 $description=$fetch_subject_data['t1_description'];
                                 
                     echo "<tr id='delete_row_$fetch_subject_unique_id' class='td_data_style'>
                                   <td><b>$row</b></td> 
                                        <td>$class_name</td>
                                       <td>$section_name</td>
                                            <td>$subject_name</td>
                                       <td>$max_marks</td>
                                       <td>$pass_marks</td>
                                       <td>$description</td>
                                <td style='border-right:1px solid gray; width:130px;'>";
                                {
                            ?>
                        
                        <a style="color:blue;" href="#" onclick="window.open('edit_assign_subject.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=550,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        
                        <div onclick="delete_data('<?php  echo $fetch_subject_unique_id;?>','assign_subject_delete_command')" class="edit_delete_button">Delete</div>
                     
                       <?php 
                        }       
                                echo"</td>
                                 </tr>";     
                                             
                                 
                                 
                                 
                                 
                     }
                       
                     if(empty($fetch_subject_db_id))
                     {
                         echo "<tr><td colspan='8' style=' border:1px solid black; height:30px; text-align:center;"
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
    #subject_id_chosen{ width:250px; }
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