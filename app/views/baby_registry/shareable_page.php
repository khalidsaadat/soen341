<?php

use Symfony\Component\VarDumper\VarDumper;

    $this->view('include/header');

    // Baby registry info
    $baby_registry = $model['baby_registry'];

    $organizer_name = $baby_registry->organizer_name;
    $delivery_date = $baby_registry->delivery_date;
    $description = $baby_registry->description;
    $delivery_date = date('d F, Y', strtotime($delivery_date));
    $product_ids = unserialize($baby_registry->product_ids);

    $products_count = (($product_ids)) ? count($product_ids) : 0;
    
    // to get the token from the url
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);

    $token = end($uri_segments);
    
    
?>
<title>Browse Products</title>
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
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h4><?php echo $organizer_name; ?>'s Baby Registry</h4>
                        <div>
                            Event date: <?php echo $delivery_date; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->




    <!-- Shop Section Begin -->
    <section class="shop " style="margin-top: 10px;">
        <div class="container" style="padding-left: 150px; padding-top: 10px; padding-right: 150px; padding-bottom: 10px;">
            
            <div class="shop__product__option">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="shop__product__option__left">
                            <div>
                                <span style="font-size: 20px; ">
                                    A message from <?php echo $organizer_name; ?>:
                                </span>
                            </div>
                            <p style="font-style: italic;">
                                <span style="font-size: 25px; color: #ccc;">"</span>
                                <?php echo $description; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <?php
                            if(isset($_SESSION['return-msg'])) {
                                $error_msg = $_SESSION['return-msg'];
                                echo "
                                    <div class='form_error'>
                                        $error_msg
                                    </div>
                                ";

                                unset($_SESSION['return-msg']);
                            }
                        ?>
                        <hr>
                        <div class="row">
                            <?php
                                if($products_count > 0) {
                                    $modal_counter = 1;
                                    foreach($product_ids as $product_id)
                                    {
                                        $user_id = $_SESSION['user_id'];

                                        $product = $this->model('Product')->find($product_id);
                                        $name = $product->name;
                                        $price = $product->price;
            
                                        $colors_serialized = unserialize($product->colors);
                                        $colors_array = array_filter($colors_serialized);
            
                                        $size_serialized = unserialize($product->size);
                                        $size_array = array_filter($size_serialized);
                                        
                                        $image = $product->images;
                                        $images_name = explode(',', $image);
                                        $image_name = $images_name[0];

                                        // baby registry id
		                                $baby_registry_id = $this->model('BabyRegistryToken')->find($token)->baby_registry_id;

                                        // check if the product is already in the cart
                                        $cart_exist = $this->model('Cart')->findByProductIdByUserIdByRegId($product_id, $user_id, $baby_registry_id);
                                        $cart_exist_flag = ($cart_exist) ? 1 : 0;

                                        // Users should not be able to add a new baby registry's product to cart if there is already another baby registry's product in the cart
                                        // Except the existing baby registry can add the products
                                        $existing_baby_product = $this->model('Cart')->getAllForBabyRegistries();
                                        $existing_product_baby_reg_id = '';
                                        if($existing_baby_product) 
                                            $existing_product_baby_reg_id = $existing_baby_product->baby_reg_id;

                                        $existing_baby_product_flag = ($existing_baby_product) ? 1 : 0;

                                        // Users should not be able to add to cart if there is already another item from user's personal shop
                                        $existing_shop_product = $this->model('Cart')->getAllForUserPersonal($user_id);
                                        $existing_shop_product_flag = ($existing_shop_product) ? 1 : 0;
                                        
                            
                                        echo "
                                            <div class='col-lg-4 col-md-6 col-sm-6'>
                                                <div class='product__item'>
                                                    ";
                                                    if($existing_baby_product_flag == 1 OR $existing_shop_product_flag == 1) {
                                                        echo "
                                                            <div style='cursor: pointer;'>
                                                        ";
                                                    }
                                                    else {
                                                        ?>
                                                        <div style="cursor: pointer;" onclick="location.href='/shop/product/<?php echo $product_id; ?>'">
                                                        <?php
                                                    }
                                                    ?>
                                                        <?php
                                                        echo "
                                                        <div class='product__item__pic set-bg' data-setbg='/assets/products/images/$image_name'>
                                                            <ul class='product__hover'>
                                                                <li style='background: #000; color: #fff; padding: 10px 5px;'>
                                                                    ";
                                                                    if($cart_exist_flag == 1) {
                                                                        // remove the item from the cart
                                                                        echo "
                                                                            <a href='/babyregistry/remove_from_cart/$token/$product_id' style='color: #fff;'>Remove from cart</a>
                                                                        ";
                                                                    }
                                                                    else {
                                                                        // Warning: user should be informed that they cannot add a new product because of the existing products belong to another baby reg
                                                                        if($existing_baby_product_flag == 1 && $existing_product_baby_reg_id == $baby_registry_id) {
                                                                            // for existing baby registry's products
                                                                            echo "
                                                                                <a href='/babyregistry/add_to_cart/$token/$product_id' style='color: #fff;'>Add to cart</a>
                                                                            ";
                                                                        }
                                                                        elseif($existing_baby_product_flag == 1 && $existing_product_baby_reg_id != $baby_registry_id) {
                                                                            // do not allow other baby registry's products to be added
                                                                            echo "
                                                                                <a href='#' data-toggle='modal' data-target='#existing-modal-$modal_counter' style='color: #fff;'>Add to cart</a>
                                                                            ";
                                                                        }
                                                                        elseif($existing_shop_product_flag == 1) {
                                                                            // do not allow other baby registry's products to be added
                                                                            echo "
                                                                                <a href='#' data-toggle='modal' data-target='#existing-modal-$modal_counter' style='color: #fff;'>Add to cart</a>
                                                                            ";
                                                                        }
                                                                        else {
                                                                            // when there is nothing in the cart from any baby registeries
                                                                            echo "
                                                                                <a href='/babyregistry/add_to_cart/$token/$product_id' style='color: #fff;'>Add to cart</a>
                                                                            ";
                                                                        }
                                                                        
                                                                    }
                                                                    echo "
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class='product__item__text'>
                                                        <h6>$name</h6>
                                                        
                                                        <h5>$$price</h5>
    
                                                        <div class='product__color__select'>
                                                            ";
                                                            $radio_color_counter = 1;
                                                            foreach($colors_array as $color) {
                                                                echo "
                                                                    <label class='active' for='pc-6_$radio_color_counter' style='background:$color;' data-toggle='tooltip' data-placement='top' title='$color'>
                                                                        <input type='radio' name='color' id='pc-6_$radio_color_counter' value='$color'>
                                                                    </label>
                                                                ";
                                                                $radio_color_counter++;
                                                            }
                                                            echo"
                                                        </div>
    
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        ";
                                        
                                        $cart_item_count = $_SESSION['cart_items_count'];
                                        $items_text = ($cart_item_count > 1) ? 'items' : 'item';
                                        echo "
                                            <div class='modal fade' id='existing-modal-$modal_counter' tabindex='-1' role='dialog' aria-labelledby='existing-modal-label' aria-hidden='true'>
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

                                        $modal_counter++;
                        
                                    }
                                }
                                else {
                                    ?>
                                    <div class="col-lg-12 text-center">
                                        <div class="text-center" style="margin-top: 20px;">
                                            <h4>No product found in this baby registry</h4><br>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
    <!-- Shop Section End -->

<?php
    $this->view('include/footer');
?>