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
$fetch_currency=$fetch_org_data['currency'];
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
        <title>Finance</title>
         <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
         
        <script type="text/javascript" src="jquery/jquery-1.js">
        </script>
        <script type="text/javascript" src="account_javascript/account_details.js"></script>
    </head>
    <style>
   #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial;  font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px; position: relative  }
    #valuediv{ width:100%; height:auto; margin: 0 auto;    }
    #table_midle_set{ width:1150px; height:auto; margin:0 auto;
                      margin-top:10px; border:1px solid silver;     
    }
     #table_midle_setdetail{ width:400px; height:auto;  float:left; margin-left:2px;   margin-top:10px; 
                            
    }
    .td_leftpaddingth{ padding-left:10px;}
    #top_add_view_div{ width:auto;padding-left:10px; padding-right:10px;   height:18px;
                       background-image:url('finanacephoto/skynormal.png');
                       float:right; margin-right:5px; color:black; text-align:center; padding-top:2px        }
    .td_leftpadding{ padding-right:10px;text-align:right;  }
    .textsize_same{ border:1px solid gray; margin-left:5px; }
    .both_button_style{ width:90px;  padding-left:10px;
                        padding-right:10px;  height:28px; margin-left:5px; font-size:12px; float:right;
                             border:0px;color:whitesmoke; font-weight:bold; cursor:pointer;
                              margin-top:5px; 
                             border-radius:3px; background-color: cornflowerblue;  
                              }
    #error-msg{ width:100%; height:22px;padding-top:3px; background-color:#FFFFCC; 
                margin-top:10px; float:left; color:#380000; text-align: center;
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
    
    .selectbox{ width:280px; height:25px; padding:3px;   border:1px solid silver;  }
    .selectbox_advance{ width:130px; border:1px solid silver;  }
    .studentselectbox{ width:255px; font-size:12px;  color:black; height:20px;    border:1px solid silver;   }
    #studentsearchname{ width:270px; border:1px solid silver;  }
    .listbutton{ width:100%; height:100%; text-align:left;background-color:whitesmoke; 
                    border:1px solid whitesmoke;  font-size:12px;  font-weight:400;  }
        .listbutton:hover{ background-color:silver;  border:1px solid silver; font-weight:700;  cursor:pointer;  }
 ul{ margin: 0; padding: 0;width:100%; height:auto;list-style:none;color: black; background-color:whitesmoke;  }
             li{ margin: 0; padding: 0;width:auto; height:25px; font-weight:400;  border-bottom:1px solid silver;
                   color: black; border-left:1px solid silver;border-right:1px solid silver; }
       .sli{ width:100%;  height:auto; font-size:0px;   }
        .hsli{ width:100%; height:auto; height:22px; text-indent:5px;  }
        #showiframepaymentsystem{ width:698px; overflow:hidden; position:relative;
                                    height:650px; display:none;    }
        .selectfeegroup{ width:180px; height:22px; border:1px solid silver;   }
        .td_fetch_previous_details{ border-right:1px solid silver; z-index:100; 
                                   font-size: 12px; border-bottom:1px solid silver; text-align:center;    }
    #studentperiviousdetails{ width:100%; height:284px;   overflow:auto;   }
    .bg_color{ background-color:white; height:22px;border-bottom:1px solid silver;    }
    .feesprintslip{ width:auto; height:auto; color:blue; text-decoration: underline; cursor:pointer;    }
    #refereshbutton{ width:85px; height:27px; float:right; margin-right:15px; font-weight:bold;  
                     text-align:right; cursor:pointer;  
                     background-image:url('finanacephoto/refresh.png');
                     background-color:white;   background-position-y:1px; background-position-x:1px;  
                     background-repeat:no-repeat;   }
    #refereshbuttonadvance{width:85px; height:27px; float:right; margin-right:15px; font-weight:bold;  
                     text-align:right; cursor:pointer;  
                     background-image:url('finanacephoto/refresh.png');
                     background-color:white;   background-position-y:1px; background-position-x:1px;  
                     background-repeat:no-repeat; display: none;}
    #fullviewwindowoutput{width:850px;  height:550px;border:2px solid steelblue;  
               position:fixed;  right:0px; left:0px; top:20px; bottom:0px; display:none;
                              z-index:202; background-color:whitesmoke; margin:0 auto; overflow:  no-display;  }
        #closebutton{ width:100%; height:30px; background-color:steelblue; float:right; border-bottom:1px solid black;   }
        #closebuttonthis{ width:33px; height:25px; margin-top:6px;  
                          float:right;  
                          }
        #viewoutput{width:100%; height:94%;float:left; 
                    background-color:whitesmoke;  overflow:hidden;  }
         #fullviewwindow{ width:28px;  height:28px; margin-top:2px; 
                          float:right;
                         background-image:url('finanacephoto/closewindow/max.png'); background-repeat:no-repeat;     }
       #feespaymentdetailsdata{ width:840px; height:auto; margin-top:15px;    } 
  #accountpaymentdetails{ width:100%; height:auto; margin-top:20px;   }
  .details_table{ width:98%; height:auto; float:left; margin-top:10px; margin-bottom:15px;  margin-left:1%; margin-right:1%;   }
  .top_heading_line{ width:auto; background-color: mintcream; border:1px solid black; border-right:0px;
  text-align:center; height:22px;   font-weight:bold;   }
  .alert_notification{ border:1px solid black; text-align:center; color: red; border-top:0px; height:30px;    }
  .td_heading_data{ border-left:1px solid black; font-size:11px;  border-bottom:1px solid black;
padding-left:4px; padding-right:4px; height:23px;  text-align:center;    }
  .radio_box{ width:18px; height:18px; position:relative;   cursor:pointer;  }
  .text_box_class{ width:120px; padding-left:5px; margin-left:3px; height:20px;    }
    </style>
    
    <body style=" margin: 0;padding: 0;">
        <div id="temp_data"></div>   
        
        
   <?php 
      include_once '../ajax_loader_page_second.php';
      ?> 
        
        
         <div id="financefirstdiv">
              <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
           <input id="organization_id" name='organization_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
             <input id="branch_id" name='branch_id' value="<?php  echo $fetch_branch_id;?>" type="hidden">
             <input type="hidden" id="currency" value="<?php  echo $fetch_currency;?>">
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td>
                        
                              <?php 
                                include_once 'headerfinancepage.php';
                                ?>
                                <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
                                <style>
                         #color_7{ background-color:dodgerblue; color:white; border-top-left-radius:3px;
                         border-top-right-radius:3px; }   
                        </style>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <div id="valuediv"> 
                            
                            
         <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
        
        <script type="text/javascript">
      
