<?php
    $this->view('include/header');
?>
<title>Checkout</title>
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
                        <a href="/account" id="myaccount_wishlist"><img src="/assets/img/icon/heart.png" alt=""></a>
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
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Check Out</span>
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
            
            
            <?php
                // global cart item modal
                $cart_items = $model['cart_items'];
                

                if(!isset($_SESSION['user_id'])) {
                    ?>
                    <div class="text-center">
                        <h3>Login to view your cart</h3>
                        <div style="margin-top: 15px;">
                            <button class="site-btn" onclick="location.href='/account/login'">Login</button>
                        </div>
                    </div>
                    <?php
                }
                elseif(count($cart_items) == 0) {
                    ?>
                    <div class="text-center">
                        <h3>Your cart is empty</h3>
                        <h5>Shop around to purchase your favorite products</h5>
                        <div style="margin-top: 15px;">
                            <button class="site-btn" onclick="location.href='/shop'">Shop</button>
                        </div>
                    </div>
                    <?php  
                }
                else {
                    ?>
                    <div class="checkout__form">
                        <form method="post">
                            <div class="row">
                                <div class="col-lg-8 col-md-6">
                                    <?php
                                        // global return msg variable
                                        $return_msg = '';

                                        // Card Number Check 
                                        // get the error model if any
                                        if(isset($model['ccError'])) {
                                            $ccError = $model['ccError'];
                                            if($ccError == 'invalid') {
                                                // <span class='error'>* Credit Card Invalid.</span>
                                                $return_msg .= 'Invalid Credit Card.<br>';
                                            }
                                        }

                                        // CVV Check 
                                        // get the error model if any
                                        if(isset($model['cvvError'])) {
                                            $cvvError = $model['cvvError'];
                                            if($cvvError == 'invalid') {
                                                // <span class='error'>* CVV Invalid.</span>
                                                $return_msg .= 'Invalid CVC.<br>';
                                            }
                                        } 

                                        // Expiry Check 
                                        // get the error model if any
                                        if(isset($model['expError'])) {
                                            $expError = $model['expError'];
                                            if($expError == 'invalid') {
                                                // <span class='error'>* Card Expired.</span>
                                                $return_msg .= 'Expired Card.<br>';
                                            }
                                        }   

                                        // Success msg
                                        if(isset($_SESSION['success-msg'])) {
                                            $msg = $_SESSION['success-msg'];
                                            
                                            $return_msg .= $msg;
                                            
                                            unset($_SESSION['success-msg']);
                                        }

                                        // Print global return msg
                                        if(strlen($return_msg) > 0) {
                                            echo "
                                                <div class='form_error'>
                                                    $return_msg
                                                </div>
                                            ";
                                        }
                                        
                                    ?>
                                    
                                    <h6 class="checkout__title">Billing Details</h6>      
                                    <div class="row" style="margin-bottom: 20px;">
                                        <div class="col-lg-12">
                                            <div style="background: #e1e5ee; padding: 5px 10px;">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <span style="font-size: 16px; font-weight: bold;">
                                                            Your delivery address:
                                                        </span> 
                                                    </div>
                                                    <div class="col-md-2 text-right" style="font-size: 14px; cursor: pointer;" data-toggle="modal" data-target="#change-address-modal">
                                                        <span class="icon_pencil"  style="cursor: pointer;"></span> 
                                                        <span style="color: #2a324b;">Change</span>
                                                    </div>

                                                </div>
                                                <div style="padding-top: 10px;">
                                                    <?php
                                                        if(isset($model['primary_address'])) {

                                                            $primary_address = $model['primary_address'];
                                                            $p_full_address = $primary_address->street . ', ' . $primary_address->city . ', ' . $primary_address->province . ', ' . $primary_address->postal_code . ', ' . $primary_address->country;
                                                            
                                                            echo "
                                                                <input type='radio' id='primary' name='address' checked='checked'> <label for='primary'>$p_full_address</label> <br>
                                                            ";
                                                        }

                                                        if(isset($model['secondary_address'])) {
                                                            $secondary_address = $model['secondary_address'];
                                                            $s_full_address = $secondary_address->street . ', ' . $secondary_address->city . ', ' . $secondary_address->province . ', ' . $secondary_address->postal_code . ', ' . $secondary_address->country;
                                                        }
                                                    ?>
                                                                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Change Address Modal -->
                                    <div class="modal fade" id="change-address-modal" tabindex="-1" role="dialog" aria-labelledby="change-address-modal-label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title font-weight" id="change-address-modal-label">Select Your Delivery Address</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                            <div class="modal-body">
                                                                
                                                                    <span style="font-size: 18px;">Your current delivery address is: </span>    
                                                                    <div style="padding-left: 10px; font-style: italic; font-weight: bold;">
                                                                        <?php echo $p_full_address; ?>
                                                                    </div>

                                                                    <hr>
                                                                    <div>
                                                                        <span style="font-size: 18px;">Available addresses to select: </span>
                                                                        <div style="padding-left: 10px;">
                                                                            <?php
                                                                                echo "
                                                                                    <input type='radio' id='p_address' name='change_address' value='$primary_address->address_id' checked='checked'> <label for='p_address'>$p_full_address</label> <br>
                                                                                    <input type='radio' id='s_address' name='change_address' value='$secondary_address->address_id'> <label for='s_address'>$s_full_address</label> <br>
                                                                                ";
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div>
                                                                        Want to update your address? Click <a href="/account" style="color: blue;">here</a>
                                                                    </div>
                                                            
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="site-btn" data-dismiss="modal">Close</button>
                                                                <button type="submit"  name="update_address" class="site-btn">Confirm Changes</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                    <h6 class="checkout__title">Payment <span style="float:right"><a href="#"><img src="../malefashion/img/payment.png" alt=""></a></span></h6>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="checkout__input"> 
                                                                                
                                                <p>Credit/Debit Card<span>*</span></p>
                                                    <select name="cvvType" style= "position: absolute; left:222px; border: 1px solid #e5e5e5;">
                                                        <option value="Type" disabled>Select Type</option>
                                                        <option value="American">American Express</option>
                                                        <option value="Discover">Discover</option>
                                                        <option value="Master">Master Card</option>
                                                        <option value="Visa">Visa</option>
                                                    </select>       
                                                    <input type="text" name="credit_card_num" placeholder="&#128179; Card Number">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">                                  
                                            <div class="checkout__input">
                                                <p>Cardholder Name<span>*</span></p>                                       
                                                <input type="text" name="card_holder_name" placeholder="Name on Card">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Expiration Date<span>*</span></p>
                                                <input type="text" name="expiry_date" placeholder="MM/YY">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Security Code<span>*</span></p>
                                                <input type="text" name="cvv" placeholder="CVC">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="checkout__order">
                                        <h4 class="order__title">Your order</h4>
                                        <?php
                                            // success wishlist added msg
                                            if(isset($_SESSION['wishlist_added'])) {
                                                echo "
                                                    <div class='form_error'>
                                                        Product added to wishlist
                                                    </div>
                                                ";
                                            }

                                            unset($_SESSION['wishlist_added']);

                                            // success wishlist removed msg
                                            if(isset($_SESSION['wishlist_removed'])) {
                                                echo "
                                                    <div class='form_error'>
                                                        Product removed from wishlist
                                                    </div>
                                                ";
                                            }

                                            unset($_SESSION['wishlist_removed']);

                                            // success cart removed msg
                                            if(isset($_SESSION['cart_removed'])) {
                                                echo "
                                                    <div class='form_error'>
                                                        Product removed from your cart
                                                    </div>
                                                ";
                                            }

                                            unset($_SESSION['cart_removed']);
                                        ?>
                                        
                                        <div class="checkout__order__products">Product <span>Total</span></div>
                                        <ul class="checkout__total__products">
                                            
                                        <?php
                                                $subtotal = 0;
                                                $tax_percentage = 14.975;
                                                $tax_amount = 0;
                                                $total = 0;

                                                $counter = 1;
                                                foreach($cart_items as $item) {
                                                    $product_id = $item->product_id;
                                                    $product = $this->model('Product')->find($product_id);
                                                    $name = $product->name;

                                                    $price = $product->price;
                                                    $quantity = $item->quantity;
                                                    $total_price = $price * $quantity;

                                                    $color = $item->color;
                                                    $size = $item->size;

                                                    // add to subtotal
                                                    $subtotal += $total_price;

                                                    // check wishlist table and show heart icon if the product is in the wishlist
                                                    $in_wishlist_flag = ($this->model('Wishlist')->isInWishList($product_id, $_SESSION['user_id'])) ? true : false;
                                                    
                                                    echo "
                                                        <li class='font-weight-bold'>$counter. $name
                                                            <span style='cursor: pointer;'> 
                                                                ";
                                                                if($in_wishlist_flag) {
                                                                    ?>
                                                                        <span class='icon_heart' data-toggle='tooltip' data-placement='right' title='Remove from wishlist' onclick="location.href='/shop/remove_from_wishlist/<?php echo $product_id; ?>'" style='margin-left: 10px;'></span>
                                                                    <?php
                                                                }
                                                                else {
                                                                    ?>
                                                                        <span class='icon_heart_alt' data-toggle='tooltip' data-placement='right' title='Add to wishlist' onclick="location.href='/shop/add_to_wishlist/<?php echo $product_id; ?>'" style='margin-left: 10px;'></span>
                                                                    <?php
                                                                }
                                                                ?>                                                                
                                                                <span class='icon_pencil' data-toggle='tooltip' data-placement='bottom' title='Edit' onclick="location.href='/shop/product/<?php echo $product_id; ?>/edit'"></span> 
                                                                <?php
                                                                echo "
                                                            </span>
                                                            <div>
                                                                <span style='float: left; font-style: italic; font-weight: normal;'>$ $total_price</span> 
                                                                
                                                                <span style='float: left; margin-left: 10px; font-weight: normal;'>|</span>
                                                                <span style='float: left; margin-left: 10px; font-weight: normal;'>Qty: $quantity</span>
                    
                                                                <span style='float: left; margin-left: 10px; font-weight: normal;'>|</span>
                                                                <span style='float: left; margin-left: 10px; font-weight: normal;'>Size: $size</span>
                    
                                                                <span style='float: left; margin-left: 10px; font-weight: normal;'>|</span>
                                                                <span class='product__details__option__color checkout-color' style='float: left; margin-left: 10px; top: 2px; font-weight: normal;'>
                                                                    <label style='background: $color;' for='sp-1' data-toggle='tooltip' data-placement='top' title='$color'>
                                                                        <input type='radio' id='sp-1'>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                        </li>
                                                    ";

                                                    $counter++;
                                                }

                                                // calculating the total amount
                                                $tax_amount = $subtotal * ($tax_percentage / 100);
                                                $tax_amount = number_format($tax_amount, 2);

                                                $total = $tax_amount + $subtotal;
                                                $total = number_format($total, 2);
                                            ?>
                                            
                                            
                                        </ul>
                                        <ul class="checkout__total__all">
                                            <li>Subtotal <span>$<?php echo $subtotal; ?></span></li>
                                            <li>Tax (<?php echo $tax_percentage; ?>%) <span>$<?php echo $tax_amount; ?></span></li>
                                            <li>Total <span>$<?php echo $total; ?></span></li>
                                        </ul>
                                        <p>
                                            <?php
                                                $start    = new DateTime('today');
                                                $interval = new DateInterval('P3W');
                                                $period   = new DatePeriod($start, $interval, 1, DatePeriod::EXCLUDE_START_DATE);
                                                foreach($period as $deliveryDate) {
                                                    echo "Expected Delivery Date: " . $deliveryDate->format('d-m-Y');
                                                }
                                            ?>
                                        </p>
                                        <div class="checkout__input__checkbox">
                                            <label for="acc-or">
                                                Add as a gift?
                                                <input type="checkbox" id="acc-or">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <p>Thank you for shopping with us! We hope you enjoyed the shopping experience.</p>
                                        <button type="submit" class="site-btn" name="review_cart">PLACE ORDER</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                }
            ?>

        </div>
    </section>
    <!-- Checkout Section End -->

<?php
    $this->view('include/footer');
?>