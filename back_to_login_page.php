<?php
ob_start();
session_start(); 

session_destroy();
if(isset($_SESSION['verify_account_permission']))
{
    unset($_SESSION['verify_account_permission']);
    unset($_SESSION['admin_session_on']);
    unset($_SESSION['super_admin_session_on']);
session_destroy();
header("Location:loginPage.php"); 
}  else {
  session_destroy();
   unset($_SESSION['verify_account_permission']);
    unset($_SESSION['admin_session_on']);
    unset($_SESSION['super_admin_session_on']);
header("Location:loginPage.php");   
}
?>