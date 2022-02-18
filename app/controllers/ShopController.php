<?php
// For normal user 
class ShopController extends Controller{

	// Function that shows the index page when you type 'localhost'
	public function index(){
    
		// get the products' basic information
		$products_basic_info = $this->model('Product')->getAllBasicInfo();
		$products = $this->model('Product')->getAllActive();
    
		$this->view('shop/index', ['products'=>$products, 'products_basic_info'=>$products_basic_info]);

	}

	// product detail page
    public function product($product_id) {
		$product = $this->model('Product')->find($product_id);
		
        $this->view('shop/product_detail', ['product'=>$product]);
    }

	public function cart() {

	}

	public function checkout() {
		$this->view('shop/checkout');
	}

}