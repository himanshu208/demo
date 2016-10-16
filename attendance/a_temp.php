
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        
    </head>
    <body>
       <?php
$start= new DateTime('2010-12-02');
$start->modify('first day of this month');
$end= new DateTime('2012-05-06');
$end->modify('first day of next month');
$interval=DateInterval::createFromDateString('1 month');
$period=new DatePeriod($start, $interval, $end);

foreach ($period as $dt) {
   $dt= $dt->format("Y-m");
    $calander_date=$dt."-01";
  /* Set the default timezone */
date_default_timezone_set("America/Montreal");

/* Set the date */
$date=strtotime(date($calander_date));

$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);
$firstDay = mktime(0,0,0,$month, 1, $year);
$title = strftime('%B', $firstDay);
$dayOfWeek = date('D', $firstDay);
$daysInMonth = cal_days_in_month(0, $month, $year);
/* Get the name of the week days */
$timestamp = strtotime('next Sunday');
$weekDays = array();
for ($i = 0; $i < 7; $i++) {
	$weekDays[] = strftime('%a', $timestamp);
	$timestamp = strtotime('+1 day', $timestamp);
}
$blank = date('w', strtotime("{$year}-{$month}-01"));  

       
       

?>
<table cellspacing="0" class='calander_table' style="table-layout: fixed; float:left; ">
	<tr>
		<th colspan="7" class="text-center"> <?php echo $title ?> <?php echo $year ?> </th>
	</tr>
	<tr>
		<?php foreach($weekDays as $key => $weekDay) : ?>
            <td class="text-center"><b><?php echo $weekDay ?></b></td>
		<?php endforeach ?>
	</tr>
	<tr>
		<?php for($i = 0; $i < $blank; $i++): ?>
			<td></td>
		<?php endfor; ?>
		<?php for($i = 1; $i <= $daysInMonth; $i++): ?>
			<?php if($day == $i): ?>
                        <td valign="top" class="squire_td"><div class="date_print_name"><strong><?php echo $i ?></strong></div>
                            <div class="attendance_status">P</div>
                        </td>
			<?php else: ?>
                        <td valign="top" class="squire_td"><div  class="date_print_name"><?php echo $i ?></div></td>
			<?php endif; ?>
			<?php if(($i + $blank) % 7 == 0): ?>
				</tr><tr>
			<?php endif; ?>
		<?php endfor; ?>
		<?php for($i = 0; ($i + $blank + $daysInMonth) % 7 != 0; $i++): ?>
			<td></td>
		<?php endfor; ?>
	</tr>
</table>
        
        <?php
}
        ?>
    </body>
</html>
