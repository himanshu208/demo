
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

<?php 
$message_show="";
if(!empty($_POST['adddiscountparticularstudent']))
{
$discount_type=$_POST['discount_type'];
$discount=$_POST['discount'];
$discount_description=$_POST['description'];
$update_db_id=$_POST['update_db_id'];
$session_id=$_POST['use_inset_session_id'];
    
$update_discount_category_db=mysql_query("UPDATE financefeediscountparticularstudent SET discount_type='$discount_type',feediscount='$discount',description='$discount_description'"
        . "WHERE id='$update_db_id' and organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$session_id' and action='active'");    
  
if((!empty($update_discount_category_db))&&($update_discount_category_db))
{
    $message_show='<div id="error-msg">Record update successfully complete.</div>';  
}else
{
 $message_show='<div id="error-msg">Request failed,please try again.</div>';   
}
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
        <title>Edit Fee Details</title>
      
          <script type="text/javascript">
              function reset_button()
              {
        var r=confirm("Are you sure you want to refresh current page");
if (r==true)
  {       
        location.reload(); 
     
        }
              }
          </script>
          
          
          <style>
        .feegroup_list{ width:auto; height:auto; padding-top:6px;  float:left; padding-left:10px;    }
    .select_all{ width:100%; height:auto;  padding-left:10px;border-bottom:1px solid skyblue; font-weight:bold;    }
    
   #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial; font-weight:800;  font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{ width:1150px; height:auto;  margin:0 auto;  }
    #table_midle_set{ width:100%; height:180px; margin:0 auto; margin-top:10px; border:1px solid #555555; float:left;    
    }
    .td_leftpaddingth{ padding-left:10px; padding-top: 4px;}
    #top_add_view_div{ width:190px; height:18px; padding-top:5px; padding-left:10px;
                       padding-right:10px; margin-top:-5px; 
                   background-color: #FFFFCC;
                       float:right; margin-right:3px; color:black; text-align:center;      }
    .td_leftpadding{ padding-right:10px;text-align:right;  }
    .textsize_same{ border:1px solid gray; margin-left:5px; }
     .add_button_reset_button{ width:70px; height:28px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-color:dodgerblue; border:0px;  float:right; cursor:pointer;
    margin-top:10px; margin-bottom:10px;  }
    #error-msg{ width:100%; height:22px;padding-top:3px; background-color:#FFFFCC; 
                margin-top:10px; float:left; color:#380000; text-align: center;
                background-image:url('finanacephoto/skyblue.pg'); font-size: 12px; border:1px solid silver;     }
    #table_midle_settable{ width:650; height:auto;  float:left;  }
    .selectsize_same{ width:165px; }
    .text_sizebox{ width:160px; border:1px solid silver;   }
    #particularstudentname{ width:180px; height:auto; position:absolute;float:left; display:none;  }
    #particularstudentfathername{ width:162px; height:20px; position:absolute;  display:none; }
    #particularstudentdateofbirth{ width:162px; height:20px; position:absolute; margin:0; padding:0; display:none;   }
     .listbutton{ width:100%; height:100%; text-align:left;background-color:whitesmoke; 
                    border:1px solid whitesmoke;     }
        .listbutton:hover{ background-color:silver;  border:1px solid silver; cursor:pointer;  }
 ul{ margin: 0; padding: 0;width:100%; height:auto;list-style:none;color: black; background-color: white;  }
             li{ margin: 0; padding: 0;width:auto; height:20px; padding-top:5px;  font-weight:100;  
                 border-bottom:1px solid silver;
                   color: black; border-left:1px solid silver;border-right:1px solid silver; }
             li:hover{ background-color: whitesmoke; color:blue; }
       .sli{ width:100%; height:auto; font-size:0px;   }
        .hsli{ width:100%; height:auto; height:22px; text-indent:5px;  }
        .radio_button{ width:auto; height:20px; position:relative; top:7px;   }
        #normal_search_div{ width: 350px; height:150px; }
        #student_details_div_tag{ width:600px; height:150px;  float:right;   }
        .select_styling{ width:170px; height:22px;  }
        #student_data_table{ width:500px; height:auto; float:right; font-size:12px;    }
        #ajax_loader_show{ display: none;}
        #all_student_details{ width:415px; display:none;  float:left; max-height:400px; overflow-y:auto;   
                              position:absolute; }
        #all_student_details li{ padding-left:4px; cursor:pointer;  padding-right:4px; padding-top:4px;   }
        .search{ width:437px; height:18px;  }
        p{ margin: 0; padding:0; float:left;  }
        #advance_search{ display:none; }
        .select_box_Styling { width:230px; height: 24px; }
        .search_text_box{ width:415px; height:18px;  }
        sup { color:red; }
        .error_msg{  width:600px; height:20px;padding-top:3px; background-color:#FFFFCC; font-weight:100;  
                margin-top:10px;color:#380000; text-align: center; margin:0 auto; padding-top:8px;  
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
        strong { font-size: 12px;}
    </style>
          
    </head>
    <body style="margin: 0; padding:0; ">
         <input id="organization_id" name='organization_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
         <input id="branch_id" name='branch_id' value="<?php  echo $fetch_branch_id;?>" type="hidden">
          <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
          
      <?php  include_once 'edit_header_page.php';?>
               
                          <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">  
           
        <div class="first_work_div">
        <div class="edit_title_heading">Edit Student Discount Details</div>
          <?php 
            if(!empty($_REQUEST['token_id']))
            {
               $encrypt_id=$_REQUEST['token_id'];
           $particular_student_discount_db=mysql_query("SELECT * FROM financefeediscountparticularstudent WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and encrypt_id='$encrypt_id' and action='active'");    
            $fetch_particular_student_data=  mysql_fetch_array($particular_student_discount_db);
            $fech_particular_num_rows=  mysql_num_rows($particular_student_discount_db);
            if((!empty($fetch_particular_student_data))&&($fetch_particular_student_data!=null)&&($fech_particular_num_rows!=0))
            {
             $fetch_update_db_id=$fetch_particular_student_data['id'];
            $fetch_student_id=$fetch_particular_student_data['student_id'];
            $fetch_course_id=$fetch_particular_student_data['course_id'];
            $fetch_fee_group_id=$fetch_particular_student_data['fee_group_id'];
            $discount_type=$fetch_particular_student_data['discount_type'];
            $discount=$fetch_particular_student_data['feediscount'];
            $discount_description=$fetch_particular_student_data['description'];
              //fee group
                       $fee_group_db=mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and fee_group_id='$fetch_fee_group_id'");
                            $fetch_fee_group_data=  mysql_fetch_array($fee_group_db);
                            $fetch_fee_group_num_rows=  mysql_num_rows($fee_group_db);
                            if((!empty($fetch_fee_group_data))&&($fetch_fee_group_data!=null)&&($fetch_fee_group_num_rows!=0))
                            {
                              $fee_group_name=$fetch_fee_group_data['feegroupname']; 
                            }else
                            {
                             $fee_group_name="Missing Record";   
                            }   
                            {
            ?>
         <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                               <tr>
                                    <td colspan="3">
                                      <?php  echo $message_show;?>
                                    </td>
                                </tr> 
                                <tr>
                                    <td  class="td_leftpaddingth" style=" height:10px; " colspan="2"> 
                                    <strong style="color:gray;background-color:whitesmoke; padding-left:10px; padding-right:10px;
                                            font-size:11px; ">Fields marked with <span><sup style=" color:red; ">*</sup> 
                                            must be filled.</strong>    
                                    </td>
                                </tr>
                                
                                
                                          <tr>
                                              <td style=" height:10px; "></td>
                                          </tr>
                                          <tr>
                                              <td colspan="2" style=" font-size: 12px;">
                                                   <fieldset style=" font-size:12px;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Student Detail</span></legend>
                                      
                                      
                                    <?php 
                                      
                                      echo"<div id='student_search_data'>";
   $student_db=mysql_query("SELECT * FROM student_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'
           and session_id='$fecth_session_id_set' and course_id='$fetch_course_id' and student_id='$fetch_student_id'");
   while ($fetch_student_details=mysql_fetch_array($student_db))
   {
   $fetch_student_name=$fetch_student_details['student_full_name'];
   $fetch_student_father_name=$fetch_student_details['father_name'];
   $fetch_student_id=$fetch_student_details['student_id'];
   $fetch_class_id=$fetch_student_details['course_id'];
   $fetch_section_id=$fetch_student_details['section_id'];
   $fetch_session_id=$fetch_student_details['session_id'];
   $fetch_category_id=$fetch_student_details['category_id'];
   $fetch_roll_no=$fetch_student_details['roll_no'];
   $fetch_student_gender= ucfirst($fetch_student_details['student_gender']);
   $fetch_studnet_dob= $fetch_student_details['student_dob'];
   $fetch_student_mobile_no=$fetch_student_details['student_mobile_no'];
   $fetch_father_mobile_no=$fetch_student_details['father_mobile_no'];
   $fetch_mother_name=$fetch_student_details['mother_name'];
   $fetch_mother_mobile_no=$fetch_student_details['mother_mobile_no'];
   $fetch_parents_name=$fetch_student_details['local_parent_name'];
   $fetch_parents_mobile_no=$fetch_student_details['local_parent_mobile_no'];
   $fetch_student_photo=$fetch_student_details['student_photo'];
   $fetch_id=$fetch_student_details['id'];
   
   
   $class_db=  mysql_query("SELECT * FROM course_db WHERE course_id='$fetch_class_id'");
   $fetch_course_data=  mysql_fetch_array($class_db);
   $fetch_course_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_course_data))&&($fetch_course_data!=null)&&($fetch_course_num_rows!=0))
   {
      $course_name=$fetch_course_data['course_name'];
      $fetch_class_id=$fetch_class_id;
      
   }  else {
        $course_name="";
        $fetch_class_id="0";
   }
   
   $section_db=mysql_query("SELECT * FROM section_db WHERE section_id='$fetch_section_id'");
   $fetch_section_data=  mysql_fetch_array($section_db);
   $fetch_section_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_section_data))&&($fetch_section_data!=null)&&($fetch_section_num_rows!=0))
   {
      $section_name=$fetch_section_data['section_name'];
      
   }  else {
        $section_name="";
   }
   
    $session_db=mysql_query("SELECT * FROM session_db WHERE session_id='$fetch_session_id'");
   $fetch_session_data=  mysql_fetch_array($session_db);
   $fetch_session_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_session_data))&&($fetch_session_data!=null)&&($fetch_session_num_rows!=0))
   {
      $session_name=$fetch_session_data['session_name'];
      
   }  else {
        $session_name="";
   }
   
    $category_db=mysql_query("SELECT * FROM category_db WHERE category_id='$fetch_category_id'");
   $fetch_category_data=  mysql_fetch_array($category_db);
   $fetch_category_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_category_data))&&($fetch_category_data!=null)&&($fetch_category_num_rows!=0))
   {
      $category_name=$fetch_category_data['category_name'];
      
   }  else {
        $category_name="";
   }
   
 
    echo "
   <table class='student_table'>
            <tr>
                <td><b>Class</b></td>
                <td><b>:</b></td>
                <td><input type='hidden' id='student_insert_class' name='studnet_insert_post_class' value='$fetch_class_id'>$course_name</td>
                <td><b>Section</b></td>
                <td><b>:</b></td>
                <td>$section_name</td>
                <td><b>Session</b></td>
                <td><b>:</b></td>
                <td>$session_name</td>
                <td rowspan='6'><img class='student_images' src='../$fetch_student_photo'></td>
            </tr>
            <tr>
                <td><b>Student ID.</b></td>
                <td><b>:</b></td>
                <td>$fetch_student_id</td>
                <td><b>Form No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_id</td>
                <td><b>Roll No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_roll_no</td>
            </tr>
            <tr>
                <td><b>Student Name</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_student_name</td>
                <td><b>Gender</b></td>
                <td><b>:</b></td>
                <td>$fetch_student_gender</td>
                
            </tr>
             <tr>
                <td><b>Date Of Birth</b></td>
                <td><b>:</b></td>
                <td>$fetch_studnet_dob</td>
                <td><b>Category</b></td>
                <td><b>:</b></td>
                <td>$category_name</td>
                <td><b>Mobile No. (stu)</b></td>
                <td><b>:</b></td>
                <td>$fetch_student_mobile_no</td>
                
            </tr>
             <tr>
                <td><b>Father Name</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_student_father_name</td>
                <td><b>Mobile No. (Ho)</b></td>
                <td><b>:</b></td>
                <td>$fetch_father_mobile_no</td>
                
            </tr>
             <tr>
                <td><b>Mother Name</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_mother_name</td>
                <td><b>Mobile No. (Ho)</b></td>
                <td><b>:</b></td>
                <td>$fetch_mother_mobile_no</td>
                
            </tr>";
    if(!empty($fetch_parents_name))
    {
            echo"<tr>
                <td><b>Local Parents</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_parents_name</td>
                <td><b>Mobile No. (Ho)</b></td>
                <td><b>:</b></td>
                <td>$fetch_parents_mobile_no</td>
                
            </tr>";
    }    
        echo"</table>
   
   </div>";
   }           
