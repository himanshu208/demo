<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
    
?>
  <?php 
   date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$today_date=date("Y-m-d");
$date_time=$today_date." ".$time_current; 
   //insert fee
    if(isset($_POST['payamount']))
    {
        

      $insert_organization_id=$fetch_school_id;
      $insert_branch_id=$fetch_branch_id;
      $insert_session_id=$_POST['use_inset_session_id'];
      $insert_student_admission_id=$_POST['insert_student_id'];
      $insert_course_id=$_POST['insert_class_id'];
      
      $insert_payment_date=$_POST['paymentdate'];
      
      $insert_fee_group_id=$_POST['fee_group_id'];
      $insert_fee_group_name=$_POST['fee_group_name'];
      $insert_fee_qty=$_POST['fee_group_qty'];
      $insert_fee_group_specific_month=$_POST['fee_group_specific_month'];
      $insert_fee_amount=$_POST['fee_group_amount'];
      $insert_fee_sub_total_amount=$_POST['sub_total_fee'];
      $insert_fee_fine_amount=$_POST['fine_total_fee'];
      $insert_fee_discount_amount=$_POST['discount_total_fee'];
      $insert_fee_total_amount=$_POST['total_amount'];
      
     
      
      //OTHER VALUE INSERT
      
      $insert_total_fee_amount=$_POST['total_fee_payable_value'];
      $insert_total_fine_amount=$_POST['total_fine_payable_value'];
      $insert_discount_rate=$_POST['discount_rate'];
      $insert_discount_amount=$_POST['total_discount_amount'];
      $insert_payment_info=$_POST['payment_info'];
      $insert_payment_description=$_POST['fee_description'];
      $insert_final_amount_payable=$_POST['total_amount_payable'];
      $insert_fine_discount=$_POST['fine_discount'];
      $insert_fine_discount_description=$_POST['fine_discount_description'];
      $insert_special_discount=$_POST['special_discount'];
      $insert_special_discount_description=$_POST['special_discount_description'];
      $insert_payment_mode=$_POST['payment_mode'];
      $insert_bank_name=$_POST['bank_name'];
      $insert_cheque_dd_no=$_POST['cheque_dd_number'];
      $insert_cheque_dd_date=$_POST['cheque_dd_date'];
      $insert_cheque_dd_amount=$_POST['cheque_dd_amount'];
      $insert_amount_paid=$_POST['amount_paid'];
      $insert_due_amount=$_POST['due_amount'];
     
      $temp_due_amount=($insert_final_amount_payable-$insert_amount_paid);
      if(round($insert_due_amount)==round($temp_due_amount))
      {
      
      if($insert_payment_mode=="cash")
      {
      $fee_status="cleared";   
      $insert_bank_name="";
      $insert_cheque_dd_no="";
      $insert_cheque_dd_date="";
      $insert_cheque_dd_amount="";
      }else 
      {
      $fee_status="pending";
      }
      
      
$result=mysql_query("SHOW TABLE STATUS LIKE 'finance_student_pay_fee'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_student_fee_pay_fee_id="STUDENT_PAY_FEE_$nextId";
$encrypt_id=md5($final_student_fee_pay_fee_id);
$recipt_id=$recipt_prefix.$nextId;

if((!empty($insert_organization_id))&&(!empty($insert_branch_id))&&(!empty($insert_session_id))&&(!empty($final_student_fee_pay_fee_id))&&(!empty($recipt_id))&&(!empty($nextId))
        &&(!empty( $insert_total_fee_amount))&&(!empty($insert_student_admission_id))&&(!empty($insert_course_id))
        &&(!empty($insert_payment_date)))
{   
  
    $check_fee_already_pay=0;
     $total_fee_value=count($insert_fee_group_id);    
     $count_total_number_submited=0;  
     for($i=0;$i<$total_fee_value;$i++)
     {
      
     $fee_group_id=$insert_fee_group_id[$i]; 
     $fee_group_name=$insert_fee_group_name[$i];
     $fee_qty=$insert_fee_qty[$i];
     $fee_month=$insert_fee_group_specific_month[$i];
     $fee_amount=$insert_fee_amount[$i];
     $fee_sub_amount=$insert_fee_sub_total_amount[$i];
     $fee_fine_amount=$insert_fee_fine_amount[$i];
     $fee_discount_amount=$insert_fee_discount_amount[$i];
     $fee_total_amount=$insert_fee_total_amount[$i];
     
       $explode_month=explode(",",$fee_month);
       $total_month_count=count($explode_month);
       $total_insert_mounth_count=0;
       foreach($explode_month as $fee_month_name)
       {
       if($fee_group_id=="fee_other_pay")
       {
       $fee_group_id=0;    
       }
       
       if($fee_group_id=="fee_due_pay")
       {
       $fee_group_id=0;    
       }
       
       $payment_check_db=mysql_query("SELECT * FROM finance_student_pay_fee as T1 "
                 . " LEFT JOIN finance_pay_fee_integrate_db as T2 ON T1.student_pay_fee_id=T2.pay_fee_id "
                 . " LEFT JOIN finance_pay_fee_month_db as T3 ON T1.student_pay_fee_id=T3.pay_fee_id "
                 . " WHERE $db_t1_main_details T1.student_id='$insert_student_admission_id' and T2.fee_group_id='$fee_group_id'"
                 . " and T3.fee_group_id='$fee_group_id' and T3.specify_month_term='$fee_month' and T1.is_delete='none' and T1.status='cleared'");
        $payment_num_rows=mysql_num_rows($payment_check_db);
         if(!empty($payment_num_rows)&&($payment_num_rows!=0))
         {
        $check_fee_already_pay++;     
         }   
     }
     }
    
    if($check_fee_already_pay==0)
    {
    
      $insert_fee_payment_db=mysql_query("INSERT into finance_student_pay_fee values('','$insert_organization_id'
              ,'$insert_branch_id','$insert_session_id','$final_student_fee_pay_fee_id','$encrypt_id','$insert_student_admission_id','$insert_course_id','$recipt_id'
              ,'$insert_payment_date','$insert_total_fee_amount','$insert_total_fine_amount','$insert_discount_rate','$insert_discount_amount'
              ,'$insert_payment_info','$insert_payment_description','$insert_final_amount_payable','$insert_fine_discount','$insert_fine_discount_description'
              ,'$insert_special_discount','$insert_special_discount_description','$insert_payment_mode','$insert_amount_paid','$insert_bank_name','$insert_cheque_dd_no','$insert_cheque_dd_date'
              ,'$insert_cheque_dd_amount','$insert_due_amount','$today_date','$date_time','$fecth_user_unique','none','$fee_status','active')");
      if($insert_fee_payment_db)
      {
        
          
          if(!empty($_POST['due_amount_id']))
          {
           $due_amount_id_post=$_POST['due_amount_id'];   
           $implode_due_amount_id=implode(",",$due_amount_id_post);   
          }else
          {
           $implode_due_amount_id="";   
          }
          
          $explode_due_amount_id=explode(",",$implode_due_amount_id);
          $arrayCount=count($explode_due_amount_id);
          $count_due_amount_array_no=0;
          foreach ($explode_due_amount_id as $temp_due_amount_id)
          {
          $update_due_amount_db=mysql_query("UPDATE finance_student_due_amount_db SET is_delete='yes'"
                  . " WHERE student_id='$insert_student_admission_id' and student_due_amount_id='$temp_due_amount_id'"); 
          if(($update_due_amount_db)&&(!empty($update_due_amount_db)))
          {
            $count_due_amount_array_no +=1;  
          }else
          {  
              $count_due_amount_array_no +=0;   
          }    
          }
          
          if($arrayCount==$count_due_amount_array_no)
          {
              
     $total_fee_value=count($insert_fee_group_id);    
     $count_total_number_submited=0;  
     for($i=0;$i<$total_fee_value;$i++)
     {
      
     $fee_group_id=$insert_fee_group_id[$i]; 
     $fee_group_name=$insert_fee_group_name[$i];
     $fee_qty=$insert_fee_qty[$i];
     $fee_month=$insert_fee_group_specific_month[$i];
     $fee_amount=$insert_fee_amount[$i];
     $fee_sub_amount=$insert_fee_sub_total_amount[$i];
     $fee_fine_amount=$insert_fee_fine_amount[$i];
     $fee_discount_amount=$insert_fee_discount_amount[$i];
     $fee_total_amount=$insert_fee_total_amount[$i];
     
     if((!empty($fee_qty))&&(!empty($fee_month)))
     {
     
$results=mysql_query("SHOW TABLE STATUS LIKE 'finance_pay_fee_integrate_db'");
$rows=mysql_fetch_array($results);
$nextIds=$rows['Auto_increment']; 


     $insert_pay_fee_integrated=mysql_query("INSERT into finance_pay_fee_integrate_db values('','$final_student_fee_pay_fee_id'"
             . ",'$fee_group_id','$fee_group_name','$fee_qty','$fee_amount','$fee_sub_amount'"
             . ",'$fee_fine_amount','$fee_discount_amount','$fee_total_amount','none','$today_date','$date_time')");   
       if((!empty($insert_pay_fee_integrated))&&($insert_pay_fee_integrated))
       {
       $explode_month=explode(",",$fee_month);
       $total_month_count=count($explode_month);
       $total_insert_mounth_count=0;
       foreach($explode_month as $fee_month_name)
       {
       $insert_month_db=mysql_query("INSERT into finance_pay_fee_month_db values('','$nextIds','$final_student_fee_pay_fee_id'"
               . ",'$fee_group_id','$fee_month_name','none','$today_date')"); 
       if((!empty($insert_month_db))&&($insert_month_db))
       {
       $total_insert_mounth_count++;    
       }
       }   
        if($total_month_count==$total_insert_mounth_count)
        {
       $count_total_number_submited++; 
        }else
        {
$delete_fee_payment_db=mysql_query("DELETE FROM finance_pay_fee_integrate_db WHERE pay_fee_id='$final_student_fee_pay_fee_id'"
        . " and fee_group_id='$fee_group_id'");
        }
       }
     }else
     {
     $count_total_number_submited++;    
     }
     }
       if($count_total_number_submited==$total_fee_value)      
       {     
          if(($insert_due_amount!=0)||(!empty($insert_due_amount)))
          {

$result_due_amount=mysql_query("SHOW TABLE STATUS LIKE 'finance_student_due_amount_db'");
$row_due_amount=mysql_fetch_array($result_due_amount);
$nextId_due_amount=$row_due_amount['Auto_increment']; 
$final_student_fee_due_amount_id="STUDENT_DUE_FEE_$nextId_due_amount";
$due_amount_encrypt_id=md5($final_student_fee_due_amount_id);
  
if($insert_due_amount<0)
{
 $payment_name="Paid Amount";   
}else
{
 $payment_name="Due Amount";  
}

$insert_due_amount_db=mysql_query("INSERT into finance_student_due_amount_db values('','$insert_organization_id'
              ,'$insert_branch_id','$insert_session_id','$final_student_fee_due_amount_id','$due_amount_encrypt_id'
        ,'$insert_student_admission_id','$insert_course_id','$final_student_fee_pay_fee_id','$recipt_id','$nextId','$insert_payment_date'
        ,'$payment_name','$insert_due_amount','none','$today_date','$date_time','pending','active')");
              
     if(($insert_due_amount_db)&&(!empty($insert_due_amount_db)))
     {
     $message_show="<div class='notification_div_tag' style=' color:green; '>Fee Payment Successfully Complete</div>";   
     {
       
     ?>
   
     <script type="text/javascript">
        window.open('fee_payment_receipt.php?token_id=<?php  echo $encrypt_id;?>','_blank','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');
    </script>
    
  <?php 
     }
     }else 
     {
      $delete_fee_payment_db=mysql_query("DELETE FROM finance_student_pay_fee WHERE student_pay_fee_id='$final_student_fee_pay_fee_id'");
     if($delete_fee_payment_db)
     {
     $message_show="<div class='notification_div_tag' style=' color:red; '>Request failed,Please try again.</div>";     
     }else
     {
     $delete_fee_payment_db=mysql_query("DELETE FROM finance_student_pay_fee WHERE id='$nextId'");
     if($delete_fee_payment_db)
     {
     $message_show="<div class='notification_div_tag' style=' color:red; '>Request failed,Please try again.</div>"; 
     }       
     }
     } 
          }else
          {
          $message_show="<div class='notification_div_tag' style=' color:green; '>Fee Payment Successfully Complete</div>";
            {
     ?>
    
     <script type="text/javascript">
      window.open('fee_payment_receipt.php?token_id=<?php  echo $encrypt_id;?>','_blank','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');
    </script>
  <?php 
     }
          }
          }else
          {
     $delete_fee_payment_db=mysql_query("DELETE FROM finance_student_pay_fee WHERE id='$nextId'");
     if($delete_fee_payment_db)
     {
     $message_show="<div class='notification_div_tag' style=' color:red; '>Request failed,Please try again.</div>"; 
     }    
          }
          }else
          {
    $delete_fee_payment_db=mysql_query("DELETE FROM finance_student_pay_fee WHERE student_pay_fee_id='$final_student_fee_pay_fee_id'");
     if($delete_fee_payment_db)
     {
         echo "<div class='notification_div_tag' style=' color:red; '>Request failed,Please try again.</div>";    
     }   
     }
     }else
      {
      $message_show="<div class='notification_div_tag' style=' color:red; '>Sorry request failed,Please try again.</div>";
      }
   }else
{
$message_show="<div class='notification_div_tag' style=' color:red; '>Sorry,Record already exist in database</div>";
}   
}else
{
$message_show="<div class='notification_div_tag' style=' color:red; '>Please fill all fields.</div>";
}
}else
{
$message_show="<div class='notification_div_tag' style=' color:red; '>Sorry Technical Problem,Please try again</div>";
}

require_once 'pop_up.php';
      }
     
      
    ?>
    

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Pay Fee</title>
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
        <link href="stylesheet/fee_pay_css.css" rel="stylesheet" type="text/css" media="all">
        
    </head>
    <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>   
    <script src="../javascript/list.js"></script>
   
    <script type="text/javascript" src="account_javascript/account_validate.js"></script>
    <script type="text/javascript" src="account_javascript/account_pay.js"></script>
   
    <body onload="page_load()" style=" margin: 0;padding: 0;">
   
    <?php 
      include_once '../ajax_loader_page_second.php';
      ?>  
        <input type="hidden" id="organization_id" value="<?php  echo $fetch_school_id;?>">
        <input type="hidden" id="branch_id" value="<?php  echo $fetch_branch_id;?>">
        <div id="printwindow" style="width:100%;height:100%;background-color:#000000; display: none;
        opacity:0.7;filter:alpha(opacity=70);position:fixed;top:0;  left:0;z-index:201; overflow:hidden; ">
        </div>
       
        <div id='fullviewwindowoutput'>
            <div id='closebutton'>
                <abbr title="Window Close">
                <div id="closebuttonthis">
                    <img id="closebuttonimage" width="25px" height="25px"
                         style="margin-top:-4px; margin-left:3px;" src="finanacephoto/closewindow/cencle.png">
               </div> 
                </abbr>
                <abbr title="Window Maximize/Minimize">
                 <div id="fullviewwindow">
                 </div></abbr>
            </div> 
            <div id='viewoutput'></div>
        </div>
        
         <div id="financefirstdiv">
<form name="myForm" action="" onsubmit="return validateForm(this);" method="post" enctype="multipart/form-data">
               
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td>
                        
                              <?php 
                                include_once 'headerfinancepage.php';
                                ?>  
                    
                      <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>"> 
                           
                      <style>
                          #color_4{ background-color:dodgerblue; color:white; border-top-left-radius:4px;
                           border-top-right-radius:4px;}
                      </style>   
                    </td></tr> 
                <tr>
                    <td>
                        <div id="valuediv">
                            <table style=" width:auto; margin:0 auto;"> 
                                <tr><td style=" width:1150px;  ">  
                            <table  cellspacing="0" cellpadding="0" id="table_midle_set"> 
                                <tr>
                                    <td colspan="2" class="td_leftpaddingth" style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:darkslateblue ">
                                  Fee Payment
                                    </td>
                                </tr>
                                <tr><td class="td_leftpadding">
                                     <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                         <legend><span style=" color: maroon;  "><b>Select Student</b></span></legend>
                                    <table cellspacing="0" cellpadding="0" style="width:100%; height:auto;  ">
                                    <tr>
                                    <td  class="td_leftpaddingth" style=" height:25px; " colspan="5"> 
                                    <strong style="color:gray;background-color:whitesmoke; padding-left:10px;
                                            padding-right:10px; 
                                            font-size:11px; ">Fields marked with <span><sup style=" color:red; ">*</sup> 
                                            must be filled.</strong> 
                                   </td>
                                </tr>      
                                <?php
                                if(!empty($_REQUEST['search_option']))
                                {
                                 $search_option=$_REQUEST['search_option'];
                                 if($search_option=="normal")
                                 {
                                   $normal_check="checked";
                                 $advance_check="";   
                                 $normal_display="display:block;";
                                 $advance_display="display:none;";
                                 }else
                                 {
                                    $normal_check="";
                                 $advance_check="checked";  
                                 $normal_display="display:none;";
                                 $advance_display="display:block;";
                                 }
                                    
                                }else
                                {
                                 $normal_check="checked";
                                 $advance_check="";
                                 
                                 $normal_display="display:block;";
                                 $advance_display="display:none;";
                                 
                                }
                                ?>
                                
                                
                                <tr>
