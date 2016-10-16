<?php
//SESSION CONFIGURATION
$check_array_in="sms_module";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="javascript/sms_javascript.js"></script>
    </head>
    <body>
        <div id="include_header_page">
          <?php 
include_once '../ajax_loader_page_second.php';
          ?>
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
                           <td>SMS (Phone/Email)</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>SMS (Phone/Email)</b></div>
                </div>
                 
                
              <div class="middle_left_div_tag">
                  <div style=" width:100%; height:10px; "></div>
                 <a href="compose_sms.php">
                 <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Compose SMS</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>SMS (Phone) sent class & section wise</span></td>
                        </tr>
                 </table>
                </div> 
               </a>
                  
                  <a href="bulk_sms.php">
                 <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Send Bulk SMS (Phone)</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>SMS (Phone) sent all user</span></td>
                        </tr>
                 </table>
                </div> 
               </a>
                  
                  
                  <a href="send_email.php">
                      <div class="small_dashboard" style=" display:none; ">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Compose Email</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Compose Email & View Report</span></td>
                        </tr>
                 </table>
                </div> 
               </a>  
                  
                  
                  
                  <a href="sms_report.php">
                      <div class="small_dashboard" style=" display:none; ">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Message Report</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>List Of SMS Report</span></td>
                        </tr>
                 </table>
                </div> 
               </a>  
                  
                   <a href="student_allocate_list.php">
                       <div class="small_dashboard" style=" display:none; ">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>SMS Counter</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Total use sms credit</span></td>
                        </tr>
                 </table>
                </div> 
               </a>  
                  
                 
                  
                  
                  <a href="manage_template.php">
                 <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Manage Template</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage SMS Template</span></td>
                        </tr>
                 </table>
                </div> 
               </a>  
                  
                  <a href="../telephonediary/list_of_contact.php">
                 <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Manage Contact</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Add & View Contact</span></td>
                        </tr>
                 </table>
                </div> 
               </a>  
                  
                 
                  
                  
                  <a href="sms_setting.php">
                 <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>SMS Setting</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage Setting</span></td>
                        </tr>
                 </table>
                </div> 
               </a>  
              
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