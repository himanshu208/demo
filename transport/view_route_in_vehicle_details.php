<?php
//SESSION CONFIGURATION
$check_array_in="transport";
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
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
    </head>
    <body>
          <?php  include_once '../ajax_loader_page_second.php';?>
      
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
                           <td><a href="transport_dashboard.php">Transport</a></td>
                           <td>/</td>
                           <td><a href="transport_system_setting.php">Transport System Setting</a></td>
                           <td>/</td>
                           <td>View Route In Transport Details</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>View Route Details</b></div>
                    <a href="add_route_and_vehicle.php">
                        <div class="view_button">Add New Route</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   
                   <div id="top_buttons_div">
                       <div class="button_show_style">Print</div>   
                   </div>
                   <table cellspacing="0" cellpadding="0" class="table_details">
                       <tr>
                           <td class="th_styling">Sl No.</td>
                           <td class="th_styling">Route Name</td>
                           <td class="th_styling">Sub Route Details</td>
                           <td class="th_styling">Vehicle Type</td>
                           <td class="th_styling">Vehicle Reg. No.</td>
                           <td class="th_styling">Driver Name</td>
                           <td class="th_styling">Mobile No.</td>
                           <td class="th_styling">Description</td>
                           <td class="th_styling" style=" border-right:1px solid gray;  ">Action</td>
                       </tr>
                       
                     <?php 
                       $row=0;
