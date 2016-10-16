<?php 
if(isset($_POST['change_session_id']))
{
 if(!empty($_POST['change_session_id']))
 {
 $session_current_id=$_POST['change_session_id'];  
 $_SESSION['working_session_year']=$session_current_id;
 }
}





      $session__new_activate_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and by_defult='active'"); 
      $fecth_session_active_data=  mysql_fetch_array($session__new_activate_db);
      $fecth_session_num_rows=  mysql_num_rows($session__new_activate_db);
      if((!empty($fecth_session_active_data))&&($fecth_session_active_data!=null)&&($fecth_session_num_rows!=0))
      {
       $fecth_session_id_set_tmep=$fecth_session_active_data['session_id']; 
       
      }else
      {
       echo "<style>#session_not_active{ display:block; }</style>"; 
      }

if(isset($_SESSION['working_session_year']))
{
 $fecth_session_id_set=$_SESSION['working_session_year'];  
}else
{
  $fecth_session_id_set=$fecth_session_id_set_tmep; 
}


$user_account_db=mysql_query("SELECT * FROM login_user_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and user_admin_id='$user_unique_id'");
$fetch_user_account_data=  mysql_fetch_array($user_account_db);
$fetch_use_num_rows=  mysql_num_rows($user_account_db);
if((!empty($fetch_user_account_data))&&($fetch_user_account_data!=null)&&($fetch_use_num_rows!=0))
{
  $fetch_user_name=$fetch_user_account_data['full_name'];
}else
{
   $fetch_user_name=""; 
}
?>

<?php
//module 

