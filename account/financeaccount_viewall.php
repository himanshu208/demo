
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
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
        
        <title>Finance</title>
    </head>
    <style>
         #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  padding-bottom:10px; 
                              font-family:arial; font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{width:1150px; height:auto; margin:0 auto;    }
    #table_midle_set{ width:100%; height:auto; margin:0 auto; margin-top:5px;       }
    .td_leftpadding{ padding-left:10px; padding-top:6px;    }
    .textsize_same{ border:1px solid gray; margin-left:5px; }
    .add_button_reset_button{ width:60px; height:23px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke;  
                             background-image:url('finanacephoto/bgblack.png');  }
    .td_border_color{ border-bottom:1px solid silver; width:auto;  height:30px; margin:0; padding: 0; 
                     border-right:1px solid silver; background-color:#F8F8F8 ; text-align:center;
                     border-top:1px solid gray;    }
    #tdleft{ border-left:1px solid silver;}
     #top_add_view_div{ width:150px; height:18px; padding-top:6px; padding-left:10px;
                       padding-right:10px; margin-top:-4px; 
                   background-color: #FFFFCC;
                       float:right; margin-right:4px; color:black; text-align:center;      }
    .td_viewvalue{ border-bottom:1px solid silver; width:auto;  height:30px; margin:0; padding: 0; 
                     border-right:1px solid silver; text-align:center;    }
    #both_add_div{ width:45px; height: 22px; margin:0 auto;   }
    .editfee { width:18px; float:left; font-size: 0px;  height:18px; background-image:url('finanacephoto/edit.png');  }
    .deletefee{ width:18px; height:18px; float:right; font-size: 0px;  background-image:url('finanacephoto/delete.png'); }
    .editfee:hover{ cursor:pointer; }
    .deletefee{ cursor:pointer; }
    </style>
    
    <body style="margin:0;padding:0;">
        
        <?php 
      include_once '../ajax_loader_page_second.php';
      ?>
         <input id="organization_id" name='organization_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
             <input id="branch_id" name='branch_id' value="<?php  echo $fetch_branch_id;?>" type="hidden">
            
        
        
         <div id="financefirstdiv">
