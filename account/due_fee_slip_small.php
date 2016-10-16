<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
  <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
      
      <?php 
        if((!empty($_REQUEST['token_id'])))
        {
             
$student_encrypt_id=$_REQUEST['token_id'];
        
function dmyTime($dt)
{
    list ($d, $m, $y) = explode ('-', $dt);
    return strtotime("$y-$m-$d");
}
function dmyTimed($dtd)
{
    list ($d, $m, $y) = explode ('-', $dtd);
    return strtotime("$y-$m-$d");
}

date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$today_date=date("Y-m-d");
$date_time=$today_date." ".$time_current;
$month=date("M");
$year=date("Y");

$month_year=$month." ".$year;
         
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
        
 $clear_count=0;
 $next_page=0;
 
 $explode_id=$student_encrypt_id;
 $explode=explode(",",$explode_id);
 foreach ($explode as $student_id)
 {
        if(!empty($_REQUEST['s_id']))
        {
        $s_id=$_REQUEST['s_id'];  
        if($s_id=="true")
        {
        $student_search="T1.id='$student_id'";   
        }else
        {
         $student_search="T1.encrypt_id='$student_id'";      
        }
        }else
        {
         $student_search="T1.encrypt_id='$student_id'";  
        }
     
 
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
                 . " $db_t1_main_details $student_search and T1.is_delete='none'");
          $fetch_student_data=mysql_fetch_array($student_db);
          $fetch_student_num_rows=mysql_num_rows($student_db);
          if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
          {
          $clear_count++;
           $next_page++;   
              
          $sr_no=$fetch_student_data['id'];
          $student_id=$fetch_student_data['student_id'];
          $class_id=$fetch_student_data['course_id'];
          $course_id=$class_id;
          $category_id=$fetch_student_data['category_id'];
          $student_handicapped=$fetch_student_data['student_handicapped'];
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
         
          
          echo "<div class='first_reciept_div' style='width:47%; border:1px solid black; float:left;
              margin:1%; font-size:9px; margin-bottom:0; margin-top:1%;'>
        
        <table class='first_table' style='width:100%; padding:2%; padding-top:0; padding-bottom:0; font-size:9px;'> 
        <tr>
<td colspan='3'>
 <table cellspacing='0' style=' width:98%; margin:1%; font-size:9px;'>
<tr>
<td style='width:50px;'> <img height='45px' src='../$school_logo'></td>
<td><center><b>$fetch_school_name</b></center><br/> <center>$branch_adress</center></td>    
</tr>
</table>
</td>        
</tr>
          <tr>
                <td COLSPAN='3'><div class='horizental_line_black'></div></td>
            </tr>
            <tr>
                <td COLSPAN='3' class='fee_recipt_title_name' style='text-align:center; font-size:11px; '><b>Due Fee Slip</b></td>
            </tr>
            <tr>
                <td COLSPAN='3'><div class='horizental_line_black'></div></td>
            </tr>
            <tr>
                <td><b>Slip Print Date</b></td>
                <td><b>:</b></td>
                <td><b>$date_time</b></td>
            </tr>
            <tr>
                <td><b>Student Name</b></td>
                <td><b>:</b></td>
                <td>$student_name</td>
                    </tr>
                    <tr>
                <td><b>Course-Section</b></td>
                <td><b>:</b></td>
                <td><b>$course_name $section_name | $admitted_session_name</b></td>
            </tr>
            <tr>
                <td><b>Father Name</b></td>
                <td><b>:</b></td>
                <td>$father_name</td>
                    </tr>
                    <tr>
                <td><b>Mobile No. (Ho)</b></td>
                <td><b>:</b></td>
                <td>$father_mobile_no</td>
            </tr>
            <tr>
                <td></td>
            </tr>
       
            <tr>
                <td COLSPAN='3' class='fee_recipt_title_name' style='font-size:11px;'><b>Description</b></td>
            </tr>
            <tr>
                <td COLSPAN='3'><div class='horizental_line_silver'></div></td>
            </tr>
            <tr>
                <td colspan='3'>
             <table cellspacing='0' cellpadding='0' class='fee_group_table' style='font-size:9px;'>
                
             <tr id='fee_heading' style='font-size:10px;'>
             <td style='text-align:left;'><b>Fee</b></td>
             <td><b>Amount</b></td>
             <td style='text-align:center;'><b>Fee Description</b></td>
             <td><b>Total</b></td>
            </tr>
            <tr>
                <td style=' height:0px; '></td>
            </tr>
            <tr>
                <td COLSPAN='4'><div class='horizental_line_silver'></div></td>
            </tr>";
          
     
     $now_total_payable_fees=0;
     $now_fee_payable_amount=0;
     $now_fine_payable_amount=0;
     $now_discount_amount_payable=0;
     $now_finaly_amount_payable=0;
     $get_sub_total_amount=0;
     $fee_amount_dbs=mysql_query("SELECT *,T1.id as t1_id FROM financefeeamount as T1"
         . " LEFT JOIN financeaddfee as T2 ON T1.fee_id=T2.fee_id "
         . " LEFT JOIN financeaddfeegroup as T3 ON T1.fee_group_id=T3.fee_group_id"
         . " LEFT JOIN course_db as T4 ON T1.course_id=T4.course_id WHERE "
            . " $db_t1_main_details T1.fee_assign_to='class_fee_group' and T1.course_id='$class_id' and T1.action='active' "
            . " OR $db_t1_main_details T1.fee_assign_to='student_wise' and T1.student_id='$student_id' and T1.action='active'"); 
                           
     $fetch_fee_amount_num_rows=mysql_num_rows($fee_amount_dbs);
     while ($fetch_fee_amount_data=mysql_fetch_array($fee_amount_dbs))
         {
       
      
        $fetch_fee_amount_id=$fetch_fee_amount_data['fee_amount_id'];
        $fetch_fee_id=$fetch_fee_amount_data['fee_id'];
        $fetch_fee_group_id=$fetch_fee_amount_data['fee_group_id'];
        $fee_group_id=$fetch_fee_amount_data['fee_group_id'];
        $fetch_fee_amount=$fetch_fee_amount_data['feesamount'];
        $fine_option=$fetch_fee_amount_data['fine_option'];
        $fetch_fine_amount=$fetch_fee_amount_data['fineamount'];
        $fetch_applicable_status=$fetch_fee_amount_data['applicable_fee'];
        $transport_hostel_check=$fetch_fee_amount_data['hostelandtransportstatus'];
        $fetch_fee_group_name=ucwords($fetch_fee_amount_data['feegroupname']);
        $fetch_fee_group_type=ucfirst($fetch_fee_amount_data['feegrouptype']);
         $fetch_fee_name=$fetch_fee_amount_data['fee_name'];
        
         $tranport_hostel_active_on=1;
        
        
       if(($transport_hostel_check=="active")&&($fetch_fee_name=="Transport Fee"))
       {
            
        //transport fetch fees
   
       $student_dbed=mysql_query("SELECT *,T1.encrypt_id as ad_id,"
                 . "T10.description as transport_description FROM student_db as T1"
                 . " INNER JOIN student_allot_transport as T10 ON T1.transport_id=T10.transport_unique_id WHERE "
                 . " $db_t1_main_details T1.student_id='$student_id' and T1.is_delete='none' "
               . "and T10.is_delete='none'");
         $fetch_student_records=mysql_fetch_array($student_dbed);
         $fetch_student_num_rows=mysql_num_rows($student_dbed);   
         if((!empty($fetch_student_records))&&($fetch_student_records!=null)&&($fetch_student_num_rows!=0))
         {
            
         $transport_unique_id=$fetch_student_records['transport_unique_id']; 
         $transport_allot_db=mysql_query("SELECT * FROM student_allot_transport as T1 "
                 . " INNER JOIN transport_sub_route_db as T2 ON T1.sub_route=T2.sub_route_unique_id "
                 . " WHERE $db_t1_main_details T1.transport_unique_id='$transport_unique_id' and T1.is_delete='none'");
         $transport_allot_data=mysql_fetch_array($transport_allot_db);
         $transport_num_rows=mysql_num_rows($transport_allot_db);
         if((!empty($transport_allot_data))&&($transport_allot_data!=null)&&($transport_num_rows!=0))
         {
         $subroute_amount=$transport_allot_data['rent'];  
         $fetch_fee_amount=$subroute_amount;  
         $tranport_hostel_active=1;
         }else
         {
         $tranport_hostel_active=0;    
         }
         }else
         {
          $tranport_hostel_active=0;   
         }
         }else
         if(($transport_hostel_check=="active")&&($fetch_fee_name=="Hostel Fee"))
         {
                   
       $student_db=mysql_query("SELECT *,T1.encrypt_id as ad_id,T9.description as hostel_description"
                 . " FROM student_db as T1 "
                 . " INNER JOIN student_allot_hostel as T9 ON T1.hostel_id=T9.hostel_unique_id WHERE "
                 . " $db_t1_main_details T1.student_id='$student_id' and T1.is_delete='none' and T9.is_delete='none'");
         $fetch_student_record=mysql_fetch_array($student_db);
         $fetch_student_num_rows=mysql_num_rows($student_db);   
         if((!empty($fetch_student_record))&&($fetch_student_record!=null)&&($fetch_student_num_rows!=0))
         {
         $hostel_unique_id=$fetch_student_record['hostel_id']; 
         $hostel_allot_db=mysql_query("SELECT * FROM student_allot_hostel as T1 "
                 . "INNER JOIN hostel_room_db as T2 ON T1.room=T2.room_unique_id "
                 . "WHERE T1.hostel_unique_id='$hostel_unique_id' and T1.is_delete='none'");
         $hostel_allot_data=mysql_fetch_array($hostel_allot_db);
         $hostel_num_rows=mysql_num_rows($hostel_allot_db);
         if((!empty($hostel_allot_data))&&($hostel_allot_data!=null)&&($hostel_num_rows!=0))
         {
         $hostel_amount=$hostel_allot_data['rent']; 
         $fetch_fee_amount=$hostel_amount;   
         $tranport_hostel_active=1;
         }else
         {
         $tranport_hostel_active=0;    
         }
         }else
         {
         $tranport_hostel_active=0;    
         }
         }else
         {
          $tranport_hostel_active=1;   
         }
        
        
        if(!empty($fetch_applicable_status))
        {
           $student_admission=$fetch_student_data['admission_status']; 
        }else
        {
         $fetch_applicable_status="1";   
         $student_admission="1";
        }
        //condition check transport fees
        if($tranport_hostel_active_on==$tranport_hostel_active)
        {
        //condition check new fees
        if($fetch_applicable_status==$student_admission)
        {
   
            
             
            $number_rows=0; 
            $get_fee_qty=0;
            
           $get_sub_total_amount=0;
           $get_fine_amount=0;
           $get_discount_amount=0;
           $get_total_amount=0;
           $get_last_total_amount=0;
           $get_specify_month="";
           $old_month_array=array();
           $old_specific_month_array=array();
            
$print_sub_total_amount=0;
$print_total_discount_amount=0;
$print_total_fine_amount=0;
$print_total_amount=0;
            
        $fee_set_date_db=mysql_query("SELECT * FROM finance_fee_set_date_db WHERE fee_group_id='$fetch_fee_group_id' and is_delete='none'"); 
        while ($fee_set_date=mysql_fetch_array($fee_set_date_db))
        {
           $number_rows++; 
           $month=$fee_set_date['monthlyofmonth'];
         $fetch_specify_month=$month;
         
         $start_date=$fee_set_date['collectfeestartdate'];
         $due_date=$fee_set_date['collectfeeduedate'];   
         
         //calculate fine amount
         
         $days=floor((dmyTime($today_date)-dmyTime($due_date))/86400);
         $collect_fee_start=floor((dmyTime($start_date) - dmyTime($today_date))/86400);       
if($days>0)
{
  $due_days=$days;
  if($fine_option=="per_day")
  {
    $payble_fine_amount=$due_days*$fetch_fine_amount;
   
  }else
  {
 $payble_fine_amount=$fetch_fine_amount;    
  }
   $print_due_days=$due_days." days";
}
else 
{
 $payble_fine_amount=0; 
 $print_due_days="";
} 
$print_fine_amount=$payble_fine_amount;


//discount fee category wise

$fee_category_discount_db=mysql_query("SELECT * FROM financefeediscountcategory WHERE $db_main_details"
        . " course_id='$course_id' and fee_group_id='$fee_group_id' and category_id='$category_id'"
        . " and action='active'");
           $fetch_category_discount_data=mysql_fetch_array($fee_category_discount_db);
           $fetch_category_discount_num_rows=mysql_num_rows($fee_category_discount_db);
          if((!empty($fetch_category_discount_data))&&($fetch_category_discount_data!=null)&&($fetch_category_discount_num_rows!=0)) 
          {
           $fetch_fee_discount_type=$fetch_category_discount_data['discount_type'];
           if($fetch_fee_discount_type=="percantage")
           {
            
           $fetch_discount_rate=$fetch_category_discount_data['feediscount'];   
           $calculation_category_discount=(($fetch_discount_rate*$fetch_fee_amount)/100);
           $category_discount_amount=$calculation_category_discount;   
               
           }else
           {
           $fetch_discount_rate=$fetch_category_discount_data['feediscount'];   
           $category_discount_amount=$fetch_discount_rate;  
           }   
                
          }else
          {
           $category_discount_amount=0;   
          }
         
          //particular student discount
          $particular_student_discount=mysql_query("SELECT * FROM financefeediscountparticularstudent WHERE
             $db_main_details student_id='$student_id' and fee_group_id='$fee_group_id' and action='active'");
          $fetch_student_fee_discount_data=mysql_fetch_array($particular_student_discount);
          $fetch_student_fee_discount_num_rows=mysql_num_rows($particular_student_discount);
          if((!empty($fetch_student_fee_discount_data))&&($fetch_student_fee_discount_data!=null)&&($fetch_student_fee_discount_num_rows!=0))
          {
           $fetch_fee_discount_types=$fetch_student_fee_discount_data['discount_type'];
           if($fetch_fee_discount_types=="percantage")
           {
            
           $fetch_student_discount_rate=$fetch_student_fee_discount_data['feediscount'];   
           $calculation_particular_student_discount=(($fetch_student_discount_rate*$fetch_fee_amount)/100);
           $particluar_student_discount_amount=$calculation_particular_student_discount;   
               
           }else
           {
          $fetch_student_discount_rate=$fetch_student_fee_discount_data['feediscount'];
          $particluar_student_discount_amount=$fetch_student_discount_rate;  
           }   
          }  else {
          $particluar_student_discount_amount=0;    
          }
          
          //student handicapped discount
          $student_handicapped_db=mysql_query("SELECT * FROM financefeediscountstudenthandicapped WHERE $db_main_details"
                  . " feestudenthandicapped='$student_handicapped' and fee_group_id='$fee_group_id' and action='active'");
          $fetch_student_handicapped_data=mysql_fetch_array($student_handicapped_db);
          $fetch_student_handicapped_num_rows=mysql_num_rows($student_handicapped_db);
          if((!empty($fetch_student_handicapped_data))&&($fetch_student_handicapped_data!=null)&&($fetch_student_handicapped_num_rows!=0))
          {
            
           $fetch_fee_discount_typed=$fetch_student_handicapped_data['discount_type'];
           if($fetch_fee_discount_typed=="percantage")
           {
            
           $fetch_student_handicapped_discount_rate=$fetch_student_fee_discount_data['feediscount'];   
           $calculation_handicapped_student_discount=(($fetch_student_handicapped_discount_rate*$fetch_fee_amount)/100);
           $student_handicapped_discount_amount=$calculation_handicapped_student_discount;   
               
           }else
           {
         $fetch_student_handicapped_discount_rate=$fetch_student_fee_discount_data['feediscount']; 
          $student_handicapped_discount_amount=$fetch_student_handicapped_discount_rate;  
           }    
              
          }else
          {
              $student_handicapped_discount_amount=0;
          }
          
        $final_fee_discount_amount=($student_handicapped_discount_amount+$particluar_student_discount_amount+$category_discount_amount);
        $final_payable_fees_student=(($fetch_fee_amount+$payble_fine_amount)-$final_fee_discount_amount);
 
$print_total_discount_amount +=$final_fee_discount_amount;
$print_total_fine_amount +=$print_fine_amount;
$print_total_amount +=$final_payable_fees_student;


         $payment_check_db=mysql_query("SELECT * FROM finance_student_pay_fee as T1 "
                 . " LEFT JOIN finance_pay_fee_integrate_db as T2 ON T1.student_pay_fee_id=T2.pay_fee_id "
                 . " LEFT JOIN finance_pay_fee_month_db as T3 ON T1.student_pay_fee_id=T3.pay_fee_id "
                 . " WHERE $db_t1_main_details T1.student_id='$student_id' and T2.fee_group_id='$fetch_fee_group_id'"
                 . " and T3.fee_group_id='$fetch_fee_group_id' and T3.specify_month_term='$month' and T1.is_delete='none' and T1.status='cleared'");
        
         $payment_num_rows=mysql_num_rows($payment_check_db);
         if(empty($payment_num_rows)&&($payment_num_rows==0))
         {
        
         if($collect_fee_start<=0)
         {
                      $get_sub_total_amount +=$fetch_fee_amount; 
                      $get_fine_amount +=$payble_fine_amount;
                      $get_discount_amount +=$final_fee_discount_amount;
                      $get_last_total_amount +=$final_payable_fees_student;
                     
                      $get_specify_month = "<div class='show_month' id='show_month_$fetch_specify_month'>$fetch_specify_month,</div>";
                      array_push($old_month_array,$get_specify_month);
                      array_push($old_specific_month_array,$fetch_specify_month);
                                        
             
         $start_check="checked";   
         $get_fee_qty++;
         
         }else
         {
             $start_check="";   
           
              
         }
         }else
         {
             echo "<style>#fee_group_null_$fetch_fee_group_id { background-color:Red;}</style>";
         }
        


      {
                      ?>    
            
               <?php 
           }
          
         
if($days<0)
{
 echo "<style> #color_tr_$number_rows { background-color:wheat; } </style>";  
}else{
    
}
       }
                          
                                            

$specific_month_explode=implode(",",$old_specific_month_array);  
        if(!empty($get_fee_qty))  
        {
            echo"<tr class='fee_details_heading'>
                <td style='text-align:left;'>".ucwords($fetch_fee_group_name)."</td>
                <td><div class='div_td'>$fetch_fee_amount</div></td>
                <td style='text-align:center;'>$specific_month_explode</td>
                 <td><div class='div_td'>".number_format($get_last_total_amount,2)."</div></td>
                </tr>";
        }
       
                               $now_total_payable_fees +=($get_last_total_amount);
                               $now_fee_payable_amount +=($get_sub_total_amount);
                              
                              
                               $now_fine_payable_amount +=($get_fine_amount);
                               $now_discount_amount_payable +=($get_discount_amount);
                               $now_finaly_amount_payable +=($get_last_total_amount);
                                 
              
                              if($now_discount_amount_payable!=0)
                               {
                               $discount_rate=number_format((($now_discount_amount_payable*100)/$now_fee_payable_amount),2);
                               }  else {
                                  $discount_rate=0; 
                               }
        }
         }
         }
          

                               $total_due_amount=0;
                               $total_both_fine_or_due_amount=0;
                                $total_due_amount_fine=0;
                                
                               $insert_due_amount_id=0;
                               $number_row=0;
                               
                             
                               $due_amount_db=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE student_id='$student_id'
                               and is_delete='none' and status='pending' and action='active'");
                               while ($fetch_due_fee_amount_db=mysql_fetch_array($due_amount_db))
                               {
                               $fetch_due_amount_fee_id=$fetch_due_fee_amount_db['student_due_amount_id']; 
                               $fetch_due_payment_name=$fetch_due_fee_amount_db['payment_name']; 
                               $receipt_id=$fetch_due_fee_amount_db['receipt_id'];
                               $pay_fee_unqie_id=$fetch_due_fee_amount_db['student_pay_fee_id'];
                               $receipt_no=$fetch_due_fee_amount_db['reciept_no'];         
                               $fetch_due_amount=$fetch_due_fee_amount_db['due_amount']; 
                               $fetch_due_amount_payment_date=$fetch_due_fee_amount_db['payment_date']; 
  $number_row++;
                             if($fetch_due_payment_name=="Due Amount")
                             {
$due_amount_fine_rate=0;
$due_days=floor((dmyTime($today_date) - dmyTime($fetch_due_amount_payment_date))/86400);
if($due_days>0)
{
$due_amount_fine_amount=($due_days*$due_amount_fine_rate);
}  else {
  $due_amount_fine_amount=0;  
}

$final_payble_due_amount=($due_amount_fine_amount+$fetch_due_amount);

                             }else
                             {
                               $due_amount_fine_amount=0; 
                               $final_payble_due_amount=($fetch_due_amount);
     
                             }
                             $insert_due_amount_id++;
                             $static_unique_id="fee_due_pay";
                             $final_due_amount_unique_insert_id=$static_unique_id;
                             {
                         $due_amount_pay_month="Rec. No.: $receipt_id";      
                          $fee_encrypt_id=md5($pay_fee_unqie_id);    
                     if(!empty($final_payble_due_amount))
                     {
                 echo"<tr class='fee_details_heading'>
                <td style='text-align:left;'>".ucwords($fetch_due_payment_name)."</td>
                <td><div class='div_td'>$fetch_due_amount</div></td>
                <td style='text-align:center;'>$due_amount_pay_month</td>
                 <td><div class='div_td'>".number_format($final_payble_due_amount,2)."</div></td>
                </tr>";  
                     }          
                                 
                                 
                             $total_due_amount +=$fetch_due_amount;
                               $total_both_fine_or_due_amount +=$final_payble_due_amount;
                               $total_due_amount_fine +=$due_amount_fine_amount;
                               }
                               } 
                               
                               
                               
                        $now_total_payable_fees=($now_total_payable_fees+$total_both_fine_or_due_amount);
                               $now_fee_payable_amount=($now_fee_payable_amount+$total_due_amount);
                              
                              
                               $now_fine_payable_amount=($now_fine_payable_amount+$total_due_amount_fine);
                               $now_discount_amount_payable=($now_discount_amount_payable);
                               $now_finaly_amount_payable=($now_finaly_amount_payable+$total_both_fine_or_due_amount);
                          
                               if(empty($now_finaly_amount_payable))
                               {
                                   echo "<tr><td colspan=3>No Due Fee</td></tr>";   
                               }
                               
                               
                               
                          $amount_paid_in_word=strtoupper(convertNum($now_finaly_amount_payable));     
                            if(!empty($now_finaly_amount_payable))
                            {
                             $now_finaly_amount_payable=number_format($now_finaly_amount_payable,2);   
                            }
         
            
                            
                            
                            
                            
            echo" <tr>
                <td COLSPAN='4'><div class='horizental_line_silver'></div></td>
            </tr>
            <tr>
                <td colspan='4' style=' text-align: right;'>
                    <b> Total Due Amount :</b> $fetch_currency $now_finaly_amount_payable    
                </td>
            </tr>
            <tr>
                <td COLSPAN='4'><div class='horizental_line_silver'></div></td>
            </tr>
            <tr>
                <td colspan='4' style='font-size:8px;'>
IN WORD $amount_paid_in_word                
</td>
            </tr>
             <tr>
                <td COLSPAN='4'><div class='horizental_line_black'></div></td>
            </tr>
            <tr>
                <td colspan='4' style=' text-align:center; height:0px; '> <b>Powered By -  Pixabyte Technologies Pvt. Ltd.</b></td>
            </tr>
           
             </table>   
                </td>
            </tr>
            </table>
            
        </div>";
       
            if($clear_count==2)
            {
                echo "<div style='width:100%; float:left; height:1px; float:left;'></div>";   
             $clear_count=0;   
            }
            
            if($next_page==6)
            {
                
           echo"<br/><h1 style='page-break-after:always'></h1>";     
            $next_page=0;
            }
            
         
          }  
         }
        }
        
        ?>
        <?php
}
        ?>
        
        
        
        
        
        
        
        
        
        
        