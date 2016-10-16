<?php
require_once 'connection.php';
if(!empty($_REQUEST['token_id']))
{
 $token_id=$_REQUEST['token_id'];
 
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

function gen_random_string($length=6)
{
   $chars ="012345678998765432115425478965478598721457796328978998854551124787521";//length:36
    $final_rand='';
    for($i=0;$i<$length; $i++)
    {
        $final_rand .= $chars[ rand(0,strlen($chars)-1)];
 
    }
    return $final_rand;
} 

$verify_account_otp="123456";
 
$update_otp_password=mysql_query("UPDATE admin_last_login_date_db SET otp_password='$verify_account_otp'"
        . " WHERE last_login_id='$token_id'");    
if($update_otp_password)
{
    echo "1";
}else
{
    echo "2";
}
}else
{
    echo "3";  
}
?>