<?php
//SESSION CONFIGURATION
$check_array_in="hr";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
                
        <?php
function user_name($length=6)
{
   $chars ="abcdefghijklmnopqrstuvwxyz123456789987654321";//length:36
    $final_rand='';
    for($i=0;$i<$length; $i++)
    {
        $final_rand .= $chars[ rand(0,strlen($chars)-1)];
 
    }
    return $final_rand;
}

 function password($length=8)
{
   $chars ="123456789987654321";//length:36
    $final_rand='';
    for($i=0;$i<$length; $i++)
    {
        $final_rand .= $chars[ rand(0,strlen($chars)-1)];
 
    }
    return $final_rand;
}
        
        ?>
        
             
        
        <?php
require_once '../connection.php';
 $employee_db=mysql_query("SELECT *,T1.id as db_id,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                      . "LEFT JOIN hr_family_db as T3 ON T1.family_id=T3.family_unique_id "
                      . "LEFT JOIN hr_department_db as T4 ON T1.department_id=T4.department_id "
                      . "LEFT JOIN hr_designation_db as T5 ON T1.designation_id=T5.designation_id "
                      . "LEFT JOIN hr_bank_db as T6 ON T1.bank_id=T6.bank_unique_id "
                      . "LEFT JOIN category_db as T8 ON T1.category_id=T8.category_id WHERE T1.is_delete='none'");
              $empoyee_num_rows=mysql_num_rows($employee_db);
              while ($employee_data=mysql_fetch_array($employee_db))
              {
             
                $employee_unique_id=$employee_data['t1_employee_id'];
                $employee_db_id=$employee_data['db_id'];
                $employee_encrypt_id=$employee_data['t1_encrypt_id'];
                $employee_no=$employee_data['employee_no'];
              
                  $employee_username=user_name();
               $employee_passwprd=password();
               $encrypt_password=md5($employee_passwprd);
                
$update_db=mysql_query("UPDATE hr_employee_db SET user_name='$employee_username',password='$encrypt_password',temp_password='$employee_passwprd' WHERE employee_id='$employee_unique_id'");
             
if((!empty($update_db))&&($update_db))
{
    echo "record update sucessfully complete";
}else
{
    echo "recored failed";   
}
                
                
              }

        ?>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>