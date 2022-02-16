<?php
// For normal user 
class ShopController extends Controller{

	// Function that shows the index page when you type 'localhost'
	public function index(){

		$products = $this->model('Product')->getAllActive();
		// Send the 'products' variable to the View for rendering it to the webpage.
		$this->view('shop/index', ['products'=>$products]);
	}

    public function product($product_id) {
        $this->view('shop/product_detail');
    }

	public function cart() {

	}

	public function checkout() {
		$this->view('shop/checkout');
	}

}