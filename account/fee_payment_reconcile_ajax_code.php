<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php 
require_once '../connection.php';
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['status']))&&(!empty($_REQUEST['fee_payment_id'])))
{
$organization_id=$_REQUEST['org_id'];
$branch_id=$_REQUEST['branch_id'];
$session_id=$_REQUEST['session_id'];
$status=$_REQUEST['status'];
$recipt_id=$_REQUEST['fee_payment_id'];

$due_fee_recept_id="STUDENT_PAY_FEE_".$recipt_id;

$update_fee_payment_db=mysql_query("UPDATE finance_student_pay_fee SET status='$status' WHERE id='$recipt_id' and organization_id='$organization_id'"
        . "and branch_id='$branch_id' and session_id='$session_id' and is_delete='none'");
if((!empty($update_fee_payment_db))&&($update_fee_payment_db))
{
    
$update_due_fee_db=mysql_query("UPDATE finance_student_due_amount_db SET is_delete='yes',status='cancel'"
        . " WHERE student_pay_fee_id='$due_fee_recept_id'");   
if((!empty($update_due_fee_db))&&($update_due_fee_db))
{  
    
    $select_month_db=mysql_query("SELECT * FROM finance_pay_fee_month_db WHERE pay_fee_id='$due_fee_recept_id'"
            . " and fee_group_id='fee_due_pay'");
    $select_num_rows=mysql_num_rows($select_month_db);
    if((!empty($select_num_rows))&&($select_num_rows!=0))
    {
     $num=0;   
    while($select_data=mysql_fetch_array($select_month_db))
    {
   $receipt_id=$select_data['specify_month_term'];
   $new_receipt_id=substr($receipt_id,10);
    
  $update_old_due_fee_db=mysql_query("UPDATE finance_student_due_amount_db SET is_delete='none',status='pending'"
        . " WHERE receipt_id='$new_receipt_id'");
  if((!empty($update_old_due_fee_db))&&($update_old_due_fee_db))
  {
  $num++;    
  }
    }
    
    if($select_num_rows==$num)
    {
    echo "1";     
    }else
    {
     echo "0";    
    }    
    }else
    {
    echo "1"; 
    }
}else
{
  echo "0";   
}
}else
{
    echo "0"; 
}
}
 




//student fee payment details

