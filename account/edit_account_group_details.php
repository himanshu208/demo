<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>
<?php 
$message_show="";
 if(!empty($_POST['addfeedetails']))
                      {
                     
                          date_default_timezone_set('Asia/Calcutta'); 
                          $timezone=5.5;
                          $localtime=$timezone*3600;
                          $time_current=date("h:i:s A");
                          $date=date("Y-m-d");
                          $date_time=$date." ".$time_current;
   
                      $accountheadgroupname=$_POST['accountheadgroup'];
                      $session_id=$_POST['use_inset_session_id'];
                      $insert_account_group_id=$_POST['update_db_id'];
                      $insert_account_type=$_POST['accountheadtype'];
                      
  
               if((!empty($accountheadgroupname))&&(!empty($fetch_school_id))
                       &&(!empty($fetch_branch_id))&&(!empty($session_id))&&(!empty($insert_account_group_id))&&(!empty($insert_account_type)))   
                      {

                      $matchaccountheadvalue=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE id!='$insert_account_group_id'"
                              . " and $db_main_details accountheadgroupname='$accountheadgroupname' and accountheadgrouptype='$insert_account_type'"
                              . " and action='active'");
                      $fetchconditionmatch=mysql_fetch_array($matchaccountheadvalue);
                      $fetch_account_head_num_rows=mysql_num_rows($matchaccountheadvalue);
                      if((empty($fetchconditionmatch))&&($fetchconditionmatch==null)&&($fetch_account_head_num_rows==0))
                      {
                       $insertaccounthead=  mysql_query("UPDATE financeaccountheadhdetail SET"
                               . " accountheadgroupname='$accountheadgroupname',accountheadgrouptype='$insert_account_type' WHERE "
                               . "id='$insert_account_group_id' and action='active'");
                       if($insertaccounthead)
                       {
                         $message_show='<div id="error-msg">Record update successfully complete. </div>';  
                       }else $message_show='<div id="error-msg">Request failed,please try again.</div>';
                          
                      }else $message_show='<div id="error-msg">Record already exist in database.</div>';
                          
                          
                      }else $message_show='<div id="error-msg">Please fill all fields.</div>';
                      }
?>


