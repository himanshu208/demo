<?php
//SESSION CONFIGURATION
$check_array_in="parent";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?> 
<?php
      require_once '../connection.php';
      if((!empty($_REQUEST['parent_full_detail_id'])))
      {
          $token_id=$_REQUEST['parent_full_detail_id'];
          
         $parent_db=mysql_query("SELECT * FROM parent_db WHERE parent_unique_id='$token_id' and is_delete='none'");
         $fetch_parent_data=mysql_fetch_array($parent_db);
         $fetch_parent_num_rows=mysql_num_rows($parent_db);
         if((!empty($fetch_parent_data))&&($fetch_parent_data!=null)&&($fetch_parent_num_rows!=0))
         {              
    $parent_unqiue_id=$fetch_parent_data['parent_unique_id'];
    $parent_encrypt_id=$fetch_parent_data['encrypt_id'];
    
    
    $student_db=mysql_query("SELECT * FROM student_db as T1 WHERE $db_t1_main_details parent_id='$parent_unqiue_id' and is_delete='none'");
    $student_num_rows=mysql_num_rows($student_db);
    
         {
             ?>
                 <div class='heading_title' style=' background-color:whitesmoke; padding-bottom:4px;'>Parent Full Detail</div>
                   <br/>
                 <div class="header_top_button" onclick="parent_back()">Back</div>
                 <a href="#" onclick="window.open('edit_parent.php?token_id=<?php  echo $parent_encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                  <div class="header_top_button" style=" background-color:green; ">Edit</div></a>
                  
                  <?php
                  if(!empty($student_num_rows))
                  {
                  {
                  ?>
                 <div class="header_top_button" style=" background-color:red; opacity:.5; cursor:not-allowed;  ">Delete</div>
                 <?php
                  }
                      
                  }else
                  {
                  ?>
                   <div class="header_top_button" onclick="delete_data('<?php echo $parent_unqiue_id;?>','parent_delete_command')" style=" background-color:red;">Delete</div>
                   <?php
                  }
                   ?>
                   <div style=" width:100%; height:auto; float:left; margin-top:20px;   border-top:1px solid black;  ">
                       <table id="parent_table" style=" width:100%; ">
                    
                           
             <?php
         }   
             
    
    $parent_father_name=$fetch_parent_data['father_name'];
    $parent_father_mobile_no=$fetch_parent_data['father_mobile_no'];
    $parent_father_email_id=$fetch_parent_data['father_email'];
    $parent_father_qualification=$fetch_parent_data['father_qualification'];
    $parent_father_occupation=$fetch_parent_data['father_occupation'];
    $parent_father_annual_income=$fetch_parent_data['father_annual_income'];
    $parent_father_photo=$fetch_parent_data['father_photo'];
    
    if(empty($parent_father_photo))
    {
    $parent_father_photo="images/no_avilable_image.gif";    
    }  else {
      $parent_father_photo=$parent_father_photo;    
       
    }
    
    
    $parent_mother_name=$fetch_parent_data['mother_name'];
    $parent_mother_mobile_no=$fetch_parent_data['mother_mobile_no'];
    $parent_mother_email_id=$fetch_parent_data['mother_email_id'];
    $parent_mother_qualification=$fetch_parent_data['mother_qualification'];
    $parent_mother_occupation=$fetch_parent_data['mother_occupation'];
    $parent_mother_annual_income=$fetch_parent_data['mother_annual_income'];
    $parent_mother_photo=$fetch_parent_data['mother_photo'];
    
    
    if(empty($parent_mother_photo))
    {
    $parent_mother_photo="images/no_avilable_image.gif";    
    }  else {
      $parent_mother_photo=$parent_mother_photo;    
       
    }
    
    $parent_local_parent_relation=$fetch_parent_data['local_parent_relation'];
    $parent_local_parent_name=$fetch_parent_data['local_parent_name'];
    $parent_local_parent_mobile_no=$fetch_parent_data['local_parent_mobile_no'];
    $parent_local_parent_email=$fetch_parent_data['local_parent_email_id'];
    $parent_local_parent_qualification=$fetch_parent_data['local_parent_qualification'];
    $parent_local_parent_occupation=$fetch_parent_data['local_parent_occupation'];
    $parent_local_parent_annual_income=$fetch_parent_data['local_parent_annual_income'];
    $parent_local_parent_photo=$fetch_parent_data['local_parent_photo'];
    
    if(empty($parent_local_parent_photo))
    {
    $parent_local_parent_photo="images/no_avilable_image.gif";    
    }  else {
      $parent_local_parent_photo=$parent_local_parent_photo;    
       
    }
                  
    $parent_user_name=$fetch_parent_data['user_name'];
    $parent_password=$fetch_parent_data['temp_password'];
                     
               echo "   <tr>
                         <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9' style='font-size:15px;'><span><b>Father Detail</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Father Name</b></td><td><b>:</b></td><td> $parent_father_name</td>
                    
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $parent_father_mobile_no</td>
                    <td></td><td></td>
                    <td rowspan='8' style=' width:160px; '><img class='parent_image' src='../$parent_father_photo'></td>
                    </tr>
                    
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Email Id</b></td><td><b>:</b></td><td>  $parent_father_email_id</td>
                    
                    <td><b>Qualification</b></td><td><b>:</b></td><td> $parent_father_qualification</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Occupation</b></td><td><b>:</b></td><td> $parent_father_occupation</td>
                    
                    <td><b>Annual Income</b></td><td><b>:</b></td><td> $parent_father_annual_income</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9' style='font-size:15px;'><span><b>Mother Detail</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Mother Name</b></td><td><b>:</b></td><td> $parent_mother_name</td>
                    
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $parent_mother_mobile_no</td>
                    <td></td><td></td>
                    <td rowspan='8' style=' width:160px; '><img class='parent_image' src='../$parent_mother_photo'></td>
                    </tr>
                    
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Email Id</b></td><td><b>:</b></td><td> $parent_mother_email_id</td>
                    
                    <td><b>Qualification</b></td><td><b>:</b></td><td> $parent_mother_qualification</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Occupation</b></td><td><b>:</b></td><td> $parent_mother_occupation</td>
                    
                    <td><b>Annual Income</b></td><td><b>:</b></td><td> $parent_mother_annual_income</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>";
                    
                    
                    
                    
                   if((!empty($parent_local_parent_relation))&&(!empty($parent_local_parent_name))) 
                   {
                    
                   echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9' style='font-size:15px;'><span><b>Local Guardian Detail</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Guardian Relation</b></td><td><b>:</b></td><td> $parent_local_parent_relation</td>
                    
                    <td><b></b></td><td></td><td></td>
                    <td></td><td></td>
                    <td rowspan='10' style=' width:160px; '><img class='parent_image' src='../$parent_local_parent_photo'></td>
                    </tr>
                    
                     <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Guardian Name</b></td><td><b>:</b></td><td> $parent_local_parent_name</td>
                    
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $parent_local_parent_mobile_no</td>
                    <td></td><td></td>
                    
                    
                    
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Email Id</b></td><td><b>:</b></td><td> $parent_local_parent_email</td>
                    
                    <td><b>Qualification</b></td><td><b>:</b></td><td> $parent_local_parent_qualification</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Occupation</b></td><td><b>:</b></td><td> $parent_local_parent_occupation</td>
                    
                    <td><b>Annual Income</b></td><td><b>:</b></td><td> $parent_local_parent_annual_income</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>";
                    
                   }
                   
                   echo "<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9' style='font-size:15px;'><span><b>Account Login Detail</b></span></td>
                    </tr>
                     <tr>
                      <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                     <tr>
                    <td><b>Username</b></td><td><b>:</b></td><td> $parent_user_name</td>
                    
                    <td><b>Password</b></td><td><b>:</b></td><td> $parent_password</td>
                    <td></td><td></td>
                    </tr>  "; 
                    
                   
                   
                   
                   
                   
                   echo"  <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9' style='font-size:15px;'><span><b>Children</b></span></td>
                    </tr>
                     <tr>
                      <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
";
                   
                   
         }
         {
             ?>
                       </table>
                           <?php
         }
      }
         
                     ?> 
                       <?php
}
?>