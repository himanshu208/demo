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
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="account_javascript/delete_javascript.js"></script>
        <title>List Of Fee Group</title>
    </head>
   
    
    <body style=" margin: 0;padding: 0;">
        
    <?php 
      include_once '../ajax_loader_page_second.php';
      ?>  
        
         <div id="financefirstdiv">
         <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
           <input id="organization_id" name='organization_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
             <input id="branch_id" name='branch_id' value="<?php  echo $fetch_branch_id;?>" type="hidden">
            
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td style="">
                        
                              <?php 
                                include_once 'heademastersetting.php';
                                ?>
                             <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">  
                        <style>
                         #color_6{ background-color:dodgerblue; color:white; border-top-left-radius:3px;
                         border-top-right-radius:3px; }   
                        </style>  
                    </td>
                </tr> 
                <tr>
                    <td>
                        <div id="valuediv">
                        
                            <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="4" class="td_leftpadding" 
                                        style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                        <strong>List Of Fee Group</strong>   
  <a href="financeadd_fee.php" border="0" style=" text-decoration:none; ">
                                    <div id="top_add_view_div">
                                        <strong>Add New Fee Group</strong>
                                    </div>
                                    </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='td_border_color' id="tdleft">
                                      <strong>Sl.No</strong>
                                    </td>
                                    <td class='td_border_color'>
                                        <strong>Fee Group</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Fee Group Description </strong>
                                    </td>
                                    <td class='td_border_color'>
                                   <strong>Action</strong>
                                    </td>
                                    
                                    
                                </tr>
                             <?php 
                        require_once '../connection.php';
                        $row=0;
                        $feefinancedatabase=mysql_query("SELECT * FROM financeaddfee WHERE organization_id='$fetch_school_id' and 
branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and action='active'");
                        
                        while ($fetchthisvalue=mysql_fetch_array($feefinancedatabase))
                        {
                            $fetchdataid=$fetchthisvalue['id'];
                            $encrypt_id=$fetchthisvalue['encrypt_id'];
                            $fetchfeename=ucfirst($fetchthisvalue['fee_name']);
                            $feedesciption=ucfirst($fetchthisvalue['feedescription']);
                            $row++;
                        echo "<tr id='delete_row_$fetchdataid'>
                            <td class='td_viewvalue' id='tdleft'>$row</td>
                            <td class='td_viewvalue'>$fetchfeename</td>
                            <td class='td_viewvalue'>$feedesciption</td>
                            <td class='td_viewvalue' style='width:132px;'>
                            <abbr title='Edit'>";
                        {
                        ?>
                         <a style="color:blue;" href="#" onclick="window.open('edit_fee_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=400,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                         <div class='edit_delete_buttons' style='background-color:green; width:45px;'>Edit</div></a>
                      <?php 
                        }
                           echo "</abbr>
                            <abbr title='Delete'>";
                        {
                        ?>
                            <div onclick="delete_data('<?php  echo $fetchdataid;?>','fee_tr_name')" class='edit_delete_button'>Delete</div>
                         <?php 
                        }
                           echo " </abbr>
                            
                            </td>
                            
</tr>                            
";
                        
                        }
                        
                        if(empty($fetchfeename))
                        {
                        echo "
<tr>
<td colspan='4' class='td_viewvalue' id='tdleft'>
<strong style='color:red;'>Record no found !!</strong>
</td>
</tr>
";
                        }                 
                        
                               ?>
                                
                                <tr>
                                    <td>
                                        </br>   
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                    </td>
              <tr>
                    <td>
                        <div style=" width:300px; height:40px;  ">
                            
                        </div>
                    </td>
                </tr>
            </table> 
         </form>
         </div>
       
         <div id="attechfotter" style=" width:100%; height:22px; position:fixed; bottom:0px; ">
          <?php 
              include 'financefotter.php';
            ?>
        </div> 
         </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>