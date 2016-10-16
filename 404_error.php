<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Differential Academy| Home Page </title>

        <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700,400italic' rel='stylesheet' type='text/css'>
        <link href='fonts/Lato-Medium.css' rel='stylesheet' type='text/css'/>
        <link href='fonts/Lato-Heavy.css' rel='stylesheet' type='text/css'/>

        <!-- Bootstrap css -->
        <link rel="stylesheet" href="css/bootstrap.min.css"/>

      <!-- Font awesome css 
        <link rel="stylesheet" href="css/font-awesome.min.css">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/font-awesome.min.css">

        <!-- Stroke Font Icon css -->
        <link rel="stylesheet" href="css/pe-icon-7-stroke.css"/>

        <!-- Animate css -->
        <link rel="stylesheet" href="css/animate.css">

        <!-- Owl carousel 2 css -->
        <link rel="stylesheet" href="css/owl.carousel.css"/>

        <!-- Custom css -->
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="css/responsive.css"/>

        <!-- Favicons -->
        <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png"/>
        <link rel="shortcut icon" type="image/png" href="img/fav-icon.png"/>  

       
    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     jQuery Latest version -->
        <script type="text/javascript" src="js/vendor/jquery.1.11.1.js"></script>
        
        <!-- Google Maps API -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

        <!-- Bootstrap JS -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

        <!-- jQuery Counterup and Waypoints -->
        <script type="text/javascript" src="js/waypoints.min.js"></script>
        <script type="text/javascript" src="js/jquery.counterup.min.js"></script>

        <!-- jQuery easing -->
        <script type="text/javascript"  src="js/jquery.easing.1.3.min.js"></script>
      
        <!-- jQuery owl carousel -->
        <script type="text/javascript" src="js/owl.carousel.min.js"></script>

        <!-- WOW Animation -->
        <script type="text/javascript" src="js/wow.min.js"></script>
           
        <!--Activating WOW Animation only for modern browser-->
        <!--[if !IE]><!-->
            <script type="text/javascript">
                new WOW().init();</script>
       
        <script  type="text/javascript" src="js/main.js"></script>

   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script>
       $(function () {
           $(document).on('click', '.open-login', function (e) {
               $('#msg').removeClass();
               $('#msg').addClass("login-msg").text('Please login below');
               $('#username').val('');
               $('#password').val('');
               $('.login-frame').fadeIn(500);
               $('.login-box').animate({ 'top': '50px' }, 500);
               e.preventDefault();
           });
           $(document).on('click', '.close-login', function (e) {
               $('.login-box').animate({ 'top': '-165px' }, 500);
               $('.login-frame').fadeOut(500);
               $('#username').val('');
               $('#password').val('');
               e.preventDefault();
           });
           $(document).on('click', '.login-btn', function (e) {
               var username = $('#username').val();
               var password = $('#password').val();
               var _loginMsg = $('#msg');
               if (username == '' || password == '') {
                   _loginMsg.addClass("error").removeClass("success");
                   _loginMsg.html("Fields should not be empty");
                   $('.login-box')
                            .animate({ left: -25 }, 20)
                            .animate({ left: 0 }, 60)
                            .animate({ left: 25 }, 20)
                            .animate({ left: 0 }, 60);
               } else {
                   var Objdata = {};
                   Objdata.username = username;
                   Objdata.password = password;
                   var url = "Login.aspx/CheckUser";
                   $.ajax({
                       type: "POST",
                       url: url,
                       data: JSON.stringify(Objdata),
                       contentType: "application/json; charset=utf-8",
                       dataType: "json",
                       success: function (response) {
                           if (response.d == true) {
                               _loginMsg.addClass("success").removeClass("error");
                               _loginMsg.html("Login was successful!");
                               $('.login-box').animate({ 'top': '-165px' }, 800);
                               $('.login-frame').fadeOut(500);

                           } else {
                               _loginMsg.addClass("error").removeClass("success");
                               _loginMsg.html("Invalid username & Password");
                               $('.login-box')
                                    .animate({ left: -25 }, 20)
                                    .animate({ left: 0 }, 60)
                                    .animate({ left: 25 }, 20)
                                    .animate({ left: 0 }, 60);
                           }
                       },
                       error: function (xmlHttpRequest, textStatus, errorThrown) {
                           alert('Error');
                       }
                   });
               }

               e.preventDefault();
           });
       });
    </script>
