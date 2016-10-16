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
        <title>Calendar</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        
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
                  <div id='calendar'></div>
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
        
<link href='full_calander/fullcalendar.css' rel='stylesheet' />
<link href='full_calander/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='full_calander/lib/moment.min.js'></script>
<script src='full_calander/lib/jquery.min.js'></script>
<script src='full_calander/fullcalendar.min.js'></script>

<?php
{
?>
<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
                        
                        defaultDate: '2015-12-12',
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				var title = prompt('Event Title:');
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end
					};
             
				$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}
				$('#calendar').fullCalendar('unselect');
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				
                <?php
                 $calander_db=mysql_query("SELECT * FROM calander_db WHERE organization_id='$fetch_school_id' and "
                               . "branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and is_delete='none'");
                       while ($fetch_db_data=mysql_fetch_array($calander_db))
                       {
                      
                         $fetch_calander_unique_id=$fetch_db_data['calander_unique_id'];
                        $fetch_calander_encrypt_id=$fetch_db_data['encrypt_id'];
                        
                        $start_date=$fetch_db_data['start_date'];
                        $end_date=$fetch_db_data['end_date'];
                                $title=  ucfirst($fetch_db_data['title']);
                                $description=$fetch_db_data['description'];
                                $is_holiday=$fetch_db_data['is_holiday'];
                         echo " {
					title: '$title',
					start: '$start_date',
                                        url: 'http://google.com/',
                                        end: '$end_date'
				},";        
                                
                        
                       }
                
   
               ?>
			]
		});
		
	});

</script>
  <?php
}
  ?>      
    <style>

	body {
		
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width:100%;
		float:left;  margin-top:20px;  margin-bottom:50px; 
	}

</style>    
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