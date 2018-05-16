<?php
session_start();
$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "b1069ce4ee0339";
$password = "7ee6e563";
$dbname = "heroku_5eaa584d7cda171";

$conn = new mysqli($servername, $username, $password, $dbname);
   
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


 $getId = $_GET['id'];
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

if(isset($getId)) {
    if($getId == 1) {
        $content = get_data('https://offbeatjewels.herokuapp.com/src/product_marketplace.php');
    } else if($getId == 2) {
        $content = get_data('http://progresswithus.esy.es/includes/product_marketplace.php');
    } 
}

$rows = json_decode($content, true);

#update cart
if(isset($_POST['Add_to_Cart']))
{
if(isset($_SESSION['session_id']))
{
$add_to_cart_productId = $_POST['Add_to_Cart'];
 
if(!isset($_POST['cart-quantity']))
 {
    $cart_quantity = 1;
 }

else
{
    $cart_quantity = $_POST['cart-quantity'];
}

if(isset($add_to_cart_productId))
    {
        
        $new_product["ProductId"] = $add_to_cart_productId;
        $new_product["ProductQty"]= $cart_quantity;
        //add product to session or create new one
        if(isset($_SESSION["cart_products"]))
        {  //if session var already exist
             if(isset($_SESSION["cart_products"][$new_product['ProductId']])) //check item exist in products array
             {
                 unset($_SESSION["cart_products"][$new_product['ProductId']]); //unset old array item
             }           
        }
        $_SESSION["cart_products"][$new_product['ProductId']] = $new_product; //update or create product session with new item
        echo '<script>alert("You have successfully added to the cart."); </script>';
    }
}
}

if(isset($_POST['priceLowHigh']))
        {                                                                                                                                                                           
            usort($rows, function($a, $b) {
                return $a["ProductPrice"] < $b["ProductPrice"] ? -1 : 1;
            }); 
        }elseif (isset($_POST['priceHighLow']))
        {                                                                                                                                                                           
            usort($rows, function($a, $b) {
                return $a["ProductPrice"] > $b["ProductPrice"] ? -1 : 1;
            }); 
        }elseif (isset($_POST['tagAsc']))
        {                                                                                                                                                                           
            usort($rows, function($a, $b) {
                return $a["ProductTag"] < $b["ProductTag"] ? -1 : 1;
            }); 
        }elseif (isset($_POST['tagDesc']))
        {                                                                                                                                                                           
            usort($rows, function($a, $b) {
                return $a["ProductTag"] > $b["ProductTag"] ? -1 : 1;
            }); 
        }
# Add to Wishlist:
if(isset($_POST['Add_to_Wishlist']))
{
if(isset($_SESSION['session_id']))
{
$add_to_wishlist_productId = $_POST['Add_to_Wishlist'];
$add_to_wishlist_userId = $_SESSION['session_id'];
$sql = "INSERT INTO `Wishlist`". "(ProductId,UserId)". "VALUES('$add_to_wishlist_productId','$add_to_wishlist_userId')";
$results = mysql_query( $sql, $conn );
    echo '<script>alert("Added to the wishlist successfully."); </script>';
if(! $results ) {
      die('Could not enter data: ' . mysql_error());
        }
    }
}

?>

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
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
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
                                                                <li class="menu-item active">
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
        </div>
    </div>
</header>

