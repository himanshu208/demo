<?php
function data_insert($table_name,$data_input,$match_data_input)
{
  require_once '../connection.php';
  
  $fields=array_keys($data_input);  
  $values=array_map( "mysql_real_escape_string", array_values($data_input) );
   
  $select_db=mysql_query("SELECT * FROM $table_name WHERE ".implode(' ',$match_data_input)."");
  $select_data=mysql_fetch_array($select_db);
  $select_num_rows=mysql_num_rows($select_db);
  if((empty($select_data))&&($select_data==null)&&($select_num_rows==0))
  {
      
  }else
  {
   $message_show="<div class='notification_alert_show'>Record already exist in database.</div>";   
  }
   
  
  return $message_show;
}
?>