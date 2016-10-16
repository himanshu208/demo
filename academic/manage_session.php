<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>

<?php 
$message_show="";
if(isset($_POST['submit_data_process']))
{
  
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
     
$result=mysql_query("SHOW TABLE STATUS LIKE 'session_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_session_id="SESSION_$nextId"; 
$encrypt_id=md5(md5($final_session_id));
$session_db_id=$nextId;
 
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
  
  if((!empty($session_name))&&(!empty($final_session_id))&&(!empty($start_date))&&(!empty($end_date)))
  {
   
      $session_match_db=  mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$final_session_id' and is_delete='none' OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_name='$session_name' and is_delete='none'");
      $fetch_session_data_check=  mysql_fetch_array($session_match_db);
      $fetch_session_num_rows_check=  mysql_num_rows($session_match_db);
      if((empty($fetch_session_data_check))&&($fetch_session_data_check==null)&&($fetch_session_num_rows_check==0))
      {
          
       $insert_session_db=  mysql_query("INSERT into session_db values('','$fetch_school_id','$fetch_branch_id'
               ,'$final_session_id','$encrypt_id','$session_name','$session_description','$start_date','$end_date'
               ,'$date','$date_time','$user_unique_id','$default_set','none','active')");
       if($insert_session_db)
       {
           
       if(!empty($default_set))
       {
       $update_session_all_db=mysql_query("UPDATE session_db SET by_defult='' WHERE id!='$session_db_id' and organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' "
             . " and is_delete='none'");   
       }    
           
        $message_show="<span style='color:green;'>Record save successfully complete.</span>";  
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

?>


<html>
    <head>
        
        <meta http-equiv="Cache-control" content="no-cache">
        <meta http-equiv="Expires" content="-1">
        <title>Add New Class/Course</title>
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
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
        
        
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="#" method="post" onsubmit="return validateForm();" enctype="multipart/form-data">
       
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="academic.php">Academic</a></td>
                           <td>/</td>
                           <td>Manage Session</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Manage Session</b></div>
                  </div>
                
               
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
               
               
               <div class="main_work_data" style=" padding-top:20px;">
                   
                   
                   <div class="left_add_work_div">
                       <div class="heading_title_td" style="width:96%;  margin-left:0px; ">Add New Session</div>     
                    
                   <table cellspacing="2" cellpadding="2" id="session_table_style">
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
                                   name="session_year" ></td>
                    </tr>
                     <tr>
                        <td>Description</td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter session description" name="description" 
                                      id="address_text_area"></textarea>
                        </td>
                    </tr>
       
                     <tr><td>Start Date <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input style=" background-color:whitesmoke; " readonly="readonly" type="text" id="from" 
                                   placeholder="Enter start date" class="text_box_org"
                                   name="start_date" ></td>
                    </tr>
                    <tr><td>End Date <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input style=" background-color:whitesmoke; " readonly="readonly" type="text"  id="to" 
                                   placeholder="Enter end date" class="text_box_org"
                                   name="end_date" ></td>
                    </tr>
                    <tr><td>Default Set <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td>
                            
                            <input type="checkbox" name="default_set" value="active" 
                                   class="module_list"  style=" float:left;"></td>
                    </tr>
                     <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button"  id="save_button"  value="Save">   
                        </td>
                    </tr>
               </table>   
                   </div> 
                    <div class="verticle_length"></div>
                   <div class="right_fetch_work_div">
                    <div class="heading_title_td">View Session Details</div>    
                       
                    <table cellspacing="0" cellpadding="0" class="session_fetch_details">
                        <tr class="table_heading">
                            <td>Sl. No.</td>
                            <td>Session</td>
                            <td>Description</td>
                             <td>Start Date</td>
                              <td>End Date</td>
                              <td>By Default</td>
                              <td style="border-right:1px solid gray; ">Action</td>
                        </tr>
                      <?php 
                        $row=0;
                        $session_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'"
                                . "and is_delete='none'");
                        while ($fetch_session_data=mysql_fetch_array($session_db))
                        {
                            $row++;
                            $session_unique_id=$fetch_session_data['session_id'];
                            $encrypt_id=$fetch_session_data['session_encrypt_id'];
                         $session_name=$fetch_session_data['session_name'];
                         $session_description=$fetch_session_data['session_description'];
                                 $session_start_date=$fetch_session_data['start_date'];
                                 $session_end_date=$fetch_session_data['end_date'];
                                 
                                 $session_default=ucfirst($fetch_session_data['by_defult']);
                                 
                                 
                                 echo "<tr id='delete_row_$session_unique_id' class='td_data_style'>
                                   <td><b>$row</b></td> 
                                       <td><b>$session_name</b></td>
                                       <td style='width:28%;'>$session_description</td>
                                       <td>$session_start_date</td>
                                       <td>$session_end_date</td>
                                       <td><span style='color:green;'><b>$session_default</b></span></td>
                                <td style='border-right:1px solid gray;'>";
                                {
                                    ?>
                        <abbr title="Edit Session Details">
                            <a style="color:blue;" href="#" onclick="window.open('edit_session_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=400,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        </abbr>
                        
                        
                        <abbr title="Delete Session">                            
                            <div onclick="delete_data('<?php  echo $session_unique_id;?>','session_delete_command')" class="edit_delete_button">Delete</div>
                       </abbr>
                        
                      <?php 
                        }       
                                echo"</td>
                                 </tr>";     
                                 
                                 
                                 
                        }
                        $fetch_record_num_rows=mysql_num_rows($session_db);
                        if(empty($fetch_record_num_rows))
                        {
                        ?>
                        
                        <tr class="empty_db_alert">
                            <td colspan="7">Sorry, Record No Found !!</td>
                        </tr>
                     <?php 
                        }
                       ?> 
                    </table>
                    
                   </div>
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
               </div>      
              
               
               
            </div> 
        </div>
        </form>
        
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