<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>

<?php 
require_once '../connection.php';

if((!empty($_REQUEST['fees_pay_method']))&&(!empty($_REQUEST['fees_group_id']))&&(!empty($_REQUEST['student_admission_id'])))
{   

$student_admission_no=$_REQUEST['student_admission_id'];
$fee_pay_method=$_REQUEST['fees_pay_method'];
$get_fee_group_id=$_REQUEST['fees_group_id'];
if($fee_pay_method=="manually_fee")
{
if($get_fee_group_id=="all_fee_group_pay")
{
 $fee_search="";   
 $due_on="due_amount";
}else
 if($get_fee_group_id=="due_amount")
{
$fee_search="T1.fee_group_id='0' and";  
 $due_on="due_amount";
}else
if($get_fee_group_id=="other_fee")
{
 $fee_search="T1.fee_group_id='0' and";  
  $due_on="no_due_amount";
}else
{
 $fee_search=" T1.fee_group_id='$get_fee_group_id' and";
  $due_on="no_due_amount";
}  
}else
{
  $fee_search="";  
   $due_on="due_amount";
}
    
$student_db=mysql_query("SELECT *,T1.encrypt_id as ad_id,T9.description as hostel_description,"
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
                 . " $db_t1_main_details T1.student_id='$student_admission_no' and T1.is_delete='none'");
         

$fetch_student_data=  mysql_fetch_array($student_db);
$fetch_student_num_rows=  mysql_num_rows($student_db);
if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
{
 
 $fetch_student_class_id=$fetch_student_data['course_id'];
$category_id=$fetch_student_data['category_id']; 
 $student_personal_admission_id=$fetch_student_data['student_id'];
 $student_handicapped=$fetch_student_data['student_handicapped'];  
{
?>
        <link rel="stylesheet" href="stylesheet/fee_pay_css.css">
        <script type="text/javascript" src="../javascript/account_validate.js"></script>
        
        <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
          <script type="text/javascript">
$(function() {
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
    
    <input type="hidden" name="insert_class_id" value="<?php echo $fetch_student_class_id;?>">
    <input type="hidden" name="insert_student_id" value="<?php echo $student_personal_admission_id;?>">
    <div class='full_witdh_div' id="full_width_show"></div>
    <div class='show_discount_full_width' id="show_discount_full_width">
        <div class='first_small_div_tag'>
            
            <div class='table_record_data'>
                <table class='data_tables'>
                    <tr>
                        <td colspan='1'><b>Manage Fine </b></td>
                    </tr>
                    <tr>
                        <td colspan='3'><div class='horizental_line'></div></td>
                    </tr>
                    <tr>
                        <td>Fine Amount <sup style="color:red;">*</sup></td>
                        <td style=' width:30px;'><strong>:</strong></td>
                        <td><input type='text' id="fine_amount_discount" readonly="readonly"
                                   style=" background-color:aliceblue; " placeholder="Enter fine amount"
                                   class='text_box_styling'></td>
                    </tr>
                    <tr>
                        <td>
                            Fine Discount Type<sup style="color:red;">*</sup>
                        </td>
                        <td><strong>:</strong></td>
                        <td><select onchange="fine_discount_type(this.value)" id="fine_discount_type" class='select_discount_type'>
                                <option value="percantage">%</option>
                                <option value="flat">Flat</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Fine Discount <sup style="color:red;">*</sup></td>
                        <td><strong>:</strong></td>
                        <td>
                            <input type="hidden" id="temp_get_fine_discount_amount">
                            <input onkeyup="fine_discount_key_up(this.value)" placeholder="Enter fine discount"
                                  id="get_fine_discount_amount" type='text' class='text_box_styling'></td>
                    </tr>
                    <tr>
                        <td>Description <sup style="color:red;">*</sup></td>
                        <td><strong>:</strong></td>
                        <td><textarea id="fine_description" placeholder="Enter description" class="text_area_box"></textarea></td>
                    </tr>
                    <tr>
                        <td>Document</td>
                        <td><strong>:</strong></td>
                        <td><input type="file" id="fine_discount_file" name="fine_discount_file"></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                     <tr>
                        <td colspan='1'><b>Special Discount </b></td>
                    </tr>
                    
                    <tr>
                        <td colspan='3'><div class='horizental_line'></div></td>
                    </tr>
                    <tr>
                        <td>
                            Discount Type <sup style="color:red;">*</sup>
                        </td>
                        <td><strong>:</strong></td>
                        <td><select onchange="special_discount_type(this.value)" id="special_discount_type" class='select_discount_type'>
                                <option value="percantage">%</option>
                                <option value="flat">Flat</option>
                            </select></td>
                    </tr>
                     <tr>
                        <td>Discount <sup style="color:red;">*</sup></td>
                        <td><strong>:</strong></td>
                        <td>
                            <input type="hidden" id="temp_special_discount_amount">
                            <input type='text' id="special_discount_amount" onkeyup="discount_amount_value(this.value)"
                                   placeholder="Enter discount" class='text_box_styling'></td>
                    </tr>
                    <tr>
                        <td>Description <sup style="color:red;">*</sup></td>
                        <td><strong>:</strong></td>
                        <td><textarea id="discount_description" placeholder="Enter description" class="text_area_box"></textarea></td>
                    </tr>
                    <tr>
                        <td>Document</td>
                        <td><strong>:</strong></td>
                        <td><input type="file" id="special_discount_file" name="special_discount_file"></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan='3'>
                             <input type='button' class='cancel_button' onclick="clear_button()"  value='Clear'> 
                        
                          <input type='button' onclick="add_discount_button()" class='add_fine_button' value='Add'> 
                         </td>
                    </tr>
                </table>  
                </div>
            
            <div onclick="close_button_div()" class='close_button_div'></div>   
        </div>    
    </div>
        
    <script type="text/javascript" src="account_javascript/manually_javascript.js"></script>
    
    <div id="fee_payment_div">
    <div id="manually_fee_month">
      
        
        
       <?php 
    if((!empty($_REQUEST['fees_pay_method']))&&(!empty($_REQUEST['fees_group_id']))&&(!empty($_REQUEST['student_admission_id'])))
    {
  
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
        
    $fee_pay_method=$_REQUEST['fees_pay_method'];
    $fee_group_ids=$_REQUEST['fees_group_id'];
    $student_id=$_REQUEST['student_admission_id'];
    
    $student_db=mysql_query("SELECT * FROM student_db as T1 "
            . " LEFT JOIN student_personal_db as T2 ON T1.student_personal_id=T2.student_unqiue_id WHERE $db_t1_main_details"
            . " T1.student_id='$student_id' and T1.is_delete='none'");
    $student_data=mysql_fetch_array($student_db);
    $student_num_rows=mysql_num_rows($student_db);
    if((!empty($student_data))&&($student_data!=null)&&($student_num_rows!=0))
    {
    $class_id=$student_data['course_id'];
    $course_id=$class_id;
    $category_id=$student_data['category_id'];
    $student_admission=$student_data['admission_status'];
    $student_handicapped=$student_data['student_handicapped'];
    
    if($student_handicapped="yes")
    {
     $student_handicapped="Handicapped";   
    }
    
     $fee_amount_db=mysql_query("SELECT *,T1.id as t1_id FROM financefeeamount as T1"
         . " LEFT JOIN financeaddfee as T2 ON T1.fee_id=T2.fee_id "
         . " LEFT JOIN financeaddfeegroup as T3 ON T1.fee_group_id=T3.fee_group_id"
         . " LEFT JOIN course_db as T4 ON T1.course_id=T4.course_id WHERE "
            . " $db_t1_main_details $fee_search T1.fee_assign_to='class_fee_group' and T1.course_id='$class_id' and T1.action='active' "
            . " OR $db_t1_main_details $fee_search T1.fee_assign_to='student_wise' and T1.student_id='$student_id' and T1.action='active'"); 
   
     $fetch_fee_amount_num_rows=mysql_num_rows($fee_amount_db);
     while ($fetch_fee_amount_data=mysql_fetch_array($fee_amount_db))
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
        //condition transport & hostel
        if($tranport_hostel_active_on==$tranport_hostel_active)
        {
        //condiction check aaplicable only new student
        if($fetch_applicable_status==$student_admission)
        {
       ?>
      <div class="show_specify_month">
      <table cellspacing="0" cellpadding="0" class="table_position">
          <tr><td colspan="10"><b><?php  echo $fetch_fee_group_name;?> (<?php  echo $fetch_fee_group_type;?>)</b></td></tr>
          <tr><td style=" height:3px; "></td></tr>
          <tr>
         <?php
         $number_position=0;
         $get_fee_qty=0;
        $fee_set_date_db=mysql_query("SELECT * FROM finance_fee_set_date_db WHERE fee_group_id='$fetch_fee_group_id' and is_delete='none'"); 
        while ($fee_set_date=mysql_fetch_array($fee_set_date_db))
        {
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
}
else 
{
 $payble_fine_amount=0;   
}
   
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
   
        //CHECK FEE PAY ALREADY
        
         $payment_check_db=mysql_query("SELECT * FROM finance_student_pay_fee as T1 "
                 . " LEFT JOIN finance_pay_fee_integrate_db as T2 ON T1.student_pay_fee_id=T2.pay_fee_id "
                 . " LEFT JOIN finance_pay_fee_month_db as T3 ON T1.student_pay_fee_id=T3.pay_fee_id "
                 . " WHERE $db_t1_main_details T1.student_id='$student_id' and T2.fee_group_id='$fetch_fee_group_id'"
                 . " and T3.fee_group_id='$fetch_fee_group_id' and T3.specify_month_term='$month' and T1.is_delete='none' and T1.status='cleared'");
        
         $payment_num_rows=mysql_num_rows($payment_check_db);
         if(empty($payment_num_rows)&&($payment_num_rows==0))
         {
         
         echo " <td style='width:15px; padding-left:5px;'>";
         {
         $number_position++;    
         ?>
         <?php
         if($collect_fee_start<=0)
         {
         $start_check="checked";   
         $get_fee_qty++;
         }else
         {
          //complete pay fee use only   
          if(!empty($_REQUEST['fees_group_id']))
          {
           $fee_group_temp_name=$_REQUEST['fees_group_id'];
           if($fee_group_temp_name=="fully_complete_fee_pay")
           {
          $start_check="checked";   
         $get_fee_qty++;   
           }else
           {
             $start_check="";   
           }
          }else
          {
             $start_check="";
          }
         }
         ?>     
         <input class="check_box_style_<?php  echo $fetch_fee_group_id;?>" name="fee_check[]" 
                         id="check_box_<?php  echo $number_position;?>_<?php  echo $fetch_fee_group_id;?>" 
                         onclick="fee_check('<?php  echo $fetch_fee_amount;?>','<?php  echo $payble_fine_amount;?>','<?php  echo $final_fee_discount_amount;?>','<?php  echo $final_payable_fees_student;?>','<?php  echo $number_position;?>','<?php  echo $fetch_specify_month;?>','<?php  echo $fetch_fee_group_id;?>')" type="checkbox" value="<?php  echo $fetch_specify_month;?>" <?php echo $start_check;?>></td>
                 
        <?php
        
         }
         echo "</td>";
         echo "<td><b>".ucwords($fetch_specify_month)."</b></td>";
         }else
        {
echo "<td style='width:15px; padding-left:5px;'><input class='check_box_style' type='checkbox' checked disabled></td>
<td><b style='color:red;'>".ucfirst($fetch_specify_month)."</b></td>";    
        }
        
        }
        ?>     
              
         <?php 
         
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$today_dates=date("Y-m-d");
$due_amount_pay_month=date("M");

    
           
if($fetch_fee_amount!=0)
{
 $discont_rate=(($final_fee_discount_amount*100)/$fetch_fee_amount);
}  else {
     $discont_rate=0;
}     
          ?>
          </tr>
          <tr>
              <td><input type="hidden" value="<?php  echo $get_fee_qty;?>" id="fee_qty_<?php  echo $fetch_fee_group_id;?>"></td>
          </tr>
          
          
      </table></div>  
        
        
      <?php 
        }
         }
       }

       }
     ?>
      
      
        
        
        
        
        
    
        
        
        
        
      <style>
          .add_other_fee{ width:auto; height:24px; border:0px; background-color:red; color:white;
          border-radius:1px; float:right; margin-bottom:5px;  font-weight:bold;padding-left:12px; padding-right:12px;
          cursor:pointer; }
          .modify_fee{ width:auto; height:22px; background-color: crimson; border:0px; height:19px; color:white;
          cursor:pointer; border-radius:2px;  }
          .remove_button_style{ width:auto; height:15px; background-color:white; border:0px; color:red; font-size:11px;
          cursor:pointer; }
          .fee_group_text_box{ margin:2px; height:17px; font-size:11px; padding-left:2px; padding-right:2px;    border:1px solid skyblue;   }
         .sub_total_style_sheet{ font-size:12px; } 
      </style>
      
      
      <div><input type="button" class="add_other_fee" onclick="add_other_fee_group()" value="Add Other Fee"></div>
      
      <table cellspacing="0" cellpadding="0" style=" width:100%;  margin-top:4px;    ">
                <tbody><tr>
                    <td class="td_leftpaddingth" style=" padding-left:15px;  color:white; font-size:12px;   font-weight:bold;  
                                        height:20px; background-image:url('finanacephoto/bgblack.png'); ">Fee Amount</td>
                </tr>
                <tr>
                    <td>
                        <table cellspacing="0" id="fee_first_table" cellpadding="0" style=" width:100%; ">
                            <tbody><tr>
                                <td class="td_table_head">
                                 Fee    
                                </td>
                                <td class="td_table_head">
                                 Amount    
                                </td>
                                <td class="td_table_head">
                                 Qty
                                </td>
                                <td class="td_table_head">
                                Specific Month  
                                </td>
                                <td class="td_table_head">
                                Sub Total   
                                </td>
                                <td class="td_table_head">
                               Fine Amt. 
                                </td>
                                 <td class="td_table_head">
                               Discount  
                                </td>
                                <td class="td_table_head">
                                Total Amt.   
                                </td>
                                <td class="td_table_head">
                                Select  
                                </td>
                                <td class="td_table_head" style=" border-right:1px solid silver; ">
                               Action
                                </td>
                            </tr>
                            <?php 
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
            . " $db_t1_main_details $fee_search T1.fee_assign_to='class_fee_group' and T1.course_id='$class_id' and T1.action='active' "
            . " OR $db_t1_main_details $fee_search T1.fee_assign_to='student_wise' and T1.student_id='$student_id' and T1.action='active'"); 
                           
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
        
                         
       
         ?>
                            <tr id="fee_group_null_<?php echo $fetch_fee_group_id;?>">
                               <td class="td_print_value">
                                  
                              <div class="" onmouseover="show_full_fee('<?php  echo $fetch_fee_group_id;?>')"
                                        onmouseout="hide_full_fee('<?php  echo $fetch_fee_group_id;?>')">
                                 <?php  echo ucwords($fetch_fee_group_name);?>
                             <input type="hidden" name="fee_group_id[]" value="<?php  echo $fetch_fee_group_id;?>"> 
                             <input type="hidden" name="fee_group_name[]" value="<?php  echo $fetch_fee_group_name;?>">
                                   </div>
                                  
                          <div class="feesfullydetails" id="fee_full_show_<?php  echo $fetch_fee_group_id;?>" 
                               style="display: none;">
                          <table cellspacing="0" cellpadding="0" style="width:100%; background-color: white; ">
                          <tbody><tr>
                           <td class="fineheader" colspan="4"><?php  echo $fetch_fee_group_name;?></td>
                           <td class="fineheader" colspan="3"> Discount :<?php  echo $discont_rate;?> %</td>
                           <td class="fineheader" colspan="3">Today Date -<?php  echo $today_date;?></td>                        
                             </tr> 
                          <tr>
                          <td class="td_fine_show_table" style="border-left:1px solid silver;">Specify</td>
                          <td class="td_fine_show_table">Fee Amount</td>
                          <td class="td_fine_show_table">Start Date</td>
                          <td class="td_fine_show_table">Due Date</td>
                          <td class="td_fine_show_table">Fine (per day)</td>
                          <td class="td_fine_show_table">Due Days</td>
                          <td class="td_fine_show_table">Fine Amount</td>
                          <td class="td_fine_show_table">Discount Amount</td>
                          <td class="td_fine_show_table">Sub Total</td>
                          </tr>
                    <?php 
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
           $fee_group_temp_name=$_REQUEST['fees_group_id'];
           if($fee_group_temp_name=="fully_complete_fee_pay")
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
           }  else {
             $start_check="";   
           }  
              
         }
         }else
         {
             echo "<style>#fee_group_null_$fetch_fee_group_id { background-color:Red;}</style>";
         }
        


      {
                      ?>    
                 <tr id="color_tr_<?php  echo $number_rows;?>">
                 <td class="td_fetchfine" style="border-left:1px solid silver;"><?php  echo $fetch_specify_month;?></td>
                 <td class="td_fetchfine"><?php  echo $fetch_fee_amount;?></td>
                 <td class="td_fetchfine" style=" font-size: 10px;"><?php  echo $start_date;?></td>
                 <td class="td_fetchfine" style=" font-size: 10px;"><?php  echo $due_date;?></td>
                 <td class="td_fetchfine"><?php  echo $fetch_fine_amount;?></td>
                 <td class="td_fetchfine" style="color:red;"><?php  echo $print_due_days;?> </td>
                 <td class="td_fetchfine"><?php  echo $print_fine_amount;?></td>
                 <td class="td_fetchfine"><?php  echo $final_fee_discount_amount;?> </td>
                 <td class="td_fetchfine"><?php  echo $final_payable_fees_student;?> </td>
                 </tr>
                 
               <?php 
           }
          
         
