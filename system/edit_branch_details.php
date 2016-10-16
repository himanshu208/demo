<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>

<?php 
$message_show="";
require_once '../connection.php';
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

if(isset($_POST['submit_data_process']))
{
 
 $update_db_id=$_POST['update_unique_id'];     
 $branch_name=$_POST['branch_name'];
 $branch_contact_no=$_POST['branch_contact_no'];
 $branch_email_id=$_POST['branch_email'];
 $branch_fax=$_POST['branch_fax'];
 $branch_address=$_POST['branch_address'];
 $currency=$_POST['currency'];
 $branch_establish_year=$_POST['year_of_establish'];
 $branch_description=$_POST['branch_description'];

 $branch_affilated_name=$_POST['affiliation_name'];
 $branch_affilated_number=$_POST['affiliation_number'];
 $branch_trust_society_name=$_POST['trust_name'];
 $branch_trust_society_no=$_POST['trust_number'];
 $branch_website_url=$_POST['branch_website'];
 
         $principle_name=$_POST['principle_name'];
         $principle_email=$_POST['principle_email'];
         $principle_mobile=$_POST['principle_mobile_no'];
         $principle_phone=$_POST['principle_phone'];
         
         $student_admission_no_prefix=$_POST['student_preifix'];
         $employee_no_prefix=$_POST['employee_preifix'];
 
         $bill_logo=$_POST['temp_bill_logo'];
         $school_logo=$_POST['temp_school_logo'];
 
 if((!empty($branch_name))&&(!empty($update_db_id))&&(!empty($branch_contact_no))&&(!empty($branch_email_id))&&(!empty($branch_address))
         &&(!empty($branch_establish_year))&&(!empty($currency))&&(!empty($principle_name))&&(!empty($principle_mobile)))
 {
   
  $match_select_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='' and branch_id!='$update_db_id'"
          . " and branch_name='$branch_name' OR organization_id='$fetch_school_id' and branch_id!='$update_db_id' and contact_no='$branch_contact_no'"
          . " OR organization_id='$fetch_school_id' and branch_id!='$update_db_id' and email_id='$branch_email_id'");
  $fetch_match_branch_data=mysql_fetch_array($match_select_db);
  $fetch_branch_num_rows_match=mysql_num_rows($match_select_db);
  
  if((empty($fetch_match_branch_data))&&($fetch_match_branch_data==null)&&($fetch_branch_num_rows_match==0))
  {
   
        $filename= $_FILES['branch_collage_logo']['name'];
        $tmpfilename = $_FILES['branch_collage_logo']['tmp_name'];
        $filesize = $_FILES['branch_collage_logo']['size'];
        
        $filename_1= $_FILES['report_logo']['name'];
        $tmpfilename_1 = $_FILES['report_logo']['tmp_name'];
        $filesize_1 = $_FILES['report_logo']['size'];
      
        if(!empty($filename))
        {
         $imagesize=getimagesize($tmpfilename); 
         if ((!empty($imagesize))) {
          if(($filesize<153600))
         {
         date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(1000, 5000);
            $location="images/school_logo/". $random . $time . $filename;
            $templocation= "images/school_logo/". $random . $time;
            $upload= move_uploaded_file($tmpfilename,"../".$location);
            if($upload)
            {
                
            }else
            {
             $location=$school_logo;
            }
         }else
         {
            $location=$school_logo;  
         }
         }else
         {
         $location=$school_logo;     
         }
        }else
        {
         $location=$school_logo;   
        }
        
        
        
        if(!empty($filename_1))
        {
         $imagesize_1=getimagesize($tmpfilename_1);
         if ((!empty($imagesize_1))) {
            
         if(($filesize_1<256000))
         {
           date_default_timezone_set('Asia/Calcutta'); 
           $time = mktime();
           $random = rand(1000, 5000);
            $location_1="images/school_logo/". $random . $time . $filename_1;
            $templocation_1= "images/school_logo/". $random . $time;
            $upload_1= move_uploaded_file($tmpfilename_1,"../".$location_1);
            if($upload_1)
            {
                
            }else
            {
             $location_1=$bill_logo;  
            }
         }else
         {
          $location_1=$bill_logo;    
         }
         }else
         {
           $location_1=$bill_logo;   
         }
        }else
        {
         $location_1=$bill_logo;   
        }
        
  $update_db=  mysql_query("UPDATE branch_db SET branch_name='$branch_name',affiliation_from='$branch_affilated_name',affiliation_number='$branch_affilated_number'"
          . ",trust_name='$branch_trust_society_name',trust_number='$branch_trust_society_no',website='$branch_website_url',contact_no='$branch_contact_no',email_id='$branch_email_id',fax_no='$branch_fax',address='$branch_address'"
          . ",establish_year='$branch_establish_year',currency='$currency',description='$branch_description',branch_logo='$location',report_logo='$location_1',principal_name='$principle_name',"
          . "principal_email='$principle_email',principal_phone='$principle_phone',principal_mobile='$principle_mobile',student_prefix_no='$student_admission_no_prefix',employee_prefix_no='$employee_no_prefix' "
          . "WHERE branch_id='$update_db_id' and action='active'");
  if(!empty($update_db))
  {
    $message_show="Record update successfully complete.";  
      
  }else
  {
    $message_show="Request failed,please try again";  
  }
   
  }else
  {
       $message_show="Record already exist in database";    
  }
     
     
 }else
 {
   $message_show="Please fill all fields.";    
 }
    
 require_once '../pop_up.php';   
}

