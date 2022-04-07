<?php
    $this->view('include/header');

    // baby registry
    $baby_registry = $model['baby_registry'];
    $baby_reg_title = $baby_registry->name;
    $organizer_name = $baby_registry->organizer_name;
    $delivery_date = $baby_registry->delivery_date;
    $delivery_date = date('d F, Y', strtotime($delivery_date));

    // baby products
    $products = $model['babies_products'];
    $products_count = count($products);

    $token = $model['token'];
?>
<title>Browse Products</title>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/shop">Shop</a></li>
                            <li class="active"><a href="/babyregistry">Baby Registry</a></li>
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
                <div class="col-lg-8">
                    <div class="breadcrumb__text">
                        <h4>Add Products</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <a href="/babyregistry">Baby Registry</a>
                            <span>Add Products</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php 

                    echo "
                        <div>
                            <span>Title: $baby_reg_title</span>
                        </div>    
                        <div>
                            <span>Organizer: $organizer_name</span>
                        </div>
                        <div>
                            <span>Event date: $delivery_date</span>
                        </div>
                    ";

                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->




    <!-- Shop Section Begin -->
    <section class="shop" style="margin-top: 20px; padding-bottom: 20px;">
        <div class="container" style="padding-left: 120px; padding-top: 0px; padding-right: 120px; padding-bottom: 0px;">
            <div class="shop__sidebar">
                <form method="post">
                
                    <div class="shop__sidebar__search authentication_form">
                        <input type="text" name="search_query" placeholder="Search...">
                        <button type="submit" name="search_btn"><span class="icon_search"></span></button>

                    </div>

                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing <?php echo $products_count; ?> products</p>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="row">
                        <?php         

                            if($products_count > 0) {
                                foreach($products as $product)
                                {
                                    $product_id = $product->product_id;
                                    $name = $product->name;
                                    $price = $product->price;

                                    $colors_serialized = unserialize($product->colors);
                                    $colors_array = array_filter($colors_serialized);

                                    $size_serialized = unserialize($product->size);
                                    $size_array = array_filter($size_serialized);
                                    
                                    $image = $product->images;
                                    $images_name = explode(',', $image);
                                    $image_name = $images_name[0];

                                    // baby reg id
                                    $baby_reg_id = $this->model('BabyRegistryToken')->find($token)->baby_registry_id;

                                    $product_exist = $this->model('BabyRegistry')->findByProductId($product_id, $baby_reg_id);
                                    $product_exist_flag = ($product_exist) ? 1 : 0;
                        
                                            echo "
                                                <div class='col-lg-4 col-md-6 col-sm-6'>
                                                    <div class='product__item'>
                                                        ";
                                                        ?>
                                                        <div style="cursor: pointer;" onclick="location.href='/shop/product/<?php echo $product_id; ?>'">
                                                            <?php
                                                            echo "
                                                            <div class='product__item__pic set-bg' data-setbg='/assets/products/images/$image_name'>
                                                                <ul class='product__hover'>
                                                                    <li style='background: #000; color: #fff; padding: 10px 5px;'>
                                                                        ";
                                                                        if($product_exist_flag == 1) {
                                                                            // remove the item from the cart
                                                                            echo "
                                                                                <a href='/babyregistry/remove_from_cart/$token/$product_id' style='color: #fff;'>Remove from registry</a>
                                                                            ";
                                                                        }
                                                                        else {
                                                                            // add the item in the cart
                                                                            echo "
                                                                                <a href='/babyregistry/add_to_registry/$token/$product_id' style='color: #fff;'>Add to registry</a>
                                                                            ";
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
                    
                                }
                            }
                            else {
                                ?>
                                <div class="col-lg-12 text-center">
                                    <div class="text-center" style="margin-top: 20px;">
                                        <h4>No product found!</h4><br>
                                        <button class="site-btn" onclick="location.href='/babyregistry/add_products'">Search Again</button>
                                    </div>

                                </div>
                                <?php
                            }
                        
                            
                        ?>
                    
                    </div>

                </form>    
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

<?php
    $this->view('include/footer');
?>