<td colspan="6" style=" width:100%; height:30px; 
margin-bottom:10px; padding-left:10px;   margin-top:10px; color:white;  border-radius:10px;
background-color:lawngreen; color:black; ">
    <table>
        <tr>
            <td>  <input id="normalsearch" style=" width:18px;  height:18px; " onclick="normal_search()" name="normalcheckedradio" value='normalsearch' type="radio" <?php echo $normal_check;?>></td>
            <td><strong> Normal Search  </strong></td>
       
            <td><input id="advancesearch" style=" width:18px;  height:18px; " onclick="advance_search()" name='normalcheckedradio' 
       style="padding-left:10px; " value="advancesearch" type="radio" <?php echo $advance_check;?>></td>
            <td><strong>Advance Search  </strong></td>
        </tr>
    </table>
</td>
                                             </tr>
            <tr>
            <td>
           <table  cellspacing="0" cellpadding="0"  id="normalsearchtable"  style=" width:100%; height:auto; float:left;
                   margin-top:10px; <?php echo $normal_display;?>"><tr>
            <td><b>Class<sup style=" color:red; ">*</sup></b></td> 
            <td style=" width:20px; "><strong>:</strong></td>
            <td>
              <select onchange="class_change_id(this.value)" id="studentclass" class="selectbox">
                    <option id="class_zero_select" value="0">-- Select --</option>
                  <?php  
                          $course_db=  mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
                          while ($fetch_course_data=mysql_fetch_array($course_db))
                          {
                              
                           if(!empty($_REQUEST['Xmlhtppclass']))
                           {
                            $get_course_name=$_REQUEST['Xmlhtppclass'];   
                           }else
                           {
                           $get_course_name="";    
                           }
                              
                           $fetch_course_name=$fetch_course_data['course_name']; 
                           $fetch_course_id=$fetch_course_data['course_id']; 
                           
                           if($get_course_name==$fetch_course_id)
                           {
                             echo "<option value='$fetch_course_id' selected>$fetch_course_name</option>";
                              
                           }else
                           {
                             echo "<option value='$fetch_course_id'>$fetch_course_name</option>";
                              
                           }
                           
                          
                          }
                                   ?>
                </select>
            </td>
            <td><b>Section<sup style=" color:red; ">*</sup></b></td> 
            <td style=" width:20px; "> <strong>: </strong></td>
            <td>
              <select onchange="section_change_id(this.value)" id="studentsection" 
                                          class="selectbox">
                    <?php 
                                  if(empty($_REQUEST['Xmlhtppclass']))
                                  {
                                      echo "<option>--- Select ---</option>";   
                                  }else
                                  {
                 $get_course_name=$_REQUEST['Xmlhtppclass']; 
                 $get_section_id=$_REQUEST['Xmlhttpsection'];
    $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details course_id='$get_course_name' and is_delete='none' ORDER BY section_name ASC");
    while ($fetch_class_data=mysql_fetch_array($section_db))
    {
        $fetch_section_id=$fetch_class_data['section_id'];
        $fetch_section_name=$fetch_class_data['section_name'];
        if($get_section_id==$fetch_section_id)
        {
        echo "<option value='$fetch_section_id' selected>$fetch_section_name</option>";
        }else
        {
         echo "<option value='$fetch_section_id'>$fetch_section_name</option>";   
        }
    } 
   if(empty($fetch_section_id))
   {
    echo "<option>--- Select ---</option>";      
   }
                                      
                                      
                                      
                                  }
                                  
                                  ?>
                </select>
             
             
             <style>
             #student_search_record{ width:400px;border:1px solid silver; height:22px; float:left; cursor:pointer;     }    
             #student_static_search_div{ width:400px; height:auto; position:absolute;
             float:right;  margin-top:23px; background-color: white; border:1px solid silver;
             border-top:0px; display:none; }  
             #search_static_student{ width:390px;  height:18px; border:1px solid red; padding-left:2px;    }
             .list{ width:100%; height:auto; float:left; font-size:11px;   }
             #student_name_tittle{ width:auto; height:auto; float:left; padding-top:4px; padding-left:4px;     }
             #arrow_under_div{ width:10px; height:10px;  float:right; background-repeat:no-repeat; cursor:pointer; 
             margin-top:6px;margin-right:10px; background-image: url('../images/bottom_arrow.jpg'); }
           .redio_button{ width:20px; height:25px; cursor:pointer;   }
           .list li { color: dodgerblue;}
           .list b{ float:left; margin-left:6px;  }
           .list span{ font-size:11px; color:gray;  float:left; margin-left:5px;  }
           
           .add_student_sheet{ width:auto; padding-left:20px; padding-right:20px; background-color:coral;
           border:0px; margin-left:15px; cursor:pointer; height:30px; font-weight:bold;   padding-top:4px; padding-bottom:4px; color:whitesmoke;     }
           .student_father_name span{ font-size:10px; color:gray;  }
             </style>
             
            </td>
               </tr>
               <tr>
                   <td style=" height:15px; "></td>
               </tr>
               <tr>
            <td><b>Student<sup style=" color:red; ">*</sup></b></td> 
            <td>
            <strong>:</strong>  
            
            
            
            </td>
            <td colspan="4">
             <div id="fetch_record" style=" display:none; "></div>
             <div id="temp_student_list" style=" width:auto; float:left;  ">
             <select id="student_id" onchange="student_chage(this.value)" data-placeholder="---Select---" class="chosen-select" tabindex="-1">
                                     <option value="0"></option>
                                     <?php
                                 if((!empty($_REQUEST['Xmlhtppclass']))&&(!empty($_REQUEST['Xmlhttpsection'])))
                                 {
                                 $class_id=$_REQUEST['Xmlhtppclass'];    
                              $section_id=$_REQUEST['Xmlhttpsection'];
                                  
                                $search_result="T1.course_id='$class_id' and T1.section_id='$section_id' and";   
                                    
                                 }else
                                 {
                                  $search_result="";   
                                  }   
                              
                              if(!empty($_REQUEST['student_admission_id']))
                              {
                               $get_student_id=$_REQUEST['student_admission_id'];      
                              }else
                              {
                               $get_student_id="";   
                              }
                              
                   $student_dbs=mysql_query("SELECT *,T1.id as db_id,T1.encrypt_id as t1_encrypt_id FROM student_db as T1"
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
                 . " $db_t1_main_details $search_result T1.is_delete='none'");
         $row=0;
         $fetch_student_num_rows=mysql_num_rows($student_dbs);
         while ($fetch_student_datas=mysql_fetch_array($student_dbs))
         {
$row++;  
$db_id=$fetch_student_datas['db_id'];    
$student_unqiue_id=$fetch_student_datas['student_id']; 
    $student_gender=ucfirst($fetch_student_datas['student_gender']);
$course_name=$fetch_student_datas['course_name'];             
$section_name=$fetch_student_datas['section_name'];
$student_full_name=$fetch_student_datas['student_full_name'];
$student_father_name=$fetch_student_datas['father_name'];
$student_father_mobile_no=$fetch_student_datas['father_mobile_no'];
   
    if($student_gender=="Male")
    {
       $relation="S/O";
    }else
    {
   $relation="D/O";     
    }
  if($get_student_id==$student_unqiue_id)
  {
      echo "<option value='$student_unqiue_id' selected> $student_full_name $relation $student_father_name / $course_name - $section_name  / Mo. $student_father_mobile_no  </option>";
  }else
  {
    echo "<option value='$student_unqiue_id'> $student_full_name $relation $student_father_name /<b> $course_name - $section_name</b> / Mo. $student_father_mobile_no  </option>";
     
  }
  }
                                     ?>
    </select>
             </div>
            
            <input type="button" onclick="static_student()" class="add_student_sheet" value="Add">
            </td>
            
                        </tr>
           </table>
                    
                    
                    
                    
                    
            <table  cellspacing="0" cellpadding="0"  id="advancesearchtable"
                    style=" width:100%; height:auto; <?php echo $advance_display;?> padding-top:7px;" 
                    >
           <tr>
            <td style=" width:90px; height:30px;  padding-left:5px; ">Search By<sup style=" color:red; ">*</sup></td> 
            <td>
            <strong>:</strong> <select id="studentsearchby" class="selectbox_advance">
     <option id="T7.student_full_name" value="T7.student_full_name">Student Name</option>
     <option id="T1.sr_no" value="T1.sr_no">Sr.No</option>
     <option id="T1.roll_no" value="T1.roll_no">Roll Number</option>
     <option id="T1.enrollment_no" value="T1.enrollment_no">Enrollment Number</option>
     <option id="T1.student_id" value="T1.student_id">Admission No.</option>
     <option id="T7.student_gender" value="T7.student_gender">Gender</option>
     <option id="T5.category_name" value="T5.category_name">Category</option>
     <option id="T7.student_dob" value="T7.student_dob">Student Date of Birth</option>
     <option id="T1.admission_date" value="T1.admission_date">Admission Date</option>
     <option id="T1.account_status" value="T1.account_status">Account status</option>
     <option id="T7.student_mobile_no" value="T7.student_mobile_no">Student Mobile No.</option>
     <option id="T7.student_email_id" value="T7.student_email_id">Student Email id</option>
     <option id="T6.father_name" value="T6.father_name">Father Name</option>
     <option id="T6.father_mobile_no" value="T6.father_mobile_no">Father Mobile No.</option>
     <option id="T6.father_email" value="T6.father_email">Father Email id</option>
     <option id="T6.mother_name" value="T6.mother_name">Mother Name</option>
     <option id="T6.mother_mobile_no" value="T6.mother_mobile_no">Mother Number</option>
     <option id="T6.local_parent_name" value="T6.local_parent_name">Local Guardian Name </option>
     <option id="T7.current_address" value="T7.current_address">Address</option>
     <option id="T7.current_city" value="T7.current_city">City</option>
     <option id="T7.current_state" value="T7.current_state">State</option>
                </select>
            
             </td>
           </tr>
           <tr>
               <td style=" height:11px;"></td>
           </tr>
           <tr>
            <td style=" width:60px; height:25px;">Search<sup style=" color:red; ">*</sup></td> 
            <td >
             <?php
             if((!empty($_REQUEST['student_admission_id']))&&(!empty($_REQUEST['search_qq'])))
             {
             $student_id=$_REQUEST['student_admission_id'];
             $student_qq=$_REQUEST['search_qq'];
             
             }else
             {
             $student_id="";
             $student_qq="";
             }
             
             ?>   
            <strong>:</strong>
            <input type="hidden" id="advance_student_id" value="<?php echo $student_id;?>">
            <input type="text" autocomplete="off" value="<?php echo $student_qq;?>" onkeyup="advance_live_autocomplete_search(event,this.value)"
                   name="studentname" placeholder="Search" id="student_search">
           
            
            <div id="automcomplete_first_div">
                               <div id="ajax_auto_complete_div">
                                   <ul id="all_list">
                                       
                                   </ul>   
                               </div>
                           </div>
            
            </td>
            <td style=" width:70px; "> <input type="button" onclick="static_student()" class="add_student_sheet" value="Add">
            </td>
            <td>
            </td>
           </tr>
           </table>
                
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
                                      <?php
                                        if((!empty($_REQUEST['fees_pay_method'])))
                                        {
                                        $fee_pay_option=$_REQUEST['fees_pay_method'];
                                        if($fee_pay_option=="manually_fee")
                                        {
                                        $m_check="checked";
                                        $a_check="";
                                        $m_display="display:block;";
                                        $a_display="display:none;";
                                        }else
                                        {
                                        $m_check="";
                                        $a_check="checked"; 
                                        $m_display="display:none;";
                                        $a_display="display:block;";
                                        }
                                        }else
                                        {
                                        $m_check="";
                                        $a_check=""; 
                                        $m_display="display:none;";
                                        $a_display="display:none;";    
                                        }
                                        ?>   
                                        
                                        <table cellspacing="0" style=" width:auto; margin-left:26px; margin-top:10px; ">
                                            <tr>
                                    <td style=" width: 100px;"><b>Payment Date</b> <sup style=" color:red; ">*</sup> </td>
                                    <td><b>:</b></td>
                                    <td>
                                      <?php 
                                      
