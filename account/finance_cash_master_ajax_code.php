<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
       
      <?php 
        
        //fee group summary
        require_once '../connection.php';
        if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['currency']))&&
                (!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['page_no'])))
        {
         $fetch_school_id=$_REQUEST['org_id'];
         $fetch_branch_unique_db_id=$_REQUEST['branch_id'];
         $fetch_branch_id=$_REQUEST['branch_id'];
         $fecth_session_id_set=$_REQUEST['session_id'];
         $fetch_currency=$_REQUEST['currency'];
         $from_date=$_REQUEST['from_date'];
         $to_date=$_REQUEST['to_date'];
         $fee_group_id=$_REQUEST['fee_group_id'];
          
          
 $get_page_no=$_REQUEST['page_no'];
  $static_first_search_no=4;
  $minius_one=($get_page_no-1);
  $first_limit=($static_first_search_no*$minius_one);
  
  $add_page=($get_page_no+1);
  $dedut_page=($get_page_no-1);
  $next_page=$add_page;
  $previous_page=$dedut_page;
         
  $put_currency="<b style='color:red;'>$fetch_currency</b>";
  
  
  
  
         
         echo "<div id='first_hundred_div'>";
         
         
         //fee group id match
         if(!empty($fee_group_id))
         {
          $search_fee_group="and fee_group_id LIKE '%$fee_group_id%'";
          
         }else
         {
          $search_fee_group="";   
         }
        //payment date match
         if((!empty($from_date))&&(!empty($to_date)))
         {
         $search_date="and payment_date BETWEEN '$from_date' AND '$to_date'";      
         }else
         {
           $search_date="";  
         }
         
         
         
         
         
         
         $fee_array_insert=array();
         
         $search_fee_group_array=array();
         array_push($search_fee_group_array,$fee_group_id);
         
         $insert_array=array();
         $row=0;
         
         
         $total_fine_amount=0;
         $total_discount_amount=0;
         $total_due_amount=0;
         $total_extra_paid_amount=0;
         $total_amount_paid=0;
         $show_due_amount=0;
         
         $total_amount=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' $search_date $search_fee_group and is_delete='none' and status='cleared'");
         while ($details=mysql_fetch_array($total_amount))
         {
         $row++;
         $fetch_fee_group_id=$details['fee_group_id'];
         $explode_fee_group_id=explode(",",$fetch_fee_group_id);
         
         
         $fetch_recipt_id=$details['receipt_id'];
         $fetch_recipt_db_id=$details['id'];
        
         
         if(!empty($fee_group_id))
         {
          $match_fee_group_id=$search_fee_group_array; 
          $show_due_amount++;
         }else
         {
           $match_fee_group_id=explode(",",$fetch_fee_group_id); 
         }
         
        
         foreach ($match_fee_group_id as $fee_group_id_value)
         {
         
          
         $insert_array_match=in_array($fee_group_id_value, $insert_array);   
         if($insert_array_match!=true)
         {
         $last_total_amount=0;    
         $fl_array=preg_grep('/^'.$fee_group_id_value.'.*/',$explode_fee_group_id);
         foreach ($fl_array as $fee_group_ids)
         {
         
         $search_array=in_array($fee_group_ids,$explode_fee_group_id);
         if($search_array==true)
         {
       
         array_push($insert_array,$fee_group_id_value);   
             
             
             
        $total_fee_group_amount=0;
        $total_amount_db=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' $search_date and fee_group_id LIKE '%$fee_group_ids%'  and is_delete='none' and status='cleared'");
         while ($details_data=mysql_fetch_array($total_amount_db))
         {
          $fetch_fee_group_id=$details_data['fee_group_id'];
         $fetch_fee_group_amounts=unserialize($details_data['fee_sub_total_amount']);
         $explode_fee_group_ids=explode(",",$fetch_fee_group_id);
         
         
         $fl_array=preg_grep('/^'.$fee_group_ids.'.*/',$explode_fee_group_ids);
         foreach ($fl_array as $fee_group_ids)
         {
         
         $search_array=in_array($fee_group_ids,$explode_fee_group_ids);
         if($search_array==true)
         {   
               
         $total_fee_amount=$fetch_fee_group_amounts[$fee_group_ids];
         $total_fee_group_amount+=$total_fee_amount;    
         
         
         }
         }
         
         }
         
         
         $fee_group_or_other_fee=$fee_group_ids."#fee#".$total_fee_group_amount;
         
         
          $insert_check_array=in_array($fee_group_or_other_fee, $fee_array_insert);
         if($insert_check_array!=true)
         {
             array_push($fee_array_insert,$fee_group_or_other_fee);
         }
        }
         
         }
         
         
         
         }
         }
         
         
         $due_amount_db=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' and receipt_id='$fetch_recipt_id' and reciept_no='$fetch_recipt_db_id' and is_delete='none'");
         $fetch_due_amount_data=  mysql_fetch_array($due_amount_db);
         $fetch_due_amount_num_rows=  mysql_num_rows($due_amount_db);
         if((!empty($fetch_due_amount_data))&&($fetch_due_amount_data!=null)&&($fetch_due_amount_num_rows!=0))
         {
           $fetch_due_amount=$fetch_due_amount_data['due_amount'];
           if($fetch_due_amount<0)
           {
           $total_extra_paid_amount +=abs($fetch_due_amount);
           }else
           {
           $total_due_amount +=$fetch_due_amount;
           }
             
         }
         
         
         
         $fetch_fine_amount=$details['total_fine_amount'];
         $fetch_discount_amount=$details['total_discount_amount'];
         $fetch_fine_discount_amount=$details['fine_discount'];
         $fetch_special_discount_amount=$details['special_discount'];
         
         
         $total_paid_amount=$details['amount_paid'];
         
         $total_amount_paid +=$total_paid_amount;
         
         
         
         $temp_total_discount_amount=($fetch_special_discount_amount+$fetch_fine_discount_amount+$fetch_discount_amount);
         
         $total_fine_amount +=$fetch_fine_amount;
         $total_discount_amount +=$temp_total_discount_amount;
         
         
         }
         
         
         
         
        
         
         
         
       
         
        
         echo "<div class='top_fee_payment_summary'>
             <div class='top_compand_div'>
              <div class='top_menu_button' id='excel_button'>Excel</div>  
              <div class='top_menu_button' onclick='converted_pdf()' id='pdf_button'>Pdf</div>
                                           
<div class='top_menu_button' id='print_button'>Print</div> 
</div>
             
<table id='show_table' cellspacing=0 cellpadding=0 style='width:50%; height:auto; float:right; padding-top:2px;'>
<tr><td class='th_styling' >Fee Group/Fee</td><td class='th_styling' style=' border-left:0px; border-right:1px solid black; text-align:right;'>Balance</td></tr>";

         $total_amount_recive=0;
         foreach ($fee_array_insert as $particular_fee_or_amount)
         {
             
          $explode_two_fee_group_or_amount=explode("#fee#", $particular_fee_or_amount);
          
          $get_fee_group_id=$explode_two_fee_group_or_amount[0];
          $get_fee_group_amount=$explode_two_fee_group_or_amount[1];
          
          
          $fee_group_db=  mysql_query("SELECT * FROM  financeaddfeegroup WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . " and session_id='$fecth_session_id_set' and fee_group_id='$get_fee_group_id'");
         $fee_group_data=  mysql_fetch_array($fee_group_db);
         $fee_group_num_rows=  mysql_num_rows($fee_group_db);
         if((!empty($fee_group_data))&&($fee_group_data!=null)&&($fee_group_num_rows!=0))
         {
         $fetch_fee_group_name=$fee_group_data['feegroupname'];
        echo"<tr><td class='td_styling'>$fetch_fee_group_name</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $get_fee_group_amount/-</td></tr>";
     
           $total_amount_recive +=$get_fee_group_amount;  
             
         }
         }         
         
         
         $match_other_fee=preg_grep('/^FESGRP_OTHER_.*/',$fee_array_insert);
         if($match_other_fee==true)
         {
            $total_other_fee_amount=0;
             foreach ($match_other_fee as $other_fee_or_amount)
             {
               
              $explode_other_fee_or_amount=  explode("#fee#", $other_fee_or_amount); 
              $other_fee_amount=$explode_other_fee_or_amount[1];
              $total_other_fee_amount +=$other_fee_amount;
                 
                 
             }
           
             
          echo"<tr><td class='td_styling' >Other Fee</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_other_fee_amount/-</td></tr>";    
             
         }else
         {
          $total_other_fee_amount=0;   
         }
         
         
         
         if($show_due_amount!=0)
         {
         $match_due_fee=preg_grep('/^FESGRP_DUE_PAID_.*/',$fee_array_insert);
         if($match_due_fee==true)
         {
            $total_due_fee_amount=0;
             foreach ($match_due_fee as $due_fee_or_amount)
             {
               
              $explode_due_fee_or_amount=  explode("#fee#", $due_fee_or_amount); 
              $due_fee_amount=$explode_due_fee_or_amount[1];
              $total_due_fee_amount +=$due_fee_amount;
                 
                 
             }
           
             
          echo"<tr><td class='td_styling' >Collect Due Fee</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_due_fee_amount/-</td></tr>";    
             
         }else
         {
          $total_due_fee_amount=0;   
         }    
         }else
         {
           $total_due_fee_amount=0;  
         }
         
         
         
        if($show_due_amount==0)
         { 
         
         if((!empty($total_fine_amount))&&($total_fine_amount!=0))
         {
          echo"<tr><td class='td_styling' >Fine Amount</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_fine_amount/-</td></tr>";    
         }
         
         
         if((!empty($total_discount_amount))&&($total_discount_amount!=0))
         {
           echo"<tr><td class='td_styling'>Discount Amount</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency (-) $total_discount_amount/-</td></tr>";     
         }
         
         }else
         {
          $total_discount_amount=0; 
          $total_fine_amount=0;
         }
         
         if($show_due_amount==0)
         {
          if((!empty($total_extra_paid_amount))&&($total_extra_paid_amount!=0))
         {
           echo"<tr><td class='td_styling'>Extra Paid Amount</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_extra_paid_amount/-</td></tr>";     
         }
         
         }else
         {
           $total_extra_paid_amount=0;  
         }
         
         
         
         
         $final_amount_paid_student=(($total_amount_recive+$total_extra_paid_amount+$total_due_fee_amount+$total_other_fee_amount+$total_fine_amount)-$total_discount_amount);
         
         
         
         $match_equal_amount=($final_amount_paid_student-$total_due_amount);
       
         
         

echo"<tr><td class='td_styling' style=' background-color:whitesmoke;'>";
     if($show_due_amount==0)
         {
         echo"<b>Due  Balance :</b> $put_currency $total_due_amount/-";
         }
         
echo "</td><td class='td_styling' style='text-align:right; border-left:0px;"
         . " border-right:1px solid black; background-color:whitesmoke;'><b>Total Balance :</b> $put_currency $final_amount_paid_student/-</td></tr>


</table></div>";


         if(($total_amount_paid!=$match_equal_amount)&&($show_due_amount==0))
         {
             echo "<style>#show_table { display:none;} </style>";
             
             echo "<div style='width:50%; height:20px; padding-top:10px; float:right; color:red;'>Sorry,Technical Problem,Please Contact technical team.</div>";
             
         }


         
echo "<div class='top_compand_div' style='margin-top:10px;'>
    <div class='top_menu_button' id='excel_button'>Excel</div>  
              <div class='top_menu_button' onclick='converted_pdf()' id='pdf_button'>Pdf</div>
                                           
<div class='top_menu_button' id='print_button'>Print (0,50)</div>  
<div class='top_menu_button' id='print_button'>Print (All)</div> 
         </div>";





         echo '<table cellspacing="0" cellpadding="0" class="details_table" style="width:100%; margin-top:2px; margin-left:0;">
               <tr>
               <td class="top_heading_line">Sl No.</td>
               <td class="top_heading_line">Receipt No.</td>
               <td class="top_heading_line">Payment Date</td>
               <td class="top_heading_line">Class/Course-S</td>
               <td class="top_heading_line">Student Name</td>
               <td class="top_heading_line">Father Name</td>
               <td class="top_heading_line">Payment Mode</td>
               <td class="top_heading_line">Amount Payable</td>
               <td class="top_heading_line">Paid Amount</td>
               <td class="top_heading_line">Due Amount</td>
               <td class="top_heading_line">Status</td>
              <td class="top_heading_line" style=" border-right:1px solid black; ">Action</td>
              </tr>';
         
         
         
         
         $number_no_record=0;
               $row=0;
              $fee_payment_db= mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                      . " and session_id='$fecth_session_id_set' $search_date $search_fee_group ORDER BY id DESC");
              while ($fetch_fee_payment_data=mysql_fetch_array($fee_payment_db))
              {
               $row++;
                  $fee_payment_id=$fetch_fee_payment_data['id'];
                  $recipt_id=$fee_payment_id;
                  $fee_payment_date=$fetch_fee_payment_data['payment_date'];
                  $student_id=$fetch_fee_payment_data['student_id'];
                  $stduent_course_id=$fetch_fee_payment_data['course_id'];
                  $encrypt_id=$fetch_fee_payment_data['encrypt_id'];
                  $payment_mode=strtoupper($fetch_fee_payment_data['payment_mode']);
                  $amount_payable=$fetch_fee_payment_data['student_payable_amount'];
                  $amount_paid=$fetch_fee_payment_data['amount_paid'];
                  $due_amount=$fetch_fee_payment_data['due_amount'];
                  
               
                  $studnet_db=mysql_query("SELECT *,T1.encrypt_id as ad_id,T9.description as hostel_description,"
                 . "T10.description as transport_description FROM student_db as T1"
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
                 . " $db_t1_main_details T1.student_id='$student_id'");
         
                  $fetch_student_data=mysql_fetch_array($studnet_db);
                  $fetch_student_num_rows=mysql_num_rows($studnet_db);
                  if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
                  {
                    $student_name=$fetch_student_data['student_full_name'];
                    $father_name=$fetch_student_data['father_name'];
                    $father_mobile_no=$fetch_student_data['father_mobile_no'];
                    $section_id=$fetch_student_data['section_id'];
                    
                    if((!empty($get_section_id))&&($get_section_id==0))
                    {
                     $match_section_id=$section_id;  
                    }else
                    {
                     $match_section_id=0;   
                    }
                    
                  }else
                  {
                    $student_name="<b style='color:red;'>Missing</b>";
                    $father_name="<b style='color:red;'>Missing</b>";
                    $father_mobile_no="<b style='color:red;'>Missing</b>";
                    $section_id="";
                  }
                  
                  
                  
                  
                   $course_data_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and 
                session_id='$fecth_session_id_set' and course_id='$stduent_course_id'");
            $course_data_record=mysql_fetch_array($course_data_db);
            $course_data_num_rows=mysql_num_rows($course_data_db);
            if((!empty($course_data_record))&&($course_data_record!=null)&&($course_data_num_rows!=0))
            {
               $course_name=$course_data_record['course_name']; 
            }else
            {
              $course_name="";   
            }
                  
             $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and 
                session_id='$fecth_session_id_set' and section_id='$section_id'");   
             $section_data=mysql_fetch_array($section_db);
             $section_num_rows=  mysql_num_rows($section_db);
                  if((!empty($section_data))&&($section_data!=null)&&($section_num_rows!=0))
                  {
                  $section_name=$section_data['section_name'];   
                  }else
                  {
                      $section_name="";
                  }
                  
                  
                  
                  
                $payment_ststus=strtoupper($fetch_fee_payment_data['status']);
                if($payment_ststus=="CLEARED")
                {
                    $payment_ststuss="";
                 $payment_ststus="<div id='payment_status_$recipt_id' style='color:green;'><b>$payment_ststus</b></div>";   
                }else
                    if($payment_ststus=="PENDING")
                {
                        $payment_ststuss="";
                   $payment_ststus="<div id='payment_status_$recipt_id' style='color:orange;'><b>$payment_ststus</b></div>";       
                }else
                if($payment_ststus=="CANCEL")
                {
                    $payment_ststuss=$payment_ststus;
                   $payment_ststus="<div id='payment_status_$recipt_id' style='color:red;'><b>$payment_ststus</b></div>";       
                   
                   }
                 
                  echo "<tr><td class='td_heading_data'>$row</td>"
                          . "<td class='td_heading_data'>$recipt_id</td>"
                          . "<td class='td_heading_data'>$fee_payment_date</td>"
                          . "<td class='td_heading_data'>$course_name <b>-</b> $section_name</td>"
                          . "<td class='td_heading_data'>$student_name</td>"
                          . "<td class='td_heading_data'>$father_name</td>"
                          . "<td class='td_heading_data'>$payment_mode</td>"
                          . "<td class='td_heading_data' style='text-align:right; padding-right:8px;'><b style='color:red;'>$fetch_currency</b> $amount_payable</td>"
                          . "<td class='td_heading_data' style='text-align:right; padding-right:8px;'><b style='color:red;'>$fetch_currency</b> $amount_paid</td>"
                          . "<td class='td_heading_data' style='text-align:right; padding-right:8px;'><b style='color:red;'>$fetch_currency</b> $due_amount</td>"
                          . "<td class='td_heading_data'>$payment_ststus</td>"
                          . "<td class='td_heading_data' style='width:50px; border-right:1px solid black;'>";
                  {
                         ?>   
                        
                         <a style="color:blue;" href="#" onclick="window.open('finance_fee_view_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=670,width=870,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
                        <div class='view_button'>View</div></a>
                   
                   <?php 
                        }  
                          echo"</td></tr>";   
                          $number_no_record=1;
                  
              
              
              }
              
              $check_fee_payment_num_rows=mysql_num_rows($fee_payment_db);
              if(empty($number_no_record))
              {
                echo ' <tr>
                   <td style=" border:1px solid black; text-align:center; height:30px;
                      color:red; font-weight:bold;   border-top:0px;" colspan="14">Record no found !!</td>
               </tr>  ';    
              }else
              if((empty($fee_payment_id))&&(empty($check_fee_payment_num_rows)))
              {
                  echo ' <tr>
                   <td style=" border:1px solid black; text-align:center; height:30px;
                      color:red; font-weight:bold;   border-top:0px;" colspan="14">Record no found !!</td>
               </tr>  ';   
              }
              
             $count_total_rows_db=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                      . " and session_id='$fecth_session_id_set' $search_date $search_fee_group");
              $count_total_rows=  mysql_num_rows($count_total_rows_db);
              $show_page_number="4";
              $forward_page_devision=($count_total_rows/$show_page_number);
              $forward_page=ceil($forward_page_devision);
              $page=$get_page_no;
              $first_limit=($show_page_number*$page);
              $limit_search="$first_limit,$show_page_number";
              
             {
              ?>          
              <tr> <td style=" height:15px; "></td></tr>
              
            <?php 
             }
              if($count_total_rows>$show_page_number)
              {
              {
              ?>
                                <tr>
                                    <td colspan="14">
                                        <div id="forward_position">
                                        <?php 
                                           if($page>1)
                                          {
                                          {
                                          ?>  
                                            
                                        <div onclick="forward_page('<?php  echo $previous_page;?>')"  class="next_button">Previous</div>
                                      <?php 
                                          }
                                          }
                                        ?>
                                        
                                        
                                      <?php 
                                        for($i=1;$i<=$forward_page;$i++)
                                        {
                                        {
                                        ?>
                                    <?php 
                                      if($page==$i)
                                        {
                                        ?>
                                        <div id="selected_page" class="number_position"><?php  echo $i;?></div>
                                      <?php 
                                       }else
                                       {
                                       {
                                       ?>
                                        <div onclick="forward_page('<?php  echo $i;?>')" class="number_position"><?php  echo $i;?></div>
                                   <?php 
                                      }
                                      }
                                      ?>   
                                        
                                      <?php 
                                        }
                                        }
                                        ?>
                                      <?php 
                                        if($forward_page>$page)
                                        {
                                        {
                                        ?>
                                     <div onclick="forward_page('<?php  echo $next_page;?>')" class="next_button">Next</div>
                                      <?php 
                                        }
                                        }
                                       
                                        ?>
                                        
                                      </div>
                                        </td>
                                </tr>
                       <?php 
               
              }
              }
                        
             
    
         echo "</table></div>";
            
        }
        
        
        
        
        
        
        //due balance summary
            if((!empty($_REQUEST['due_org_id']))&&(!empty($_REQUEST['due_branch_id']))&&(!empty($_REQUEST['currency']))&&
                (!empty($_REQUEST['due_session_id']))&&(!empty($_REQUEST['page_no'])))
        {
         $fetch_school_id=$_REQUEST['due_org_id'];
         $fetch_branch_unique_db_id=$_REQUEST['due_branch_id'];
         $fetch_branch_id=$_REQUEST['due_branch_id'];
         $fecth_session_id_set=$_REQUEST['due_session_id'];
         $fetch_currency=$_REQUEST['currency'];
         $from_date=$_REQUEST['from_date'];
         $to_date=$_REQUEST['to_date'];
         $student_id=$_REQUEST['student_id'];
          
          
 $get_page_no=$_REQUEST['page_no'];
  $static_first_search_no=4;
  $minius_one=($get_page_no-1);
  $first_limit=($static_first_search_no*$minius_one);
  
  $add_page=($get_page_no+1);
  $dedut_page=($get_page_no-1);
  $next_page=$add_page;
  $previous_page=$dedut_page;
         
  $put_currency="<b style='color:red;'>$fetch_currency</b>";
  
  
  
   //STUDENT id match
         if(!empty($student_id))
         {
          $search_fee_group="and student_id='$student_id'";
          
         }else
         {
          $search_fee_group="";   
         }
        //payment date match
         if((!empty($from_date))&&(!empty($to_date)))
         {
         $search_date="and payment_date BETWEEN '$from_date' AND '$to_date'";      
         }else
         {
           $search_date="";  
         }
  
         
          echo "<div class='top_fee_payment_summary'>
             <div class='top_compand_div'>
              <div class='top_menu_button' id='excel_button'>Excel</div>  
              <div class='top_menu_button' onclick='converted_pdf()' id='pdf_button'>Pdf</div>
                                           
<div class='top_menu_button' id='print_button'>Print</div> 
</div>

<table id='show_table' cellspacing=0 cellpadding=0 style='width:50%; height:auto; float:right; padding-top:2px;'>
<tr><td class='th_styling' >Particulars</td><td class='th_styling' style=' border-left:0px; border-right:1px solid black; text-align:right;'>Amount</td></tr>";

$fetch_total_amount=mysql_query("SELECT organization_id,branch_id,session_id,is_delete,payment_date,student_id,SUM(due_amount) as total_due_amount FROM finance_student_due_amount_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                      . " and session_id='$fecth_session_id_set' $search_fee_group $search_date and payment_name='Due Amount' and is_delete='none'"); 
$total_due_amount_data= mysql_fetch_assoc($fetch_total_amount); 
$total_due_amount=abs($total_due_amount_data['total_due_amount']);  
echo"<tr><td class='td_styling'>Due Amount</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_due_amount/-</td></tr>";


$fetch_paid_total_amount=mysql_query("SELECT organization_id,branch_id,session_id,is_delete,payment_date,student_id,SUM(due_amount) as total_due_amount FROM finance_student_due_amount_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                      . " and session_id='$fecth_session_id_set' $search_fee_group $search_date and payment_name='Paid Amount' and is_delete='none'"); 
$total_paid_amount_data= mysql_fetch_assoc($fetch_paid_total_amount); 
$total_paid_amount=$total_paid_amount_data['total_due_amount'];  
echo"<tr><td class='td_styling'>Extra Paid Amount</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency ".abs($total_paid_amount)."/-</td></tr>";
 

echo"</table>
</div>
";
         
         
         
  echo "<div class='top_compand_div' style='margin-top:10px;'>
    <div class='top_menu_button' id='excel_button'>Excel</div>  
    <div class='top_menu_button' onclick='converted_pdf()' id='pdf_button'>Pdf</div>
                                           
<div class='top_menu_button' id='print_button'>Print (0,50)</div>  
<div class='top_menu_button' id='print_button'>Print (All)</div> 
         </div>";
  echo '<table cellspacing="0" cellpadding="0" class="details_table" style="width:100%; margin-top:2px; margin-left:0;">
               <tr>
               <td class="top_heading_line">Sl No.</td>
               <td class="top_heading_line">Payment Receipt No.</td>
               <td class="top_heading_line">Payment Date</td>
               <td class="top_heading_line">Class/Course-S</td>
               <td class="top_heading_line">Student Name</td>
               <td class="top_heading_line">Father Name</td>
               <td class="top_heading_line">Particular</td>
               <td class="top_heading_line">Amount</td>
               <td class="top_heading_line">Status</td>
              <td class="top_heading_line" style=" border-right:1px solid black; ">Action</td>
              </tr>';
  $row=0;
   $number_no_record=0;
 $due_balance_db=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                      . " and session_id='$fecth_session_id_set' $search_fee_group $search_date and is_delete='none'"); 
              while ($fetch_due_balance_data=  mysql_fetch_array($due_balance_db))
              {
               $row++;
               $fecth_student_id=$fetch_due_balance_data['student_id'];
               $fecth_class_id=$fetch_due_balance_data['course_id'];
               $fecth_payment_recipt_id=$fetch_due_balance_data['receipt_id'];
               $fecth_recipt_no=$fetch_due_balance_data['reciept_no'];
               $fee_pay_id=$fetch_due_balance_data['student_pay_fee_id'];
               $payment_name=$fetch_due_balance_data['payment_name'];
                $fee_payment_date= $fetch_due_balance_data['payment_date'];
                $fetch_payment_amount=$fetch_due_balance_data['due_amount'];
                
                
                
                
                
                $studnet_db=mysql_query("SELECT *,T1.encrypt_id as ad_id,T9.description as hostel_description,"
                 . "T10.description as transport_description FROM student_db as T1"
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
                 . " $db_t1_main_details T1.student_id='$fecth_student_id'");
         
                  $fetch_student_data=mysql_fetch_array($studnet_db);
                  $fetch_student_num_rows=mysql_num_rows($studnet_db);
                  if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
                  {
                    $student_name=$fetch_student_data['student_full_name'];
                    $father_name=$fetch_student_data['father_name'];
                    $father_mobile_no=$fetch_student_data['father_mobile_no'];
                    $section_id=$fetch_student_data['section_id'];
                    
                    if((!empty($get_section_id))&&($get_section_id==0))
                    {
                     $match_section_id=$section_id;  
                    }else
                    {
                     $match_section_id=0;   
                    }
                    
                  }else
                  {
                    $student_name="<b style='color:red;'>Missing</b>";
                    $father_name="<b style='color:red;'>Missing</b>";
                    $father_mobile_no="<b style='color:red;'>Missing</b>";
                    $section_id="";
                  }
                  
                  
                  
                  
                   $course_data_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and 
                session_id='$fecth_session_id_set' and course_id='$fecth_class_id'");
            $course_data_record=mysql_fetch_array($course_data_db);
            $course_data_num_rows=mysql_num_rows($course_data_db);
            if((!empty($course_data_record))&&($course_data_record!=null)&&($course_data_num_rows!=0))
            {
               $course_name=$course_data_record['course_name']; 
            }else
            {
              $course_name="";   
            }
                  
             $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and 
                session_id='$fecth_session_id_set' and section_id='$section_id'");   
             $section_data=mysql_fetch_array($section_db);
             $section_num_rows=  mysql_num_rows($section_db);
                  if((!empty($section_data))&&($section_data!=null)&&($section_num_rows!=0))
                  {
                  $section_name=$section_data['section_name'];   
                  }else
                  {
                      $section_name="";
                  }
                  
                  
               
             
                 echo "<tr><td class='td_heading_data'>$row</td>"
                          . "<td class='td_heading_data'>$fecth_payment_recipt_id</td>"
                          . "<td class='td_heading_data'>$fee_payment_date</td>"
                          . "<td class='td_heading_data'>$course_name <b>-</b> $section_name</td>"
                          . "<td class='td_heading_data'>$student_name</td>"
                          . "<td class='td_heading_data'>$father_name</td>"
                          . "<td class='td_heading_data'>$payment_name</td>"
                          . "<td class='td_heading_data' style='text-align:right; padding-right:8px;'><b style='color:red;'>$fetch_currency</b> $fetch_payment_amount</td>"
                          . "<td class='td_heading_data' style='text-align:center; padding-right:8px;'><b style='color:orange;'>Pending</b> </td>"
                          . "<td class='td_heading_data' style='border-right:1px solid black; width:45px;'>";
                        {
                         ?>
                           <a style="color:blue;" href="#" onclick="window.open('finance_fee_view_details.php?token_id=','size',config='height=670,width=870,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
                        <div class='view_button'>View</div></a>        
                        <?php 
                        }
                        echo"</td></tr>";
                        
                         $number_no_record=1;
                  }
                  
              $check_fee_payment_num_rows=mysql_num_rows($due_balance_db);
              if(empty($number_no_record))
              {
                echo ' <tr>
                   <td style=" border:1px solid black; text-align:center; height:30px;
                      color:red; font-weight:bold;   border-top:0px;" colspan="14">Record no found !!</td>
               </tr>  ';    
              }else
              if((empty($fecth_payment_recipt_id))&&(empty($check_fee_payment_num_rows)))
              {
                  echo ' <tr>
                   <td style=" border:1px solid black; text-align:center; height:30px;
                      color:red; font-weight:bold;   border-top:0px;" colspan="14">Record no found !!</td>
               </tr>  ';   
              }
  
  $count_total_rows_db=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                      . "and session_id='$fecth_session_id_set' $search_fee_group $search_date and is_delete='none'"); 
             
              $count_total_rows=mysql_num_rows($count_total_rows_db);
              $show_page_number="4";
              $forward_page_devision=($count_total_rows/$show_page_number);
              $forward_page=ceil($forward_page_devision);
              $page=$get_page_no;
              $first_limit=($show_page_number*$page);
              $limit_search="$first_limit,$show_page_number";
              
             {
              ?>          
              <tr> <td style=" height:15px; "></td></tr>
              
            <?php 
             }
              if($count_total_rows>$show_page_number)
              {
              {
              ?>
                                <tr>
                                    <td colspan="14">
                                        <div id="forward_position">
                                        <?php 
                                           if($page>1)
                                          {
                                          {
                                          ?>  
                                            
                                        <div onclick="forward_page('<?php  echo $previous_page;?>')"  class="next_button">Previous</div>
                                      <?php 
                                          }
                                          }
                                        ?>
                                        
                                        
                                      <?php 
                                        for($i=1;$i<=$forward_page;$i++)
                                        {
                                        {
                                        ?>
                                    <?php 
                                      if($page==$i)
                                        {
                                        ?>
                                        <div id="selected_page" class="number_position"><?php  echo $i;?></div>
                                      <?php 
                                       }else
                                       {
                                       {
                                       ?>
                                        <div onclick="forward_page('<?php  echo $i;?>')" class="number_position"><?php  echo $i;?></div>
                                   <?php 
                                      }
                                      }
                                      ?>   
                                        
                                      <?php 
                                        }
                                        }
                                        ?>
                                      <?php 
                                        if($forward_page>$page)
                                        {
                                        {
                                        ?>
                                     <div onclick="forward_page('<?php  echo $next_page;?>')" class="next_button">Next</div>
                                      <?php 
                                        }
                                        }
                                       
                                        ?>
                                        
                                      </div>
                                        </td>
                                </tr>
                       <?php 
               
              }
              }
              
              
              
              echo "</table>";
  
}
        
        
        
        
  //pending balance summary
