
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
if(!empty($_POST['addfeediscountonstudenthandicapped']))
{
$discount_type=$_POST['discount_type'];
$discount=$_POST['feediscount'];
$discount_description=$_POST['description'];
$update_db_id=$_POST['update_db_id'];
$session_id=$_POST['use_inset_session_id'];
    
$update_discount_category_db=mysql_query("UPDATE financefeediscountstudenthandicapped SET discount_type='$discount_type',feediscount='$discount',feediscountdescription='$discount_description'"
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
          <script type="text/javascript">
              function validateForm()
              {
              var discount=document.getElementById("discount").value;
             
              var discount_type=document.getElementById("discount_type").value;
              if(discount==0)
              {
                 alert("Please enter discount");
                 document.getElementById("discount").focus();
                 return false;
              }else
                  if(isNaN(discount))
              {
                 alert("Please enter only numeric value");
                 return false;
              }else
                if(discount_type=="percantage")
            {
               if(discount>100) 
               {
                 alert("Please enter below value");
                 document.getElementById("discount").focus();
                 return false;
               }
            }
                
                
              }
          </script>
          <style>
   #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial; font-weight:800;  font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{ width:1150px; height:auto;  margin:0 auto;  }
    #table_midle_set{ width:100%; height:180px; margin:0 auto; margin-top:10px; border:1px solid #555555; float:left;    
    }
    .td_leftpaddingth{ padding-left:10px; padding-top: 4px;}
    #top_add_view_div{ width:220px; height:18px; padding-top:6px; padding-left:10px;
                       padding-right:10px; margin-top:-4px; 
                   background-color: #FFFFCC;
                       float:right; margin-right:4px; color:black; text-align:center;      }
    .td_leftpadding{ padding-right:10px;text-align:right;  }
    .textsize_same{ border:1px solid gray; margin-left:5px; }
    .add_button_reset_button{ width:70px; height:28px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-color:dodgerblue; border:0px;  float:right; cursor:pointer;
    margin-top:10px; margin-bottom:10px;  }
    #error-msg{ width:600px; height:20px;padding-top:3px; background-color:#FFFFCC; 
                margin-top:10px; color:#380000; text-align: center; margin:0 auto; font-weight:100; padding-top:8px;   
                background-image:url('finanacephoto/skyblue.pg'); font-size: 12px; border:1px solid silver; margin-top:10px;     }
    #table_midle_settable{ width:100%; height:50px;  }
    .selectsize_same{ width:185px; height:25px;  }
    .text_sizebox{ width:180px; border:1px solid silver; height:22px; padding-left:3px;     }
     .feegroup_list{ width:auto; height:auto; padding-top:6px;  float:left; padding-left:10px;    }
    .select_all{ width:auto; height:auto;  padding-left:10px;border-bottom:1px solid skyblue; font-weight:bold;    }
   .all_check_box_styling{ width:15px; height:15px; cursor:pointer;   }
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
        <div class="edit_title_heading">Edit Handicapped Discount Details</div>
         <?php  
           if(!empty($_REQUEST['token_id']))
           {
            $encrypt_id=$_REQUEST['token_id'];
            
          $discount_handicapped_db=mysql_query("SELECT * FROM financefeediscountstudenthandicapped WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and encrypt_id='$encrypt_id' and action='active'");     
           $discount_handicapped_data=mysql_fetch_array($discount_handicapped_db);
           $discount_handicapped_num_rows=mysql_num_rows($discount_handicapped_db);
           if((!empty($discount_handicapped_data))&&($discount_handicapped_data!=null)&&($discount_handicapped_num_rows!=0))
           {
            $discount_db_id=$discount_handicapped_data['id']; 
            $fetch_fee_group_id=$discount_handicapped_data['fee_group_id'];
            $discount_type=$discount_handicapped_data['discount_type'];
            $discount=$discount_handicapped_data['feediscount'];
            $discount_discription=$discount_handicapped_data['feediscountdescription'];
           
              
           //fee group
                       $fee_group_db=mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and fee_group_id='$fetch_fee_group_id'");
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
                                     <td colspan="2" class="td_leftpadding">
                                          <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Select Handicapped</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" width:40px; ">
                                                 
                                              </td>
                                              <td  class="td_leftpadding">
                                                  <strong>Handicapped</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                                  <input type="hidden" name="update_db_id" value="<?php  echo $discount_db_id;?>">
                                                  <select class="selectsize_same" id="studenthandicapped" name="handicapped" disabled>
                                               <option value="Handicapped">Handicapped</option>
                                              
                                               </select>
                                              </td>
                                              
                                              
                                                                   
                                              
                                          </tr>
                                      </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="td_leftpadding">
                                        <fieldset style=" font-size:12px; font-weight:500;margin-left:10px;
                                                  margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Select Fee Group </span></legend>
                                       <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" width:20px; ">
                                                 
                                              </td>
                                              <td  class="td_leftpadding">
                                                  <strong>Fee Group/Fee</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                                  <select id="categoryname" class="selectsize_same"disabled>
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
                                              height:130px;">
                                          <tr>
                                              <td width="30px">
                                                  
                                              </td>
                                              <td  class="td_leftpadding">
                                                  <strong>Discount Type</strong>
                                                  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                                  <select id="discount_type" class="selectsize_same"
                                                          name="discount_type">
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
                                              <td style=" width:30px; "></td>
                                              <td  class="td_leftpadding">
                                                  <strong>Discount</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                                  <input type="text" placeholder="Enter discount" id="discount" name="feediscount"
                                                      value="<?php  echo $discount;?>" class="text_sizebox" style=" width:185px; height:24px;  ">
                                              </td>
                                          </tr>
                                          <tr>
                                              <td style=" width:30px; "></td>
                                              <td  class="td_leftpadding">
                                                  <strong>Description</strong>  
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                                  <textarea id="textareasize" name="description" class="text_sizebox" style=" width:185px;  height:60px; "><?php  echo $discount_discription;?></textarea>
                                              </td>
                                              
                                                                   
                                              
                                          </tr>
                                      </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                         <input type="submit" value="Update" id="handicappedsavebutton"
                                                name="addfeediscountonstudenthandicapped" class="add_button_reset_button" style=" margin-right:12px; ">
                                        
                                         <input type="submit" value="Reset" class="add_button_reset_button" style=" background-color: deeppink">
                                       
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