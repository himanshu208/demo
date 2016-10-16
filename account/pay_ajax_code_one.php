<?php 
require_once '../connection.php';
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['account_type'])))
{
  
 $organization_id=$_REQUEST['org_id'];
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $account_type=$_REQUEST['account_type'];
    
 $select_account_head_db=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE organization_id='$organization_id'
     and branch_id='$branch_id' and session_id='$session_id' and accountheadgrouptype='$account_type' and action='active'");
 echo "<option value='0'>---Select---</option>";
 while ($fetch_account_head_data=mysql_fetch_array($select_account_head_db))
{
  
   $account_head_id=$fetch_account_head_data['account_head_id'];
  $account_head_name=$fetch_account_head_data['accountheadgroupname'];
  
  echo "<option value='$account_head_id'>$account_head_name</option>";
   
 }
 $count_account_head=  mysql_num_rows($select_account_head_db);
 if(empty($account_head_id)&&(empty($count_account_head)))
 {
     echo "<option value='0'>Record no found !!</option>";   
 }
}



//get account name
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['account_group_id'])))
{
     $organization_id=$_REQUEST['org_id'];
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $account_group_id=$_REQUEST['account_group_id'];
 
 $select_account_db=mysql_query("SELECT * FROM financeaccountdetail WHERE organization_id='$organization_id' and branch_id='$branch_id'
        and session_id='$session_id' and account_group_id='$account_group_id' and action='active'");
 echo "<option value='0'>---Select---</option>";
 while ($account_name_data=mysql_fetch_array($select_account_db))
 {
     $fetch_account_name_id=$account_name_data['account_id'];
     $fetch_account_name=$account_name_data['accountname'];
     
     echo "<option value='$fetch_account_name_id'>$fetch_account_name</option>"; 
     
     
 }
 $account_name_num_rows=mysql_num_rows($select_account_db);
 if((empty($fetch_account_name_id))&&(empty($account_name_num_rows)))
 {
     echo "<option value='0'>Record no found !!</option>"; 
 }
 
 
 
}


//search account details

if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['currency']))&&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['account_type_details'])))
{
$organization_id=$_REQUEST['org_id'];
$branch_id=$_REQUEST['branch_id'];
$session_id=$_REQUEST['session_id'];
$account_type=$_REQUEST['account_type_details'];
$fetch_currency=$_REQUEST['currency'];
echo "<div id='account_group_data'>";
    $select_account_head_db=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE organization_id='$organization_id'
     and branch_id='$branch_id' and session_id='$session_id' and accountheadgrouptype='$account_type' and action='active'");
 echo "<option value='0'>---Select---</option>";
 while ($fetch_account_head_data=mysql_fetch_array($select_account_head_db))
{
  
   $account_head_id=$fetch_account_head_data['account_head_id'];
  $account_head_name=$fetch_account_head_data['accountheadgroupname'];
  
  echo "<option value='$account_head_id'>$account_head_name</option>";
   
 }
 $count_account_head=  mysql_num_rows($select_account_head_db);
 if(empty($account_head_id)&&(empty($count_account_head)))
 {
     echo "<option value='0'>Record no found !!</option>";   
 }
 
      echo"</div>";
      
   echo "<div id='account_payment_details_data'>";   
   echo '                                            <div class="all_div_tag">
                                            <div class="top_menu_button" id="excel_button">Excel</div>  
                                            <div class="top_menu_button" id="pdf_button">Pdf</div>  
                                            <div class="top_menu_button" id="print_button">Print (0,50)</div>  
                                            <div class="top_menu_button" id="print_button">Print (All)</div>  
                                            </div>               
                                            
                                            
               <table cellspacing="0" cellpadding="0" class="details_table">
               <tr>
               <td class="top_heading_line">Sl No.</td>
               <td class="top_heading_line">Receipt No.</td>
               <td class="top_heading_line">Payment Date</td>
               <td class="top_heading_line">Account Group</td>
               <td class="top_heading_line">Account Name</td>
               <td class="top_heading_line">Depositor Name</td>
               <td class="top_heading_line">Mobile Number</td>
               <td class="top_heading_line">Payment Mode</td>
               <td class="top_heading_line">Amount</td>
               <td class="top_heading_line">Status</td>
              <td class="top_heading_line" style="width:35px;">Print</td>
              <td class="top_heading_line" style=" border-right:1px solid black; ">Action</td>
               </tr>
';
                $row=0;
               $payment_db=mysql_query("SELECT * FROM finance_account_payment WHERE organization_id='$organization_id' and branch_id='$branch_id' and session_id='$session_id' and account_type='$account_type' and is_delete='none'");
               while ($fetch_payment_data=mysql_fetch_array($payment_db))
               {
                $row++;
                $recipt_id=$fetch_payment_data['id'];
                $encrypt_id=$fetch_payment_data['encrypt_id'];
                $payment_date=$fetch_payment_data['payment_date'];  
                $account_group_id=$fetch_payment_data['account_group_id'];  
                $account_name_id=$fetch_payment_data['account_name_id'];  
                
                $account_group_db=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE organization_id='$organization_id' and
                branch_id='$branch_id' and session_id='$session_id' and account_head_id='$account_group_id'");
                $fetch_account_group_data=mysql_fetch_array($account_group_db);
                $fetch_account_group_num_rows=mysql_num_rows($account_group_db);
                if((!empty($fetch_account_group_data))&&($fetch_account_group_data!=null)&&($fetch_account_group_num_rows!=0))
                {
                    $account_group_name=ucfirst($fetch_account_group_data['accountheadgroupname']);
                }else
                {
                 $account_group_name="Record missing";   
                }
                
                $account_name_db=  mysql_query("SELECT * FROM financeaccountdetail WHERE organization_id='$organization_id' and
                branch_id='$branch_id' and session_id='$session_id' and account_id='$account_name_id'");
                $fetch_account_name_data=  mysql_fetch_array($account_name_db);
                $fetch_account_name_num_rows=mysql_num_rows($account_name_db);
                if((!empty($fetch_account_name_data))&&($fetch_account_name_data!=null)&&($fetch_account_name_num_rows!=0))
                {
                $account_name=$fetch_account_name_data['accountname'];   
                }else
                {
                 $account_name="Record missing";      
                }
                
                if($account_type=="income")
                {
                $depositor_name=$fetch_payment_data['depositor_name']; 
                $depositor_mobile_no=$fetch_payment_data['mobile_no']; 
                }  else
                    if($account_type=="expense")
                {
                 $depositor_name=$fetch_payment_data['receiver_name']; 
                $depositor_mobile_no=$fetch_payment_data['receiver_mobile_no'];    
                }
                 
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
                        . "<td class='td_heading_data' style='color:blue;'>";
                {
                ?>
               <a style="color:blue;" href="#" onclick="window.open('fee_account_receipt.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=530,width=900,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  

                   <div class='print_button'>Print</div></a>
                        
              <?php 
                } echo "</td><td class='td_heading_data' style=' width:117px;border-right:1px solid black;'>";
                        {
                         ?>   
                        
                         <a style="color:blue;" href="#" onclick="window.open('account_view_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=530,width=900,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
                        <div class='view_button'>View</div></a>
                       <?php 
                    if($payment_ststuss=="CANCEL")
                    {
                    }else {
                    {
                    ?>   
               <div onclick="account_payment_cancel('<?php  echo $recipt_id;?>')" id="cancel_button_hide_<?php  echo $recipt_id;?>" class='cancel_button'>Cancel</div>
                      <?php 
                    }
                    }
                      ?>    
                   <?php 
                        }  
                     echo" </td>"
                        . "</tr>";   
               }
               $fetch_payment_num_rows=mysql_num_rows($payment_db);
               if((empty($recipt_id))&&(empty($fetch_payment_num_rows)))
               {
                   echo ' <tr>
                   <td colspan="12" class="alert_notification">Record no found !!</td>
               </tr>';  
               }
   echo "</div>";
      
    }

    
    
    
    
//submit button search data
    
 if((!empty($_REQUEST['temp_org_id']))&&(!empty($_REQUEST['account_type']))&&(!empty($_REQUEST['temp_branch_id']))&&(!empty($_REQUEST['temp_session_id']))||(!empty($_REQUEST['unique_account_group_id']))
         ||(!empty($_REQUEST['unique_account_nameid']))||(!empty($_REQUEST['date_from']))&&(!empty($_REQUEST['date_to']))&&(!empty($_REQUEST['currency']))) 
 {
          $organization_id=$_REQUEST['temp_org_id'];
          $branch_id=$_REQUEST['temp_branch_id'];
         $session_id=$_REQUEST['temp_session_id'];
         $account_group_id=$_REQUEST['unique_account_group_id'];
        $account_name_id=$_REQUEST['unique_account_nameid'];
         $date_from=$_REQUEST['date_from'];
         $date_to=$_REQUEST['date_to'];
         $fetch_currency=$_REQUEST['currency'];
         $account_type=$_REQUEST['account_type'];
         $search_by=$_REQUEST['search_by'];
         $search_input=$_REQUEST['search_input'];
         
         
         
         echo '<div class="all_div_tag">
                                            <div class="top_menu_button" id="excel_button">Excel</div>  
                                            <div class="top_menu_button" id="pdf_button">Pdf</div>  
                                            <div class="top_menu_button" id="print_button">Print (0,50)</div>  
                                            <div class="top_menu_button" id="print_button">Print (All)</div>  
                                            </div>               
                                            
                                            
               <table cellspacing="0" cellpadding="0" class="details_table">
               <tr>
               <td class="top_heading_line">Sl No.</td>
               <td class="top_heading_line">Receipt No.</td>
               <td class="top_heading_line">Payment Date</td>
               <td class="top_heading_line">Account Group</td>
               <td class="top_heading_line">Account Name</td>
               <td class="top_heading_line">Depositor Name</td>
               <td class="top_heading_line">Mobile Number</td>
               <td class="top_heading_line">Payment Mode</td>
               <td class="top_heading_line">Amount</td>
               <td class="top_heading_line">Status</td>
              <td class="top_heading_line" style="width:35px;">Print</td>
              <td class="top_heading_line" style=" border-right:1px solid black; ">Action</td>
               </tr>';
         
         if(!empty($account_group_id))
         {
          $search_account_type="and account_group_id='$account_group_id'";   
         }else
         {
          $search_account_type="";   
         }
         
         if(!empty($account_name_id))
         {
           $search_account_name_id="and account_name_id='$account_name_id'";  
         }else
         {
           $search_account_name_id="";  
         }
         
         if((!empty($date_from))&&(!empty($date_to)))
         {
             $search_by_data="and payment_date BETWEEN '$date_from' AND '$date_to'";
         }  else {
            $search_by_data=""; 
         }
         
         
         if((!empty($search_by))&&(!empty($search_input)))
         {
          $other_search="and $search_by LIKE '%$search_input%'";   
         }  else {
             $other_search="";
         }
         
         
                
                $row=0;
               $payment_db=mysql_query("SELECT * FROM finance_account_payment WHERE organization_id='$organization_id' and branch_id='$branch_id' and session_id='$session_id' $search_by_data and account_type='$account_type' $search_account_type $search_account_name_id $other_search and is_delete='none'");
               while ($fetch_payment_data=mysql_fetch_array($payment_db))
               {
                $row++;
                $recipt_id=$fetch_payment_data['id'];
                $encrypt_id=$fetch_payment_data['encrypt_id'];
                $payment_date=$fetch_payment_data['payment_date'];  
                $account_group_id=$fetch_payment_data['account_group_id'];  
                $account_name_id=$fetch_payment_data['account_name_id'];  
                
                $account_group_db=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE organization_id='$organization_id' and
                branch_id='$branch_id' and session_id='$session_id' and account_head_id='$account_group_id'");
                $fetch_account_group_data=mysql_fetch_array($account_group_db);
                $fetch_account_group_num_rows=mysql_num_rows($account_group_db);
                if((!empty($fetch_account_group_data))&&($fetch_account_group_data!=null)&&($fetch_account_group_num_rows!=0))
                {
                    $account_group_name=ucfirst($fetch_account_group_data['accountheadgroupname']);
                }else
                {
                 $account_group_name="Record missing";   
                }
                
                $account_name_db=  mysql_query("SELECT * FROM financeaccountdetail WHERE organization_id='$organization_id' and
                branch_id='$branch_id' and session_id='$session_id' and account_id='$account_name_id'");
                $fetch_account_name_data=  mysql_fetch_array($account_name_db);
                $fetch_account_name_num_rows=mysql_num_rows($account_name_db);
                if((!empty($fetch_account_name_data))&&($fetch_account_name_data!=null)&&($fetch_account_name_num_rows!=0))
                {
                $account_name=$fetch_account_name_data['accountname'];   
                }else
                {
                 $account_name="Record missing";      
                }
                
                if($account_type=="income")
                {
                $depositor_name=$fetch_payment_data['depositor_name']; 
                $depositor_mobile_no=$fetch_payment_data['mobile_no']; 
                }  else
                    if($account_type=="expense")
                {
                 $depositor_name=$fetch_payment_data['receiver_name']; 
                $depositor_mobile_no=$fetch_payment_data['receiver_mobile_no'];    
                }
                 
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
                        . "<td class='td_heading_data' style='color:blue;'>";
                {
                ?>
               <a style="color:blue;" href="#" onclick="window.open('fee_account_receipt.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=530,width=900,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  

                   <div class='print_button'>Print</div></a>
                        
              <?php 
                } echo "</td><td class='td_heading_data' style=' width:117px;border-right:1px solid black;'>";
                        {
                         ?>   
                        
                         <a style="color:blue;" href="#" onclick="window.open('account_view_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=530,width=900,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
                        <div class='view_button'>View</div></a>
                        
              <?php 
                    if($payment_ststuss=="CANCEL")
                    {
                    }else {
                    {
                    ?>
                        
               <div onclick="account_payment_cancel('<?php  echo $recipt_id;?>')" id="cancel_button_hide_<?php  echo $recipt_id;?>" class='cancel_button'>Cancel</div>
                    <?php 
                    }
                    }
                      ?>      
                   <?php 
                        }  
                     echo" </td>"
                        . "</tr>";   
               }
               $fetch_payment_num_rows=mysql_num_rows($payment_db);
               if((empty($recipt_id))&&(empty($fetch_payment_num_rows)))
               {
                   echo ' <tr>
                   <td colspan="12" class="alert_notification">Record no found !!</td>
               </tr>';  
               }   
}
   

if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['update_account_payment_id'])))
{
 $organization_id=$_REQUEST['org_id'];
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $update_account_payment_id=$_REQUEST['update_account_payment_id'];
 
 
 $update_account_payment_db=  mysql_query("UPDATE finance_account_payment SET status='cancel' WHERE id='$update_account_payment_id'"
         . "and organization_id='$organization_id' and branch_id='$branch_id' and session_id='$session_id' and is_delete='none'");
 if((!empty($update_account_payment_db))&&($update_account_payment_db))
 {
     echo "1";  
 }else
 {
  echo "0";   
 }
 
    
    
    
}


    

?>