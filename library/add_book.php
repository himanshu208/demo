<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>


<?php 
//insert library category values

$message_show="";
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
if(isset($_POST['submit_process']))
{
 $category=$_POST['category'];
 $isbn=$_POST['isbn'];
         $title=$_POST['title'];
         $subject=$_POST['subject'];
         $author_id=$_POST['temp_author_id'];
         $author=$_POST['author'];
         $edition=$_POST['edition'];
         $publisher=$_POST['publisher'];
         $tag=$_POST['tag'];
         $insert_tag=implode(",",$tag);
         $copy=$_POST['copy'];
         $price=$_POST['price'];
         $issuable=$_POST['issuable'];
         $position=$_POST['library_position'];
         $description=$_POST['description'];
         $insert_session_id=$_POST['use_inset_session_id'];
         
         
      
 
$result=mysql_query("SHOW TABLE STATUS LIKE 'library_book_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_db_id="LIB_ITEM_$nextId"; 
$encrypt_id=md5(md5($final_db_id));

  
 if((!empty($category))&&(!empty($isbn))&&(!empty($title))&&(!empty($subject))&&(!empty($author))
         &&(!empty($edition))&&(!empty($publisher))&&(!empty($issuable))&&(!empty($final_db_id))&&(!empty($insert_session_id)))
 {
  
 $select_match_book_db=mysql_query("SELECT * FROM library_book_db WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and category_id='$category'"
         . " and title='$title' and author_id='$author_id' and edition='$edition' "
         . "and publisher='$publisher' and is_delete='none'"); 
 $fetch_book_data=mysql_fetch_array($select_match_book_db);
 $fetch_book_num_rows=mysql_num_rows($select_match_book_db);
    if((empty($fetch_book_data))&&($fetch_book_data==null)&&($fetch_book_num_rows==0)) 
    {
      
    if(empty($author_id))
    {

$results=mysql_query("SHOW TABLE STATUS LIKE 'library_author_db'");
$rows=mysql_fetch_array($results);
$nextIds=$rows['Auto_increment']; 
$final_db_ids="LIB_AUTHR_$nextIds"; 
$encrypt_ids=md5(md5($final_db_ids)); 
        
    $author_db=mysql_query("INSERT into library_author_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'
         ,'$final_db_ids','$encrypt_ids','$author','','none','$date','$date_time','$user_unique_id')"); 
    if((!empty($author_db))&&($author_db))
    {
   $insert_admin_id=$final_db_ids;    
    }else
    {
    $insert_admin_id=0;    
    }
    }else
    {
     $insert_admin_id=$author_id;   
    }   
        
     if(!empty($insert_admin_id))
     {
        
    $insert_db=mysql_query("INSERT into library_book_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'
         ,'$final_db_id','$encrypt_id','$category','$isbn','$title','$subject','$insert_admin_id','$edition','$publisher'"
            . ",'$insert_tag','$copy','$price','$issuable','$position','$description','none','$date','$date_time','$user_unique_id')");
    if((!empty($insert_db))&&($insert_db)) 
    {
      $message_show="<div class='notification_alert_show' style='color:green;'>Record save successfully complete.</div>";   
    }else
    {
    $message_show="<div class='notification_alert_show'>Request failed,please try again</div>";     
    }
    
     }else
     {
       $message_show="<div class='notification_alert_show'>Request failed,please try again</div>";     
      
     }
        
    }else $message_show="<div class='notification_alert_show'>Record already exist in database.</div>"; 
     
   
  
 }else $message_show="<div class='notification_alert_show'>Please fill all fields.</div>";
  
 
require_once '../pop_up.php';
 
}


?>





<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add Book</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
        function validate_form() 
        {
         var category=document.getElementById("category").value;
         var isbn=document.getElementById("isbn").value;
                 var title=document.getElementById("title").value;
                 var subject=document.getElementById("subject").value;
                 var author=document.getElementById("author").value;
                 var edition=document.getElementById("edition").value;
                 var publisher=document.getElementById("publisher").value;
                 var tag=document.getElementById("tag").value;
                 var copy=document.getElementById("copy").value;
                 var price=document.getElementById("price").value;
                 
         if(category==0)
         {
          alert("Please select category");
          document.getElementById("category").focus();
          return false;
         }else
         {
          document.getElementById("ajax_loader_show").style.display="block";   
         }
        }
        </script>
        
        <script type="text/javascript">
      function author_key_up(author_key)
      {
          document.getElementById("ul_dataas").style.display="block";  
          document.getElementById("temp_author_id").value="";
       var org_id="<?php echo $fetch_school_id;?>";
               var branch_id="<?php echo $fetch_branch_id;?>";
               var session_id=document.getElementById("insert_session_id").value;
               if(org_id==0 || branch_id==0 || session_id==0)
               {
                alert("Sorry technical problem,Please try again.");
                return false;
               }else
      if(author_key==0)
      {
       document.getElementById("ul_dataas").style.display="none";   
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
 document.getElementById("list").innerHTML=httpxml.responseText;
     }else
     {
      document.getElementById("ul_dataas").style.display="none";     
     }
     
     }else
     {
      
     }
    } 
  
