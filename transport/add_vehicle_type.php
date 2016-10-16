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
 $insert_session_id=$_POST['use_inset_session_id'];
  
$result=mysql_query("SHOW TABLE STATUS LIKE 'transport_vehicle_type_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_vehicle_type_id="VEHCLTYP_$nextId"; 
$encrypt_id=md5(md5($final_vehicle_type_id));
  
  
 if((!empty($final_vehicle_type_id))&&(!empty($vehicle_type))&&(!empty($no_of_vehicle))&&(!empty($insert_session_id)))
 {
  
 $select_match_vehicle_type_db=mysql_query("SELECT * FROM transport_vehicle_type_db WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and vehicle_type_id='$final_vehicle_type_id' and is_delete='none'
     OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$insert_session_id'
         and vehicle_type='$vehicle_type' and is_delete='none'"); 
 $fetch_vehicle_type_data=mysql_fetch_array($select_match_vehicle_type_db);
 $fetch_vehicle_type_num_rows=mysql_num_rows($select_match_vehicle_type_db);
    if((empty($fetch_vehicle_type_data))&&($fetch_vehicle_type_data==null)&&($fetch_vehicle_type_num_rows==0)) 
    {
     
     $insert_db=mysql_query("INSERT into transport_vehicle_type_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'
         ,'$final_vehicle_type_id','$encrypt_id','$vehicle_type','$no_of_vehicle','$description','none'
             ,'$date','$date_time','$user_unique_id','active')");
    if((!empty($insert_db))&&($insert_db)) 
    {
      $message_show="<div class='notification_alert_show' style='color:green;'>Record save successfully complete</div>";   
    }else
    {
    $message_show="<div class='notification_alert_show'>Request failed,please try again</div>";     
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
        <title></title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
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
                           <td>Add Vehicle Type</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Add Vehicle Type</b></div>
                    <a href="view_vehicle_type_details.php">
                        <div class="view_button">View Vehicle Type Details</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
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
                       <td><input type="text" id="vehicle_type" name="vehicle_type" placeholder="Enter vehicle type" class="text_box_class"></td>
                       </tr>
                      
                       
                       <tr>
                       <td>Number of Vehicle <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input onkeypress="javascript:return isNumber (event)" type="text"
                                  id="no_of_vehicle" name="no_of_vehicle" 
                                  class="text_box_class" style=" width:20%; text-align:center;  "> </td>
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
        </div>
        
        
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