<?php
//SESSION CONFIGURATION
$check_array_in="transport";
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
 $route_unique_id=$_POST['route_unique_id'];  
 $route_code=$_POST['route_code'];    
 $route_name=$_POST['route_name'];
 $sub_route_name=$_POST['sub_route_name'];
 $route_distance=$_POST['distanse_one_ways'];
 $description=$_POST['description'];

 
  
 if((!empty($route_code))&&(!empty($route_unique_id))&&(!empty($route_name))&&(!empty($sub_route_name)))
 {
  
 $select_match_route_db=mysql_query("SELECT * FROM transport_route_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
         and route_id!='$route_unique_id' and route_code='$route_code' and route_name='$route_name' and sub_route_name='$sub_route_name' and is_delete='none'"
         . " OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and route_id!='$route_unique_id' and route_code='$route_code' and is_delete='none'"); 
 $fetch_route_data=mysql_fetch_array($select_match_route_db);
 $fetch_route_num_rows=mysql_num_rows($select_match_route_db);
    if((empty($fetch_route_data))&&($fetch_route_data==null)&&($fetch_route_num_rows==0)) 
    {
     
      $update_db=  mysql_query("UPDATE transport_route_db SET route_code='$route_code',route_name='$route_name',"
            . "sub_route_name='$sub_route_name',distance='$route_distance',description='$description'"
            . " WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and route_id='$route_unique_id' and is_delete='none'"); 
    if((!empty($update_db))&&($update_db)) 
    {
      $message_show="<div class='notification_alert_show' style='color:green;'>Record update successfully complete.</div>";   
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
        <title>Edit Route Details</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
             function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
            </script> 
        
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
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validate_form();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Route Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
              <?php
              if(!empty($_REQUEST['token_id']))
              {
               
    $token_id=$_REQUEST['token_id'];
   $database_db=mysql_query("SELECT * FROM transport_route_db WHERE encrypt_id='$token_id' and is_delete='none'");
  $fetch_data=mysql_fetch_array($database_db);
  $fetch_num_rows=mysql_num_rows($database_db);
  if((!empty($fetch_data))&&($fetch_data!=null)&&($fetch_num_rows!=0))
  {
 
      
  {   
   ?>   
                <input type="hidden" name="route_unique_id" value="<?php echo $fetch_data[4];?>">
    <table cellsapcing="4" cellpadding="4" class="table_middle" style=" font-size:12px; ">
                      
                       <tr>
                           <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                       </tr>
                       
                       <tr>
                           <td><br/></td>
                       </tr>
                      <tr>
                          <td><b>Route Code <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[6];?>" id="route_code" name="route_code" placeholder="Enter route code"
                                  class="text_box_class"></td>
                       </tr>
                       <tr>
                           <td><b>Route Name <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[7];?>" id="route_name" name="route_name" placeholder="Enter route name" class="text_box_class"></td>
                       </tr>
                      
                       <tr>
                       <td><b>Sub Route Name <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><textarea id="sub_route_name" name="sub_route_name" placeholder="Enter sub route name" class="text_area_class"><?php echo $fetch_data[8];?></textarea></td>
                       </tr>
                       
                       <tr>
                           <td><b>Distance (one ways)</b></td>
                       <td><b>:</b></td>
                       <td><input value="<?php echo $fetch_data[9];?>" type="text" id="distance_one_ways" onkeypress="javascript:return isNumber (event)" autocomplete="off" name="distanse_one_ways"
                                  style=" width:20%; text-align:center;  " class="text_box_class"> <b>Km</b></td>
                       </tr>
                       
                       <tr>
                       <td><b>Description</b></td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter description" class="text_area_class"><?php echo $fetch_data[10];?></textarea></td>
                       </tr>
                       
                       <tr>
                           <td colspan="3">
                               <input type="submit" class="submit_process" style=" margin-right:0px; " 
                                      name="submit_process" value="Update"> 
                               
                               <input type="reset" class="reset_process" style=" margin-right:20px; " name="reset_process" value="Reset">
                               
                               
                           </td>
                       </tr>
                   </table>     
                
                
                
      
   <?php
  }
  }else
  {
      echo "Record no found !"; 
  }
                  
              }
              
              ?>
                
            
            
            
            </div>
            </div>
            <div class="edit_fotter_div_tag">Design & Develop By :  Pixabyte Technologies Pvt. Ltd.</div>
            
            
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