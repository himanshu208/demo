<?php
//SESSION CONFIGURATION
$check_array_in="hostel";
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
     


$db_unique_id=$_POST['update_unique_id'];
$insert_session_id=$_POST['use_inset_session_id'];
$hostel_type=$_POST['hostel_type'];
$description=$_POST['description'];

if((!empty($insert_session_id))&&(!empty($hostel_type))&&(!empty($db_unique_id)))
{
 
 $select_db=mysql_query("SELECT * FROM hostel_type_db WHERE $db_main_details hostel_type_unique_id!='$db_unique_id' and hostel_type='$hostel_type' and is_delete='none'");   
 $select_data=mysql_fetch_array($select_db);
 $select_num_rows=mysql_num_rows($select_db);
 
 if((empty($select_data))&&($select_data==null)&&($select_num_rows==0))
 {
  
 $update_db=mysql_query("UPDATE hostel_type_db SET hostel_type='$hostel_type',description='$description' WHERE $db_main_details "
         . "hostel_type_unique_id='$db_unique_id' and is_delete='none'");
 if($update_db)
 {
    $message_show="<span style='color:green;'>Record update successfully complete.</span>";   
 }else
 {
 $message_show="<span style='color:red;'>Request failed,Please try again.</span>";      
 }
 
 
 }else
 {
   $message_show="<span style='color:red;'>Record already exist in database</span>";    
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
        <title>Edit Hostel Type</title>
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
            
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validate_form();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Hostel Type</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];
             
            $select_data=mysql_query("SELECT * FROM hostel_type_db WHERE $db_main_details encrypt_id='$token_id' and is_delete='none'"); 
            $fetch_data=mysql_fetch_array($select_data);
            $fetch_num_data=mysql_num_rows($select_data);
            if((!empty($fetch_data))&&($fetch_data!=null)&&($fetch_num_data!=0))
            {
            
             $session_id=$fetch_data['session_id'];    
              
             $hostel_type=$fetch_data['hostel_type'];
             $description=$fetch_data['description'];
             {
             ?>  
              <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $fetch_data[4];?>">
             <input type="hidden" name="use_inset_session_id" id="insert_session_id"  value="<?php  echo $session_id;?>">   
      
             <table cellspacing="4" cellpadding="6" id="session_table_style" style=" font-size:13px; ">
                    <tr>
                        <td colspan="3" style=" font-size:13px; "><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr>
                        <td colspan="3">
                        </td>
                    </tr>
                    <tr><td><b>Hostel Type</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" value="<?php echo $hostel_type;?>" autocomplete="off" id="hostel_type" 
                                   placeholder="Please enter hostel type" class="text_box_org"
                                   name="hostel_type" ></td>
                    </tr>
                     <tr>
                         <td><b>Description</b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter description" name="description" 
                                      id="address_text_area"><?php echo $description;?></textarea>
                        </td>
                    </tr>
                     <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button"  id="save_button"  value="Update">   
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