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
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-to-dropdown">
                        <div class="nav-wrapper d-md-flex justify-content-center" style="text-align: center;">
                            <ul class="nav nav-pills " id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="my-registry-tab" data-toggle="pill" href="#my-registry" role="tab" aria-controls="my-registry" aria-selected="true">My Registry</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="add-items-tab" data-toggle="pill" href="#add-items" role="tab" aria-controls="add-items" aria-selected="false">Add Items</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="settings-tab" data-toggle="pill" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
                                </li>
                            </ul>

                        </div>
                             <form method="post">
                                <div class="tab-content authentication_form" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="my-registry" role="tabpanel" aria-labelledby="my-registry-tab">
                                        <div class="container-fluid">
                                            <div>
                                                <h2 class="mb-3 font-weight-bold">My Baby Registry</h2>
                                                <button type="submit" name="createRegistry" class="site-btn" style="margin-left: 900px;">Create Registry</button>
                                            </div>
                                            
                                            something

                                            
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="add-items" role="tabpanel" aria-labelledby="add-items-tab">
                                        <div class="container-fluid">
                                            <h2 class="mb-3 font-weight-bold">Add Items</h2>
                                            
                                            sometihng

                                            

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                        <div class="container-fluid">
                                            <h2 class="mb-3 font-weight-bold">Settings</h2>
                                            
                                            something

                                        </div>
                                    </div>
                                </div>
                            </form>
                        
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