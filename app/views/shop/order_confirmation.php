<?php
    // global header -- do not write file extension (.php)
    $this->view('/include/header');

    
?>

<title>Confirmation</title>

                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/shop">Shop</a></li>
                            <li><a href="/">Baby Registry</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="/assets/img/icon/search.png" alt=""></a>
                        <a href="#"><img src="/assets/img/icon/heart.png" alt=""></a>
                        <a href="/shop/checkout"><img src="/assets/img/icon/cart.png" alt=""> <span>0</span></a>
                        <div class="price">$0.00</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Order Placed</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <a href="./checkout.html">Checkout</a>
                            <span>Order Confirmation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                     <!-- Order Number -->
                     <?php 
                        // checks if current order session exists
                        if(isset($_SESSION['current_order_number'])) {
                            $order_number = $_SESSION['current_order_number'];
                            
                            echo "
                                <h6 class='coupon__code' class='checkout__title' style='font-size: 19px;'>
                                    <span style='font-weight: bold;'>Order Number:</span>$order_number
                                </h6>
                            ";
                        }
                    ?>
                    <h2>THANK YOU FOR PLACING YOUR ORDER! &#128516;</h2> <br>
                    <h4>We appreciate your trust in us. We hope we keep meeting your expectations.</h4>
                    <h4>You can track your order in My Order page of your account.</h4>
                    <br>
                    <button class="site-btn" onclick="location.href='/shop/'" style="font-weight: normal;">Continue Shop</button>
                    <br>
                    <!-- <h6 class="coupon__code" class="checkout__title">$order_number</h6> -->
                 
                    
                   

                </div>
            </div>

        </div>
    </section>
    <!-- Checkout Section End -->

<?php
    // global footer - do not write file extension (.php)
    $this->view('include/footer');
?>