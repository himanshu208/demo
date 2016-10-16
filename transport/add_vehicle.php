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
   
$result=mysql_query("SHOW TABLE STATUS LIKE 'transport_vehicle_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_vehicle_id="VEHCL_$nextId"; 
$encrypt_id=md5(md5($final_vehicle_id));
  
  
 if((!empty($final_vehicle_id))&&(!empty($vehicle_type))&&(!empty($vehicle_reg_no))&&(!empty($vehicle_no_seats))&&(!empty($max_allowed))&&(!empty($insert_session_id)))
 {
  
 $select_match_vehicle_db=mysql_query("SELECT * FROM transport_vehicle_db WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and vehicle_id='$final_vehicle_id' and is_delete='none'
     OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$insert_session_id'
         and vehicle_type_id='$vehicle_type' and vehicle_registration_no='$vehicle_reg_no' and is_delete='none'"); 
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
     $insert_db=mysql_query("INSERT into transport_vehicle_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'
         ,'$final_vehicle_id','$encrypt_id','$vehicle_type','$vehicle_reg_no','$vehicle_reg_date'
             ,'$vehicle_no_seats','$max_allowed','$vehicle_milage','$vehicle_service_date','$insurance_no','$insurance_expire_date',"
             . "'$taxrrimed','$vehicle_owner_name','$vehicle_mobile_no','$description','none'
             ,'$date','$date_time','$user_unique_id','active')");
    if((!empty($insert_db))&&($insert_db)) 
    {
      $message_show="<div class='notification_alert_show' STYLE='COLOR:GREEN;'>Record save successfully complete</div>";   
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





<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add Vehicle</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       
        
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
                        if(max_allowed==0)
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
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" name="myForm" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
         
            
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="transport_dashboard.php">Transport</a></td>
                           <td>/</td>
                           <td><a href="transport_system_setting.php">Transport System Setting</a></td>
                           <td>/</td>
                           <td>Add Vehicle</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Add Vehicle</b></div>
                    <a href="view_vehicle_details.php">
                        <div class="view_button">View Vehicle Details</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
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
    echo "<option value='$fetch_vehicle_type_id'>$fetch_vehicle_type_name</option>";   
}
?>
                           </select>    
                       </td>
                       <td><abbr title="Add New Vehicle Type"><a href="add_vehicle_type.php"><div class="add_button_styles">Add</div></a></abbr></td>
                       </tr>
                      
                       
                       <tr>
                       <td>Vehicle Registration No. <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="vehicle_registration_no" name="vehicle_registration_no" placeholder="Enter vehicle registration number" class="text_box_class">
                           <br/><span style=" font-size:9px; color:red;  ">(Example : UP 16 AA 1111)</span></td>
                       </tr>
                       
                       <tr>
                       <td>Vehicle Registration Date</td>
                       <td><b>:</b></td>
                       <td><input type="text" id="vehicle_reg_date" name="vehicle_registration_date" placeholder="Enter vehicle registration date" class="text_box_class"> </td><td></td>
                       </tr>
                       
                       
                       <tr>
                       <td>Number Of Seats <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" onkeypress="javascript:return isNumber (event)" id="no_of_seats" name="no_of_seats" class="text_box_class" style=" text-align:center;  width:25%; "> </td>
                       </tr>
                       
                       <tr>
                       <td>Maximum Allowed<sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" onkeypress="javascript:return isNumber (event)" id="max_allowed" name="max_allowed" class="text_box_class" style=" text-align:center;  width:25%; "> </td>
                       </tr>
                       
                       <tr>
                       <td>Milage (1 liter)</td>
                       <td><b>:</b></td>
                       <td><input type="text" id="vehicle_milage" name="vehicle_milage" class="text_box_class" style=" width:25%; text-align:center; "><B> Km</B> </td>
                       </tr>
                       
                       <tr>
                       <td>Start Service Date</td>
                       <td><b>:</b></td>
                       <td><input type="text"  id="start_service_date" name="start_service_date" placeholder="Enter start service date" class="text_box_class"> </td><td></td>
                       </tr>
                       
                       <tr>
                       <td>Insurance Number</td>
                       <td><b>:</b></td>
                       <td><input type="text" id="insurance_number" name="insurance_number" placeholder="Enter insurance number" class="text_box_class"> </td><td></td>
                       </tr>
                       
                       <tr>
                       <td>Insurance Expire Date</td>
                       <td><b>:</b></td>
                       <td><input type="text" id="insurance_expire" name="insurance_expire" placeholder="Enter insurance expire date" class="text_box_class"> </td><td></td>
                       </tr>
                        <tr>
                       <td>Tax Remitted</td>
                       <td><b>:</b></td>
                       <td><input type="text" id="taxrrimed" name="taxrrimed" placeholder="Enter taxrrimed" class="text_box_class"> </td><td></td>
                       </tr>
                       
                       <tr>
                       <td>Vehicle Owner Name</td>
                       <td><b>:</b></td>
                       <td><input type="text" id="vehicle_owner" name="vehicle_owner" placeholder="Enter vehicle owner" class="text_box_class"> </td><td></td>
                       </tr>
                       
                        <tr>
                       <td>Mobile No.</td>
                       <td><b>:</b></td>
                       <td><input type="text" id="mobile_no" name="mobile_no" placeholder="Enter mobile number" class="text_box_class"> </td><td></td>
                       </tr>
                       
                       <tr>
                       <td>Description </td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter description" class="text_area_class"></textarea></td>
                       </tr>
                       
                       <tr>
                           <td colspan="3">
                                <input type="submit" class="submit_process" name="submit_process" value="Save"> 
                               
                               <input type="reset" class="reset_process" name="reset_process" value="Reset">
                              
                               
                           </td>
                       </tr>
                   </table>    
                   
               </div>
                
             
                
                
               
            </div> 
            <div id="last_size_cover"></div>
        </div>
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
        
        <div id="include_fotter_page">
       <?php 
         require_once '../fotter/fotter_page.php';
         
         ?>   
        </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>