<?php
require_once 'config/dashboard_config.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dashboard</title>
        <link rel="icon" href="<?php  $fetch_school_logo?>" type="image/gif" sizes="20x20">
         <link href="stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="javascript/loadImg.js"></script>
        <script>
$(function(){
        $('img').imgPreload()
    });
</script>
        </head>
    <body>
        
        <div id="session_not_active">
            <div id="session_expire_show">Please Contact PIXABYTE.<br/><br/>
                <b>Contact Number</b> : 9582456009<br/><br/>
                <b>Email</b><br/>
            info@pixabyte.in</div>   
        </div>
        
        
        
        
        
        
        
        <?php 
include_once 'ajax_loader_page.php';
      ?>
     <div id="include_header_page">
       <?php 
            include_once 'header/header_page.php';
         ?> 
     </div>
        <input type="hidden" name="use_inset_session_id" id="insert_session_id" value="<?php  echo $fecth_session_id_set;?>">   
        
        
        
      <input type="hidden" id="input_show_id_1" value="0">
        <input type="hidden" id="input_show_id_2" value="0">
        
        <script type="text/javascript">
    function show_button_one(number)
    {
     document.getElementById("show_first_div_2").style.transitionDuration="0s";
     document.getElementById("show_first_div_2").style.width="0%";
    document.getElementById("show_button_1").style.display="none";
    
    document.getElementById("show_first_div_1").style.transitionDuration="0.7s";
     document.getElementById("show_first_div_1").style.width="100%";
     document.getElementById("show_button_2").style.display="block";
    
   
    }
    
    function show_button_two(number)
    {
    document.getElementById("show_first_div_1").style.transitionDuration="0s";
     document.getElementById("show_first_div_1").style.width="0%";
      document.getElementById("show_button_1").style.display="block";
    
    document.getElementById("show_first_div_2").style.transitionDuration="0.7s";
     document.getElementById("show_first_div_2").style.width="100%";
     document.getElementById("show_button_2").style.display="none";
    
    
    }
    
    function close_button_one(number)
    {
     document.getElementById("show_first_div_1").style.transitionDuration="0s";
     document.getElementById("show_first_div_1").style.width="0%";
     document.getElementById("show_button_1").style.display="block";
     
      document.getElementById("show_first_div_2").style.transitionDuration="0.7s";
     document.getElementById("show_first_div_2").style.width="100%";
     document.getElementById("show_button_2").style.display="none";
      
    }
    
     function close_button_two(number)
    {
     document.getElementById("show_first_div_2").style.transitionDuration="0s";
     document.getElementById("show_first_div_2").style.width="0%";
     document.getElementById("show_button_2").style.display="block";
      
    document.getElementById("show_button_1").style.display="none";
    document.getElementById("show_first_div_1").style.transitionDuration="0.7s";
     document.getElementById("show_first_div_1").style.width="100%";
     
    }
    </script>
      
   
    
        
        <div id="main_work_div">
            <div id="left_side_fixed_button">
                <abbr tittle="Close"><div onclick="show_button_one('1')" class="show_left_slider" id="show_button_1"></div></abbr>    
                <div onclick="show_button_two('2')" class="show_left_slider" id="show_button_2"></div>    
                
            </div>
            
            
            <div class="second_full_width" style=" display:block; " id="show_first_div_1">
                <div class="middle_center_div">
                    <div class="first_left_work_div">
                        
                        
                      <?php 
 if(module("admission",$explode_module_array)==1)
 {
                        ?>
                        
                        <a border="0" href="admission/registration.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image" src="images/module_icon/add_users.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Admission</div></td>
                                </tr>
                            </table>
                        </div></a>
                  <?php 
  }
                    ?>
                      

  <?php 
 if(module("search_student",$explode_module_array)==1)
 {
                        ?>
                         <a border="0" href="search/search.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/user_search.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Student Search</div></td>
                                </tr>
                            </table>
                        </div></a>
<?php 
  }
