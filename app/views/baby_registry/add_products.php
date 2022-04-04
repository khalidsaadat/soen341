<?php
    $this->view('include/header');

    $products = $model['babies_products'];
    $products_count = count($products);
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
                        <h4>Add Products</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <a href="/babyregistry">Baby Registry</a>
                            <span>Add Products</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->




    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container" style="padding-left: 120px; padding-top: 0px; padding-right: 120px; padding-bottom: 0px;">
            
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
                                                                <a href='/babyregistry/add_to_registry/$product_id'>Add to registry</a>
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
                                <button class="site-btn" onclick="location.href='/shop'">Continue Shopping</button>
                            </div>

                        </div>
                        <?php
                    }
                
                    
                ?>
            
            </div>


        </div>
    </section>
    <!-- Shop Section End -->

<?php
    $this->view('include/footer');
?>