<html>
    <head>
        <meta charset="UTF-8">
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
        <title>Edit Account Group Details</title>
      <script type="text/javascript" src="jquery/jquery-1.js">
        </script>
        <script type="text/javascript">
        $(document).ready(function(){
            
            $("#addbuttonaccounthead").click(function(){
            var accountheadgroup=$("#accountheadgroup").val();
            if(accountheadgroup=="")
                {
                    alert("Please enter account group name");
                    $("#accountheadgroup").focus();
                    return false;
                }else
               if($('input[name=accountheadtype]:checked').length<=0)
{
 alert("Please select account type");
 return false;
}else;
             
                
           
            });
        });
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
    
     <style>
   #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial; font-weight:800;  font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{ width:1150px; height:auto;  margin:0 auto;  }
    #table_midle_set{ width:100%; height:180px; margin:0 auto; margin-top:5px; border:1px solid #555555; float:left;    
    }
    #table_midle_settable{ width:100%; height:60px; margin:0 auto; margin-top:10px; font-size:12px;  float:left;    
    }
    .td_leftpaddingth{ padding-left:10px; padding-top: 4px;}
    #top_add_view_div{ width:160px; height:18px; padding-top:6px; padding-left:10px;
                       padding-right:10px; margin-top:-4px; 
                   background-color: #FFFFCC;
                       float:right; margin-right:4px; color:black; text-align:center;      }
    .td_leftpadding{ padding-right:10px;text-align:right;  }
    .textsize_same{ border:1px solid gray; margin-left:5px; width:200px; height:22px;
                   padding-left:4px; padding-right:4px;     }
     .add_button_reset_button{ width:70px; height:28px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-color:dodgerblue; border:0px;  float:right; cursor:pointer;
    margin-top:10px; margin-bottom:10px;  }
    #error-msg{ width:500px; height:21px; padding-top:8px; background-color:#FFFFCC; 
                margin-top:10px; margin:0 auto;  color:#380000; text-align: center; font-weight:100; 
                 border:1px solid silver;     }
    .selectsize_same{ width:150px; }
    #selectclassall{ width:15px; height:15px;  }
    </style>
    <body style="margin: 0; padding:0; ">
         <input id="organization_id" name='organization_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
         <input id="branch_id" name='branch_id' value="<?php  echo $fetch_branch_id;?>" type="hidden">
          <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
          
      <?php  include_once 'edit_header_page.php';?>
               
                          <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">  
           
        <div class="first_work_div">
            <div class="edit_title_heading">Edit Account Group Details</div>
          <?php 
            if(!empty($_REQUEST['token_id']))
            {
            $encrypt_id=$_REQUEST['token_id'];
           $account_group_db=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE $db_main_details encrypt_id='$encrypt_id' and action='active'");
           $fetch_account_data=  mysql_fetch_array($account_group_db);
           $fetch_account_num_rows=  mysql_num_rows($account_group_db);
           if((!empty($fetch_account_data))&&($fetch_account_data!=null)&&($fetch_account_num_rows!=0))
           {
           $fetch_account_group_name=$fetch_account_data['accountheadgroupname'];
           $fetch_account_type=$fetch_account_data['accountheadgrouptype'];
           $fetch_account_group_db_id=$fetch_account_data['id'];
               
               
           {
            ?>
           <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td style=" font-size:12px; padding-top: 10px; "><?php  echo $message_show;?></td>
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
                                       <fieldset style=" font-size:12px; margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Enter Account Group</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Group Name</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                               <input type="hidden" name="insert_account_type" value="<?php  echo $fetch_account_type;?>">
                                               <input type="hidden" id="update_db_id" name="update_db_id" value="<?php  echo $fetch_account_group_db_id;?>">
                                               <input type="text" name="accountheadgroup" placeholder="Enter account group name" id="accountheadgroup" value="<?php  echo  $fetch_account_group_name;?>" class="textsize_same">
                                              </td>
                                          </tr>
                                      </table>
                                    </td>
                                    
                                </tr> 
                                 <tr>
                                 <td colspan="2" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Select Account Type</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style="width:30px; float:left; "> 
                                                  
                                              </td>
                                              <td style=" width:20px;  ">
                                                  
                                                <?php 
                                                  if($fetch_account_type=="income")
                                                  {
                                                  ?>
                                                  <input type="Radio" name="accountheadtype" value="income" id="selectclassall" checked> 
                                            <?php 
                                                  }else
                                                  {
                                              ?>
                                                  <input type="Radio" name="accountheadtype" value="income" id="selectclassall"> 
                                            
                                              <?php 
                                                
                                                  }?>  
                                                  
                                                  
                                              </td>
                                              <td style=" width:100px; ">
                                                  <b> Income</b>
                                              </td>
                                              <td style=" width:20px;  ">
                                                 <?php 
                                                  if($fetch_account_type=="expense")
                                                  {
                                                  ?>
                                                <input type="Radio" name="accountheadtype" value="expense" id="selectclassall" checked> 
                                            <?php 
                                                  }else
                                                  {
                                              ?>
                                                 <input type="Radio" name="accountheadtype" value="expense" id="selectclassall"> 
                                             
                                            <?php 
                                                
                                                  }?>
                                              </td>
                                              <td>
                                                  <b> Expense</b>
                                              </td>
                                             
                                          </tr>
                                          <tr>
                                            
                                          </tr>
                                          
                                      </table>
                                    </td>
                                       </tr>
                                <tr>
                                    
                                    
                                    <td colspan="2">
                                         <input type="submit" value="Update" name="addfeedetails" 
                                                id="addbuttonaccounthead" class="add_button_reset_button" style=" margin-right:12px; ">
                                       
                                         <input type="button" value="Reset" onclick="reset_button()" class="add_button_reset_button" style="background-color:deeppink; ">
                                       
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
}else
{
    echo "Sorry,Technical Problem";   
}
?>