var url="ajax_code.php";
url=url+"?token_id="+author_key+"&org_id="+org_id+"&branch_id="+branch_id+"&session_id="+session_id+"";
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);   
      }  
      }
      
      function author_select(author_id,author_name)
      {
       document.getElementById("temp_author_id").value=author_id;
       document.getElementById("author").value=author_name;
       document.getElementById("ul_dataas").style.display="none";   
      } 
      
      
        </script>
        
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
                           <td><a href="library.php">Library</a></td>
                           <td>/</td>
                           <td><a href="library_setting.php">Library Setting</a></td>
                           <td>/</td>
                           <td>Add Book</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Add Book</b></div>
                    <a href="view_book_list.php">
                        <div class="view_button">View Books List</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   <table cellsapcing="4" cellpadding="4" class="table_middle" style=" font-size:12px; ">
                       <tr>
                           <td><span style=" display:none; "><?php echo $message_show;?></span></td>
                       </tr>
                       <tr>
                           <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                       </tr>
                       
                       <tr>
                           <td><br/></td>
                       </tr>
                      <tr>
                          <td><b>Category <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><select onchange="change_category(this.value)" id="category" name="category" class="select_class">
                               <option value="0">--- Select Category ---</option>
                               <?php
                               $category_db=mysql_query("SELECT * FROM library_category_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and is_delete='none'");
                               while ($fetch_category_data=mysql_fetch_array($category_db))
                               {
                                 $fetch_unique_id=$fetch_category_data['lib_category_unique_id'];
                                         $fetch_category_name=$fetch_category_data['category'];
                                         
                                         echo "<option id='$fetch_unique_id' value='$fetch_unique_id'>$fetch_category_name</option>";
                               }
                               ?>
                           </select>
                           
                       </td><td><a href="manage_library_category.php"><div class="add_button_styles">Add</div></a></td>
                       </tr>
                      
                      
                      
                        <tr>
                            <td><b>ISBN <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b> <input type="text" id="isbn" name="isbn" placeholder="Please enter ISBN" class="text_box_class"></td>
                       </tr>
                       
                       <tr>
                            <td><b>Title <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b> <input type="text" id="title" name="title" placeholder="Please enter title" class="text_box_class"></td>
                       </tr>
                       
                       <tr>
                            <td><b>Subject <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b> <input type="text" id="subject" name="subject" placeholder="Please enter subject" class="text_box_class"></td>
                       </tr>
                       
                       <tr>
                            <td><b>Author <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td>
                           <input type="hidden" name="temp_author_id" id="temp_author_id">
                           <input type="text" onkeyup="author_key_up(this.value)" id="author" name="author" placeholder="Please enter author" class="text_box_class">
                       <div id="ul_dataas" class="ul_dataas">
                           <ul id="list"></ul>  
                       </div>
                       </td><td><a href="manage_author.php"><div class="add_button_styles">Add</div></a></td>
                       </tr>
                       
                       <tr>
                            <td><b>Edition <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b> <input type="text" id="edition" name="edition" Placeholder="Please enter edition" class="text_box_class"></td>
                       </tr>
                       
                       <tr>
                            <td><b>Publisher <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b> <input type="text" id="publisher" name="publisher" placeholder="Please enter publisher"  class="text_box_class"></td>
                       </tr>
                       
                       <tr>
                            <td><b>Tag <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td>
                           <select id="tag" name="tag[]" data-placeholder="Choose a tag" class="chosen-select" multiple style="width:330px;" tabindex="4">
                        <option value=""></option>
            <?php
             $library_tag_db=mysql_query("SELECT * FROM library_tag_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'"
                                . "and session_id='$fecth_session_id_set' and is_delete='none'");
                        while ($fetch_library_tag_data=mysql_fetch_array($library_tag_db))
                        {
                           
                                 $tag_db_id=$fetch_library_tag_data['id'];
                                 $tag_unique_id=$fetch_library_tag_data['tag_unique_id'];
                                 $encrypt_id=$fetch_library_tag_data['encrypt_id'];
                                 $library_tag=ucwords($fetch_library_tag_data['tag']);
                                 $tag_description=$fetch_library_tag_data['description'];
                        
                                 echo "<option value='$tag_unique_id'>$library_tag</option>";           
                                 
                        }
            ?>
                        </select>   
                           
                       </td> 
                       <td><a href="manage_tag.php"><div class="add_button_styles">Add</div></a></td>
                       </tr>
                       
                       <tr>
                            <td><b>Copy <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b> <input type="text" id="copy" name="copy" value="0" onkeypress="javascript:return isNumber (event)"
                                      class="text_box_class" style=" width:35%; text-align:center; "></td>
                       </tr>
                       
                       
                       <tr>
                            <td><b>Price <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b><?php echo $fetch_currency;?></b> <input type="text" id="price" onkeypress="javascript:return isNumber (event)" autocomplete="off" name="price"
