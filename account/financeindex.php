<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>




<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finance</title>
        <link href="stylesheet/dashboard_styling.css" rel="stylesheet" type="text/css" media="all">
         <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
       
        <style>
             #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial; font-size:12px; float:left;      }
            #fullviewtable{ width:100%; height:100%;  margin:0; padding: 0; float:left; }
            #linkviewdiv{ width:840px; height:200px; background-color:white;   }
            .spacing{ margin: 0;padding:0; border-spacing: 0px }
            
            .td_index{ margin:0; padding:0; border-spacing: 0;  }
            .td_verticleline{   margin:0; padding:0; border-spacing: 0;
                                }
            #linkpage{ width:840px; height:400px; background-color:white;  border-top:1px solid whitesmoke;    }
            
        </style>
    </head>
    <body style=" margin:0; padding: 0;  ">
        
    <?php 
include_once '../ajax_loader_page_second.php';
      ?>
        
        <div id="financefirstdiv">
            <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td>
                    <?php 
                      include_once 'headerfinancepage.php';
                      ?>
                        <style>
                          #color_1{ background-color:dodgerblue; color: white; }  
                        </style>
                        
                        
                        <input id='org_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
                        <input id='branch_id' value="<?php  echo $fetch_branch_unique_db_id;?>" type="hidden">
                        <input id='session_id' value="<?php  echo $fecth_session_id_set;?>" type="hidden">
                        <input type="hidden" id='currency_id' value="<?php  echo $fetch_currency;?>">    
                        
                        
                    </td>
                </tr>
                <tr>
                    <td>
                       <div id="mainpagesourse">
                        
                         <?php 
                           //count total student
                           $student_count_db=mysql_query("SELECT * FROM student_db WHERE $db_main_details is_delete='none'");
                           $total_student_no=mysql_num_rows($student_count_db);
                           
                           if($total_student_no!=0)
                           {
                           $total_student_no=number_format($total_student_no);    
                           }else
                           {
                               $total_student_no=$total_student_no;
                           }
                           
                           
                           //employee total no
                           $total_employee_no=0;
                           
                           //due amount total no
                           $due_amount_db=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE $db_main_details_whout_session is_delete='none'");
                           $fetch_total_due_amount=mysql_num_rows($due_amount_db);
                           if($fetch_total_due_amount!=0)
                           {
                            $fetch_total_due_amount=  number_format($fetch_total_due_amount);   
                           }  else {
                             $fetch_total_due_amount=$fetch_total_due_amount;  
                           }
                           
                           
                           //payment history
                           $payment_history_db=mysql_query("SELECT * FROM finance_student_pay_fee WHERE $db_main_details is_delete='none'");
                           $fetch_total_payment_history=mysql_num_rows($payment_history_db);
                           if($fetch_total_payment_history!=0)
                           {
                              $fetch_total_payment_history=  number_format($fetch_total_payment_history); 
                           }else
                           {
                               $fetch_total_payment_history=$fetch_total_payment_history;
                           }
                           
                           
                           
                           //account history
                           
                            $account_history_db=mysql_query("SELECT * FROM finance_account_payment WHERE $db_main_details is_delete='none'");
                           $fetch_total_account_history=mysql_num_rows($account_history_db);
                           if($fetch_total_account_history!=0)
                           {
                              $fetch_total_account_history=  number_format($fetch_total_account_history); 
                           }else
                           {
                               $fetch_total_account_history=$fetch_total_account_history;
                           }
                           
                           ?>
                           
                           
                           
                           
                           
                           <div id="first_dashboard_div">
                               <div class="small_first_dashboard_div" id="color_ing_1" style=" margin-left:0px; ">
                                   <table cellspacing="0" cellpadding="0" class="first_dashboard_table">
                                       <tr>
                                           <td><div class="first_dashboard_no"><?php  echo $total_student_no;?></div></td>
                                           <td rowspan="2" style=" width:80px; ">
                                               <div class="image_div"><img border="0" class="first_dashboard_image" src="../images/student.png"></div></td>
                                       </tr>
                                       <tr>
                                           <td><div class="first_dashboard_title">Student</div></td>
                                       </tr>
                                   </table>   
                               </div>   
                          
                               <div class="small_first_dashboard_div" id="color_ing_2">
                                   <table cellspacing="0" cellpadding="0" class="first_dashboard_table">
                                       <tr>
                                           <td><div class="first_dashboard_no"><?php  echo $total_employee_no;?></div></td>
                                           <td rowspan="2" style=" width:80px; "><div class="image_div"><img border="0" class="first_dashboard_image" src="../images/employee.png"></div></td>
                                       </tr>
                                       <tr>
                                           <td><div class="first_dashboard_title">Employee</div></td>
                                       </tr>
                                   </table>   
                               </div>  
                               
                               
                               <div class="small_first_dashboard_div" id="color_ing_3">
                                   <table cellspacing="0" cellpadding="0" class="first_dashboard_table">
                                       <tr>
                                           <td><div class="first_dashboard_no"><?php  echo $fetch_total_due_amount;?></div></td><td rowspan="2" style=" width:80px; "><div class="image_div"><img border="0" class="first_dashboard_image" src="../images/due_amount.png"></div></td>
                                       </tr>
                                       <tr>
                                           <td><div class="first_dashboard_title">Due Amount</div></td>
                                       </tr>
                                   </table>   
                               </div>
                               
                               
                               <div class="small_first_dashboard_div" id="color_ing_4">
                                   <table cellspacing="0" cellpadding="0" class="first_dashboard_table">
                                       <tr>
                                           <td><div class="first_dashboard_no"><?php  echo $fetch_total_payment_history;?></div></td><td rowspan="2" style=" width:80px; "><div class="image_div"><img border="0" class="first_dashboard_image" src="../images/payment_history.png"></div></td>
                                       </tr>
                                       <tr>
                                           <td><div class="first_dashboard_title">Payment History</div></td>
                                       </tr>
                                   </table>   
                               </div>
                               
                               <div class="small_first_dashboard_div" id="color_ing_5">
                                   <table cellspacing="0" cellpadding="0" class="first_dashboard_table">
                                       <tr>
                                           <td><div class="first_dashboard_no"><?php  echo $fetch_total_account_history;?></div></td><td rowspan="2" style=" width:80px; "><div class="image_div"><img border="0" class="first_dashboard_image" src="../images/account.png"></div></td>
                                       </tr>
                                       <tr>
                                           <td><div class="first_dashboard_title">Account</div></td>
                                       </tr>
                                   </table>   
                               </div>
                               
                            </div> 
                           
                           
                           
                           
                           <div id="second_dashboard_div">
                               
                              
                              
                               
                               
                               
                               <div id="admin_details">
                                   <div id="top_heading_second_dashboard">
                                       <div class="admin_detail_tittle">User Admin Details</div> 
                                       <div class="right_hide_boder"></div>
                                   </div>  
                                   
                                  <?php 
                               
                               $admin_detail_db=mysql_query("SELECT * FROM login_user_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and user_admin_id='$fecth_user_unique' and action='active'");
                               $admin_detail_data=mysql_fetch_array($admin_detail_db);
                               $admin_detail_num_rows=mysql_num_rows($admin_detail_db);
                               if((!empty($admin_detail_data))&&($admin_detail_data!=null)&&($admin_detail_num_rows!=0))
                               {
                                 $fetch_account_type=$admin_detail_data['account_type'];
                                 $fetch_user_name=  ucfirst($admin_detail_data['full_name']);
                                 $fetch_user_gender=  ucfirst($admin_detail_data['gender']);
                                 $fetch_user_email_id=$admin_detail_data['email_id'];
                                 $fetch_user_mobile_no=$admin_detail_data['mobile_number'];
                                 $fetch_user_address=ucfirst($admin_detail_data['address']);
                                 $fetch_user_image=$admin_detail_data['profile_picture'];
                               
                               if($fetch_account_type=="super_admin")
                               {
                                 $admin_role="Owner";  
                               }else
                                 if($fetch_account_type=="branch_head_admin")
                               {
                                 $admin_role="Branch Head Admin";  
                               }  else {
                                  $admin_role="Admin";
                               }   
                              
                               
                               if(!empty($fetch_user_image))
                               {
                                   
                               }else
                               {
                                 $fetch_user_image="../images/image_no_found.png";  
                               }
                               
                               
                            {
                               ?>
                                   
                                   <table class="user_admin_table" style=" color:black;">
                                       
                                       <tr>
                                           <td><b>Role</b></td><td style=" width:5px; "><b>:</b></td>
                                           <td><?php  echo $admin_role;?></td>
                                           <td rowspan="4">
                                               <div class="admin_profile_pic">
                                                   <img border="0" class="image_show_admin" src="<?php  echo $fetch_user_image;?>">
                                               </div><span style=" position:absolute; float:left; margin-top:120px; margin-left:16px;  font-weight:bold; color:black;     ">Profile Photo</span></td>
                                       </tr>
                                       <tr>
                                           <td><b>Name</b></td><td style=" width:5px; "><b>:</b></td>
                                           <td><?php  echo $fetch_user_name;?></td>
                                       </tr>
                                        <tr>
                                           <td><b>Gender</b></td><td style=" width:5px; "><b>:</b></td>
                                           <td><?php  echo $fetch_user_gender;?></td>
                                       </tr>
                                       <tr>
                                           <td><b>Mobile</b></td><td style=" width:5px; "><b>:</b></td>
                                           <td><?php  echo $fetch_user_mobile_no;?></td>
                                       </tr>
                                       <tr>
                                           <td><b>Email </b></td><td style=" width:5px; "><b>:</b></td>
                                           <td><?php  echo $fetch_user_email_id;?></td>
                                       </tr>
                                       <tr>
                                           <td></td>
                                       </tr>
                                       </tr>
                                       <tr>
                                           <td><b>Address </b></td><td style=" width:5px; "><b>:</b></td>
                                           <td  colspan="2">
                                               <div style=" width:260px;"> <?php  echo $fetch_user_address;?></div></td>
                                       </tr>
                                       <tr>
                                           <td colspan="4">
                                           <?php 
                                             if(isset($_SESSION['last_login_date']))
                                             {
                                                $last_login_date= $_SESSION['last_login_date'];
                                                echo '<div class="last_login_message">User Admin Last Login is '.$last_login_date.'</div></td>';   
                                             }
                                             ?>

                                       </tr>
                                       <tr>
                                           <td colspan="4">
                                               <div class="button_show" style=" display:none;  ">Edit Profile</div>
                                               <a href="change_password.php">
                                               <div class="button_show" style=" background-color: #FF5050;">Change Password</div>
                                               </a>
                                           </td>
                                       </tr>
                                   </table>
                               </div>   
                             
                             <?php 
                            }
                               }
                               ?>
                               
                               
                               
        <script type="text/javascript" src="account_javascript/dash_board_javascript.js"></script>                      
        <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
        <script type="text/javascript">
      
