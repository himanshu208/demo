<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>



<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       
        
        <script type="text/javascript">
    window.onload = refreshParent;
    function refreshParent() {
     window.opener.location.reload();
    }
   
   function close_pop_up_this()
   {
   window.close();    
   }
   
</script>


        <script type="text/javascript">
            function ok_close()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
             function close_button()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
   document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) 
    {
       document.getElementById("win_pop_up").style.display="none";
    }else
    if (evt.keyCode == 13) 
    {
    document.getElementById("win_pop_up").style.display="none";
    }
};
            
            </script>
            
             <script type="text/javascript">
             function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
            </script> 
            
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validate_form();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Section Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
            
            
            <table cellspacing="4" cellpadding="2" id="org_table_style" style="margin:0 auto;
                         margin-top:10px;  font-size:12px;  ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    
                    <tr><td>Class <sup>*</sup><br/><span style=" font-size:10px; color:red;  ">(Enter Only Alphabet)</td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="class_name" 
                                   value="" placeholder="Enter section/class name" class="text_box_org"
                                   name="class_name"></td>
                    </tr>
                    <tr><td>Section</td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="class_full_name" 
                                   value=""   placeholder="Enter section/class full name" class="text_box_org"
                                   name="class_full_name"></td>
                    </tr>
                    
                     <tr>
                        <td>Description</td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter session description" name="description" 
                                      id="address_text_area"></textarea>
                        </td>
                    </tr>
                     <tr><td>Strength <sup>*</sup><br/><span style=" font-size:10px; color:red;  ">(Enter Only Numeric Value)</span></td>
                        <td><b>:</b></td>
                        <td><input type="text" id="strength"  style=" width:30%; text-align:center; "
                                   value="" class="text_box_org" onkeypress="javascript:return isNumber (event)"
                                   name="class_strength" ></td>
                    </tr>
                    
                     <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button" onclick="return org_validate();" id="save_button"  value="Update">   
                        </td>
                    </tr>
               </table>   
            
            </div>
            </div>
            <div class="edit_fotter_div_tag">Design & Develop By : Pixabyte Technologies Pvt. Ltd.</div>
            
            
        </div>
       </form>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>