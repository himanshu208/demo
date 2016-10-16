<?php
session_start();
ob_start();
if(isset($_SESSION['student_id']))
{
    unset($_SESSION['student_id']);
    if(isset($_SESSION['student_id']))
    {
        session_destroy();
        header("Location:login.php"); 
    }else
    {
       
      header("Location:login.php");   
    }
    
}else
{
    header("Location:login.php");
}
?>