?>  
                      
                        
                        
                        
                     <?php 
 if(module("parent",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="parent/parent_list.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/parents.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Parents</div></td>
                                </tr>
                            </table>
                        </div></a>
<?php 
  }
?>  
                      
                        
                        
                        
                        
                        
                        
                    <?php 
 if(module("transport",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="transport/transport_dashboard.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/school_bus.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Transport</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        
                       <?php 
  }
                    ?> 
                        
                        
                      <?php 
 if(module("hostel",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="hostel/hostel_dashboard.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/hostel.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Hostel</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                    ?>
                        
                        
                        
                        <?php 
 if(module("library",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="library/library.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/book_library.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Library</div></td>
                                </tr>
                            </table>
                        </div></a>
                      
  <?php 
  }
  ?>
                        
                        
                        
                       <?php 
 if(module("calender",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="calender/calender_report.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/calendar_icon.jpg"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Calender</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                    ?>
                        
                        <?php 
 if(module("account",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="account/financeindex.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/finance_1.ico"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Account/Finance</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                    ?>
                        
                          <?php 
 if(module("attendance",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="attendance/attendance_dashboard.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/attendance.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Attendance</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                    ?>
                        
                         <?php 
 if(module("time_table",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="timetable/time_table_dashboard.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/timetable.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Time Table</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                    ?>
                        
                        
                       <?php 
 if(module("examination",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="examination/examination_dashboard.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/exam_icon.jpg"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Examination</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                       <?php 
  }
                    ?> 
                        
                        
                        
                         <?php 
 if(module("report",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="report/report.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/report-icon.gif"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Report</div></td>
                                </tr>
                            </table>
                        </div></a>
                       <?php 
  }
                    ?> 
                        
                         <?php 
 if(module("manage_admin",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="manage_admin/manage_admin.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/user_admin.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Manage Admin</div></td>
                                </tr>
                            </table>
                        </div></a>
                       
                        <?php 
  }
                    ?>
                        
                        
                        
                        
                         <?php 
 if(module("visitor_management",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="visitor/add_new_visitor.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/visitor_icon.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Visitor Management</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                    ?>
                        
                        
                         <?php 
 if(module("telephone_diary",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="telephonediary/telephonediary_report.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/telephone_icon.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Telephone Diary</div></td>
                                </tr>
                            </table>
                        </div></a>
                     <?php 
  }
                    ?>   
                        
                        
                          <?php 
 if(module("online_support",$explode_module_array)==1)
 {
                        ?>
                         <a border="0" href="">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/live_support.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Online Support</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                     <?php 
  }
                    ?>   
                        
                        
                         <?php 
 if(module("sms_module",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="sms/sms_dashboard.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/sms.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">SMS (Phone/Email)</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                      <?php 
  }
                    ?>  
                        
                         <?php 
 if(module("hr",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="human_resource/hr_dashboard.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/HRMS.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Human Resource</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        
                     <?php 
  }
                    ?>   
                      
                        
                        
                        
                        
                         <?php 
 if(module("assignment",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="assignment/assignment.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/assignment.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Assignment & H.W</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                       
                        
                        
                          <?php 
 if(module("notice",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="notice/notice.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/notice_icon_1.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Notice</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                       
                        
                           <?php 
 if(module("health_card",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="system/system_dashboard.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/health_card.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Health Card</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                        
                        
                        <?php 
 if(module("event",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="event/event_dashboard.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/add_event.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Event</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                        
                        
                        
                         <?php 
 if(module("inventory",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="inventory/inventory.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/inventory.jpg"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Inventory</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                        
                        
                        
                        
                        
                        
                         <?php 
 if(module("media",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="media/media.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/media.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Media</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                        
                        
                        
                        
                        
                         <?php 
 if(module("data_import_export",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="data_import_export/import_export_dashboard.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/data_export.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Data Import/Export</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                        
                        
                        
                        
                        
                        
                         <?php 
 if(module("academic",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="academic/academic.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/academic-icon.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Academic</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                        
                        
                         
                             <?php 
 if(module("alumni",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="alumni/alumni_dashboard.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/almuni.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Alumni</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                        
                        
                         
                              <?php 
 if(module("achievement",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="achievement/achievement.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/acheivement.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Achievement</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                        
                        
                        
                        
                         <?php 
 if(module("news",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="news/news.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/news.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">News</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                        
                        
                    
                        
                          <?php 
 if(module("study_material",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="study_material/study_material.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/study_meterial.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Study Material</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                      
                        
                        
                          <?php 
 if(module("blog",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="blog/blog.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/blog.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">Blog</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                        
                        
                       
                        
                          <?php 
 if(module("system_setting",$explode_module_array)==1)
 {
                        ?>
                        <a border="0" href="system/system_dashboard.php">
                        <div class="module_style_class">
                            <table class="module_short_table">
                                <tr>
                                    <td><div class="module_images_div"><img class="module_image"
                                                                            src="images/module_icon/system_setting_1.png"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="verticle_lines"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="module_tittle_name">System Setting</div></td>
                                </tr>
                            </table>
                        </div></a>
                        
                        <?php 
  }
                        
                    ?>
                        
                        
                    </div> 
                    <div onclick="close_button_one('1')" class="close_button"></div>
                </div>    
            </div>
            
            
            <div class="second_full_width" style=" width:0%; " id="show_first_div_2">
                <div class="middle_center_div">
                    <div class="first_left_work_div">
                        
                        <div class="notification_first_class"></div>    
                        
                        <div class="notification_first_class"></div>    
                        
                        <div class="notification_first_class"></div>    
                        
                        <div class="notification_first_class"></div>    
                        <div class="notification_first_class"></div>    
                        <div class="notification_first_class"></div>    
                        <div class="notification_first_class"></div>    
                        <div class="notification_first_class"></div>    
                        <div class="notification_first_class"></div>    
                        <div class="notification_first_class"></div>    
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </div> 
                    <div onclick="close_button_two('2')"  class="close_button"></div>
                </div>    
            </div>
            
            
            <div id="main_second_work_div">
           </div>
        </div>
        
       
        <div id="include_fotter_page"><?php  require_once 'fotter/fotter_page.php'; ?></div>
        </body>
</html> 
