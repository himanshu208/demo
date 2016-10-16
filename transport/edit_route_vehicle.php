<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/edit_page_configuration.php';
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
$route_allot_db_id=$_POST['update_unique_id'];

if(!empty($_POST['sub_route_unqiue_id']))
{
$sub_route_db_id=$_POST['sub_route_unqiue_id'];
$sub_route_db_id=array_filter($sub_route_db_id);
}else
{
$sub_route_db_id=0;   
}

if(!empty($_POST['temp_sub_route_unqiue_id']))
{
 $temp_sub_route_id=$_POST['temp_sub_route_unqiue_id']; 
 $temp_sub_route_id=array_filter($temp_sub_route_id);
}else
{
 $temp_sub_route_id=0;
}

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

 if((!empty($route_allot_db_id))&&(!empty($route_id))&&(!empty($vehicle_type))
         &&(!empty($vehicle_reg_no))&&(!empty($vehicle_driver))
         &&(!empty($insert_session_id))&&(!empty($insert_sub_route))&&(!empty($insert_pick_time))&&(!empty($insert_drop_time))
         &&(!empty($insert_rent)))
 {
  
 $select_match_route_vehicle_db=mysql_query("SELECT * FROM transport_allocate_route_db WHERE $db_main_details allocate_vehicle_route_id!='$route_allot_db_id'  and route_id='$route_id' and vehicle_type_id='$vehicle_type' and vehicle_id='$vehicle_reg_no' and is_delete='none'"); 
 $fetch_route_vehicle_data=mysql_fetch_array($select_match_route_vehicle_db);
 $fetch_route_vehicle_num_rows=mysql_num_rows($select_match_route_vehicle_db);
    if((empty($fetch_route_vehicle_data))&&($fetch_route_vehicle_data==null)&&($fetch_route_vehicle_num_rows==0)) 
    {

     $update_db=mysql_query("UPDATE transport_allocate_route_db SET route_id='$route_id',vehicle_type_id='$vehicle_type'"
             . ",vehicle_id='$vehicle_reg_no',driver_id='$vehicle_driver',description='$description' WHERE $db_main_details allocate_vehicle_route_id='$route_allot_db_id' and is_delete='none'");
     if((!empty($update_db))&&($update_db)) 
    {
         
    
         
     $sub_rount_count=count($sub_route);
     for($i=0;$i<$sub_rount_count;$i++)
     {
     
         if(!empty($sub_route_db_id[$i]))
         {
         $update_sub_route_id=$sub_route_db_id[$i];
         }else
         {
         $update_sub_route_id=0;   
         }
        
         $insert_sub_route_name=$sub_route[$i];
         $insert_pick_time=$pick_time[$i];
         $insert_drop_time=$drop_time[$i];
         $insert_rent=$rent_fare[$i];
        if(!empty($update_sub_route_id))
        {
         
        if((!empty($insert_sub_route_name))&&(!empty($insert_rent)))
        {
         $update_sub_route_db=  mysql_query("UPDATE transport_sub_route_db SET route_allot_id='$route_allot_db_id',"
                 . "sub_route='$insert_sub_route_name',pick_time='$insert_pick_time',drop_time='$insert_drop_time',rent='$insert_rent' WHERE $db_main_details sub_route_unique_id='$update_sub_route_id' and is_delete='none'");   
        }  
        }else
         if((empty($update_sub_route_id))&&(!empty($insert_sub_route_name))&&(!empty($insert_rent)))
         {
$results=mysql_query("SHOW TABLE STATUS LIKE 'transport_sub_route_db'");
$rows=mysql_fetch_array($results);
$nextIds=$rows['Auto_increment']; 
$final_sub_route_id="SUBRUTE_$nextIds"; 
$encrypt_id=md5(md5($final_sub_route_id));
    
      $update_sub_route_db=mysql_query("INSERT into transport_sub_route_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
        . ",'$final_sub_route_id','$encrypt_id','$route_allot_db_id','$insert_sub_route_name','$insert_pick_time'"
        . ",'$insert_drop_time','$insert_rent','none','$date','$date_time','$fecth_user_unique')");
         }  
         }
       
      if($update_sub_route_db)
      {
      $message_show="<div class='notification_alert_show' style='color:green;'>Record update successfully complete</div>";   
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

<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Route & Transport</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       
        
        <script type="text/javascript">
    window.onload = refreshParent;
    function refreshParent() {
     window.opener.location.reload();
    }
   
   function close_pop_up_this()
   {
   window.close();    
   }
   
</script>


        <script type="text/javascript">
            function ok_close()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
             function close_button()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
   document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) 
    {
       document.getElementById("win_pop_up").style.display="none";
    }else
    if (evt.keyCode == 13) 
    {
    document.getElementById("win_pop_up").style.display="none";
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
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validate_form();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Route & Transport</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];
             
            $select_data=mysql_query("SELECT * FROM transport_allocate_route_db WHERE $db_main_details encrypt_id='$token_id' and is_delete='none'"); 
            $fetch_data=mysql_fetch_array($select_data);
            $fetch_num_data=mysql_num_rows($select_data);
            if((!empty($fetch_data))&&($fetch_data!=null)&&($fetch_num_data!=0))
            {
            
            $session_id=$fetch_data['session_id'];
            $allote_route_vehicle_id=$fetch_data['allocate_vehicle_route_id'];
            $route_id=$fetch_data['route_id'];
            $vehicle_type_id=$fetch_data['vehicle_type_id'];
            $vehicel_id=$fetch_data['vehicle_id'];
            $driver_id=$fetch_data['driver_id'];
            $description=$fetch_data['description'];
           $vehicle_rent=$fetch_data['vehicle_rent'];         
             {
             ?>  
             <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $fetch_data[4];?>">
             <input type="hidden" name="use_inset_session_id" id="insert_session_id"  value="<?php  echo $session_id;?>">   
      
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
                              if($route_id==$fetch_route_id)
                              {
                              echo "<option value='$fetch_route_id' selected>$fetch_route_name</option>";
                              }else
                              {
                              echo "<option value='$fetch_route_id'>$fetch_route_name</option>";
                                  
                              }
                               }
                               if(empty($fetch_route_id))
                               {
                                   echo "<option value='0'>Record no Found !!</option>";   
                               }
                               ?>
                               
                           </select>
                       </td>
                       
                       </tr>
                      
                       <tr>
                           <td colspan="3">
                               <table id="show_sub_route_td" style=" float:left;    display:none; ">
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
                    <?php
                    $number=1;
                    $sub_route_db=mysql_query("SELECT * FROM transport_sub_route_db WHERE $db_main_details"
                            . " route_allot_id='$allote_route_vehicle_id' and is_delete='none' ORDER BY id DESC");
                    $sub_route_num_rows=mysql_num_rows($sub_route_db);
                    while ($sub_route_data=mysql_fetch_array($sub_route_db))
                    {
                     $sub_route_unqiue_id=$sub_route_data['sub_route_unique_id']; 
                     $sub_route_name=$sub_route_data['sub_route'];
                     $sub_route_pick_time=$sub_route_data['pick_time'];
                     $sub_route_drop_time=$sub_route_data['drop_time'];
                     $sub_route_rent=$sub_route_data['rent'];
                    {
                     ?>
                         
<tr class="td_style_sub">
<td style=" border-left:0; ">
    <input type="hidden" name="sub_route_unqiue_id[]" value="<?php echo $sub_route_unqiue_id;?>"> 
    <input id="sub_route_<?php echo $number;?>" value="<?php echo $sub_route_name;?>" name="sub_route_name[]" class="text_style_sub_text" type="text" placeholder="Enter Sub route"></td>
<td><input class="time_picker" value="<?php echo $sub_route_pick_time;?>" id="pick_time_<?php echo $number;?>" type="text" name="pick_time[]" style=" width:70px; text-align:center;  "></td>
<td><input class="time_picker" value="<?php echo $sub_route_drop_time;?>" id="drop_time_<?php echo $number;?>" type="text" name="drop_time[]" style=" width:70px; text-align:center; "></td>
<td><span style=" color:red; "><?php echo $fetch_currency;?></span> <input value="<?php echo $sub_route_rent;?>" id="rent_<?php echo $number;?>" name="sub_route_price[]" onkeypress="javascript:return isNumber (event)" class="text_style_sub_text" type="text" style=" width:60px; text-align:right; "></td>
<td style=" border:0px; border-top:1px solid silver; ">
<?php


if($sub_route_num_rows!=$number)
{
{
  ?>
  <input type="button" onclick="removeen(this)" class="remove_button" value="Remove">
    <?php
}

}
?>
</td>
</tr>                                  
                                   
                     <?php
                    }
                    $number++;
                    }
                    if(empty($sub_route_num_rows))
                    {
                    ?>               
                                   
 <tr class="td_style_sub">
     
<td style=" border-left:0; ">
     <input type="hidden" name="sub_route_unqiue_id[]"> 
    <input id="sub_route_1" name="sub_route_name[]" class="text_style_sub_text" type="text" placeholder="Enter Sub route"></td>
<td><input class="time_picker" id="pick_time_1" type="text" name="pick_time[]" style=" width:70px; text-align:center;  "></td>
<td><input class="time_picker" id="drop_time_1" type="text" name="drop_time[]" style=" width:70px; text-align:center; "></td>
<td><span style=" color:red; "><?php echo $fetch_currency;?></span> <input id="rent_1" name="sub_route_price[]" onkeypress="javascript:return isNumber (event)" class="text_style_sub_text" type="text" style=" width:60px; text-align:right; "></td>
<td style=" border:0px; border-top:1px solid silver; "></td>
                                   </tr>
<?php
                    }
?>


                                   </table> 
                               <table style=" float:left; ">
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
    if($vehicle_type_id==$fetch_vehicle_type_id)
    {
    echo "<option value='$fetch_vehicle_type_id' selected>$fetch_vehicle_type_name</option>"; 
    }else
    {
      echo "<option value='$fetch_vehicle_type_id'>$fetch_vehicle_type_name</option>"; 
       
    }
}
 if(empty($fetch_vehicle_type_id)) 
 {
 echo "<option value='0'>Record no found !!</option>";       
 }
?>
                           </select>
                       </td>
                      
                       </tr>
                       
                       <tr>
                       <td>Vehicle Registration No. <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                       <select class="select_class" id="vehicle_registration_no" name="vehicle_registration_no">
                               <option value="0">-- Select vehicle registration no. --</option> 
                               <?php
$vehicle_db=  mysql_query("SELECT * FROM transport_vehicle_db WHERE $db_main_details vehicle_type_id='$vehicle_type_id' and is_delete='none'");
  while ($fetch_vehicle_data=mysql_fetch_array($vehicle_db))
  {
    $fetch_vehicle_id=$fetch_vehicle_data['vehicle_id'];
    $fetch_vehicle_reg_name=$fetch_vehicle_data['vehicle_registration_no'];
    if($vehicel_id==$fetch_vehicle_id)
    {
    echo "<option value='$fetch_vehicle_id' selected>$fetch_vehicle_reg_name</option>";
    }else
    {
     echo "<option value='$fetch_vehicle_id'>$fetch_vehicle_reg_name</option>";
       
    }
  }
  if(empty($fetch_vehicle_id))
  {
      echo "<option value='0'>Record no found !!</option>";
  } 
                               ?>
                               
                           </select>
                       </td>
                     
                       </tr>
                      
                       
                       <tr>
                       <td>Driver <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                           <select id="driver_id" name="driver_id" class="select_class">
                               <option value="0">--- Select Driver---</option>
                               <?php
                               $driver_db=mysql_query("SELECT * FROM transport_driver_db WHERE $db_main_details is_delete='none'");
                               while ($fecth_data=mysql_fetch_array($driver_db))
                               {
                                $data_1=$fecth_data['driver_unique_id'];
                                $driver_name=$fecth_data['driver_name'];
                                if($driver_id!=$data_1)
                                {
                                $check_used=mysql_query("SELECT * FROM transport_allocate_route_db WHERE $db_main_details driver_id='$data_1' and is_delete='none'");
                                $data_num_check=mysql_num_rows($check_used);
                                if(!empty($data_num_check))
                                {
                                echo "<option value='$data_1' disabled>$driver_name  (already allot)</option>";
                                }else
                                {
                                 echo "<option value='$data_1'>$driver_name </option>";
                                  
                                }
                                }else
                                {
                                  echo "<option value='$data_1' selected>$driver_name </option>";   
                                }
                               }
                               
                               
                               ?>
                               
                               
                           </select>   
                       </td>
                     
                       </tr>
                       
                      
                       <tr>
                       <td>Description </td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter description" class="text_area_class"><?php echo $description;?></textarea></td>
                       </tr>
                       
                       <tr>
                           <td colspan="3">
                                <input type="submit" class="submit_process" name="submit_process" value="Update"> 
                               
                               
                                <input type="reset" class="reset_process" style=" margin-right:20px; " name="reset_process" value="Reset">
                              
                           </td>
                       </tr>
                   </table> 
                
                
            <?php
             }
            }
             }
            ?>
            
            
            
            </div>
            </div>
            <div class="edit_fotter_div_tag">Design & Develop By :  Pixabyte Technologies Pvt. Ltd.</div>
            
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
     
     cell1.innerHTML=" <input type='hidden' name='sub_route_unqiue_id[]' value=''><input name='sub_route_name[]' id='sub_route_"+add_number+"' class='text_style_sub_text' type='text' placeholder='Enter Sub route'>";
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
        </div>
       </form>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>