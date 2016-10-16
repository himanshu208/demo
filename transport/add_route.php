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
 $route_code=$_POST['route_code'];    
 $route_name=$_POST['route_name'];
 $sub_route_name=$_POST['sub_route_name'];
 $route_distance=$_POST['distanse_one_ways'];
 $description=$_POST['description'];
 $insert_session_id=$_POST['use_inset_session_id'];
  
 
$result=mysql_query("SHOW TABLE STATUS LIKE 'transport_route_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_db_id="RUTE_$nextId"; 
$encrypt_id=md5(md5($final_db_id));

  
 if((!empty($route_code))&&(!empty($final_db_id))&&(!empty($route_name))&&(!empty($sub_route_name)))
 {
  
 $select_match_route_db=mysql_query("SELECT * FROM transport_route_db WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and route_id='$final_db_id' and is_delete='none'
     OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$insert_session_id'
         and route_code='$route_code' and route_name='$route_name' and sub_route_name='$sub_route_name' and is_delete='none'"
         . " OR organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and route_code='$route_code' and is_delete='none'"); 
 $fetch_route_data=mysql_fetch_array($select_match_route_db);
 $fetch_route_num_rows=mysql_num_rows($select_match_route_db);
    if((empty($fetch_route_data))&&($fetch_route_data==null)&&($fetch_route_num_rows==0)) 
    {
     
     $insert_db=mysql_query("INSERT into transport_route_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'
         ,'$final_db_id','$encrypt_id','$route_code','$route_name','$sub_route_name','$route_distance','$description','none'
             ,'$date','$date_time','$user_unique_id','active')");
    if((!empty($insert_db))&&($insert_db)) 
    {
      $message_show="<div class='notification_alert_show' style='color:green;'>Record save successfully complete.</div>";   
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
        <title></title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
        function validate_form() 
        {
            var route_code=document.getElementById("route_code").value;
            var route_name=document.getElementById("route_name").value;
            var sub_route_name=document.getElementById("sub_route_name").value;
            var distance_one_ways=document.getElementById("distance_one_ways").value;
            if(route_code==0)
            {
             alert("Please enter route code");
               document.getElementById("route_code").focus();
               return false;   
            }else
           if(route_name==0) 
            {
               alert("Please enter route name");
               document.getElementById("route_name").focus();
               return false;
            }else
             if(sub_route_name==0) 
            {
               alert("Please enter sub route name");
               document.getElementById("sub_route_name").focus();
               return false;
            }else
                if(isNaN(distance_one_ways))
                    {
                     alert("Please enter only numeric value");
               document.getElementById("distance_one_ways").focus();
               return false;   
                    }
            
        }
        </script>
    </head>
    <body>
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
                           <td>Add Route</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Add Route</b></div>
                    <a href="view_route_details.php">
                        <div class="view_button">View Route Details</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   <table cellsapcing="4" cellpadding="4" class="table_middle" style=" font-size:12px; ">
                       <tr>
                           <td><span style=" display:none; "><?php echo $message_show;?></span></td>
                       </tr>
                       <tr>
                           <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                       </tr>
                       
                       <tr>
                           <td><br/></td>
                       </tr>
                      <tr>
                          <td><b>Route Code <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="route_code" name="route_code" placeholder="Enter route code"
                                  class="text_box_class"></td>
                       </tr>
                       <tr>
                           <td><b>Route Name <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="route_name" name="route_name" placeholder="Enter route name" class="text_box_class"></td>
                       </tr>
                      
                       <tr>
                       <td><b>Sub Route Name <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><textarea id="sub_route_name" name="sub_route_name" placeholder="Enter sub route name" class="text_area_class"></textarea></td>
                       </tr>
                       
                       <tr>
                           <td><b>Distance (one ways)</b></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="distance_one_ways" onkeypress="javascript:return isNumber (event)" autocomplete="off" name="distanse_one_ways"
                                  style=" width:20%; text-align:center;  " class="text_box_class"> <b>Km</b></td>
                       </tr>
                       
                       <tr>
                       <td><b>Description</b></td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter description" class="text_area_class"></textarea></td>
                       </tr>
                       
                       <tr>
                           <td colspan="3">
                               <input type="submit" class="submit_process" style=" margin-right:0px; " name="submit_process" value="Save"> 
                               
                               <input type="reset" class="reset_process" style=" margin-right:20px; " name="reset_process" value="Reset">
                               
                               
                           </td>
                       </tr>
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