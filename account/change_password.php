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



<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finance</title>
        <script type="text/javascript">
        function validateForm()
        {
          var old_password=document.getElementById("old_password").value;
          var new_password=document.getElementById("new_password").value;
          var confirm_password=document.getElementById("confirm_password").value;
          if(old_password==0)
          {
            alert("Please enter old password");
            document.getElementById("old_password").focus();
            return false;
          }else
              if(new_password==0)
          {
             alert("Please enter new password");
             document.getElementById("new_password").focus();
             return false;
          }else
              if(confirm_password==0)
          {
             alert("Please enter confirm password");
             document.getElementById("confirm_password").focus();
             return false;
          }
          
        }
        </script>
        <style>
             #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial; font-size:12px; float:left;      }
            #fullviewtable{ width:100%; height:100%;  margin:0; padding: 0; float:left; }
            #linkviewdiv{ width:840px; height:200px; background-color:white;   }
            .spacing{ margin: 0;padding:0; border-spacing: 0px }
            
            .td_index{ margin:0; padding:0; border-spacing: 0;  }
            .td_verticleline{   margin:0; padding:0; border-spacing: 0;
                                }
            #linkpage{ width:840px; height:400px; background-color:white;  border-top:1px solid whitesmoke;    }
            #mainpagesourse{ width:1148px; padding-bottom:10px; 
                              
                            height:auto; margin:0 auto; border:1px solid #555555; margin-top:6px;  }
            #attechfotter{ width:100%; height:22px; position:fixed; bottom:0px;    }
           .td_style_top_heder{ border-left:1px solid silver; height:27px; font-weight:100; 
                              background-color:white;  text-align:center; border-bottom:1px solid silver;     }
           .td_styling{ border-left:1px solid silver; height:22px; font-weight:100; 
                              text-align:center; border-bottom:1px solid silver;     }
 
  .notification{ width:400px; height:100px; background-color:whitesmoke; float:left;  }
  .top_first_heading{ width:97%; height:20px; padding-left:3%; float:left;border:1px solid dodgerblue;  
                    padding-top:5px; color:white;   background-color:dodgerblue;   }
  .main_work_data{ width:100%; height:250px; background-color:white; float: left;border-left:1px solid dodgerblue; 
  border-right:1px solid dodgerblue;   }
  .fotter_last_div{ width:100%; height:24px; background-color:dodgerblue; float:left; border:1px solid dodgerblue; 
  }
  #change_password_middle_Div{ width:600px; height: auto; margin:0 auto;  }
  .old_password_table{ width:80%; height:auto; margin:0 auto; margin-top:30px;    }
   .add_button_reset_button{ width:70px; height:28px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-color:dodgerblue; border:0px;  float:right; cursor:pointer;   }
   .text_box_styling{ width:290px; height:22px; padding-left:4px;  }
   .title_heading{ width:98%; padding-left:2%;font-weight:bold;   height:22px; background-color:#555555; color:white; padding-top:6px;    }
        </style>
    </head>
    <body style=" margin:0; padding: 0;  ">
          <form name="myForm" action="" onsubmit="return validateForm(this);" method="post" enctype="multipart/form-data">
           
        <div id="financefirstdiv">
            <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td>
                    <?php 
                      include_once 'headerfinancepage.php';
                      ?>
                        <style>
                          #color_10{ background-color:dodgerblue; color: white; }  
                        </style>
                    </td>
                </tr>
                <tr>
                    <td>
                       <div id="mainpagesourse">
                           <div class="title_heading">Change Password</div>
                           <div id="change_password_middle_Div">
                               <table cellspacing="4" cellpadding="4" class="old_password_table">
                                   <tr>
                                       <td colspan="3">
                                           <strong style="color:gray;background-color:whitesmoke; padding-left:10px; padding-right:10px;
                                            font-size:11px; ">Fields marked with <span><sup style=" color:red; ">*</sup> 
                                            must be filled.</span></strong>
                                       </td>
                                   </tr>
                                   <tr>
                                       <td>
                                           <b>Old Password <sup style="color:red; ">*</sup></b>   
                                       </td>
                                       <td><b>:</b></td>
                                       <td><input class="text_box_styling" id="old_password" type="text" placeholder="Enter old password"></td>
                                   </tr>
                                   <tr>
                                       <td>
                                           <b>New Password <sup style="color:red; ">*</sup></b>   
                                       </td>
                                       <td><b>:</b></td>
                                       <td><input class="text_box_styling" id="new_password" type="text" placeholder="Enter old password"></td>
                                   </tr>
                                   <tr>
                                       <td>
                                           <b>Confirm Password <sup style="color:red; ">*</sup></b>   
                                       </td>
                                       <td><b>:</b></td>
                                       <td style=" width:200px; "><input id="confirm_password" class="text_box_styling" type="text" placeholder="Enter old password"></td>
                                   </tr>
                                   <tr>
                                       <td colspan="3">
                                           <input type="submit" style=" background-color: deeppink;" class="add_button_reset_button" value="Update">
                                           <input type="button" class="add_button_reset_button" value="Reset">
                                          
                                       </td>
                                   </tr>
                               </table>  
                           </div> 
                       
                       </div>
                        
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr> 
               
            </table>  
        </div>
          </form>
        <div id="attechfotter">
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