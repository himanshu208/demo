<?php
function sms_api($user_mobile_no,$user_message,$user_id,$unicode)
{
 
$user_name="t4t4jdconvent";
$password="508919";
$to=$user_mobile_no;
$from="JDCSCH";
$message_send=rawurlencode($user_message);

$url="http://nimbusit.net/api.php";
$data="username=$user_name&password=$password&sender=$from&sendto=$to&message=$message_send".$unicode."";
   
    //The function uses CURL for posting data to server
        $objURL = curl_init($url);
        curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($objURL,CURLOPT_POST,1);
        curl_setopt($objURL, CURLOPT_POSTFIELDS,$data);
        $retval = trim(curl_exec($objURL));
        curl_close($objURL);
      

if($retval=="Less credits to send sms")
{
return 0;  
}else
  if($retval=="Invalid Request")
{
return 2;  
}else
{
return $retval;    
}
    
}




?>
