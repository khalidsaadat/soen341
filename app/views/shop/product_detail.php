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
                            <li><a href="/babyregistry">Baby Registry</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        
                        <a href="/shop/checkout"><img src="/assets/img/icon/cart.png" alt=""> <span><?php echo $_SESSION['cart_items_count']; ?></span></a>
                        <div class="price">$<?php echo $_SESSION['cart_items_price']; ?></div>
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
                                                            <input type='radio' name='size' id='size_ratio_$radio_size_counter' value='$size' required/> $size
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
                                                            <input type='radio' id='color_radio_$radio_color_counter' name='color' value='$color_name' required>
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
                                    <?php

                                        $role = '';
                                        if(isset($_SESSION['role'])) {
                                            $role = $_SESSION['role'];
                                        }

                                        // admin should not be able to buy products
                                        if($role != 'admin') {
                                            // Users should not be able to add a new baby registry's product to cart if there is already another baby registry's product in the cart
                                            // Except the existing baby registry can add the products
                                            $existing_product = $this->model('Cart')->getAllForBabyRegistries();
                                            $existing_product_baby_reg_id = '';
                                            if($existing_product) 
                                                $existing_product_baby_reg_id = $existing_product->baby_reg_id;
    
                                            $existing_product_flag = ($existing_product) ? 1 : 0;
    
                                            if($existing_product_flag == 1) {
                                                echo "
                                                    <a href='#' data-toggle='modal' data-target='#existing-modal' class='site-btn'>$cart_button_name</a>
                                                ";
                                            }
                                            else {
                                                echo "
                                                    <button type='submit' name='$cart_btn_action_name' class='site-btn'>$cart_button_name</a>
                                                ";
                                            }
                                        }

                                    ?>
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
                                
                    <!-- existing products modal -->
                    <?php 
                        $cart_item_count = $_SESSION['cart_items_count'];
                        $items_text = ($cart_item_count > 1) ? 'items' : 'item';
                        
                        echo "
                            <div class='modal fade' id='existing-modal' tabindex='-1' role='dialog' aria-labelledby='existing-modal-label' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered' role='document'>
                                    <form method='post'>
        
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <span class='badge badge-warning' style='font-size: 15px;'>Attention!</span>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                                </button>
                                            </div>
                                            <div class='modal-body'>
                                                You already have <span style='font-weight: bold;'>$cart_item_count</span> $items_text in your cart from another baby registry or personal shop. <br><br>
                                                <div>
                                                    Kindly, checkout the current items or remove them to continue.
                                                </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='site-btn' data-dismiss='modal'>Close</button> 
                                            </div>
                                        </div>
        
                                    </form>
                                </div>
                            </div>
                        ";
                    ?>

                    <hr>
                    
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