date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$date1=date("Y-m-d");

if(!empty($_REQUEST['xmlpayment_date']))
{
 $date1=$_REQUEST['xmlpayment_date'];   
}
{
?>
  
                                     <input type='text' name='paymentdate' id='payment_dates' readonly='readonly'
                                               class='text_box_size_same' 
                                               style="border:1px solid silver; text-align:left;  margin-left:5px; 
                                               padding-left:5px; height:25px; width:110px;    " value='<?php  echo $date1;?>'>
<?php 
}
  ?>                                  
                                    </td>
                                    <td style=" width:40px; "></td>
                                    <td style=" width:120px; ">
                                   <input type="button" id="refereshbutton" value="Refresh">
                                   <input type="button" id="refereshbuttonadvance" value="Refresh">
                                    </td>
                                    <td style=" width:17px; background-color:black; ">
        <input type="radio" id="collectfeeautomatic" onclick="fee_payment_mode('automatic')"
               class="redio_button" name="collectfeetype" value="automatic" <?php echo $a_check;?>>
                                    </td>
                                    
                                    <td style=" width:80px;padding-left:5px;  margin-right:3px; 
         background-color:dodgerblue; text-align: left; color:white; "><strong>Fully Fee Pay</strong></td> 
                                    <td style=" width:10px; "> </td>
                                    <td style=" width:17px; background-color:black;  ">
         <input type="radio" onclick="fee_payment_mode('manually')" name="collectfeetype" class="redio_button" 
                id="collectfeemanually"  value="manually" <?php echo $m_check;?>>
                                    </td>
                                    
                                    <td  style=" width:80px; padding-left:5px;
           background-color:dodgerblue; text-align: left; color:white;"><strong>Manually Pay</strong></td>
                                </tr>  
                                        </table> 
                                    </td>
                                </tr> 
                                <tr>
                                    <td>
                                        
                                       
                                        
                                        <fieldset id="manuallycollectfeedetails" style=" <?php echo $m_display;?>  font-size:12px;
              font-weight:500;margin-left:10px;margin-right:13px;  margin-top:5px;  
              text-align:left;">
        <legend><span style=" color: maroon;  "><b>Manually Collect Fee</b></span></legend>
         
                                        <table style=" height:50px; margin-left:50px;  ">
                                            <tr>
                                                <td>
                                             <strong>Fee</strong> <sup style=" color:red; ">*</sup>       
                                                </td>
                                                <td>
                                               <strong>:</strong> 
                                               <select onchange="manually_fee_group_id(this.value)" id="manuallyfeegroup" class="selectfeegroup" >
                                       <?php
                                       if(empty($_REQUEST['student_admission_id']))
                                       {
                                       ?>
                                                   <option id="manually_select_fee_group" value="0">--Select Fee--</option> 
<?php
                                       }
