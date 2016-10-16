<?php 
session_start(); 
ob_start();
?>
<?php 
require_once 'connection.php';
if(isset($_SESSION['admin_session_on']))
{
$user_unique_id=$_SESSION['admin_session_on'];
$user_db=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id='$user_unique_id'");
$fetch_user_data=mysql_fetch_array($user_db);
$fetch_user_num_rows=mysql_num_rows($user_db);
if((!empty($fetch_user_data))&&($fetch_user_data!=null)&&($fetch_user_num_rows!=0))
{
  $fetch_school_id=$fetch_user_data['organization_id'];
  $fetch_branch_id=$fetch_user_data['branch_id'];
  
$organisation_db=mysql_query("SELECT * FROM organization_db  WHERE organization_id='$fetch_school_id'"); 
 $fetch_org_data=mysql_fetch_array($organisation_db);
 $fetch_org_num_rows=mysql_num_rows($organisation_db);
if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_rows!=0))
{
$fetch_school_logo=$fetch_org_data['school_logo'];
    
$branch_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");  
$fetch_branch_data=mysql_fetch_array($branch_db);
$fetch_branch_num_rows=mysql_num_rows($branch_db);
 if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
 {

  $fetch_school_name=$fetch_branch_data['branch_name'];
  
 $school_session_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");
 $fetch_school_session_data=mysql_fetch_array($school_session_db);
 $fetch_school_num_rows=mysql_num_rows($school_session_db);
  if((!empty($fetch_school_session_data))&&($fetch_school_session_data!=null)&&($fetch_school_num_rows!=0))  
  {
  
     
      
 if(isset($_POST['submit_data_process']))
 {
  
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
    
     
 $static_id="COURSE";    
 $add_one_no=1;   
 $course_org_db=mysql_query("SELECT * FROM course_db WHERE id ORDER BY id DESC");
 $fetch_course_org_record=mysql_fetch_array($course_org_db);
 $fetch_course_num_rows=mysql_num_rows($course_org_db);
  if((!empty($fetch_course_org_record))&&($fetch_course_org_record!=null)&&($fetch_course_num_rows!=0))
  {
   $fetch_id=$fetch_course_org_record['id'];
   $add_both_values=$fetch_id+$add_one_no;
   $final_course_id=$static_id."_".$add_both_values;   
  }else
  {
   $final_course_id=$static_id."_".$add_one_no;   
  }
     
  $encrypt_id=md5(md5($final_course_id));
    $session_id=$_POST['session_id']; 
  $class_position=$_POST['class_position'];
  $class_name=$_POST['class_name'];
  $class_full_name=$_POST['class_full_name'];
  $class_code=$_POST['class_code'];
  $class_description=$_POST['description'];
  $class_strength=$_POST['class_strength'];
  
  if((!empty($class_position))&&(!empty($class_name))&&(!empty($class_strength)))
  {
   
      $course_match_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id' and course_id='$final_course_id'
          OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id' and course_name='$class_name'
              OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id' and course_code='$class_code'
              OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id' and course_position='$class_position'");
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
        $message_show="Record save successfully complete<br/>
Add new course/class please fill all field & save<br/>
<b>Other wise</b> Continue Next Page
";  
       }else
       {
        $message_show="Request failed,Please try again";     
       }
          
          
      }else
      {
        $message_show="Record already exist in database.";  
      }
      
      
  }else
  {
      $message_show="Please fill all fields.";
  }
  
 }
  
 
 if(isset($_POST['next_page']))
 {
  header("Location:add_section.php");   
 }
 
 
 
{
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dashboard</title>
        <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
         <link href="stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
     <link rel="stylesheet" href="javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="javascript/calenderapi/ui/jquery.ui.widget.js"></script>

	<script src="javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="javascript/calenderapi/demos.css">
         <script type="text/javascript">
      
$(function() {
$("#from").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"images/calander.png",
      buttonImageOnly: true,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( );
      }
    });
    
    $("#to").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"images/calander.png",
      buttonImageOnly: true,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( );
      }
    });
    
    
