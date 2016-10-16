<?php
//SESSION CONFIGURATION
$check_array_in="assignment";
require_once '../config/edit_page_configuration.php';
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

$title=$_POST['notes_title'];
$description=$_POST['notes_description'];
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
$final_assign_id=$_POST['update_unique_id']; 

            
            if((!empty($title))&&(!empty($description))&&(!empty($class))
                    &&(!empty($section))&&(!empty($subject))&&(!empty($insert_session_id))&&(!empty($final_assign_id)))
            {
         $select_check_db=  mysql_query("SELECT * FROM notes_db WHERE $db_main_details notes_id!='$final_assign_id' and title='$title' and "
                 . " class_id='$class' and section_id='$section'"
                 . " and subject_id='$subject' and is_delete='none'");
         $select_check_num=mysql_num_rows($select_check_db);
         if($select_check_num==0)
         {
     
        
        $update_db=mysql_query("UPDATE notes_db SET title='$title',description='$description',"
                . "class_id='$class',section_id='$section',subject_id='$subject' "
                . "WHERE notes_id='$final_assign_id' and is_delete='none'");
        
        
        if($update_db)
        {
            
        $delete_db=mysql_query("DELETE FROM notes_attech_file_db WHERE notes_id='$final_assign_id'");    
         
             
        $filename= $_FILES['attech_file']['name'];
        $tmpfilename = $_FILES['attech_file']['tmp_name'];
        $filesize = $_FILES['attech_file']['size'];
        $temp_document=$_POST['temp_attach_file'];
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
      $location=$temp_document[$i]; ;
      }
      
      }else 
      {
        $location=$temp_document[$i]; ;  
      }
        }else
        {
        $location=$temp_document[$i];    
        }
        if(!empty($location))
        {
         $insert_attech_file_db=mysql_query("INSERT into notes_attech_file_db values('','$final_assign_id',"
                 . "'$location','$date')"); 
         if($insert_attech_file_db)
         {
             
         } 
        }
        }
         
            
         $message_show="Record save successfully complete";     
          
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
        <title>Edit Notes</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
         function validateForm()
         {
                   var title=document.getElementById("notes_title").value;
                   var description=document.getElementById("notes_description").value;
                   var date_submit=document.getElementById("submit_date").value;
                   var class_name=document.getElementById("class_name").value;
                   var section=document.getElementById("section_name").value;
                   var subject=document.getElementById("subject_id").value;
                   
                   if(title==0)
                   {
                      alert("Please enter notes title");
                      document.getElementById("notes_title").focus();
                      return false;
                   }else
                       if(description==0)
                   {
                      alert("Please enter description");
                      document.getElementById("notes_description").focus();
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
             function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
            </script> 
            
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validate_form();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Notes Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];
             
            $select_data=mysql_query("SELECT * FROM notes_db WHERE encrypt_id='$token_id' and is_delete='none'"); 
            $fetch_db_data=mysql_fetch_array($select_data);
            $fetch_num_data=mysql_num_rows($select_data);
            if((!empty($fetch_db_data))&&($fetch_db_data!=null)&&($fetch_num_data!=0))
            {
            
              $session_id=$fetch_db_data['session_id'];    
              $notes_id=$fetch_db_data['notes_id'];
                               $title=$fetch_db_data['title'];
                               $description=ucwords($fetch_db_data['description']);
                            
                               $class=$fetch_db_data['class_id'];
                               $section=$fetch_db_data['section_id'];
                               $subject=$fetch_db_data['subject_id'];
             {
             ?>  
              <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $notes_id;?>">
             <input type="hidden" name="use_inset_session_id" id="insert_session_id"  value="<?php  echo $session_id;?>">   
      
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
                          <td><b>Notes title<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input type="text" name="notes_title" placeholder='Please enter notes title'
                                      id="notes_title"  value="<?php echo $title;?>" class="text_box_styles"  autocomplete="off"> </td>
                          <td>
                          </td>
                      </tr>
                      
                      
                       <tr>
                           <td><b>Notes Description <sup>*</sup> </b></td><td><b>:</b></td>
                          <td colspan="2">
                              <textarea name="notes_description" placeholder='Please enter notes description'
                                        id="notes_description" class="text_area_styles" style=" width:450px; "><?php echo $description;?></textarea>   
                          </td>
                      </tr>
                      
                       <tr>
                          <td><b>Attach File</b></td><td><b>:</b></td>
                          <td>
                            
                              <table id="attach_file_table" style=" float:left; ">
                                  <tr>
                                   <td><input type="hidden" name="temp_attach_file[]"><input type="file" id="attach_file_1" name="attech_file[]" id="attech_file"></td>
                                  </tr> 
                                  <?php
                 $number=1;
                $attech_db=mysql_query("SELECT * FROM notes_attech_file_db WHERE notes_id='$notes_id'");        
                 while ($attech_data=mysql_fetch_array($attech_db))
                 {
                 $attech_db_id=$attech_data['id'];
                 $attech_file=$attech_data['document'];
                 $number++;
                 echo ' <tr>
<td><input type="hidden" name="temp_attach_file[]" value="'.$attech_file.'">
    <input type="file"  name="attech_file[]" id="attech_file" style="display:none;"><span style="color:blue;"><b>Document '.$number.'</b></span></td>
<td><input type="button" onclick="removeen(this)" class="remove_button_style" value="Remove"></td>                                 
</tr>';
                 
                 }
                                  
                                  ?>
                                  <input type="hidden" id="temp_assign_no" value="<?php echo $number;?>">
                                 
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
                                if($class==$fetch_class_id)
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
                      </tr>
                       <tr>
                          <td><b>Section<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> 
                              <select class="select_class" onchange="section_change(this.value)" name="section_id" id="section_name" style=" width:280px; ">
                                  <option value='0'>---Select---</option>
                                 <?php
    $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details course_id='$class' and is_delete='none'");
    while ($fetch_class_data=mysql_fetch_array($section_db))
    {
        $fetch_section_id=$fetch_class_data['section_id'];
        $fetch_section_name=$fetch_class_data['section_name'];
        if($section==$fetch_section_id)
        {
         echo "<option value='$fetch_section_id' selected>$fetch_section_name</option>";   
        }  else {
          echo "<option value='$fetch_section_id'>$fetch_section_name</option>";  
        }
        
    }
                                 ?>
                         </select>
                          </td>
                      </tr>
                      <tr>
                          <td><b>Subject<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> 
                         <select class="select_class" name="subject_name" id="subject_id" style=" width:280px; ">
                                  <option value='0'>---Select---</option>
                                  <?php
            $subject_assign_db=mysql_query("SELECT * FROM subject_assign_db as T1 "
         . "LEFT JOIN subject_db as T2 ON T1.subject_id=T2.subject_id WHERE T1.class_id='$class'"
         . " and T1.section_id='$section' and T1.is_delete='none'");
 while ($subject_assign_data=mysql_fetch_array($subject_assign_db))
 {
  $subject_id=$subject_assign_data['subject_id'];
  $subject_name=$subject_assign_data['subject_name'];
  if($subject==$subject_id)
  {
  echo "<option value='$subject_id' selected>$subject_name</option>";    
  }  else {
    echo "<option value='$subject_id'>$subject_name</option>";  
  }
  
     
     
 }
                                  ?>
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
                              <input type="submit" name="data_submit" class="button_styling" style=" margin-right:0;  " value="Update">   
                          </td> 
                      </tr>
                      
                   </table>  
                
                
            <?php
             }
            }
             }
            ?>
            
            
            
            </div>
            </div>
            <div class="edit_fotter_div_tag">Design & Develop By : DIGI SHIKSHA</div>
            
            
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