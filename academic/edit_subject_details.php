<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>
<?php
   $message_show="";
  if(isset($_POST['submit_data_process']))
  {   
      $subject_type=$_POST['subject_type'];
      $subject_update_db_id=$_POST['subject_unique_id'];
      $subject_name=$_POST['subject_name'];
      $subject_full_name=$_POST['subject_full_name'];
      $description=$_POST['description'];
      if((!empty($subject_name))&&(!empty($subject_full_name))&&(!empty($subject_update_db_id)))
      {
       $final_subject_id=$subject_update_db_id;    
       $check_subject_record=mysql_query("SELECT * FROM subject_db WHERE $db_main_details subject_id!='$final_subject_id' and subject_name='$subject_name' and is_delete='none'");
       $fetch_subject_data=mysql_fetch_array($check_subject_record);
       $fetch_subject_num_rows=mysql_num_rows($check_subject_record);
      if((empty($fetch_subject_data))&&($fetch_subject_data==null)&&($fetch_subject_num_rows==0))
      {
     
         $update_db=  mysql_query("UPDATE subject_db SET subject_type='$subject_type',subject_name='$subject_name',subject_code='$subject_full_name',"
                 . "description='$description' WHERE subject_id='$final_subject_id' and is_delete='none'");
          
          
         if($update_db)
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
        <title>Edit Subject Detail</title>
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
                <div class="title_name">Edit Subject Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div> 
          <?php 
            if(!empty($_REQUEST['token_id']))
            {
            $token_id=$_REQUEST['token_id'];
   
$subject_db=mysql_query("SELECT * FROM subject_db WHERE $db_main_details encrypt_id='$token_id' and is_delete='none'");
$fetch_subject_data= mysql_fetch_array($subject_db);
$fetch_subject_num_rows=mysql_num_rows($subject_db);
if((!empty($fetch_subject_data))&&($fetch_subject_data!=null)&&($fetch_subject_num_rows!=0))
{

   
            $subject_db_id=$fetch_subject_data['id'];
             $subject_type=$fetch_subject_data['subject_type'];
            $subject_unique_id=$fetch_subject_data['subject_id'];
            $subject_name=$fetch_subject_data['subject_name'];
            $subject_full_name=$fetch_subject_data['subject_code'];
            $subject_description=$fetch_subject_data['description'];
            
            if($subject_type=="theory")
            {
             $thoeory_check="checked";
             $practicle_lab="";
            }else
            {
               $thoeory_check="";
             $practicle_lab="checked";   
            }
            
    
?>
            
            <input type="hidden" name="subject_unique_id" value="<?php  echo $subject_unique_id;?>">
            <div class="edit_main_work_div">
                <div class="edit_center_div_tag">
                    
             <table cellspacing="2" cellpadding="2"  style="margin:0 auto;
                         margin-top:10px;  font-size:12px;  ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr>
                        <td style=" height: 20px;"></td>
                    </tr>
                     <tr>
                        <td colspan="2"></td>
                        <td>
                            <table>
                                <tr>
                                    <td><input type="radio" name="subject_type" value="theory" <?php echo $thoeory_check;?>></td>
                                    <td><b>Theory</b> </td>
                                    <td><input type="radio" name="subject_type" value="practical" <?php echo $practicle_lab;?>></td>
                                    <td><b><b>Practical/Lab</b></b></td> 
                                </tr>
                            </table>    
                            
                        </td>
                    </tr>
                    <tr><td><b>Subject Name</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="subject_name" 
                                   value="<?php  echo $subject_name;?>"  placeholder="Enter subject name" class="text_box_org"
                                   name="subject_name"></td>
                    </tr>
                    <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                    <tr><td><b>Subject Code <sup>*</sup></b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="section_name" 
                                   value="<?php  echo $subject_full_name;?>"  placeholder="Enter subject code" class="text_box_org"
                                   name="subject_full_name"></td>
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
                                     id="address_text_area"><?php  echo $subject_description;?></textarea>
                        </td>
                    </tr>
                    <tr>
                    <td style=" height:7px; "></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button" id="save_button" 
                                   value="Update">   
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