$(function() {

$("#rem_from").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      dateFormat:"yy-mm-dd"
     
    });  
    
    $("#rem_to").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      dateFormat:"yy-mm-dd"
    });  
    
     $("#account_from").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      dateFormat:"yy-mm-dd"
    });  
    
     $("#account_to").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      dateFormat:"yy-mm-dd"
    });  
    
});
    </script>
    
    <style>
       #ui-datepicker-div{ font-size:10px; } 
       .text_box { width:110px; height:16px;font-size:11px;  border:1px solid silver;  padding-left:5px; padding-right: 5px;   }
    
        </style>
                               
                               
                   <div id="notification_show_div" style=" border:1px solid tomato; border-top:0px;  ">
                                   <div id="top_heading_second_dashboard" style=" border-bottom:1px solid tomato; ">
                                     <div class="admin_detail_tittle" style=" width:140px;  border-top:1px solid tomato; border-right:1px solid tomato;  ">Remainder</div> 
                                       <div class="right_hide_boder"></div>
                                   </div>
                                   <table class="date_table" >
                                       <tr>
                                           <td style=" color: gray;"><b>From</b> <sup style=" color:red; ">*</sup></td>
                                           <td><b>:</b></td>
                                           <td><input class="text_box" id="rem_from" placeholder="YY-mm-dd" type="text"></td>
                                           <td style=" width:5px; "></td>
                                           <td style=" color: gray;"><b>To</b> <sup style=" color:red; ">*</sup></td>
                                           <td><b>:</b></td>
                                           <td><input class="text_box" id="rem_to" placeholder="YY-mm-dd" type="text"></td>
                                            
                                           <td><input type="button" class="search_button_style"></td>
                                           <td><div class="clear_button">Clear</div></td>
                                       </tr>
                                   </table>
                                   
                                   
                                   <div class="notification_work_div">
                                       <div class="horizental_line"></div>  
                                       
                                       <div class="remainder_ul" style=" display:none; ">
                                           <div class="list_stylse">
                                           <div class="left_side_title">Due Student List</div> 
                                           <div class="right_side_number">[ 12 ]</div>
                                           </div>   
                                           
                                           
                                            <div class="list_stylse">
                                           <div class="left_side_title">Pending Student</div> 
                                           <div class="right_side_number">[ 18 ]</div>
                                           </div>   
                                           
                                           
                                       </div>    
                                       
                                   </div>
                                   
                               </div>
                               
                               
                               
                               
