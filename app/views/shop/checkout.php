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
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-8 col-md-6">
                                
                                    <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                                    here</a> to enter your code</h6>
                                    <h6 class="checkout__title">Billing Details</h6>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Fist Name<span>*</span></p>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Last Name<span>*</span></p>
                                                <input type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="checkout__input">
                                        <p>Country<span>*</span></p>
                                        <input type="text">
                                    </div>
                                    <div class="checkout__input">
                                        <p>Address<span>*</span></p>
                                        <input type="text" placeholder="Street Address" class="checkout__input__add">
                                        <input type="text" placeholder="Apartment, suite, unite ect (optinal)">
                                    </div>
                                    <div class="checkout__input">
                                        <p>Town/City<span>*</span></p>
                                        <input type="text">
                                    </div>
                                    <div class="checkout__input">
                                        <p>Country/State<span>*</span></p>
                                        <input type="text">
                                    </div>
                                    <div class="checkout__input">
                                        <p>Postcode / ZIP<span>*</span></p>
                                        <input type="text">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Phone<span>*</span></p>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Email<span>*</span></p>
                                                <input type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="acc">
                                            Create an account?
                                            <input type="checkbox" id="acc">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>Create an account by entering the information below. If you are a returning customer
                                        please login at the top of the page</p>
                                    </div>
                                    <div class="checkout__input">
                                        <p>Account Password<span>*</span></p>
                                        <input type="text">
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="diff-acc">
                                            Note about your order, e.g, special noe for delivery
                                            <input type="checkbox" id="diff-acc">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input">
                                        <p>Order notes<span>*</span></p>
                                        <input type="text"
                                        placeholder="Notes about your order, e.g. special notes for delivery.">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="checkout__order">
                                        <h4 class="order__title">Your order</h4>
                                        <div class="checkout__order__products">Product <span>Total</span></div>
                                        <ul class="checkout__total__products">
                                            
                                        <?php
                                                
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


                                                    echo "
                                                        <li class='font-weight-bold'>$counter. $name
                                                            <span style='cursor: pointer;'> 
                                                                <span class='icon_heart' data-toggle='tooltip' data-placement='bottom' title='Add to wishlist' style='margin-left: 10px;'></span>
                                                                ";
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
                                            ?>
                                            
                                            
                                        </ul>
                                        <ul class="checkout__total__all">
                                            <li>Subtotal <span>$750.99</span></li>
                                            <li>Total <span>$750.99</span></li>
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
                                        <button type="submit" class="site-btn">PLACE ORDER</button>
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