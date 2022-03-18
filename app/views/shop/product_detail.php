<?php
       $this->view('include/header');

       $product = $model['product'];

        $cart_color = '';
        $cart_size =  '';
        $cart_quantity =  1; // default quantity is 1
        $cart_button_name = "Add to cart";
        $cart_btn_action_name = 'add_to_cart';

        $remove_from_cart_flag = 0;
        if(isset($model['cart_item'])) {
            // for editing a product in product detail page
            $cart_item = $model['cart_item'];

            $cart_color = ucfirst($cart_item->color);
            $cart_size = $cart_item->size;
            $cart_quantity = $cart_item->quantity;
            $cart_button_name = "Update Cart";
            $cart_btn_action_name = 'update_cart';

            $remove_from_cart_flag = 1;
        }
  
       // for product detail page
       $name = $product->name;
       $price = $product->price;
       $description = $product->description;
       $sizes = unserialize($product->size);
       $colors = unserialize($product->colors);
       $images = $product->images;
       $images_array = array_map('trim', explode(',', $images));
   
  
       
   
?>
<title><?php echo $name; ?></title>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li class="active"><a href="/shop">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./about.html">About Us</a></li>
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
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

    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <form method="post">
            <div class="product__details__pic">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__details__breadcrumb">
                                <a href="/">Home</a>
                                <a href="/shop/">Shop</a>
                                <span>Product Details</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <ul class="nav nav-tabs" role="tablist">
                                
                                <?php
                                    $first_image = '';
                                    if(!empty($images_array)) {
                                        $first_image = $images_array[0];
                                    }

                                    echo "
                                        <li class='nav-item'>
                                            <a class='nav-link active' data-toggle='tab' href='#tabs-1' role='tab'>
                                                <div class='product__thumb__pic set-bg' data-setbg='/assets/products/images/$first_image'>
                                                </div>
                                            </a>
                                        </li>
                                    ";  

                                    // if there are more images, show them
                                    if(count($images_array) > 1) {
                                        $counter = 2;
                                        foreach(array_slice($images_array, 1) as $image) {
                                            echo "
                                                <li class='nav-item'>
                                                    <a class='nav-link' data-toggle='tab' href='#tabs-$counter' role='tab'>
                                                        <div class='product__thumb__pic set-bg' data-setbg='/assets/products/images/$image'>
                                                        </div>
                                                    </a>
                                                </li>
                                            ";

                                            $counter++;
                                        }
                                    }
                                ?>
                                
                                
                                
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-9">
                            <div class="tab-content">
                                

                                <?php
                                    $first_image = '';
                                    if(!empty($images_array)) {
                                        $first_image = $images_array[0];
                                    }

                                    echo "
                                        <div class='tab-pane active' id='tabs-1' role='tabpanel'>
                                            <div class='product__details__pic__item'>
                                                <img src='/assets/products/images/$first_image' alt=''>
                                            </div>
                                        </div>
                                    ";  

                                    // if there are more images, show them
                                    if(count($images_array) > 1) {
                                        $counter = 2;
                                        foreach(array_slice($images_array, 1) as $image) {
                                            echo "
                                                <div class='tab-pane' id='tabs-$counter' role='tabpanel'>
                                                    <div class='product__details__pic__item'>
                                                        <img src='/assets/products/images/$image' alt=''>
                                                    </div>
                                                </div>
                                            ";

                                            $counter++;
                                        }
                                    }
                                ?>
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product__details__content">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="product__details__text">
                                <div class="row justify-content-center">
                                    <div class="col-4">
                                        <?php 
                                            if(isset($_SESSION['return-msg'])) {
                                                $return_msg = $_SESSION['return-msg'];
                                                echo "
                                                    <div class='form_error'>
                                                        $return_msg
                                                    </div>
                                                ";

                                                unset($_SESSION['return-msg']);
                                            }
                                        ?>
                                    </div>
                                </div>
                                <h4><?php echo $name; ?></h4>
                            
                                <h3>$<?php echo $price; ?></h3>
                                <input type="hidden" value="<?php echo $price; ?>" name="price">
                                
                                <?php echo html_entity_decode($description); ?>
                                
                                <div class="product__details__option">
                                    <div class="product__details__option__size">
                                        <span>Size:</span>
                                        <?php
                                            $radio_size_counter = 1;
                                            foreach($sizes as $size) {
                                                if($cart_size == $size) {
                                                    echo "
                                                        <label class='active' for='size_ratio_0'>
                                                            <input type='radio' name='size' id='size_ratio_0' value='$size' checked='checked'/> $size
                                                        </label>  
                                                    ";
                                                    ?>
                                                      
                                                    <?php
                                                }
                                                else {
                                                    echo "
                                                        <label for='size_ratio_$radio_size_counter'>
                                                            <input type='radio' name='size' id='size_ratio_$radio_size_counter' value='$size' /> $size
                                                        </label>  
                                                    ";
                                                     
                                                    // increment the ratio counter to move to the next size
                                                    $radio_size_counter++;
                                                }
                                                
                                               
                                                
                                            }
                                        ?>
                                        
                                    </div>
                                    <div class="product__details__option__color">
                                        <span>Color:</span>
                                        <?php
                                            $radio_color_counter = 1;
                                            foreach($colors as $color) {
                                                $color_name = ucfirst($color);
                                            
                                                // check if the cart color matches the color
                                                if($cart_color == $color_name) {
                                                    echo "
                                                        <label class='active' style='background: $color;' for='color_radio_0' data-toggle='tooltip' data-placement='top' title='$color_name'>
                                                            <input type='radio' id='color_radio_0' name='color' checked='checked' value='$color_name'>
                                                        </label>
                                                    ";
                                                }
                                                else {
                                                    echo "
                                                        <label style='background: $color;' for='color_radio_$radio_color_counter' data-toggle='tooltip' data-placement='top' title='$color_name'>
                                                            <input type='radio' id='color_radio_$radio_color_counter' name='color' value='$color_name'>
                                                        </label>
                                                    ";
                                                     
                                                    // increment the ratio counter to move to the next color
                                                    $radio_color_counter++;
                                                }
                                                
                                            }
                                        ?>
                                        
                                    </div>
                                </div>
                                <div class="product__details__cart__option">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" name="quantity" value="<?php echo $cart_quantity; ?>">
                                        </div>
                                    </div>
                                    <button type="submit" name="<?php echo $cart_btn_action_name; ?>" class="site-btn"><?php echo $cart_button_name; ?></button>
                                </div>
                                <div class="product__details__btns__option">
                                    <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                                    <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                                </div>

                                <?php
                                    if($remove_from_cart_flag == 1) {
                                        echo "
                                            <div>
                                                <button type='submit' name='remove_cart' style='color: blue; border: none; background: none;'>Remove from cart</button> 
                                            </div>
                                        ";
                                    }
                                ?>
                            
                            </div>
                        </div>
                    </div>

                    <hr>
                    <!-- TODO: sprint 3 -->
                    <!-- <div class="row">
                        <div class="col-lg-12">
                            <div class="product__details__tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                        role="tab">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                        Previews(5)</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                        information</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                        <div class="product__details__tab__content">
                                            <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                                solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                                ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                            pharetras loremos.</p>
                                            <div class="product__details__tab__content__item">
                                                <h5>Products Infomation</h5>
                                                <p>A Pocket PC is a handheld computer, which features many of the same
                                                    capabilities as a modern PC. These handy little devices allow
                                                    individuals to retrieve and store e-mail messages, create a contact
                                                    file, coordinate appointments, surf the internet, exchange text messages
                                                    and more. Every product that is labeled as a Pocket PC must be
                                                    accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                                <p>As is the case with any new technology product, the cost of a Pocket PC
                                                    was substantial during it’s early release. For approximately $700.00,
                                                    consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                    These days, customers are finding that prices have become much more
                                                    reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                            </div>
                                            <div class="product__details__tab__content__item">
                                                <h5>Material used</h5>
                                                <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                    from synthetic materials, not natural like wool. Polyester suits become
                                                    creased easily and are known for not being breathable. Polyester suits
                                                    tend to have a shine to them compared to wool and cotton suits, this can
                                                    make the suit look cheap. The texture of velvet is luxurious and
                                                    breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-6" role="tabpanel">
                                        <div class="product__details__tab__content">
                                            <div class="product__details__tab__content__item">
                                                <h5>Products Infomation</h5>
                                                <p>A Pocket PC is a handheld computer, which features many of the same
                                                    capabilities as a modern PC. These handy little devices allow
                                                    individuals to retrieve and store e-mail messages, create a contact
                                                    file, coordinate appointments, surf the internet, exchange text messages
                                                    and more. Every product that is labeled as a Pocket PC must be
                                                    accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                                <p>As is the case with any new technology product, the cost of a Pocket PC
                                                    was substantial during it’s early release. For approximately $700.00,
                                                    consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                    These days, customers are finding that prices have become much more
                                                    reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                            </div>
                                            <div class="product__details__tab__content__item">
                                                <h5>Material used</h5>
                                                <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                    from synthetic materials, not natural like wool. Polyester suits become
                                                    creased easily and are known for not being breathable. Polyester suits
                                                    tend to have a shine to them compared to wool and cotton suits, this can
                                                    make the suit look cheap. The texture of velvet is luxurious and
                                                    breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-7" role="tabpanel">
                                        <div class="product__details__tab__content">
                                            <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                                solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                                ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                            pharetras loremos.</p>
                                            <div class="product__details__tab__content__item">
                                                <h5>Products Infomation</h5>
                                                <p>A Pocket PC is a handheld computer, which features many of the same
                                                    capabilities as a modern PC. These handy little devices allow
                                                    individuals to retrieve and store e-mail messages, create a contact
                                                    file, coordinate appointments, surf the internet, exchange text messages
                                                    and more. Every product that is labeled as a Pocket PC must be
                                                    accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                                <p>As is the case with any new technology product, the cost of a Pocket PC
                                                    was substantial during it’s early release. For approximately $700.00,
                                                    consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                    These days, customers are finding that prices have become much more
                                                    reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                            </div>
                                            <div class="product__details__tab__content__item">
                                                <h5>Material used</h5>
                                                <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                    from synthetic materials, not natural like wool. Polyester suits become
                                                    creased easily and are known for not being breathable. Polyester suits
                                                    tend to have a shine to them compared to wool and cotton suits, this can
                                                    make the suit look cheap. The texture of velvet is luxurious and
                                                    breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </form>
    </section>
    <!-- Shop Details Section End -->


    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="/assets/img/footer-logo.png" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                        <a href="#"><img src="/assets/img/payment.png" alt=""></a>
                    </div>
                </div>
          
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            SOEN 341 - Mini Amazon
                           
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
   
    <script src="/js/jquery.nice-select.min.js"></script>
    <script src="/js/jquery.nicescroll.min.js"></script>
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/jquery.countdown.min.js"></script>
    <script src="/js/jquery.slicknav.js"></script>
    <script src="/js/mixitup.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/main.js"></script>
</body>

</html>