?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Branch Detail</title>
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
             
      <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
          <script type="text/javascript">
      function org_validate()
      {
        
          var branch_name=document.getElementById("branch_name").value;
          
          var branch_contact_no=document.getElementById("branch_contact_no").value;
          var branch_email_id=document.getElementById("branch_email").value;
          
          var branch_address=document.getElementById("branch_address").value;
          var branch_establish_year=document.getElementById("establish_year").value;
          var branch_logo=document.getElementById("branch_collage_logo").value;
          var report_logo=document.getElementById("report_logo").value;
          var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i
          var b=emailfilter.test(branch_email_id);
          var principal_name=document.getElementById("principle_name").value;
          var principal_mobile_no=document.getElementById("principle_mobile_no").value;
          
         if(branch_name==0)
             {
              alert("Please enter branch name");
              document.getElementById("branch_name").focus();
              return false;
             }else
              if(branch_contact_no==0)
             {
              alert("Please enter contact number");
              document.getElementById("branch_contact_no").focus();
              return false;
             }else
       if(isNaN(branch_contact_no))
{
alert("Please enter the valid contact number (Like : 9899176775)");
document.getElementById("branch_contact_no").focus();
return false;
}
if((branch_contact_no.length < 1) || (branch_contact_no.length > 12) || (branch_contact_no.length < 10))
{
alert("Please enter contact number must be 10 integers");
document.getElementById("branch_contact_no").focus();
return false;
}else
    if(branch_email_id==0)
     {
      alert("Please enter email");
      document.getElementById("branch_email").focus();
      return false; 
     }else
         if(b==false)
{
alert("Please enter valid email");
document.getElementById("branch_email").focus();
return false;
}else
    if(branch_address==0)
        {
           alert("Please enter branch address");
           document.getElementById("branch_address").focus();
         return false;
        }else
        if(branch_establish_year==0)
        {
           alert("Please enter establish year");
           document.getElementById("establish_year").focus();
         return false;
        }else
            if(isNaN(branch_establish_year))
                {s
                 alert("Please enter valid establish year (like :2015)");
           document.getElementById("establish_year").focus();
         return false;   
                }else
        if(principal_name==0)
    {
        alert("Please enter name of the principal");
        document.getElementById("principle_name").focus();
        return false;
    }else
    if(principal_mobile_no==0)
{
   alert("Please enter principal mobile number");
   document.getElementById("principle_mobile_no").focus();
   return false;
}
              {
                    document.getElementById("ajax_loader_show").style.display="block";    
                    }
      }
      </script>
      
      
      <script type="text/javascript">
            $(document).ready(function(){
               $('#branch_collage_logo').change(function(){
			var file=this.files[0];
                        var file_size_convetred=file.size/1024;
                        var set_file_limit='150';
                            if(file_size_convetred>set_file_limit)
                            {
			    alert('Photo Size Should be less then 150 Kb');
                            $('#branch_collage_logo').val('');
                            $('#branch_collage_logo').focus();
                            return false;
                            }
           	});   
                
                $('#report_logo').change(function(){
			var file=this.files[0];
                        var file_size_convetred=file.size/1024;
                        var set_file_limit='250';
                            if(file_size_convetred>set_file_limit)
                            {
			    alert('Photo Size Should be less then 250 Kb');
                            $('#report_logo').val('');
                            $('#report_logo').focus();
                            return false;
                            }
           	});   
            });
            </script>
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return org_validate();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Branch Detail</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];
             
            $select_data=mysql_query("SELECT * FROM branch_db WHERE branch_encrypt_id='$token_id' and action='active'"); 
            $fetch_branch_data=mysql_fetch_array($select_data);
            $fetch_num_data=mysql_num_rows($select_data);
            if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_num_data!=0))
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
                    $account_status=ucfirst($fetch_branch_data['account_status']);
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
              <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $fetch_branch_data[2];?>">
              <table cellspacing="2" cellpadding="2" id="org_table_style" style=" margin: 10px;">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    
                    <tr>
                        <td colspan="6"><div class="title_show_this">Branch Details</div></td>
                    </tr>
                    <tr><td><b>School/College Name</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="school_name" 
                                   placeholder="Enter school name" class="text_box_org"
                                   name="school_name" readonly="readonly" style=" background-color: whitesmoke;" value="<?php  echo $school_name;?>"></td>
                        <td><b>Branch Name</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="branch_name" 
                                   placeholder="Enter branch name" class="text_box_org"
                                   name="branch_name" value="<?php echo $branch_name;?>"></td>
                    </tr>
                    <tr><td><b>Affiliation From</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="affiliaton_name" placeholder="Enter affiliation from" class="text_box_org" name="affiliation_name" value="<?php echo $affiliation_from;?>"></td>
                        <td><b>Affiliation Number</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="affiliaton_no" placeholder="Enter affiliation number" class="text_box_org" name="affiliation_number" value="<?php echo $affilation_number;?>"></td>
                    </tr>
                    
                    
                    <tr><td><b>Trust/Society Name</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="trust_name" placeholder="Enter Trust/Society name" class="text_box_org" name="trust_name" value="<?php echo $trust_name; ?>"></td>
                        <td><b>Trust/Society Number</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="trust_no" placeholder="Enter Trust/Society number" class="text_box_org" name="trust_number" value="<?php echo $trust_number;?>"></td>
                    </tr>
                    
                    
                    <tr><td><b>Contact No.</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="branch_contact_no" placeholder="Enter contact number" class="text_box_org" name="branch_contact_no" value="<?php echo $contact_no;?>"></td>
                        <td><b>Email</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="branch_email" placeholder="Enter email id" class="text_box_org" name="branch_email" value="<?php echo $email_id;?>"></td>
                    </tr>
                    
                    <tr><td><b>Fax</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="branch_fax" placeholder="Enter fax number" class="text_box_org" name="branch_fax" value="<?php echo $fax_no;?>"></td>
                        <td><b>Website</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="branch_website" placeholder="Enter website url" class="text_box_org" name="branch_website" value="<?php echo $website;?>"></td>
                    </tr>
                    <tr>
                        <td><b>Address</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="branch_address" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter branch complete address" name="branch_address" id="address_text_area"><?php echo $address;?></textarea>
                        </td>
                        <td><b>Establish Year</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input id="establish_year" autocomplete="off" type="text" placeholder="Enter establish year" class="text_box_org" name="year_of_establish" value="<?php echo $establish_year;?>"></td>
                    </tr>
                    
                    
                    <tr>
                        <td><b>Private Note</b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="branch_description" autocomplete="off" class="text_area_style" placeholder="Enter Private Note" name="branch_description" id="address_text_area"><?php echo $description?></textarea>
                        </td>
                        <td>
                            <b>Currency <sup>*</sup></b>
                        </td>
                        <td><b>:</b></td>
                        <td>
        <select class="select_styling" name="currency"> 
       <option value="INR" selected>India Rupees - INR</option>
        <option value="EUR">Euro - EUR</option>
        <option value="USD">United States Dollars - USD</option>
        <option value="GBP">United Kingdom Pounds - GBP</option>
        <option value="CAD">Canada Dollars - CAD</option>
        <option value="AUD">Australia Dollars - AUD</option>
        <option value="JPY">Japan Yen - JPY</option>
        <option value="NZD">New Zealand Dollars - NZD</option>
        <option value="CHF">Switzerland Francs - CHF</option>
        <option value="ZAR">South Africa Rand - ZAR</option>
        <option value="AFA">Afghanistan Afghanis - AFA</option>
        <option value="ALL">Albania Leke - ALL</option>
        <option value="DZD">Algeria Dinars - DZD</option>
        <option value="USD">America (United States) Dollars - USD</option>
        <option value="ARS">Argentina Pesos - ARS</option>
        <option value="AUD">Australia Dollars - AUD</option>
        <option value="ATS">Austria Schillings - ATS*</option>
        <option value="BSD">Bahamas Dollars - BSD</option>
        <option value="BHD">Bahrain Dinars - BHD</option>
        <option value="BDT">Bangladesh Taka - BDT</option>
        <option value="BBD">Barbados Dollars - BBD</option>
        <option value="BEF">Belgium Francs - BEF*</option>
        <option value="BMD">Bermuda Dollars - BMD</option>
        <option value="BRL">Brazil Reais - BRL</option>
        <option value="BGN">Bulgaria Leva - BGN</option>
        <option value="CAD">Canada Dollars - CAD</option>
        <option value="XOF">CFA BCEAO Francs - XOF</option>
        <option value="XAF">CFA BEAC Francs - XAF</option>
        <option value="CLP">Chile Pesos - CLP</option>
        <option value="CNY">China Yuan Renminbi - CNY</option>
        <option value="COP">Colombia Pesos - COP</option>
        <option value="XPF">CFP Francs - XPF</option>
        <option value="CRC">Costa Rica Colones - CRC</option>
        <option value="HRK">Croatia Kuna - HRK</option>
        <option value="CYP">Cyprus Pounds - CYP</option>
        <option value="CZK">Czech Republic Koruny - CZK</option>
        <option value="DKK">Denmark Kroner - DKK</option>
        <option value="DEM">Deutsche (Germany) Marks - DEM*</option>
        <option value="DOP">Dominican Republic Pesos - DOP</option>
        <option value="NLG">Dutch (Netherlands) Guilders - NLG*</option>
        <option value="XCD">Eastern Caribbean Dollars - XCD</option>
        <option value="EGP">Egypt Pounds - EGP</option>
        <option value="EEK">Estonia Krooni - EEK</option>
        <option value="EUR">Euro - EUR</option>
        <option value="FJD">Fiji Dollars - FJD</option>
        <option value="FIM">Finland Markkaa - FIM*</option>
        <option value="FRF">France Francs - FRF*</option>
        <option value="DEM">Germany Deutsche Marks - DEM*</option>
        <option value="XAU">Gold Ounces - XAU</option>
        <option value="GRD">Greece Drachmae - GRD*</option>
        <option value="NLG">Holland (Netherlands) Guilders - NLG*</option>
        <option value="HKD">Hong Kong Dollars - HKD</option>
        <option value="HUF">Hungary Forint - HUF</option>
        <option value="ISK">Iceland Kronur - ISK</option>
        <option value="XDR">IMF Special Drawing Right - XDR</option>
        <option value="INR">India Rupees - INR</option>
        <option value="IDR">Indonesia Rupiahs - IDR</option>
        <option value="IRR">Iran Rials - IRR</option>
        <option value="IQD">Iraq Dinars - IQD</option>
        <option value="IEP">Ireland Pounds - IEP*</option>
        <option value="ILS">Israel New Shekels - ILS</option>
        <option value="ITL">Italy Lire - ITL*</option>
        <option value="JMD">Jamaica Dollars - JMD</option>
        <option value="JPY">Japan Yen - JPY</option>
        <option value="JOD">Jordan Dinars - JOD</option>
        <option value="KES">Kenya Shillings - KES</option>
        <option value="KRW">Korea (South) Won - KRW</option>
        <option value="KWD">Kuwait Dinars - KWD</option>
        <option value="LBP">Lebanon Pounds - LBP</option>
        <option value="LUF">Luxembourg Francs - LUF*</option>
        <option value="MYR">Malaysia Ringgits - MYR</option>
        <option value="MTL">Malta Liri - MTL</option>
        <option value="MUR">Mauritius Rupees - MUR</option>
        <option value="MXN">Mexico Pesos - MXN</option>
        <option value="MAD">Morocco Dirhams - MAD</option>
        <option value="NLG">Netherlands Guilders - NLG*</option>
        <option value="NZD">New Zealand Dollars - NZD</option>
        <option value="NOK">Norway Kroner - NOK</option>
        <option value="OMR">Oman Rials - OMR</option>
        <option value="PKR">Pakistan Rupees - PKR</option>
        <option value="XPD">Palladium Ounces - XPD</option>
        <option value="PEN">Peru Nuevos Soles - PEN</option>
        <option value="PHP">Philippines Pesos - PHP</option>
        <option value="XPT">Platinum Ounces - XPT</option>
        <option value="PLN">Poland Zlotych - PLN</option>
        <option value="PTE">Portugal Escudos - PTE*</option>
        <option value="QAR">Qatar Riyals - QAR</option>
        <option value="ROL">Romania Lei - ROL</option>
        <option value="RUB">Russia Rubles - RUB</option>
        <option value="SAR">Saudi Arabia Riyals - SAR</option>
        <option value="XAG">Silver Ounces - XAG</option>
        <option value="SGD">Singapore Dollars - SGD</option>
        <option value="SKK">Slovakia Koruny - SKK</option>
        <option value="SIT">Slovenia Tolars - SIT</option>
        <option value="ZAR">South Africa Rand - ZAR</option>
        <option value="KRW">South Korea Won - KRW</option>
        <option value="ESP">Spain Pesetas - ESP*</option>
        <option value="XDR">Special Drawing Rights (IMF) - XDR</option>
        <option value="LKR">Sri Lanka Rupees - LKR</option>
        <option value="SDD">Sudan Dinars - SDD</option>
        <option value="SEK">Sweden Kronor - SEK</option>
        <option value="CHF">Switzerland Francs - CHF</option>
        <option value="TWD">Taiwan New Dollars - TWD</option>
        <option value="THB">Thailand Baht - THB</option>
        <option value="TTD">Trinidad and Tobago Dollars - TTD</option>
        <option value="TND">Tunisia Dinars - TND</option>
        <option value="TRY">Turkey New Lira - TRY</option>
        <option value="TRL">Turkey Lira - TRL*</option>
        <option value="AED">United Arab Emirates Dirhams - AED</option>
        <option value="GBP">United Kingdom Pounds - GBP</option>
        <option value="USD">United States Dollars - USD</option>
        <option value="VEB">Venezuela Bolivares - VEB</option>
        <option value="VND">Vietnam Dong - VND</option>
        <option value="ZMK">Zambia Kwacha - ZMK</option>
        <option value="EUR">-- Special Units: --</option>
        <option value="XAF">CFA BEAC Francs - XAF</option>
        <option value="XOF">CFA BCEAO Francs - XOF</option>
        <option value="XPF">CFP Francs - XPF</option>
        <option value="XCD">Eastern Caribbean Dollars - XCD</option>
        <option value="EUR">Euro - EUR</option>
        <option value="XDR">IMF Special Drawing Rights - XDR</option>
        <option value="XAU">-- Precious Metals: --</option>
        <option value="XAG">Silver Ounces - XDR</option>
        <option value="XAU">Gold Ounces - XAU</option>
        <option value="XPT">Platinum Ounces - XPT</option>
        <option value="XPD">Palladium Ounces - XPD</option>
                     </select>   
                        </td>
                    </tr>
                    <tr><td><b>Upload Logo</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td>
                            <input id="branch_collage_logo" name="branch_collage_logo" type="file">  <br/>
                            
                             <?php
                            if((!empty($branch_logo))&&(is_file("../".$branch_logo)))
                            {
                            ?>
                            <a style="color:blue;" href="#" onclick="window.open('../<?php echo $branch_logo;?>','size',config='height=300,width=300,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                            <input type="button" class="document_button" value="View"></a>
                            <?php
                            }
                            ?>
                            
                        <input type="hidden" name="temp_school_logo" value="<?php echo $branch_logo;?>">
                        </td>
                        <td><b>Bill Header Logo</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td>
                        <input id="report_logo" name="report_logo" type="file"><br/>  
                            <?php
                            if((!empty($report_logo))&&(is_file("../".$report_logo)))
                            {
                            ?>
                            <a style="color:blue;" href="#" onclick="window.open('../<?php echo $report_logo;?>','size',config='height=220,width=900,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                            <input type="button" class="document_button" value="View"></a>
                            <?php
                            }
                            ?>
                        <input type="hidden" name="temp_bill_logo" value="<?php echo $report_logo;?>">
                        </td>
                    </tr>
                    
                    
                     <tr>
                        <td colspan="2"></td>
                        <td style=" font-size:12px; color:red;  ">Image Dimension width=70px * height 70px</td>
                    
                        <td colspan="2"></td>
                        <td style=" font-size:12px; color:red;  ">Image Dimension width=700px * height 70px</td>
                    </tr>
                    <tr>
                        <td style=" height:10px; "></td>
                    </tr>
                     <tr>
                        <td colspan="6"><div class="title_show_this">Principal / Head of the Institution</div></td>
                    </tr>
                    
                     <tr><td><b>Name of the Principal <sup>*</sup></b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="principle_name"
                                   placeholder="Enter name of the principal" class="text_box_org"
                                   name="principle_name" value="<?php echo $principal_name;?>"></td>
                        <td><b>Email of the Principal</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="principle_email"
                                   placeholder="Email of the principal" class="text_box_org" name="principle_email"
                                   value="<?php echo $principal_email;?>"></td>
                    </tr>
                    <tr><td><b>Phone</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="principle_phone" placeholder="Enter phone" 
                                   class="text_box_org" name="principle_phone" value="<?php echo $principal_phone;?>"></td>
                        <td><b>Mobile <sup>*</sup></b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="principle_mobile_no" placeholder="Enter mobile number"
                                   class="text_box_org" name="principle_mobile_no" value="<?php echo $principal_mobile;?>"></td>
                    </tr>
                    <tr>
                        <td style=" height:10px; "></td>
                    </tr>
                    <tr>
                        <td colspan="6"><div class="title_show_this">Prefix For Admission Number/Employee Number </div></td>
                    </tr>
                    <tr><td><b>Prefix For Student Admission No. <sup>*</sup></b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="student_preifix"
                                    class="text_box_org"
                                    name="student_preifix" value="<?php echo $student_prefix_no?>"></td>
                        <td><b>Prefix For Employee Number </b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="employee_preifix"
                                   class="text_box_org" name="employee_preifix" value="<?php echo $employee_prefix_no;?>"></td>
                    </tr>
                    
                    <tr>
                        <td style=" height:40px; "></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <input type="submit" name="submit_data_process"
                                   class="save_button" id="save_button" style=" margin-right:20px; " value="Update">   
                        </td>
                    </tr>
                </table>
               
                
                
            <?php
             }
            }
             }
            ?>
            
            
            
            </div>
            </div>
            <div class="edit_fotter_div_tag">Design & Develop By : DIGI SHIKSHA</div>
            
            
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