<?php 


          $ones = array(
 "",
 " one",
 " two",
 " three",
 " four",
 " five",
 " six",
 " seven",
 " eight",
 " nine",
 " ten",
 " eleven",
 " twelve",
 " thirteen",
 " fourteen",
 " fifteen",
 " sixteen",
 " seventeen",
 " eighteen",
 " nineteen"
);
 
$tens = array(
 "",
 "",
 " twenty",
 " thirty",
 " forty",
 " fifty",
 " sixty",
 " seventy",
 " eighty",
 " ninety"
);
 
$triplets = array(
 "",
 " thousand",
 " million",
 " billion",
 " trillion",
 " quadrillion",
 " quintillion",
 " sextillion",
 " septillion",
 " octillion",
 " nonillion"
);
 
 // recursive fn, converts three digits per pass
function convertTri($num, $tri) {
  global $ones, $tens, $triplets;
 
  // chunk the number, ...rxyy
  $r = (int) ($num / 1000);
  $x = ($num / 100) % 10;
  $y = $num % 100;
 
  // init the output string
  $str = "";
 
  // do hundreds
  if ($x > 0)
   $str = $ones[$x] . " hundred";
 
  // do ones and tens
  if ($y < 20)
   $str .= $ones[$y];
  else
   $str .= $tens[(int) ($y / 10)] . $ones[$y % 10];
 
  // add triplet modifier only if there
  // is some output to be modified...
  if ($str != "")
   $str .= $triplets[$tri];
 
  // continue recursing?
  if ($r > 0)
   return convertTri($r, $tri+1).$str;
  else
   return $str;
 }
 
