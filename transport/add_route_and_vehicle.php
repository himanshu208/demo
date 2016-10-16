<?php
//SESSION CONFIGURATION
$check_array_in="transport";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>


<?php 
$message_show="";
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
if(isset($_POST['submit_process']))
{
 
$route_id=$_POST['route_id'];
$sub_route=$_POST['sub_route_name'];
$pick_time=$_POST['pick_time'];
$drop_time=$_POST['drop_time'];
$rent_fare=$_POST['sub_route_price'];
$vehicle_type=$_POST['vehicle_type'];
$vehicle_reg_no=$_POST['vehicle_registration_no'];
$vehicle_driver=$_POST['driver_id'];
$description=$_POST['description'];
$insert_session_id=$_POST['use_inset_session_id'];

$insert_sub_route=array_filter($sub_route);
$insert_pick_time=array_filter($pick_time);
$insert_drop_time=array_filter($drop_time);
$insert_rent=array_filter($rent_fare);

$result=mysql_query("SHOW TABLE STATUS LIKE 'transport_allocate_route_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_route_vehicle_id="ALCTROTETRNS_$nextId"; 
$encrypt_id=md5(md5($final_route_vehicle_id));


 if((!empty($final_route_vehicle_id))&&(!empty($route_id))&&(!empty($vehicle_type))
         &&(!empty($vehicle_reg_no))&&(!empty($vehicle_driver))
         &&(!empty($insert_session_id))&&(!empty($insert_sub_route))&&(!empty($insert_pick_time))&&(!empty($insert_drop_time))
         &&(!empty($insert_rent)))
 {
  
 $select_match_route_vehicle_db=mysql_query("SELECT * FROM transport_allocate_route_db WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and allocate_vehicle_route_id='$final_route_vehicle_id'
     OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$insert_session_id'
         and route_id='$route_id' and vehicle_type_id='$vehicle_type' and vehicle_id='$vehicle_reg_no' and is_delete='none'"); 
 $fetch_route_vehicle_data=mysql_fetch_array($select_match_route_vehicle_db);
 $fetch_route_vehicle_num_rows=mysql_num_rows($select_match_route_vehicle_db);
    if((empty($fetch_route_vehicle_data))&&($fetch_route_vehicle_data==null)&&($fetch_route_vehicle_num_rows==0)) 
    {
     
     $insert_db=mysql_query("INSERT into transport_allocate_route_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'
         ,'$final_route_vehicle_id','$encrypt_id','$route_id','$vehicle_type','$vehicle_reg_no'
             ,'','$vehicle_driver','$description'
             ,'none','$date','$date_time','$user_unique_id','active')");
    if((!empty($insert_db))&&($insert_db)) 
    {
     $sub_rount_count=count($sub_route);
     for($i=0;$i<$sub_rount_count;$i++)
     {
     
         $insert_sub_route_name=$sub_route[$i];
         $insert_pick_time=$pick_time[$i];
         $insert_drop_time=$drop_time[$i];
         $insert_rent=$rent_fare[$i];
         
$results=mysql_query("SHOW TABLE STATUS LIKE 'transport_sub_route_db'");
$rows=mysql_fetch_array($results);
$nextIds=$rows['Auto_increment']; 
$final_sub_route_id="SUBRUTE_$nextIds"; 
$encrypt_id=md5(md5($final_sub_route_id));
    
$insert_dbs=mysql_query("INSERT into transport_sub_route_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
        . ",'$final_sub_route_id','$encrypt_id','$final_route_vehicle_id','$insert_sub_route_name','$insert_pick_time'"
        . ",'$insert_drop_time','$insert_rent','none','$date','$date_time','$fecth_user_unique')");
         
     }
       
      if($insert_dbs)
      {
      $message_show="<div class='notification_alert_show' style='color:green;'>Record save successfully complete</div>";   
      }else
      {
       $delete_db=mysql_query("DELETE FROM transport_allocate_route_db WHERE id='$nextId'");   
       if($delete_db)
       {
       $message_show="<div class='notification_alert_show'>Request failed,please try again</div>"; 
       }
       
      }
     }else
    {
    $message_show="<div class='notification_alert_show'>Request failed,please try again</div>";     
    }
        
        
    }else $message_show="<div class='notification_alert_show'>Record already exist in database.</div>"; 
     
     
 }else $message_show="<div class='notification_alert_show'>Please fill all fields.</div>";
   
require_once '../pop_up.php';
 
}


?>





<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add Route & Vehicle</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
        function validate_form() 
        {
            var route_id=document.getElementById("route_id").value;
            var vehicle_type=document.getElementById("vehicle_type").value;
            var vehicle_reg_no=document.getElementById("vehicle_registration_no").value;
            var vehicle_driver_name=document.getElementById("driver_id").value;
            
            if(route_id==0)
                {
                   alert("Please select route name");
                   document.getElementById("route_id").focus();
                   return false;
                }else
                    
                    var add_new_line_no=new Number(document.getElementById("add_line_no").value);
                        var add_one=new Number("1");
                        var add_number=new Number(add_new_line_no+add_one);
                        
                        for(var i=1;i<add_number;i++)
                        {
                         if(document.getElementById("sub_route_"+i+""))
                         {
                          var sub_route_name=document.getElementById("sub_route_"+i+"").value;
                          var pick_time=document.getElementById("pick_time_"+i+"").value;
                          var drop_time=document.getElementById("drop_time_"+i+"").value;
                          var rent=document.getElementById("rent_"+i+"").value;
                          if(sub_route_name==0)
                          {
                             alert("Please enter sub route");
                             document.getElementById("sub_route_"+i+"").focus();
                             return false;
                          }else
                              if(pick_time==0)
                          {
                             alert("Please enter pick time");
                             document.getElementById("pick_time_"+i+"").focus();
                             return false;
                          }else
                          if(drop_time==0)
                          {
                             alert("Please enter drop time");
                             document.getElementById("drop_time_"+i+"").focus();
                             return false;
                          }else
                          if(rent==0)
                          {
                             alert("Please enter rent/fare");
                             document.getElementById("rent_"+i+"").focus();
                             return false;
                          }else
                          if(isNaN(rent))
                          {
                             alert("Please enter only numeric value");
                             document.getElementById("rent_"+i+"").focus();
                             return false;
                          }
                          }
                         }
                    
           if(vehicle_type==0) 
            {
               alert("Please select vehicle type");
               document.getElementById("vehicle_type").focus();
               return false;
            }else
             if(vehicle_reg_no==0) 
            {
               alert("Please select vehicle registration number (like - XY 15 XY 4545)");
               document.getElementById("vehicle_registration_no").focus();
               return false;
            }else
             if(vehicle_driver_name==0) 
            {
               alert("Please select driver");
               document.getElementById("driver_id").focus();
               return false;
            }
        }
        </script>
        
        
        
        <script type="text/javascript">
         function  change_route_id(route_id) 
         {
             
             
             
   var organization_id="<?php  echo $fetch_school_id;?>";
   var branch_id="<?php  echo $fetch_branch_id;?>";
   var session_id=document.getElementById("insert_session_id").value;
   if((organization_id==0)&&(branch_id==0)&&(session_id==0))
       {
         alert("Please enter organization,branch,session id,Please Reload page");
         return false;
       }else
             if(route_id==0)
                 {
                     
              document.getElementById("show_sub_route_td").style.display="none";
            document.getElementById("sub_route_data").innerHTML="";
            return false;       
            }else
                {
var httpxml;   
try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
     if(httpxml.responseText!=0)
     {
 document.getElementById("show_sub_route_td").style.display="block";
 document.getElementById("sub_route_data").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";    
              
     }else
         {
          document.getElementById("sub_route_data").innerHTML="Record no Found !!";
          
          document.getElementById("ajax_loader_show").style.display="none";    
              
   
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="transport_ajax_code.php";
url=url+"?route_id="+route_id+"&&org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);   
                }
         }
         
         
         
         
         function  vehicle_type_id(vehicle_type_id) 
         {
             
             
             
              var organization_id="<?php  echo $fetch_school_id;?>";
   var branch_id="<?php  echo $fetch_branch_id;?>";
   var session_id=document.getElementById("insert_session_id").value;
   if((organization_id==0)&&(branch_id==0)&&(session_id==0))
       {
         alert("Please enter organization,branch,session id,Please Reload page");
         return false;
       }else
             if(vehicle_type_id==0)
                 {
                     
             document.getElementById("vehicle_registration_no").innerHTML="<option value='0'>-- Select vehicle registration no. --</option>"
            return false;       
            }else
                {
var httpxml;   
try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
     if(httpxml.responseText!=0)
     {

 document.getElementById("vehicle_registration_no").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";    
              
     }else
         {
          
          document.getElementById("ajax_loader_show").style.display="none";    
              
   
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="transport_ajax_code.php";
url=url+"?vehicle_type_id="+vehicle_type_id+"&&org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);   
                }
         }
        </script>
        
       
    </head>
    <body>
     
       <?php 
include_once '../ajax_loader_page_second.php';
      ?>
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
                           <td>Add Route & Transport</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Add Route & Transport</b></div>
                    
                    <a href="view_route_in_vehicle_details.php">
                        <div class="view_button">View Route & Transport Details</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   <table cellsapcing="4" cellpadding="4" class="table_middle">
                       <tr>
                           <td><br/></td>
                       </tr>
                       <tr>
                           <td><?php echo $message_show;?></td>
                       </tr>
                       <tr>
                           <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                       </tr>
                       <tr>
                       <td>Route Name <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                           <select class="select_class" onchange="change_route_id(this.value)" id="route_id" name="route_id">
                               <option value="0">--Select route name --</option> 
                               
                             <?php 
                               $route_db=  mysql_query("SELECT * FROM transport_route_db WHERE organization_id='$fetch_school_id' and 
                                   branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and is_delete='none'");
                               
                               while ($fetch_route_data=  mysql_fetch_array($route_db))
                               {
                              $fetch_route_id=$fetch_route_data['route_id'];
                              $fetch_route_name=$fetch_route_data['route_name'];
                              
                              echo "<option value='$fetch_route_id'>$fetch_route_name</option>";
                              
                               }
                               if(empty($fetch_route_id))
                               {
                                   echo "<option value='0'>Record no Found !!</option>";   
                               }
                               ?>
                               
                           </select>
                       </td>
                       <td><abbr title="Add New Route"><a href="add_route.php"><div class="add_button_styles">Add</div></a></abbr></td>
                      
                       </tr>
                      
                       <tr>
                           <td colspan="3">
                               <table id="show_sub_route_td" style="   display:none; ">
                                   <tr >
                           <td style=" width:185px; ">Sub Route</td>
                           <td><b>:</b></td>
                           <td id="sub_route_data" style=" color:blue; "></td>
                       </tr>
                               </table>
                           </td>
                       </tr>
                     
                       
                       
                       
                       <tr>
                           <td colspan="5">
                               <input type="hidden" id="add_line_no" value="1">
                               <table id="sub_route_table" cellspacing="0" cellpadding="0" style=" font-size:12px;  width:100%;  border:1px solid silver; ">
                                   <tr class="tr_style">
                                       <td style=" border-left:0px; ">Sub Route</td>
                                       <td>Pick Time</td>
                                       <td>Drop Time</td>
                                       <td >Rent/Fare</td>
                                       <td style=" border:0px; "></td>
                                   </tr>
                                   <tr class="td_style_sub">
<td style=" border-left:0; "><input id="sub_route_1" name="sub_route_name[]" class="text_style_sub_text" type="text" placeholder="Enter Sub route"></td>
<td><input class="time_picker" id="pick_time_1" type="text" name="pick_time[]" style=" width:70px; text-align:center;  "></td>
<td><input class="time_picker" id="drop_time_1" type="text" name="drop_time[]" style=" width:70px; text-align:center; "></td>
<td><span style=" color:red; "><?php echo $fetch_currency;?></span> <input id="rent_1" name="sub_route_price[]" onkeypress="javascript:return isNumber (event)" class="text_style_sub_text" type="text" style=" width:60px; text-align:right; "></td>
<td style=" border:0px; border-top:1px solid silver; "></td>
                                   </tr>
                                   </table> 
                               <table>
                                   <tr>
                                       <td>
                                           <input type="button" onclick="add_new_line()" class="add_new_line" value="Add New Sub Route">     
                                       </td>
                                   </tr>
                               </table>
                           </td>
                       </tr>
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       <td>Vehicle Type <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                           <select class="select_class" onchange="vehicle_type_id(this.value)" id="vehicle_type" name="vehicle_type">
                               <option value="0">--Select vehicle type --</option> 
                              <?php 
$vehicle_type_db=mysql_query("SELECT * FROM transport_vehicle_type_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and is_delete='none'");
while ($fetch_vehicle_type_data=  mysql_fetch_array($vehicle_type_db))
{
   $fetch_vehicle_type_id=$fetch_vehicle_type_data['vehicle_type_id'];
    $fetch_vehicle_type_name=$fetch_vehicle_type_data['vehicle_type'];
    echo "<option value='$fetch_vehicle_type_id'>$fetch_vehicle_type_name</option>";   
}
 if(empty($fetch_vehicle_type_id)) 
 {
 echo "<option value='0'>Record no found !!</option>";       
 }
?>
                           </select>
                       </td>
                       <td><abbr title="Add New Vehicle type"><a href="add_vehicle_type.php"><div class="add_button_styles">Add</div></a></abbr></td>
                      
                       </tr>
                       
                       <tr>
                       <td>Vehicle Registration No. <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                       <select class="select_class" id="vehicle_registration_no" name="vehicle_registration_no">
                               <option value="0">-- Select vehicle registration no. --</option> 
                           </select>
                       </td>
                       <td><abbr title="Add New Vehicle"><a href="add_vehicle.php"><div class="add_button_styles">Add</div></a></abbr></td>
                      
                       </tr>
                       
                       <tr style=" display:none; ">
                       <td>Rent/Fare <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><b style=" color:red; "><?php  echo $fetch_currency;?></b> <input onkeypress="javascript:return isNumber (event)" type="text" id="vehicle_rent" name="vehicle_rent" autocomplete="off"  class="text_box_class" style=" width:25%; text-align:right;  "> </td>
                       </tr>
                       
                       <tr>
                       <td>Driver <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                           <select id="driver_id" name="driver_id" class="select_class">
                               <option value="0">--- Select Driver---</option>
                               <?php
                               $driver_db=mysql_query("SELECT * FROM transport_driver_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and is_delete='none'");
                               while ($fecth_data=mysql_fetch_array($driver_db))
                               {
                                $data_1=$fecth_data['driver_unique_id'];
                                $driver_name=$fecth_data['driver_name'];
                                
                               
                                {
                                 echo "<option value='$data_1'>$driver_name </option>";
                                  
                                }
                                
                               }
                               
                               
                               ?>
                               
                               
                           </select>   
                       </td>
                       <td><abbr title="Add New Driver"><a href="add_driver.php"><div class="add_button_styles">Add</div></a></abbr></td>
                      
                       </tr>
                       
                      
                       <tr>
                       <td>Description </td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter description" class="text_area_class"></textarea></td>
                       </tr>
                       
                       <tr>
                           <td colspan="3">
                                <input type="submit" class="submit_process" name="submit_process" value="Save"> 
                               
                               
                                <input type="reset" class="reset_process" style=" margin-right:20px; " name="reset_process" value="Reset">
                              
                           </td>
                       </tr>
                   </table>    
                   
               </div>
                
             
                
                
               
            </div> 
            <div id="last_size_cover"></div>
        </div>
        
            <script src="../javascript/jquery-1.7.2.min.js"></script>  
  <script type="text/javascript" src="../javascript/time_picker/jquery.timepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="../javascript/time_picker/jquery.timepicker.css" />

  <script type="text/javascript" src="../javascript/time_picker/lib/bootstrap-datepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="../javascript/time_picker/lib/bootstrap-datepicker.css" />

  <script type="text/javascript" src="../javascript/time_picker/lib/site.js"></script>
  <link rel="stylesheet" type="text/css" href="../javascript/time_picker/lib/site.css" /> 
  
  <script type="text/javascript">
                $(function() {
                    $('.time_picker').timepicker();
                });
            </script>
        
            <script type="text/javascript">
                       function add_new_line()
                       {
                        var add_new_line_no=new Number(document.getElementById("add_line_no").value);
                        var add_one=new Number("1");
                        var add_number=new Number(add_new_line_no+add_one);
                        
                        for(var i=1;i<add_number;i++)
                        {
                         if(document.getElementById("sub_route_"+i+""))
                         {
                          var sub_route_name=document.getElementById("sub_route_"+i+"").value;
                          var pick_time=document.getElementById("pick_time_"+i+"").value;
                          var drop_time=document.getElementById("drop_time_"+i+"").value;
                          var rent=document.getElementById("rent_"+i+"").value;
                          if(sub_route_name==0)
                          {
                             alert("Please enter sub route");
                             document.getElementById("sub_route_"+i+"").focus();
                             return false;
                          }else
                              if(pick_time==0)
                          {
                             alert("Please enter pick time");
                             document.getElementById("pick_time_"+i+"").focus();
                             return false;
                          }else
                                if(drop_time==0)
                          {
                             alert("Please enter drop time");
                             document.getElementById("drop_time_"+i+"").focus();
                             return false;
                          }else
                                if(rent==0)
                          {
                             alert("Please enter rent/fare");
                             document.getElementById("rent_"+i+"").focus();
                             return false;
                          }
                          }
                         }
                        
                        
    var table=document.getElementById("sub_route_table");
    var row=table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);
     var cell4 = row.insertCell(3);
     var cell5 = row.insertCell(4);
     
     cell1.innerHTML="<input name='sub_route_name[]' id='sub_route_"+add_number+"' class='text_style_sub_text' type='text' placeholder='Enter Sub route'>";
     cell2.innerHTML="<input class='time_picker' id='pick_time_"+add_number+"' type='text' name='pick_time[]' style=' width:70px; text-align:center; '>";
     cell3.innerHTML="<input class='time_picker' id='drop_time_"+add_number+"' type='text' name='drop_time[]' style=' width:70px; text-align:center; '>";
     cell4.innerHTML="<b style='color:Red;'><?php echo $fetch_currency;?></b> <input id='rent_"+add_number+"' class='text_style_sub_text' type='text' name='sub_route_price[]' onkeypress='javascript:return isNumber (event)' style=' width:60px; text-align:right; '>";
     cell5.innerHTML="<input type='button' onclick='removeen(this)' class='remove_button' value='Remove'>";
    
    $(function() {
                    $('.time_picker').timepicker();
                });
     
     document.getElementById("add_line_no").value=add_number;
     
var tbl=document.getElementById("sub_route_table");        
var tds=tbl.getElementsByTagName("td"); 
tds[5].style.borderTop="1px solid silver";
tds[6].style.borderTop="1px solid silver";
tds[6].style.borderLeft="1px solid silver";
tds[7].style.borderTop="1px solid silver";
tds[7].style.borderLeft="1px solid silver";
tds[8].style.borderTop="1px solid silver";
tds[8].style.borderLeft="1px solid silver";
tds[9].style.borderTop="1px solid silver";

                       }
                       
function removeen(row)
{
var r=confirm("Are you sure you want to remove");
if (r==true)
  {
     var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('sub_route_table').deleteRow(i);   
  }
  
  }
                       </script>
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