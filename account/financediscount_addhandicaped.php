
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
                        date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
                      require_once '../connection.php';
                      if(!empty($_POST['addfeediscountonstudenthandicapped']))
                      {
                        $feehandicappedname=$_POST['handicapped'];
                        $fee_group_id=$_POST['all_fee_group_id'];
                        $implode_fee_group_id=implode(",",$fee_group_id); 
                        $feediscount=$_POST['feediscount'];
                        $fee_discount_type=$_POST['discount_type'];
                        $feediscountdesciption=ucfirst(nl2br($_POST['description']));
                        $insert_session_id=$_POST['use_inset_session_id'];
                $explode_fee_group_id=explode(",",$implode_fee_group_id); 
                
                foreach ($explode_fee_group_id as $insert_fee_group_id)
                {     
  $static_id="DISCTHANDICPT";    
 $add_one_no=1;   
 $discount_cat_org_db=mysql_query("SELECT * FROM financefeediscountstudenthandicapped WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' ORDER BY id DESC");
 $fetch_discount_cat_org_record=mysql_fetch_array($discount_cat_org_db);
 $fetch_discount_cat_num_rows=mysql_num_rows($discount_cat_org_db);
  if((!empty($fetch_discount_cat_org_record))&&($fetch_discount_cat_org_record!=null)&&($fetch_discount_cat_num_rows!=0))
  {
   $fetch_id=$fetch_discount_cat_org_record['id'];
   $add_both_values=$fetch_id+$add_one_no;
   $final_discount_cat_id=$static_id."_".$add_both_values;   
  }else
  {
   $final_discount_cat_id=$static_id."_".$add_one_no;   
  }      
  $encrypt_id=md5(md5($final_discount_cat_id));
         
                            
                        if((!empty($feehandicappedname))&&(!empty($feediscount))&&(!empty($fee_discount_type))
                                &&(!empty($final_discount_cat_id))&&(!empty($insert_fee_group_id)))
                        {    
                          $selectvaluematchclass=mysql_query("SELECT * FROM financefeediscountstudenthandicapped WHERE
                           organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$insert_session_id'
                                 and discount_handicaped_id='$final_discount_cat_id' and action='active'
                           OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
                                  and session_id='$insert_session_id' and feestudenthandicapped='$feehandicappedname' and fee_group_id='$insert_fee_group_id' and action='active'");
                        $checkthisvalue=mysql_fetch_array($selectvaluematchclass);
                       $check_already_value=mysql_num_rows($selectvaluematchclass);
                        if((empty($checkthisvalue))&&($checkthisvalue==null)&&($check_already_value==0))
                        {
                     
                        $insertvalue=mysql_query("INSERT into financefeediscountstudenthandicapped values('',
                                '$fetch_school_id','$fetch_branch_id','$insert_session_id','$final_discount_cat_id','$encrypt_id'
                                ,'$feehandicappedname','$insert_fee_group_id','$fee_discount_type','$feediscount','$feediscountdesciption'
                                ,'$date','$date_time','$user_unique_id','active')");
                         if($insertvalue)
                         {
                              $message_show='<div id="error-msg">Record save successfully complete.</div>';
                         }else $message_show='<div id="error-msg">Request failed,please try again.</div>';
                        }else  $message_show='<div id="error-msg">Record already exist in database.</div>';
                        
                        }else  $message_show='<div id="error-msg">Please fill all fields.</div>';
                        
                } 
                      }
                      
                      
                        ?>    
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finance</title>
          <script type="text/javascript" src="jquery/jquery-1.js">
        </script>
        <script type="text/javascript">
        
 function validateForm(frm)
 {
  var student_handicapped=document.getElementById("studenthandicapped").value; 
  var discount_type=document.getElementById("discount_type").value;
  var discount=document.getElementById("discount").value;
    var destCount=frm.elements['all_fee_group_id[]'].length;
var destSel   = false;
for(i = 0; i < destCount; i++){
if(frm.elements['all_fee_group_id[]'][i].checked){
destSel = true;
break;
}
}   
  if(student_handicapped==0)
  {
     alert("Please select handicapped");
     document.getElementById("studenthandicapped").focus();
     return false;
  }else
      if(!destSel){
alert('Please select atleast one fee group');
return false;
}else
      if(discount_type==0)
          {
             alert("Please select discount type");
             document.getElementById("discount_type").focus();
             return false;
          }else
              if(discount==0)
                  {
                     alert("Please enter discount");
                     document.getElementById("discount").focus();
                     return false;
                  }else
                     if(isNaN(discount))
                         {
                          alert("Please enter only numeric value (like-1,2,3,4)");
                     document.getElementById("discount").focus();
                     return false;   
                         }
  
 }
 
        </script>
        <script type="text/javascript">
    function check_all()
{
    var all_check_id=document.getElementById("select_all_fee").checked;
    if(all_check_id==true)
        {
var destCount = document.myForm.elements['all_fee_group_id[]'].length;
for(i = 0; i < destCount; i++){
document.myForm.elements['all_fee_group_id[]'][i].checked=true;
}
        }else
            {
             var destCount = document.myForm.elements['all_fee_group_id[]'].length;
for(i = 0; i < destCount; i++){
document.myForm.elements['all_fee_group_id[]'][i].checked=false;
}
            }
    
}    
    </script>
        
    </head>
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
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
    #table_midle_settable{ width:100%; height:50px;  }
    .selectsize_same{ width:185px; height:25px;  }
    .text_sizebox{ width:180px; border:1px solid silver; height:22px; padding-left:3px;     }
     .feegroup_list{ width:auto; height:auto; padding-top:6px;  float:left; padding-left:10px;    }
    .select_all{ width:auto; height:auto;  padding-left:10px;border-bottom:1px solid skyblue; font-weight:bold;    }
   .all_check_box_styling{ width:15px; height:15px; cursor:pointer;   }
    </style>
    <body style=" margin: 0;padding: 0;">
         <div id="financefirstdiv">
              <form name="myForm" action="" onsubmit="return validateForm(this);" method="post" enctype="multipart/form-data">
           
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td style="background-image:url('finanacephoto/bgblack.png');">
                        
                              <?php 
                                include_once 'heademastersetting.php';
                                ?>
                               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">    
                    </td>
                </tr> 
                <tr>
                    <td>
                        <div id="valuediv">
                        
                            <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="2" class="td_leftpaddingth" style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                      
                                    Add/Edit Handicapped Discount Details  
                                    
                                    <a href="financediscount_viewall.php?seehandicappeddiscount=1hh_qwqwq_ADDSDS663644_SDWHJ" border="0" style=" text-decoration:none; ">
                                        <abbr title="View Handicapped Discount Detail">
                                    <div id="top_add_view_div">
                                        <strong> View Handicapped Discount Details </strong>
                                    </div>
                                        </abbr>
                                    </a>
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
                                    <td colspan="3">
                                   <?php  echo $message_show;?>   
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
                                               <select class="selectsize_same" id="studenthandicapped" name="handicapped">
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
                                              <td style=" height:20px; ">
                                                  <div style=" width:auto; height:auto; ">
                                                      <div class='select_all'><table><tr><td>
              <input id="select_all_fee" class="all_check_box_styling" onclick="check_all()" type='checkbox'></td><td>Select All</td></tr></table></div>
                                                <?php 
$fee_group_data=mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$fetch_school_id'
        and branch_id='$fetch_branch_id' and 
session_id='$fecth_session_id_set'");
while ($fetch_fee_group_data=  mysql_fetch_array($fee_group_data))
{
$fetch_fee_group_name=$fetch_fee_group_data['feegroupname']; 
 $fetch_fee_group_id=$fetch_fee_group_data['fee_group_id'];
echo "<div class='feegroup_list'><table><tr><td><input type='checkbox' class='all_check_box_styling' name='all_fee_group_id[]' value='$fetch_fee_group_id'></td><td>$fetch_fee_group_name</td></tr></table></div>";
    
}
                                                  
                                                  ?>
                                                  </div>
                                              </td>
                                          </tr>
                                          
                                          
                                         
                                      </table></fieldset>
                                         
                                         
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
                                                      <option value="percantage">%</option>
                                                      <option value="flat">Flat</option>
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
                                               <input type="text" id="discount" name="feediscount"
                                                      maxlength="3" class="text_sizebox">
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
                                               <textarea id="textareasize" name="description" class="text_sizebox" style=" height:60px; "></textarea>
                                              </td>
                                              
                                                                   
                                              
                                          </tr>
                                      </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                         <input type="submit" value="Save" id="handicappedsavebutton"
                                                name="addfeediscountonstudenthandicapped" class="add_button_reset_button" style=" margin-right:12px; ">
                                        
                                         <input type="submit" value="Reset" class="add_button_reset_button" style=" background-color: deeppink">
                                       
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                    </td>
                </tr>
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