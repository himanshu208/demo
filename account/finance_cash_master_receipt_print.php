
<?php 
session_start(); 
ob_start();
?>
<?php 
require_once '../connection.php';
if(isset($_SESSION['finance_module']))
{
$user_unique_id=$_SESSION['finance_module'];
$user_db=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id='$user_unique_id'");
$fetch_user_data=mysql_fetch_array($user_db);
$fetch_user_num_rows=mysql_num_rows($user_db);
if((!empty($fetch_user_data))&&($fetch_user_data!=null)&&($fetch_user_num_rows!=0))
{
  $fetch_school_id=$fetch_user_data['organization_id'];
  $fetch_branch_id=$fetch_user_data['branch_id'];
  $fetch_accout_type=$fetch_user_data['account_type'];
  $fecth_user_unique=$fetch_user_data['user_admin_id'];
$organisation_db=mysql_query("SELECT * FROM organization_db WHERE organization_id='$fetch_school_id'"); 
 $fetch_org_data=mysql_fetch_array($organisation_db);
 $fetch_org_num_rows=mysql_num_rows($organisation_db);
if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_rows!=0))
{
$fetch_school_logo="../".$fetch_org_data['school_logo'];

$branch_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");  
$fetch_branch_data=mysql_fetch_array($branch_db);
$fetch_branch_num_rows=mysql_num_rows($branch_db);
 if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
 {
$fetch_branch_unique_db_id=$fetch_branch_data['branch_id'];
$fetch_school_name=$fetch_branch_data['branch_name'];
 

if($fetch_accout_type=="branch_head_admin")
{
 $manage_module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and admin_type='branch_head_admin'");   

}else
{
$manage_module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and admin_id='$user_unique_id'");   
}
$fetch_module_data=mysql_fetch_array($manage_module_db);
$fetch_module_num_rows=mysql_num_rows($manage_module_db);
 if((!empty($fetch_module_data))&&($fetch_module_data!=null)&&($fetch_module_num_rows!=0))
 {
  $fetch_module_list=$fetch_module_data['module'];
  $explode_module_array=explode(",",$fetch_module_list);
  $check_array_in="account";
  $search_match_module= in_array($check_array_in,$explode_module_array);
  if($search_match_module==true)
  {
 {
  ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finance Print Receipt</title>
          <script type="text/javascript" src="jquery/jquery-1.js">
        </script>
        <script type="text/javascript">
       $(document).ready(function(){
        window.print();   
       });
        </script>
    </head>
    <style>
     #first_print_slip_div{ width:730px; margin:0 auto; font-family:arial;   height:100%;     }  
     .top_td_receipt{ width:100%; height:25px; text-align:center; font-size:15px; font-weight: bold; color:#440000;  
                     border-bottom:1px solid black; border-top:1px solid black; text-align:center;   }
     .top_td_receipt_middle{width:100%; height:25px;text-align:center; 
                            font-size:13px; font-weight:700; 
                            color:#440000;  border-top:1px solid silver;
                     border-bottom:1px solid silver; text-align:left;  }
     .top_td_receipt_middle_total{width:100%; height:25px;text-align:center; 
                            font-size:13px; font-weight:700; 
                            color:#440000;  border-top:1px dotted silver;
                     border-bottom:1px dotted silver; text-align:left;  }
     .left_td_style{ width:150px; height:22px; font-size:12px; adding-top:2px; font-weight:bold;   }
     .left_td_style_size{ width:150px; height:16px; padding-bottom:5px; font-size:12px; adding-top:2px; font-weight:bold;   }
     .right_td_style{ width:auto; text-align:left; font-size:12px;}
     .top_td_receipt_middle_company_name{width:100%; height:25px; text-align:center; 
                            font-size:13px; font-weight:700; 
                            color:#440000;  border-top:1px solid silver; padding-top:20px;  text-align:center; 
                      }
                       #first_page_ajax_code{ width:100%; height:auto;  }  
         .top_heading_data{ width:100%; height:25px; border-top: 1px solid silver;border-bottom: 1px solid silver;
                           text-align:center; background-color: steelblue; font-weight:bold; font-size:15px; 
         color:white;}
       .top_heading_line{ width:auto;  height:25px; text-align:center; font-size:11px;  
                  background-color:whitesmoke; font-weight:bold; z-index:101; 
                  border-bottom:1px solid silver; border-right:1px solid silver;
    }
    .top_heading_line_this{ width:auto;  height:25px; text-align:center; font-weight:100; font-size:11px; 
                  background-color:white;
                  border-bottom:1px solid silver; border-right:1px solid silver;}
    #td_colering{ border-left:1px solid silver;   }
    .left_side_td{ width:150px; height:15px;  }
    .right_td_style{ width:200px; height:15px;  }
    </style>
    <body>
        <div id="first_print_slip_div">
            <table cellspacing="0" cellpadding="0"  style='width:100%; height:70px; float:left;  color:white; font-size:32px; text-align:center;
                   background-color:black;  '>
                <tr><td>B.K PUBLIC SCHOOL</td></tr>
            </table> 
            <table cellspacing="0" cellpadding="0" style='width:100%;margin-top:5px; font-size:13px;   
                   height:auto; float:left;'>
                <tr>
                    <td colspan='4' class='top_td_receipt'>
                   Cash Book Receipt 
                    </td>
                </tr>
                <tr>
                    <td>
                      <?php 
                        require_once '../connection.php';
                        if((!empty($_REQUEST['fee_starttime']))&&(!empty($_REQUEST['fee_duetime']))&&(!empty($_REQUEST['feegroup'])))
                        {
                         $startfeespayment=$_REQUEST['fee_starttime'];
        $duefeespayment=$_REQUEST['fee_duetime'];
        $feesgroup=$_REQUEST['feegroup'];   
                            
                            
                         echo " 
                <table  cellspacing='0' cellpadding='0'  style=' width:100%; '>
        <tr >
        <td colspan='2' height='40px; padding-left:10px;'><strong>Start Date :</strong></td><td>$startfeespayment</td>
        <td colspan='4' style='text-align:right;'><strong>End Date :</strong></td><td style='text-align:right;'>$duefeespayment</td>
        </tr>
                <tr><td colspan='9' class='top_heading_data'>
                   Cash Book Fee Name : $feesgroup
                    </td></tr><tr><td colspan='9' style='width:100%;'></td></tr>
                <tr>
               <td class='top_heading_line' STYLE='30PX; border-left:1px solid silver;'>Sl.No</td>
               <td class='top_heading_line'>Receipt No</td>
               <td class='top_heading_line'>Payment Date</td>
               <td class='top_heading_line'>Student Name</td>
               <td class='top_heading_line' >Father Name</td>
               <td class='top_heading_line'>Class - Section</td>
               <td class='top_heading_line' >Fee Group Name</td>
               <td class='top_heading_line'>Amount Paid</td>
               <td class='top_heading_line'>Status</td>";
        
         $checkfeesequal="";
           $checkfeetype_equal="";
           $row=0;  
          $feegroupnamedb=mysql_query("SELECT * FROM financefeeamount WHERE addfeesname='$feesgroup'"); 
          while($fecthfeename=  mysql_fetch_array($feegroupnamedb))
          {
           $fetch_feesname=$fecthfeename['addfeesname'];  
           $fecthfees_type=$fecthfeename['feegrouptype'];
           $fetchfees_groupname=$fecthfeename['feesgroupname'];
           if(($fetch_feesname!=$checkfeesequal)&&($fecthfees_type!=$checkfeetype_equal))
           {
             $startdatevalue=strtotime($startfeespayment);
                 $encryptfetchstartdate=ceil($startdatevalue/60/60/24);
                
                 $enddatefrom=strtotime($duefeespayment);
                 $encryptfetchduedate=ceil($enddatefrom/60/60/24);      
                $totalfinalamountfinallypaid=0;
               for($strst_firstdate=$encryptfetchstartdate;$strst_firstdate<=$encryptfetchduedate;$strst_firstdate++)
               {
             
            $temp_recieptnumber=0;
            $databasestudentfees=mysql_query("SELECT * FROM finanacepaystudentfees WHERE feesgroup='$fetchfees_groupname'");    
           while($fecthfee_payment=mysql_fetch_array($databasestudentfees)) 
           {
               $fetch_receiptnumber=$fecthfee_payment['trnumber'];
               $fetchpaymentdate=$fecthfee_payment['paymentdate'];
               $fetchstudent_srnumber=$fecthfee_payment['studentsrno'];
               $fetchstudentadmission_number=$fecthfee_payment['studentadmissionno'];
               $fetch_feesgroup_name=$fecthfee_payment['feesgroup'];
               $amount_paid=$fecthfee_payment['amountpaid'];
               $feesstatus=$fecthfee_payment['status'];
                $endpaymantdatefrom=strtotime($fetchpaymentdate);
                 $encryptpaymentdate=ceil($endpaymantdatefrom/60/60/24);   
               if($encryptpaymentdate==$strst_firstdate)
               {
                  
               if($fetch_receiptnumber!=$temp_recieptnumber)
               {
               $fetchstudentdatabase=  mysql_query("SELECT * FROM studentadmissionlkg WHERE id='$fetchstudent_srnumber' and admissionno='$fetchstudentadmission_number'");
               $fetchstudentdetails=  mysql_fetch_array($fetchstudentdatabase);
               if(!empty($fetchstudentdetails))
               {
                   $feepayment_check=$fecthfee_payment['feepaymonth'];
                   $databasestudentfees_row=mysql_query("SELECT * FROM finanacepaystudentfees WHERE trnumber='$fetch_receiptnumber'");    
                   $fecthfee_payment_row=mysql_num_rows($databasestudentfees_row);
                   $studentname=$fetchstudentdetails['firstname'];
                   $studentfathername=$fetchstudentdetails['fathername'];
                   $studentclass=$fetchstudentdetails['class'];
                   $studentsection=$fetchstudentdetails['section'];
                  if(($fecthfee_payment_row>1)&&($feepayment_check=="autopayment"))
                  {
                   $fetch_feesgroup_name_TEMP="/O.T.P"; 
                   $fecth_particular_feee_amount=$fecthfee_payment['perticularfees'];
                   $fecth_particular_fine=$fecthfee_payment['particularfine'];
                   $fecth_particular_discount=$fecthfee_payment['particulardiscount'];
                   $fetch_this_descount_fine=$fecthfee_payment['discountfine'];
                   $divided_fine=$fetch_this_descount_fine/$fecthfee_payment_row;
                   $both_added_this=round($divided_fine+$fecth_particular_discount);
                   $amount_paid=(($fecth_particular_feee_amount+$fecth_particular_fine)-$both_added_this);
                  }else {
                 $fetch_feesgroup_name_TEMP=""; 
                  }
                   $row++;
               echo "<tr>
               <td class='top_heading_line_this' style='border-left:1px solid silver;'>$row</td>
               <td class='top_heading_line_this'>$fetch_receiptnumber</td>
               <td class='top_heading_line_this'>$fetchpaymentdate</td>
               <td class='top_heading_line_this'>$studentname</td>
               <td class='top_heading_line_this'>$studentfathername</td>
                <td class='top_heading_line_this'>$studentclass -  $studentsection</td>
                <td class='top_heading_line_this'>$fetch_feesgroup_name$fetch_feesgroup_name_TEMP</td>
             <td class='top_heading_line_this'>$amount_paid</td>
               <td class='top_heading_line_this'>$feesstatus</td>
               </tr>
                   ";
               }else
               {
                   echo "<tr><td colspan='12' style='width:100%;border-left:1px solid silver; font-size:15px; text-align:center; font-weight:bold;
                     height:25px; background-color:skyblue;'>No Record Found</td></tr>";
               }
               $temp_recieptnumber=$fetch_receiptnumber;
               $totalfinalamountfinallypaid +=$amount_paid;}}}}
           if(empty($totalfinalamountfinallypaid))
           {
             echo "<tr><td colspan='12' style='width:100%; font-size:15px; text-align:center; font-weight:bold;
                     height:25px; background-color:skyblue;'>No Record Found</td></tr>";  
           }
           $convernumberformat=number_format($totalfinalamountfinallypaid,2);
           echo "<tr>
                    <td colspan='7' style='text-align:right; padding-top:5px; padding-bottom:5px; background-color:white;'>
                    <strong> Total Amount Paid :  </strong>
                    </td>
             <td style='text-align:center; background-color:white;'> <strong>  $convernumberformat  </strong></td>
             <td colspan='4' style='background-color:white; text-align:center; '>
           
             </td>   
             </tr></table>";   
           }
           $checkfeesequal=$fetch_feesname;
           $checkfeetype_equal=$fecthfees_type;
           $checkfeegroup_equal=$fetchfees_groupname;
          }
          if(empty($fetch_feesname))
          {
              echo "<tr><td colspan='12' style='width:100%; font-size:15px; text-align:center; font-weight:bold;
                     height:25px; background-color:skyblue;'>No Record Found</td></tr>";
          }   
                        }
                        
                        
                        //user_fee_payment_print
                        
                         if((!empty($_REQUEST['user_fee_starttime']))&&(!empty($_REQUEST['user_fee_duetime'])))
       {
        $startfeespayment=$_REQUEST['user_fee_starttime'];
        $duefeespayment=$_REQUEST['user_fee_duetime'];
        echo "  <table  cellspacing='0' cellpadding='0'  style=' width:100%; '>
             <tr>
        <td colspan='2' height='40px; padding-left:10px;'><strong>Start Date :</strong></td><td>$startfeespayment</td>
        <td colspan='4' style='text-align:right;'><strong>End Date :</strong></td><td style='text-align:right;'>$duefeespayment</td>
        </tr>
                <tr>
                    <td colspan='13' class='top_heading_data'>
                   Fee Payment Details
                    </td>
                </tr>
                
                <tr>
                    <td colspan='12' style='width:100%;'>
                       
                </td>
                </tr>
               <tr>
               <td class='top_heading_line' STYLE='30PX;border-left:1px solid silver;'>Sl.No</td>
               <td class='top_heading_line'>Receipt No</td>
               <td class='top_heading_line'>Payment Date</td>
               <td class='top_heading_line'>Student Name</td>
               <td class='top_heading_line' >Father Name</td>
               <td class='top_heading_line'>Class - Section</td>
               <td class='top_heading_line' >Fee Group Name</td>
               <td class='top_heading_line'>Amount Paid</td>
               <td class='top_heading_line'>Status</td>";
                 $startdatevalue=strtotime($startfeespayment);
                 $encryptfetchstartdate=ceil($startdatevalue/60/60/24);
                 $enddatefrom=strtotime($duefeespayment);
                 $encryptfetchduedate=ceil($enddatefrom/60/60/24);      
                $totalfinalamountfinallypaid=0;
                 $row=0;   
               for($strst_firstdate=$encryptfetchstartdate;$strst_firstdate<=$encryptfetchduedate;$strst_firstdate++)
               {
            $temp_recieptnumber=0;
            $databasestudentfees=mysql_query("SELECT * FROM finanacepaystudentfees");    
           while ($fecthfee_payment=  mysql_fetch_array($databasestudentfees)) 
           {
               
               $fetch_receiptnumber=$fecthfee_payment['trnumber'];
               $fetchpaymentdate=$fecthfee_payment['paymentdate'];
               $fetchstudent_srnumber=$fecthfee_payment['studentsrno'];
               $fetchstudentadmission_number=$fecthfee_payment['studentadmissionno'];
               $fetch_feesgroup_name=$fecthfee_payment['feesgroup'];
               $amount_paid=$fecthfee_payment['amountpaid'];
               $feesstatus=$fecthfee_payment['status'];
               $endpaymantdatefrom=strtotime($fetchpaymentdate);
                 $encryptpaymentdate=ceil($endpaymantdatefrom/60/60/24);   
               if($encryptpaymentdate==$strst_firstdate)
               {
                  
               if($fetch_receiptnumber!=$temp_recieptnumber)
               {
               $fetchstudentdatabase=  mysql_query("SELECT * FROM studentadmissionlkg WHERE id='$fetchstudent_srnumber' and admissionno='$fetchstudentadmission_number'");
               $fetchstudentdetails=  mysql_fetch_array($fetchstudentdatabase);
               if(!empty($fetchstudentdetails))
               {
                    $row++;
                    
                    $feepayment_check=$fecthfee_payment['feepaymonth'];
                   $databasestudentfees_row=mysql_query("SELECT * FROM finanacepaystudentfees WHERE trnumber='$fetch_receiptnumber'");    
          $fecthfee_payment_row=mysql_num_rows($databasestudentfees_row);
                     if(($fecthfee_payment_row>1)&&($feepayment_check=="autopayment"))
                  {
                   $fetch_feesgroup_name="One Time Paid"; 
                   
                  }
                   $studentname=$fetchstudentdetails['firstname'];
                   $studentfathername=$fetchstudentdetails['fathername'];
                   $studentclass=$fetchstudentdetails['class'];
                   $studentsection=$fetchstudentdetails['section']; 
         echo "<tr>
               <td class='top_heading_line_this' style='border-left:1px solid silver;'>$row</td>
               <td class='top_heading_line_this'>$fetch_receiptnumber</td>
               <td class='top_heading_line_this'>$fetchpaymentdate</td>
               <td class='top_heading_line_this'>$studentname</td>
               <td class='top_heading_line_this'>$studentfathername</td>
               <td class='top_heading_line_this'>$studentclass -  $studentsection</td>
               <td class='top_heading_line_this'>$fetch_feesgroup_name</td>
               <td class='top_heading_line_this'>$amount_paid</td>
               <td class='top_heading_line_this'>$feesstatus</td>
               </tr>
                   ";
               }else
               {
                 echo "<tr><td colspan='12' style='width:100%; font-size:15px; text-align:center; font-weight:bold;
                     height:25px; background-color:skyblue;'>No Record Found</td></tr>";
               }
               $temp_recieptnumber=$fetch_receiptnumber;
               $totalfinalamountfinallypaid +=$amount_paid;
               }}}}
           if(empty($totalfinalamountfinallypaid))
           {
             echo "<tr><td colspan='12' style='width:100%; font-size:15px; text-align:center; font-weight:bold;
                     height:25px; background-color:skyblue;'>No Record Found</td></tr>";  
           }
           $convernumberformat=number_format($totalfinalamountfinallypaid,2);
           echo "<tr>
                    <td colspan='7' style='text-align:right; padding-top:5px; padding-bottom:5px; background-color:white;'>
                    <strong> Total Amount Paid :  </strong>
                    </td>
             <td style='text-align:center; background-color:white;'> <strong>  $convernumberformat  </strong></td>
             <td colspan='4' style='background-color:white; text-align:center; '>
           
             </td>   
             </tr></table>";   
             }
          
             
            //daybook  
          if((!empty($_REQUEST['daybook_fee_duetime']))&&(!empty($_REQUEST['daybook'])))
          {
              $day_book_find_today_date=$_REQUEST['daybook_fee_duetime'];
               $startdatevalue=strtotime($day_book_find_today_date);
                 $encryptfetchstartdate=ceil($startdatevalue/60/60/24);
                 $enddatefrom=strtotime($day_book_find_today_date);
                 $encryptfetchduedate=ceil($enddatefrom/60/60/24);      
        echo "  <table  cellspacing='0' cellpadding='0'  style=' width:100%; '>
             <tr >
        <td colspan='' height='40px; padding-left:10px;'><strong>Date :</strong></td><td>$day_book_find_today_date</td>
        <td colspan='4' style='text-align:right;'><strong></strong></td><td style='text-align:right;'></td>
        </tr>
                <tr>
                    <td colspan='13' class='top_heading_data'>
                   Day Book
                    </td>
                </tr>
                
                
               
               <tr>
               <td class='top_heading_line' STYLE='30PX; border-left:1px solid silver;'>Sl.No</td>
               <td class='top_heading_line'>Fee Name</td>
               <td class='top_heading_line'>Income Amount</td>
                <td class='top_heading_line'>Expense Amount</td>
               ";
                 
          $totalfinalamountfinallypaid=0;  
          $temp_recieptnumber=0;
          $row=0; 
          $finaltotal_amount_student_temp =0;
          $checkfeesequal="";
          $feegroupnamedb=mysql_query("SELECT * FROM financefeeamount WHERE id order by addfeesname ASC"); 
          while($fecthfeename=mysql_fetch_array($feegroupnamedb))
          {
           $fetch_feesname=$fecthfeename['addfeesname'];  
           
           if($fetch_feesname!=$checkfeesequal)
           {
           $fecthfees_type=$fecthfeename['feegrouptype'];
           $fetchfees_groupname=$fecthfeename['feesgroupname'];
               
               $temp_account_amount=0;
               $temp_account_name="";
             
               $temp_receipt_number='';
              $finaltotal_amount_student=0;
                $temp_account_amount_temp_student=0;
               $account_payment_database=mysql_query("SELECT * FROM finanacepaystudentfees WHERE feesgroup='$fetchfees_groupname'");
               while($fetch_payment_details=mysql_fetch_array($account_payment_database))
               {
                   
               $fetch_recipt_number=$fetch_payment_details['trnumber'];
               if($fetch_recipt_number!=$temp_receipt_number)
               {
                 
               $fecth_payment_date=$fetch_payment_details['paymentdate'];
               $payment_date_this=strtotime($fecth_payment_date);
               $encryptfetch_paymentdate=ceil($payment_date_this/60/60/24);  
               $fetchaccountname_print=$fetch_payment_details['feesgroup'];
               if($temp_account_name!=$fetchaccountname_print)
               {
               
                   
             
               $temp_reciept_number_is="";
               $account_payment_database_temp=mysql_query("SELECT * FROM finanacepaystudentfees WHERE feesgroup='$fetchaccountname_print'");
               while ($fetch_payment_details_temp=mysql_fetch_array($account_payment_database_temp))
               {
                $fetch_temp_payment_date=$fetch_payment_details_temp['paymentdate'];
                $fecth_receipt_number=$fetch_payment_details_temp['trnumber'];
                if($temp_reciept_number_is!=$fecth_receipt_number)
                {
                  $feepayment_check= $fetch_payment_details_temp['feepaymonth']; 
                $databasestudentfees_row=mysql_query("SELECT * FROM finanacepaystudentfees WHERE trnumber='$fecth_receipt_number'");    
                $fecthfee_payment_row=mysql_num_rows($databasestudentfees_row);    
                
                $payment_date_this_temp=strtotime($fetch_temp_payment_date);
               $encryptfetch_paymentdate_temp=ceil($payment_date_this_temp/60/60/24);  
              for($strst_firstdate=$encryptfetchstartdate;$strst_firstdate<=$encryptfetchduedate;$strst_firstdate++)
               {
               if($encryptfetch_paymentdate_temp==$strst_firstdate)
               { 
               
                 if(($fecthfee_payment_row>1)&&($feepayment_check=="autopayment"))
                  {
                   $fetch_feesgroup_name_TEMP="/O.T.P"; 
                   $fecth_particular_feee_amount=$fetch_payment_details_temp['perticularfees'];
                   $fecth_particular_fine=$fetch_payment_details_temp['particularfine'];
                   $fecth_particular_discount=$fetch_payment_details_temp['particulardiscount'];
                   $fetch_this_descount_fine=$fetch_payment_details_temp['discountfine'];
                   $divided_fine=$fetch_this_descount_fine/$fecthfee_payment_row;
                   $both_added_this=round($divided_fine+$fecth_particular_discount);
                   $fetch_this_expense_payment_amount_temp=(($fecth_particular_feee_amount+$fecth_particular_fine)-$both_added_this);
                  }else {
                  $fetch_this_expense_payment_amount_temp=$fetch_payment_details_temp['amountpaid'];
                  }
                $temp_account_amount_temp_student +=$fetch_this_expense_payment_amount_temp;
               }
               }
               
                }
                $temp_reciept_number_is=$fecth_receipt_number;
               }
                  
                  if($temp_account_amount_temp_student!=0)
                  {
                      $row++;
                   echo "<tr>
               <td class='top_heading_line_this' style='border-left:1px solid silver;'>$row</td>
               <td class='top_heading_line_this'>$fetchaccountname_print</td>
               <td class='top_heading_line_this'>$temp_account_amount_temp_student</td>
               <td class='top_heading_line_this'></td>
               </tr>
                   "; 
                  
                  }
                  $temp_account_name=$fetchaccountname_print; 
               
                $finaltotal_amount_student +=$temp_account_amount_temp_student;
               }
               }
              $temp_receipt_number=$fetch_recipt_number;   
              
             }
              $checkfeesequal=$fetch_feesname;
            $finaltotal_amount_student_temp +=$finaltotal_amount_student;
             
               } }
        
                 
               
               
               //expense_balance_sheet
                
                 $totalfinalamountfinallypaid=0;
                  
              
            $temp_recieptnumber=0;
            $account_type="expense";
             
            $finaltotal_amount_expense=0;
           $databasestudentfees_expense=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE accountheadgrouptype='$account_type'");    
           while ($fecthfee_payment_expense=mysql_fetch_array($databasestudentfees_expense)) 
                 {
               $accountname_this=$fecthfee_payment_expense['accountheadgroupname'];
               $temp_account_amount=0;
                $temp_account_name="";
             
                $temp_account_amount_temp_expense=0;
               $account_payment_database=  mysql_query("SELECT * FROM financeaccountpayment WHERE accountgroup='$accountname_this' and accounttype='Expense'");
               while ($fetch_payment_details=  mysql_fetch_array($account_payment_database))
               {
                
              
               $fecth_payment_date=$fetch_payment_details['paymentdate'];
               $payment_date_this=strtotime($fecth_payment_date);
               $encryptfetch_paymentdate=ceil($payment_date_this/60/60/24);  
                $fetchaccountname_print=$fetch_payment_details['accountgroup'];
               if($temp_account_name!=$fetchaccountname_print)
               {
               
                   
               
               $account_payment_database_temp=mysql_query("SELECT * FROM financeaccountpayment WHERE accountgroup='$fetchaccountname_print' and accounttype='Expense'");
               while ($fetch_payment_details_temp=mysql_fetch_array($account_payment_database_temp))
               {
                $fetch_temp_payment_date=$fetch_payment_details_temp['paymentdate'];
                $payment_date_this_temp=strtotime($fetch_temp_payment_date);
               $encryptfetch_paymentdate_temp=ceil($payment_date_this_temp/60/60/24);  
              for($strst_firstdate=$encryptfetchstartdate;$strst_firstdate<=$encryptfetchduedate;$strst_firstdate++)
               {
               if($encryptfetch_paymentdate_temp==$strst_firstdate)
               { 
                $fetch_this_expense_payment_amount_temp=$fetch_payment_details_temp['amount'];
                
                $temp_account_amount_temp_expense +=$fetch_this_expense_payment_amount_temp;
               }
               }
               }
                 
                  if($temp_account_amount_temp_expense!=0)
                  {
                       $row++;
                   echo "<tr>
               <td class='top_heading_line_this' style='border-left:1px solid silver;'>$row</td>
               <td class='top_heading_line_this'>$fetchaccountname_print</td>
                      <td class='top_heading_line_this'></td>
               <td class='top_heading_line_this'>$temp_account_amount_temp_expense</td>
               
               </tr>
                   "; 
                  }
               $temp_account_name=$fetchaccountname_print;
               }    
             }
             $finaltotal_amount_expense +=$temp_account_amount_temp_expense;
             $this_amount_converted=  number_format($finaltotal_amount_expense,2);
               }
               
               
               
               
               
               
               //income_expense
            $temp_recieptnumber=0;
            $account_type="income";
             
            $finaltotal_amount_income=0;
           $databasestudentfees_income=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE accountheadgrouptype='$account_type'");    
           while ($fecthfee_payment_income=mysql_fetch_array($databasestudentfees_income)) 
                 {
               $accountname_this=$fecthfee_payment_income['accountheadgroupname'];
               $temp_account_amount=0;
                $temp_account_name_income="";
             
                 $temp_account_amount_temp=0;
               
               $account_payment_database_income=  mysql_query("SELECT * FROM financeaccountpayment WHERE accountgroup='$accountname_this' and accounttype='income'");
               while ($fetch_payment_details_income=  mysql_fetch_array($account_payment_database_income))
               {
                
              
               $fecth_payment_date=$fetch_payment_details_income['paymentdate'];
               $payment_date_this=strtotime($fecth_payment_date);
               $encryptfetch_paymentdate=ceil($payment_date_this/60/60/24);  
                $fetchaccountname_print=$fetch_payment_details_income['accountgroup'];
               if($temp_account_name_income!=$fetchaccountname_print)
               {   
              
               $account_payment_database_temp_income=mysql_query("SELECT * FROM financeaccountpayment WHERE accountgroup='$fetchaccountname_print' and accounttype='income'");
               while ($fetch_payment_details_temp_income=mysql_fetch_array($account_payment_database_temp_income))
               {
                $fetch_temp_payment_date=$fetch_payment_details_temp_income['paymentdate'];
                $payment_date_this_temp=strtotime($fetch_temp_payment_date);
               $encryptfetch_paymentdate_temp=ceil($payment_date_this_temp/60/60/24);  
              for($strst_firstdate=$encryptfetchstartdate;$strst_firstdate<=$encryptfetchduedate;$strst_firstdate++)
               {
               if($encryptfetch_paymentdate_temp==$strst_firstdate)
               { 
                $fetch_this_expense_payment_amount_temp=$fetch_payment_details_temp_income['amount'];
                
                $temp_account_amount_temp +=$fetch_this_expense_payment_amount_temp;
               }
               }
               }
                  
                  if($temp_account_amount_temp!=0)
                  {
                      $row++;
                   echo "<tr>
               <td class='top_heading_line_this' style='border-left:1px solid silver;'>$row</td>
               <td class='top_heading_line_this'>$fetchaccountname_print</td>
                      <td class='top_heading_line_this'>$temp_account_amount_temp</td>
               <td class='top_heading_line_this'></td>
               
               </tr>
                   "; 
                  }  else {
                      $temp_account_amount_temp=0;
                  }
               $temp_account_name_income=$fetchaccountname_print;
               }    
             }
             $finaltotal_amount_income +=$temp_account_amount_temp;
             
               }
       
               
             $finalincome_amount=($finaltotal_amount_income+$finaltotal_amount_student_temp);  
              $converter_income_amount=number_format($finalincome_amount,2);  
               
              
              $profitandloss=($finalincome_amount-$finaltotal_amount_expense);
              $converted_profit_loss=number_format($profitandloss,2);
              
                echo "<tr>
                    <td colspan='2' style='text-align:center; padding-top:5px; padding-bottom:5px; background-color:white;'>
                    <strong> Profit/Loss :  $converted_profit_loss</strong>
                    </td>
             <td style='text-align:center; background-color:white;'> <strong> Income Total :  $converter_income_amount </strong></td>
             <td colspan='1' style='background-color:white; text-align:center; '>
           <strong> Expense Total :  $this_amount_converted </strong>
             </td>   
             </tr></table>";   
              
              }
        
              
              //expense
              
                          
   //expense_feepayment_cashmaster
       if((!empty($_REQUEST['expense_fee_starttime']))&&(!empty($_REQUEST['expense_fee_duetime'])))
       {
        $startfeespayment=$_REQUEST['expense_fee_starttime'];
        $duefeespayment=$_REQUEST['expense_fee_duetime'];
        
        echo "  <table  cellspacing='0' cellpadding='0'  style=' width:100%; '>
             <tr >
        <td colspan='2' height='40px; padding-left:10px;'><strong>Start Date :</strong> $startfeespayment</td>
        <td colspan='' style='text-align:right;'><strong>End Date : </strong>$duefeespayment</td>
        </tr>
                <tr>
                    <td colspan='6' class='top_heading_data'>
                  Expense Payment Summary
                    </td>
                </tr>
      
                
               
               <tr>
               <td class='top_heading_line' STYLE='30PX; border-left:1px solid silver;'>Sl.No</td>
               <td class='top_heading_line'>Account Name</td>
               <td class='top_heading_line'>Amount</td>
               ";
                 $startdatevalue=strtotime($startfeespayment);
                 $encryptfetchstartdate=ceil($startdatevalue/60/60/24);
                 $enddatefrom=strtotime($duefeespayment);
                 $encryptfetchduedate=ceil($enddatefrom/60/60/24);      
                 $totalfinalamountfinallypaid=0;
                  
              
            $temp_recieptnumber=0;
            $account_type="expense";
             $row=0; 
            $finaltotal_amount_expense=0;
           $databasestudentfees_expense=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE accountheadgrouptype='$account_type'");    
           while ($fecthfee_payment_expense=mysql_fetch_array($databasestudentfees_expense)) 
                 {
               $accountname_this=$fecthfee_payment_expense['accountheadgroupname'];
               $temp_account_amount=0;
                $temp_account_name="";
             
                
               $account_payment_database=  mysql_query("SELECT * FROM financeaccountpayment WHERE accountgroup='$accountname_this' and accounttype='Expense'");
               while ($fetch_payment_details=  mysql_fetch_array($account_payment_database))
               {
                
              
               $fecth_payment_date=$fetch_payment_details['paymentdate'];
               $payment_date_this=strtotime($fecth_payment_date);
               $encryptfetch_paymentdate=ceil($payment_date_this/60/60/24);  
                $fetchaccountname_print=$fetch_payment_details['accountgroup'];
               if($temp_account_name!=$fetchaccountname_print)
               {
               
                   
               $temp_account_amount_temp=0;
               
               $account_payment_database_temp=mysql_query("SELECT * FROM financeaccountpayment WHERE accountgroup='$fetchaccountname_print' and accounttype='Expense'");
               while ($fetch_payment_details_temp=mysql_fetch_array($account_payment_database_temp))
               {
                $fetch_temp_payment_date=$fetch_payment_details_temp['paymentdate'];
                $payment_date_this_temp=strtotime($fetch_temp_payment_date);
               $encryptfetch_paymentdate_temp=ceil($payment_date_this_temp/60/60/24);  
              for($strst_firstdate=$encryptfetchstartdate;$strst_firstdate<=$encryptfetchduedate;$strst_firstdate++)
               {
               if($encryptfetch_paymentdate_temp==$strst_firstdate)
               { 
                $fetch_this_expense_payment_amount_temp=$fetch_payment_details_temp['amount'];
                
                $temp_account_amount_temp +=$fetch_this_expense_payment_amount_temp;
               }
               }
               }
                  $row++;
                  if($temp_account_amount_temp!=0)
                  {
                   echo "<tr>
               <td class='top_heading_line_this' style='border-left:1px solid silver;'>$row</td>
               <td class='top_heading_line_this'>$fetchaccountname_print</td>
               <td class='top_heading_line_this'>$temp_account_amount_temp</td>
               
               </tr>
                   "; 
                  }
               $temp_account_name=$fetchaccountname_print; 
               
               
               }
               
               
                
              
               
                 
                 
             }
             $finaltotal_amount_expense +=$temp_account_amount_temp;
             $this_amount_converted=number_format($finaltotal_amount_expense,2);
             
               }
               if($this_amount_converted==0)
               {
                   echo "<tr><td colspan='12' style='width:100%; font-size:15px; text-align:center; font-weight:bold;
                     height:25px; background-color:skyblue;'>No Record Found</td></tr>";
               }
                echo "<tr>
                    <td colspan='2' style='text-align:right; padding-top:5px; padding-bottom:5px; background-color:white;'>
                    <strong> Total Amount :  </strong>
                    </td>
             <td style='text-align:center; background-color:white;'> <strong>  $this_amount_converted </strong></td>
             <td colspan='1' style='background-color:white; text-align:center; '>
           
             </td>   
             </tr></table>";   
       }
        
       
       
        //account_feepayment_cashmaster
       if((!empty($_REQUEST['account_fee_starttime']))&&(!empty($_REQUEST['account_fee_duetime']))&&(!empty($_REQUEST['accounthead']))&&(!empty($_REQUEST['account_type'])))
       {
        $startfeespayment=$_REQUEST['account_fee_starttime'];
        $duefeespayment=$_REQUEST['account_fee_duetime'];
        $account_group_name=$_REQUEST['accounthead'];
        $account_type=$_REQUEST['account_type'];
        $startdatevalue=strtotime($startfeespayment);
                 $encryptfetchstartdate=ceil($startdatevalue/60/60/24);
                 $enddatefrom=strtotime($duefeespayment);
                 $encryptfetchduedate=ceil($enddatefrom/60/60/24);     
        if($account_type=="income")
          {
              $this_value_print="Person Name";
              $this_value_mobileno_print="Mobile No";
          }else
              if($account_type=="expense")
              {
              $this_value_print="Department";
              $this_value_mobileno_print="Issue To";
          }
        
        echo "  <table  cellspacing='0' cellpadding='0'  style=' width:100%; '>
              <tr >
        <td colspan='7' height='40px; padding-left:10px;'><strong>Start Date :</strong> $startfeespayment</td>
        <td colspan='colspan='3' style='text-align:right;'><strong>End Date : </strong>$duefeespayment</td>
        </tr>
                <tr>
                    <td colspan='13' class='top_heading_data'>
                   $account_type , Account Group Name : $account_group_name
                    </td>
                </tr>
                
                <tr>
                    <td colspan='12' style='width:100%;'>
                       
                    </td>
                </tr>
              
               <tr>
               <td class='top_heading_line' STYLE='30PX;'>Sl.No</td>
               <td class='top_heading_line'>Receipt No</td>
               <td class='top_heading_line'>Payment Date</td>
               <td class='top_heading_line'>Account Group</td>
               <td class='top_heading_line'> Account Name</td>
               <td class='top_heading_line'>$this_value_print</td>
               <td class='top_heading_line'>$this_value_mobileno_print</td>
               <td class='top_heading_line'>Amount Paid</td>
               <td class='top_heading_line'>Status</td>
 
               
         
              ";
        $final_total_amount=0;
         for($strst_firstdate=$encryptfetchstartdate;$strst_firstdate<=$encryptfetchduedate;$strst_firstdate++)
               {
               
            $row=0;   
            $temp_recieptnumber=0;
           
          $paymentgroupnamedb=mysql_query("SELECT * FROM financeaccountpayment WHERE accountgroup='$account_group_name'"); 
          while($fecthaccountname=mysql_fetch_array($paymentgroupnamedb))
          {
           $row++;
          $fetch_account_group_name=$fecthaccountname['accountgroup'];  
          $fetch_account_receipt_number=$fecthaccountname['receiptno'];
          $fetch_account_payment_date=$fecthaccountname['paymentdate'];
          $fetch_account_name=$fecthaccountname['accountname'];
          $fetch_group_type=$fecthaccountname['accounttype'];
          $account_satats=$fecthaccountname['status'];
          if($fetch_group_type=="income")
              
          {
              $this_value_print_temp=$fecthaccountname['personname'];
              $this_value_mobileno_print_temp=$fecthaccountname['mobileno'];
          }else
              if($account_type=="expense")
              {
             $this_value_print_temp=$fecthaccountname['department'];
              $this_value_mobileno_print_temp=$fecthaccountname['issueto'];
          }
         
             $payment_date_encrupt=strtotime($fetch_account_payment_date);
                 $encryptfetch_payment_date=ceil($payment_date_encrupt/60/60/24);     
             if($temp_recieptnumber!=$fetch_account_receipt_number)
              {
                 if($encryptfetch_payment_date==$strst_firstdate)
             {
                 
              $fetch_amount_pay=$fecthaccountname['amount'];
          
                   
               echo "<tr>
               <td class='top_heading_line_this'>$row</td>
               <td class='top_heading_line_this'>$fetch_account_receipt_number</td>
               <td class='top_heading_line_this'>$fetch_account_payment_date</td>
               <td class='top_heading_line_this'>$fetch_account_group_name</td>
               <td class='top_heading_line_this'>$fetch_account_name</td>
                <td class='top_heading_line_this'>$this_value_print_temp</td>
                <td class='top_heading_line_this'>$this_value_mobileno_print_temp</td>
               <td class='top_heading_line_this'>$fetch_amount_pay</td>
               <td class='top_heading_line_this'>$account_satats</td>
                </tr>
                   ";
               
              $final_total_amount +=$fetch_amount_pay;  
              }
              
             }
            
             $temp_recieptnumber=$fetch_account_receipt_number;
             
               }
               
               
               $converted_total_amount=  number_format($final_total_amount,2);
               
              
             
               
           
         
           } 
           if($converted_total_amount==0)
               {
                   echo "<tr><td colspan='12' style='width:100%; font-size:15px; text-align:center; font-weight:bold;
                     height:25px; background-color:skyblue;'>No Record Found</td></tr>";
               }
           echo "<tr>
                    <td colspan='7' style='text-align:right; padding-top:5px; padding-bottom:5px; background-color:white;'>
                    <strong> Total Amount Paid :  </strong>
                    </td>
             <td style='text-align:center; background-color:white;'> <strong>  $converted_total_amount </strong></td>
             <td colspan='4' style='background-color:white; text-align:center; '>
           
             </td>   
             </tr></table>";   
           
         
         
           
               }
           
          
          
       
         
       //feepayment_summary_report_cashmaster
       if((!empty($_REQUEST['feepayment_fee_starttime']))&&(!empty($_REQUEST['feepayment_fee_duetime'])))
       {
        $startfeespayment=$_REQUEST['feepayment_fee_starttime'];
        $duefeespayment=$_REQUEST['feepayment_fee_duetime'];
         
        echo "  <table  cellspacing='0' cellpadding='0'  style=' width:100%; '>
             <tr >
        <td colspan='2' height='40px; padding-left:10px;'><strong>Start Date :</strong> $startfeespayment</td>
        <td colspan='' style='text-align:right;'><strong>End Date : </strong>$duefeespayment</td>
        </tr>
                <tr>
                    <td colspan='3' class='top_heading_data'>
                   Fee Payment Summary
                    </td>
                </tr>
                
               
               <tr>
               <td class='top_heading_line' STYLE='30PX; border-left:1px solid silver;'>Sl.No</td>
               <td class='top_heading_line'>Fee Name</td>
               <td class='top_heading_line'>Income Amount</td>
               ";
                 $startdatevalue=strtotime($startfeespayment);
                 $encryptfetchstartdate=ceil($startdatevalue/60/60/24);
                 $enddatefrom=strtotime($duefeespayment);
                 $encryptfetchduedate=ceil($enddatefrom/60/60/24);      
                 $totalfinalamountfinallypaid=0;
                  
              
          $temp_recieptnumber=0;
          $row=0; 
          $finaltotal_amount_expense_temp =0;
          $checkfeesequal="";
          $feegroupnamedb=mysql_query("SELECT * FROM financefeeamount WHERE id order by addfeesname ASC"); 
          while($fecthfeename=mysql_fetch_array($feegroupnamedb))
          {
           $fetch_feesname=$fecthfeename['addfeesname'];  
           
           if($fetch_feesname!=$checkfeesequal)
           {
           $fecthfees_type=$fecthfeename['feegrouptype'];
           $fetchfees_groupname=$fecthfeename['feesgroupname'];
               
               $temp_account_amount=0;
               $temp_account_name="";
             
               $temp_receipt_number='';
              $finaltotal_amount_expense=0;
               $account_payment_database=mysql_query("SELECT * FROM finanacepaystudentfees WHERE feesgroup='$fetchfees_groupname'");
               while($fetch_payment_details=mysql_fetch_array($account_payment_database))
               {
                   
               $fetch_recipt_number=$fetch_payment_details['trnumber'];
               if($fetch_recipt_number!=$temp_receipt_number)
               {
                 
               $fecth_payment_date=$fetch_payment_details['paymentdate'];
               $payment_date_this=strtotime($fecth_payment_date);
               $encryptfetch_paymentdate=ceil($payment_date_this/60/60/24);  
               $fetchaccountname_print=$fetch_payment_details['feesgroup'];
               if($temp_account_name!=$fetchaccountname_print)
               {
               
                   
               $temp_account_amount_temp=0;
               $temp_reciept_number_is="";
               $account_payment_database_temp=mysql_query("SELECT * FROM finanacepaystudentfees WHERE feesgroup='$fetchaccountname_print'");
               while ($fetch_payment_details_temp=mysql_fetch_array($account_payment_database_temp))
               {
                $fetch_temp_payment_date=$fetch_payment_details_temp['paymentdate'];
                $fecth_receipt_number=$fetch_payment_details_temp['trnumber'];
                if($temp_reciept_number_is!=$fecth_receipt_number)
                {
                  $feepayment_check= $fetch_payment_details_temp['feepaymonth']; 
                $databasestudentfees_row=mysql_query("SELECT * FROM finanacepaystudentfees WHERE trnumber='$fecth_receipt_number'");    
                $fecthfee_payment_row=mysql_num_rows($databasestudentfees_row);    
                
                $payment_date_this_temp=strtotime($fetch_temp_payment_date);
               $encryptfetch_paymentdate_temp=ceil($payment_date_this_temp/60/60/24);  
              for($strst_firstdate=$encryptfetchstartdate;$strst_firstdate<=$encryptfetchduedate;$strst_firstdate++)
               {
               if($encryptfetch_paymentdate_temp==$strst_firstdate)
               { 
               
                 if(($fecthfee_payment_row>1)&&($feepayment_check=="autopayment"))
                  {
                   $fetch_feesgroup_name_TEMP="/O.T.P"; 
                   $fecth_particular_feee_amount=$fetch_payment_details_temp['perticularfees'];
                   $fecth_particular_fine=$fetch_payment_details_temp['particularfine'];
                   $fecth_particular_discount=$fetch_payment_details_temp['particulardiscount'];
                   $fetch_this_descount_fine=$fetch_payment_details_temp['discountfine'];
                   $divided_fine=$fetch_this_descount_fine/$fecthfee_payment_row;
                   $both_added_this=round($divided_fine+$fecth_particular_discount);
                   $fetch_this_expense_payment_amount_temp=(($fecth_particular_feee_amount+$fecth_particular_fine)-$both_added_this);
                  }else {
                  $fetch_this_expense_payment_amount_temp=$fetch_payment_details_temp['amountpaid'];
                  }
                $temp_account_amount_temp +=$fetch_this_expense_payment_amount_temp;
               }
               }
               
                }
                $temp_reciept_number_is=$fecth_receipt_number;
               }
                  $row++;
                  if($temp_account_amount_temp!=0)
                  {
                   echo "<tr>
               <td class='top_heading_line_this' style='border-left:1px solid silver;'>$row</td>
               <td class='top_heading_line_this'>$fetchaccountname_print</td>
               <td class='top_heading_line_this'>$temp_account_amount_temp</td>
               
               </tr>
                   "; 
                  
                  }
                  $temp_account_name=$fetchaccountname_print; 
               
                $finaltotal_amount_expense +=$temp_account_amount_temp;
               }
               }
              $temp_receipt_number=$fetch_recipt_number;   
              
             }
              $checkfeesequal=$fetch_feesname;
            $finaltotal_amount_expense_temp +=$finaltotal_amount_expense;
             $this_amount_converted=number_format($finaltotal_amount_expense_temp,2);
               }
               
                }
        
       if($this_amount_converted==0)
               {
                   echo "<tr><td colspan='12' style='width:100%; font-size:15px; text-align:center; font-weight:bold;
                     height:25px; background-color:skyblue;'>No Record Found</td></tr>";
               }
       
                echo "<tr>
                    <td colspan='2' style='text-align:right; padding-top:5px; padding-bottom:5px; background-color:white;'>
                    <strong> Total Amount :  </strong>
                    </td>
             <td style='text-align:center; background-color:white;'> <strong>  $this_amount_converted </strong></td>
             <td colspan='1' style='background-color:white; text-align:center; '>
           
             </td>   
             </tr></table>";   
      
       }
       
          //balancesheet_summary_report_cashmaster
       if((!empty($_REQUEST['balancesheet_fee_starttime']))&&(!empty($_REQUEST['balancesheet_fee_duetime'])))
       {
        $startfeespayment=$_REQUEST['balancesheet_fee_starttime'];
        $duefeespayment=$_REQUEST['balancesheet_fee_duetime'];
        
        echo "  <table  cellspacing='0' cellpadding='0'  style=' width:100%; '>
            <tr >
        <td colspan='2' height='40px; padding-left:10px;'><strong>Start Date :</strong> $startfeespayment</td><td></td>
        <td colspan='' style='text-align:right;'><strong>End Date : </strong>$duefeespayment</td>
        </tr>
                <tr>
                    <td colspan='4' class='top_heading_data'>
                   Balance Sheet
                    </td>
                </tr>
                
               
               <tr>
               <td class='top_heading_line' STYLE='30PX; border-left:1px solid silver;'>Sl.No</td>
               <td class='top_heading_line'>Fee Name</td>
               <td class='top_heading_line'>Income Amount</td>
                <td class='top_heading_line'>Expense Amount</td>
               ";
                 $startdatevalue=strtotime($startfeespayment);
                 $encryptfetchstartdate=ceil($startdatevalue/60/60/24);
                 $enddatefrom=strtotime($duefeespayment);
                 $encryptfetchduedate=ceil($enddatefrom/60/60/24);      
          
          $totalfinalamountfinallypaid=0;  
          $temp_recieptnumber=0;
          $row=0; 
          $finaltotal_amount_student_temp =0;
          $checkfeesequal="";
          $feegroupnamedb=mysql_query("SELECT * FROM financefeeamount WHERE id order by addfeesname ASC"); 
          while($fecthfeename=mysql_fetch_array($feegroupnamedb))
          {
           $fetch_feesname=$fecthfeename['addfeesname'];  
           
           if($fetch_feesname!=$checkfeesequal)
           {
           $fecthfees_type=$fecthfeename['feegrouptype'];
           $fetchfees_groupname=$fecthfeename['feesgroupname'];
               
               $temp_account_amount=0;
               $temp_account_name="";
             
               $temp_receipt_number='';
              $finaltotal_amount_student=0;
                $temp_account_amount_temp_student=0;
               $account_payment_database=mysql_query("SELECT * FROM finanacepaystudentfees WHERE feesgroup='$fetchfees_groupname'");
               while($fetch_payment_details=mysql_fetch_array($account_payment_database))
               {
                   
               $fetch_recipt_number=$fetch_payment_details['trnumber'];
               if($fetch_recipt_number!=$temp_receipt_number)
               {
                 
               $fecth_payment_date=$fetch_payment_details['paymentdate'];
               $payment_date_this=strtotime($fecth_payment_date);
               $encryptfetch_paymentdate=ceil($payment_date_this/60/60/24);  
               $fetchaccountname_print=$fetch_payment_details['feesgroup'];
               if($temp_account_name!=$fetchaccountname_print)
               {
               
                   
             
               $temp_reciept_number_is="";
               $account_payment_database_temp=mysql_query("SELECT * FROM finanacepaystudentfees WHERE feesgroup='$fetchaccountname_print'");
               while ($fetch_payment_details_temp=mysql_fetch_array($account_payment_database_temp))
               {
                $fetch_temp_payment_date=$fetch_payment_details_temp['paymentdate'];
                $fecth_receipt_number=$fetch_payment_details_temp['trnumber'];
                if($temp_reciept_number_is!=$fecth_receipt_number)
                {
                  $feepayment_check= $fetch_payment_details_temp['feepaymonth']; 
                $databasestudentfees_row=mysql_query("SELECT * FROM finanacepaystudentfees WHERE trnumber='$fecth_receipt_number'");    
                $fecthfee_payment_row=mysql_num_rows($databasestudentfees_row);    
                
                $payment_date_this_temp=strtotime($fetch_temp_payment_date);
               $encryptfetch_paymentdate_temp=ceil($payment_date_this_temp/60/60/24);  
              for($strst_firstdate=$encryptfetchstartdate;$strst_firstdate<=$encryptfetchduedate;$strst_firstdate++)
               {
               if($encryptfetch_paymentdate_temp==$strst_firstdate)
               { 
               
                 if(($fecthfee_payment_row>1)&&($feepayment_check=="autopayment"))
                  {
                   $fetch_feesgroup_name_TEMP="/O.T.P"; 
                   $fecth_particular_feee_amount=$fetch_payment_details_temp['perticularfees'];
                   $fecth_particular_fine=$fetch_payment_details_temp['particularfine'];
                   $fecth_particular_discount=$fetch_payment_details_temp['particulardiscount'];
                   $fetch_this_descount_fine=$fetch_payment_details_temp['discountfine'];
                   $divided_fine=$fetch_this_descount_fine/$fecthfee_payment_row;
                   $both_added_this=round($divided_fine+$fecth_particular_discount);
                   $fetch_this_expense_payment_amount_temp=(($fecth_particular_feee_amount+$fecth_particular_fine)-$both_added_this);
                  }else {
                  $fetch_this_expense_payment_amount_temp=$fetch_payment_details_temp['amountpaid'];
                  }
                $temp_account_amount_temp_student +=$fetch_this_expense_payment_amount_temp;
               }
               }
               
                }
                $temp_reciept_number_is=$fecth_receipt_number;
               }
                  $row++;
                  if($temp_account_amount_temp_student!=0)
                  {
                   echo "<tr>
               <td class='top_heading_line_this' style='border-left:1px solid silver;'>$row</td>
               <td class='top_heading_line_this'>$fetchaccountname_print</td>
               <td class='top_heading_line_this'>$temp_account_amount_temp_student</td>
               <td class='top_heading_line_this'></td>
               </tr>
                   "; 
                  
                  }
                  $temp_account_name=$fetchaccountname_print; 
               
                $finaltotal_amount_student +=$temp_account_amount_temp_student;
               }
               }
              $temp_receipt_number=$fetch_recipt_number;   
              
             }
              $checkfeesequal=$fetch_feesname;
            $finaltotal_amount_student_temp +=$finaltotal_amount_student;
             
               } 
               
              
               }
              
               
               
               //expense_balance_sheet
                $startdatevalue=strtotime($startfeespayment);
                 $encryptfetchstartdate=ceil($startdatevalue/60/60/24);
                 $enddatefrom=strtotime($duefeespayment);
                 $encryptfetchduedate=ceil($enddatefrom/60/60/24);      
                 $totalfinalamountfinallypaid=0;
                  
              
            $temp_recieptnumber=0;
            $account_type="expense";
              
            $finaltotal_amount_expense=0;
           $databasestudentfees_expense=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE accountheadgrouptype='$account_type'");    
           while ($fecthfee_payment_expense=mysql_fetch_array($databasestudentfees_expense)) 
                 {
               $accountname_this=$fecthfee_payment_expense['accountheadgroupname'];
               $temp_account_amount=0;
                $temp_account_name="";
             
                $temp_account_amount_temp_expense=0;
               $account_payment_database=  mysql_query("SELECT * FROM financeaccountpayment WHERE accountgroup='$accountname_this' and accounttype='Expense'");
               while ($fetch_payment_details=  mysql_fetch_array($account_payment_database))
               {
                
              
               $fecth_payment_date=$fetch_payment_details['paymentdate'];
               $payment_date_this=strtotime($fecth_payment_date);
               $encryptfetch_paymentdate=ceil($payment_date_this/60/60/24);  
                $fetchaccountname_print=$fetch_payment_details['accountgroup'];
               if($temp_account_name!=$fetchaccountname_print)
               {
               
                   
               
               $account_payment_database_temp=mysql_query("SELECT * FROM financeaccountpayment WHERE accountgroup='$fetchaccountname_print' and accounttype='Expense'");
               while ($fetch_payment_details_temp=mysql_fetch_array($account_payment_database_temp))
               {
                $fetch_temp_payment_date=$fetch_payment_details_temp['paymentdate'];
                $payment_date_this_temp=strtotime($fetch_temp_payment_date);
               $encryptfetch_paymentdate_temp=ceil($payment_date_this_temp/60/60/24);  
              for($strst_firstdate=$encryptfetchstartdate;$strst_firstdate<=$encryptfetchduedate;$strst_firstdate++)
               {
               if($encryptfetch_paymentdate_temp==$strst_firstdate)
               { 
                $fetch_this_expense_payment_amount_temp=$fetch_payment_details_temp['amount'];
                
                $temp_account_amount_temp_expense +=$fetch_this_expense_payment_amount_temp;
               }
               }
               }
                 
                  if($temp_account_amount_temp_expense!=0)
                  {
                      $row++;
                   echo "<tr>
               <td class='top_heading_line_this'  style='border-left:1px solid silver;'>$row</td>
               <td class='top_heading_line_this'>$fetchaccountname_print</td>
                      <td class='top_heading_line_this'></td>
               <td class='top_heading_line_this'>$temp_account_amount_temp_expense</td>
               
               </tr>
                   "; 
                  }
               $temp_account_name=$fetchaccountname_print;
               }    
             }
             $finaltotal_amount_expense +=$temp_account_amount_temp_expense;
             $this_amount_converted=  number_format($finaltotal_amount_expense,2);
               }
               
               
               
               
               
               
               //income_expense
            $temp_recieptnumber=0;
            $account_type="income";
           
            $finaltotal_amount_income=0;
           $databasestudentfees_income=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE accountheadgrouptype='$account_type'");    
           while ($fecthfee_payment_income=mysql_fetch_array($databasestudentfees_income)) 
                 {
               $accountname_this=$fecthfee_payment_income['accountheadgroupname'];
               $temp_account_amount=0;
                $temp_account_name_income="";
             
                 $temp_account_amount_temp=0;
               
               $account_payment_database_income=  mysql_query("SELECT * FROM financeaccountpayment WHERE accountgroup='$accountname_this' and accounttype='income'");
               while ($fetch_payment_details_income=  mysql_fetch_array($account_payment_database_income))
               {
                
              
               $fecth_payment_date=$fetch_payment_details_income['paymentdate'];
               $payment_date_this=strtotime($fecth_payment_date);
               $encryptfetch_paymentdate=ceil($payment_date_this/60/60/24);  
                $fetchaccountname_print=$fetch_payment_details_income['accountgroup'];
               if($temp_account_name_income!=$fetchaccountname_print)
               {   
              
               $account_payment_database_temp_income=mysql_query("SELECT * FROM financeaccountpayment WHERE accountgroup='$fetchaccountname_print' and accounttype='income'");
               while ($fetch_payment_details_temp_income=mysql_fetch_array($account_payment_database_temp_income))
               {
                $fetch_temp_payment_date=$fetch_payment_details_temp_income['paymentdate'];
                $payment_date_this_temp=strtotime($fetch_temp_payment_date);
               $encryptfetch_paymentdate_temp=ceil($payment_date_this_temp/60/60/24);  
              for($strst_firstdate=$encryptfetchstartdate;$strst_firstdate<=$encryptfetchduedate;$strst_firstdate++)
               {
               if($encryptfetch_paymentdate_temp==$strst_firstdate)
               { 
                $fetch_this_expense_payment_amount_temp=$fetch_payment_details_temp_income['amount'];
                
                $temp_account_amount_temp +=$fetch_this_expense_payment_amount_temp;
               }
               }
               }
                 
                  if($temp_account_amount_temp!=0)
                  {
                       $row++;
                   echo "<tr>
               <td class='top_heading_line_this'  style='border-left:1px solid silver;'>$row</td>
               <td class='top_heading_line_this'>$fetchaccountname_print</td>
                      <td class='top_heading_line_this'>$temp_account_amount_temp</td>
               <td class='top_heading_line_this'></td>
               
               </tr>
                   "; 
                  }  else {
                      $temp_account_amount_temp=0;
                  }
               $temp_account_name_income=$fetchaccountname_print;
               }    
             }
             $finaltotal_amount_income +=$temp_account_amount_temp;
             
               }
       
               
             $finalincome_amount=($finaltotal_amount_income+$finaltotal_amount_student_temp);  
              $converter_income_amount=number_format($finalincome_amount,2);  
               
              
              $profitandloss=($finalincome_amount-$finaltotal_amount_expense);
              $converted_profit_loss=number_format($profitandloss,2);
              
                echo "<tr>
                    <td colspan='2' style='text-align:center; padding-top:5px; padding-bottom:5px; background-color:white;'>
                    <strong> Profit/Loss :  $converted_profit_loss</strong>
                    </td>
             <td style='text-align:center; background-color:white;'> <strong> Income Total :  $converter_income_amount </strong></td>
             <td colspan='1' style='background-color:white; text-align:center; '>
           <strong> Expense Total :  $this_amount_converted </strong>
             </td>   
             </tr></table>";   
      
       }
       
       
    
       
              
              
              
              
              
              
              
                        
                        
                            ?>
                    </td>
                </tr>
                
                <tr>
                    
                    <td class='top_td_receipt_middle_company_name' colspan='4'>Powered By : Pixabyte</td>
                     
                </tr>
                
            </table>
        </div>
    </body>
</html>
<?php 
  }
  }else
  {
   header("Location:../404_error.php");   
  }
 }else
 {
 header("Location:../loginPage.php");   
 }
  
  
 }else
 {
 header("Location:../loginPage.php");   
 }
 
 
 }else
{
     header("Location:../loginPage.php");
}


}else
{
    header("Location:../loginPage.php");
}

}else
{
     header("Location:../loginPage.php");
}
?>