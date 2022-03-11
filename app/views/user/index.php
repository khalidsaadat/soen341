<?php
    // global header -- do not write file extension (.php)
    $this->view('/include/header');

    // Account detail
    $profile = $model['user_profile'];
    $name = $profile->full_name;
    $email = $profile->email;
    $phone = $profile->phone_number;
    $address = $profile->address;

    // Order detail

    // Wishlist detail
    $wishlists = $model['wishlists'];
?>

<title>My Account</title>

                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/shop">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./about.html">About Us</a></li>
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                    <li><a href="/shop/checkout">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contacts</a></li>
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
                        <h4>My Account</h4>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-to-dropdown">
                        <div class="nav-wrapper" style="text-align: center;">
                            <ul class="nav nav-pills d-md-flex " id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="account-detail-tab" data-toggle="pill" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true">Account Detail</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="orders-tab" data-toggle="pill" href="#orders" role="tab" aria-controls="orders" aria-selected="false">Orders</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="wish-list-tab" data-toggle="pill" href="#wish-list" role="tab" aria-controls="wish-list" aria-selected="false">Wish Lists</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="rewards-tab" data-toggle="pill" href="#rewards" role="tab" aria-controls="rewards" aria-selected="false">Rewards</a>
                                </li>
                            </ul>

                        </div>

                        <div class="tab-content authentication_form" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                <div class="container-fluid">
                                    <h2 class="mb-3 font-weight-bold">Account Detail</h2>
                                    
                                    <?php
                                        // Show the message
                                        if(isset($_SESSION['return-msg'])) {
                                            $error_msg = $_SESSION['return-msg'];
                                            echo "
                                                <div class='form_error'>
                                                    $error_msg
                                                </div>
                                            ";
                                        }

                                        if(isset($model['error_msg'])) {
                                            $error_msg = $model['error_msg'];
                                            echo "
                                                <div class='form_error'>
                                                    $error_msg
                                                </div>
                                            ";
                                        }

                                        // reset the msg session
                                        unset($_SESSION['return-msg']);

                                    ?>
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="checkout__input">
                                                    <p>Name<span>*</span></p>
                                                    <input type="text" name="full_name" id="full_name" value="<?php echo $name; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="checkout__input">
                                                    <p>Email<span>*</span></p>
                                                    <input type="email" name="email" id="email" value="<?php echo $email; ?>" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="checkout__input">
                                                    <p>Phone<span>*</span></p>
                                                    <input type="text" name="phone_number" id="phone_number" value="<?php echo $phone; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="checkout__input">
                                                    <p>Address<span>*</span></p>
                                                    <input type="text" name="address" id="address" value="<?php echo $address; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <h3 class="mb-3 font-weight">Security</h3>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="checkout__input">
                                                    <p>Current Password</p>
                                                    <input type="password" name="current_pwd" id="current_pwd">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="checkout__input">
                                                    <p>New Password</p>
                                                    <input type="password" name="new_pwd" id="new_pwd">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="checkout__input">
                                                    <p>Confirm New Password</p>
                                                    <input type="password" name="confirm_new_pwd" id="confirm_new_pwd">
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" name="update-account" class="site-btn">UDPATE</button>
                                        
                                    </form>

                                    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                <div class="container-fluid">
                                    <h2 class="mb-3 font-weight-bold">Orders</h2>
                                    
                                    <div class="col-lg-12">
                                        <div class="row" style="margin-bottom: 15px;">
                                            <div class="col-lg-12 order-item">
                                                <div class="row order-header">
                                                    <div class="col-lg-6">
                                                        <span><strong>Order #: </strong>1234x89b</span> 
                                                        <span class="header-title-divider"> | </span>
                                                        <span><strong>Total: </strong>$123.99</span> 
                                                    </div>
                                                    <div class="col-lg-6 text-right">
                                                        <span><strong>Order Date: </strong>12 February, 2022</span>
                                                    </div>
                                                </div>
                                                <div class="row pd-10">
                                                    <div class="col-lg-2">
                                                        <img src="/assets/products/images/620c78e33d89f.jpg" alt="">
                                                    </div>
                                                    <div class="col-lg-7 pd-l-0">
                                                        <div class="order-item-title">Product Name</div>
                                                        <div>
                                                            Size: M
                                                        </div>
                                                        <div>
                                                            Color: Red
                                                        </div>
                                                        <div>
                                                            Quantity: 2
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 text-right">
                                                        <div class="font-weight-bold"> Expected Delivery</div>
                                                        <div class="delivery-date">30 February, 2022 by 8pm</div>
                                                        <hr class="delivery-date-hr">
                                                        <div data-toggle="modal" data-target="#track-order-modal">
                                                            <span style="font-weight: bold; cursor: pointer;"><img src="/assets/icons/delivery.png" alt="" style="height: 22px;"> Track Order</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row order-footer text-right">
                                                    <div class="col-lg-12">
                                                        <div class="cancel-order">
                                                            <a href="#" data-toggle="modal" data-target="#cancel-order-modal">Cancel Order</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="row" style="margin-bottom: 15px;">
                                            <div class="col-lg-12 order-item">
                                                <div class="row order-header">
                                                    <div class="col-lg-6">
                                                        <span><strong>Order #: </strong>1234x89b</span> 
                                                        <span class="header-title-divider"> | </span>
                                                        <span><strong>Total: </strong>$123.99</span> 
                                                    </div>
                                                    <div class="col-lg-6 text-right">
                                                        <span><strong>Order Date: </strong>12 February, 2022</span>
                                                    </div>
                                                </div>
                                                <div class="row pd-10">
                                                    <div class="col-lg-2">
                                                        <img src="/assets/products/images/620b5f66c9b0d.jpg" alt="">
                                                    </div>
                                                    <div class="col-lg-7 pd-l-0">
                                                        <div class="order-item-title">Product Name</div>
                                                        <div>
                                                            Size: M
                                                        </div>
                                                        <div>
                                                            Color: Red
                                                        </div>
                                                        <div>
                                                            Quantity: 2
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 text-right">
                                                        <div class="font-weight-bold"> Expected Delivery</div>
                                                        <div class="delivery-date">30 February, 2022 by 8pm</div>
                                                        <hr class="delivery-date-hr">
                                                        <div data-toggle="modal" data-target="#track-order-modal">
                                                            <span style="font-weight: bold; cursor: pointer;"><img src="/assets/icons/delivery.png" alt="" style="height: 22px;"> Track Order</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row order-footer text-right">
                                                    <div class="col-lg-12">
                                                        <div class="cancel-order">
                                                            <a href="#" data-toggle="modal" data-target="#cancel-order-modal">Cancel Order</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Track Modal -->
                                    <div class="modal fade" id="track-order-modal" tabindex="-1" role="dialog" aria-labelledby="track-order-modal-label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    
                                                    <ul class="steps">
                                                        <li class="step step-success">
                                                            <div class="step-content">
                                                                <span class="step-circle">1</span>
                                                                <span class="step-text">Received</span>
                                                            </div>
                                                        </li>
                                                        <li class="step step-active">
                                                            <div class="step-content">
                                                                <span class="step-circle">2</span>
                                                                <span class="step-text">Preparing</span>
                                                            </div>
                                                        </li>
                                                        <li class="step">
                                                            <div class="step-content">
                                                                <span class="step-circle">3</span>
                                                                <span class="step-text">Shipping</span>
                                                            </div>
                                                        </li>
                                                        <li class="step">
                                                            <div class="step-content">
                                                                <span class="step-circle">4</span>
                                                                <span class="step-text">Delivered</span>
                                                            </div>
                                                        </li>
                                                    </ul>

                                                    <div>
                                                        <hr>
                                                        <div class="row" style="margin-left: 20px;">
                                                            <ul>
                                                                <li style="padding-bottom: 5px;"><strong>Order recieved</strong>: 20 February, 2022</li>
                                                                <li><strong>Preparing</strong>: 22 February, 2022</li>
                                                            </ul>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="site-btn" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cancel Modal -->
                                    <div class="modal fade" id="cancel-order-modal" tabindex="-1" role="dialog" aria-labelledby="cancel-order-modal-label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight" id="cancel-order-modal-label">Product Name</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to cancel your order?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="site-btn" data-dismiss="modal">Close</button>
                                                    <button type="button" class="site-btn">Cancel Order</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    

                                </div>
                            </div>
                            <div class="tab-pane fade" id="wish-list" role="tabpanel" aria-labelledby="wish-list-tab">
                                <div class="container-fluid">
                                    <h2 class="mb-3 font-weight-bold">Wishlist</h2>
                                    
                                    <div class="col-lg-12">
                                        <div class="row" style="margin-bottom: 15px;">

                                            <?php
                                                // get wishlist from the db
                                                if(count($wishlists) > 0) {
                                                    foreach($wishlists as $wishlist) {
                                                        $wishlist_id = $wishlist->wishlist_id;
                                                        $date = date('F d, Y', strtotime($wishlist->date));

                                                        $product_id = $wishlist->product_id;
                                                        $product = $this->model('Product')->find($product_id);

                                                        $name = $product->name;
                                                        $sizes = unserialize($product->size);
                                                            $sizes_copy = $sizes;
                                                        $colors = unserialize($product->colors);
                                                        $image = $product->images;
                                                        $images_name = explode(',', $image);
                                                        $image_name = $images_name[0];

                                                   
                                                        echo "
                                                            <div class='col-lg-12 order-item mb-10'>
                                                                <div class='row order-header'>
                                                                    <div class='col-lg-6'>
                                                                        <span><strong>Date Added: </strong>$date</span>
                                                                    </div>
                                                                </div>
                                                                <div class='row pd-10'>
                                                                    <div class='col-lg-2'>
                                                                        <img src='/assets/products/images/$image_name' alt=''>
                                                                    </div>
                                                                    <div class='col-lg-7 pd-l-0'>
                                                                        <div class='order-item-title'>$name</div>
                                                                        <div>
                                                                            Size(s) Available: ";
                                                                                foreach($sizes as $size) {
                                                                                    echo $size;
                                                                                    // add comma except the last value
                                                                                    if(next($sizes_copy)) {
                                                                                        echo ', ';
                                                                                    }
                                                                                }
                                                                            echo "
                                                                        </div>
                                                                        <div>
                                                                            Color(s) Available: 
                                                                                <div>";
                                                                                foreach($colors as $color) {
                                                                                    $color = ucfirst($color);
                                                                                    echo "
                                                                                        <span class='product__details__option__color checkout-color' style='float: left; margin-left: 10px; top: 2px; font-weight: normal;'>
                                                                                            <label style='background: $color;' for='sp-1' data-toggle='tooltip' data-placement='top' title='$color'>
                                                                                                <input type='radio' id='sp-1'>
                                                                                            </label>
                                                                                        </span>
                                                                                    ";
                                                                                }
                                                                            echo "
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class='col-lg-3 text-right'>
                                                                        <div>
                                                                            <span style='font-weight: bold; cursor: pointer;'><img src='/assets/icons/trash.png' alt='' style='height: 22px; padding-right: 10px;' data-toggle='tooltip' data-placement='right' title='Remove from wishlist'>&nbsp; </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        ";
                                                    }
                                                }
                                                else {
                                                    ?>
                                                    <div>
                                                        <h4>Your wishlist is empty</h4>
                                                    </div>
                                                    <?php
                                                }
                                            ?>

                                        </div>

                                    </div>

                                    
                                    <!-- Cancel Modal -->
                                    <div class="modal fade" id="cancel-order-modal" tabindex="-1" role="dialog" aria-labelledby="cancel-order-modal-label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight" id="cancel-order-modal-label">Product Name</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to cancel your order?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="site-btn" data-dismiss="modal">Close</button>
                                                    <button type="button" class="site-btn">Cancel Order</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    

                                </div>
                            </div>
                            <div class="tab-pane fade" id="rewards" role="tabpanel" aria-labelledby="rewards-tab">
                                <div class="container-fluid">
                                    <h2 class="mb-3 font-weight-bold">Rewards</h2>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Checkout Section End -->

<?php
    // global footer - do not write file extension (.php)
    $this->view('include/footer');
?>