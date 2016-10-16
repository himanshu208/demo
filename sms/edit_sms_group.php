<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/edit_page_configuration.php';
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
 
  
      $update_db_id=$_POST['update_unique_id'];
      $sms_system_group_name=$_POST['sms_system_group_name'];
       $description=$_POST['description'];
       $insert_session=$_POST['use_inset_session_id'];
      if((!empty($sms_system_group_name))&&(!empty($update_db_id)))
      {
       $check_sms_system_group_record=mysql_query("SELECT * FROM sms_system_group_db WHERE $db_main_details_whout_session"
               . " id!='$update_db_id' and sms_category_name='$sms_system_group_name' and is_delete='none'");
       $fetch_sms_system_group_data= mysql_fetch_array($check_sms_system_group_record);
       $fetch_sms_system_group_num_rows=  mysql_num_rows($check_sms_system_group_record);
      if((empty($fetch_sms_system_group_data))&&($fetch_sms_system_group_data==null)&&($fetch_sms_system_group_num_rows==0))
      {
        
        
          $update_db=mysql_query("UPDATE sms_system_group_db SET sms_category_name='$sms_system_group_name'"
                  . ",description='$description' WHERE "
                  . "id='$update_db_id' and is_delete='none'");
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
        <title>Edit System SMS Group Template</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
               
<script type="text/javascript">
 function validate_form()
 {
     var sms_system_group_name=document.getElementById("sms_system_group_name").value;
     
     if(sms_system_group_name==0)
         {
             alert("Please enter system SMS group");
             document.getElementById("sms_system_group_name").focus();
             return false;
         } else
          {
              document.getElementById("ajax_loader_show").style.display="block";    
                  
             }
             
 }
</script>
        
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
                <div class="title_name">Edit System SMS Group Template</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];
             
            $select_data=mysql_query("SELECT * FROM sms_system_group_db WHERE $db_main_details_whout_session id='$token_id' and is_delete='none'"); 
            $fetch_data=mysql_fetch_array($select_data);
            $fetch_num_data=mysql_num_rows($select_data);
            if((!empty($fetch_data))&&($fetch_data!=null)&&($fetch_num_data!=0))
            {
             $fetch_sms_system_group_db_id=$fetch_data['id'];
            $fetch_sms_system_group_name=ucwords($fetch_data['sms_category_name']) ;
             $fetch_sms_system_group_description=$fetch_data['description'];
                                 
              $session_id=$fetch_data['session_id'];    
              
             {
             ?>  
              <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $fetch_sms_system_group_db_id;?>">
             <input type="hidden" name="use_inset_session_id" id="insert_session_id"  value="<?php  echo $session_id;?>">   
      
              <table cellspacing="2" cellpadding="2" id="org_table_style" style=" width:auto;
                     font-size:12px; margin:auto;  ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr><td><b>System SMS Group</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sms_system_group_name" 
                                   placeholder="Enter system sms group" class="text_box_org"
                                   name="sms_system_group_name" value="<?php echo $fetch_sms_system_group_name;?>"></td>
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
                                      id="address_text_area"><?php echo $fetch_sms_system_group_description;?></textarea>
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