?>                                      
  <?php
  require_once 'student_pay_fee_manually_fee_class.php';
                                        ?>                
                                                    </select>    
                                                </td>
                                            </tr>   
                                        </table>
 </fieldset>
                                        
          <fieldset id="auotomaticallycollectfeedetails" style=" <?php echo $a_display;?>
                  font-size:12px; font-weight:500;margin-left:10px;margin-right:13px;
                  margin-top:5px; text-align:left;">
              <legend><span style=" color: maroon;  "><b>Fully Collect Fee</b></span></legend>
                                        <table style=" height:50px; margin-left:50px;  ">
                                            <tr>
                                                <td>
                                             <strong>Fee</strong> <sup style=" color:red; ">*</sup>       
                                                </td>
                                                <td>
                                               <strong>:</strong> 
                                               
                                               <?php
                                               if(!empty($_REQUEST['fees_group_id']))
                                               {
                                                $fee_comp_pay_option=$_REQUEST['fees_group_id'];   
                                                if($fee_comp_pay_option=="fully_complete_fee_pay")
                                                {
                                                $coplete_pay="selected";    
                                                }else
                                                {
                                                 $coplete_pay="";   
                                                }
                                               }else
                                               {
                                                 $coplete_pay=""; 
                                               }
                                               ?>
                                               <select onchange="full_complete_pay_fee(this.value)" id="autofeegroup" class="selectfeegroup">
                                                        <option id="zero_select_automatically" value="0">--Select--</option> 
                                                        <option value="fully_complete_fee_pay" <?php echo  $coplete_pay;?>>Complete Pay Fee</option>
                                               </select>    
                                                </td>
                                            </tr>   
                                        </table>
                                        </fieldset>   
                                    </td>
                                </tr>
                            <tr>
                                <td colspan="">
                                    <div id="showiframepaymentsystem" style="border-top:1px solid black;
                                          padding:1%; margin-top:1em; float:left; position:relative; width:98%; height: auto; display:block; ">
                                    <?php
