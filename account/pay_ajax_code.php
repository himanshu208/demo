<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php 
require_once '../connection.php';

//normal search class wise

if((!empty($_REQUEST['class_id']))&&(!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))
        &&(!empty($_REQUEST['session_id'])))
{
 $organization_id=$_REQUEST['org_id'];
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $class_id=$_REQUEST['class_id'];
 
 echo "<div id='section_record'>
<option value='0'>--Select--</option>     
";
 $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$organization_id'
     and branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id' and is_delete='none'");
 while ($fetch_section_data= mysql_fetch_array($section_db))
 {
   $fetch_section_id=$fetch_section_data['section_id'];
   $fetch_section_name=$fetch_section_data['section_name'];
   echo "<option value='$fetch_section_id'>$fetch_section_name</option>";
 }
 if(empty($fetch_section_id))
 {
   echo "<option value='0'>Record no found !</option>";
 }
    
 echo "</div><div id='student_data'>";
 echo '<option value="0"></option>';
$student_db=mysql_query("SELECT *,T1.id as db_id,T1.encrypt_id as ad_id,T9.description as hostel_description,"
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
                 . " T1.organization_id='$organization_id'
     and T1.branch_id='$branch_id' and T1.session_id='$session_id' and T1.course_id='$class_id' and T1.is_delete='none'");
         
while ($fetch_student_datas=mysql_fetch_array($student_db))
{
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
    
  echo "<option value='$student_unqiue_id'> $student_full_name $relation $student_father_name /<b> $course_name - $section_name</b> / Mo. $student_father_mobile_no  </option>";
       
}
if(empty($student_unqiue_id))
{
   echo "<option value='0'>Record No Found !!</option>"; 
}

echo"</div>"; 
    
    
    
}




//normal search section wise
if((!empty($_REQUEST['temp_class_id']))&&(!empty($_REQUEST['temp_section_id']))&&(!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id'])))
{
 $organization_id=$_REQUEST['org_id'];
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $class_id=$_REQUEST['temp_class_id'];
 $section_id=$_REQUEST['temp_section_id'];
 echo "<div id='student_data'>";
echo '<option value="0"></option>';
$student_db=mysql_query("SELECT *,T1.id as db_id,T1.encrypt_id as ad_id,T9.description as hostel_description,"
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
                 . " T1.organization_id='$organization_id'
     and T1.branch_id='$branch_id' and T1.session_id='$session_id' and T1.course_id='$class_id' and "
        . " T1.section_id='$section_id'  and T1.is_delete='none'");
         
while ($fetch_student_datas=mysql_fetch_array($student_db))
{
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
    
  echo "<option value='$student_unqiue_id'> $student_full_name $relation $student_father_name /<b> $course_name - $section_name</b> / Mo. $student_father_mobile_no  </option>";
       
}
if(empty($student_unqiue_id))
{
   echo "<option value='0'>Record No Found !!</option>"; 
}

echo"</div>"; 
    
    
    
}



//fee payament advance search student
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))
        &&(!empty($_REQUEST['search_by']))&&(!empty($_REQUEST['search_qq'])))

{
    $organization_id=$_REQUEST['org_id'];
    $branch_id=$_REQUEST['branch_id'];
    $session_id=$_REQUEST['session_id'];
    $search_by=$_REQUEST['search_by'];
    $search_qq_temp=trim($_REQUEST['search_qq']);
    $search_qq=preg_replace('/\s+/', ' ',$search_qq_temp); 

 
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
                 . " LEFT JOIN house_db as T11 ON T1.house_id=T11.house_id WHERE "
                 . " $db_t1_main_details $search_by LIKE '%$search_qq%' and T1.is_delete='none' ORDER BY T7.student_full_name ASC");
         
