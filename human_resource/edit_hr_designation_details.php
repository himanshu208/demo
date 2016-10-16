<?php
//SESSION CONFIGURATION
$check_array_in="hr";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php
   
   $message_show="";
  if(isset($_POST['submit_data_process']))
  {   
      $hr_designation_update_db_id=$_POST['hr_designation_unique_id'];
      $hr_designation_name=$_POST['hr_designation_name'];
      $description=$_POST['description'];
      if((!empty($hr_designation_name))&&(!empty($hr_designation_update_db_id)))
      {
       $final_hr_designation_id=$hr_designation_update_db_id;
          
          
       $check_hr_designation_record=  mysql_query("SELECT * FROM hr_designation_db WHERE $db_main_details_whout_session designation_id!='$final_hr_designation_id' and designation_name='$hr_designation_name' and is_delete='none'");
       $fetch_hr_designation_data= mysql_fetch_array($check_hr_designation_record);
       $fetch_hr_designation_num_rows=  mysql_num_rows($check_hr_designation_record);
      if((empty($fetch_hr_designation_data))&&($fetch_hr_designation_data==null)&&($fetch_hr_designation_num_rows==0))
      {
     
         $update_db=  mysql_query("UPDATE hr_designation_db SET designation_name='$hr_designation_name',"
                 . "description='$description' WHERE $db_main_details_whout_session designation_id='$final_hr_designation_id' and is_delete='none'");
          
          
         if($update_db)
         {
          $message_show="<span style='color:green;'>Record Update successfully complete</span>";   
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
        <title>Edit Designation Detail</title>
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
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validateForm();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Designation Detail</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div> 
          <?php 
            if(!empty($_REQUEST['token_id']))
            {
            $token_id=$_REQUEST['token_id'];
   
$hr_designation_db=mysql_query("SELECT * FROM hr_designation_db WHERE $db_main_details_whout_session encrypt_id='$token_id' and is_delete='none'");
$fetch_hr_designation_data= mysql_fetch_array($hr_designation_db);
$fetch_hr_designation_num_rows=mysql_num_rows($hr_designation_db);
if((!empty($fetch_hr_designation_data))&&($fetch_hr_designation_data!=null)&&($fetch_hr_designation_num_rows!=0))
{

            $hr_designation_db_id=$fetch_hr_designation_data['id'];
            $hr_designation_unique_id=$fetch_hr_designation_data['designation_id'];
            $hr_designation_name=$fetch_hr_designation_data['designation_name'];
            $hr_designation_description=$fetch_hr_designation_data['description'];
    
?>
            
            <input type="hidden" name="hr_designation_unique_id" value="<?php  echo $hr_designation_unique_id;?>">
            <div class="edit_main_work_div">
                <div class="edit_center_div_tag">
                    
             <table cellspacing="2" cellpadding="2"  style="margin:0 auto;
                         margin-top:10px;  font-size:12px;  ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                   <tr><td>Designation<sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="hr_designation_name" 
                                   value="<?php  echo $hr_designation_name;?>"  placeholder="Enter hr_designation name" class="text_box_org"
                                   name="hr_designation_name"></td>
                    </tr>
                    <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                    <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                     placeholder="Enter description" name="description" 
                                     id="address_text_area"><?php  echo $hr_designation_description;?></textarea>
                        </td>
                    </tr>
                    <tr>
                    <td style=" height:7px; "></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button" onclick="return org_validate();" id="save_button" 
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