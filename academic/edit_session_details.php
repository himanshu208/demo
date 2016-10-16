<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>


<?php 
$message_show="";
if(isset($_POST['edit_submit_data_process']))
{
  $session_db_id=$_POST['session_db_id'];  
  $session_unique_id=$_POST['session_unique_id'];   
  $session_name=$_POST['session_year'];
  $session_description=$_POST['description'];
  $start_date=$_POST['start_date'];
  $end_date=$_POST['end_date'];
  if(!empty($_POST['default_set']))
  {
  $default_set=$_POST['default_set'];
  }else
  {
  $default_set="";     
  }
  
  if((!empty($session_name))&&(!empty($session_unique_id))&&(!empty($start_date))&&(!empty($end_date)))
  {
   
      $session_match_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id!='$session_unique_id' and session_name='$session_name' and is_delete='none'");
      $fetch_session_data_check=mysql_fetch_array($session_match_db);
      $fetch_session_num_rows_check=mysql_num_rows($session_match_db);
      if((empty($fetch_session_data_check))&&($fetch_session_data_check==null)&&($fetch_session_num_rows_check==0))
      {
      
       $update_session_db=mysql_query("UPDATE session_db SET session_name='$session_name',session_description='$session_description',"
             . "start_date='$start_date',end_date='$end_date',by_defult='$default_set' WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' "
             . "and session_id='$session_unique_id' and is_delete='none'");
       if($update_session_db)
       {
       if(!empty($default_set))
       {
       $update_session_all_db=mysql_query("UPDATE session_db SET by_defult='' WHERE id!='$session_db_id' and organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' "
             . " and is_delete='none'");   
       }
       
        $message_show="<span style='color:green;'>Record update successfully complete.</span>";  
       }else
       {
        $message_show="<span style='color:red;'>Request failed,Please try again</span>";     
       }
          
          
      }else
      {
        $message_show="<span style='color:red;'>Record already exist in database.</span>";  
      }
      
      
  }else
  {
      $message_show="<span style='color:red;'>Please fill all fields.</span>";
  }
    
  require_once '../pop_up.php';   
    
}

require_once 'edit_header_page.php';

?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Session Details</title>
         <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
         <script type="text/javascript">
 function validateForm()
 {
     var session_name=document.getElementById("session_year").value;
     var start_date=document.getElementById("from").value;
     var end_date=document.getElementById("to").value;
     if(session_name==0)
         {
             alert("Please enter session name");
             document.getElementById("session_year").focus();
             return false;
         }else
             if(start_date==0)
         {
             alert("Please enter start date");
             document.getElementById("from").focus();
             return false;
         }else
             if(end_date==0)
         {
             alert("Please enter end date");
             document.getElementById("to").focus();
             return false;
         }else
             {
             document.getElementById("ajax_loader_show").style.display="block";    
                  
             }
             
 }
</script>

<script type="text/javascript">
    
    function refreshParent() {
        window.opener.location.href = window.opener.location.href;
     
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
               window.close();
               return false;
            }
            
             function close_button()
            {
               document.getElementById("win_pop_up").style.display="none"; 
               window.close();
            }
            
   document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) 
    {
       document.getElementById("win_pop_up").style.display="none";
       window.close();
    }else
    if (evt.keyCode == 13) 
    {
    document.getElementById("win_pop_up").style.display="none";
    window.close();
    }
};
            
            </script>    
         
         <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
         
        <script type="text/javascript">
      
$(function() {
$("#from").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
    $("#to").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
   
});
    </script>
               
    </head>
    <body onload="refreshParent()">
      <?php  include_once '../ajax_loader_page_second.php';?>
        
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Session Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div> 
            
          <?php 
            if(!empty($_REQUEST['token_id']))
            {
            $token_id=$_REQUEST['token_id'];
            $session_db=mysql_query("SELECT * FROM session_db WHERE session_encrypt_id='$token_id' and is_delete='none'");
            $fetch_session_data=mysql_fetch_array($session_db);
            $fetch_session_num_rows=mysql_num_rows($session_db);
            if((!empty($fetch_session_data))&&($fetch_session_data!=null)&&($fetch_session_num_rows!=0))
            {
                $session_db_fetch_id=$fetch_session_data['id'];
                $session_unique_id=$fetch_session_data['session_id'];
                    $session=$fetch_session_data['session_name'];
                    $description=$fetch_session_data['session_description'];
                    $start_date=$fetch_session_data['start_date'];
                   $end_date=$fetch_session_data['end_date'];
                   $by_deafault=$fetch_session_data['by_defult'];
                   
                   if($by_deafault=="active")
                   {
                    $by_deafault="checked";   
                   }else
                   {
                     $by_deafault="";  
                   }
            ?>
            
            
            <form action="" method="post" name="form1" onsubmit="return validateForm();" enctype="multipart/form-data">
                <input type="hidden" name="session_db_id" value="<?php  echo $session_db_fetch_id;?>">
                <input type="hidden" name="session_unique_id" value="<?php  echo $session_unique_id;?>">
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
             <table cellspacing="2" cellpadding="2" >
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr>
                        <td colspan="3">
                        </td>
                    </tr>
                    <tr><td>Session Name<sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="session_year" 
                                   placeholder="Enter session name" class="text_box_org"
                                   value="<?php  echo $session;?>"  name="session_year" ></td>
                    </tr>
                     <tr>
                        <td>Description</td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter session description" name="description" 
                                      id="address_text_area"><?php  echo $description;?></textarea>
                        </td>
                    </tr>
       
                     <tr><td>Start Date <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input style=" background-color:whitesmoke; " readonly="readonly" type="text" id="from" 
                                   placeholder="Enter start date" class="text_box_org"
                                   value="<?php  echo $start_date;?>" name="start_date" ></td>
                    </tr>
                    <tr><td>End Date <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input style=" background-color:whitesmoke; " readonly="readonly" type="text"  id="to" 
                                   placeholder="Enter end date" class="text_box_org"
                                   value="<?php  echo $end_date;?>"  name="end_date" ></td>
                    </tr>
                    <tr><td>Default Set <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td>
                            
                            <input type="checkbox" name="default_set" value="active" 
                                   class="module_list" style=" float:left;"<?php  echo $by_deafault;?>></td>
                    </tr>
                     <tr>
                        <td colspan="3">
                            <input type="submit" name="edit_submit_data_process"
                                   class="save_button" id="save_button"  value="Update">   
                        </td>
                    </tr>
               </table>
                
                
                
             </div>
             </div>
            </form>
          <?php 
            }
            }
            ?>
             <div class="edit_fotter_div_tag">Design & Develop By : Pixabyte Technologies Pvt. Ltd.</div>
            
            
        </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>