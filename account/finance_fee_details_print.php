

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
$report_logo=$fetch_branch_data['report_logo'];

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
<link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
<style>
     .top_heading_line{ width:auto; background-color: mintcream; border:1px solid black; border-right:0px;
  text-align:center; height:22px;   font-weight:bold;  font-size:11px;  }
  .alert_notification{ border:1px solid black; text-align:center; color: red; border-top:0px; height:30px;    }
  .td_heading_data{ border-left:1px solid black; font-size:11px;  border-bottom:1px solid black;
padding-left:4px; padding-right:4px; height:23px;  text-align:center;    }
  
</style>       

<?php 
require_once '../connection.php';
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
  
  if($_REQUEST['limit']=="no")
  {
    $search_limit="";  
  }  else {
     $search_limit="LIMIT $first_limit,5"; 
  }
  
  
   echo '   
                 <div class="first_logo_div" style="width:1050px;">
        <img style="width:100%; height:200px;" src="../'.$report_logo.'">
          </div>                          
               <table cellspacing="0" cellpadding="0" class="details_table" 
               style="width:1050px; margin-left:3px; float:left; margin-top:5px;">
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
               <td class="top_heading_line" class="top_heading_line" style=" border-right:1px solid black; ">Status</td>
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
                      . " and session_id='$fecth_session_id_set' $other_search $search_student_record $search_course $search_payment_date ORDER BY id DESC $search_limit");
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
                  
                  $studnet_db=mysql_query("SELECT * FROM student_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set'"
                          . "and course_id='$stduent_course_id' and student_id='$student_id'");
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
                  if($match_section_id==$get_section_id)
                  {
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
                          . "<td class='td_heading_data' style='border-right:1px solid black;'>$payment_ststus</td>"
                          . "</tr>";   
                          $number_no_record=1;
                  
              }else
              {
               
              }
              
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
                      . " and session_id='$fecth_session_id_set' $other_search $search_student_record $search_course $search_payment_date");
              $count_total_rows=  mysql_num_rows($count_total_rows_db);
              $show_page_number="4";
              $forward_page_devision=($count_total_rows/$show_page_number);
              $forward_page=ceil($forward_page_devision);
              $page=$get_page_no;
              $first_limit=($show_page_number*$page);
              $limit_search="$first_limit,$show_page_number";
              
}

?>
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