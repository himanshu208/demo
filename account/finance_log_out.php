<?php 
ob_start(); session_start(); 
 if(isset($_SESSION['school_admin_unique_id_session_active']))
 {
if(isset($_SESSION['finance_module']))
{
unset($_SESSION['finance_module']);
header("Location:../admin.php");

}
   
 }else
 {
     unset($_SESSION['finance_module']);
     session_destroy();
  header("Location:../loginPage.php");     
 }


?>
