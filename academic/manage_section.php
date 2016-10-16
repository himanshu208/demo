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
 
  $session_id=$_POST['use_inset_session_id']; 
  
  if(count($_POST['class_name'])>0)
  {
  $class_name=$_POST['class_name'];
  $section_name=$_POST['section_name'];
  $section_strength=$_POST['section_strength'];
  $section_description=$_POST['description'];
  
  if((!empty($session_id))&&(!empty($class_name))&&(!empty($section_name))&&(!empty($section_strength)))
  {
   
   $implode_class=implode(",",$class_name);
   $explode_class=explode(",",$implode_class);
   foreach($explode_class as $class_id)
   {
    
$result=mysql_query("SHOW TABLE STATUS LIKE 'section_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_section_id="SECTION_$nextId"; 
$encrypt_id=md5(md5($final_section_id));
      $section_match_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id' and section_id='$final_section_id' and is_delete='none'
          OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id' and course_id='$class_id' and section_name='$section_name' and is_delete='none'");
      $fetch_section_data_check=mysql_fetch_array($section_match_db);
      $fetch_section_num_rows_check=mysql_num_rows($section_match_db);
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
        $message_show="Record save sucessfully complete.";  
       }else
       {
        $message_show="Request failed,Please try again";     
       }
  }else
  {
      $message_show="Please fill all fields.";
  }        
   
  }else
  {
      $message_show="Please first select class";
  }
  
   require_once '../pop_up.php';   
 } 
      
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage Section</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
      
        <script type="text/javascript">
 function validateForm()
 {
   
            var school_id=document.getElementById("school_id").value;
            var branch_id=document.getElementById("branch_id").value;
            var current_session_id=document.getElementById("session_unique_id").value;
         
   
 var class_course=document.getElementById("class_id").value;
 var section_name=document.getElementById("section_name").value;
 var strength=document.getElementById("strength").value;

if(school_id==0 || branch_id==0 || current_session_id==0)
{
 alert("Sorry,Technical Problem ,Please Contact IT Team");
    return false;    
}else
 if(class_course==0)
 {
    alert("Please first select class/course");
    return false;
 }else
     if(section_name==0)
 {
    alert("Please enter section");
     document.getElementById("section_name").focus();
    return false;
 }else
     if(strength==0)
 {
    alert("Please enter section strength");
   document.getElementById("strength").focus();
    return false;
 }else
  if(isNaN(strength))
      {
         alert("Please enter only numeric value");
         document.getElementById("strength").focus();
         return false;
      }
     }
</script>

<script type="text/javascript">
function search_button()
{
 var class_course_id=document.getElementById("course_class_unique_id").value; 
 if(class_course_id==0)
 {
  alert("Please select class/course");
  return false;
 }else
 {
   document.getElementById("ajax_loader_show").style.display="block"; 
   window.location.assign("manage_section.php?token_id="+class_course_id+"");   
          
 }
  
}

function reset_button()
{
  document.getElementById("ajax_loader_show").style.display="block"; 
  window.location.assign("manage_section.php");   
      
}


</script>
<script type="text/javascript" src="../javascript/delete_javascript.js"></script>

    </head>
    <body onclick="hide_div()">
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
                           <td>Manage Section</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Manage Section</b></div></div>
                
               <div class="main_work_data" style=" float:left; ">
                   
                    <div class="left_add_work_div" style="width:37%;   ">
                    <div class="heading_title_td" style="width:96%;  margin-left:0px; ">Add New Section</div>     
               
                    <table cellspacing="8" cellpadding="4" style=" float:left; font-size:12px; ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    
                    <tr><td>Course/Class <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td>
                           <select id="class_id"  multiple  name='class_name[]' data-placeholder="---Select multiple class/course---" class="chosen-select" tabindex="-1">
                                    <option value="0"></option>
                                        <?php 
                  $course_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
                  while ($fetch_course_data=mysql_fetch_array($course_db))
{
   $fecth_course_id=$fetch_course_data['course_id'];
  $fetch_course_name=$fetch_course_data['course_name'];
  echo "<option value='$fecth_course_id'>$fetch_course_name</option>";
  
}
                                 
                                 ?>  
                                </select>
                        </td>
                    </tr>
                    <tr><td>Section <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="section_name" 
                                   placeholder="Enter section name" class="text_box_org"
                                   name="section_name"></td>
                    </tr>
                    
                     <tr>
                        <td>Description</td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter section description" name="description" 
                                      id="address_text_area"></textarea>
                        </td>
                    </tr>
                     <tr><td>Strength <sup>*</sup><br/><span style=" font-size:10px; color:red;  ">(Enter Only Numeric)</span></td>
                        <td><b>:</b></td>
                        <td><input type="text" id="strength" onkeypress="javascript:return isNumber (event)" 
                                   placeholder="Enter section strength" class="text_box_org"
                                   name="section_strength" ></td>
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
                   <div class="heading_title_td">List Of Section/Batch</div>  
                   <br/>
                   <br/>
                   <br/>
                   <fieldset class="search_tabless" style=" width:400px; margin-top:10px;  ">
                       <legend>Filter/Search</legend>
                       <table style=" margin:0 auto; font-size:12px;  ">
                           <tr>
                               <td>Class/Course</td><td><b>:</b></td>
                               <td>
                                   <select id="course_class_unique_id" class="select_combo_box">
                                       <option value="0"> --- Select Class/Course ---</option> 
                                     <?php 
                  if(!empty($_REQUEST['token_id']))
                 {
                 $token_id=$_REQUEST['token_id'];    
                 $encrypt_search="and encrypt_id='$token_id'";    
                 }else
                 {
                  $encrypt_search="";   
                  $token_id="";
                 }  
                                       
  $class_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
