 //class to get section
 
 function change_class_name(class_id)
 {        
var httpxml;   
if((class_id==0))
    {
      return false;
    }
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
 document.getElementById("section_name").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";    
              
     }else
         {
           document.getElementById("section_name").innerHTML="<option value='0'>Record no found !!</option>";
             document.getElementById("ajax_loader_show").style.display="none";    
              
   
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="ajax_code.php";
url=url+"?class_id="+class_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
                 }
                 
                 
                 
         //route ajax  
                  function change_route_id(route_id)
                 {        

var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("brnach_id").value;
var session_id=document.getElementById("insert_session_id").value;

if((organization_id==0)&&(branch_id==0)&&(session_id==0))
    {
    alert("Please enter organization,branch,session id,Please reload page");
return false;    
    }else 
if((route_id==0))
    {
   document.getElementById("sub_route").innerHTML="<option value='0'>-- Select Sub Route --</option>";
   document.getElementById("vehicle_type_id").innerHTML="<option value='0'>-- Select vehicle type --</option>";
    document.getElementById("vehicle_reg_no").innerHTML="<option value='0'>Select vehicle reg. no</option>";
   
    return false;
    }
    
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
document.getElementById("fetch_record").innerHTML=httpxml.responseText;
 var vehicle_type_value=document.getElementById("vehicle_type_data").innerHTML;
 document.getElementById("vehicle_type_id").innerHTML=vehicle_type_value;
 
 var sub_route_data=document.getElementById("sub_route_record").innerHTML;
 document.getElementById("sub_route").innerHTML=sub_route_data;
 document.getElementById("fetch_record").innerHTML="";
   
   document.getElementById("ajax_loader_show").style.display="none";    
              
     }else
         {
             document.getElementById("ajax_loader_show").style.display="none";    
              
   
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="ajax_code.php";
url=url+"?route_id="+route_id+"&&org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
                 }
                 
                 
                 
                 
                 //vehicle type 
                 
                  function change_vehicle_type_id(vehicle_type_id)
                 {        

var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("brnach_id").value;
var session_id=document.getElementById("insert_session_id").value;
var route_id=document.getElementById("route_id").value;
if((organization_id==0)&&(branch_id==0)&&(session_id==0))
    {
    alert("Please enter organization,branch,session id,Please reload page");
return false;    
    }else 
        if(route_id==0)
            {
             alert("Please first select route name");
             document.getElementById("route_id").focus();
             return false;
            }else
if((vehicle_type_id==0))
    {
   document.getElementById("vehicle_reg_no").innerHTML="<option value='0'>Select vehicle reg. no</option>";
   document.getElementById("vehicle_rent").innerHTML="<option value='0'>0</option>";
    return false;
    }
    
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
 document.getElementById("vehicle_reg_no").innerHTML=httpxml.responseText;
 document.getElementById("ajax_loader_show").style.display="none";    
             
 
     }else
         {
             document.getElementById("ajax_loader_show").style.display="none";    
              
   
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="ajax_code.php";
url=url+"?vehicel_type_route_id="+route_id+"&&vehicle_type_id="+vehicle_type_id+"&&org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
                 }
                 
                 
             
                 
                 
          //edit student javascript
function on_show_photo(number)
{
 var input_photo=document.getElementById("input_photo_"+number).value;   
 if(input_photo==0)
     {
     document.getElementById("show_photo_"+number).style.display="block";
     document.getElementById("input_photo_"+number).value=1;    
     }else
         {
         document.getElementById("show_photo_"+number).style.display="none";
         document.getElementById("input_photo_"+number).value=0;    
         }
}
  
  
  //hostel to room no
  
  function hostel_unique_name(hostel_id)
 {        
var httpxml;   
if((hostel_id==0))
    {
      return false;
    }
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
        

 document.getElementById("room_div").innerHTML="<select \n\
  name='hostel_room_id' id='hostel_room_id' tabindex='-1' class='chosen-select' data-placeholder='Select Room'  style=' width:300px; '><option value='0'></option>\n\
\n\
"+httpxml.responseText+"</select>";
 document.getElementById("ajax_loader_show").style.display="none";    
    
var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
   
     }else
         {
             
           document.getElementById("hostel_room_id").innerHTML="<option value='0'>Record no found !!</option>";
             document.getElementById("ajax_loader_show").style.display="none";    
              
   
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
  
var url="ajax_code.php";
url=url+"?hostel_id="+hostel_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
                 }