<?php
session_start();
?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Spartan Deals</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id"
          content="199118433992-ln3nj31q0u10h01egspqdccit655jhhb.apps.googleusercontent.com">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,400italic,600' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/social-likes_classic.css">
    <link rel="stylesheet" href="css/venobox.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <link rel="stylesheet" href="lib/css/nivo-slider.css" type="text/css"/>
    <link rel="stylesheet" href="lib/css/preview.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/meanmenu.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet"
          type="text/css"/>
    <script type="text/javascript">
        (function () {
            var po = document.createElement('script');
            po.type = 'text/javascript';
            po.async = true;
            po.src = 'https://plus.google.com/js/client:plusone.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(po, s);
        })();
    </script>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1689593654679841',
                cookie     : true,
                xfbml      : true,
                version    : 'v2.8'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script>
        function myFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
            if (input.value == '') {
                ul.style.display = 'none';
            } else {
                ul.style.display = 'inline-block';
            }

        }
    </script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Add your site or application content here -->
<header>
    <div class="header-container">
        <div class="container">
            <div class="top-bar">
                <div class="topbar-content">
                    <!-- <div class="header-email widget">
                        <i class="fa fa-envelope"></i><strong>Email:</strong> <a
                            href="mailto:viveklakshmanan@live.com ">spartandeals6@gmail.com </a>
                    </div> -->
                    <!-- <div class="header-phone widget"><i class="fa  fa-phone"></i><strong>Phone:</strong><a
                            href="tel:+16692924707"> (669) 272-4707</a></div> -->
                    <div class="top-menu widget">
                        <div class="menu-top-menu-container">
                            <ul class="nav_menu" id="menu-top-menu">
                                <?php
                                if(isset($_SESSION['session_user'])) {
                                    echo '

                                <li class="menu-item"><a href="logout.php">Logout</a></li>
                                ';
                                } else {
                                echo '
                                <li class="menu-item"><a href="#" data-toggle="modal" data-target="#sign-modal">Sign
                                    up</a></li>
                                <li class="menu-item"><a href="#" data-toggle="modal"
                                                         data-target="#login-modal">Login</a></li>
                                ';
                                }

                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="global-table">
                            <div class="global-row">
                                <div class="global-cell">
                                    <div class="logo">
                                        <a href="index.php" title="Market-Place"><img src="img/logo/blitz-2.png"
                                                                                       alt="logo image"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-9 hidden-sm hidden-xs">
                        <div class="horizontal-menu">
                            <div class="global-table">
                                <div class="global-row">
                                    <div class="global-cell">
                                        <div class="visible-large">
                                            <div class="mega_main mega_main_menu" id="mega_main_menu_first">
                                                <div class="menu_holder">
                                                    <div class="menu_inner">
                                                        <nav>
                                                            <ul class="mega_main_menu_ul" id="mega_main_menu_ul_first">
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="index.php">
															<span class="link_content">
																<span class="link_text">Home</span>
															</span>
                                                                    </a>
                                                                </li>
<!--                                                                 <li class="menu-item">
                                                                    <a class="item_link" href="shop.html?id=4">
															<span class="link_content">
																<span class="link_text">Shop</span>
															</span>
                                                                    </a>
                                                                </li>
 -->                                                                <li class="menu-item">
                                                                    <a class="item_link" href="tracker.php?id=4">
															<span class="link_content">
																<span class="link_text">Tracker</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="about.php">
															<span class="link_content">
																<span class="link_text">About</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item active">
                                                                    <a class="item_link" href="contact.php">
															<span class="link_content">
																<span class="link_text">Contact Us</span>
															</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 hidden-md hidden-lg">
                        <div class='mobile-menu-area'>
                            <nav id="mobile-menu">
                                <ul>
                                    <li><a href="index.php">Home</a>
                                    </li>
                                    <!-- <li><a href="shop.html?id=4">Shop</a> -->

                                    </li>
                                    <li><a href="#">Tracker</a>

                                    </li>
                                    <li><a href="#">About</a>

                                    </li>
                                    <li><a href="#">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--/ Header -->
<div class="clear"></div>
<!-- main-container full-width -->
<!--  HEADER-AREA END-->
<div align="center" class="row">
    <img  align="center" alt="about-us" src="img/contact/contactuslight.jpg">
</div>


