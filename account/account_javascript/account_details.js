//by date javascript

function by_date()
         {
           var by_date_check=document.getElementById("check_by_date").checked;
           if(by_date_check==true)
           {
            document.getElementById("show_from_to_date_table").style.display="block";
           }else
           {
            document.getElementById("show_from_to_date_table").style.display="none";
             
           }
         }
         
         
         
         
         
         
         
         //radio button
         function radio_button_check(account_type)
         {
         var organization_id=document.getElementById("organization_id").value;
         var branch_id=document.getElementById("branch_id").value;
         var session_id=document.getElementById("insert_session_id").value;
        var currency=document.getElementById("currency").value;
        if((organization_id!=0)&&(account_type!=0)&&(branch_id!=0)&&(session_id!=0))
        {
         
          var httpxml;

try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
 if(httpxml.responseText!=0)
     {
   
   document.getElementById("temp_data").innerHTML=httpxml.responseText;
   var account_group_data=document.getElementById("account_group_data").innerHTML;
   var account_payment_data=document.getElementById("account_payment_details_data").innerHTML;
   document.getElementById("accountgroupname").innerHTML=account_group_data;
  document.getElementById("account_payment_details").innerHTML=account_payment_data;
  document.getElementById("temp_data").innerHTML="";
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="pay_ajax_code_one.php";
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&currency="+currency+"&&session_id="+session_id+"&&account_type_details="+account_type;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);         
                 
                 
        }else
        {
          alert("Please fill all fields");
          return false;
        }
        
        
         }
         
         
         
         
         
         //account group name
         function account_group_name_id(account_group_id)
         {
     var org_id=document.getElementById("organization_id").value;
     var branch_id=document.getElementById("branch_id").value;
     var session_id=document.getElementById("insert_session_id").value;
    
    if(account_group_id!=0)
    {
    if((org_id==0)&&(branch_id==0)&&(session_id==0))
         {
         alert("Sorry,Organization,Branch,Session Data missing");
         return false;
         }else
         {
          
                    
var httpxml;

try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
 if(httpxml.responseText!=0)
     {
   
   document.getElementById("account_name").innerHTML=httpxml.responseText;
  document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="pay_ajax_code_one.php";
url=url+"?org_id="+org_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&account_group_id="+account_group_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);  
            
            
            
         }
     }else
        {
         document.getElementById("account_name").innerHTML="<option value='0'>---Select---</option>"
        }        
         }
         
         
         
         
         
         //on click search record 
         
         function search_button()
         {
     var org_id=document.getElementById("organization_id").value;
     var branch_id=document.getElementById("branch_id").value;
     var session_id=document.getElementById("insert_session_id").value;
     var currency=document.getElementById("currency").value;
        
     var account_type_income=document.getElementById("incomesearch").checked;
     var account_type_expensive=document.getElementById("expensesearch").checked;
     if(account_type_income==true)
     {
       var account_type=document.getElementById("incomesearch").value;
     }else
         if(account_type_expensive==true)
     {
        var account_type=document.getElementById("expensesearch").value; 
     }
        
    if((org_id==0)&&(branch_id==0)&&(session_id==0)&&(currency==0))
    {
     alert("Please fill all fields");
     return false;
    }else
    {
    var by_date=document.getElementById("check_by_date").checked;
    if(by_date==true)
    {
     var from_date=document.getElementById("date_from").value;
     var to_date=document.getElementById("date_to").value;
    }else
    {
    var from_date=""; 
    var to_date="";
    }
     
    var account_group_id=document.getElementById("accountgroupname").value;
    var account_name_id=document.getElementById("account_name").value;
    var search_by=document.getElementById("search_by").value;
    var search_input=document.getElementById("search_value").value;
    if((from_date==0 || to_date==0)&&(account_group_id==0)&&(account_name_id==0)&&(search_by==0 || search_input==0)) 
    {
      alert("Please fill atleast one option");
      return false;
    }else
    {
                        
var httpxml;

try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
 if(httpxml.responseText!=0)
     {
 
   document.getElementById("account_payment_details").innerHTML=httpxml.responseText;
  
     document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="pay_ajax_code_one.php";
url=url+"?temp_org_id="+org_id+"&&temp_branch_id="+branch_id+"&&account_type="+account_type+"&&temp_session_id="+session_id+"&&unique_account_group_id="+account_group_id+"&&unique_account_nameid="+account_name_id+"&&date_from="+from_date+"&&date_to="+to_date+"&&search_by="+search_by+"&&search_input="+search_input+"&&currency="+currency;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
    }                
    }
    }
         
      

//advanvce search option onclick
function advance_search_option()
{
var checked_advance_search=document.getElementById("advance_search_option_value").checked;
if(checked_advance_search==true)
{
 $(document).ready(function(){
   $("#search_by_tr,#search_input_tr").show();
 });
}else
{
  $(document).ready(function(){
   $("#search_by_tr,#search_input_tr").hide();
 });  
} 
}


//cancel fee payment
function account_payment_cancel(account_payment_name)
{
  var org_id=document.getElementById("organization_id").value;
  var branch_id=document.getElementById("branch_id").value;
  var session_id=document.getElementById("insert_session_id").value;
  if((org_id==0)&&(branch_id==0)&&(session_id==0)&&(account_payment_name==0))
  {
   alert("Please fill all fields");
   return false;
  }else
  {
  var r=confirm("Are you sure you want to cancel payment record");
if (r==true)
  {
        
var httpxml;

try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
 if(httpxml.responseText!=0)
     {
   document.getElementById("ajax_loader_show").style.display="none";
   alert("Record update successfully complete");
   document.getElementById("payment_status_"+account_payment_name).innerHTML="<b>CANCEL</b>";
   document.getElementById("payment_status_"+account_payment_name).style.color="Red";
   document.getElementById("cancel_button_hide_"+account_payment_name).style.display="none";
   
     }else
     {
         alert("Sorry,Request failed,please try again later");
     }
     
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="pay_ajax_code_one.php";
url=url+"?org_id="+org_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&update_account_payment_id="+account_payment_name;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);    
  }
  }  
}