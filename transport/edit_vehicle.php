<?php
//SESSION CONFIGURATION
$check_array_in="transport";
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
if(isset($_POST['submit_process']))
{
 $final_vehicle_id=$_POST['update_db_id'];  
 $vehicle_type=$_POST['vehicle_type'];
 $vehicle_reg_no=$_POST['vehicle_registration_no'];
 $vehicle_reg_date=$_POST['vehicle_registration_date'];
 $vehicle_no_seats=$_POST['no_of_seats'];
 $max_allowed=$_POST['max_allowed'];
 $vehicle_milage=$_POST['vehicle_milage'];
 $vehicle_service_date=$_POST['start_service_date'];
 $insurance_no=$_POST['insurance_number'];
 $insurance_expire_date=$_POST['insurance_expire'];
 $taxrrimed=$_POST['taxrrimed'];
 $vehicle_owner_name=$_POST['vehicle_owner'];
 $vehicle_mobile_no=$_POST['mobile_no'];
 $description=$_POST['description'];
 $insert_session_id=$_POST['use_inset_session_id'];
   

 if((!empty($final_vehicle_id))&&(!empty($vehicle_type))&&(!empty($vehicle_reg_no))&&(!empty($vehicle_no_seats))&&(!empty($max_allowed))&&(!empty($insert_session_id)))
 {
  
 $select_match_vehicle_db=mysql_query("SELECT * FROM transport_vehicle_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$insert_session_id'
        and vehicle_id!='$final_vehicle_id' and vehicle_type_id='$vehicle_type' and vehicle_registration_no='$vehicle_reg_no' and is_delete='none'"); 
 $fetch_vehicle_data=mysql_fetch_array($select_match_vehicle_db);
 $fetch_vehicle_num_rows=mysql_num_rows($select_match_vehicle_db);
    if((empty($fetch_vehicle_data))&&($fetch_vehicle_data==null)&&($fetch_vehicle_num_rows==0)) 
    {
     
    $check_vehicle_type_db=mysql_query("SELECT * FROM transport_vehicle_type_db WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and vehicle_type_id='$vehicle_type' and is_delete='none'");    
      $fetch_vehicle_type_data= mysql_fetch_array($check_vehicle_type_db);
      $fetch_vehicle_type_num_rows=mysql_num_rows($check_vehicle_type_db);
      if((!empty($fetch_vehicle_type_data))&&($fetch_vehicle_type_num_rows!=null)&&($fetch_vehicle_type_num_rows!=0))  
      {
       $fetch_vehicle_no_of_vehicle=$fetch_vehicle_type_data['no_of_vehicle'];   
     
       
       $match_insert_vehicle_db=  mysql_query("SELECT * FROM transport_vehicle_db WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and vehicle_type_id='$vehicle_type' and is_delete='none'");
       $fetch_vehicle_no_insert=mysql_num_rows($match_insert_vehicle_db);
       
       if($fetch_vehicle_no_of_vehicle>$fetch_vehicle_no_insert)
       {       
   
     $update_db=mysql_query("UPDATE transport_vehicle_db SET vehicle_type_id='$vehicle_type',vehicle_registration_no='$vehicle_reg_no',registration_date='$vehicle_reg_date',no_of_seats='$vehicle_no_seats',"
             . "max_allow='$max_allowed',milage='$vehicle_milage',start_service_date='$vehicle_service_date',insurance_no='$insurance_no',insurance_expire_date='$insurance_expire_date',"
             . "taxrrimed='$taxrrimed',vehicle_owner_name='$vehicle_owner_name',mobile_no='$vehicle_mobile_no',description='$description' WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and vehicle_id='$final_vehicle_id' and is_delete='none'");
     
    if((!empty($update_db))&&($update_db)) 
    {
      $message_show="<div class='notification_alert_show' STYLE='COLOR:GREEN;'>Record update successfully complete</div>";   
    }else
    {
    $message_show="<div class='notification_alert_show'>Request failed,please try again</div>";     
    }
       }else
       {
        $message_show="<div class='notification_alert_show'>Sorry,you have already create $fetch_vehicle_no_of_vehicle vehicle</div>";        
       }
     }else
      {
       $message_show="<div class='notification_alert_show'>Sorry,$vehicle_type,Record missing in database</div>";     
       
      }    
    }else $message_show="<div class='notification_alert_show'>Record already exist in database.</div>"; 
     
     
 }else $message_show="<div class='notification_alert_show'>Please fill all fields.</div>";
 
require_once '../pop_up.php';
 
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Vehicle Details</title>
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
            var vehicle_registration_no=document.getElementById("vehicle_registration_no").value;
            var vehicle_no_of_seats=document.getElementById("no_of_seats").value;
            var max_allowed=document.getElementById("max_allowed").value;
           if(vehicle_type==0) 
            {
               alert("Please enter vehicle type");
               document.getElementById("vehicle_type").focus();
               return false;
            }else
             if(vehicle_registration_no==0) 
            {
               alert("Please enter vehicle registration date");
               document.getElementById("vehicle_registration_no").focus();
               return false;
            }else
                if(vehicle_no_of_seats==0) 
            {
               alert("Please enter number of seats");
               document.getElementById("no_of_seats").focus();
               return false;
            }else
                if(isNaN(vehicle_no_of_seats))
                    {
                     alert("Please enter only numeric value");
               document.getElementById("no_of_seats").focus();
               return false;   
                    }else
                        if(max_allowed=0)
                    {
                      alert("Please enter maximum allowed");
                      document.getElementById("max_allowed").focus();
                      return false;
                    }else
                if(isNaN(max_allowed))
                    {
                     alert("Please enter only numeric value");
               document.getElementById("max_allowed").focus();
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
                <div class="title_name">Edit Vehicle Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
              
                 <?php
              if(!empty($_REQUEST['token_id']))
              {
               
    $token_id=$_REQUEST['token_id'];
   $database_db=mysql_query("SELECT * FROM transport_vehicle_db WHERE encrypt_id='$token_id' and is_delete='none'");
  $fetch_data=mysql_fetch_array($database_db);
  $fetch_num_rows=mysql_num_rows($database_db);
  if((!empty($fetch_data))&&($fetch_data!=null)&&($fetch_num_rows!=0))
  {
 $fecth_session_id_set=$fetch_data[3];
 $get_vehicle_id=$fetch_data[6];
      
  {   
 ?>      
                
            <input type="hidden" name="update_db_id" value="<?php echo $fetch_data[4];?>">   
            <input type="hidden" name="use_inset_session_id" value="<?php echo $fetch_data[3];?>">
            <table cellsapcing="4" cellpadding="4" class="table_middle">
                       <tr>
                           <td><br/></td>
                       </tr>
                       <tr>
                           <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                       </tr>
                      
                       <tr>
                       <td>Vehicle Type <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                           <select class="select_class" id="vehicle_type" name="vehicle_type">
                               <option value="0">--Select vehicle type --</option> 
                             <?php 
                             
$vehicle_type_db=mysql_query("SELECT * FROM transport_vehicle_type_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and is_delete='none'");
while ($fetch_vehicle_type_data=  mysql_fetch_array($vehicle_type_db))
{
   $fetch_vehicle_type_id=$fetch_vehicle_type_data['vehicle_type_id'];
    $fetch_vehicle_type_name=$fetch_vehicle_type_data['vehicle_type'];
    
    if($get_vehicle_id==$fetch_vehicle_type_id)
    {
    echo "<option value='$fetch_vehicle_type_id' selected>$fetch_vehicle_type_name</option>";   
    }  else {
         echo "<option value='$fetch_vehicle_type_id'>$fetch_vehicle_type_name</option>";   
   
    }
}
?>
                           </select>    
                       </td>
                       </tr>
                      
                       
                       <tr>
                       <td>Vehicle Registration No. <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[7];?>" id="vehicle_registration_no" name="vehicle_registration_no" placeholder="Enter vehicle registration number" class="text_box_class">
                           <br/><span style=" font-size:9px; color:red;  ">(Example : UP 16 AA 1111)</span></td>
                       </tr>
                       
                       <tr>
                       <td>Vehicle Registration Date</td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[8];?>" id="vehicle_reg_date" name="vehicle_registration_date" placeholder="Enter vehicle registration date" class="text_box_class"> </td><td></td>
                       </tr>
                       
                       
                       <tr>
                       <td>Number Of Seats <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" onkeypress="javascript:return isNumber (event)" value="<?php echo $fetch_data[9];?>" id="no_of_seats" name="no_of_seats" class="text_box_class" style=" text-align:center;  width:25%; "> </td>
                       </tr>
                       
                       <tr>
                       <td>Maximum Allowed<sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" onkeypress="javascript:return isNumber (event)" value="<?php echo $fetch_data[10];?>" id="max_allowed" name="max_allowed" class="text_box_class" style=" text-align:center;  width:25%; "> </td>
                       </tr>
                       
                       <tr>
                       <td>Milage (1 liter)</td>
                       <td><b>:</b></td>
                       <td><input type="text" onkeypress="javascript:return isNumber (event)" value="<?php echo $fetch_data[11];?>" id="vehicle_milage" name="vehicle_milage" class="text_box_class" style=" width:25%; text-align:center; "><B> Km</B> </td>
                       </tr>
                       
                       <tr>
                       <td>Start Service Date</td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[12];?>" id="start_service_date" name="start_service_date" placeholder="Enter start service date" class="text_box_class"> </td><td></td>
                       </tr>
                       
                       <tr>
                       <td>Insurance Number</td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[13];?>" id="insurance_number" name="insurance_number" placeholder="Enter insurance number" class="text_box_class"> </td><td></td>
                       </tr>
                       
                       <tr>
                       <td>Insurance Expire Date</td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[14];?>" id="insurance_expire" name="insurance_expire" placeholder="Enter insurance expire date" class="text_box_class"> </td><td></td>
                       </tr>
                        <tr>
                       <td>Taxrrimed</td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[15];?>" id="taxrrimed" name="taxrrimed" placeholder="Enter taxrrimed" class="text_box_class"> </td><td></td>
                       </tr>
                       
                       <tr>
                       <td>Vehicle Owner Name</td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[16];?>" id="vehicle_owner" name="vehicle_owner" placeholder="Enter vehicle owner" class="text_box_class"> </td><td></td>
                       </tr>
                       
                        <tr>
                       <td>Mobile No.</td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[17];?>" id="mobile_no" name="mobile_no" placeholder="Enter mobile number" class="text_box_class"> </td><td></td>
                       </tr>
                       
                       <tr>
                       <td>Description </td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter description" class="text_area_class"><?php echo $fetch_data[18];?></textarea></td>
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
        
          <script type="text/javascript" src="../javascript/next_javascript.js"></script>
         <script type="text/javascript" src="../javascript/admission_javascript.js"></script>
         <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
         
       
             <script type="text/javascript">
      
$(function() {
$("#vehicle_reg_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
    
    $("#start_service_date,#insurance_expire").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
   
});
    </script>
        
        
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>