<?php
if((!empty($_REQUEST['student_admission_id'])))
{
 $fetch_student_id=$_REQUEST['student_admission_id'];  
echo "<div id='previous_fee_payment_redord'>
<table cellspacing='0' cellpadding='0' class='fee_table_class'>";


$fee_payment_db=mysql_query("SELECT * FROM finance_student_pay_fee WHERE $db_main_details student_id='$fetch_student_id' and is_delete='none'");
$fetch_fee_payment_num_rows=mysql_num_rows($fee_payment_db);

if($fetch_fee_payment_num_rows!=0)
{
    echo "<tr>
        <td class='th_styling'>Sl.No</td>
        <td class='th_styling'>Rec. No.</td>
        <td class='th_styling'>Receipt ID</td>
        <td class='th_styling'>Payment Date</td>
        <td class='th_styling'>Amount Payable</td>
        <td class='th_styling'>Amount Paid</td>
        <td class='th_styling' style='border-right:1px solid black;'>Action</td>
        </tr>";  
}

$row=0;
while($fetch_fee_payment_data=mysql_fetch_array($fee_payment_db))
{
 
    
    
    $recipt_no=$fetch_fee_payment_data['id'];
 $recipt_id=$fetch_fee_payment_data['receipt_id']; 
 $payment_date=$fetch_fee_payment_data['payment_date']; 
 $encrypt_id=$fetch_fee_payment_data['encrypt_id']; 
 $amount_payable=  number_format($fetch_fee_payment_data['student_payable_amount'],2); 
 $amount_paid=number_format($fetch_fee_payment_data['amount_paid'],2); 
 $row++;
 echo "<tr>
       <td class='fee_td_styling'>$row</td>
       <td class='fee_td_styling'>$recipt_no</td>
       <td class='fee_td_styling'>";
 {?>
 
 <a style='color:blue;' href="#" onclick="window.open('finance_fee_view_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=530,width=900,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
 <b><?php  echo $recipt_id;?></b></a>
<?php 
 }
 echo"</td>
       <td class='fee_td_styling'>$payment_date</td>
       <td class='fee_td_styling' style='text-align:right; padding-right:5px;'><span style='font-size:11px;'>$fetch_currency</span> $amount_payable</td>
       <td class='fee_td_styling' style='text-align:right; padding-right:5px;' ><span style='font-size:11px;'>$fetch_currency</span> $amount_paid</td>
       <td class='fee_td_styling' style='color:blue; border-right:1px solid black;'>";
 {
    
?>
 <a style='color:blue;' href="#" onclick="window.open('fee_payment_receipt.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=530,width=900,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
 <b>Print</b></a>
<?php 
 }
 echo "</td>
       </tr>";
 
    
    
    
}

$fetch_due_amount_db=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE $db_main_details student_id='$fetch_student_id' and is_delete='none'");

$fetch_due_amount=0;
while ($fetch_due_amount_data=mysql_fetch_array($fetch_due_amount_db))
{
   $fetch_due_amount +=$fetch_due_amount_data['due_amount']; 
}

if($fetch_due_amount<0)
{
$print_due_fee_name="Extra Paid Amount"; 
$fetch_due_amount=  abs($fetch_due_amount);
}else
{
$print_due_fee_name="Due Amount";   
}
if($fetch_fee_payment_num_rows!=0)
{
echo "<tr>
<td colspan='7' style='border:1px solid black; height:22px;
text-align:center; padding-right:30px; background-color:gray; color:white;
border-top:0px;'><b>$print_due_fee_name : $fetch_currency $fetch_due_amount /-</b></td>    
</tr>";
}else
{
    echo "<tr><td style=' text-align:center; height:25px; color:red; font-weight:bold;'>Record No Found !!</td></tr>";   
}
echo "</table></div>";
}
?>