<div class="clear"></div>
<div class="shop-header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="shop-header-title">
                    <h1>Shop All Products & Services</h1>
                    <div class="shop-menu">
                        <ul>
                            <li><a <?php if(isset($getId) && $getId == 4)  echo 'class="active"';?>href="?id=1">OffBeat Jewels</a></li>
                            <li><a <?php if(isset($getId) && $getId == 6)  echo 'class="active"';?>href="?id=2">Progresswithus</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="breadcrumbs all-product-view-mode">
                    <a href="index.php">Home</a><span class="separator">&gt;</span><span> Shop</span>
                </div>
            </div>
        </div>
        <div class="all-product-sidebar-area">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <aside class="widget shop-filter fix">
                        <h3 class="sidebar-title">Sort</h3>
                        <div class="info_widget">
                            <div class="price_filter">
                                <div class="sidebar-menu">
                                    <form method="post">
                                          <input style="width: 180px; margin-bottom: 10px;" type="submit"  value="Price :Low to High" name="priceLowHigh" / ><br>
                                          <input style="width: 180px; margin-bottom: 10px;" type="submit"  value="Price :High to Low" name ="priceHighLow"/><br>
                                          <input type="submit" style="width: 180px; margin-bottom: 10px;" value="Tag :Ascending" name ="tagAsc"/><br>
                                          <input type="submit" style="width: 180px; margin-bottom: 10px;"  value="Tag :Descending" name = "tagDesc"/><br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <aside class="widget filter-by">
                        <h3 class="sidebar-title">Filter by</h3>
                        <ul class="sidebar-menu">
                            <li><a href="shop.php?id=1">OffBeat Jewels</a></li>
                            <li><a href="shop.php?id=2">Progresswithus</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-md-9 fix">
                    <div class="all-product-list-grid-area">
                        <div class="row">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="grid">
                                    <div class="ma-bestsellerproductslider-container">
                                        <?php
                                                echo '<form action="shop.php?id=' . $getId .'" method="post">';
                                        // output data of each row
                                        foreach ($rows as $row ) {
                                        $productId = $row[0];
                                        $productTag = $row[1];
                                        $productName = $row[2];
                                        $productPrice = $row[3];
                                        $productDesc = $row[4];
                                        $MRP = (int)$productPrice + 2;

                                        echo '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <div class="single-item">
                                            <div class="s-product-img">
                                                <a href="product.php?pid='.$productId .'">
                                                    <img alt="" src="img/product/' .  $productId . '.jpg" class="primary-image">
                                                </a>
                                                <div class="price-rate">
                                                    <div class="global-table">
                                                        <div class="global-row">
                                                            <div class="global-cell">
                                                                <div class="hover-view-content">
                                                                    <a href="#" class="modal-view detail-link quickview" data-toggle="modal" data-target="#productModal' . $productId . '">Quick View</a>
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
                                                                        <p class="special-price"><span class="price">$' . $productPrice . '</span></p>
                                                                        <p class="old-price"> <span class="price"><del>$'. $MRP . '</del></span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pro-action">
                                                    <div class="product-cart-area-list">
                                                        <div class="cart-btn btn-add-to-cart"><button type="submit" name="Add_to_Cart" value="' . $productId .'"><i class="fa fa-shopping-cart"></i>ADD TO CART
                                                        </button></div>
                                                        <div class="cart-btn right link-compare"><button type="submit" name="Add_to_Wishlist" value="' . $productId .'"><i class="fa fa-heart-o"></i></button></div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-title">
                                                <a href="product.php?pid='.$productId .'&categoryId='.$getId.'   ">' . $productName . '</a>
                                            </div>
                                        </div>
                                    </div>';
                                        }
                                        ?>
                                </form>
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
                                    <li class="menu-item"> <a href="#">About</a> </li>
                                    <li class="menu-item"> <a href="#">News</a> </li>
                                    <li class="menu-item"> <a href="#">Contact</a> </li>
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

<div id="quickview-wrapper">
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
                    </div>

                    <div class="product-info">
                        <h1>' . $productName . '</h1>
                        <div class="price-box-3">
                            <div class="s-price-box">
                                <span class="new-price">$' . $productPrice . '</span>
                                <span class="old-price">$'. $MRP . '</span>
                            </div>
                        </div>
                        <div class="quick-add-to-cart">
                            <form class="cart" action="shop.html?id=' . $getId .'" method="post">
                                <div class="numbers-row">
                                    <input type="number" id="french-hens" value="2" name="cart-quantity">
                                </div>
                                <button class="single_add_to_cart_button" name="Add_to_Cart" type="submit" value ="'.$productId.'">Add to cart</button>
                                <div class="cart-btn right link-compare"><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Wishlist" ><button type="submit" name="Add_to_Wishlist" value="' . $productId .'"><i class="fa fa-heart-o"></i>
                                                        </a></div>
                            </form>
                        </div>
                        <div class="quick-desc">
                            This is a very good product. Please buy this product and help us.
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
    }
    ?>
</div>

<div id="login-modal" class="modal fade login" aria-labelledby="myModalLabel" tabindex="-1" role="dialog">
    <div class="modal-dialog login animated">
        <form id="login-form" action="index.html" method="POST">
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
        <form id="sign-form" action="index.html" method="POST">
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
