<?php
//SESSION CONFIGURATION
$check_array_in="assignment";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Assignment</title>
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
                           <td>Assignment & H.W</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Assignment</b></div>
                </div>
                 
                
              <div class="middle_left_div_tag">
                  <div style=" width:100%; height:10px; "></div>
                  <a href="list_of_assigment.php">
                 <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Assignment</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage all class assignment</span></td>
                        </tr>
                 </table>
                </div> 
               </a>
                  
                  
                  <a href="list_of_notes.php">
                 <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Notes</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage all class notes</span></td>
                        </tr>
                 </table>
                </div> 
               </a>
                  
                  <a href="list_of_home_work.php">
                 <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Home Work</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage Home Work</span></td>
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