<!-- TEAM-AREA-START -->
<div class="team-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="team-hedding">
                    <h3>Contact US</h3>
                    <p><h4>Call us or Mail us, to help & serve you better!!</h4></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="team-member">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-member">
                        <div class="member-info">
                            <h4>Cold Stone Coffee</h4>
                            <h5><img src="img/contact/callblack.jpg"/></h5><h3>(121)987-1098</h3>
                            <h5><img src="img/contact/mailpink.jpg"/>renu.parameswaran@sjsu.edu</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="single-member">
                        <div class="single-member">
                            <div class="member-info">
                                <h4>Fashionista</h4>
                                <h5><img src="img/contact/callblack.jpg"/></h5><h3>(122)989-1099</h3>
                                <h5><img src="img/contact/mailpink.jpg"/>vivek.lakshmanan@sjsu.edu</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="single-member">
                        <div class="single-member">
                            <div class="member-info">
                                <h4>Home Decors</h4>
                                <h5><img src="img/contact/callblack.jpg"/></h5><h3>(123)988-1100</h3>
                                <h5><img src="img/contact/mailpink.jpg"/>smitha.venkatesh@sjsu.edu</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="team-member">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-member">
                            <div class="single-member">
                                <div class="member-info">
                                    <h4>Ice Modders</h4>
                                    <h5><img src="img/contact/callblack.jpg"/></h5><h3>(124)990-1101</h3>
                                    <h5><img src="img/contact/mailpink.jpg"/>karthik.nair@sjsu.edu</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="single-member">
                            <div class="single-member">
                                <div class="member-info">
                                    <h4>KadArt</h4>
                                    <h5><img src="img/contact/callblack.jpg"/></h5><h3>(125)991-1102</h3>
                                    <h5><img src="img/contact/mailpink.jpg"/>chaitanya.kademane@sjsu.edu</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="single-member">
                            <div class="single-member">
                                <div class="member-info">
                                    <h4>MtvConnect</h4>
                                    <h5><img src="img/contact/callblack.jpg"/></h5><h3>(126)992-1103</h3>
                                    <h5><img src="img/contact/mailpink.jpg"/>aaditya.deowanshi@sjsu.edu</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- TEAM-AREA-END -->
    <!-- SERVICE-WORK-AREA-START -->

    <!-- ABOUT-SKILLS-AREA-END -->
    <!-- main-container full-width end -->

    <!-- Footer area-->
    <div class="footer">
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12 fix">
                        <div class="bottom_menu">
                            <div class="menu-customer-care-container">
                                <nav>
                                    <ul class="nav_menu">
                                        <li class="menu-item"><a href="index.php">Home</a></li>
                                        <li class="menu-item"><a href="shop.php?id=1">Shop </a></li>
                                        <li class="menu-item"><a href="about.php">About</a></li>
                                        <li class="menu-item"><a href="contact.php">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="copyright-info"> Copyright &copy; 2018 <a href="#">Blitz Services & Products </a>
                        All Rights Reserved
                    </div>
                    <div class="copyright-info">** This is for SJSU Course CMPE-272 purpose only. Images are taken
                        from internet.
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="login-modal" class="modal fade login" aria-labelledby="myModalLabel" tabindex="-1" role="dialog">
    <div class="modal-dialog login animated">
        <form id="login-form" action="index.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onClick="window.location.reload()" data-dismiss="modal"
                            aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title">Login with</h4>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="content">
                            <div>
                                <fb:login-button scope="public_profile,email" onlogin="fbLogin();">
                                </fb:login-button>

                            </div>
                            <hr style="clear:both;">


                            <div class="g-signin2"  data-onsuccess="onSignIn">
                            </div>

                            <div class="division">
                                <div class="line l"></div>
                                <span>or</span>
                                <div class="line r"></div>
                            </div>

                            <script type="text/javascript">
                                function onSignIn(googleUser) {
                                    var profile = googleUser.getBasicProfile();

                                    var data = [];
                                    data.push(profile.getName());
                                    data.push(profile.getEmail());

                                    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
                                    console.log('Name: ' + profile.getName());
                                    console.log('Image URL: ' + profile.getImageUrl());
                                    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
                                    console.log(profile);
                                    closeModal();

                                }

                                function closeModal() {
                                    // <?php
                                    // $_SESSION['session_user'] = "google";
                                    // $_SESSION['session_id'] = "google";
                                    // ?>
                                    signOut();
                                    window.location.reload();
                                }

                                function signOut() {
                                    var auth2 = gapi.auth2.getAuthInstance();
                                    auth2.signOut().then(function () {
                                        console.log('User signed out.');
                                    });
                                }

                                function fbLogin() {
                                    FB.login(function (response) {
                                        if (response.status === 'connected') {
                                            console.log("connected");
                                            // Logged into your app and Facebook.
                                            FB.api('/me', {
                                                fields: 'email,first_name,last_name'
                                            }, function (response) {
                                                $.post('socialauth.php', {
                                                    email: response.email,
                                                    firstName: response.first_name,
                                                    lastName: response.last_name
                                                }).done(function (data) {
                                                    window.location.reload();
                                                });
                                            });
                                        } else {
                                            // The person is not logged into this app or we are unable to tell.
                                            console.log("failed");
                                        }
                                    }, {
                                        scope: 'public_profile,email'
                                    });
                                }

                            </script>

                            <h2>Login Account </h2>
                            <div id="err-msg"></div>

                            <div class="form-group">
                                <input type="text" id="email" name="email" placeholder="email"
                                       class="form-control input-lg"/>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" name="password" placeholder="Password"
                                       class="form-control input-lg"/>
                            </div>
                            <div class="form-group">
                                <div id="captcha"></div>
                            </div>
                            <div class="form-group">
                                <input type="submit" id="login" name="login" value="login"
                                       class="btn btn-primary btn-block btn-lg"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        Don't have an account? <a href="#sign-modal" data-dismiss="modal" data-toggle="modal">Register
                        Here</a>
                    </div>
                </div>
        </form>
    </div>

