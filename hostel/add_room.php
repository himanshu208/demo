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
 
        $hostel_id=$_POST['hostel'];
        $room_no=$_POST['room_no'];
        $floor_no=$_POST['floor_no'];
                $no_of_bed=$_POST['no_of_bed'];
                $rent=$_POST['rent'];
                $room_key_no=$_POST['room_key_no'];
                $room_facilities=$_POST['room_facilities'];
                
        $insert_session_id=$_POST['use_inset_session_id'];

$result=mysql_query("SHOW TABLE STATUS LIKE 'hostel_room_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_room_id="ROOM_$nextId"; 
$encrypt_id=md5(md5($final_room_id));
  
  
 if((!empty($final_room_id))&&(!empty($hostel_id))&&(!empty($room_no))
         &&(!empty($floor_no))&&(!empty($no_of_bed))&&(!empty($rent))&&(!empty($insert_session_id)))
 {
  
$select_db=mysql_query("SELECT * FROM hostel_room_db WHERE $db_main_details hostel_id='$hostel_id'"
        . " and room_no='$room_no' and is_delete='none'"); 
$fecth_data=mysql_fetch_array($select_db);
$fecth_num_rows=mysql_num_rows($select_db);
if((empty($fecth_data))&&($fecth_data==null)&&($fecth_num_rows==0))
{
 
$insert_db=mysql_query("INSERT into hostel_room_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
         . ",'$final_room_id','$encrypt_id','$hostel_id','$room_no','$floor_no','$no_of_bed','$rent'"
                . ",'$room_key_no','$room_facilities','none','$date','$date_time'"
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
        <title>Add Room</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
        function validate_form() 
        {
               var hostel=document.getElementById("hostel").value;
                var room_no=document.getElementById("room_no").value;
                var floor_no=document.getElementById("floor_no").value;
                        var bed_no=document.getElementById("no_of_bed").value;
                        var rent=document.getElementById("rent").value;
               
               if(hostel==0)
               {
                  alert("Please select hostel");
                  document.getElementById("hostel").focus();
                  return false;
               }else
                   if(room_no==0)
               {
                  alert("Please enter room number");
                  document.getElementById("room_no").focus();
                  return false;
               }else
                   if(floor_no==0)
               {
                  alert("Please enter floor number");
                  document.getElementById("floor_no").focus();
                  return false;
               }else
                   if(bed_no==0)
               {
                  alert("Please enter number of bed");
                  document.getElementById("no_of_bed").focus();
                  return false;
               }else
                   if(rent==0)
               {
                  alert("Please enter room rent/fate");
                  document.getElementById("rent").focus();
                  return false;
               }
               
        }
        </script>
        <style>
          #hostel_chosen{ width:330px; }  
        </style>
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
                           <td>Add Room</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Add Room</b></div>
                    <a href="view_room_list.php">
                        <div class="view_button">View Room list</div></a>
                </div>
             
                
               <div class="middle_left_div_tag" style=" margin-top:20px; ">
                   <table cellsapcing="4" cellpadding="4" class="table_middle" style=" font-size:12px; ">
                       <tr>
                           <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                       </tr>
                       <tr>
                       <td>Hostel <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                           <select id="hostel" data-placeholder="---Select Hostel---" 
                                   class="chosen-select" style="width:330px; font-weight:100;  " tabindex="-1" name="hostel">
                               <option value="0"></option> 
                               <?php
                               $hostel_type_db=  mysql_query("SELECT * FROM hostel_type_db WHERE $db_main_details is_delete='none'");
                               while ($hostel_type_data=mysql_fetch_array($hostel_type_db))
                               {
                                $hostel_type_id=$hostel_type_data['hostel_type_unique_id'];
                                 $hostel_type=$hostel_type_data['hostel_type'];   
                                 $hostel_db=mysql_query("SELECT * FROM hostel_db WHERE $db_main_details hostel_type_id='$hostel_type_id' and is_delete='none'");
                                 $hostel_num_rows=mysql_num_rows($hostel_db);
                                 if(!empty($hostel_num_rows))
                                 {
                                 
                                 echo "<optgroup label='$hostel_type'>";      
                               while ($hostel_data=mysql_fetch_array($hostel_db))
                               {
                                  $hostel_unique_id=$hostel_data['hostel_unique_id'];
                                  $hostel_name=$hostel_data['hostel_name'];
                                  echo "<option value='$hostel_unique_id'>$hostel_name</option>";
                               } 
                               echo "</optgroup>"; 
                               }
                               }
                                
                                     
                               
                               ?>
                               
                           </select>   
                       </td>
                       <td><a href="manage_hostel_type.php"><div class="add_button_styles">Add</div></a></td>
                        </tr>
                       <tr>
                       <td>Room No. <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text"  id="room_no" name="room_no" placeholder="Please enter room number" class="text_box_class"></td>
                       </tr>
                       <tr>
                       <td>Floor No. <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="floor_no" name="floor_no" placeholder="Please enter floor number" class="text_box_class"></td>
                       </tr>
                       <tr>
                       <td>No. Of Bed <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" autocomplete="off" onkeypress="javascript:return isNumber (event)" id="no_of_bed" 
                                  name="no_of_bed" style=" width:39%; text-align:center; " class="text_box_class"></td>
                       </tr>
                       <tr>
                       <td>Rent/Fare <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><b><?php echo $fetch_currency;?> </b><input type="text" autocomplete="off" onkeypress="javascript:return isNumber (event)" id="rent"
                                                                       name="rent" style=" width:33%; text-align:right; " class="text_box_class"></td>
                       </tr>
                       
                       <tr>
                       <td>Room Key No.</td>
                       <td><b>:</b></td>
                       <td><input type="text" id="room_key_no" name="room_key_no" placeholder="Please enter room key number" class="text_box_class"></td>
                       </tr>
                       <tr>
                       <td>Room Facilities </td>
                       <td><b>:</b></td>
                       <td><textarea id="room_facilities" name="room_facilities" placeholder="Enter room facilities" class="text_area_class"></textarea></td>
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
             <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
       
   <link rel="stylesheet" href="../javascript/combosearch/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
  </style>
            
  <script src="../javascript/combosearch/chosen.jquery.js" type="text/javascript"></script>
  <script src="../javascript/combosearch/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
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