</head>
<body>
    
     <div id="preloader">
            <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
        </div>
        <header class="header_area" >
            <div class="container" >
                <div class="header_content"><!--style="position:fixed;"-->
                    <div class="row" >
                   
                        <div class="col-md-4 col-sm-3" style="/* position: fixed; */">
                            <div class="logo">
                            <!--<span>Differential Academy</span>-->
                               <a href="Default.aspx"><img src="img/icon_cap.png" height="190px" width="190px" style="margin-top: 12px;" alt=""></a>
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>                             
                            </div>
                             
                        </div>                                    
                        <div class="col-md-8 col-sm-9 nav_area">
                            <nav class="main_menu">
                                <div class="navbar-collapse collapse" id="navbar-collapse"> 
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="current_page_item"><a href="Default.aspx">Home</a></li>
                                        <li><a href="aboutus.aspx">About</a></li>
                                        <li><a href="course.aspx">Courses</a>
                                       <ul class="dropdown-menu">
                                                    
                            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Junior Section</a>
								<ul class="dropdown-menu">
									<li><a href="#">Class VI</a></li>
									<li><a href="#">Class VII</a></li>
									<li><a href="#">Class VIII</a></li>
									<li><a href="#">Class IX</a></li>
									<li><a href="#">Class X</a></li>
                                                                      
								</ul>
							</li>
                            </ul>
                                        </li>
                                        <li><a href="onlinereg.aspx">Admission</a></li>
                                        <li><a href="career.aspx">Career</a></li>
                                      
                                        <li><a href="contact.aspx">Contact Us</a></li>
                                    </ul>                                                     
                                </div>
                            </nav>
                           <!-- <form action="Home.aspx" class="header_search hidden-xs">
                                <input type="text" placeholder="Search">
                                <input type="submit" value="">
                            </form>-->

                        </div>
                    </div>
                </div>
            </div>
        </header>
       <!-- Begin #carousel-section -->
    <section id="carousel-section" class="section-global-wrapper" style="margin-top: 0px;"> 
        <div class="container-fluid-kamn">
            <div class="row">
                <div id="carousel-1" class="carousel slide">

                    <!-- Indicators -->
                    <ol class="carousel-indicators visible-lg">
                        <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-1" data-slide-to="1"></li>
                        <li data-target="#carousel-1" data-slide-to="2"></li>
                    </ol>
        
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <!-- Begin Slide 1 -->
                        <div class="item active">
                            <img src="img/slider/1.jpg"  width="100%" style="height: 500px;" alt="">
                            <div class="carousel-caption">
                                <h3 class="carousel-title">Education is the key to your success</h3>
                                
                                <p >Love exciting and new. Come aboard were expecting you.<br /> Love life's sweetest reward Let it flow it floats back to you. <br />Texas tea. A man is born he's a man of means you knew. </p>
                               
                                
                                <a href="Admissioninformations.aspx" class="rm_btn">Apply Online</a>
                            </div>
                        </div>
                        <!-- End Slide 1 -->

                        <!-- Begin Slide 2 -->
                        <div class="item">
                            <img src="img/slider/2.jpg"  width="100%" style="height: 500px;" alt="">
                            <div class="carousel-caption">
                                <h3 class="carousel-title">Why Choose Us ?</h3>
                                <p class="carousel-body">The work culture at DIFFERENTIAL ACADEMY <br /> is based on simple but the most powerful<br /> philosophy – “Commitment”.</p>
                               
                                <a href="Admissioninformations.aspx" class="rm_btn">Apply Online</a>
                            </div>
                        </div>
                        <!-- End Slide 2 -->

                        <!-- Begin Slide 3 -->
                        <div class="item">
                            <img src="img/slider/3.jpg" style="height: 500px;" width="100%"  alt="">
                            <div class="carousel-caption">
                                <h3 class="carousel-title">Our Mission</h3>
                                <p class="carousel-body">Our MISSION is to bring all aspirants under the roof of <br /> Differential Academy through online as well as offline <br />that help them TWO steps ahead to their success of their life.</p>
                                 
                                <a href="Admissioninformations.aspx" class="rm_btn">Apply Online </a>
                            </div>
                        </div>
                        <!-- End Slide 3 -->
                    </div>
        
                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-1" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-1" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End #carousel-section -->
        <!--<section class="key_to_success_area">
            <div class="container">
                <div class="row">
                    <div class="key_to_success">
                        <div class="col-md-7" >
                            <div class="key2seccess_txt">
                                <h2>Education is the key to your success</h2>
                                <p>Love exciting and new. Come aboard were expecting you. Love life's sweetest reward Let it flow it floats back to you. Texas tea. A man is born he's a man of means you knew. </p>
                                <a href="#" class="rm_btn">Learn more</a>
                                <a href="Admissioninformations.aspx" class="rm_btn">apply now</a>
                            </div>
                        </div>
                        <div class="col-md-5 hidden-sm hidden-xs">
                            <div class="key2seccess_photo">
                                <img src="img/header_bottom_photo.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
        
        <section class="our_courses_area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section_heading">
                            <h1>Welcome To Our Academy</h1>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="row all_our_courses">
                    <div class="col-md-4 col-sm-6">
                        <div class="single_our_course">
                            <div class="sing_course_thumb">
                            <a href=""></a>                    
                            </div>
                            <div class="sing_course_txt">
                                <form id="form1" runat="server" >
                          
         <div class="login-frame">
    <div class="login-box">
        <div id="msg"></div>
        <h1>Sign in</h1>
        <p>Sign in User Register Account</p>
        <div class="form-group">
            <label class="form-label">Username:</label>
            <input type="text">
        </div>
        <div class="form-group">
            <label class="form-label">Password:</label>
            <input type="password">
        </div>
        
                            </div>
                           </div>                  
                        </form>
                        <form id="Form1" runat="server">
