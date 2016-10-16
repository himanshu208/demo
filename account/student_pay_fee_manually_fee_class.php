<?php
if((!empty($_REQUEST['student_admission_id'])))
{
    $stduent_id=$_REQUEST['student_admission_id'];
    
    if(!empty($_REQUEST['fees_group_id']))
    {
    $xml_fee_group_id=$_REQUEST['fees_group_id'];   
    }else
    {
     $xml_fee_group_id="zero";   
    }
   if($xml_fee_group_id=="zero")
   {
     echo "<option id='manually_select_fee_group' value='0' selected>--Select Fee--</option>";
   }else
   {
      echo "<option id='manually_select_fee_group' value='0'>--Select Fee--</option>"; 
   }
    
    
    $student_db=mysql_query("SELECT * FROM student_db WHERE $db_main_details student_id='$stduent_id'");
    $student_data=mysql_fetch_array($student_db);
    $student_num_rows=mysql_num_rows($student_db);
    if((!empty($student_data))&&($student_data!=null)&&($student_num_rows!=0))
    {
    $class_id=$student_data['course_id'];
    $category_id=$student_data['category_id'];
    $student_admission=$student_data['admission_status'];
   
    
    $fee_amount_db=mysql_query("SELECT *,T1.id as t1_id FROM financefeeamount as T1"
         . " LEFT JOIN financeaddfee as T2 ON T1.fee_id=T2.fee_id "
         . " LEFT JOIN financeaddfeegroup as T3 ON T1.fee_group_id=T3.fee_group_id"
         . " LEFT JOIN course_db as T4 ON T1.course_id=T4.course_id WHERE "
            . " $db_t1_main_details T1.fee_assign_to='class_fee_group' and T1.course_id='$class_id' and T1.action='active' "
            . " OR $db_t1_main_details T1.fee_assign_to='student_wise' and T1.student_id='$stduent_id' and T1.action='active'"); 
    $fetch_fee_group_num_rows=mysql_num_rows($fee_amount_db);
    if($fetch_fee_group_num_rows!=0)
    {
     if($xml_fee_group_id=="all_fee_group_pay")
    {    
    echo "<option id='id_all_fee_group_pay' value='all_fee_group_pay' selected>All Fees Pay</option>";
    }else
    {
      echo "<option id='id_all_fee_group_pay' value='all_fee_group_pay'>All Fees Pay</option>";
      
    }
    }
 
    while ($fetch_fee_amount_data=mysql_fetch_array($fee_amount_db))
   {
       $fetch_fee_id=$fetch_fee_amount_data['fee_id'];
       $fetch_group_id=$fetch_fee_amount_data['fee_group_id'];
       $fetch_applicable_status=$fetch_fee_amount_data['applicable_fee'];
       $transport_hostel_check=$fetch_fee_amount_data['hostelandtransportstatus'];
       $fetch_fee_group_id=$fetch_fee_amount_data['fee_group_id'];
       $fetch_fee_group_name=ucwords($fetch_fee_amount_data['feegroupname']);
       $fetch_fee_name=$fetch_fee_amount_data['fee_name'];
       
       if(!empty($fetch_applicable_status))
        {
           $student_admission=$student_data['admission_status']; 
        }else
        {
         $fetch_applicable_status="1";   
         $student_admission="1";
        }
      if($fetch_applicable_status==$student_admission)
        { 
       if(($transport_hostel_check=="active")&&($fetch_fee_name=="Transport Fee"))
       {
           
       $student_db=mysql_query("SELECT *,T1.encrypt_id as ad_id,"
                 . "T10.description as transport_description FROM student_db as T1"
                 . " INNER JOIN student_allot_transport as T10 ON T1.transport_id=T10.transport_unique_id WHERE "
                 . " $db_t1_main_details T1.student_id='$stduent_id' and T1.is_delete='none' and T10.is_delete='none'");
         $fetch_student_record=mysql_fetch_array($student_db);
         $fetch_student_num_rows=mysql_num_rows($student_db);   
         if((!empty($fetch_student_record))&&($fetch_student_record!=null)&&($fetch_student_num_rows!=0))
         {
     if($xml_fee_group_id==$fetch_fee_group_id)
    {     
          echo "<option id='$fetch_fee_group_id' value='$fetch_fee_group_id' selected>$fetch_fee_group_name</option>";  
    }else
    {
      echo "<option id='$fetch_fee_group_id' value='$fetch_fee_group_id'>$fetch_fee_group_name</option>";     
    }
         }
         }else
        if(($transport_hostel_check=="active")&&($fetch_fee_name=="Hostel Fee"))
       {
           
       $student_db=mysql_query("SELECT *,T1.encrypt_id as ad_id,T9.description as hostel_description"
                 . " FROM student_db as T1"
                 . " INNER JOIN student_allot_hostel as T9 ON T1.hostel_id=T9.hostel_unique_id WHERE "
                 . " $db_t1_main_details T1.student_id='$stduent_id' and T1.is_delete='none' and T9.is_delete='none'");
         $fetch_student_record=mysql_fetch_array($student_db);
         $fetch_student_num_rows=mysql_num_rows($student_db);   
         if((!empty($fetch_student_record))&&($fetch_student_record!=null)&&($fetch_student_num_rows!=0))
         {
          if($xml_fee_group_id==$fetch_fee_group_id)
    {     
          echo "<option id='$fetch_fee_group_id' value='$fetch_fee_group_id' selected>$fetch_fee_group_name</option>";  
    }else
    {
      echo "<option id='$fetch_fee_group_id' value='$fetch_fee_group_id'>$fetch_fee_group_name</option>";     
    }    
         }
         }else
         {    
         if($xml_fee_group_id==$fetch_fee_group_id)
    {     
          echo "<option id='$fetch_fee_group_id' value='$fetch_fee_group_id' selected>$fetch_fee_group_name</option>";  
    }else
    {
      echo "<option id='$fetch_fee_group_id' value='$fetch_fee_group_id'>$fetch_fee_group_name</option>";     
    }
         }
        }
   }
   $check_due_amount=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE student_id='$stduent_id' and course_id='$class_id' and is_delete='none'");
   $check_array_value=mysql_fetch_array($check_due_amount);
   $check_num_rows=mysql_num_rows($check_due_amount);
   
   if((!empty($check_array_value))&&($check_array_value!=null)&&($check_num_rows!=0))
   {
        if($xml_fee_group_id=="due_amount")
    {      
       echo "<option  value='due_amount' selected>Due/(-) Paid Amount</option>";  
    }else
    {
      echo "<option value='due_amount'>Due/(-) Paid Amount</option>";     
    }
       
   }
    if($xml_fee_group_id=="other_fee")
    { 
   echo "<option id='other_fee' value='other_fee' selected>Other Fee</option>";
    }else
    {
       echo "<option id='other_fee' value='other_fee'>Other Fee</option>";  
    }
    }
    
}
?>