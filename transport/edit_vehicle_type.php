<?php
//SESSION CONFIGURATION
$check_array_in="transport";
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
if(isset($_POST['submit_process']))
{
 $vehicle_type=$_POST['vehicle_type'];
 $no_of_vehicle=$_POST['no_of_vehicle'];
 $description=$_POST['description'];
 $vahicle_type_id=$_POST['vehicle_type_unique_id'];
  
 if((!empty($vahicle_type_id))&&(!empty($vehicle_type))&&(!empty($no_of_vehicle)))
 {
  
 $select_match_vehicle_type_db=mysql_query("SELECT * FROM transport_vehicle_type_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
        and vehicle_type_id!='$vahicle_type_id' and vehicle_type='$vehicle_type' and is_delete='none'"); 
 $fetch_vehicle_type_data=mysql_fetch_array($select_match_vehicle_type_db);
 $fetch_vehicle_type_num_rows=mysql_num_rows($select_match_vehicle_type_db);
    if((empty($fetch_vehicle_type_data))&&($fetch_vehicle_type_data==null)&&($fetch_vehicle_type_num_rows==0)) 
    {
    $update_db=  mysql_query("UPDATE transport_vehicle_type_db SET vehicle_type='$vehicle_type',no_of_vehicle='$no_of_vehicle',description='$description' "
             . "WHERE vehicle_type_id='$vahicle_type_id' and is_delete='none'");
     
    if((!empty($update_db))&&($update_db)) 
    {
      $message_show="<div class='notification_alert_show' style='color:green;'>Record update successfully complete</div>";   
    }else
    {
    $message_show="<div class='notification_alert_show'>Request failed,please try again</div>";     
    }
        
        
    }else $message_show="<div class='notification_alert_show'>Record already exist in database.</div>"; 
     
     
 }else $message_show="<div class='notification_alert_show'>Please fill all fields.</div>";
  
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
             function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
            </script> 
            
            
            <script type="text/javascript">
        function validate_form() 
        {
            var vehicle_type=document.getElementById("vehicle_type").value;
            var no_of_vehicle=document.getElementById("no_of_vehicle").value;
            
           if(vehicle_type==0) 
            {
               alert("Please enter vehicle type");
               document.getElementById("vehicle_type").focus();
               return false;
            }else
             if(no_of_vehicle==0) 
            {
               alert("Please enter number of vehicle");
               document.getElementById("no_of_vehicle").focus();
               return false;
            }else
                if(isNaN(no_of_vehicle))
                    {
                     alert("Please enter only numeric value");
               document.getElementById("no_of_vehicle").focus();
               return false;   
                    }
            
        }
        </script>
            
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validate_form();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Student Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
              if(!empty($_REQUEST['token_id']))
              {
               
    $token_id=$_REQUEST['token_id'];
   $database_db=mysql_query("SELECT * FROM  transport_vehicle_type_db WHERE encrypt_id='$token_id' and is_delete='none'");
  $fetch_data=mysql_fetch_array($database_db);
  $fetch_num_rows=mysql_num_rows($database_db);
  if((!empty($fetch_data))&&($fetch_data!=null)&&($fetch_num_rows!=0))
  {
 
      
  {   
 ?>   
     
    <input type="hidden" name="vehicle_type_unique_id" value="<?php echo $fetch_data[4];?>">              
  <table cellsapcing="4" cellpadding="4" class="table_middle" style=" font-size:12px; ">
                       <tr>
                           <td><br/></td>
                       </tr>
                       <tr>
                           <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                       </tr>
                     
                       <tr>
                           <td><br/></td>
                       </tr>
                      
                       <tr>
                       <td>Vehicle Type <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[6];?>" id="vehicle_type" name="vehicle_type" placeholder="Enter vehicle type" class="text_box_class"></td>
                       </tr>
                      
                       
                       <tr>
                       <td>Number of Vehicle <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input value="<?php echo $fetch_data[7];?>" onkeypress="javascript:return isNumber (event)" type="text"
                                  id="no_of_vehicle" name="no_of_vehicle" 
                                  class="text_box_class" style=" width:20%; text-align:center;  "> </td>
                       </tr>
                       
                       <tr>
                       <td>Description </td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter description" class="text_area_class"><?php echo $fetch_data[8];?></textarea></td>
                       </tr>
                       
                       <tr>
                           <td colspan="3">
                              <input type="submit" class="submit_process" name="submit_process" value="Update"> 
                               
                               
                               <input type="reset" class="reset_process" name="reset_process" value="Reset">
                               
                           </td>
                       </tr>
                   </table>                  
                
                
  <?php
  }
  }else
  {
      echo "Record no found !"; 
  }
                  
              }
 ?>
                
            
            
            
            </div>
            </div>
            <div class="edit_fotter_div_tag">Design & Develop By :  Pixabyte Technologies Pvt. Ltd.</div>
            
            
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