

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
<?php 
date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$todaydate=date("Y-m-d"); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Cash Master</title>
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="account_javascript/cash_master_javascript.js"></script>
    </head>
    <style>
   #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial;   float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{ width:1150px; height:auto;  margin:0 auto;  }
    #table_midle_set{ width:100%; height:auto; margin:0 auto; margin-top:2px; border:1px solid #555555; float:left;    
    }
    .td_leftpaddingth{ padding-left:10px; padding-top:3px; }
    #top_add_view_div{ width:100px; height:18px;
                       background-image:url('finanacephoto/skynormal.png');
                       float:right; margin-right:5px; color:black; text-align:center; padding-top:2px        }
    .td_leftpadding{ padding-right:10px;text-align:right;  }
    .textsize_same_start{ width:120px;  border:1px solid gray; margin-left:5px; }
    .textsize_same_due{ width:120px;  border:1px solid gray; margin-left:5px; }
    .add_button_reset_button{ width:60px; height:23px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-image:url('finanacephoto/bgblack.png');  }
    #error-msg{ width:100%; height:22px;padding-top:3px; background-color:#FFFFCC; 
                margin-top:10px; float:left; color:#380000; text-align: center;
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
    .samediv_color_image_size_etc{ width:auto;  height:25px; text-align:center;  
                                   color:black;cursor:pointer; 
                                  background-color: steelblue; background-image:url('finanacephoto/cash_image_div.png');    }
    #div_verticle{ width:1px; height:16px; margin-top:2px; background-color:red;    }
    .samediv_color_image_size_etc:hover{background-image:url('finanacephoto/white_cash_div.png');  color:black;  }
    #feepayment_cashmaster{ background-image:url('finanacephoto/white_cash_div.png');  color:black; }
    #feepayment_process_cashmaster{ width:100%; height:100px;   }
    .find_and_reset_button{width:60px; height:23px; margin-left:5px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-image:url('finanacephoto/bgblack.png'); }
    #feesgroupsearch{ width:150px; height:22px; border:1px solid silver;   }
    .text_same_style{ width:110px; margin-left:5px;  }
    .calender_div_tag_start{width:25px; height:25px; float:left;  background-repeat:no-repeat;
                     background-image:url('finanacephoto/calender.png'); }
    .calender_div_tag_start:hover{ cursor:pointer; }
    .calender_div_tag_due{width:25px; height:25px; float:left;  background-repeat:no-repeat;
                     background-image:url('finanacephoto/calender.png'); }
    .calender_div_tag_due:hover{ cursor:pointer; }
    #cashmaster_details{width:100%; height:auto; margin-top:20px;   }
    #feepayment_process_cashmaster{width:100%; height:95px; }
    #user_feepayment_process_cashmaster{ width:100%; height:95px;   display:none; }
    #daybook_feepayment_process_cashmaster{ width:100%; height:95px;   display:none; }
    #expense_feepayment_process_cashmaster{ width:100%; height:95px;  display:none; }
     #account_feepayment_process_cashmaster{ width:100%; height:110px;  display:none; }
      #feepaymentsummary_feepayment_process_cashmaster{ width:100%; height:95px;  display:none; }
       #balancesheet_feepayment_process_cashmaster{ width:100%; height:95px;  display:none; }
    .same_button_size_equal{ width:100%; height:100%; padding-top:5px;   }
    #table_midle_settable{ margin-bottom:10px;  }
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
        #printslip{ color: blue; cursor:pointer; text-decoration:underline;  }
    .top_fee_payment_summary{ width: 100%; height:auto; float:left; }
   .top_compand_div{ width:100%; height: 30px;  float:left;  }
   .th_styling{ border-bottom:1px solid black; border-top:1px solid black; height:24px; background-color:  #d9edf7;
font-weight:bold; border-left:1px solid black; font-size: 13px; padding-left:10px; padding-right:10px;      }
   .td_styling{ padding-left:15px; padding-right:10px; border-bottom:1px solid black; height:22px; border-left:1px solid black;     }
    .radio_box{ width:15px; height:15px;  }
    optgroup{ background-color: whitesmoke; }
    </style>
    <body style=" margin: 0;padding: 0;">
      <?php 
      include_once '../ajax_loader_page_second.php';
      
      ?> 
         <div id="financefirstdiv">
               <input id="organization_id" name='organization_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
             <input id="branch_id" name='branch_id' value="<?php  echo $fetch_branch_id;?>" type="hidden">
             <input type="hidden" id="currency" value="<?php  echo $fetch_currency;?>">
            
         <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
           
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td>
                 <?php  include_once 'headerfinancepage.php'; ?>
                    <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>"> 
                    
                    <style>
                         #color_8{ background-color:dodgerblue; color:white; border-top-left-radius:3px;
                         border-top-right-radius:3px; }   
                        </style>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <div id="valuediv">
                         <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>   
                       <script src="../javascript/list.js"></script>    
                            <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
        
        
        <script type="text/javascript">
      
        </script>
        
        <script type="text/javascript">
      
