<?php
//SESSION CONFIGURATION
$check_array_in="transport";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>




<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        
        <script type="text/javascript">
           function filter_button()
           {
                    var vehicle_type=document.getElementById("vehicle_type").value;
                    var search_by=document.getElementById("search_by").value;
                    var search=document.getElementById("search").value;
                    
                    if(vehicle_type==0 && search_by==0 && search==0)
                    {
                    alert("Please select atleast one option");
                    return false;
                    }else
                    if(search_by!=0 && search==0)
                    {
                   alert("Please enter search keyword here");
                   document.getElementById("search").focus();
                   return false;
                    }else
                      if(search_by==0 && search!=0)
                    {
                   alert("Please select search by");
                   document.getElementById("search_by").focus();
                   return false;
                    }else
                    {
                    document.getElementById("ajax_loader_show").style.display="block";    
                   window.location.assign("view_vehicle_details.php?vtxml="+vehicle_type+"&&sbxml="+search_by+"&&sxml="+search+"");   
                    }
           }
           
           function reset_button()
           {
            document.getElementById("ajax_loader_show").style.display="block";    
           window.location.assign("view_vehicle_details.php");   
           }
        </script>
       
    </head>
    <body onload="page_load()">
         <?php  include_once '../ajax_loader_page_second.php';?>
        
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
                           <td><a href="transport_dashboard.php">Transport</a></td>
                           <td>/</td>
                           <td><a href="transport_system_setting.php">Transport System Setting</a></td>
                           <td>/</td>
                           <td>View Vehicle Details</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>View Vehicle Details</b></div>
                    <a href="add_vehicle.php">
                        <div class="view_button">Add New Vehicle</div></a>
                </div>
               <style>
                   .th_styling{ font-size:11px; }
                   .td_style { font-size:11px; }
               </style> 
                
               <div class="middle_left_div_tag">
                   
                   <div class="filter_div">
               
                       <?php
                       if(!empty($_REQUEST['vtxml']))
                       {
                        $vehicle_type_id=$_REQUEST['vtxml'];   
                        $vehice_type="and vehicle_type_id='$vehicle_type_id'";  
                       }else
                       {
                       $vehicle_type_id="";  
                       $vehice_type="";
                       }
                       
                       if(!empty($_REQUEST['sbxml'])&&(!empty($_REQUEST['sxml'])))
                       {
                        $search_by_tr=$_REQUEST['sbxml'];
                        $search=$_REQUEST['sxml'];
                       $search_by="and $search_by_tr LIKE '%$search%'";    
                       }  else {
                          $search_by=""; 
                          $search_by_tr="";
                          $search="";
                       }
                       
                       ?>
              <?php
              if(!empty($_REQUEST['sbxml'])&&(!empty($_REQUEST['sxml'])))
                       {
                   $search_by_tr=$_REQUEST['sbxml'];
                        $search=$_REQUEST['sxml'];
              ?>        
        <script type="text/javascript">
        function page_load()
        {
      document.getElementById("<?php echo $search_by_tr;?>").selected=true;
       $(function() {
$("#search").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    });
    
    var ab="<?php echo $search_by_tr;?>";
    if(ab=="insurance_expire_date")
    {
    $(".ui-datepicker-trigger").show();     
    }else
    if(ab=="registration_date")
{
    $(".ui-datepicker-trigger").show();     
    }else
    if(ab=="start_service_date")
{
    $(".ui-datepicker-trigger").show();     
    }else
    {
     $(".ui-datepicker-trigger").hide();      
    }
        }
        </script>
                <?php
                       }
                ?>       
                       
                       <table style=" width:95%; margin: 0 auto;  font-size:12px; ">
                           <tr>
                               <td><b>Vehicle Type</b></td><td><b>:</b></td>
                               <td> <select class="select_filter" id="vehicle_type" name="vehicle_type">
                               <option value="0">--Select vehicle type --</option> 
                             <?php 
