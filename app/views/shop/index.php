<?php
    $this->view('include/header');

    $products = $model['products'];
    $products_count = count($products);
?>
<title>Browse Products</title>
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
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->




    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <form method="post">
                            <div class="shop__sidebar__search">
                                <input type="text" name="search_query" placeholder="Search...">
                                <button type="submit" name="search_btn"><span class="icon_search"></span></button>

                            </div>
                        
                            
                            <div class="shop__sidebar__accordion">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__categories">
                                                    <ul class="nice-scroll">
                                                        <?php
                                                            // get the category name from the url
                                                            // if it matches the one in the list, highlight it
                                                            $url_category = basename($_SERVER['REQUEST_URI']);

                                                            $categories = $model['categories'];
                                                            foreach($categories as $test) {
                                                                $category_name = $test->category_name;
                                                                $category_name_lower = strtolower($category_name);

                                                                // if url_category matches the category in the list, highlight it
                                                                if($url_category == $category_name_lower) {
                                                                    echo "
                                                                        <li class='active_filter'><a href='/shop/index/filter/category/$category_name_lower'>$category_name</a></li>
                                                                    ";
                                                                }
                                                                else {
                                                                    echo "
                                                                        <li><a href='/shop/index/filter/category/$category_name_lower'>$category_name</a></li>
                                                                    ";
                                                                }
                                                            }
                                                        ?>

                                                    </ul>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                        </div>
                                        <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__brand">
                                                    <ul>

                                                        <?php
                                                            // get the brand name from the url
                                                            // if it matches the one in the list, highlight it
                                                            $url_brand= basename($_SERVER['REQUEST_URI']);
                                                            
                                                            $brands = $model['brands'];
                                                            foreach($brands as $brand) {
                                                                $brand_name = $brand->brand_name;
                                                                $brand_id = $brand->brand_id;

                                                                 // if url_category matches the category in the list, highlight it
                                                                 if($url_brand == $brand_id) {
                                                                    echo "
                                                                        <li class='active_filter'><a href='/shop/index/filter/brand/$brand_id'>$brand_name</a></li>
                                                                    ";
                                                                }
                                                                else {
                                                                    echo "
                                                                        <li><a href='/shop/index/filter/brand/$brand_id'>$brand_name</a></li>
                                                                    ";
                                                                }
                                                            }
                                                        ?>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <!-- <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                        </div>
                                        <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__price">
                                                    <ul>
                                                        <li><a href="#">$0.00 - $50.00</a></li>
                                                        <li><a href="#">$50.00 - $100.00</a></li>
                                                        <li><a href="#">$100.00 - $150.00</a></li>
                                                        <li><a href="#">$150.00 - $200.00</a></li>
                                                        <li><a href="#">$200.00 - $250.00</a></li>
                                                        <li><a href="#">250.00+</a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                        </div>
                                        <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__size">

                                                    <?php
                                                        // get the size name from the url
                                                        // if it matches the one in the list, highlight it
                                                        $url_size= basename($_SERVER['REQUEST_URI']);
                                                    
                                                        $all_si = $model['size'];
                                                        foreach($all_si as $size) {
                                                            
                                                            if($url_size == $size) {
                                                                echo "
                                                                    <li id='$size' class='size_filter active'><a href='/shop/index/filter/size/$size'>$size</a></li>
                                                                ";
                                                            }
                                                            else {
                                                                echo "
                                                                    <li id='$size' class='size_filter'><a href='/shop/index/filter/size/$size'>$size</a></li>
                                                                ";
                                                            }
                                                        }

                                                    ?>    

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                        </div>
                                        <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__color">
                                                    
                                                    <?php
                                                        // get the color name from the url
                                                        // if it matches the one in the list, highlight it
                                                        $url_color= basename($_SERVER['REQUEST_URI']);
                                                    
                                                        $all_color = $model['colors'];
                                                        foreach($all_color as $color) {

                                                            if($url_color == $color) {
                                                                echo "
                                                                    <li id='$color' class='color_filter active' style='background: $color' data-toggle='tooltip' data-placement='top' title='$color'></li>
                                                                ";
                                                            }
                                                            else {
                                                                echo "
                                                                    <li id='$color' class='color_filter' style='background: $color' data-toggle='tooltip' data-placement='top' title='$color'></li>
                                                                ";
                                                            }
                                                        }

                                                    ?>    
                                                    


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                        </div>
                                        <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__tags">

                                                    <?php
                                                    
                                                        
                                                    $all_keyword = $model['keywords'];
                                                    foreach($all_keyword as $keyword) {
                                                        echo "
                                                                <a href='#'>$keyword</a>
                                                        ";
                                                    }

                                                ?>    



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing <?php echo $products_count; ?> products</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select>
                                        <option value="">Low To High</option>
                                        <option value="">$0 - $55</option>
                                        <option value="">$55 - $100</option>
                                    </select>
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
                                                                 <li><a href='#'><img src='/assets/img/icon/heart.png' alt=''></a></li>
                                                                 <li><a href='#'><img src='/assets/img/icon/compare.png' alt=''> <span>Compare</span></a>
                                                                 </li>
                                                                 <!-- To do: make sure to change the product id of each item. Once you loop through the product, just print their id -->
                                                                 <li><a href='/shop/product/1'><img src='/assets/img/icon/search.png' alt=''></a></li>
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
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

<?php
    $this->view('include/footer');
?>