style=" width:30%; text-align:right;  " value="0" class="text_box_class">/-</td>
                       </tr>
                       
                        <tr>
                            <td><b>Issuable <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b>
                               <table>
                                   <tr>
                                       <td><input type="radio" name="issuable" value="yes" checked></td><td>Yes</td>
                                       <td><input type="radio" name="issuable" value="no"></td><td>No</td>
                                   </tr>
                               </table>  
                           </b></td>
                       </tr>
                       
                       <tr>
                       <td><b>Position</b></td>
                       <td><b>:</b></td>
                       <td><textarea id="library_position" name="library_position"
                                     placeholder="Enter position" class="text_area_class" style=" height:45px; "></textarea></td>
                       </tr>
                       
                       
                       <tr>
                       <td><b>Description</b></td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter description" class="text_area_class" style=" height:45px; "></textarea></td>
                       </tr>
                       
                       <tr>
                           <td colspan="3">
                               <input type="submit" class="submit_process" style=" margin-right:0px; " name="submit_process" value="Save"> 
                               
                               <input type="reset" class="reset_process" style=" margin-right:20px; " name="reset_process" value="Reset">
                               
                               
                           </td>
                       </tr>
                   </table>    
                   
               </div>
                
             
                
                
               
            </div> 
        </div>
  
  <link rel="stylesheet" href="../javascript/combosearch/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
  </style>
            
  <script src="../javascript/combosearch/chosen.jquery.js" type="text/javascript"></script>
  <script src="../javascript/combosearch/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
            
            
        <div id="include_fotter_page">
       <?php require_once '../fotter/fotter_page.php'; ?>   
        </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>