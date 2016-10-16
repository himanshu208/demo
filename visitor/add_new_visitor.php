
<?php 
session_start(); 
ob_start();
?>
<?php 
require_once '../connection.php';
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
  $fetch_accout_type=$fetch_user_data['account_type'];
  $fecth_user_unique=$fetch_user_data['user_admin_id'];
$organisation_db=mysql_query("SELECT * FROM organization_db WHERE organization_id='$fetch_school_id'"); 
 $fetch_org_data=mysql_fetch_array($organisation_db);
 $fetch_org_num_rows=mysql_num_rows($organisation_db);
if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_rows!=0))
{
$fetch_school_logo="../".$fetch_org_data['school_logo'];

$branch_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");  
$fetch_branch_data=mysql_fetch_array($branch_db);
$fetch_branch_num_rows=mysql_num_rows($branch_db);
 if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
 {
$fetch_branch_unique_db_id=$fetch_branch_data['branch_id'];
$fetch_school_name=$fetch_branch_data['branch_name'];
 

if($fetch_accout_type=="branch_head_admin")
{
 $manage_module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and admin_type='branch_head_admin'");   

}else
{
$manage_module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and admin_id='$user_unique_id'");   
}
$fetch_module_data=mysql_fetch_array($manage_module_db);
$fetch_module_num_rows=mysql_num_rows($manage_module_db);
 if((!empty($fetch_module_data))&&($fetch_module_data!=null)&&($fetch_module_num_rows!=0))
 {
  $fetch_module_list=$fetch_module_data['module'];
  $explode_module_array=explode(",",$fetch_module_list);
  $check_array_in="system_setting";
  $search_match_module= in_array($check_array_in,$explode_module_array);
  if($search_match_module==true)
  {
      
 {
  ?>
<?php 
$log_out_page="../account_logout.php";
require '../page_url_link.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add New Visitor</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        
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
                           <td>Add New Visitor</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Add New Visitor</b></div>
              <a href="add_mark_attendance_type.php"> <div class="view_button">View Visitor Details</div> </a> 
                   </div>
                
               <div class="main_work_data" style=" float:left;  padding-top:20px;">
                 <?php 
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
    
                   ?>
                 
                   <div id="visitor_log_id">
                       <div class="visit_log">
                           Visit Log
                       </div>
                    <table cellspacing="2" cellpadding="2" class="visitor_log_table">
                        <tr>
                            <td><b>Visit ID</b></td>
                            <td><b>:</b></td>
                            <td><input class="visitor_log_text" type="text" value="#D20M07Y15V1" readonly="readonly"></td>
                            <td><b>Serial ID</b></td>
                            <td><b>:</b></td>
                            <td><input class="visitor_log_text" readonly="readonly" value="1" type="text"></td>
                            <td><b>Today Date</b></td>
                            <td><b>:</b></td>
                            <td><input class="visitor_log_text" value="<?php  echo $date;?>" readonly="readonly" type="text"></td>
                        </tr>
                        
                        
                        <tr>
                            <td><b>To Meet</b></td>
                            <td><b>:</b></td>
                            <td>
                             <select class="select_box_visit_log">
                                    <option>---Select To Meet---</option>
                                    <option>Official</option>
                                </select>   
                            </td>
                            
                            <td><b>Status</b></td>
                            <td><b>:</b></td>
                            <td>
                                <select class="select_box_visit_log">
                                    <option>---Select Status---</option>
                                    <option>Arrived &  Left</option>
                                </select>
                            </td>
                            
                            <td><b>Gate No.</b></td>
                            <td><b>:</b></td>
                            <td><input class="visitor_log_text"  value="1" type="text"></td>
                            
                            <td><b>Purpose</b></td>
                            <td><b>:</b></td>
                            <td>
                                <select class="select_box_visit_log">
                                    <option>---Select Purpose---</option>
                                    <option>Official</option>
                                </select>
                            </td>
                         </tr>
                         
                         <tr>
                             <td><b>In Time</b></td>
                             <td><b>:</b></td>
                             <td><input class="text_box_in_time" value="<?php  echo $date_time;?>" type="text"></td>
                             
                             <td><b>Out Time</b></td>
                             <td><b>:</b></td>
                             <td><input class="text_box_in_time" value="<?php  echo $date_time;?>" type="text"></td>
                             <td><b>Visit Duration</b></td>
                             <td><b>:</b></td>
                             <td></td>
                             <td><b>Visit Remarks</b></td>
                             <td><b>:</b></td>
                             <td colspan="5">
                                 <textarea class="text_area_small"></textarea>
                             </td>
                         </tr></table></div> 
                  
                   
                   
                   
                   <div id="visitor_log_id" style="margin-top:30px; ">
                      
                       <div class="visit_log">
                           Visitor Details
                       </div>
                       <div style=" width:935px; height:auto; border-right:1px solid whitesmoke; float:left;   ">
                           <table  id='visitor_table'>
                           <tr>
                               
                               <td><b>Name</b></td>
                               <td><b>:</b></td>
                               <td><input class="visitor_text_box" type="text"></td>
                               
                               <td><b>Is Regular Visit</b></td>
                               <td><b>:</b></td>
                               <td><input class="check_box_styling" type="checkbox"></td>
                               
                               
                               <td><b>Is V.I.P Visit</b></td>
                               <td><b>:</b></td>
                               <td style=" width:100px; "><input class="check_box_styling" type="checkbox"></td>
                               
                               <td>
                                   <div class='image_selection'></div>   
                                   
                               </td>  
                           </tr>
                           <tr>
                               <td><b>Email</b></td>
                               <td><b>:</b></td>
                               <td><input class="visitor_text_box" type="text"></td>
                               
                               <td><b>Phone</b></td>
                               <td><b>:</b></td>
                               <td><input class="visitor_text_box" type="text"></td>
                               
                               <td><b>Mobile No.</b></td>
                               <td><b>:</b></td>
                               <td><input class="visitor_text_box" type="text"></td>
                               
                               
                           </tr>
                           
                           <tr>
                               <td><b>Visitor Type</b></td>
                               <td><b>:</b></td>
                               <td><input class="visitor_text_box" type="text"></td>
                               
                               <td><b>Company</b></td>
                               <td><b>:</b></td>
                               <td><input class="visitor_text_box" type="text"></td>
                               
                               <td><b>Designation</b></td>
                               <td><b>:</b></td>
                               <td><input class="visitor_text_box" type="text"></td>
                              </tr>
                              
                              
                              <tr>
                               <td><b>Vehicle</b></td>
                               <td><b>:</b></td>
                               <td><input class="visitor_text_box" type="text"></td>
                               
                               <td><b>Vehicle Number</b></td>
                               <td><b>:</b></td>
                               <td><input class="visitor_text_box" type="text"></td>
                               
                               <td><b>Parking Receipt No.</b></td>
                               <td><b>:</b></td>
                               <td><input class="visitor_text_box" type="text"></td>
                              </tr>
                              
                              
                              <tr>
                                  <td><b>Material<br/> Carried<br/> Inside</b></td>
                                  <td><b>:</b></td>
                                  <td colspan="2"><textarea class='text_area_full_big'></textarea></td>
                                  <td colspan="5" rowspan="4" style=" vertical-align: top;">
                                      <div class="other_person" style=" margin-left:3px; ">
                                      <table class="person_selection_table">
                                          <tr>
                                              <td><input class="check_box_styling" name="person_selection" type="radio" checked></td><td>Alone Person</td>
                                              <td><input class="check_box_styling"  name="person_selection" type="radio"></td><td>Multiple Person</td>
                                          </tr>
                                      </table> 
                                      </div>
                                      
                                      <div id="multiple_person" >
                                          <table  class="multiple_person_table">
                                              <tr>
                                                  <td class="visitor_th_style">Person Name</td>
                                                  <td class="visitor_th_style">Mobile No.</td>
                                                  <td class="visitor_th_style">Upload Photo</td>
                                              </tr>
                                              <tr>
                                                  <td><input class="visitor_text_box" type=""></td>
                                                  <td><input class="visitor_text_box" type=""></td>
                                                  <td></td>
                                              </tr>
                                          </table>   
                                      </div>
                                  </td>
                                  
                              </tr>
                              
                              <tr>
                                  <td><b>Address</b></td>
                                  <td><b>:</b></td>
                                  <td colspan="2"><textarea class='text_area_full_big'></textarea></td>
                              </tr>
                           
                              <tr>
                                  <td><b>Remark</b></td>
                                  <td><b>:</b></td>
                                  <td colspan="2"><textarea class='text_area_full_big'></textarea></td>
                              </tr>
                           
                              
                       </table>
                       </div>
                      <div class="person_photos">
                          <center>
                          <table>
                              <tr>
                                  <td colspan="2"><div class="person_self_picture"></div></td>
                              </tr>  
                              <td><input type="button" value="Upload Photo"</td>
                              <td><input type="button" value="Add Camera"></td>
                          </table>
                              </center>
                       </div> 

                       
                       
                       
                         
                       
                   </div>
                   
                   <table style=" float:right; margin-top:5px;  ">
                           <tr>
                                  <td>
                                      <input type="button" class="button_styling" value="Save">
                                      <input type="button" class="button_styling" style=" background-color: deeppink" value="Reset">
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
    </body>
</html>
<?php 
  }
  }else
  {
   header("Location:../404_error.php");   
  }
 }else
 {
 header("Location:../loginPage.php");   
 }
  
  
 }else
 {
 header("Location:../loginPage.php");   
 }
 
 
 }else
{
     header("Location:../loginPage.php");
}


}else
{
    header("Location:../loginPage.php");
}

}else
{
     header("Location:../loginPage.php");
}
?>