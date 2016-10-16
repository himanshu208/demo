<?php
//SESSION CONFIGURATION
$check_array_in="transport";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Vehicle Description</title>
    </head>
    <body style=" font-family:arial; font-size:13px; ">
      <?php
      
      
      ?>
 
         
            
            
            <?php
          require_once '../connection.php';
            if(!empty($_REQUEST['token_id']))
            {
             $token_id=$_REQUEST['token_id'];   
            $vehicle_db=mysql_query("SELECT * FROM  transport_vehicle_db WHERE encrypt_id='$token_id' and is_delete='none'");   
           $fetch_vehicle_data=mysql_fetch_array($vehicle_db);
           $fetch_vehicle_num_rows=mysql_num_rows($vehicle_db);
           
           if((!empty($fetch_vehicle_data))&&($fetch_vehicle_data!=null)&&($fetch_vehicle_num_rows!=0))
           {
               echo ' <div style=" width:80%; height:auto; margin:0 auto;  padding:2em; background-color:aliceblue; border:1px solid aquamarine;     ">
         ';
             $fetch_description=$fetch_vehicle_data['description'];
             echo ' <b style=" text-align:left; ">Description</b><br/>
            <hr/>';
             
             echo "<p>$fetch_description</p>";
             echo '</div>';  
               
           }else
            {
                echo "record no found !"; 
            }
            
            
            }else
            {
                echo "record no found !"; 
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