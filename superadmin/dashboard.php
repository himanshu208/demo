<?php 
session_start(); 
ob_start();
?>
<?php 
require_once '../connection.php';
if(isset($_SESSION['super_admin_session_on']))
{
$user_unique_id=$_SESSION['super_admin_session_on'];
$user_db=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id='$user_unique_id'");
$fetch_user_data=mysql_fetch_array($user_db);
$fetch_user_num_rows=mysql_num_rows($user_db);
if((!empty($fetch_user_data))&&($fetch_user_data!=null)&&($fetch_user_num_rows!=0))
{
  $fetch_school_id=$fetch_user_data['organization_id'];
  $fetch_branch_id=$fetch_user_data['branch_id'];
  
$organisation_db=mysql_query("SELECT * FROM organization_db  WHERE organization_id='$fetch_school_id'"); 
 $fetch_org_data=mysql_fetch_array($organisation_db);
 $fetch_org_num_rows=mysql_num_rows($organisation_db);
if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_rows!=0))
{
$fetch_school_logo=$fetch_org_data['school_logo'];  
$branch_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id'");  
$fetch_branch_data=mysql_fetch_array($branch_db);
$fetch_branch_num_rows=mysql_num_rows($branch_db);
 if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
 { 
$manage_module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id'"); 
$fetch_module_data=  mysql_fetch_array($manage_module_db);
$fetch_module_num_rows=  mysql_num_rows($manage_module_db);
if((!empty($fetch_module_data))&&($fetch_module_data!=null)&&($fetch_module_num_rows!=0))
{
{
?>




<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        
    </head>
    <body>
        <div id="include_header_page">
       <?php 
            include_once 'header_page.php';
         ?>   
        </div>
        <div id="include_fotter_page">
          <?php 
             include_once 'fotter_page.php';
            ?>
        </div>
    </body>
</html>
<?php 
}
}else
 {
 header("Location:manage_module.php");   
 }
 }else
 {
 header("Location:branch_details.php");   
 }
 }else
{
     header("Location:../organisation_details.php");
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