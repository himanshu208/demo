<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>



<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>View Book List</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
    </head>
    
    <body onload="page_load()">
        
        <?php  include_once '../ajax_loader_page_second.php';?>
       
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" name="myForm" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
        
            <?php
            if((!empty($_REQUEST['search']))&&(!empty($_REQUEST['search_option']))&&(!empty($_REQUEST['search_qq'])))
            {
           $search_type=$_REQUEST['search'];
           $search_option=$_REQUEST['search_option'];
           $search_qq=$_REQUEST['search_qq'];
           
           {
           ?>
            <script type="text/javascript">
            function page_load()
            {
            
            document.getElementById("advance_search").style.display="none";
            document.getElementById("normal_search_div").style.display="block";
            document.getElementById("<?php echo $search_option;?>_check").checked=true;   
            document.getElementById("category_box").style.display="none";    
            document.getElementById("author_box").style.display="none"; 
            document.getElementById("tag_box").style.display="none";
            document.getElementById("<?php echo $search_option;?>_box").style.display="block";
            document.getElementById("<?php echo $search_qq;?>").selected=true;
        
            }
            </script>
            
           <?php
           }    
            }else
            if((!empty($_REQUEST['search']))&&(!empty($_REQUEST['search_by']))&&(!empty($_REQUEST['search_qq'])))
            {
           $search_type=$_REQUEST['search'];
           $search_by=$_REQUEST['search_by'];
           $search_qq=$_REQUEST['search_qq'];
           
           {
           ?>
            <script type="text/javascript">
            function page_load()
            {
          document.getElementById("advance_check").checked=true;
           document.getElementById("normal_search_div").style.display="none"; 
            document.getElementById("advance_search").style.display="block";
            document.getElementById("<?php echo $search_by;?>").selected=true;
            document.getElementById("search_qq").value="<?php echo $search_qq;?>"
            }
            </script>
            
           <?php
           }    
            }
            ?>
            
            
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
                           <td>View Book List</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>View Book List</b></div>
                    <a href="add_book.php">
                        <div class="view_button">Add New Book</div></a>
                </div>
                 <script type="text/javascript">
                  function search_choose(search_option)
                  {
                  if(search_option=="normal")
                  {
                      document.getElementById("advance_search").style.display="none";
                      document.getElementById("normal_search_div").style.display="block";
                  }else
                   if(search_option=="advance")
                  {
                   document.getElementById("normal_search_div").style.display="none";
                   document.getElementById("advance_search").style.display="block";   
                  }
                  }
                 </script>
                
               <div class="middle_left_div_tag">
                   
                   <div class="filter_div" style=" float:left; ">
                       <div class="search_option_div">
                       <table class="search_option_table" style=" margin:0 auto; ">
                           <tr>
                               <td><input type="radio" class="radio_check" id="normal_check" onclick="search_choose('normal')" name="search_option" checked></td><td><b>Normal Search</b></td> 
                               <td style="width:10%; "></td>
                               <td><input type="radio" class="radio_check" id="advance_check" onclick="search_choose('advance')" name="search_option"></td><td><b>Advance Search</b></td>
                           </tr>   
                       </table></div>
                       <script type="text/javascript">
                       function select_change(select_option)
                       {
                        if(select_option=="category")
                        {
                       document.getElementById("author_box").style.display="none";    
                       document.getElementById("tag_box").style.display="none"; 
                       document.getElementById("category_box").style.display="block"; 
                        }else
                            if(select_option=="author")
                        {
                       document.getElementById("category_box").style.display="none";    
                       document.getElementById("tag_box").style.display="none"; 
                       document.getElementById("author_box").style.display="block";    
                        }else
                            if(select_option=="tag")
                        {
                       document.getElementById("category_box").style.display="none";    
                       document.getElementById("author_box").style.display="none"; 
                       document.getElementById("tag_box").style.display="block";    
                        }
                       }
                           
                       </script>
                       
                       <script type="text/javascript">
                           function search_button()
                           {
                               if(document.getElementById("category_check").checked)
                               {
                                var catg=document.getElementById("category_box").value;
                                var choose_search_by="category";
                                if(catg==0)
                                {
                                 alert("Please select category");
                                 document.getElementById("category_box").focus();
                                 return false;
                                }
                               }else
                                   if(document.getElementById("author_check").checked)
                               {
                                var catg=document.getElementById("author_box").value;
                                var choose_search_by="author";
                                if(catg==0)
                                {
                                 alert("Please select author");
                                 document.getElementById("author_box").focus();
                                 return false;
                                }
                               }else
                                if(document.getElementById("tag_check").checked)
                               {
                                 var catg=document.getElementById("tag_box").value;
                                 var choose_search_by="tag";
                                if(catg==0)
                                {
                                 alert("Please select tag");
                                 document.getElementById("tag_box").focus();
                                 return false;
                                }
                               }
                             
          document.getElementById("ajax_loader_show").style.display="block";        
          window.location.assign("view_book_list.php?search=normal&search_option="+choose_search_by+"&search_qq="+catg+"");   
                              
                           }
                           
                           function clear_all()
                           {
                                document.getElementById("ajax_loader_show").style.display="block";
 window.location.assign("view_book_list.php");   
                                         
                           }
                           
                           
                           function advance_search()
                           {
                            var search_by=document.getElementById("search_by").value;
                            var search_qq=document.getElementById("search_qq").value;
                            
                            if(search_by==0)
                            {
                                alert("Please select search by");
                                document.getElementById("search_by").focus();
                                return false;
                            }else
                                if(search_qq==0)
                            {
                               alert("Please enter search keyword here");
                               document.getElementById("search_qq").focus();
                               return false;
                            }else
                            {
document.getElementById("ajax_loader_show").style.display="block";        
window.location.assign("view_book_list.php?search=advance&search_by="+search_by+"&search_qq="+search_qq+"");   
                 
                            }
                           }
                           
                           </script>
                       
                       
                       <div id="normal_search_div" style=" width:100%; float:left;   margin-top:10px; ">
                           <table style=" margin:0 auto; margin-top:10px;  ">
                               <tr>
                                   <td>
                                       <table style=" margin-right:15px; ">
                                   <tr>
                                   <td><input type="radio" id="category_check" class="radio_check" name="select_option_this" onchange="select_change('category')" checked></td><td><b>Category</b></td>
                                   <td><input type="radio" id="author_check" class="radio_check" name="select_option_this" onchange="select_change('author')" ></td><td><b>Author</b></td>
                                   <td><input type="radio" id="tag_check" class="radio_check" name="select_option_this" onchange="select_change('tag')" ></td><td><b>Tag</b></td>
                                       
                                   </tr>
                               </table>
                                   </td>
                                   <td><b>:</b></td>
                                       <td>
                                           <select id="category_box" class="select_box">
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
                                           
                                           
                                           <select id="author_box" class="select_box" style=" display: none;">
                                               <option value="0">--- Select Author ---</option>   
                                            <?php
    $author_db=mysql_query("SELECT * FROM library_author_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and is_delete='none'");
                               while ($fetch_author_data=mysql_fetch_array($author_db))
                               {
                                 $fetch_unique_id=$fetch_author_data['author_unique_id'];
                                         $fetch_author_name=$fetch_author_data['author'];
                                         
                                         echo "<option id='$fetch_unique_id' value='$fetch_unique_id'>$fetch_author_name</option>";
                               }
                               ?>    
                                               
                                           </select>  
                                           
                                           
                                           <select id="tag_box" class="select_box" style=" display: none;">
                                               <option value="0">--- Select Tag ---</option> 
                                                 <?php
    $tag_db=mysql_query("SELECT * FROM library_tag_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and is_delete='none'");
                               while ($fetch_tag_data=mysql_fetch_array($tag_db))
                               {
                                 $fetch_unique_id=$fetch_tag_data['tag_unique_id'];
                                         $fetch_tag_name=$fetch_tag_data['tag'];
                                         
                                         echo "<option id='$fetch_unique_id' value='$fetch_unique_id'>$fetch_tag_name</option>";
                               }
                               ?>    
                                           </select>  
                                       </td>
                              
                               </tr>  
                               <tr>
                                   <td colspan="3">