$(function() {

$("#to_date_1,#to_date_2,#to_date_3,#to_date_4,#to_date_5,#to_date_6,#to_date_7,#to_date_8,#to_date_9").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    }); 
    
    
    $("#from_date_1,#from_date_2,#from_date_3,#from_date_5,#from_date_6,#from_date_7,#from_date_8,#from_date_9").datepicker({ 
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
                                    <td colspan="6" class="td_leftpaddingth" style=" color:white;  font-weight:bold;  
                                        height:30px; background-color:#555555; ">
                                    Cash Master
                                    <input type="hidden" value="" id="saved_radio_button_value">
                                    </td>
                                </tr>
                                <tr>
                                    <td  class="td_leftpaddingth" style=" height:5px; " colspan="4">   
                                    </td>
                                </tr>
      <tr><td>
           
              <div class="first_option_div">
              <a href="#1"><div id="button_active_1" onclick="button_function('1')" class="button_cash_master" style=" margin-left:2px; border-left:1px solid black; ">Fee Group Summary</div> </a>
              <a href="#2"><div id="button_active_2" onclick="button_function('2')"  class="button_cash_master">Due Balance Summary</div></a>
              <a href="#8"><div id="button_active_8" onclick="button_function('8')"  class="button_cash_master">Pending Balance Summary</div></a>
              <a href="#3"><div id="button_active_3" onclick="button_function('3')"  class="button_cash_master">Salary Summary</div></a>
              <a href="#4"><div id="button_active_4" onclick="button_function('4')"  class="button_cash_master">Day Book</div></a>
              <a href="#5"><div id="button_active_5" onclick="button_function('5')"  class="button_cash_master">Account</div></a>
              <a href="#6"><div id="button_active_6" onclick="button_function('6')"  class="button_cash_master">Income Summary</div></a>
              <a href="#7"><div id="button_active_7" onclick="button_function('7')"  class="button_cash_master">Expense Summary</div></a>
              <a href="#9"><div id="button_active_9" onclick="button_function('9')"  class="button_cash_master">Balance Sheet</div></a>
              </div>   
              
         </td>
         </tr>
         <tr>
                     <td>    
                         
                         <div id="filter_show_div_1" class="filter_div_tag" style=" display:block; ">
                             <table class="filter_table">
                                 <tr>
                                     <td><b>From <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="from_date_1" class="text_box" placeholder="Enter from date (Y-m-d)" type="text"></td>
                                     
                                     <td><b>To <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="to_date_1" class="text_box" placeholder="Enter to date (Y-m-d)" type="text"></td>
                                     
                                     <td><b>Fee Name/Fee Group <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td>
                                         <select class="select_box" id="fee_group_id">
                                             <option value="0">---Select---</option>
                                           <?php 
   $fee_group_db=  mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set'"
           . "and action='active'");
   while ($fetch_fee_group_data=mysql_fetch_array($fee_group_db))
   {
      $fetch_fee_group_id=$fetch_fee_group_data['fee_group_id'];
      $fetch_fee_group_name=$fetch_fee_group_data['feegroupname'];
      echo "<option value='$fetch_fee_group_id'>$fetch_fee_group_name</option>"; 
       
   }
   if(!empty($fetch_fee_group_id))
   {
   echo "<option value='FESGRP_DUE_PAID_'>Due Amount</option>";
   echo "<option value='FESGRP_OTHER_'>Other Fee</option>";
   }
                                             
                                             ?>
                                         </select></td>
                                 </tr>
                                 <tr>
                                     <td style=" height:7px; "></td>
                                 </tr>
                                 <tr>
                                     <td colspan="10">
                                         <input type="button" onclick="fee_group_search()" class="button_styling" 
                                                style=" margin-right:52px; " value="Search">
                                         <input type="reset" class="button_styling" style=" background-color:deeppink; " value="Reset">  
                                         
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style=" height:10px; "></td>
                                 </tr>
                             </table>
                         </div>
                         
                         
                         
                         
                         
                         
                         
                         <div id="filter_show_div_2" class="filter_div_tag">
                          <table class="filter_table">
                                 <tr>
                                     <td><b>From <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="from_date_2" class="text_box" placeholder="Enter from date (Y-m-d)" type="text"></td>
                                     
                                     <td><b>To <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="to_date_2" class="text_box" placeholder="Enter to date (Y-m-d)" type="text"></td>
                                     
                                     <td><b>Student Name <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td>
                                         <select class="select_box" id="student_id" style=" width:350px; font-size:12px;  ">
                                             <option value="0">---Select Student---</option>
                                           <?php 
  $student_id_array=array();
  $due_balance_db=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set'"
          . "and is_delete='none'");
  while ($fetch_student_due_amount_data=mysql_fetch_array($due_balance_db))
  {
   $fetch_student_id=$fetch_student_due_amount_data['student_id'];
   $fetch_student_course=$fetch_student_due_amount_data['course_id'];
   
   $student_pay_fee_id=$fetch_student_due_amount_data['student_pay_fee_id'];
   $recipt_id=$fetch_student_due_amount_data['receipt_id'];
   $recipt_no=$fetch_student_due_amount_data['reciept_no'];
   
   
   $student_db=  mysql_query("SELECT * FROM student_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and course_id='$fetch_student_course' and student_id='$fetch_student_id'");
   $fetch_student_data=  mysql_fetch_array($student_db);
   $fetch_student_num_row=  mysql_num_rows($student_db);
   if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_row!=0))
   {
       $fetch_student_id=$fetch_student_data['student_id'];
       $fetch_student_name=  ucfirst($fetch_student_data['student_full_name']);
       $fetch_student_father_name=$fetch_student_data['father_name'];
       $fetch_student_roll_no=$fetch_student_data['roll_no'];
               
       
       echo "<option value='$fetch_student_id'>$fetch_student_name <b>So/</b> $fetch_student_father_name</option>";   
   }
   
   
   
  }
  
                                             
                                             ?>
                                         </select></td>
                                 </tr>
                                 <tr>
                                     <td style=" height:7px; "></td>
                                 </tr>
                                 <tr>
                                     <td colspan="10">
                                         <input type="button" onclick="due_amount_search()" class="button_styling" 
                                                style=" margin-right:52px; " value="Search">
                                         <input type="reset" class="button_styling" style=" background-color:deeppink; " value="Reset">  
                                         
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style=" height:10px; "></td>
                                 </tr>
                             </table>   
                         </div>
                         
                         
                         
                         
                         
                         
                         
                         
                         <div id="filter_show_div_3" class="filter_div_tag">
                             
                            <table class="filter_table" style=" width:auto; margin-left:130px;  ">
                                 <tr>
                                     <td><b>From <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="from_date_3" class="text_box" placeholder="Enter from date (Y-m-d)" type="text"></td>
                                     <td style=" width:60px; "></td>
                                     <td><b>To <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="to_date_3" class="text_box" placeholder="Enter to date (Y-m-d)" type="text"></td>
                                     <td style=" width:60px; "></td>
                                     <td>
                                          <input type="reset" class="button_styling" style=" background-color:deeppink; " value="Reset">  
                                        
                                         <input type="button" onclick="salary_search()" class="button_styling" 
                                               value="Search">
                                         
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style=" height:10px; "></td>
                                 </tr>
                             </table>    
                         </div>
                         
                         
                         
                         <div id="filter_show_div_4" class="filter_div_tag">
                             <table class="filter_table" style=" width:auto; padding-bottom:20px;  float:left; margin-left:350px;  ">
                                 <tr>
                                    
                                     <td><b>Date<sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="to_date_4" class="text_box" placeholder="Enter to date (Y-m-d)" type="text"></td>
                                     <td style=" width:50px; "></td>
                                     <td>
                                          <input type="reset" class="button_styling" style=" background-color:deeppink; " value="Reset">  
                                         
                                         <input type="button" onclick="day_book_search()" class="button_styling" 
                                                 value="Search">
                                        
                                     </td>
                                
                                     <td style=" height:10px; "></td>
                                 </tr>
                             </table>    
                             
                         </div>
                         
                         
                         
                         
                         
                         <div id="filter_show_div_5" class="filter_div_tag">
                             <table class="filter_table" style="  margin-left:10px;">
                                 <tr>
                                     <td><b>From <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="from_date_5" class="text_box" style=" width:150px; " placeholder="Enter from date (Y-m-d)" type="text"></td>
                                     <td style=" width:15px; "></td>
                                     <td><b>To <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="to_date_5" class="text_box" style=" width:150px; "  placeholder="Enter to date (Y-m-d)" type="text"></td>
                                   
                                     <td style=" width:15px; "></td>
                                     <td><input type="radio" class="radio_box" name="account_type" value="income" id="income_value" checked=""></td>
                                     <td><b>Income</b></td>
                                     
                                     <td style=" width:15px; "></td>
                                      <td><input name="account_type" class="radio_box" value="expense" id="expense_value" type="radio"></td>
                                      <td><b>Expense</b></td>
                                      
                                      
                                      <td style=" width:15px; "></td>
                                      <td style=" font-size:12px; "><b>Account <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td>
                                         <select class="select_box" id="account_group_id" style=" width:250px; ">
                                             <option value="0">---Select---</option>
                                           <?php 
  $account_group_db=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and accountheadgrouptype='income' and action='active'");
  while ($fetch_account_group_data=mysql_fetch_array($account_group_db))
  {
      
     $account_group_id=$fetch_account_group_data['account_head_id'];
     $account_group_name=ucfirst($fetch_account_group_data['accountheadgroupname']);
      
     echo "<optgroup label='$account_group_name'>";  
     $account_db=  mysql_query("SELECT * FROM financeaccountdetail WHERE  organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and account_type='income' and account_group_id='$account_group_id' and action='active'");
     while ($fetch_account_data=mysql_fetch_array($account_db))
     {
     $fetch_account_id=$fetch_account_data['account_id'];
     $fetch_account_name=$fetch_account_data['accountname'];
     echo "<option value='$fetch_account_id'>$fetch_account_name</option>";
     
     
     }
     
     echo "</optgroup>";
     
      
      
  }
                                             
                                             ?>
                                             
                                         </select></td>
                                 </tr>
                                 <tr>
                                     <td style=" height:7px; "></td>
                                 </tr>
                                 <tr>
                                     <td colspan="20">
                                         <input type="button" onclick="account_search()" class="button_styling" 
                                                style=" margin-right:47px; " value="Search">
                                         <input type="reset" class="button_styling" style=" background-color:deeppink; " value="Reset">  
                                         
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style=" height:10px; "></td>
                                 </tr>
                             </table>    
                             
                             
                         </div>
                         
                         
                         
                         
                         
                         <div id="filter_show_div_6" class="filter_div_tag">
                         <table class="filter_table" style=" width:auto; margin-left:130px;  ">
                                 <tr>
                                     <td><b>From <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="from_date_6" class="text_box" placeholder="Enter from date (Y-m-d)" type="text"></td>
                                     <td style=" width:60px; "></td>
                                     <td><b>To <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="to_date_6" class="text_box" placeholder="Enter to date (Y-m-d)" type="text"></td>
                                     <td style=" width:60px; "></td>
                                     <td>
                                          <input type="reset" class="button_styling" style=" background-color:deeppink; " value="Reset">  
                                        
                                         <input type="button" onclick="income_search()" class="button_styling" 
                                               value="Search">
                                         
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style=" height:10px; "></td>
                                 </tr>
                             </table>      
                         </div>
                         
                         
                         
                         
                         
                         
                         <div id="filter_show_div_7" class="filter_div_tag">
                             <table class="filter_table" style=" width:auto; margin-left:130px;  ">
                                 <tr>
                                     <td><b>From <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="from_date_7" class="text_box" placeholder="Enter from date (Y-m-d)" type="text"></td>
                                     <td style=" width:60px; "></td>
                                     <td><b>To <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="to_date_7" class="text_box" placeholder="Enter to date (Y-m-d)" type="text"></td>
                                     <td style=" width:60px; "></td>
                                     <td>
                                          <input type="reset" class="button_styling" style=" background-color:deeppink; " value="Reset">  
                                        
                                         <input type="button" onclick="expense_search()" class="button_styling" 
                                               value="Search">
                                         
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style=" height:10px; "></td>
                                 </tr>
                             </table>    
                         </div>
                         
                         
                         
                         
                         
                         <div id="filter_show_div_8" class="filter_div_tag">
                          <table class="filter_table" style=" width:auto; margin-left:130px;  ">
                                 <tr>
                                     <td><b>From <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="from_date_8" class="text_box" placeholder="Enter from date (Y-m-d)" type="text"></td>
                                     <td style=" width:60px; "></td>
                                     <td><b>To <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="to_date_8" class="text_box" placeholder="Enter to date (Y-m-d)" type="text"></td>
                                     <td style=" width:60px; "></td>
                                     <td>
                                          <input type="reset" class="button_styling" style=" background-color:deeppink; " value="Reset">  
                                        
                                         <input type="button" onclick="pending_balance_search()" class="button_styling" 
                                               value="Search">
                                         
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style=" height:10px; "></td>
                                 </tr>
                             </table>           
                         </div>
                         
                         
                         
                         
                         
                         
                         <div id="filter_show_div_9" class="filter_div_tag">
                            
