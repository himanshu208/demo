<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
     
<?php     
 if(isset($_POST['submit_data_process']))
 {
  
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

     
$result=mysql_query("SHOW TABLE STATUS LIKE 'course_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_course_id="COURSE_$nextId"; 
$encrypt_id=md5(md5($final_course_id));


  $session_id=$_POST['use_inset_session_id']; 
  $class_position=$_POST['class_position'];
  $class_name=$_POST['class_name'];
  $class_full_name=$_POST['class_full_name'];
  $class_code=$_POST['class_code'];
  $class_description=$_POST['description'];
  $class_strength=$_POST['class_strength'];
  
  if((!empty($class_position))&&(!empty($class_name))&&(!empty($class_code))&&(!empty($class_strength)))
  {
   
      $course_match_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id' and course_id='$final_course_id' and is_delete='none'
          OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id' and course_name='$class_name' and is_delete='none'
              OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id' and course_code='$class_code' and is_delete='none'
              OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id' and course_position='$class_position' and is_delete='none'");
      $fetch_course_data_check=  mysql_fetch_array($course_match_db);
      $fetch_course_num_rows_check=  mysql_num_rows($course_match_db);
      if((empty($fetch_course_data_check))&&($fetch_course_data_check==null)&&($fetch_course_num_rows_check==0))
      {
       $insert_course_db=  mysql_query("INSERT into course_db values('','$fetch_school_id','$fetch_branch_id'
               ,'$session_id','$final_course_id','$encrypt_id','$class_name','$class_full_name','$class_code'
               ,'$class_description','$class_strength','$class_position'
               ,'none','$date','$date_time','$user_unique_id','active')");
       if($insert_course_db)
       {
        $message_show="<span style='color:green;'>Record save successfully complete.</span>";  
       }else
       {
        $message_show="<span style='color:red;'>Request failed,Please try again</span>";     
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
        <title>Manage Class/Course</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
         <script type="text/javascript">
 function org_validate()
 {
     var session_id=document.getElementById("insert_session_id").value;
     var position=document.getElementById("class_position").value;
     var course_name=document.getElementById("class_name").value;
     var class_code=document.getElementById("class_code").value;
     var class_strength=document.getElementById("strength").value;
     
    
     if(session_id==0)
         {
             alert("Please select session");
             document.getElementById("session_ids").focus();
             return false;
         }else
             if(position==0)
         {
             alert("Please enter course/class position");
             document.getElementById("class_position").focus();
             return false;
         }else
             if(isNaN(position))
         {
             alert("Please enter only numeric value (like : 1,2,3,4,5,6,7,8,9)");
             document.getElementById("class_position").focus();
             return false;
         }else
    if(course_name==0)
         {
             alert("Please enter course/class name");
             document.getElementById("class_name").focus();
             return false;
         }else
             if(class_code==0)
         {
             alert("Please enter course/class code");
             document.getElementById("class_code").focus();
             return false;
         }else
             if(class_strength==0)
         {
             alert("Please enter course/class strength ");
             document.getElementById("strength").focus();
             return false;
         }else
         if(isNaN(class_strength))
         {
             alert("Please enter only numeric value");
             document.getElementById("strength").focus();
             return false;
         }else
             {
                   document.getElementById("ajax_loader_show").style.display="block";    
                  
             }
             
 }
</script>

<script type="text/javascript" src="../javascript/delete_javascript.js"></script>
    </head>
    <body>
        <?php  include_once '../ajax_loader_page_second.php';?>
         
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" method="post" onsubmit="return validateForm();" enctype="multipart/form-data">
       
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="academic.php">Academic</a></td>
                           <td>/</td>
                           <td>Manage Class/Course</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Manage Class/Course</b></div>
                  </div>
                
               <div class="main_work_data" style=" padding-top:0px;  float:left; ">
                   
                   <div class="left_add_work_div" style="width:37%;   ">
               <div class="heading_title_td" style="width:96%;  margin-left:0px; ">Add New Class/Course</div>     
                
                <table cellspacing="4" cellpadding="2" id="org_table_style" style="margin:0 auto;
                         margin-top:10px;  font-size:12px;  ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr><td>Course/Class Position <sup>*</sup> <br/><span style=" font-size:10px; color:red;  ">(Enter Only Numeric Value)</span></td>
                        <td><b>:</b></td>
                        <td><input type="text" id="class_position"  onkeypress="javascript:return isNumber (event)" style=" width:30%; text-align:center; "
                                    class="text_box_org"
                                   name="class_position" ></td>
                    </tr>
                    <tr><td>Course/Class Name <sup>*</sup><br/><span style=" font-size:10px; color:red;  ">(Enter Only Alphabet)</td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="class_name" 
                                   placeholder="Enter course/class name" class="text_box_org"
                                   name="class_name"></td>
                    </tr>
                    <tr><td>Course/Class Full Name</td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="class_full_name" 
                                   placeholder="Enter course/class full name" class="text_box_org"
                                   name="class_full_name"></td>
                    </tr>
                    <tr><td>Course/Class Code<sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="class_code" 
                                   placeholder="Enter course/class code" class="text_box_org"
                                   name="class_code"></td>
                    </tr>
                     <tr>
                        <td>Description</td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter session description" name="description" 
                                      id="address_text_area"></textarea>
                        </td>
                    </tr>
                     <tr><td>Strength <sup>*</sup><br/><span style=" font-size:10px; color:red;  ">(Enter Only Numeric Value)</span></td>
                        <td><b>:</b></td>
                        <td><input type="text" id="strength"  style=" width:30%; text-align:center; "
                                   class="text_box_org" onkeypress="javascript:return isNumber (event)"
                                   name="class_strength" ></td>
                    </tr>
                    
                     <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button" onclick="return org_validate();" id="save_button"  value="Save">   
                        </td>
                    </tr>
               </table>
                   
               </div>  
                   <div class="verticle_length"></div>
                   <div class="right_fetch_work_div" style=" width:61%;   ">
                    <div class="heading_title_td">View Class/Course Details</div>    
                   <table cellspacing="0" cellpadding="0" class="session_fetch_details">
                        <tr class="table_heading">
                            <td>Sl. No.</td>
                            <td>Position</td>
                            <td>Class/Course</td>
                             <td>Full Name</td>
                              <td>Code</td>
                              <td>Description</td>
                              <td>Strength</td>
                              <td style="border-right:1px solid gray; ">Action</td>
                        </tr>
                        
                     <?php 
                       $row=0;
  $course_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and"
          . " branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and is_delete='none'"); 
 
  while ($fetch_course_data=mysql_fetch_array($course_db))
  {
      $row++;
            $fetch_course_db_id=$fetch_course_data['id'];
            $fetch_course_unique_id=$fetch_course_data['course_id'];
            $fetch_cpurse_encrypt_id=$fetch_course_data['encrypt_id'];
            $fetch_course=$fetch_course_data['course_name'];
            $fetch_course_position=$fetch_course_data['course_position'];
            $fetch_course_full_name=$fetch_course_data['class_full_name'];
            $fetch_course_code=$fetch_course_data['course_code'];
            $fetch_course_strength=$fetch_course_data['strength'];
            $fetch_course_description=$fetch_course_data['description'];
      echo "<tr id='delete_row_$fetch_course_unique_id' class='td_data_style'>
                                   <td><b>$row</b></td>
                                       <td><center><b>$fetch_course_position</b></center></td>
                                       <td>$fetch_course</td>
                                           <td style='width:11%; font-size:10px;'>$fetch_course_full_name</td>
                                           <td>$fetch_course_code</td>
                                               <td style='width:21%; font-size:10px;'>$fetch_course_description</td>
                                                   <td><center><b>$fetch_course_strength</b></center></td>
             
<td style=' width:130px; border-right:1px solid gray;'>";
                                {
                                    ?>
                        <abbr title="Edit Class/Course Details">
                            <a style="color:blue;" href="#" onclick="window.open('edit_class_course_details.php?token_id=<?php  echo $fetch_cpurse_encrypt_id;?>','size',config='height=490,width=620,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        </abbr>
                        
                        
                        <abbr title="Delete Class/Course">                            
                            <div onclick="delete_data('<?php  echo $fetch_course_unique_id;?>','course_delete_command')" class="edit_delete_button">Delete</div>
                       </abbr>
                        
                      <?php 
                        }       
                                echo"</td>
</tr>"; 
      
  }
  $fetch_course_num_rows=mysql_num_rows($course_db);
    if(empty($fetch_course_num_rows))
    {
                       
    ?>
        <tr class="empty_db_alert">
                            <td colspan="10">Sorry, Record No Found !!</td>
                        </tr>     
                      <?php 
                        }
                        ?>
                   </table>
               </div>
                   
                   
                   
                   
                  
               </div>      
              
               
               
            </div> 
        </div>
        </form>
        
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