// returns the number as an anglicized string
function convertNum($num) {
 $num = (int) $num;    // make sure it's an integer
 
 if ($num < 0)
  return "negative".convertTri(-$num, 0);
 
 if ($num == 0)
  return "zero";
 
 return convertTri($num, 0);
}
 
 // Returns an integer in -10^9 .. 10^9
 // with log distribution
 function makeLogRand() {
  $sign = mt_rand(0,1)*2 - 1;
  $val = randThousand() * 1000000
   + randThousand() * 1000
   + randThousand();
  $scale = mt_rand(-9,0);
 
  return $sign * (int) ($val * pow(10.0, $scale));
 }
      


date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;



  $put_currency="<b style='color:red;'>$fetch_currency</b>";
  $from_date=$date;
  $to_date=$date;
   
        
        //payment date match
         if((!empty($from_date))&&(!empty($to_date)))
         {
         $search_date_t1=" T1.payment_date BETWEEN '$from_date' AND '$to_date' and";    
         $search_date=" payment_date BETWEEN '$from_date' AND '$to_date' and";    
         }else
         {
           $search_date="";  
           $search_date_t1="";
         }
  
      
         $total_fine_amount=0;
         $total_discount_amount=0;
         $total_due_amount=0;
         $total_extra_paid_amount=0;
         $total_amount_paid=0;
         $show_due_amount=0;
        
         //fee income today
         
         $pay_fee_income=mysql_query("SELECT *,SUM((T2.fee_group_qty*T2.fee_amount)+T2.fee_fine_amount-T2.fee_discount_amount) as payable_amount "
                 . "FROM finance_student_pay_fee as T1 "
                 . " INNER JOIN finance_pay_fee_integrate_db as T2 ON T1.student_pay_fee_id=T2.pay_fee_id WHERE $db_t1_main_details $search_date_t1 T1.is_delete='none' and T1.status='cleared'");
         $total_fee_amount=mysql_fetch_array($pay_fee_income);
         $total_fees_amount=$total_fee_amount['payable_amount'];
         //CHECK STUDENT PAYAMENT DIFFRENCE
         
         
         
         $pay_fee_incomes=mysql_query("SELECT *,SUM(student_payable_amount) as student_payable_amount "
                 . "FROM finance_student_pay_fee WHERE $search_date is_delete='none' and status='cleared'");
         $total_fee_amounts=mysql_fetch_array($pay_fee_incomes);
         $student_payable_amount=$total_fee_amounts['student_payable_amount'];
        
         
         //fee discount amount
         
            $fee_discount=mysql_query("SELECT *,SUM(T1.fine_discount+T1.special_discount) as payable_amount "
                 . "FROM finance_student_pay_fee as T1 WHERE $db_t1_main_details $search_date_t1 T1.is_delete='none' and T1.status='cleared'");
         $total_fee_discount=mysql_fetch_array($fee_discount);
         $total_fees_discount_amount=$total_fee_discount['payable_amount'];
         $total_fees_amount=$total_fees_amount-$total_fees_discount_amount;
         
         //total discount amount
         
          $total_discount=mysql_query("SELECT *,SUM(T2.fee_discount_amount) as payable_amount "
                 . "FROM finance_student_pay_fee as T1 "
                 . " INNER JOIN finance_pay_fee_integrate_db as T2 ON T1.student_pay_fee_id=T2.pay_fee_id WHERE $db_t1_main_details $search_date_t1 T1.is_delete='none' and T1.status='cleared'");
         $total_discount_amount=mysql_fetch_array($total_discount);
         $total_discount_value=$total_discount_amount['payable_amount'];
         $total_fees_discount_amount=$total_fees_discount_amount+$total_discount_value;
         
         
       //OUTSTANDING AMOUNT
         
       $due_amount_db=mysql_query("SELECT *,SUM(T1.due_amount) as total_due_amount FROM finance_student_due_amount_db as T1"
               . " INNER JOIN finance_student_pay_fee as T2 ON T1.student_pay_fee_id=T2.student_pay_fee_id"
               . " WHERE $db_t1_main_details $search_date_t1 T1.is_delete='none' and T2.status='cleared'");  
       $due_amount_data=mysql_fetch_array($due_amount_db);
       $total_due_amount=$due_amount_data['total_due_amount'];
       
       
       //account income 
       
       $account_income_db=mysql_query("SELECT SUM(cheque_dd_amount+paid_amount) as income_pay_amount FROM finance_account_payment WHERE $db_main_details "
               . " $search_date account_type='income' and status='cleared' and is_delete='none'");
       $income_amount_data=mysql_fetch_array($account_income_db);
       $income_amount=$income_amount_data['income_pay_amount'];
       
       //account expense 
       
       $account_expense_db=mysql_query("SELECT *,SUM(cheque_dd_amount+paid_amount) as expensepay_amount FROM finance_account_payment WHERE $db_main_details "
               . " $search_date account_type='expense' and status='cleared' and is_delete='none'");
       $expense_amount_data=mysql_fetch_array($account_expense_db);
       $expense_amount=$expense_amount_data['expensepay_amount'];
       
       
       $total_income_amount=($total_fees_amount+$income_amount);
       
       //profit balance
       
       $profit_balance=($total_income_amount-$expense_amount);
       
