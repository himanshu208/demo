
      <?php 
        if((!empty($_REQUEST['token_id'])))
        {
         
                      
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
            
          if(!empty($_REQUEST['add_on']))
          {
              echo '<div class="duplicate_error">Duplicate</div> '; 
          }
         
          
         $fee_payment_recipt_id=$_REQUEST['token_id'];
         
         $fee_payment_db=mysql_query("SELECT * FROM finance_student_pay_fee WHERE $db_main_details"
                 . " encrypt_id='$fee_payment_recipt_id' and is_delete='none'");
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
          
          
          $number_check=0;
          for($i=1;$i<=$print_copy;$i++)
          {
          
          echo "<div class='first_reciept_div' style='width:48%; margin-left:1%; float:left; margin-top:10px;'>
        
        <table class='first_table' style='font-size:10px;'> 
        <tr>
<td colspan='6'>
 <table cellspacing='0' style=' width:90%; margin-left:2%;'>
<tr>
<td style='width:70px;'> <img height='60px' src='../$school_logo'></td>
<td><center>$school_name</center><br/> <center>$school_address</center></td>    
</tr>
</table>
</td>        
</tr>
          <tr>
                <td COLSPAN='6'><div class='horizental_line_black'></div></td>
            </tr>
            <tr>
                <td COLSPAN='6' class='fee_recipt_title_name' style='text-align:center; font-size:13px; '><b>Fee Receipt</b></td>
            </tr>
            <tr>
                <td COLSPAN='6'><div class='horizental_line_black'></div></td>
            </tr>
            <tr>
                <td><b>Receipt No.</b></td>
                <td><b>:</b></td>
                <td><b>$recipt_no</b></td>
                  </tr>
                  <tr>
                <td><b>Payment Date</b></td>
                <td><b>:</b></td>
                <td><b>$payment_date</b></td>
            </tr>
            
            <tr>
                <td><b>S.R NO.</b></td>
                <td><b>:</b></td>
                <td><b>$sr_no</b></td>
            </tr>
            <tr>
<td><b>Class - Section</b></td>
                <td><b>:</b></td>
                <td><b>$course_name $section_name</b></td>           
</tr>
            
            <tr>
                <td><b>Student Name</b></td>
                <td><b>:</b></td>
                <td>$student_name</td>
                
            </tr>
             
            <tr>
                <td><b>Father Name</b></td>
                <td><b>:</b></td>
                <td>$father_name</td>
                    </tr>
                    <tr>
                <td><b>Mobile No. (Ho)</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$father_mobile_no</td>
            </tr>
            
            <tr>
                <td></td>
            </tr>
            <tr>
                <td COLSPAN='6'><div class='horizental_line_silver'></div></td>
            </tr>
            <tr>
                <td colspan='6'>
             <table cellspacing='0' cellpadding='0' class='fee_group_table'>
                
             <tr id='fee_heading' style='font-size:11px;'>
             <td style='text-align:left;'><b>Fee Details</b></td>
              <td style='text-align:right;'><b>Amount</b></td>
             <td style='text-align:center;'><b>Fee Description</b></td>
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
                <td style='text-align:center;'> $month_implode</td>
            
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
                    <b> Total Amount :</b> $fetch_currency ".number_format($total_payable_amount,2)."    
                </td>
            </tr>
            <tr>
                <td COLSPAN='8'><div class='horizental_line_silver'></div></td>
            </tr>
             </table>   
                </td>
            </tr>
            <tr>
<td colspan='6'>
<table style='width:100%;'>
          
         <tr>
              <td><b>Amt. Payable</b></td>
                <td><b>:</b></td>
                <td>$fetch_currency ".number_format($final_amount_payable,2)."</td>
                <td style='font-size:12px;'><b>Amt. Paid</b></td>
                <td style='font-size:12px;'><b>:</b></td>
                <td style='font-size:12px;'><b>$fetch_currency $amount_paid</b></td>
                
            </tr>
            <tr>
<td><b>$fee_name Amount</b></td>
<td><b>:</b></td>
<td>$fetch_currency $due_amount</td>    
    
<td><b>Payment Mode</b></td>
<td><b>:</b></td>
<td>$payment_mode</td>    
</tr>
</table>
</td>            
</tr>";


           echo" 
               <tr><td style='height:3px;'></td></tr>
            <tr>
                <td colspan='6' style='font-size:8px;'>WE THANKFULLY ACKNOWLEDGE THE RECEIPT OF $fetch_currency $amount_paid
                <br/>
               IN WORD <b> $amount_paid_in_word </b>ONLY
                </td>
            </tr>
            <tr>
<td style='height:20px;'></td>            
</tr>
            <tr>
                <td colspan='2'><b>Signature Of Depositor</b></td>
            
                <td style='text-align:right;'><b>Authorized Signatory</b></td>
            </tr>
            
            <tr>
                <td style=' height:0px; '></td>
            </tr>
            <tr>
                <td COLSPAN='6'><div class='horizental_line_black'></div></td>
            </tr>
            <tr>
                <td colspan='6' style=' text-align:center; height:0px; background-color:whitesmoke;  '> <b>Powered By -  Pixabyte Technologies Pvt. Ltd.</b></td>
            </tr>
            <tr>
                <td COLSPAN='6'><div class='horizental_line_black'></div></td>
            </tr>
        </table>
            
        </div> ";
     if($number_check==3)
     {
echo"<br/><h1 style='page-break-after:always'></h1>
        "; 
$number_check=0;
     }  else {
           
         $number_check++;
     }     
          }  
          }  
         }
         }
        
        ?>
        
        
        
        
        
        
        
        
        
        
        
        