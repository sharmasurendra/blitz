<?php
$getId = $_GET['uid'];

// Create connection
$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "b1069ce4ee0339";
$password = "7ee6e563";
$dbname = "heroku_5eaa584d7cda171";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

#user detail result
$user_sql = "SELECT * FROM User where UserId=$getId;";
$user_detail_result = $conn->query($user_sql);
echo $user_detail_result;
#review details

$review_sql = "SELECT * FROM  `Review` WHERE UserId =$getId";
$review_detail_result = $conn->query($review_sql);


$conn->close();
?>


<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shop Category Page | Assyrian</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon
    ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

    <!-- Google Fonts
    ============================================ -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,400italic,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- font awesome CSS
    ============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
    ============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- nivo slider CSS
    ============================================ -->
    <link rel="stylesheet" href="lib/css/nivo-slider.css" type="text/css" />
    <link rel="stylesheet" href="lib/css/preview.css" type="text/css" media="screen" />
    <!-- animate CSS
    ============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- venobox CSS
    ============================================ -->
    <link rel="stylesheet" href="css/venobox.css">
    <!-- jquery-ui CSS
    ============================================ -->
    <link rel="stylesheet" href="css/jquery-ui.css">
    <!-- meanmenu CSS
    ============================================ -->
    <link rel="stylesheet" href="css/meanmenu.css">
    <!-- main CSS
    ============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- style CSS
    ============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
    ============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
    ============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Add your site or application content here -->