while ($fetch_student_data=mysql_fetch_array($student_db))
{
    $fetch_student_id=$fetch_student_data['student_id'];
    $fetch_student_name=$fetch_student_data['student_full_name'];
    $fetch_father_name=$fetch_student_data['father_name'];
   {
  ?> 
<li onclick="student_record('<?php  echo $fetch_student_id;?>','<?php  echo $fetch_student_name;?>')">
  <?php 
   }
     echo "<a class='ancor_student_id' style='font-size:0px;'>$fetch_student_id</a>
           <a class='ancor_student_name' style='font-size:0px;'>$fetch_student_name</a>
   <p class='student_search'>$fetch_student_name</p> <b>So/</b> <p class='student_father_name'><span>$fetch_father_name</span></p>
   <input type='hidden' id='student_name_$fetch_student_id' value='$fetch_student_name'>
    </li>"; 
    
}
if(empty($fetch_student_id))
{
    echo "<li style='color:red; text-align:center;'><p>Record no found !!</p></li>"; 
}
    
    
    
}





//view student details
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))
        &&(!empty($_REQUEST['student_id'])))
{
    $organization_id=$_REQUEST['org_id'];
    $branch_id=$_REQUEST['branch_id'];
    $session_id=$_REQUEST['session_id'];
    $student_id=$_REQUEST['student_id'];
    
 $organisation_db=mysql_query("SELECT * FROM organization_db WHERE organization_id='$organization_id'"); 
 $fetch_org_data=mysql_fetch_array($organisation_db);
 $fetch_org_num_rows=mysql_num_rows($organisation_db);
if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_rows!=0))
{
$fetch_currency=$fetch_org_data['currency'];
}
    
    
    echo "<div id='student_profile_data'>";
