<?php
session_start();
ob_start();
?>
<?php 
if(isset($_SESSION['student_id']))
{
    header("Location:index.php"); 
}

require_once '../connection.php';
$school_db=mysql_query("SELECT * FROM organization_db WHERE id ORDER BY id DESC");
$fetch_school_data=mysql_fetch_array($school_db);
$fetch_num_rows=mysql_num_rows($school_db);
if((!empty($fetch_school_data))&&($fetch_school_data!=null)&&($fetch_num_rows!=0))
{
  $company_logo=$fetch_school_data['school_logo']; 
{
?>

<?php
$message_show="";
if(isset($_POST['login_button']))
{
$user_name=mysql_real_escape_string($_POST['user_name']); 
$password=mysql_real_escape_string($_POST['password']);   
  if((!empty($user_name))&&(!empty($password)))
  {
  $encrypt_password=md5(md5($password));    
    
  $select_user_db=mysql_query("SELECT * FROM student_db WHERE user_name='$user_name' and password='$encrypt_password' and is_delete='none'");
  $select_user_num_rows=mysql_num_rows($select_user_db);
  $select_student_data=mysql_fetch_array($select_user_db);
  
  if((!empty($select_student_data))&&($select_student_data!=null)&&($select_user_num_rows!=0))
  {
  if($select_user_num_rows==1)
  {
   $student_id=$select_student_data['student_id'];   
  $_SESSION['student_id']=$student_id;
  
  if(isset($_SESSION['student_id']))
  {
      header("Location:index.php");     
  }else
  {
   $_SESSION['student_id']==$student_id;  
  }
   header("Location:index.php");        
      
  }else
  {
   $message_show="<div class='alert alert-danger' role='alert'>Sorry,Technical Problem,Please try again a few minute</div>";    
  }
  }else
  {
     $message_show="<div class='alert alert-danger' role='alert'>Invalid username and password</div>";  
  }
      
  }  else {
      $message_show="<div class='alert alert-danger' role='alert'>Please enter username and password</div>";    
  }
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!----webfonts--->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<!---//webfonts--->  
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</head>
<body id="login">
  <div class="login-logo">
      <a href="index.html"><img height="110px" src="../<?php echo $company_logo;?>" alt=""/></a>
  </div>

    <div class="app-cam" style=" margin-top:0; ">
	   <form action="" onsubmit="return login_page_validate();" method="post" enctype="multipart/form-data">
      <center><?php echo $message_show;?></center>
               <input type="text" class="text" name="user_name" placeholder="Username">
               <input type="password" name="password" placeholder="Password">
                <div class="submit"><input type="submit" name="login_button" value="Login"></div>
		<div class="login-social-link">
         
        </div>
	</form>
  </div>
   <div class="copy_layout login">
       <p>Copyright &copy; 2016 | Design by <a href="http://digishiksha.in/" target="_blank"><b>DIGI SHIKSHA</b></a> </p>
   </div>
</body>
</html>
<?php 
}
}else
{
    echo 'Coming soon';   
}
?>