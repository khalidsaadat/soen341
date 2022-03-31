<?php
    // global header -- do not write file extension (.php)
    $this->view('/include/header');
?>

<title>Baby Registry Settings</title>

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
                        <h4>Baby Registry Settings</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Baby Registry</a>
                            <span>Baby Registry Settings</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form method="post">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Baby Registry
                                    <p class="to_lower_case">Manage your Baby Registry settings below.</p>
                            </h6>
                            <div class="row">
                            <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Baby Registry Title<span>*</span></p>
                                        <input type="text" name="title" id="title" required>
                                    </div>
                                </div> 
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" name="first_name" id="first_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name" id="last_name" required>
                                    </div>
                                </div>
                            </div> 
                             <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="text" name="email" id="email" required>
                            </div>
                            <div class="checkout__input">
                                <p>Expected Arrival Date<span>*</span></p>
                                <div class="form-group">
                                    <label class="control-label" for="date">Date</label>
                                    <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
                                </div>
                            </div>

                            <div class="checkout__input__checkbox">
                                <br>
                                <p>Is This Your First Baby ?</p>
                                <input type="radio" name = "ans" value="yes"> Yes </br>
                                <input type="radio" name = "ans" value="no"> No </br>
                                 
                            </div>

                            <!-- shipping address -->
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col-lg-12">
                                    <div style="background: #e1e5ee; padding: 5px 10px;">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <span style="font-size: 16px; font-weight: bold;">
                                                    Your delivery address:
                                                </span> 
                                            </div>
                                            <div class="col-md-2 text-right" style="font-size: 14px; cursor: pointer;" data-toggle="modal" data-target="#change-address-modal">
                                                <span class="icon_pencil"  style="cursor: pointer;"></span> 
                                                <span style="color: #2a324b;">Change</span>
                                            </div>

                                        </div>
                                        <div style="padding-top: 10px;">
                                            <?php
                                                if(isset($model['primary_address'])) {

                                                    $primary_address = $model['primary_address'];
                                                    $p_full_address = $primary_address->street . ', ' . $primary_address->city . ', ' . $primary_address->province . ', ' . $primary_address->postal_code . ', ' . $primary_address->country;
                                                    
                                                    echo "
                                                        <input type='radio' id='primary' name='address' checked='checked'> <label for='primary'>$p_full_address</label> <br>
                                                    ";
                                                }

                                                if(isset($model['secondary_address'])) {
                                                    $secondary_address = $model['secondary_address'];
                                                    $s_full_address = $secondary_address->street . ', ' . $secondary_address->city . ', ' . $secondary_address->province . ', ' . $secondary_address->postal_code . ', ' . $secondary_address->country;
                                                }
                                            ?>
                                                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Change Address Modal -->
                            <div class="modal fade" id="change-address-modal" tabindex="-1" role="dialog" aria-labelledby="change-address-modal-label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight" id="change-address-modal-label">Select Your Delivery Address</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            <div class="modal-body">
                                                
                                                    <span style="font-size: 18px;">Your current delivery address is: </span>    
                                                    <div style="padding-left: 10px; font-style: italic; font-weight: bold;">
                                                        <?php echo $p_full_address; ?>
                                                    </div>

                                                    <hr>
                                                    <div>
                                                        <span style="font-size: 18px;">Available addresses to select: </span>
                                                        <div style="padding-left: 10px;">
                                                            <?php
                                                                echo "
                                                                    <input type='radio' id='p_address' name='change_address' value='$primary_address->address_id' checked='checked'> <label for='p_address'>$p_full_address</label> <br>
                                                                    <input type='radio' id='s_address' name='change_address' value='$secondary_address->address_id'> <label for='s_address'>$s_full_address</label> <br>
                                                                ";
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div>
                                                        Want to update your address? Click <a href="/account" style="color: blue;">here</a>
                                                    </div>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="site-btn" data-dismiss="modal">Close</button>
                                                <button type="submit"  name="update_address" class="site-btn">Confirm Changes</button>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="checkout__input__checkbox">
                                <br>
                                <label for="acc">
                                   Allow family and friends to easily purchase from 3rd party merchants
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <div class="checkout__input">
                                <p>Add a greetings to your friends and family at the top of your registry</p>
                                <input type="text" name= "description" id = "description"
                                placeholder="E.g Thank you so much for visiting our Baby Registry.">
                            </div>

                            <button type="submit" name="create_registry" class="site-btn">Create my Baby Registry</button>
                           
                    
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

<?php
    // global footer - do not write file extension (.php)
    $this->view('include/footer');
?>