?>
                               
                               
                               
                               
                               
                               
                               
                               
                               <div id="third_account_details" style=" border:1px solid green; border-top:0px;  ">
                                 <div id="top_heading_second_dashboard" style=" border-bottom:1px solid green; ">
                                     <div class="admin_detail_tittle" style=" width:140px;  border-top:1px solid green; border-right:1px solid green;  ">Account Ledger</div> 
                                       <div class="right_hide_boder"></div>
                                   </div> 
                                   
                                 
                                   <table class="date_table" style=" margin-left:2px; ">
                                       <tr>
                                           
                                           <td><input class="text_box" id="account_from" style=" width:102px; " placeholder="From (YY-mm-dd)" type="text"></td>
                                           
                                           <td><input class="text_box" id="account_to" style=" width:102px; " placeholder="To (YY-mm-dd)" type="text"></td>
                                            
                                           <td><input type="button" onclick="account_payment_details()" class="search_button_style" ></td>
                                           
                                       </tr>
                                   </table>   
                                   
                                   <div class="notification_work_div" id="account_ledger_show">
                                       <div class="horizental_line"></div>  
                                       
                                       <?php 
                                   
                                   if(($total_fees_amount!=$student_payable_amount))
         {
             
             echo "<div style='width:98%; margin:0 auto; height:20px; padding-top:10px;  color:red;'>Sorry,Technical Problem,Please Contact technical team.</div>";
             
         }
                                   ?>
                                       
                                       <table cellspacing="0" class="income_expense_table">
                                           <tr>
                                               <td colspan="3"><div class="date_range">Date From :<?php  echo $from_date;?> &nbsp; &nbsp;Date To :<?php  echo $from_date;?></div></td>
                                           </tr>
                                           <tr>
                                               <td style=" height:5px; "></td> 
                                           </tr>
                                           <tr>
                                               <td style=" width:124px; color:green; "><b>Income Balance</b></td><td><b>:</b></td>
                                               <td style=" font-size:12px; text-align:right; color:green;  "><abbr title="<?php echo ucwords(convertNum($total_income_amount))." $fetch_currency Only ";?>"><?php  echo  $put_currency;?> <?php  echo number_format($total_income_amount,2);?>/-</abbr></td>
                                           </tr>
                                            <tr>
                                                <td style=" color: red;"><b>Expense Balance</b></td><td><b>:</b></td>
                                                <td style=" font-size:12px; text-align:right;  color:red;  "><abbr title="<?php echo ucwords(convertNum($expense_amount))." $fetch_currency Only ";?>"><?php  echo  $put_currency;?> <?php  echo number_format($expense_amount,2);?>/-</abbr></td>
                                           </tr>
                                           <tr>
                                               <td colspan="3"><div class="horizental_line" style=" width:100%; background-color: gray; margin-left:0;  "></div>  </td>
                                           </tr>
                                            <tr>
                                                <td style=" color:black;"><b>Total Profit Balance</b></td><td><b>:</b></td>
                                                <td style=" font-size:12px; text-align:right; color:black; "><abbr title="<?php echo ucwords(convertNum($profit_balance))." $fetch_currency Only ";?>"><?php  echo  $put_currency;?> <?php  echo number_format($profit_balance,2);?>/-</abbr></td>
                                           </tr>
                                             <tr>
                                               <td colspan="3"><div class="horizental_line" style=" width:100%; background-color: gray; margin-left:0;  "></div>  </td>
                                           </tr>
                                            <?php
                                           if(!empty($total_fees_discount_amount))
                                           {
                                           ?>
                                           <tr style=" background-color:yellow;  ">
                                                <td style=" color:black; font-size:12px; "><b>Discount</b></td><td><b>:</b></td>
                                                <td style=" font-size:12px; text-align:right; color:black; "><abbr title="<?php echo ucwords(convertNum($total_fees_discount_amount))." $fetch_currency Only ";?>"><?php  echo  $put_currency;?> <?php  echo number_format($total_fees_discount_amount,2);?>/- </abbr></td>
                                           </tr>
                                           <?php
                                           }
                                           ?>
                                           <?php
                                           if(!empty($total_due_amount))
                                           {
                                           ?>
                                            <tr>
                                                <td style=" color:black; font-size:12px; "><b>Outstanding Balance</b></td><td><b>:</b></td>
                                                <td style=" font-size:12px; text-align:right; color:black; "><abbr title="<?php echo ucwords(convertNum($total_due_amount))." $fetch_currency Only ";?>"><?php  echo  $put_currency;?> <?php  echo number_format($total_due_amount,2);?>/- </abbr></td>
                                           </tr>
                                           <?php
                                           }
                                           ?>
                                           
                                           
                                           <tr>
                                               <td colspan="3">
                                                   <a href="financecash_master.php#9">
                                                   <div class="view_full_details">View Full Details</div>
                                                   </a>
                                                   </td>
                                           </tr>
                                       </table>  
                                       
                                   </div>
                                   
                                   
                               </div>
                               
                               
                               
                           </div>
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
    <script type="text/javascript" src="https://www.gogle.com/jsapi"></script>
   <script type="text/javascript">

          // Load the Visualization API and the piechart package.
          google.load('visualization', '1.0', {'packages':['corechart']});

          // Set a callback to run when the Google Visualization API is loaded.
          google.setOnLoadCallback(drawChart);

          // Callback that creates and populates a data table,
          // instantiates the pie chart, passes in the data and
          // draws it.
          function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');    
            data.addColumn('number', 'Slices');
            data.addRows([
              ['NUS', 3],
              ['LKG', 1],
              ['UKG', 1],
              ['I', 1],
              ['II', 2],
              ['III', 5],
              ['IV', 7],
              ['V', 8],
              ['VI', 9],
              ['VII', 10],
              ['VIII', 11],
              ['IX', 4],
              ['X', 6]
            ]);
            // Create the data table.
            var data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'Topping');
            data2.addColumn('number', 'Slices');
            data2.addRows([
              ['NUS', 1],
              ['LKG', 5],
              ['UKG', 6],
              ['I', 8],
              ['II', 3],
              ['III', 5],
              ['IV', 6],
              ['V', 8],
              ['VI', 9],
              ['VII', 11],
              ['VIII', 18],
              ['IX', 2],
              ['X', 5]
            ]);

            var data3 = new google.visualization.DataTable();
            data3.addColumn('string', 'Year');
            data3.addColumn('number', 'Sales');
            data3.addColumn('number', 'Expenses');
            data3.addColumn('number', 'Profit');
            data3.addRows([
              ['Jan', 1000, 400,100],
              ['Feb', 0, 0,0],
              ['Mar',  0,0,0],
              ['Apr', 0, 0,0],
              ['May', 0, 0,0],
              ['Jun', 0, 0,0],
              ['July', 1030, 540,120],
              ['Aug', 1030, 540,120],
              ['Sep', 1030, 540,120],
              ['Oct', 1030, 540,120],
              ['Nov', 1030, 540,120],
              ['Dec', 1030, 540,120]
            ]);

            // Set chart options
            var options = {'title':'Class Fee Payment Performance',
                           'width':400,
                           'height':300};
            // Set chart options
            var options2 = {'title':'Class Due Amount Performance',
                           'width':400,
                           'height':300};
            // Set chart options
            var options3 = {'title':'School Account Performance',
                           'width':400,
                           'height':260,'font-size':10};

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
            var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
            chart2.draw(data2, options2);
            var chart3 = new google.visualization.BarChart(document.getElementById('chart_div3'));
            chart3.draw(data3, options3);

          }
        </script>
                           
                           
        <div id="third_dashboard_div" style=" display:none; ">
        <div>
          
            <div id="chart_div3" style=" width:400px; height:300px; float:left;   "></div>
           <div id="chart_div" style=" width:300px; height:300px; float:left;   "></div>
           <div id="chart_div2" style=" width:400px; height:300px; float:left;   "></div>
          
         
        </div>   
    </div>
                           
                           
                           
                           
                           
          
                       </div>
                        
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr> 
               
            </table>  
        </div>
        <div id="attechfotter">
          <?php 
              include 'financefotter.php';
            ?>
        </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>