<header>
    <div class="header-container">
        <!--header top start-->
        <div class="container">
            <div class="top-bar">
                <div class="topbar-content">
                    <div class="header-email widget">
                        <i class="fa fa-envelope"></i><strong>Email:</strong> <a href="mailto:viveklakshmanan@live.com ">viveklakshmanan@live.com </a>
                    </div>
                    <div class="header-phone widget"><i class="fa  fa-phone"></i><strong>Phone:</strong><a href="tel:+16692924707"> (669) 272-4707</a> </div>
                    <div class="top-menu widget">
                        <div class="menu-top-menu-container">
                            <ul class="nav_menu" id="menu-top-menu">
                                <?php
                                if(isset($_SESSION['session_user'])) {
                                    echo '<li class="menu-item  first"><a href="my-account.php">My Account</a></li>
                                <li class="menu-item"><a href="wishlist.php">My Wishlist</a></li>
                                <li class="menu-item"><a href="shop.php">Shopping Cart</a></li>
                                <li class="menu-item"><a href="checkout.php">Checkout</a></li>
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
        <!--header top end-->
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="global-table">
                            <div class="global-row">
                                <div class="global-cell">
                                    <div class="logo">
                                        <a href="index.php" title="Market-Place" ><img src="img/logo/logo-1.png" alt="logo image" ></a>
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
                                                                <li >
                                                                    <a class="item_link" href="index.php">
															<span class="link_content">
																<span class="link_text">Home</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item active">
                                                                    <a class="item_link" href="shop.php?id=1">
															<span class="link_content">
																<span class="link_text">Shop</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="blog.html">
															<span class="link_content">
																<span class="link_text">Blog</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="index.php#">
															<span class="link_content">
																<span class="link_text">Portfolio</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="index.php#">
															<span class="link_content">
																<span class="link_text">Pages</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="contact-us.php">
															<span class="link_content">
																<span class="link_text">Contact Us</span>
															</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <!-- /class="menu_inner" -->
                                                </div>
                                                <!-- /class="menu_holder" -->
                                            </div>
                                            <!-- /id="mega_main_menu" -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 hidden-md hidden-lg">
                        <!-- Main Menu End -->
                        <div class='mobile-menu-area'>
                            <nav id="mobile-menu">
                                <ul>
                                    <li><a href="index.<?php  ?>">Home</a>
                                    </li>
                                    <li><a href="shop.php">Shop</a>

                                    </li>
                                    <li><a href="blog.html">Blog</a>

                                    </li>
                                    <li><a href="portfolio-detailas.php">Portfolio</a>

                                    </li>
                                    <li><a href="index.php#">Pages</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Main Menu End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!--/ Header -->
<div class="clear"></div>
<!-- main-container full-width -->
<!-- shop-header-area start -->
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="breadcrumbs all-product-view-mode">
                    <a href="index.php">Home</a><span class="separator">&gt;</span><span> My Account</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h1> Products I have reviewd, so far: </h1>
                <div role="tabpanel" class="tab-pane active" id="grid">
                    <div class="ma-bestsellerproductslider-container">
                        <!-- single item start -->
                        <?php
                        if ($review_detail_result->num_rows > 0) {
                        // output data of each row
                        while($row = $review_detail_result->fetch_assoc()) {
                        echo '<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                            <div class="single-item">
                                <div class="s-product-img">
                                    <a href="#">
                                        <img alt="" src="img/product/' . $row['ProductId'] .  '.jpg" class="primary-image">
                                    </a>
                                    <div class="price-rate">
                                        <!-- Single product hover view-->
                                        <div class="global-table">
                                            <div class="global-row">
                                                <div class="global-cell">
                                                    <div class="hover-view-content">
                                                        <a href="#" class="modal-view detail-link quickview" data-toggle="modal" data-target="#productModal">For More</a>
                                                        <div class="ratings">
                                                            <ul>
                                                                <li>
                                                                    <div class="star">
                                                                        <span class="yes"><i class="fa fa-star-o"></i></span>
                                                                        <span class="yes"><i class="fa fa-star-o"></i></span>
                                                                        <span class="yes"><i class="fa fa-star-o"></i></span>
                                                                        <span class="yes"><i class="fa fa-star-o"></i></span>
                                                                        <span><i class="fa fa-star-o"></i></span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="price-box">
                                                            <p class="special-price"><span class="price">£70.00</span></p>
                                                            <p class="old-price"> <span class="price"><del>£80.00</del></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ Single product hover view-->
                                    </div>
                                </div>
                                <div class="product-title">
                                    <a href="#">' . $row['ProductId'] . '</a>
                                </div>
                            </div>
                        </div>';}}?>
                        <!-- single item end -->
                    </div>
                </div>
<!--                --><?php
//                if ($review_detail_result->num_rows > 0) {
//                // output data of each row
//                while($row = $review_detail_result->fetch_assoc()) {
//                echo '';
//                echo '<p class="myacc">User Id: '. $row['UserId'] .'</p>';
//                echo '<p>Product Id: '. $row['ProductId'] .'</p>';
//                echo '<p>Rating: '. $row['Rating'] .'</p>';
//                echo '<p>Comments: '. $row['Comments'] .'</p>';
//                echo '<p>UserName: '. $row['UserName'] .'</p>';
//
//
//                }
//                } else {
//                echo "0 results";
//                }
//                ?>

                <div class="row">
                <h1> My Details </h1>
                <?php
                if ($user_detail_result->num_rows > 0) {
                // output data of each row
                while($row = $user_detail_result->fetch_assoc()) {
                echo '<p class="myacc">User Id: '. $row['UserId'] .'</p>';
                echo '<p>User Name: '. $row['UserName'] .'</p>';
                echo '<p>Email: '. $row['UserEmail'] .'</p>';
                }
                } else {
                echo "0 results";
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- shop-header-area end -->
<!-- main-container full-width end -->


<!-- Footer area-->
<div class="footer" style="margin-top: 140px;">
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 col-xs-12 fix">
                    <div class="bottom_menu">
                        <div class="menu-customer-care-container">
                            <nav>
                                <ul class="nav_menu">
                                    <li class="menu-item"> <a href="index.php">Home</a> </li>
                                    <li class="menu-item"> <a href="shop.php">Shop </a> </li>
                                    <li class="menu-item"> <a href="about.php">About</a> </li>
                                    <li class="menu-item"> <a href="news.php">News</a> </li>
                                    <li class="menu-item"> <a href="contact.php">Contact</a> </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="copyright-info"> Copyright &copy; 2018 <a href="http://lvivek.com/">Vikas Kodwani & Surendra Sharma </a> All Rights Reserved </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer area-->
<!-- QUICKVIEW PRODUCT -->
<div id="quickview-wrapper">
    <!-- Modal -->
    <?php

    foreach ($rows as $row ) {
    $productId = $row["ProductId"];
    $productTag = $row["ProductTag"];
    $productName = $row["ProductName"];
    $productPrice = $row["ProductPrice"];
    $productDesc = $row["ProductDesc"];
    $MRP = (int)$productPrice + 2;
    echo'<div class="modal fade" id="productModal' . $productId . '" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="modal-product">
                    <div class="product-images">
                        <div class="main-image images">
                            <img alt="" src="img/product/' .  $productId . '.jpg">
                        </div>
                    </div><!-- .product-images -->

                    <div class="product-info">
                        <h1>' . $productName . '</h1>
                        <div class="price-box-3">
                            <div class="s-price-box">
                                <span class="new-price">$' . $productPrice . '</span>
                                <span class="old-price">$'. $MRP . '</span>
                            </div>
                        </div>
                        <a href="#" class="see-all">See all features</a>
                        <div class="quick-add-to-cart">
                            <form method="post" class="cart">
                                <div class="numbers-row">
                                    <input type="number" id="french-hens" value="2">
                                </div>
                                <button class="single_add_to_cart_button" type="submit">Add to cart</button>
                            </form>
                        </div>
                        <div class="quick-desc">
                            This is a very good product. Please buy this product and help us.
                        </div>

                    </div><!-- .product-info -->
                </div><!-- .modal-product -->
            </div><!-- .modal-body -->
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div>';
}
?>

<!-- END Modal -->
</div>
<!-- END QUICKVIEW PRODUCT -->

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
