<?php 
session_start(); 
ob_start();

require_once 'connection.php';
$school_db=mysql_query("SELECT * FROM organization_db WHERE id ORDER BY id DESC");
$fetch_school_data=mysql_fetch_array($school_db);
$fetch_num_rows=mysql_num_rows($school_db);
if((empty($fetch_school_data))&&($fetch_school_data==null)&&($fetch_num_rows==0))
{
{
?>
<?php 
if(isset($_SESSION['user_admin_session']))
{
 header("Location:user_account_details.php");
        
}else
if(isset($_SESSION['verify_account_session']))
{
header("Location:organization_verify.php");    
}

?>

<?php 
$message_show="";
require_once 'connection.php';
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

if(isset($_POST['submit_data_process']))
{
 
 $static_id="SCHL";    
 $add_one_no=1;   
 $school_org_db=mysql_query("SELECT * FROM organization_db WHERE id ORDER BY id DESC");
 $fetch_school_org_record=mysql_fetch_array($school_org_db);
 $fetch_school_num_rows=mysql_num_rows($school_org_db);
  if((!empty($fetch_school_org_record))&&($fetch_school_org_record!=null)&&($fetch_school_num_rows!=0))
  {
   $fetch_id=$fetch_school_org_record['id'];
   $add_both_values=$fetch_id+$add_one_no;
   $final_school_id=$static_id."_".$add_both_values;   
  }else
  {
   $final_school_id=$static_id."_".$add_one_no;   
  }
   
  
  function gen_random_string($length=6)
{
   $chars ="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";//length:36
    $final_rand='';
    for($i=0;$i<$length; $i++)
    {
        $final_rand .= $chars[ rand(0,strlen($chars)-1)];
 
    }
    return $final_rand;
} 
 $verify_account_otp=gen_random_string();  
 $encrypt_id=md5(md5($final_school_id));   
 $school_name=$_POST['school_name'];
 $school_contact_no=$_POST['school_contact_no'];
 $school_email_id=$_POST['school_email'];
 $school_address=$_POST['school_address'];
 $school_establish_year=$_POST['year_of_establish'];
 $school_description=$_POST['school_description'];
$school_currency=$_POST['currency'];
 $school_affilated_name=$_POST['affiliation_name'];
 $school_affilated_number=$_POST['affiliation_number'];
 $school_trust_society_name=$_POST['trust_name'];
 $school_trust_society_no=$_POST['trust_number'];
 $school_website_url=$_POST['school_website'];
 
 if((!empty($school_name))&&(!empty($school_contact_no))&&(!empty($school_email_id))&&(!empty($school_address))
         &&(!empty($school_establish_year))&&(!empty($school_currency)))
 {
   
  $match_select_db=mysql_query("SELECT * FROM organization_db WHERE organization_id='$final_school_id'
          OR school_name='$school_name' OR contact_no='$school_contact_no' OR email_id='$school_email_id'");
  $fetch_match_school_data=mysql_fetch_array($match_select_db);
  $fetch_school_num_rows_match=mysql_num_rows($match_select_db);
  
  if((empty($fetch_match_school_data))&&($fetch_match_school_data==null)&&($fetch_school_num_rows_match==0))
  {
   
      
   if((!empty($_FILES['school_collage_logo']))) 
       {                    
        
        $filename= $_FILES['school_collage_logo']['name'];
        $tmpfilename = $_FILES['school_collage_logo']['tmp_name'];
        $filesize = $_FILES['school_collage_logo']['size'];
       
        if((!empty($filename)))
        { 
        if(($filesize<512000))
         {
        $imagesize=getimagesize($tmpfilename);
        if ((!empty($imagesize))) {
            
            date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(1000, 5000);
            $location="images/school_logo/". $random . $time . $filename;
            $templocation= "images/school_logo/". $random . $time;
            $upload=move_uploaded_file($tmpfilename,$location);
             
    if(($upload))
    {
  $insert_school_data=mysql_query("INSERT into organization_db values('','$final_school_id','$encrypt_id','$school_name'
          ,'$school_affilated_name','$school_affilated_number','$school_trust_society_name','$school_trust_society_no'
          ,'$school_website_url','$school_contact_no','$school_email_id','$school_address','$school_establish_year'
          ,'$school_currency','$school_description','$location','$date','$date_time','','','deactive','pending','$verify_account_otp','active')");  
  
  if(!empty($insert_school_data))
  {
   $_SESSION['verify_account_session']=$final_school_id;
   if(isset($_SESSION['verify_account_session']))
   {
    
$To_customer=$school_email_id; 
$Subject_company ='Verify your email address'; 
$Message_your =' <span style=" font-size:18px;  font-weight:bold; color:gray;  ">Pixabyte Technologies Pvt. Ltd.</span>
        <br/>
        <br/>
        <span style=" font-size:30px;  font-weight:bold; color:dodgerblue;  ">Verify your email address</span>
        <br/>
        <br/>
        <span>To finish setup this S.M.S Account, we just need to make sure this email address is yours.</span>
        <br/>
        <br/>
        <div style=" width:auto; height:auto; padding-top:10px; padding-bottom:10px;  
            background-color:dodgerblue;  color:white; font-weight: bold; float:left; text-align:center; padding-left:30px; padding-right:30px;
            ">Verify  '.$school_email_id.'</div>
        <br/>
        <br/>
        <br/>
        <span style=" float:left; ">Or you may be asked to enter this one time password code : '.$verify_account_otp.'</span>
        <br/>
        <br/>
        <b>Thanks,<br/>
        The Pixabyte Technologies team</b>
        ';
$header  = 'MIME-Version: 1.0' . "\r\n";
		$header.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header.="From: $school_name <pixabyteservice@gmail.com> \r\n" . 
"Reply-To: $school_name <pixabyteservice@gmail.com> \r\n";//enter any header
$send_mail_conform= mail($To_customer,$Subject_company,$Message_your,$header); 
 if($send_mail_conform==false)
 {
  header("Location:organization_verify.php");
 }
   }
      
      
  }else
  {
    $message_show="Request failed,please try again";  
  }
  
  
    }else  $message_show="Request failed,please try again";
      }else  $message_show="Invalid picture format";
      }else  $message_show="Picture size should be below 150kb";
      }else   $message_show="Please Choose Picture";
      }else $message_show="Please Choose Picture</div>"; 
      
      
  }else
  {
       $message_show="Record already exist in database";    
  }
     
     
 }else
 {
   $message_show="Please fill all Mandatory fields.";    
 }
    
    
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add Organization Details</title>
          <link href="stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
          <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
          <script type="text/javascript">
      function org_validate()
      {
          var school_name=document.getElementById("school_name").value;
          var school_contact_no=document.getElementById("school_contact_no").value;
          var school_email_id=document.getElementById("school_email").value;
          var school_address=document.getElementById("school_address").value;
          var school_establish_year=document.getElementById("establish_year").value;
          var school_logo=document.getElementById("school_collage_logo").value;
          var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i
          var b=emailfilter.test(school_email_id);
          
         if(school_name==0)
             {
              alert("Please enter school/collage name");
              document.getElementById("school_name").focus();
              return false;
             }else
              if(school_contact_no==0)
             {
              alert("Please enter contact number");
              document.getElementById("school_contact_no").focus();
              return false;
             }else
       if(isNaN(school_contact_no))
{
alert("Please enter the valid contact number (Like : 9582456009)");
document.getElementById("school_contact_no").focus();
return false;
}
if((school_contact_no.length < 1) || (school_contact_no.length > 12) || (school_contact_no.length < 10))
{
alert("Please enter contact number must be 10 integers");
document.getElementById("school_contact_no").focus();
return false;
}else
    if(school_email_id==0)
     {
      alert("Please enter email");
      document.getElementById("school_email").focus();
      return false; 
     }else
         if(b==false)
{
alert("Please enter valid email");
document.getElementById("school_email").focus();
return false;
}else
    if(school_address==0)
        {
           alert("Please enter school/collage address");
           document.getElementById("school_address").focus();
         return false;
        }else
        if(school_establish_year==0)
        {
           alert("Please enter establish year");
           document.getElementById("establish_year").focus();
         return false;
        }else
            if(isNaN(school_establish_year))
                {
                 alert("Please enter valid establish year (like :2013)");
           document.getElementById("establish_year").focus();
         return false;   
                }else
                if(school_logo==0)
        {
           alert("Please choose school logo");
           document.getElementById("school_collage_logo").focus();
         return false;
        }else
              {
                    document.getElementById("ajax_loader_show").style.display="block";    
                    }
      }
      </script>
      
      
      <script type="text/javascript">
            $(document).ready(function(){
               $('#school_collage_logo').change(function(){
			var file=this.files[0];
                        var file_size_convetred=file.size/1024;
                        var set_file_limit='500';
                            if(file_size_convetred>set_file_limit)
                            {
			    alert('Photo Size Should be less then 500 Kb');
                            $('#school_collage_logo').val('');
                            $('#school_collage_logo').focus();
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
    <?php 
include_once 'ajax_loader_page.php';
      ?>
        
<?php
include_once 'step_header.php';;
?>   
        <div id="second_work_div">
		
            <div id="middle_work_div_org">
			
                 <form action="" onsubmit="return org_validate();" method="post" enctype="multipart/form-data">
       
                <table cellspacing="2" cellpadding="2" id="org_table_style">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
					
                    <tr>
                        <td colspan="3">
                          <?php 
                            if(!empty($message_show))
                            {
                                echo "<div class='notification_alert'>$message_show</div>";    
                            }
                            ?>
                        </td>
                    </tr>
                    <tr><td><b>School/Collage Name</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="school_name" placeholder="Enter school/collage name" class="text_box_org" name="school_name" value="<?php  if(isset($_POST['school_name'])){ echo $_POST['school_name'];}?>"></td>
                        <td><b>Affiliation From</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="affiliaton_name" placeholder="Enter affiliation from" class="text_box_org" name="affiliation_name" value="<?php  if(isset($_POST['affiliation_name'])){ echo $_POST['affiliation_name'];}?>"></td>
                    </tr>
                    <tr><td><b>Affiliation Number</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="affiliaton_no" placeholder="Enter affiliation number" class="text_box_org" name="affiliation_number" value="<?php  if(isset($_POST['affiliation_number'])){ echo $_POST['affiliation_number'];}?>"></td>
                        <td><b>Trust/Society Name</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="trust_name" placeholder="Enter Trust/Society name" class="text_box_org" name="trust_name" value="<?php  if(isset($_POST['trust_name'])){ echo $_POST['trust_name'];}?>"></td>
                    </tr>
                    <tr><td><b>Trust/Society Number</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="trust_no" placeholder="Enter Trust/Society number" class="text_box_org" name="trust_number" value="<?php  if(isset($_POST['trust_number'])){ echo $_POST['trust_number'];}?>"></td>
                        <td><b>Contact No.</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="school_contact_no" placeholder="Enter contact number" class="text_box_org" name="school_contact_no" value="<?php  if(isset($_POST['school_contact_no'])){ echo $_POST['school_contact_no'];}?>"></td>
                    </tr>
                    
                    <tr><td><b>Email </b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="school_email" placeholder="Enter email" class="text_box_org" name="school_email" value="<?php  if(isset($_POST['school_email'])){ echo $_POST['school_email'];}?>"></td>
                        <td><b>Website</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="school_website" placeholder="Enter website url" class="text_box_org" name="school_website" value="<?php  if(isset($_POST['school_website'])){ echo $_POST['school_website'];}else{echo "http://";}?>"></td>
                    </tr>
                    <tr>
                        <td><b>Address </b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="school_address" autocomplete="off" class="text_area_style" placeholder="Enter school/collage address" name="school_address" id="address_text_area"><?php  if(isset($_POST['school_address'])){ echo $_POST['school_address'];}?></textarea>
                        </td>
                        <td><b>Founded On</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input id="establish_year"  autocomplete="off" type="text" placeholder="Enter founded on" class="text_box_org" name="year_of_establish" value="<?php  if(isset($_POST['year_of_establish'])){ echo $_POST['year_of_establish'];}else {     }?>"></td>
                    </tr>
                    <tr><td><b>Currency</b> <sup>*</sup></td>
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
                   
                        <td><b>Private Note</b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="school_description" autocomplete="off" class="text_area_style" placeholder="Enter Private Note" name="school_description" id="address_text_area"><?php  if(isset($_POST['school_description'])){ echo $_POST['school_description'];}?></textarea>
                        </td>
                    </tr>
                    <tr><td><b>Upload Logo</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td>
                            <input id="school_collage_logo" name="school_collage_logo" type="file">   
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td style=" width:320px;  font-size:12px; color:green;  ">(Supported formats : .jpg , .png ; max filesize: 250Kb, 
recommended size : 70*70)</td>
                    </tr>
                    <tr>
                        <td style=" height:20px; "></td>
                    </tr>
                    <tr>
                        <td colspan="10">
                                <input type="submit" name="submit_data_process" class="save_button" id="save_button" value="Save & Continue">   
                        </td>
                    </tr>
                </table>
                 </form>
            </div>   
        </div>
        
       
        
        <?php
        include_once 'step_fotter.php';
        ?>
    </body>
</html>
<?php 
}
}else
{
    
  $fetch_account_verify_status=$fetch_school_data['account_verify']; 
  $fecth_organization_id=$fetch_school_data['organization_id'];
    if($fetch_account_verify_status=="pending")
    {
   $_SESSION['verify_account_session']=$fecth_organization_id;
   if(isset($_SESSION['verify_account_session']))
   {
       header("Location:organization_verify.php");
   }
         
    }else
    {
      header("Location:loginPage.php");   
    }
    
    
    
      
}
?>