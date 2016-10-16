<?php
//SESSION CONFIGURATION
$check_array_in="sms_module";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>
<?php
   $message_show="";
  if(isset($_POST['submit_data_process']))
  {   
      $sms_message_type_db_update_db_id=$_POST['sms_message_type_db_unique_id'];
      $sms_message_type_db_name=$_POST['sms_message_type_db_name'];
      $description=$_POST['description'];
      if((!empty($sms_message_type_db_name))&&(!empty($sms_message_type_db_update_db_id)))
      {
       $final_sms_message_type_db_id=$sms_message_type_db_update_db_id;
          
          
       $check_sms_message_type_db_record=mysql_query("SELECT * FROM sms_message_type_db WHERE organization_id='$fetch_school_id' "
               . "and branch_id='$fetch_branch_id' and message_type_id!='$final_sms_message_type_db_id' "
               . "and message_type='$sms_message_type_db_name' and is_delete='none'");
       $fetch_sms_message_type_db_data= mysql_fetch_array($check_sms_message_type_db_record);
       $fetch_sms_message_type_db_num_rows=  mysql_num_rows($check_sms_message_type_db_record);
      if((empty($fetch_sms_message_type_db_data))&&($fetch_sms_message_type_db_data==null)&&($fetch_sms_message_type_db_num_rows==0))
      {
     
         $update_db=  mysql_query("UPDATE sms_message_type_db SET message_type='$sms_message_type_db_name',"
                 . "description='$description' WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' "
                 . "and message_type_id='$final_sms_message_type_db_id' and is_delete='none'");
          
          
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
        <title>Edit Message Type</title>
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
                <div class="title_name">Edit Message Type</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div> 
          <?php 
            if(!empty($_REQUEST['token_id']))
            {
            $token_id=$_REQUEST['token_id'];
   
$sms_message_type_db_db=mysql_query("SELECT * FROM sms_message_type_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and encrypt_id='$token_id' and is_delete='none'");
$fetch_sms_message_type_db_data= mysql_fetch_array($sms_message_type_db_db);
$fetch_sms_message_type_db_num_rows=mysql_num_rows($sms_message_type_db_db);
if((!empty($fetch_sms_message_type_db_data))&&($fetch_sms_message_type_db_data!=null)&&($fetch_sms_message_type_db_num_rows!=0))
{

            $sms_message_type_db_db_id=$fetch_sms_message_type_db_data['id'];
            $sms_message_type_db_unique_id=$fetch_sms_message_type_db_data['message_type_id'];
            $sms_message_type_db_name=$fetch_sms_message_type_db_data['message_type'];
            $sms_message_type_db_description=$fetch_sms_message_type_db_data['description'];
    
?>
            
            <input type="hidden" name="sms_message_type_db_unique_id" value="<?php  echo $sms_message_type_db_unique_id;?>">
            <div class="edit_main_work_div">
                <div class="edit_center_div_tag">
                    
             <table cellspacing="2" cellpadding="2"  style="margin:0 auto;
                         margin-top:10px;  font-size:12px;  ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                   <tr><td><b>Message Type </b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sms_message_type_db_name" 
                                   value="<?php  echo $sms_message_type_db_name;?>"  placeholder="Enter message type name" class="text_box_org"
                                   name="sms_message_type_db_name"></td>
                    </tr>
                    <tr>
                        <td style=" height:7px; "></td>
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
                                     id="address_text_area"><?php  echo $sms_message_type_db_description;?></textarea>
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