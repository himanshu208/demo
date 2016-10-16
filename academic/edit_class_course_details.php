<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>
<?php      
  //update class course details

  if(isset($_POST['submit_data_process']))
 {
 
  $class_unique_id=$_POST['class_unique_id'];
  $session_unique_ids=$_POST['session_unique_id'];
  $class_position=$_POST['class_position'];
  $class_name=$_POST['class_name'];
  $class_full_name=$_POST['class_full_name'];
  $class_code=$_POST['class_code'];
  $class_description=$_POST['description'];
  $class_strength=$_POST['class_strength'];
  
  if((!empty($class_position))&&(!empty($class_unique_id))&&(!empty($class_name))&&(!empty($class_code))&&(!empty($class_strength)))
  {
   
      $course_match_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_unique_ids' and course_id!='$class_unique_id' and course_name='$class_name' and is_delete='none'
              OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_unique_ids' and course_id!='$class_unique_id' and course_code='$class_code' and is_delete='none'
              OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_unique_ids' and course_id!='$class_unique_id' and course_position='$class_position' and is_delete='none'");
      $fetch_course_data_check=  mysql_fetch_array($course_match_db);
      $fetch_course_num_rows_check=  mysql_num_rows($course_match_db);
      if((empty($fetch_course_data_check))&&($fetch_course_data_check==null)&&($fetch_course_num_rows_check==0))
      {   
   $update_class_db=  mysql_query("UPDATE course_db SET course_name='$class_name',class_full_name='$class_full_name',course_code='$class_code'"
           . ",description='$class_description',strength='$class_strength',course_position='$class_position' WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and course_id='$class_unique_id' and is_delete='none'");    
       if($update_class_db)
       {
        $message_show="Record Update successfully complete.";  
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
  
  require_once '../pop_up.php';
      
 }   
    
  ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
 function validateForm()
 {
     var position=document.getElementById("class_position").value;
     var course_name=document.getElementById("class_name").value;
     var class_code=document.getElementById("class_code").value;
     var class_strength=document.getElementById("strength").value;
     
    
     
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
            
    </head>
    <body>
         <?php  include_once '../ajax_loader_page_second.php';?>
        
       <form action="" method="post" name="form1" onsubmit="return validateForm();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Class/Course Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div> 
            
            
          <?php 
          if(!empty($_REQUEST['token_id']))
          {
           $token_id=$_REQUEST['token_id'];   
            $class_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' "
                    . "and encrypt_id='$token_id' and is_delete='none'");
            $fetch_course_data=mysql_fetch_array($class_db);
            $fetch_course_num_rows=mysql_num_rows($class_db);
            
            if((!empty($fetch_course_data))&&($fetch_course_data!=null)&&($fetch_course_num_rows!=0))
            {
            
            $fetch_course_db_id=$fetch_course_data['id'];
            $session_get_id=$fetch_course_data['session_id'];
            $fetch_course_unique_id=$fetch_course_data['course_id'];
            $fetch_cpurse_encrypt_id=$fetch_course_data['encrypt_id'];
            $fetch_course=$fetch_course_data['course_name'];
            $fetch_course_position=$fetch_course_data['course_position'];
            $fetch_course_full_name=$fetch_course_data['class_full_name'];
            $fetch_course_code=$fetch_course_data['course_code'];
            $fetch_course_strength=$fetch_course_data['strength'];
            $fetch_course_description=$fetch_course_data['description'];  
            
            ?>
            <input type="hidden" name="class_unique_id" value="<?php  echo $fetch_course_unique_id;?>">
            <input type="hidden" name="session_unique_id" value="<?php  echo $session_get_id;?>">
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
             <table cellspacing="4" cellpadding="2" id="org_table_style" style="margin:0 auto;
                         margin-top:10px;  font-size:12px;  ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr><td>Course/Class Position <sup>*</sup> <br/><span style=" font-size:10px; color:red;  ">(Enter Only Numeric Value)</span></td>
                        <td><b>:</b></td>
                        <td><input value="<?php  echo $fetch_course_position;?>" type="text" id="class_position"  onkeypress="javascript:return isNumber (event)" style=" width:30%; text-align:center; "
                                    class="text_box_org"
                                   name="class_position" ></td>
                    </tr>
                    <tr><td>Course/Class Name <sup>*</sup><br/><span style=" font-size:10px; color:red;  ">(Enter Only Alphabet)</td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="class_name" 
                                   value="<?php  echo $fetch_course;?>" placeholder="Enter course/class name" class="text_box_org"
                                   name="class_name"></td>
                    </tr>
                    <tr><td>Course/Class Full Name</td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="class_full_name" 
                                   value="<?php  echo $fetch_course_full_name;?>"   placeholder="Enter course/class full name" class="text_box_org"
                                   name="class_full_name"></td>
                    </tr>
                    <tr><td>Course/Class Code<sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="class_code" 
                                   value="<?php  echo $fetch_course_code;?>" placeholder="Enter course/class code" class="text_box_org"
                                   name="class_code"></td>
                    </tr>
                     <tr>
                        <td>Description</td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter session description" name="description" 
                                      id="address_text_area"><?php  echo $fetch_course_description;?></textarea>
                        </td>
                    </tr>
                     <tr><td>Strength <sup>*</sup><br/><span style=" font-size:10px; color:red;  ">(Enter Only Numeric Value)</span></td>
                        <td><b>:</b></td>
                        <td><input type="text" id="strength"  style=" width:30%; text-align:center; "
                                   value="<?php  echo $fetch_course_strength;?>" class="text_box_org" onkeypress="javascript:return isNumber (event)"
                                   name="class_strength" ></td>
                    </tr>
                    
                     <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button" onclick="return org_validate();" id="save_button"  value="Update">   
                        </td>
                    </tr>
               </table>   
            
            
            
            </div>
            </div>
            
          <?php 
          }
          }
            ?>
            <div class="edit_fotter_div_tag">Design & Develop By : Pixabyte Technologies Pvt. Ltd.</div>
            
            
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