<?php
//SESSION CONFIGURATION
require_once 'config/config.php';
if($connection_permission==1)
{
?>
<!DOCTYPE HTML>
<html>
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/lines.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!----webfonts--->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<!---//webfonts--->  
<!-- Nav CSS -->
<link href="css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<!-- Graph JavaScript -->
<script src="js/d3.v3.js"></script>
<script src="js/rickshaw.js"></script>
</head>
<body>
<div id="wrapper">
    <?php
    include_once 'header.php';
    include_once 'left_nav.php';
    ?>    
            
            
            <!-- /.navbar-static-side -->
       
        <div id="page-wrapper">
        <div class="graphs">
          
            
            <?php

$prsent_attendance=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details"
        . " student_id='$user_unique_id' and attendance='p' and is_delete='none'");
$total_prsent_student=mysql_num_rows($prsent_attendance);

$absent_attendance=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details"
        . " student_id='$user_unique_id' and attendance='a' and is_delete='none'");
$total_absent_student=mysql_num_rows($absent_attendance);

$leave_attendance=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details"
        . " student_id='$user_unique_id' and attendance='l' and is_delete='none'");
$total_leave_student=mysql_num_rows($leave_attendance);

$late_attendance=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details"
        . " student_id='$user_unique_id' and attendance='lt' and is_delete='none'");
$total_late_student=mysql_num_rows($late_attendance);


$attendance_total_db=mysql_query("SELECT * FROM attendance_total_day_db WHERE class_id='$class_id' and section_id='$section_id' and is_delete='none'");
$attendance_total_num_rows=mysql_num_rows($attendance_total_db);
$attendance_total_data= mysql_fetch_array($attendance_total_db);
$total_working_days=$attendance_total_num_rows;

$student_prsent_att=0;
$student_absent_att=0;
$student_leave_att=0;
$student_late_att=0;
$mark_attenandance_type=mysql_query("SELECT * FROM attendance_mark_db WHERE $db_main_details class_id='$class_id' "
        . "and section_id='$section_id' and student_id='$student_id' "
        . "and is_delete='none' and action='action'");
while ($fetch_attendance_data=mysql_fetch_array($mark_attenandance_type))
{
$attendance=$fetch_attendance_data['attendance'];
if($attendance=="p")
{
 $student_prsent_att++;   
}else
 if($attendance=="a")
{
 $student_absent_att++;   
}else
 if($attendance=="l")
{
 $student_leave_att++;   
}else
    if($attendance=="lt")
{
 $student_late_att++;   
}
}
     
$leave_attendance_count=$student_leave_att;
$leave_attendance_calculate=($student_leave_att/2);


$total_prsent_attendance=($student_prsent_att+$leave_attendance_calculate+$student_late_att);
if($total_working_days!=0)
{
$attendance_aggrigate=(($total_prsent_attendance*100)/$total_working_days);
}else
{
 $attendance_aggrigate=0;   
}
$temp_width=$attendance_aggrigate;

if($attendance_aggrigate!=0)
{
 $attendance_aggrigate=number_format($attendance_aggrigate,2);   
}
            ?>
            
            <?php
            $prsent_width=(($student_prsent_att*100)/$total_working_days);
           $absent_width=(($student_absent_att*100)/$total_working_days);
           $leave_width=(($student_leave_att*100)/$total_working_days);
           $late_width=(($student_late_att*100)/$total_working_days);
           
            ?>
            
            
            <div class="title_heading">Attendance</div>
             <div class="widget_1">
		 	 <div class="col-sm-3 widget_1_box">
                <div class="tile-progress bg-info">
                    <div class="content">
                        <h4><i class="fa  icon-sm"></i> <b>Total Attendance</b></h4>
                        <div class="progress"><div class="progress-bar inviewport animated visible slideInLeft" style="width: 100%;"></div></div>
                        <span><b><h4><b><?php echo $attendance_total_num_rows;?></b></h4></b></span>
                    </div>
                </div>
             </div>
                 
                 
                 <div class="col-sm-3 widget_1_box">
               <div class="tile-progress bg-danger">
                    <div class="content">
                        <h4><i class="fa icon-sm"></i><b>Total Present</b></h4>
                        <div class="progress"><div class="progress-bar inviewport animated visible slideInLeft" style="width:<?php echo $prsent_width;?>%;"></div></div>
                        <span><b><h4><b><?php echo $total_prsent_student;?></b></h4></b></span>
                    </div>
                </div>
             </div>
              
                 
                  <div class="col-sm-3 widget_1_box">
             	<div class="tile-progress bg-secondary">
                    <div class="content">
                        <h4><i class="fa icon-sm"></i><b>Total Absent</b></h4>
                        <div class="progress"><div class="progress-bar inviewport animated visible slideInLeft" style="width:<?php echo $absent_width;?>%;"></div></div>
                        <span><b><h4><b><?php echo $total_absent_student;?></b></h4></b></span>
                    </div>
                </div>
			  </div>
                 
                 
                 <div class="col-sm-3 widget_1_box">
                <div class="tile-progress bg-success">
                    <div class="content">
                        <h4><i class="fa icon-sm"></i><b>Total Leave</b></h4>
                        <div class="progress"><div class="progress-bar inviewport animated visible slideInLeft" style="width:<?php echo $leave_width;?>%;"></div></div>
                        <span><h4><b><?php echo $total_leave_student;?></b></h4></span>
                    </div>
                </div>
             </div>
                 
                 
                 <div class="col-sm-3 widget_1_box">
                <div class="tile-progress bg-success">
                    <div class="content">
                        <h4><i class="fa icon-sm"></i><b>Total Late</b></h4>
                        <div class="progress"><div class="progress-bar inviewport animated visible slideInLeft" style="width:<?php echo $late_width;?>%;"></div></div>
                        <span><h4><b><?php echo $total_late_student;?></b></h4></span>
                    </div>
                </div>
             </div>
                 
                 
                 <div class="col-sm-3 widget_1_box">
               <div class="tile-progress bg-info">
                    <div class="content">
                        <h4><i class="fa icon-sm"></i><b>Aggregate Attendance</b></h4>
                        <div class="progress"><div class="progress-bar inviewport animated visible slideInLeft" style="width:<?php echo $temp_width;?>%;"></div></div>
                        <span><b><h4><b><?php echo $attendance_aggrigate;?>%</b></h4></b></span>
                    </div>
                </div>
             </div>
                 
                 
             </div>
     	 <div class="clearfix"> </div>
	<?php
    include_once 'footer.php';
                ?>
		</div>
       </div>
   
   </div>
   
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>