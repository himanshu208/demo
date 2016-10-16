<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Pixabyte Technologies Pvt. Ltd.</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
    </head>
    <body>
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" name="myForm" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
        
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="system_dashboard.php">System Setting</a></td>
                           <td>/</td>
                           <td>Manage Branch Detail</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
               
             <?php  
                   $branch_record_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and action='active'");
                   $fetch_branch_data=mysql_fetch_array($branch_record_db);
                   $fetch_branch_num_rows=mysql_num_rows($branch_record_db);
                   if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
                   {
                    $fetch_organization_id=$fetch_branch_data['organization_id'];
                    $fetch_branch_id=$fetch_branch_data['branch_id'];
                    $encrypt_branch_id=$fetch_branch_data['branch_encrypt_id'];
                    $branch_name=ucfirst($fetch_branch_data['branch_name']);
                    $affiliation_from=$fetch_branch_data['affiliation_from'];
                    $affilation_number=$fetch_branch_data['affiliation_number'];
                    $trust_name=$fetch_branch_data['trust_name'];
                    $trust_number=$fetch_branch_data['trust_number'];
                    $website=$fetch_branch_data['website'];
                    $contact_no=$fetch_branch_data['contact_no'];
                    $email_id=$fetch_branch_data['email_id'];
                    $fax_no=$fetch_branch_data['fax_no'];
                    $address=$fetch_branch_data['address'];
                    $establish_year=$fetch_branch_data['establish_year'];
                    $description=$fetch_branch_data['description'];
                    $branch_logo=$fetch_branch_data['branch_logo'];
                    $report_logo=$fetch_branch_data['report_logo'];
                    $account_status=  ucfirst($fetch_branch_data['account_status']);
                    if($account_status=="Active")
                    {
                     $account_status="<b style='color:green;'>$account_status</b>";   
                    }else
                    {
                     $account_status="<b style='color:red;'>$account_status</b>";    
                    }
                    
                    $principal_name=ucwords($fetch_branch_data['principal_name']);
                    $principal_phone=$fetch_branch_data['principal_phone'];
                            $principal_mobile=$fetch_branch_data['principal_mobile'];
                            $principal_email=$fetch_branch_data['principal_email'];
                            
                          $student_prefix_no=$fetch_branch_data['student_prefix_no'];
                          $employee_prefix_no=$fetch_branch_data['employee_prefix_no'];
                    
                    
           $organisation_db=mysql_query("SELECT * FROM organization_db WHERE organization_id='$fetch_organization_id'");         
            $fetch_org_data=mysql_fetch_array($organisation_db);
            $fetch_org_num_row=mysql_num_rows($organisation_db);
            
            if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_row!=0))
            {
            $school_name=$fetch_org_data['school_name'];   
            }else
            {
             $school_name="";   
            }
                    
                       
                   {
                   ?>
               
                <div id="top_show_button">
                    <div id="transport_function" class="Short_menu_show"><b>Branch Details</b></div>
                     <a style="color:blue;" href="#" onclick="window.open('edit_branch_details.php?token_id=<?php  echo $encrypt_branch_id;?>','size',config='height=650,width=1110,position=absolute,left=10,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                     <div class="view_button">Edit Branch Detail</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   
                   <table class="branch_details_table">
                       <tr>
                        <td colspan="6" style=" font-size:16px; "><b>Branch Details</b><br/>
                        <div class="horizental_line_ed"></div>
                        </td>
                       </tr>
                       <tr>
                           <td><b>School</b></td><td><b>:</b></td><td><b><?php  echo $school_name;?></b></td>
						    <td><b>Branch Name</b></td><td><b>:</b></td><td><?php  echo $branch_name;?></td>
                           <td rowspan="8"  colspan="4" valign="top">
                               <table style=" margin:0; padding:0;  ">
                                   <tr>
                                       <td><div class="branch_logo_show">
                                                       <img class="show_logo" src='../<?php  echo $branch_logo;?>'> 
                                           </div></td>
                                   </tr>
                                   <tr>
                                       <td style=" font-size:15px; "><centeR><b> Logo</b></centeR></td>
                                   </tr>
                               </table>
                           </td>
                       </tr>
                       
                       <tr>
                           <td><b>Affiliation From</b></td><td><b>:</b></td><td><?php  echo $affiliation_from;?></td>
						   <td><b>Affiliation Number</b></td><td><b>:</b></td><td><?php  echo $affilation_number;?></td>
                       </tr>
                       
                        <tr>
                           <td><b>Trust Name</b></td><td><b>:</b></td><td><?php  echo $trust_name;?></td>
						    <td><b>Trust Number</b></td><td><b>:</b></td><td><?php  echo $trust_number;?></td>
                   
                       </tr>
                       <tr>
                           <td><b>Website</b></td><td><b>:</b></td><td><?php  echo $website;?></td>
						    <td><b>Contact Number</b></td><td><b>:</b></td><td><?php  echo $contact_no;?></td>
                      
                       </tr>
                       <tr>
                           <td><b>Email</b></td><td><b>:</b></td><td><?php  echo $email_id;?></td>
                       
                           <td><b>Fax Number</td><td><b>:</b></td><td><?php  echo $fax_no;?></td>
                       </tr>
                       <tr>
                           <td><b>Address</b></td><td><b>:</b></td><td colspan=""><?php  echo $address;?></td>
						   <td><b>Establish Year</b></td><td><b>:</b></td><td><?php  echo $establish_year;?></td>
                         
                       </tr>
                       <tr>
                              <td><b>Currency</b></td><td><b>:</b></td><td><?php  echo $establish_year;?></td>
							   <td><b>Account Status</b></td><td><b>:</b></td><td><?php  echo $account_status;?></td>
                      
                       </tr>
                       <tr>
                           <td><b>Description</b></td><td><b>:</b></td><td colspan="4"><?php  echo $description;?></td>
                       </tr>
                        <tr>
                           <td style=" height:5px; "></td>
                       </tr>
                       <tr>
                        <td colspan="6" style=" font-size:16px; "><b>Principal Detail</b><br/>
                        <div class="horizental_line_ed"></div>
                        </td>
                       </tr>
                        <tr>
                           <td><b>Name of the Principal</b></td><td><b>:</b></td><td><?php  echo $principal_name;?></td>
                            <td><b>Phone</b></td><td><b>:</b></td><td><?php  echo $principal_phone;?></td>
                       </tr>
                       <tr>
                           <td><b>Mobile</b></td><td><b>:</b></td><td><?php  echo $principal_mobile;?></td>
                            <td><b>Email of the Principal</b></td><td><b>:</b></td><td><?php  echo $principal_email;?></td>
                       </tr>
                       <tr>
                           <td style=" height:5px; "></td>
                       </tr>
                       <tr>
                        <td colspan="6" style=" font-size:16px; "><b>Prefix For Admission Number/Employee Number</b><br/>
                        <div class="horizental_line_ed"></div>
                        </td>
                       </tr>
                       <tr>
                           <td><b>Prefix For Student Admission No.</b></td><td><b>:</b></td><td><?php  echo $student_prefix_no;?></td>
                            <td><b>Prefix For Employee Number</b></td><td><b>:</b></td><td><?php  echo $employee_prefix_no;?></td>
                       </tr>
                       <tr>
                           <td style=" height:5px; "></td>
                       </tr>
                       <tr>
                        <td colspan="6" style=" font-size:16px; "><b>Bill Header Logo</b><br/>
                        <div class="horizental_line_ed"></div>
                        </td>
                       </tr>
                       <tr>
                           <td colspan="6">
                               <div class="report_logo">
                                   <img src="../<?php  echo $report_logo;?>"   
                               </div>   
                           </td>
                       </tr>
                       
                   </table>     
                 <?php 
                   }
                   }
                   ?>
               </div>
                
             
                
                
               
            </div> 
        </div>
        </form>
        
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