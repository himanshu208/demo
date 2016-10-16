
<?php 
session_start(); 
ob_start();
?>
<?php 
require_once '../connection.php';
if(isset($_SESSION['admin_session_on']))
{
$user_unique_id=$_SESSION['admin_session_on'];
$user_db=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id='$user_unique_id'");
$fetch_user_data=mysql_fetch_array($user_db);
$fetch_user_num_rows=mysql_num_rows($user_db);
if((!empty($fetch_user_data))&&($fetch_user_data!=null)&&($fetch_user_num_rows!=0))
{
  
  $fetch_school_id=$fetch_user_data['organization_id'];
  $fetch_branch_id=$fetch_user_data['branch_id'];
  $fetch_accout_type=$fetch_user_data['account_type'];
  $fecth_user_unique=$fetch_user_data['user_admin_id'];
$organisation_db=mysql_query("SELECT * FROM organization_db WHERE organization_id='$fetch_school_id'"); 
 $fetch_org_data=mysql_fetch_array($organisation_db);
 $fetch_org_num_rows=mysql_num_rows($organisation_db);
if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_rows!=0))
{
$fetch_school_logo="../".$fetch_org_data['school_logo'];

$branch_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");  
$fetch_branch_data=mysql_fetch_array($branch_db);
$fetch_branch_num_rows=mysql_num_rows($branch_db);
 if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
 {
$fetch_branch_unique_db_id=$fetch_branch_data['branch_id'];
$fetch_school_name=$fetch_branch_data['branch_name'];
 

if($fetch_accout_type=="branch_head_admin")
{
 $manage_module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and admin_type='branch_head_admin'");   

}else
{
$manage_module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and admin_id='$user_unique_id'");   
}
$fetch_module_data=mysql_fetch_array($manage_module_db);
$fetch_module_num_rows=mysql_num_rows($manage_module_db);
 if((!empty($fetch_module_data))&&($fetch_module_data!=null)&&($fetch_module_num_rows!=0))
 {
  $fetch_module_list=$fetch_module_data['module'];
  $explode_module_array=explode(",",$fetch_module_list);
  $check_array_in="calender";
  $search_match_module= in_array($check_array_in,$explode_module_array);
  if($search_match_module==true)
  {
      
 {
  ?>
<?php 
$log_out_page="../account_logout.php";
require '../page_url_link.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Calendar Report</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        <script type="text/javascript">
       function filter_button()
       {
       var start_date=document.getElementById("start_date").value;
       var end_date=document.getElementById("end_date").value;
       var title=document.getElementById("title").value;
       var is_holiday=document.getElementById("is_holiday").checked;
       if(is_holiday==true)
       {
         is_holiday="on";  
       }else
       {
        is_holiday="";   
       }
       
       if((start_date==0)&&(end_date==0)&&(title==0)&&(is_holiday==0))
       {
         alert("Please choose atleast one option");
         return false;
       }else
           if((start_date!=0)&&(end_date==0))
       {
           alert("Please enter end date");
           document.getElementById("end_date").focus();
           return fasle;
       }else
            if((start_date==0)&&(end_date!=0))
        {
          alert("Please enter start date");
           document.getElementById("start_date").focus();
           return fasle;    
        }else
       {
        window.location.assign("calender_report.php?start_date="+start_date+"&end_date="+end_date+"&title="+title+"&is_holiday="+is_holiday);   
       
       }
           
       
       }
        </script>
        
    </head>
    <body>
       <?php  include_once '../ajax_loader_page_second.php';?>
         
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" method="post" onsubmit="return validateForm();" enctype="multipart/form-data">
       
            
            
            
            
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td>Calendar Report</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Calendar Report</b></div>
              <a href="add_calender.php"> <div class="view_button">Add Calendar</div> </a> 
              
              <a href="calender.php"> <div class="view_button" style=" margin-right:30px; background-color:darkorchid;  ">Calendar</div> </a> 
             
                   </div>
                
               <div class="main_work_data" style=" padding-top:20px;">
               <div id="calander_show">
                 
                   <div class="filter_div_tag">
                       <center>
                           <table style=" width:80%;  font-size:12px; margin-top:15px;  ">
                           <tr>
                               <td><b>Start Date</b></td><td><b>:</b></td>
                               <td><input value="<?php if(!empty($_REQUEST['start_date'])) { echo $_REQUEST['start_date'];}?>" id="start_date" placeholder="Enter start date" class="text_box_org_ing" type="text"></td>
                               <td style=" width:20px; "></td>
                               <td><b>End Date</b></td><td><b>:</b></td>
                               <td><input value="<?php if(!empty($_REQUEST['end_date'])) { echo $_REQUEST['end_date'];}?>" id="end_date" placeholder="Enter end date" class="text_box_org_ing" type="text"></td>
                               <td style=" width:20px; "></td>
                               <td><b>Title</b></td><td><b>:</b></td>
                                <?php
                           
                           if(!empty($_REQUEST['is_holiday']))
                           {
                            $is_holiday=$_REQUEST['is_holiday'];  
                            if($is_holiday=="on")
                            {
                             $checked="checked";   
                            }else
                            {
                             $checked="";   
                            }
                           }  else {
                              $is_holiday=""; 
                                $checked="";
                           }
                           ?>
                               <td><input value="<?php if(!empty($_REQUEST['title'])) { echo $_REQUEST['title'];}?>" id="title" placeholder="Enter title" class="text_box_org_ing" type="text"></td>
                               <td>is Holiday</td><td style=" width:10px; "><input id="is_holiday" value="on" type="checkbox" <?php echo $checked;?>></td>
                           </tr>
                           
                          
                           
                           <tr>
                               <td colspan="13">
                                   <input type="button" onclick="filter_button()" class="filter_button" value="Filter">   
                                   
                               </td>
                           </tr>
                       </table>  
                       </center>
                   </div>
                   
                   
                   
                   <table cellspacing="0" cellpadding="0" class="table_details">
                       <tr class="th_heading_style">
                           <td>Sl. No.</td>
                           <td>Start Date<br/><span style=" font-size:10px; ">(YY-MM-DD)</span></td>
                           <td>End Date<br/><span style=" font-size:10px; ">(YY-MM-DD)</span></td>
                           <td>Title</td>
                           <td style=" width:32%; ">Description</td>
                           <td>Is Holiday</td>
                           <td style=" border-right:1px solid black;   ">Action</td>
                       </tr>
                       
                       <?php
                       
                      if((!empty($_REQUEST['start_date']))&&(!empty($_REQUEST['end_date']))||(!empty($_REQUEST['title']))
                              ||(!empty($_REQUEST['is_holiday'])))
                      {
                        
                        $start_date=$_REQUEST['start_date'];
                                $end_date=$_REQUEST['end_date'];
                                $title=$_REQUEST['title'];
                                $is_holiday=$_REQUEST['is_holiday'];
                                
                      
                       if(($start_date)&&($end_date))
                       {
                         $date_search="and start_date BETWEEN '$start_date' AND '$end_date' and end_date BETWEEN '$start_date' AND '$end_date'";  
                       }  else {
                           $date_search="";
                       }
                       
                       if(!empty($title))
                       {
                        $title_search="and title LIKE '%$title%'";   
                       }  else {
                           $title_search="";
                       }
                       
                       if(!empty($is_holiday))
                       {
                        $holiday_search="and is_holiday='$is_holiday'";   
                       }  else {
                           $holiday_search="";
                       }
                       
                     $search_op=$date_search." ".$title_search." ".$holiday_search;  
                       
                          
                      }  else {
                      $search_op="";    
                      }
                       
                       $row=0;
                       $calander_db=mysql_query("SELECT * FROM calander_db WHERE organization_id='$fetch_school_id' and "
                               . "branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' $search_op and is_delete='none'");
                       while ($fetch_db_data=mysql_fetch_array($calander_db))
                       {
                         $row++;  
                        $fetch_calander_unique_id=$fetch_db_data['calander_unique_id'];
                        $fetch_calander_encrypt_id=$fetch_db_data['encrypt_id'];
                        
                        $start_date=$fetch_db_data['start_date'];
                        $end_date=$fetch_db_data['end_date'];
                                $title=$fetch_db_data['title'];
                                $description=$fetch_db_data['description'];
                                $is_holiday=$fetch_db_data['is_holiday'];
                       if($is_holiday=="on")
                       {
                       $is_holiday="<span style='padding:6px; color:white; border-radius:5px; background-color:red;'>Holiday</span>";    
                       }
                                echo "<tr id='delete_row_$fetch_calander_unique_id' class='td_styling_data'><td><b>$row</b></td>"
                                        . "<td>$start_date</td>"
                                        . "<td>$end_date</td>"
                                        . "<td><b>$title</b></td>"
                                        . "<td>$description</td>"
                                        . "<td>$is_holiday</td>"
                                        . "<td style='width:130px; border-right:1px solid black;'>";
                                       {
                                    ?>
                        <abbr title="Edit Calendar Details">
                            <a style="color:blue;" href="#" onclick="window.open('edit_calendar.php?token_id=<?php  echo $fetch_calander_encrypt_id;?>','size',config='height=550,width=620,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        </abbr>
                        
                        
                        <abbr title="Delete Calendar">                            
                            <div onclick="delete_data('<?php  echo $fetch_calander_unique_id;?>','calender_delete_command')" class="edit_delete_button">Delete</div>
                       </abbr>
                        
                      <?php 
                        }     
                                
                                        echo "</td>"
                                        . "</tr>";   
                                
                                
                           
                       }
                       
                       if(empty($fetch_calander_unique_id))
                       {
                           echo "<tr><td colspan='9' style='border:1px solid black; border-top:0px; height:35px; font-weight:bold; color:red; text-align:center;'>Record no found !!</td></tr>";   
                       }
                       
                       
                       
                       ?>
                       
                       
                       
                       
                   </table>
                   
                   
                   
                  </div>
                  </div>      
              
               
               
            </div> 
        </div>
        </form>
        
        <script type="text/javascript" src="../javascript/next_javascript.js"></script>
         <script type="text/javascript" src="../javascript/admission_javascript.js"></script>
         <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
         
         <script type="text/javascript">
      
$(function() {
$("#start_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      yearRange:'1950:2013',
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    $("#end_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      yearRange:'1950:2013',
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
   
});
    </script>
        
        
        <div id="include_fotter_page">
       <?php 
         require_once '../fotter/fotter_page.php';
         
         ?>   
        </div
</body>
</html>
<?php 
  }
  }else
  {
   header("Location:../404_error.php");   
  }
 }else
 {
 header("Location:../loginPage.php");   
 }
  
  
 }else
 {
 header("Location:../loginPage.php");   
 }
 
 
 }else
{
     header("Location:../loginPage.php");
}


}else
{
    header("Location:../loginPage.php");
}

}else
{
     header("Location:../loginPage.php");
}
?>