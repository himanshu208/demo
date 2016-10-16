<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
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
            
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Fee Payment Details</title>
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
         
    </head>
    <body>
        
      <?php 
        if(!empty($_REQUEST['token_id']))
        {
         $fee_payment_recipt_id=$_REQUEST['token_id'];
         
         $fee_payment_db=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id'
          and branch_id='$fetch_branch_id' and encrypt_id='$fee_payment_recipt_id'");
         $fetch_fee_payment_data=mysql_fetch_array($fee_payment_db);
         $fetch_fee_payment_num_rows=mysql_num_rows($fee_payment_db);
         if((!empty($fetch_fee_payment_data))&&($fetch_fee_payment_data!=null)&&($fetch_fee_payment_num_rows!=0))
         {
         
          date_default_timezone_set('Asia/Calcutta'); 
          $timezone=5.5;
          $localtime=$timezone*3600;
          $time_current=date("h:i:s A");
          $today_date=date("Y-m-d");
          $date_time=$today_date." ".$time_current;
      
             
          $student_pay_fee_id=$fetch_fee_payment_data['student_pay_fee_id']; 
          $recipt_no=$fetch_fee_payment_data['id'];
          $recipt_id=$fetch_fee_payment_data['receipt_id'];
          $recipt_date=$fetch_fee_payment_data['payment_date'];
          $payment_date=$fetch_fee_payment_data['date_time'];
          $student_id=$fetch_fee_payment_data['student_id'];
          $session_year_id=$fetch_fee_payment_data['session_id'];
          $course_id=$fetch_fee_payment_data['course_id'];
          $payment_info=$fetch_fee_payment_data['payment_info'];
          $payment_description=$fetch_fee_payment_data['payment_description'];
          
          $fine_discount_description=$fetch_fee_payment_data['fine_discount_description'];
          $fine_discount_document=$fetch_fee_payment_data['payment_description'];
          $special_discount_description=$fetch_fee_payment_data['special_discount_description'];
          $special_discount_document=$fetch_fee_payment_data['payment_description'];
          $fee_status=$fetch_fee_payment_data['status'];
           $student_db=mysql_query("SELECT *,T1.id as db_id,T1.encrypt_id as encrpt_id,T1.user_name as student_user_name"
                 . ",T1.temp_password as student_password,T6.user_name as parent_user_name"
                 . ",T6.temp_password as parent_password FROM student_db as T1"
                 . " LEFT JOIN course_db as T2 ON T1.course_id=T2.course_id"
                 . " LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id "
                 . " LEFT JOIN session_db as T4 ON T1.session_id=T4.session_id "
                 . " LEFT JOIN category_db as T5 ON T1.category_id=T5.category_id "
                 . " LEFT JOIN parent_db as T6 ON T1.parent_id=T6.parent_unique_id"
                 . " LEFT JOIN student_personal_db as T7 ON T1.student_personal_id=T7.student_unqiue_id"
                 . " LEFT JOIN student_previous_class_db as T8 ON T1.previous_class_id=T8.previous_class_unique_id"
                 . " LEFT JOIN student_allot_hostel as T9 ON T1.hostel_id=T9.hostel_unique_id"
                 . " LEFT JOIN student_allot_transport as T10 ON T1.transport_id=T10.transport_unique_id "
                 . "LEFT JOIN house_db as T11 ON T1.house_id=T11.house_id WHERE "
                 . " $db_t1_main_details T1.student_id='$student_id' and T1.is_delete='none'");
          $fetch_student_data=mysql_fetch_array($student_db);
          $fetch_student_num_rows=mysql_num_rows($student_db);
          if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
          {
          
          $sr_no=$fetch_student_data['id'];
          $admission_no=$fetch_student_data['admission_no'];
          $roll_no=$fetch_student_data['roll_no'];
          $student_name=UCWORDS($fetch_student_data['student_full_name']);
          $gender=ucfirst($fetch_student_data['student_gender']);
          $father_name=ucwords($fetch_student_data['father_name']);
          $mother_name=ucwords($fetch_student_data['mother_name']);
          $address=ucwords($fetch_student_data['current_address']);
          $nearest_area=$fetch_student_data['current_nearest_area'];
          $city=$fetch_student_data['current_city'];
          $country=$fetch_student_data['current_country'];
          $disctric=$fetch_student_data['current_desctric'];
          $state=$fetch_student_data['current_state'];
          $pincode=$fetch_student_data['current_pincode'];
          if(!empty($nearest_area))
          {
              $nearest_area=" (".$nearest_area."), ";
          }  else {
            $nearest_area="";  
          }
         
          if(!empty($city))
          {
           $city.", ".$city;   
          }else
          {
              $city="";
          }
          if(!empty($disctric))
          {
          $disctric=", ".$disctric;    
          }  else {
           $disctric="";   
          }
          
          if(!empty($state))
          {
           $state=", ".$state;   
          }else
          {
              $state="";
          }
          if(!empty($country))
          {
          $country=", ".$country;    
          }else
          {
              $country="";
          }
          if(!empty($pincode))
          {
           $pincode=" (".$pincode.")";   
          }else
          {
              $pincode="";
          }
          
          $final_address_print=ucfirst($address.$nearest_area.$city.$pincode.$disctric.$state.$country);
          
          
          
          
          $father_mobile_no=$fetch_student_data['father_mobile_no'];
          $student_mobile_no=$fetch_student_data['student_mobile_no'];
          
          $student_email_id=$fetch_student_data['student_email_id'];
          $father_email_id=$fetch_student_data['father_email'];
          
          $admitted_session_name=$fetch_student_data['session_name'];
          $session_name=$fetch_student_data['session_name'];
         
          
          if(!empty($student_email_id))
          {
            $email_id=$student_email_id; 
          }  else {
            $email_id= $father_email_id;   
          }
          $account_status=ucfirst($fetch_student_data['account_status']);
          $sub_status="Regular";
          
          
          $course_name=$fetch_student_data['course_name'];
          $section_name=$fetch_student_data['section_name'];
          $category_name=$fetch_student_data['category_name'];
          $sub_category_name=$fetch_student_data['sub_category'];
          
          
          
          
          
          
          echo "<div class='first_reciept_div' style='margin:20px;'> 
        <table class='first_table'> 
          <tr>
                <td COLSPAN='6'><div class='horizental_line_black'></div></td>
            </tr>
            <tr>
                <td COLSPAN='6' class='fee_recipt_title_name' style='text-align:center; background-color:whitesmoke; font-size:18px; '><b>Fee Payment Details</b></td>
            </tr>
            <tr>
                <td COLSPAN='6'><div class='horizental_line_black'></div></td>
            </tr>
            <tr>
                <td><b>Receipt No.</b></td>
                <td><b>:</b></td>
                <td><b>$recipt_no</b></td>
                <td><b>Receipt ID</b></td>
                <td><b>:</b></td>
                <td><b>$recipt_id</b></td>
            </tr>
            <tr>
                <td><b>Receipt Date</b></td>
                <td><b>:</b></td>
                <td>$today_date</td>
                <td><b>Payment Date</b></td>
                <td><b>:</b></td>
                <td>$payment_date</td>
            </tr>
            
            <tr>
                <td><b>S.R NO.</b></td>
                <td><b>:</b></td>
                <td><b>$sr_no</b></td>
                <td><b>Admission No.</b></td>
                <td><b>:</b></td>
                <td><b>$admission_no</b></td>
            </tr>
            
            
            <tr>
                <td><b>Student Name</b></td>
                <td><b>:</b></td>
                <td>$student_name</td>
                <td><b>Roll No.</b></td>
                <td><b>:</b></td>
                <td><b>$roll_no</b></td>
            </tr>
             <tr>
                <td><b>Gender</b></td>
                <td><b>:</b></td>
                <td>$gender</td>
                <td><b>Admitted Session</b></td>
                <td><b>:</b></td>
                <td>$admitted_session_name</td>
            </tr>
            <tr>
                <td><b>Father Name</b></td>
                <td><b>:</b></td>
                <td>$father_name</td>
                <td><b>Academic Session</b></td>
                <td><b>:</b></td>
                <td>$session_name</td>
            </tr>
            
            <tr>
                <td><b>Mother Name</b></td>
                <td><b>:</b></td>
                <td>$mother_name</td>
                <td><b>Course/Class - Section</b></td>
                <td><b>:</b></td>
                <td>$course_name $section_name</td>
            </tr>
            <tr>
                <td><b>Address</b></td>
                <td><b>:</b></td>
                <td rowspan='2' style=' width:220px; vertical-align:top;  '>$final_address_print</td>
                 <td><b>Category</b></td>
                <td><b>:</b></td>
                <td>$category_name</td>
            </tr>
            
            <tr>
                <td></td>
                <td></td>
                <td><b>Sub-Category</b></td>
                <td><b>:</b></td>
                <td>$sub_category_name</td>
            </tr>
            <tr>
                <td><b>Mobile No. (Ho)</b></td>
                <td><b>:</b></td>
                <td>$father_mobile_no</td>
                <td><b>Mobile No.(Stu)</b></td>
                <td><b>:</b></td>
                <td>$student_mobile_no</td>
            </tr>
            <tr>
                <td><b>Email</b></td>
                <td><b>:</b></td>
                <td>$email_id</td>
                <td><b>Status/Sub-status</b></td>
                <td><b>:</b></td>
                <td>$account_status/$sub_status</td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
       
            <tr>
                <td COLSPAN='6' class='fee_recipt_title_name'><b>Fee Group/Fee Details</b>
        <div class='fee_status'>Fee Status : $fee_status</div>        
</td>
            </tr>
            <tr>
                <td COLSPAN='6'><div class='horizental_line_silver'></div></td>
            </tr>
            <tr>
                <td colspan='6'>
             <table cellspacing='0' cellpadding='0' class='fee_group_table'>
                
             <tr id='fee_heading'>
             <td style='text-align:left;'><b>Fee Group/Fee Name</b></td>
             <td><b>Amount</b></td>
             <td style='text-align:center;'><b>Qty.</b></td>
             <td style='text-align:center;'><b>Months/Annual/Terms</b></td>
             <td><b>Sub Total</b></td>
             <td><b>Fine</b></td>
             <td><b>Discount</b></td>
             <td><b>Total</b></td>
            </tr>
            <tr>
                <td style=' height:0px; '></td>
            </tr>
            <tr>
                <td COLSPAN='8'><div class='horizental_line_silver'></div></td>
            </tr>";
        $total_payable_amount=0;
        $fee_integirated_db=mysql_query("SELECT * FROM finance_pay_fee_integrate_db WHERE pay_fee_id='$student_pay_fee_id' and is_delete='none'");  
        while ($fee_int_data=mysql_fetch_array($fee_integirated_db))
        {
          $integrated_id=$fee_int_data['id'];  
          $fee_group_unique_id=$fee_int_data['fee_group_id']; 
          $fee_group_name=ucwords($fee_int_data['fee_group_name']);  
          $fee_qty=$fee_int_data['fee_group_qty'];
          $fee_amount=$fee_int_data['fee_amount'];
          $fine_amount=$fee_int_data['fee_fine_amount'];
          $discount_amount=$fee_int_data['fee_discount_amount'];       
          
          $sub_total_fees=($fee_qty*$fee_amount);
          $grand_total=($sub_total_fees+$fine_amount-$discount_amount);
          
         $month_array=array(); 
         $month_of_db=mysql_query("SELECT * FROM finance_pay_fee_month_db WHERE fee_integrate_id='$integrated_id' and pay_fee_id='$student_pay_fee_id' and fee_group_id='$fee_group_unique_id' "
                 . "and is_delete='none'"); 
         while ($month_data=mysql_fetch_array($month_of_db))
         {
             $month_name=$month_data['specify_month_term'];
             array_push($month_array,$month_name);    
         }
          
         $month_implode=ucwords(implode(", ",$month_array)); 
          
            echo"<tr class='fee_details_heading'>
                <td style='text-align:left;'>$fee_group_name</td>
                <td><div class='div_td'>".number_format($fee_amount,2)."</div></td>
                <td style='text-align:center;'>$fee_qty</td>
                <td style='text-align:center;'> $month_implode</td>
                <td><div class='div_td'>".number_format($sub_total_fees,2)."</div></td>
                <td><div class='div_td'>".number_format($fine_amount,2)."</div></td>
                <td><div class='div_td'>".number_format($discount_amount,2)."</div></td>
                 <td><div class='div_td'>".number_format($grand_total,2)."</div></td>
                
            </tr>";
            
        $total_payable_amount +=$grand_total;
        }
          
        $fine_discount_amount=$fetch_fee_payment_data['fine_discount'];
        $special_discount_amount=$fetch_fee_payment_data['special_discount'];
        
        $final_amount_payable=($total_payable_amount-$fine_discount_amount-$special_discount_amount);
          
          
          $amount_paid=number_format($fetch_fee_payment_data['amount_paid'],2);
          $amount_paid_temp=$fetch_fee_payment_data['amount_paid'];
          
          if($fetch_fee_payment_data['due_amount']!=0)
          {
          $due_amount=number_format(abs($fetch_fee_payment_data['due_amount']),2);
          }else
          {
          $due_amount="0.00";    
          }
          
          if($fetch_fee_payment_data['due_amount']<0)
          {
            $fee_name="Extra Paid";  
          }else 
          {
            $fee_name="Due";   
          }
          
          
          
          $payment_mode=strtoupper($fetch_fee_payment_data['payment_mode']);
          if($payment_mode=="CASH")
          {
          $cash_amount=$fetch_currency ." ". $amount_paid."/-";  
          $bank_name="";
          $cheque_dd_no="";
          $cheque_dd_date="";
          $cheque_dd_amount="";
          
          }else
          {
          $cash_amount=""; 
          $bank_name=$fetch_fee_payment_data['bank_name'];
          $cheque_dd_no=$fetch_fee_payment_data['cheque_dd_no'];
          $cheque_dd_date=$fetch_fee_payment_data['cheque_dd_date'];
          if($fetch_fee_payment_data['cheque_dd_amount']!=0)
          {
          $cheque_dd_amount="$fetch_currency".number_format($fetch_fee_payment_data['cheque_dd_amount'],2)."/-";
          }else
          {
            $cheque_dd_amount=$fetch_currency."0.00";   
          }
          
          }

          
$amount_paid_in_word=strtoupper(convertNum($amount_paid_temp));

          
            echo" <tr>
                <td COLSPAN='8'><div class='horizental_line_silver'></div></td>
            </tr>
            <tr>
                <td colspan='8' style=' text-align: right;'>
                    <b> Total Amount :</b> $fetch_currency ".number_format($total_payable_amount,2)."/-    
                </td>
            </tr>
            <tr>
                <td COLSPAN='8'><div class='horizental_line_silver'></div></td>
            </tr>
             </table>   
                </td>
            </tr>
            <tr>
                <td><b>Total Amount</b></td>
                <td><b>:</b></td>
                <td> $fetch_currency ".number_format($total_payable_amount,2)."/-</td>
                <td><b>Fine Discount</b></td>
                <td><b>:</b></td>
                <td>$fetch_currency ".number_format($fine_discount_amount,2)."/-</td>
            </tr>
            
            <tr>
                <td><b>Special Discount Amount</b></td>
                <td><b>:</b></td>
                <td>$fetch_currency ".number_format($special_discount_amount,2)."/-</td>
                <td style=' font-size:13px; '><b>Amount Payable</b></td>
                <td><b>:</b></td>
                <td><b>$fetch_currency ".number_format($final_amount_payable,2)."/-</b></td>
            </tr>
            <tr>
                <td  style=' font-size:13px; '><b>Amount Paid</b></td>
                <td><b>:</b></td>
                <td><b>$fetch_currency $amount_paid/-</b></td>
                <td><b>$fee_name Amount</b></td>
                <td><b>:</b></td>
                <td>$fetch_currency $due_amount/-</td>
            </tr>
            <tr>
                <td style=' height:4px; '></td>
            </tr>
             <tr>
                <td COLSPAN='6' class='fee_recipt_title_name'><b>Payment Details</b></td>
            </tr>
            <tr>
                <td COLSPAN='6'><div class='horizental_line_silver'></div></td>
            </tr>
            <tr>
                <td><b>Payment Type</b></td>
                <td><b>:</b></td>
                <td>$payment_mode</td>";
                 if(empty($bank_name))
{   
                echo"<td style=' font-size:13px; '><b>Cash Amount</b></td>
                <td><b>:</b></td>
                <td>$cash_amount</td>
                </tr>";
}
if(!empty($bank_name))
{
           echo" <tr>
                <td><b>Bank Name</b></td>
                <td><b>:</b></td>
                <td>$bank_name</td>
                <td><b>Cheque/DD No.</b></td>
                <td><b>:</b></td>
                <td>$cheque_dd_no</td>
            </tr>
            <tr>
                <td  ><b>Cheque/DD Date</b></td>
                <td><b>:</b></td>
                <td>$cheque_dd_date</td>
                <td style=' font-size:13px; '><b>Cheque/DD Amount</b></td>
                <td><b>:</b></td>
                <td>$cheque_dd_amount</td>
            </tr>";
}
           echo" <tr>
                <td style=' height:4px; '></td>
            </tr>
            <tr>
                <td COLSPAN='6' class='fee_recipt_title_name'><b>Fine Discount Description</b></td>
            </tr>
            <tr>
                <td COLSPAN='6'><div class='horizental_line_silver'></div></td>
            </tr>
            <tr>
            <td>Description</td><td><b>:</b></td>
                <td colspan='4' style=' height:10px; '>$fine_discount_description</td>
            </tr>
            <tr>
            <td>Document</td><td><b>:</b></td>
                <td colspan='4' style=' height:10px; '><div class='button_document'>View</div></td>
            </tr>

             <tr>
                <td COLSPAN='6' class='fee_recipt_title_name'><b>Special Discount Description</b></td>
            </tr>
            <tr>
                <td COLSPAN='6'><div class='horizental_line_silver'></div></td>
            </tr>
            <tr>
            <td>Description</td><td><b>:</b></td>
                <td colspan='4' style=' height:10px; '>$special_discount_description</td>
            </tr>
            <tr>
            <td>Document</td><td><b>:</b></td>
                <td colspan='4' style=' height:10px; '><div class='button_document'>View</div></td>
            </tr>



            <tr>
                <td COLSPAN='6' class='fee_recipt_title_name'><b>Fee Description</b></td>
            </tr>
            <tr>
                <td COLSPAN='6'><div class='horizental_line_silver'></div></td>
            </tr>
            <tr>
                <td style=' height:40px; '>$payment_description</td>
            </tr>
            <tr>
                <td colspan='6'>WE THANKFULLY ACKNOWLEDGE THE RECEIPT OF $fetch_currency $amount_paid/-
                <br/>
               IN WORD <b> $amount_paid_in_word </b>ONLY
                </td>
            </tr>
            
            <tr>
                <td style=' height:0px; '></td>
            </tr>
            <tr>
                <td COLSPAN='6'><div class='horizental_line_black'></div></td>
            </tr>
            <tr>
                <td colspan='6' style=' text-align:center; height:30px;  '> <b>Powered By - DIGI SHIKSHA</b></td>
            </tr>
        </table>
            
        </div>  ";   
             
             
          }  
         }
         }
        
        ?>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>