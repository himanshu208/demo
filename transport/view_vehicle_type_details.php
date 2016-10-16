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
                           <td>View Vehicle Type Details</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>View Vehicle Type Details</b></div>
                    <a href="add_vehicle_type.php">
                        <div class="view_button">Add Vehicle Type</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   
                   
                   <div id="top_buttons_div">
                       <div class="button_show_style">Print</div>   
                   </div>
                   
                   <table cellspacing="0" cellpadding="0" class="table_details">
                       <tr>
                           <td class="th_styling">Sl No.</td>
                           <td class="th_styling">Vehicle Type</td>
                           <td class="th_styling">Number Of Vehicle</td>
                           <td class="th_styling">Description</td>
                           <td class="th_styling" style=" border-right:1px solid gray;  ">Action</td>
                       </tr>
                       
                    <?php 
                       $row=0;
                       $vehicle_db=mysql_query("SELECT * FROM transport_vehicle_type_db WHERE organization_id='$fetch_school_id'"
                               . " and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and is_delete='none'");
                       while ($fetch_vehicle_data=mysql_fetch_array($vehicle_db))
                       {
                           $row++;
                                $vehicle_db_id=$fetch_vehicle_data['id'];
                                $vehicle_unique_id=$fetch_vehicle_data['vehicle_type_id'];
                                $vehicle_encrypt_id=$fetch_vehicle_data['encrypt_id'];
                                $vehicle_name=$fetch_vehicle_data['vehicle_type'];
                                $no_of_vehicle=$fetch_vehicle_data['no_of_vehicle'];
                                $vehicle_description=$fetch_vehicle_data['description'];
                                
                                echo "<tr id='delete_row_$vehicle_unique_id'>
                                  <td class='td_style'><center><b>$row</b></center></td> 
                                   <td class='td_style'>$vehicle_name</td> 
                                   <td class='td_style'><center><b>$no_of_vehicle</b></center></td> 
                                  <td class='td_style'>$vehicle_description</td> 
                                   <td class='td_style' style='width:132px; border-right:1px solid gray;'>";
                                    {
                        ?>
                       <a style="color:blue;" href="#" onclick="window.open('edit_vehicle_type.php?token_id=<?php echo $vehicle_encrypt_id;?>','size',config='height=500,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        
                            <div class='edit_delete_buttons' style='background-color:green; width:45px;'>Edit</div></a>
                      <?php 
                        }
                           echo "</abbr>
                            <abbr title='Delete'>";
                        {
                        ?>
                            <div onclick="delete_data('<?php  echo $vehicle_unique_id;?>','vehicle_type_delete_command')" class='edit_delete_button'>Delete</div>
                         <?php 
                        }
                                  echo" </td> 
                                      
                                </tr>";
                           
                           
                       }
                       
                       $reocrd_num_rows=mysql_num_rows($vehicle_db);
                       if(empty($reocrd_num_rows))
                       {
                           echo "<tr><td colspan='10' class='empty_td'>Record No Found!</td></tr>";   
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