$(function() {

$("#date_to").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });  
    
    $("#date_from").datepicker({ 
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
                            
                            
                            <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="4" class="td_leftpadding" 
                                        style=" color:white; text-align:left; padding-left:10px;   
                                        height:25px; background-image:url('finanacephoto/bgblack.png'); ">
                                        <strong>Account Payment Details</strong>   
  <a href="finance_account_payment_add.php" border="0" style=" text-decoration:none; ">
      <abbr title=" Add Account Payment Details">
                                    <div id="top_add_view_div">
                                        <strong>Add/Edit Account Payment </strong>
                                    </div>
  </abbr>
                                    </a>
                                    </td>
                                </tr>
                               <tr><td class="td_leftpadding">
                                     <fieldset style=" font-size:12px; font-weight:500;margin-left:10px;
                                               margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Select Account Group and Group Type</span></legend>
                                    <table cellspacing="0" cellpadding="0" style="width:100%; height:auto;  ">
                                    <tr>
                                    <td  class="td_leftpaddingth" style=" height:25px; " colspan="5"> 
                                    <strong style="color:gray;background-color:whitesmoke; padding-left:10px;
                                            padding-right:10px; 
                                            font-size:11px; ">Fields marked with <span><sup style=" color:red; ">*</sup> 
                                            must be filled.</strong> 
                                   </td>
                                </tr>    <tr>
                                              <td colspan="6" style=" width:100%; height:28px; border-radius:3px; 
                                                 margin-bottom:10px; padding-left:10px;   margin-top:10px; color:white;  
                                                 background-color:gray;">
                                                  <table>
                                                      <tr>
                                                          <td><input id="incomesearch" name="normalcheckedradio" class="radio_box" onclick="radio_button_check(this.value)" value='income' type="radio" checked></td><td><strong>Income</strong></td>
                                                          <td style=" width:10px; "></td>
                                                          <td><input id="expensesearch" name='normalcheckedradio' class="radio_box" onclick="radio_button_check(this.value)" value="expense" type="radio"></td><td><strong>Expense</strong></td>
                                                      </tr>
                                                  </table>
                                             
                                              </td>
                                             
                                          </tr>
                                          <tr>
                                              <td>
                                                  <table cellspacing="0" cellpadding=0 style=" width:460px; height: auto; margin:0 auto; margin-top:4px;  ">
                                                      
                                                      <tr>
                                                          <td style=" background-color:whitesmoke; height:32px;  "><input onclick="by_date()" id="check_by_date" type="checkbox" value="by_date"></td>
                                                          <td style=" background-color:whitesmoke; padding-right:5px; "><b>By Date</b></td>
                                                          <td colspan="2" style=" width:360px; ">
                                                              <table style=" display:none; " id="show_from_to_date_table">
                                                                  <tr>
                                                          <td style=" padding-left:5px; "><b>From</b></td><td><b>:</b></td>
                                                          <td><input type="text" id="date_from" class="text_box_class" placeholder="Enter from" readonly="readonly"></td>
                                                          <td style=" width:30px; "></td>
                                                           <td><b>To</b></td><td><b>:</b></td>
                                                           <td><input type="text" id="date_to" class="text_box_class" placeholder="Enter to"  readonly="readonly"></td>
                                                           
                                                               </tr>
                                                              </table>
                                                          </td>
                                                      </tr>
                                                  </table>   
                                              </td>
                                          </tr>
            <tr>
                <td>
         <table  cellspacing="4" cellpadding="2" style=" width:auto; margin:0 auto;  height:auto;">
           <tr>
            <td>Account Group Name<sup style=" color:red; ">*</sup></td> 
            <td><strong>:</strong></td>
            <td>
                <select onchange="account_group_name_id(this.value)" id="accountgroupname" class="selectbox">
                    <option value="0">---Select---</option>
                  <?php 
                    $account_group_db=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE organization_id='$fetch_school_id'
                    and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and accountheadgrouptype='income' and action='active'");
                    while ($fetch_account_group_data=mysql_fetch_array($account_group_db))
                    {
                     $fecth_account_group_name=$fetch_account_group_data['accountheadgroupname'];
                     $fecth_account_group_id=$fetch_account_group_data['account_head_id'];
                     echo "<option value='$fecth_account_group_id'>$fecth_account_group_name</option>";
                   }
                    ?>
                </select>
            </td>
           </tr>
           <tr>
               <td>Account Name <sup style=" color:red; ">*</sup></td>
                <td><strong>:</strong></td>
                <td> <select id="account_name" class="selectbox">
               <option value="0">---Select---</option>
           </select></td>
           </tr>
           <tr>
               <td>
                   <table cellspacing="0" cellpadding="0" class="advance_search">
                       <tr>
                           <td><input onclick="advance_search_option()" id="advance_search_option_value" type="checkbox"></td><td><span><b>Advance Search</b></span></td>
                       </tr>
                   </table>
                   
                   </td>
           </tr>
           <tr id="search_by_tr" style="display:none; ">
               <td>Search By </td><td><b>:</b></td>
               <td><select id="search_by" class="selectbox">
                       <option value="0">---Select---</option>
                       <option value="department">Receiver Department</option>
                       <option value="receiver_designation">Receiver Designation</option>
                       <option value="receiver_name">Receiver Name</option>
                       <option value="receiver_mobile_no">Receiver Mobile Number</option>
                       <option value="depositor_name">Depositor Name</option>
                       <option value="mobile_no">Depositor Mobile Number</option>
                       <option value="email_id">Depositor Email</option>
                       <option value="depositor_address">Depositor Address</option>
                       <option value="payment_mode">Payment Mode</option>
                       <option value="bank_name">Bank Name</option>
                       <option value="cheque_dd_no">Cheque/DD Number</option>
                       <option value="cheque_dd_date">Cheque/DD Date (Y-m-d)</option>
                       <option value="status">Status</option>
                   </select></td>
           </tr>
           <tr id="search_input_tr" style="display:none; ">
               <td>Search</td><td><b>:</b></td>
               <td><input type="text" class="text_class_style" placeholder="Enter Search Keyword..." id="search_value"></td>
           </tr>
           
           
           <tr>
               <td colspan="2"></td>
            <td>
            <input type="button" name="filter_value"class="both_button_style" onclick="search_button()" id='filter_value' value="Search">
            <input type="submit" id="filter_reset" class="both_button_style" style=" background-color: deeppink; " value="Reset">
            </td>
            
           
                        </tr></table>
                    
                    
                    
                    
                    
          
                </td>
                                          </tr>
                                          <tr>
                                              <td style=" height:auto; "></td>
                                          </tr>
                                      </table>
                                    </td>
                                    
                                </tr> 
                                <tr>
                                    <td>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <div id="account_payment_details">
                                            
                                            <div class="all_div_tag">
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
               
              
             <?php 
               $row=0;
               $payment_db=mysql_query("SELECT * FROM finance_account_payment WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_type='income' and is_delete='none'");
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
                   <td colspan="11" class="alert_notification">Record no found !!</td>
               </tr>';  
               }
               ?>
               
               
               
               
                                            </table>    
                                        </div>   
                                    </td>
                                </tr>  
                                
                                
                            </table>
                            
                        </div>
                    </td>
              <tr>
                    <td>
                        <div style=" width:300px; height:40px;  ">
                            
                        </div>
                    </td>
                </tr>
            </table> 
         </div>
       
         <div id="attechfotter" style=" width:100%; height:22px; position:fixed; bottom:0px; ">
          <?php 
              include 'financefotter.php';
            ?>
        </div> 
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