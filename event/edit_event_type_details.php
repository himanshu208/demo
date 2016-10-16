<?php
//SESSION CONFIGURATION
$check_array_in="event";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>
<?php
   
   $message_show="";
  if(isset($_POST['submit_data_process']))
  {   
      $event_type_update_db_id=$_POST['event_type_unique_id'];
      $event_type_name=$_POST['event_type_name'];
      $description=$_POST['description'];
      if((!empty($event_type_name))&&(!empty($event_type_update_db_id)))
      {
       $final_event_type_id=$event_type_update_db_id;
          
          
       $check_event_type_record=  mysql_query("SELECT * FROM event_type_db WHERE $db_main_details event_type_id!='$final_event_type_id' and event_type='$event_type_name' and is_delete='none'");
       $fetch_event_type_data= mysql_fetch_array($check_event_type_record);
       $fetch_event_type_num_rows=  mysql_num_rows($check_event_type_record);
      if((empty($fetch_event_type_data))&&($fetch_event_type_data==null)&&($fetch_event_type_num_rows==0))
      {
     
         $update_db=  mysql_query("UPDATE event_type_db SET event_type='$event_type_name',"
                 . "description='$description' WHERE $db_main_details event_type_id='$final_event_type_id' and is_delete='none'");
          
          
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
        <title>Edit Event Type Detail</title>
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
                <div class="title_name">Edit Event Type Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div> 
          <?php 
            if(!empty($_REQUEST['token_id']))
            {
            $token_id=$_REQUEST['token_id'];
   
$event_type_db=mysql_query("SELECT * FROM event_type_db WHERE $db_main_details encrypt_id='$token_id' and is_delete='none'");
$fetch_event_type_data= mysql_fetch_array($event_type_db);
$fetch_event_type_num_rows=mysql_num_rows($event_type_db);
if((!empty($fetch_event_type_data))&&($fetch_event_type_data!=null)&&($fetch_event_type_num_rows!=0))
{

            $event_type_db_id=$fetch_event_type_data['id'];
            $event_type_unique_id=$fetch_event_type_data['event_type_id'];
            $event_type_name=$fetch_event_type_data['event_type'];
            
            $event_type_description=$fetch_event_type_data['description'];
    
?>
            
            <input type="hidden" name="event_type_unique_id" value="<?php  echo $event_type_unique_id;?>">
            <div class="edit_main_work_div">
                <div class="edit_center_div_tag">
                    
             <table cellspacing="2" cellpadding="2"  style="margin:0 auto;
                         margin-top:10px;  font-size:12px;  ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                   <tr><td>Event Type<sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="event_type_name" 
                                   value="<?php  echo $event_type_name;?>"  placeholder="Enter event type name" class="text_box_org"
                                   name="event_type_name"></td>
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
                                     id="address_text_area"><?php  echo $event_type_description;?></textarea>
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