while ($get_class_data=mysql_fetch_array($class_db))
{
    $fetch_course_id=$get_class_data['course_id'];
    $fetch_course_name=$get_class_data['course_name'];
    $fetch_course_encrypt_id=$get_class_data['encrypt_id'];
    if($token_id==$fetch_course_encrypt_id)
    {
    echo "<option value='$fetch_course_encrypt_id' selected>$fetch_course_name</option>";
    }else
    {
        echo "<option value='$fetch_course_encrypt_id'>$fetch_course_name</option>";
    
    }
}
                                       
                                       ?>
                                   </select>
                               </td>
                               <td><input type="button" onclick="search_button()" class="search_button_css" value="Search"></td>
                               <td><input type="button" onclick="reset_button()" class="search_button_css" style=" background-color:deeppink; " value="Reset"></td>
                           </tr>
                       </table>
                   </fieldset>
                   <br/>
                   <hr/>
                   <table cellspacing="0" cellpadding="0" class="session_fetch_details">
                        <tr class="table_heading">
                            <td style=" width:7%; ">Sl. No.</td>
                            <td>Class/Course</td>
                            <td>Section</td>
                            <td>Description</td>
                            <td>Strength</td>
                            <td style="border-right:1px solid gray; ">Action</td>
                        </tr>
                        
                     <?php 
                       
               
                       
$row=0;
$course_data_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and"
          . " branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' $encrypt_search and is_delete='none'");
  while ($fetch_course_data=mysql_fetch_array($course_data_db))
  {
      
   $fetch_course_id=$fetch_course_data['course_id'];
   $fetch_course_name=$fetch_course_data['course_name'];
    
   $temp_section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$fetch_school_id' and"
          . " branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and course_id='$fetch_course_id' and is_delete='none'");
   $row_span_num=mysql_num_rows($temp_section_db);
   
   $a=0;
    $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$fetch_school_id' and"
          . " branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and course_id='$fetch_course_id' and is_delete='none'");
    while($fetch_section_data=mysql_fetch_array($section_db))
    {
             $row++;
             $fetch_section_db_id=$fetch_section_data['id'];
             $fetch_section_unique_id=$fetch_section_data['section_id'];
             $encrypt_id=$fetch_section_data['encrypt_id'];
             $fetch_section_name=$fetch_section_data['section_name'];
             $fetch_section_description=$fetch_section_data['description'];
             $fetch_section_strength=$fetch_section_data['strength'];
             

  
 



             
        echo "<tr id='delete_row_$fetch_section_unique_id' class='td_data_style'>
                                   <td><b>$row</b></td>";
if(empty($a))
{
 
    echo "<td rowspan=$row_span_num><center><b>$fetch_course_name</b></center></td>";
     
}
echo"<td>$fetch_section_name</td>
<td style='width:11%; font-size:10px;'>$fetch_section_description</td>
<td><b>$fetch_section_strength</b></td><td style=' width:130px; border-right:1px solid gray;'>";
                                {
                                    ?>
                        <abbr title="Edit Class/Course Details">
                            <a style="color:blue;" href="#" onclick="window.open('edit_section_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=490,width=620,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        </abbr>
                        
                        
                        <abbr title="Delete Class/Course">                            
                            <div onclick="delete_data('<?php  echo $fetch_section_unique_id;?>','section_delete_command')" class="edit_delete_button">Delete</div>
                       </abbr>
                        
                      <?php 
                        }       
                                echo"</td></tr>"; 
           
     
 $a++;
    }
    
   $a=0; 
    
  }                  
       
  
    if(empty($fetch_section_db_id))
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
         <link rel="stylesheet" href="../javascript/combosearch/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
    #parent_id_chosen{ width:400px; }
    #hostel_id_chosen{ width:330px; }
    #hostel_room_id_chosen{ width:330px; }
    #class_id_chosen{ width:250px; }
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