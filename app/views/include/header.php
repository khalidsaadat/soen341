<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css?version=0.3" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-steps@%5E1.0/dist/bootstrap-steps.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/custom_style.css?version=2.8" type="text/css">

    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js"></script>

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <?php 
                    // if user is logged-in, show sign out button
                    if(isset($_SESSION['user_id'])) {
                        echo "<a href='/account/signout'>Sign Out</a>";
                    }
                    else {
                        echo "<a href='/account/login'>My Account</a>";
                    }

                    // get the number of items in the cart + the total amount
                    $cart_items = $this->model('Cart')->getAllByUserId($_SESSION['user_id']);
                    $cart_price = 0;
                    foreach($cart_items as $cart) {
                        $cart_price += $cart->price;
                    }
                    // calculate tax and total amount
                    $tax_amount_flt = $cart_price * (14.975 / 100);

                    $cart_price_flt = $tax_amount_flt + $cart_price;

                    $cart_price = number_format($cart_price_flt, 2);

                    $cart_items = ($cart_items) ? count($cart_items) : 0;
                    $_SESSION['cart_items_count'] = $cart_items;
                    $_SESSION['cart_items_price'] = $cart_price;
                ?>
            </div>
            
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="/assets/img/icon/search.png" alt=""></a>
            <a href="#"><img src="/assets/img/icon/heart.png" alt=""></a>
            <a href="#"><img src="/assets/img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                
                                <?php 
                                    // admin portal
                                    $my_account_url = '/';
                                    if((isset($_SESSION['role'])) && ($_SESSION['role'] == 'admin')) {
                                        $my_account_url = '/admin/';
                                    }
                                    // normal user account
                                    else if((isset($_SESSION['role'])) && ($_SESSION['role'] == 'user')) {
                                        $my_account_url = '/account/';
                                    }
                                    // if user is logged-in, show sign out button                                    
                                    if(isset($_SESSION['user_id'])) {
                                        echo "<a href='$my_account_url' style='margin-right: 8px;'>My Account</a>";
                                        echo "<span style='color: white; margin-right: 8px;'>|</span>";
                                        echo "<a href='/account/signout'>Sign Out</a>";
                                    }
                                    else {
                                        echo "<a href='/account/login'>My Account</a>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="/"><img src="/assets/img/logo.png" alt=""></a>
                    </div>
                </div>