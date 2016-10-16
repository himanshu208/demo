
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finance</title>
        <script type="text/javascript" src="jquery/jquery-1.js">
        </script>
        <script type="text/javascript" src="jquery/finance_student_iframe_jqurycode.js">
             function myfunction()
{

document.getElementById("demo").innerHTML=x;
} 
        </script>
        <script type="text/javascript">
         $(document).ready(function(){
              $("#showdepositfine").hover(function(){
        $(".showdepositfeefinedetails").show("fast"); 
       });
        $("#showdepositfine").mouseout(function(){
        $(".showdepositfeefinedetails").hide("fast");   
       });
       
                $("#inputdate").click(function(){
                  var chequeddcalender="chequeddcalender";
                   $.get("financechequecalender.php",{chequeddcalender:chequeddcalender},function(data)
                    {
                      $("#outputcalender").show();
                      $("#outputcalender").html(data);
                    }); 
                });  
                
          $("#payamount").click(function(){
             var amountpaid=$("#amountpaidvalue").val();
             var feepayable=$("#totalamountpayble").val();
             var fineamount=$("#totalfineamount").val();
             var amountdiscount=$("#totalamountdiscount").val();
             var finediscount=$("#customfine").val();                 
                               
                               
               var finalpadamount=$('#finalpaybleoutputthis').text();
                var finalpayableamount=$("#thisisthefinaloutput").val();
                var dueamount=$("#dueamount").val();
                               
             if(amountpaid=="")
                 {
                     alert("Please Fill The Amount");
                     return false;
                 }else
                     {
                   
var r=confirm("Are You Sure Process Continue....");
if (r==true)
  {
var P=confirm("\
Fee Amount                    "+feepayable+"\n\
Fine Amount                   "+fineamount+"\n\
------------------------------------------\n\
Total Amount                  "+finalpadamount+"\n\
------------------------------------------\n\
Fine Discount                  - "+finediscount+"\n\
Discount Amount            - "+amountdiscount+"\n\
-------------------------------------------\n\
Total Payable Amount =   "+finalpayableamount+"\n\
-------------------------------------------\n\
Amount Paid = "+amountpaid+"   Due Amount = "+dueamount+"\n\
-------------------------------------------\n\
");
if (P==true)
  {
           
  }
else
  {
  return false;
  }        
  }
else
  {
  return false;
  }
                     }
            })  ; 
                
            })
    </script>
    <script>
       
        </script>
        <style>
         .text_box_size_same{ width:150px; height:18px; border:1px solid silver; padding-left:5px;    } 
         .select_box{ width:155px; border:1px solid silver; height:24px; padding-top:2px; padding-bottom:2px; padding-right:2px;    }
        .addpayamount_reset_button{width:auto; padding-left:20px; padding-right:20px; float:right;    height:23px; margin-right:12px; margin-top:5px; margin-bottom:5px;   font-size:12px; float:right;   
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-image:url('finanacephoto/bgblack.png');}
        .addcenclefine{width:auto; padding-left:20px; padding-right:20px; float:right;    height:23px; margin-right:22px; margin-top:5px; margin-bottom:5px;   font-size:12px; float:right;   
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-image:url('finanacephoto/bgblack.png');}
        .td_table_head{ width:auto; text-align:center; font-weight:bold; height:25px; background-color:whitesmoke;     border-bottom:1px solid silver; border-left:1px solid silver; font-size:12px;    }
        .td_print_value{ width:auto; text-align:center; height:22px; background-color:white;     border-bottom:1px solid silver; border-left:1px solid silver; font-size:12px;   }
       p{ float:left; padding-left:2px; color:maroon; height:20px;  margin:0; padding:0;        }
       .showfinedetails{width:500px; height:auto; border:1px solid maroon;  background-color: yellow; position:absolute; 
                        left:105px; right:0px;   display:none;      }
       .showduefinedetails{width:500px; height:auto; border:1px solid maroon;  background-color: yellow; position:absolute; 
                        left:105px; right:0px;   display:none;      }
       .td_fine_show_table{ width:auto; height:17px; background-color:whitesmoke; font-weight:bold; border-bottom:1px solid silver; border-right:1px solid silver;   }
       .fineheader{ background-color:maroon; text-align:left; height:18px;  padding-left:15px; font-weight:bold; color:white;     }
        .td_fetchfine{ border-bottom:1px solid silver; background-color:white;  border-right:1px solid silver;  }
        .td_fine_show_tabletotal{ background-color:maroon; text-align:center; height:18px; 
                                 padding-left:0px; font-weight:bold; color:white;     }
        .showdepositfeefinedetails{ width:500px; height: auto; display:none; 
                                   position:absolute; margin-top:0; margin-left:60px;  border:1px solid maroon; }
       #discountfine{width:400px; height:300px;overflow:hidden;   
     text-align:center;padding:10px 0 10px 0;z-index:102; display:none;margin:10px;     }
#closebuttonthis{ width:33px; height:32px; background-image:url('finanacephoto/cenclebutton.png'); 
                 background-repeat:no-repeat; margin-right:10px;   float:right;  margin-right:6px;    }
#closebuttonthis:hover{ cursor: pointer;}
#codethis{ width:360px; height:220px; float:left; background-color:white; border:5px solid white;     }
#inputdate{ width:30px; height:30px; margin-top:3px; margin-left:3px; cursor:pointer;background-image:url('finanacephoto/calender.png'); background-repeat:no-repeat;   }
#outputcalender{ width:202px; height:228px; display:none; margin-top:-228px;   margin-left:0px;  position:absolute;    }       
#addfine{ width:45px; height:18px; margin:0 auto; cursor:pointer; padding-left:8px; 
           background-position-x:2px;  background-position-y:3px;    
          background-color:skyblue; padding-top:2px; 
          background-image:url('finanacephoto/plus.gif'); background-repeat:no-repeat;  } 
