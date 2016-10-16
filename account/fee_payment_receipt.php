<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript">
          function print_window()
          {
          window.print(); 
        window.onfocus=function(){ window.close();}
          }
        </script>
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
         
    </head>
    <body onload="print_window()">
       
      <?php
      if($recipt_format=="a4")
      {
          include_once 'a4_receipt.php';   
      }else
          if($recipt_format=="a5")
      {
          include_once 'a5_receipt.php';   
      }else
          if($recipt_format=="a6")
      {
          include_once 'a6_receipt.php';   
      }else
      {
          include_once 'a4_receipt.php';   
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