if($days<0)
{
 echo "<style> #color_tr_$number_rows { background-color:wheat; } </style>";  
}else{
    
}
       }
                 ?>
                 
                 <tr><td colspan="3" class="td_fine_show_tabletotal" style="text-align:left; padding-left:4px; font-size:11px;"> Discount Amount :<?php  echo $print_total_discount_amount;?> <b style="color:whitesmoke;"><?php  echo $fetch_currency;?></b></td>
                       <td colspan="2" class="td_fine_show_tabletotal" style="text-align:left; font-size:11px;">Fine Amount :<?php  echo $print_total_fine_amount;?> <b style="color:whitesmoke;"><?php  echo $fetch_currency;?></b></td>      
                    <td colspan="3" class="td_fine_show_tabletotal" style="text-align:right; font-size:11px;">Total Amount : </td>
                    <td class="td_fine_show_tabletotal"><?php  echo $print_total_amount;?> <b style="color:whitesmoke;"><?php  echo $fetch_currency;?></b></td>
                          </tr>
                          </tbody></table>     
               </div>
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                               
                               </td>
                               <td class="td_print_value">
                                   <input type="hidden" name="fee_group_amount[]" value="<?php  echo $fetch_fee_amount;?>">
                                 <?php  echo $fetch_fee_amount;?></td>
                               
                               <td class="td_print_value">
                              <input type="text" name="fee_group_qty[]" style="width:35px; color:gray; background-color:yellow; border:1px solid silver;
                                     text-align: center;" id="fee_group_qty_<?php  echo $fetch_fee_group_id;?>" readonly="readonly" value="<?php  echo $get_fee_qty;?>">
                               </td>
                               
                               <td class="td_print_value" style="width:100px;">
                                   
                                 <div class="month_define_style" align="justify" id="specify_month_<?php  echo $fetch_fee_group_id;?>">
                                <?php 
                                  
