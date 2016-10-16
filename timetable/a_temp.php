<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       <?php   
       $message_show="";
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
       
$arrival_time="7:00am";
$departure_time="7:00am";

$d1=strtotime($arrival_time);
$d2=strtotime($departure_time);

echo $d1."bbb".$d2;

$diff=$d2-$d1;
 $diff/60/60;
//Print the difference in hours : minutes
$am = "7:30 AM";
$pm = "7:37 AM";
$minutes_diff=round(abs(strtotime($pm) - strtotime($am)) / 60);


?>
    </body>
</html>
