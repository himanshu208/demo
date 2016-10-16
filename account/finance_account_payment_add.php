<?php 
    $protocol=$_SERVER['SERVER_PROTOCOL'];
    $domain=$_SERVER['HTTP_HOST'];
    $script= $_SERVER['SCRIPT_NAME'];
    $parameters=$_SERVER['QUERY_STRING'];
    if(!empty($parameters))
    {
      $perametres="?";
    }  else {
      $perametres="";  
    }
//next we do a bit of string manipulation to convert output like HTTP/1.1 to http
    $protocol=strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 
                === FALSE ? 'http' : 'https';
 
//now the final part to concatenate all this together to form the URL
    $FinalUrl = $protocol . '://' . $domain. $script . $perametres . $parameters;
     ?> 



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
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finance</title>
        <script type="text/javascript" src="account_javascript/account_income_expensive_javascript.js"></script>
        <script type="text/javascript">
           function validateForm()
           {
          
            var payment_date=document.getElementById("payment_date").value;
            var account_group_id=document.getElementById("select_acount_head").value;
            var account_name_id=document.getElementById("account_name").value;
            var payment_mode=document.getElementById("selectpaymenttype").value;
            var amount_paid=document.getElementById("amount").value;
            
            var department=document.getElementById("department").value;
            var designation=document.getElementById("designation").value;
            var reciver_name=document.getElementById("receiver_name").value;
            var reciver_mobile_no=document.getElementById("receiver_mobile_no").value;
            
            if(payment_date==0)
            {
               alert("Please enter payment date");
               document.getElementById("payment_date").focus();
               return false;
            }else
              if(account_group_id==0)
          {
             alert("Please select account group");
             return false;
          }else
              if(account_name_id==0)
          {
             alert("Please select account");
             return false;
             
          }else
              if(payment_mode==0)
          {
             alert("Please select payment mode");
             return false;
          }else
            if(amount_paid==0)
        {
        alert("Please enter amount");
        return false;
        }
            
            
            
           }
            </script>
    </head>
    <style>
   #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial;   font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{ width:1050px; height:auto;  margin:0 auto;  }
    #table_midle_set{ width:100%; height:180px; margin:0 auto; margin-top:10px; border:1px solid silver;   
}
    #inputdate{ width:30px; height:30px; margin-top:3px; margin-left:3px; cursor:pointer;background-image:url('finanacephoto/calender.png'); background-repeat:no-repeat;   }
   #outputcalender{ width:202px; height:228px; display:none; 
                    margin-top:-228px;   margin-left:0px;  position:absolute;    }       
 
    .td_leftpaddingth{ padding-left:10px;}
    #top_add_view_div{ width:auto; height:18px;padding-left:5px; padding-right:5px;  
                       background-image:url('finanacephoto/skynormal.png');
                       float:right; margin-right:5px; color:black; text-align:center; padding-top:2px        }
    .td_leftpadding{ width:170px; height:35px;   padding-left:100px;  text-align:left;  }
    .textsize_same{ border:1px solid silver; width: 220px; height:21px; padding-left:2px; 
                   padding-right: 2px;  border-radius:2px;  }
    .add_button_reset_button{ width:90px; height:26px; margin-left:12px; font-size:12px; float:right; 
                             border:1px solid dodgerblue;color:whitesmoke; font-weight:bold;  
                             background-color:dodgerblue;   }
    #error-msg{ width:100%; height:22px;padding-top:3px; background-color:#FFFFCC; 
                margin-top:10px; float:left; color:#380000; text-align: center;
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
    #show_po_up_calender{ width:25px; height:25px; margin-left:-15px;    
                          background-repeat:no-repeat;  background-image:url('finanacephoto/calender.png');   }
    #selectacounthead{ width:250px; height:20px; border:1px solid silver;   }
    #incomeaxtradetails{ width:100px; height:22px; background-color: steelblue;
                         text-align:center; padding-top:5px; cursor:pointer;color:whitesmoke; 
    display: none;}
    #expansemoredetails{ display:none;  }
     #fullviewwindowoutput{width:500px;  height:300px;border:2px solid steelblue;  
               position:fixed;  right:0px; left:0px; top:50px; bottom:0px; display:none;
                              z-index:202; background-color:whitesmoke; margin:0 auto; overflow:  no-display;  }
        #closebutton{ width:100%; height:30px; background-color:steelblue; float:right; border-bottom:1px solid black;   }
        #closebuttonthis{ width:33px; height:25px; margin-top:6px;  
                          float:right;  
                          }
        #viewoutput{width:100%; height:250px;float:left; 
                    background-color:whitesmoke;  overflow:hidden;  }
         #fullviewwindow{ width:28px;  height:28px; margin-top:2px; 
                          float:right;
                         background-image:url('finanacephoto/closewindow/max.png'); background-repeat:no-repeat;     }
         .radio_button{ width:15px; height:15px; position:relative; top: 5px; cursor:pointer;  }
         .select_box_style{ width:227px; height:25px; padding:3px;   }
         .record_insert_payment_table{ width:auto; height:auto; margin:0 auto;   }
         .text_area_style{ width:220px; height:50px; font-family:arial;  border:1px solid silver;   }
         #ui-datepicker-div{ font-size:13px; }
         .alert_show{ width:100%; height:20px; padding-top:8px; text-align:center;
                     background-color: lavender; margin-top:5px; box-shadow:1px 1px 1px 1px silver;
                   margin-left:30px; color:red;   border-radius:2px;
         }
    </style>
    <body style=" margin: 0;padding: 0;">
        
       <?php 
         $message_show="";
                                         if(isset($_POST['add_account_payment']))
                                         {
                                             
                                             
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$today_date=date("Y-m-d");
$date_time=$today_date." ".$time_current;
   
$result=mysql_query("SHOW TABLE STATUS LIKE 'finance_account_payment'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_payment_id="ACCOUNT_PAY_$nextId";
$encrypt_id=md5($final_payment_id);



                                             
                                                 $org_id=$_POST['organization_id'];
                                                 $branch_id=$_POST['branch_id'];
                                                 $session_id=$_POST['use_inset_session_id'];
                                                 $payment_date=$_POST['payment_date'];
                                                 if(!empty($_POST['sameaccountpaymenttype']))
                                                 {
                                                 $account_type=$_POST['sameaccountpaymenttype'];
                                                 }  else {
                                                 $account_type="";    
                                                 }
                                                 $account_group_id=$_POST['account_group_id'];
                                                 $account_name_id=$_POST['account_id'];
                                                 $payment_info=$_POST['paymentinfo'];
                                                 $payment_description=$_POST['description'];
                                                 
                                                 $depositor_name=$_POST['personname'];
                                                 $organization=$_POST['organization'];
                                                 $mobile_number=$_POST['mobileno'];
                                                 $email_id=$_POST['emailid'];
                                                 $depositor_address=$_POST['depositor_address'];
                                                 $description=$_POST['descriptioninformation'];
                                                 
                                                 $department=$_POST['receiver_department'];
                                                 $receiver_designation=$_POST['receiver_designation'];
                                                 $receiver_name=$_POST['receiver_name'];
                                                 $receiver_mobile_no=$_POST['receiver_mobile_no'];
                                                 
                                                 $payment_mode=$_POST['paymentmode'];
                                                 
                                                 
                                                 $bank_name=$_POST['bankname'];
                                                 $cheque_dd_no=$_POST['chequeddnumber'];
                                                 $cheque_dd_date=$_POST['chequedddate'];
                                                 $cheque_dd_amount=$_POST['chequeddamount'];
                                                 
                                                 $amount_paid=$_POST['paymentamount'];
                                                 if($payment_mode=="cash")
                                                 {
                                                 $status="cleared";    
                                                 }else
                                                 {
                                                  $status="pending";    
                                                 }
                                                 
                                                 
  if((!empty($org_id))&&(!empty($branch_id))&&(!empty($session_id))&&(!empty($payment_date))&&(!empty($account_type))
          &&(!empty($account_group_id))&&(!empty($final_payment_id))&&(!empty($account_name_id))&&(!empty($payment_mode))&&(!empty($amount_paid)))
  {
   
     $check_record_already_exist_db=  mysql_query("SELECT * FROM finance_account_payment WHERE organization_id='$org_id'
      and branch_id='$branch_id' and session_id='$session_id' and account_payment_id='$final_payment_id'"); 
     $fetch_check_fee_data=mysql_fetch_array($check_record_already_exist_db);
     $fetch_check_num_rows=mysql_num_rows($check_record_already_exist_db);
     if((empty($fetch_check_fee_data))&&($fetch_check_fee_data==null)&&($fetch_check_num_rows==0))
     {
         
     $insert_payment_db=mysql_query("INSERT into finance_account_payment values('','$org_id','$branch_id','$session_id','$final_payment_id'
           ,'$encrypt_id','$payment_date','$account_type','$account_group_id','$account_name_id','$payment_info'
             ,'$payment_description','$department','$receiver_designation','$receiver_name','$receiver_mobile_no','$depositor_name','$organization','$mobile_number','$email_id','$depositor_address'
             ,'$description','$payment_mode','$bank_name','$cheque_dd_no','$cheque_dd_date','$cheque_dd_amount','$amount_paid','$today_date','$date_time','$status','none','active')");   
             
     if((!empty($insert_payment_db))&&($insert_payment_db))
     {
       $message_show="<div class='alert_show'>Record save successfully complete.</div>";   
     }else
     {
      $message_show="<div class='alert_show'>Sorry,Request failed,please try again.</div>";   
     }
         
     }else
     {
      $message_show="<div class='alert_show'>Record already exist in database</div>";   
     }
     
     
      
      
      
      
  }else
  {
      $message_show="<div class='alert_show'>Please fill all fields</div>";
  }
                                             
                                             
                                             
                                         }
                                          
                                          ?>    
        
        
        
        
         <div id="financefirstdiv">
            
             <div id="printwindow" style="width:100%;height:100%;background-color:#000000; display: none;
        opacity:0.7;filter:alpha(opacity=70);position:fixed;top:0;  left:0;z-index:201; overflow:hidden; ">
        </div>
       <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
       
             <input id="organization_id" name='organization_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
             <input id="branch_id" name='branch_id' value="<?php  echo $fetch_branch_id;?>" type="hidden">
             
        
           
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td>
                        
                              <?php 
                                include_once 'headerfinancepage.php';
                                ?>
                           <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
                           
                           <style>
                            #color_7{ background-color:dodgerblue; color:white;  }   
                           </style>       
                    </td>
                </tr> 
                <tr>
                    <td>
                    <div id="valuediv">
                       <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
        
        <script type="text/javascript">
      
$(function() {

$("#payment_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });  
    
    $("#cheque_dd_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    }); 
});
    </script>
    
    
            
                         <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="6" class="td_leftpaddingth" style=" color:white;  font-weight:bold;  
                                        height:25px; background-image:url('finanacephoto/bgblack.png'); ">
                                    Add/Edit Account Payment Details  
                                    
                                    <a href="financeaccount_paymentdetails.php" border="0" style=" text-decoration:none; ">
                                        <abbr title="View Fee Detail">
                                    <div id="top_add_view_div">
                                        <strong> View Account Payment Details </strong>
                                    </div>
                                        </abbr>
                                    </a>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        
                                        
                                        
                                        
                                  <table class="record_insert_payment_table">
                                      <tr>
                                          <td colspan='4'>
                                           <?php  echo $message_show;?>
                                          </td>   
                                      </tr>    
                                      
                                      
                                      
                                <tr>
                                    <td  class="td_leftpaddingth" style=" height:10px; " colspan="4"> 
                                    <strong style="color:gray;background-color:whitesmoke; padding-left:10px; padding-right:10px;
                                            font-size:11px; ">Fields marked with <span><sup style=" color:red; ">*</sup> 
                                            must be filled.</strong>    
                                    </td>
                                </tr>
                                <tr>
<?php 
date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$date1=date("Y-m-d");
{
?>
                                    <td class="td_leftpadding">
                                        <b>Payment Date</b> <span style=" font-size:11px; color:red;  font-weight:100;  ">(dd/mm/YY)</span> <sup style=" color:red; ">*</sup> 
                                    </td><td style="width:10px;"><strong>:</strong></td>
                                    <td>
                                        <input type="text" name="payment_date" id="payment_date" class="textsize_same" value="<?php  echo $date1;?>">
                                    </td>
                                    <td>
                                    
                                    </td>
                                    
                                </tr> 
                            <?php 
}
?>
                                 <tr>
                                    <td class="td_leftpadding">
                                        <b>Account Type</b>  <sup style=" color:red; ">*</sup> 
                                    </td><td style="width:10px;"><strong>:</strong></td>
                                    <td colspan="3" style=" font-weight:200; ">
                                    <input type="radio" onclick="account_type(this.value)" class="radio_button" name='sameaccountpaymenttype' id="incomesearch" value="income"> <b>Income</b>
                                    <input type="radio" onclick="account_type(this.value)"  class="radio_button" name='sameaccountpaymenttype' id="expensesearch" value="expense"> <b>Expense</b>
                                 
                                    </td>
                                    <td>
                                        <div id="incomeaxtradetails">
                                          Add Details  
                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td class="td_leftpadding">
                                        <b>Account Group</b> <sup style=" color:red; ">*</sup> 
                                    </td><td style="width:10px;"><strong>:</strong></td>
                                    <td colspan="">
                                       <select class="select_box_style" onchange="account_group_name(this.value)" 
                                               id="select_acount_head" name="account_group_id">
                                            <option value="0">---Select---</option>
                                        </select>
                                    </td>
                                    
                                </tr>
                                 <tr>
                                    <td class="td_leftpadding">
                                        <b>Account Name</b><sup style=" color:red; ">*</sup> 
                                    </td><td style="width:10px;"><strong>:</strong></td>
                                    <td>
                                    <select  class="select_box_style" id="account_name" name="account_id">
                                        <option value="0">---Select---</option>
                                    </select>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td class="td_leftpadding">
                                        <b> Payment Info</b> 
                                    </td><td style="width:10px;"><strong>:</strong></td>
                                    <td colspan="">
                                        <input type="text" placeholder="Enter payment info" class="textsize_same"  name="paymentinfo">
                                    </td>
                                   
                                </tr>
                                <tr>
                                    <td class="td_leftpadding">
                                        <b> Description</b> 
                                    </td><td style="width:10px;"><strong>:</strong></td>
                                    <td colspan="">
                                     <textarea placeholder='Enter description' class="text_area_style" name="description"></textarea>
                                    </td>
                                     
                                </tr>
                                <tr>
                                    <td colspan="4">
            <fieldset id="dipositor_details" style=' font-size:12px; float:right; margin-left:0px;   width:400px; 
                               margin-top:10px;   text-align:left; display:none; '>
                <legend><span style=" color: maroon;"> <b>Depositor Details</b></span></legend>
             
                <table style=" width:100%; height:210px;    float:left; ">
                    <tr>
                        <td style=" width:210px;  "><b>Depositor Name</b></td><td><strong>:</strong></td>
                        <td><input type="text" placeholder="Enter depositor name" name="personname" class="textsize_same" id="personname"></td>
                    </tr> 
                    <tr>
                        <td><b>Organization/Position</b></td>
                        <td style="width:10px;"><strong>:</strong></td>
                        <td><input class="textsize_same" placeholder="Enter organization/position" type="text" name="organization" id="organization"></td>
                    </tr> 
                    <tr>
                        <td><b>Mobile No</b></td>
                        <td><strong>:</strong></td>
                        <td><input class="textsize_same" placeholder="Enter mobile number" type="text" name="mobileno" id="mobileno"></td>
                    </tr> 
                    <tr>
                        <td><b>Email ID</b></td>
                        <td><strong>:</strong></td>
                        <td><input type="text" placeholder="Enter email id" class="textsize_same" name="emailid" id="emailid"></td>
                    </tr> 
                    <tr>
                         <td><b>Address</b></td><td><strong>:</strong></td>
                        <td><textarea id="description" placeholder="Enter Address" class="text_area_style" 
                                      name="depositor_address"></textarea></td>
                    </tr> 
                     <tr>
                         <td><b>Description</b></td><td><strong>:</strong></td>
                        <td><textarea id="description" placeholder="Enter description" class="text_area_style" name="descriptioninformation"></textarea></td>
                    </tr> 
                    <tr>
                    </table>
         </fieldset>
                  
                                    </td>
                                </tr>
                                
                                
                                
                                <tr>
                 <td colspan="4" >
                     <div id="expanse_more_details" style=" display:none; ">
                         <fieldset 
                               style=' font-size:12px; float:right; margin-left:0px;   width:400px; 
                               margin-top:10px;   text-align:left;'>
                  <legend><span style=' color: maroon; '><b>Receiver Details</b></span></legend>
                    
                         <table cellspacing="0" style=' width:100%; height:140px;  float:left;  '>
                              <tr>
                 <td style=' width:260px; '>
                     <b>Department <sup style=" color:red; ">*</sup></b> 
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td>
                     <input type="text" name="receiver_department" placeholder='Enter department' class="textsize_same" id="department">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Designation</b> <sup style=" color:red; ">*</sup> 
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td colspan="2">
                     <input type="text" name="receiver_designation" placeholder='Enter Designation' class="textsize_same" id="designation">
                 </td>
             </tr>
                           <tr>
                 <td>
                     <b>Receiver Name</b> <sup style=" color:red; ">*</sup> 
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td colspan="2">
                     <input type="text" name="receiver_name" placeholder='Enter Receiver Name' class="textsize_same" id="receiver_name">
                 </td>
             </tr>
             <tr>
                 <td>
                     <b>Mobile No.</b> <sup style=" color:red; ">*</sup> 
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td colspan="2">
                     <input type="text" name="receiver_mobile_no" placeholder='Enter Mobile Number' class="textsize_same" id="receiver_mobile_no">
                 </td>
             </tr>
             
                         </table> 
                  </fieldset>
                     </div>
                 </td>
             </tr>
                                
                                
                                
                                
                                
                                <tr>
                 <td class="td_leftpadding">
                     <b>  Payment Mode</b> <sup style=" color:red; ">*</sup>  
                 
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td><select onchange="payment_mode(this.value)" class="select_box_style" name='paymentmode' id='selectpaymenttype'>
                         <option value='cash'>CASH</option>
                         <option value='cheque'>CHEQUE</option>
                         <option value='dd'>DD</option>
                     </select>
                 </td>
                 
         </tr>
        <tr>
                 <td colspan="4">
                    
              <fieldset 
                               style=' font-size:12px; float:right; margin-left:0px;   width:400px; 
                               margin-top:10px;  text-align:left; display:none; ' id='show_cheque_and_dd_details' >
                  <legend><span style=' color: maroon; '><b>CHEQUE/DD Details</b></span></legend>
                     <table cellspacing="0" cellpadding="0" style=' width:100%; float:left; height:130px; '>
                         <tr>
        <td style=' width:260px; '><b>Bank Name <sup style=" color:red;">*</sup></b></td><td style='width:10px;'><strong>:</strong></td>
                         <td>
        <select id="selectbankname" class="select_box_style"  name='bankname'>
        <option value="0">--Select Bank Name--</option>
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
                             <td><b>Cheque/DD No. <sup style=" color:red;">*</sup></b></td><td style='width:10px;'><strong>:</strong></td>
                         <td>
                        <input type='text' name='chequeddnumber' placeholder='Enter Cheque/DD No.' id="chequeddno" class="textsize_same" >
                         </td>
                         
                         </tr>
                         
                         <tr>
                             <td><b>Cheque/DD Date <sup style=" color:red;">*</sup></b></td><td style='width:10px;'><strong>:</strong></td>
                         <td>
                         
                        <input type='text' name='chequedddate' placeholder='Cheque/DD Date'  id="cheque_dd_date"
                               class="textsize_same" style=" width:190px; ">
                        
                         </td>
                         
                         </tr>
                         <tr>
                             <td><b>Cheque/DD Amount <sup style=" color:red;">*</sup></b></td>
                             <td><strong>:</strong> </td>
                         <td>
                    
                             <input type='text' onkeyup="cheque_dd_amount(this.value)" autocomplete="off" 
                            id="chequeddamount" placeholder='Enter Cheque/DD Amount' name='chequeddamount' class="textsize_same" > 
                         </td>
                         
                         </tr>
                         
                     </table></fieldset>
                 </td>
       
             </tr>
            
             
              <tr>
                 <td class="td_leftpadding">
                     <b>Amount</b><sup style=" color:red; ">*</sup> 
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td colspan="2">
                 <input type="text" onkeyup="amount_value(this.value)" autocomplete="off"
                        placeholder="Enter Amount" class="textsize_same"  name="paymentamount" id="amount">
                 </td>
                 <td><b style=' color:red; '><?php  echo $fetch_currency;?></b></td>
             </tr>  
             <tr>
                                    <td style=' height:20px; '></td>
                                </tr>
                                <tr>
                                    <td colspan="2" ></td>
                                    <td>
                                        
                                        <input type="submit" value="Reset" class="add_button_reset_button" style='background-color: deeppink;
                                             border:1px solid deeppink; '>
                                        <input type="submit" value="Save" name="add_account_payment" 
                                           id="addfeesname"    class="add_button_reset_button">
                                    </td>
                                </tr>
                                <tr>
                                    <td style=' height:20px; '></td>
                                </tr>
                                 </table>   
                                        
                                    </td>   
                                </tr>
                            </table>
                            
                        </div>
                    </td>
                </tr>
           <tr>
                    <td>
                        <div style=" width:300px; height:40px;  ">
                            
                        </div>
                    </td>
                </tr>
            </table> 
       </form>
         </div>
       
         <div id="attechfotter" style=" width:100%; height:22px; position:fixed; bottom:0px; ">
          <?php 
              include 'financefotter.php';
            ?>
        </div>
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
     header("Location:../loginPage.php?return_url=$FinalUrl");
}
?>