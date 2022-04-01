<?php
    $this->view('include/header');
?>
<title>Login</title>

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
            <div class="row d-flex justify-content-center authentication_form">
                <div class="col-lg-6">
                    <div class="blog__details__content">
                        <form method="post">

                            <h6 class="checkout__title">Login</h6>

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

                                if(isset($_SESSION['successful_account_creation_msg'])) {
                                    $msg = $_SESSION['successful_account_creation_msg'];
                                    echo "
                                        <div class='form_success'>
                                            $msg
                                        </div>
                                    ";
                                }

                                // user login before they add to cart
                                if(isset($_SESSION['login_flag'])) {
                                    echo "
                                        <div class='form_success'>
                                            You must login first
                                        </div>
                                    ";

                                    // unset the session variable
                                    unset($_SESSION['login_flag']);
                                }
                            ?>
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="text" name="email" id="email" required>
                            </div>

                            <div class="checkout__input">
                                <p>Password<span>*</span></p>
                                <input type="password" name="password" id="password" required>
                            </div>
                            
                            <div class="row d-flex justify-content-center">
                                <button type="submit" name="login" class="site-btn col-lg-10 col-md-10">Login</button>
                            </div>
                            
                            <div class="text_with_href text_center">
                                Want to create an account? <a href="/account/signup">Sign Up</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

<?php
    $this->view('include/footer');
?>