<?php
//SESSION CONFIGURATION
$check_array_in="admission";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php

if(isset($_POST['update_button']))
{
    if(!empty($_POST['student_check']))
    {
$student_db_id=$_POST['student_check'];
    }else
    {
    $student_db_id=array();    
    }
$student_count_id=sizeof($student_db_id);
if(!empty($student_count_id))
{
$result=0;
foreach ($student_db_id as $student_id)
{
$student_photo=$_FILES["student_photo_$student_id"];
if(!empty($student_photo))
{
 $select_db=mysql_query("SELECT * FROM student_db WHERE id='$student_id' and is_delete='none'");
 $select_data=  mysql_fetch_array($select_db);
 $select_num_rows=  mysql_num_rows($select_db);
    if((!empty($select_data))&&($select_data!=null)&&($select_num_rows!=0))
    {
        $filename=$_FILES["student_photo_$student_id"]['name'];
        $tmpfilename=$_FILES["student_photo_$student_id"]['tmp_name'];
        $filesize=$_FILES["student_photo_$student_id"]['size'];
        if(!empty($filename))
        {
        if(($filesize<102400))
         {
        $imagesize=getimagesize($tmpfilename);
        if ((!empty($imagesize))) 
            {
        
            date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(1000, 5000);
            $location="crud_images/student_registration/". $random . $time . $filename;
            $templocation="crud_images/student_registration/". $random . $time;
            $upload=move_uploaded_file($tmpfilename,"../".$location);
           if(($upload))
           {    
       $update_db=mysql_query("UPDATE student_db SET student_photo='$location' WHERE id='$student_id' and is_delete='none'");  
        if((!empty($update_db))&&($update_db))
        {
         $result++;   
        }else
        {
          $result=0;  
        }
      }else
      {
      $location="";
      }
      }else 
      {
        $location="";  
      }
      }else 
      {
        $location="";  
      }
        }else
        {
        $location="";    
        }
 }
}
}   
if(!empty($result))
{
  $message_show="<span style='color:green;'>Student photo upload successfully complete</span>";    
}else
{
   $message_show="Request failed please try again.";   
}

}else
{
   $message_show="Please select atleast one student";   
}


 require_once '../pop_up.php'; 
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Missing Photo</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
           <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
      
        <script type="text/javascript">
          
            $(document).ready(function(){
                
          
              $('.student_photo').change(function(){
			var file=this.files[0];
                        var file_size_convetred=file.size/1024;
                        var set_file_limit='100';
                            if(file_size_convetred>set_file_limit)
                            {
			    alert('Photo Size Should be less then 100 Kb');
                            $('.student_photo').val('');
                            $('.student_photo').focus();
                            
                            return false;
                            }
           	}); 
                  });
        </script>
        
    </head>
    <body>
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" name="myForm" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
        
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td>Missing Photo</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Student Missing Photo</b></div>
                </div>
<script type="text/javascript">
  var loadFile = function(event,number) {
    var output = document.getElementById('output_'+number+'');
    output.src = URL.createObjectURL(event.target.files[0]);
    
     document.getElementById('student_check_'+number+'').checked=true;   
   
  };
</script> 
<script type="text/javascript">
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});

