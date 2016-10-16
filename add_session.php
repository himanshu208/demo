<?php 
session_start(); 
ob_start();
?>
<?php 
require_once 'connection.php';
if(isset($_SESSION['admin_session_on']))
{
$user_unique_id=$_SESSION['admin_session_on'];
$user_db=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id='$user_unique_id'");
$fetch_user_data=mysql_fetch_array($user_db);
$fetch_user_num_rows=mysql_num_rows($user_db);
if((!empty($fetch_user_data))&&($fetch_user_data!=null)&&($fetch_user_num_rows!=0))
{
  $fetch_school_id=$fetch_user_data['organization_id'];
  $fetch_branch_id=$fetch_user_data['branch_id'];
  
$organisation_db=mysql_query("SELECT * FROM organization_db  WHERE organization_id='$fetch_school_id'"); 
 $fetch_org_data=mysql_fetch_array($organisation_db);
 $fetch_org_num_rows=mysql_num_rows($organisation_db);
if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_rows!=0))
{
$fetch_school_logo=$fetch_org_data['school_logo'];
 
$branch_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");  
$fetch_branch_data=mysql_fetch_array($branch_db);
$fetch_branch_num_rows=mysql_num_rows($branch_db);
 if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
 {

  $fetch_school_name=$fetch_branch_data['branch_name'];
  
 $school_session_db=  mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");
 $fetch_school_session_data=mysql_fetch_array($school_session_db);
 $fetch_school_num_rows=mysql_num_rows($school_session_db);
  if((empty($fetch_school_session_data))&&($fetch_school_session_data==null)&&($fetch_school_num_rows==0))  
  {
      
 if(isset($_POST['submit_data_process']))
 {
  
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
    
     
 $static_id="SESSION";    
 $add_one_no=1;   
 $session_org_db=mysql_query("SELECT * FROM session_db  WHERE id ORDER BY id DESC");
 $fetch_session_org_record=mysql_fetch_array($session_org_db);
 $fetch_session_num_rows=mysql_num_rows($session_org_db);
  if((!empty($fetch_session_org_record))&&($fetch_session_org_record!=null)&&($fetch_session_num_rows!=0))
  {
   $fetch_id=$fetch_session_org_record['id'];
   $add_both_values=$fetch_id+$add_one_no;
   $final_session_id=$static_id."_".$add_both_values;   
  }else
  {
   $final_session_id=$static_id."_".$add_one_no;   
  }
     
  $encrypt_id=  md5(md5($final_session_id));
     
  $session_name=$_POST['session_year'];
  $session_description=$_POST['description'];
  $start_date=$_POST['start_date'];
  $end_date=$_POST['end_date'];
  $default_set=$_POST['default_set'];
  
  if((!empty($session_name))&&(!empty($start_date))&&(!empty($end_date)))
  {
   
      $session_match_db=  mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$final_session_id'
          OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_name='$session_name'");
      $fetch_session_data_check=  mysql_fetch_array($session_match_db);
      $fetch_session_num_rows_check=  mysql_num_rows($session_match_db);
      if((empty($fetch_session_data_check))&&($fetch_session_data_check==null)&&($fetch_session_num_rows_check==0))
      {
       $insert_session_db=  mysql_query("INSERT into session_db values('','$fetch_school_id','$fetch_branch_id'
               ,'$final_session_id','$encrypt_id','$session_name','$session_description','$start_date','$end_date'
               ,'$date','$date_time','$user_unique_id','active','none','active')");
       if($insert_session_db)
       {
           header("Location:add_course.php");
       }else
       {
        $message_show="Request failed,Please try again";     
       }
          
          
      }else
      {
        $message_show="Record already exist in database.";  
      }
      
      
  }else
  {
      $message_show="Please fill all fields.";
  }
  require_once 'pop_up.php';
  
 }
      
{
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dashboard</title>
         
<script type="text/javascript">
 function org_validate()
 {
     var session_name=document.getElementById("session_year").value;
     var start_date=document.getElementById("from").value;
     var end_date=document.getElementById("to").value;
     if(session_name==0)
         {
             alert("Please enter session name");
             document.getElementById("session_year").focus();
             return false;
         }else
             if(start_date==0)
         {
             alert("Please enter start date");
             document.getElementById("from").focus();
             return false;
         }else
             if(end_date==0)
         {
             alert("Please enter end date");
             document.getElementById("to").focus();
             return false;
         }else
             {
                   document.getElementById("ajax_loader_show").style.display="block";    
                  
             }
             
 }
</script>


    </head>
    <body>
        <?php 
include_once 'ajax_loader_page.php';
      ?>
     <div id="include_header_page">
       <?php 
            include_once 'header_page.php';
         ?>
     </div>
       
         <form action="" onsubmit="return org_validate();" method="post" enctype="multipart/form-data">
       
         <div id="main_work_div">
             <div id="main_middle_work_div" style=" width:1200px; ">
                 <div class="forward_step">
            <table cellspacing="0" cellpadding="0" id="full_width_table">
                <tr>
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color"  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                     <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                     <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                     <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                </tr>
                <tr>
                    <td colspan="3" id="color_set_page" class="heading_short_forward">
                   Manage Session Year 
                    </td>
                    <td colspan="3"  class="heading_short_forward">
                   Manage Course/Class  
                    </td>
                    <td colspan="3" class="heading_short_forward">
                   Manage Section 
                    </td>
                    
                    <td colspan="3"  class="heading_short_forward">
                   Manage Category 
                    </td>
                    
                      <td colspan="3"  class="heading_short_forward">
                   Finish Page
                    </td>
                </tr>
                
                
            </table>
        </div>
                 
              
               
               
               <div class="main_work_data" style=" padding-top:20px;">
                   
                   
                   <div class="left_add_work_div" style=" float:none; margin:0 auto;  ">
                   <table cellspacing="2" cellpadding="2" id="session_table_style">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr>
                        <td colspan="3">
                        </td>
                    </tr>
                    <tr><td><b>Session Name</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="session_year" 
                                   placeholder="Enter session name" class="text_box_org"
                                   name="session_year" ></td>
                    </tr>
                     <tr>
                         <td><b>Description</b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter session description" name="description" 
                                      id="address_text_area"></textarea>
                        </td>
                    </tr>
       
                    <tr><td><b>Start Date</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input style=" background-color:whitesmoke; " readonly="readonly" type="text" id="from" 
                                   placeholder="Enter start date" class="text_box_org"
                                   name="start_date" ></td>
                    </tr>
                    <tr><td><b>End Date</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input style=" background-color:whitesmoke; " readonly="readonly" type="text"  id="to" 
                                   placeholder="Enter end date" class="text_box_org"
                                   name="end_date" ></td>
                    </tr>
                    <tr><td><b>Default Set</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td>
                            
                            <input type="checkbox" name="default_set" value="active" 
                                   class="module_list"  style=" float:left;"></td>
                    </tr>
                     <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button"  id="save_button"  value="Save & Continue">   
                        </td>
                    </tr>
               </table>   
                   </div> 
             </div>
         </div>
         </form>
         
        <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="javascript/calenderapi/demos.css">
         
        <script type="text/javascript">
      
$(function() {
$("#from").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"images/calander.png",
      buttonImageOnly: true
    });
    
    $("#to").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"images/calander.png",
      buttonImageOnly: true
    });
    
   
});
    </script>
        
        <div id="include_fotter_page">
          <?php 
             include_once 'superadmin/fotter_page.php';
            ?>
        </div>
    </body>
</html>
<?php 
}
}else
 {
 header("Location:dashboard.php");   
 }

 }else
 {
 header("Location:loginPage.php");   
 }
 
 
 }else
{
     header("Location:loginPage.php");
}


}else
{
    header("Location:loginPage.php");
}

}else
{
     header("Location:loginPage.php");
}

?>