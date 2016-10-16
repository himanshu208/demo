<!DOCTYPE html>
<html>
<body >


<script type="text/javascript">
var int=self.setInterval(function(){clock()},100);
function clock()
{
var d=new Date();
var t=d.toLocaleTimeString();
document.getElementById("clock").innerHTML=t;
}
</script>
<style>
    #clock{ width:auto; height:15px; float:right; background-color:white; color:black; 
       text-align:center; font-weight:bold; font-size:13px;color:black; 
       padding-top:5px; margin-top:13px; margin-right:25px;  }
    #date{  width:auto; height:15px; float:right; background-color:white; color:black; border-radius:11px; 
       text-align:center;  font-size:10px;color:black; 
       padding-top:5px; margin-top:0px; margin-right:35px;   }
     #todaydate{  width:auto; height:15px; float:right; background-color:white; color:black; border-radius:11px; 
       text-align:center;  font-size:12px;color:red; 
       padding-top:5px; margin-top:0px; margin-right:55px;   }
</style>
<abbr title="Current Time">
<div id="clock" ><strong></strong></div></abbr>
<abbr title="Today Date">
<div id="date">
 <?php 
 date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$date=date("H:i:s A");
$date1=date("d-M-Y");
echo "$date1";
?>
</div>
</abbr>
<abbr title="Today Day">
<div id="todaydate">
 <?php 
 date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$date=date("H:i:s A");
$date1=  strtoupper(date("D"));
echo "<strong>$date1</strong>";
?>
</div>
</abbr>
</body>
</html>