?>                               
                                      
                                     
                                      
                                      
                                      
                                                   </fieldset> 
                                              </td>
                                          </tr>        
                                 <tr>
                                              <td colspan="2">
                                                   <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Fee Group/Fee Detail</span></legend>
                                                 
                                                   <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" width:90px; ">
                                                 
                                              </td>
                                              <td  class="td_leftpadding">
                                                  <strong>Fee Group/Fee</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                                  <input type="hidden" name="update_db_id" value="<?php  echo  $fetch_update_db_id;?>">
                                                  <select id="categoryname" class="select_box" disabled>
                                               <option><?php  echo $fee_group_name;?></option>
                                               </select>
                                              </td>
                                              
                                              
                                                                   
                                              
                                          </tr></table>
                                                   </fieldset> 
                                              </td>
                                          </tr> 
                                <tr>
                                    <td colspan="2" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Set Discount (%)</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable" style=" 
                                              height:150px;">
                                          <tr>
                                              <td style=" width:90px; "></td>
                                              <td  class="td_leftpadding">
                                                  <strong>Discount Type</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                                  <select name="discount_type" class="select_box" id="discount_type">
                                                  <?php 
                                                      if($discount_type=="percantage")
                                                      {
                                                      ?>
                                                      <option value="percantage" selected="">%</option>
                                                    <?php 
                                                      }else
                                                      {
                                                      ?>
                                                      <option value="percantage">%</option>
                                                    <?php 
                                                      }
                                                      ?>
                                                      
                                                    <?php 
                                                      if($discount_type=="flat")
                                                      {
                                                      ?>
                                                      <option value="flat" selected>Flat</option>
                                                    <?php 
                                                      }else
                                                      {
                                                      ?>
                                                      <option value="flat">Flat</option>
                                                    <?php 
                                                      }
                                                      ?>
                                                  </select>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td style=" width:60px; "></td>
                                              <td  class="td_leftpadding">
                                                  <strong>Discount</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                               <input type="text" id="discount" 
                                                      value="<?php  echo $discount;?>"  name="discount" 
                                                      class="text_sizebox" style=" width:290px; height:24px; padding-left: 3px;  ">
                                              </td>
                                          </tr>
                                          <tr>
                                              <td style=" width:60px;  "></td>
                                              <td  class="td_leftpadding">
                                                  <strong>Description</strong>  
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                                  <textarea id="textareasize" name="description" class="text_sizebox" style=" width:290px;  height:60px; "><?php  echo $discount_description;?></textarea>
                                              </td>
                                              
                                                                   
                                              
                                          </tr>
                                      </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                         <input type="submit" value="Update" id="addparticularstudentdiscount"
                                                name="adddiscountparticularstudent" class="add_button_reset_button" style=" margin-right:14px; ">
                                        
                                         <input type="submit" value="Reset" class="add_button_reset_button" style=" background-color: deeppink;"> 
                                       
                                        
                                    </td>
                                </tr>
                            </table>
      <?php 
                            }
                                 
            }  
            }
            
        ?>
                            
        </div>
        </form>
        
        
        
      <?php  include_once 'edit_fotter_page.php';?>
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