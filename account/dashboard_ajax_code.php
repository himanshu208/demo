<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php 
require_once '../connection.php';
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['currency']))
        &&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['account_from_date']))&&(!empty($_REQUEST['account_to_date'])))
{
  $fetch_school_id=$_REQUEST['org_id'];
  $fetch_branch_unique_db_id=$_REQUEST['branch_id'];
  $fecth_session_id_set=$_REQUEST['session_id'];
  $fetch_currency=$_REQUEST['currency'];
  
  $put_currency="<b style='color:red;'>$fetch_currency</b>";
  $from_date=$_REQUEST['account_from_date'];
  $to_date=$_REQUEST['account_to_date'];
   
         
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
    <div class="horizental_line"></div>  
                                       
                                       <?php 
                                   
                                   if(($total_fees_amount!=$student_payable_amount))
         {
             
             echo "<div style='width:98%; margin:0 auto; height:20px; padding-top:10px;  color:red;'>Sorry,Technical Problem,Please Contact technical team.</div>";
             
         }
                                   ?>
                                       
                                       <table cellspacing="0" cellpadding="0" class="income_expense_table">
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
                                       
<?php 
}
  ?>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>