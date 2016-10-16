<?php
//SESSION CONFIGURATION
$check_array_in="hostel";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>




<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Hostel List</title>
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
                           <td><a href="hostel_dashboard.php">Hostel</a></td>
                           <td>/</td>
                           <td><a href="hostel_setting.php">Hostel Setting</a></td>
                           <td>/</td>
                           <td>Hostel list</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>View Hostel List</b></div>
                    <a href="add_hostel.php">
                        <div class="view_button">Add New Hostel</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   
                   
                   <div id="top_buttons_div">
                       <div class="button_show_style">Print</div>   
                   </div>
                   
                   <table cellspacing="0" cellpadding="0" class="table_details">
                       <tr>
                           <td class="th_styling">Sl No.</td>
                           <td class="th_styling">Hostel Type</td>
                           <td class="th_styling">Hostel</td>
                            <td class="th_styling">Phone</td>
                             <td class="th_styling">Email</td>
                              <td class="th_styling">Address</td>
                           <td class="th_styling">Hostel Facilities</td>
                           <td class="th_styling">Warden</td>
                           <td class="th_styling" style=" border-right:1px solid gray;  ">Action</td>
                       </tr>
                       
                       
                       
                       <?php
                       $row=0;
                         
                        $hostel_db=mysql_query("SELECT * FROM hostel_db WHERE $db_main_details "
                                . " is_delete='none'");
                        $fetch_hostel_num_rows=mysql_num_rows($hostel_db);
                        while ($fetch_hostel_data=mysql_fetch_array($hostel_db))
                        {
                          $row++;  
                            
                        $hostel_unique_id=$fetch_hostel_data['hostel_unique_id'];
                        $encrypt_id=$fetch_hostel_data['encrypt_id'];
                        $hostel_phone=$fetch_hostel_data['phone'];
                                $hostel_email=$fetch_hostel_data['email'];
                                $hostel_address=$fetch_hostel_data['address'];
                                $hostel_facilities=$fetch_hostel_data['facilities'];
                               $warden_id=$fetch_hostel_data['warden_id'];
                            
                         $hostel_name=$fetch_hostel_data['hostel_name'];
                          $hostel_type_id=$fetch_hostel_data['hostel_type_id'];
                          $hostel_type_db=mysql_query("SELECT * FROM hostel_type_db WHERE $db_main_details "
                                . "hostel_type_unique_id='$hostel_type_id' and is_delete='none'");
                        $fetch_hostel_type_data=mysql_fetch_array($hostel_type_db);
                        $fetch_hostel_type_num_rows=mysql_num_rows($hostel_type_db);
                        if((!empty($fetch_hostel_type_data))&&($fetch_hostel_type_data!=null)&&($fetch_hostel_type_num_rows!=0))
                        {
                          $hostel_type_name=ucwords($fetch_hostel_type_data['hostel_type']);
                          
                        }else
                        {
                         $hostel_type_name="";   
                        }     
                        
                        
                        $warden_db=mysql_query("SELECT * FROM hostel_warden_db WHERE $db_main_details warden_unique_id='$warden_id' and is_delete='none' ");
                        $warden_data= mysql_fetch_array($warden_db);
                        $warden_num_rows=  mysql_num_rows($warden_db);
                        if((!empty($warden_data))&&($warden_data!=null)&&($warden_num_rows!=0))
                        {
                       $warden_name=$warden_data['warden_name'];    
                        }  else
                            {
                           $warden_name="";  
                        }
                        
                           echo "<tr id='delete_row_$hostel_unique_id'>
                                  <td class='td_style'><center><b>$row</b></center></td> 
                                   <td class='td_style'><center><b>$hostel_type_name</b></center></td> 
                                   <td class='td_style'><center>$hostel_name</center></td> 
                                  <td class='td_style'><center>$hostel_phone</center></td>
                                   <td class='td_style'><center>$hostel_email</center></td>
                                    <td class='td_style'><center>$hostel_address</center></td>
                                     <td class='td_style'><center>$hostel_facilities</center></td>
                                      <td class='td_style'><center>$warden_name</center></td>
                                   <td class='td_style' style='width:132px; border-right:1px solid gray;'>";
                                    {
                        ?>
                       <a style="color:blue;" href="#" onclick="window.open('edit_hostel.php?token_id=<?php echo $encrypt_id;?>','size',config='height=500,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        
                            <div class='edit_delete_buttons' style='background-color:green; width:45px;'>Edit</div></a>
                      <?php 
                        }
                           echo "</abbr>
                            <abbr title='Delete'>";
                        {
                        ?>
                            <div onclick="delete_data('<?php  echo $hostel_unique_id;?>','hostel_db_delete_command')" class='edit_delete_button'>Delete</div>
                         <?php 
                        }
                                  echo" </td> 
                                      
                                </tr>";
                        
                        }
                  
                       if(empty($fetch_hostel_num_rows))
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