$student_data=mysql_query("SELECT *,T1.encrypt_id as ad_id,T9.description as hostel_description,"
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
                 . " $db_t1_main_details T1.student_id='$student_id' and T1.is_delete='none'");
         

    $fetch_student_data= mysql_fetch_array($student_data);
    $fetch_student_num_rows=  mysql_num_rows($student_data);
    if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
    {
       
        
        $fetch_student_id=$fetch_student_data['student_id'];
        $fetch_student_sr_no=$fetch_student_data['sr_no'];
        $admission_no=$fetch_student_data['admission_no'];
        $fetch_student_name=$fetch_student_data['student_full_name'];
        $fetch_student_mobile_no=$fetch_student_data['student_mobile_no'];
        $fetch_student_father_name=$fetch_student_data['father_name'];
        $fetch_student_father_mob_no=$fetch_student_data['father_mobile_no'];
        $fetch_local_parents_name=$fetch_student_data['local_parent_name'];
        $fetch_local_parents_mob_no=$fetch_student_data['local_parent_mobile_no'];
        $fetch_studnet_dob=$fetch_student_data['student_dob'];
        $student_photo=$fetch_student_data['student_photo'];
        if(empty($student_photo))
        {
         $student_photo="images/no_avilable_image.gif";   
        }else
        {
        $student_photo=$student_photo;    
        }
        
        $fetch_class_id=$fetch_student_data['course_id'];
        $fetch_section_id=$fetch_student_data['section_id'];
        $fetch_category_id=$fetch_student_data['category_id'];
        $fetch_session_id=$fetch_student_data['session_id'];
        $fetch_student_roll_no=$fetch_student_data['roll_no'];
        $student_gender=  ucfirst($fetch_student_data['student_gender']);
        
$course_name=$fetch_student_data['course_name'];             
$section_name=$fetch_student_data['section_name'];
$session_name=$fetch_student_data['session_name'];
$category_name=$fetch_student_data['category_name'];
$house_name=ucwords($fetch_student_data['house_name']);
        
        
        echo "<table cellspacing='0' cellpadding='0' style=' width:100%; height:auto;   border:1px solid silver;      '>
                                
                                <tbody>
                                <tr id='studentdetailsrecord'>

    <tr>
                                    <td style='width:90px;   height:20px; padding-left:3px;  '>
                                    <b>Sr/Form No</b>
                                    </td>  
                                    <td style='width:50px;'>
                                        <strong>: $fetch_student_sr_no
                                     <input type='hidden' value='$fetch_student_sr_no' id='student_sr_no'></strong>
                                    </td>
                                    <td style='width:90px;'>
                                   <b> Admission No.</b>
                                    </td>  
                                    <td style='width:80px;'>
                                        <strong>: $admission_no  
   <input type='hidden' value='$fetch_student_id' id='student_admission_no'></strong>
     <input type='hidden' id='student_class_id' value='$fetch_class_id'>                               
     </td>
     
                                    <td rowspan='5' style='width:85px; '>
                                        <div style='width:80px; height:95px; border:1px solid silver; float:right;
                                             margin-right:5px;   margin-top:2px;   '>
                                      <img src='../$student_photo' style='width:80px; height:95px;'>      
                                        </div>
                                    </td>
                                </tr>
     <tr>
     <td style='width:90px;  height:20px; padding-left:3px;  '>
                                    <b>Class</b>
                                    </td>  
                                    <td style='width:100px;'>
                                        <strong>:</strong> $course_name
                                    </td>
                                    <td style='width:90px;'>
                                   <b>Section</b>
                                    </td>  
                                    <td style='width:80px;'>
                                        <strong>:</strong> $section_name
                                  
     </td>
     </tr>
   <tr>
     <td style='width:90px;  height:20px; padding-left:3px;  '>
                                    <b>Roll No.</b>
                                    </td>  
                                    <td style='width:50px;'>
                                        <strong>:</strong> $fetch_student_roll_no
                                    </td>
                                    <td style='width:90px;'>
                                   <b>Session</b>
                                    </td>  
                                    <td style='width:80px;'>
                                        <strong>:</strong> $session_name
                                  
     </td>
     </tr>
     
                                <tr>
                                    <td style='width:90px;height:20px; padding-left:3px; '>
                                        <b>Student Name</b>
                                    </td>  
                                    <td colspan='3'>
                                       <strong>:</strong> $fetch_student_name
                                    </td>
                                    
                                </tr> 
                                  <tr>
                                    <td style='width:90px;height:20px; padding-left:3px;   '>
                                    <b>Mobile No.</b>
                                    </td>  
                                    <td colspan='3' style=' width:auto;'>
                                       <strong>:</strong> $fetch_student_mobile_no
                                    </td>
                                    
                                </tr>
   <tr>
     <td style='width:90px;  height:20px; padding-left:3px;  '>
                                   <b>Gender</b>
                                    </td>  
                                    <td style='width:50px;'>
                                        <strong>:</strong> $student_gender
                                    </td>
                                    <td style='width:90px;'>
                                   <b>Category</b>
                                    </td>  
                                    <td COLSPAN='2'>
                                        <strong>:</strong> $category_name
   <SPAN style='padding-left:25px;'><b>D.O.B</b> <strong>:</strong> $fetch_studnet_dob</SPAN>
                                  
     </td>
    
     </tr>
                              <tr>
                                    <td style='width:90px;height:20px; padding-left:3px;   '>
                                       <b> Father Name</b>
                                    </td>  
                                    <td colspan='2' style=' width:auto;'>
                                       <strong>:</strong> $fetch_student_father_name
                                    </td>
                                    <td style='width:90px;height:20px; padding-left:3px;   '>
                                    <b>Mobile No.</b>
                                    </td>  
                                    <td colspan='2' style=' width:auto;'>
                                       <strong>:</strong> $fetch_student_father_mob_no
                                    </td>
                                </tr>";
                                 if(!empty($fetch_local_parents_name))
                                 {
                                  echo"<tr>
                                    <td style='width:90px;height:20px; padding-left:3px;   '>
                                     <b>Local Guardian</b>
                                    </td>  
                                    <td colspan='2' style=' width:auto;'>
                                       <strong>:</strong> $fetch_local_parents_name
                                    </td>
                                    <td style='width:90px;height:20px; padding-left:3px;   '>
                                   <b> Mobile No.</b>
                                    </td>  
                                    <td colspan='2' style=' width:auto;'>
                                       <strong>:</strong> $fetch_local_parents_mob_no
                                    </td>
                                </tr>";
                                 }
                                 
    echo" <tr><td style='width:100px; height:10px;'></td></tr>

        
   </tr>
                                
                            </tbody></table>";    
        
    }else
    {
        echo "<div class='record_no_found'> Record No Found !!</div>";   
    }
    
    
echo "</div>
    
<div id='previous_fee_payment_redord'>
<table cellspacing='0' cellpadding='0' class='fee_table_class'>";


