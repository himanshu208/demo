<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php 
  $message_show="";
                      require_once '../connection.php';
                      if(!empty($_POST['addfeedetails']))
                      {
                     
                          date_default_timezone_set('Asia/Calcutta'); 
                          $timezone=5.5;
                          $localtime=$timezone*3600;
                          $time_current=date("h:i:s A");
                          $date=date("Y-m-d");
                          $date_time=$date." ".$time_current;
   
                      $accountheadgroupname=$_POST['accountheadgroup'];
                      if(!empty($_POST['accountheadtype']))
                      {
                      $accountheadtype=$_POST['accountheadtype'];
                      }  else {
                         $accountheadtype=""; 
                      }
                      $session_id=$_POST['use_inset_session_id'];
                      
                      
 $result=mysql_query("SHOW TABLE STATUS LIKE 'financeaccountheadhdetail'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_account_head_id="ACCTGRP_$nextId";                            
$encrypt_id=md5(md5($final_account_head_id));

  
                      if((!empty($accountheadgroupname))&&(!empty($final_account_head_id))&&(!empty($accountheadtype))&&(!empty($session_id)))   
                      {

  
                          
                          
                          
                          $matchaccountheadvalue=mysql_query("SELECT * FROM financeaccountheadhdetail  WHERE $db_main_details"
                                  . " account_head_id='$final_account_head_id' and action='active'
                              OR $db_main_details accountheadgroupname='$accountheadgroupname'
                              and accountheadgrouptype='$accountheadtype' and action='active'");
                      $fetchconditionmatch=mysql_fetch_array($matchaccountheadvalue);
                      $fetch_account_head_num_rows=mysql_num_rows($matchaccountheadvalue);
                      if((empty($fetchconditionmatch))&&($fetchconditionmatch==null)&&($fetch_account_head_num_rows==0))
                      {
                       $insertaccounthead=mysql_query("INSERT into financeaccountheadhdetail values('','$fetch_school_id','$fetch_branch_id','$session_id'
                               ,'$final_account_head_id','$encrypt_id','$accountheadgroupname','$accountheadtype'
                               ,'$date','$date_time','$user_unique_id','active')");
                       if($insertaccounthead)
                       {
                         $message_show='<div id="error-msg">Record save successfully complete. </div>';  
                       }else $message_show='<div id="error-msg">Request failed,please try again.</div>';
                          
                      }else $message_show='<div id="error-msg">Record already exist in database.</div>';
                          
                          
                      }else $message_show='<div id="error-msg">Please fill all fields.</div>';
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
    #error-msg{ width:600px; height:21px;padding-top:8px; background-color:#FFFFCC; 
                margin-top:10px; margin:0 auto;  color:#380000; text-align: center; font-weight:100; 
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
    .selectsize_same{ width:150px; }
    #selectclassall{ width:15px; height:15px;  }
    </style>
    <body style=" margin: 0;padding: 0;">
         <div id="financefirstdiv">
              <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
           
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td style="background-image:url('finanacephoto/bgblack.png');">
                        
                              <?php 
                                include_once 'heademastersetting.php';
                                ?>
                          
                    </td>
                </tr> 
                <tr>
                    <td>
                        <div id="valuediv">
                           <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   

                            <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="2" class="td_leftpaddingth" style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                    Add New Account Group 
                                    
                                    <a href="financeaccount_viewall.php?viewaccountheadmaster=12yyt_sajjfhgb_ashhhvvtetefwtFfff_JHJVCfss" border="0" style=" text-decoration:none; ">
                                        <abbr title="View Account Head Master Detail">
                                    <div id="top_add_view_div">
                                        <strong> View Account Group Details </strong>
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
                                    <td><?php  echo $message_show;?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Enter Account Group</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Group Name</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                               <input type="text" name="accountheadgroup" placeholder="Enter account group name" id="accountheadgroup" class="textsize_same">
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
                                                  <input type="Radio" name="accountheadtype" value="income" id="selectclassall" checked> 
                                              </td>
                                              <td style=" width:100px; ">
                                                  <b> Income</b>
                                              </td>
                                              <td style=" width:20px;  ">
                                                <input type="Radio" name="accountheadtype" value="expense" id="selectclassall"> 
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
                                         <input type="submit" value="Save" name="addfeedetails" 
                                                id="addbuttonaccounthead" class="add_button_reset_button" style=" margin-right:12px; ">
                                       
                                         <input type="button" value="Reset" onclick="reset_button()" class="add_button_reset_button" style="background-color:deeppink; ">
                                       
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
}else
{
    echo "Sorry,Technical Problem";   
}
?>