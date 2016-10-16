<?php
//SESSION CONFIGURATION
$check_array_in="hostel";
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
 
        $hostel_type_id=$_POST['hostel_type'];
        $hostel_name=$_POST['hostel'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $hostel_facilities=$_POST['hostel_facilities'];
        $warden=$_POST['warden'];
        $insert_session_id=$_POST['use_inset_session_id'];

$result=mysql_query("SHOW TABLE STATUS LIKE 'hostel_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_warden_id="HOSTEL_$nextId"; 
$encrypt_id=md5(md5($final_warden_id));
  
  
 if((!empty($final_warden_id))&&(!empty($hostel_type_id))&&(!empty($hostel_name))
         &&(!empty($phone))&&(!empty($address))&&(!empty($warden))&&(!empty($insert_session_id)))
 {
  
$select_db=mysql_query("SELECT * FROM hostel_db WHERE $db_main_details hostel_type_id='$hostel_type_id'"
        . " and hostel_name='$hostel_name' and is_delete='none'"); 
$fecth_data=mysql_fetch_array($select_db);
$fecth_num_rows=mysql_num_rows($select_db);
if((empty($fecth_data))&&($fecth_data==null)&&($fecth_num_rows==0))
{
 
$insert_db=mysql_query("INSERT into hostel_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
         . ",'$final_warden_id','$encrypt_id','$hostel_type_id','$hostel_name','$phone','$email','$address'"
                . ",'$hostel_facilities','$warden','none','$date','$date_time'"
         . ",'$fecth_user_unique')");   
    
if((!empty($insert_db))&&($insert_db))
{
 $message_show="<div class='notification_alert_show' style='color:green;'>Record save successfully complete.</div>";
     
}else
{
  $message_show="<div class='notification_alert_show'>Request failed,Please try again.</div>";
    
}
}  else {
   $message_show="<div class='notification_alert_show'>Record already exist in database.</div>";
  
}
     
     
 

 }  else {
    $message_show="<div class='notification_alert_show'>Please fill all fields.</div>";
  
 }

 require_once '../pop_up.php';
}


?>





<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add Hostel</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
        function validate_form() 
        {
               var hostel_type=document.getElementById("hostel_type").value;
               var hostel=document.getElementById("hostel").value;
               var phone=document.getElementById("phone").value;
               var address=document.getElementById("address").value;
               var warden=document.getElementById("warden").value;
               if(hostel_type==0)
               {
                  alert("Please select hostel type");
                  document.getElementById("hostel_type").focus();
                  return false;
               }else
                   if(hostel==0)
               {
                   alert("Please enter hostel name");
                   document.getElementById("hostel").focus();
                   return false;
               }else
                   if(phone==0)
               {
                  alert("Please enter phone number");
                  document.getElementById("phone").focus();
                  return false;
               }else
                     if(isNaN(phone))
               {
                  alert("Please enter vaild phone number");
                  document.getElementById("phone").focus();
                  return false;
               }else
                   if(address==0)
               {
                  alert("Please enter address");
                  document.getElementById("address").focus();
                  return false;
               }else
               if(warden==0)
               {
                alert("Please select warden");
                document.getElementById("warden").focus();
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
                           <td><a href="hostel_dashboard.php">Hostel</a></td>
                           <td>/</td>
                           <td><a href="hostel_setting.php">Hostel Setting</a></td>
                           <td>/</td>
                           <td>Add Hostel</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Add Hostel</b></div>
                    <a href="view_hostel_list.php">
                        <div class="view_button">View Hostel list</div></a>
                </div>
             
                
               <div class="middle_left_div_tag" style=" margin-top:20px; ">
                   <table cellsapcing="4" cellpadding="4" class="table_middle" style=" font-size:12px; ">
                       <tr>
                           <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                       </tr>
                        <tr>
                       <td>Hostel Type<sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                           <select class="select_class" id="hostel_type" name="hostel_type">
                               <option value="0">---Select Hostel Type---</option> 
                               <?php
                               $hostel_type_db=mysql_query("SELECT * FROM  hostel_type_db WHERE $db_main_details is_delete='none'");
                               while ($hostel_data=mysql_fetch_array($hostel_type_db))
                               {
                                  $hostel_unique_id=$hostel_data['hostel_type_unique_id'];
                                  $hostel_type_name=$hostel_data['hostel_type'];
                                  echo "<option value='$hostel_unique_id'>$hostel_type_name</option>";
                               }  
                                     
                               
                               ?>
                               
                           </select>   
                       </td>
                       <td><a href="manage_hostel_type.php"><div class="add_button_styles">Add</div></a></td>
                       </tr>
                       <tr>
                       <td>Hostel <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="hostel" name="hostel" placeholder="Please enter hostel name" class="text_box_class"></td>
                       </tr>
                        <tr>
                       <td>Phone <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" onkeypress="javascript:return isNumber (event)" id="phone" name="phone" placeholder="Please enter phone number" class="text_box_class"></td>
                       </tr>
                       <tr>
                       <td>Email</td>
                       <td><b>:</b></td>
                       <td><input type="text" id="email" name="email" placeholder="Please enter email id" class="text_box_class"></td>
                       </tr>
                       <tr>
                           <td>Address <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><textarea id="address" name="address" placeholder="Please enter address" class="text_area_class"></textarea></td>
                       </tr>
                       <tr>
                       <td>Hostel Facilities </td>
                       <td><b>:</b></td>
                       <td><textarea id="hostel_facilities" name="hostel_facilities" placeholder="Enter hostel facilities" class="text_area_class"></textarea></td>
                       </tr>
                       <tr>
                       <td>Warden <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                           <select class="select_class" id="warden" name="warden">
                               <option value="0">---Select Warden---</option> 
                               <?php
                               $hostel_warden_db=mysql_query("SELECT * FROM  hostel_warden_db WHERE $db_main_details is_delete='none'");
                               while ($hostel_data=mysql_fetch_array($hostel_warden_db))
                               {
                                  $hostel_unique_id=$hostel_data['warden_unique_id'];
                                  $hostel_warden_name=$hostel_data['warden_name'];
$select_db=mysql_query("SELECT * FROM hostel_db WHERE $db_main_details warden_id='$hostel_unique_id'"
        . " and is_delete='none'"); 
$fecth_data=mysql_fetch_array($select_db);
$fecth_num_rows=mysql_num_rows($select_db);
if((!empty($fecth_data))&&($fecth_data!=null)&&($fecth_num_rows!=0))
{                  
  echo "<option value='$hostel_unique_id' disabled>$hostel_warden_name (already allot)</option>";                                 
}else
{
  echo "<option value='$hostel_unique_id'>$hostel_warden_name</option>";   
}
                                 
                               }  
                                     
                               
                               ?>
                               
                           </select>       
                       </td>
                       <td><a href="add_warden.php"><div class="add_button_styles">Add</div></a></td>
                       </tr>
                       <tr>
                           <td style=" height:10px; "></td>
                       </tr>
                       <tr>
                           <td colspan="3">
                              <input type="submit" class="submit_process" name="submit_process" value="Save"> 
                               
                               
                               <input type="reset" class="reset_process" name="reset_process" value="Reset">
                               
                           </td>
                       </tr>
                   </table>    
                   
               </div>
               <div style=" width:20%; height:100px; float:left;  "></div>
             
                
                
               
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