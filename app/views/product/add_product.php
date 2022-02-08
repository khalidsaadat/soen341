<?php
    $this->view('include/header');
?>
<title>Add a Product</title>

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


    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form authentication_form product_creation">
                <form method="post">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            
                            <h6 class="checkout__title">Add a new product</h6>

                            <?php
                                // if there is an error message from the server
                                if(isset($model['error'])) {
                                    $error_msg = $model['error'];
                                    echo "
                                        <div class='form_error'>
                                            $error_msg
                                        </div>
                                    ";
                                }
                            ?>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Name<span>*</span></p>
                                        <input type="text" name="first_name" id="first_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Brand<span>*</span></p>
                                        <input type="text" name="last_name" id="last_name" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Price<span>*</span></p>
                                        <input type="text" name="phone_number" id="phone_number" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Quantity<span>*</span></p>
                                        <input type="text" name="email" id="email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                   <div class="row">
                                       <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Size(s)<span>*</span></p>
                                                <select class="selectpicker txt-black" multiple title=" ">
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>L</option>
                                                    <option>XL</option>
                                                </select>
                                            </div>
                                       </div>
                                       <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Color(s)<span>*</span> <span class="label-sub">(Separate by comma)</span></p>
                                                <input type="password" name="confirm_password" id="confirm_password" required>
                                            </div>
                                       </div>
                                   </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                       <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Brand<span>*</span></p>
                                                <select class="selectpicker txt-black" multiple data-live-search="true" data-max-options="1" title=" ">
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>L</option>
                                                    <option>XL</option>
                                                </select>
                                            </div>
                                       </div>
                                       <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Color(s)<span>*</span> <span class="label-sub">(Separate by comma)</span></p>
                                                <input type="password" name="confirm_password" id="confirm_password" required>
                                            </div>
                                       </div>
                                   </div>
                                </div>
                            </div>

                            <hr>
                      
                            <button type="submit" name="create" class="site-btn">Create</button>
                   
                        </div>

                        
                       
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

<?php
    $this->view('include/footer');
?>