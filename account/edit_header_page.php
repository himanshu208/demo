<?php 
require_once '../connection.php';
if(isset($_POST['change_session_id']))
{
 if(!empty($_POST['change_session_id']))
 {
 $session_current_id=$_POST['change_session_id'];  
 $_SESSION['working_session_year']=$session_current_id;
 }
}

      $session__new_activate_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and by_defult='active'"); 
      $fecth_session_active_data=  mysql_fetch_array($session__new_activate_db);
      $fecth_session_num_rows=  mysql_num_rows($session__new_activate_db);
      if((!empty($fecth_session_active_data))&&($fecth_session_active_data!=null)&&($fecth_session_num_rows!=0))
      {
       $fecth_session_id_set_tmep=$fecth_session_active_data['session_id']; 
       $session_name=$fecth_session_active_data['session_name']; 
       
      }else
      {
       echo "<style>#session_not_active{ display:block; }</style>"; 
      }

if(isset($_SESSION['working_session_year']))
{
 $fecth_session_id_set=$_SESSION['working_session_year'];  
}else
{
  $fecth_session_id_set=$fecth_session_id_set_tmep; 
}

?>
   
<html>
    <head>
        <meta charset="UTF-8">
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
         <script type="text/javascript">
        function RefreshParent() {
            if (window.opener != null && !window.opener.closed) {
                window.opener.location.reload();
            }
        }
        window.onbeforeunload=RefreshParent;
      </script> 
        <script type="text/javascript">
        function close_window()
        {
         var r=confirm("Are you sure you want to close current window");
if (r==true)
  {  
      window.opener.location.reload();
      window.close();
    }
        }
        </script>
        
        
        
        
        
        <title></title>
    </head>
    <body style="margin: 0; padding:0; ">
        <div id="edit_header_page_div">
            <div id="school_logo">
                <img height="50px" src="../<?php  echo $fetch_school_logo;?>">   
            </div>   
            
            <div onclick="close_window()" class="close_window">Close Window</div> 
            
        </div>
    </body>
</html>