<input type="button" class="filter_button" onclick="search_button()" value="Search">   
<input type="button" class="clear_button" onclick="clear_all()" value="Clear All">
                                      
                                   </td>
                               </tr>
                           </table>  
                       </div>
                       
                       
                       <div id="advance_search" style=" width:100%; float:left; display:none;    margin-top:20px; ">
                           <table style=" margin:0 auto; ">
                               <tr>
                                   <td><b>Search By</b></td><td><b>:</b></td>
                                   <td>
                                       <select id="search_by" class="select_box">
                                        <option value="0">---Select Search By---</option> 
                                        <option id="isbn" value="isbn">ISBN</option>
                                        <option id="title" value="title">Title</option>
                                        <option id="subject" value="subject">Subject</option>
                                        <option id="edition" value="edition">Edition</option>
                                        <option id="publisher" value="publisher">Publisher</option>
                                        <option id="issuable" value="issuable">Issuable</option>
                                        <option id="position" value="position">Position</option>
                                        <option id="description" value="description">Description</option>
                                       </select></td>
                                       <td style=" width:5%; "></td>
                                       <td><b>Search</b></td>
                                       <td><b>:</b></td>
                                       <td><input type="text" id="search_qq" class="search_box_styling"
                                                  placeholder="Search Keyword here"></td>
                               </tr>
                               <tr>
                                   <td colspan="8">
                                       <input type="button" onclick="advance_search()" class="filter_button" value="Search">   
                                       <input type="button" onclick="clear_all()" class="clear_button" value="Clear All">
                                      
                                   </td>
                               </tr>
                           </table>   
                       </div>
                       
                       
                       
                       
                   </div> 
                   
                   <div id="top_buttons_div">
                       <div class="button_show_style">Print</div>   
                   </div>
                   
                   <table cellspacing="0" cellpadding="0" class="table_details">
                       <tr>
                           <td class="th_styling">Sl No.</td>
                           <td class="th_styling">Category</td>
                           <td class="th_styling">ISBN</td>
                           <td class="th_styling">Title</td>
                           <td class="th_styling">Subject</td>
                           <td class="th_styling">Edition</td>
                           <td class="th_styling">Issuable</td>
                           <td class="th_styling">Copy</td>
                           <td class="th_styling">Price</td>
                           <td class="th_styling">View Details</td>
                           <td class="th_styling" style=" border-right:1px solid gray;  ">Action</td>
                       </tr>
                       <?php
           if((!empty($_REQUEST['search']))&&(!empty($_REQUEST['search_option']))&&(!empty($_REQUEST['search_qq'])))
            {
           $search_type=$_REQUEST['search'];
           $search_option=$_REQUEST['search_option'];
           $search_qq=$_REQUEST['search_qq'];
           
           if($search_option=="category")
           {
           $search_result="and category_id='$search_qq'";
           }else
            if($search_option=="author")
           {
           $search_result="and author_id='$search_qq'";
           }else
           if($search_option=="tag")
           {
           $search_result="and tag LIKE '%$search_qq%'";
           }
           
            }else
                if((!empty($_REQUEST['search']))&&(!empty($_REQUEST['search_by']))&&(!empty($_REQUEST['search_qq'])))
                {
                $search_by=$_REQUEST['search_by'];
                $search_qq=$_REQUEST['search_qq'];
                $search_result="and $search_by LIKE '%$search_qq%'";     
                    
                }else
            {
            $search_result="";    
            }
                       
           ?>
                       
                     <?php 
                       $row=0;
                       $book_db=mysql_query("SELECT * FROM  library_book_db WHERE organization_id='$fetch_school_id'"
                               . " and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' $search_result"
                               . " and is_delete='none'");
                        while ($book_data=mysql_fetch_array($book_db))
                       {
                       $book_unique_id=$book_data['book_unique_id'];
                           $encrypt_id=$book_data['encrypt_id'];
                           $category=$book_data['category_id'];
                           $isbn=$book_data['isbn'];
                               $title=$book_data['title'];
                               $subject=$book_data['subject'];
                               $author_id=$book_data['author_id'];
                               $edition=$book_data['edition'];
                               $publisher=$book_data['publisher'];
                               $tag_id=$book_data['tag'];
                               $copy=$book_data['copy'];
                               $price=$book_data['price'];
                               $issueable=ucwords($book_data['issuable']);
                               $position=$book_data['position'];
                               $description=$book_data['description'];
                               
                               if(!empty($price))
                               {
                                  $price=  number_format($price,2); 
                               }
                               
             $category_db=mysql_query("SELECT * FROM library_category_db WHERE organization_id='$fetch_school_id'"
                               . " and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set'"
                     . " and lib_category_unique_id='$category'");
                       $fetch_category_data=mysql_fetch_array($category_db);
                       $fetch_category_num_rows=mysql_num_rows($category_db);
                          if((!empty($fetch_category_data))&&($fetch_category_data!=null)&&($fetch_category_num_rows!=0))
                          {
                           $category_name=$fetch_category_data['category'];  
                          }else
                          {
                          $category_name="";      
                          }
                               
                               
                            $row++;
                               echo "<tr id='delete_row_$book_unique_id'>
                                  <td class='td_style'><center><b>$row</b></center></td> 
                                       <td class='td_style'><center>$category_name</center></td> 
                                   <td class='td_style'>$isbn</td>
                                   <td class='td_style'>$title</td>"
                                       . "<td class='td_style'>$subject</td>"
                                       . "<td class='td_style'><center>$edition</center></td>"
                                       . "<td class='td_style'><center>$issueable</center></td>"
                                       . "<td class='td_style'><center>$copy</center></td>"
                                       . "<td class='td_style' style='text-align:right;'><b>$fetch_currency</b> $price</td>"
                                       . "<td class='td_style' style='width:90px; padding:0; padding-left:10px;'>";
                              {
                                  ?>
                       <a style="color:blue;" href="#" onclick="window.open('view_book_details.php?token_id=<?php echo $encrypt_id;?>','size',config='height=620,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <input type="button" class="view_button_style" value="View Detail"></a>
                       
                       <?php
                              }
                               echo"</td>"
                                      . "<td class='td_style' style='width:133px; padding:0; border-right:1px solid black;'>";
                               {
                        ?>
                       <a style="color:blue;" href="#" onclick="window.open('edit_book_details.php?token_id=<?php echo $encrypt_id;?>','size',config='height=620,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        
                            <div class='edit_delete_buttons' style='background-color:green; width:45px;'>Edit</div></a>
                      <?php 
                        }
                           echo "</abbr>
                            <abbr title='Delete'>";
                        {
                        ?>
                            <div onclick="delete_data('<?php  echo $book_unique_id;?>','lib_book_delete_command')" class='edit_delete_button'>Delete</div>
                         <?php 
                        }
                               echo"</td></tr>"; 
                                      
                       }
                       $record_table_check=mysql_num_rows($book_db);
                        if(empty($record_table_check))
                       {
                           echo "<tr>"
                           . "<td colspan='12' style=' height:30px; color:red;"
                                   . " border:1px solid black; border-top:0px;'><center><b>Record No Found !</b></center></td></tr>";    
                       }
                       
                       ?>
                       
                       
                       
                   </table>       
                   
               </div>
                
             
                
                
               
            </div> 
        </div>
        
        
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