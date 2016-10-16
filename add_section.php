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
 $course_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'"); 
 $fetch_course_data=  mysql_fetch_array($course_db);
 $fetch_course_num_rows=  mysql_num_rows($course_db);
  if((!empty($fetch_course_data))&&($fetch_course_data!=null)&&($fetch_course_num_rows!=0))   
  {  
      
      
      
      
 if(isset($_POST['submit_data_process']))
 {
  
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
    
     

     
 
  $session_id=$_POST['session_id']; 
  
  if(!empty($_POST['class_name']))
  {
   $class_name=$_POST['class_name'];
  }else
  {
   $class_name="";
  }
  $section_name=$_POST['section_name'];
  $section_strength=$_POST['section_strength'];
  $section_description=$_POST['description'];
  if((!empty($session_id))&&(!empty($class_name))&&(!empty($section_name))&&(!empty($section_strength)))
  {
   
   $implode_class=implode(",",$class_name);
   $explode_class=explode(",",$implode_class);
   foreach($explode_class as $class_id)
   {
    
 $static_id="SECTION";    
 $add_one_no=1;   
 $section_org_db=mysql_query("SELECT * FROM section_db WHERE id ORDER BY id DESC");
 $fetch_section_org_record=mysql_fetch_array($section_org_db);
 $fetch_section_num_rows=mysql_num_rows($section_org_db);
  if((!empty($fetch_section_org_record))&&($fetch_section_org_record!=null)&&($fetch_section_num_rows!=0))
  {
   $fetch_id=$fetch_section_org_record['id'];
   $add_both_values=$fetch_id+$add_one_no;
   $final_section_id=$static_id."_".$add_both_values;   
  }else
  {
   $final_section_id=$static_id."_".$add_one_no;   
  }
     $encrypt_id=md5(md5($final_section_id));
    
      $section_match_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id' and section_id='$final_section_id'
          OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id' and course_id='$class_id' and section_name='$section_name'");
      $fetch_section_data_check=  mysql_fetch_array($section_match_db);
      $fetch_section_num_rows_check=  mysql_num_rows($section_match_db);
      if((empty($fetch_section_data_check))&&($fetch_section_data_check==null)&&($fetch_section_num_rows_check==0))
      {
       $insert_section_db=  mysql_query("INSERT into section_db values('','$fetch_school_id','$fetch_branch_id'
               ,'$session_id','$class_id','$final_section_id','$encrypt_id','$section_name'
               ,'$section_description','$section_strength','none'
               ,'$date','$date_time','$user_unique_id','active')");
      
          
      }else
      {
        $message_show="Record already exist in database.";  
      }
      
   }
   
    if($insert_section_db)
       {
        $message_show="Record save successfully complete<br/>
Add new section/class please fill all field & save<br/>
<b>Other wise</b> Continue Next Page
";  
       }else
       {
        $message_show="Request failed,Please try again";     
       }
          
   
  }else
  {
      $message_show="Please fill all fields.";
  }
  
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
 function validateForm()
 {
     var session_id=document.getElementById("session_id").value;
     var class_id=document.getElementById("class_id").value;
     var section_name=document.getElementById("section_name").value;
             var strength=document.getElementById("strength").value;
             if(session_id==0)
             {
                 alert("Please select session");
                 return false;
             }else
                 if(class_id==0)
             {
                alert("Please select class/course");
                
             }else
                 if(section_name==0)
             {
                alert("Please enter section name");
                return false;
             }else
                 if(strength==0)
             {
                alert("Please enter strength");
                return false;
             }
             
 }
</script>

<script type="text/javascript">
var checkflag = "false";
function check(field) {
  if (checkflag == "false") {
    for (i = 0; i < field.length; i++) {
      field[i].checked = true;
      
    }
    checkflag = "true";
    return "Uncheck All";
  } else {
    for (i = 0; i < field.length; i++) {
      field[i].checked = false;
    }
    checkflag = "false";
    return "Check All";
  }
}    
</script>
<style>
    #class_id_chosen{ width:263px; }
</style>

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
       
         <form action="" method="post"  onsubmit="return validateForm();" enctype="multipart/form-data">
       
         <div id="main_work_div">
             <div id="main_middle_work_div">
                   <div class="forward_step">
            <table cellspacing="0" cellpadding="0" id="full_width_table">
                <tr>
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                     <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                     <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color" class="circle_div"></div></td>
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
                    <td colspan="3" class="heading_short_forward">
                   Manage Course/Class  
                    </td>
                    <td colspan="3" id="color_set_page" class="heading_short_forward">
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
                    <tr><td><b>Session</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><select id="session_ids" class="select_style" name="session_id">
                           <?php 
                             $session_db_db=  mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");
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
                    <tr><td><b>Course/Class</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td>
                          
                            
                                <select id="class_id"  multiple  name='class_name[]' data-placeholder="---Select multiple class/course---" class="chosen-select" tabindex="-1">
                                    <option value="0"></option>
                                        <?php 
                  $course_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$fetch_session_id'");
                  while ($fetch_course_data=  mysql_fetch_array($course_db))
{
   $fecth_course_id=$fetch_course_data['course_id'];
  $fetch_course_name=$fetch_course_data['course_name'];
  echo "<option value='$fecth_course_id'>$fetch_course_name</option>";
  
}
                                 
                                 ?>  
                                </select>
                        </td>
                    </tr>
                    <tr><td><b>Section</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="section_name" 
                                   placeholder="Enter section name" class="text_box_org"
                                   name="section_name"></td>
                    </tr>
                    
                     <tr>
                         <td><b>Description</b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter section description" name="description" 
                                      id="address_text_area"></textarea>
                        </td>
                    </tr>
                     <tr><td><b>Strength </b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" id="strength" 
                                   placeholder="Enter section strength" class="text_box_org"
                                   name="section_strength" ></td>
                    </tr>
                    <tr>
                        <td style=" height:10px; ">
                                
                        </td>
                    </tr>
                     <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button"  id="save_button"  value="Save">   
                        </td>
                    </tr>
               </table>
                 
                 
               <?php 
                $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$fetch_session_id'"
                        . " and is_delete='none'");
                $fetch_section_num_rows=  mysql_num_rows($section_db); 
                if($fetch_section_num_rows!=0)
                {
                    
                {
                 ?>
                 
                 
                 <div id="horizental_line"></div>
                 <table cellspacing="0" cellpadding="0" id="course_table_list">
                     <tr>
                         <td colspan="6"><b>Section List</b></td>
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
                         <td class="td_heading">Code</td>
                          <td class="td_heading">Section</td>
                           <td class="td_heading">Strength</td>
                           <td class="td_heading" style=" border-right:1px solid gray; ">Action</td>
                     </tr>
                   <?php 
                    $row=1;
while ($fetch_section_data=mysql_fetch_array($section_db))
{
  $fetch_section_name=$fetch_section_data['section_name'];
  $fetch_section_strength=$fetch_section_data['strength'];
  $fetch_course_id=$fetch_section_data['course_id'];
  $fetch_session_year_id=$fetch_section_data['session_id'];
  $fetch_section_db_id=$fetch_section_data['id'];
             $fetch_section_unique_id=$fetch_section_data['section_id'];
             $encrypt_id=$fetch_section_data['encrypt_id'];
  $fetch_course_db=  mysql_query("SELECT * FROM course_db WHERE course_id='$fetch_course_id'");
  $fetch_course_details= mysql_fetch_array($fetch_course_db);
  $fetch_course_num_rows_details=mysql_num_rows($fetch_course_db);
  if((!empty($fetch_course_details))&&($fetch_course_details!=null)&&($fetch_course_num_rows_details!=0))
  {
      $course_name=$fetch_course_details['course_name'];
      $course_code=$fetch_course_details['course_code'];
  }else
  {
  $course_name="Missing";  
  $course_code="Missing";
  }
  
  
  echo "<tr>
<td class='td_value_heading'><b>$row</b></td>  
<td class='td_value_heading'>$course_name</td>
  <td class='td_value_heading'>$course_code</td>
<td class='td_value_heading'>$fetch_section_name</td>

<td class='td_value_heading'>$fetch_section_strength</td>
<td class='td_value_heading' style=' border-right:1px solid gray; '>";
  
   {
                                    ?>
                        <abbr title="Edit Class/Course Details">
                            <a style="color:blue;" href="#" onclick="window.open('academic/edit_section_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=490,width=620,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        </abbr>
                        
                        
                        <abbr title="Delete Class/Course">                            
                            <div onclick="delete_data('<?php  echo $fetch_section_unique_id;?>','section_delete_command')" class="edit_delete_button">Delete</div>
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
                 if($fetch_section_num_rows!=0)
                {
                    
                {
                 ?>
                 <div class="next_button_show">
                 <a href="add_category.php"><input type="button" class="next_button_styling" name="next_page" value="Next">
                 </a> </div>
               <?php 
}
  }
                 ?>
                 
                 
                 
             </div>
         </div>
         </form>
        
             <link rel="stylesheet" href="javascript/combosearch/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
    #parent_id_chosen{ width:400px; }
    #hostel_id_chosen{ width:330px; }
    #hostel_room_id_chosen{ width:330px; }
    
  </style>          
  <script src="javascript/combosearch/chosen.jquery.js" type="text/javascript"></script>
  <script src="javascript/combosearch/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
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
             include_once 'superadmin/fotter_page.php';
            ?>
        </div>
    </body>
</html>
<?php 
}
}else
 {
 header("Location:add_course.php");   
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