 //class to get section
 
 function section_change(section_id)
 {    
   var class_id=document.getElementById("class_name").value;  
var httpxml; 
if(class_id==0)
{
 alert("Please first select class");
 document.getElementById("class_name").focus();
 return false;
}else
if((section_id==0))
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
 document.getElementById("subject_id").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";    
              
     }else
         {
           document.getElementById("subject_id").innerHTML="<option value='0'>Record no found !!</option>";
             document.getElementById("ajax_loader_show").style.display="none";    
              
   
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="ajax_code.php";
url=url+"?temp_class_id="+class_id+"&temp_section_id="+section_id+"";
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
                 }
                 
        function add_attech_file()
        {
     
     
      var temp_no=new Number(document.getElementById("temp_assign_no").value);  
      
      for(var i=0;i<=temp_no;i++)
      {
     if(document.getElementById("attach_file_"+i+""))
     {
       var attach_file_name=document.getElementById("attach_file_"+i+"").value;  
       if(attach_file_name==0)
       {
        alert("Please choose attach file");
        document.getElementById("attach_file_"+i+"").focus();
        return false;
       }
     }
      }
     var add_new_one=new Number('1');       
 var r=confirm("Are you sure you want to add new attach file");
if (r==true)
  { 
      
   var table = document.getElementById("attach_file_table");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
     
  var add_both=new Number(temp_no+add_new_one);
  cell1.innerHTML='<input type="hidden" name="temp_attach_file[]"><input type="file" id="attach_file_'+add_both+'" name="attech_file[]" id="attech_file">';
  cell2.innerHTML='<input type="button" onclick="removeen(this)" class="remove_button_style" value="Remove">';
  document.getElementById("temp_assign_no").value=add_both;
  
       }
        
        }
        
        
        function removeen(row)
        {
             var r=confirm("Are you sure you want to remove");
if (r==true)
  { 
   var i=row.parentNode.parentNode.rowIndex;
  document.getElementById('attach_file_table').deleteRow(i);    
  }
        }