<?php 
require_once '../connection.php';
if(!empty($_REQUEST['viewaccountheadmaster']))
{
{
?>             
        
        <script type="text/javascript">
            function remove_record(delete_tr_name)
            {
var organization_id=document.getElementById("organization_id").value;
   var branch_id=document.getElementById("branch_id").value;
   var session_id=document.getElementById("insert_session_id").value;
    if((organization_id==0)||(branch_id==0)||(session_id==0)||delete_tr_name==0)
   {
      alert("Please fill all fields.")
      return false;
   }else
   {

var r=confirm("Are you sure you want to delete a record");
if (r==true)
  { 
   
   var httpxml;

try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
 if(httpxml.responseText!=0)
     {
   document.getElementById("ajax_loader_show").style.display="none";
   if(httpxml.responseText==1)
   {
   document.getElementById("delete_row_"+delete_tr_name).style.display="none";
   alert("Record delete successfully complete");
   
   }else
   {
     alert("Sorry,Request failed,Please try again later");
         return false;  
   }
   
     }else
     {
         alert("Sorry,Request failed,Please try again later");
         return false;
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="delete_ajax_code.php";
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&account_name_id="+delete_tr_name;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
   
  } 
  }
  }
        </script>           
             
             
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td style="background-image:url('finanacephoto/bgblack.png');  font-weight:bold; ">
                        
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
                                    <td colspan="4" class="td_leftpadding" 
                                         style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                        <strong>View Account Group Details</strong>   
  <a href="financeaccount_addaccounthead.php" border="0" style=" text-decoration:none; ">
      <abbr title="Add New Accoutn Head Master Deatil">
                                    <div id="top_add_view_div">
                                        <strong>Add New Account Group</strong>
                                    </div>
  </abbr>
                                    </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='td_border_color' id="tdleft">
                                      <strong>  Sl.No</strong>
                                    </td>
                                    <td class='td_border_color'>
                                        <strong>Account Group</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Account Group Type</strong>
                                    </td>
                                    <td class='td_border_color'>
                                   <strong>Action</strong>
                                    </td>
                                    
                                    
                                </tr>
                             <?php 
                        require_once '../connection.php';
                        $row=0;
                        $accountheadmaster=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and action='active'");
                        
                        while ($accountheadvalue=mysql_fetch_array($accountheadmaster))
                        {
                            $fetchdataid=$accountheadvalue['id'];
                            $encrypt_id=$accountheadvalue['encrypt_id'];
                            $fetchaccountgroupname=ucfirst($accountheadvalue['accountheadgroupname']);
                            $feeaccountgrouptype=ucfirst($accountheadvalue['accountheadgrouptype']);
                            $row++;
                        echo "<tr id='delete_row_$fetchdataid'>
                            <td class='td_viewvalue' id='tdleft'>$row</td>
                            <td class='td_viewvalue'>$fetchaccountgroupname</td>
                            <td class='td_viewvalue'>$feeaccountgrouptype</td>
                            <td class='td_viewvalue' style='width:132px;'>
                            
                             <abbr title='Edit'>";
                        {
                        ?>
                                <a style="color:blue;" href="#" onclick="window.open('edit_account_group_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=500,width=600,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        
                            <div class='edit_delete_buttons' style='background-color:green; width:45px;'>Edit</div></a>
                      <?php 
                        }
                           echo "</abbr>
                            <abbr title='Delete'>";
                        {
                        ?>
                            <div onclick="remove_record('<?php  echo $fetchdataid;?>')" class='edit_delete_button'>Delete</div>
                         <?php 
                        }
                           echo " </abbr>
                           
                            </td>
                            
</tr>                            
";
                        
                        }
                        
                        if(empty($fetchaccountgroupname))
                        {
                        echo "
<tr>
<td colspan='4' class='td_viewvalue' id='tdleft'>
<strong style='color:red;'>No Available Record</strong>
</td>
</tr>
";
                        }                 
                        
                               ?>
                                
    <?php 
}
}
      ?>                          
      
<?php 
require_once '../connection.php';
if(!empty($_REQUEST['viewaccountdetails']))
{
    

{
?>             
         <script type="text/javascript">
            function remove_record(delete_tr_name)
            {
var organization_id=document.getElementById("organization_id").value;
   var branch_id=document.getElementById("branch_id").value;
   var session_id=document.getElementById("insert_session_id").value;
    if((organization_id==0)||(branch_id==0)||(session_id==0)||delete_tr_name==0)
   {
      alert("Please fill all fields.")
      return false;
   }else
   {

var r=confirm("Are you sure you want to delete a record");
if (r==true)
  { 
   
   var httpxml;

try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
 if(httpxml.responseText!=0)
     {
   document.getElementById("ajax_loader_show").style.display="none";
   if(httpxml.responseText==1)
   {
   document.getElementById("delete_row_"+delete_tr_name).style.display="none";
   alert("Record delete successfully complete");
   
   }else
   {
     alert("Sorry,Request failed,Please try again later");
         return false;  
   }
   
     }else
     {
         alert("Sorry,Request failed,Please try again later");
         return false;
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="delete_ajax_code.php";
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&account_group_name_id="+delete_tr_name;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
   
  } 
  }
  }
        </script>      
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td style="background-image:url('finanacephoto/bgblack.png');  font-weight:bold; ">
                        
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
                                    <td colspan="6" class="td_leftpadding" 
                                        style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                        <strong>View Account Details</strong>   
  <a href="financeaccount_addaccount.php" border="0" style=" text-decoration:none; ">
      <abbr title="Add New Account Deatil">
                                    <div id="top_add_view_div">
                                        <strong>Add New Account</strong>
                                    </div>
  </abbr>
                                    </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='td_border_color' id="tdleft">
                                      <strong>  Sl.No</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Account Type</strong>
                                    </td>
                                    <td class='td_border_color'>
                                        <strong>Account Group</strong>
                                    </td>
                                    
                                    <td class='td_border_color'>
                                        <strong>Account Name</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Description</strong>
                                    </td>
                                    <td class='td_border_color'>
                                   <strong>Action</strong>
                                    </td>
                                    
                                    
                                </tr>
                            <?php 
                              $row=0;
                              $account_db=mysql_query("SELECT * FROM financeaccountdetail WHERE organization_id='$fetch_school_id' and 
                                  branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and action='active'");
                              while ($fetch_account_data=mysql_fetch_array($account_db))
                              {
                                 $row++;
                                 $fetchdataid=$fetch_account_data['id'];
                                 $encrypt_id=$fetch_account_data['encrypt_id'];
                                  $fetch_account_name=$fetch_account_data['accountname'];
                                  $fetch_account_type=ucfirst($fetch_account_data['account_type']);
                                  $fetch_account_group_id=$fetch_account_data['account_group_id'];
                                  $fetch_account_description=$fetch_account_data['accountdescription'];
                                  
                                  
    $account_group_db=mysql_query("SELECT * FROM financeaccountheadhdetail WHERE account_head_id='$fetch_account_group_id'");
    $fetch_account_head_data=mysql_fetch_array($account_group_db);
    $fetch_account_num_rows=mysql_num_rows($account_group_db);
    if((!empty($fetch_account_head_data))&&($fetch_account_head_data!=null)&&($fetch_account_num_rows!=0))
    {
      $fecth_account_group_name=$fetch_account_head_data['accountheadgroupname']; 
    }  else {
         $fecth_account_group_name="Missing";
    }
                                  
                                  
                                  echo "<tr id='delete_row_$fetchdataid'>
                                  <td class='td_viewvalue' id='tdleft'>$row</td>
                                  <td class='td_viewvalue'>$fetch_account_type</td>
                                  <td class='td_viewvalue'>$fecth_account_group_name</td>
                                  <td class='td_viewvalue'>$fetch_account_name</td>
                                  <td class='td_viewvalue'>$fetch_account_description</td>
                                  <td class='td_viewvalue' style='width:132px;'>
                                   <abbr title='Edit'>";
                        {
                        ?>
                                <a style="color:blue;" href="#" onclick="window.open('edit_account_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=500,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        
                            <div class='edit_delete_buttons' style='background-color:green; width:45px;'>Edit</div></a>
                      <?php 
                        }
                           echo "</abbr>
                            <abbr title='Delete'>";
                        {
                        ?>
                            <div onclick="remove_record('<?php  echo $fetchdataid;?>')" class='edit_delete_button'>Delete</div>
                         <?php 
                        }
                           echo " </abbr>
                                  </td>
                                  
                                  </tr>";
                                  
                              }
                              
                              ?>
                                
                                
                                
                                         <?php 
}
}
             ?>
                                <tr>
                                    <td>
                                        </br>   
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                    </td>
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