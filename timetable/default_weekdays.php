<?php
//SESSION CONFIGURATION
$check_array_in="time_table";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php
require_once '../connection.php';
if(isset($_POST['submit_process_button']))
{
 if(count($_POST['week_days'])>0)
 {
$week_days=$_POST['week_days']; 
 }else
 {
  $week_days=0;   
 }
 
 
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
 
 $insert_session_id=$_POST['use_inset_session_id'];
$result=mysql_query("SHOW TABLE STATUS LIKE 'time_table_weekdays_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_days_id="WK_DYS_$nextId"; 
$encrypt_id=md5(md5($final_days_id));    
 
 if((!empty($week_days))&&(!empty($final_days_id)))
 {
$implode_days=implode(",",$week_days);

$select_match_db=mysql_query("SELECT * time_table_weekdays_db FROM WHERE $db_main_details_whout_session and is_delete='none'");
$select_num_rows=  mysql_num_rows($select_match_db);
if($select_num_rows==0)
{
$insert_days_db=mysql_query("INSERT into time_table_weekdays_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
        . ",'$final_days_id','$encrypt_id','$implode_days','none','$date','$date_time')");
if((!empty($insert_days_db))&&($insert_days_db))
{
 $message_show="<span>Record save successfully complete</span>";   
}else
{
 $message_show="<span>Request failed,Please try again</span>";     
}

}else
 {
  $message_show="Record already exist in database";   
 }
     
 }else
 {
  $message_show="Please fill all fields.";   
 }
 require_once '../pop_up.php';
}


if(isset($_POST['update_process_button']))
{
 if(count($_POST['week_days'])>0)
 {
$week_days=$_POST['week_days']; 
 }else
 {
  $week_days=0;   
 }
 
 
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
 
$insert_session_id=$_POST['use_inset_session_id'];
$final_days_id=$_POST['update_db_id'];
 if((!empty($week_days))&&(!empty($final_days_id)))
 {
$implode_days=implode(",",$week_days);
$update_db=  mysql_query("UPDATE time_table_weekdays_db SET week_days='$implode_days' WHERE week_days_id='$final_days_id' and is_delete='none'");
if((!empty($update_db))&&($update_db))
{
 $message_show="<span>Record update successfully complete</span>";   
}else
{
 $message_show="<span>Request failed,Please try again</span>";     
}


 }else
 {
  $message_show="Please fill all fields.";   
 }
 require_once '../pop_up.php';
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Default Weekdays</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" >
        function validate_form()
        {
            
        }
        </script> 
    </head>
    <body>
       <?php 
      include_once '../ajax_loader_page_second.php';
      ?> 
        
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="time_table_dashboard.php">Time Table</a></td>
                           <td>/</td>
                           <td><a href="time_table_setting.php">Time Table Setting</a></td>
                           <td>/</td>
                           <td>Default Weekdays</td>
                       </tr>
                   </table>   
               </div>
               <form action="" name="myForm" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
        
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
               <div id="top_show_button"><div id="transport_function" class="Short_menu_show"><b>Default Weekdays</b></div></div>
               
               <?php
               $week_days_db=mysql_query("SELECT * FROM time_table_weekdays_db WHERE $db_main_details_whout_session is_delete='none'");
               $week_data=mysql_fetch_array($week_days_db);
               $week_days_num_rows=mysql_num_rows($week_days_db);
               if((!empty($week_data))&&($week_data!=null)&&($week_days_num_rows!=0))
               {
               $week_days=$week_data['week_days']; 
               $week_days_id=$week_data['week_days_id'];
               }else
               {
                $week_days=0;   
                $week_days_id=0;
               
               }
                 
               $week_array=explode(",",$week_days);
               
               ?>
               <input type="hidden" name="update_db_id" value="<?php echo $week_days_id;?>">     
               <div class="main_work_data" style=" padding-top:20px;">
                   <div class="default_week_days">
                       <table id="week_days_table">
                           <?php
                           $week_days=array("sunday","monday","tuesday","wednesday","thursday","friday","saturday");
                           foreach($week_days as $week_namee)
                           {
                            $week_name_large=ucwords($week_namee);  
                            if(in_array($week_namee,$week_array)==true)
                            {
                            echo " <tr>
                               <td><input name='week_days[]' class='week_days' value='$week_namee' type='checkbox' checked></td><td>$week_name_large</td>
                           </tr>";        
                            }else
                            {
                            
                           echo " <tr>
                               <td><input name='week_days[]' class='week_days' value='$week_namee' type='checkbox'></td><td>$week_name_large</td>
                           </tr>";    
                            }
                           
                           }
                           ?>
                           <tr>
                               <td style=" height:20px; "></td>
                           </tr>
                           <tr>
                               <td colspan="3">
                                   <?php
                                   if(empty($week_days_num_rows))
                                   {
                                   ?>
                                   <input type="submit" class="submit_process" name="submit_process_button" style=" font-weight:bold; " value="Save">   
                              <?php
                                   }else
                                   {
                                   {
                                       ?>
                                     <input type="submit" class="submit_process" name="update_process_button" style=" font-weight:bold; " value="Update">   
                         
                                   <?php
                                   }
                                   }
                              ?>
                               </td>
                           </tr> 
                       </table> 
                   </div>
                   
               </div>
               </form>
            </div> 
        </div>
        
        <div style=" width:100px; height:30px; float: left;  "></div>
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