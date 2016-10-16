<?php
//SESSION CONFIGURATION
$check_array_in="telephone_diary";
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
      $contact_group_name=$_POST['contact_group_name'];
       $description=$_POST['description'];
       $insert_session=$_POST['use_inset_session_id'];
      if((!empty($contact_group_name)))
      {
       $check_contact_group_record=mysql_query("SELECT * FROM contact_group_db WHERE id!='$update_db_id' and $db_main_details_whout_session"
               . " group_name='$contact_group_name' and is_delete='none'");
       $fetch_contact_group_data= mysql_fetch_array($check_contact_group_record);
       $fetch_contact_group_num_rows=  mysql_num_rows($check_contact_group_record);
      if((empty($fetch_contact_group_data))&&($fetch_contact_group_data==null)&&($fetch_contact_group_num_rows==0))
      {
          $update_db=mysql_query("UPDATE contact_group_db SET group_name='$contact_group_name',description='$description' WHERE id='$update_db_id' and is_delete='none'");
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
        <title>Edit Contact Group</title>
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
             function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
            </script> 
            <script type="text/javascript">
 function org_validate()
 {
     var contact_group_name=document.getElementById("contact_group_name").value;
     
     if(contact_group_name==0)
         {
             alert("Please enter system SMS group");
             document.getElementById("contact_group_name").focus();
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
           
       <form action="" method="post" name="form1" onsubmit="return validate_form();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Contact Group</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];
             
            $select_data=mysql_query("SELECT * FROM contact_group_db WHERE id='$token_id' and is_delete='none'"); 
            $fetch_data=mysql_fetch_array($select_data);
            $fetch_num_data=mysql_num_rows($select_data);
            if((!empty($fetch_data))&&($fetch_data!=null)&&($fetch_num_data!=0))
            {
            
              $session_id=$fetch_data['session_id'];  
              $update_db_id=$fetch_data['id']; 
              $fetch_contact_group_name=$fetch_data['group_name'];
              $fetch_contact_group_description=$fetch_data['description'];
                                 
             {
             ?>  
              <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $update_db_id;?>">
             <input type="hidden" name="use_inset_session_id" id="insert_session_id"  value="<?php  echo $session_id;?>">   
      
             <table cellspacing="2" cellpadding="2" id="org_table_style" style=" font-size:12px; width:auto; margin:auto;   ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr><td><b>Contact Group</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="contact_group_name" 
                                   placeholder="Enter contact group" class="text_box_org"
                                   name="contact_group_name" value="<?php echo $fetch_contact_group_name;?>"></td>
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
                                      id="address_text_area"><?php echo $fetch_contact_group_description;?></textarea>
                        </td>
                    </tr>
                    <tr>
                    <td style=" height:7px; "></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button" id="save_button"  value="Update">   
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