require_once 'finance_manually_all_fee_group_pay.php';
                                    ?>   
                                    </div>   
                                    
                                </td>
                            </tr>
                            
                            </table>
                            <div style=" display:none; " id="student_record_data"></div>                  
                                           
                            <style>
                           .no_record{ width:100%; height:20px; background-color: whitesmoke;
                           color:red; text-align:center; padding-top:10px; font-weight:bold;   }     
                                
                            </style>            
                                        
                                        
                                        
                            <table  cellspacing="0" cellpadding="0" id="table_midle_setdetail" style=" float:right; ">
                                
                                <tr>
                                    <td>
                                   <table cellspacing="0" cellpadding="0" 
                                          style=" width:100%; height:auto;   border:1px solid silver;">
                                
                                <tr>
                                    <td colspan="5" class="td_leftpaddingth" style=" color:white;   font-weight:bold;  
                                        height:25px; background-image:url('finanacephoto/bgblack.png'); ">
                                 Student Details
                                    </td>
                                </tr>
                                <tr id="studentdetailsrecord"  >
                                   <td colspan='6'>
                                   <div id="student_record_fetch" style=" font-size:11px; ">
                                       
                                   <?php
                                    require_once 'student_pay_fee_student_details_php_class.php';
                                   ?>    
                                       
                                       <?php
                                       if(empty($_REQUEST['student_admission_id']))
                                       {
                                       ?>
                                       <input type="hidden" id="student_sr_no">
                                       <input type="hidden" id="student_admission_no">
                                       <input type="hidden" id="student_class_id">
                                       <div class="no_record">Record No Found !!</div>
                                       <?php
                                       }
                                       ?>
                                   </div>
                                   </td>
          
                                </tr>
                                
                            </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                        <div id="previouspamentdetail">
                        <table  cellspacing="0" cellpadding="0" style=" width:100%; border:1px solid silver; height:auto;  margin-top:4px;     ">
                                
                                <tr>
                                    <td colspan='6' class='td_leftpaddingth' style='color:white;   font-weight:bold;  
                                        height:25px; background-image:url("finanacephoto/bgblack.png");'>
                                Previous Payment Details
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="6">
                                        <div id="studentperiviousdetails" >
                                            
                                           <?php
