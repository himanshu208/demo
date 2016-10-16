<?php
function due_amount($class_id,$student_id)
{
    
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
           $student_admission=$student_data['admission_status']; 
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
                 ?>
                 
                        
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                               <?php 
                                  
foreach ($old_month_array as $value_print)
{
  
}

$specific_month_explode=implode(",",$old_specific_month_array);
                                  ?> 
                                  
             <?php
       
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
             ?>
                               <?php
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
                               ?>
                               
                               
                            
                          
                <?php 
                  if(!empty($fetch_due_payment_name))
                  {
                      
                  {
                  ?>
                        
                <?php 
                  }
                  }else
                  {
                  {
                         ?>
                          

<?php 
                  }
                  }
?>
                   
                          
                          <?php
                          
                          $due_amount_pay_month="Rec. No.: $receipt_id";      
                          $fee_encrypt_id=md5($pay_fee_unqie_id);
                          ?>
                         
                             <?php 
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
                                
                               return $now_finaly_amount_payable;
                               }
                               ?>