<fieldset>
<legend>Student/Parent Login</legend> 
<div>
<asp:Label ID="Name" runat="server" Text="UserName:" CssClass="lbl"/>
<br/>
<asp:TextBox ID="txtUserName" runat="server" Height="30px" Width="100%"/>
<asp:RequiredFieldValidator ID="RV1" runat="server" ControlToValidate="txtUserName" ErrorMessage="Please Enter User Name" SetFocusOnError="True">*
</asp:RequiredFieldValidator><br />
</div>
 
<div>
<asp:Label ID="lblPwd" runat="server" Text="Password:" CssClass="lbl"/>
<br/>
<asp:TextBox ID="txtPwd" runat="server" TextMode="Password" CssClass="pwd" Height="30px" Width="100%"/>
<asp:RequiredFieldValidator ID="RV2" runat="server" ControlToValidate="txtPwd" ErrorMessage="Your Password" SetFocusOnError="True">*
</asp:RequiredFieldValidator><br />
</div>
 <br />
<div>
<asp:Button ID="btnLogIn" runat="server" Text="Sign In"/>
</div>
  <br />                     
<div>
<asp:HyperLink ID="HyperLink1" runat="server" NavigateUrl="#">Forgot Password ?</asp:HyperLink>
<br/>
</div>
<div class='short_explanation'>&nbsp;&nbsp;&nbsp;&nbsp;New User ? 
<asp:HyperLink ID="HyperLink2" runat="server">SignUp !</asp:HyperLink></div>                       
<asp:ValidationSummary ID="ValidationSummary1" 
                       runat="server" CssClass="error"/>