require_once 'student_pay_fee_previous_fee_detail_ajax.php';
                                           ?> 
                                           <?php
                                           if(empty($_REQUEST['student_admission_id']))
                                           {
                                           ?>
                                            <div class="no_record">Record No Found !!</div>
                                       <?php
                                           }
                                       ?>
                                        </div>   
                                    </td>
                                </tr>
                            </table>   
                                        </div>
                                        
                                        
                                        
                                    </td>
                                </tr>  
                                <tr>
                                    <td style=" height:100%; ">
                                        
                                    </td>
                                </tr>
                            </table>
                    </td>
                </tr>
            </table>
                        </div>
                             </td>
                                </tr>
                               
                               
                                <tr>
                                    <td style=" height:20px; float:left; "></td> 
                                </tr>
                            </table>
         </div>
       
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
    
   $("#payment_dates").datepicker({ 
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
             
               
                 <link rel="stylesheet" href="../javascript/combosearch/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
    #parent_id_chosen{ width:400px; }
    #hostel_id_chosen{ width:330px; }
    #hostel_room_id_chosen{ width:330px; }
    #student_id_chosen { width:430px; }
    .chosen-results{ font-size:11px; }
  </style>          
  <script src="../javascript/combosearch/chosen.jquery.js" type="text/javascript"></script>
  <script src="../javascript/combosearch/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
  
        
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }

  </script>
            
        
        
         <div id="attechfotter" style=" width:100%; height:22px; position:fixed; bottom:0px; ">
          <?php 
              include 'financefotter.php';
            ?>
        </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>