<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>



<html>
    <head>
        <meta charset="UTF-8">
        <title>View Book Details</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       
        
        <script type="text/javascript">
   
   
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
                <div class="title_name">View Book Details</div>   
                
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
              $category=$fetch_data['category_id'];    
               $category_db=mysql_query("SELECT * FROM library_category_db WHERE organization_id='$fetch_school_id'"
                               . " and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set'"
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
                               $issueable=ucwords($fetch_data['issuable']);
                               $position=$fetch_data['position'];
                               $description=$fetch_data['description'];
                               
                               if(!empty($price))
                               {
                                  $price=  number_format($price,2); 
                               }
                          
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
                        foreach ($explode_tag as $tag_unique_id)
                        {
                           
                        $tag_db=mysql_query("SELECT * FROM library_tag_db WHERE tag_unique_id='$tag_unique_id'");   
                        $fetch_tag_data=  mysql_fetch_array($tag_db);
                        $fetch_tag_num_rows=mysql_num_rows($tag_db);
                        if((!empty($fetch_tag_data))&&($fetch_tag_data!=null)&&($fetch_tag_num_rows!=0))
                        {
                            $tag_name=$fetch_tag_data['tag'];
                            
                            array_push($tag_array,$tag_name);  
                        }
                        }
                        
                     
                        $implode_tag_name=implode(",",$tag_array);
                               
                          
             {
             ?>  
             
                <table cellspacing="0" cellpadding="0" id="book_view_table" style=" width:80%; ">
                    <tr>
                        <td><b>Category</b></td><td><b>:</b></td><td><?php echo $category_name;?></td>
                    </tr>
                    <tr>
                        <td><b>ISBN</b></td><td><b>:</b></td><td><?php echo $isbn;?></td>
                    </tr>
                    <tr>
                        <td><b>Title</b></td><td><b>:</b></td><td><?php echo $title;?></td>
                    </tr>
                    <tr>
                        <td><b>Subject</b></td><td><b>:</b></td><td><?php echo $subject;?></td>
                    </tr>
                    <tr>
                        <td><b>Author</b></td><td><b>:</b></td><td><?php echo $author_name;?></td>
                    </tr>
                    <tr>
                        <td><b>Edition</b></td><td><b>:</b></td><td><?php echo $edition;?></td>
                    </tr>
                    <tr>
                        <td><b>Publisher</b></td><td><b>:</b></td><td><?php echo $publisher;?></td>
                    </tr>
                    <tr>
                        <td><b>Tag</b></td><td><b>:</b></td><td><?php echo $implode_tag_name;?></td>
                    </tr>
                    <tr>
                        <td><b>Copy</b></td><td><b>:</b></td><td><?php echo $copy;?></td>
                    </tr>
                    <tr>
                        <td><b>Price</b></td><td><b>:</b></td><td><b><?php echo $fetch_currency;?></b> <?php echo $price;?></td>
                    </tr>
                    <tr>
                        <td><b>Issuable</b></td><td><b>:</b></td><td><?php echo $issueable;?></td>
                    </tr>
                    <tr>
                        <td><b>Position</b></td><td><b>:</b></td><td><?php echo $position;?></td>
                    </tr>
                    <tr>
                        <td><b>Description</b></td><td><b>:</b></td><td><?php echo $description;?></td>
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