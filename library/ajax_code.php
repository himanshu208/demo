<?php
require_once '../connection.php';
if((!empty($_REQUEST['token_id']))&&(!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id'])))
{
  $token_id=  trim($_REQUEST['token_id']);
  $org_id=$_REQUEST['org_id'];
  $branch_id=$_REQUEST['branch_id'];
  $session_id=$_REQUEST['session_id'];
  
      $library_author_db=mysql_query("SELECT * FROM library_author_db WHERE organization_id='$org_id' and branch_id='$branch_id'"
                                . "and session_id='$session_id' and author LIKE '%$token_id%' and is_delete='none'");
                        while ($fetch_library_author_data=mysql_fetch_array($library_author_db))
                        {
                        
                                 $author_db_id=$fetch_library_author_data['id'];
                                 $author_unique_id=$fetch_library_author_data['author_unique_id'];
                                 $encrypt_id=$fetch_library_author_data['encrypt_id'];
                                 $library_author=ucwords($fetch_library_author_data['author']);
                                 $author_description=$fetch_library_author_data['description'];
                                 {
                                     ?>
<li onclick="author_select('<?php echo $author_unique_id;?>','<?php echo $library_author;?>')"><?php echo $library_author;?></li>
<?php
                        }
                                 
                        }
  
  
}


//issue book ajax code

if((!empty($_REQUEST['book_unique_id']))&&(!empty($_REQUEST['get_school_id']))
        &&(!empty($_REQUEST['get_branch_id']))&&(!empty($_REQUEST['get_session_id'])))
{
         $book_id=$_REQUEST['book_unique_id'];
         $school_id=$_REQUEST['get_school_id'];
         $branch_id=$_REQUEST['get_branch_id'];
         $session=$_REQUEST['get_session_id'];
         $issue_date=$_REQUEST['issue_date'];
         
         $book_db=mysql_query("SELECT * FROM library_book_db WHERE organization_id='$school_id' and "
                 . "branch_id='$branch_id' and session_id='$session' and book_unique_id='$book_id'");
         $book_data=mysql_fetch_array($book_db);
         $book_num_rows=mysql_num_rows($book_db);
         if((!empty($book_data))&&($book_data!=null)&&($book_num_rows!=0))
         {
          
          $author_id=$book_data['author_id'];    
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
                              
        $fetch_category_id=$book_data['category_id']; 
        $category_db=mysql_query("SELECT * FROM library_category_db WHERE organization_id='$school_id' and "
                 . "branch_id='$branch_id' and session_id='$session' and lib_category_unique_id='$fetch_category_id'");
        $category_data=mysql_fetch_array($category_db);
        $category_num_rows=mysql_num_rows($category_db);
        
        if((!empty($category_data))&&($category_data!=null)&&($category_num_rows!=0))
        {
        
        $max_limit=$category_data['max_limit'];
        $return_day=$category_data['return_day'];
        if(!empty($return_day))
        {
        $return_date=date('Y-m-d', strtotime("+$return_day day", strtotime($issue_date)));
        }else
        {
        $return_day="";   
        }
         $result="$author_name@@$issue_date@@$return_date";
         echo $result;
        
        }else
        {
            echo "1"; 
        }
             
         }else
         {
             echo '1'; 
         }
         
         
         
}
?>