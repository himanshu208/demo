<?php
//SESSION CONFIGURATION
$check_array_in="telephone_diary";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>



<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>List Of Contact</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        <script type="text/javascript">
        function search_value()
        {
         var group_id=document.getElementById("group_id").value;
                 var search_by=document.getElementById("search_by").value;
                 var search_qq=document.getElementById("search_qq").value;
        if((group_id==0)&&(search_by==0)&&(search_qq==0))
        {
           alert("Please select atleast one option");
           return false;
        }else
            if((search_by==0)&&(search_qq!=0)&&(group_id==0))
        {
            alert("Please select search by");
            return false
        }else
         if((search_by!=0)&&(search_qq==0)&&(group_id==0))
        {
            alert("Please enter search keyword here");
            return false
        }else
       if((search_by==0)&&(search_qq==0)&&(group_id!=0))
        {
        window.location.assign("list_of_contact.php?xmlgroup="+group_id+"&xmlsearchby="+search_by+"&xmlsearchqq="+search_qq+"");   
        }else
        {
         window.location.assign("list_of_contact.php?xmlgroup="+group_id+"&xmlsearchby="+search_by+"&xmlsearchqq="+search_qq+"");   
           
        }
        }
        </script>
    </head>
    <body onload="page_load()">
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                      <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="telephonediary_report.php">Telephone Diary</a></td>
                           <td>/</td>
                           <td>List Of Contact</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>List Of Contact</b></div>
                    <a href="add_new_contact.php">
                        <div class="view_button">Add New Contact</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   <table style=" margin:auto; margin-top:27px;  ">
                       <tr>
                           <td>
                               <b>Group</b>
                           </td>
                           <td><b>:</b></td>
                           <td>
                               <select id='group_id' class="select_styling_group">
                                   <option value="0">---Select---</option> 
                                      <?php
                                      if(!empty($_REQUEST['xmlgroup']))
                                      {
                                        $get_group=$_REQUEST['xmlgroup'];   
                                      }  else {
                                      $get_group="";    
                                      }
                                      
                                        $contact_group_db=mysql_query("SELECT * FROM contact_group_db WHERE $db_main_details_whout_session is_delete='none'");   
                     while ($fetch_contact_group_data=mysql_fetch_array($contact_group_db))
                     {
                  
                                $fetch_contact_group_db_id=$fetch_contact_group_data['id'];
                                $fetch_contact_group_name=ucwords($fetch_contact_group_data['group_name']) ;
                                $fetch_contact_group_description=$fetch_contact_group_data['description'];
                                if($get_group==$fetch_contact_group_db_id)
                                {
                                echo "<option value='$fetch_contact_group_db_id' selected>$fetch_contact_group_name</option>";       
                                }  else {
                                 echo "<option value='$fetch_contact_group_db_id'>$fetch_contact_group_name</option>";       
                                    
                                }
                                }
                                       ?>
                               </select>
                           </td>
                           <td style=" width:35px; "></td>
                           <td><b>Search By</b></td><td><b>:</b></td>
                                   <td><select id='search_by' class="select_styling_group">
                                           <option value="0">---Select---</option>
                                            <option id='T2.group_name' value="T2.group_name">Group Name</option>
                                           <option id='T1.name' value="T1.name">Name</option>
                                           <option id='T1.organization' value="T1.organization">Organization</option>
                                           <option id='T1.phone_number' value="T1.phone_number">Phone Number</option>
                                           <option id='T1.mobile_number' value="T1.mobile_number">Mobile Number</option>
                                           <option id='T1.email' value="T1.email">Email</option>
                               </select></td>
                                <td style=" width:35px; "></td>
                               <td><b>Keyword</b></td>
                               <td><b>:</b></td>
                               <td><input id='search_qq' value="<?php if(!empty($_REQUEST['xmlsearchqq'])){ echo $_REQUEST['xmlsearchqq']; }?>" placeholder="Enter search keyword here" class="text_box_search" type="text"></td>
                               <td style=" width:35px; "></td><td><input onclick="search_value()" type="button" class="search_button_css" value="Search"></td>
                       </tr>
                   </table>
                   <div id="top_buttons_div" style=" border-bottom:1px solid gray; "></div>
                   
                   <table cellspacing="0" cellpadding="0" class="table_details">
                       <tr>
                           <td class="th_styling">Sl.No.</td>
                           <td class="th_styling">Group</td>
                           <td class="th_styling">Name</td>
                           <td class="th_styling">Organization</td>
                            <td class="th_styling">Phone Number</td>
                           <td class="th_styling">Mobile Number</td>
                            <td class="th_styling">Email</td>
                             <td class="th_styling">Note</td>
                           <td class="th_styling" style=" border-right:1px solid gray;">Action</td>
                       </tr>
                       
                    <?php 
                    
                    if((!empty($_REQUEST['xmlgroup']))&&(!empty($_REQUEST['xmlsearchby']))&&(!empty($_REQUEST['xmlsearchqq'])))
                    {
                    $group=$_REQUEST['xmlgroup'];
                    $search_by=$_REQUEST['xmlsearchby'];
                    $search_qq=$_REQUEST['xmlsearchqq'];
                    
                    $search_result="T1.group_id='$group' and $search_by LIKE '%$search_qq%' and ";
                    }else
                        if((!empty($_REQUEST['xmlsearchqq']))&&(!empty($_REQUEST['xmlsearchby'])))
                        {
                    $search_by=$_REQUEST['xmlsearchby'];
                    $search_qq=$_REQUEST['xmlsearchqq'];
                    
                           $search_result=" $search_by LIKE '%$search_qq%' and ";
                       
                        }else
                    if(!empty($_REQUEST['xmlgroup']))
                    {
                     $group=$_REQUEST['xmlgroup'];
                    $search_result="T1.group_id='$group' and";    
                    }
                    else {
                      $search_result="";  
                    }
                    
                    
                    
                    $row=0;
                    
                    $contact_db=  mysql_query("SELECT * FROM contact_no_db as T1 "
                            . "LEFT JOIN contact_group_db as T2 ON T1.group_id=T2.id "
                            . "WHERE $db_t1_main_without_session $search_result T1.is_delete='none'");
                    while ($contact_data=mysql_fetch_array($contact_db))
                     {     
                    $row++;    
                    $fetch_contact_id=$contact_data['contact_id'];
                    $encrypt_id=$contact_data['encrypt_id'];
                    $group=$contact_data['group_name'];
                            $name=$contact_data['name'];
                            $organization=$contact_data['organization'];
                            $phone_no=$contact_data['phone_number'];
                            $mobile_no=$contact_data['mobile_number'];
                            $email_id=$contact_data['email'];
                            $note=$contact_data['note'];
                            
                        echo "<tr id='delete_row_$fetch_contact_id'><td class='td_style'><center><b>$row</b></center></td>"
                                . "<td class='td_style'><center>$group</center></td>"
                                . "<td class='td_style'>$name</td>"
                                . "<td class='td_style'>$organization</td>"
                                . "<td class='td_style'>$phone_no</td>"
                                . "<td class='td_style'>$mobile_no</td>"
                                . "<td class='td_style'>$email_id</td>"
                                . "<td class='td_style'>$note</td>"
                                . "<td class='td_style' style=' width:130px; border-right:1px solid black;'>"; 
                        {
                            ?>
                          <abbr title="Edit contact">
                            <a style="color:blue;" href="#" onclick="window.open('edit_contact_number.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=600,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        </abbr>
                        
                        
                        <abbr title="Delete group">                            
                            <div onclick="delete_data('<?php  echo $fetch_contact_id;?>','contact_number_delete_command')" class="edit_delete_button">Delete</div>
                       </abbr>
                       <?php
                    }
                        echo"</td>"
                                . "</tr>";    
}
                   
                    ?>
                       
                       
                       
                   </table>       
                   
               </div>
                
             
                
                
               
            </div> 
        </div>
        <?php
        if(!empty($_REQUEST['xmlsearchby']))
        {
        ?>
        <script type="text/javascript">
        function page_load()
        {
       if(document.getElementById("<?php echo $_REQUEST['xmlsearchby'];?>"))
       {
       document.getElementById("<?php echo $_REQUEST['xmlsearchby'];?>").selected=true;    
       }
        }
        </script>
 <?php
} 
 ?>       
        <div id="include_fotter_page">
       <?php 
         require_once '../fotter/fotter_page.php';
         
         ?>   
        </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>