<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
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
                      if(isset($_POST['addfeedetails']))
                      {
                      
                      $accountheadgrouptype=$_POST['accountgrouptype'];
                      $accountheadgroupname=$_POST['accountgroupname'];
                      $accountname=$_POST['accountname'];
                      $accountdescription=$_POST['accountdescription'];
                      $final_fee_group_id=$_POST['update_db_id'];
                      $fecth_session_id_set=$_POST['use_inset_session_id'];
                      if((!empty($accountheadgrouptype))&&(!empty($final_fee_group_id))&&(!empty($accountheadgroupname))&&(!empty($accountname)))   
                      {
                     
                          
                          
                          $matchaccountvalue=mysql_query("SELECT * FROM financeaccountdetail WHERE id!='$final_fee_group_id' and account_type='$accountheadgrouptype' and account_group_id='$accountheadgroupname' and accountname='$accountname' and action='active'");
                      $fetchconditionmatch=mysql_fetch_array($matchaccountvalue);
                      $fetch_account_num_rows=mysql_num_rows($matchaccountvalue);
                      if((empty($fetchconditionmatch))&&($fetchconditionmatch==null)&&($fetch_account_num_rows==0))
                      {
                       $insertaccounthead=mysql_query("UPDATE financeaccountdetail SET accountname='$accountname',accountdescription='$accountdescription' WHERE id='$final_fee_group_id' and action='active'");
                       if($insertaccounthead)
                       {
                         $message_show='<div id="error-msg">Record update successfully complete.</div>';  
                       }
                          
                      }else $message_show='<div id="error-msg">Record already exist in database.</div>';
                          
                          
                      }else $message_show='<div id="error-msg">Please fill all fields.</div>';
                      }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
        <title>Edit Fee Details</title>
        <style>
   #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial; font-weight:800;  font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{ width:1150px; height:auto;  margin:0 auto;  }
    #table_midle_set{ width:100%; height:180px; margin:0 auto; margin-top:5px; border:1px solid #555555; float:left;    
    }
    #table_midle_settable{ width:100%; height:230px; margin:0 auto; margin-top:10px; font-size:12px;  float:left;    
    }
    .td_leftpaddingth{ padding-left:10px; padding-top:4px;  }
      #top_add_view_div{ width:130px; height:18px; padding-top:6px; padding-left:10px;
                       padding-right:10px; margin-top:-4px; 
                   background-color: #FFFFCC;
                       float:right; margin-right:2px; color:black; text-align:center;      }
    .td_leftpadding{ padding-right:10px;text-align:right;  }
    .textsize_same{ border:1px solid silver; margin-left:5px; width:250px; height:23px; padding-left:3px;   }
    .add_button_reset_button{ width:70px; height:28px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-color:dodgerblue; border:0px;  float:right; cursor:pointer;
    margin-top:10px; margin-bottom:10px;  }
    #error-msg{ width:550px; height:20px;padding-top:8px; background-color:#FFFFCC; 
                margin-top:10px;  color:#380000; text-align: center; margin:0 auto;  font-size: 12px; font-weight: 100;
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
    .selectsize_same{ width:250px; margin-left:5px;  height:26px; padding:2px;    }
    </style>
    
    
    
     <script type="text/javascript">
    function validateForm()
{
     var account_grop_type=document.getElementById("accountgrouptype").value;
     var account_group=document.getElementById("accountgroupname").value;
     var account_name=document.getElementById("accountname").value;
     if(account_grop_type==0)
         {
         alert("Please select account type");
         document.getElementById("accountgrouptype").focus();
         return false;
         }else
             if(account_group==0)
                 {
                  alert("Please select account group");
                  document.getElementById("accountgroupname").focus();
                  return false;
                 }else
                     if(account_name==0)
                         {
                          alert("Please enter account name");
                          document.getElementById("accountname").focus();
                          return false;
                         }
     
     
     
}    
    </script>
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
    </head>
    <body style="margin: 0; padding:0; ">
         <input id="organization_id" name='organization_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
         <input id="branch_id" name='branch_id' value="<?php  echo $fetch_branch_id;?>" type="hidden">
          <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
          
      <?php  include_once 'edit_header_page.php';?>
               
                          <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">  
           
        <div class="first_work_div">
            <div class="edit_title_heading">Edit Account Details</div>
          <?php  
           if(!empty($_REQUEST['token_id']))
           {
              $encrypt_id=$_REQUEST['token_id'];
              
           $account_db=  mysql_query("SELECT * FROM financeaccountdetail WHERE $db_main_details encrypt_id='$encrypt_id' and action='active'");   
           $fetch_account_data=  mysql_fetch_array($account_db);
           $fetch_account_num_rows=  mysql_num_rows($account_db);
           if((!empty($fetch_account_data))&&($fetch_account_data!=null)&&($fetch_account_num_rows!=0))
           {
           $account_db_id=$fetch_account_data['id'];    
           $account_group_id=$fetch_account_data['account_group_id'];
           $account_type=$fetch_account_data['account_type'];
           $account_name=$fetch_account_data['accountname'];
           $account_description=$fetch_account_data['accountdescription'];
            
           $account_group_db=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE $db_main_details account_head_id='$account_group_id'");
           $fetch_account_group_data=mysql_fetch_array($account_group_db);
           $fetch_account_group_num_rows=mysql_num_rows($account_group_db);
           if((!empty($fetch_account_group_data))&&($fetch_account_group_data!=null)&&($fetch_account_group_num_rows!=0))
           {
               
           $account_group_name=  ucfirst($fetch_account_group_data['accountheadgroupname']);
               
           }else
           {
               $account_group_name="Missing Record";
           }
           }
           }
           
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
                                      <legend><span style=" color: maroon;  ">Add Account Income/Expense Details</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Account Group Type</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                                </td>
                                              <td>
                                               <input type="hidden" name="update_db_id" value="<?php  echo $account_db_id;?>">
                                               <input type="hidden" name="accountgrouptype" value="<?php  echo $account_type;?>">
                                               <input type="hidden" name="accountgroupname" value="<?php  echo $account_group_id;?>">
                                               <select  onchange="account_head(this.value)"
                                                       id="accountgrouptype" class="selectsize_same" disabled>
                                                   <option><?php  echo ucfirst($account_type);?></option>
                                               </select>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Account Group</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                                </td>
                                              <td>
                                               <select  id="accountgroupname"
                                                       class="selectsize_same" disabled>
                                                   <option><?php  echo $account_group_name;?></option>   
                                               </select>
                                              </td>
                                          </tr>
                                          
                                           <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Account Name</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                                </td>
                                              <td>
                                                  <input type="text" name="accountname" id="accountname" class="textsize_same" value="<?php  echo $account_name;?>" style=" width:250px; padding-left:3px; height:24px; border:1px solid silver;   ">
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Account Description</strong>
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                                  <textarea name="accountdescription" style=" width:245px; margin-left:5px;  height:80px;  "><?php  echo $account_description;?></textarea>
                                              </td>
                                          </tr>
                                      </table>
                                    </td>
                                    
                                </tr> 
                                 
                                <tr>
                                    
                                    
                                    <td colspan="2">
                                          <input type="submit" value="Update" name="addfeedetails" 
                                                 id="addbuttonaccounthead" class="add_button_reset_button" style=" margin-right: 12px;">
                                       
                                         <input type="button" value="Reset" class="add_button_reset_button" style=" background-color: deeppink;">
                                      
                                    </td>
                                </tr>
                            </table>
                            
        </div>
        </form>
        
        
        
      <?php  include_once 'edit_fotter_page.php';?>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>