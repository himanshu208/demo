
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
   
      
   $message_show="";
   if(isset($_POST['data_submit']))
   {
       
 date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

$result=mysql_query("SHOW TABLE STATUS LIKE 'calander_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_cln_id="CLNDER_$nextId"; 
$encrypt_id=md5(md5($final_cln_id));
       
     $session_id=$_POST['use_inset_session_id']; 
    $start_date=$_POST['start_data'];
    $end_date=$_POST['end_date'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            if(!empty($_POST['is_holiday']))
            {
            $is_holiday=$_POST['is_holiday'];
            }  else {
                $is_holiday="";
            }
            if((!empty($session_id))&&(!empty($final_cln_id))&&(!empty($start_date))&&(!empty($end_date))&&(!empty($title)))
            {
            $select_db=mysql_query("SELECT * FROM calander_db WHERE organization_id='$fetch_school_id' "
                    . "and branch_id='$fetch_branch_id' and session_id='$session_id' and"
                    . " start_date='$start_date' and end_date='$end_date' and title='$title' and is_delete='none'");
            $fecth_db_data=  mysql_fetch_array($select_db);
            $fecth_db_num_rows=  mysql_num_rows($select_db);
            
            if((empty($fecth_db_data))&&($fecth_db_data==null)&&($fecth_db_num_rows==0))
            {
              
             $insert_db=  mysql_query("INSERT into calander_db values('','$fetch_school_id','$fetch_branch_id'"
                     . ",'$session_id','$final_cln_id','$encrypt_id','$start_date','$end_date','$title','$description','$is_holiday'"
                     . ",'none','$date','$date_time','$fecth_user_unique')");
             if($insert_db)
             {
             $message_show="<span style='color:green;'>Record save successfully complete</span>";   
             
             }  else {
                $message_show="<span style='color:red;'>Sorry,Request failed, Please try again.</span>";   
          
             }
                
                
                
            }  else {
               $message_show="<span style='color:red;'>Record already exist in database.</span>";   
            }
                
                
            }else
            {
               $message_show="<span style='color:red;'>Please fill all fields.</span>";
  }
  
  require_once '../pop_up.php';
        }
      
      
      
      
 {
  ?>
<?php 
$log_out_page="../account_logout.php";
require '../page_url_link.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Calendar</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
         function validateForm()
         {
           var start_date=document.getElementById("start_date").value;
           var end_date=document.getElementById("end_date").value;
           var title=document.getElementById("title_name").value;
           
           if(start_date==0)
           {
              alert("Please enter start date");
              document.getElementById("start_date").focus();
              return false;
           }else
               if(end_date==0)
           {
              alert("Please enter end date");
              document.getElementById("end_date").focus();
              return false;
           }else
               if(title==0)
           {
              alert("Please enter title");
              document.getElementById("title_name").focus();
              return false;
           }
         }
        </script>
    </head>
    <body>
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
                           <td>Add Calendar</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Add Calendar</b></div>
              <a href="calender.php"> <div class="view_button">Calendar</div> </a> 
              <a href="calender_report.php"> <div class="view_button"  style=" margin-right:10px; background-color:darksalmon;  ">View Calendar Report</div> </a> 
                   </div>
                
               <div class="main_work_data" style=" padding-top:20px;">
               <div id="calander_show">
               
                   <table cellspacing="3" cellpadding="7" class="insert_table">
                       <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                      </tr>
                      <tr>
                          <td><b>Start Date <sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input type="text" name="start_data"  id="start_date" class="text_box_styles" autocomplete="off"> </td>
                      </tr>
                      <tr>
                          <td><b>End Date <sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input type="text" name="end_date" id="end_date"  class="text_box_styles" autocomplete="off"> </td>
                      </tr>
                      <tr>
                          <td><b>Title<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input type="text" name="title" id="title_name"  class="text_box_styles" style=" width:100%; " autocomplete="off"> </td>
                      </tr>
                      <tr>
                          <td><b>Description </b></td><td><b>:</b></td>
                          <td>
                              <textarea name="description" id="editor_tool" class="text_area_styles"></textarea>   
                          </td>
                      </tr>
                      <tr>
                          <td><b>Is Holiday</b></td> <td><b>:</b></td>
                          <td><input name="is_holiday" type="checkbox"></td>
                      </tr>
                      <tr>
                          <td colspan="3">
                              <input type="submit" name="data_submit" class="button_styling" style=" margin-right:0px; " value="Save">   
                          </td> 
                      </tr>
                      
                   </table>
                   
                   
               </div>      
               </div> 
               </div>
               </form>
        
        <div id="include_fotter_page">
       <?php 
         require_once '../fotter/fotter_page.php';
         
         ?>   
        </div>
        
<link type="text/css" rel="stylesheet" href="editor_tool/demo.css">
<link type="text/css" rel="stylesheet" href="editor_tool/jquery-te-1.4.0.css">
<script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="editor_tool/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script>
	$('#editor_tool').jqte();
	
	
</script>      
     
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