<?php
//SESSION CONFIGURATION
$check_array_in="event";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php 

   $message_show="";
   if(isset($_POST['data_submit']))
   {
       
 date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

$result=mysql_query("SHOW TABLE STATUS LIKE 'event_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_cln_id="EVENT_$nextId"; 
$encrypt_id=md5(md5($final_cln_id));
       
    $session_id=$_POST['use_inset_session_id']; 
    $event_name=$_POST['event_name'];
    $event_description=$_POST['event_description'];
    $event_type_id=$_POST['event_type'];
    $start_date=$_POST['start_data'];
    $end_date=$_POST['end_date'];
    $start_time=$_POST['start_time'];
    $end_time=$_POST['end_time'];
    
    $start_date=$start_date." ".$start_time;
    $end_date=$end_date." ".$end_time;
    
    
    $incharge_name=$_POST['incharge_name'];
    $incharge_mobile_no=$_POST['incharge_mobile_no'];
    $event_for=$_POST['event_for'];       
            
           
            if((!empty($session_id))&&(!empty($final_cln_id))&&(!empty($start_date))
                    &&(!empty($end_date))&&(!empty($event_name))&&(!empty($event_type_id))&&(!empty($event_for)))
            {
            $select_db=mysql_query("SELECT * FROM event_db WHERE $db_main_details start_date='$start_date' and end_date='$end_date'"
                    . " and event_name='$event_name' and event_type_id='$event_type_id' and is_delete='none'");
            $fecth_db_data=  mysql_fetch_array($select_db);
            $fecth_db_num_rows=  mysql_num_rows($select_db);
            
            if((empty($fecth_db_data))&&($fecth_db_data==null)&&($fecth_db_num_rows==0))
            {
              
             $insert_db=mysql_query("INSERT into event_db values('','$fetch_school_id','$fetch_branch_id'"
                     . ",'$session_id','$final_cln_id','$encrypt_id','$event_name','$event_type_id','$event_description'"
                     . ",'$start_date','$end_date','$incharge_name','$incharge_mobile_no','$event_for'"
                     . ",'none','$date','$date_time','$fecth_user_unique')");
             if($insert_db)
             {
             $message_show="<span style='color:green;'>Record save successfully complete</span>";   
             
             }  else {
                $message_show="<span style='color:red;'>Sorry,Request failed, Please try again.</span>";   
          
             }
                
                
                
            }  else {
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
        <title>Add Event</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
         function validateForm()
         {
           var title=document.getElementById("event_name").value;  
           var event_type=document.getElementById("event_type").value; 
           var event_description=document.getElementById("event_description").value; 
           var start_date=document.getElementById("start_date").value;
           var end_date=document.getElementById("end_date").value;
            if(title==0)
           {
              alert("Please enter event name");
              document.getElementById("event_name").focus();
              return false;
           }else
                 if(event_type==0)
           {
              alert("Please select event type");
              document.getElementById("event_type").focus();
              return false;
           }else
                if(event_description==0)
           {
              alert("Please select event description");
              document.getElementById("event_description").focus();
              return false;
           }else
           if(start_date==0)
           {
              alert("Please enter start date");
              document.getElementById("start_date").focus();
              return false;
           }else
               if(end_date==0)
           {
              alert("Please enter end date");
              document.getElementById("end_date").focus();
              return false;
           }
              
         }
        </script>
    </head>
    <body>
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" method="post" onsubmit="return validateForm();" enctype="multipart/form-data">
       
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="event_list.php">List Of Event Type</a></td>
                           <td>/</td>
                           <td>Add Event</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Add Event</b></div>
              <a href="../calender/calender.php"> <div class="view_button">Calendar</div> </a> 
              <a href="event_list.php"> <div class="view_button"  style=" margin-right:10px; background-color:darkslateblue;  ">List Of Event</div> </a> 
                   </div>
                
               <div class="main_work_data" style=" padding-top:20px;">
               <div id="calander_show">
               <?php
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
               ?>
                   <table cellspacing="3" cellpadding="7" class="insert_table">
                       <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                      </tr>
                       <tr>
                          <td><b>Event Name<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input type="text" name="event_name" placeholder='Please enter event name' id="event_name"  class="text_box_styles"  autocomplete="off"> </td>
                      </tr>
                      
                      <tr>
                          <td><b>Event Type<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> 
                              <select class="select_class" name="event_type" id="event_type" style=" width:280px; ">
                                  <option value='0'>---Select---</option> 
                                  <?php
                    $event_type_db=mysql_query("SELECT * FROM event_type_db WHERE $db_main_details is_delete='none'");   
                     while ($fetch_event_type_data=mysql_fetch_array($event_type_db))
                     {
                
                                 $fetch_event_type_unique_id=$fetch_event_type_data['event_type_id'];
                                 $fetch_event_type_name=$fetch_event_type_data['event_type'];
                               
                                echo "<option value='$fetch_event_type_unique_id'>$fetch_event_type_name</option>";   
                     }           
                                  ?>
                              </select>
                          </td>
                      </tr>
                       <tr>
                          <td><b>Event Description </b></td><td><b>:</b></td>
                          <td>
                              <textarea name="event_description" id="event_description" class="text_area_styles"></textarea>   
                          </td>
                      </tr>
                      <tr>
                          <td><b>Start Date <sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input type="text" name="start_data"  id="start_date" class="text_box_styles" value="<?php echo $date;?>" style=" width:40%; " autocomplete="off"> 
                              <input type="text" class="text_box_styles" id="start_time" name="start_time" style=" width:25%; margin-left:40px;   " value="<?php echo $time_current;?>"> <img style=" margin-top:0px; position:absolute; margin-left:4px;   " src="../images/time_icon.png">
                          </td>
                      </tr>
                      <tr>
                          <td><b>End Date <sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input type="text" name="end_date" id="end_date"  class="text_box_styles" style=" width:40%; " value="<?php echo $date;?>"  autocomplete="off"> 
                              <input type="text" class="text_box_styles" name="end_time" id="end_time" style=" width:25%; margin-left:40px;   "  value="<?php echo $time_current;?>"> <img style=" margin-top:0px; position:absolute; margin-left:4px;   " src="../images/time_icon.png">
                          </td>
                      </tr>
                    
                      <tr>
                          <td><b>Organizer/Incharge Name </b></td><td><b>:</b></td>
                          <td> <input type="text" name="incharge_name" placeholder="Please enter organizer/incharge name" id="incharge_name"  class="text_box_styles"  autocomplete="off"> </td>
                      </tr>
                      <tr>
                          <td><b>Organizer/Incharge Mobile No. </b></td><td><b>:</b></td>
                          <td> <input type="text" name="incharge_mobile_no" placeholder="Please enter organizer/incharge mobile no." id="incharge_mobile_no"  class="text_box_styles"  autocomplete="off"> </td>
                      </tr>
                      <tr>
                          <td><b>Event For<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> 
                         <select class="select_class" name="event_for" id="event_for" style=" width:280px; ">
                                  <option value='common_to_all'>Common to all</option>
                                  <option value='class_section'>Selected Class/Section</option>
                                  <option value='department_designation'>Selected Department/Designation</option>
                         </select>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="4">
                              <div id="class_course_div"></div> 
                              
                              <div id="department_div"></div>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="3">
                              <input type="submit" name="data_submit" class="button_styling" style=" margin-right:50px; " value="Save">   
                          </td> 
                      </tr>
                      
                   </table>
                   
                   
               </div>      
               </div> 
               </div>
               </form>
        
        <div id="include_fotter_page">
       <?php 
         require_once '../fotter/fotter_page.php';
         
         ?>   
        </div>
        
<link type="text/css" rel="stylesheet" href="editor_tool/demo.css">
<link type="text/css" rel="stylesheet" href="editor_tool/jquery-te-1.4.0.css">
<script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="editor_tool/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script>
	$('#editor_tool').jqte();
	
	
</script>      
     
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
$("#start_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      yearRange:'1950:2013',
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    $("#end_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      yearRange:'1950:2013',
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