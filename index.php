<?php
session_start();
$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "b1069ce4ee0339";
$password = "7ee6e563";
$dbname = "heroku_5eaa584d7cda171";

function get_data($url)
{
    $curl = curl_init();
    $timeout = 5;
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=$_POST['password'];
$email = stripcslashes($email);
$password = stripcslashes($password);
$sql = "SELECT * FROM Users where UserEmail = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
$sql_username = $row['UserEmail'];
$sql_password = $row['UserPassword'];
if ($sql_username == $email && $sql_password == $password ){
$_SESSION['session_user'] = $sql_username;
$_SESSION['session_id'] = $row['UserId'];
echo '
<script type="text/javascript"> alert("Successfully, logged in."); </script>';
}
else {
echo '
<script type="text/javascript"> alert("Failed to login. Give proper credentials."); </script>';
}
}
}
}

$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

//name can contain only alpha characters and space
if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
$error = true;
$name_error = "Name must contain only alphabets and space";
}
if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
$error = true;
$email_error = "Please Enter Valid Email ID";
}
if(strlen($password) < 6) {
$error = true;
$password_error = "Password must be minimum of 6 characters";
}
if($password != $cpassword) {
$error = true;
$cpassword_error = "Password and Confirm Password doesn't match";
}
if (!$error){
$sql = "INSERT INTO Users (UserName, UserPassword, UserEmail)
VALUES ('$name', '$password', '$email')";

if ($conn->query($sql) === TRUE) {
echo '
<script type="text/javascript"> alert("Successfully, Registered"); </script>';
} else {
echo '
<script type="text/javascript"> alert("Failed to register, give proper details."); </script>';
}
}
}



unset($_POST);
?>