$manage_route_vehicle_db=mysql_query("SELECT * FROM transport_allocate_route_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                               . "and session_id='$fecth_session_id_set' and is_delete='none'");
                       while ($fetch_route_vehicle_data=mysql_fetch_array($manage_route_vehicle_db))
                       {
                        $row++; 
                        $fetch_allocate_route_id=$fetch_route_vehicle_data['allocate_vehicle_route_id'];
                        $encrypt_id=$fetch_route_vehicle_data['encrypt_id'];
                        $fetch_route_transport_db_id=$fetch_route_vehicle_data['id'];
                       $fetch_route_id=$fetch_route_vehicle_data['route_id'];
                        $fetch_vehicle_type_id=$fetch_route_vehicle_data['vehicle_type_id'];
                       $fetch_vehicle_id=$fetch_route_vehicle_data['vehicle_id'];
                       $vehicle_rent=$fetch_route_vehicle_data['vehicle_rent'];
                       $driver_name=$fetch_route_vehicle_data['driver_id'];
                       $description=$fetch_route_vehicle_data['description'];
                        
$driver_db=mysql_query("SELECT * FROM  transport_driver_db WHERE organization_id='$fetch_school_id'"
. " and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and driver_unique_id='$driver_name' and is_delete='none'");
$driver_data=mysql_fetch_array($driver_db);
$driver_num_rows=mysql_num_rows($driver_db);
if((!empty($driver_data))&&($driver_data!=null)&&($driver_num_rows!=0))
{
    $driver_name=$driver_data['driver_name'];
    $mobile_no=$driver_data['mobile_no'];
}else
{
 $driver_name="";
 $mobile_no="";
}
                       
                       //route name
                       $route_db=mysql_query("SELECT * FROM transport_route_db WHERE organization_id='$fetch_school_id'"
                               . " and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' "
                               . "and route_id='$fetch_route_id'");
                       
                       $fetch_route_data=  mysql_fetch_array($route_db);
                       $fetch_route_num_rows=  mysql_num_rows($route_db);
                       if((!empty($fetch_route_data))&&($fetch_route_data!=null)&&($fetch_route_num_rows!=0))
                       {
                        $route_name=$fetch_route_data['route_name'];  
                       }else
                       {
                        $route_name="";   
                       }
                       
                       
                       //vehicle type name
                          $vehicle_type_db=mysql_query("SELECT * FROM transport_vehicle_type_db WHERE organization_id='$fetch_school_id'"
                               . " and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and vehicle_type_id='$fetch_vehicle_type_id'");
                       $fetch_vehicle_type_data=mysql_fetch_array($vehicle_type_db);
                       $fetch_vehicle_type_num_rows=  mysql_num_rows($vehicle_type_db);
                       if((!empty($fetch_vehicle_type_data))&&($fetch_vehicle_type_data!=null)&&($fetch_vehicle_type_num_rows!=0))
                       {
                        $vehicle_type_naem=$fetch_vehicle_type_data['vehicle_type'];  
                       }else 
                       {
                        $vehicle_type_naem="";   
                       }
                       
                       //vehicle registration no
                       
                       $vehicle_registration_no=mysql_query("SELECT * FROM transport_vehicle_db WHERE organization_id='$fetch_school_id'"
                               . " and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' "
                               . "and vehicle_id='$fetch_vehicle_id'");
                       $fetch_vehicle_reg_data=mysql_fetch_array($vehicle_registration_no);
                       $fetch_vehicle_reg_num_rows=mysql_num_rows($vehicle_registration_no);
                       
                       if((!empty($fetch_vehicle_reg_data))&&($fetch_vehicle_reg_data!=null)&&($fetch_vehicle_reg_num_rows!=0))
                       {
                         $vehicle_registration_no= $fetch_vehicle_reg_data['vehicle_registration_no']; 
                       }else 
                       {
                         $vehicle_registration_no="";  
                       }
                       
                       
                       echo "<tr id='delete_row_$fetch_allocate_route_id'>
                                  <td class='td_style'><center><b>$row</b></center></td> 
                                   <td class='td_style'>$route_name</td> 
                                        <td class='td_style'>";
                       {
                       ?>
                       <?php
                       $sub_route_db=mysql_query("SELECT * FROM  transport_sub_route_db WHERE organization_id='$fetch_school_id'"
                               . " and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and route_allot_id='$fetch_allocate_route_id' and is_delete='none'");
                       $sub_route_num_rows=mysql_num_rows($sub_route_db);
                       ?>
                       
                       <?php
                       if(!empty($sub_route_num_rows))
                       {
                       ?>
                       <table cellspacing="0" cellpadding="0" style=" width: 100%; margin-top:10px; margin-bottom:10px;   ">
                           <tr class="th_sub_route">
                               <td>Sub Route</td>
                               <td>Pick Time</td>
                               <td>Drop Time</td>
                               <td style=" border-right:1px solid blue; ">Rent/Fare</td>
                               
                           </tr>
                           
                           <?php
                          while($fetch_sub_route_data=mysql_fetch_array($sub_route_db))
                          {
                          $fetch_sub_route_name=$fetch_sub_route_data['sub_route'];
                           $fetch_pick_time=$fetch_sub_route_data['pick_time'];
                                  $fetch_drop_time=$fetch_sub_route_data['drop_time'];
                                  $fetch_rent=$fetch_sub_route_data['rent'];
                                  echo "<tr class='td_sub_style'>"
                                  . "<td>$fetch_sub_route_name</td>"
                                          . "<td>$fetch_pick_time</td>"
                                          . "<td>$fetch_drop_time</td>"
                                          . "<td style='border-right:1px solid blue;'><b style='color:Red;'>$fetch_currency</b> $fetch_rent/-</td>"
                                          . "</tr>"; 
                              
                          }
                           
                           ?>
                           
                           
                       </table>
                       <?php
                       }
                       ?>
                       
                       <?php
                       }
                       echo"</td> 
                                       <td class='td_style'><center><b>$vehicle_type_naem</b></center></td> 
                                        <td class='td_style'><center>$vehicle_registration_no</center></td> 
                                        <td class='td_style'>$driver_name</td> 
                                        <td class='td_style'><center>$mobile_no</center></td> 
                                        <td class='td_style'>$description</td> 
                                       
                                        <td class='td_style' style='width:130px; border-right:1px solid gray;'>";
                                    {
                        ?>
                       <a style="color:blue;" href="#" onclick="window.open('edit_route_vehicle.php?token_id=<?php echo $encrypt_id;?>','size',config='height=700,width=800,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        
                            <div class='edit_delete_buttons' style='background-color:green; width:45px;'>Edit</div></a>
                      <?php 
                        }
                           echo "</abbr>
                            <abbr title='Delete'>";
                        {
                        ?>
                            <div onclick="delete_data('<?php  echo $fetch_allocate_route_id;?>','assign_route_vehicle_delete_command')" class='edit_delete_button'>Delete</div>
                         <?php 
                        }
                                  echo" </td> 
                                     </tr> ";
                           
                           
                       }
                          $reocrd_num_rows=mysql_num_rows($manage_route_vehicle_db);
                       if(empty($reocrd_num_rows))
                       {
                           echo "<tr><td colspan='18' class='empty_td'>Record No Found!</td></tr>";   
                       }
                       
                       ?>
                       
                       
                       
                   </table>       
                   
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