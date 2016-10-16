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
        <title>View Driver Details</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
      <script type="text/javascript">
           function filter_button()
           {
                    var vehicle_type=document.getElementById("vehicle_type").value;
                    var search_by=document.getElementById("search_by").value;
                    var search=document.getElementById("search").value;
                    
                    if(vehicle_type==0 && search_by==0 && search==0)
                    {
                    alert("Please select atleast one option");
                    return false;
                    }else
                    if(search_by!=0 && search==0)
                    {
                   alert("Please enter search keyword here");
                   document.getElementById("search").focus();
                   return false;
                    }else
                      if(search_by==0 && search!=0)
                    {
                   alert("Please select search by");
                   document.getElementById("search_by").focus();
                   return false;
                    }else
                    {
                    document.getElementById("ajax_loader_show").style.display="block";    
                   window.location.assign("view_driver_details.php?vtxml="+vehicle_type+"&&sbxml="+search_by+"&&sxml="+search+"");   
                    }
           }
           
           function reset_button()
           {
            document.getElementById("ajax_loader_show").style.display="block";    
           window.location.assign("view_driver_details.php");   
           }
        </script>
    
    </head>
    <body onload="page_load()">
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
                            <td><a href="transport_system_setting.php">Transport Setting</a></td>
                            <td>/</td>
                           <td>View Driver Details</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>View Driver Details</b></div>
                    <a href="add_driver.php">
                        <div class="view_button">Add Driver</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   
                   <style>
                    .th_styling { font-size:11px; }  
                    .td_style { font-size:11px; }
                   </style>
                  
                   <?php
                   
                   if(!empty($_REQUEST['vtxml']))
                   {
                   $route_vehicel_id=$_REQUEST['vtxml'];    
                   $route_db=mysql_query("SELECT * FROM transport_allocate_route_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and route_id='$route_vehicel_id' and is_delete='none' OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and vehicle_id='$route_vehicel_id' and is_delete='none'");
                   $fetch_route_data=mysql_fetch_array($route_db);
                   $fetch_num_rows=mysql_num_rows($route_db);
                   if((!empty($fetch_route_data))&&($fetch_route_data!=null)&&($fetch_num_rows!=0))
                   {
                    $driver_id=$fetch_route_data['driver_id'];  
                   }else 
                   {
                    $driver_id=0;   
                   }
                   
                   if(!empty($driver_id))
                   {
                   $search_driver_id="and driver_unique_id='$driver_id'";   
                   }else
                   {
                  $search_driver_id="";     
                   }
                   
                   }else
                   {
                   $route_vehicel_id="";  
                   $search_driver_id="";
                   }
                   
                   if((!empty($_REQUEST['sbxml']))&&(!empty($_REQUEST['sxml'])))
                   {
                   $search_by=$_REQUEST['sbxml'];
                   $search=$_REQUEST['sxml'];
                   
                   $search_filter="and $search_by LIKE '%$search%'";
                   }else 
                   {
                      $search_by=""; 
                      $search="";
                      $search_filter="";
                   }
                   if(!empty($search_by))
                   {
                ?>
                   
                   <script type="text/javascript">
                       function page_load()
                       {
                      document.getElementById("<?php echo $search_by;?>").selected=true;    
                       }
                       </script>
                   <?php
                   }
                   ?>
                   <div class="filter_div"> 
                   <table style=" width:95%; margin: 0 auto;  font-size:12px; ">
                           <tr>
                               <td><b>Route/Vehicle</b></td><td><b>:</b></td>
                               <td> <select class="select_filter" id="vehicle_type" name="vehicle_type">
                                 <?php
                                 $route_db=mysql_query("SELECT * FROM transport_route_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and is_delete='none'");
                                 $num_rows=mysql_num_rows($route_db);
                                 ?>     
                               <option value="0">--Select route/vehicle --</option>
                               
                               <?php
                               if(!empty($num_rows))
                               {
                               ?>
                               <optgroup label="Route" style=" background-color:gray; color:white;  ">
                                </optgroup>
                               <?php
while ($fetch_route_data=mysql_fetch_array($route_db))
{
 $route_data_1=$fetch_route_data[4];
 $route_data_2=$fetch_route_data[7];
 if($route_vehicel_id==$route_data_1)
 {
 echo "<option value='$route_data_1' selected>$route_data_2</option>";
 }else
 {
 echo "<option value='$route_data_1'>$route_data_2</option>";    
 }
}
                               ?>    
                                   
                               
                               <?php
                               }
                               ?>
                                
                                
                                
                                <?php
                                 $vehicle_db=mysql_query("SELECT * FROM transport_vehicle_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and is_delete='none'");
                                 $num_rows=mysql_num_rows($vehicle_db);
                                 ?>     
                              
                               <?php
                               if(!empty($num_rows))
                               {
                               ?>
                               <optgroup label="Vehicle" style=" background-color:gray;    color:white;  ">
                                </optgroup>
                               <?php
while ($fetch_vehicle_data=mysql_fetch_array($vehicle_db))
{
 $vehicle_data_1=$fetch_vehicle_data[4];
 $vehicle_data_2=$fetch_vehicle_data[7];
 if($route_vehicel_id==$vehicle_data_1)
 {
 echo "<option value='$vehicle_data_1' selected>$vehicle_data_2</option>";
 }else
 {
   echo "<option value='$vehicle_data_1'>$vehicle_data_2</option>";   
 }
}
                               ?>    
                                   
                               
                               <?php
                               }
                               ?>
                                
                                
                                
                           </select>
                               </td>
                               
                             <td><b>Search By</b></td><td><b>:</b></td>
                             <td>
                                  <select class="select_filter" id="search_by" onchange="search_by_check(this.value)">
                                       <option value="0">--- Select Search By ---</option>
                                       <option id="driver_name" value="driver_name">Driver Name</option>
                                       <option id="gender" value="gender">Gender</option>
                                        <option id="dob" value="dob">Date of Birth</option>
                                        <option id="father_name" value="father_name">Father Name</option>
                                        <option id="email" value="email">Email</option>
                                        <option id="married_status" value="married_status">Married Status</option>
                                        <option id="address" value="address">Address</option>
                                        <option id="license_no" value="license_no">License Number</option>
                                        <option id="license_expire_date" value="license_expire_date">License Expire Date</option>
                                   </select>
                               </td>
                               <td><b>Search</b></td><td><b>:</b></td>
                               <td style=" width:255px;"><input type="text" value="<?php echo $search;?>" id="search" placeholder="Enter keyword here" class="text_search"></td>
                               
                               <td>
                                   <input type="button" class="filter_button" onclick="filter_button()" style=" margin-top: 0; height:26px; float:left; " value="Filter">
                                   <input type="button" class="filter_button" onclick="reset_button()" style=" margin-top: 0; margin-left:15px;  float:left;  background-color:deeppink;  height:26px; " value="Reset">
                             
                               </td>
                           </tr>
                       </table></div> 
                   
                   
                   <div id="top_buttons_div">
                       <div class="button_show_style">Print</div>   
                   </div>
                   
                   <table cellspacing="0" cellpadding="0" class="table_details">
                       <tr>
                           <td class="th_styling">Sl.No.</td>
                           <td class="th_styling">Driver Name</td>
                           <td class="th_styling">Gender</td>
                           <td class="th_styling">DOB</td>
                           <td class="th_styling">Father Name</td>
                           <td class="th_styling">Mobile Number</td>
                           <td class="th_styling">Route</td>
                           <td class="th_styling">Vehicle Reg. No.</td>
                           <td class="th_styling">License No.</td>
                           <td class="th_styling">Expire Date</td>
                           <td class="th_styling">View</td>
                           <td class="th_styling" style=" border-right:1px solid gray;  ">Action</td>
                       </tr>
                       
                       <?php 
                       $row=0;
                       $driver_db=mysql_query("SELECT * FROM transport_driver_db WHERE organization_id='$fetch_school_id'"
                               . " and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' $search_driver_id $search_filter and is_delete='none'");
                       while ($fecth_data=mysql_fetch_array($driver_db))
                       {
                        $row++;
                        
                         
                                echo "<tr id='delete_row_$fecth_data[4]'>
                                  <td class='td_style'><center><b>$row</b></center></td> 
                                   <td class='td_style'>".ucwords($fecth_data[8])."</td> 
                                   <td class='td_style'><center>".ucwords($fecth_data[9])."</center></td> 
                                  <td class='td_style'>$fecth_data[10]</td> 
                                      <td class='td_style'>".ucwords($fecth_data[11])."</td> 
                                   <td class='td_style'><center>$fecth_data[12]</center></td> 
                                  <td class='td_style'>Greater Noida</td> 
                                      <td class='td_style'><center><b>UP 16 BC 8630</b></center></td> 
                                   <td class='td_style'><center>$fecth_data[16]</center></td> 
                                  <td class='td_style'><center>$fecth_data[17]</center></td> 
                                  <td class='td_style'><center><div class='view_button_styles'>View</div></center></td> 
                                  <td class='td_style' style=' padding:0;width:133px; border-right:1px solid gray;'>";
                                    {
                        ?>
                       <a style="color:blue;" href="#" onclick="window.open('edit_driver.php?token_id=<?php echo $fecth_data[5];?>&&sxml=<?php echo $fecth_session_id_set;?>','size',config='height=660,width=700,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        
                            <div class='edit_delete_buttons' style='background-color:green; width:45px;'>Edit</div></a>
                      <?php 
                        }
                           echo "</abbr>
                            <abbr title='Delete'>";
                        {
                        ?>
                            <div onclick="delete_data('<?php  echo $fecth_data[4];?>','driver_delete_command')" class='edit_delete_button'>Delete</div>
                         <?php 
                        }
                                  echo" </td> 
                                      
                                </tr>";
                           
                        
                        
                       }
                     
                       $reocrd_num_rows=mysql_num_rows($driver_db);
                       if(empty($reocrd_num_rows))
                       {
                           echo "<tr><td colspan='13' class='empty_td'>Record No Found!</td></tr>";   
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