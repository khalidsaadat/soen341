<?php
    $this->view('include/header');
?>
<title>Add a Product</title>

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
                <form method="post" enctype="multipart/form-data">
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
                                        <input type="text" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Brand<span>*</span></p>
                                                <select name="brand" id="brand" class="selectpicker txt-black" multiple data-live-search="true" data-max-options="1" title=" ">
                                                    <?php
                                                        $brands = $model['brands'];

                                                        foreach($brands as $brand) {
                                                            $brand_name = $brand->brand_name;
                                                          
                                                            echo "
                                                                <option value='$brand->brand_id'>$brand->brand_name</option>
                                                            ";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                       </div>
                                       <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Categories<span>*</span> <span class="label-sub">(Separate by comma)</span></p>
                                                <select name="categories[]" id="categories[]" class="selectpicker txt-black" multiple data-live-search="true" data-max-options="3" title=" ">
                                                    <?php
                                                        $categories = $model['categories'];

                                                        foreach($categories as $category) {
                                                            $category_name = $category->category_name;
                                                          
                                                            echo "
                                                                <option value='$category->category_name'>$category->category_name</option>
                                                            ";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                       </div>
                                   </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Price<span>*</span></p>
                                                <input type="text" name="price" id="price" required>
                                            </div>
                                       </div>
                                       <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Quantity<span>*</span> <span class="label-sub"></span></p>
                                                <input type="text" name="quantity" id="quantity" required>
                                            </div>
                                       </div>
                                   </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                       <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Size(s)<span>*</span></p>
                                                <select name="size[]" id="size[]" class="selectpicker txt-black" multiple title=" ">
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
                                                <input type="text" name="colors" id="colors" required>
                                            </div>
                                       </div>
                                   </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Keywords<span>*</span> <span class="label-sub">(Separate by comma)</span></p>
                                        <input type="text" name="keywords" id="keywords" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="checkout__input">
                                                <p>Reward Point<span>*</span></p>
                                                <input type="text" name="reward_point" id="reward_point" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 d-flex align-items-center">
                                            <div class=" checkout__input__checkbox">
                                                <label for="promotion">
                                                    Promotion
                                                    <input type="checkbox" name="promotion" id="promotion" value="1">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <form method="post" action="#" id="#">
                                            <div class="form-group files color">
                                                <p>Upload Images<span>*</span></p>
                                                <input type="file" name="images[]" id="image[]" class="form-control" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <textarea name="product_description"></textarea>
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