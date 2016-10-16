<?php 
session_start(); 
ob_start();
?>
<?php 
require_once '../connection.php';
if(isset($_SESSION['finance_module']))
{
$user_unique_id=$_SESSION['finance_module'];
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
$fetch_currency=$fetch_org_data['currency'];

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
  $check_array_in="account";
  $search_match_module= in_array($check_array_in,$explode_module_array);
  if($search_match_module==true)
  {
 {
  ?>
<?php 
require_once '../connection.php';
if((!empty($_REQUEST['fees_pay_method']))&&(!empty($_REQUEST['fees_group_id']))&&(!empty($_REQUEST['course_id']))
        &&(!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))
        &&(!empty($_REQUEST['student_admission_id']))&&(!empty($_REQUEST['student_sr_no'])))
{   
$stduent_id=$_REQUEST['student_sr_no'];
$organization_id=$_REQUEST['org_id'];
$branch_id=$_REQUEST['branch_id'];
$session_id=$_REQUEST['session_id'];
$student_admission_no=$_REQUEST['student_admission_id'];
$course_id=$_REQUEST['course_id'];
    
$student_db=mysql_query("SELECT * FROM student_db WHERE id='$stduent_id' and organization_id='$organization_id'
        and branch_id='$branch_id' and session_id='$session_id' and 
    student_id='$student_admission_no'");
$fetch_student_data=  mysql_fetch_array($student_db);
$fetch_student_num_rows=  mysql_num_rows($student_db);
if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
{
$fetch_student_class_id=$fetch_student_data['course_id'];
if($fetch_student_class_id==$course_id)
{
{
?>

<?php 
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
               
               $loopcounted=$_POST['loopcounted'];
             for($monthloop=1;$monthloop<=$loopcounted;$monthloop++)
               {
              $payfeestudentsrno=$_POST['payfeestudentsrnumber'];
              $payfeestudentadmissionnumber=$_POST['payfeestudentadmissionnumber'];
              $payfeestudentclass=$_POST['payfeestudentclass'];
              $payfeestudentsessionyear=$_POST['payfeestudentsessionyear'];
              $payfeesgroupnamethis=$_POST["payfeesgroupname$monthloop"];
              $perticularfees=$_POST["particularfees$monthloop"];
              $perticularfine=$_POST["particularfine$monthloop"];
              $perticulardiscount=$_POST["thisdiscountadd$monthloop"];
              $payfeefeepayblevalue=$_POST['feepayablevalue'];
              $payfeefinepayablevalue=number_format($_POST['finepayablevalue'],2);
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
              $paydescriptiondiscountfine=nl2br($_POST['discriptiondiscountfine']);
              
              if(!empty($_POST["selectfees$monthloop"]))
              {
              $paythismonthchecked=$_POST["selectfees$monthloop"];
              $serviceenable="Paid Fee";
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
                       ,'$payfeetodaydate','$payfeesgroupnamethis','$paythismonthchecked','$perticularfees','$perticularfine','$perticulardiscount','$serviceenable','$payfeefeepayblevalue','$payfeefinepayablevalue'
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
?>
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
            })    
             
              
            
                
            })
    </script>
    <script type="text/javascript" src="../javascript/automatic_fee_payement.js"></script>
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

.feesfullydetails{ width:600px; display:none;  height:30px; background-color:red; position:absolute; margin:2px; margin-left:30px;  margin-top:-0px;      }
#yellocolor{ background-color:yellow; }
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
             
             
             
             
         <div style=" width:690px; height:auto; margin-right:5px;"> 
             <table style=" width:100%; padding-left:20px; margin-top:10px;  font-size:13px; border:1px solid silver;    margin-left:5px;  height:20px; background-color:white;   ">
             <tr>
                 <td><strong>Auto Fee Payment</strong></td>
             </tr>
         </table>
        
             <table cellspacing="0" cellpadding="0" style=" width:100%;  margin-top:10px;  padding-left:5px;   ">
                <tr>
                    <td  class="td_leftpaddingth" style=" padding-left:15px;  color:white; font-size:12px;   font-weight:bold;  
                                        height:20px; background-image:url('finanacephoto/bgblack.png'); ">Select Fee</td>
                </tr>
                <tr>
                    <td>
                        <table cellspacing="0" cellpadding="0" style=" width:100%; ">
                            <tr>
                                <td class="td_table_head">
                                 Fee Group   
                                </td>
                                <td class="td_table_head">
                                 Amount    
                                </td>
                                <td class="td_table_head">
                                 Quantity   
                                </td>
                                <td class="td_table_head">
                                 Subtotal   
                                </td>
                                <td class="td_table_head">
                                Fine Amount  
                                </td>
                                <td class="td_table_head">
                                Discount 
                                </td>
                                <td class="td_table_head">
                                Total Amount  
                                </td>
                                <td class="td_table_head" style=" border-right:1px solid silver; ">
                                Select
                                </td>
                            </tr> 
                          <?php 
                            date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$today_dates=date("Y-m-d");
                             function dmyTime($dt)
{
    list ($d, $m, $y) = explode ('-', $dt);
    return strtotime("$y-$m-$d");
}

                            $row=0;
                            $fee_qty=0;
                         $final_total_fee=0;
                         $final_total_fine=0;
                         $final_total_discount=0;
                         $final_all_total_fees_payable=0;
                      $fee_amount_db=mysql_query("SELECT * FROM financefeeamount WHERE organization_id='$organization_id'
                      and branch_id='$branch_id' and session_id='$session_id' and course_id='$fetch_student_class_id' and action='active'");
                            while ($fetch_fee_amount_data=mysql_fetch_array( $fee_amount_db))
                            {
                            $fetch_fee_amount_id=$fetch_fee_amount_data['fee_amount_id'];
                            $fetch_fee_id=$fetch_fee_amount_data['fee_id'];
                            $fetch_fee_group_id=$fetch_fee_amount_data['fee_group_id'];
                            $fetch_fees_amount=$fetch_fee_amount_data['feesamount'];
                            $fetch_fine_rate=$fetch_fee_amount_data['fineamount'];
                        
                         $fetch_fee_group=mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$organization_id'
                          and branch_id='$branch_id' and session_id='$session_id' and fee_group_id='$fetch_fee_group_id'
                                 and fee_id='$fetch_fee_id' and action='active'");   
                            
                         $fetch_fee_group_data=mysql_fetch_array($fetch_fee_group);
                         $fetch_fee_group_num_rows=mysql_num_rows($fetch_fee_group);
                         if((!empty($fetch_fee_group_data))&&($fetch_fee_group_data!=null)&&($fetch_fee_group_num_rows!=0))
                         {
                          $row ++;   
                         
                         $fetch_fee_group_name=$fetch_fee_group_data['feegroupname'];
                         $fetch_specify_month=$fetch_fee_group_data['monthlyofmonth'];
                         $fetch_fee_collect_start_date=unserialize($fetch_fee_group_data['collectfeestartdate']);
                         $fetch_fee_collect_due_date=unserialize($fetch_fee_group_data['collectfeeduedate']);
                         
                         
                         
                         
                            echo "<tr>
                          <td class='td_print_value'>";
                         {
                         ?>
                            <div class='showdetails' onmouseover="show_des_fee('<?php  echo $row;?>')"
                                 onmouseout="hide_des_fee('<?php  echo $row;?>')" id='showdetails1'><?php  echo $fetch_fee_group_name;?></div> 
                        <?php 
                         }
                          echo"<div class='feesfullydetails' id='feesfullydetails_$row' style='display:none;'>
                          <table cellspacing='0' cellpadding='0' style='width:100%; '>
                          <tbody><tr>
                           <td class='fineheader' colspan='4'>$fetch_fee_group_name </td>
                           <td class='fineheader' colspan='2'> Discount : 5%</td>
                           <td class='fineheader' colspan='3'>Today Date - 2015/04/10</td>                        
                             </tr> 
                          <tr>
                          <td class='td_fine_show_table' style='border-left:1px solid silver;'>Specify</td>
                          <td class='td_fine_show_table'>Fee Amount</td>
                          <td class='td_fine_show_table'>Start Date</td>
                          <td class='td_fine_show_table'>Due Date</td>
                          <td class='td_fine_show_table'>Fine (per day)</td>
                          <td class='td_fine_show_table'>Due Days</td>
                          <td class='td_fine_show_table'>Fine Amount</td>
                          <td class='td_fine_show_table'>Sub Total</td>
                          </tr>";
                      $quantity=0;
                    $total_amount_payable=0;  
                    $total_discount_amount=0;
                    $total_fine_amount_paybale=0;
                    $sub_total_fees=0;
                   $explode_specify_month=explode(",",$fetch_specify_month);
                   foreach ($explode_specify_month as $specify_month_term) {
                       
                       $start_date=$fetch_fee_collect_start_date[$specify_month_term];
                       $due_date=$fetch_fee_collect_due_date[$specify_month_term];
   $quantity++;

$end_date=$due_date;
$today_date=$today_dates;
$days = floor((dmyTime($today_date) - dmyTime($end_date))/86400);
if($days>=0)
{
 $print_days=$days." days";  
 $fine_amount=($fetch_fine_rate*$print_days);
}else
{
   $print_days="";
   $fine_amount=0;
}
               

$total_payable_amount=($fetch_fees_amount+$fine_amount);

$discount_rate=5;
$discount_amount=(($discount_rate*$fetch_fees_amount)/100);





                      echo"<tr style=''>
                 <td class='td_fetchfine' style='border-left:1px solid silver;'>$specify_month_term</td>
                 <td class='td_fetchfine'>$fetch_fees_amount <b style='color:red;'>$fetch_currency</b></td>
                 <td class='td_fetchfine'>$start_date</td>
                 <td class='td_fetchfine'>$due_date</td>
                 <td class='td_fetchfine'>$fetch_fine_rate <b style='color:red;'>$fetch_currency</b></td>
                 <td class='td_fetchfine' style='color:red;'>$print_days</td>
                 <td class='td_fetchfine'>$fine_amount <b style='color:red;'>$fetch_currency</b></td>
                 <td class='td_fetchfine'>$total_payable_amount <b style='color:red;'>$fetch_currency</b></td>
                 </tr><tr>";
                      
                 $total_amount_payable +=$total_payable_amount; 
                 $total_discount_amount +=$discount_amount;
                 $total_fine_amount_paybale +=$fine_amount;
                 $sub_total_fees +=$fetch_fees_amount;
                    }     
                       
                    
                  $final_student_payable_amount=($total_amount_payable-$total_discount_amount);  
                    
                    
                          echo"<td colspan='3' class='td_fine_show_tabletotal' style='text-align:left; padding-left:4px; font-size:11px;'> Discount Amount : $total_discount_amount <b style='color:whitesmoke;'>$fetch_currency</b></td>
                    <td colspan='2' class='td_fine_show_tabletotal' style='text-align:left; font-size:11px;'>Fine Amount : $total_fine_amount_paybale <b style='color:whitesmoke;'>$fetch_currency</b></td>      
                    <td colspan='2' class='td_fine_show_tabletotal' style='text-align:right; font-size:11px;'>Total Amount : </td>
                          <td class='td_fine_show_tabletotal'>$total_amount_payable <b style='color:whitesmoke;'>$fetch_currency</b></td>
                          </tr>
                          </tbody></table>     
               </div>
               
                           
               
                                </td>
                               <td class='td_print_value' style='text-align:right; padding-right:3px;'>$fetch_fees_amount <b style='color:red;'>$fetch_currency</b></td>
                               <td class='td_print_value'>
                               <input type='text' style='width:30px; text-align:center; color:gray;'
                               readonly='readonly' value='$quantity'> 
                                </td>
                               <td class='td_print_value' style='text-align:right; padding-right:3px;'>
                               $sub_total_fees <b style='color:red;'>$fetch_currency</b>
                               <input type='hidden' id='thisfeesadd1' value='$sub_total_fees'>
                                </td>
                               
                               <td class='td_print_value' style='text-align:right; padding-right:3px;'>
                                 $total_fine_amount_paybale <b style='color:red;'>$fetch_currency</b>
                             <input type='hidden' id='thisfineadd1' value='$total_fine_amount_paybale'>
                           
                                </td>
                    <td class='td_print_value' style='text-align:right; padding-right:3px;'>
                                  (-) $total_discount_amount <b style='color:red;'>$fetch_currency</b>
                                </td>
                               <td class='td_print_value' style='text-align:right; padding-right:3px;'>
                                 $final_student_payable_amount <b style='color:red;'>$fetch_currency</b>
                                </td>
                           
                           
                           
                               <td class='td_print_value' style='border-right:1px solid silver;'>
   <input type='checkbox' class='allchecked' id='selectfees1' name='selectfees1' value='autopayment' unchecked='' checked='checked'> 
  <input type='hidden' name='particularfees1' value='3300'>
  <input type='hidden' name='particularfine1' value='9114'>
                                                   
                           <input type='hidden' name='payfeesgroupname1' value='Examination Fee'>
                           <input type='hidden' id='thisdiscountadd1' name='thisdiscountadd1' value='330'>    
                           </td>
                               
                               
                            </tr>";  
                          $fee_qty++;
                          $final_total_fee +=$sub_total_fees;
                          $final_total_fine +=$total_fine_amount_paybale;
                          $final_total_discount +=$total_discount_amount;
                          $final_all_total_fees_payable +=$final_student_payable_amount;
                          
                          
                         }   
                            }
                            
                            
                            
                            
                            $final_total_amount=(($final_total_fee)-($final_total_discount));
                            
                           
                            ?>
                            
                           </table>
                         
                        
                       
                        
                        
                        
                      <table cellspacing="0" cellpadding="0" style=" width:600px;  margin-top:10px; margin-left:40px;  padding-left:5px;   ">
                <tbody><tr>
                    <td class="td_leftpaddingth" style=" padding-left:15px;  color:white; font-size:12px;   font-weight:bold;  
                                        height:20px; background-image:url('finanacephoto/bgblack.png'); ">Fee Amount</td>
                </tr>
                <tr>
                    <td>
                        <table cellspacing="0" cellpadding="0" style=" width:100%; ">
                            <tbody><tr>
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
                                Discount   
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
                             <tr><td class="td_print_value">Total Fee Amount</td>
      <td class="td_print_value"><div class="tempfeesamount" style=" width:auto; height:auto;  ">
      <?php  echo $final_total_fee." <b style='color:red;'>$fetch_currency</b>";?></div></td>
          
   <td class="td_print_value">
       <input type="text" style="width:35px; color:gray; background-color: whitesmoke;
              border:1px solid silver;  text-align:center;"
              id="feequantity" readonly="readonly" value="<?php  echo $fee_qty;?>"></td>      
   <td class="td_print_value"><div class="tempfeesamount" style=" width:auto; height:auto;  "><?php  echo $final_total_discount." <b style='color:red;'>$fetch_currency</b>";?></div></td>
   <td class="td_print_value"><div class="tempfeesamount" style=" width:auto; height:auto;  "><?php  echo $final_total_amount." <b style='color:red;'>$fetch_currency</b>";?></div></td>
<td class="td_print_value"><input type="checkbox" checked="" disabled=""></td>
<td class="td_print_value" style="border-right:1px solid silver; color:red;">No Modify</td>
                               </tr>
      <tr><td class="td_print_value">Total Fine Amount</td>
   <td class="td_print_value"><div class="tempfineamount" style=" width:auto; height:auto;  "><?php  echo $final_total_fine." <b style='color:red;'>$fetch_currency</b>";?></div></td>
   <td class="td_print_value">
       <input type="text" style="width:35px; color:gray; background-color: whitesmoke; border:1px solid silver; text-align:center;" 
              id="feequantity" readonly="readonly" value="<?php  echo $fee_qty;?>"></td>   
   <td class="td_print_value"><div class="tempfeesamount" style=" width:auto; height:auto;  ">0 <b style='color:red;'><?php  echo $fetch_currency;?></b></div></td>
  <td class="td_print_value"><div class="tempfineamount" id="discountfinethisstudent" 
                                  style=" width:auto; height:auto;  "><?php  echo $final_total_fine." <b style='color:red;'>$fetch_currency</b>";?></div></td>
<td class="td_print_value"><input type="checkbox" checked="" disabled=""></td>
<td class="td_print_value" style="border-right:1px solid silver; color:red;">
 <div id="addfine"><strong>Add</strong></div>
<div id="modified" style="color:blue; display:none;">No Modify</div>
                               </td></tr>
  
  <tr>
                               <td class="td_print_value"><div id="showduefine">Paid Fee</div>
                               <div class="showduefinedetails" style="display: none;">
                          <table cellspacing="0" cellpadding="0" style="width:100%; ">
                          <tbody><tr>
         <td class="fineheader" colspan="5">Previous Paid Fee</td>  <td class="fineheader">2015/04/11</td>                        
                             </tr>
                          <tr>
                          <td class="td_fine_show_table">Sl.No</td>
                          <td class="td_fine_show_table">Payment Date</td>
                          <td class="td_fine_show_table">Fee Group</td>
                          <td class="td_fine_show_table">Due Amount</td>
                         <td class="td_fine_show_table">Fine Amount</td>
                          <td class="td_fine_show_table">Total Amount</td>
                          </tr>
                          <tr>
<td colspan="6" style="background-color:skyblue;">No Due Fee</td>                      
</tr>
                   
                          <tr>
                          <td colspan="5" class="td_fine_show_tabletotal" style="text-align:right;">Total Due Amount :</td>
                          <td class="td_fine_show_tabletotal"> 0</td>
                          </tr>
                          </tbody></table></div></td>                               <td class="td_print_value">0 <b style='color:red;'><?php  echo $fetch_currency;?></b></td>
   <td class="td_print_value"><input type="text" style="width:35px; color:gray; background-color: whitesmoke; border:1px solid silver; text-align:center;"
                                     id="feequantity" readonly="readonly" value="0"></td>  
   <td class="td_print_value"><div class="tempfeesamount" style=" width:auto; height:auto;  ">0 <b style='color:red;'><?php  echo $fetch_currency;?></b></div></td>
  
<td class="td_print_value">0 <b style='color:red;'><?php  echo $fetch_currency;?></b><input type="hidden" id="addeddueamount" value="0"></td>
<td class="td_print_value">
<input type="checkbox" name="dueamountselected" value="$fecthduesamounts" id="dueamountchecked" checked=""></td>                                    
<td class="td_print_value" style="border-right:1px solid silver; color:red;">No Modify</td>
                               </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr style='background-color: whitesmoke; height:20px;font-size:12px; font-weight:bold;  
                    border:1px solid silver; border-top:0px;   '>
                    <td colspan="3" style=" text-align:right; ">Total Payable Amount :</td>
                  
                </tr>
       </tbody></table>  
                        
            <?php 
              
              $student_payable_amount=($final_total_amount+$final_total_fine);
              if($student_payable_amount==$final_all_total_fees_payable)
              {
                 $student_final_pay_amount=$student_payable_amount; 
              }  else {
                 $student_final_pay_amount="Missing"; 
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
                            id='totalamountpayble' value='<?php  echo $final_total_fee;?>'>
                 </td>
                  <td>
                Fine Payable   
                 </td><td style='width:10px;'><strong>:</strong></td>
                 <td>
                     <input type='text' readonly='readonly' name='finepayablevalue' class='text_box_size_same' 
                            id='totalfineamount'
                            value='<?php  echo $final_total_fine;?>'>
                 </td>
             </tr>  
             <tr>
                 <td style='height:25px;'>
                  Discount in %  
                 </td><td style='width:10px;'><strong>:</strong></td>
                 <td>
                     <input type='text' readonly='readonly' name='discount' class='text_box_size_same'
                            id='totalamountdiscountinpercantage' value='0'>
                 </td>
                  <td>
                 Discount Amount   
                 </td><td style='width:10px;'><strong>:</strong></td>
                 <td>
                     <input type='text' readonly='readonly' name='discountamount' class='text_box_size_same'
                            id='totalamountdiscount'
                            value='<?php  echo $final_total_discount;?>'>
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
                      id='thisisthefinaloutpu' value='<?php  echo $student_final_pay_amount;?>'>
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
                        <input type='text' name='chequeddnumber' id="chequeddno" class='text_box_size_same' >
                         </td>
                         <td>Cheque/DD Date</td><td style='width:10px;'><strong>:</strong></td>
                         <td>
                          <div id="outputcalender"></div>
                        <input type='text' name='chequedddate' id="chequedddate" class='text_box_size_same' >
                        
                         </td>
                         <td><div id="inputdate"></div></td>
                         </tr>
                         <tr>
                         <td colspan='2'>Cheque/DD Amount</td>
                         <td>
                             <strong>:</strong> <input type='text' autocomplete="off" readonly="readonly" value='<?php  echo $student_final_pay_amount;?>'
                                               id="chequeddamount" name='chequeddamount' value="" class='text_box_size_same'>
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
                     <input type='text' readonly='readonly' name="amountpaid" value="<?php  echo $student_final_pay_amount;?>"
                            autocomplete="off" id='amountpaidvalue' class='text_box_size_same'> <b style='color:red;'><?php  echo $fetch_currency;?></b>
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
<?php 
}
}else    echo 'student record missing,Please contact DIGI Shiksha';
}else    echo 'student record missing,Please contact DIGI Shiksha';
}else    echo 'student record missing,Please contact DIGI Shiksha';
?>

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