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
                        <div class="shop__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
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
                                                    <!-- <li><a href="#">Men (20)</a></li>
                                                    <li><a href="#">Women (20)</a></li>
                                                    <li><a href="#">Bags (20)</a></li>
                                                    <li><a href="#">Clothing (20)</a></li>
                                                    <li><a href="#">Shoes (20)</a></li>
                                                    <li><a href="#">Accessories (20)</a></li>
                                                    <li><a href="#">Kids (20)</a></li>
                                                    <li><a href="#">Kids (20)</a></li>
                                                    <li><a href="#">Kids (20)</a></li> -->

                                                    <?php
                                                        $categories = $model['categories'];

                                                        foreach($categories as $test) {
                                                            $category_name = $test->category_name;
                                                          
                                                            echo "
                                                                <li><a href='#'>$category_name</a></li>
                                                            ";
                                                        }
                                                    ?>



                                                </ul>
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
                                                    <!-- <li><a href="#">Louis Vuitton</a></li>
                                                    <li><a href="#">Chanel</a></li>
                                                    <li><a href="#">Hermes</a></li>
                                                    <li><a href="#">Gucci</a></li> -->

                                                    <?php
                                                        $brands = $model['brands'];

                                                        foreach($brands as $test) {
                                                            $brand_name = $test->brand_name;
                                                          
                                                            echo "
                                                                <li><a href='#'>$brand_name</a></li>
                                                            ";
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
                                                <!-- <label for="xs">xs
                                                    <input type="radio" id="xs">
                                                </label>
                                                <label for="sm">s
                                                    <input type="radio" id="sm">
                                                </label>
                                                <label for="md">m
                                                    <input type="radio" id="md">
                                                </label>
                                                <label for="xl">xl
                                                    <input type="radio" id="xl">
                                                </label>
                                                <label for="2xl">2xl
                                                    <input type="radio" id="2xl">
                                                </label>
                                                <label for="xxl">xxl
                                                    <input type="radio" id="xxl">
                                                </label>
                                                <label for="3xl">3xl
                                                    <input type="radio" id="3xl">
                                                </label>
                                                <label for="4xl">4xl
                                                    <input type="radio" id="4xl">
                                                </label> -->

                                                <?php
                                                 
                                                    
                                                    $all_si = $model['size'];
                                                    foreach($all_si as $sizes) {
                                                        echo "
                                                            <label for='sm'>$sizes
                                                                 <input type='radio' id='sm'>
                                                            </label>
                                                        ";
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
                                                <!-- <label class="c-1" for="sp-1">
                                                    <input type="radio" id="sp-1">
                                                </label>
                                                <label class="c-2" for="sp-2">
                                                    <input type="radio" id="sp-2">
                                                </label>
                                                <label class="c-3" for="sp-3">
                                                    <input type="radio" id="sp-3">
                                                </label>
                                                <label class="c-4" for="sp-4">
                                                    <input type="radio" id="sp-4">
                                                </label>
                                                <label class="c-5" for="sp-5">
                                                    <input type="radio" id="sp-5">
                                                </label>
                                                <label class="c-6" for="sp-6">
                                                    <input type="radio" id="sp-6">
                                                </label>
                                                <label class="c-7" for="sp-7">
                                                    <input type="radio" id="sp-7">
                                                </label>
                                                <label class="c-8" for="sp-8">
                                                    <input type="radio" id="sp-8">
                                                </label>
                                                <label class="c-9" for="sp-9">
                                                    <input type="radio" id="sp-9">
                                                </label> -->
                                                
                                                <?php
                                                   
                                                    
                                                    $all_color = $model['colors'];
                                                    foreach($all_color as $color) {
                                                        echo "
                                                            <label style='background: $color;' for='sp-2'>
                                                                <input type='radio' id='sp-2'>
                                                            </label>
                                                        ";
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
                                                <!-- <a href="#">Product</a>
                                                <a href="#">Bags</a>
                                                <a href="#">Shoes</a>
                                                <a href="#">Fashio</a>
                                                <a href="#">Clothing</a>
                                                <a href="#">Hats</a>
                                                <a href="#">Accessories</a> -->

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
                                                    <a href='#' class='add-cart'>+ Add To Cart</a>

                                                <form method='post' id='add_to_cart_form'>
                                                    <input type='hidden' name='product_id' id='product_id' value=$product_id>
                                                    <input type='submit' class='add-cart' value='+ Add To Cart' name='add_to_cart' id='add_to_cart'>
                                                    <h5>$$price</h5>

                                                    <div class='product__details__option__sizes'>
                                                        ";
                                                        $size_ratio_counter = 1;
                                                        foreach($size_array as $size) {

                                                            echo "
                                                                <label for='size_counter_$size_ratio_counter'>
                                                                    <input type='radio' name='size_counter_$size_ratio_counter' class='size-button' value='$size'>$size
                                                                </label>
                                                            ";

                                                            // S,M,L
                                                            // S = size_counter_1
                                                            // M = size_counter_2
                                                            // L = size_counter_3

                                                            $size_ratio_counter++;
                                                        }
                                                        
                                                        echo"
                                                     </div> 
                                                     
                                                    <div class='product__color__select'>
                                                        ";
                                                        foreach($colors_array as $color) {
                                                            echo "
                                                                <label for='pc-6' class='active' style='background:$color;' data-toggle='tooltip' data-placement='top' title='$color'>
                                                                    <input type='radio' id='pc-6'>
                                                                </label>
                                                            ";
                                                        }
                                                        echo"
                                                    </div>
                                                </form>

                                            </div>
                                           
                                       </div>
                                   </div>
                                ";
        
                            }
                        ?>
                       
                   

                    
                    
                   
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

<?php
    $this->view('include/footer');
?>