<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
         
    </head>
    <body>
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
                           <td>Academic</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button"><div id="transport_function" class="Short_menu_show"><b>Academic</b></div></div>
                
                    
               <a href="manage_session.php">   
                <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Manage Session</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Add New Session Or View Session Details</span></td>
                        </tr>
                    </table>
                </div></a> 
                
                
               
               <a href="manage_class.php">
               <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Manage Class/Course</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Add New & View Class/Course Details</span></td>
                        </tr>
                    </table>
               </div>
               </a>
               
               
               <a href="manage_section.php">
                 <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Manage Section</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Add New & View Section Details</span></td>
                        </tr>
                 </table>
                 </div> </a>
               
                
                <a href="manage_section.php">
                 <div style="display:none;" class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Class Teacher Allocation</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage Class Teacher</span></td>
                        </tr>
                 </table>
                 </div> </a>
               
               
               <a href="manage_category.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Manage Category</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Add New & View Category Details</span></td>
                        </tr>
                 </table>
                </div>
                </a>
               
               <a href="manage_house.php">
                <div style="display:none;"  class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Manage House</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Add New & View Category Details</span></td>
                        </tr>
                 </table>
                </div>
                </a>
               
               
               
                <a href="subject.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Manage Subject</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage Subject</span></td>
                        </tr>
                 </table>
                </div></a> 
              
              
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