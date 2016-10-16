   function get_details()
   {
       
   var student_check=document.getElementById("student_check").checked;
   var parents_check=document.getElementById("parent_check").checked;
   var employee_check=document.getElementById("employee_check").checked;
   var contact_check=document.getElementById("contact_check").checked;
   if(student_check==true)
   {
   var class_id=document.getElementById("class_id").value;
   var section_id=document.getElementById("section_id").value;
   var house_id=document.getElementById("house_id").value;
   if(class_id==0)
   {
      alert("Please select class/course");
      document.getElementById("class_id").focus();
      return false;
   }
   }else
   if(parents_check==true)
   {
    var parnet_check=document.getElementById("all_parent").checked;
    if(parnet_check==false)
    {
      alert("Please check all parent");
      return false;
    }
    var all_parent="all_parent";   
    
   }else
   if(employee_check==true)
   {
       
   var department=document.getElementById("department_id").value;
   var designation=document.getElementById("designation_id").value;
   var profession_teaching_yes=document.getElementById("teching_yes").checked;
   var profession_teaching_no=document.getElementById("teaching_no").checked;
   var all_teachers=document.getElementById("all_employee").checked;
   
   if(all_teachers==true)
   {
   var all_amployee_search="yes";    
   }else
   {
   var all_amployee_search="no";        
   }
   
   if(profession_teaching_yes==true)
   {
    var teching="yes";   
   }else
    if(profession_teaching_no==true)
   {
      var teching="no";     
   }else
   {
      var teching="no_search";     
   }
   
   }else
   if(contact_check==true)
   {
    var all_contact=document.getElementById("all_contact").checked;
    if(all_contact==true)
    {
     all_contact="yes";   
    }else
    {
     all_contact="no";    
    }
    var group=document.getElementById("group_id").value;   
   }else
   {
    alert("Please select atleast one option");
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
       
 document.getElementById("data_list").innerHTML=httpxml.responseText;
 document.getElementById("ajax_loader_show").style.display="none";
 
   $(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"
                
            });
            var user_length=$('input[name="post_data[]"]:checked').length;
            document.getElementById("total_reciver").innerHTML=user_length;
            
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });  
              var user_length=$('input[name="post_data[]"]:checked').length;
            document.getElementById("total_reciver").innerHTML=user_length;
        }
    });
 
           
}); 
     }else
     {
         document.getElementById("ajax_loader_show").style.display="none";
         alert("Sorry,Request failed,Please try again later");
         return false;   
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="sms_ajax_code.php";

 if(student_check==true)
   {
url=url+"?search=student&class="+class_id+"&section="+section_id+"&house="+house_id+"";
   }else
   if(parents_check==true)
   {
   url=url+"?all_parent=all";
    
   }else
   if(employee_check==true)
   {
   
   url=url+"?all_employee_details=yes&all_employee="+all_amployee_search+"&department_id="+department+"&designation_id="+designation+"&teching="+teching+"";    
   }else
   if(contact_check==true)
   {
    url=url+"?all_contact=all_contact&group="+group+"";   
   }else
   {
   url=url+"?class=0&section=0&house=0";    
   }
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
   
   }
   
   
   function message_type(msg_id)
   {
    if(msg_id==0)
    {
        
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
       
 document.getElementById("message_data_load").innerHTML="<ul>"+httpxml.responseText+"</ul>";
 document.getElementById("ajax_loader_show").style.display="none";

     }else
     {
         document.getElementById("ajax_loader_show").style.display="none";
         alert("Sorry,Request failed,Please try again later");
         return false;   
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="sms_ajax_code.php";
 url=url+"?message_id="+msg_id+"";    
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
    }    
   }
   
    $(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"
                
            });
            var user_length=$('input[name="post_data[]"]:checked').length;
            document.getElementById("total_reciver").innerHTML=user_length;
            
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });  
              var user_length=$('input[name="post_data[]"]:checked').length;
            document.getElementById("total_reciver").innerHTML=user_length;
        }
    });
 
           
}); 
 