<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Blitz Services & Products</title>
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
<body class="home">
<header>
    <div class="header-container">
        <div class="container">
            <div class="top-bar">
                <div class="topbar-content">
                <div class="top-menu widget">
                        <div class="menu-top-menu-container">
                            <ul class="nav_menu" id="menu-top-menu">
                                <?php
                                if(isset($_SESSION['session_user'])) {
                                    echo '
                                
                                <li class="menu-item"><a href="logout.php" onclick="closeModal()">Logout</a></li>
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
                                                                <li class="menu-item active">
                                                                    <a class="item_link" href="index.php">
															<span class="link_content">
																<span class="link_text">Home</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item megamenu_list">
                                                                    <a class="item_link" href="shop.php?id=1">
															<span class="link_content">
																<span class="link_text">Shop</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="tracker.php?id=1&categoryId=1">
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
                                                                <li class="menu-item">
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
                                    <li><a href="shop.php?id=1">Shop</a>

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
            <div class="nav-container">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="left-category-menu hidden-sm hidden-xs">
                                <div class="left-product-cat">
                                    <div class="category-heading">
                                        <h2>Market Place</h2>
                                    </div>
                                    <div class="category-menu-list" style="display: none;">
                                        <ul>
                                            <li class="arrow-plus">
                                                <a href="shop.php?id=1"><span class="cat-thumb "><i
                                                        class="fa fa-laptop"></i></span>OffBeat Jewels</a>
                                            </li>
                                            <li class="arrow-plus">
                                                <a href="shop.php?id=2"><span class="cat-thumb "><i
                                                        class="fa fa-laptop"></i></span>progresswithus</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        




                        <div class="col-lg-9 col-md-9">
                            <div class="search-cart-list">
                                <div class="header-search">
                                    <div class="product-category">
                                    </div>
                                </div>
                                <div class="cart-total">
                                    <ul>
                                    </ul>
                                    <div class="mini_cart_inner">
                                        <ul class="cart_list">
                                            <?php if(isset($_SESSION["cart_products"]) && isset($_SESSION['session_user']))
										{
											foreach ( $_SESSION["cart_products"] as $key => $value) {
                                            $productId = (string)$key;
                                            $content="";
                                            if($productId[0]==1){
                                            $content = get_data('https://offbeatjewels.herokuapp.com/src/product_marketplace.php');
                                            } else if($productId[0] == 2) {
                                            $content = get_data('http://progresswithus.esy.es/includes/product_marketplace.php');
                                            } 
                                            $rows = json_decode($content, true);

                                            foreach ($rows as $row ) {
                                            if($row["ProductId"]==$productId)
                                            {
                                            $productId = $row["ProductId"];
                                            $productName = $row["ProductName"];
                                            $productPrice = $row["ProductPrice"];
                                            echo '
                                            <li>
                                                <a class="product-image" href="#">
                                                    <img alt="" src="img/product/' .  $productId . '.jpg"
                                                         class="primary-image">
                                                </a>
                                                <div class="product-details">
                                                    <a class="product-name" href="index.php#">'.$productName.'</a>
                                                    <span class="cart-price-box">
																<span class="amount">$'.$productPrice.'</span>
															</span>
                                                </div>
                                            </li>
                                            ';

                                            }

                                            }
                                            }
                                            }
                                            ?>
                                        </ul>
                                        <p class="buttons">
                                            <!-- <a href="checkout.php#" class="button checkout wc-forward">Checkout</a> -->
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="main-banner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-6">
                <div class="banner-content-padding">
                    <div class="banner-img"><a href="#"><img src="img/banners/hero.jpg"
                                                             alt="banner picture"/></a></div>
                </div>
            </div>
            <div class="col-md-7 col-sm-6">
                <div class="banner-content-padding">
                    <div class="banner-content">
                        <p><a href="shop.php?id=1" class="button">VIEW COLLECTION</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="new-product-area">
    <div class="container">
        <div class="row">
            <div class="section-title">
                <div class="col-md-12">
                    <h3><span>TOP PRODUCTS / SERVICES</span>
                        <i class="cross-icon"><i></i></i>
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="new-product-list">
                <div class="col-md-12 text-center fix">
                    <div class="tab-menu">
                        <!-- Nav tabs -->
                        <ul id="store" class="nav nav-tabs" role="tablist">
                            <li data-input="0" role="presentation" class="active">
                                <a href="index.php#all" aria-controls="all" role="tab" data-toggle="tab">All</a>
                            </li>
                            <li data-input="4" role="presentation">
                                <a href="index.php#OffBeatJewels" aria-controls="OffBeatJewels" role="tab" data-toggle="tab">OffBeat Jewels</a>
                            </li>
                            <li data-input="6" role="presentation">
                                <a href="index.php#Progresswithus" aria-controls="Progresswithus" role="tab" data-toggle="tab">Progresswithus</a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="clear"></div>
                <div class="tab-content product-list">
                    <div class="tab-pane fade active in" id="all">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.php#all1" aria-controls="all1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                                <!-- <li role="presentation">
                                    <a href="index.php#all2" aria-controls="all2" role="tab"
                                       data-toggle="tab">Recent</a>
                                </li> -->
                                <li role="presentation">
                                    <a href="index.php#all3" aria-controls="all3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#all4" aria-controls="all4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="all1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        // echo "getting most recent of all";
                                        $sql = "SELECT Product.productId, Product.productName, Product.productTag, productPrice, productDesc, Most.counter
FROM Most
INNER JOIN Product
USING ( ProductId )
ORDER BY Most.counter DESC
LIMIT 0 , 5;";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        $counter = $row['counter'];
                                        if($counter == 0) {
                                        break;
                                        }
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in " id="all2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['all'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['all'])) {
                                        $prod = $_COOKIE['all'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        // echo $first.'<br>';
                                        // echo $second.'<br>';
                                        // echo $third.'<br>';
                                        // echo $fourth.'<br>';
                                        // echo $fifth.'<br>';


                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in " id="all3">
                                    <div class="product-owl-active  indicator-style">

                                        <?php
                                        $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId group by A.ProductId order by AVG(Rating) desc Limit 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;

                                        // echo $productTag;
                                        // echo $productName;
                                        // echo $productPrice";

                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in " id="all4">
                                    <div class="product-owl-active  indicator-style">
                                        
                                        <?php

                                        $sql = "Select count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId group by A.ProductId order by count(*) desc  LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            // echo "getting top commented";

                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;

                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade in" id="OffBeatJewels">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.php#OffBeatJewels1" aria-controls="OffBeatJewels1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                               <!--  <li role="presentation">
                                    <a href="index.php#OffBeatJewels2" aria-controls="OffBeatJewels2" role="tab"
                                       data-toggle="tab">Recent</a>
                                </li> -->
                                <li role="presentation">
                                    <a href="index.php#OffBeatJewels3" aria-controls="OffBeatJewels3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#OffBeatJewels4" aria-controls="OffBeatJewels4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="OffBeatJewels1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 1;
                                        $sql = "SELECT Product.productId, Product.productName, Product.productTag, productPrice, productDesc, Most.counter
FROM Most
INNER JOIN Product
USING ( ProductId )
WHERE ProductId > 1 and ProductId < 15 ORDER BY Most.counter DESC
                                        LIMIT 0 , 5;";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        $counter = $row['counter'];
                                        if($counter == 0) {
                                        break;
                                        }
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>



                                <div role="tabpanel" class="tab-pane fade in " id="OffBeatJewels2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['OffBeatJewels'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['OffBeatJewels'])) {
                                        $prod = $_COOKIE['OffBeatJewels'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in " id="OffBeatJewels3">
                                    <div class="product-owl-active  indicator-style">
                                        <?php

                                        $id = 1;
                                        $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >1 and B.ProductId < 15"  . " group by A.ProductId
                                        order by AVG(Rating) desc Limit 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in " id="OffBeatJewels4">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 1;
                                        $sql = "SELECT count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >1 and B.ProductId < 15"  . " group by A.ProductId
                                        order by count(*) desc Limit 5";


                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Progresswithus">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.php#Progresswithus1" aria-controls="Progresswithus1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                               <!--  <li role="presentation">
                                    <a href="index.php#Progresswithus2" aria-controls="Progresswithus2" role="tab" data-toggle="tab">Recent</a>
                                </li> -->
                                <li role="presentation">
                                    <a href="index.php#Progresswithus3" aria-controls="Progresswithus3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#Progresswithus4" aria-controls="Progresswithus4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="Progresswithus1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 6;
                                        $sql = "SELECT Product.productId, Product.productName, Product.productTag, productPrice, productDesc, Most.counter FROM Most INNER JOIN Product USING ( ProductId ) WHERE ProductId >= 15 and ProductId < 25 ORDER BY Most.counter DESC
                                        LIMIT 0 , 5;";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        $counter = $row['counter'];
                                        if($counter == 0) {
                                        break;
                                        }
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ fashioninsta item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="Progresswithus2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['Progresswithus'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['Progresswithus'])) {
                                        $prod = $_COOKIE['Progresswithus'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ fashioninsta item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="Progresswithus3">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 2;
                                        // $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        // " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        // order by AVG(Rating) desc Limit 5";

 $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >13 and B.ProductId < 30"  . " group by A.ProductId
                                        order by avg(Rating) desc Limit 5";

                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ fashioninsta item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="Progresswithus4">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 2;
                                        // $sql = "Select count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        // " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        // order by count(*) desc LIMIT 5";

 $sql = "SELECT count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >13 and B.ProductId < 30"  . " group by A.ProductId
                                        order by count(*) desc Limit 5";


                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ fashioninsta item End -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="home">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.php#home1" aria-controls="home1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#home2" aria-controls="home2" role="tab"
                                       data-toggle="tab">Recent</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#home3" aria-controls="home3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#home4" aria-controls="home4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 5;
                                        $sql = "SELECT Product.ProductId, Product.ProductName, Product.ProductTag, ProductPrice, ProductDesc, Most.counter
FROM Most
INNER JOIN Product
USING ( ProductId )
WHERE ProductId > " . $id*1000 . " and ProductId
                                        < ". ($id + 1)*1000 . "
                                        ORDER BY Most.counter DESC
                                        LIMIT 0 , 5;";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        $counter = $row['counter'];
                                        if($counter == 0) {
                                        break;
                                        }
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ home decor item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="home2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['home'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['home'])) {
                                        $prod = $_COOKIE['home'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ home decor item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="home3">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 5;
                                        $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by AVG(Rating) desc Limit 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ home decor item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="home4">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 5;
                                        $sql = "Select count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by count(*) desc LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ home decor item End -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ice">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.php#ice1" aria-controls="ice1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#ice2" aria-controls="ice2" role="tab"
                                       data-toggle="tab">Recent</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#ice3" aria-controls="ice3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#ice4" aria-controls="ice4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="ice1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 3;
                                        $sql = "SELECT Product.ProductId, Product.ProductName, Product.ProductTag, ProductPrice, ProductDesc, Most.counter
FROM Most
INNER JOIN Product
USING ( ProductId )
WHERE ProductId > " . $id*1000 . " and ProductId
                                        < ". ($id + 1)*1000 . "
                                        ORDER BY Most.counter DESC
                                        LIMIT 0 , 5;";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        $counter = $row['counter'];
                                        if($counter == 0) {
                                        break;
                                        }
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ ice modder item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="ice2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['ice'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['ice'])) {
                                        $prod = $_COOKIE['ice'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ ice modder item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="ice3">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 3;
                                        $sql = "SELECT * FROM `Product` WHERE ProductId > " . $id*1000 . " and ProductId
                                        < ". ($id + 1)*1000 . " LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ ice modder item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="ice4">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 3;
                                        $sql = "Select count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by count(*) desc LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ ice modder item End -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kadart">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.php#kadart1" aria-controls="kadart1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#kadart2" aria-controls="kadart2" role="tab" data-toggle="tab">Recent</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#kadart3" aria-controls="kadart3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#kadart4" aria-controls="kadart4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="kadart1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 2;
                                        $sql = "SELECT Product.ProductId, Product.ProductName, Product.ProductTag, ProductPrice, ProductDesc, Most.counter
FROM Most
INNER JOIN Product
USING ( ProductId )
WHERE ProductId > " . $id*1000 . " and ProductId
                                        < ". ($id + 1)*1000 . "
                                        ORDER BY Most.counter DESC
                                        LIMIT 0 , 5;";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        $counter = $row['counter'];
                                        if($counter == 0) {
                                        break;
                                        }
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ kadart item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="kadart2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['kadart'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['kadart'])) {
                                        $prod = $_COOKIE['kadart'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ kadart item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="kadart3">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 2;
                                        $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by AVG(Rating) desc Limit 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ kadart item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="kadart4">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 2;
                                        $sql = "Select count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by count(*) desc LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ kadart item End -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="mtv">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.php#mtv1" aria-controls="mtv1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#mtv2" aria-controls="mtv2" role="tab"
                                       data-toggle="tab">Recent</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#mtv3" aria-controls="mtv3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.php#mtv4" aria-controls="mtv4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="mtv1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 1;
                                        $sql = "SELECT Product.ProductId, Product.ProductName, Product.ProductTag, ProductPrice, ProductDesc, Most.counter
FROM Most
INNER JOIN Product
USING ( ProductId )
WHERE ProductId > " . $id*1000 . " and ProductId
                                        < ". ($id + 1)*1000 . "
                                        ORDER BY Most.counter DESC
                                        LIMIT 0 , 5;";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        $counter = $row['counter'];
                                        if($counter == 0) {
                                        break;
                                        }
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ mtv item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="mtv2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['mtv'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['mtv'])) {
                                        $prod = $_COOKIE['mtv'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ mtv item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="mtv3">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 1;
                                        $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by AVG(Rating) desc Limit 5";

                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ mtv item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="mtv4">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 1;
                                        $sql = "Select count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by count(*) desc LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["productId"];
                                        $productTag = $row["productTag"];
                                        $productName = $row["productName"];
                                        $productPrice = $row["productPrice"];
                                        $productDesc = $row["productDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.php#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.php#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.php#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.php#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.php#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ mtv item End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
                                    var email = profile.getEmail();
                                    var name = profile.getName();
                                    name = name.split(" ");
                                    signOut();
                                    $.post('socialauth.php', {
                                        email: email,
                                        firstName: name[0],
                                        lastName: name[1]
                                    }).done(function (data) {
                                        window.location.reload();
                                    });
                                    closeModal();
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
                                <label for="name">Password (minimum 6 characters)</label>
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

<script src="js/vendor/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/jquery-price-slider.js"></script>
<script src="js/jquery.collapse.js"></script>
<script src="js/jquery.mixitup.js"></script>
<script src="js/jquery.meanmenu.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/social-likes.min.js"></script>
<script src="js/venobox.js"></script>
<script src="lib/js/jquery.nivo.slider.js" type="text/javascript"></script>
<script src="lib/home.js" type="text/javascript"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

</body>
</html>