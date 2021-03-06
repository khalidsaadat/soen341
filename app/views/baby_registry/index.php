<?php
    // global header -- do not write file extension (.php)
    $this->view('/include/header');

?>

<title>Baby Registry</title>

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
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Baby Registry</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <span>Baby Registry</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout">
        <div class="container" style="margin-top: 20px;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-to-dropdown">
                        
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h2 class="mb-3 font-weight-bold">My Baby Registries</h2>
                                </div>
                                <div class="col-lg-2" style="display: flex; justify-content: right; align-items: center;">  
                                    <img src="/assets/icons/add.png" height="30" onclick="location.href='/babyregistry/add'" data-toggle="tooltip" data-placement="left" data-original-title="Add a baby registry" style="cursor: pointer;">
                                </div>
                            </div>
                            <?php
                                // baby registries
                                $baby_registeries = $model['baby_registeries'];
                                if(count($baby_registeries) == 0) {
                                    // baby registry is empty for this user
                                    echo "
                                    <div class='col-lg-12 text-center'>
                                        <div class='text-center' style='margin-top: 20px;'>
                                            <h4>You do not have any baby registry</h4><br>
                                        </div>
                                    </div>
                                    ";
                                }
                                else {
                                    // there are baby registeries for this user
                                    // loop through the baby registry
                                    foreach($baby_registeries as $baby_registry) {
                                        // baby registry detail
                                        $baby_reg_id = $baby_registry->baby_registry_id;
                                        $name = $baby_registry->name;
                                        
                                        $product_ids = $baby_registry->product_ids;
                                        $product_ids_array = unserialize($product_ids);
                                        $products_count = (!empty($product_ids_array) > 0) ? count($product_ids_array) : 0;

                                        $organizer_name = $baby_registry->organizer_name;
                                        $delivery_date = $baby_registry->delivery_date;
                                        $delivery_date = date('d F, Y', strtotime($delivery_date));
                                        
                                        $address_id = $baby_registry->address_id;
                                        $address = $this->model('Address')->find($address_id);

                                        $description = $baby_registry->description;
                                        $status = $baby_registry->status;

                                        // get the existing token if exists by the baby reg id
                                        $baby_reg_token = $this->model('BabyRegistryToken')->findByBabyRegistryId($baby_reg_id);
                                        $token;
                                        if($baby_reg_token == false) {
                                            // open the form for generating a new baby reg token
                                            echo "
                                                <form class='share_form' method='post'>
                                            ";
                                        }
                                        else {
                                            // get the existing token for this baby reg
                                            $token = $baby_reg_token->token;
                                        }

                                        // shareable url
                                        $url = '';
                                    
                                    ?>
                                                <div class="col-lg-12" style="background: #f5f7f7; border: 1px solid #EFF2F2; border-radius: 5px; padding: 15px; margin-bottom: 15px;">
                                                    <input type="hidden" name="baby_registry_id" id="baby_registry_id" value="<?php echo $baby_reg_id; ?>">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div>
                                                                <span style="font-weight: bold; font-size: 18px;"><?php echo $name; ?></span>
                                                            </div>
                                                            <div>
                                                                <span style="color: #575959; font-size: 14px;">
                                                                    Organized by <strong><?php echo $organizer_name; ?></strong> <br>
                                                                    Event date: <strong><?php echo $delivery_date; ?></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="text-right">
                                                                # of products: <?php echo $products_count; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    

                                                    <hr>

                                                    <div style="display: flex; align-items: center;">
                                                        <img src="/assets/icons/settings.png" height="14" style="vertical-align:middle; padding-right: 5px;"><span style="font-size: 11px;">SETTINGS</span>
                                                        <span style="padding-left: 10px; padding-right: 10px;"></span>

                                                        <?php
                                                            
                                                            if($baby_reg_token == true) {
                                                                // show the existing token
                                                                echo "
                                                                    <div style='cursor: pointer;' data-toggle='collapse' href='#collapseExample-$baby_reg_id' role='button' aria-expanded='false' aria-controls='collapseExample'>
                                                                        <img src='/assets/icons/link.png' height='14' style='vertical-align:middle;'>
                                                                        <span style='font-size: 11px;'>SHARE</span>
                                                                    </div>
                                                                ";
                                                                $url = '/babyregistry/shareable/' . $token;
                                                            }
                                                            else {
                                                                // generate a new one and display it
                                                                echo "
                                                                    <button type='submit' style='background: none; border: none;' data-toggle='collapse' href='#collapseExample-$baby_reg_id' role='button' aria-expanded='false' aria-controls='collapseExample'>
                                                                        <img src='/assets/icons/link.png' height='14' style='vertical-align:middle; padding-right: 5px;'>
                                                                        <span style='font-size: 11px;'>SHARE</span>
                                                                    </button>
                                                                ";
                                                            }

                                                        ?>
                                                    
                                                        <span style="padding-left: 10px; padding-right: 10px;"></span>
                                                        
                                                        <span onclick="location.href='/babyregistry/add_products/<?php echo $token; ?>'" style="cursor: pointer;">
                                                            <img src="/assets/icons/add_sign.png" height="14" style="vertical-align:middle; padding-right: 5px;"><span style="font-size: 11px;">ADD PRODUCTS</span>
                                                        </span>
                                                    </div>

                                                    <!-- Shareable link collapse -->
                                                    <div class="collapse" id="collapseExample-<?php echo $baby_reg_id; ?>">
                                                        <div class="card card-body">
                                                            <div id="my_links" class="row">
                                                                <div class="col-lg-8">
                                                                    <input type="hidden" style="width: 700px;" id="<?php echo $url; ?>" value="<?php echo $baby_reg_id; ?>">
                                                                    <a href="<?php echo $url; ?>" id="shareable_link_url" style="color: blue;"><?php echo $url; ?></a>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <!-- <img src="/assets/icons/copy.png" height="14" onclick="copyText()" onmousemove="changeTooltip()" data-toggle="tooltip" data-placement="top" data-original-title="Copy link" style="vertical-align:middle; padding-right: 5px; cursor: pointer;"> -->
                                                                    <img id="<?php echo 'localhost' . $url; ?>" src="/assets/icons/copy.png" onmousemove="changeTooltip()" height="14" data-toggle="tooltip" data-placement="top" data-original-title="Copy link" style="vertical-align:middle; padding-right: 5px; cursor: pointer;">
                                                                </div>
                                                            </div>

                                                            <div id="log"></div>
                                                        </div>
                                                    </div>

                                                    
                                                </div>
                                    <?php

                                        if($baby_reg_token == false) {
                                            echo "
                                                </form>
                                            ";
                                        }
                                    ?>
                                    <?php
                                    }
                                }
                            ?>
                            
                                
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    

<?php
    // global footer - do not write file extension (.php)
    $this->view('include/footer');
?>