$vehicle_type_db=mysql_query("SELECT * FROM transport_vehicle_type_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and is_delete='none'");
while ($fetch_vehicle_type_data=  mysql_fetch_array($vehicle_type_db))
{
   $fetch_vehicle_type_id=$fetch_vehicle_type_data['vehicle_type_id'];
    $fetch_vehicle_type_name=$fetch_vehicle_type_data['vehicle_type'];
    if($vehicle_type_id==$fetch_vehicle_type_id)
    {
    echo "<option value='$fetch_vehicle_type_id' selected>$fetch_vehicle_type_name</option>";   
    }else
    {
     echo "<option value='$fetch_vehicle_type_id'>$fetch_vehicle_type_name</option>";   
       
    }
}
?>
                           </select>  </td>
                               
                               <td><b>Search By</b></td><td><b>:</b></td>
                               <td>
                                   <select class="select_filter" id="search_by" onchange="search_by_check(this.value)">
                                       <option value="0">--- Select Search By ---</option>
                                        <option id="vehicle_registration_no" value="vehicle_registration_no">Registration Number</option>
                                         <option id="registration_date" value="registration_date">Registration Date</option>
                                          <option id="no_of_seats" value="no_of_seats">Number of Seats</option>
                                           <option id="max_allow" value="max_allow">Maximum Allowed</option>
                                            <option id="milage" value="milage">Milage</option>
                                             <option id="start_service_date" value="start_service_date">Start Service Date</option>
                                              <option id="insurance_no" value="insurance_no">Insurance Number</option>
                                               <option id="insurance_expire_date" value="insurance_expire_date">Insurance Expire Date</option>
                                                <option id="vehicle_owner_name" value="vehicle_owner_name">Owner Name</option>
                                                 <option id="mobile_no" value="mobile_no">Mobile Number</option>
                                   </select>
                               </td>
                               <td><b>Search</b></td><td><b>:</b></td>
                               <td style=" width:255px;"><input type="text" value="<?php echo $search;?>" id="search" placeholder="Enter keyword here" class="text_search"></td>
                               
                               <td>
                                   <input type="button" class="filter_button" onclick="filter_button()" style=" margin-top: 0; height:26px; float:left; " value="Filter">
                                   <input type="button" class="filter_button" onclick="reset_button()" style=" margin-top: 0; margin-left:15px;  float:left;  background-color:deeppink;  height:26px; " value="Reset">
                             
                               </td>
                           </tr>
                       </table>
                       
                   </div> 
                   
                  <div id="top_buttons_div">
                       <div class="button_show_style">Print</div>   
                   </div>
                   <table cellspacing="0" cellpadding="0" class="table_details">
                       <tr>
                           <td class="th_styling">Sl No.</td>
                           <td class="th_styling">Vehicle Type</td>
                           <td class="th_styling">Registration No.</td>
                           <td class="th_styling">Reg. Date</td>
                           <td class="th_styling">No. Of Seats</td>
                           <td class="th_styling">Max Allowed</td>
                           <td class="th_styling">Milage<br/> (1 liter)</td>
                           <td class="th_styling">Start Service</td>
                           <td class="th_styling">Insurance</td>
                            <td class="th_styling">Insur. Expire</td>
                             <td class="th_styling">Tax Remitted</td>
                           <td class="th_styling">Owner Name</td>
                           <td class="th_styling">Mobile No.</td>
                           <td class="th_styling">Description</td>
                           <td class="th_styling" style=" border-right:1px solid gray;">Action</td>
                       </tr>
                       
                     <?php 
                       $row=0;
                       $vehicle_db=mysql_query("SELECT * FROM transport_vehicle_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                               . "and session_id='$fecth_session_id_set' $vehice_type $search_by and is_delete='none'");
                       while ($fetch_vehicle_data=mysql_fetch_array($vehicle_db))
                       {
                     $row++;
                              $vehicle_db_id=$fetch_vehicle_data['id'];
                              $vegicle_unique_id=$fetch_vehicle_data['vehicle_id'];
                              $vehicle_encrypt_id=$fetch_vehicle_data['encrypt_id'];
                              $fetch_vehicle_type_id=$fetch_vehicle_data['vehicle_type_id'];
                              $fetch_registration_no=$fetch_vehicle_data['vehicle_registration_no'];
                              $registration_date=$fetch_vehicle_data['registration_date'];
                              $no_of_seat=$fetch_vehicle_data['no_of_seats'];
                              $max_allowed=$fetch_vehicle_data['max_allow'];
                              $milage=$fetch_vehicle_data['milage'];
                              $start_service_date=$fetch_vehicle_data['start_service_date'];
                              $insurance_no=$fetch_vehicle_data['insurance_no'];
                                      $insurance_expire=$fetch_vehicle_data['insurance_expire_date'];
                                      $taxrimed=$fetch_vehicle_data['taxrrimed'];
                              $vehicle_owner_name=$fetch_vehicle_data['vehicle_owner_name'];
                              $owner_mobile_no=$fetch_vehicle_data['mobile_no'];
                              $description=$fetch_vehicle_data['description'];
                           
                              if(strtotime($start_service_date)==0)
                              {
                                  $start_service_date="";
                              }
                            
                                if(strtotime($insurance_expire)==0)
                              {
                                  $insurance_expire="";
                              }
                            
                             
                              
                              $vehicle_type_db=mysql_query("SELECT * FROM transport_vehicle_type_db WHERE organization_id='$fetch_school_id'"
                               . " and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and vehicle_type_id='$fetch_vehicle_type_id'");
                       $fetch_vehicle_type_data=mysql_fetch_array($vehicle_type_db);
                       $fetch_vehicle_type_num_rows=  mysql_num_rows($vehicle_type_db);
                       if((!empty($fetch_vehicle_type_data))&&($fetch_vehicle_type_data!=null)&&($fetch_vehicle_type_num_rows!=0))
                       {
                        $vehicle_type_naem=$fetch_vehicle_type_data['vehicle_type'];  
                       }else 
                       {
                        $vehicle_type_naem="";   
                       }
                              
                            echo "<tr id='delete_row_$vegicle_unique_id'>
                                  <td class='td_style'><center><b>$row</b></center></td> 
                                   <td class='td_style'><center>$vehicle_type_naem</center></td> 
                                   <td class='td_style'><center>$fetch_registration_no</center></td> 
                                   <td class='td_style'><center>$registration_date</center> </td> 
                                   <td class='td_style'><center>$no_of_seat</center></td> 
                                    <td class='td_style'><center>$max_allowed</center></td> 
                                           <td class='td_style'>";
                            
                            if(!empty($milage))
                            {
                                echo "<center>$milage <b>Km</b></center>";
                            }
                            
                                            echo "</td> 
                                               <td class='td_style'><center>$start_service_date</center></td>
                                                   <td class='td_style'><center>$insurance_no</center></td>
                                                       <td class='td_style'><center>$insurance_expire</center></td>
                                                           <td class='td_style'><center>$taxrimed</center></td>
                                                               
                                                    <td class='td_style'>$vehicle_owner_name</td> 
                                                         <td class='td_style'>$owner_mobile_no</td> 
                                                         <td class='td_style'>";
                                            if(!empty($description))
                                            {
                                            {
                                           ?>
                       
                       <center>
                       <a style="color:blue; font-size:15px; text-decoration:underline;  " href="#" onclick="window.open('description.php?token_id=<?php echo $vehicle_encrypt_id;?>','size',config='height=400,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                     View
                       </a>  </center>
                       <?php
                                            }
                                            }
                                            echo"</td> 
                                   <td class='td_style' style='padding:0; width:130px; border-right:1px solid gray;'>";
                                    {
                        ?>
                                <a style="color:blue;" href="#" onclick="window.open('edit_vehicle.php?token_id=<?php echo $vehicle_encrypt_id;?>','size',config='height=680,width=680,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        
                            <div class='edit_delete_buttons' style='background-color:green; width:45px;'>Edit</div></a>
                      <?php 
                        }
                           echo "</abbr>
                            <abbr title='Delete'>";
                        {
                        ?>
                            <div onclick="delete_data('<?php  echo $vegicle_unique_id;?>','vehicle_delete_command')" class='edit_delete_button'>Delete</div>
                         <?php 
                        }
                                  echo" </td> 
                                      
                                </tr>"; 
                           
                       }
                        $reocrd_num_rows=mysql_num_rows($vehicle_db);
                       if(empty($reocrd_num_rows))
                       {
                           echo "<tr><td colspan='18' class='empty_td'>Record No Found!</td></tr>";   
                       }
                       
                       ?>
                       
                       
                       
                   </table>       
                   
               </div>
                
             
                
                
               
            </div> 
        </div>
         <script type="text/javascript" src="../javascript/next_javascript.js"></script>
         <script type="text/javascript" src="../javascript/admission_javascript.js"></script>
         <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
       
            <script type="text/javascript">
           function search_by_check(search_by_name)
           {
               
           document.getElementById("search").value="";    
           if((search_by_name=="registration_date"))
           {
           $(function() {
$("#search").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    });
     $(".ui-datepicker-trigger").show();   
           }else
           if((search_by_name=="start_service_date"))
           {
           $(function() {
$("#search").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    });
     $(".ui-datepicker-trigger").show();   
           }else
           if((search_by_name=="insurance_expire_date"))
           {
           $(function() {
$("#search").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    });
     $(".ui-datepicker-trigger").show();   
           }else
           {
           $(function()
           {
           $(".ui-datepicker-trigger").hide();    
           })
             
             
           }
       }
            </script>
            <style>
                .ui-datepicker-trigger{ position:relative;  float:left; }
                #search { float:left; }
            </style>
            
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