</script>
<script type="text/javascript">
 function org_validate()
 {
     var session_id=document.getElementById("session_ids").value;
     var position=document.getElementById("class_position").value;
     var course_name=document.getElementById("class_name").value;
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
<script type="text/javascript" src="javascript/delete_javascript.js"></script>
 

    </head>
    <body>
        <?php 
include_once 'ajax_loader_page.php';
      ?>
     <div id="include_header_page">
       <?php 
            include_once 'header_page.php';
         ?>
     </div>
       
         <form action="" method="post" enctype="multipart/form-data">
       
         <div id="main_work_div">
             <div id="main_middle_work_div">
                   <div class="forward_step">
            <table cellspacing="0" cellpadding="0" id="full_width_table">
                <tr>
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                     <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color"  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                     <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                     <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                </tr>
                <tr>
                    <td colspan="3" class="heading_short_forward">
                   Manage Session Year 
                    </td>
                    <td colspan="3" id="color_set_page" class="heading_short_forward">
                   Manage Course/Class  
                    </td>
                    <td colspan="3" class="heading_short_forward">
                   Manage Section 
                    </td>
                    
                    <td colspan="3"  class="heading_short_forward">
                   Manage Category 
                    </td>
                    
                      <td colspan="3"  class="heading_short_forward">
                   Finish Page
                    </td>
                </tr>
                
                
            </table>
        </div>
               <table cellspacing="2" cellpadding="2" id="org_table_style" style=" width:50%;  float:left; ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr>
                        <td colspan="3">
                          <?php 
                            if(!empty($message_show))
                            {
                                echo "<div class='notification_alert'>$message_show</div>";    
                            }
                            ?>
                        </td>
                    </tr>
                    <tr><td><b>Session </b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><select id="session_ids" class="select_style" name="session_id">
                           <?php 
                             $session_db_db=  mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and is_delete='none'");
                             while ($fetch_session_opt_data=  mysql_fetch_array($session_db_db))
                             {
                              $fetch_session_id=$fetch_session_opt_data['session_id'];
                                 $fetch_session_name=$fetch_session_opt_data['session_name'];
                                 echo "<option value='$fetch_session_id'>$fetch_session_name</option>";
                             }
                             if(empty($fetch_session_id))
                             {
                                 echo "<option value='0'>Record no found !!</option>"; 
                             }
                             ?>   
                            </select></td>
                    </tr>
                    <tr><td><b>Course/Class Position</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" id="class_position" 
                                   placeholder="Enter course/class position" class="text_box_org"
                                   name="class_position" ></td>
                    </tr>
                    <tr><td><b>Course/Class Name</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="class_name" 
                                   placeholder="Enter course/class name" class="text_box_org"
                                   name="class_name"></td>
                    </tr>
                    <tr><td><b>Course/Class Full Name</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="class_full_name" 
                                   placeholder="Enter course/class full name" class="text_box_org"
                                   name="class_full_name"></td>
                    </tr>
                    <tr><td><b>Course/Class Code</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="class_code" 
                                   placeholder="Enter course/class code" class="text_box_org"
                                   name="class_code"></td>
                    </tr>
                     <tr>
                         <td><b>Description</b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter session description" name="description" 
                                      id="address_text_area"></textarea>
                        </td>
                    </tr>
                    <tr><td><b>Strength</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" id="strength" 
                                   placeholder="Enter course/class Max. strength" class="text_box_org"
                                   name="class_strength" ></td>
                    </tr>
                    
                     <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button" onclick="return org_validate();" id="save_button"  value="Save">   
                        </td>
                    </tr>
               </table>
                 
                 
               <?php 
                 $course_db=  mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");
                $fetch_course_num_rows=  mysql_num_rows($course_db); 
                if($fetch_course_num_rows!=0)
                {
                    
                {
                 ?>
                 
                 
                 <div id="horizental_line"></div>
                 <table cellspacing="0" cellpadding="0" id="course_table_list">
                     <tr>
                         <td colspan="6"><b> List Of Course/Class</b></td>
                     </tr>
                     <tr>
                         <td colspan="6">
                             <div class="verticle_line"></div>
                         </td>
                     </tr>
                     <tr>
                         <td style=" height:3px; "></td>
                     </tr>
                     <tr>
                         <td class="td_heading">Sl.No</td>
                         <td class="td_heading">Course/Class</td>
                         <td class="td_heading">Position</td>
                          <td class="td_heading">Code</td>
                           <td class="td_heading">Strength</td>
                           <td class="td_heading" style=" border-right:1px solid gray; ">Action</td>
                     </tr>
                   <?php 
                    $row=1;
while ($fetch_course_data=  mysql_fetch_array($course_db))
{
  $fetch_course_name=$fetch_course_data['course_name'];
  $fetch_course_code=$fetch_course_data['course_code'];
  $fetch_course_position=$fetch_course_data['course_position'];
  $fetch_course_strength=$fetch_course_data['strength'];
    $fetch_course_unique_id=$fetch_course_data['course_id'];
            $fetch_cpurse_encrypt_id=$fetch_course_data['encrypt_id'];
  
  echo "<tr>
<td class='td_value_heading'><b>$row</b></td>  
<td class='td_value_heading'>$fetch_course_name</td>
<td class='td_value_heading'>$fetch_course_position</td>
<td class='td_value_heading'>$fetch_course_code</td>
<td class='td_value_heading'>$fetch_course_strength</td>
<td class='td_value_heading' style=' border-right:1px solid gray; '>";
  {
                                    ?>
                        <abbr title="Edit Class/Course Details">
                            <a style="color:blue;" href="#" onclick="window.open('academic/edit_class_course_details.php?token_id=<?php  echo $fetch_cpurse_encrypt_id;?>','size',config='height=490,width=620,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        </abbr>
                        
                        
                        
                        
                      <?php 
                        }       
echo"</td>
</tr>";
  $row++;
}
                     ?>
                     
                     
                     
                 </table>
               <?php 
                }
                }
                 ?>
                 
               <?php 
                 if($fetch_course_num_rows!=0)
                {
                    
                {
                 ?>
                 <div class="next_button_show">
                 <input type="submit" class="next_button_styling" name="next_page" value="Next">
                 </div>
               <?php 
}
  }
                 ?>
                 
                 
                 
             </div>
         </div>
         </form>
        <div id="include_fotter_page">
          <?php 
             include_once 'superadmin/fotter_page.php';
            ?>
        </div>
    </body>
</html>
<?php 
}
}else
 {
 header("Location:add_session.php");   
 }

 }else
 {
 header("Location:loginPage.php");   
 }
 
 
 }else
{
     header("Location:loginPage.php");
}


}else
{
    header("Location:loginPage.php");
}

}else
{
     header("Location:loginPage.php");
}

?>