require_once '../connection.php';
        if((!empty($_REQUEST['pending_bal_org_id']))&&(!empty($_REQUEST['pending_bal_branch_id']))&&(!empty($_REQUEST['currency']))&&
                (!empty($_REQUEST['pending_bal_session_id']))&&(!empty($_REQUEST['page_no'])))
        {
         $fetch_school_id=$_REQUEST['pending_bal_org_id'];
         $fetch_branch_unique_db_id=$_REQUEST['pending_bal_branch_id'];
         $fetch_branch_id=$_REQUEST['pending_bal_branch_id'];
         $fecth_session_id_set=$_REQUEST['pending_bal_session_id'];
         $fetch_currency=$_REQUEST['currency'];
         $from_date=$_REQUEST['from_date'];
         $to_date=$_REQUEST['to_date'];
         
          
 $get_page_no=$_REQUEST['page_no'];
  $static_first_search_no=4;
  $minius_one=($get_page_no-1);
  $first_limit=($static_first_search_no*$minius_one);
  
  $add_page=($get_page_no+1);
  $dedut_page=($get_page_no-1);
  $next_page=$add_page;
  $previous_page=$dedut_page;
         
  $put_currency="<b style='color:red;'>$fetch_currency</b>";
  
  
  
  
         
         echo "<div id='first_hundred_div'>";
         
         
         //fee group id match
         $fee_group_id="";
          $search_fee_group="";   
         
        //payment date match
         if((!empty($from_date))&&(!empty($to_date)))
         {
         $search_date="and payment_date BETWEEN '$from_date' AND '$to_date'";      
         }else
         {
           $search_date="";  
         }
         
         
         
         
         
         
         $fee_array_insert=array();
         
         $search_fee_group_array=array();
         array_push($search_fee_group_array,$fee_group_id);
         
         $insert_array=array();
         $row=0;
         
         
         $total_fine_amount=0;
         $total_discount_amount=0;
         $total_due_amount=0;
         $total_extra_paid_amount=0;
         $total_amount_paid=0;
         $show_due_amount=0;
         
         $total_amount=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' $search_date $search_fee_group and is_delete='none' and status='pending'");
         while ($details=mysql_fetch_array($total_amount))
         {
         $row++;
         $fetch_fee_group_id=$details['fee_group_id'];
         $explode_fee_group_id=explode(",",$fetch_fee_group_id);
         
         
         $fetch_recipt_id=$details['receipt_id'];
         $fetch_recipt_db_id=$details['id'];
        
         
         if(!empty($fee_group_id))
         {
          $match_fee_group_id=$search_fee_group_array; 
          $show_due_amount++;
         }else
         {
           $match_fee_group_id=explode(",",$fetch_fee_group_id); 
         }
         
        
         foreach ($match_fee_group_id as $fee_group_id_value)
         {
         
          
         $insert_array_match=in_array($fee_group_id_value, $insert_array);   
         if($insert_array_match!=true)
         {
         $last_total_amount=0;    
         $fl_array=preg_grep('/^'.$fee_group_id_value.'.*/',$explode_fee_group_id);
         foreach ($fl_array as $fee_group_ids)
         {
         
         $search_array=in_array($fee_group_ids,$explode_fee_group_id);
         if($search_array==true)
         {
       
         array_push($insert_array,$fee_group_id_value);   
             
             
             
        $total_fee_group_amount=0;
        $total_amount_db=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' $search_date and fee_group_id LIKE '%$fee_group_ids%'  and is_delete='none' and status='pending'");
         while ($details_data=mysql_fetch_array($total_amount_db))
         {
          $fetch_fee_group_id=$details_data['fee_group_id'];
         $fetch_fee_group_amounts=unserialize($details_data['fee_sub_total_amount']);
         $explode_fee_group_ids=explode(",",$fetch_fee_group_id);
         
         
         $fl_array=preg_grep('/^'.$fee_group_ids.'.*/',$explode_fee_group_ids);
         foreach ($fl_array as $fee_group_ids)
         {
         
         $search_array=in_array($fee_group_ids,$explode_fee_group_ids);
         if($search_array==true)
         {   
               
         $total_fee_amount=$fetch_fee_group_amounts[$fee_group_ids];
         $total_fee_group_amount+=$total_fee_amount;    
         
         
         }
         }
         
         }
         
         
         $fee_group_or_other_fee=$fee_group_ids."#fee#".$total_fee_group_amount;
         
         
          $insert_check_array=in_array($fee_group_or_other_fee, $fee_array_insert);
         if($insert_check_array!=true)
         {
             array_push($fee_array_insert,$fee_group_or_other_fee);
         }
        }
         
         }
         
         
         
         }
         }
         
         
         $due_amount_db=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' and receipt_id='$fetch_recipt_id' and reciept_no='$fetch_recipt_db_id' and is_delete='none'");
         $fetch_due_amount_data=  mysql_fetch_array($due_amount_db);
         $fetch_due_amount_num_rows=  mysql_num_rows($due_amount_db);
         if((!empty($fetch_due_amount_data))&&($fetch_due_amount_data!=null)&&($fetch_due_amount_num_rows!=0))
         {
           $fetch_due_amount=$fetch_due_amount_data['due_amount'];
           if($fetch_due_amount<0)
           {
           $total_extra_paid_amount +=abs($fetch_due_amount);
           }else
           {
           $total_due_amount +=$fetch_due_amount;
           }
             
         }
         
         
         
         $fetch_fine_amount=$details['total_fine_amount'];
         $fetch_discount_amount=$details['total_discount_amount'];
         $fetch_fine_discount_amount=$details['fine_discount'];
         $fetch_special_discount_amount=$details['special_discount'];
         
         
         $total_paid_amount=$details['amount_paid'];
         
         $total_amount_paid +=$total_paid_amount;
         
         
         
         $temp_total_discount_amount=($fetch_special_discount_amount+$fetch_fine_discount_amount+$fetch_discount_amount);
         
         $total_fine_amount +=$fetch_fine_amount;
         $total_discount_amount +=$temp_total_discount_amount;
         
         
         }
         
         
         
         
        
         
         
         
       
         
        
         echo "<div class='top_fee_payment_summary'>
             <div class='top_compand_div'>
              <div class='top_menu_button' id='excel_button'>Excel</div>  
              <div class='top_menu_button' onclick='converted_pdf()' id='pdf_button'>Pdf</div>
                                           
<div class='top_menu_button' id='print_button'>Print</div> 
</div>
             
<table id='show_table' cellspacing=0 cellpadding=0 style='width:60%; height:auto; margin:0 auto; padding-top:2px;'>
<tr><td class='th_styling' >Fee Group/Fee</td><td class='th_styling' style=' border-left:0px; border-right:1px solid black; text-align:right;'>Balance</td></tr>";

         $total_amount_recive=0;
         foreach ($fee_array_insert as $particular_fee_or_amount)
         {
             
          $explode_two_fee_group_or_amount=explode("#fee#", $particular_fee_or_amount);
          
          $get_fee_group_id=$explode_two_fee_group_or_amount[0];
          $get_fee_group_amount=$explode_two_fee_group_or_amount[1];
          
          
          $fee_group_db=  mysql_query("SELECT * FROM  financeaddfeegroup WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . " and session_id='$fecth_session_id_set' and fee_group_id='$get_fee_group_id'");
         $fee_group_data=  mysql_fetch_array($fee_group_db);
         $fee_group_num_rows=  mysql_num_rows($fee_group_db);
         if((!empty($fee_group_data))&&($fee_group_data!=null)&&($fee_group_num_rows!=0))
         {
         $fetch_fee_group_name=$fee_group_data['feegroupname'];
        echo"<tr><td class='td_styling'>$fetch_fee_group_name</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $get_fee_group_amount/-</td></tr>";
     
           $total_amount_recive +=$get_fee_group_amount;  
             
         }
         }         
         
         
         $match_other_fee=preg_grep('/^FESGRP_OTHER_.*/',$fee_array_insert);
         if($match_other_fee==true)
         {
            $total_other_fee_amount=0;
             foreach ($match_other_fee as $other_fee_or_amount)
             {
               
              $explode_other_fee_or_amount=  explode("#fee#", $other_fee_or_amount); 
              $other_fee_amount=$explode_other_fee_or_amount[1];
              $total_other_fee_amount +=$other_fee_amount;
                 
                 
             }
           
             
          echo"<tr><td class='td_styling' >Other Fee</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_other_fee_amount/-</td></tr>";    
             
         }else
         {
          $total_other_fee_amount=0;   
         }
         
         
         
         if($show_due_amount!=0)
         {
         $match_due_fee=preg_grep('/^FESGRP_DUE_PAID_.*/',$fee_array_insert);
         if($match_due_fee==true)
         {
            $total_due_fee_amount=0;
             foreach ($match_due_fee as $due_fee_or_amount)
             {
               
              $explode_due_fee_or_amount=  explode("#fee#", $due_fee_or_amount); 
              $due_fee_amount=$explode_due_fee_or_amount[1];
              $total_due_fee_amount +=$due_fee_amount;
                 
                 
             }
           
             
          echo"<tr><td class='td_styling' >Collect Due Fee</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_due_fee_amount/-</td></tr>";    
             
         }else
         {
          $total_due_fee_amount=0;   
         }    
         }else
         {
           $total_due_fee_amount=0;  
         }
         
         
         
        if($show_due_amount==0)
         { 
         
         if((!empty($total_fine_amount))&&($total_fine_amount!=0))
         {
          echo"<tr><td class='td_styling' >Fine Amount</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_fine_amount/-</td></tr>";    
         }
         
         
         if((!empty($total_discount_amount))&&($total_discount_amount!=0))
         {
           echo"<tr><td class='td_styling'>Discount Amount</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency (-) $total_discount_amount/-</td></tr>";     
         }
         
         }else
         {
          $total_discount_amount=0; 
          $total_fine_amount=0;
         }
         
         if($show_due_amount==0)
         {
          if((!empty($total_extra_paid_amount))&&($total_extra_paid_amount!=0))
         {
           echo"<tr><td class='td_styling'>Extra Paid Amount</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_extra_paid_amount/-</td></tr>";     
         }
         
         }else
         {
           $total_extra_paid_amount=0;  
         }
         
         
         
         
         $final_amount_paid_student=(($total_amount_recive+$total_extra_paid_amount+$total_due_fee_amount+$total_other_fee_amount+$total_fine_amount)-$total_discount_amount);
         
         
         
         $match_equal_amount=($final_amount_paid_student-$total_due_amount);
       
         
         

echo"<tr><td class='td_styling' style=' background-color:whitesmoke;'>";
     if($show_due_amount==0)
         {
         echo"<b>Due  Balance :</b> $put_currency $total_due_amount/-";
         }
         
echo "</td><td class='td_styling' style='text-align:right; border-left:0px;"
         . " border-right:1px solid black; background-color:whitesmoke;'><b>Total Balance :</b> $put_currency $final_amount_paid_student/-</td></tr>


</table></div>";


         if(($total_amount_paid!=$match_equal_amount)&&($show_due_amount==0))
         {
             echo "<style>#show_table { display:none;} </style>";
             
             echo "<div style='width:50%; height:20px; padding-top:10px; float:right; color:red;'>Sorry,Technical Problem,Please Contact technical team.</div>";
             
         }


        }
        
    
        
        
        
        
        
        
        
        
    //account search details    
        
     if((!empty($_REQUEST['account_org_id']))&&(!empty($_REQUEST['account_branch_id']))&&(!empty($_REQUEST['currency']))&&
                (!empty($_REQUEST['account_session_id']))&&(!empty($_REQUEST['page_no'])))
        {
         $fetch_school_id=$_REQUEST['account_org_id'];
         $fetch_branch_unique_db_id=$_REQUEST['account_branch_id'];
         $fetch_branch_id=$_REQUEST['account_branch_id'];
         $fecth_session_id_set=$_REQUEST['account_session_id'];
         $fetch_currency=$_REQUEST['currency'];
         $from_date=$_REQUEST['from_date'];
         $to_date=$_REQUEST['to_date'];
         $account_group_id=$_REQUEST['account_group_id'];
         $account_type=$_REQUEST['account_type'];
          
 $get_page_no=$_REQUEST['page_no'];
  $static_first_search_no=4;
  $minius_one=($get_page_no-1);
  $first_limit=($static_first_search_no*$minius_one);
  
  $add_page=($get_page_no+1);
  $dedut_page=($get_page_no-1);
  $next_page=$add_page;
  $previous_page=$dedut_page;
         
  $put_currency="<b style='color:red;'>$fetch_currency</b>";
  
   //account id match
         if(!empty($account_group_id))
         {
          $search_account_group="and account_name_id='$account_group_id'";
          
         }else
         {
          $search_account_group="";   
         }
       
        //payment date match
         if((!empty($from_date))&&(!empty($to_date)))
         {
         $search_date="and payment_date BETWEEN '$from_date' AND '$to_date'";      
         }else
         {
           $search_date="";  
         }
  
  
  echo "<div id='first_hundred_div'>";
         
  
         echo "<div class='top_fee_payment_summary'>
             <div class='top_compand_div'>
              <div class='top_menu_button' id='excel_button'>Excel</div>  
              <div class='top_menu_button' onclick='converted_pdf()' id='pdf_button'>Pdf</div>
                                           
<div class='top_menu_button' id='print_button'>Print</div> 
</div>
             
<table id='show_table' cellspacing=0 cellpadding=0 style='width:50%; height:auto; float:right; padding-top:2px;'>
<tr><td class='th_styling' >Account Group/Account</td><td class='th_styling' style=' border-left:0px; border-right:1px solid black; text-align:right;'>Balance</td></tr>";

$match_array=array();   
$total_balance=0;
$account_payment_db=mysql_query("SELECT * FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_type='$account_type' $search_date $search_account_group and status='cleared' and is_delete='none'");
while ($fetch_account_payment_data=mysql_fetch_array($account_payment_db))
{
 $fetch_account_id=$fetch_account_payment_data['account_name_id'];
  
 
 $search_match_array=in_array($fetch_account_id, $match_array);
 if($search_match_array!=true)
 {
  array_push($match_array,$fetch_account_id);   
  
 $total_account_balance_db=mysql_query("SELECT organization_id,branch_id,session_id,account_type,payment_date,account_name_id,SUM(paid_amount) as total_amount,status,is_delete FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' $search_date and account_type='$account_type' and account_name_id='$fetch_account_id' and status='cleared' and is_delete='none'");
 $fetch_total_amount=  mysql_fetch_assoc($total_account_balance_db);
 $total_income_expense_amount=$fetch_total_amount['total_amount'];
    
  $account_name_db=  mysql_query("SELECT * FROM financeaccountdetail WHERE organization_id='$fetch_school_id' and
                branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_id='$fetch_account_id'");
                $fetch_account_name_data=  mysql_fetch_array($account_name_db);
                $fetch_account_name_num_rows=mysql_num_rows($account_name_db);
                if((!empty($fetch_account_name_data))&&($fetch_account_name_data!=null)&&($fetch_account_name_num_rows!=0))
                {
                $account_name=$fetch_account_name_data['accountname'];   
                }else
                {
                 $account_name="Record missing";      
                }  
     
                
                
   echo"<tr><td class='td_styling' >$account_name</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_income_expense_amount/-</td></tr>";    
              
  $total_balance +=$total_income_expense_amount;             
 }
}         
         
echo"<tr><td class='td_styling' style=' background-color:whitesmoke;'>";
   
         echo"<b>Closing Balance :</b> $put_currency 0/-";
        
         
echo "</td><td class='td_styling' style='text-align:right; border-left:0px;"
         . " border-right:1px solid black; background-color:whitesmoke;'><b>Total Balance :</b> $put_currency $total_balance/-</td></tr>";
         
         
         
         
         
         
echo "</table></div>";
  




  if($account_type=="income")
                {
               $person_name="Depositor";     
                }else
                {
                $person_name="Receiver";     
                }




echo "<div class='top_compand_div' style='margin-top:10px;'>
    <div class='top_menu_button' id='excel_button'>Excel</div>  
              <div class='top_menu_button' onclick='converted_pdf()' id='pdf_button'>Pdf</div>
                                           
<div class='top_menu_button' id='print_button'>Print (0,50)</div>  
<div class='top_menu_button' id='print_button'>Print (All)</div> 
         </div>";
echo ' <table cellspacing="0" cellpadding="0" class="details_table" style="width:100%; margin-top:2px; margin-left:0;">
               <tr>
               <td class="top_heading_line">Sl No.</td>
               <td class="top_heading_line">Receipt No.</td>
               <td class="top_heading_line">Payment Date</td>
               <td class="top_heading_line">Account Group</td>
               <td class="top_heading_line">Account Name</td>
               <td class="top_heading_line">'.$person_name.' Name</td>
               <td class="top_heading_line">Mobile Number</td>
               <td class="top_heading_line">Payment Mode</td>
               <td class="top_heading_line">Amount</td>
               <td class="top_heading_line">Status</td>
              <td class="top_heading_line" style=" border-right:1px solid black; ">Action</td>
               </tr>';

$row=0;
               $payment_db=mysql_query("SELECT * FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_type='$account_type' $search_date $search_account_group and status='cleared' and is_delete='none'");
               while ($fetch_payment_data=mysql_fetch_array($payment_db))
               {
                $row++;
                $recipt_id=$fetch_payment_data['id'];
                $encrypt_id=$fetch_payment_data['encrypt_id'];
                $payment_date=$fetch_payment_data['payment_date'];  
                $account_group_id=$fetch_payment_data['account_group_id'];  
                $account_name_id=$fetch_payment_data['account_name_id'];  
                
                
              
                
                
                $account_group_db=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE organization_id='$fetch_school_id' and
                branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_head_id='$account_group_id'");
                $fetch_account_group_data=mysql_fetch_array($account_group_db);
                $fetch_account_group_num_rows=mysql_num_rows($account_group_db);
                if((!empty($fetch_account_group_data))&&($fetch_account_group_data!=null)&&($fetch_account_group_num_rows!=0))
                {
                    $account_group_name=ucfirst($fetch_account_group_data['accountheadgroupname']);
                }else
                {
                 $account_group_name="Record missing";   
                }
                
                $account_name_db=  mysql_query("SELECT * FROM financeaccountdetail WHERE organization_id='$fetch_school_id' and
                branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_id='$account_name_id'");
                $fetch_account_name_data=  mysql_fetch_array($account_name_db);
                $fetch_account_name_num_rows=mysql_num_rows($account_name_db);
                if((!empty($fetch_account_name_data))&&($fetch_account_name_data!=null)&&($fetch_account_name_num_rows!=0))
                {
                $account_name=$fetch_account_name_data['accountname'];   
                }else
                {
                 $account_name="Record missing";      
                }
                
                
                $depositor_name=$fetch_payment_data['depositor_name'];  
                $depositor_mobile_no=$fetch_payment_data['mobile_no'];  
                $payment_mode=strtoupper($fetch_payment_data['payment_mode']);  
                $amount_paid=number_format($fetch_payment_data['paid_amount'],2);  
                $payment_ststus=strtoupper($fetch_payment_data['status']);
                if($payment_ststus=="CLEARED")
                {
                    $payment_ststuss="";
                 $payment_ststus="<div id='payment_status_$recipt_id' style='color:green;'><b>$payment_ststus</b></div>";   
                }else
                    if($payment_ststus=="PENDING")
                {
                        $payment_ststuss="";
                   $payment_ststus="<div id='payment_status_$recipt_id' style='color:orange;'><b>$payment_ststus</b></div>";       
                }else
                if($payment_ststus=="CANCEL")
                {
                    $payment_ststuss=$payment_ststus;
                   $payment_ststus="<div id='payment_status_$recipt_id' style='color:red;'><b>$payment_ststus</b></div>";       
                   
                   }
                echo "<tr> <td class='td_heading_data'>$row</td>
                        <td class='td_heading_data'>$recipt_id</td>
                       <td class='td_heading_data'>$payment_date</td><td class='td_heading_data'>$account_group_name</td>"
                        . "<td class='td_heading_data'>$account_name</td>"
                        . "<td class='td_heading_data'>$depositor_name</td>"
                        . "<td class='td_heading_data'>$depositor_mobile_no</td>"
                        . "<td class='td_heading_data'>$payment_mode</td>"
                        . "<td class='td_heading_data'><b style='color:red;'>$fetch_currency</b> $amount_paid</td>"
                        . "<td class='td_heading_data'>$payment_ststus</td>"
                        . "";
                        echo "<td class='td_heading_data' style=' width:50px;border-right:1px solid black;'>";
                        {
                         ?>   
                        
                         <a style="color:blue;" href="#" onclick="window.open('account_view_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=530,width=900,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
                        <div class='view_button'>View</div></a>
                     
                   <?php 
                        }  
                     echo" </td>"
                        . "</tr>";   
               }
               $fetch_payment_num_rows=mysql_num_rows($payment_db);
               if((empty($recipt_id))&&(empty($fetch_payment_num_rows)))
               {
                   echo ' <tr>
                   <td colspan="11" class="alert_notification">Record no found !!</td>
               </tr>';  
               }


  echo "</div>";
}
        
        
        
   

//income summary

 require_once '../connection.php';
        if((!empty($_REQUEST['income_org_id']))&&(!empty($_REQUEST['income_branch_id']))&&(!empty($_REQUEST['currency']))&&
                (!empty($_REQUEST['income_session_id']))&&(!empty($_REQUEST['page_no'])))
        {
         $fetch_school_id=$_REQUEST['income_org_id'];
         $fetch_branch_unique_db_id=$_REQUEST['income_branch_id'];
         $fetch_branch_id=$_REQUEST['income_branch_id'];
         $fecth_session_id_set=$_REQUEST['income_session_id'];
         $fetch_currency=$_REQUEST['currency'];
         $from_date=$_REQUEST['from_date'];
         $to_date=$_REQUEST['to_date'];
          
         $fee_group_id=""; 
 $get_page_no=$_REQUEST['page_no'];
  $static_first_search_no=4;
  $minius_one=($get_page_no-1);
  $first_limit=($static_first_search_no*$minius_one);
  
  $add_page=($get_page_no+1);
  $dedut_page=($get_page_no-1);
  $next_page=$add_page;
  $previous_page=$dedut_page;
         
  $put_currency="<b style='color:red;'>$fetch_currency</b>";
  
  
   echo "<div id='first_hundred_div'>";
    //fee group id match
         if(!empty($fee_group_id))
         {
          $search_fee_group="and fee_group_id LIKE '%$fee_group_id%'";
          
         }else
         {
          $search_fee_group="";   
         }
        //payment date match
         if((!empty($from_date))&&(!empty($to_date)))
         {
         $search_date="and payment_date BETWEEN '$from_date' AND '$to_date'";      
         }else
         {
           $search_date="";  
         }
         
         
         
        $fee_array_insert=array();
         
         $search_fee_group_array=array();
         array_push($search_fee_group_array,$fee_group_id);
         
         $insert_array=array();
         $row=0;
         
         
         $total_fine_amount=0;
         $total_discount_amount=0;
         $total_due_amount=0;
         $total_extra_paid_amount=0;
         $total_amount_paid=0;
         $show_due_amount=0;
         
         $total_amount=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' $search_date $search_fee_group and is_delete='none' and status='cleared'");
         while ($details=mysql_fetch_array($total_amount))
         {
         $row++;
         $fetch_fee_group_id=$details['fee_group_id'];
         $explode_fee_group_id=explode(",",$fetch_fee_group_id);
         
         
         $fetch_recipt_id=$details['receipt_id'];
         $fetch_recipt_db_id=$details['id'];
        
         
         if(!empty($fee_group_id))
         {
          $match_fee_group_id=$search_fee_group_array; 
          $show_due_amount++;
         }else
         {
           $match_fee_group_id=explode(",",$fetch_fee_group_id); 
         }
         
        
         foreach ($match_fee_group_id as $fee_group_id_value)
         {
         
          
         $insert_array_match=in_array($fee_group_id_value, $insert_array);   
         if($insert_array_match!=true)
         {
         $last_total_amount=0;    
         $fl_array=preg_grep('/^'.$fee_group_id_value.'.*/',$explode_fee_group_id);
         foreach ($fl_array as $fee_group_ids)
         {
         
         $search_array=in_array($fee_group_ids,$explode_fee_group_id);
         if($search_array==true)
         {
       
         array_push($insert_array,$fee_group_id_value);   
             
             
             
        $total_fee_group_amount=0;
        $total_amount_db=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' $search_date and fee_group_id LIKE '%$fee_group_ids%'  and is_delete='none' and status='cleared'");
         while ($details_data=mysql_fetch_array($total_amount_db))
         {
          $fetch_fee_group_id=$details_data['fee_group_id'];
         $fetch_fee_group_amounts=unserialize($details_data['fee_sub_total_amount']);
         $explode_fee_group_ids=explode(",",$fetch_fee_group_id);
         
         
         $fl_array=preg_grep('/^'.$fee_group_ids.'.*/',$explode_fee_group_ids);
         foreach ($fl_array as $fee_group_ids)
         {
         
         $search_array=in_array($fee_group_ids,$explode_fee_group_ids);
         if($search_array==true)
         {   
               
         $total_fee_amount=$fetch_fee_group_amounts[$fee_group_ids];
         $total_fee_group_amount+=$total_fee_amount;    
         
         
         }
         }
         
         }
         
         
         $fee_group_or_other_fee=$fee_group_ids."#fee#".$total_fee_group_amount;
         
         
          $insert_check_array=in_array($fee_group_or_other_fee, $fee_array_insert);
         if($insert_check_array!=true)
         {
             array_push($fee_array_insert,$fee_group_or_other_fee);
         }
        }
         
         }
         
         
         
         }
         }
         
         
         $due_amount_db=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' and receipt_id='$fetch_recipt_id' and reciept_no='$fetch_recipt_db_id' and is_delete='none'");
         $fetch_due_amount_data=  mysql_fetch_array($due_amount_db);
         $fetch_due_amount_num_rows=  mysql_num_rows($due_amount_db);
         if((!empty($fetch_due_amount_data))&&($fetch_due_amount_data!=null)&&($fetch_due_amount_num_rows!=0))
         {
           $fetch_due_amount=$fetch_due_amount_data['due_amount'];
           if($fetch_due_amount<0)
           {
           $total_extra_paid_amount +=abs($fetch_due_amount);
           }else
           {
           $total_due_amount +=$fetch_due_amount;
           }
             
         }
         
         
         
         $fetch_fine_amount=$details['total_fine_amount'];
         $fetch_discount_amount=$details['total_discount_amount'];
         $fetch_fine_discount_amount=$details['fine_discount'];
         $fetch_special_discount_amount=$details['special_discount'];
         
         
         $total_paid_amount=$details['amount_paid'];
         
         $total_amount_paid +=$total_paid_amount;
         
         
         
         $temp_total_discount_amount=($fetch_special_discount_amount+$fetch_fine_discount_amount+$fetch_discount_amount);
         
         $total_fine_amount +=$fetch_fine_amount;
         $total_discount_amount +=$temp_total_discount_amount;
         
         
         }
         
         
         
         
        
         
         
         
       
         
        
         echo "<div class='top_fee_payment_summary'>
             <div class='top_compand_div'>
              <div class='top_menu_button' id='excel_button'>Excel</div>  
              <div class='top_menu_button' onclick='converted_pdf()' id='pdf_button'>Pdf</div>
                                           
<div class='top_menu_button' id='print_button'>Print</div> 
</div>
             
<table id='show_table' cellspacing=0 cellpadding=0 style='width:55%; height:auto; margin:0 auto; padding-top:2px;'>
<tr><td class='th_styling' >Particulars</td><td class='th_styling' style=' border-left:0px; border-right:1px solid black; text-align:right;'>Balance</td></tr>";

         $total_amount_recive=0;
         foreach ($fee_array_insert as $particular_fee_or_amount)
         {
             
          $explode_two_fee_group_or_amount=explode("#fee#", $particular_fee_or_amount);
          
          $get_fee_group_id=$explode_two_fee_group_or_amount[0];
          $get_fee_group_amount=$explode_two_fee_group_or_amount[1];
          
          
          $fee_group_db=  mysql_query("SELECT * FROM  financeaddfeegroup WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . " and session_id='$fecth_session_id_set' and fee_group_id='$get_fee_group_id'");
         $fee_group_data=  mysql_fetch_array($fee_group_db);
         $fee_group_num_rows=  mysql_num_rows($fee_group_db);
         if((!empty($fee_group_data))&&($fee_group_data!=null)&&($fee_group_num_rows!=0))
         {
         $fetch_fee_group_name=$fee_group_data['feegroupname'];
        echo"<tr><td class='td_styling'>$fetch_fee_group_name</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $get_fee_group_amount/-</td></tr>";
     
           $total_amount_recive +=$get_fee_group_amount;  
             
         }
         }         
         
         
         $match_other_fee=preg_grep('/^FESGRP_OTHER_.*/',$fee_array_insert);
         if($match_other_fee==true)
         {
            $total_other_fee_amount=0;
             foreach ($match_other_fee as $other_fee_or_amount)
             {
               
              $explode_other_fee_or_amount=  explode("#fee#", $other_fee_or_amount); 
              $other_fee_amount=$explode_other_fee_or_amount[1];
              $total_other_fee_amount +=$other_fee_amount;
                 
                 
             }
           
             
          echo"<tr><td class='td_styling' >Other Fee</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_other_fee_amount/-</td></tr>";    
             
         }else
         {
          $total_other_fee_amount=0;   
         }
         
         
         
         if($show_due_amount!=0)
         {
         $match_due_fee=preg_grep('/^FESGRP_DUE_PAID_.*/',$fee_array_insert);
         if($match_due_fee==true)
         {
            $total_due_fee_amount=0;
             foreach ($match_due_fee as $due_fee_or_amount)
             {
               
              $explode_due_fee_or_amount=  explode("#fee#", $due_fee_or_amount); 
              $due_fee_amount=$explode_due_fee_or_amount[1];
              $total_due_fee_amount +=$due_fee_amount;
                 
                 
             }
           
             
          echo"<tr><td class='td_styling' >Collect Due Fee</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_due_fee_amount/-</td></tr>";    
             
         }else
         {
          $total_due_fee_amount=0;   
         }    
         }else
         {
           $total_due_fee_amount=0;  
         }
         
         
         
        if($show_due_amount==0)
         { 
         
         if((!empty($total_fine_amount))&&($total_fine_amount!=0))
         {
          echo"<tr><td class='td_styling' >Fine Amount</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_fine_amount/-</td></tr>";    
         }
         
         
         if((!empty($total_discount_amount))&&($total_discount_amount!=0))
         {
           echo"<tr><td class='td_styling'>Discount Amount  <b style='font-size:11px; margin-left:10px;'>(Expense)</b></td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency (-) $total_discount_amount/-</td></tr>";     
         }
         
         }else
         {
          $total_discount_amount=0; 
          $total_fine_amount=0;
         }
         
         if($show_due_amount==0)
         {
          if((!empty($total_extra_paid_amount))&&($total_extra_paid_amount!=0))
         {
           echo"<tr><td class='td_styling'>Extra Paid Amount</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_extra_paid_amount/-</td></tr>";     
         }
         
         }else
         {
           $total_extra_paid_amount=0;  
         }
         

         
         
         
         
$match_array=array();   
$total_balance=0;
$account_payment_db=mysql_query("SELECT * FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_type='income' $search_date and status='cleared' and is_delete='none'");
while ($fetch_account_payment_data=mysql_fetch_array($account_payment_db))
{
 $fetch_account_id=$fetch_account_payment_data['account_name_id'];
  
 
 $search_match_array=in_array($fetch_account_id, $match_array);
 if($search_match_array!=true)
 {
  array_push($match_array,$fetch_account_id);   
  
 $total_account_balance_db=mysql_query("SELECT organization_id,branch_id,session_id,account_type,payment_date,account_name_id,SUM(paid_amount) as total_amount,status,is_delete FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' $search_date and account_type='income' and account_name_id='$fetch_account_id' and status='cleared' and is_delete='none'");
 $fetch_total_amount=  mysql_fetch_assoc($total_account_balance_db);
 $total_income_expense_amount=$fetch_total_amount['total_amount'];
    
  $account_name_db=  mysql_query("SELECT * FROM financeaccountdetail WHERE organization_id='$fetch_school_id' and
                branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_id='$fetch_account_id'");
                $fetch_account_name_data=  mysql_fetch_array($account_name_db);
                $fetch_account_name_num_rows=mysql_num_rows($account_name_db);
                if((!empty($fetch_account_name_data))&&($fetch_account_name_data!=null)&&($fetch_account_name_num_rows!=0))
                {
                $account_name=$fetch_account_name_data['accountname'];   
                }else
                {
                 $account_name="Record missing";      
                }  
     
                
                
   echo"<tr><td class='td_styling' >$account_name</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_income_expense_amount/-</td></tr>";    
              
  $total_balance +=$total_income_expense_amount;             
 }
}
         
         
         
         
         
         
         $final_amount_paid_student=(($total_amount_recive+$total_balance+$total_extra_paid_amount+$total_due_fee_amount+$total_other_fee_amount+$total_fine_amount)-$total_discount_amount);
         
         
         
         $match_equal_amount=($final_amount_paid_student-$total_due_amount);
       
         
         

echo"<tr><td class='td_styling' style=' background-color:whitesmoke;'>";
     if($show_due_amount==0)
         {
         echo"<b>Due  Balance :</b> $put_currency $total_due_amount/-";
         }
         
echo "</td><td class='td_styling' style='text-align:right; border-left:0px;"
         . " border-right:1px solid black; background-color:whitesmoke;'><b>Total Balance :</b> $put_currency $final_amount_paid_student/-</td></tr>


</table></div>";


         if((($total_amount_paid+$total_balance)!=$match_equal_amount)&&($show_due_amount==0))
         {
             echo "<style>#show_table { display:none;} </style>";
             
             echo "<div style='width:50%; height:20px; padding-top:10px; float:right; color:red;'>Sorry,Technical Problem,Please Contact technical team.</div>";
             
         }

  
         
   
   
   
   echo "</div>";
  
  
        }
        
        
        
  //expense summary search
        
    if((!empty($_REQUEST['expense_org_id']))&&(!empty($_REQUEST['expense_branch_id']))&&(!empty($_REQUEST['currency']))&&
                (!empty($_REQUEST['expense_session_id']))&&(!empty($_REQUEST['page_no'])))
        {
         $fetch_school_id=$_REQUEST['expense_org_id'];
         $fetch_branch_unique_db_id=$_REQUEST['expense_branch_id'];
         $fetch_branch_id=$_REQUEST['expense_branch_id'];
         $fecth_session_id_set=$_REQUEST['expense_session_id'];
         $fetch_currency=$_REQUEST['currency'];
         $from_date=$_REQUEST['from_date'];
         $to_date=$_REQUEST['to_date'];
          
         $fee_group_id=""; 
 $get_page_no=$_REQUEST['page_no'];
  $static_first_search_no=4;
  $minius_one=($get_page_no-1);
  $first_limit=($static_first_search_no*$minius_one);
  
  $add_page=($get_page_no+1);
  $dedut_page=($get_page_no-1);
  $next_page=$add_page;
  $previous_page=$dedut_page;
         
  $put_currency="<b style='color:red;'>$fetch_currency</b>";
  
  $fee_group_id="";
   //fee group id match
         if(!empty($fee_group_id))
         {
          $search_fee_group="and fee_group_id LIKE '%$fee_group_id%'";
          
         }else
         {
          $search_fee_group="";   
         }
        //payment date match
         if((!empty($from_date))&&(!empty($to_date)))
         {
         $search_date="and payment_date BETWEEN '$from_date' AND '$to_date'";      
         }else
         {
           $search_date="";  
         }
  
         
         
         
         
   echo "<div id='first_hundred_div'>";
     echo "<div class='top_fee_payment_summary'>
             <div class='top_compand_div'>
              <div class='top_menu_button' id='excel_button'>Excel</div>  
              <div class='top_menu_button' onclick='converted_pdf()' id='pdf_button'>Pdf</div>
                                           
<div class='top_menu_button' id='print_button'>Print</div> 
</div>
             
<table id='show_table' cellspacing=0 cellpadding=0 style='width:55%; height:auto; margin:0 auto; padding-top:2px;'>
<tr><td class='th_styling' >Particulars</td><td class='th_styling' style=' border-left:0px; border-right:1px solid black; text-align:right;'>Balance</td></tr>";
   
   $match_array=array();   
$total_balance=0;
$account_payment_db=mysql_query("SELECT * FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_type='expense' $search_date and status='cleared' and is_delete='none'");
while ($fetch_account_payment_data=mysql_fetch_array($account_payment_db))
{
 $fetch_account_id=$fetch_account_payment_data['account_name_id'];
  
 
 $search_match_array=in_array($fetch_account_id, $match_array);
 if($search_match_array!=true)
 {
  array_push($match_array,$fetch_account_id);   
  
 $total_account_balance_db=mysql_query("SELECT organization_id,branch_id,session_id,account_type,payment_date,account_name_id,SUM(paid_amount) as total_amount,status,is_delete FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' $search_date and account_type='expense' and account_name_id='$fetch_account_id' and status='cleared' and is_delete='none'");
 $fetch_total_amount=  mysql_fetch_assoc($total_account_balance_db);
 $total_income_expense_amount=$fetch_total_amount['total_amount'];
    
  $account_name_db=  mysql_query("SELECT * FROM financeaccountdetail WHERE organization_id='$fetch_school_id' and
                branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_id='$fetch_account_id'");
                $fetch_account_name_data=  mysql_fetch_array($account_name_db);
                $fetch_account_name_num_rows=mysql_num_rows($account_name_db);
                if((!empty($fetch_account_name_data))&&($fetch_account_name_data!=null)&&($fetch_account_name_num_rows!=0))
                {
                $account_name=$fetch_account_name_data['accountname'];   
                }else
                {
                 $account_name="Record missing";      
                }  
     
                
                
   echo"<tr><td class='td_styling' >$account_name</td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_income_expense_amount/-</td></tr>";    
              
  $total_balance +=$total_income_expense_amount;             
 }
}
   
echo"<tr><td class='td_styling' style=' background-color:whitesmoke;'>";
     
         echo"<b>Closing Balance :</b> $put_currency 0/-";
       
echo "</td><td class='td_styling' style='text-align:right; border-left:0px;"
         . " border-right:1px solid black; background-color:whitesmoke;'><b>Total Balance :</b> $put_currency $total_balance/-</td></tr>";



echo "</table>";
   echo "</div>";
   
   
   
        }
        
        
        
        
        
        
        
     //balance shett
     if((!empty($_REQUEST['bal_sheet_org_id']))&&(!empty($_REQUEST['bal_sheet_branch_id']))&&(!empty($_REQUEST['currency']))&&
                (!empty($_REQUEST['bal_sheet_session_id']))&&(!empty($_REQUEST['page_no'])))
        {
         $fetch_school_id=$_REQUEST['bal_sheet_org_id'];
         $fetch_branch_unique_db_id=$_REQUEST['bal_sheet_branch_id'];
         $fetch_branch_id=$_REQUEST['bal_sheet_branch_id'];
         $fecth_session_id_set=$_REQUEST['bal_sheet_session_id'];
         $fetch_currency=$_REQUEST['currency'];
         $from_date=$_REQUEST['from_date'];
         $to_date=$_REQUEST['to_date'];
          
         $fee_group_id=""; 
 $get_page_no=$_REQUEST['page_no'];
  $static_first_search_no=4;
  $minius_one=($get_page_no-1);
  $first_limit=($static_first_search_no*$minius_one);
  
  $add_page=($get_page_no+1);
  $dedut_page=($get_page_no-1);
  $next_page=$add_page;
  $previous_page=$dedut_page;
         
  $put_currency="<b style='color:red;'>$fetch_currency</b>";
  
  $fee_group_id="";
   //fee group id match
         if(!empty($fee_group_id))
         {
          $search_fee_group="and fee_group_id LIKE '%$fee_group_id%'";
          
         }else
         {
          $search_fee_group="";   
         }
        //payment date match
         if((!empty($from_date))&&(!empty($to_date)))
         {
         $search_date="and payment_date BETWEEN '$from_date' AND '$to_date'";      
         }else
         {
           $search_date="";  
         }
  
         $fee_array_insert=array();
         
         $search_fee_group_array=array();
         array_push($search_fee_group_array,$fee_group_id);
         
         $insert_array=array();
         $row=0;
         
         
         $total_fine_amount=0;
         $total_discount_amount=0;
         $total_due_amount=0;
         $total_extra_paid_amount=0;
         $total_amount_paid=0;
         $show_due_amount=0;
         
         $total_amount=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' $search_date $search_fee_group and is_delete='none' and status='cleared'");
         while ($details=mysql_fetch_array($total_amount))
         {
         $row++;
         $fetch_fee_group_id=$details['fee_group_id'];
         $explode_fee_group_id=explode(",",$fetch_fee_group_id);
         
         
         $fetch_recipt_id=$details['receipt_id'];
         $fetch_recipt_db_id=$details['id'];
        
         
         if(!empty($fee_group_id))
         {
          $match_fee_group_id=$search_fee_group_array; 
          $show_due_amount++;
         }else
         {
           $match_fee_group_id=explode(",",$fetch_fee_group_id); 
         }
         
        
         foreach ($match_fee_group_id as $fee_group_id_value)
         {
         
          
         $insert_array_match=in_array($fee_group_id_value, $insert_array);   
         if($insert_array_match!=true)
         {
         $last_total_amount=0;    
         $fl_array=preg_grep('/^'.$fee_group_id_value.'.*/',$explode_fee_group_id);
         foreach ($fl_array as $fee_group_ids)
         {
         
         $search_array=in_array($fee_group_ids,$explode_fee_group_id);
         if($search_array==true)
         {
       
         array_push($insert_array,$fee_group_id_value);   
             
             
             
        $total_fee_group_amount=0;
        $total_amount_db=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' $search_date and fee_group_id LIKE '%$fee_group_ids%'  and is_delete='none' and status='cleared'");
         while ($details_data=mysql_fetch_array($total_amount_db))
         {
          $fetch_fee_group_id=$details_data['fee_group_id'];
         $fetch_fee_group_amounts=unserialize($details_data['fee_sub_total_amount']);
         $explode_fee_group_ids=explode(",",$fetch_fee_group_id);
         
         
         $fl_array=preg_grep('/^'.$fee_group_ids.'.*/',$explode_fee_group_ids);
         foreach ($fl_array as $fee_group_ids)
         {
         
         $search_array=in_array($fee_group_ids,$explode_fee_group_ids);
         if($search_array==true)
         {   
               
         $total_fee_amount=$fetch_fee_group_amounts[$fee_group_ids];
         $total_fee_group_amount+=$total_fee_amount;    
         
         
         }
         }
         
         }
         
         
         $fee_group_or_other_fee=$fee_group_ids."#fee#".$total_fee_group_amount;
         
         
          $insert_check_array=in_array($fee_group_or_other_fee, $fee_array_insert);
         if($insert_check_array!=true)
         {
             array_push($fee_array_insert,$fee_group_or_other_fee);
         }
        }
         
         }
         
         
         
         }
         }
         
         
         $due_amount_db=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' and receipt_id='$fetch_recipt_id' and reciept_no='$fetch_recipt_db_id' and is_delete='none'");
         $fetch_due_amount_data=  mysql_fetch_array($due_amount_db);
         $fetch_due_amount_num_rows=  mysql_num_rows($due_amount_db);
         if((!empty($fetch_due_amount_data))&&($fetch_due_amount_data!=null)&&($fetch_due_amount_num_rows!=0))
         {
           $fetch_due_amount=$fetch_due_amount_data['due_amount'];
           if($fetch_due_amount<0)
           {
           $total_extra_paid_amount +=abs($fetch_due_amount);
           }else
           {
           $total_due_amount +=$fetch_due_amount;
           }
             
         }
         
         
         
         $fetch_fine_amount=$details['total_fine_amount'];
         $fetch_discount_amount=$details['total_discount_amount'];
         $fetch_fine_discount_amount=$details['fine_discount'];
         $fetch_special_discount_amount=$details['special_discount'];
         
         
         $total_paid_amount=$details['amount_paid'];
         
         $total_amount_paid +=$total_paid_amount;
         
         
         
         $temp_total_discount_amount=($fetch_special_discount_amount+$fetch_fine_discount_amount+$fetch_discount_amount);
         
         $total_fine_amount +=$fetch_fine_amount;
         $total_discount_amount +=$temp_total_discount_amount;
         
         
         }
         
         
         
         
         
         
         
   echo "<div id='first_hundred_div'>";
     echo "<div class='top_fee_payment_summary'>
             <div class='top_compand_div'>
              <div class='top_menu_button' id='excel_button'>Excel</div>  
              <div class='top_menu_button' onclick='converted_pdf()' id='pdf_button'>Pdf</div>
                                           
<div class='top_menu_button' id='print_button'>Print</div> 
</div>
             
<table id='show_table' cellspacing=0 cellpadding=0 style='width:70%; height:auto; margin:0 auto; padding-top:2px;'>
<tr><td class='th_styling' >Particulars</td>
<td class='th_styling' style=' border-left:0px; text-align:right;'>Income Balance</td>

<td class='th_styling' style=' border-left:0px; border-right:1px solid black; text-align:right;'>Expense Balance</td></tr>";

      $total_amount_recive=0;
         foreach ($fee_array_insert as $particular_fee_or_amount)
         {
             
          $explode_two_fee_group_or_amount=explode("#fee#", $particular_fee_or_amount);
          
          $get_fee_group_id=$explode_two_fee_group_or_amount[0];
          $get_fee_group_amount=$explode_two_fee_group_or_amount[1];
          
          
          $fee_group_db=  mysql_query("SELECT * FROM  financeaddfeegroup WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . " and session_id='$fecth_session_id_set' and fee_group_id='$get_fee_group_id'");
         $fee_group_data=  mysql_fetch_array($fee_group_db);
         $fee_group_num_rows=  mysql_num_rows($fee_group_db);
         if((!empty($fee_group_data))&&($fee_group_data!=null)&&($fee_group_num_rows!=0))
         {
         $fetch_fee_group_name=$fee_group_data['feegroupname'];
        echo"<tr><td class='td_styling'>$fetch_fee_group_name</td>"
                . "<td class='td_styling' style='text-align:right; '>$put_currency $get_fee_group_amount/-</td><td class='td_styling' style='text-align:right; border-right:1px solid black;'></td></tr>";
     
           $total_amount_recive +=$get_fee_group_amount;  
             
         }
         }         
         
         
         $match_other_fee=preg_grep('/^FESGRP_OTHER_.*/',$fee_array_insert);
         if($match_other_fee==true)
         {
            $total_other_fee_amount=0;
             foreach ($match_other_fee as $other_fee_or_amount)
             {
               
              $explode_other_fee_or_amount=  explode("#fee#", $other_fee_or_amount); 
              $other_fee_amount=$explode_other_fee_or_amount[1];
              $total_other_fee_amount +=$other_fee_amount;
                 
                 
             }
           
             
          echo"<tr><td class='td_styling' >Other Fee</td>"
                . "<td class='td_styling' style='text-align:right;'>$put_currency $total_other_fee_amount/-</td><td class='td_styling' style='text-align:right; border-right:1px solid black;'></td></tr>";    
             
         }else
         {
          $total_other_fee_amount=0;   
         }
         
         
         
         if($show_due_amount!=0)
         {
         $match_due_fee=preg_grep('/^FESGRP_DUE_PAID_.*/',$fee_array_insert);
         if($match_due_fee==true)
         {
            $total_due_fee_amount=0;
             foreach ($match_due_fee as $due_fee_or_amount)
             {
               
              $explode_due_fee_or_amount=  explode("#fee#", $due_fee_or_amount); 
              $due_fee_amount=$explode_due_fee_or_amount[1];
              $total_due_fee_amount +=$due_fee_amount;
                 
                 
             }
           
             
          echo"<tr><td class='td_styling' >Collect Due Fee</td>"
                . "<td class='td_styling' style='text-align:right;'>$put_currency $total_due_fee_amount/-</td><td class='td_styling' style='text-align:right; border-right:1px solid black;'></td></tr>";    
             
         }else
         {
          $total_due_fee_amount=0;   
         }    
         }else
         {
           $total_due_fee_amount=0;  
         }
         
         
         
        if($show_due_amount==0)
         { 
         
         if((!empty($total_fine_amount))&&($total_fine_amount!=0))
         {
          echo"<tr><td class='td_styling' >Fine Amount</td>"
                . "<td class='td_styling' style='text-align:right;'>$put_currency $total_fine_amount/-</td><td class='td_styling' style='text-align:right; border-right:1px solid black;'></td></tr>";    
         }
         
         
         if((!empty($total_discount_amount))&&($total_discount_amount!=0))
         {
           echo"<tr><td class='td_styling'>Discount Amount </td>"
                . "<td class='td_styling' style='text-align:right;'></td><td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_discount_amount/-</td></tr>";     
         }
         
         }else
         {
          $total_discount_amount=0; 
          $total_fine_amount=0;
         }
         
         if($show_due_amount==0)
         {
          if((!empty($total_extra_paid_amount))&&($total_extra_paid_amount!=0))
         {
           echo"<tr><td class='td_styling'>Extra Paid Amount</td>"
                . "<td class='td_styling' style='text-align:right;'>$put_currency $total_extra_paid_amount/-</td><td class='td_styling' style='text-align:right; border-right:1px solid black;'></td></tr>";     
         }
         
         }else
         {
           $total_extra_paid_amount=0;  
         }
         

         
         
         
         
$match_array=array();   
$total_balance=0;
$account_payment_db=mysql_query("SELECT * FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_type='income' $search_date and status='cleared' and is_delete='none'");
while ($fetch_account_payment_data=mysql_fetch_array($account_payment_db))
{
 $fetch_account_id=$fetch_account_payment_data['account_name_id'];
  
 
 $search_match_array=in_array($fetch_account_id, $match_array);
 if($search_match_array!=true)
 {
  array_push($match_array,$fetch_account_id);   
  
 $total_account_balance_db=mysql_query("SELECT organization_id,branch_id,session_id,account_type,payment_date,account_name_id,SUM(paid_amount) as total_amount,status,is_delete FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' $search_date and account_type='income' and account_name_id='$fetch_account_id' and status='cleared' and is_delete='none'");
 $fetch_total_amount=  mysql_fetch_assoc($total_account_balance_db);
 $total_income_expense_amount=$fetch_total_amount['total_amount'];
    
  $account_name_db=  mysql_query("SELECT * FROM financeaccountdetail WHERE organization_id='$fetch_school_id' and
                branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_id='$fetch_account_id'");
                $fetch_account_name_data=  mysql_fetch_array($account_name_db);
                $fetch_account_name_num_rows=mysql_num_rows($account_name_db);
                if((!empty($fetch_account_name_data))&&($fetch_account_name_data!=null)&&($fetch_account_name_num_rows!=0))
                {
                $account_name=$fetch_account_name_data['accountname'];   
                }else
                {
                 $account_name="Record missing";      
                }  
     
                
                
   echo"<tr><td class='td_styling' >$account_name</td>"
                . "<td class='td_styling' style='text-align:right; '>$put_currency $total_income_expense_amount/-</td><td class='td_styling' style='text-align:right; border-right:1px solid black;'></td></tr>";    
              
  $total_balance +=$total_income_expense_amount;             
 }
}
         
         
         
         
         
         
         $final_amount_paid_student=(($total_amount_recive+$total_balance+$total_extra_paid_amount+$total_due_fee_amount+$total_other_fee_amount+$total_fine_amount));
         $match_equal_amount=($final_amount_paid_student-$total_due_amount);
         
         $total_amount_paid_student=($total_amount_paid+$total_balance+$total_discount_amount);
         

     
     
     
$match_array=array();   
$total_expense_balance=0;
$expense_account_payment_db=mysql_query("SELECT * FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_type='expense' $search_date and status='cleared' and is_delete='none'");
while ($fetch_account_payment_data=mysql_fetch_array($expense_account_payment_db))
{
 $fetch_account_id=$fetch_account_payment_data['account_name_id'];
  
 
 $search_match_array=in_array($fetch_account_id, $match_array);
 if($search_match_array!=true)
 {
  array_push($match_array,$fetch_account_id);   
  
 $total_account_balance_db=mysql_query("SELECT organization_id,branch_id,session_id,account_type,payment_date,account_name_id,SUM(paid_amount) as total_amount,status,is_delete FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' $search_date and account_type='expense' and account_name_id='$fetch_account_id' and status='cleared' and is_delete='none'");
 $fetch_total_amount=  mysql_fetch_assoc($total_account_balance_db);
 $total_income_expense_amount=$fetch_total_amount['total_amount'];
    
  $expense_account_name_db=  mysql_query("SELECT * FROM financeaccountdetail WHERE organization_id='$fetch_school_id' and
                branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_id='$fetch_account_id'");
                $fetch_account_name_data=  mysql_fetch_array($expense_account_name_db);
                $fetch_account_name_num_rows=mysql_num_rows($expense_account_name_db);
                if((!empty($fetch_account_name_data))&&($fetch_account_name_data!=null)&&($fetch_account_name_num_rows!=0))
                {
                $expense_account_name=$fetch_account_name_data['accountname'];   
                }else
                {
                 $expense_account_name="Record missing";      
                }  
     
                
                
   echo"<tr><td class='td_styling' >$expense_account_name</td><td class='td_styling' style='text-align:right;'></td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_income_expense_amount/-</td></tr>";    
              
  $total_expense_balance +=$total_income_expense_amount;             
 }
}
   










$total_expense_amount=($total_expense_balance+$total_discount_amount);

$profit_balance=($final_amount_paid_student-$total_expense_amount);

if($profit_balance<0)
{
$profit_name="Loss";
$profit_balance=$profit_balance;
}else
{
 $profit_name="Profit";
$profit_balance=$profit_balance;   
}


if($profit_balance!=0)
{
   $profit_balance=number_format($profit_balance,2); 
}else
{
    $profit_balance=$profit_balance;
}


if($final_amount_paid_student!=0)
{
 $final_amount_paid_student=number_format($final_amount_paid_student,2);   
}  else {
   $final_amount_paid_student=$final_amount_paid_student; 
}

if($total_expense_amount!=0)
{
 $total_expense_amount=  number_format($total_expense_amount,2);   
}  else {
  $total_expense_amount=$total_expense_amount;  
}

echo"<tr><td class='td_styling' style=' background-color:whitesmoke;'>";
     
         echo"<b>Total $profit_name Balance :</b> $put_currency $profit_balance/-";
       
echo "</td><td class='td_styling' style=' background-color:whitesmoke; text-align:right; border-left:0px;'><b>Total Income Balance :</b> $put_currency $final_amount_paid_student/-</td><td class='td_styling' style='text-align:right; border-left:0px;"
         . " border-right:1px solid black; background-color:whitesmoke;'><b>Total Expense Balance :</b> $put_currency $total_expense_amount/-</td></tr>";



echo "</table>";




 if(($total_amount_paid_student!=$match_equal_amount)&&($show_due_amount==0))
         {
             echo "<style>#show_table { display:none;} </style>";
             
             echo "<div style='width:50%; height:20px; padding-top:10px; float:right; color:red;'>Sorry,Technical Problem,Please Contact technical team.</div>";
             
         }



   echo "</div>";
   
   
   
        }
           
        
        
     
        
        
        
        
        
        
        
        
        
        
        
        
          //day book summary
     if((!empty($_REQUEST['day_book_org_id']))&&(!empty($_REQUEST['day_book_branch_id']))&&(!empty($_REQUEST['currency']))&&
                (!empty($_REQUEST['day_book_session_id']))&&(!empty($_REQUEST['page_no'])))
        {
         $fetch_school_id=$_REQUEST['day_book_org_id'];
         $fetch_branch_unique_db_id=$_REQUEST['day_book_branch_id'];
         $fetch_branch_id=$_REQUEST['day_book_branch_id'];
         $fecth_session_id_set=$_REQUEST['day_book_session_id'];
         $fetch_currency=$_REQUEST['currency'];
         $from_date=$_REQUEST['from_date'];
         $to_date=$_REQUEST['to_date'];
          
         $fee_group_id=""; 
 $get_page_no=$_REQUEST['page_no'];
  $static_first_search_no=4;
  $minius_one=($get_page_no-1);
  $first_limit=($static_first_search_no*$minius_one);
  
  $add_page=($get_page_no+1);
  $dedut_page=($get_page_no-1);
  $next_page=$add_page;
  $previous_page=$dedut_page;
         
  $put_currency="<b style='color:red;'>$fetch_currency</b>";
  
  $fee_group_id="";
   //fee group id match
         if(!empty($fee_group_id))
         {
          $search_fee_group="and fee_group_id LIKE '%$fee_group_id%'";
          
         }else
         {
          $search_fee_group="";   
         }
        //payment date match
         if((!empty($from_date))&&(!empty($to_date)))
         {
         $search_date="and payment_date BETWEEN '$from_date' AND '$to_date'";      
         }else
         {
           $search_date="";  
         }
  
         $fee_array_insert=array();
         
         $search_fee_group_array=array();
         array_push($search_fee_group_array,$fee_group_id);
         
         $insert_array=array();
         $row=0;
         
         
         $total_fine_amount=0;
         $total_discount_amount=0;
         $total_due_amount=0;
         $total_extra_paid_amount=0;
         $total_amount_paid=0;
         $show_due_amount=0;
         
         $total_amount=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' $search_date $search_fee_group and is_delete='none' and status='cleared'");
         while ($details=mysql_fetch_array($total_amount))
         {
         $row++;
         $fetch_fee_group_id=$details['fee_group_id'];
         $explode_fee_group_id=explode(",",$fetch_fee_group_id);
         
         
         $fetch_recipt_id=$details['receipt_id'];
         $fetch_recipt_db_id=$details['id'];
        
         
         if(!empty($fee_group_id))
         {
          $match_fee_group_id=$search_fee_group_array; 
          $show_due_amount++;
         }else
         {
           $match_fee_group_id=explode(",",$fetch_fee_group_id); 
         }
         
        
         foreach ($match_fee_group_id as $fee_group_id_value)
         {
         
          
         $insert_array_match=in_array($fee_group_id_value, $insert_array);   
         if($insert_array_match!=true)
         {
         $last_total_amount=0;    
         $fl_array=preg_grep('/^'.$fee_group_id_value.'.*/',$explode_fee_group_id);
         foreach ($fl_array as $fee_group_ids)
         {
         
         $search_array=in_array($fee_group_ids,$explode_fee_group_id);
         if($search_array==true)
         {
       
         array_push($insert_array,$fee_group_id_value);   
             
             
             
        $total_fee_group_amount=0;
        $total_amount_db=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' $search_date and fee_group_id LIKE '%$fee_group_ids%'  and is_delete='none' and status='cleared'");
         while ($details_data=mysql_fetch_array($total_amount_db))
         {
          $fetch_fee_group_id=$details_data['fee_group_id'];
         $fetch_fee_group_amounts=unserialize($details_data['fee_sub_total_amount']);
         $explode_fee_group_ids=explode(",",$fetch_fee_group_id);
         
         
         $fl_array=preg_grep('/^'.$fee_group_ids.'.*/',$explode_fee_group_ids);
         foreach ($fl_array as $fee_group_ids)
         {
         
         $search_array=in_array($fee_group_ids,$explode_fee_group_ids);
         if($search_array==true)
         {   
               
         $total_fee_amount=$fetch_fee_group_amounts[$fee_group_ids];
         $total_fee_group_amount+=$total_fee_amount;    
         
         
         }
         }
         
         }
         
         
         $fee_group_or_other_fee=$fee_group_ids."#fee#".$total_fee_group_amount;
         
         
          $insert_check_array=in_array($fee_group_or_other_fee, $fee_array_insert);
         if($insert_check_array!=true)
         {
             array_push($fee_array_insert,$fee_group_or_other_fee);
         }
        }
         
         }
         
         
         
         }
         }
         
         
         $due_amount_db=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . "and session_id='$fecth_session_id_set' and receipt_id='$fetch_recipt_id' and reciept_no='$fetch_recipt_db_id' and is_delete='none'");
         $fetch_due_amount_data=  mysql_fetch_array($due_amount_db);
         $fetch_due_amount_num_rows=  mysql_num_rows($due_amount_db);
         if((!empty($fetch_due_amount_data))&&($fetch_due_amount_data!=null)&&($fetch_due_amount_num_rows!=0))
         {
           $fetch_due_amount=$fetch_due_amount_data['due_amount'];
           if($fetch_due_amount<0)
           {
           $total_extra_paid_amount +=abs($fetch_due_amount);
           }else
           {
           $total_due_amount +=$fetch_due_amount;
           }
             
         }
         
         
         
         $fetch_fine_amount=$details['total_fine_amount'];
         $fetch_discount_amount=$details['total_discount_amount'];
         $fetch_fine_discount_amount=$details['fine_discount'];
         $fetch_special_discount_amount=$details['special_discount'];
         
         
         $total_paid_amount=$details['amount_paid'];
         
         $total_amount_paid +=$total_paid_amount;
         
         
         
         $temp_total_discount_amount=($fetch_special_discount_amount+$fetch_fine_discount_amount+$fetch_discount_amount);
         
         $total_fine_amount +=$fetch_fine_amount;
         $total_discount_amount +=$temp_total_discount_amount;
         
         
         }
         
         
         
         
         
         
         
   echo "<div id='first_hundred_div'>";
     echo "<div class='top_fee_payment_summary'>
             <div class='top_compand_div'>
              <div class='top_menu_button' id='excel_button'>Excel</div>  
              <div class='top_menu_button' onclick='converted_pdf()' id='pdf_button'>Pdf</div>
                                           
<div class='top_menu_button' id='print_button'>Print</div> 
</div>
             
<table id='show_table' cellspacing=0 cellpadding=0 style='width:70%; height:auto; margin:0 auto; padding-top:2px;'>
<tr><td class='th_styling' >Particulars</td>
<td class='th_styling' style=' border-left:0px; text-align:right;'>Income Balance</td>

<td class='th_styling' style=' border-left:0px; border-right:1px solid black; text-align:right;'>Expense Balance</td></tr>";

      $total_amount_recive=0;
         foreach ($fee_array_insert as $particular_fee_or_amount)
         {
             
          $explode_two_fee_group_or_amount=explode("#fee#", $particular_fee_or_amount);
          
          $get_fee_group_id=$explode_two_fee_group_or_amount[0];
          $get_fee_group_amount=$explode_two_fee_group_or_amount[1];
          
          
          $fee_group_db=  mysql_query("SELECT * FROM  financeaddfeegroup WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                 . " and session_id='$fecth_session_id_set' and fee_group_id='$get_fee_group_id'");
         $fee_group_data=  mysql_fetch_array($fee_group_db);
         $fee_group_num_rows=  mysql_num_rows($fee_group_db);
         if((!empty($fee_group_data))&&($fee_group_data!=null)&&($fee_group_num_rows!=0))
         {
         $fetch_fee_group_name=$fee_group_data['feegroupname'];
        echo"<tr><td class='td_styling'>$fetch_fee_group_name</td>"
                . "<td class='td_styling' style='text-align:right; '>$put_currency $get_fee_group_amount/-</td><td class='td_styling' style='text-align:right; border-right:1px solid black;'></td></tr>";
     
           $total_amount_recive +=$get_fee_group_amount;  
             
         }
         }         
         
         
         $match_other_fee=preg_grep('/^FESGRP_OTHER_.*/',$fee_array_insert);
         if($match_other_fee==true)
         {
            $total_other_fee_amount=0;
             foreach ($match_other_fee as $other_fee_or_amount)
             {
               
              $explode_other_fee_or_amount=  explode("#fee#", $other_fee_or_amount); 
              $other_fee_amount=$explode_other_fee_or_amount[1];
              $total_other_fee_amount +=$other_fee_amount;
                 
                 
             }
           
             
          echo"<tr><td class='td_styling' >Other Fee</td>"
                . "<td class='td_styling' style='text-align:right;'>$put_currency $total_other_fee_amount/-</td><td class='td_styling' style='text-align:right; border-right:1px solid black;'></td></tr>";    
             
         }else
         {
          $total_other_fee_amount=0;   
         }
         
         
         
         if($show_due_amount!=0)
         {
         $match_due_fee=preg_grep('/^FESGRP_DUE_PAID_.*/',$fee_array_insert);
         if($match_due_fee==true)
         {
            $total_due_fee_amount=0;
             foreach ($match_due_fee as $due_fee_or_amount)
             {
               
              $explode_due_fee_or_amount=  explode("#fee#", $due_fee_or_amount); 
              $due_fee_amount=$explode_due_fee_or_amount[1];
              $total_due_fee_amount +=$due_fee_amount;
                 
                 
             }
           
             
          echo"<tr><td class='td_styling' >Collect Due Fee</td>"
                . "<td class='td_styling' style='text-align:right;'>$put_currency $total_due_fee_amount/-</td><td class='td_styling' style='text-align:right; border-right:1px solid black;'></td></tr>";    
             
         }else
         {
          $total_due_fee_amount=0;   
         }    
         }else
         {
           $total_due_fee_amount=0;  
         }
         
         
         
        if($show_due_amount==0)
         { 
         
         if((!empty($total_fine_amount))&&($total_fine_amount!=0))
         {
          echo"<tr><td class='td_styling' >Fine Amount</td>"
                . "<td class='td_styling' style='text-align:right;'>$put_currency $total_fine_amount/-</td><td class='td_styling' style='text-align:right; border-right:1px solid black;'></td></tr>";    
         }
         
         
         if((!empty($total_discount_amount))&&($total_discount_amount!=0))
         {
           echo"<tr><td class='td_styling'>Discount Amount </td>"
                . "<td class='td_styling' style='text-align:right;'></td><td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_discount_amount/-</td></tr>";     
         }
         
         }else
         {
          $total_discount_amount=0; 
          $total_fine_amount=0;
         }
         
         if($show_due_amount==0)
         {
          if((!empty($total_extra_paid_amount))&&($total_extra_paid_amount!=0))
         {
           echo"<tr><td class='td_styling'>Extra Paid Amount</td>"
                . "<td class='td_styling' style='text-align:right;'>$put_currency $total_extra_paid_amount/-</td><td class='td_styling' style='text-align:right; border-right:1px solid black;'></td></tr>";     
         }
         
         }else
         {
           $total_extra_paid_amount=0;  
         }
         

         
         
         
         
$match_array=array();   
$total_balance=0;
$account_payment_db=mysql_query("SELECT * FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_type='income' $search_date and status='cleared' and is_delete='none'");
while ($fetch_account_payment_data=mysql_fetch_array($account_payment_db))
{
 $fetch_account_id=$fetch_account_payment_data['account_name_id'];
  
 
 $search_match_array=in_array($fetch_account_id, $match_array);
 if($search_match_array!=true)
 {
  array_push($match_array,$fetch_account_id);   
  
 $total_account_balance_db=mysql_query("SELECT organization_id,branch_id,session_id,account_type,payment_date,account_name_id,SUM(paid_amount) as total_amount,status,is_delete FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' $search_date and account_type='income' and account_name_id='$fetch_account_id' and status='cleared' and is_delete='none'");
 $fetch_total_amount=  mysql_fetch_assoc($total_account_balance_db);
 $total_income_expense_amount=$fetch_total_amount['total_amount'];
    
  $account_name_db=  mysql_query("SELECT * FROM financeaccountdetail WHERE organization_id='$fetch_school_id' and
                branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_id='$fetch_account_id'");
                $fetch_account_name_data=  mysql_fetch_array($account_name_db);
                $fetch_account_name_num_rows=mysql_num_rows($account_name_db);
                if((!empty($fetch_account_name_data))&&($fetch_account_name_data!=null)&&($fetch_account_name_num_rows!=0))
                {
                $account_name=$fetch_account_name_data['accountname'];   
                }else
                {
                 $account_name="Record missing";      
                }  
     
                
                
   echo"<tr><td class='td_styling' >$account_name</td>"
                . "<td class='td_styling' style='text-align:right; '>$put_currency $total_income_expense_amount/-</td><td class='td_styling' style='text-align:right; border-right:1px solid black;'></td></tr>";    
              
  $total_balance +=$total_income_expense_amount;             
 }
}
         
         
         
         
         
         
         $final_amount_paid_student=(($total_amount_recive+$total_balance+$total_extra_paid_amount+$total_due_fee_amount+$total_other_fee_amount+$total_fine_amount));
         $match_equal_amount=($final_amount_paid_student-$total_due_amount);
         
         $total_amount_paid_student=($total_amount_paid+$total_balance+$total_discount_amount);
         

     
     
     
$match_array=array();   
$total_expense_balance=0;
$expense_account_payment_db=mysql_query("SELECT * FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_type='expense' $search_date and status='cleared' and is_delete='none'");
while ($fetch_account_payment_data=mysql_fetch_array($expense_account_payment_db))
{
 $fetch_account_id=$fetch_account_payment_data['account_name_id'];
  
 
 $search_match_array=in_array($fetch_account_id, $match_array);
 if($search_match_array!=true)
 {
  array_push($match_array,$fetch_account_id);   
  
 $total_account_balance_db=mysql_query("SELECT organization_id,branch_id,session_id,account_type,payment_date,account_name_id,SUM(paid_amount) as total_amount,status,is_delete FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' $search_date and account_type='expense' and account_name_id='$fetch_account_id' and status='cleared' and is_delete='none'");
 $fetch_total_amount=  mysql_fetch_assoc($total_account_balance_db);
 $total_income_expense_amount=$fetch_total_amount['total_amount'];
    
  $expense_account_name_db=  mysql_query("SELECT * FROM financeaccountdetail WHERE organization_id='$fetch_school_id' and
                branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_id='$fetch_account_id'");
                $fetch_account_name_data=  mysql_fetch_array($expense_account_name_db);
                $fetch_account_name_num_rows=mysql_num_rows($expense_account_name_db);
                if((!empty($fetch_account_name_data))&&($fetch_account_name_data!=null)&&($fetch_account_name_num_rows!=0))
                {
                $expense_account_name=$fetch_account_name_data['accountname'];   
                }else
                {
                 $expense_account_name="Record missing";      
                }  
     
                
                
   echo"<tr><td class='td_styling' >$expense_account_name</td><td class='td_styling' style='text-align:right;'></td>"
                . "<td class='td_styling' style='text-align:right; border-right:1px solid black;'>$put_currency $total_income_expense_amount/-</td></tr>";    
              
  $total_expense_balance +=$total_income_expense_amount;             
 }
}
   










$total_expense_amount=($total_expense_balance+$total_discount_amount);

$profit_balance=($final_amount_paid_student-$total_expense_amount);

if($profit_balance<0)
{
$profit_name="Loss";
$profit_balance=$profit_balance;
}else
{
 $profit_name="Profit";
$profit_balance=$profit_balance;   
}


if($profit_balance!=0)
{
   $profit_balance=number_format($profit_balance,2); 
}else
{
    $profit_balance=$profit_balance;
}


if($final_amount_paid_student!=0)
{
 $final_amount_paid_student=number_format($final_amount_paid_student,2);   
}  else {
   $final_amount_paid_student=$final_amount_paid_student; 
}

if($total_expense_amount!=0)
{
 $total_expense_amount=  number_format($total_expense_amount,2);   
}  else {
  $total_expense_amount=$total_expense_amount;  
}

echo"<tr><td class='td_styling' style=' background-color:whitesmoke;'>";
     
         echo"<b>Total $profit_name Balance :</b> $put_currency $profit_balance/-";
       
echo "</td><td class='td_styling' style=' background-color:whitesmoke; text-align:right; border-left:0px;'><b>Total Income Balance :</b> $put_currency $final_amount_paid_student/-</td><td class='td_styling' style='text-align:right; border-left:0px;"
         . " border-right:1px solid black; background-color:whitesmoke;'><b>Total Expense Balance :</b> $put_currency $total_expense_amount/-</td></tr>";



echo "</table>";




 if(($total_amount_paid_student!=$match_equal_amount)&&($show_due_amount==0))
         {
             echo "<style>#show_table { display:none;} </style>";
             
             echo "<div style='width:50%; height:20px; padding-top:10px; float:right; color:red;'>Sorry,Technical Problem,Please Contact technical team.</div>";
             
         }



   echo "</div>";
   
   
   
        }
 ?>
  <?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>