$fee_payment_db=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$organization_id' and branch_id='$branch_id'
        and session_id='$session_id' and student_id='$fetch_student_id' and is_delete='none'");
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

$fetch_due_amount_db=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE organization_id='$organization_id' and branch_id='$branch_id'
        and session_id='$session_id' and student_id='$fetch_student_id' and is_delete='none'");

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









//fee manually fee selected
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))
        &&(!empty($_REQUEST['student_admission_id']))&&(!empty($_REQUEST['class_unique_id'])))

{
    $organization_id=$_REQUEST['org_id'];
    $branch_id=$_REQUEST['branch_id'];
    $session_id=$_REQUEST['session_id'];
    $stduent_id=$_REQUEST['student_admission_id'];
    $class_id=$_REQUEST['class_unique_id'];
    echo "<option id='manually_select_fee_group' value='0'>-- Select fee group --</option>";
    
   
    $fee_student_amount_db=mysql_query("SELECT * FROM financefeeamount WHERE organization_id='$organization_id' and branch_id='$branch_id'
       and session_id='$session_id' and fee_assign_to='student_fee_group' and student_id='$stduent_id' and action='active'");
  
     $fee_amount_db=mysql_query("SELECT * FROM financefeeamount WHERE organization_id='$organization_id' and branch_id='$branch_id'
       and session_id='$session_id' and fee_assign_to='class_fee_group' and course_id='$class_id' and action='active'");
  
    $fetch_student_particular_fee_num_rows=mysql_num_rows($fee_student_amount_db);
    $fetch_fee_group_num_rows=mysql_num_rows($fee_amount_db);
    if($fetch_fee_group_num_rows!=0)
    {
        echo "<option id='id_all_fee_group_pay' value='all_fee_group_pay'>All Fee Group Pay</option>";    
    }
    if($fetch_student_particular_fee_num_rows!=0)
    {
    if($fetch_fee_group_num_rows==0)
    {
      echo "<option id='id_all_fee_group_pay' value='all_fee_group_pay'>All Fee Group Pay</option>";  
    }   
    }
    
    
   while ($fetch_fee_amount_datas=mysql_fetch_array($fee_student_amount_db))
   {
       $fetch_fee_id=$fetch_fee_amount_datas['fee_id'];
       $fetch_group_id=$fetch_fee_amount_datas['fee_group_id'];
       
       
       $fee_group_db=mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$organization_id'
               and branch_id='$branch_id' and session_id='$session_id' and fee_group_id='$fetch_group_id' and fee_id='$fetch_fee_id' and action='active'");
       $fetch_fee_group_data=mysql_fetch_array($fee_group_db);
       $fee_group_num_rows=mysql_num_rows($fee_group_db);
       if((!empty($fetch_fee_group_data))&&($fetch_fee_group_data!=null)&&($fee_group_num_rows!=0))
       {
       $fetch_fee_group_id=$fetch_fee_group_data['fee_group_id'];
       $fetch_fee_group_name=$fetch_fee_group_data['feegroupname'];
       
        echo "<option id='$fetch_fee_group_id' value='$fetch_fee_group_id'>$fetch_fee_group_name</option>";  
       }
       
   }
   
    
    
    while ($fetch_fee_amount_data=mysql_fetch_array($fee_amount_db))
   {
       $fetch_fee_id=$fetch_fee_amount_data['fee_id'];
       $fetch_group_id=$fetch_fee_amount_data['fee_group_id'];
       $fetch_applicable_status=$fetch_fee_amount_data['applicable_fee'];
       
       $fee_group_db=mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$organization_id'
               and branch_id='$branch_id' and session_id='$session_id' and fee_group_id='$fetch_group_id' and fee_id='$fetch_fee_id'");
       $fetch_fee_group_data=mysql_fetch_array($fee_group_db);
       $fee_group_num_rows=mysql_num_rows($fee_group_db);
       if((!empty($fetch_fee_group_data))&&($fetch_fee_group_data!=null)&&($fee_group_num_rows!=0))
       {
       $fetch_fee_group_id=$fetch_fee_group_data['fee_group_id'];
       $fetch_fee_group_name=$fetch_fee_group_data['feegroupname'];
       
       $fee_db=mysql_query("SELECT * FROM financeaddfee WHERE organization_id='$organization_id'
               and branch_id='$branch_id' and session_id='$session_id' and fee_id='$fetch_fee_id'");
       while ($fetch_fee_data=mysql_fetch_array($fee_db))
       {
        
       $fetch_fee_name=$fetch_fee_data['fee_name'];
       if($fetch_fee_name=="Transport Fee")
       {
          
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
                 . " $db_t1_main_details T1.student_id='$stduent_id' and T1.is_delete='none'");
         
         $fetch_student_record=mysql_fetch_array($student_db);
         $fetch_student_num_rows=mysql_num_rows($student_db);   
         if((!empty($fetch_student_record))&&($fetch_student_record!=null)&&($fetch_student_num_rows!=0))
         {
           
         $fetch_route_id=$fetch_student_record['route_id'];
         $fetch_vehicle_type_id=$fetch_student_record['vehicle_type_id'];
         $fetch_vehicle_reg_id=$fetch_student_record['vehicle_reg_id'];
         
         if((!empty($fetch_route_id))&&(!empty($fetch_vehicle_type_id))&&(!empty($fetch_vehicle_reg_id)))
         {
          echo "<option id='$fetch_fee_group_id' value='$fetch_fee_group_id'>$fetch_fee_group_name</option>";  
            
         }
         }
         
         
       }else
         if($fetch_fee_name=="Hostel Fee")
       {
         
    
       $student_data=mysql_query("SELECT *,T1.encrypt_id as ad_id,T9.description as hostel_description,"
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
                 . " $db_t1_main_details T1.student_id='$stduent_id' and T1.is_delete='none'");
         
         $fetch_student_record=mysql_fetch_array($student_db);
         $fetch_student_num_rows=mysql_num_rows($student_db);   
         if((!empty($fetch_student_record))&&($fetch_student_record!=null)&&($fetch_student_num_rows!=0))
         {
           
         $fetch_hostel_id=$fetch_student_record['hostel_id'];
         $fetch_hostel_type_id=$fetch_student_record['hostel_type_id'];
         $fetch_hostel_room_no=$fetch_student_record['hostel_room_no'];
         
         if((!empty($fetch_hostel_id))&&(!empty($fetch_hostel_type_id))&&(!empty($fetch_hostel_room_no)))
         {
          echo "<option id='$fetch_fee_group_id' value='$fetch_fee_group_id'>$fetch_fee_group_name</option>";  
            
         }
         }      
             
       }else
       if(($fetch_applicable_status=="new")&&($fetch_fee_name!="Transport Fee")&&($fetch_fee_name!="Hostel Fee"))
       {
       $student_db=mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id'
               and branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id' and student_id='$stduent_id' and admission_status='new'");  
         $fetch_student_record=mysql_fetch_array($student_db);
         $fetch_student_num_rows=mysql_num_rows($student_db);   
         if((!empty($fetch_student_record))&&($fetch_student_record!=null)&&($fetch_student_num_rows!=0))
         {
          echo "<option id='$fetch_fee_group_id' value='$fetch_fee_group_id'>$fetch_fee_group_name</option>";  
         }  
           
       }else
       {    
         if(($fetch_fee_name!="Transport Fee")&&($fetch_fee_name!="Hostel Fee"))  
         {
         echo "<option id='$fetch_fee_group_id' value='$fetch_fee_group_id'>$fetch_fee_group_name</option>";   
         }
       }
       }
       }
       
   }
   
   
   $check_due_amount=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE organization_id='$organization_id' and branch_id='$branch_id'
       and session_id='$session_id' and student_id='$stduent_id' and course_id='$class_id' and is_delete='none'");
   $check_array_value=mysql_fetch_array($check_due_amount);
   $check_num_rows=mysql_num_rows($check_due_amount);
   
   if((!empty($check_array_value))&&($check_array_value!=null)&&($check_num_rows!=0))
   {
       echo "<option id='due_amount' value='due_amount'>Due/(-) Paid Amount</option>";  
   }
   
   echo "<option id='other_fee' value='other_fee'>Other Fee</option>";
   
}


?>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>