foreach ($old_month_array as $value_print)
{
    echo $value_print;    
}

$specific_month_explode=implode(",",$old_specific_month_array);
                                  ?> 
                                   </div>
    <input type="hidden" id="specific_month_<?php  echo $fetch_fee_group_id;?>" name="fee_group_specific_month[]" value="<?php  echo $specific_month_explode;?>">
                                  
                               </td>
                                   
                               <td class="td_print_value">
                                   <input type="hidden" name="sub_total_fee[]" id="sub_total_value_<?php  echo $fetch_fee_group_id;?>" value="<?php  echo $get_sub_total_amount;?>">
                                   <div id="sub_total_html_<?php  echo $fetch_fee_group_id;?>" style="text-align:center;"><?php  echo $get_sub_total_amount;?></div></td>
                              
                               
                               <td class="td_print_value">
                                   <input type="hidden" name="fine_total_fee[]" id="fine_amount_value_<?php  echo $fetch_fee_group_id;?>" value="<?php  echo $get_fine_amount;?>">
                                   <div id="fine_amount_html_<?php  echo $fetch_fee_group_id;?>" style="text-align:center;"><?php  echo $get_fine_amount;?></div></td>
                              
                               
                               <td class="td_print_value">
                                   <input type="hidden" name="discount_total_fee[]" id="discount_amount_value_<?php  echo $fetch_fee_group_id;?>" value="<?php  echo $get_discount_amount;?>">
                                   <div id="discount_amount_html_<?php  echo $fetch_fee_group_id;?>" style="text-align:center;"><?php  echo $get_discount_amount;?></div></td>
                              
                               
                               <td class="td_print_value">
                                   <input type="hidden" name="total_amount[]" id="total_amount_value_<?php  echo $fetch_fee_group_id;?>" value="<?php  echo $get_last_total_amount;?>">
                                   <div id="total_amount_html_<?php  echo $fetch_fee_group_id;?>" style="text-align:center;"><?php  echo $get_last_total_amount;?></div></td>
                           
                               
                               <td class="td_print_value"><input type="checkbox" checked="" 
                                                              id="check_total_fee_amount_<?php  echo $fetch_fee_group_id;?>" disabled=""></td>
                             <td class="td_print_value" style="border-right:1px solid silver; font-size:11px;  color:red;"> No Modify</td>
                               </tr>  
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
                               
                               if($due_on=="due_amount")
                               {
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
                               
                               
                               <tr>
                          <td class="td_print_value">
                          <input type="hidden" name="fee_group_name[]" value="<?php  echo $fetch_due_payment_name;?>">    
                          <input type="hidden" name="fee_group_id[]" value="<?php  echo $final_due_amount_unique_insert_id;?>">    
                          <div onmouseover="show_due_amount('<?php  echo $fetch_due_amount_fee_id;?>')"
                                                          onmouseout="hide_due_amount('<?php  echo $fetch_due_amount_fee_id;?>')" id="showduefine"><?php  echo $fetch_due_payment_name;?></div>
                   
                          
                          
                          
                          
                          
                          <div class="showduefinedetails" id="due_amount_<?php  echo $fetch_due_amount_fee_id;?>" style="display: none;">
                          <table cellspacing="0" cellpadding="0" style="width:100%; ">
                          <tbody><tr>
                                 <td class="fineheader" colspan="6"><?php  echo $fetch_due_payment_name;?> Details</td>  <td class="fineheader"><?php  echo $today_date;?></td>                        
                             </tr>
                          <tr>
                         <td class="td_fine_show_table">Sl.No</td>
                         <td class="td_fine_show_table">Recept ID</td>
                         <td class="td_fine_show_table">Recept No.</td>
                         <td class="td_fine_show_table">Payment Date</td>
                         <td class="td_fine_show_table"><?php  echo $fetch_due_payment_name;?></td>
                         <td class="td_fine_show_table">Fine Amount</td>
                         <td class="td_fine_show_table">Total Amount</td>
                         </tr>
                          
                <?php 
                  if(!empty($fetch_due_payment_name))
                  {
                      
                  {
                  ?>
                         <tr>
                             <td class="td_stylings"><?php echo $number_row;?></td>
                             <td class="td_stylings"><?php echo $receipt_id;?></td>
                             <td class="td_stylings"><?php echo $receipt_no;?></td>
                             <td class="td_stylings"><?php  echo $fetch_due_amount_payment_date;?></td>
                             <td class="td_stylings"><?php  echo $fetch_due_amount;?></td>
                             <td class="td_stylings"><?php  echo $due_amount_fine_amount;?></td>
                             <td class="td_stylings"><?php  echo $final_payble_due_amount;?></td>
                         </tr>      
                         
                <?php 
                  }
                  }else
                  {
                  {
                         ?>
                          
<tr>
<td colspan="6" style="background-color:white; color:red; height:22px; ">No record found !!</td>                      
</tr>
<?php 
                  }
                  }
?>
                   
                          <tr>
                          <td colspan="6" class="td_fine_show_tabletotal" style="text-align:right;">Total<?php  echo $fetch_due_payment_name;?> :</td>
                          <td class="td_fine_show_tabletotal"><?php  echo $final_payble_due_amount;?></td>
                          </tr>
                          </tbody></table></div>
                          
                          
                          
                          
                          </td>
                          <td class="td_print_value">
                              <input type="hidden" name="fee_group_amount[]" value="<?php  echo $fetch_due_amount;?>"><?php  echo $fetch_due_amount;?></td>
                                 
                          <?php
                          
                          $due_amount_pay_month="Rec. No.: $receipt_id";      
                          $fee_encrypt_id=md5($pay_fee_unqie_id);
                          ?>
                          <td class="td_print_value">
         <input type="text" style="width:35px; color:gray; background-color:yellow; border:1px solid silver;
                text-align: center;"  name="fee_group_qty[]" id="due_qty_<?php echo $fetch_due_amount_fee_id;?>" readonly="readonly" value="1"></td>
                         
                          <td class="td_print_value" style=" text-align:left; font-size:10px; text-indent:2px;   ">
                              <input type="hidden" name="fee_group_specific_month[]" value="<?php  echo $due_amount_pay_month;?>">
                              <a style="color:blue;" href="#" onclick="window.open('fee_payment_receipt.php?token_id=<?php echo $fee_encrypt_id;?>','size',config='height=530,width=900,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                                 <b style=" color:blue; text-decoration:underline;  "><center><?php  echo $due_amount_pay_month;?></center></b></a></td>
                                  
                          <td class="td_print_value"><input type="hidden" name="sub_total_fee[]" value="<?php  echo $fetch_due_amount;?>"><?php  echo$fetch_due_amount;?></td>
                                  
                          <td class="td_print_value"><input type="hidden" name="fine_total_fee[]" value="<?php  echo $due_amount_fine_amount;?>"><?php  echo $due_amount_fine_amount;?></td>
                          
                          <td class="td_print_value"><input type="hidden" name="discount_total_fee[]" value="0">0</td>
                          
                          <td class="td_print_value"><input type="hidden" name="total_amount[]" value="<?php  echo $final_payble_due_amount;?>"><?php  echo $final_payble_due_amount;?>
                          
                              <input type="hidden" id="addeddueamount" value="0"></td>
                              
                          <td class="td_print_value">
                                      <input type="checkbox" name="due_amount_id[]" id="due_amount_checked_<?php  echo $fetch_due_amount_fee_id;?>" onclick="check_due_amount('<?php  echo $fetch_due_amount_fee_id;?>','<?php  echo $fetch_due_amount;?>','<?php  echo $due_amount_fine_amount;?>','<?php  echo $final_payble_due_amount;?>','0')" value="<?php  echo $fetch_due_amount_fee_id;?>"  checked></td>                                    
<td class="td_print_value" style="border-right:1px solid silver; font-size:11px;  color:red;">No Modify</td>
                               </tr>  
                               
                             <?php 
                               $total_due_amount +=$fetch_due_amount;
                               $total_both_fine_or_due_amount +=$final_payble_due_amount;
                               $total_due_amount_fine +=$due_amount_fine_amount;
                               }
                               } 
                               }
                               
                                 $now_total_payable_fees=($now_total_payable_fees+$total_both_fine_or_due_amount);
                               $now_fee_payable_amount=($now_fee_payable_amount+$total_due_amount);
                              
                              
                               $now_fine_payable_amount=($now_fine_payable_amount+$total_due_amount_fine);
                               $now_discount_amount_payable=($now_discount_amount_payable);
                               $now_finaly_amount_payable=($now_finaly_amount_payable+$total_both_fine_or_due_amount);
                                
                               
                               
                               
                              if($now_discount_amount_payable!=0)
                               {
                               $discount_rate=number_format((($now_discount_amount_payable*100)/$now_fee_payable_amount),2);
                               }  else {
                                  $discount_rate=0; 
                               }   
                             ?>
                               
                               
                            <?php
                            if($get_fee_group_id=="other_fee")
                            {
                            ?>   
                               
                            <tr>
                                <td style="border-left-width: 1px; border-left-style: solid; border-left-color: silver; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: silver;">
                                    <input type="hidden" name="fee_group_id[]" id="other_fee_group_id_1" value="fee_other_pay">
                                    <input type="text" id="other_fee_group_name_1" placeholder="Enter fee name" class="fee_group_text_box" style="width:160px;" name="fee_group_name[]"></td>
                                
                                
                                <td style="border-left-width: 1px; border-left-style: solid; border-left-color: silver; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: silver;">
                                    <input type="hidden" id="temp_other_fee_group_amount_1">
                                    <input type="text" autocomplete="off" placeholder="Amount" onkeypress="javascript:return isNumber (event)" onkeyup="other_fee_group_amount_value(this.value,1)" id="other_fee_group_amount_1" class="fee_group_text_box" style="width:40px;" name="fee_group_amount[]"></td>
                                <td style="border-left-width: 1px; border-left-style: solid; border-left-color: silver; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: silver;">
                                    <input type="hidden" id="temp_other_fee_group_qty_1">
                                    <input type="text" autocomplete="off" placeholder="Qty" onkeypress="javascript:return isNumber (event)" onkeyup="other_fee_group_qty_value(this.value,1)" id="other_fee_group_qty_1" class="fee_group_text_box" style="width:31px; text-align:center;" value="1" name="fee_group_qty[]"></td>
                                
                                <td style="border-left-width: 1px; border-left-style: solid; border-left-color: silver; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: silver;">
                                    <input type="text" placeholder="Specific Month" id="other_fee_group_specific_month_1" class="fee_group_text_box" style="width:90px;" name="fee_group_specific_month[]"></td>
                                
                                <td style="border-left-width: 1px; border-left-style: solid; border-left-color: silver; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: silver; text-align: center;">
                                    <input type="hidden" name="sub_total_fee[]" id="other_fee_group_sub_total_value_1" value="0">
                                    <div class="sub_total_style_sheet" id="other_fee_group_sub_total_html_1">0</div></td>
                                
                                
                                <td style="border-left-width: 1px; border-left-style: solid; border-left-color: silver; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: silver;">
                                    <input type="hidden" id="temp_other_fee_group_fine_1">
                                    <input type="text" autocomplete="off" placeholder="Fine" onkeypress="javascript:return isNumber (event)" onkeyup="other_fee_group_fine_value(this.value,1)" id="other_fee_group_fine_1" class="fee_group_text_box" style="width:40px;" name="fine_total_fee[]"></td>
                                <td style="border-left-width: 1px; border-left-style: solid; border-left-color: silver; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: silver;">
                                    <input type="hidden" id="temp_other_fee_group_discount_1">
                                    <input type="text" autocomplete="off" placeholder="Discount" onkeypress="javascript:return isNumber (event)" onkeyup="other_fee_group_discount_value(this.value,1)" id="other_fee_group_discount_1" class="fee_group_text_box" style="width:43px;" name="discount_total_fee[]"></td>
                                
                                <td style="border-left-width: 1px; border-left-style: solid; border-left-color: silver; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: silver; text-align: center;">
                                    <input type="hidden" name="total_amount[]" id="other_fee_group_total_amount_value_1" value="0">
                                    <div class="sub_total_style_sheet" id="other_fee_group_total_amount_html_1">0</div></td>
                                
                                <td style="border-left-width: 1px; border-left-style: solid; border-left-color: silver; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: silver; text-align: center;"><input type="checkbox" checked="" disabled=""></td>
                                
                                <td style="border-left-width: 1px; border-left-style: solid; border-left-color: silver; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: silver; border-right-width: 1px; border-right-style: solid; border-right-color: silver; font-size:11px; color:red; text-align:center;   ">No Modify</td></tr>
                                
                                <?php
                            }
                                ?>    
                               
                               
                               
                               
                            <tr>
                                <td colspan="7" style=" background-color:white ; height:25px; text-align:right;font-size:12px; 
                                    border-bottom:1px solid silver; border-left:1px solid silver;  ">
                                    <div style=" width:290px; float:right;  ">
                                        <strong>Total Payable Amount</strong>  <strong style=" padding-left:5px; ">:</strong> 
                                       </div>
                                </td>
                                <td style=" background-color:white;font-size:12px; font-weight:bold;  color:brown;   text-align:center; border-bottom:1px solid silver;">
                                    <div id="currency"><?php  echo $fetch_currency;?></div> <div id="final_payable_amount"><?php  echo $now_total_payable_fees;?></div>
                                        
                                </td>
                                <td  style=" background-color:white ;border-bottom:1px solid silver; "></td>
                                <td style=" background-color:white ;border-bottom:1px solid silver; border-right:1px solid silver; ">
                                    
                                </td>
                            </tr>
                        </tbody></table>   
                    </td>
                </tr>
            </tbody></table>
      
       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
      <legend><span style=" color: maroon;  ">Payment Details</span></legend>
         
         <table cellspacing="0" style=" width:100%; padding-left:3px;  ">
             <tbody><tr>
                 <td style="height:25px;">
                  Fee Payable <sup style=" color:red; ">*</sup>  
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td>
                     <input type="hidden" id="temp_fee_payable_amount"  value="<?php  echo $get_sub_total_amount;?>">
                     <input type="text" style=" background-color:aliceblue;  " readonly="readonly" name="total_fee_payable_value"
                            class="text_box_size_same" id="fee_payable_amount" value="<?php  echo $now_fee_payable_amount;?>">
                 </td>
                  <td>
                     
                Fine Payable   
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td>
                     <input type="text" style=" background-color:aliceblue;  " readonly="readonly" name="total_fine_payable_value" class="text_box_size_same"
                            id="total_fine_amount" value="<?php  echo $now_fine_payable_amount;?>">
                 </td>
             </tr> 
             
             <tr id="fine_discount_tr" style=" display:none; ">
                 <td>
                    
                     Fine Discount
                 </td>
                 <td><b>:</b></td>
                 <td><input style=" background-color:aliceblue;" class="text_box_size_same"
                        id="total_fine_discount" name="fine_discount"   readonly="readonly" type="text"></td>
                 <td>Description</td>
                 <td><b>:</b></td>
                 <td>
                     <textarea id="total_fine_discount_description" style=" background-color:aliceblue; 
                               width:161px; " name="fine_discount_description" readonly="readonly"></textarea>    
                 </td>
             </tr>
             <tr>
                 <td style="height:25px;">
                  Discount in %  
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td>
                     <input type="text" style=" background-color:aliceblue;  " readonly="readonly" name="discount_rate" 
                            class="text_box_size_same" id="discount_rate" value="<?php  echo $discount_rate;?>">
                 </td>
                  <td>
                 Discount Amount   
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td>
                     <input type="text" style=" background-color:aliceblue;  " readonly="readonly" name="total_discount_amount" class="text_box_size_same"
                            id="total_amount_discount" value="<?php  echo $now_discount_amount_payable;?>">
                 </td>
             </tr>
             <tr>
                 <td style="height:25px;">
                 Payment Info  
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td>
                     <input type="text" name="payment_info" class="text_box_size_same" id="totalamount" value="">
                 </td>
                  <td>
                  Fee Description 
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td>
                     <textarea name="fee_description" style="width:161px; height:30px; "></textarea>
                 </td>
             </tr>
             <tr id="special_discount_tr" style=" display:none; ">
                 <td>
                   Special Discount
                 </td>
                 <td><b>:</b></td>
                 <td><input id="total_special_discount_amount" name="special_discount" style=" background-color:aliceblue;" class="text_box_size_same" readonly="readonly" type="text"></td>
                 <td>Description</td>
                 <td><b>:</b></td>
                 <td>
                     <textarea id="special_description" name="special_discount_description" style=" background-color:aliceblue; width:161px;   " readonly="readonly"></textarea>    
                 </td>
             </tr>
             <tr>
                 <td style="height:25px;">
                <strong> Amount Payable </strong><sup style=" color:red; ">*</sup>  
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td>
               <input type="text" style=" background-color:aliceblue;  " name="total_amount_payable" readonly="readonly" class="text_box_size_same"
                      id="final_amount_payable_this" value="<?php  echo $now_finaly_amount_payable;?>">
                 </td>
                 
             </tr>
             <style>
                 .add_spacial_discount{ width:110px; text-align:center;  height:22px; padding-top:8px;
                 background-color:dodgerblue; color:white; cursor:pointer; box-shadow:0px 0px 2px 1px silver;
                 border-radius:3px; float:right; margin-right:26px;   }
             </style>
             
             <tr>
                 <td style="height:35px; padding-top: 10px;">
                     <b>Payment Mode</b> <sup style=" color:red; ">*</sup>  
                 </td><td style="width:10px;"><strong>:</strong></td>
                 <td>
                     <select class="select_box" onchange="change_payment_mode(this.value)" name="payment_mode" id="selectpaymenttype">
                         <option value="cash">CASH</option>
                         <option value="cheque">CHEQUE</option>
                         <option value="dd">DD</option>
                     </select>
                 </td>
                 <td colspan="3">
                     <div onclick="add_discount()" class="add_spacial_discount">Add Discount</div>
                 </td>
                 
             </tr>
        <tr>
                 <td colspan="6">
        <fieldset id="showchequeanddddetails" style="display:none;">
         <legend><span style=" color: maroon; ">CHEQUE/DD Details</span></legend>
                     <table style="width:100%; height:100px; ">
                         <tbody><tr>
                         <td>Bank Name</td><td style="width:10px;"><strong>:</strong></td>
                         <td colspan="4">
                             <select id="selectbankname" name="bank_name">
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
	<option>Woori Bank</option>
	<option>Yes Bank Ltd</option>
        <option>Other Bank</option>
                             </select>
                         </td>
                         </tr>
                         <tr>
                         <td>Cheque/DD No.</td><td style="width:10px;"><strong>:</strong></td>
                         <td>
                        <input type="text" name="cheque_dd_number" id="chequeddno" class="text_box_size_same">
                         </td>
                         <td>Cheque/DD Date</td><td style="width:10px;"><strong>:</strong></td>
                         <td>
                          <div id="outputcalender"></div>
                        <input type="text" name="cheque_dd_date" id="cheque_dd_date" class="text_box_size_same">
                        
                         </td>
                         
                         </tr>
                         <tr>
                         <td colspan="2">Cheque/DD Amount</td>
                         <td>
                     <strong>:</strong> <input type="text" autocomplete="off" value="" 
                                             onkeyup="cheque_amount_payable(this.value)"  id="chequeddamount" name="cheque_dd_amount"
                                               class="text_box_size_same">
                         </td>
                         
                         </tr>
                     </tbody></table></fieldset>
                 </td>
       
             </tr>
             <tr>
                 <td style="height:8px;  ">
                     
                 </td>
             </tr>
             <tr>
                 <td style=" height:30px; text-align:center;  background-color: aqua;   ">
                     <strong>Amount Paid</strong></td>
                 <td style="width:10px;  height:30px; background-color: aqua;   "><strong>:</strong></td>
                 <td style=" height:30px; background-color: aqua;  ">
                     <input type="hidden" id="temp_amount_paid_value" value="<?php  echo $now_finaly_amount_payable;?>">
                     <input type="text" style=" border:1px solid black; height:22px;  " onkeypress='javascript:return isNumber (event)' name="amount_paid" onkeyup="amount_payable(this.value)"
                            autocomplete="off" id="amount_paid_value" 
                            class="text_box_size_same" value="<?php  echo $now_finaly_amount_payable;?>">
                     
                   
                 </td>
               <?php 
                 if($now_finaly_amount_payable<0)
                 {
                    $due_amount_value=$now_finaly_amount_payable;
                 }else
                 {
                   $due_amount_value=0;  
                 }
                 ?>
                 <td style=" height:30px; background-color: aqua;  "><b>Due/(-)Paid Amount</b></td>
                 <td style=" height:30px; background-color: aqua;  "><b>:</b></td>
                 <td style=" height:30px; background-color: aqua;  ">
            <input type="text" name="due_amount" id="due_amount" value="<?php  echo $due_amount_value;?>"></td>
                 
           <td colspan="4" style=" height:100%; margin-bottom:5px;  background-color:aqua;  "></td>

             </tr>
             <tr>
                 <td colspan="7"><hr/></td>
             </tr>
             <tr>
                 <td colspan="6" style=" padding-top:10px; ">
                
                 <input type="submit" class="addpayamount_reset_button" id="payamount" 
                        name="payamount" onclick="myFunction()" value="Pay Fee">
                 </td>
             </tr>
         </tbody></table>
         </fieldset>
      
    <?php   
    }
    ?>   
      
      
  </div>    
     </div>       
<?php 
}
}
}

?>

<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>