#showalreadypaidfees{ width:400px; height:70px;display: none; 
                      background-color:white; color:#440000; text-align:center; padding-top:40px;
                      position: absolute; left:140px; top:90px; 
                      z-index:102;  border:10px solid steelblue; font-weight:bold;    }
        </style>
    </head>
    <body style=" margin:0; padding:0;overflow:hidden; font-family:arial;    ">
         <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
          <div id="showfineminimize" style="width:100%;height:100%;background-color:#000000;
        opacity:0.6;filter:alpha(opacity=80);position:fixed;top:0;left:0;display:none;z-index:101;"></div>
        <div id="discountfine"><div id="closebuttonthis"></div>
        <div id="codethis">
                <table cellspacing="0" style=" width:340px; font-size:12px;  height:200px;  margin:0 auto; margin-top:10px; border:1px solid silver;    ">
                    <tr>
                        <td colspan="3" style=" text-align:left;  padding-left:15px;  color:white; font-size:12px;   font-weight:bold;  
                                        height:20px; background-image:url('finanacephoto/bgblack.png'); "> 
                        Custom Fine
                        </td>
                    </tr>
                    <tr>
                        <td style=" width:100px; ">Fine</td><td style="width:10px; "><strong>:</strong></td>
                        <td><input type="text"  style=" width:155px; border:1px solid silver;  "
                                name="discountfine"   id="customfine" value="0"></td>
                    </tr>
                    <tr>
                        <td style=" width:100px; ">Description</td><td style="width:10px; "><strong>:</strong></td>
                        <td><textarea style=" width:150px; height:70px; border:1px solid silver;  " 
                                  name="discriptiondiscountfine"  id="customfinedescription"></textarea></td>
                    </tr>
                    <tr><td colspan="3" style=" margin-right:10px; ">
                            <input type="button" id="cenclecustomefine" class="addcenclefine" value="Cencle"> 
                            <input type="button" id="addcustomefine" class="addcenclefine" value="Add">  
                        </td></tr>
                </table>  
            </div>
        </div>
             
             <div id="showalreadypaidfees">
               Auto Paid Fees
             </div>
             
             
             
             
         <div style=" width:690px; height:auto; margin-right:5px;   "> 
          <?php 
            require_once '../connection.php';
            if(!empty($_REQUEST['feesgroupname']))
            {             
date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$todaydate=date("Y/m/d");     
             $feepaymentmethod=$_REQUEST['feespaymethod'];
             $feesgroupname=$_REQUEST['feesgroupname'];
             $whichclass=$_REQUEST['setclass'];
             $sessionyear=$_REQUEST['setsessionyear'];
             $feepaystudentsrno=$_REQUEST['studentsrno'];
             $feepaystudentadmissionno=$_REQUEST['studentadmissionno'];
             $feespaymentstudentcategory=$_REQUEST['studentcategory'];
             
             $studentalreadysavedfee=mysql_query("SELECT * FROM finanacepaystudentfees WHERE studentsrno='$feepaystudentsrno'
                        and studentadmissionno='$feepaystudentadmissionno' and thisclass='$whichclass'
                        and thissessionyear='$sessionyear' and feesgroup='$feesgroupname' and feepaymonth='autopayment'");  
                $alreadysaved=mysql_fetch_array( $studentalreadysavedfee);
              if(!empty($alreadysaved))
                {
                  echo '
        <script type="text/javascript">
         $(document).ready(function(){
   $("#showfineminimize").css("display","block");
   $("#showalreadypaidfees").css("display","block");

});
         </script>
                         ';
              }
             
             
             
             
             
             echo "<table>
                   <tr>
             <td><input type='hidden' name='payfeestudentsrnumber' value='$feepaystudentsrno'>
             <input type='hidden' name='payfeestudentadmissionnumber' value='$feepaystudentadmissionno'>
             <input type='hidden' name='payfeestudentsessionyear' value='$sessionyear'>
             <input type='hidden' name='payfeestudentclass' value='$whichclass'>
             <input type='hidden' name='payfeesgroupname' value='$feesgroupname'>
             <input type='hidden' name='payafeetodaydate' value='$todaydate'>
             </td>                   
</tr>
                   </table>";
             
             
             
           $selectfeeamountdb=mysql_query("SELECT * FROM financefeeamount WHERE feesgroupname='$feesgroupname' and feesetclass='$whichclass'");
           $fetchdata= mysql_fetch_array($selectfeeamountdb);
           {  
              $feesname=$fetchdata['addfeesname'];
              $fetchgrouptype=$fetchdata['feegrouptype'];
              $fetchfeesfinetemp=$fetchdata['feesamount'];
              $fetchfeesfineamount=$fetchdata['fineamount'];
              
                              
                               if(($fetchfeesfinetemp=="active")&&($feesname=="Hostel Fee"))
                               {
                                  //hostelcheckrecorded 
                                $checkthisstudentallocatedhostel=mysql_query("SELECT * FROM studenthosteldata WHERE srno='$feepaystudentsrno' and studentadmissionno='$feepaystudentadmissionno'");
                                $hostelcheck=mysql_fetch_array($checkthisstudentallocatedhostel);
                                if(!empty($hostelcheck))
                                {
                                $fetchfeesamount=$hostelcheck['studentroomrent'];
                                }
                               }else
                                   if(($fetchfeesfinetemp=="active")&&($feesname=="Transport Fee"))
                               {
                                //transportcheckedrecord
                                $checkthisstudentallocatedtransport=mysql_query("SELECT * FROM studenttransportdata WHERE srno='$feepaystudentsrno' and studentadmissionno='$feepaystudentadmissionno'");
                                $transportcheck=mysql_fetch_array($checkthisstudentallocatedtransport);
                                 if(!empty ($transportcheck)) 
                                 {
                                    $fetchfeesamount=$transportcheck['tranportrent'];  
                                 }
                               }else{
                              $fetchfeesamount=$fetchfeesfinetemp;
                               }
              
              
              
              
              //studentdiscountcode//
              
           $studentdiscountbalance=mysql_query("SELECT * FROM financefeediscountcategory WHERE feesname='$feesname' and feecategory='$feespaymentstudentcategory'");
           $fetchthisdiscount=mysql_fetch_array($studentdiscountbalance);
           
           if(!empty($fetchthisdiscount))
           {
           $fetchstudentcategorydiscount=$fetchthisdiscount['feediscount'];  
           
           }else
               {
               $fetchstudentcategorydiscount="0";  
              
               }
             
           $studentparticulardiscount=  mysql_query("SELECT * FROM financefeediscountparticularstudent WHERE studentsrno='$feepaystudentsrno' and studentadmissionno='$feepaystudentadmissionno'");
           $studentparticularfetch=  mysql_fetch_array($studentparticulardiscount);
           if(!empty($studentparticularfetch))
           {
             $fetchstudentparticulardiscount=$studentparticularfetch['feediscount']; 
           }else
           {
             $fetchstudentparticulardiscount="0"; 
           }
            //studenthandicapeddiscount//
           $studenthandicappeddiscount=  mysql_query("SELECT * FROM financefeediscountstudenthandicapped WHERE id");
           $studenthandicappeddiscountfetch= mysql_fetch_array($studenthandicappeddiscount);
           if(!empty($studenthandicappeddiscountfetch))
           {
            $studenthandicappeddiscount_percantage=$studenthandicappeddiscountfetch['feediscount'];   
           }else
           {
            $studenthandicappeddiscount_percantage="0";   
           }
               
           //finalstudentdiscountamount
           $fetchstudentdiscount= $studenthandicappeddiscount_percantage+$fetchstudentparticulardiscount+$fetchstudentcategorydiscount;
           $feediscountinamount=(($fetchfeesamount*$fetchstudentdiscount)/100);
           
           
           
           
           
           
               //startfeemonthlyprocess
            if($fetchgrouptype=="monthly")
            { 
                
                
              if(!empty($_POST['payamount'])){  
              $addtrnumber=mysql_query("SELECT * FROM finanacepaystudentfees WHERE id order by id DESC");
              $fetchnumber=mysql_fetch_array($addtrnumber);
               if(!empty($fetchnumber))
               {
               $numberaddedITS=$fetchnumber['trnumber']; 
               $addedone="1";
               $numberadded=$numberaddedITS+$addedone;
               }else
               {
             $numberadded="1";}
             $loopnumber=$_POST['loopcounted'];
             for($monthloop=1;$monthloop<=$loopnumber;$monthloop++)
               {
              $payfeestudentsrno=$_POST['payfeestudentsrnumber'];
              $payfeestudentadmissionnumber=$_POST['payfeestudentadmissionnumber'];
              $payfeestudentclass=$_POST['payfeestudentclass'];
              $particulerfees=$_POST["particularfees$monthloop"];
              $particularfine=$_POST["particularfine$monthloop"];
              $payfeestudentsessionyear=$_POST['payfeestudentsessionyear'];
              $payfeesgroupnamethis=$_POST['payfeesgroupname'];
              $payfeefeepayblevalue=$_POST['feepayablevalue'];
              $payfeefinepayablevalue=$_POST['finepayablevalue'];
              $payfeetodaydate=$_POST['payafeetodaydate'];
              $payfeesdiscount=$_POST['discount'];
              $payfeesdiscountamount=$_POST['discountamount'];
              $payfeespaymentinfo=$_POST['paymentinfo'];
              $payfeespaymentdescription=$_POST['feedescription'];
              $payfeesamountpayable=$_POST['totalamountpayable'];
              $payfeespaymentmode=$_POST['paymentmode'];
               if($payfeespaymentmode=="cash")
              {
                $payfeesbankname="----------"; 
                $payfeeschequeddno="----------"; 
              $payfeeschequedddate="----------"; 
              $payfeeschequeddamount="0.0"; 
              $status="CLEARED";
              }  else {
                  $payfeesbankname=$_POST['bankname'];
                  $payfeeschequeddno=$_POST['chequeddnumber'];
              $payfeeschequedddate=$_POST['chequedddate'];
              $payfeeschequeddamount=$_POST['chequeddamount'];
               $status="PENDING";
              }
              
              $payfeesamountpaiod=$_POST['amountpaid'];
              $payfeesdueamount=$_POST['dueamount'];
              $paydiscountfine=$_POST['discountfine'];
              $paydescriptiondiscountfine=  nl2br($_POST['discriptiondiscountfine']);
              
              if(!empty($_POST["checkme$monthloop"]))
              {
              $paythismonthchecked=$_POST["checkme$monthloop"];
              $serviceenable="No";
              }else {
                    $paythismonthchecked="";
                     $serviceenable="Yes";
                    }
               if(!empty($paythismonthchecked))
               {
              if(($payfeestudentsrno!="")&&($payfeestudentadmissionnumber!="")&&($payfeestudentclass!="")&&($payfeestudentsessionyear!="")&&($payfeesamountpaiod!=""))
              {
                  require_once '../connection.php';
                $selectmatchthisfeealreadypay=mysql_query("SELECT * FROM finanacepaystudentfees WHERE studentsrno='$payfeestudentsrno'
                        and studentadmissionno='$payfeestudentadmissionnumber' and thisclass='$payfeestudentclass'
                        and thissessionyear='$payfeestudentsessionyear' and feesgroup='$payfeesgroupnamethis' and feepaymonth='$paythismonthchecked'");  
                $fetchpaymentdetail=mysql_fetch_array($selectmatchthisfeealreadypay);
              if(empty($fetchpaymentdetail))
                {
                
               if(!empty($_POST['dueamountselected']))
               {
                 $deletedfine=mysql_query("DELETE FROM financestudentduefine WHERE studentsrno='$payfeestudentsrno'
                         and studentadmissionno='$payfeestudentadmissionnumber'"); 
                 if($deletedfine)
                 {}}    
               $insertedpaymentdetails=mysql_query("INSERT into finanacepaystudentfees values('','$numberadded','$payfeestudentsrno'
                       ,'$payfeestudentadmissionnumber','$payfeestudentclass','$payfeestudentsessionyear'
                       ,'$payfeetodaydate','$payfeesgroupnamethis','$paythismonthchecked','$particulerfees','$particularfine','','$serviceenable','$payfeefeepayblevalue','$payfeefinepayablevalue'
                       ,'$paydiscountfine','$paydescriptiondiscountfine','$payfeesdiscount','$payfeesdiscountamount','$payfeespaymentinfo','$payfeespaymentdescription'
                       ,'$payfeesamountpayable','$payfeespaymentmode','$payfeesbankname','$payfeeschequeddno'
                       ,'$payfeeschequedddate','$payfeeschequeddamount','$payfeesdueamount','$payfeesamountpaiod','$status')");
}}}}



             if(!empty($insertedpaymentdetails))
               {
                if(($payfeesdueamount!="0")&&($payfeesamountpaiod!=""))
                {   
                $insertstudentdueamount=mysql_query("INSERT into financestudentduefine values('','$numberadded','$payfeestudentsrno'
                        ,'$payfeestudentadmissionnumber','$payfeestudentclass','$payfeestudentsessionyear'
                        ,'$payfeesgroupnamethis','$payfeetodaydate','$payfeesdueamount')");
                 if(!empty($insertstudentdueamount))
                 {
                     
                 }else
                 {
                $deletedfine=mysql_query("DELETE FROM finanacepaystudentfees WHERE trnumber='$numberadded'"); 
                 if($deletedfine)
                 {
                     if(!empty($_POST['dueamountselected']))
                     {
                     $duepaymenterrorcodeduepayment=$_POST['dueamountselected'];
                     $insertstudentdueamount=mysql_query("INSERT into financestudentduefine values('','$numberadded','$payfeestudentsrno'
                        ,'$payfeestudentadmissionnumber','$payfeestudentclass','$payfeestudentsessionyear'
                        ,'$payfeesgroupnamethis','$payfeetodaydate','$duepaymenterrorcodeduepayment')");
                     }
                     echo '
        <script type="text/javascript">
         $(document).ready(function(){
alert("Request Failed........Try Again");    
return false;
});
         </script>
                         ';
                 }
                }     
                 }   
                 echo '
            
        <script type="text/javascript">
         $(document).ready(function(){
alert("Payment Process Succesfully Complete"); 
return false;
});
         </script>
                         ';
               }}
               
               
               
               
               echo' 
         <table style=" width:665px; margin:0 auto; font-size:12px; 
                margin-top:10px;height:45px; background-color:whitesmoke; border:1px solid silver;    ">
             <tr>
                 <td colspan="4" style=" color:maroon; ">Monthly</td>
             </tr>
             <tr>';
              $fetchgroupdb=mysql_query("SELECT * FROM financeaddfeegroup WHERE feegroupname='$feesgroupname' and feegrouptype='$fetchgrouptype' and sessionyear='$sessionyear' order by encryptdate ASC");
              $numbercheck=1;
              while($fetchmonth=mysql_fetch_array($fetchgroupdb))
              {    
$fetchincmonth=$fetchmonth['monthlyofmonth'];               
date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$todaydate=date("Y/m/d");
                 
                 $todaydatevalue=strtotime($todaydate);
                 $encryptfetchtodaydate=ceil($todaydatevalue/60/60/24);
                 $fetchfeeduedate=$fetchmonth['collectfeeduedate'];
                 $itemtodaydatefrom=strtotime($fetchfeeduedate);
                 $encryptfetchduedate=ceil($itemtodaydatefrom/60/60/24); 
              $feepaymentmethod=$_REQUEST['feespaymethod'];
             $feesgroupname=$_REQUEST['feesgroupname'];
             $whichclass=$_REQUEST['setclass'];
             $sessionyear=$_REQUEST['setsessionyear'];
             $feepaystudentsrno=$_REQUEST['studentsrno'];
             $feepaystudentadmissionno=$_REQUEST['studentadmissionno'];
                    
          $selectfinanacepaymentdatabase=mysql_query("SELECT * FROM finanacepaystudentfees WHERE studentsrno='$feepaystudentsrno'
                        and studentadmissionno='$feepaystudentadmissionno' and thisclass='$whichclass'
                        and thissessionyear='$sessionyear' and feesgroup='$feesgroupname' and feepaymonth='$fetchincmonth'");  
                $matchthidvaluedatabase=mysql_fetch_array( $selectfinanacepaymentdatabase);        
                 if(empty($matchthidvaluedatabase))
                 {
                 if($encryptfetchduedate<$encryptfetchtodaydate)
                 {
                 $subtratdueday=round($encryptfetchtodaydate-$encryptfetchduedate);
                 
                 }else
                 {
                  $subtratdueday=0;   
                 }
                 echo "
                 <td>
                 ";
                 {
                     ?>
                <script type='text/javascript'>
               $(document).ready(function(){
                $('#checkmonth'+<?php  echo $numbercheck;?>+'').click(function(){
                 var checkboxvalue=$(this).val();
                
                 var amountpayble=$('#totalamountpayble').val();
                 
                 var thismonthaddvalue=$('#thismonthfeesinclude'+<?php  echo $numbercheck;?>+'').val();
                 var thismonthfine=$('#thismonthfine'+<?php  echo $numbercheck;?>+'').val();
                 if(thismonthfine!=0)
                     {
                      var fineaddone=1;
                      var finequantity=$('#finequantity').val();
                      var finemonthname=checkboxvalue;
                     }else
                         {  
                       var fineaddone=0;
                       var finequantity=$('#finequantity').val();
                        var finemonthname="";
                         }
                 var finequantityvalue=new Number(finequantity);
              
                 var thismonthduefine=new Number(thismonthfine);
                 var finerate="<?php  echo $fetchfeesfineamount;?>";
                 var totalamountfine=(thismonthduefine*finerate);
                 var totalfinepayble=$('#totalfineamount').val();
                 var finepayblethis=new Number(totalfinepayble);
                 
                 var a=new Number(amountpayble);
                 
                 var b=new Number(thismonthaddvalue);
                 
                 var feeq=1;
                 
                 var dc=$('#feequantity').val();
                 var feeqvalue=new Number(dc);
                  if($('#dueamountchecked').attr('checked'))
                 {
                    var addeddueamount=$("#addeddueamount").val();
                  var convertednumberits=new Number(addeddueamount);  
                 }else{
                     var convertednumberits='' 
                 }
                
                     
                if($('#checkmonth'+<?php  echo $numbercheck;?>+'').attr('checked'))
                 {
                     
                 var discountamountthis="<?php  if(!empty($feediscountinamount)){ echo $feediscountinamount;} ?>";
                 var newnumberadded=new Number(discountamountthis);
                 var feediscount=$("#totalamountdiscount").val();
                 var finediscountamount=new Number(feediscount);
                 var thisisafinaloutputindiscount=(newnumberadded+finediscountamount)
                 $("#totalamountdiscount").val(thisisafinaloutputindiscount);
                 
                 var totalpaymentadded=a+b;
                 var totalamountfinepayble=finepayblethis+totalamountfine;
                 var feequantity=feeqvalue+feeq;
                 var totalfinequantity=finequantityvalue+fineaddone;
                 $('#totalamountpayble').val(totalpaymentadded);
                 
                 $('#totalamount').html(totalpaymentadded);
                 
                 $('#p'+<?php  echo $numbercheck;?>+'').html(checkboxvalue+',');
                 $('#pf'+<?php  echo $numbercheck;?>+'').html(finemonthname+',');
                 $('#feequantity').val(feequantity);
                 
                 $('#finequantity').val(totalfinequantity);
                 
                 $('#totalfineamount').val(totalamountfinepayble);
                 
                 $('#totalfineamountis').html(totalamountfinepayble);
                 
                 var feepayblerupease=totalpaymentadded+totalamountfinepayble+convertednumberits;
                 $("#finalpaybleoutput").html(feepayblerupease);
                 var discountsubtract=(feepayblerupease-thisisafinaloutputindiscount)
                 $("#thisisthefinaloutput").val(discountsubtract);
                 }else
                 {
                  var discountamountthis="<?php  if(!empty($feediscountinamount)){ echo $feediscountinamount;} ?>";
                 var newnumberadded=new Number(discountamountthis);
                 var feediscount=$("#totalamountdiscount").val();
                 var finediscountamount=new Number(feediscount);
                 var thisisafinaloutputindiscount=(finediscountamount-newnumberadded)
                 $("#totalamountdiscount").val(thisisafinaloutputindiscount);    
                 
                 var totalpaymentadded=a-b;
                  var feequantity=feeqvalue-feeq;
                  var totalamountfinepayble=finepayblethis-totalamountfine;
                  var totalfinequantity=finequantityvalue-fineaddone;
                 $('#totalamountpayble').val(totalpaymentadded );
                 $('#totalamount').html(totalpaymentadded);
                 $('#p'+<?php  echo $numbercheck;?>+'').html('');
                 $('#pf'+<?php  echo $numbercheck;?>+'').html('');
                 $('#feequantity').val(feequantity);
                 $('#finequantity').val(totalfinequantity);
                  $('#totalfineamount').val(totalamountfinepayble);
                  $('#totalfineamountis').html(totalamountfinepayble);
                  var feepayblerupease=totalpaymentadded+totalamountfinepayble+convertednumberits;
                 $("#finalpaybleoutput").html(feepayblerupease);
                  var discountsubtract=(feepayblerupease-thisisafinaloutputindiscount)
                $("#thisisthefinaloutput").val(discountsubtract);
                 }
                 
                 
                 
                 
                 }); });
</script>
<?php 
                 }
                 
                 $fineamountthis=$subtratdueday*$fetchfeesfineamount;
                 echo "
                 </td>
                 
                 <td style='width:8px;'>
                 <input type='checkbox' name='checkme$numbercheck' id='checkmonth$numbercheck' value='$fetchincmonth'>
                 <input type='hidden' id='thismonthfeesinclude$numbercheck' value='$fetchfeesamount'>
                 <input type='hidden' id='thismonthfine$numbercheck' value='$subtratdueday'>
                 
 <input type='hidden' name='particularfees$numbercheck' value='$fetchfeesamount'>
 <input type='hidden' name='particularfine$numbercheck' value='$fineamountthis'>
                 
                 </td><td style='width:50px; text-align:left;'>$fetchincmonth</td>";    
               
              }else
              {
                  echo "<td ></td>
                      
                 <td style='width:8px;'>
                 <input type='checkbox'  value='$fetchincmonth' checked disabled>
                  <input type='hidden' name='particularfees$numbercheck' value='0'>
                  <input type='hidden' name='particularfine$numbercheck' value='0'>
                 </td><td style='width:50px; text-align:left;'>$fetchincmonth</td>
";      
              }
               $numbercheck++; 
              }
              $finalnumber=$numbercheck-1;
              echo "<input type='hidden' name='loopcounted' value='$finalnumber'>";
              {
           ?>  
           <td style='width:100%;'></td>
             </tr>
         </table>
         
            <table cellspacing="0" cellpadding="0" style=" width:600px;  margin-top:10px; margin-left:40px;  padding-left:5px;   ">
                <tr>
                    <td  class="td_leftpaddingth" style=" padding-left:15px;  color:white; font-size:12px;   font-weight:bold;  
                                        height:20px; background-image:url('finanacephoto/bgblack.png'); ">Fee Amount</td>
                </tr>
                <tr>
                    <td>
                        <table cellspacing="0" cellpadding="0" style=" width:100%; ">
                            <tr>
                                <td class="td_table_head">
                                 Fee    
                                </td>
                                <td class="td_table_head">
                                 Amount    
                                </td>
                                <td class="td_table_head">
                                 Quantity   
                                </td>
                                <td class="td_table_head">
                                Specific Month  
                                </td>
                                <td class="td_table_head">
                                Total Amount   
                                </td>
                                <td class="td_table_head">
                               Select  
                                </td>
                                <td class="td_table_head" style=" border-right:1px solid silver; ">
                                Modify   
                                </td>
                            </tr>
                          <?php 
                           echo "<tr>
                               <td class='td_print_value'>$feesname</td>
                                <td class='td_print_value'>$fetchfeesamount</td>
                                 <td class='td_print_value'><input type='text' 
                            style='width:55px; color:gray; padding-left:2px;' id='feequantity' readonly='readonly' value='0'></td>
                                  <td class='td_print_value' style='width:200px;'>
<p id='p1' class='p'></p><p id='p2' class='p'></p><p id='p3' class='p'></p><p id='p4' class='p'></p><p id='p5' class='p'></p><p id='p6' class='p'></p>
<p id='p7' class='p'></p><p id='p8' class='p'></p><p id='p9' class='p'></p><p id='p10' class='p'></p><p id='p11' class='p'></p><p id='p12' class='p'></p>
                            </td>
                            <td class='td_print_value'><div id='totalamount' style='text-align:center;'>0</div></td>
                            <td class='td_print_value'><input type='checkbox' checked disabled></td>
                                    <td class='td_print_value' style='border-right:1px solid silver; color:red;'>No Modify</td>
                               </tr>";
                            ?>  
                          <?php 
                           echo "<tr>
                               <td class='td_print_value'><div id='showfine'>Fine</div>
                               <div class='showfinedetails'>
                          <table cellspacing='0' cellpadding='0' style='width:100%; '>
                          <tr>
                           <td class='fineheader' colspan='3'>Monthly Fee</td>  <td class='fineheader'>$todaydate</td>                        
                             </tr>
                          <tr>
                          <td class='td_fine_show_table'>Month</td>
                          <td class='td_fine_show_table'>Start Date</td>
                          <td class='td_fine_show_table'>Due Date</td>
                          <td class='td_fine_show_table'>No Of Due Day</td>
                          </tr>
                          ";
                  $sessionyear=$_REQUEST['setsessionyear']; 
                  $feepaystudentsrno=$_REQUEST['studentsrno'];
             $feepaystudentadmissionno=$_REQUEST['studentadmissionno'];
             $feesgroupname=$_REQUEST['feesgroupname'];    
$fetchgroupdb=mysql_query("SELECT * FROM financeaddfeegroup WHERE feegroupname='$feesgroupname'
        and feegrouptype='$fetchgrouptype' and sessionyear='$sessionyear' order by encryptdate ASC");
              $numbercheck=1;
               $adddedtotaldays=0;
              while($fetchmonth=mysql_fetch_array($fetchgroupdb))
              {    
$fetchincmonth=$fetchmonth['monthlyofmonth']; 
$selectmonthmarch=mysql_query("SELECT * FROM finanacepaystudentfees WHERE studentsrno='$feepaystudentsrno' and
       studentadmissionno='$feepaystudentadmissionno' and feesgroup='$feesgroupname' and feepaymonth='$fetchincmonth'");
$fecthmatchmonth=mysql_fetch_array($selectmonthmarch);
$fetchstartdate=$fetchmonth['collectfeestartdate'];
$fetchduedate=$fetchmonth['collectfeeduedate'];
date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$todaydate=date("Y/m/d"); 
                 $todaydatevalue=strtotime($todaydate);
                 $encryptfetchtodaydate=ceil($todaydatevalue/60/60/24);
                 $fetchfeeduedate=$fetchmonth['collectfeeduedate'];
                 $itemtodaydatefrom=strtotime($fetchfeeduedate);
                 $encryptfetchduedate=ceil($itemtodaydatefrom/60/60/24);
if(empty($fecthmatchmonth))
{
                 if($encryptfetchduedate<$encryptfetchtodaydate)
                 {
                 $subtratdueday=round($encryptfetchtodaydate-$encryptfetchduedate);
                 
                 echo "<tr style=''>
                 <td class='td_fetchfine'>$fetchincmonth</td>
                 <td class='td_fetchfine'>$fetchstartdate</td>
                 <td class='td_fetchfine'>$fetchduedate</td>
                 <td class='td_fetchfine'>$subtratdueday</td>
                 </tr>";
                 
                 }else
                 {
                  $subtratdueday=0;   
                 }
                 
               $adddedtotaldays +=$subtratdueday; 
              }
              }
              if($adddedtotaldays=="0")
              {
                  echo "<tr>
<td colspan='4' style='background-color:skyblue;'>No Due Fine</td>                      
</tr>";    
              }
              echo "
                   </tr>
                          <tr>
                          <td colspan='3' class='td_fine_show_tabletotal' style='text-align:right;'>Total No Of Due Day :</td>
                          <td class='td_fine_show_tabletotal'>$adddedtotaldays</td>
                          </tr>";           
                           echo "
                          </table>     
                          </div>
                               
</td>
                                <td class='td_print_value'>$fetchfeesfineamount</td>
                                 <td class='td_print_value'><input type='text' 
                            style='width:55px; color:gray; padding-left:2px;' id='finequantity' readonly='readonly' value='0'></td>
<td class='td_print_value'><p id='pf1' class='p'></p><p id='pf2' class='p'></p><p id='pf3' class='p'></p><p id='pf4' class='p'></p><p id='pf5' class='p'></p>
<p id='pf6' class='p'></p><p id='pf7' class='p'></p><p id='pf8' class='p'></p><p id='pf9' class='p'></p><p id='pf10' class='p'></p><p id='pf11' class='p'></p><p id='pf12' class='p'></p>
                                </td>
                                   <td class='td_print_value'><div id='totalfineamountis' style='text-align:center;'>0</div></td>
<td class='td_print_value'><input type='checkbox' checked disabled></td>                                    
<td class='td_print_value' style='border-right:1px solid silver; color:red;'><div id='addfine'><strong> Add</strong></div>
<div id='modified' style='color:blue; display:none;'>No Modify</div>
</td>
                               </tr>";
                           
                            ?>
       <?php 
$fecthisstudentarresduesamount=mysql_query("SELECT * FROM financestudentduefine WHERE studentsrno='$feepaystudentsrno' and studentadmissionno='$feepaystudentadmissionno'
     and studentclass='$whichclass' and studentsessionyear='$sessionyear'");
 $fecthduesamounts=0;
 $quantity=0;
 while ($fetchduesamount=mysql_fetch_array($fecthisstudentarresduesamount))
 {
     $fetchduethisamount=$fetchduesamount['duepayment'];
   $quantity++;
   $fecthduesamounts +=$fetchduethisamount;  
 }
  if($fecthduesamounts>0)
 {
     $paymentname="Due Fee";
     $positivevalue=$fecthduesamounts;
 }else
 {
  $paymentname="Paid Fee";
  $positivevalue=abs($fecthduesamounts);
 }
                           echo "<tr>
                               <td class='td_print_value'><div id='showduefine'>$paymentname</div>
                               <div class='showduefinedetails'>
                          <table cellspacing='0' cellpadding='0' style='width:100%; '>
                          <tr>
         <td class='fineheader' colspan='5'>Previous $paymentname</td>  <td class='fineheader'>$todaydate</td>                        
                             </tr>
                          <tr>
                          <td class='td_fine_show_table'>Sl.No</td>
                          <td class='td_fine_show_table'>Payment Date</td>
                          <td class='td_fine_show_table'>Fee Group</td>
                          <td class='td_fine_show_table'>Due Amount</td>
                         <td class='td_fine_show_table'>Fine Amount</td>
                          <td class='td_fine_show_table'>Total Amount</td>
                          </tr>
                          ";
 $fecthisstudentarresduesamount=mysql_query("SELECT * FROM financestudentduefine WHERE studentsrno='$feepaystudentsrno' and studentadmissionno='$feepaystudentadmissionno'
 and studentclass='$whichclass' and studentsessionyear='$sessionyear'");
 $row=0;
  $totaldueamountpayable=0;
 while ($fetchduesamountthis=mysql_fetch_array($fecthisstudentarresduesamount))
 {
    $row++;
    $fetchtrnumber=$fetchduesamountthis['trnumber'];
    $fetchduepaymentdate=$fetchduesamountthis['feespaymentdate'];
    $fetchduefeegroup=$fetchduesamountthis['feesgroup'];
    $fetchdueamount=$fetchduesamountthis['duepayment'];
    $studentcheckthismonthduefine=mysql_query("SELECT * FROM finanacepaystudentfees WHERE trnumber='$fetchtrnumber' order by id DESC");
    $trnumberfetchmonth=  mysql_fetch_array($studentcheckthismonthduefine);
    if(!empty($trnumberfetchmonth))
    {
    $monthofmonthfecth=$trnumberfetchmonth['feepaymonth'];
    $feesgroupdbduedate=mysql_query("SELECT * FROM financeaddfeegroup WHERE feegroupname='$fetchduefeegroup'
    and monthlyofmonth='$monthofmonthfecth'");
   $fetchfeegroupdetail=mysql_fetch_array($feesgroupdbduedate);
   if(!empty($fetchfeegroupdetail))  
   {
                                 $fetchthisfeemonth=$fetchfeegroupdetail['monthlyofmonth'];
                                 $thisfetchfeesname=$fetchfeegroupdetail['feename'];
                                 $thisfetchfeesgroup=$fetchfeegroupdetail['feegroupname'];
                                 $thisfetchgrouptype=$fetchfeegroupdetail['feegrouptype'];
                                 $thisfetchstartfeecollectdate=$fetchfeegroupdetail['collectfeestartdate'];
 $thisfeesduedate=$fetchfeegroupdetail['collectfeeduedate'];
date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$todaydate=date("Y/m/d");
                 $todaydatevalue=strtotime($todaydate);
                 $encryptfetchtodaydate=ceil($todaydatevalue/60/60/24);
                 $itemtodaydatefrom=strtotime($thisfeesduedate);
                 $encryptfetchduedate=ceil($itemtodaydatefrom/60/60/24);
                 
                 $itemduedatedatefrom=strtotime($fetchduepaymentdate);
                 $encryptfetchduedatepayment=ceil($itemduedatedatefrom/60/60/24);
                 
                  if($encryptfetchduedate<$encryptfetchtodaydate)
                 {
                 $duepaymentdateamountrate=round($encryptfetchtodaydate-$encryptfetchduedatepayment);
                 
                 }else
                 {
                  $duepaymentdateamountrate=0;   
                 } 
                 
                $selectfeeamountdb=mysql_query("SELECT * FROM financefeeamount WHERE
                         addfeesname='$thisfetchfeesname' and feegrouptype='$thisfetchgrouptype'
                         and feesgroupname='$thisfetchfeesgroup' and feesetclass='$whichclass'");

                           $fetchfeesamountmonthandyear=mysql_fetch_array($selectfeeamountdb);
                           if(!empty($fetchfeesamountmonthandyear))
                           {
                             
                             $duefeesfineamounts=$fetchfeesamountmonthandyear['fineamount'];
                             $duefineamountfinal=$duepaymentdateamountrate*$duefeesfineamounts;
                           }else
                           {
                           $duefineamountfinal="0";    
                           }  
                 
                 }
                 else
                     {
                     $duefineamountfinal="0";
                     }
    }else
    {
     $duepaymentdateamountrate="0"; 
     $duefineamountfinal="0";
     
    }
                
                         
                 $finaltotaldueamount=$fetchdueamount+$duefineamountfinal;
                 
    
    
                 echo "<tr style=''>
                 <td class='td_fetchfine'>$row</td>
                 <td class='td_fetchfine'>$fetchduepaymentdate</td>
                 <td class='td_fetchfine'>$fetchduefeegroup</td>
                 <td class='td_fetchfine'>$fetchdueamount</td>
                 <td class='td_fetchfine'>$duefineamountfinal</td>
                 <td class='td_fetchfine'>$finaltotaldueamount</td>
                 </tr>"; 
                 
                $totaldueamountpayable +=$finaltotaldueamount;
 }     
 if(empty($fetchduepaymentdate))
 {
                  echo "<tr>
<td colspan='6' style='background-color:skyblue;'>No Due Fee</td>                      
</tr>";    
 }         
              echo "
                   </tr>
                          <tr>
                          <td colspan='5' class='td_fine_show_tabletotal' style='text-align:right;'>Total Due Amount :</td>
                          <td class='td_fine_show_tabletotal'> $totaldueamountpayable</td>
                          </tr>";           
                           echo "
                          </table></div></td>";
                                 
             $feepaymentmethod=$_REQUEST['feespaymethod'];
             $feesgroupname=$_REQUEST['feesgroupname'];
             $whichclass=$_REQUEST['setclass'];
             $sessionyear=$_REQUEST['setsessionyear'];
             $feepaystudentsrno=$_REQUEST['studentsrno'];
             $feepaystudentadmissionno=$_REQUEST['studentadmissionno'];
                  echo "
                                <td class='td_print_value'>$totaldueamountpayable</td>
                                 <td class='td_print_value'><input type='text' 
                            style='width:55px; color:gray; padding-left:2px;' id='finequantity' readonly='readonly' value='$quantity'></td>
                                  <td class='td_print_value'>
                                  </td>
<td class='td_print_value'>$totaldueamountpayable<input type='hidden' id='addeddueamount' value='$totaldueamountpayable'></td>
<td class='td_print_value'><input type='checkbox' name='dueamountselected' value='$totaldueamountpayable' id='dueamountchecked' checked></td>                                    
<td class='td_print_value' style='border-right:1px solid silver; color:red;'>No Modify</td>
                               </tr>";
                  
                           
                            ?>
                            
                            <tr>
                                <td colspan="5" style=" background-color:white ; height:25px; text-align:right;font-size:12px; 
                                    border-bottom:1px solid silver; border-left:1px solid silver;  ">
                                    <div style=" width:290px; float:right;  ">
                                        <strong>Total Payable Amount</strong>  <strong style=" padding-left:5px; ">:</strong> 
                                       </div>
                                </td>
                                <td style=" background-color:white;font-size:12px; font-weight:bold;  color:brown;   text-align:center; border-bottom:1px solid silver;">
                                        <div id="finalpaybleoutput">0</div>
                                        
                                </td>
                                <td style=" background-color:white ;border-bottom:1px solid silver; border-right:1px solid silver; ">
                                    
                                </td>
                            </tr>
                        </table>   
                    </td>
                </tr>
            </table>
          <?php 
               }
           }
           
       
           
           
           
           
           
           
           
           
  //startannualfees //       
   if($fetchgrouptype=="annual")
   {
       
       
        if(!empty($_POST['payamount'])){  
              $addtrnumber=mysql_query("SELECT * FROM finanacepaystudentfees WHERE id order by id DESC");
              $fetchnumber=mysql_fetch_array($addtrnumber);
               if(!empty($fetchnumber))
               {
               $numberaddedITS=$fetchnumber['trnumber']; 
               $addedone="1";
               $numberadded=$numberaddedITS+$addedone;
               }else
               {$numberadded="1";}
            
              $payfeestudentsrno=$_POST['payfeestudentsrnumber'];
              $payfeestudentadmissionnumber=$_POST['payfeestudentadmissionnumber'];
              $payfeestudentclass=$_POST['payfeestudentclass'];
              $perticulerfees=$_POST['particularfees'];
              $perticularfine=$_POST['particularfine'];
              $payfeestudentsessionyear=$_POST['payfeestudentsessionyear'];
              $payfeesgroupnamethis=$_POST['payfeesgroupname'];
              $payfeefeepayblevalue=$_POST['feepayablevalue'];
              $payfeefinepayablevalue=$_POST['finepayablevalue'];
              $payfeetodaydate=$_POST['payafeetodaydate'];
              $payfeesdiscount=$_POST['discount'];
              $payfeesdiscountamount=$_POST['discountamount'];
              $payfeespaymentinfo=$_POST['paymentinfo'];
              $payfeespaymentdescription=$_POST['feedescription'];
              $payfeesamountpayable=$_POST['totalamountpayable'];
                $payfeespaymentmode=$_POST['paymentmode'];
              if($payfeespaymentmode=="cash")
              {
                $payfeesbankname="----------"; 
                $payfeeschequeddno="----------"; 
              $payfeeschequedddate="----------"; 
              $payfeeschequeddamount="0.0"; 
              $status="CLEARED";
              }  else {
                  $payfeesbankname=$_POST['bankname'];
                  $payfeeschequeddno=$_POST['chequeddnumber'];
              $payfeeschequedddate=$_POST['chequedddate'];
              $payfeeschequeddamount=$_POST['chequeddamount'];
               $status="PENDING";
              }
              $payfeesamountpaiod=$_POST['amountpaid'];
              $payfeesdueamount=$_POST['dueamount'];
              $paydiscountfine=$_POST['discountfine'];
              $paydescriptiondiscountfine=  nl2br($_POST['discriptiondiscountfine']);
              $annualpaymentfees="Yearly";
              $servicedueefee=$_POST['serviceduefee'];
             
              if(($payfeestudentsrno!="")&&($payfeestudentadmissionnumber!="")&&($payfeestudentclass!="")&&($payfeestudentsessionyear!="")&&($payfeesamountpaiod!=""))
              {
                  require_once '../connection.php';
                $selectmatchthisfeealreadypay=mysql_query("SELECT * FROM finanacepaystudentfees WHERE studentsrno='$payfeestudentsrno'
                        and studentadmissionno='$payfeestudentadmissionnumber' and thisclass='$payfeestudentclass'
                        and thissessionyear='$payfeestudentsessionyear' and feesgroup='$payfeesgroupnamethis'");  
                $fetchpaymentdetail=mysql_fetch_array($selectmatchthisfeealreadypay);
              
                
               if(!empty($_POST['dueamountselected']))
               {
                 $deletedfine=mysql_query("DELETE FROM financestudentduefine WHERE studentsrno='$payfeestudentsrno'
                         and studentadmissionno='$payfeestudentadmissionnumber'"); 
                 if($deletedfine)
                 {}}    
               $insertedpaymentdetails=mysql_query("INSERT into finanacepaystudentfees values('','$numberadded','$payfeestudentsrno'
                       ,'$payfeestudentadmissionnumber','$payfeestudentclass','$payfeestudentsessionyear'
                       ,'$payfeetodaydate','$payfeesgroupnamethis','$annualpaymentfees','$perticulerfees','$perticularfine','','$servicedueefee','$payfeefeepayblevalue','$payfeefinepayablevalue'
                       ,'$paydiscountfine','$paydescriptiondiscountfine','$payfeesdiscount','$payfeesdiscountamount','$payfeespaymentinfo','$payfeespaymentdescription'
                       ,'$payfeesamountpayable','$payfeespaymentmode','$payfeesbankname','$payfeeschequeddno'
                       ,'$payfeeschequedddate','$payfeeschequeddamount','$payfeesdueamount','$payfeesamountpaiod','$status')");
              }
               if(!empty($insertedpaymentdetails))
               {
                if(($payfeesdueamount!="0")&&($payfeesamountpaiod!=""))
                {   
                $insertstudentdueamount=mysql_query("INSERT into financestudentduefine values('','$numberadded','$payfeestudentsrno'
                        ,'$payfeestudentadmissionnumber','$payfeestudentclass','$payfeestudentsessionyear'
                        ,'$payfeesgroupnamethis','$payfeetodaydate','$payfeesdueamount')");
                 if(!empty($insertstudentdueamount))
                 {
                     
                 }else
                 {
                $deletedfine=mysql_query("DELETE FROM finanacepaystudentfees WHERE trnumber='$numberadded'"); 
                 if($deletedfine)
                 {
                     if(!empty($_POST['dueamountselected']))
                     {
                     $duepaymenterrorcodeduepayment=$_POST['dueamountselected'];
                     $insertstudentdueamount=mysql_query("INSERT into financestudentduefine values('','$numberadded','$payfeestudentsrno'
                        ,'$payfeestudentadmissionnumber','$payfeestudentclass','$payfeestudentsessionyear'
                        ,'$payfeesgroupnamethis','$payfeetodaydate','$duepaymenterrorcodeduepayment')");
                     }
                     echo '
        <script type="text/javascript">
         $(document).ready(function(){
alert("Request Failed........Try Again");    
return false;
});
         </script>
                         ';
                 }
                }     
                 }   
                 echo '
            
        <script type="text/javascript">
         $(document).ready(function(){
alert("Payment Process Succesfully Complete"); 
return false;
});
         </script>
                         ';
               }}
       
   {
   
       
       ?>
         <table style=" width:100%; padding-left:20px; font-size:13px; border:1px solid silver;    margin-left:5px;  height:20px; background-color:white;   ">
             <tr>
                 <td><strong>Annual Fee Payment</strong></td>
             </tr>
         </table>
       <table cellspacing="0" cellpadding="0" style=" width:600px;  margin-top:10px; margin-left:40px;  padding-left:5px;   ">
                <tr>
                    <td  class="td_leftpaddingth" style=" padding-left:15px;  color:white; font-size:12px;   font-weight:bold;  
                                        height:20px; background-image:url('finanacephoto/bgblack.png'); ">Fee Amount</td>
                </tr>
                <tr>
                    <td>
                        <table cellspacing="0" cellpadding="0" style=" width:100%; ">
                            <tr>
                                <td class="td_table_head">
                                 Fee    
                                </td>
                                <td class="td_table_head">
                                 Amount    
                                </td>
                                <td class="td_table_head">
                                 Quantity   
                                </td>
                                <td class="td_table_head">
                                Total Amount   
                                </td>
                                <td class="td_table_head">
                                Select  
                                </td>
                                <td class="td_table_head" style=" border-right:1px solid silver; ">
                                Modify   
                                </td>
                            </tr>   
  <?php      
   }
    $studentpaymentalreadypay=mysql_query("SELECT * FROM finanacepaystudentfees WHERE studentsrno='$feepaystudentsrno' and studentadmissionno='$feepaystudentadmissionno'
     and thisclass='$whichclass' and thissessionyear='$sessionyear' and feesgroup='$feesgroupname'"); 
     $fetchalreadyvalue=mysql_fetch_array($studentpaymentalreadypay);
     
     if(!empty($fetchalreadyvalue)&&($fetchalreadyvalue!=""))
                  {
         echo "<style>
 #yellowcolor{ background-color:yellow;}             
</style>";
         
         echo "<input type='hidden' name='serviceduefee' value='Due Fee'>";
         
                  }else
                  {
echo "<input type='hidden' name='serviceduefee' value='Paid Fee'>";
         
                  }
     
     
    echo "<tr><td id='yellowcolor' class='td_print_value'>$feesname</td>
   <td id='yellowcolor' class='td_print_value'>$fetchfeesamount</td>
   <td id='yellowcolor' class='td_print_value'><input type='text' style='width:55px;
   color:gray; padding-left:2px;' id='feequantity'
   readonly='readonly' value='1'></td>      
  <td id='yellowcolor' class='td_print_value'><div id='totalamount' style='text-align:center;'>$fetchfeesamount</div></td>
<td id='yellowcolor' class='td_print_value'><input type='checkbox' checked disabled></td>
<td id='yellowcolor' class='td_print_value' style='border-right:1px solid silver; color:red;'>No Modify</td>
                               </tr>";
                            ?> 
                            
                            
                          <?php 
                           echo "<tr>
                               <td id='yellowcolor' class='td_print_value'><div id='showfine'>Fine</div>
                               <div class='showfinedetails'>
                          <table cellspacing='0' cellpadding='0' style='width:100%; '>
                          <tr>
                           <td class='fineheader' colspan='3'>Anuual Fee</td><td class='fineheader'>$todaydate</td>                        
                             </tr>
                          <tr>
                          <td class='td_fine_show_table'>Fee Group</td>
                          <td class='td_fine_show_table'>Start Date</td>
                          <td class='td_fine_show_table'>Due Date</td>
                          <td class='td_fine_show_table'>No Of Due Day</td>
                          </tr>
                          ";
                  $sessionyear=$_REQUEST['setsessionyear']; 
                  $feepaystudentsrno=$_REQUEST['studentsrno'];
             $feepaystudentadmissionno=$_REQUEST['studentadmissionno'];
                 
$fetchgroupdb=mysql_query("SELECT * FROM financeaddfeegroup WHERE feegroupname='$feesgroupname'
        and feegrouptype='$fetchgrouptype' and sessionyear='$sessionyear' order by encryptdate ASC");
              $numbercheck=1;
               $adddedtotaldays=0;
              while($fetchmonth=mysql_fetch_array($fetchgroupdb))
              {    
$fetchincmonth=$fetchmonth['monthlyofmonth']; 
$selectmonthmarch=  mysql_query("SELECT * FROM finanacepaystudentfees WHERE studentsrno='$feepaystudentsrno' and
       studentadmissionno='$feepaystudentadmissionno' and feepaymonth='$fetchincmonth'");
$fecthmatchmonth=mysql_fetch_array($selectmonthmarch);
$fetchstartdate=$fetchmonth['collectfeestartdate'];
$fetchduedate=$fetchmonth['collectfeeduedate'];
date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$todaydate=date("Y/m/d"); 
                 $todaydatevalue=strtotime($todaydate);
                 $encryptfetchtodaydate=ceil($todaydatevalue/60/60/24);
                 $fetchfeeduedate=$fetchmonth['collectfeeduedate'];
                 $itemtodaydatefrom=strtotime($fetchfeeduedate);
                 $encryptfetchduedate=ceil($itemtodaydatefrom/60/60/24);
                 if(empty($fecthmatchmonth))
                 {
                 if($encryptfetchduedate<$encryptfetchtodaydate)
                 {$subtratdueday=round($encryptfetchtodaydate-$encryptfetchduedate); 
                 if(!empty($fetchalreadyvalue)&&($fetchalreadyvalue!=""))
                  {
                       echo "<tr>
<td colspan='4' style='background-color:skyblue;'>No Due Days</td>                      
</tr>";
                  }else
                  {

                 
                 echo "<tr style=''>
                 <td class='td_fetchfine'>$feesgroupname</td>
                 <td class='td_fetchfine'>$fetchstartdate</td>
                 <td class='td_fetchfine'>$fetchduedate</td>
                 <td class='td_fetchfine'>$subtratdueday</td>
                 </tr>"; 
                  }
                 }else
                 {
                  $subtratdueday=0;   
                 }  
                 $adddedtotaldays +=$subtratdueday;}}
              if($adddedtotaldays=="0")
              {
                  echo "<tr>
<td colspan='4' style='background-color:skyblue;'>No Due Days</td>                      
</tr>";
                  
} 




if(!empty($fetchalreadyvalue)&&($fetchalreadyvalue!=""))
                  {
                   $totalpayfine=0;
                   $fetchquantity=0;
                   $adddedtotaldays=0;
                  }else
                  {
$totalpayfine=($adddedtotaldays*$fetchfeesfineamount);
$fetchquantity="1";
                  }
              echo "
                   </tr>
                          <tr>
                          <td colspan='3' class='td_fine_show_tabletotal' 
              style='text-align:right;'>Total No Of Due Day :</td>
                          <td class='td_fine_show_tabletotal'>$adddedtotaldays</td>
                          </tr>";           
                           echo "
                          </table>     
                          </div>
                               
</td>
                                <td id='yellowcolor' class='td_print_value'>$fetchfeesfineamount</td>
                                 <td id='yellowcolor' class='td_print_value'><input type='text' 
                            style='width:55px; color:gray; padding-left:2px;' id='finequantity'
                            readonly='readonly' value='$fetchquantity'></td>

<td id='yellowcolor' class='td_print_value'><div id='totalfineamountis' style='text-align:center;'>$totalpayfine</div></td>
<td id='yellowcolor' class='td_print_value'><input type='checkbox' checked disabled></td>                                    
<td id='yellowcolor' class='td_print_value' style='border-right:1px solid silver; color:red;'><div id='addfine'><strong>Add</strong></div>
<div  id='modified' style='color:blue; display:none;'>No Modify</div>
</td>
                               </tr>";
                           
                           
echo "<input type='hidden' name='particularfees' 
                           value='$fetchfeesamount'>
<input type='hidden' name='particularfine' 
                           value='$totalpayfine'>
                           ";              
                           
              ?>
          <?php 
$fecthisstudentarresduesamount=mysql_query("SELECT * FROM financestudentduefine WHERE studentsrno='$feepaystudentsrno' and studentadmissionno='$feepaystudentadmissionno'
     and studentclass='$whichclass' and studentsessionyear='$sessionyear'");
 $fecthduesamounts=0;
 $quantity=0;
 while ($fetchduesamount=mysql_fetch_array($fecthisstudentarresduesamount))
 {
     $fetchduethisamount=$fetchduesamount['duepayment'];
   $quantity++;
   $fecthduesamounts +=$fetchduethisamount;  
 }
  if($fecthduesamounts>0)
 {
     $paymentname="Due Fee";
     $positivevalue=$fecthduesamounts;
 }else
 {
  $paymentname="Paid Fee";
  $positivevalue=abs($fecthduesamounts);
 }
                           echo "<tr>
                               <td class='td_print_value'><div id='showduefine'>$paymentname</div>
                               <div class='showduefinedetails'>
                          <table cellspacing='0' cellpadding='0' style='width:100%; '>
                          <tr>
         <td class='fineheader' colspan='5'>Previous $paymentname</td>  <td class='fineheader'>$todaydate</td>                        
                             </tr>
                          <tr>
                          <td class='td_fine_show_table'>Sl.No</td>
                          <td class='td_fine_show_table'>Payment Date</td>
                          <td class='td_fine_show_table'>Fee Group</td>
                          <td class='td_fine_show_table'>Due Amount</td>
                         <td class='td_fine_show_table'>Fine Amount</td>
                         <td class='td_fine_show_table'>Total Amount</td>
                          </tr>
                          ";
 $fecthisstudentarresduesamount=mysql_query("SELECT * FROM financestudentduefine WHERE studentsrno='$feepaystudentsrno' and studentadmissionno='$feepaystudentadmissionno'
 and studentclass='$whichclass' and studentsessionyear='$sessionyear'");
 $row=0;
  $totaldueamountpayable=0;
 while ($fetchduesamountthis=mysql_fetch_array($fecthisstudentarresduesamount))
 {
    $row++;
    $fetchtrnumber=$fetchduesamountthis['trnumber'];
    $fetchduepaymentdate=$fetchduesamountthis['feespaymentdate'];
    $fetchduefeegroup=$fetchduesamountthis['feesgroup'];
    $fetchdueamount=$fetchduesamountthis['duepayment'];
    $studentcheckthismonthduefine=mysql_query("SELECT * FROM finanacepaystudentfees WHERE trnumber='$fetchtrnumber' order by id DESC");
    $trnumberfetchmonth=  mysql_fetch_array($studentcheckthismonthduefine);
    if(!empty($trnumberfetchmonth))
    {
    $monthofmonthfecth=$trnumberfetchmonth['feepaymonth'];
    $feesgroupdbduedate=mysql_query("SELECT * FROM financeaddfeegroup WHERE feegroupname='$fetchduefeegroup'
    and monthlyofmonth='$monthofmonthfecth'");
   $fetchfeegroupdetail=mysql_fetch_array($feesgroupdbduedate);
   if(!empty($fetchfeegroupdetail))  
   {
                                 $fetchthisfeemonth=$fetchfeegroupdetail['monthlyofmonth'];
                                 $thisfetchfeesname=$fetchfeegroupdetail['feename'];
                                 $thisfetchfeesgroup=$fetchfeegroupdetail['feegroupname'];
                                 $thisfetchgrouptype=$fetchfeegroupdetail['feegrouptype'];
                                 $thisfetchstartfeecollectdate=$fetchfeegroupdetail['collectfeestartdate'];
 $thisfeesduedate=$fetchfeegroupdetail['collectfeeduedate'];
date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$todaydate=date("Y/m/d");
                 $todaydatevalue=strtotime($todaydate);
                 $encryptfetchtodaydate=ceil($todaydatevalue/60/60/24);
                 $itemtodaydatefrom=strtotime($thisfeesduedate);
                 $encryptfetchduedate=ceil($itemtodaydatefrom/60/60/24);
                 
                 $itemduedatedatefrom=strtotime($fetchduepaymentdate);
                 $encryptfetchduedatepayment=ceil($itemduedatedatefrom/60/60/24);
                 
                  if($encryptfetchduedate<$encryptfetchtodaydate)
                 {
                 $duepaymentdateamountrate=round($encryptfetchtodaydate-$encryptfetchduedatepayment);
                 
                 }else
                 {
                  $duepaymentdateamountrate=0;   
                 } 
                 
                $selectfeeamountdb=mysql_query("SELECT * FROM financefeeamount WHERE
                         addfeesname='$thisfetchfeesname' and feegrouptype='$thisfetchgrouptype'
                         and feesgroupname='$thisfetchfeesgroup' and feesetclass='$whichclass'");

                           $fetchfeesamountmonthandyear=mysql_fetch_array($selectfeeamountdb);
                           if(!empty($fetchfeesamountmonthandyear))
                           {
                             
                             $duefeesfineamounts=$fetchfeesamountmonthandyear['fineamount'];
                             $duefineamountfinal=$duepaymentdateamountrate*$duefeesfineamounts;
                           }else
                           {
                           $duefineamountfinal="0";    
                           }  
                 
                 }
                 else
                     {
                     $duefineamountfinal="0";
                     }
    }else
    {
   $duepaymentdateamountrate="0"; 
     $duefineamountfinal="0"; 
    }
                
                         
                 $finaltotaldueamount=$fetchdueamount+$duefineamountfinal;
                 
    
    
                 echo "<tr style=''>
                 <td class='td_fetchfine'>$row</td>
                 <td class='td_fetchfine'>$fetchduepaymentdate</td>
                 <td class='td_fetchfine'>$fetchduefeegroup</td>
                 <td class='td_fetchfine'>$fetchdueamount</td>
                 <td class='td_fetchfine'>$duefineamountfinal</td>
                 <td class='td_fetchfine'>$finaltotaldueamount</td>
                 "; 
                 
                $totaldueamountpayable +=$finaltotaldueamount;
 }     
 if(empty($fetchduepaymentdate))
 {
                  echo "<tr>
<td colspan='6' style='background-color:skyblue;'>No Due Fee</td>                      
</tr>";    
 }         
              echo "
                   </tr>
                          <tr>
                          <td colspan='5' class='td_fine_show_tabletotal' style='text-align:right;'>Total Due Amount :</td>
                          <td class='td_fine_show_tabletotal'> $totaldueamountpayable</td>
                          </tr>";           
                           echo "
                          </table></div></td>";
           
                           
                                
                          
                               
             $feepaymentmethod=$_REQUEST['feespaymethod'];
             $feesgroupname=$_REQUEST['feesgroupname'];
             $whichclass=$_REQUEST['setclass'];
             $sessionyear=$_REQUEST['setsessionyear'];
             $feepaystudentsrno=$_REQUEST['studentsrno'];
             $feepaystudentadmissionno=$_REQUEST['studentadmissionno'];
                  echo "
                                <td class='td_print_value'>$totaldueamountpayable</td>
                                 <td class='td_print_value'><input type='text' 
                            style='width:55px; color:gray; padding-left:2px;' id='finequantity' readonly='readonly' value='$quantity'></td>
                                  
<td class='td_print_value'>$totaldueamountpayable<input type='hidden' id='addeddueamount' value='$totaldueamountpayable'></td>
<td class='td_print_value'><input type='checkbox' name='dueamountselected' value='$totaldueamountpayable' id='dueamountchecked' checked></td>                                    
<td class='td_print_value' style='border-right:1px solid silver; color:red;'>No Modify</td>
                               </tr>";
                  
                           
                               
                 
                   ?>
                            
                         
                            
                            
                           <?php 
                             
                             //depositfeeprocess
                             
                           echo "<tr>
                               <td id='yellowcolor' class='td_print_value'><div id='showdepositfine'>Deposit Fee</div>
                               <div class='showdepositfeefinedetails'>
                          <table cellspacing='0' cellpadding='0' style='width:100%; '>
                          <tr>
                      <td class='fineheader' colspan='3'>Deposit Fee Details</td> 
                      <td class='fineheader' style='padding-right:10px;'>$todaydate</td></tr>
                          <tr>
                          <td class='td_fine_show_table'>Sl.No</td>
                          <td class='td_fine_show_table'>Payment Date</td>
                          <td class='td_fine_show_table' style=''>Fee Group</td>
                          <td class='td_fine_show_table' >Amount</td>
                        
                          </tr>
                          ";
$studentdepositfee=mysql_query("SELECT * FROM finanacepaystudentfees WHERE studentsrno='$feepaystudentsrno' and studentadmissionno='$feepaystudentadmissionno'
     and thisclass='$whichclass' and thissessionyear='$sessionyear' and feesgroup='$feesgroupname'");
  $row=0;
  $studentdepositfeepayment=0;
  if($studentdepositfeepayment=="0")
  {
     
  }
  $depositquantity=0;
 while($depositsamountthis=mysql_fetch_array($studentdepositfee))
 {
    $row++;
    $fetchdepositpaymentdate=$depositsamountthis['paymentdate'];
    $fetchdepositfeegroup=$depositsamountthis['feesgroup'];
    $fetchdepositamount=$depositsamountthis['amountpaid'];
                 echo "<tr style=''>
                 <td class='td_fetchfine'>$row</td>
                 <td class='td_fetchfine'>$fetchdepositpaymentdate</td>
                 <td class='td_fetchfine' style='padding-left:5px; padding-right:5px;'>$fetchdepositfeegroup</td>
                 <td class='td_fetchfine'>$fetchdepositamount</td>
                 </tr>"; 
                 
                 $studentdepositfeepayment +=$fetchdepositamount;
                 $depositquantity++;
 }     
 if(empty($fetchdepositpaymentdate))
 {
                  echo "<tr>
<td colspan='4' style='background-color:skyblue;'>No Deposit Fee</td>                      
</tr>";    
 }         
              echo "
                   </tr>
                          <tr>
                          <td colspan='3' class='td_fine_show_tabletotal' style='text-align:right;'>Total Deposit Fees :</td>
                          <td class='td_fine_show_tabletotal'> $studentdepositfeepayment</td>
                          </tr>";           
                           echo "
                          </table>     
                          </div>
                               
</td>";
             $feepaymentmethod=$_REQUEST['feespaymethod'];
             $feesgroupname=$_REQUEST['feesgroupname'];
             $whichclass=$_REQUEST['setclass'];
             $sessionyear=$_REQUEST['setsessionyear'];
             $feepaystudentsrno=$_REQUEST['studentsrno'];
             $feepaystudentadmissionno=$_REQUEST['studentadmissionno'];
                  echo "
                                <td id='yellowcolor' class='td_print_value'>$studentdepositfeepayment</td>
                                 <td id='yellowcolor' class='td_print_value'><input type='text' 
                            style='width:55px; color:gray; padding-left:2px;' 
             id='finequantity' readonly='readonly' value='$depositquantity'></td>
                                  
<td id='yellowcolor' class='td_print_value'>$studentdepositfeepayment<input type='hidden' id='addeddueamount' value='$studentdepositfeepayment'></td>
<td id='yellowcolor' class='td_print_value'>
<input type='checkbox' name='dueamountselected' value='$studentdepositfeepayment' id='dueamountchecked' checked disabled></td>                                    
<td id='yellowcolor' class='td_print_value' style='border-right:1px solid silver; color:red;'>No Modify</td>
                               </tr>";
                  
              //enddepositfeeprocess    
                
                  {
                   
                 
                  if(!empty($fetchalreadyvalue)&&($fetchalreadyvalue!=""))
                  {
                      
                  }else
                  {
                  
                       if(!empty($fetchstudentdiscount)){
                          $thisstudentduefinediscount=(($fetchfeesamount*$fetchstudentdiscount)/100); 
                      }else{
                            $thisstudentduefinediscount="0";
                            }
                      $totalfinalfees=(($totalpayfine+$fetchfeesamount+$fecthduesamounts)-$studentdepositfeepayment);
                      $feepayableamountannual=$fetchfeesamount-$studentdepositfeepayment;
                      $studentduefinedemposit=$totalpayfine;
                     
                     $finalamountpayablestudent=($totalfinalfees-$thisstudentduefinediscount);
                   ?>
                             <script type="text/javascript">
                      $(document).ready(function(){
                          $("#finalpaybleoutput").text("<?php  echo $totalfinalfees;?>");
                          $("#totalamountpayble").val("<?php  echo $feepayableamountannual;?>");
                          $("#totalfineamount").val("<?php  echo $studentduefinedemposit;?>");
                          $("#totalamountdiscount").val("<?php  echo $thisstudentduefinediscount;?>");
                          $("#thisisthefinaloutput").val("<?php  echo $finalamountpayablestudent;?>");
                          
                       });
                      </script> 
                    <?php 
                  }
                  }
                      ?>
                            <tr>
                                <td colspan="3" style=" background-color:white ; height:25px; text-align:right;font-size:12px; 
                                    border-bottom:1px solid silver; border-left:1px solid silver;  ">
                                    <div style=" width:290px; float:right;  ">
                                        <strong>Total Payable Amount</strong>  <strong style=" padding-left:5px; ">:</strong> 
                                       </div>
                                </td>
                                <td style=" background-color:white;font-size:12px; font-weight:bold;  color:brown;   text-align:center; border-bottom:1px solid silver;">
                                        <div id="finalpaybleoutput">0</div>
                                        
                                </td>
                                <td style=" background-color:white;font-size:12px; font-weight:bold;  color:brown;   text-align:center; border-bottom:1px solid silver;">
                                        
                                </td>
                                <td style=" background-color:white ;border-bottom:1px solid silver; border-right:1px solid silver; ">
                                    
                                </td>
                            </tr>
                        </table>   
                    </td>
                </tr>
            </table>
          <?php  
   }
               }
           
            }
            
            ?>
         
         
     <?php  
           //startfeemonthlyprocess
            if($fetchgrouptype=="term")
            { 
                
                
              if(!empty($_POST['payamount'])){  
              $addtrnumber=mysql_query("SELECT * FROM finanacepaystudentfees WHERE id order by id DESC");
              $fetchnumber=mysql_fetch_array($addtrnumber);
               if(!empty($fetchnumber))
               {
               $numberaddedITS=$fetchnumber['trnumber']; 
               $addedone="1";
               $numberadded=$numberaddedITS+$addedone;
               }else
               {
             $numberadded="1";
             
             }
             for($monthloop=1;$monthloop<=12;$monthloop++)
             $loopnumber=$_POST['loopcounted'];
             for($monthloop=1;$monthloop<=$loopnumber;$monthloop++)
               {
              $payfeestudentsrno=$_POST['payfeestudentsrnumber'];
              $payfeestudentadmissionnumber=$_POST['payfeestudentadmissionnumber'];
              $payfeestudentclass=$_POST['payfeestudentclass'];
              $particulerfees=$_POST["particularfees$monthloop"];
              $particularfine=$_POST["particularfine$monthloop"];
              $payfeestudentsessionyear=$_POST['payfeestudentsessionyear'];
              $payfeesgroupnamethis=$_POST['payfeesgroupname'];
              $payfeefeepayblevalue=$_POST['feepayablevalue'];
              $payfeefinepayablevalue=$_POST['finepayablevalue'];
              $payfeetodaydate=$_POST['payafeetodaydate'];
              $payfeesdiscount=$_POST['discount'];
              $payfeesdiscountamount=$_POST['discountamount'];
              $payfeespaymentinfo=$_POST['paymentinfo'];
              $payfeespaymentdescription=$_POST['feedescription'];
              $payfeesamountpayable=$_POST['totalamountpayable'];
              $payfeespaymentmode=$_POST['paymentmode'];
             if($payfeespaymentmode=="cash")
              {
                $payfeesbankname="----------"; 
                $payfeeschequeddno="----------"; 
              $payfeeschequedddate="----------"; 
              $payfeeschequeddamount="0.0"; 
              $status="CLEARED";
              }  else {
                  $payfeesbankname=$_POST['bankname'];
                  $payfeeschequeddno=$_POST['chequeddnumber'];
              $payfeeschequedddate=$_POST['chequedddate'];
              $payfeeschequeddamount=$_POST['chequeddamount'];
               $status="PENDING";
              }
              
              $payfeesamountpaiod=$_POST['amountpaid'];
              $payfeesdueamount=$_POST['dueamount'];
              $paydiscountfine=$_POST['discountfine'];
              $paydescriptiondiscountfine=  nl2br($_POST['discriptiondiscountfine']);
              
              if(!empty($_POST["checkme$monthloop"]))
              {
              $paythismonthchecked=$_POST["checkme$monthloop"];
              $serviceenable="No";
              }else {
                    $paythismonthchecked="";
                    
                    }
               if(!empty($paythismonthchecked))
               {
              if(($payfeestudentsrno!="")&&($payfeestudentadmissionnumber!="")&&($payfeestudentclass!="")&&($payfeestudentsessionyear!="")&&($payfeesamountpaiod!=""))
              {
                  require_once '../connection.php';
                $selectmatchthisfeealreadypay=mysql_query("SELECT * FROM finanacepaystudentfees WHERE studentsrno='$payfeestudentsrno'
                        and studentadmissionno='$payfeestudentadmissionnumber' and thisclass='$payfeestudentclass'
                        and thissessionyear='$payfeestudentsessionyear' and feesgroup='$payfeesgroupnamethis' and feepaymonth='$paythismonthchecked'");  
                $fetchpaymentdetail=mysql_fetch_array($selectmatchthisfeealreadypay);
              if(empty($fetchpaymentdetail))
                {
                
               if(!empty($_POST['dueamountselected']))
               {
                 $deletedfine=mysql_query("DELETE FROM financestudentduefine WHERE studentsrno='$payfeestudentsrno'
                         and studentadmissionno='$payfeestudentadmissionnumber'"); 
                 if($deletedfine)
                 {}}    
               $insertedpaymentdetails=mysql_query("INSERT into finanacepaystudentfees values('','$numberadded','$payfeestudentsrno'
                       ,'$payfeestudentadmissionnumber','$payfeestudentclass','$payfeestudentsessionyear'
                       ,'$payfeetodaydate','$payfeesgroupnamethis','$paythismonthchecked','$particulerfees','$particularfine','','$serviceenable','$payfeefeepayblevalue','$payfeefinepayablevalue'
                       ,'$paydiscountfine','$paydescriptiondiscountfine','$payfeesdiscount','$payfeesdiscountamount','$payfeespaymentinfo','$payfeespaymentdescription'
                       ,'$payfeesamountpayable','$payfeespaymentmode','$payfeesbankname','$payfeeschequeddno'
                       ,'$payfeeschequedddate','$payfeeschequeddamount','$payfeesdueamount','$payfeesamountpaiod','$status')");
}}}}



             if(!empty($insertedpaymentdetails))
               {
                if(($payfeesdueamount!="0")&&($payfeesamountpaiod!=""))
                {   
                $insertstudentdueamount=mysql_query("INSERT into financestudentduefine values('','$numberadded','$payfeestudentsrno'
                        ,'$payfeestudentadmissionnumber','$payfeestudentclass','$payfeestudentsessionyear'
                        ,'$payfeesgroupnamethis','$payfeetodaydate','$payfeesdueamount')");
                 if(!empty($insertstudentdueamount))
                 {
                     
                 }else
                 {
                $deletedfine=mysql_query("DELETE FROM finanacepaystudentfees WHERE trnumber='$numberadded'"); 
                 if($deletedfine)
                 {
                     if(!empty($_POST['dueamountselected']))
                     {
                     $duepaymenterrorcodeduepayment=$_POST['dueamountselected'];
                     $insertstudentdueamount=mysql_query("INSERT into financestudentduefine values('','$numberadded','$payfeestudentsrno'
                        ,'$payfeestudentadmissionnumber','$payfeestudentclass','$payfeestudentsessionyear'
                        ,'$payfeesgroupnamethis','$payfeetodaydate','$duepaymenterrorcodeduepayment')");
                     }
                     echo '
        <script type="text/javascript">
         $(document).ready(function(){
alert("Request Failed........Try Again");    
return false;
});
         </script>
                         ';
                 }
                }     
                 }   
                 echo '
            
        <script type="text/javascript">
         $(document).ready(function(){
alert("Payment Process Succesfully Complete"); 
return false;
});
         </script>
                         ';
               }}
               
               
               
               
               echo' 
         <table style=" width:665px; margin:0 auto; font-size:12px; 
                margin-top:10px;height:45px; background-color:whitesmoke; border:1px solid silver;    ">
             <tr>
             <td colspan="4" style=" color:maroon; ">Termly</td>
             </tr>
             <tr>
<td>

';
               $fetchgroupdb=mysql_query("SELECT * FROM financeaddfeegroup WHERE feegroupname='$feesgroupname' and feegrouptype='$fetchgrouptype' and sessionyear='$sessionyear' order by encryptdate ASC");
              $numbercheck=1;
              while($fetchmonth=mysql_fetch_array($fetchgroupdb))
              {    
$fetchincmonth=$fetchmonth['monthlyofmonth'];               
date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$todaydate=date("Y/m/d");
                 
                 $todaydatevalue=strtotime($todaydate);
                 $encryptfetchtodaydate=ceil($todaydatevalue/60/60/24);
                 $fetchfeeduedate=$fetchmonth['collectfeeduedate'];
                 $itemtodaydatefrom=strtotime($fetchfeeduedate);
                 $encryptfetchduedate=ceil($itemtodaydatefrom/60/60/24); 
              $feepaymentmethod=$_REQUEST['feespaymethod'];
             $feesgroupname=$_REQUEST['feesgroupname'];
             $whichclass=$_REQUEST['setclass'];
             $sessionyear=$_REQUEST['setsessionyear'];
             $feepaystudentsrno=$_REQUEST['studentsrno'];
             $feepaystudentadmissionno=$_REQUEST['studentadmissionno'];
                echo "
                     <div style='width:80px; height:25px;  float:left;'> 
                    <table><tr>
                 <td>
                 ";     
          $selectfinanacepaymentdatabase=mysql_query("SELECT * FROM finanacepaystudentfees WHERE studentsrno='$feepaystudentsrno'
                        and studentadmissionno='$feepaystudentadmissionno' and thisclass='$whichclass'
                        and thissessionyear='$sessionyear' and feesgroup='$feesgroupname' and feepaymonth='$fetchincmonth'");  
                $matchthidvaluedatabase=mysql_fetch_array( $selectfinanacepaymentdatabase);        
                
                if(empty($matchthidvaluedatabase))
                 {
                 if($encryptfetchduedate<$encryptfetchtodaydate)
                 {
                 $subtratdueday=round($encryptfetchtodaydate-$encryptfetchduedate);
                 
                 }else
                 {
                  $subtratdueday=0;   
                 }
                
                 {
                     ?>
                <script type='text/javascript'>
               $(document).ready(function(){
                $('#checkmonth'+<?php  echo $numbercheck;?>+'').click(function(){
                 var checkboxvalue=$(this).val();
                
                 var amountpayble=$('#totalamountpayble').val();
                 
                 var thismonthaddvalue=$('#thismonthfeesinclude'+<?php  echo $numbercheck;?>+'').val();
                 var thismonthfine=$('#thismonthfine'+<?php  echo $numbercheck;?>+'').val();
                 if(thismonthfine!=0)
                     {
                      var fineaddone=1;
                      var finequantity=$('#finequantity').val();
                      var finemonthname=checkboxvalue;
                     }else
                         {  
                       var fineaddone=0;
                       var finequantity=$('#finequantity').val();
                        var finemonthname="";
                         }
                 var finequantityvalue=new Number(finequantity);
              
                 var thismonthduefine=new Number(thismonthfine);
                 var finerate="<?php  echo $fetchfeesfineamount;?>";
                 var totalamountfine=(thismonthduefine*finerate);
                 var totalfinepayble=$('#totalfineamount').val();
                 var finepayblethis=new Number(totalfinepayble);
                 
                 var a=new Number(amountpayble);
                 
                 var b=new Number(thismonthaddvalue);
                 
                 var feeq=1;
                 
                 var dc=$('#feequantity').val();
                 var feeqvalue=new Number(dc);
                  if($('#dueamountchecked').attr('checked'))
                 {
                    var addeddueamount=$("#addeddueamount").val();
                  var convertednumberits=new Number(addeddueamount);  
                 }else{
                     var convertednumberits='' 
                 }
                
                     
                if($('#checkmonth'+<?php  echo $numbercheck;?>+'').attr('checked'))
                 {
                     
                 var discountamountthis="<?php  if(!empty($feediscountinamount)){ echo $feediscountinamount;} ?>";
                 var newnumberadded=new Number(discountamountthis);
                 var feediscount=$("#totalamountdiscount").val();
                 var finediscountamount=new Number(feediscount);
                 var thisisafinaloutputindiscount=(newnumberadded+finediscountamount)
                 $("#totalamountdiscount").val(thisisafinaloutputindiscount);
                 
                 var totalpaymentadded=a+b;
                 var totalamountfinepayble=finepayblethis+totalamountfine;
                 var feequantity=feeqvalue+feeq;
                 var totalfinequantity=finequantityvalue+fineaddone;
                 $('#totalamountpayble').val(totalpaymentadded);
                 
                 $('#totalamount').html(totalpaymentadded);
                 
                 $('#p'+<?php  echo $numbercheck;?>+'').html(checkboxvalue+',');
                 $('#pf'+<?php  echo $numbercheck;?>+'').html(finemonthname+',');
                 $('#feequantity').val(feequantity);
                 
                 $('#finequantity').val(totalfinequantity);
                 
                 $('#totalfineamount').val(totalamountfinepayble);
                 
                 $('#totalfineamountis').html(totalamountfinepayble);
                 
                 var feepayblerupease=totalpaymentadded+totalamountfinepayble+convertednumberits;
                 $("#finalpaybleoutput").html(feepayblerupease);
                 var discountsubtract=(feepayblerupease-thisisafinaloutputindiscount)
                 $("#thisisthefinaloutput").val(discountsubtract);
                 }else
                 {
                  var discountamountthis="<?php  if(!empty($feediscountinamount)){ echo $feediscountinamount;} ?>";
                 var newnumberadded=new Number(discountamountthis);
                 var feediscount=$("#totalamountdiscount").val();
                 var finediscountamount=new Number(feediscount);
                 var thisisafinaloutputindiscount=(finediscountamount-newnumberadded)
                 $("#totalamountdiscount").val(thisisafinaloutputindiscount);    
                 
                 var totalpaymentadded=a-b;
                  var feequantity=feeqvalue-feeq;
                  var totalamountfinepayble=finepayblethis-totalamountfine;
                  var totalfinequantity=finequantityvalue-fineaddone;
                 $('#totalamountpayble').val(totalpaymentadded );
                 $('#totalamount').html(totalpaymentadded);
                 $('#p'+<?php  echo $numbercheck;?>+'').html('');
                 $('#pf'+<?php  echo $numbercheck;?>+'').html('');
                 $('#feequantity').val(feequantity);
                 $('#finequantity').val(totalfinequantity);
                  $('#totalfineamount').val(totalamountfinepayble);
                  $('#totalfineamountis').html(totalamountfinepayble);
                  var feepayblerupease=totalpaymentadded+totalamountfinepayble+convertednumberits;
                 $("#finalpaybleoutput").html(feepayblerupease);
                  var discountsubtract=(feepayblerupease-thisisafinaloutputindiscount)
                $("#thisisthefinaloutput").val(discountsubtract);
                 }
                 
                 
                 
                 
                 }); });
</script>
<?php 
                 }
                 $fineamountthisparticular=$subtratdueday*$fetchfeesfineamount;
                 echo "
                 </td>
                 
                 <td style='width:8px;'>
                 <input type='checkbox' name='checkme$numbercheck' id='checkmonth$numbercheck' value='$fetchincmonth'>
                 <input type='hidden' id='thismonthfeesinclude$numbercheck' value='$fetchfeesamount'>
                 <input type='hidden' id='thismonthfine$numbercheck' value='$subtratdueday'>
       <input type='hidden' name='particularfees$numbercheck' value='$fetchfeesamount'>
       <input type='hidden' name='particularfine$numbercheck' value='$fineamountthisparticular'>
                 
                 </td><td style='width:52px;  float:left; text-align:left;'>$fetchincmonth</td>";    
               
              }else
              {
                  echo "
                      
                 <td style='width:18px;'>
       <input type='hidden' name='particularfees$numbercheck' value='0'>
                  <input type='hidden' name='particularfine$numbercheck' value='0'>         
                 <input type='checkbox'  value='$fetchincmonth' checked disabled>
                 </td><td style=''width:52px;  float:left; text-align:left;'>$fetchincmonth</td>";      
              }
               $numbercheck++; 
               echo "
        </tr></table>
        </div>";
              }
               $finalnumber=$numbercheck-1;
              echo "<input type='hidden' name='loopcounted' value='$finalnumber'>";
              
              {
           ?>  

         </td>
             </tr>
             
         </table>
         
            <table cellspacing="0" cellpadding="0" style=" width:600px;  margin-top:10px; margin-left:40px;  padding-left:5px;   ">
                <tr>
                    <td  class="td_leftpaddingth" style=" padding-left:15px;  color:white; font-size:12px;   font-weight:bold;  
                                        height:20px; background-image:url('finanacephoto/bgblack.png'); ">Fee Amount</td>
                </tr>
                <tr>
                    <td>
                        <table cellspacing="0" cellpadding="0" style=" width:100%; ">
                            <tr>
                                <td class="td_table_head">
                                 Fee    
                                </td>
                                <td class="td_table_head">
                                 Amount    
                                </td>
                                <td class="td_table_head">
                                 Quantity   
                                </td>
                                <td class="td_table_head">
                                Specific Month  
                                </td>
                                <td class="td_table_head">
                                Total Amount   
                                </td>
                                <td class="td_table_head">
                               Select  
                                </td>
                                <td class="td_table_head" style=" border-right:1px solid silver; ">
                                Modify   
                                </td>
                            </tr>
                          <?php 
                           echo "<tr>
                               <td class='td_print_value'>$feesname</td>
                                <td class='td_print_value'>$fetchfeesamount</td>
                                 <td class='td_print_value'><input type='text' 
                            style='width:55px; color:gray; padding-left:2px;' id='feequantity' readonly='readonly' value='0'></td>
                                  <td class='td_print_value' style='width:200px;'>
<p id='p1' class='p'></p><p id='p2' class='p'></p><p id='p3' class='p'></p><p id='p4' class='p'></p><p id='p5' class='p'></p><p id='p6' class='p'></p>
<p id='p7' class='p'></p><p id='p8' class='p'></p><p id='p9' class='p'></p><p id='p10' class='p'></p><p id='p11' class='p'></p><p id='p12' class='p'></p>
<p id='p13' class='p'></p><p id='p14' class='p'></p><p id='p15' class='p'></p><p id='p16' class='p'></p><p id='p17' class='p'></p>
<p id='p18' class='p'></p><p id='p19' class='p'></p><p id='p20' class='p'></p><p id='p21' class='p'></p><p id='p22' class='p'></p>
<p id='p23' class='p'></p><p id='p24' class='p'></p><p id='p25' class='p'></p><p id='p26' class='p'></p><p id='p27' class='p'></p>
<p id='p28' class='p'></p><p id='p29' class='p'></p><p id='p30' class='p'></p><p id='p31' class='p'></p><p id='p32' class='p'></p>
<p id='p33' class='p'></p><p id='p34' class='p'></p><p id='p35' class='p'></p><p id='p36' class='p'></p>
                            
                            </td>
                            <td class='td_print_value'><div id='totalamount' style='text-align:center;'>0</div></td>
                            <td class='td_print_value'><input type='checkbox' checked disabled></td>
                                    <td class='td_print_value' style='border-right:1px solid silver; color:red;'>No Modify</td>
                               </tr>";
                            ?>  
                          <?php 
                           echo "<tr>
                               <td class='td_print_value'><div id='showfine'>Fine</div>
                               <div class='showfinedetails'>
                          <table cellspacing='0' cellpadding='0' style='width:100%; '>
                          <tr>
                           <td class='fineheader' colspan='3'>Termly Fee</td>  <td class='fineheader'>$todaydate</td>                        
                             </tr>
                          <tr>
                          <td class='td_fine_show_table'>Term</td>
                          <td class='td_fine_show_table'>Start Date</td>
                          <td class='td_fine_show_table'>Due Date</td>
                          <td class='td_fine_show_table'>No Of Due Day</td>
                          </tr>
                          ";
                  $sessionyear=$_REQUEST['setsessionyear']; 
                  $feepaystudentsrno=$_REQUEST['studentsrno'];
             $feepaystudentadmissionno=$_REQUEST['studentadmissionno'];
             $feesgroupname=$_REQUEST['feesgroupname'];    
$fetchgroupdb=mysql_query("SELECT * FROM financeaddfeegroup WHERE feegroupname='$feesgroupname'
        and feegrouptype='$fetchgrouptype' and sessionyear='$sessionyear' order by encryptdate ASC");
              $numbercheck=1;
               $adddedtotaldays=0;
              while($fetchmonth=mysql_fetch_array($fetchgroupdb))
              {    
$fetchincmonth=$fetchmonth['monthlyofmonth']; 
$selectmonthmarch=mysql_query("SELECT * FROM finanacepaystudentfees WHERE studentsrno='$feepaystudentsrno' and
       studentadmissionno='$feepaystudentadmissionno' and feesgroup='$feesgroupname' and feepaymonth='$fetchincmonth'");
$fecthmatchmonth=mysql_fetch_array($selectmonthmarch);
$fetchstartdate=$fetchmonth['collectfeestartdate'];
$fetchduedate=$fetchmonth['collectfeeduedate'];
date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$todaydate=date("Y/m/d"); 
                 $todaydatevalue=strtotime($todaydate);
                 $encryptfetchtodaydate=ceil($todaydatevalue/60/60/24);
                 $fetchfeeduedate=$fetchmonth['collectfeeduedate'];
                 $itemtodaydatefrom=strtotime($fetchfeeduedate);
                 $encryptfetchduedate=ceil($itemtodaydatefrom/60/60/24);
if(empty($fecthmatchmonth))
{
                 if($encryptfetchduedate<$encryptfetchtodaydate)
                 {
                 $subtratdueday=round($encryptfetchtodaydate-$encryptfetchduedate);
                 
                 echo "<tr style=''>
                 <td class='td_fetchfine'>$fetchincmonth</td>
                 <td class='td_fetchfine'>$fetchstartdate</td>
                 <td class='td_fetchfine'>$fetchduedate</td>
                 <td class='td_fetchfine'>$subtratdueday</td>
                 </tr>";
                 
                 }else
                 {
                  $subtratdueday=0;   
                 }
                 
               $adddedtotaldays +=$subtratdueday; 
              }
              }
              if($adddedtotaldays=="0")
              {
                  echo "<tr>
<td colspan='4' style='background-color:skyblue;'>No Due Fine</td>                      
</tr>";    
              }
              echo "
                   </tr>
                          <tr>
                          <td colspan='3' class='td_fine_show_tabletotal' style='text-align:right;'>Total No Of Due Day :</td>
                          <td class='td_fine_show_tabletotal'>$adddedtotaldays</td>
                          </tr>";           
                           echo "
                          </table>     
                          </div>
                               
</td>
                                <td class='td_print_value'>$fetchfeesfineamount</td>
                                 <td class='td_print_value'><input type='text' 
                            style='width:55px; color:gray; padding-left:2px;' id='finequantity' readonly='readonly' value='0'></td>
<td class='td_print_value'><p id='pf1' class='p'></p><p id='pf2' class='p'></p><p id='pf3' class='p'></p><p id='pf4' class='p'></p><p id='pf5' class='p'></p>
<p id='pf6' class='p'></p><p id='pf7' class='p'></p><p id='pf8' class='p'></p><p id='pf9' class='p'></p><p id='pf10' class='p'></p><p id='pf11' class='p'></p><p id='pf12' class='p'></p>
<p id='pf13' class='p'></p> <p id='pf14' class='p'></p> <p id='pf15' class='p'></p> <p id='pf16' class='p'></p>  <p id='pf17' class='p'></p>
<p id='pf18' class='p'></p><p id='pf19' class='p'></p><p id='pf20' class='p'></p><p id='pf21' class='p'></p><p id='pf22' class='p'></p>
<p id='pf23' class='p'></p><p id='pf24' class='p'></p><p id='pf25' class='p'></p><p id='pf26' class='p'></p><p id='pf27' class='p'></p>
 <p id='pf28' class='p'></p><p id='pf29' class='p'></p><p id='pf30' class='p'></p><p id='pf31' class='p'></p><p id='pf32' class='p'></p>
<p id='pf33' class='p'></p><p id='pf34' class='p'></p>  <p id='pf35' class='p'></p>   <p id='pf36' class='p'></p>         
                                </td>
<td class='td_print_value'><div id='totalfineamountis' style='text-align:center;'>0</div></td>
<td class='td_print_value'><input type='checkbox' checked disabled></td>                                    
<td class='td_print_value' style='border-right:1px solid silver; color:red;'><div id='addfine'><strong>Add</strong></div>
<div id='modified' style='color:blue; display:none;'>No Modify</div>
</td>
                               </tr>";
                           
                            ?>
            <?php 
$fecthisstudentarresduesamount=mysql_query("SELECT * FROM financestudentduefine WHERE studentsrno='$feepaystudentsrno' and studentadmissionno='$feepaystudentadmissionno'
     and studentclass='$whichclass' and studentsessionyear='$sessionyear'");
 $fecthduesamounts=0;
 $quantity=0;
 while ($fetchduesamount=mysql_fetch_array($fecthisstudentarresduesamount))
 {
     $fetchduethisamount=$fetchduesamount['duepayment'];
   $quantity++;
   $fecthduesamounts +=$fetchduethisamount;  
 }
  if($fecthduesamounts>0)
 {
     $paymentname="Due Fee";
     $positivevalue=$fecthduesamounts;
 }else
 {
  $paymentname="Paid Fee";
  $positivevalue=abs($fecthduesamounts);
 }
                           echo "<tr>
                               <td class='td_print_value'><div id='showduefine'>$paymentname</div>
                               <div class='showduefinedetails'>
                          <table cellspacing='0' cellpadding='0' style='width:100%; '>
                          <tr>
         <td class='fineheader' colspan='5'>Previous $paymentname</td>  <td class='fineheader'>$todaydate</td>                        
                             </tr>
                          <tr>
                          <td class='td_fine_show_table'>Sl.No</td>
                          <td class='td_fine_show_table'>Payment Date</td>
                          <td class='td_fine_show_table'>Fee Group</td>
                          <td class='td_fine_show_table'>Due Amount</td>
                         <td class='td_fine_show_table'>Fine Amount</td>
                          <td class='td_fine_show_table'>Total Amount</td>
                          </tr>
                          ";
 $fecthisstudentarresduesamount=mysql_query("SELECT * FROM financestudentduefine WHERE studentsrno='$feepaystudentsrno' and studentadmissionno='$feepaystudentadmissionno'
 and studentclass='$whichclass' and studentsessionyear='$sessionyear'");
 $row=0;
  $totaldueamountpayable=0;
 while ($fetchduesamountthis=mysql_fetch_array($fecthisstudentarresduesamount))
 {
    $row++;
    $fetchtrnumber=$fetchduesamountthis['trnumber'];
    $fetchduepaymentdate=$fetchduesamountthis['feespaymentdate'];
    $fetchduefeegroup=$fetchduesamountthis['feesgroup'];
    $fetchdueamount=$fetchduesamountthis['duepayment'];
    $studentcheckthismonthduefine=mysql_query("SELECT * FROM finanacepaystudentfees WHERE trnumber='$fetchtrnumber' order by id DESC");
    $trnumberfetchmonth=  mysql_fetch_array($studentcheckthismonthduefine);
    if(!empty($trnumberfetchmonth))
    {
    $monthofmonthfecth=$trnumberfetchmonth['feepaymonth'];
    $feesgroupdbduedate=mysql_query("SELECT * FROM financeaddfeegroup WHERE feegroupname='$fetchduefeegroup'
    and monthlyofmonth='$monthofmonthfecth'");
   $fetchfeegroupdetail=mysql_fetch_array($feesgroupdbduedate);
   if(!empty($fetchfeegroupdetail))  
   {
                                 $fetchthisfeemonth=$fetchfeegroupdetail['monthlyofmonth'];
                                 $thisfetchfeesname=$fetchfeegroupdetail['feename'];
                                 $thisfetchfeesgroup=$fetchfeegroupdetail['feegroupname'];
                                 $thisfetchgrouptype=$fetchfeegroupdetail['feegrouptype'];
                                 $thisfetchstartfeecollectdate=$fetchfeegroupdetail['collectfeestartdate'];
 $thisfeesduedate=$fetchfeegroupdetail['collectfeeduedate'];
date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$todaydate=date("Y/m/d");
                 $todaydatevalue=strtotime($todaydate);
                 $encryptfetchtodaydate=ceil($todaydatevalue/60/60/24);
                 $itemtodaydatefrom=strtotime($thisfeesduedate);
                 $encryptfetchduedate=ceil($itemtodaydatefrom/60/60/24);
                 
                 $itemduedatedatefrom=strtotime($fetchduepaymentdate);
                 $encryptfetchduedatepayment=ceil($itemduedatedatefrom/60/60/24);
                 
                  if($encryptfetchduedate<$encryptfetchtodaydate)
                 {
                 $duepaymentdateamountrate=round($encryptfetchtodaydate-$encryptfetchduedatepayment);
                 
                 }else
                 {
                  $duepaymentdateamountrate=0;   
                 } 
                 
                $selectfeeamountdb=mysql_query("SELECT * FROM financefeeamount WHERE
                         addfeesname='$thisfetchfeesname' and feegrouptype='$thisfetchgrouptype'
                         and feesgroupname='$thisfetchfeesgroup' and feesetclass='$whichclass'");

                           $fetchfeesamountmonthandyear=mysql_fetch_array($selectfeeamountdb);
                           if(!empty($fetchfeesamountmonthandyear))
                           {
                             
                             $duefeesfineamounts=$fetchfeesamountmonthandyear['fineamount'];
                             $duefineamountfinal=$duepaymentdateamountrate*$duefeesfineamounts;
                           }else
                           {
                           $duefineamountfinal="0";    
                           }  
                 
                 }
                 else
                     {
                     $duefineamountfinal="0";
                     }
    }else
    {
     $duepaymentdateamountrate="0"; 
     $duefineamountfinal="0";
    }
                
                         
                 $finaltotaldueamount=$fetchdueamount+$duefineamountfinal;
                 
    
    
                 echo "<tr style=''>
                 <td class='td_fetchfine'>$row</td>
                 <td class='td_fetchfine'>$fetchduepaymentdate</td>
                 <td class='td_fetchfine'>$fetchduefeegroup</td>
                 <td class='td_fetchfine'>$fetchdueamount</td>
                 <td class='td_fetchfine'>$duefineamountfinal</td>
                 <td class='td_fetchfine'>$finaltotaldueamount</td>
                 </tr>"; 
                 
                $totaldueamountpayable +=$finaltotaldueamount;
 }     
 if(empty($fetchduepaymentdate))
 {
                  echo "<tr>
<td colspan='6' style='background-color:skyblue;'>No Due Fee</td>                      
</tr>";    
 }         
              echo "
                   </tr>
                          <tr>
                          <td colspan='5' class='td_fine_show_tabletotal' style='text-align:right;'>Total Due Amount :</td>
                          <td class='td_fine_show_tabletotal'> $totaldueamountpayable</td>
                          </tr>";           
                           echo "
                          </table></div></td>";
                           
                                
                          
                               
             $feepaymentmethod=$_REQUEST['feespaymethod'];
             $feesgroupname=$_REQUEST['feesgroupname'];
             $whichclass=$_REQUEST['setclass'];
             $sessionyear=$_REQUEST['setsessionyear'];
             $feepaystudentsrno=$_REQUEST['studentsrno'];
             $feepaystudentadmissionno=$_REQUEST['studentadmissionno'];
                  echo "
                                <td class='td_print_value'>$totaldueamountpayable</td>
                                 <td class='td_print_value'><input type='text' 
                            style='width:55px; color:gray; padding-left:2px;' id='finequantity' readonly='readonly' value='$quantity'></td>
                                  <td class='td_print_value'>
                                  </td>
<td class='td_print_value'>$totaldueamountpayable<input type='hidden' id='addeddueamount' value='$totaldueamountpayable'></td>
<td class='td_print_value'><input type='checkbox' name='dueamountselected' value='$totaldueamountpayable' id='dueamountchecked' checked></td>                                    
<td class='td_print_value' style='border-right:1px solid silver; color:red;'>No Modify</td>
                               </tr>";
                  
                           
                            
                           {
                            ?>
                            
                            <tr>
                                <td colspan="5" style=" background-color:white ; height:25px; text-align:right;font-size:12px; 
                                    border-bottom:1px solid silver; border-left:1px solid silver;  ">
                                    <div style=" width:290px; float:right;  ">
                                        <strong>Total Payable Amount</strong>  <strong style=" padding-left:5px; ">:</strong> 
                                       </div>
                                </td>
                                <td style=" background-color:white;font-size:12px; font-weight:bold;  color:brown;   text-align:center; border-bottom:1px solid silver;">
                                        <div id="finalpaybleoutput">0</div>
                                        
                                </td>
                                <td style=" background-color:white ;border-bottom:1px solid silver; border-right:1px solid silver; ">
                                    
                                </td>
                            </tr>
                        </table>   
                    </td>
                </tr>
            </table>
          <?php 
               }
           }
           }
           ?>
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
            <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
         <legend><span style=" color: maroon;  ">Payment Details</span></legend>
         
         <table cellspacing="0" style=" width:100%; padding-left:3px;  ">
             <tr>
                 <td style='height:25px;'>
                  Fee Payable <sup style=" color:red; ">*</sup>  
                 </td><td style='width:10px;'><strong>:</strong></td>
                 <td>
                     <input type='text' readonly='readonly' name='feepayablevalue' class='text_box_size_same'
                            id='totalamountpayble' value='0'>
                 </td>
                  <td>
                Fine Payable   
                 </td><td style='width:10px;'><strong>:</strong></td>
                 <td>
                     <input type='text' readonly='readonly' name='finepayablevalue' class='text_box_size_same' 
                            id='totalfineamount'
                     value='0'>
                 </td>
             </tr>  
             <tr>
                 <td style='height:25px;'>
                  Discount in %  
                 </td><td style='width:10px;'><strong>:</strong></td>
                 <td>
                     <input type='text' readonly='readonly' name='discount' class='text_box_size_same'
                            id='totalamountdiscountinpercantage' value='<?php  if(!empty($fetchstudentdiscount)){ echo $fetchstudentdiscount;}else{
        echo "0";}?>'>
                 </td>
                  <td>
                 Discount Amount   
                 </td><td style='width:10px;'><strong>:</strong></td>
                 <td>
                     <input type='text' readonly='readonly' name='discountamount' class='text_box_size_same'
                            id='totalamountdiscount'
                            value='0'>
                 </td>
             </tr>
             <tr>
                 <td style='height:25px;'>
                 Payment Info  
                 </td><td style='width:10px;'><strong>:</strong></td>
                 <td>
                     <input type='text'  name='paymentinfo' class='text_box_size_same'
                            id='totalamount' value=''>
                 </td>
                  <td>
                  Fee Description 
                 </td><td style='width:10px;'><strong>:</strong></td>
                 <td rowspan='2'>
                     <textarea name="feedescription" style='width:150px; height:40px; '></textarea>
                 </td>
             </tr>
             <tr>
                 <td style='height:25px;'>
                <strong> Amount Payable </strong><sup style=" color:red; ">*</sup>  
                 </td><td style='width:10px;'><strong>:</strong></td>
                 <td>
               <input type='text'  name='totalamountpayable' readonly='readonly' class='text_box_size_same'
                            id='thisisthefinaloutput' value='0'>
                 </td>
                 
             </tr>
             <tr>
                 <td style='height:35px; padding-top: 10px;'>
                 Payment Mode <sup style=" color:red; ">*</sup>  
                 </td><td style='width:10px;'><strong>:</strong></td>
                 <td>
                     <select class='select_box' name='paymentmode' id='selectpaymenttype'>
                         <option value='cash'>CASH</option>
                         <option value='cheque'>CHEQUE</option>
                         <option value='dd'>DD</option>
                     </select>
                 </td>
                 
             </tr>
        <tr>
                 <td colspan='6'>
                     <fieldset id='showchequeanddddetails' style='display:none;'
                               style='font-size:12px; font-weight:500;margin-left:-2px;
                               margin-top:5px;    text-align:left;'>
         <legend><span style=' color: maroon; '>CHEQUE/DD Details</span></legend>
                     <table style='width:100%; height:100px; '>
                         <tr>
                         <td >Bank Name</td><td style='width:10px;'><strong>:</strong></td>
                         <td colspan="4">
                             <select id="selectbankname" name='bankname'>
        <option value="">--Select Bank Name--</option>
	<option>Abhyudaya Co-Op Bank Ltd</option>
	<option>Abu Dhabi Commercial Bank</option>
	<option>Ahmedabad Mercantile Co-Op Bank Ltd</option>
	<option>Allahabad Bank</option>
	<option>Almora Urban Co-Operative Bank Ltd</option>
	<option>Andhra Bank</option>
	<option>Andhra Pragathi Grameena Bank</option>
	<option>Apna Sahakari Bank Ltd</option>
	<option>Austarlia and New Zealand Banking Gorup Ltd</option>
	<option>Axis Bank</option>
	<option>Bank Internasional Indonesia</option>
	<option>Bank Of America</option>
	<option>Bank Of Bahrain And Kuwait</option>
	<option>Bank Of Baroda</option>
	<option>Bank Of Ceylon</option>
	<option>Bank Of India</option>
	<option>Bank Of Maharashtra</option>
	<option>Bank Of Nova Scotia</option>
	<option>Bank Of Tokyo-Mitsubishi Ufj Ltd</option>
	<option>Barclays Bank Plc</option>
	<option>Bassein Catholic Co-Op Bank Ltd</option>
	<option>Bharat Co-Op Bank (Mumbai) Ltd</option>
	<option>Bnp Paribas</option>
	<option>Canara Bank</option>
	<option>Capital Local Area Bank Ltd</option>
	<option>Catholic Syrian Bank Ltd</option>
	<option>Central Bank Of India</option>
	<option>Chinatrust Commercial Bank</option>
	<option>Citibank</option>
	<option>Citizencredit Co-Op Bank Ltd</option>
	<option>City Union Bank Ltd</option>
	<option>Commonwealth Bank of Australia</option>
	<option>Corporation Bank</option>
	<option>Cosmos Co-Op Bank Ltd</option>
	<option>Credit Agricole Corp and Investment Bank</option>
	<option>Credit Suisse Ag</option>
	<option>Dbs Bank Ltd</option>
	<option>Dena Bank</option>
	<option>Deutsche Bank Ag</option>
	<option>Development Credit Bank Ltd</option>
	<option>Dhanlaxmi Bank Ltd</option>
	<option>Dicgc</option>
	<option>Dombivli Nagari Sahakari Bank Ltd</option>
	<option>Federal Bank Ltd</option>
	<option>Firstrand Bank Ltd</option>
	<option>Greater Bombay Co-Op Bank Ltd</option>
	<option>Gurgaon Gramin Bank</option>
	<option>Hdfc Bank Ltd</option>
	<option>Hsbc</option>
	<option>Icici Bank Ltd</option>
	<option>Idbi Bank Ltd</option>
	<option>Indian Bank</option>
	<option>Indian Overseas Bank</option>
	<option>Indusind Bank Ltd</option>
	<option>Ing Vysya Bank Ltd</option>
	<option>Jalgaon Janata Sahkari Bank Ltd</option>
	<option>Jammu And Kashmir Bank Ltd</option>
	<option>Janakalyan Sahakari Bank Ltd</option>
	<option>Janaseva Sahakari Bank Ltd Pune</option>
	<option>Janata Sahkari Bank Ltd Pune</option>
	<option>Jpmorgan Chase Bank</option>
	<option>Kallappanna Awade Ich Janata S Bank</option>
	<option>Kalupur Commercial Co Op Bank Ltd</option>
	<option>Kalyan Janata Sahakari Bank Ltd</option>
	<option>Kapole Co-Op Bank</option>
	<option>Karnataka Bank Ltd</option>
	<option>Karnataka State Co-Op Apex Bank Ltd</option>
	<option>Karnataka Vikas Grameena Bank</option>
	<option>Karur Vysya Bank</option>
	<option>Kotak Mahindra Bank</option>
	<option>Kurmanchal Nagar Sahakari Bank Ltd</option>
	<option>Lakshmi Vilas Bank Ltd</option>
	<option>Mahanagar Co-Op Bank Ltd</option>
	<option>Maharashtra State Co-Op Bank</option>
	<option>Mashreq Bank Psc</option>
	<option>Mehsana Urban Co-Op Bank Ltd</option>
	<option>Mizuho Corporate Bank Ltd</option>
	<option>Mumbai District Central Co-Op Bank Ltd</option>
	<option>Nagpur Nagarik Sahakari Bank Ltd</option>
	<option>Nainital Bank Ltd</option>
	<option>National Australia Bank</option>
	<option>New  India Co-Op  Bank  Ltd</option>
	<option>Nkgsb Co-Op Bank Ltd</option>
	<option>North Malabar Gramin Bank</option>
	<option>Nutan Nagarik Sahakari Bank Ltd</option>
	<option>Oman International Bank Saog</option>
	<option>Oriental Bank Of Commerce</option>
	<option>Parsik Janata Sahakari Bank Ltd</option>
	<option>Prathama Bank</option>
	<option>Prime Co-Operative Bank Ltd</option>
	<option>Punjab And Maharashtra Co-Op Bank Ltd</option>
	<option>Punjab And Sind Bank</option>
	<option>Punjab National Bank</option>
	<option>Rabobank International (CCRB)</option>
	<option>Rajkot Nagarik Sahakari Bank Ltd</option>
	<option>Ratnakar Bank Ltd</option>
	<option>Reserve Bank Of India</option>
	<option>Royal Bank Of Scotland</option>
	<option>Saraswat Co-Op Bank Ltd</option>
	<option>SBER Bank</option>
	<option>Shamrao Vithal Co-Op Bank Ltd</option>
	<option>Shinhan Bank</option>
	<option>Shri Chhatrapati Rajarshi Shahu Urban Co-Op Bank Ltd</option>
	<option>Societe Generale</option>
	<option>South Indian Bank</option>
	<option>Standard Chartered Bank</option>
	<option>State Bank Of Bikaner And Jaipur</option>
	<option>State Bank Of Hyderabad</option>
	<option>State Bank Of India</option>
	<option>State Bank Of Mauritius Ltd</option>
	<option>State Bank Of Mysore</option>
	<option>State Bank Of Patiala</option>
	<option>State Bank Of Travancore</option>
	<option>Sumitomo Mitsui Banking Corporation</option>
	<option>Surat Peoples Co-Op Bank Ltd</option>
	<option>Syndicate Bank</option>
	<option>Tamilnad Mercantile Bank Ltd</option>
	<option>Tamilnadu State Apex Co-Op Bank Ltd</option>
	<option>Thane Bharat Sahakari Bank Ltd</option>
	<option>Thane District Central Co-operative Bank Ltd</option>
	<option>Thane Janata Sahakari Bank Ltd</option>
	<option>The A.P. Mahesh Co-Op Urban Bank Ltd</option>
	<option>The Akola District Central Co-operative Bank</option>
	<option>The Gadchiroli District Central Co-operative Bank Ltd</option>
	<option>The Gujarat State Co-Operative Bank Ltd</option>
	<option>The Jalgaon Peoples Co-op Bank</option>
	<option>The Kangra Co-Operative Bank Ltd.</option>
	<option>The Karad Urban Co-Op Bank Ltd</option>
	<option>The Municipal Co-Operative Bank Ltd. Mumbai</option>
	<option>The Nasik Merchants Co-Op Bank Ltd</option>
	<option>The Rajasthan State Co-Operative Bank Ltd</option>
	<option>The Sahebrao Deshmukh Co-op Bank Ltd.</option>
	<option>The Seva Vikas Co-operative Bank Ltd</option>
	<option>The Surat District Co-Operative Bank Ltd</option>
	<option>The Sutex Co Op Bank Ltd</option>
	<option>The Varachha Co-Op. Bank Ltd</option>
	<option>The Vishweshwar Sahakari Bank Ltd Pune</option>
	<option>Tumkur Grain Merchants Cooperative Bank Ltd</option>
	<option>UBS AG</option>
	<option>Uco Bank</option>
	<option>Union Bank Of India</option>
	<option>United Bank Of India</option>
	<option>Vasai Vikas Sahakari Bank Ltd</option>
	<option>Vijaya Bank</option>
	<option>West Bengal State Co-Op Bank Ltd</option>
	<option>Westpac Banking Corporation</option>
	<option >Woori Bank</option>
	<option>Yes Bank Ltd</option>
        <option>Other Bank</option>
                             </select>
                         </td>
                         </tr>
                         <tr>
                         <td>Cheque/DD No</td><td style='width:10px;'><strong>:</strong></td>
                         <td>
                        <input type='text' name='chequeddnumber' id="chequeddno"  class='text_box_size_same'>
                         </td>
                         <td>Cheque/DD Date</td><td style='width:10px;'><strong>:</strong></td>
                         <td>
                          <div id="outputcalender"></div>
                        <input type='text' name='chequedddate' id="chequedddate"  class='text_box_size_same'>
                        
                         </td>
                         <td><div id="inputdate"></div></td>
                         </tr>
                         <tr>
                         <td colspan='2'>Cheque/DD Amount</td>
                         <td>
                     <strong>:</strong> <input type='text' autocomplete="off" value="0.0"
                                               id="chequeddamount" name='chequeddamount' class='text_box_size_same'>
                         </td>
                         
                         </tr>
                     </table></fieldset>
                 </td>
       
             </tr>
             <tr>
                 <td style='height:8px;  '>
                     
                 </td>
             </tr>
             <tr>
                 <td style=' height:30px; text-align:center;  background-color:whitesmoke;   '>
                     <strong>Amount Paid</strong></td>
                 <td style='width:10px;  height:30px; background-color:whitesmoke;   '><strong>:</strong></td>
                 <td style=' height:30px; background-color:whitesmoke;   '>
                     <input type='text' name="amountpaid" autocomplete="off" id='amountpaidvalue' class='text_box_size_same'>
                     <input type="hidden" name="dueamount" id="dueamount" value="0">
                   
                 </td>
                 
           <td colspan='4' style=' height:100%; margin-bottom:5px;  background-color:whitesmoke;   '></td>

             </tr>
             <tr>
                 <td colspan='6' style=' padding-top:10px; '>
                 <input type='submit' name='reset' class='addpayamount_reset_button' value='Reset'>
                 <input type='submit' class='addpayamount_reset_button'  id="payamount" name='payamount' onclick='myFunction()' value='Pay Amount'>
                 </td>
             </tr>
         </table>
         </fieldset>
        </div>
    </body>
</html>