function module($module_name,$explode_module_array)
{
   
 if(in_array($module_name,$explode_module_array)==true)
 {
 return 1;    
 }else
 {
  return 0;    
 }
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/header_javascript.js"></script>
        <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
        <title></title>
        <script type="text/javascript">
            function ok_closed()
            {
               document.getElementById("win_pop_up_head").style.display="none"; 
            }
            
             function close_buttond()
            {
               document.getElementById("win_pop_up_head").style.display="none"; 
            }
            
   document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) 
    {
       document.getElementById("win_pop_up_head").style.display="none";
    }else
    if (evt.keyCode == 13) 
    {
    document.getElementById("win_pop_up_head").style.display="none";
    }
};
            
            </script>
            
            <script type="text/javascript">
             function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
            </script> 
            
   
            
    </head>
    <body>
         
         <form name="myForm" action="" method="post" enctype="multipart/form-data">
    
             <?php  include_once "$loader_ajax";?>
        
             
             <div style=" display:none; " id="win_pop_up_head"> 
             <div class="pop_up_div">
             </div>
             <div class="second_pop_up_div">
                 <div class="pop_up_middle_div">
                     <div class="close_div" onclick="close_buttond()"></div>  
                     
                     <div class="middle_center_work_div" id="win_pop_up_text_head"></div>
                     
                     
                     
                     <div class="last_bottom_close_div">
                         <div onclick="ok_closed()" class="ok_button_style">OK</div>  
                     </div>
                 </div> 
                 
             </div>
             </div>
             
             
             
             
             <div id="view_full_image_div_opacity">
              
             </div>          
           <?php 
             if(!empty($fecth_user_unique))
             {
               $user_unique_id=$fecth_user_unique; 
             }else
             {
                $user_unique_id=$user_unique_id; 
             }
             ?>
             
             <input type="hidden" id="school_id" value="<?php  echo $fetch_school_id;?>">  
             <input type="hidden" id="branch_id" value="<?php  echo $fetch_branch_id;?>">
             <input type="hidden" id="admin_id" value="<?php  echo $user_unique_id;?>">
             
            <div id="header_first_page">
            <div id="merge_div">
                <table cellspacing="0" cellpadding="0" id="menu_first_table">
                 <tr>
                     <td>
                       <div id="school_logo">
                       <img class="school_small_logo" style=" max-width:55px;  margin-top:3px; height:49px; " src="<?php  echo $fetch_school_logo;?>">    
                       </div>  
                     </td>
                     <td>
                       <div id="menu_list">
                           <div id="first_small_top_div">
                               <table cellspacing="0" cellpadding="0" id="top_first_div_table">
                                   <tr>
                                       <td><?php  include_once 'header_live_time.php'; ?></td>
                                       <td></td>
                                       <td></td>
                                       <td style=" color:red;"><a style=" color: crimson; "><b>WELCOME <?php  echo strtoupper($fetch_user_name);?></b></a></td>
                                       <td></td>
                                       <td></td>
                                       <td><b>Working Academic Session Year</b></td>
                                       <td><b>:</b></td>
                                       <td><select onchange="javascript:submit()" id="session_unique_id"
                                                   name="change_session_id" >
                                               
                         <?php 
                           $session_db=  mysql_query("SELECT * FROM  session_db WHERE organization_id='$fetch_school_id'
                                   and branch_id='$fetch_branch_id' and is_delete='none'");
                           while ($fetch_session_data=mysql_fetch_array($session_db))
                           {
                           $fetch_session_id=$fetch_session_data['session_id'];
                           $fetch_session_name=$fetch_session_data['session_name'];
                           if(!empty($fecth_session_id_set))
                           {
                           if($fetch_session_id==$fecth_session_id_set)
                           {
                            echo "<option value='$fetch_session_id' selected>$fetch_session_name</option>";
                           
                           }else
                           {
                           echo "<option value='$fetch_session_id'>$fetch_session_name</option>";
                             
                           }
                           
                           }else
                           {
                           
                           $fetch_session_defult_set=$fetch_session_data['by_defult'];
                           if($fetch_session_defult_set=="active")
                           {
                                echo "<option value='$fetch_session_id' selected>$fetch_session_name</option>";
                            $fecth_session_id_set=$fetch_session_id;
                           }else
                           {
                               echo "<option value='$fetch_session_id'>$fetch_session_name</option>"; 
                           }
                           }
                           }
                           if(!empty($fetch_session_id))
                           {
                               echo "<style>#session_not_active{ display:block; }</style>"; 
                           }
                           ?>    
                           </select></td>
                                       <td>
                                        <a href="<?php  echo $log_out_page;?>">
                         <div id="log_out_button">LOG OUT</div>
                         </a>
                                       </td> 
                                   </tr>
                                   
                               </table>
                             
                               
                           </div>   
                           
                           
                           
                           
                           <div id="second_small_top_div">
                           
                               <script type="text/javascript">
                                function mouse_over_show(number)
                                {
                                document.getElementById("sub_menu_"+number+"").style.display="block";    
                                }
                                 function mouse_out_hide(number)
                                {
                                document.getElementById("sub_menu_"+number+"").style.display="none";    
                                }
                                
                               </script>
                          
                           <table cellspacing="0" cellpadding="0" class="short_menu_table">
                               <tr>
                                   <td><a border="0" href="<?php  echo $deshboard_page;?>"><div class="menu_list_show">Dashboard</div></a></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                   
                                   <?php 
 if(module("admission",$explode_module_array)==1)
 {
                        ?>
                                       <td>
                                       <div onmouseover="mouse_over_show('1')" onmouseout="mouse_out_hide('1')"><div class="menu_list_show">Admission</div>
                                          <div class="sub_menu_lisst" onmouseover="mouse_over_show('1')" onmouseout="mouse_out_hide('1')" id="sub_menu_1">
                                              <div class="menu_new_div">
                                              <ul class="menu_list_li">
               <a href="<?php echo $admission;?>"><li>Admission</li></a>    
               <a href="<?php echo $missing_photo;?>"><li>Missing Photo</li></a>
               <a href="<?php echo $assign_roll_no;?>"><li>Assign Roll Number</li></a>
               <a href=""><li style=" border-bottom:0; ">Promote Student</li></a>    
                                            
                                            
                                              </ul>
                                              </div>
                                           </div>
                                       </div>
                                        </td>
                                    <td style=" padding:0px; "><div class="bottom_arrow"></div></td>
                                   <td style=" padding:0px; "></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                   
                                   <?php
 }
                                   ?>
                                   
                                   <?php 
 if(module("search_student",$explode_module_array)==1)
 {
                        ?>
                                   
                                   <td><a href="<?php echo $student_search;?>"><div class="menu_list_show">Search Student</div></a></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                   <?php
 }
                                   ?>
                                   
                                    <?php 
 if(module("parent",$explode_module_array)==1)
 {
                        ?>
                                   
                                    <td><a href="<?php echo $parents_search;?>"><div class="menu_list_show">Parents</div></a></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                 <?php
 }
                                 ?>  
                                   
                                   <?php 
 if(module("transport",$explode_module_array)==1)
 {
                        ?>
                                   
                                   <td><div onmouseover="mouse_over_show('2')"
                                             onmouseout="mouse_out_hide('2')" class="menu_list_show"><div class="menu_list_show">Transport</div>
                                        <div class="sub_menu_lisst" onmouseover="mouse_over_show('2')"
                                             onmouseout="mouse_out_hide('2')" id="sub_menu_2">
                                              <div class="menu_new_div">
                                              <ul class="menu_list_li">
               <a href="<?php echo $tran_add_student;?>"><li>Allocate New Student</li></a>    
               <a href="<?php echo $tran_student_list;?>"><li>Allocate Student List</li></a>
               <a href="<?php echo $tran_route_list;?>"><li>Route Details</li></a> 
               <a href="<?php echo $tran_vehicle;?>"><li>Vehicle Details</li></a> 
               <a href="<?php echo $tran_setting;?>"><li class="sub_menu_list">Transport Setting</li></a> 
               <a href="<?php echo $tran_add_route;?>"><li>Manage Route</li></a>
               <a href="<?php echo $trans_add_veh_type;?>"><li>Manage Vehicle Type</li></a>
               <a href="<?php echo $trans_add_vehicle;?>"><li>Manage Vehicle</li></a>
                <a href="<?php echo $tran_add_driver;?>"><li>Manage Driver</li></a>
               <a href="<?php echo $tran_add_route_allot;?>"><li style=" border-bottom:0; ">Manage Route & Transport</li></a>
                                            
                                            
                                              </ul>
                                              </div>
                                           </div>
                                       </div></td>
                                   <td style=" padding:0px; "><div class="bottom_arrow"></div></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                   <?php
 }
                                   ?>
                                   
                                    <?php 
 if(module("hostel",$explode_module_array)==1)
 {
                        ?>
                                   <td><div onmouseover="mouse_over_show('3')"
                                             onmouseout="mouse_out_hide('3')" class="menu_list_show">Hostel</div>
                                   
                                    <div class="sub_menu_lisst" onmouseover="mouse_over_show('3')"
                                             onmouseout="mouse_out_hide('3')" id="sub_menu_3">
                                              <div class="menu_new_div">
                                              <ul class="menu_list_li">
               <a href="<?php echo $tran_add_student;?>"><li>Allocate New Student</li></a>    
               <a href="<?php echo $tran_student_list;?>"><li>Allocate Student List</li></a>
               <a href="<?php echo $tran_route_list;?>"><li>Route Details</li></a> 
               <a href="<?php echo $tran_vehicle;?>"><li>Vehicle Details</li></a> 
               <a href="<?php echo $tran_setting;?>"><li class="sub_menu_list">Transport Setting</li></a> 
               <a href="<?php echo $tran_add_route;?>"><li>Manage Route</li></a>
               <a href="<?php echo $trans_add_veh_type;?>"><li>Manage Vehicle Type</li></a>
               <a href="<?php echo $trans_add_vehicle;?>"><li>Manage Vehicle</li></a>
                <a href="<?php echo $tran_add_driver;?>"><li>Manage Driver</li></a>
               <a href="<?php echo $tran_add_route_allot;?>"><li style=" border-bottom:0; ">Manage Route & Transport</li></a>
                                            
                                            
                                              </ul>
                                              </div>
                                           </div>
                                   </td>
                                   <td style=" padding:0px; "><div class="bottom_arrow"></div></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                   <?php
 }
                                   ?>
                                   
                                   
                                      <?php 
 if(module("library",$explode_module_array)==1)
 {
                        ?>
                                   <td><div class="menu_list_show">Library</div></td>
                                   <td style=" padding:0px; "><div class="bottom_arrow"></div></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                   <?php
 }
                                   ?>
                                   
                                   
                                     <?php 
 if(module("account",$explode_module_array)==1)
 {
                        ?>
                                   <td><div class="menu_list_show">Account</div></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                   <?php
 }
                                   ?>
                                   
                                     <?php 
 if(module("attendance",$explode_module_array)==1)
 {
                        ?>
                                   <td><div class="menu_list_show">Attendance</div></td>
                                   <td style=" padding:0px; "><div class="bottom_arrow"></div></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                   <?php
 }
                                   ?>
                                   
                                   <?php 
 if(module("sms_module",$explode_module_array)==1)
 {
                        ?>
                                    <td><div class="menu_list_show">SMS</div></td>
                                   <td style=" padding:0px; "><div class="bottom_arrow"></div></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                   <?php
 }
                                   ?>
                                   
                                    <?php 
 if(module("time_table",$explode_module_array)==1)
 {
                        ?>
                                   <td><div class="menu_list_show">Time Table</div></td>
                                   <td style=" padding:0px; "><div class="bottom_arrow"></div></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                   <?php
 }
                                   ?>
                                   
                                     <?php 
 if(module("examination",$explode_module_array)==1)
 {
                        ?>
                                   <td><div class="menu_list_show">Examination</div></td>
                                   <td style=" padding:0px; "><div class="bottom_arrow"></div></td>
                                   <td><div class="verticle_menu_line"></div></td>
                              <?php
 }
                              ?>   
                                   
                                    <?php 
 if(module("report",$explode_module_array)==1)
 {
                        ?>
                                   <td><div class="menu_list_show">Report</div></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                   <?php
 }
                                   ?>
                                   
                                    <?php 
 if(module("hr",$explode_module_array)==1)
 {
                        ?>
                                   <td><a href="index.php"><div class="menu_list_show">H.R</div></a></td>
                                   <td style=" padding:0px; "><div class="bottom_arrow"></div></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                   <?php
 }
                                   ?>
                                   
                                   
                                   <td><div class="menu_list_show">Other</div></td>
                                   <td style=" padding:0px; "><div class="bottom_arrow"></div></td>
                                   <td><div class="verticle_menu_line"></div></td>
                                   
                                     <?php 
 if(module("system_setting",$explode_module_array)==1)
 {
                        ?>
                                   
                                   <td><a href="system/system_dashboard.php"><div class="menu_list_show">System Setting</div></a></td>
                                   <td style=" padding:0px; "><div class="bottom_arrow"></div></td>
                                  <?php
 }
                                  ?>
                               </tr>
                           </table>
                           </div>
                            </div>   
                     </td>
                    
                 </tr>
                 
                </table>
        
       
        
            </div>
        </div>
         </form>
    </body>
</html>
