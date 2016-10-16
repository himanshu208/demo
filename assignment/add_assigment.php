<?php
//SESSION CONFIGURATION
$check_array_in="assignment";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php
$message_show="";
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
if(isset($_POST['data_submit']))
{

$title=$_POST['assignment_title'];
$description=$_POST['assignment_description'];
$date_of_submission=$_POST['submit_date'];
$assignment_attech_file=$_POST['submit_date'];
$class=$_POST['class_id'];
$section=$_POST['section_id'];
$subject=$_POST['subject_name'];
if(count($_FILES['attech_file']['name'])>0)
{
   $attach_file=count($_FILES['attech_file']['name']); 
}  else {
  $attach_file=0;  
}

            
$insert_session_id=$_POST['use_inset_session_id'];
$result=mysql_query("SHOW TABLE STATUS LIKE 'assignment_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_assign_id="ASSIGN_$nextId"; 
$encrypt_id=md5(md5($final_assign_id));
            
            if((!empty($title))&&(!empty($description))&&(!empty($date_of_submission))&&(!empty($class))
                    &&(!empty($section))&&(!empty($subject))&&(!empty($insert_session_id))&&(!empty($final_assign_id)))
            {
         $select_check_db=  mysql_query("SELECT * FROM assignment_db WHERE $db_main_details title='$title' and "
                 . "date_of_submit='$date_of_submission' and class_id='$class' and section_id='$section'"
                 . " and subject_id='$subject' and is_delete='none'");
         $select_check_num=mysql_num_rows($select_check_db);
         if($select_check_num==0)
         {
     
        $insert_db=mysql_query("INSERT into assignment_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
                . ",'$final_assign_id','$encrypt_id','$title','$description','$date_of_submission','$class'"
                . ",'$section','$subject','none','$date','$date_time','')");
        if($insert_db)
        {
           if(!empty($attach_file))
           {
             
        $filename= $_FILES['attech_file']['name'];
        $tmpfilename = $_FILES['attech_file']['tmp_name'];
        $filesize = $_FILES['attech_file']['size'];
        
        for($i=0;$i<$attach_file;$i++)
        {
        if(!empty($filename[$i]))
        {
        if(($filesize[$i]<8802400))
         {
       
        
            date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(1000, 5000);
            $location="crud_images/document/". $random . $time . $filename[$i];
            $templocation="crud_images/document/". $random . $time;
            $upload=move_uploaded_file($tmpfilename[$i],"../".$location);
           if(($upload))
           {    
         
       $location=$location;        
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
        if(!empty($location))
        {
         $insert_attech_file_db=mysql_query("INSERT into assignment_attech_file_db values('','$final_assign_id',"
                 . "'$location','$date')"); 
         if($insert_attech_file_db)
         {
             
         } 
        }
        }
         
            
         $message_show="Record save successfully complete";     
           }else
           {   
          $message_show="Record save successfully complete";  
           }
        }else
        {
         $message_show="Sorry,Request failed, Please try again.";      
        }
         }else
         {
          $message_show="Sorry,Record already exist in database.";        
         }
                
                
                
            }else
            {
            $message_show="Please fill all fields.";   
            }
            require_once '../pop_up.php';
}


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Assignment</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
         function validateForm()
         {
                   var title=document.getElementById("assignment_title").value;
                   var description=document.getElementById("assignment_description").value;
                   var date_submit=document.getElementById("submit_date").value;
                   var class_name=document.getElementById("class_name").value;
                   var section=document.getElementById("section_name").value;
                   var subject=document.getElementById("subject_id").value;
                   
                   if(title==0)
                   {
                      alert("Please enter assignment title");
                      document.getElementById("assignment_title").focus();
                      return false;
                   }else
                       if(description==0)
                   {
                      alert("Please enter description");
                      document.getElementById("assignment_description").focus();
                      return false;
                   }else
                       if(date_submit==0)
                   {
                      alert("Please enter date of submission");
                      document.getElementById("submit_date").focus();
                      return false;
                   }else
                       if(class_name==0)
                   {
                     alert("Please select class");
                     document.getElementById("class_name").focus();
                     return false;
                   }else
                       if(section==0)
                   {
                      alert("Please select section");
                      document.getElementById("section_name").focus();
                      return false;
                   }else
                      if(subject==0)
                  {
                     alert("Please select subject");
                     document.getElementById("subject_id").focus();
                     return false;
                  }
                   
              
         }
        </script>
        <script type="text/javascript" src="javascript/assignment_js.js"></script>
    </head>
    <body>
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
                           <td><a href="assignment.php">Assignment & H.W</a></td>
                           <td>/</td>
                           <td><a href="list_of_assigment.php">List of Assignment</a></td>
                           <td>/</td>
                           <td>Add Assignment</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Add Assignment</b></div>
             
              <a href="list_of_assigment.php"> <div class="view_button"  style=" margin-right:10px; background-color:dodgerblue;  ">List Of Assignment</div> </a> 
                   </div>
                
               <div class="main_work_data" style=" padding-top:20px;">
               <div id="calander_show">
               <?php
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
               ?>
                   <table cellspacing="3" cellpadding="3" class="insert_table">
                       <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                      </tr>
                      
                      
                       <tr>
                          <td><b>Assignment title<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input type="text" name="assignment_title" placeholder='Please enter assignment title'
                                      id="assignment_title"  class="text_box_styles"  autocomplete="off"> </td>
                          <td>
                          </td>
                      </tr>
                      
                      
                       <tr>
                           <td><b>Assignment Description <sup>*</sup> </b></td><td><b>:</b></td>
                          <td colspan="2">
                              <textarea name="assignment_description" placeholder='Please enter assignment description'
                                        id="assignment_description" class="text_area_styles" style=" width:450px; "></textarea>   
                          </td>
                      </tr>
                       <tr>
                          <td><b>Date of Submission <sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input type="text" name="submit_date"  id="submit_date" 
                                      class="text_box_styles" value="<?php echo $date;?>" autocomplete="off"> 
                             </td>
                      </tr>
                       <tr>
                          <td><b>Assignment File</b></td><td><b>:</b></td>
                          <td>
                              <input type="hidden" id="temp_assign_no" value="1">
                              <table id="attach_file_table">
                                  <tr>
                                      <td><input type="hidden" name="temp_attach_file[]"><input type="file" id="attach_file_1" name="attech_file[]" id="attech_file"></td><td></td>
                                  </tr>
                              </table>
                              
                             
                             
                             
                          </td>
                      </tr>
                      <tr>
                          <td colspan="3"><input type="button" onclick="add_attech_file()" class="add_attech_file" value="Add Attach File"></td>
                      </tr>
                      <tr>
                          <td><b>Class <sup>*</sup> </b></td><td><b>:</b></td>
                          <td> 
                              <select class="select_class" name="class_id" onchange="change_class_name(this.value)"
                                      id="class_name" style=" width:280px; ">
                                  <option value='0'>---Select---</option>
                                  <?php 
                               $class_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
                               while ($fetch_class_data=mysql_fetch_array($class_db))
                               {
                                $fetch_class_name=$fetch_class_data['course_name'];
                                $fetch_class_id=$fetch_class_data['course_id'];
                                
                               echo "<option value='$fetch_class_id'>$fetch_class_name</option>";
                               }
                               ?>
                         </select>
                          </td>
                      </tr>
                       <tr>
                          <td><b>Section<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> 
                              <select class="select_class" onchange="section_change(this.value)" name="section_id" id="section_name" style=" width:280px; ">
                                  <option value='0'>---Select---</option>
                                  <option value="A">A</option>
                         </select>
                          </td>
                      </tr>
                      <tr>
                          <td><b>Subject<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> 
                         <select class="select_class" name="subject_name" id="subject_id" style=" width:280px; ">
                                  <option value='0'>---Select---</option>
                                  
                         </select>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="4">
                              <div id="class_course_div"></div> 
                              
                              <div id="department_div"></div>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="3">
                              <input type="submit" name="data_submit" class="button_styling" style=" margin-right:0;  " value="Save">   
                          </td> 
                      </tr>
                      
                   </table>
                   
                   
               </div>      
               </div> 
               </div>
               </form>
        
        <div id="include_fotter_page">
       <?php 
         require_once '../fotter/fotter_page.php';
         
         ?>   
        </div>
        
<link type="text/css" rel="stylesheet" href="editor_tool/demo.css">
<link type="text/css" rel="stylesheet" href="editor_tool/jquery-te-1.4.0.css">
<script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="editor_tool/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script>
	$('#editor_tool').jqte();
	
	
</script>      
     
 <script type="text/javascript" src="../javascript/next_javascript.js"></script>
         <script type="text/javascript" src="../javascript/admission_javascript.js"></script>
         <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
         
         <script type="text/javascript">
      
$(function() {
    $("#submit_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      yearRange:'1950:2013',
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
   
});
    </script>
 
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>