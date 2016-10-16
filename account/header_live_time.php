<!DOCTYPE html>
<html>
<body>
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
    #top_div_tag_this_its{ width:auto; height:auto; padding-bottom:4px; padding-top:2px;
                           float:left;   border:1px solid whitesmoke; }
    #clock{ width:auto; height:auto;   float:left; 
        text-align:center; font-weight:100;   float: left;
  background-repeat:no-repeat;  font-weight:bold; color:black;   }
    #date_this{ width:auto; height:auto; font-weight:100; 
                float: right;margin-top: 3px; margin-right: 5px;}
    #verticle_lines{ width: 1px; height:13px;  margin-left:10px; background-color:whitesmoke; float: left; }
</style>
<div id="top_div_tag_this_its">
    

<abbr title="Current Time">
    
<?php 
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$today_day=date("N");
$date33=date("d-M-Y");
$dayNames = Array("","MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY", "SUNDAY",);
echo "
    <div id='date_this'>
        <table cellspacing=0 cellpadding=0>
            <tr>
<td><div id='clock'></div></abbr><div id='verticle_lines'></div></td>
                <td><b>$dayNames[$today_day] , $date33</b></td>
            </tr>
        </table>
    </div>";?>
</div>
</body>
</html>