if((!empty($_REQUEST['organization_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['currency']))
        &&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['page_no']))
        ||(!empty($_REQUEST['search_course_id']))||(!empty($_REQUEST['search_section_id']))
        ||(!empty($_REQUEST['search_student_id']))
        ||(!empty($_REQUEST['other_search_by']))&&(!empty($_REQUEST['other_search_value']))
        ||(!empty($_REQUEST['from_date']))&&(!empty($_REQUEST['to_date'])))
{
  
  $fetch_school_id=$_REQUEST['organization_id']; 
  $fetch_branch_unique_db_id=$_REQUEST['branch_id'];
  $fetch_branch_id=$_REQUEST['branch_id'];
  $fetch_currency=$_REQUEST['currency'];
  $fecth_session_id_set=$_REQUEST['session_id'];
  $course_id=$_REQUEST['search_course_id'];
  $get_section_id=$_REQUEST['search_section_id'];
  $search_student_id=$_REQUEST['search_student_id'];
  $other_search_by=$_REQUEST['other_search_by'];
  $other_search_value=$_REQUEST['other_search_value'];
  $form_date=$_REQUEST['from_date'];
  $to_date=$_REQUEST['to_date'];
  
  
 $get_page_no=$_REQUEST['page_no'];
  $static_first_search_no=4;
  $minius_one=($get_page_no-1);
  $first_limit=($static_first_search_no*$minius_one);
  
  $add_page=($get_page_no+1);
  $dedut_page=($get_page_no-1);
  $next_page=$add_page;
  $previous_page=$dedut_page;
 
                                         echo '<div class="all_div_tag">
                                            <div class="top_menu_button" id="excel_button">Excel</div>  
                                            <div class="top_menu_button" id="pdf_button">Pdf</div>'; 
                                           { ?>
    <a style="color:blue;" href="#" onclick="window.open('finance_fee_details_print.php?organization_id=<?php  echo $fetch_school_id;?>&&branch_id=<?php  echo $fetch_branch_unique_db_id;?>&&session_id=<?php  echo $fecth_session_id_set;?>&&currency=<?php  echo $fetch_currency;?>&&search_course_id=<?php  echo $course_id;?>&&search_section_id=<?php  echo $get_section_id;?>&&search_student_id=<?php  echo $search_student_id;?>&&other_search_by=<?php  echo $other_search_by;?>&&other_search_value=<?php  echo $other_search_value;?>&&from_date=<?php  echo $form_date;?>&&to_date=<?php  echo $to_date;?>&&page_no=<?php  echo $get_page_no;?>&&limit=yes','size',config='height=530,width=1100,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
  <div class="top_menu_button" id="print_button">Print (0,50)</div>
    </a>
                                           
    <a style="color:blue;" href="#" onclick="window.open('finance_fee_details_print.php?organization_id=<?php  echo $fetch_school_id;?>&&branch_id=<?php  echo $fetch_branch_unique_db_id;?>&&session_id=<?php  echo $fecth_session_id_set;?>&&currency=<?php  echo $fetch_currency;?>&&search_course_id=<?php  echo $course_id;?>&&search_section_id=<?php  echo $get_section_id;?>&&search_student_id=<?php  echo $search_student_id;?>&&other_search_by=<?php  echo $other_search_by;?>&&other_search_value=<?php  echo $other_search_value;?>&&from_date=<?php  echo $form_date;?>&&to_date=<?php  echo $to_date;?>&&page_no=<?php  echo $get_page_no;?>&&limit=no','size',config='height=530,width=1100,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
        <div class="top_menu_button" id="print_button">Print (All)</div> 
        </a> 
                                          <?php 
                                           }
                                           echo'</div>  
                                            
                                        </div>   
                                          <table cellspacing="0" cellpadding="0" class="details_table">
               <tr>
               <td class="top_heading_line">Sl No.</td>
               <td class="top_heading_line">Receipt No.</td>
               <td class="top_heading_line">Payment Date</td>
               <td class="top_heading_line">Class/Course-S</td>
               <td class="top_heading_line">Student Name</td>
               <td class="top_heading_line">Father Name</td>
               <td class="top_heading_line">Mobile Number</td>
               <td class="top_heading_line">Payment Mode</td>
               <td class="top_heading_line">Amount Payable</td>
               <td class="top_heading_line">Paid Amount</td>
               <td class="top_heading_line">Due Amount</td>
               <td class="top_heading_line">Status</td>
              <td class="top_heading_line" style=" border-right:1px solid black; ">Action</td>
              </tr>';
              
              
              
              //student search
   if(!empty($course_id))
   {
   $search_course="and course_id='$course_id'";
   }else
   {
     $search_course="";  
   }
   
   //student search
   
   if(!empty($search_student_id))
   {
    $search_student_record="and student_id='$search_student_id'";   
   }else
   {
   $search_student_record="";    
   }
   
   
   //other search
   if((!empty($other_search_by))&&(!empty($other_search_value)))
  {
   $other_search="and $other_search_by LIKE '%$other_search_value%'"; 
  }else 
  {
  $other_search="";  
  }
  
  //date search
  if((!empty($form_date))&&(!empty($to_date)))
  {
   $search_payment_date="and payment_date BETWEEN '$form_date' AND '$to_date'";   
  }else
  {
    $search_payment_date="";  
  }
  
   
               $number_no_record=0;
               $row=0;
              $fee_payment_db= mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                      . " and session_id='$fecth_session_id_set' $other_search $search_student_record $search_course $search_payment_date ORDER BY id DESC LIMIT $first_limit,5");
              while ($fetch_fee_payment_data=  mysql_fetch_array($fee_payment_db))
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
              echo "<style>#color_select_$recipt_id {background-color:green; color:white; border:1px solid black;}</style>";
                   $payment_ststus=$payment_ststus;   
                }else
                    if($payment_ststus=="PENDING")
                {
                        $payment_ststuss="";
                        echo "<style>#color_select_$recipt_id {background-color:orange; color:white; border:1px solid black;}</style>";
                
                   $payment_ststus=$payment_ststus; 
                }else
                if($payment_ststus=="CANCEL")
                {
                    $payment_ststuss=$payment_ststus;
                   echo "<style>#color_select_$recipt_id { background-color:red; color:white; border:1px solid black;}</style>";
                
                   $payment_ststus=$payment_ststus;       
                   
                   }
                   
                  echo "<tr><td class='td_heading_data'>$row</td>"
                          . "<td class='td_heading_data'>$recipt_id</td>"
                          . "<td class='td_heading_data'>$fee_payment_date</td>"
                          . "<td class='td_heading_data'>$course_name <b>-</b> $section_name</td>"
                          . "<td class='td_heading_data'>$student_name</td>"
                          . "<td class='td_heading_data'>$father_name</td>"
                          . "<td class='td_heading_data'>$father_mobile_no</td>"
                          . "<td class='td_heading_data'>$payment_mode</td>"
                          . "<td class='td_heading_data' style='text-align:right; padding-right:8px;'><b style='color:red;'>$fetch_currency</b> $amount_payable</td>"
                          . "<td class='td_heading_data' style='text-align:right; padding-right:8px;'><b style='color:red;'>$fetch_currency</b> $amount_paid</td>"
                          . "<td class='td_heading_data' style='text-align:right; padding-right:8px;'><b style='color:red;'>$fetch_currency</b> $due_amount</td>"
                          . "<td class='td_heading_data'>";
                  
                     if($payment_ststus=="CANCEL")
                  {
                   echo "<select readonly='readonly' disabled onchange='status_change(this.value,$recipt_id)' "
                           . "id='color_select_$recipt_id'>";   
                  }  else {
                      echo "<select onchange='status_change(this.value,$recipt_id)' id='color_select_$recipt_id'>";
                  }     
                  
                 if($payment_ststus=="CLEARED")
                 {
                 echo "<option style='background-color:green;' value='cleared' selected>CLEARED</option>";  
                 }else {
                 echo "<option style='background-color:green;' value='cleared'>CLEARED</option>";
                 }
                 
                  if($payment_ststus=="PENDING")
                 {
                 echo "<option style='background-color:orange;' value='pending' selected>PENDING</option>";  
                 }else {
                 echo "<option style='background-color:orange;' value='pending'>PENDING</option>";
                 }
              
                   if($payment_ststus=="CANCEL")
                 {
                 echo "<option style='background-color:red;' value='cancel' selected>CANCEL</option>";  
                 }else {
                 echo "<option style='background-color:red;' value='cancel'>CANCEL</option>";
                 }
              
                          echo "</select></td>"
                          . "<td class='td_heading_data' style='border-right:1px solid black;'>";
                        if($payment_ststus!="CANCEL")  
                       {
                  {
                         ?>   
                        
                             <div id="update_button_<?php  echo $recipt_id;?>" onclick="change_fee_status('<?php  echo $recipt_id;?>')" class='update_button'>Update</div>
                   
                   <?php 
                        } 
                       }
                          echo"</td></tr>";   
                  
              }
              
              $check_fee_payment_num_rows=mysql_num_rows($fee_payment_db);
              if((empty($fee_payment_id))&&(empty($check_fee_payment_num_rows)))
              {
                  echo ' <tr>
                   <td style=" border:1px solid black; text-align:center; height:30px;
                      color:red; font-weight:bold;   border-top:0px;" colspan="14">Record no found !!</td>
               </tr>  ';   
              }
              
              
              
              
              
             $count_total_rows_db=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                      . " and session_id='$fecth_session_id_set' $other_search $search_student_record $search_course $search_payment_date");
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
                         ?> 
                       <?php 
              }
                         
?>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>