</div>
</div>

<div id="sign-modal" class="modal fade login" aria-labelledby="myModalLabel" tabindex="-1" role="dialog">
    <div class="modal-dialog login animated">
        <form id="sign-form" action="index.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onClick="window.location.reload()" data-dismiss="modal"
                            aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title">Register with</h4>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="content">
                            <div>
                                <fb:login-button scope="public_profile,email" onlogin="fbLogin();">
                                </fb:login-button>

                            </div>
                            <hr style="clear:both;">


                            <div class="g-signin2" data-onsuccess="onSignIn">
                            </div>

                            <div class="division">
                                <div class="line l"></div>
                                <span>or</span>
                                <div class="line r"></div>
                            </div>


                            <h2>Sign Up to Create Account </h2>
                            <div id="err-msg"></div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" placeholder="Enter Full Name" required
                                       value="<?php if($error) echo $name; ?>" class="form-control"/>
                                <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" name="email" placeholder="Email" required
                                       value="<?php if($error) echo $email; ?>" class="form-control"/>
                                <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" name="password" placeholder="Password" required
                                       class="form-control"/>
                                <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Confirm Password</label>
                                <input type="password" name="cpassword" placeholder="Confirm Password" required
                                       class="form-control"/>
                                <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                            </div>
                            <div class="form-group">
                                <div id="captcha"></div>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="signup" class="btn btn-primary " value="signup">
                                </input>

                            </div>
                        </div>
        </form>
        <div class="modal-footer">
            <div class="col-md-4 col-md-offset-4 text-center">
                Already Registered? <a href="#login-modal" data-dismiss="modal" data-toggle="modal">Login Here</a>
            </div>
        </div>
    </div>
</div>

<!-- Footer area-->
<!-- jquery
============================================ -->
<script src="js/vendor/jquery-1.11.3.min.js"></script>
<!-- bootstrap JS
============================================ -->
<script src="js/bootstrap.min.js"></script>
<!-- wow JS
============================================ -->
<script src="js/wow.min.js"></script>
<!-- price-slider JS
============================================ -->
<script src="js/jquery-price-slider.js"></script>
<!-- collapse JS
============================================ -->
<script src="js/jquery.collapse.js"></script>
<!-- mixitup JS
============================================ -->
<script src="js/jquery.mixitup.js"></script>
<!-- meanmenu JS
============================================ -->
<script src="js/jquery.meanmenu.js"></script>
<!-- owl.carousel JS
============================================ -->
<script src="js/owl.carousel.min.js"></script>
<!-- scrollUp JS
============================================ -->
<script src="js/jquery.scrollUp.min.js"></script>
<!-- social-likes JS
============================================ -->
<script src="js/social-likes.min.js"></script>
<!-- venobox JS
============================================ -->
<script src="js/venobox.js"></script>
<!-- Nivo slider js
============================================ -->
<script src="lib/js/jquery.nivo.slider.js" type="text/javascript"></script>
<script src="lib/home.js" type="text/javascript"></script>
<!-- plugins JS
============================================ -->
<script src="js/plugins.js"></script>
<!-- main JS
============================================ -->
<script src="js/main.js"></script>

</body>
</html>