<br /><br />
<asp:Label ID="lblMsg" runat="server" Text="" CssClass="lbl"/>
</fieldset>
</form>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-4 col-sm-6">
                        <div class="single_our_course">
                      <div class="sing_course_txt">
                        <h2 class="widget_title" style="color:#000 !important;">Notice</h2>
                        
                                    <ul class="latest_post" style="margin-left:10px !important;">
                                        <li style=" color: red;">No Notice for now.</li>
                                   </ul>
                                             </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="single_our_course">
                        <div class="sing_course_txt">
                          <h2 class="widget_title"  style="color:#000 !important;">Circular</h2>
                                    <ul class="latest_post" style="margin-left:10px !important;">
                                        <li style=" color: red;">No Circular for now.</li>
                                    </ul>
                           
                        </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
        
        <section class="search_courses_area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section_heading">
                            <h1>Subscribe us</h1>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                 <div class="col-md-6" >
                        <div class="course_search" style="margin-left: 130px;">
                          <h3 style="color:#fff;">To Recieve Our Updates Via E-mail</h3>
                        </div>
                    </div>
                    <div class="col-md-6" >
                        <div class="course_search" style="margin-left: -60px; margin-top: -10px;">
                            <form action="Default.aspx">
                                                              
                                <input type="text" placeholder="Enter your Email" style="width:50%;" />
                                <input type="submit" value="Search"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="why_choose_us_area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="why_choose_us_photo">
                            <img src="img/why_choose_us_photo.png" alt="" style="padding-top: 56px; padding-right: 22px;">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="why_choose_us_txt">
                            <h1>Why Choose Us ?</h1>
                            <p>The work culture at DIFFERENTIAL ACADEMY is based on simple but the most powerful philosophy – “Commitment”. This honest philosophy comes from the Founder and Chairman of the Institute. Since his erstwhile days, the Chairman has laid prime emphasis on commitment at work.</p>
                            <p>Every associate at DIFFERENTIAL ACADEMY understands the significance of commitment in bringing innovation in what one does, and acknowledges it completely. This work culture equips a typical associate at Academy to work with utmost dedication in whatever job is given to him/her.</p>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="single_why_choose">
                                        <div class="single_why_choose_icon">
                                            <img src="img/icon_why_choose_1.png" alt="">
                                        </div>
                                        <h3>Experienced Faculty</h3>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="single_why_choose">
                                        <div class="single_why_choose_icon">
                                            <img src="img/icon_why_choose_2.png" alt="">
                                        </div>
                                        <h3>Popular Courses</h3>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="single_why_choose">
                                        <div class="single_why_choose_icon">
                                            <img src="img/icon_why_choose_3.png" alt="">
                                        </div>
                                        <h3>Guaranteed Career</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="latest_courses_area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section_heading">
                            <h1>Latest Courses</h1>
                            <p>Check our featured courses</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="all_latest_course">
                        <div class="single_latest_courses">
                            <div class="sing_lat_course_photo">
                                <img src="img/latest_course_1.jpg" alt="">
                            </div>
                            <div class="sing_lat_course_txt">
                                <h3>Class 12</h3>
                              <h2>Class 12</h2>
                                <p>Thorough Preparation for 12th Board Exam is done.</p>
                              <ul>
                                    <li><i class="fa fa-calendar"></i>Course duration : <span>3 Yr</span></li>
                                    <li><i class="fa fa-graduation-cap"></i>Degree Level : <span>Master’s Degree</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single_latest_courses">
                            <div class="sing_lat_course_photo">
                                <img src="img/latest_course_2.jpg" alt="">
                            </div>
                            <div class="sing_lat_course_txt">
                                <h3>Class 11</h3>
                                <h2>Class 11</h2>
                                <p>Physics ,Chemistry ,Mathematics Syllabus of Class XI will be taught thoroughly</p>
                                <ul>
                                    <li><i class="fa fa-calendar"></i>Course duration : <span>3 Yr</span></li>
                                    <li><i class="fa fa-graduation-cap"></i>Degree Level : <span>Master’s Degree</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single_latest_courses">
                            <div class="sing_lat_course_photo">
                                <img src="img/latest_course_3.jpg" alt="">
                            </div>
                            <div class="sing_lat_course_txt">
                                <h3>Class 10</h3>
                                <h2>Dance courses</h2>
                                <p>Special Classes for NTSE preparation will be done.</p>
                                <ul>
                                    <li><i class="fa fa-calendar"></i>Course duration : <span>3 Yr</span></li>
                                    <li><i class="fa fa-graduation-cap"></i>Degree Level : <span>Master’s Degree</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        
        <section class="testimonial_area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section_heading">
                            <h1>What Our Students Say</h1>
                            <p>Testimonials from students</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="all_testimonial">
                            <div class="single_testi_slider">
                                <div class="testi_student_photo">
                                    <img src="img/test_slider_1.jpg" alt="">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="testi_studient_txt">
                                    <p>I like the teachers here, the way they teach us. They provide good assistance.</p>
                                    <h3><span>Rahul Verma   |</span> Class  12th</h3>
                                </div>
                            </div>
                            <div class="single_testi_slider">
                                <div class="testi_student_photo">
                                    <img src="img/test_slider_1.jpg" alt="">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="testi_studient_txt">
                                    <p>One of the best coaching institute, i have ever joined. I would recommend my friend too.</p>
                                    <h3><span>Anil Kumar   |</span> Class  10th</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testi_slider_nav">
                <i class="fa fa-angle-left testi_prev"></i>
                <i class="fa fa-angle-right testi_next"></i>
            </div>
        </section>
        
        <footer class="footer_area">
            <div class="footer_top">
                <div class="container">
                    <div class="row">
                        <div class="footer_widgets">
                            <div class="col-md-3 col-sm-6">
                                <div class="single_footer_widget">
                                    <h2 class="widget_title">About us</h2>
                                    <p>We are an educational platform to help all aspirants who have challenges keeping up with the changing of world of competition and education system, but know they need to do something to improve their skills and their life. We have made it easy to be a lifelong learner.</p>
                                    <ul class="footer_social">
                                        <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6" align="center">
                                <div class="single_footer_widget">
                                     <div id="fb-root"></div>
<script>    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
        fjs.parentNode.insertBefore(js, fjs);
    } (document, 'script', 'facebook-jssdk'));</script>

<div class="fb-page" data-href="https://www.facebook.com/netzillasolutions" data-width="100%" data-height="10%" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"></div>
     
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-6">
                                <div class="single_footer_widget">
                                    <h2 class="widget_title">contact info</h2>
                                    <ul class="footer_contact">
                                          <li>651, F-Block, Delta-I,& E - 56, Alpha - 1st Greater Noida pin Code 201306, U.P, India</li>
                                        <li>+91-9654366897</li>
                                        <li>+91-8010424290</li>
                                        <li>+91-9412130711</li>
                                        <li>differentialacademy@gmail.com</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <p>© 2016 DifferentialAcademy. All rights reserved</p>
                        </div>
                        <div class="col-sm-8">
                            <nav class="footer_menu">
                                <ul>
                                    <li><a href="Home.aspx">Home</a></li>
                                    <li><a href="aboutus.aspx">About</a></li>
                                    <li><a href="contact.aspx">Contact</a></li>
                                    <li><a href="admin" target="_blank">Admin Login</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
</body>
</html>
