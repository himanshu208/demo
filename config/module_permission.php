<?php
function module_permission($check_array_in,$operation_permission)
{
 
  $search_match_module=in_array($check_array_in,$explode_module_array);
  if($search_match_module==true)
  { 
    $module_connect=1;
    return $module_connect;
  }else
  {
  $module_connect=0;
  return $module_connect;    
  }
}
?>