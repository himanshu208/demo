<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/edit_page_configuration.php';
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
         
         $update_db_id=$_POST['update_unique_id'];

  
 if((!empty($category))&&(!empty($isbn))&&(!empty($title))&&(!empty($subject))&&(!empty($author))
         &&(!empty($edition))&&(!empty($publisher))&&(!empty($issuable))&&(!empty($update_db_id))&&(!empty($insert_session_id)))
 {
  
 $select_match_book_db=mysql_query("SELECT * FROM library_book_db WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and book_unique_id!='$update_db_id' and category_id='$category'"
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
      
    $update_db=mysql_query("UPDATE library_book_db SET category_id='$category',isbn='$isbn',title='$title',subject='$subject',author_id='$insert_admin_id',edition='$edition',"
            . "publisher='$publisher',tag='$insert_tag',copy='$copy',price='$price',issuable='$issuable',position='$position',description='$description' WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and book_unique_id='$update_db_id' and is_delete='none'");
    if((!empty($update_db))&&($update_db)) 
    {
      $message_show="<div class='notification_alert_show' style='color:green;'>Record update successfully complete.</div>";   
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


<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Book Details</title>
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
            
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validate_form();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Book Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];
             
            $select_data=mysql_query("SELECT * FROM library_book_db WHERE organization_id='$fetch_school_id' and"
         . " branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and encrypt_id='$token_id' and is_delete='none'"); 
            $fetch_data=mysql_fetch_array($select_data);
            $fetch_num_data=mysql_num_rows($select_data);
            if((!empty($fetch_data))&&($fetch_data!=null)&&($fetch_num_data!=0))
            {
            
              $session_id=$fetch_data['session_id'];    
              
               $book_unique_id=$fetch_data['book_unique_id'];
                           $encrypt_id=$fetch_data['encrypt_id'];
                           $category=$fetch_data['category_id'];
                           $isbn=$fetch_data['isbn'];
                               $title=$fetch_data['title'];
                               $subject=$fetch_data['subject'];
                               $author_id=$fetch_data['author_id'];
                               $edition=$fetch_data['edition'];
                               $publisher=$fetch_data['publisher'];
                               $tag_id=$fetch_data['tag'];
                               $copy=$fetch_data['copy'];
                               $price=$fetch_data['price'];
                               $issueable=$fetch_data['issuable'];
                               $position=$fetch_data['position'];
                               $description=$fetch_data['description'];
              
                               
                               $author_db=mysql_query("SELECT * FROM library_author_db WHERE author_unique_id='$author_id'");
                              $author_data=mysql_fetch_array($author_db);
                              $author_num_rows=mysql_num_rows($author_db);
                              
                              if((!empty($author_data))&&($author_data!=null)&&($author_num_rows!=0))
                              {
                              $author_name=$author_data['author'];    
                              }else
                              {
                               $author_name="";   
                              }
                               $tag_array=array();
                              $explode_tag=explode(",",$tag_id);
                              foreach ($explode_tag as $tag_u_id)
                              {
                                  array_push($tag_array, $tag_u_id);  
                              }
                              
                              if($issueable=="yes")
                              {
                                 $yes_check="checked";
                                 $no_check="";
                              }  else {
                                $yes_check="";
                                 $no_check="checked";  
                              }
                              
                              
             {
             ?>  
              <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $book_unique_id;?>">
             <input type="hidden" name="use_inset_session_id" id="insert_session_id"  value="<?php  echo $session_id;?>">   
      
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
                                       if($category==$fetch_unique_id)
                                       {
echo "<option id='$fetch_unique_id' value='$fetch_unique_id' selected>$fetch_category_name</option>";
                                       }else
                                       {
echo "<option id='$fetch_unique_id' value='$fetch_unique_id'>$fetch_category_name</option>";      
                                       }
                               }
                               ?>
                           </select>
                           
                       </td></tr>
                      
                      
                      
                        <tr>
                            <td><b>ISBN <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b> <input type="text" value="<?php echo $isbn;?>" id="isbn" name="isbn" placeholder="Please enter ISBN" class="text_box_class"></td>
                       </tr>
                       
                       <tr>
                            <td><b>Title <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b> <input type="text" value="<?php echo $title;?>" id="title" name="title" placeholder="Please enter title" class="text_box_class"></td>
                       </tr>
                       
                       <tr>
                            <td><b>Subject <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b> <input type="text" value="<?php echo $subject;?>" id="subject" name="subject" placeholder="Please enter subject" class="text_box_class"></td>
                       </tr>
                       
                       <tr>
                            <td><b>Author <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td>
                           <input type="hidden" name="temp_author_id" value="<?php echo $author_id;?>" id="temp_author_id">
                           <input type="text" autocomplete="off" value="<?php echo $author_name;?>" onkeyup="author_key_up(this.value)" id="author" name="author" placeholder="Please enter author" class="text_box_class">
                       <div id="ul_dataas" class="ul_dataas">
                           <ul id="list"></ul>  
                       </div>
                       </td></tr>
                       
                       <tr>
                            <td><b>Edition <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b> <input type="text" value="<?php echo $edition;?>" id="edition" name="edition" Placeholder="Please enter edition" class="text_box_class"></td>
                       </tr>
                       
                       <tr>
                            <td><b>Publisher <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b> <input type="text" value="<?php echo $publisher;?>" id="publisher" name="publisher" placeholder="Please enter publisher"  class="text_box_class"></td>
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
                        if(in_array($tag_unique_id,$tag_array))
                        {
                         echo "<option value='$tag_unique_id' selected>$library_tag</option>"; 
                        }else
                        {
                            echo "<option value='$tag_unique_id' >$library_tag</option>"; 
                        }
                                 
                        }
            ?>
                        </select>   
                           
                       </td> 
                       
                       </tr>
                       
                       <tr>
                            <td><b>Copy <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b> <input type="text" id="copy"  name="copy" value="<?php echo $copy;?>" onkeypress="javascript:return isNumber (event)"
                                      class="text_box_class" style=" width:35%; text-align:center; "></td>
                       </tr>
                       
                       
                       <tr>
                            <td><b>Price <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b><?php echo $fetch_currency;?></b> <input type="text"  id="price" onkeypress="javascript:return isNumber (event)" autocomplete="off" name="price"
                style=" width:30%; text-align:right;  " value="<?php echo $price;?>" class="text_box_class">/-</td>
                       </tr>
                       
                        <tr>
                            <td><b>Issuable <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><b>
                               <table>
                                   <tr>
                                       <td><input type="radio" name="issuable" value="yes" <?php echo $yes_check;?>></td><td>Yes</td>
                                       <td><input type="radio" name="issuable" value="no" <?php echo $no_check;?>></td><td>No</td>
                                   </tr>
                               </table>  
                           </b></td>
                       </tr>
                       
                       <tr>
                       <td><b>Position</b></td>
                       <td><b>:</b></td>
                       <td><textarea id="library_position" name="library_position"
                                     placeholder="Enter position" class="text_area_class" style=" height:45px; "><?php echo $position;?></textarea></td>
                       </tr>
                       
                       
                       <tr>
                       <td><b>Description</b></td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter description" class="text_area_class" style=" height:45px; "><?php echo $description;?></textarea></td>
                       </tr>
                       
                       <tr>
                           <td colspan="3">
                               <input type="submit" class="submit_process" style=" margin-right:0px; " name="submit_process" value="Update"> 
                               
                               <input type="reset" class="reset_process" style=" margin-right:20px; " name="reset_process" value="Reset">
                               
                               
                           </td>
                       </tr>
                   </table>    
               
                
                
            <?php
             }
            }
             }
            ?>
            
  <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>        
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