function search_buttoned()
{
 
 var class_name=document.getElementById("class_name").value;
 var section=document.getElementById("section_name").value;

 if(class_name==0)
 {
  alert("Please select class/course");
  document.getElementById("class_name").focus();
  return false;
 }else
 {
 document.getElementById("ajax_loader_show").style.display="block";   
 window.location.assign("missing_photo.php?xml_class="+class_name+"&xml_section="+section+"") 
    
 }
}
</script>
<script type="text/javascript" src="../javascript/admission_javascript.js"></script>             
               <div class="middle_left_div_tag">
                   
                  <div class="search_option" style=" border-bottom:1px solid gray; padding-bottom:10px;  ">
                        <table id="search_table">
                 <tr>
                       <td><b>Course/Class <sup>*</sup></b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="class_name" name="class_id" onchange="change_class_name(this.value)" class="select_box_style">
                               <option value="0">---Select---</option>   
                             <?php 
                              if(!empty($_REQUEST['xml_class']))
                       {
                         $token_class_id=$_REQUEST['xml_class'];  
                           
                       }else
                       {
                         $token_class_id="";  
                           
                       }
                             
                               $class_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
                               while ($fetch_class_data=mysql_fetch_array($class_db))
                               {
                                $fetch_class_name=$fetch_class_data['course_name'];
                                $fetch_class_id=$fetch_class_data['course_id'];
                                if($token_class_id==$fetch_class_id)
                                {
                               echo "<option value='$fetch_class_id' selected>$fetch_class_name</option>";
                                }else
                                {
                                 echo "<option value='$fetch_class_id'>$fetch_class_name</option>";
                                }
                               }
                               ?>
                           </select>
                       </td>
                       
                       <td style=" width:5%; "></td>
                        <td><b>Section <sup>*</sup></b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="section_name" name="section_id" class="select_box_style">
                               <option value="0">---Select---</option>  
                                <?php 
                       if(!empty($_REQUEST['xml_class']))
                       {
                         $token_class_id=$_REQUEST['xml_class'];  
                           
if(!empty($_REQUEST['xml_section']))
{
 $get_section_id=$_REQUEST['xml_section']; 
}else
{
 $get_section_id="0";   
}      

$section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details_whout_session course_id='$token_class_id' and is_delete='none'");
                               while ($fetch_section_data=mysql_fetch_array($section_db))
                               {
                                $fetch_section_name=$fetch_section_data['section_name'];
                                $fetch_section_id=$fetch_section_data['section_id'];
                                if($get_section_id==$fetch_section_id)
                                {
                               echo "<option value='$fetch_section_id' selected>$fetch_section_name</option>";
                                }else
                                {
                                 echo "<option value='$fetch_section_id'>$fetch_section_name</option>";
                                   
                                }
                               }
                       }
                               ?>
                               
                           </select>
                       </td>
                       <td><input type="button" id="search_button" onclick="search_buttoned()" style=" margin:0; margin-left:10px;  " value="Search"></td>
                   </tr>
                   
                        </table>   
                   </div>
                   
                   
                   
                   
                   <div id="new_parent">
                       
                       <table cellspacing="0" cellpadding="0" class="photo_upload_table" style=" font-size:12px; ">
                           <tr class="th_style">
                               <td><input id="selecctall" type="checkbox"></td>
                               <td><b>Sl. No.</b></td>
                               <td>Admission No.</td>
                                <td>Class-Section</td>
                               <td>Student Name</td>
                               <td>Gender</td>
                               <td>Father Name</td>
                               <td>Mobile No.</td>
                                <td>Mother Name</td>
                               <td>View Detail</td>
                               <td style=" border-right:1px solid gray; ">Upload Photo</td>
                              
                           </tr>
                           
                         <?php
                         if((!empty($_REQUEST['xml_class']))&&(!empty($_REQUEST['xml_section'])))
                         {
                             $get_class_id=$_REQUEST['xml_class'];
                             $get_section_id=$_REQUEST['xml_section'];
                         $search_result="T1.course_id='$get_class_id' and T1.section_id='$get_section_id' and";    
                         }else
                             if(!empty($_REQUEST['xml_class']))
                             {
                               $get_class_id=$_REQUEST['xml_class']; 
                               $search_result="T1.course_id='$get_class_id' and";   
                             }else
                             {
                              $search_result="";    
                             }
                         
                         
                         $row=0;
                   $student_db=mysql_query("SELECT *,T1.id as t1_db_id,T1.encrypt_id as ad_id FROM student_db as T1"
                 . " LEFT JOIN course_db as T2 ON T1.course_id=T2.course_id"
                 . " LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id "
                 . " LEFT JOIN parent_db as T6 ON T1.parent_id=T6.parent_unique_id"                 
                 . " LEFT JOIN student_personal_db as T7 ON T1.student_personal_id=T7.student_unqiue_id WHERE "
                . " $db_t1_main_details $search_result T1.is_delete='none'");
                         
                         while ($fetch_student_data=mysql_fetch_array($student_db))
                         {
       
$db_id=$fetch_student_data['t1_db_id'];
$form_sr_no=$fetch_student_data['sr_no'];

$student_roll_no=$fetch_student_data['roll_no'];       
$student_admission_date=$fetch_student_data['admission_date'];  
$enrollment_no=$fetch_student_data['enrollment_no'];  
$course_name=$fetch_student_data['course_name'];             
$section_name=$fetch_student_data['section_name'];  

    $student_full_name=$fetch_student_data['student_full_name'];
    $student_gender=ucfirst($fetch_student_data['student_gender']);
    $sub_status=ucwords($fetch_student_data['sub_status']);
    $student_photo=$fetch_student_data['student_photo'];
    
     $student_father_name=$fetch_student_data['father_name'];
    $student_father_mobile_no=$fetch_student_data['father_mobile_no'];
    
     $student_mother_name=$fetch_student_data['mother_name'];
   
     if((empty($student_photo))||(!is_file("../".$student_photo)))
     {
         $admission_no=$fetch_student_data['admission_no'];
     $row++;
                         ?>
                           
                           <tr class="td_style_student">
                               <td><input class="checkbox1" id="student_check_<?php echo $row;?>" type="checkbox" name="student_check[]" value="<?php echo $db_id;?>"></td>
                               <td><?php echo $row;?></td>
                               <td><b><?php echo $admission_no;?></b></td>
                               <td><?php echo $course_name ."-". $section_name;?></td>
                               <td><?php echo $student_full_name;?></td>
                               <td><?php echo  $student_gender;?></td>
                               <td><?php echo $student_father_name;?></td>
                               <td><?php echo $student_father_mobile_no;?></td>
                               <td><?php echo $student_mother_name;?></td>
                               <td><input type="button" class="view_full_detail_button" value="View Full Detail"></td>
                               <td style=" padding:0;  border-right:1px solid gray; ">
                                   <table>
                                       <tr>
                                           <td style=" border: 0;"><img height="70px" id="output_<?php echo $row;?>"></td>
                                           <td style=" border: 0;"><input type="file" class="student_photo" name="student_photo_<?php echo $db_id;?>" accept="image/*" onchange="loadFile(event,'<?php echo $row;?>')"></td>
                                       </tr>        
                                   </table>   
                               </td>
                              
                           </tr>
                           
                           <?php
     }
                         }
                           ?>
                           
                           <?php
                           if(empty($admission_no))
                           {
                               echo "<tr><td colspan='12' style='border:1px solid gray; height:40px; text-align:center;"
                               . "color:red; font-size:15px; border-top:0;'>Record no found !</td></tr>";    
                           }else
                           {
                           ?>
                           
                           
                           <tr>
                               <td height="10px"></td>
                           </tr>
                           <tr>
                               <td colspan="13"><input type="submit" name="update_button" class="update_button_style" value="Update"></td>
                           </tr>
                           <?php
                           }
                           ?>
                           
                       </table>   
                   </div>
                   
               </div>
                
             
                
                
               
            </div> 
        </div>
        
        
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