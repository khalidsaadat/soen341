
<?php
    // global header -- do not write file extension (.php)
    $this->view('/include/header');
?>

<title>Admin Portal</title>

                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/shop">Shop</a></li>
                            <li><a href="/">Baby Registry</a></li>
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
                        <h4>Admin Dashboard</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <?php
        $products = $model['products'];
        $promotions = $model['promotions'];
        $promotions_count = (sizeof($promotions) > 0) ? sizeof($promotions) : '0';
        $new_products = $model['new_products'];
        $new_products_count = (sizeof($new_products) > 0) ? sizeof($new_products) : '0';
    ?>

    <!-- Checkout Section Begin -->
    <section class="checkout spad spad-t-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-1">
                                <div class="heading">Top Products</div>
                                <div class="text-right">
                                    <div class="static_number">
                                        14
                                    </div>
                                    <div>
                                        <span class="static_percentage"><span class="font-weight-bold arrow_up"></span> 25%</span> from last month
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-2">
                                <div class="heading">New Products</div>
                                <div class="text-right">
                                    <div class="static_number">
                                        <?php echo $new_products_count; ?>
                                    </div>
                                    <div>
                                        <span class="static_percentage"><span class="font-weight-bold arrow_down"></span> 25%</span> from last month
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-3">
                                <div class="heading">On Sale</div>
                                <div class="text-right">
                                    <div class="static_number">
                                        <?php echo $promotions_count; ?>
                                    </div>
                                    <div>
                                        <span class="static_percentage"><span class="font-weight-bold arrow_up"></span> 25%</span> from last month
                                    </div>
                                </div>
                            </div>     
                        </div>
                    </div>
                    <hr>

                    <div class="container" style="padding-right: 0px; padding-left: 0px;">
                        <div class="table-responsive">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h2 class="font-weight-bold">Products</h2>
                                        </div>
                                        <div class="col-sm-8">						
                                            <a href="/product/add_product" class="btn btn-primary"><i class="material-icons">&#xe145;</i> <span>Add a Product</span></a>
                                        </div>
                                    </div>
                                </div>
                              
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Brand</th>
                                            <th>Price</th>						
                                            <th>Quantity</th>
                                            <th>Promotion</th>						
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                        <?php 
                                            foreach($products as $product) {
                                                $product_name = $product->name;
                                                $brand_name = $this->model('Brand')->find($product->brand_id)->brand_name;
                                                $price = $product->price;
                                                $quantity = $product->quantity_available;
                                                $promotion = ($product->promotion == 1) ? 'Sale' : '-';
                                                $status = ($product->status == 1) ? 'In Stock' : 'Out of stock';
                                                
                                                echo "
                                                    <tr>
                                                        <td>1</td>
                                                        <td><a href='#'><img src='/assets/img/product/product-1.jpg' class='avatar' alt=''>$product_name</a></td>
                                                        <td class='text-center'>$brand_name</td>
                                                        <td class='text-center'>$$price</td>                        
                                                        <td class='text-center'>$quantity</td>
                                                        <td  class='text-center'>$promotion</td>
                                                        <td><span class='status text-success'>&bull;</span> $status</td>
                                                        <td><a href='' class='view' title='View Details' data-toggle='tooltip'><i class='material-icons'>&#xE5C8;</i></a></td>
                                                    </tr>
                                                ";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                
                            </div>
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