<table class="filter_table" style=" width:auto; margin-left:130px;  ">
                                 <tr>
                                     <td><b>From <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="from_date_9" class="text_box" placeholder="Enter from date (Y-m-d)" type="text"></td>
                                     <td style=" width:60px; "></td>
                                     <td><b>To <sup style=" color:red; ">*</sup></b></td>
                                     <td><b>:</b></td>
                                     <td><input id="to_date_9" class="text_box" placeholder="Enter to date (Y-m-d)" type="text"></td>
                                     <td style=" width:60px; "></td>
                                     <td>
                                          <input type="reset" class="button_styling" style=" background-color:deeppink; " value="Reset">  
                                        
                                         <input type="button" onclick="balance_sheet_search()" class="button_styling" 
                                               value="Search">
                                         
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style=" height:10px; "></td>
                                 </tr>
                             </table>                               
                         </div>
                         
                         
                         
                     </td>
         </tr>
         <tr>
             <td colspan="4">
                 <div id="cash_master_data" class="fetch_data_record">
                     
                 </div>   
             </td>
         </tr>
         
         
         <tr>
             <td style=" height:2px; "></td>
         </tr>
         </table>
             <div style=" width:100px; height:40px;  "></div>     
         </div>
                    </td>
                </tr>
         </table>
         </form>
         </div>
         <div id="attechfotter" style=" width:100%; height:22px; position:fixed; bottom:0px; ">
          <?php 
              include 'financefotter.php';
            ?>
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