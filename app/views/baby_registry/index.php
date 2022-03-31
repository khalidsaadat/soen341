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
                                    <a class="nav-link" id="settings-tab" data-toggle="pill" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
                                </li>
                            </ul>

                        </div>

                        <div class="tab-content authentication_form" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="my-registry" role="tabpanel" aria-labelledby="my-registry-tab">
                                <div class="container-fluid">
                                    <h2 class="mb-3 font-weight-bold">My Baby Registry</h2>
                                    
                                    <form class="share_form" method="post">
                                        <div class="col-lg-12" style="background: #f5f7f7; border: 1px solid #EFF2F2; border-radius: 5px; padding: 15px; margin-bottom: 15px;">
                                            <input type="hidden" name="baby_registry_id" id="baby_registry_id" value="1">
                                            <div>
                                                <span style="font-weight: bold; font-size: 18px;">Baby Registry Title</span>
                                            </div>
                                            <div>
                                                <span style="color: #575959; font-size: 14px;">
                                                    Created by <strong>Anum and Shabia</strong> on 1 April, 2022
                                                </span>
                                            </div>

                                            <hr>
                                            <div style="display: flex; align-items: center;">
                                                <img src="/assets/icons/settings.png" height="14" style="vertical-align:middle; padding-right: 5px;"><span style="font-size: 11px;">SETTINGS</span>
                                                <span style="padding-left: 10px; padding-right: 10px;"></span>

                                                <button type="submit" style="background: none; border: none;" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    <img src="/assets/icons/link.png" height="14" style="vertical-align:middle; padding-right: 5px;">
                                                    <span style="font-size: 11px;" onclick="">SHARE</span>
                                                </button>
                                                
                                                
                                                <span style="padding-left: 10px; padding-right: 10px;"></span>
                                                
                                                <img src="/assets/icons/option.png" height="14" style="vertical-align:middle; padding-right: 5px;"><span style="font-size: 11px;">MORE</span>
                                            </div>

                                            <div class="collapse" id="collapseExample">
                                                <div class="card card-body">
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <a href="" id="shareable_link_url" style="color: blue;"></a>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <img src="/assets/icons/copy.png" height="14" style="vertical-align:middle; padding-right: 5px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                        </div>
                                    </form>

                                    <div class="col-lg-12" style="background: #f5f7f7; border: 1px solid #EFF2F2; border-radius: 5px; padding: 15px;">
                                        <div>
                                            <span style="font-weight: bold; font-size: 18px;">Another Title</span>
                                        </div>
                                        <div>
                                            <span style="color: #575959; font-size: 14px;">
                                                Created by <strong>Khalid</strong> on 1 February, 2022
                                            </span>
                                        </div>

                                        <hr>
                                        <div style="display: flex; align-items: center;">
                                            <img src="/assets/icons/settings.png" height="14" style="vertical-align:middle; padding-right: 5px;"><span style="font-size: 11px;">SETTINGS</span>
                                            <span style="padding-left: 10px; padding-right: 10px;"></span>

                                            <img src="/assets/icons/link.png" height="14" style="vertical-align:middle; padding-right: 5px;">
                                            <span style="font-size: 11px;" onclick="">SHARE</span>
                                            
                                            <span style="padding-left: 10px; padding-right: 10px;"></span>
                                            
                                            <img src="/assets/icons/option.png" height="14" style="vertical-align:middle; padding-right: 5px;"><span style="font-size: 11px;">MORE</span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <div class="container-fluid">
                                    <h2 class="mb-3 font-weight-bold">Settings</h2>
                                    
                                    something

                                </div>
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