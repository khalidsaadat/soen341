<?php
    // global header -- do not write file extension (.php)
    $this->view('/include/header');

    // Account detail
    $profile = $model['user_profile'];
    $name = $profile->full_name;
    $email = $profile->email;
    $phone = $profile->phone_number;
    $address = $profile->address;

    // Orders
    $orders = $model['orders'];
    
    // Addresses
    $p_flag = 0;
    $p_street = '';
    $p_city = '';
    $p_province = '';
    $p_postal_code = '';
    $p_country = '';
    $p_status = '';
    if($model['primary_address'] == true) {
        $primary_address = $model['primary_address'];
        $p_street = $primary_address->street;
        $p_city = $primary_address->city;
        $p_province = $primary_address->province;
        $p_postal_code = $primary_address->postal_code;
        $p_country = $primary_address->country;
        $p_status = $primary_address->status;

        $p_flag = 1;

    }

    $s_flag = 0;
    $s_street = '';
    $s_city = '';
    $s_province = '';
    $s_postal_code = '';
    $s_country = '';
    $s_status = '';
    if($model['secondary_address'] == true) {

        $secondary_address = $model['secondary_address'];
        $s_street = $secondary_address->street;
        $s_city = $secondary_address->city;
        $s_province = $secondary_address->province;
        $s_postal_code = $secondary_address->postal_code;
        $s_country = $secondary_address->country;
        $s_status = $secondary_address->status;

        $s_flag = 1;
    }

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
                            <li><a href="/babyregistry">Baby Registry</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="/assets/img/icon/search.png" alt=""></a>
                        <a href="#"><img src="/assets/img/icon/heart.png" alt=""></a>
                        <a href="/shop/checkout"><img src="/assets/img/icon/cart.png" alt=""> <span><?php echo $_SESSION['cart_items_count']; ?></span></a>
                        <div class="price">$<?php echo $_SESSION['cart_items_price']; ?></div>
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
                        <?php
                            if(isset($_SESSION['return-msg'])) {
                                $msg = $_SESSION['return-msg'];
                                echo "
                                    <div class='form_error'>
                                        $msg
                                    </div>
                                ";

                                unset($_SESSION['return-msg']);
                            }
                        ?>
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
                        <div class="nav-wrapper d-md-flex justify-content-center" style="text-align: center;">
                            <ul class="nav nav-pills  " id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="account-detail-tab" data-toggle="pill" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true">Account Detail</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="orders-tab" data-toggle="pill" href="#orders" role="tab" aria-controls="orders" aria-selected="false">Orders</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="wish-list-tab" data-toggle="pill" href="#wish-list" role="tab" aria-controls="wish-list" aria-selected="false">Wish Lists</a>
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
                                            <!-- <div class="col-lg-6">
                                                <div class="checkout__input">
                                                    <p>Address<span>*</span></p>
                                                    <input type="text" name="address" id="address" value="<?php echo $address; ?>">
                                                </div>
                                            </div> -->
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

                                        <hr>
                                        <h3 class="mb-3 font-weight">Addresses</h3>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="panel panel-1" style="background: #cdedfd; color: #000; border: 1px solid #cfdee7;">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="heading">Primary Address</div>
                                                        </div>
                                                        <div class="col-md-2 text-right">
                                                            <span class="icon_pencil" style="cursor: pointer;" data-toggle="modal" data-target="#primary-address-modal"></span> &nbsp;
                                                            <span class="icon_heart" style="cursor: pointer;"></span>
                                                        </div>
                                                    </div>
                                                    <div class="text-left" style="margin-top: 10px;">
                                                        <div>
                                                            <?php
                                                                if($p_flag == 1)
                                                                    echo $p_street . ', ' . $p_city . ', ' . $p_province . ', ' . $p_postal_code . ', ' . $p_country;
                                                                else
                                                                    echo 'No primary address.';
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="panel panel-2" style="background: #e7e5e5; color: #000; border: 1px solid #aee5d8;">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="heading">Secondary Address</div>
                                                        </div>
                                                        <div class="col-md-2 text-right">
                                                            <span class="icon_pencil"  style="cursor: pointer;" data-toggle="modal" data-target="#secondary-address-modal"></span> &nbsp;
                                                            <span class="icon_heart_alt" style="cursor: pointer;" data-toggle="modal" data-target="#primary-address-modal"></span>
                                                        </div>
                                                    </div>
                                                    <div class="text-left" style="margin-top: 10px;">
                                                        <div>
                                                            <?php
                                                                if($s_flag == 1)
                                                                    echo $s_street . ', ' . $s_city . ', ' . $s_province . ', ' . $s_postal_code . ', ' . $s_country;
                                                                else
                                                                    echo 'No secondary address.';
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Primary Address Modal -->
                                        <div class="modal fade" id="primary-address-modal" tabindex="-1" role="dialog" aria-labelledby="primary-address-modal-label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight" id="primary-address-modal-label">Primary Address</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                        <div class="modal-body">
                                                            
                                                                <div class="checkout__input">
                                                                    <p>Street #<span>*</span></p>
                                                                    <input type="text" name="p_street" id="p_street" value="<?php echo $p_street; ?>">
                                                                </div>

                                                                <div class="checkout__input">
                                                                    <p>City<span>*</span></p>
                                                                    <input type="text" name="p_city" id="p_city" value="<?php echo $p_city; ?>">
                                                                </div>

                                                                <div class="checkout__input">
                                                                    <p>Province<span>*</span></p>
                                                                    <input type="text" name="p_province" id="p_province" value="<?php echo $p_province; ?>">
                                                                </div>

                                                                <div class="checkout__input">
                                                                    <p>Postal Code<span>*</span></p>
                                                                    <input type="text" name="p_postal_code" id="p_postal_code" value="<?php echo $p_postal_code; ?>">
                                                                </div>

                                                                <div class="checkout__input">
                                                                    <p>Country<span>*</span></p>
                                                                    <input type="text" name="p_country" id="p_country" value="<?php echo $p_country; ?>">
                                                                </div>

                                                                <div class="checkout__input__checkbox">
                                                                    <label for="p_primary_address">
                                                                        Primary Address?
                                                                        <?php 
                                                                            if($p_status == 1) {
                                                                                echo "
                                                                                    <input type='checkbox' id='p_primary_address' name='p_primary_address' checked='checked'>
                                                                                    <span class='checkmark'></span>
                                                                                ";
                                                                            }
                                                                            else {
                                                                                echo "
                                                                                    <input type='checkbox' id='p_primary_address' name='p_primary_address'>
                                                                                    <span class='checkmark'></span>
                                                                                ";
                                                                            }
                                                                        ?>
                                                                    </label>
                                                                </div>
                                                        
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="site-btn" data-dismiss="modal">Close</button>
                                                            <button type="submit"  name="update_address" class="site-btn">Save Changes</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Secondary Address Modal -->
                                        <div class="modal fade" id="secondary-address-modal" tabindex="-1" role="dialog" aria-labelledby="secondary-address-modal-label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight" id="secondary-address-modal-label">Secondary Address</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                        <div class="modal-body">
                                                            
                                                                <div class="checkout__input">
                                                                    <p>Street #<span>*</span></p>
                                                                    <input type="text" name="s_street" id="street" value="<?php echo $s_street; ?>">
                                                                </div>

                                                                <div class="checkout__input">
                                                                    <p>City<span>*</span></p>
                                                                    <input type="text" name="s_city" id="city" value="<?php echo $s_city; ?>">
                                                                </div>

                                                                <div class="checkout__input">
                                                                    <p>Province<span>*</span></p>
                                                                    <input type="text" name="s_province" id="province" value="<?php echo $s_province; ?>">
                                                                </div>

                                                                <div class="checkout__input">
                                                                    <p>Postal Code<span>*</span></p>
                                                                    <input type="text" name="s_postal_code" id="postal_code" value="<?php echo $s_postal_code; ?>">
                                                                </div>

                                                                <div class="checkout__input">
                                                                    <p>Country<span>*</span></p>
                                                                    <input type="text" name="s_country" id="country" value="<?php echo $s_country; ?>">
                                                                </div>

                                                                <div class="checkout__input__checkbox">
                                                                    <label for="s_primary_address">
                                                                        Primary Address?
                                                                        <?php 
                                                                            if($s_status == 1) {
                                                                                echo "
                                                                                    <input type='checkbox' id='s_primary_address' name='s_primary_address' checked='checked'>
                                                                                    <span class='checkmark'></span>
                                                                                ";
                                                                            }
                                                                            else {
                                                                                echo "
                                                                                    <input type='checkbox' id='s_primary_address' name='s_primary_address'>
                                                                                    <span class='checkmark'></span>
                                                                                ";
                                                                            }
                                                                        ?>
                                                                    </label>
                                                                </div>
                                                        
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="site-btn" data-dismiss="modal">Close</button>
                                                            <button type="submit"  name="update_address" class="site-btn">Save Changes</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" name="update-account" class="site-btn">UDPATE</button>
                                        
                                    </form>

                                    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                <div class="container-fluid">
                                    <h2 class="mb-3 font-weight-bold">Orders</h2>
                                    
                                    <div class="col-lg-12">
                                        <?php
                                         
                                            
                                            
                                        $modal_counter = 1;
                                            foreach($orders as $order) {

                                                $order_id = $order->order_id;
                                                $address_id = $order->address_id;
                                                $status = $order->status;
                                                $cart_ids_serialized = $order->cart_ids;
                                                $cart_ids_array = unserialize($cart_ids_serialized);

                                                $all_cart_ids_array = array();
                                                $counter = 0; 
                                                foreach($cart_ids_array as $id) {
                                                    $id_array = (array) $id;
                                                    // $all_keywords_str .= ',' . implode(', ', array_map("ucfirst", $id_array));
                                                    $id = implode(', ', array_map("ucfirst", $id_array));
                                                    $all_cart_ids_array[$counter] = $id;

                                                    $counter++;
                                                }

                                                $order_number = $order->order_number;
                                                $order_date = $order->order_date; 
                                                $order_date = date('d F, Y', strtotime($order_date));

                                                $delivery_date = $order->delivery_date;
                                                $delivery_date = date('d F, Y', strtotime($delivery_date));

                                                $total = $order->total;
                                                $total = number_format($total, 2);
                                                
                                                echo "
                                                <div class='row' style='margin-bottom: 15px;'>
                                                    <div class='col-lg-12 order-item'>
                                                        <div class='row order-header'>
                                                            <div class='col-lg-6'>
                                                                <span><strong>Order #: </strong>$order_number</span> 
                                                                <span class='header-title-divider'> | </span>
                                                                <span><strong>Total: </strong>$$total</span> 
                                                            </div>
                                                            <div class='col-lg-6 text-right'>
                                                                <span><strong>Order Date: </strong>$order_date</span>
                                                            </div>
                                                        </div>
                                                ";
                                                $delivery_print_flag = 0;
                                                foreach($all_cart_ids_array as $cart) {
                                                    
                                                    $this_cart = $this->model('Cart')->find($cart);
                                                    $size = $this_cart->size;
                                                    $color = $this_cart->color;
                                                    $quantity = $this_cart->quantity;
                                                    $product_id = $this_cart->product_id;
                                                    

                                                    $this_product = $this->model('Product')->find($product_id);
                                                    $images = $this_product->images;
                                                    $images_names = explode(',', $images);
                                                    $image_name = $images_names[0];
                                                    
                                                    $name = $this_product->name;

                                                    echo "
                                                        
                                                                <div class='row pd-10'>
                                                                    <div class='col-lg-2'>
                                                                        <img src='/assets/products/images/$image_name' alt=''>
                                                                    </div>
                                                                    <div class='col-lg-7 pd-l-0'>
                                                                        <div class='order-item-title'>$name</div>
                                                                        <div>
                                                                            Size: $size
                                                                        </div>
                                                                        <div>
                                                                            Color: $color
                                                                        </div>
                                                                        <div>
                                                                            Quantity: $quantity
                                                                        </div>
                                                                    </div>
                                                                    <div class='col-lg-3 text-right'>";
                                                                    if($delivery_print_flag == 0) {
                                                                        echo "
                                                                            
                                                                                <div class='font-weight-bold'> Expected Delivery</div>
                                                                                <div class='delivery-date'>$delivery_date by 8pm</div>
                                                                                <hr class='delivery-date-hr'>
                                                                                ";
                                                                                // <div data-toggle='modal' data-target='#track-order-modal'>
                                                                                //     <span style='font-weight: bold; cursor: pointer;'><img src='/assets/icons/delivery.png' alt='' style='height: 22px;'> Track Order</span>
                                                                                // </div>
                                                                                
                                                                    }
                                                                    echo "
                                                                    </div>
                                                                </div>
                                                                   
                                                    ";
                                                    
                                                    // stop from printing more expected delivery date for the rest of the items in the same order number
                                                    $delivery_print_flag = 1;
                                                    
                                                    echo "
                                                        <div class='modal fade' id='cancel-order-modal-$modal_counter' tabindex='-1' role='dialog' aria-labelledby='cancel-order-modal-label' aria-hidden='true'>
                                                            <div class='modal-dialog modal-dialog-centered' role='document'>
                                                                <form method='post'>
                    
                                                                    <div class='modal-content'>
                                                                        <div class='modal-header'>
                                                                            <h5 class='modal-title font-weight' id='cancel-order-modal-label'>Order #: $order_number</h5>
                                                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                            <span aria-hidden='true'>&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class='modal-body'>
                                                                            Are you sure you want to cancel your order?
                                                                        </div>
                                                                        <div class='modal-footer'>
                                                                            <button type='button' class='site-btn' data-dismiss='modal'>Close</button> 
                                                                            ";
                                                                            ?>
                                                                            <button type='button' class='site-btn' onclick="location.href='/shop/cancel_order/<?php echo $order_id; ?>'">Cancel Order</button>
                                                                            <?php
                                                                            echo "
                                                                        </div>
                                                                    </div>
                    
                                                                </form>
                                                            </div>
                                                        </div>
                                                    ";
                                                    
                                                    
                                                }

                                                echo "

                                                                
                                                            <div class='row order-footer text-right'>
                                                                <div class='col-lg-12'>
                                                                ";
                                                                if($status == 1) {
                                                                    echo "
                                                                        <div class='cancel-order'>
                                                                            <a href='#' data-toggle='modal' data-target='#cancel-order-modal-$modal_counter'>Cancel Order</a>
                                                                        </div>
                                                                    ";
                                                                }
                                                                else {
                                                                    echo "
                                                                        <div class='cancel-order'>
                                                                            Order Cancelled
                                                                        </div>
                                                                    ";
                                                                }
                                                                echo "
                                                                </div>
                                                            </div>
                                                        
                                                        </div>
                                                    </div>
                                                ";
                                                

                                                $modal_counter++;
                                            }
                                        ?>
                                        

                                    </div>

                                    <!-- Track Modal -->
                                    <!-- <div class="modal fade" id="track-order-modal" tabindex="-1" role="dialog" aria-labelledby="track-order-modal-label" aria-hidden="true">
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
                                    </div> -->

                                    

                                    

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
                                                    $modal_counter = 1;
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
                                                                        ";
                                                                        ?>
                                                                        <div class='order-item-title' onclick="location.href='/shop/product/<?php echo $product_id; ?>'" style="cursor: pointer;"><?php echo $name; ?></div>
                                                                        <?php
                                                                        echo "
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
                                                                        <div data-toggle='modal' data-target='#remove-wishlist-modal-$modal_counter'>
                                                                            <span style='font-weight: bold; cursor: pointer;'><img src='/assets/icons/trash.png' alt='' style='height: 22px; padding-right: 10px;' data-toggle='tooltip' data-placement='right' title='Remove from wishlist'>&nbsp; </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        ";


                                                        // Cancel Modal 
                                                        ?>
                                                        <div class="modal fade" id="remove-wishlist-modal-<?php echo $modal_counter; ?>" tabindex="-1" role="dialog" aria-labelledby="remove-wishlist-modal-label" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title font-weight" id="remove-wishlist-modal-label"><?php echo $name; ?></h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to remove it from your wishlist?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="site-btn" data-dismiss="modal">Close</button>
                                                                        <button type="button" class="site-btn" onclick="location.href='/shop/remove_from_wishlist/<?php echo $product_id; ?>'">Remove</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        // increment to the next wishlist item
                                                        $modal_counter++;
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